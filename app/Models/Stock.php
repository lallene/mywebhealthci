<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = ['stock_site_1', 'user_id', 'medication_id','stock_site_2','stock_site_3',];
    
    public function Medication(){
        return $this->belongsTo(Medication::class, 'medication_id');
    }

    public function User(){
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function TransactionMedicament(){
        return $this->hasMany(TransactionMedicament::class);
    }
}
