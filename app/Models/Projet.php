<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['designation', 'site_id', 'dltsuperviseur'];

    public function Site(){
        return $this->belongsTo(Site::class, 'site_id');
    }
    public function Consultations(){
        return $this->hasMany(Consultation::class);
    }

    public function TransactionMedicament(){
        return $this->hasMany(Consultation::class);
    }
}
