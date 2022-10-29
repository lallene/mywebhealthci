<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent_sante extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['nom','prenom','email','contact','site_id'];

    public function site(){
        return $this->belongsTo(Site::class, 'site_id');
    }
}
