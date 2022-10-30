<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    public $fillable = [
        'iris',
        'entite',
        'nom',
        'prenom',
        'sexe',
        'dateembauche',
        'manager',
        'projet_id',
        'emploi_id',
        'sousfonction_id',
        'contrat_id',
        'societe_id'
    ];

    public $timestamps = false;

    public function Projet(){
        return $this->belongsTo(Projet::class, 'projet_id');
    }

    public function Emploi(){
        return $this->belongsTo(Emploi::class, 'emploi_id');
    }

    public function SousFonction(){
        return $this->belongsTo(Sub_fonction::class, 'sousfonction_id');
    }

    public function Contrat(){
        return $this->belongsTo(Contrat::class, 'contrat_id');
    }

    public function Societe(){
        return $this->belongsTo(Societe::class, 'societe_id');
    }

    public function Manager(){
        return $this->belongsTo(Agent::class, 'manager', 'iris');
    }
}
