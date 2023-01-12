<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Justificatif extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nomMedecin',
        'designationCentreExterne',
        'justificatifValide',
        'motifRejet',
        'duplicat_suite_valide',
        'motif_consultation_id',
        'consultation_id'
    ];

    public function MotifNvlleConsultation(){
        return $this->belongsTo(Motif_consultation::class, 'motif_consultation_id');
    }


}


