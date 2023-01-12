<?php

namespace App\Imports;

use App\Models\Emploi;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class EmploiImport implements ToModel,  WithBatchInserts, WithChunkReading, WithHeadingRow, SkipsOnError

{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);
        $emploi= DB::table('emplois')->where('designation', $row['emploi'])->first();


        $familleemploi = DB::table('familleemplois')->where('designation', $row['familleemploi'])->first();
        if ($familleemploi == null ){ $row['familleemploi'] = 7;}else{ $row['familleemploi'] = $emploi->id;};

        if ($emploi == null){
          // dd($row);
            return new Emploi([
                'designation'=>$row['emploi'],
                'familleemploi_id'=>$row['familleemploi'],
            ]);

        }else{
            $emploi = Emploi::where( 'designation' ,'=', $row['emploi'])->first();
            $emploi->site_id = $row['emploi'];

            try{

                $emploi->save();

            }catch (\Exception $e){
                echo'e';
                //return redirect()->route('configuration.projet.liste');
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
