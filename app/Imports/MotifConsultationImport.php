<?php

namespace App\Imports;

use App\Models\Motif_consultation;
use App\Models\Projet;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class MotifConsultationImport implements ToModel,  WithBatchInserts, WithChunkReading, WithHeadingRow, SkipsOnError
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {


         $motif= DB::table('motif_consultations')->where('intitule', $row['site'])->first();

         if ($motif == null){

             return new Motif_consultation([
                 'intitule'=>$row['motif'],
             ]);

             dd($row, $motif);

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
