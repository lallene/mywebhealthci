<?php

namespace App\Http\Controllers;

use App\Models\Maladie_contagieuse;
use Illuminate\Http\Request;

class Maladie_contagieuseController extends Controller
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
        $maladies = Maladie_contagieuse::all();
        return view('configuration.maladie_contagieuse.liste', ['titre' => "Liste des maladies contagieuses", 'maladies' => $maladies]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('configuration.maladie_contagieuse.create', ['titre' => "Ajouter une maladie contagieuse"]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Maladie_contagieuse::create(
            [
                'intitule' => $request->input('intitule'),
            ]
        );

        return redirect()->route('maladie_contagieuse.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Maladie_contagieuse  $fonction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $maladie = Maladie_contagieuse::find($id);
        return view('configuration.maladie_contagieuse.edit', ['titre' => "Modifier ".$maladie->intitule, 'maladie' => $maladie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\maladie_contagieuse $fonction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $maladie_contagieuse)
    {
        $maladie_contagieuse = Maladie_contagieuse::find($maladie_contagieuse);
        $maladie_contagieuse->intitule = $request->input('intitule');


        try{
            $maladie_contagieuse->save();
        }catch (\Exception $e){
            echo'e';
        }
        return redirect()->route('maladie_contagieuse.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $maladie = Maladie_contagieuse::find($id);
        $maladie->delete();


        return redirect()->route('maladie_contagieuse.index')
            ->with('success', 'Site Supprimé avec succes');
    }

}
