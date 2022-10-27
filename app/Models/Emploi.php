<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emploi extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['designation', 'description', 'familleemploi_id'];

    public function Famille(){
        return $this->belongsTo(Familleemploi::class, 'familleemploi_id');
    }
}
