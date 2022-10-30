<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teste extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'iris',
        'date_embauche'
    ];
}
