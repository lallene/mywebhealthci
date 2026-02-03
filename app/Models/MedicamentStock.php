<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicamentStock extends Model
{
      protected $fillable = ['qte', 'medicament_id', 'user_id'];

    public function medication()
    {
        return $this->belongsTo(Medication::class, 'medicament_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
