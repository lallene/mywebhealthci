<?php

namespace App\Http\Controllers;

use App\Models\Maladie_prof;
use Illuminate\Http\Request;

class Maladie_profController extends Controller
{
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
        $maladies = Maladie_prof::all();
        return view('configuration.maladie_prof.liste', ['titre' => "Liste des maladies contagieuses", 'maladies' => $maladies]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('configuration.maladie_prof.create', ['titre' => "Ajouter une maladie professionnelle"]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Maladie_prof::create(
            [
                'intitule' => $request->input('intitule'),
            ]
        );

        return redirect()->route('maladie_prof.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Maladie_contagieuse  $fonction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {
        $maladie = Maladie_prof::find($id);
        return view('configuration.maladie_prof.edit', ['titre' => "Modifier ".$maladie->intitule, 'maladie' => $maladie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\fonction  $fonction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $maladie = Maladie_prof::find($id);
        $maladie->intitule = $request->input('intitule');


        try{
            $maladie->save();
        }catch (\Exception $e){
            echo'e';
        }
        return redirect()->route('maladie_prof.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $maladie = Maladie_prof::find($id);
        $maladie->delete();

        return redirect()->route('maladie_prof.index')
            ->with('success', 'Site Supprimé avec succes');
    }

}
