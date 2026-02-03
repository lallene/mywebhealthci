<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Contrat;
use App\Models\Emploi;
use App\Models\Fonction;
use App\Models\Projet;
use App\Models\Site;
use App\Models\Societe;
use App\Models\Sub_fonction;
use App\Models\Teste;
use Illuminate\Http\Request;

class TesteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testes = Teste::all();
        foreach ($testes as $item) {

            $oldDate = str_replace('/', '-', $item->date_embauche);

            $item->date_embauche = date('Y-m-d', strtotime($oldDate));

            $search = Agent::where('iris', '=', $item->iris)->get();

            if(!empty($search) AND isset($search[0])){
                $k = $search[0];

                $k->dateembauche = $item->date_embauche;
                //$k->save();

                //echo'<pre>'; print_r($item);
                //echo'****************************************************************************************************';
                //echo'<pre>'; die(print_r($k));
            }

            //echo $item->date_embauche." <br>*********************<br>";

            //$item->save();

            /*
            if($item->sexe == 'Féminin'){
                $item->sexe = 'F';
            }else{
                $item->sexe = 'M';
            }
            /*

            $item->save();


            //$search = Contrat::where('designation', '=', $item->contrat)->get();
            //$search = Societe::where('designation', '=', $item->societe)->get();
            //$search = Site::where('designation', '=', $item->site)->get();
            //$search = Projet::where('designation', '=', $item->projet)->get();
            //$search = Emploi::where('designation', '=', $item->emploi)->get();
            //$search = Fonction::where('intitule', '=', $item->fonction)->get();
            //$search = Sub_fonction::where('intitule', '=', $item->sousfonction)->get();
            /*
            $tempNom = $item->prenom.' '.$item->nom;
            $search = Teste::where('manager', '=', $tempNom)->get();


            if(!empty($search)){
                foreach ($search as $s) {
                    $s->manager = $item->iris;
                    $s->save();
                }
            }
            */

            /*
            if(!empty($search) AND isset($search[0])){
                $k = $search[0];

                $item->sousfonction = $k->id;
                $item->save();

                //echo'<pre>'; print_r($item);
                //echo'****************************************************************************************************';
                //echo'<pre>'; die(print_r($k));
            }
            */



        }
        echo'<pre>'; die(print_r($testes));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teste  $teste
     * @return \Illuminate\Http\Response
     */
    public function show(Teste $teste)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teste  $teste
     * @return \Illuminate\Http\Response
     */
    public function edit(Teste $teste)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teste  $teste
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teste $teste)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teste  $teste
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teste $teste)
    {
        //
    }
}
