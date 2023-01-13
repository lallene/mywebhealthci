<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricule extends Model
{
    use HasFactory;

    protected $fillable = ['matricule', 'agent_id'];

    public $timestamps = false;

    public function Agent(){
        return $this->belongsTo(Agent::class, 'agent_id');
    }

}
