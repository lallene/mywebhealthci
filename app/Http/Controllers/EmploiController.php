<?php

namespace App\Http\Controllers;

use App\Models\Emploi;
use App\Models\Familleemploi;
use Illuminate\Http\Request;

class EmploiController extends Controller
{
    private $templatePath = 'configuration.emploi';
    private $link = 'emploi';

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
        $items = Emploi::all();
        return view($this->templatePath.'.liste', ['titre' => "Liste des emplois", 'items' => $items, 'link' => $this->link]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $foreigns = Familleemploi::all();
        return view($this->templatePath.'.create', ['titre' => "Ajouter un emploi", 'link' => $this->link, 'foreigns' => $foreigns]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Emploi::create(
            [
                'designation' => $request->input('designation'),
                'description' => $request->input('description'),
                'familleemploi_id' => $request->input('familleemploi_id')
            ]
        );

        return redirect()->route('emploi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Emploi  $emploi
     * @return \Illuminate\Http\Response
     */
    public function show(Emploi $emploi)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Emploi  $emploi
     * @return \Illuminate\Http\Response
     */
    public function edit(Emploi $emploi)
    {
        $item = $emploi;
        $foreigns = Familleemploi::all();

        return view($this->templatePath.'.edit', ['titre' => "Modifier ".$item->designation, 'item' => $item, 'link' => $this->link, 'foreigns' => $foreigns]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Emploi  $emploi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Emploi::find($id);

        $item->designation = $request->input('designation');
        $item->description = $request->input('description');
        $item->familleemploi_id = $request->input('familleemploi_id');

        try{
            $item->save();
        }catch (\Exception $e){
            echo'e';
        }
        return redirect()->route('emploi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Emploi  $emploi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Familleemploi::find($id);

        $item->delete();

        return redirect()->route('emploi.index')
            ->with('success', "Emploi Supprimé avec succes");
    }
}
