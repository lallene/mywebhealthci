<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['statut','acident_travail','acident_travail','traitement_adm',
                           'medoc_adm', 'arret_maladie', 'duree_arret', 'site_id', 'date_dbt_arret',
                           'date_repise_trvl','nbre_jours', 'statut_arret', 'billet_sortie', 'covid,',
                           'repris_service', 'vaccin_covid','dose_covid', 'observation'];

    public function maladie_prof(){
        return $this->belongsTo(Maladie_prof::class, 'site_id');
    }
    public function maladie_contagieuse(){
        return $this->belongsTo(Maladie_contagieuse::class, 'site_id');
    }
    public function motif_consultation(){
        return $this->belongsTo(Motif_consultation::class, 'site_id');
    }
    public function site(){
        return $this->belongsTo(site::class, 'site_id');
    }
}


