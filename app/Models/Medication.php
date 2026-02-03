<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;


    public $timestamps = true;
    protected $fillable = ['name', 'stock_quantity', 'site_id', 'alert_threshold', 'expiration_date', 'supplier', 'supply_date', 'unit_price', 'tablet_count', 'distribution_type_id', 'validation', 'famille_medicament'];


    public function TypeDistribution(){
        return $this->belongsTo(TypeDistribution::class, 'distribution_type_id');
    }


    public function Site(){
        return $this->belongsTo(Site::class, 'site_id');
    }

    public function TransactionMedicament(){
        return $this->hasMany(TransactionMedicament::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'medication_id');
    }
}
