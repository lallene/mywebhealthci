<?php

namespace App\Http\Controllers;

use App\Models\fonction;
use App\Models\sub_fonction;
use Illuminate\Http\Request;

class Sub_FonctionController extends Controller
{
    private $templatePath = 'configuration.sub_fonction';
    private $link = 'sub_fonction';

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
        $items = sub_fonction::all();
        return view($this->templatePath.'.liste', ['titre' => "Liste des sous-fonctions", 'items' => $items, 'link' => $this->link]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $foreigns = fonction::all();
        return view($this->templatePath.'.create', ['titre' => "Ajouter une sous fonction", 'link' => $this->link, 'foreigns' => $foreigns]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        sub_fonction::create(
            [
                'intitule' => $request->input('intitule'),
                'fonction_id' => $request->input('fonction_id')
            ]
        );

        return redirect()->route('sub_fonction.index');
    }

      /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sub_fonction  $emploi
     * @return \Illuminate\Http\Response
     */
    public function edit(sub_fonction $sub_fonction)
    {
        $item = $sub_fonction;
        $foreigns = fonction::all();

        return view($this->templatePath.'.edit', ['titre' => "Modifier ".$item->intitule, 'item' => $item, 'link' => $this->link, 'foreigns' => $foreigns]);
    }

      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sub_fonction  $emploi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = sub_fonction::find($id);

        $item->intitule = $request->input('intitule');
        $item->fonction_id = $request->input('fonction_id');

        try{
            $item->save();
        }catch (\Exception $e){
            echo'e';
        }
        return redirect()->route('sub_fonction.index');
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sub_fonction  $sub_fonction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = fonction::find($id);

        $item->delete();

        return redirect()->route('sub_fonction.index')
            ->with('success', "Emploi Supprimé avec succes");
    }

}
