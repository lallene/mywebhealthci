<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Site;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
    private $templatePath = 'configuration.projet';
    private $link = 'projet';

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
        $items = Projet::all();
        return view($this->templatePath.'.liste', ['titre' => "Liste des Projets/Services", 'items' => $items, 'link' => $this->link]);
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
                'description' => $request->input('description'),
                'site_id' => $request->input('site_id')
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
        $item->description = $request->input('description');
        $item->site_id = $request->input('site_id');

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
}
