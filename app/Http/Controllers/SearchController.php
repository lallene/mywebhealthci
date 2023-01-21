<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index()
    {
        $data = DB::table('consultations')->simplePaginate(15);
        return view('search.search', compact('data'));
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
        $data = Consultation::all();
        if( $request->name){
            $data = $data->where('name', 'LIKE', "%" . $request->name . "%");
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
        $data = $data->paginate(20);
        return view('search.search', compact('data'));
    }
}
