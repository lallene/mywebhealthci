<?php

namespace App\Http\Controllers;

use App\Imports\AgentsImport;
use App\Models\Agent;
use App\Models\Contrat;
use App\Models\Emploi;
use App\Models\Projet;
use App\Models\Societe;
use App\Models\Sub_fonction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
use App\Mail\Insertion_massive;
use Illuminate\Support\Facades\Mail;

class AgentController extends Controller
{
    private $templatePath = 'configuration.effectif';
    private $link = 'effectif';

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Ressources Humaines|Corps médical');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $query = Agent::query();

       // dd($query);


        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('Matricule_salarie', 'like', "%{$search}%")
                  ->orWhereRaw("CONCAT(nom, ' ', prenom) LIKE ?", ["%{$search}%"])
                  ->orWhere('email_agent', 'like', "%{$search}%")
                  ->orWhere('work_email', 'like', "%{$search}%");
            });
        }

        $query->with(['projet', 'manager', 'sousfonction', 'societe', 'responsableDetail'])
               ->whereNotNull('Matricule_salarie');


        // Définir le nombre d'agents à charger au démarrage
        $perPage = 10;
        $agents = $query->paginate($perPage);

        return response()->json($agents);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projets = Projet::all();
        $emplois = Emploi::all();
        $sousfonctions = Sub_fonction::all();
        $contrat = Contrat::all();
        $societe = Societe::all();
        $managers = Agent::all();
        return view($this->templatePath.'.create', [
            'titre' => "Ajouter un Agent",
            'link' => $this->link,
            'projets' => $projets,
            'emplois' => $emplois,
            'sousfonctions' => $sousfonctions,
            'contrats' => $contrat,
            'societes' => $societe,
            'managers' => $managers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Agent::create(
            [
                'iris' => $request->input('iris'),
                'entite' => $request->input('entite'),
                'societe_id' => $request->input('societe_id'),
                'sexe' => $request->input('sexe'),
                'nom' => $request->input('nom'),
                'prenom' => $request->input('prenom'),
                'dateembauche' => $request->input('dateembauche'),
                'projet_id' => $request->input('projet_id'),
                'manager' => $request->input('manager'),
                'emploi_id' => $request->input('emploi_id'),
                'sousfonction_id' => $request->input('sousfonction_id'),
                'contrat_id' => $request->input('contrat_id')
            ]
        );

        return redirect()->route('effectif.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Agent::find($id);
        $projets = Projet::all();
        $emplois = Emploi::all();
        $sousfonctions = Sub_fonction::all();
        $contrat = Contrat::all();
        $societe = Societe::all();
        $managers = Agent::all();

        return view($this->templatePath.'.edit', [
            'titre' => "Modifier Collaborateur ".$item->nom.' '.$item->prenom,
            'item' => $item,
            'link' => $this->link,
            'projets' => $projets,
            'emplois' => $emplois,
            'sousfonctions' => $sousfonctions,
            'contrats' => $contrat,
            'societes' => $societe,
            'managers' => $managers
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
        $item = Agent::find($id);

        $item->entite = $request->input('entite');
        $item->societe_id = $request->input('societe_id');
        $item->sexe = $request->input('sexe');
        $item->nom = $request->input('nom');
        $item->prenom = $request->input('prenom');
        $item->dateembauche = $request->input('dateembauche');
        $item->projet_id = $request->input('projet_id');
        $item->manager = $request->input('manager');
        $item->emploi_id = $request->input('emploi_id');
        $item->sousfonction_id = $request->input('sousfonction_id');
        $item->contrat_id = $request->input('contrat_id');

        try{
            $item->save();
        }catch (\Exception $e){
            echo'e';
        }
        return redirect()->route('effectif.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Agent::find($id);

        $item->delete();

        return redirect()->route('effectif.index')
            ->with('success', "Collaborateur retiré avec succes");
    }

    public function getAgentByIris(Request $request){
        $iris = $request->input('id');
        $agent = Agent::where('iris', '=', $iris)->get();

        $array = array();

        //echo'<pre>'; die(print_r($agent));

        foreach ($agent as $i) {
            $item = Agent::find($i->id);
            $array['Id'] = $item->id;
            $array['Nom'] = $item->nom;
            $array['Prenom'] = $item->prenom;
            $array['Sexe'] = ($item->sexe == 'M') ? 'Masculin' : 'Feminin';
            //$array['Prenom'] = $item->prenom;
            $array['DateEmbauche'] = $item->dateembauche;
            $array['Projet'] = $item->Projet->designation;
            $array['Fonction'] = $item->SousFonction->Fonction->intitule;
            $array['Emploi'] = $item->Emploi->designation;
        }

        return json_encode($array);
    }

    public function import (Request $req){

       Excel::import(new AgentsImport, $req->file('agent_file'),);

        $datenow = Carbon::now();
        $datenow=   $datenow->format('Y/m/d');
        $dateInsertion=   Carbon::now()->format('d/m/Y');
        $agentsInsert = DB::table('agents')->whereDate('DateInsertion', $datenow)
                        ->get();
        $nbreCollaborateur =  sizeof($agentsInsert);

        Mail::to('lallene.achi@concentrix.com')
            ->send(new Insertion_massive($nbreCollaborateur, $dateInsertion));

    return redirect()->route('effectifs')->with('success','Les '. $nbreCollaborateur . ' collaborateurs ont bien été enregistrés.');
    }

    public function agents()
{
    $agents = DB::table('agents')
    ->select ('id', 'nom', 'prenom', 'iris', 'Matricule_salarie', 'work_email', 'email_agent')->get();
    return response()->json($agents);
}
public function liste()
{
    // Obtenir la date actuelle au format 'Y/m/d'
    $datenow = Carbon::now()->format('Y/m/d');

    $agents = DB::table('agents')
        ->join('projets', 'agents.projet_id', '=', 'projets.id')
        ->join('contrats', 'agents.contrat_id', '=', 'contrats.id')
        ->leftJoin('agents as responsables', 'agents.responsable', '=', 'responsables.Matricule_salarie')

        ->whereNotNull('agents.Matricule_salarie')
        ->select(
            'agents.id as id',
            'projets.site_id as site',
            'agents.Matricule_salarie',
            'agents.nom',
            'agents.prenom',
            'agents.work_email',
            'projets.designation as projet',
            'contrats.designation as contrat',
            'agents.responsable',
            'responsables.nom as responsable_nom',
            'responsables.prenom as responsable_prenom'
        )
        ->orderBy('agents.dateInsertion', 'desc')
        ->paginate(7000);

        //dd($agents);

    return view($this->templatePath.'.liste', [
        'titre' => "Liste des collaborateurs",
        'agents' => $agents,
        'link' => $this->link
    ]);
}


}
