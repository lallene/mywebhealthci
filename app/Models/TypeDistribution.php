<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDistribution extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = ['name'];

    public function Medication(){
        return $this->hasMany(Medication::class);
    }

}
