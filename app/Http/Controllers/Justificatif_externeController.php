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
}
