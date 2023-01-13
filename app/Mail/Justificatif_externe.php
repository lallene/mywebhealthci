<?php

namespace App\Mail;

use App\Models\Agent;
use App\Models\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class Justificatif_externe extends Mailable
{
    use Queueable, SerializesModels;






    public $agent, $consultation, $nhr, $justificatif, $dateFin, $nbreJour, $dateReprise, $dateDebut,  $dateConsul, $projet ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $nhr, Agent $agent, Consultation $consultation)
    {

        $diff = strtotime($consultation->dateReprise) - strtotime($consultation->debutArret);
        $nbreJour  = abs(round($diff / 86400));
        $dateFin = date('d-m-Y', strtotime($consultation->dateReprise. ' - 1 days'));
        $dateDebut = date('d-m-Y', strtotime($consultation->debutArret));
        $dateReprise = date('d-m-Y', strtotime($consultation->dateReprise));
        $dateConsul = date('d-m-Y', strtotime($consultation->created_at));
        $projet = $agent->Projet->designation;





        $this->nhr = $nhr;
        $this->agent = $agent;
        $this->consultation = $consultation;
        $this->dateFin = $dateFin;
        $this->nbreJour =$nbreJour;
        $this->dateDebut = $dateDebut;
        $this->dateReprise = $dateReprise;
        $this->dateConsul =  $dateConsul;
        $this->projet = $projet;

      //  dd($projet);




    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.justificatif_externe')
                    ->subject("My Webhealth CI -Projet $this->projet Notification de reception/délivrance d'un arrêt maladie.")
                    ->with([
                        'nhr'=>$this->nhr,
                        'agent'=>$this->agent,
                        'consultation'=>$this->consultation,
                        'dateFin'=> $this->dateFin,
                        'dateReprise' => $this->dateReprise,
                        'nbreJour'=>$this->nbreJour,
                        'dateDebut'=> $this->dateDebut,
                        'dateConsul'=> $this->dateConsul,
                        'projet' => $this->projet

                    ]);
    }
}
