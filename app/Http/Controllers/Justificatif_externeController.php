<?php

namespace App\Http\Controllers;

use App\Models\Justificatif_externe;
use Illuminate\Http\Request;

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

 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Justificatif_externe::create(
            [
                'statut' => $request->input('statut'),
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
                'justif_valide' => $request->input('justif_valide'),
                'motif_rejet' => $request->input('motif_rejet'),
                'Duplicat_suite_valide' => $request->input('Duplicat_suite_valide'),
                'motif_consultation_id' => $request->input('motif_consultation_id'),
                'maladie_contagieuse_id' => $request->input('maladie_contagieuse_id'),
                'maladie_prof_id' => $request->input('maladie_prof_id'),
                'site_id' => $request->input('site_id'),
                'agent_id' => $request->input('agent_id'),

            ]
        );

        return redirect()->route('justificatif_externe.index');
    }




}
