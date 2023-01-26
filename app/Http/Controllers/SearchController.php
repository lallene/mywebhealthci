<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index()
    {
       // $data = Consultation::with(['Site','MotifConsultation', 'Ordonnances', 'Medecin', 'Agent', 'Projet'])->paginate(30);
       $data = DB::table('consultations')->simplePaginate(15);
       $sites = DB::table('sites')->simplePaginate(20);
       $projets = DB::table('projets')->simplePaginate(20);
        return view('search.search', ['data' => $data, 'sites' => $sites, 'projets' => $projets ]);
    }

    public function simple(Request $request)
    {
        $data = DB::table('consultations')->simplePaginate(15);
        if( $request->input('search')){
           $data = Consultation::where('typeConsultation', 'LIKE', "%" . $request->search . "%")->simplePaginate(15);
        }
        return view('search.search', compact('data'));
    }
    public function advance(Request $request)
    {
        //dd($request);
        $data = DB::table('consultations')->simplePaginate(20);
       // dd($request->name);

        if( $request->name){
            $data = Consultation::where('motifRejet', 'LIKE', "%" . $request->name . "%")->simplePaginate(15);
        }
        if( $request->natureReception){
            $data = $data->where('address', 'LIKE', "%" . $request->natureReception . "%");
        }
        if( $request->projet_id){
            $data = $data->where('address', 'LIKE', "%" . $request->projet_id . "%");
        }
        if( $request->typeconsultaion){
            $data = $data->where('address', 'LIKE', "%" . $request->typeconsultaion . "%");
        }
        if( $request->user_id){
            $data = $data->where('address', 'LIKE', "%" . $request->user_id . "%");
        }
        if( $request->debut && $request->fin ){
            $data = $data->where('debut', '>=', $request->debut)
                         ->where('fin', '<=', $request->fin);
        }


        return view('search.search', compact('data'));
    }
}
