<?php

namespace App\Http\Controllers;


use App\Mail\Justificatif_externe;
use App\Models\Agent;
use App\Models\Consultation;
use App\Models\Justificatif;
use Illuminate\Http\Request;
use App\Models\Motif_consultation;
use App\Models\Site;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class JustificatifController extends Controller
{
    private $templatePath = 'configuration.justificatif_externe';
    private $link = 'jutificatif_externe';

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Agent de santé');

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
        //$agents= Agent::all();
        //dd($items);
        return view($this->templatePath.'.liste', ['titre' => "Justificatif d'arret maladie externe", 'items' => $items, 'link' => $this->link]);
    }

    public function reception ($id){
        $agents = Agent::find($id);
        $sites = Site::all();
        $foreigns = Motif_consultation::all();
        return view($this->templatePath.'.reception', ['titre' => "Reception de Justificatif", 'agent' => $agents, 'sites' => $sites, 'foreigns'=>$foreigns, 'link' => $this->link]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $foreigns = Justificatif::all();
        return view($this->templatePath.'.create', ['titre' => "Ajouter une sous fonction", 'link' => $this->link, 'foreigns' => $foreigns]);
    }
 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store (Request $request){


        $userId = Auth::id();

        $etatValidite = 'valide';

        $motifRejet = null;

        if($_POST['justificatifValide'] != 'oui'){
            $etatValidite = 'non';
        }

        if($_POST['justificatifValide'] != 'oui'){
            $motifRejet = $_POST['motifRejet'];
        }

        $agent = Agent::find($_POST['agent_id']);

        $consultation = Consultation::create([
            "agent_id" => $_POST['agent_id'],
            "poids" => '-',
            "poul" => '-',
            "temperature" => '-',
            "tension" => '-',
            "accident" => 'non',
            "traitement" => 'non',
            "arretMaladie" => 'oui',
            "duree_arret" => $_POST['duree_arret'],
            "nbrJour" => $_POST['nbrJour'],
            "natureDuree" => $_POST['nbrJour'],
            "dateConsultation" => $_POST['dateConsultation'],
            "typeConsultation" => 'Externe',
            "etatValidite" => $etatValidite,
            "natureReception" => $_POST['natureReception'],
            "debutArret" => $_POST['debutArret'],
            "dateReprise" => $_POST['dateReprise'],
            "billetSortie" => $_POST['billet_sortie'],
            "repriseService" => $_POST['repriseService'],
            "maladie_contagieuse" => $_POST['maladie_contagieuse'],
            "maladie_prof" => 'non',
            "vaccin_covid" => '-',
            "testCovid" => '-',
            "doseVaccinCovid" => 0,
            "observation" => $_POST['observation'],
            "motif_consultation_id" => $_POST['motif_consultation_id'],
            "user_id" => $userId,
            'nomMedecin' => $request->input('nomMedecin'),
            'designationCentreExterne' => $request->input('designationCentreExterne'),
            'justificatifValide' => $etatValidite,
            'motifRejet' => $motifRejet,
            'duplicat_suite_valide' => $request->input('duplicat_suite_valide'),
            'projet_id' => $agent->projet_id
        ]);

        $agent = Agent::find($_POST['agent_id']);
        $hrpbs =   Agent::where('emploi_id', '=', '36')->get();
        $justificatif = Justificatif::find( $consultation->id);
        $consultation = Consultation::find($consultation->id);
        $sup = $agent->manager;
        $emailsup = Agent::where('manager', '=', $sup)->get();

    //  dd($days );
      Mail::to('setushi.lawson@webhelp.com')->send(new Justificatif_externe($hrpbs, $agent, $consultation, $justificatif ));

      return redirect()->route('consultation.index');

      foreach ($hrpbs as $hrpb){
            Mail::to($hrpb['email_agent'])->send(new Justificatif_externe($hrpbs, $agent, $consultation, $justificatif));
                               }
      $sup = $agent->manager;
      $emailsup = Agent::where('manager', '=', $sup);
      dd($emailsup);

      return redirect()->route('consultation.index');

    }


}
