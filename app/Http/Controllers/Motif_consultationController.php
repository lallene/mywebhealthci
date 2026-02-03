<?php

namespace App\Http\Controllers;

use App\Imports\MotifConsultationImport;
use Illuminate\Http\Request;
use App\Models\Motif_consultation;
use Maatwebsite\Excel\Facades\Excel;

class Motif_consultationController extends Controller
{
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
        $motifs = Motif_consultation::all();
        return view('configuration.motif_consultation.liste', ['titre' => "Liste des motifs consultation", 'motifs' => $motifs]);
    }
          // Nouvelle méthode pour renvoyer les motifs en JSON
    public function getMotifsJson()
    {
        $motifs = Motif_consultation::all();
        return response()->json($motifs);
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('configuration.motif_consultation.create', ['titre' => "Ajouter une motif de consultation"]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Motif_consultation::create(
            [
                'intitule' => $request->input('intitule'),
            ]
        );

        return redirect()->route('motif_consultation.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Motif_consultation  $fonction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $motif = Motif_consultation::find($id);
        return view('configuration.motif_consultation.edit', ['titre' => "Modifier ".$motif->intitule, 'motif' => $motif]);
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
        $motif = Motif_consultation::find($id);
        $motif->intitule = $request->input('intitule');


        try{
            $motif->save();
        }catch (\Exception $e){

            echo'e';
        }
        return redirect()->route('motif_consultation.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {

        $motif = Motif_consultation::find($id);
        $motif->delete();

        return redirect()->route('motif_consultation.index')
            ->with('success', 'Site Supprimé avec succes');
    }

    public function import (Request $req){

        Excel::import(new MotifConsultationImport, $req->file('motif_file'),

     );

         return back();
     }

}
