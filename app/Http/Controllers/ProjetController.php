<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Projet;
use Illuminate\Http\Request;
use App\Imports\ProjetsImport;
use Maatwebsite\Excel\Facades\Excel;

class ProjetController extends Controller
{
    private $templatePath = 'configuration.projet';
    private $link = 'projet';

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Ressources Humaines');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $projets = Projet::with(['Site'])->paginate(100);
        return view($this->templatePath.'.liste', ['titre' => "Liste des Projets/Services", 'projets' => $projets, 'link' => $this->link]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $foreigns = Site::all();
        return view($this->templatePath.'.create', ['titre' => "Ajouter un Projet/Service", 'link' => $this->link, 'foreigns' => $foreigns]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Projet::create(
            [
                'designation' => $request->input('designation'),
                'site_id' => $request->input('site_id'),
                'dltsuperviseur' => $request->input('dltsuperviseur')
            ]
        );

        return redirect()->route('projet.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function show(Projet $projet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function edit(Projet $projet)
    {
        $item = $projet;
        $foreigns = Site::all();

        return view($this->templatePath.'.edit', ['titre' => "Modifier Projet".$item->designation, 'item' => $item, 'link' => $this->link, 'foreigns' => $foreigns]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Projet::find($id);

        $item->designation = $request->input('designation');
        $item->site_id = $request->input('site_id');
        $item->dltsuperviseur = $request->input('dltsuperviseur');


        try{
            $item->save();
        }catch (\Exception $e){
            echo'e';
        }
        return redirect()->route('projet.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Projet::find($id);

        $item->delete();

        return redirect()->route('projet.index')
            ->with('success', "Projet Supprimé avec succes");
    }

    public function import (Request $req){

        Excel::import(new ProjetsImport, $req->file('projet_file'),

     );

         return back();
     }
}
