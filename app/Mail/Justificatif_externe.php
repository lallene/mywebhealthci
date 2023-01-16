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






    public $agent, $consultation,  $dateFin, $nbreJour, $dateReprise, $dateDebut,  $dateConsul, $projet, $medecin, $hours, $minutes;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( Agent $agent, Consultation $consultation  )
    {

        $diff = strtotime($consultation->dateReprise) - strtotime($consultation->debutArret);
        $nbreJour  = abs(round($diff / 86400));
        $dateFin = date('d-m-Y', strtotime($consultation->dateReprise. ' - 1 days'));
        $dateDebut = date('d-m-Y', strtotime($consultation->debutArret));
        $dateReprise = date('d-m-Y', strtotime($consultation->dateReprise));
        $dateConsul = date('d-m-Y', strtotime($consultation->created_at));
        $agent = Agent::find($_POST['agent_id']);
        $projet = $agent->Projet->designation;
        $medecin = $consultation->Medecin->name;

        $init = $consultation->repos * 60;

        $day = floor($init / 86400);
        $hours = floor(($init -($day*86400)) / 3600);
        $minutes = floor(($init / 60) % 60);
       // dd($consultation, $init, $minutes);






        $this->agent = $agent;
        $this->consultation = $consultation;
        $this->dateFin = $dateFin;
        $this->nbreJour =$nbreJour;
        $this->dateDebut = $dateDebut;
        $this->dateReprise = $dateReprise;
        $this->dateConsul =  $dateConsul;
        $this->projet = $projet;
        $this->medecin = $medecin;
        $this->hours =$hours;
        $this->minutes =$minutes;





    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->consultation->typeConsultation == 'Externe'){
            if ($this->consultation->justificatifValide == 'oui'){
                return $this->markdown('emails.arretvalide')
                ->subject("My Webhealth CI -Projet $this->projet Notification de délivrance d'un arrêt travail validé.")
                ->with([

                    'agent'=>$this->agent,
                    'consultation'=>$this->consultation,
                    'dateFin'=> $this->dateFin,
                    'dateReprise' => $this->dateReprise,
                    'nbreJour'=>$this->nbreJour,
                    'dateDebut'=> $this->dateDebut,
                    'dateConsul'=> $this->dateConsul,
                    'projet' => $this->projet,

                ]);

            }else if ($this->consultation->justificatifValide == 'non'){
                return $this->markdown('emails.arretrefuse')
                ->subject("My Webhealth CI -Projet $this->projet Notification d’arrêt de travail non validé.")
                ->with([

                    'agent'=>$this->agent,
                    'consultation'=>$this->consultation,
                    'dateFin'=> $this->dateFin,
                    'dateReprise' => $this->dateReprise,
                    'nbreJour'=>$this->nbreJour,
                    'dateDebut'=> $this->dateDebut,
                    'dateConsul'=> $this->dateConsul,
                    'projet' => $this->projet

                ]);

            }else if ($this->consultation->arretMaladie == 'repos'){
                return $this->markdown('emails.repos')
                ->subject("My Webhealth CI -Projet $this->projet Notification de délivrance d’un arrêt de travail à effectuer sur site.")
                ->with([

                    'agent'=>$this->agent,
                    'consultation'=>$this->consultation,
                    'dateFin'=> $this->dateFin,
                    'dateReprise' => $this->dateReprise,
                    'nbreJour'=>$this->nbreJour,
                    'dateDebut'=> $this->dateDebut,
                    'dateConsul'=> $this->dateConsul,
                    'projet' => $this->projet

                ]);

            }else if ($this->consultation->justificatifValide == 'en attente'){
                return $this->markdown('emails.arretsenattente')
                ->subject("My Webhealth CI -Projet $this->projet Notification d’arrêt de travail en attente de validation.")
                ->with([

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

        }else if ($this->consultation->typeConsultation == 'Interne') {
            if ($this->consultation->arretMaladie == 'oui'){

                return $this->markdown('emails.arretvalide')
                ->subject("My Webhealth CI -Projet $this->projet Notification de délivrance d'un arrêt travail validé.")
                ->with([

                    'agent'=>$this->agent,
                    'consultation'=>$this->consultation,
                    'dateFin'=> $this->dateFin,
                    'dateReprise' => $this->dateReprise,
                    'nbreJour'=>$this->nbreJour,
                    'dateDebut'=> $this->dateDebut,
                    'dateConsul'=> $this->dateConsul,
                    'projet' => $this->projet,

                ]);



            }else if ($this->consultation->arretMaladie == 'non'){

                return $this->markdown('emails.arretrefuse')
                ->subject("My Webhealth CI -Projet $this->projet Notification d’arrêt de travail non validé.")
                ->with([

                    'agent'=>$this->agent,
                    'consultation'=>$this->consultation,
                    'dateFin'=> $this->dateFin,
                    'dateReprise' => $this->dateReprise,
                    'nbreJour'=>$this->nbreJour,
                    'dateDebut'=> $this->dateDebut,
                    'dateConsul'=> $this->dateConsul,
                    'projet' => $this->projet

                ]);

            }else if ($this->consultation->arretMaladie == 'repos'){
                return $this->markdown('emails.repos')
                ->subject("My Webhealth CI -Projet $this->projet Notification de délivrance d’un arrêt de travail à effectuer sur site.")
                ->with([

                    'agent'=>$this->agent,
                    'consultation'=>$this->consultation,
                    'dateFin'=> $this->dateFin,
                    'dateReprise' => $this->dateReprise,
                    'nbreJour'=>$this->nbreJour,
                    'dateDebut'=> $this->dateDebut,
                    'dateConsul'=> $this->dateConsul,
                    'projet' => $this->projet,
                    'minutes'=>$this->minutes,
                    'hours' =>$this->hours

                ]);

                dd('REPOS');

            }

            return redirect()->route('consultation.index')->with('success','Justificatif enregistré avec succès. Email envoyé aux supervviseurs');;

        }

    }
}
