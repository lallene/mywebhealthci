<?php

namespace App\Http\Controllers;

use App\Models\Agent_sante;
use App\Models\Site;
use Illuminate\Http\Request;

class Agent_santeController extends Controller
{
    private $templatePath = 'configuration.agent_sante';
    private $link = 'agent_sante';

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
        $items = Agent_sante::all();
        return view($this->templatePath.'.liste', ['titre' => "Liste des agents", 'items' => $items, 'link' => $this->link]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $foreigns = Site::all();
        return view($this->templatePath.'.create', ['titre' => "Ajouter un agent de santé", 'link' => $this->link, 'foreigns' => $foreigns]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Agent_sante::create(
            [
                'nom' => $request->input('nom'),
                'prenom' => $request->input('prenom'),
                'email' => $request->input('email'),
                'contact' => $request->input('contact'),
                'site_id' => $request->input('site_id')
            ]
        );

        return redirect()->route('agent_sante.index');
    }

      /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\agent_sante  $agent_sante
     * @return \Illuminate\Http\Response
     */
    public function edit(Agent_sante $agent_sante)
    {
        $item = $agent_sante;
        $foreigns = Site::all();

        return view($this->templatePath.'.edit', ['titre' => "Modifier ".$item->nom, 'item' => $item, 'link' => $this->link, 'foreigns' => $foreigns]);
    }

      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\agent_sante  $emploi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Agent_sante::find($id);

        $item->nom = $request->input('nom');
        $item->prenom = $request->input('prenom');
        $item->email = $request->input('email');
        $item->contact = $request->input('contact');
        $item->site_id = $request->input('site_id');

        try{
            $item->save();
        }catch (\Exception $e){
            echo'e';
        }
        return redirect()->route('agent_sante.index');
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\agent_sante  $sub_fonction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Agent_sante::find($id);

        $item->delete();

        return redirect()->route('agent_sante.index')
            ->with('success', "Emploi Supprimé avec succes");
    }

}
