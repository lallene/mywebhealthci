<?php

namespace App\Imports;

use App\Models\Sub_fonction;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class SubFonctionImport implements ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow, SkipsOnError
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
         //dd($row);
         $fonction= DB::table('sub_fonctions')->where('intitule', $row['fonction_emploi'])->first();
         if ($fonction == null ){ $row['fonction_emploi'] = 4;}else{ $row['fonction_emploi'] = $fonction->id;};

         $sub_fonctions = DB::table('sub_fonctions')->where('intitule', $row['sub_fonction'])->first();
         dd($row, $row['projetservice'], $row['site']);

         if ($sub_fonctions == null){
            dd($row, $row['projetservice'], $row['site']);
             return new Sub_fonction([
                 'intitule'=>$row['sub_fonction'],
                 'fonction_id'=>$row['fonction_emploi'],
             ]);

         }else{
             $sub_fonctions = Sub_fonction::where( 'intitule' ,'=', $row['sub_fonction'])->first();
             $sub_fonctions->site_id = $row['fonction_emploi'];

             try{

                 $sub_fonctions->save();

             }catch (\Exception $e){
                 echo'e';
                // return redirect()->route('configuration.sub_fonction.liste');
             }

         }
    }
    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 500;
    }

    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
    }
}
