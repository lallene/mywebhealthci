<?php

namespace App\Mail;

use App\Models\Agent;
use App\Models\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RapportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $agent, $consultation,   $charge_flux , $datedebutexport, $datefinexport, $projetselected;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Agent $agent, Consultation $consultation)
    {

        dd($consultation);
        $charge_flux = null;
        $datedebutexport =  null;
        $projetselected =  null;
        $datefinexport =  null;

        $this->consultation =  $consultation;
        $this->charge_flux = $charge_flux;
        $this->datedebutexport = $datedebutexport;
        $this->datefinexport = $datefinexport;
        $this->projetselected = $projetselected;
        $this->agent =  $agent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       
        return $this->markdown('emails.arretvalide')
        ->subject("My Webhealth CI -Projet $this->projetselected Notification de délivrance d'un arrêt travail validé.")
        ->with([

            'consultation'=>$this->consultation,
            'cf'=>$this->charge_flux,
            'datedebutexport'=>$this->datedebutexport,
            'datefinexport'=>$this->datefinexport,
            'projetselected'=>$this->projetselected,
            'agent'=>$this->agent,
        ]);

            return redirect()->route('consultation.index')->with('success','le rapport selectionné a été envoyé aux superviseurs');
    }
}
