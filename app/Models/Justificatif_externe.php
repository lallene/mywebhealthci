<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Justificatif_externe extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [ 'date_dbt_arret',  'duree_arret', 'site_id',
                           'date_repise_trvl','nbre_jours', 'billet_sortie',
                           'repris_service', 'clinique_externe', 'medecin_externe', 'justif_valide',
                            'motif_rejet', 'duplicat_suite_valide', 'user_id', 'agent_id', 'assurance', 'observation', 'motif_consultation_id', 'motif_consultation_externe_id'];

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


