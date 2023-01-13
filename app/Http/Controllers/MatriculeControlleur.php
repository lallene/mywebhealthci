<?php

namespace App\Http\Controllers;

use App\Imports\MatriculeImport;
use App\Models\Agent;
use App\Models\Matricule;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MatriculeControlleur extends Controller
{
    private $templatePath = 'configuration.matricule';
    private $link = 'matricule';

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:RH Manager');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $matricules = Matricule::with(['Agent'])->paginate(100);
        return view($this->templatePath.'.liste', ['titre' => "Liste des matricule", 'matricules' => $matricules, 'link' => $this->link]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $foreigns = Agent::all();
        return view($this->templatePath.'.create', ['titre' => "Ajouter un Matricule", 'link' => $this->link, 'foreigns' => $foreigns]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Matricule::create(
            [
                'matricule' => $request->input('matricule'),
                'agent_id' => $request->input('agent_id')
            ]
        );

        return redirect()->route('matricule.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Matricule  $matricule
     * @return \Illuminate\Http\Response
     */
    public function show(Matricule $matricule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Matricule  $matricule
     * @return \Illuminate\Http\Response
     */
    public function edit(Matricule $matricule)
    {
        $item = $matricule;
        $foreigns = Matricule::all();

        return view($this->templatePath.'.edit', ['titre' => "Modifier Matricule".$item->designation, 'item' => $item, 'link' => $this->link, 'foreigns' => $foreigns]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Matricule  $matricule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Matricule::find($id);

        $item->designation = $request->input('designation');
        $item->site_id = $request->input('site_id');

        try{
            $item->save();
        }catch (\Exception $e){
            echo'e';
        }
        return redirect()->route('matricule.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Matricule  $matricule
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Matricule::find($id);

        $item->delete();

        return redirect()->route('matricule.index')
            ->with('success', "Matricule Supprimé avec succes");
    }

    public function import (Request $req){

        Excel::import(new MatriculeImport, $req->file('matricule_file'),

     );

         return back();
     }
}
