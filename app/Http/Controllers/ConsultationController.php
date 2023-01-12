<?php

namespace App\Http\Controllers;

use App\Mail\Justificatif_externe;
use App\Models\Site;
use App\Models\Agent;
use App\Models\Ordonnance;
use App\Models\Consultation;
use App\Models\Justificatif;
use Illuminate\Http\Request;
use App\Models\Motif_consultation;
use Illuminate\Support\Facades\Auth;
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
        $items = Consultation::all();
        return view($this->templatePath.'.search', ['titre' => "Rechercher un collaborateur ", 'items' => $items, 'link' => $this->link]);
    }

    public function consulter($id){
       $agent = Agent::find($id);

       $motifs = Motif_consultation::all();
       $sites = Site::all();
     //  dd($agent->Contrat->designation);

        return view($this->templatePath.'.consultation', ['titre' => "Rechercher un collaborateur ", 'sites' => $sites,'motifs' => $motifs, 'agent' => $agent, 'link' => $this->link]);
    }

    public function reception ($id){
        $agents = Agent::find($id);
        $sites = Site::all();
        $foreigns = Motif_consultation::all();
        return view($this->templatePath.'.reception', ['titre' => "Reception de Justificatif", 'agent' => $agents, 'sites' => $sites, 'foreigns'=>$foreigns, 'link' => $this->link]);
    }


    public function store(Request $request)
    {

        $userId = Auth::id();

      //  $projet = Agent::where('agent_id', '=', $_POST['agent_id'])->get();
        //dd($projet);

        $agent = Agent::find($_POST['agent_id']);
       // dd($agent->projet_id);



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
            'nomMedecin' => '-',
            'designationCentreExterne' => '-',
            'justificatifValide' => '-',
            'motifRejet' => 'Aucun',
            'duplicat_suite_valide' =>'-',
            'projet' => $agent->projet_id


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


        //dd($consultation->etatValidite);
        $agent = Agent::find($_POST['agent_id']);
        $hrpbs =   Agent::where('emploi_id', '=', '36')->get();;
        $consultation = Consultation::find($consultation->id);
        $nbreJour = $consultation->duree_arret;
        $nbreJour = round($nbreJour/24);
        $dateFin = $consultation->dateReprise;
        $dateFin = date('d-m-Y', strtotime($dateFin. ' - 1 days'));
        dd($dateFin);
        $cfs = Agent::where('emploi_id', '=', '9' )->where('projet_id', '=', $agent->projet_id)->get();

        Mail::to('lachi@webhelp.fr')->send(new Justificatif_externe($cfs, $agent, $consultation, $dateFin, $nbreJour, ));
        dd($agent->email_agent);
        /*charge de flux*/
        $cfs = Agent::where('emploi_id', '=', '9' )->where('projet_id', '=', $agent->projet_id)->get();
        dd($dateFin);
        foreach ($cfs as $cf){
        Mail::to($cf->email_agent)->send(new Justificatif_externe($cf, $agent, $consultation, $dateFin, $nbreJour, ));
        }
         dd($dateFin);
           /*ENVOI AU N=1*/
        $sup = $agent->manager;
        $emailsup = Agent::where('iris', '=', $sup)->get();
        Mail::to($emailsup->email_agent)->send(new Justificatif_externe($hrpbs, $agent, $consultation, $dateFin, $nbreJour, $emailsup));
        dd($emailsup);
         /*ENVOI AUX HRPB*/
         foreach ($hrpbs as $hrpb){
                 Mail::to($hrpb['email_agent'])->send(new Justificatif_externe($hrpbs, $agent, $consultation, $dateFin, $nbreJour));
                                 }
        /*le collaborateur*/
        Mail::to($agent->email_agent)->send(new Justificatif_externe($hrpbs, $agent, $consultation, $dateFin, $nbreJour, $emailsup));

         return redirect()->route('consultation.index');

    }


    public function store1 (Request $request){


        $userId = Auth::id();

        $etatValidite = 'valide';

        $motifRejet = null;

        if($_POST['justificatifValide'] != 'oui'){
            $etatValidite = 'non';
        }

        if($_POST['justificatifValide'] != 'oui'){
            $motifRejet = $_POST['motifRejet'];
        }

        $projet = Agent::where('agent_id', '=', $$_POST['agent_id'])->first();

        $consultation = Consultation::create([
            "agent_id" => $_POST['agent_id'],
            "poids" => '-',
            "poul" => '-',
            "temperature" => '-',
            "tension" => '-',
            "assurance" => $_POST['assurance'],
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
            'projet_id' => $projet->projet_id
        ]);

    }
}
