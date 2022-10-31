<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Models\Justificatif_externe;
use Illuminate\Support\Facades\Auth;

class Justificatif_externeController extends Controller
{
    private $templatePath = 'configuration.justificatif_externe';
    private $link = 'jutificatif_externe';

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
        $items = Justificatif_externe::all();
        return view($this->templatePath.'.liste', ['titre' => "Jutificatif externe  agent", 'items' => $items, 'link' => $this->link]);
    }

    public function reception ($id){
        $agents = Agent::find($id);
        return view($this->templatePath.'.reception', ['titre' => "Reception de Justificatif", 'agent' => $agents, 'link' => $this->link]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $foreigns = Justificatif_externe::all();
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
        $userId = Auth::id();
        Justificatif_externe::create(
            [
                'statut' => $request->input('statut_patient'),
                'accident_travail' => $request->input('accident_travail'),
                'traitement_adm' => $request->input('traitement_adm'),
                'medoc_adm' => $request->input('medoc_adm'),
                'arret_maladie_recu' => $request->input('arret_maladie_recu'),
                'duree_arret' => $request->input('duree_arret'),
                'date_dbt_arret' => $request->input('date_dbt_arret'),
                'date_repise_trvl' => $request->input('date_repise_trvl'),
                'nbre_jours' => $request->input('nbre_jours'),
                'billet_sortie' => $request->input('billet_sortie'),
                'covid' => $request->input('covid'),
                'repris_service' => $request->input('repris_service'),
                'vaccin_covid' => $request->input('vaccin_covid'),
                'dose_covid' => $request->input('dose_covid'),
                'clinique_externe' => $request->input('clinique_externe'),
                'medecin_externe' => $request->input('medecin_externe'),
                'justif_valide' => $request->input('justif_valide'),
                'motif_rejet' => $request->input('motif_rejet'),
                'duplicat_suite_valide' => $request->input('duplicat_suite_valide'),
                'motif_consultation_id' => $request->input('motif_consultation_id'),
                'maladie_contagieuse_id' => $request->input('maladie_contagieuse_id'),
                'maladie_prof_id' => $request->input('maladie_prof_id'),
                'user_id' => $userId,
                'agent_id' => $request->input('agent_id'),

            ]
        );

        return redirect()->route('justificatif_externe.index');
    }

}
