<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familleemploi extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['designation', 'description'];

    public function Emplois(){
        return $this->hasMany(Emploi::class);
    }
}
