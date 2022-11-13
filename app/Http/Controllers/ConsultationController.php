<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Consultation;
use App\Models\Motif_consultation;
use App\Models\Ordonnance;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view($this->templatePath.'.search', ['titre' => "Recherche de l'agent", 'items' => $items, 'link' => $this->link]);
    }

    public function consulter($id){
        $agent = Agent::find($id);
        $motifs = Motif_consultation::all();
        $sites = Site::all();
        return view($this->templatePath.'.liste', ['titre' => "Recherche de l'agent", 'agent' => $agent, 'motifs' => $motifs, 'sites' => $sites, 'link' => $this->link]);
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        //echo('<pre>'); die(print_r($_POST));

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


        return redirect()->route('home');


    }
}
