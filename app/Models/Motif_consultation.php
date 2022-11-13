<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motif_consultation extends Model
{
    use HasFactory;
    protected $fillable = ['intitule'];

    public function Consultations(){
        return $this->hasMany(Consultation::class);
    }

}
