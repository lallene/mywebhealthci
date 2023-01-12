<?php

namespace App\Http\Controllers;

use App\Models\Medicament;
use Illuminate\Http\Request;

class MedicamentController extends Controller
{

    private $templatePath = 'configuration.medicament';
    private $link = 'medicament';

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Agent de santé');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Medicament::where('etat', '=', 0)->get();
        return view($this->templatePath.'.liste', ['titre' => "Liste des Medicaments", 'items' => $items, 'link' => $this->link]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->templatePath.'.create', ['titre' => "Ajouter Medicament", 'link' => $this->link]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Medicament::create(
            [
                'type' => $request->input('type'),
                'designation' => $request->input('designation'),
                'details' => $request->input('details')
            ]
        );

        return redirect()->route('medicament.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function show(Medicament $medicament)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Medicament::find($id);
        return view($this->templatePath.'.edit', ['titre' => "Modifier Medicament", 'item' => $item, 'link' => $this->link]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Medicament::find($id);
        $item->type = $request->input('type');
        $item->designation = $request->input('designation');
        $item->details = $request->input('details');
        $item->quantite = $request->input('quantite');

        try{
            $item->save();
        }catch (\Exception $e){
            echo'e';
        }
        return redirect()->route('medicament.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Medicament::find($id);

        $item->etat = 1;

        $item->save();

        return redirect()->route('medicament.index')
            ->with('success', "Medicament Supprimé avec succes");
    }
}
