<?php

namespace App\Http\Controllers;

use App\Exports\ConsultationsExport;
use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Models\Motif_consultation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Projet;
use App\Models\Site;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class SearchController extends Controller
{
    public function index()
    {


    $SaveDateDebut = null;
    $SaveDateFin = null;
    $SaveSite = null;
    $SaveProjet = null;
    $SaveMedecin = null;
    $SaveContagieuse = null;
    $SaveCentreExtene = null;
    $SaveProf = null;
    $SaveTypeArret = null;
    $SaveAccidentPro = null;
    $SaveMotifConsul = null;
    $SaveMotifRejet = null;
    $SaveTraitAdmin = null;
    $SaveCovid = null;
    $SaveTypeConsul = null;
    $SaveMedecinExterne = null;
    $SaveMedocAdm  = null;



    $nbre = 0;
    $days= 0;
    $mins = 0;
    $hours= 0;
    $totalArretrefuse = 0;
    $totalArretVailde = 0;
    $totalArretEnattente = 0;
    $heureArret = 0;
    $totalArretInterne = 0;
      $motifs = Motif_consultation::all();
      $sites = Site::all();
      $medecins = Consultation::all();
      $medecinInterne = User::role('Corps médical')->get();
      $data =null;
      //$projets = DB::table('projets')->simplePaginate(60);
      $projets = Projet::all();
      $_GET['siteConsultation'] = null;
      $_GET['projet'] = null;
      $_GET['prof'] = null;
      $_GET['maladie_contagieuse'] = null;
      $_GET['motif_consultation'] = null;
      $_GET['medoc_adm'] = null;
      $_GET['accidentPro'] = null;
      $_GET['soinadministre'] = null;
      $_GET['vaccin_covid'] = null;
      $_GET['trait_adm'] = null;
      $_GET['contagieuse'] = null;
      $_GET['motifRejet'] = null;
      $_GET['typeArrêt'] = null;
      $_GET['testCovid'] = null;
      $_GET['medecin'] = null;
      $_GET['designationCentreExterne'] = null;
      $_GET['medecinInterne'] = null;
      $_GET['typeConsultation'] = null;


      $test = null;







      //dd($medecins);

        return view('search.search', ['data' => $data, 'motifs' => $motifs,
                                       'SaveMedocAdm' => $SaveMedocAdm ,
                                      'sites' => $sites, 'projets' => $projets,
                                      'medecins' => $medecins , 'medecinInterne' => $medecinInterne,
                                      'totalArretrefuse' => $totalArretrefuse,
                                      'totalArretVailde' => $totalArretVailde,
                                      'totalArretEnattente' => $totalArretEnattente,
                                      'heureArret' => $heureArret,
                                      'totalArretInterne' => $totalArretInterne,
                                      'nbre' => $nbre,
                                      'days' => $days,
                                      'mins' => $mins,
                                      'hours' => $hours,
                                      'test' => $test,
                                      'SaveDateDebut'  => $SaveDateDebut,
                                      'SaveDateFin'  =>$SaveDateFin,
                                        'SaveSite'   => $SaveSite,
                                        'SaveProjet' => $SaveProjet,
                                        'SaveMedecin'   => $SaveMedecin,
                                        'SaveContagieuse'   => $SaveContagieuse,
                                      'SaveCentreExtene'  => $SaveCentreExtene ,
                                       'SaveProf' => $SaveProf ,
                                       'SaveTypeArret' => $SaveTypeArret ,
                                       'SaveAccidentPro' => $SaveAccidentPro ,
                                       'SaveMotifConsul' => $SaveMotifConsul ,
                                       'SaveMotifRejet' => $SaveMotifRejet ,
                                       'SaveTraitAdmin' => $SaveTraitAdmin ,
                                      'SaveCovid'  => $SaveCovid ,

                                       'SaveTypeConsul' => $SaveTypeConsul ,
                                       'SaveMedecinExterne' => $SaveMedecinExterne]);
    }

    public function advance(Request $request)
    {
        $test = "yes";
        $motifs = Motif_consultation::all();
        $sites = Site::all();
        $projets = Projet::all();
        $data = Consultation::all();
        $medecins = Consultation::all();
        $medecinInterne = User::role('Corps médical')->get();
        $data =Consultation::all();
        $SaveDateDebut = $request->datedebut;
        $SaveDateFin =  $request->datefin;
        $SaveSite = $request->siteConsultation;
        $SaveProjet = $request->projet;
        $SaveMedecin = $request->medecinInterne;
        $SaveContagieuse = $request->contagieuse;
        $SaveCentreExtene = $request->designationCentreExterne ;
        $SaveProf = $request->prof;
        $SaveTypeArret = $request->typeArrêt;
        $SaveAccidentPro = $request->accidentPro;
        $SaveMotifConsul = $request->motif_consultation_id;
        $SaveMotifRejet = $request->motifRejet;
        $SaveTraitAdmin = $request->trait_adm;
        $SaveCovid = $request->covid;
        $SaveTypeConsul = $request->typeConsultation;
        $SaveMedecinExterne =$request->medecin;
        $SaveMedocAdm  = $request->medoc_adm ;




    if (isset($request->siteConsultation) AND $request->siteConsultation <> "all" ){
        $data =  $data->where('siteConsultation', '=', $request->siteConsultation );
    }


    if (isset($request->projet) AND $request->projet <> "all" ){
        $data =  $data->where('projet_id', '=', $request->projet );

    }

    if (isset($request->medecin) AND $request->medecin <> "all" ){
    $data =  $data->where('nomMedecin', '=', $request->medecin );
    }

    if (isset($request->contagieuse) AND $request->contagieuse <> "all" ){
        $data =  $data->where('maladie_contagieuse', '=', $request->contagieuse );
    }

    if (isset($request->designationCentreExterne) AND $request->designationCentreExterne <> "all" ){
        $data =  $data->where('designationCentreExterne', '=', $request->designationCentreExterne );
    }

    if (isset($request->prof) AND $request->prof <> "all" ){
        $data =  $data->where('maladie_prof', '=', $request->prof );
    }

    if (isset($request->typeArrêt) AND $request->typeArrêt <> "all" ){
        $data =  $data->where('typeArrêt', '=', $request->typeArrêt );
    }

    if (isset($request->accidentPro) AND $request->accidentPro <> "all" ){
        $data =  $data->where('accidentPro', '=', $request->accidentPro );
    }

    if (isset($request->motif_consultation_id) AND $request->motif_consultation_id <> "all" ){
        $data =  $data->where('motif_consultation_id', '=', $request->motif_consultation_id );
    }

    if (isset($request->motifRejet) AND $request->motifRejet <> "all" ){
        $data =  $data->where('motifRejet', '=', $request->motifRejet );
    }
    if (isset($request->medoc_adm) AND $request->medoc_adm <> "all" ){
        $data =  $data->where('soinadministre', '=', $request->medoc_adm );
    }
    if (isset($request->trait_adm) AND $request->trait_adm <> "all" ){
        $data =  $data->where('traitementAdmin', '=', $request->trait_adm );
    }
    if (isset($request->testCovid) AND $request->testCovid <> "all" ){
        $data =  $data->where('testCovid', '=', $request->covid );
    }
    if (isset($request->typeConsultation) AND $request->typeConsultation <> "all" ){
        $data =  $data->where('typeConsultation', '=', $request->typeConsultation );
    }
    if (isset($request->medecinInterne) AND $request->medecinInterne <> "all" ){
        $data =  $data->where('user_id', '=', $request->medecinInterne );
    }




    if( isset($request->datedebut) && isset($request->datefin) ){

        $data = $data->where('dateConsultation', '>=', $request->datedebut)
                     ->where('dateConsultation', '<=', $request->datefin);

    }

    $dataTotal = $data ;


    if( isset($dataTotal)){

       $collaborateurs =  $dataTotal;

       $totalArretrefuse =  $dataTotal->where('typeArrêt', '=', 'non');

       $totalArretVailde = $dataTotal->where('typeArrêt', '!=', 'non')
                                 ->where('typeArrêt', '!=', 'en attente');

       $totalArretEnattente =  $dataTotal->where('typeArrêt', '=', 'en attente');

      $totalHeureNonTravaille= $dataTotal->where('typeArrêt', '!=', 'non');

         $totalArretInterne= $dataTotal->where('typeConsultation', '=', 'Interne')
                                 ->where('typeArrêt', '!=', 'non');
    }
    $nbre = sizeof($collaborateurs);
    $totalArretrefuse = sizeof($totalArretrefuse);
    $totalArretVailde = sizeof($totalArretVailde);
    $totalArretEnattente = sizeof($totalArretEnattente);
    $heureArret = $totalHeureNonTravaille->sum('duree_arret');
    $totalArretInterne = sizeof($totalArretInterne);

        $days = 0;
        $hours = floor (($heureArret - $days * 1440) / 60);
        $mins = $heureArret - ($days * 1440) - ($hours * 60);



        return view('search.search', compact('data'), ['sites' => $sites, 'projets' => $projets,
                                                        'motifs' => $motifs, 'medecins' => $medecins,
                                                        'medecinInterne'=> $medecinInterne, 'test' => $test,
                                                        'totalArretrefuse' => $totalArretrefuse,
                                                        'totalArretVailde' => $totalArretVailde,
                                                        'totalArretEnattente' => $totalArretEnattente,
                                                        'heureArret' => $heureArret,
                                                        'totalArretInterne' => $totalArretInterne,
                                                        'nbre' => $nbre,
                                                        'days' => $days,
                                                        'hours' => $hours,
                                                        'mins' => $mins,
                                                        'SaveDateDebut'  => $SaveDateDebut,
                                                        'SaveDateFin'  =>$SaveDateFin,
                                                          'SaveSite'   => $SaveSite,
                                                          'SaveProjet' => $SaveProjet,
                                                          'SaveMedecin'   => $SaveMedecin,
                                                          'SaveContagieuse'   => $SaveContagieuse,
                                                        'SaveCentreExtene'  => $SaveCentreExtene ,
                                                         'SaveProf' => $SaveProf ,
                                                         'SaveTypeArret' => $SaveTypeArret ,
                                                         'SaveAccidentPro' => $SaveAccidentPro ,
                                                         'SaveMotifConsul' => $SaveMotifConsul ,
                                                         'SaveMotifRejet' => $SaveMotifRejet ,
                                                         'SaveTraitAdmin' => $SaveTraitAdmin ,
                                                        'SaveCovid'  => $SaveCovid ,
                                                        'SaveMedocAdm'=> $SaveMedocAdm,
                                                         'SaveTypeConsul' => $SaveTypeConsul ,
                                                         'SaveMedecinExterne' => $SaveMedecinExterne
                                                    ]);
    }

    public function export(Request $request)
    {
        $from = $request->input('from', now()->subDays(7)); // par défaut 7 jours avant
        $to = $request->input('to', now()); // par défaut aujourd'hui
    
        return Excel::download(new ConsultationsExport($from, $to), 'data.xlsx');
    }
}
