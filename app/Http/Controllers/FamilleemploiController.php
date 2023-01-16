<?php

namespace App\Http\Controllers;

use App\Models\Familleemploi;
use Illuminate\Http\Request;

class FamilleemploiController extends Controller
{
    private $templatePath = 'configuration.familleemploi';
    private $link = 'famille';

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
        $items = Familleemploi::all();
        return view($this->templatePath.'.liste', ['titre' => "Liste des Familles d'emploi", 'items' => $items, 'link' => $this->link]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->templatePath.'.create', ['titre' => "Ajouter une Famille d'emploi", 'link' => $this->link]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Familleemploi::create(
            [
                'designation' => $request->input('designation'),

            ]
        );

        return redirect()->route('famille.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Familleemploi  $familleemploi
     * @return \Illuminate\Http\Response
     */
    public function show(Familleemploi $familleemploi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Familleemploi  $familleemploi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Familleemploi::find($id);
        return view($this->templatePath.'.edit', ['titre' => "Modifier ".$item->designation, 'item' => $item, 'link' => $this->link]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Familleemploi  $familleemploi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Familleemploi::find($id);
        $item->designation = $request->input('designation');


        try{
            $item->save();
        }catch (\Exception $e){
            echo'e';
        }
        return redirect()->route('famille.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Familleemploi  $familleemploi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Familleemploi::find($id);

        $item->delete();

        return redirect()->route('famille.index')
            ->with('success', "Famille d'emploi Supprimée avec succes");
    }
}
