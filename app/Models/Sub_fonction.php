<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_fonction extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['intitule', 'fonction_id'];

    public function fonction(){
        return $this->belongsTo(fonction::class, 'fonction_id');
    }
}
