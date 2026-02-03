<?php

namespace App\Mail;

use App\Models\Agent;
use App\Models\Consultation;
use App\Models\Projet;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class rapport_cf extends Mailable
{
    use Queueable, SerializesModels;



    public  $consultation,   $charge_flux , $datedebutexport, $datefinexport, $projetselected, $agent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( Consultation $consultation, Agent $agent)
    {

        $charge_flux = $consultation->id;
        $datedebutexport = $consultation->id;
        $projetselected = $consultation->id;
        $datefinexport = $consultation->id;


        dd($charge_flux, $datedebutexport, $projetselected, $datefinexport);

        $this->consultation = $consultation;
        $this->charge_flux = $charge_flux;
        $this->datedebutexport = $datedebutexport;
        $this->datefinexport = $datefinexport;
        $this->projetselected = $projetselected;
        $this->agent = $agent;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

                return $this->markdown('emails.rapport_chargeflux')
                ->subject("My Webhealth CI -Projet $this->projetselected Notification du rapport de consultaion journalier.")
                ->with([

                    'consultation'=>$this->consultation,
                    'cf'=>$this->charge_flux,
                    'datedebutexport'=>$this->datedebutexport,
                    'datefinexport'=>$this->datefinexport,
                    'projetselected'=>$this->projetselected,

                ]);

        return redirect()->route('consultation.index')->with('success','le rapport selectionné a été envoyé aux superviseurs');
    }

}
