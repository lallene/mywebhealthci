<?php

namespace App\Exports;

use App\Models\Consultation;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ConsultationsExport implements FromView
{
    public function view(): View
    {
        return view('exports.consultations', [
            'consultation' => Consultation::all()
        ]);
    }
}
