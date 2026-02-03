<?php

namespace App\Http\Controllers;


use App\Models\Site;
use App\Models\Agent;
use App\Models\Matricule;
use App\Models\Consultation;
use App\Models\Justificatif;
use Illuminate\Http\Request;
use App\Mail\Justificatif_externe;
use App\Models\Motif_consultation;
use App\Models\Projet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;


class JustificatifController extends Controller
{
    private $templatePath = 'configuration.justificatif_externe';
    private $link = 'jutificatif_externe';

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Corps médical');

    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

     //   $consultations= Consultation::all();
      //  $agents= Agent::all();
        $items = Consultation::with('Agent')->paginate(500);
               $motifs = Motif_consultation::all();

        //$agents= Agent::all();
        //dd($items);
        return view($this->templatePath.'.liste', ['titre' => "Justificatif d'arret maladie externe", 'items' => $items, 'link' => $this->link]);
    }

    public function reception ($id){

        $agents = Agent::find($id);
        
        $motifs = Motif_consultation::all();

        $siteselected = Projet::where('id','=',  $agents->projet_id)->first();
        $sites = Site::all();
        $foreigns = Motif_consultation::all();
        
        $historiquesagents = DB::table('consultations')
        ->join('users', 'consultations.user_id', '=', 'users.id')  // Joindre la table 'users' pour obtenir les informations du médecin
        ->leftJoin('consultation_motif_consultation', 'consultations.id', '=', 'consultation_motif_consultation.consultation_id')  // Jointure avec la table pivot
        ->leftJoin('motif_consultations', 'consultation_motif_consultation.motif_consultation_id', '=', 'motif_consultations.id')  // Jointure avec les motifs de consultation
        ->leftJoin('transaction_medicaments', 'consultations.id', '=', 'transaction_medicaments.consultation_id')  // Jointure avec les médicaments
        ->leftJoin('stocks', 'transaction_medicaments.stock_id', '=', 'stocks.id')  // Jointure avec les stocks
        ->leftJoin('medications', 'transaction_medicaments.medication_id', '=', 'medications.id')  // Jointure avec les médicaments via 'medication_id'
        ->where('consultations.agent_id', '=', $agents->id)  // Filtrer par l'agent
        ->where('consultations.typeConsultation', '=', 'Externe')
        ->select(
            'consultations.id as consultation_id',
            'consultations.created_at',
            'consultations.debutArret',
            'consultations.duree_arret',
            'consultations.typeArrêt',
            'consultations.nomMedecin',
            'consultations.designationCentreExterne',
            'consultations.motifRejet',
            'consultations.observation',
            'users.name as medecin',
            'motif_consultations.intitule as motif_consultation',  // Le motif de la consultation
        )
        ->get();
            // Regroupement des consultations par consultation_id
            $historiquesagents = $historiquesagents->groupBy('consultation_id')->map(function ($consultations) {
                // Récupération des informations pour chaque consultation
                $firstConsultation = $consultations->first(); // On prend la première consultation du groupe
    
              
    
                return [
                    'consultation_id' => $firstConsultation->consultation_id,
                    'created_at' => $firstConsultation->created_at,
                    'typeArrêt' => $firstConsultation->typeArrêt,
                    'debutArret' => $firstConsultation->debutArret,
                    'duree_arret' => $firstConsultation->duree_arret,
                    'medecinCNX' => $firstConsultation->medecin,
                    'nomMedecin' => $firstConsultation->nomMedecin,
                    'hopital' => $firstConsultation->designationCentreExterne,
                    'observation'=>$firstConsultation->observation,
                    'motif_consultation' => $firstConsultation->motif_consultation ?: 'Aucun motif', // Vérification du motif
                   
                ];
            });

        return view($this->templatePath.'.reception', ['titre' => "Réception de Justificatif", 'agent' => $agents, 'sites' => $sites, 'foreigns'=>$foreigns, 'link' => $this->link, 'siteselected' =>$siteselected, 'motifs'=>$motifs, 'historiquesagents'=>$historiquesagents]);
    }

 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store (Request $request){


        $userId = Auth::id();
        $agent = Agent::find($_POST['agent_id']);
        $_POST['projet_id'] = $agent->projet_id;

        if ($_POST['duree_arret'] <> 0){ $duree = $_POST['duree_arret'] * 60 ;}else {
            $duree = $_POST['duree_arret'];
        }

       // preg_match('/\d+/', $agent->responsable, $matches);
       // $email_responsable = Agent::where('Matricule_salarie', $matches[0])->first();

       //dd($duree, $request);
        $email_responsable = "example@.com";
        $_POST['nbrJour'] ='Heure';


        $consultation = Consultation::create([
            "agent_id" => $_POST['agent_id'],
            "duree_arret" => $duree,
            "nbrJour" => $_POST['nbrJour'],
            "natureDuree" => $_POST['nbrJour'],
            "dateConsultation" => $_POST['dateConsultation'],
            "typeConsultation" => 'Externe',
            "siteConsultation" => $_POST['natureReception'],
            'debutArret' => $request->filled('debutArret') ? $request->input('debutArret') : null,
            "dateReprise" => $_POST['dateReprise'],
            "maladie_contagieuse" => $_POST['maladie_contagieuse'],
            "observation" => $_POST['observation'],
            "motif_consultation_id" => $_POST['motif_consultation_id'],
            "user_id" => $userId,
            'nomMedecin' => $_POST['nomMedecin'],
            'designationCentreExterne' => $_POST['designationCentreExterne'],
            'typeArrêt' =>$_POST['justificatifValide'],
            'motifRejet' => $_POST['motifRejet'],
            'projet_id' => $_POST['projet_id'],
            'AutreMotif' =>  $_POST['motif_consultation_autre'],
        ]);


        //les variables
        $agent = Agent::find($_POST['agent_id']);
        $consultation = Consultation::find($consultation->id);
        $projet = $agent->Projet->designation;
        $charge_flux = Agent::where('sousfonction_id', '=', '49' )->where('projet_id', '=', $agent->projet_id)->get();

        
        // Sélection de l'adresse e-mail avec priorité sur l'adresse de travail
  
     // return redirect()->route('newconsultation')->with('success','Justificatif enregistré avec succès. Email envoyé ');


        // dd($consultation);
        if ($consultation->typeArrêt =='oui'){


            //les chargés de flux
            foreach ($charge_flux as $cf){
                Mail::to($cf['work_email'])->send(new Justificatif_externe( $agent, $consultation, $projet, $charge_flux));
                                }
                 //les N+1
                 if ($email_responsable){
                    Mail::to($agent->Projet->dltsuperviseur)->send(new Justificatif_externe( $agent, $consultation, $projet, $charge_flux ));
                }
            //les superviseurs
            Mail::to($agent->Projet->dltsuperviseur)->send(new Justificatif_externe( $agent, $consultation, $projet, $charge_flux ));

          // Sélection de l'adresse e-mail avec priorité sur l'adresse de travail
            $email = $agent->work_email ?? $agent->work_email;

            if ($email) {
                // Envoi de l'e-mail au collaborateur concerné
                Mail::to($email)->send(new Justificatif_externe($agent, $consultation, $projet, $charge_flux));
            } else {
                // Gérer le cas où aucune adresse e-mail n'est disponible
                Log::warning('Aucune adresse e-mail disponible pour l\'agent : ' . $agent->id);
            }
     //les N+1
     if ($email_responsable){
        Mail::to($agent->Projet->dltsuperviseur)->send(new Justificatif_externe( $agent, $consultation, $projet, $charge_flux ));
    }

            // les ressources humaines
            Mail::to('wh_dlt-ci-hr-business-partner@concentrix.com')->send(new Justificatif_externe( $agent, $consultation, $projet, $charge_flux ));

            return redirect()->route('newconsultation')->with('success','Justificatif enregistré avec succès. Email envoyé ');


        }else if ( $consultation->typeArrêt =='non'){


            //les superviseurs
            Mail::to($agent->Projet->dltsuperviseur)->send(new Justificatif_externe( $agent, $consultation, $projet, $charge_flux ));

            $email = $agent->work_email ?? $agent->work_email;

                 //les N+1
                 if ($email_responsable){
                    Mail::to($agent->Projet->dltsuperviseur)->send(new Justificatif_externe( $agent, $consultation, $projet, $charge_flux ));
                }

            if ($email) {
                // Envoi de l'e-mail au collaborateur concerné
                Mail::to($email)->send(new Justificatif_externe($agent, $consultation, $projet, $charge_flux));
            } else {
                // Gérer le cas où aucune adresse e-mail n'est disponible
                Log::warning('Aucune adresse e-mail disponible pour l\'agent : ' . $agent->id);
            }

             // les ressources humaines
             Mail::to('wh_dlt-ci-hr-business-partner@concentrix.com')->send(new Justificatif_externe( $agent, $consultation, $projet, $charge_flux ));



        }else if ($consultation->typeArrêt == 'en attente'){


            //les chargés de flux
            foreach ($charge_flux as $cf){
            Mail::to($cf['work_email'])->send(new Justificatif_externe( $agent, $consultation, $projet, $charge_flux));
                                }
            //les superviseurs
            Mail::to($agent->Projet->dltsuperviseur)->send(new Justificatif_externe( $agent, $consultation, $projet, $charge_flux ));

            $email = $agent->work_email ?? $agent->work_email;

            if ($email) {
                // Envoi de l'e-mail au collaborateur concerné
                Mail::to($email)->send(new Justificatif_externe($agent, $consultation, $projet, $charge_flux));
            } else {
                // Gérer le cas où aucune adresse e-mail n'est disponible
                Log::warning('Aucune adresse e-mail disponible pour l\'agent : ' . $agent->id);
            }

            // les ressources humaines
            Mail::to('wh_dlt-ci-hr-business-partner@concentrix.com')->send(new Justificatif_externe( $agent, $consultation, $projet, $charge_flux ));


            return redirect()->route('newconsultation')->with('success','Justificatif enregistré avec succès. Email envoyé ');

        }



    }



    public function edit($id)
    {
        $consultation = Consultation::find($id);
        $agent = Agent::find($id);
        $motifs = Motif_consultation::all();
        $sites = Site::all();
        $matricule = Matricule::where('agent_id', '=', $id)->first();

        return view($this->templatePath.'.edit', [
            'titre' => "Modifier la consultation du collaborateur ".$consultation->nom.' '.$consultation->prenom,
            'consultation' => $consultation,
            'agent'=> $agent,
            'motifs'=> $motifs,
            'sites'=> $sites,
            'matricule'=> $matricule,
            'link' => $this->link,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Consultation::find($id);
        $userId = Auth::id();

        $item->arretMaladie = $request->input('natureReception');
        $item->observation = $request->input('motif_consultation_id');
        $item->motif_consultation_id = $request->input('justificatifValide');
        $item->motif_consultation_id = $request->input('motifRejet');
        $item->motif_consultation_id = $request->input('nomMedecin');
        $item->motif_consultation_id = $request->input('observation');
        $item->user_id = $userId;
        $item->natureReception = $request->input('designationCentreExterne');

        try{
            $item->save();
        }catch (\Exception $e){
            echo'e';
        }

        $agent = Agent::find($_POST['agent_id']);
        $consultation = Consultation::find($item->id);
        $projet = $agent->Projet->designation;


        if ($consultation->typeArrêt == 'oui' ){
            // dd('test');
              Mail::to($agent->work_email)
              ->cc($projet->dltsuperviseur)
              ->cc('wh_dlt-ci-hr-business-partner@concentrix.com')
              ->send(new Justificatif_externe( $agent, $consultation));
        return redirect()->route('newconsultation')->with('success','Justificatif externe enregistrée avec succès. Email envoyé');
       } else if ($consultation->typeArrêt == 'non'){
                Mail::to($agent->work_email)
                ->cc($projet->dltsuperviseur)
                ->send(new Justificatif_externe( $agent, $consultation));
                return redirect()->route('newconsultation')->with('success','Justificatif externe enregistrée avec succès. Email envoyé');
    }

        return redirect()->route('newconsultation')->with('success','Justificatif enregistré avec succès. Email envoyé aux supervviseurs');
    }

}
