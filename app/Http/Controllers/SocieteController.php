<?php

namespace App\Http\Controllers;

use App\Imports\SocietesImport;
use App\Models\Societe;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SocieteController extends Controller
{
    private $templatePath = 'configuration.societe';

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
        $items = Societe::all();
        return view($this->templatePath.'.liste', ['titre' => "Liste des Sociétés", 'items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->templatePath.'.create', ['titre' => "Ajouter une Société"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Societe::create(
            [
                'designation' => $request->input('designation'),
                'responsable' => $request->input('responsable'),
                'contact' => $request->input('contact')
            ]
        );

        return redirect()->route('societe.index')->with('success','Société enregistrée avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Societe  $societe
     * @return \Illuminate\Http\Response
     */
    public function show(Societe $societe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Societe  $societe
     * @return \Illuminate\Http\Response
     */
    public function edit(Societe $societe)
    {
        return view($this->templatePath.'.edit', ['titre' => "Modifier ".$societe->designation, 'item' => $societe]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Societe  $societe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Societe $societe)
    {
        $societe->designation = $request->input('designation');
        $societe->responsable = $request->input('responsable');
        $societe->contact = $request->input('contact');

        try{
            $societe->save();
        }catch (\Exception $e){
            echo'e';
        }
        return redirect()->route('societe.index')->with('success','Société Modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Societe  $societe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Societe $societe)
    {
        $societe->delete();

        return redirect()->route('societe.index')
            ->with('success', 'Société Supprimée avec succes');
    }


}
