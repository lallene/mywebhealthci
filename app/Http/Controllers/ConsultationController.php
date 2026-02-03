<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Agent;
use App\Models\Matricule;
use App\Models\Stock;
use App\Models\TransactionMedicament;
use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Mail\Justificatif_externe;
use App\Models\Motif_consultation;
use App\Http\Controllers\Controller;
use App\Mail\rapport_cf;
use App\Models\MedicamentStock;
use App\Models\Projet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
        // Récupérer les consultations
        $items = Consultation::all();

        // Retourner la vue comme une réponse
        return response()->view($this->templatePath.'.newsearch', [
            'titre' => "Rechercher un collaborateur ",
            'items' => $items,
            'link' => $this->link
        ]);
    }


    public function consulter($id){
      //  dd($id);
       $agent = Agent::find($id);
       $motifs = Motif_consultation::all();
       $sites = Site::all();
       $matricule = Matricule::where('agent_id', '=', $id)->first();
       $arrets =  DB::table('consultations')
       ->where('agent_id', '=', $id)
       ->join('users', 'consultations.user_id', '=', 'users.id')
       ->where('typeArrêt', '!=', 'non')->get();






   //dd($agent->id );



     $historiquesagents = DB::table('consultations')
     ->join('users', 'consultations.user_id', '=', 'users.id')  // Joindre la table 'users' pour obtenir les informations du médecin
     ->leftJoin('consultation_motif_consultation', 'consultations.id', '=', 'consultation_motif_consultation.consultation_id')  // Jointure avec la table pivot
     ->leftJoin('motif_consultations', 'consultation_motif_consultation.motif_consultation_id', '=', 'motif_consultations.id')  // Jointure avec les motifs de consultation
     ->leftJoin('transaction_medicaments', 'consultations.id', '=', 'transaction_medicaments.consultation_id')  // Jointure avec les médicaments
     ->leftJoin('stocks', 'transaction_medicaments.stock_id', '=', 'stocks.id')  // Jointure avec les stocks
     ->leftJoin('medications', 'transaction_medicaments.medication_id', '=', 'medications.id')  // Jointure avec les médicaments via 'medication_id'
     ->where('consultations.agent_id', '=', $agent->id)  // Filtrer par l'agent
     ->select(
         'consultations.id as consultation_id',
         'consultations.created_at',
         'consultations.typeArrêt',
         'consultations.debutArret',
         'consultations.duree_arret',
         'consultations.observation',
         'users.name as medecin',
         'motif_consultations.intitule as motif_consultation',  // Le motif de la consultation
         'transaction_medicaments.medication_id',
         'transaction_medicaments.qte',
         'medications.name as medicament_name'  // Le nom du médicament
     )
     ->get();




            // Regroupement des consultations par consultation_id
        $historiquesagents = $historiquesagents->groupBy('consultation_id')->map(function ($consultations) {
            // Récupération des informations pour chaque consultation
            $firstConsultation = $consultations->first(); // On prend la première consultation du groupe

            // Traitement des médicaments, si présents
            $medicaments = $consultations->map(function ($consultation) {
                return [
                    'medicament_name' => $consultation->medicament_name,
                    'qte' => $consultation->qte
                ];
            })->filter(function ($medicament) {
                return !empty($medicament['medicament_name']); // Exclure les entrées sans médicament
            })->toArray();

            return [
                'consultation_id' => $firstConsultation->consultation_id,
                'created_at' => $firstConsultation->created_at,
                'typeArrêt' => $firstConsultation->typeArrêt,
                'debutArret' => $firstConsultation->debutArret,
                'duree_arret' => $firstConsultation->duree_arret,
                'medecin' => $firstConsultation->medecin,
                'observation'=>$firstConsultation->observation,
                'motif_consultation' => $firstConsultation->motif_consultation ?: 'Aucun motif', // Vérification du motif
                'medicaments' => $medicaments ?: 'Aucun médicament prescrit', // Vérification de la présence des médicaments

            ];
        });



   //dd($historiquesagents);

        return view($this->templatePath.'.consultation', ['titre' => "Consulter", 'sites' => $sites,'motifs' => $motifs, 'matricule'=>$matricule, 'arrets' => $arrets, 'agent' => $agent, 'historiquesagents'=>$historiquesagents,  'link' => $this->link ]);
    }

    private function getReseauFromIP($ip)
    {
        // Exemple de correspondance IP -> Réseau (À adapter selon ton infra)
        $reseaux = [
            '10.225.2.' => 1,
            '10.225.66.' => 3,
            '10.225.34.' => 2,
        ];

        foreach ($reseaux as $prefixe => $reseau) {
            if (strpos($ip, $prefixe) === 0) {
                return $reseau;
            }
        }

        return null; // Réseau inconnu
    }

    public function store(Request $request)
    {


        // Récupérer les médicaments envoyés (en JSON)
        $medicaments = json_decode($request->input('medicaments'), true);
        //  dd($medicaments);

        // Si 'motif_consultation_id' est absent, définir une valeur par défaut
        if (!$request->has('motif_consultation_id')) {
            $request->merge(['motif_consultation_id' => [25]]);
        }

        // Récupérer l'utilisateur authentifié
        $userId = Auth::id();
        $agent = Agent::find($request->input('agent_id'));

        // Fusionner les données
        $request->merge(['user_id' => $userId]);
        $request->merge(['projet_id' => $agent->projet_id]);

        // Calcul de la durée d'arrêt
        $duree = $this->calculerDureeArret($request);

        // Récupérer le site de consultation
        $site = $request->input('siteConsultation');

       // dd($site);

        $request->merge(['siteConsultation' => $site]);
        $request->merge(['duree_arret' => $duree]);



        // Validation des données d'entrée
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'agent_id' => 'required|exists:agents,id',
            'motif_consultation_id' => 'required|array',
            'motif_consultation_id.*' => 'exists:motif_consultations,id',
        ]);

        // Création d'une nouvelle consultation
        $consultation = new Consultation();
        $consultation->agent_id = $request->input('agent_id');
        $consultation->poids = $request->input('poids');
        $consultation->poul = $request->input('poul');
        $consultation->temperature = $request->input('temperature');
        $consultation->tension = $request->input('tension');
        $consultation->accidentPro = $request->input('accident');
        $consultation->soinadministre = $request->input('soinadministre');
        $consultation->maladie_contagieuse = $request->input('maladie_contagieuse');
        $consultation->maladie_prof = $request->input('maladie_prof');
        $consultation->typeArrêt = $request->input('arretMaladie');
        $consultation->duree_arret = $request->input('duree_arret');
        $consultation->debutArret = $request->input('debutArret');
        $consultation->testCovid = $request->input('testCovid');
        $consultation->vaccin_covid = $request->input('vaccin_covid');
        $consultation->doseVaccinCovid = $request->input('doseVaccinCovid');
        $consultation->observation = $request->input('observation');
        $consultation->projet_id = $request->input('projet_id');
        $consultation->siteConsultation = $request->input('siteConsultation');
        $consultation->user_id = $userId;
        $consultation->nbrJour = 'Heure';
        $consultation->motif_consultation_id = 25;
        $consultation->typeConsultation = 'Interne';
        $consultation->dateConsultation = date('Y-m-d');



        $consultation->save();

        // Sauvegarde des motifs de consultation
        $motifConsultationIds = $request->input('motif_consultation_id');
        $consultation->motifs()->sync($motifConsultationIds);

        // Sauvegarde des médicaments envoyés


        if ($medicaments) {
            foreach ($medicaments as $medicament) {
                if (isset($medicament['medicamentId']) && isset($medicament['quantity'])) {
                    $stock_id = MedicamentStock::where('medicament_id', $medicament['medicamentId'])->pluck('id')->first();
                    if ($stock_id) {
                        TransactionMedicament::create([
                            'stock_id' => $stock_id,
                            'qte' => $medicament['quantity'],
                            'consultation_id' => $consultation->id,
                            'medication_id' => $medicament['medicamentId'],
                        ]);
                    } else {
                        return response()->json(['error' => 'Médicament non trouvé dans le stock'], 400);
                    }
                }
            }
        }

        // return redirect()->route('newconsultation')->with('success', 'Justificatif enregistré avec succès. Email envoyé aux superviseurs.');
        // Envoi des mails
        $this->envoyerMails($consultation, $agent);

        return redirect()->route('newconsultation')->with('success', 'Justificatif enregistré avec succès. Email envoyé aux superviseurs.');
    }


    /**
     * Calcul de la durée d'arrêt en fonction des conditions.
     */
    private function calculerDureeArret(Request $request)
    {
        if ($request->input('duree_arret') != 0) {
            return $request->input('duree_arret') * 60;
        } elseif ($request->input('analyseExterne') != 0) {
            return $request->input('analyseExterne') * 60;
        } elseif ($request->input('repos') != 0) {
            return $request->input('repos');
        } else {
            return 0;
        }
    }

    /**
     * Envoi des e-mails à tous les destinataires concernés.
     */
    private function envoyerMails($consultation, $agent)
    {
        $projet = $agent->Projet->designation;
        $charge_flux = Agent::where('sousfonction_id', '=', '49')
                             ->where('projet_id', '=', $agent->projet_id)
                             ->get();



        // Détermine le type d'arrêt et envoie les e-mails en conséquence
        foreach ($charge_flux as $cf) {
            Mail::to($cf['work_email'])->send(new Justificatif_externe($agent, $consultation, $projet, $charge_flux));
        }

        // Envoi des mails pour les superviseurs et responsables
        if ($agent->Projet->dltsuperviseur) {
            Mail::to($agent->Projet->dltsuperviseur)->send(new Justificatif_externe($agent, $consultation, $projet, $charge_flux));
        }

        $email_responsable = $agent->Projet->dltsuperviseur ?? null;
        if ($email_responsable) {
            Mail::to($email_responsable)->send(new Justificatif_externe($agent, $consultation, $projet, $charge_flux));
        }

        $email = $agent->work_email ?? null;
        if ($email) {
            Mail::to($email)->send(new Justificatif_externe($agent, $consultation, $projet, $charge_flux));
        }

        // Mail aux ressources humaines
        Mail::to('wh_dlt-ci-hr-business-partner@concentrix.com')->send(new Justificatif_externe($agent, $consultation, $projet, $charge_flux));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */

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
    public function update()
    {
        $projet = Projet::all();
        $test = null;
        return view($this->templatePath.'.rapport', ['titre' => "Transfert Rapport", 'projet' => $projet, 'test' => $test, 'link' => $this->link ]);


    }


    public function askrapport(){

        $projet = Projet::all();
        $test = null;
        return view($this->templatePath.'.rapport', ['titre' => "Transfert Rapport", 'projet' => $projet, 'test' => $test, 'link' => $this->link ]);
    }



    public function rapport(Request $request)
    {
        $cons = DB::table('consultation')
                                ->whereDate('dateConsultation', '>=', $_GET['datedebut'])
                                ->whereDate('dateConsultation', '<=', $_GET['datedefin'])
                                ->where('projet_id', '=', $_GET['projet'])->get()
                                ->where('typeArrêt', '!=', 'non');

        $charge_flux = Agent::where('emploi_id', '=', '9' )->where('projet_id', '=', $_GET['projet'])->get();
        $datedebutexport =  $_GET['debut'];
        $datefinexport =  $_GET['fin'];
        $projetselected = $_GET['projet'];

       foreach ($charge_flux as $cf){
        Mail::to($cf['work_email'])->send(new rapport_cf ( $charge_flux, $datedebutexport, $datefinexport, $projetselected,  $cons));
                        }
    }

    public function histo(){

        $threeDaysAgo = now()->subDays(7)->toDateString();
        $consultations = Consultation::with('projet')->with('agent')->with('medecin')->whereDate('created_at', '>=', $threeDaysAgo)->get();

        return view($this->templatePath.'.historique', [ 'titre' => "Historisque de consultations",'consultations' => $consultations, 'link' => $this->link]);

    }
    public function destroy($id)
{
    $consultation = Consultation::findOrFail($id);
    $consultation->delete();

    return redirect()->back()->with('success', 'Consultation supprimée avec succès.');
}

}
