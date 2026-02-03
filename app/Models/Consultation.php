<?php

namespace App\Models;

use App\Models\Ordonnance;
use App\Models\Motif_consultation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Consultation extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'agent_id',
        'poids',
        'poul',
        'temperature',
        'tension',
        'accidentPro',
        'traitementAdmin',
        'duree_arret',
        'debutArret',
        'maladie_contagieuse',
        'maladie_prof',
        'vaccin_covid',
        'testCovid',
        'doseVaccinCovid',
        'observation',
        'motif_consultation_id',
        'siteConsultation',
        'user_id',
        'dateConsultation',
        'typeConsultation',
        'typeArrêt',
        'motifRejet',
        'nomMedecin',
        'designationCentreExterne',
        'dateConsultation ',
        'soinadministre',
        'analyseExterne',
        'projet_id',
        'nbrJour'
    ];

    public function motifs()
    {
        return $this->belongsToMany(Motif_consultation::class, 'consultation_motif_consultation');
    }
    public function Site(){
        return $this->belongsTo(site::class, 'siteConsultation');
    }

    public function Ordonnances(){
        return $this->hasMany(Ordonnance::class);
    }

    public function Medecin(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Agent(){
        return $this->belongsTo(Agent::class, 'agent_id');
    }

    public function Projet(){
        return $this->belongsTo(Projet::class, 'projet_id');
    }

    public function TransactionMedicament(){
        return $this->hasMany(Consultation::class);
    }

}


