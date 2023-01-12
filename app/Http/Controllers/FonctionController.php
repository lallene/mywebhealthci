<?php

namespace App\Http\Controllers;

use App\Models\fonction;
use Illuminate\Http\Request;

class FonctionController extends Controller
{
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
        $fonctions = fonction::all();
        return view('configuration.fonction.liste', ['titre' => "Liste des fonctions", 'fonctions' => $fonctions]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('configuration.fonction.create', ['titre' => "Ajouter un fonction"]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        fonction::create(
            [
                'intitule' => $request->input('intitule'),
            ]
        );

        return redirect()->route('fonction.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\fonction  $fonction
     * @return \Illuminate\Http\Response
     */
    public function edit(fonction $fonction)
    {
        return view('configuration.fonction.edit', ['titre' => "Modifier ".$fonction->intitule, 'fonction' => $fonction]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\fonction  $fonction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, fonction $fonction)
    {
        $fonction->intitule = $request->input('intitule');


        try{
            $fonction->save();
        }catch (\Exception $e){
            echo'e';
        }
        return redirect()->route('fonction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy(fonction $fonction)
    {
        $fonction->delete();

        return redirect()->route('fonction.index')
            ->with('success', 'Site Supprimé avec succes');
    }
}
