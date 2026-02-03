<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Projet;
use App\Models\Consultation;
use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\IrisExport;

class search_irisController extends Controller
{
    public function index()
    {
        $_GET['datedebut'] = null;
        $_GET['datefin'] =  null;
        $_GET['search'] = null;
        $SaveDateDebut = null;
        $SaveDateFin = null;
        $SaveAgent = null;


        $nbre = 0;
        $totalArretrefuse = 0;
        $totalArretVailde = 0;
        $totalArretEnattente = 0;
        $heureArret = 0;
        $totalArretInterne = 0;
        $days= 0;
        $hours= 0;
        $sites = 0;
        $medecin = 0;
        $collaborateurs = null;
        $agent = null;
        $test = null;
        $days = 0;
        return view('search.recherche_iris', ['collaborateurs' => $collaborateurs,
                                              'agent' => $agent, 'test' => $test,
                                              'nbre' => $nbre,
                                              'totalArretrefuse' => $totalArretrefuse,
                                              'totalArretVailde' => $totalArretVailde,
                                              'totalArretEnattente' => $totalArretEnattente,
                                              'heureArret' => $heureArret,
                                              'totalArretInterne' => $totalArretInterne,
                                              'days' => $days,
                                              'hours' => $hours,
                                              'sites' => $sites,
                                              'medecin'=> $medecin,
                                              'SaveDateDebut'=> $SaveDateDebut,
                                              'SaveDateFin'=>$SaveDateFin,
                                              'SaveAgent'=> $SaveAgent


                                            ]);
    }

    public function simple(Request $request)
    {
        $test = "action";
        $begin = $request->datedebut;
        $end = $request->datefin;
        $dateReprise = null;
        $dateConsul = null;

        $agent = Agent::where('Matricule_salarie', '=', $request->workday_id)->first();
        $collaborateurs = Consultation::where('agent_id', '=', $agent->id)->first();
        $days = 0;
        $sites = Site::where('id', '=', $collaborateurs->siteConsultation)->first();
        $medecin = User::where('id', '=', $collaborateurs->user_id)->first();
        $SaveDateDebut= $begin;
        $SaveDateFin= $end;
        $SaveAgent= $agent;
        

        if( $agent->id){

            $collaborateurs = DB::table('consultations')
                             ->where('agent_id', '=', $agent->id)
                             ->whereDate('dateConsultation', '>=', $begin)
                             ->whereDate('dateConsultation', '<=', $end)->get();

            
            if ($collaborateurs->isNotEmpty()) {
              $repriseDateTime = Carbon::parse($collaborateurs[0]->dateConsultation)
                  ->copy()
                  ->addMinutes($collaborateurs[0]->duree_arret);
              $dateReprise = $repriseDateTime->format('d-m-Y');
              $dateDebut = Carbon::parse($collaborateurs[0]->dateConsultation)->format('d-m-Y');
              $dateConsul = Carbon::parse($collaborateurs[0]->created_at)->format('d-m-Y');
            }


           $totalArretrefuse =  DB::table('consultations')
                            ->where('agent_id', '=', $agent->id)
                            ->where('typeArrêt', '=', 'non')
                            ->whereDate('dateConsultation', '>=', $begin)
                            ->whereDate('dateConsultation', '<=', $end);

           $totalArretVailde = DB::table('consultations')
                            ->where('agent_id', '=', $agent->id)
                            ->where('typeArrêt', '!=', 'non')
                            ->where('typeArrêt', '!=', 'en attente')
                            ->whereDate('dateConsultation', '>=', $begin)
                            ->whereDate('dateConsultation', '<=', $end);

           $totalArretEnattente = DB::table('consultations')
                            ->where('agent_id', '=', $agent->id)
                            ->where('typeArrêt', '=', 'en attente')
                            ->whereDate('dateConsultation', '>=', $begin)
                            ->whereDate('dateConsultation', '<=', $end);

            $totalHeureNonTravaille= DB::table('consultations')
                            ->where('agent_id', '=', $agent->id)
                            ->where('typeArrêt', '!=', 'non')
                            ->whereDate('dateConsultation', '>=', $begin)
                            ->whereDate('dateConsultation', '<=', $end);

            $totalArretInterne= DB::table('consultations')
                            ->where('agent_id', '=', $agent->id)
                            ->where('typeConsultation', '=', 'Interne')
                            ->where('typeArrêt', '!=', 'non')
                            ->whereDate('dateConsultation', '>=', $begin)
                            ->whereDate('dateConsultation', '<=', $end);


        }



        $nbre = sizeof($collaborateurs);
        $totalArretrefuse = sizeof($totalArretrefuse->get());
        $totalArretVailde = sizeof($totalArretVailde->get());
        $totalArretEnattente = sizeof($totalArretEnattente->get());
        $heureArret = $totalHeureNonTravaille->sum('duree_arret');
        $totalArretInterne = sizeof($totalArretInterne->get());




            if((int)$heureArret > 24){
            $days = str_pad(floor($heureArret /24),2,"0",STR_PAD_LEFT);
            $hours = str_pad($heureArret %24,2,"0",STR_PAD_LEFT);
            }
            if(isset($days)) { $days = $days." jr(s) ";}

         $days = 0;
        $hours = floor (($heureArret - $days * 1440) / 60);
        $mins = $heureArret - ($days * 1440) - ($hours * 60);



        return view('search.recherche_iris', compact('collaborateurs'), ['agent' => $agent,
                                                                          'nbre'=> $nbre, 'test'=> $test,
                                                                          'totalArretrefuse' => $totalArretrefuse,
                                                                          'totalArretVailde' => $totalArretVailde,
                                                                          'totalArretEnattente' => $totalArretEnattente,
                                                                          'heureArret' =>$heureArret,
                                                                          'days' => $days,
                                                                          'hours'=> $hours,
                                                                          'totalArretInterne' => $totalArretInterne,
                                                                          'sites' => $sites,
                                                                          'medecin'=> $medecin,
                                                                          'mins' => $mins,
                                                                          'SaveDateDebut'=> $SaveDateDebut,
                                                                          'SaveDateFin'=>$SaveDateFin,
                                                                          'SaveAgent'=> $SaveAgent,
                                                                          'dateReprise'=> $dateReprise,
                                                                          'dateDebut' => $begin,
                                                                          'dateFin' => $end,
                                                                          'dateConsul' => $dateConsul

    ]);

    }

    public function export(Request $request)
    {
        $from = $request->input('SaveDateDebut'); 
        $to = $request->input('SaveDateFin'); 
        $name =$request->input('name'); 
        $projet =$request->input('projet'); 
        $workday =$request->input('workday_id'); 


    //  dd($from, $to);
    
        return Excel::download(
            new IrisExport($from, $to, $workday, $name),
            'FicheConsultation_'.$workday.'_' . $name . '_' . $projet . '.xlsx'
        );
    }


}
