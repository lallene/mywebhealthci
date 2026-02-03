<?php

namespace App\Exports;
use App\Models\Consultation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class IrisExport implements  FromView
{
    use Exportable;

    protected $from, $to, $workday, $name;
    function __construct($from, $to, $workday, $name) {
        $this->from = $from;
        $this->to = $to;
        $this->workday = $workday;
        $this->name = $name;

 }

    public function view(): View
    {
        return view('export.iris', [
            'invoices' => Consultation::all()->whereBetween('dateConsultation', [$this->from, $this->to])
                                             ->where('Matricule_salarie', '=' ,  $this->workday),
            'datedebut' =>  $this->from,
            'datefin' =>  $this->to,
            'name'=> $this->name,
            'workday'=> $this->workday
        ]);
    }
}
