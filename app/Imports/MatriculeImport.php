<?php

namespace App\Imports;
use App\Models\Matricule;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class MatriculeImport implements ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow, SkipsOnError
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);
        $iris= DB::table('agents')->where('iris', $row['iris'])->first();
        if (!$iris == null ){ $row['iris'] = $iris->id;}

        $matricule = DB::table('matricules')->where('matricule', $row['matriculeservice'])->first();

        if ($matricule == null){
          //  dd($row, $row['matriculeservice'], $row['agent']);
            return new Matricule([
                'matricule'=>$row['matricule'],
                'agent_id'=>$row['iris'],
            ]);
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
