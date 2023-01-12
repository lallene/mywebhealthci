<?php

namespace App\Models;

use App\Models\Familleemploi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Emploi extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['designation', 'familleemploi_id'];




    public function Familleemploi(){

        return $this->belongsTo( Familleemploi::class, "familleemploi_id");
    }
}
