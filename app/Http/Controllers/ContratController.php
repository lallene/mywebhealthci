<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use Illuminate\Http\Request;

class ContratController extends Controller
{
    private $templatePath = 'configuration.contrat';
    private $link = 'typecontrat';

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
        $items = Contrat::all();
        return view($this->templatePath.'.liste', ['titre' => "Liste des Types de contrat", 'items' => $items, 'link' => $this->link]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->templatePath.'.create', ['titre' => "Ajouter un Type de contrat", 'link' => $this->link]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Contrat::create(
            [
                'designation' => $request->input('designation'),
                'description' => $request->input('description')
            ]
        );

        return redirect()->route($this->link.'.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contrat  $contrat
     * @return \Illuminate\Http\Response
     */
    public function show(Contrat $contrat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contrat  $contrat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Contrat::find($id);
        return view($this->templatePath.'.edit', ['titre' => "Modifier Type de Contrat ".$item->designation, 'item' => $item, 'link' => $this->link]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contrat  $contrat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Contrat::find($id);
        $item->designation = $request->input('designation');
        $item->description = $request->input('description');

        try{
            $item->save();
        }catch (\Exception $e){
            echo'e';
        }
        return redirect()->route($this->link.'.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contrat  $contrat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Contrat::find($id);

        $item->delete();

        return redirect()->route($this->link.'.index')
            ->with('success', "Type de contrat Supprimé avec succes");
    }
}
