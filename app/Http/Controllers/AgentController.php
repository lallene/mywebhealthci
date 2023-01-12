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
use Maatwebsite\Excel\Facades\Excel;

class AgentController extends Controller
{
    private $templatePath = 'configuration.effectif';
    private $link = 'effectif';

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:RH Manager|Agent de santé');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $agents = Agent::with(['Projet','Emploi', 'SousFonction', 'Contrat', 'Societe', 'Manager'])->paginate(3000);

        return view($this->templatePath.'.liste', ['titre' => "Liste des collaborateurs", 'agents' => $agents, 'link' => $this->link]);
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
            'titre' => "Modifier Agent ".$item->nom.' '.$item->prenom,
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
            ->with('success', "Agent retiré avec succes");
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

       Excel::import(new AgentsImport, $req->file('agent_file'),

    );

        return back();
    }

}
