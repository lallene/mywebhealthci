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
        'accident',
        'traitement',
        'arretMaladie',
        'duree_arret',
        'nbrJour',
        'debutArret',
        'dateReprise',
        'repriseService',
        'maladie_contagieuse',
        'maladie_prof',
        'vaccin_covid',
        'testCovid',
        'doseVaccinCovid',
        'observation',
        'motif_consultation_id',
        'natureReception',
        'natureDuree',
        'user_id',
        'dateConsultation',
        'typeConsultation',
        'etatValidite',
        'justificatifValide',
        'motifRejet',
        'nomMedecin',
        'designationCentreExterne',
        'repos',
        'assurance',
        'dateConsultation ',
        'soinadministre',
        'ordonnanceremise',
        'analyseExterne',
        'nbrJour',
        'analyseExterne',
        'projet_site',
        'projet_id'

    ];

    public function MotifConsultation(){
        return $this->belongsTo(Motif_consultation::class, 'motif_consultation_id');
    }

    public function Site(){
        return $this->belongsTo(site::class, 'natureReception');
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


}


