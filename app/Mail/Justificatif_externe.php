<?php

namespace App\Mail;

use App\Models\Agent;
use App\Models\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;


class Justificatif_externe extends Mailable
{
    use Queueable, SerializesModels;

    public $agent, $consultation,  $dateFin, $workday_id, $nbreJour, $dateReprise, $dateDebut,  $dateConsul, $projet, $medecin, $hours, $minutes, $dateFinExt, $dateDebutExt, $dateRepriseExt,  $dateFinRepos, $dateDebutRepos, $dateRepriseRepos;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( Agent $agent, Consultation $consultation )
    {



       // dd($consultation->typeArrêt);

        $dateDebut = Carbon::parse($consultation->dateConsultation)->format('d-m-Y');
        $repriseDateTime = Carbon::parse($consultation->dateConsultation)->copy()->addMinutes($consultation->duree_arret);
      //  $dateReprise = $repriseDateTime->format('d-m-Y');
        $dateRepriseCarbon = Carbon::parse($consultation->created_at)
            ->copy()
            ->addMinutes($consultation->duree_arret);

        // Si la date calculée est aujourd’hui ou déjà passée → prendre demain
        if ($dateRepriseCarbon->isSameDay(Carbon::today()) || $dateRepriseCarbon->lessThan(Carbon::now())) {
            $dateRepriseCarbon = Carbon::tomorrow();
        }

        // Si l’heure dépasse 19h → basculer au jour suivant
        if ($dateRepriseCarbon->hour >= 19) {
            $dateRepriseCarbon = $dateRepriseCarbon->copy()->addDay();
        }

        // Formater uniquement la date sans heure
        $dateReprise = $dateRepriseCarbon->format('d-m-Y');
       // $dateReprise = Carbon::parse($consultation->created_at)->copy()->addMinutes($consultation->duree_arret)->format('d-m-Y');

        $dateFin = $dateRepriseCarbon->copy()->subDay()->format('d-m-Y');

        $dateConsul = Carbon::parse($consultation->created_at)->format('d-m-Y');
        $nbreJour = Carbon::parse($consultation->dateConsultation)->diffInDays($repriseDateTime);
        $agent = Agent::find($_POST['agent_id']);
        $projet = $agent->Projet->designation;
        $medecin = $consultation->Medecin->name;
        $init = $consultation->duree_arret ;
        $workday_id =$agent->Matricule_salarie;
        $dateDebutExt = Carbon::parse($consultation->debutArret)->format('d-m-Y');
        $repriseDateTimeExt = Carbon::parse($consultation->debutArret)->copy()->addMinutes($consultation->duree_arret);
        $dateRepriseExt = $repriseDateTimeExt->format('d-m-Y');
        $dateFinExt = $repriseDateTimeExt->copy()->subDay()->format('d-m-Y');


        $dateDebutRepos = Carbon::parse($consultation->created_at)->format('d-m-Y H:i');
        $dateRepriseRepos = Carbon::parse($consultation->created_at)->copy()->addMinutes($consultation->duree_arret + 5)->format('d-m-Y H:i');
       $dateFinRepos = Carbon::parse($consultation->created_at)
        ->copy()
        ->addMinutes($consultation->duree_arret)
        ->format('d-m-Y H:i');
    //   dd( $dateDebutExt, $dateFinExt, $dateRepriseExt);

        $days = 0;
        $hours = floor (($init - $days * 1440) / 60);
        $minutes = $init - ($days * 1440) - ($hours * 60);


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
        $this->workday_id = $workday_id;
        $this->dateFinExt = $dateFinExt;
        $this->dateDebutExt = $dateDebutExt;
        $this->dateRepriseExt = $dateRepriseExt;

        $this->dateDebutRepos = $dateDebutRepos;
        $this->dateRepriseRepos = $dateRepriseRepos;
        $this->dateFinRepos = $dateFinRepos;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->consultation->typeArrêt == 'oui' and $this->consultation->typeConsultation == 'Interne'){
                return $this->markdown('emails.arretvalide')
                ->subject("My Webhealth CI -Projet $this->projet Notification de délivrance d'un arrêt travail validé.")
                ->cc('wh_dlt-ci-hr-business-partner@concentrix.com')
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

            }else if($this->consultation->typeArrêt == 'oui' and $this->consultation->typeConsultation == 'Externe'){
                return $this->markdown('emails.arretvalideExt')
                ->subject("My Webhealth CI -Projet $this->projet Notification de délivrance d'un arrêt travail validé.")
                ->cc('wh_dlt-ci-hr-business-partner@concentrix.com')

                ->with([
                    'agent'=>$this->agent,
                    'consultation'=>$this->consultation,
                    'dateFinExt'=> $this->dateFinExt,
                    'dateRepriseExt' => $this->dateRepriseExt,
                    'nbreJour'=>$this->nbreJour,
                    'dateDebutExt'=> $this->dateDebutExt,
                    'dateConsul'=> $this->dateConsul,
                    'projet' => $this->projet,
                ]);

            }
            else if ($this->consultation->typeArrêt == 'non' and $this->consultation->typeConsultation == 'Externe' ){
                return $this->markdown('emails.arretrefuse')
                ->subject("My Webhealth CI -Projet $this->projet Notification d’arrêt de travail non validé.")
                ->cc('wh_dlt-ci-hr-business-partner@concentrix.com')
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

            }else if ($this->consultation->typeArrêt == 'repos'){
                return $this->markdown('emails.repos')
                ->subject("My Webhealth CI -Projet $this->projet Notification de délivrance d’un arrêt de travail à effectuer sur site.")
                ->cc('wh_dlt-ci-hr-business-partner@concentrix.com')
                ->with([

                    'agent'=>$this->agent,
                    'consultation'=>$this->consultation,
                    'dateFin'=> $this->dateFinRepos,
                    'dateReprise' => $this->dateRepriseRepos,
                    'nbreJour'=>$this->nbreJour,
                    'dateDebut'=> $this->dateDebutRepos,
                    'dateConsul'=> $this->dateConsul,
                    'projet' => $this->projet

                ]);

            }else if ($this->consultation->typeArrêt == 'en attente'){
                return $this->markdown('emails.arretsenattente')
                ->subject("My Webhealth CI -Projet $this->projet Notification d’arrêt de travail en attente de validation.")
                ->cc('wh_dlt-ci-hr-business-partner@concentrix.com')
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
            else if ($this->consultation->typeArrêt == 'Analyse externe'){
                return $this->markdown('emails.analyse_externe')
                ->subject("My Webhealth CI -Projet $this->projet  Notification de délivrance d’un arrêt de travail.")
                ->cc('wh_dlt-ci-hr-business-partner@concentrix.com')
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
            else if ($this->consultation->typeArrêt == 'non' and $this->consultation->typeConsultation == 'Interne'){
                return $this->markdown('emails.noarret')
                ->subject("My Webhealth CI -Projet $this->projet  Notification de non-délivrance d’un arrêt de travail.")
            //    ->cc('wh_dlt-ci-hr-business-partner@concentrix.com')
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
           return redirect()->route('consultation.index')->with('success','Justificatif enregistré avec succès. Email envoyé aux superviseurs');
        }
}
