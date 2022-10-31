<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Justificatif_externe extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['statut','acident_travail','acident_travail','traitement_adm',
                           'medoc_adm', 'arret_maladie', 'date_dbt_arret',  'duree_arret', 'site_id', 'date_repise_trvl',
                           'date_repise_trvl','nbre_jours', 'statut_arret', 'billet_sortie', 'covid,','accident_travail','arret_maladie_recu',
                           'repris_service', 'vaccin_covid', 'clinique_externe', 'medecin_externe', 'justif_valide',
                            'motif_rejet', 'duplicat_suite_valide', 'dose_covid', 'user_id', 'agent_id'];

    public function maladie_prof(){
        return $this->belongsTo(Maladie_prof::class, 'maladie_prof_id');
    }
    public function maladie_contagieuse(){
        return $this->belongsTo(Maladie_contagieuse::class, 'maladie_contagieuse_id');
    }
    public function motif_consultation(){
        return $this->belongsTo(Motif_consultation::class, 'motif_consultation_id');
    }
    public function site(){
        return $this->belongsTo(Site::class, 'site_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function agent(){
        return $this->belongsTo(Agent::class, 'agent_id');
    }



}

