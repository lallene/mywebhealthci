<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Agent;
use App\Models\Matricule;
use App\Models\Ordonnance;
use App\Models\Consultation;
use App\Models\Justificatif;
use Illuminate\Http\Request;
use App\Mail\Justificatif_externe;
use App\Models\Motif_consultation;
use App\Exports\ConsultationsExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class ConsultationController extends Controller
{
    private $templatePath = 'configuration.consultation';
    private $link = 'consultation';

    public function __construct()
    {
        $this->middleware('auth');

    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Consultation::all();

        return view($this->templatePath.'.search', ['titre' => "Rechercher un collaborateur ", 'items' => $items, 'link' => $this->link]);
    }

    public function consulter($id){
       $agent = Agent::find($id);

       $motifs = Motif_consultation::all();
       $sites = Site::all();
     //
         $matricule = Matricule::where('agent_id', '=', $id)->first();
       //  dd($matricule->matricule);
        return view($this->templatePath.'.consultation', ['titre' => "Consulter", 'sites' => $sites,'motifs' => $motifs, 'matricule'=>$matricule, 'agent' => $agent, 'link' => $this->link]);
    }

    public function reception ($id){
        $agents = Agent::find($id);
        $sites = Site::all();
        $foreigns = Motif_consultation::all();
        return view($this->templatePath.'.reception', ['titre' => "Réception de Justificatif", 'agent' => $agents, 'sites' => $sites, 'foreigns'=>$foreigns, 'link' => $this->link]);
    }


    public function store(Request $request)
    {

        $userId = Auth::id();

      //  $projet = Agent::where('agent_id', '=', $_POST['agent_id'])->get();
        //dd($projet);

        $agent = Agent::find($_POST['agent_id']);
      // dd($_POST);

      if($_POST['assurance'] = ''){
        $assurance = '000000';
      }else{
        $assurance =  $_POST['assurance'];
      }

    // echo('<pre>'); die(print_r($_POST));
   //   dd($_POST);

        $consultation = Consultation::create([
            "agent_id" => $_POST['agent_id'],
            "poids" => $_POST['poids'],
            "poul" => $_POST['poul'],
            "temperature" => $_POST['temperature'],
            "tension" => $_POST['tension'],
            "assurance" => $_POST['assurance'],
            "accident" => $_POST['accident'],
            "traitement" => $_POST['traitement'],
            "arretMaladie" => $_POST['arretMaladie'],
            "duree_arret" => $_POST['duree_arret'],
            "nbrJour" => $_POST['nbrJour'],
            "debutArret" => $_POST['debutArret'],
            "dateReprise" => $_POST['dateReprise'],
            "billetSortie" => $_POST['billetSortie'],
            "repriseService" => $_POST['repriseService'],
            "maladie_contagieuse" => $_POST['maladie_contagieuse'],
            "maladie_prof" => $_POST['maladie_prof'],
            "vaccin_covid" => $_POST['vaccin_covid'],
            "testCovid" => $_POST['testCovid'],
            "doseVaccinCovid" => $_POST['doseVaccinCovid'],
            "observation" => $_POST['observation'],
            "motif_consultation_id" => $_POST['motif_consultation_id'],
            "user_id" => $userId,
            "natureDuree" => $_POST['nbrJour'],
            "dateConsultation" => date('Y-m-d'),
            "typeConsultation" => 'Interne',
            "etatValidite" => 'valide',
            "natureReception" => $_POST['natureReception'],
            'nomMedecin' => '-',
            'designationCentreExterne' => '-',
            'justificatifValide' => '-',
            'motifRejet' => 'Aucun',
            'projet' => $agent->projet_id,
             'assurance' => $assurance,
             'repos' => $_POST['repos']

        ]);



         if(isset($_POST['typeMedicament']) AND !empty($_POST['typeMedicament'])){
            $nbreProduit = sizeof($_POST['typeMedicament']);

            for ($i=0; $i < $nbreProduit; $i++) {
                Ordonnance::create([
                    'typeMedicament' => $_POST['typeMedicament'][$i],
                    'natureMedicament' => $_POST['natureMedicament'][$i],
                    'qte' => $_POST['qte'][$i],
                    'joursTraitement' => $_POST['joursTraitement'][$i],
                    'consultation_id' => $consultation->id
                ]);
            }

        }


          //les variables
          $agent = Agent::find($_POST['agent_id']);
          $consultation = Consultation::find($consultation->id);
          $projet = $agent->Projet->designation;
          $charge_flux = Agent::where('emploi_id', '=', '9' )->where('projet_id', '=', $agent->projet_id)->get();

          if ($consultation->arretMaladie == 'oui'){


              //les chargés de flux
              foreach ($charge_flux as $cf){
                  Mail::to($cf['email_agent'])->send(new Justificatif_externe( $agent, $consultation, $projet, $charge_flux));
                                  }
              //les superviseurs
              Mail::to($projet->dltsuperviseur)->send(new Justificatif_externe( $agent, $consultation, $projet, $charge_flux ));

              //le collaborateur concerné
              Mail::to($agent->email_agent)->send(new Justificatif_externe( $agent, $consultation, $projet, $charge_flux ));

              // les ressources humaines
              Mail::to('dlt-ci-abj1-rh-cote-divoire@ci.webhelp.com')->send(new Justificatif_externe( $agent, $consultation, $projet, $charge_flux ));

              return redirect()->route('consultation.index')->with('success','Justificatif enregistré avec succès. Email envoyé aux supervviseurs');;


          }else if ($consultation->arretMaladie == 'non'){



              //les superviseurs
              Mail::to($projet->dltsuperviseur)->send(new Justificatif_externe( $agent, $consultation, $projet, $charge_flux ));

              //le collaborateur concerné
              Mail::to($agent->email_agent)->send(new Justificatif_externe( $agent, $consultation, $projet, $charge_flux ));


          }else if ($consultation->arretMaladie == 'repos'){


              //les chargés de flux
              foreach ($charge_flux as $cf){
                  Mail::to($cf['email_agent'])->send(new Justificatif_externe( $agent, $consultation, $projet, $charge_flux));
                                  }
              //les superviseurs
              Mail::to($projet->dltsuperviseur)->send(new Justificatif_externe( $agent, $consultation, $projet, $charge_flux ));

              //le collaborateur concerné
              Mail::to($agent->email_agent)->send(new Justificatif_externe( $agent, $consultation, $projet, $charge_flux ));

              return redirect()->route('consultation.index')->with('success','Justificatif enregistré avec succès. Email envoyé aux supervviseurs');;



          }else if ($consultation->justificatifValide == 'en attente'){

               //les chargés de flux
              foreach ($charge_flux as $cf){
                  Mail::to($cf['email_agent'])->send(new Justificatif_externe( $agent, $consultation, $projet, $charge_flux));
                                  }
              //les superviseurs
              Mail::to($projet->dltsuperviseur)->send(new Justificatif_externe( $agent, $consultation, $projet, $charge_flux ));

              //le collaborateur concerné
              Mail::to($agent->email_agent)->send(new Justificatif_externe( $agent, $consultation, $projet, $charge_flux ));

              return redirect()->route('consultation.index')->with('success','Justificatif enregistré avec succès. Email envoyé aux supervviseurs');;

          }

    }



}
