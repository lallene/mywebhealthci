<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_fonction extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['intitule', 'fonction_id'];

    public function Fonction(){
        return $this->belongsTo(Fonction::class, 'fonction_id');
    }

    public function Agent(){
        return $this->hasMany(Agent::class);
    }


}
