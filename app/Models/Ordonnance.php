<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['typeMedicament', 'natureMedicament', 'qte', 'joursTraitement', 'consultation_id'];

    public function Consultation(){
        return $this->belongsTo(Consultation::class);
    }
}
