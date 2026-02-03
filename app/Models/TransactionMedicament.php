<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionMedicament extends Model
{
    use HasFactory;
    protected $fillable = ['consultation_id', 'medication_id', 'qte', 'stock_id', 'site_id', 'projet_id'];

    public function Stock(){
        return $this->belongsTo(Stock::class, 'stock_id');
    }

    public function Consultation(){
        return $this->belongsTo(Consultation::class, 'consultation_id');
    }

    public function projet(){
        return $this->belongsTo(Projet::class, 'projet_id');
    }

    public function site(){
        return $this->belongsTo(Site::class, 'site_id');
    }
}



