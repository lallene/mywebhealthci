<?php

namespace App\Mail;

use App\Exports\ConsultationsExport;
use App\Models\Consultation;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class Rapport_chargeflux extends Mailable
{
    use Queueable, SerializesModels;


    public   $consultation, $datedebutexport, $datefinexport;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datedebutexport, $datefinexport)
    {



        $datedebutexport = new DateTime();
        $datedebutexport ->sub(new DateInterval('P7D'));


        $datefinexport = Carbon::now()->subDays(1);



        $this->datedebutexport = $datedebutexport->format('Y-m-d');
        $this->datefinexport = $datefinexport;

      // dd( $datedebutexport, $datefinexport );

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $debut =
        $fin =



        $date_export =date('r');
        return $this->markdown('emails.report')
            ->subject("My Webhealth CI -Rapport du ".$date_export."")
            ->attach(Excel::download(new ConsultationsExport($this->datedebutexport, $this->datefinexport), 'report.xlsx')->getFile(), [
                'as' => 'MyWebhealthCI_report.xlsx'
            ]);

    }
}
