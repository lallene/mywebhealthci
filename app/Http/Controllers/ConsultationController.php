<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    private $templatePath = 'configuration.consultation';
    private $link = 'consultation';

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
        $items = Consultation::all();
        return view($this->templatePath.'.search', ['titre' => "Recherche de l'agent", 'items' => $items, 'link' => $this->link]);
    }

    public function consulter($id){
        $agent = Agent::find($id);
        return view($this->templatePath.'.liste', ['titre' => "Recherche de l'agent", 'agent' => $agent, 'link' => $this->link]);
    }
}
