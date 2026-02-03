<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use App\Models\Projet;
use App\Models\Contrat;
use Illuminate\Http\Request;
use App\Models\Motif_consultation;
use Illuminate\Support\Facades\DB;
use App\Exports\ConsultationsExport;
use App\Models\Agent;
use App\Models\Consultation;
use Maatwebsite\Excel\Facades\Excel;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');





    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $test = null;
        $projets = Projet::all();
        $sites = Site::all();
        $begin = date('Y-m-d');
        $end = date('Y-m-d');
        $chartData = self::getStatsByMedecin($begin, $end);
        $byTypeContrat = self::getArretByTypeContrat($begin, $end);
        $bySexe = self::getArretBySexe($begin, $end);
        $arretsByTranche = self::getArretByTranche($begin, $end);
        $byCouverture = self::getArretByCouverture($begin, $end);
        $byMaladiePro = self::getArretByMaladiePro($begin, $end);
        $byAccident = self::getArretByAccident($begin, $end);
        $byMaladieCon = self::getArretByMaladieProCon($begin, $end);
        $statByPathologie = self::getConsultationsByMotif($begin, $end);
        $statByPathologieAndGenre = self::getConsultationsByMotifAndGenre($begin, $end);
        $statByPathologieAndContagieux = self::getConsultationsByContagieux($begin, $end);
        $arretsBySite = self::getArretsBySites($begin, $end);
        $accidentsBySite = self::getAccidentsBySites($begin, $end);
        $pathologieByTranche = self::getPathologieByTranche($begin, $end);
        $getGlobalStats = self::getGlobalStats($begin, $end);


        //echo('<pre>'); die(print_r($bySexe));




        return view('home', [
            'projets' => $projets,
            'sites' => $sites,
            'dataPoints' => $chartData,
            'byTypeContrat' => $byTypeContrat,
            'bySexe' => $bySexe,
            'byCouverture' => $byCouverture,
            'statByPathologie' => $statByPathologie,
            'statByPathologieAndGenre' => $statByPathologieAndGenre,
            'statByPathologieAndContagieux' => $statByPathologieAndContagieux,
            'arretsBySite' => $arretsBySite,
            'arretsByTranche' => $arretsByTranche,
            'pathologieByTranche' => $pathologieByTranche,
            'accidentsBySite' => $accidentsBySite,
            'byMaladiePro' => $byMaladiePro,
            'test' => $test,
            'byAccident' => $byAccident,
            'byMaladieCon' => $byMaladieCon,
            'getGlobalStats' =>  $getGlobalStats

        ]);
    }

    public function filter(Request $request)
    {

        //echo'<pre>';die(print_r($_GET));
        $begin =$request->datedebut;
        $end = $request->datefin;
        $projets =  Projet::all();
        $sites = Site::all();
        $projetsRequest = $request->projetSelected;
        $sitesRequest = $request->siteConsultation;
        $test = "yes";
//dd($sitesRequest);

if (isset($sitesRequest) && is_numeric($sitesRequest)) {
    $siteSelected = $sitesRequest;
    if (isset($projetsRequest)) {
        $projetSelected = $projetsRequest;
    } else {
        $projetSelected = Projet::where('site_id', $siteSelected)->pluck('id')->toArray();
    }
} else {
    $siteSelected = null;
    $projetSelected = null;
}


//  dd( $siteSelected);


        $chartData = self::getStatsByMedecin($begin, $end, $siteSelected);
        $byTypeContrat = self::getArretByTypeContrat($begin, $end, $siteSelected, $projetSelected);
        $bySexe = self::getArretBySexe($begin, $end, $siteSelected, $projetSelected);
        $arretsByTranche = self::getArretByTranche($begin, $end, $siteSelected, $projetSelected);
        $byCouverture = self::getArretByCouverture($begin, $end, $siteSelected, $projetSelected);
        $byMaladiePro = self::getArretByMaladiePro($begin, $end, $siteSelected, $projetSelected);
        $byAccident = self::getArretByAccident($begin, $end, $siteSelected, $projetSelected);
        $byMaladieCon = self::getArretByMaladieProCon($begin, $end, $siteSelected, $projetSelected);
        $statByPathologie = self::getConsultationsByMotif($begin, $end, $siteSelected, $projetSelected);
        $statByPathologieAndGenre = self::getConsultationsByMotifAndGenre($begin, $end, $siteSelected, $projetSelected);
        $statByPathologieAndContagieux = self::getConsultationsByContagieux($begin, $end, $siteSelected, $projetSelected);
        $arretsBySite = self::getArretsBySites($begin, $end, $siteSelected, $projetSelected);
        $accidentsBySite = self::getAccidentsBySites($begin, $end, $siteSelected, $projetSelected);
        $pathologieByTranche = self::getPathologieByTranche($begin, $end, $siteSelected, $projetSelected);
        $getGlobalStats = self::getGlobalStats($begin, $end, $siteSelected, $projetSelected);

       // echo('<pre>'); die(print_r($accidentsBySite));

        $theSite = '';
        $theprojet ="";




        if(isset($_GET['siteSelected'])){
            $theSite = $_GET['siteSelected'];
        }
        if(isset($_GET['projetSelected'])){
            $theprojet = $_GET['projetSelected'];
        }



        $periode = date('d/m/Y', strtotime($begin)). ' - ' .date('d/m/Y', strtotime($end));



        return view('home', [
            'projets' => $projets,
            'sites' => $sites,
            'theSite' => $theSite,
            'theprojet' =>$theprojet,
            'periode' => $periode,
            'dataPoints' => $chartData,
            'byTypeContrat' => $byTypeContrat,
            'bySexe' => $bySexe,
            'byCouverture' => $byCouverture,
            'statByPathologie' => $statByPathologie,
            'statByPathologieAndGenre' => $statByPathologieAndGenre,
            'statByPathologieAndContagieux' => $statByPathologieAndContagieux,
            'arretsBySite' => $arretsBySite,
            'accidentsBySite' => $accidentsBySite,
            'arretsByTranche' => $arretsByTranche,
            'pathologieByTranche' => $pathologieByTranche,
            'byMaladiePro'=> $byMaladiePro,
            'byAccident' => $byAccident,
            'byMaladieCon' => $byMaladieCon,
            'test' => $test,
            'getGlobalStats'=> $getGlobalStats
        ]);
    }

    public function getStatsByMedecin($begin, $end, $siteSelected = null, $projetSelected = null){


      //  dd($siteSelected);

        $users =  User::role('Corps médical')->get();

        if(isset($siteSelected)){
            $users = DB::table('users')
            ->join('consultations', 'users.id', '=', 'consultations.user_id')
            ->select('users.*',  'users.name')
            ->where('consultations.siteConsultation', $siteSelected)
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
          ;

            if (isset($projetSelected)){
               $users = $users->whereIn('consultations.projet_id', $projetSelected)
               ->distinct()
               ->get();
            }else{
                $projetSelected = Projet::where('site_id', $siteSelected)->get();
                $users = $users->whereIn('consultations.projet_id', $projetSelected)
                ->distinct()
                ->get();
            }
        }

    //  dd($siteSelected, $users->get());

        $chartData = array();


        foreach ($users as $key => $user) {

            $chartData[$key]['y'] = $user->name;
            $chartData[$key]['a'] = 0;
            $chartData[$key]['b'] = 0;

            $consultations =  DB::table('consultations')
                ->where('typeConsultation', 'Interne')
                ->where('user_id',$user->id)
                ->where('typeConsultation', 'Interne' )
                ->whereDate('dateConsultation', '>=', $begin)
                ->whereDate('dateConsultation', '<=', $end)
                ->get();

          //  dd($consultations);

            if(!empty($consultations)){
                foreach ($consultations as $consultation) {
                    if(is_null($siteSelected) OR $siteSelected == $consultation->siteConsultation){
                        if(is_null($projetSelected) OR $projetSelected = $consultation->projet_id){
                            $chartData[$key]['a'] += 1;
                            if($consultation->typeArrêt <> 'non'){
                                $chartData[$key]['b'] += 1;
                            }
                        }
                    }
                }
            }
        }

        return $chartData;

    }
    public function getArretByTypeContrat($begin, $end, $siteSelected = null, $projetSelected = null){
        $contrats = Contrat::all();

        $arrayContrat = array();

        foreach ($contrats as $key => $contrat) {
            $query = DB::table('consultations')
                ->join('agents', 'consultations.agent_id', '=', 'agents.id')
                ->whereDate('consultations.dateConsultation', '>=', $begin)
                ->whereDate('consultations.dateConsultation', '<=', $end)
                ->where('consultations.typeArrêt', '<>', 'non')
                ->where('agents.contrat_id', '=', $contrat->id);

            if(isset($siteSelected)){
                $query->where('siteConsultation', $siteSelected);
            }
            if(isset($projetSelected)){
                $query->whereIn('consultations.projet_id', $projetSelected);
            }
            $nombre = $query->get();

            $arrayContrat[$key]['label'] = $contrat->designation;
            $arrayContrat[$key]['value'] = sizeof($nombre);

        }

        return $arrayContrat;
    }
    public function getArretBySexe($begin, $end, $siteSelected = null, $projetSelected = null){

        $array = array();

        $queryMasculin = DB::table('consultations')
            ->join('agents', 'consultations.agent_id', '=', 'agents.id')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
            ->where('consultations.typeArrêt', '<>', 'non')
            ->where('agents.sexe', '=', 'M');



        $queryFeminin = DB::table('consultations')
            ->join('agents', 'consultations.agent_id', '=', 'agents.id')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
            ->where('consultations.typeArrêt', '<>', 'non')
            ->where('agents.sexe', '=', 'F');

        if(isset($siteSelected)){
            $queryFeminin->where('consultations.siteConsultation', '=', $siteSelected);
            $queryMasculin->where('consultations.siteConsultation', '=', $siteSelected);
        }

        if(isset($projetSelected) && is_array($projetSelected) && count($projetSelected) > 0){
            $projetSelected = Projet::where('site_id', $siteSelected)->get();
            $queryMasculin->whereIn('consultations.projet_id',  $projetSelected);
            $queryFeminin->whereIn('consultations.projet_id',  $projetSelected);
       }



        $masculin = $queryMasculin->get();
        $feminin = $queryFeminin->get();

        $array[0]['label'] = 'Masculin';
        $array[0]['value'] = sizeof($masculin);

        $array[1]['label'] = 'Féminin';
        $array[1]['value'] = sizeof($feminin);

        return $array;
    }
    public function getArretByTranche($begin, $end, $siteSelected = null, $projetSelected = null){

        $array = array();

        $query = DB::table('consultations')
            ->join('agents', 'consultations.agent_id', '=', 'agents.id')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)

            ;

        if(isset($siteSelected)){
            $query->where('consultations.siteConsultation', '=', $siteSelected);
        }

        if(isset($projetSelected) && is_array($projetSelected) && count($projetSelected) > 0){
            $query->where('consultations.projet_id', '=', $projetSelected);
        }

        $consultations = $query->get();


        //echo('<pre>'); die(print_r($consultations));

        $array[0]['y'] = '18 - 25';
        $array[0]['a'] = 0;
        $array[0]['b'] = 0;

        $array[1]['y'] = '25 - 30';
        $array[1]['a'] = 0;
        $array[1]['b'] = 0;

        $array[2]['y'] = '> 30';
        $array[2]['a'] = 0;
        $array[2]['b'] = 0;

        foreach ($consultations as $consultation) {
            $agent = Agent::where('id', '=', $consultation->agent_id)->first();
            $age = date('Y') - date('Y', strtotime($agent->dateNaissance));


            if($age < 25){
                $array[0]['a'] += 1;
                if($consultation->typeArrêt <> 'non' ){
                    $array[0]['b'] += 1;
                }
            }elseif ($age > 25 AND $age < 30){
                $array[1]['a'] += 1;
                if($consultation->typeArrêt <> 'non'){
                    $array[1]['b'] += 1;
                }
            }else{
                $array[2]['a'] += 1;
                if($consultation->typeArrêt <> 'non'){
                    $array[2]['b'] += 1;
                }
            }
        }

        //echo('<pre>'); die(print_r($array));

        return $array;
    }
    public function getArretByCouverture($begin, $end, $siteSelected = null, $projetSelected = null){

        $chartData = array();


        $queryOui = DB::table('consultations')
            ->join('agents', 'consultations.agent_id', '=', 'agents.id')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
            ->where('consultations.typeArrêt', '<>', 'non')
            ->where('agents.contrat_id', '=', '1');


        $queryNon = DB::table('consultations')
              ->join('agents', 'consultations.agent_id', '=', 'agents.id')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
            ->where('consultations.typeArrêt', '<>', 'non')
            ->where('agents.contrat_id', '<>', '1');




        if(isset($siteSelected)){
            $queryOui->where('consultations.siteConsultation', $siteSelected);
            $queryNon->where('consultations.siteConsultation', $siteSelected);
        }



        if(isset($projetSelected) && is_array($projetSelected) && count($projetSelected) > 0){
            $queryOui->whereIn('consultations.projet_id', $projetSelected);
            $queryNon->whereIn('consultations.projet_id', $projetSelected);
        }


     //   dd($queryNon, $queryOui);



        $oui = $queryOui->get();
        $non = $queryNon->get();

        $chartData[0]['y'] = 'Oui';
        $chartData[0]['a'] = sizeof($oui);

        $chartData[1]['y'] = 'Non';
        $chartData[1]['a'] = sizeof($non);



    // dd($oui, $non,  $chartData[1]['y'], $chartData[1]['a'] );


        return $chartData;
    }
    public function getArretByMaladiePro($begin, $end, $siteSelected =null, $projetSelected = null){

        $chartData = array();

        $queryOui = DB::table('consultations')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
            ->where('consultations.typeArrêt', '<>', 'non')
            ->where('consultations.maladie_prof', '=', 'oui');


            $queryNon = DB::table('consultations')
            ->where(function($query) use ($begin, $end) {
                $query->where('consultations.maladie_prof', 'non')
                        ->orWhereNull('consultations.maladie_prof');
            })
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
            ->where('consultations.typeArrêt', '<>', 'non');



        if(isset($siteSelected)){
             $queryOui->where('siteConsultation',  $siteSelected);
             $queryNon->where('siteConsultation',  $siteSelected);
        }

     //   dd($siteSelected, $queryNon->get());
        if(isset($projetSelected) && is_array($projetSelected) && count($projetSelected) > 0) {
            $queryOui->whereIn('projet_id', $projetSelected);
            $queryNon->whereIn('projet_id', $projetSelected);
        }



        $oui = $queryOui->get();
        $non = $queryNon->get();

        $chartData[0]['y'] = 'Oui';
        $chartData[0]['a'] = sizeof($oui);

        $chartData[]['y'] = 'Non';
        $chartData[1]['a'] = sizeof($non);
      //  dd($chartData);

        return $chartData;
    }
    public function getArretByAccident($begin, $end, $siteSelected =null, $projetSelected = null){

        $chartData = array();

        $queryOui = DB::table('consultations')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
            ->where('consultations.typeArrêt', '<>', 'non')
            ->where('consultations.accidentPro', '=', 'oui');


        $queryNon = DB::table('consultations')
        ->where(function($query) use ($begin, $end) {
            $query->where('consultations.accidentPro', 'non')
                    ->orWhereNull('consultations.accidentPro');
        })
        ->whereDate('consultations.dateConsultation', '>=', $begin)
        ->whereDate('consultations.dateConsultation', '<=', $end)
        ->where('consultations.typeArrêt', '<>', 'non');

        if(!is_null($siteSelected)){
             $queryOui->where('consultations.siteConsultation', '=', $siteSelected);
             $queryNon->where('consultations.siteConsultation', '=', $siteSelected);
        }



        if(isset($projetSelected) && is_array($projetSelected) && count($projetSelected) > 0){
            $queryOui->whereIn('consultations.projet_id', $projetSelected);
            $queryNon->whereIn('consultations.projet_id', $projetSelected);
        }




        $oui = $queryOui->get();
        $non = $queryNon->get();

        $chartData[0]['y'] = 'Oui';
        $chartData[0]['a'] = sizeof($oui);

        $chartData[]['y'] = 'Non';
        $chartData[1]['a'] = sizeof($non);


        return $chartData;
    }
    public function getArretByMaladieProCon($begin, $end, $siteSelected =null, $projetSelected = null){

        $chartData = array();

        $queryOui = DB::table('consultations')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
            ->where('consultations.typeArrêt', '<>', 'non')
            ->where('consultations.maladie_contagieuse', '=', 'oui');


        $queryNon = DB::table('consultations')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
            ->where('consultations.typeArrêt', '<>', 'non')
            ->where('consultations.maladie_contagieuse', '=', 'non');

            if(isset($siteSelected)){
                $queryOui->where('siteConsultation',  $siteSelected);
                $queryNon->where('siteConsultation',  $siteSelected);
           }
           if(isset($projetSelected) && is_array($projetSelected) && count($projetSelected) > 0){
            $queryOui->whereIn('consultations.projet_id', $projetSelected);
            $queryNon->whereIn('consultations.projet_id', $projetSelected);
        }

        $oui = $queryOui->get();
        $non = $queryNon->get();

        $chartData[0]['y'] = 'Oui';
        $chartData[0]['a'] = sizeof($oui);

        $chartData[]['y'] = 'Non';
        $chartData[1]['a'] = sizeof($non);

        //dd($chartData);
        return $chartData;
    }
    public function getConsultationsByMotif($begin, $end, $siteSelected = null, $projetSelected = null){

        $motifs = Motif_consultation::all();
        $returnArray = array();

        foreach ($motifs as $key => $motif) {

            $query =  DB::table('consultations')
                ->whereDate('dateConsultation', '>=', $begin)
                ->whereDate('dateConsultation', '<=', $end)
                ->where('motif_consultation_id', '=', $motif->id);

                if(isset($siteSelected)){
                    $query->where('siteConsultation',  $siteSelected);

               }
               if(isset($projetSelected) && is_array($projetSelected) && count($projetSelected) > 0){
                   $query->whereIn('projet_id',  $projetSelected);

              }

            $consultations = $query->get();

           // dd($consultations);

            if(sizeof($consultations) > 0){
                $returnArray[$key]['Motif'] = $motif->intitule;
                $returnArray[$key]['Consultation'] = sizeof($consultations);


                $queryArrets =  DB::table('consultations')
                     ->where('typeArrêt', '<>', 'non')
                    ->whereDate('dateConsultation', '>=', $begin)
                    ->whereDate('dateConsultation', '<=', $end)
                    ->where('motif_consultation_id', '=', $motif->id);

                    if(isset($siteSelected)){
                        $queryArrets->where('siteConsultation',  $siteSelected);

                   }

                  if(isset($projetSelected) && is_array($projetSelected) && count($projetSelected) > 0){
                    $queryArrets->whereIn('projet_id',  $projetSelected);
                }

                $arrets = $queryArrets->get();

                $returnArray[$key]['Arret'] = sizeof($arrets);
            }

        }
        return $returnArray;
    }
    public function getConsultationsByMotifAndGenre($begin, $end, $siteSelected = null, $projetSelected = null){
        $motifs = Motif_consultation::all();

        $returnArray = array();

        $returnArray['Féminin']['TotalConsultation'] = 0;
        $returnArray['Féminin']['TotalArret'] = 0;
        $returnArray['Masculin']['TotalConsultation'] = 0;
        $returnArray['Masculin']['TotalArret'] = 0;

        foreach ($motifs as $key => $motif) {

            $queryFemme =  DB::table('consultations')
                ->join('agents', 'consultations.agent_id', '=', 'agents.id')
                ->whereDate('dateConsultation', '>=', $begin)
                ->whereDate('dateConsultation', '<=', $end)
                ->where('agents.sexe', '=', 'F')
                ->where('motif_consultation_id', '=', $motif->id);

            if(isset($siteSelected)){
                $queryFemme->where('consultations.siteConsultation', '=', $siteSelected);
            }

            if(isset($projetSelected) && is_array($projetSelected) && count($projetSelected) > 0){
                $queryFemme->whereIn('consultations.projet_id', $projetSelected);
            }



            $queryHomme =  DB::table('consultations')
                ->join('agents', 'consultations.agent_id', '=', 'agents.id')
                ->whereDate('dateConsultation', '>=', $begin)
                ->whereDate('dateConsultation', '<=', $end)
                ->where('agents.sexe', '=', 'M')
                ->where('motif_consultation_id', '=', $motif->id);

            if(isset($siteSelected)){
                $queryHomme->where('consultations.siteConsultation', '=', $siteSelected);
            }


            if(isset($projetSelected) && is_array($projetSelected) && count($projetSelected) > 0){
                $queryHomme->whereIn('consultations.projet_id', $projetSelected);
            }

            $consultationsHomme = $queryHomme->get();
            $consultationsFemme = $queryFemme->get();

            if(sizeof($consultationsFemme) > 0){
                $returnArray['Féminin']["stats"][$key]['Motif'] = $motif->intitule;
                $returnArray['Féminin']["stats"][$key]['Consultation'] = sizeof($consultationsFemme);

                $queryArrets =  DB::table('consultations')
                     ->join('agents', 'consultations.agent_id', '=', 'agents.id')
                    ->whereDate('dateConsultation', '>=', $begin)
                    ->whereDate('dateConsultation', '<=', $end)
                    ->where('typeArrêt', '<>', 'non')
                    ->where('agents.sexe', '=', 'F')
                    ->where('motif_consultation_id', '=', $motif->id);

                if(isset($siteSelected)){
                    $queryArrets->where('consultations.siteConsultation', $siteSelected);
                }

                if(isset($projetSelected) && is_array($projetSelected) && count($projetSelected) > 0){
                    $queryArrets->whereIn('consultations.projet_id', $projetSelected);
                }


                $arrets = $queryArrets->get();

                $returnArray['Féminin']["stats"][$key]['Arret'] = sizeof($arrets);
                $returnArray['Féminin']['TotalConsultation'] += sizeof($consultationsFemme);
                $returnArray['Féminin']['TotalArret'] += sizeof($arrets);
            }

            if(sizeof($consultationsHomme) > 0){

                $returnArray['Masculin']["stats"][$key]['Motif'] = $motif->intitule;
                $returnArray['Masculin']["stats"][$key]['Consultation'] = sizeof($consultationsHomme);


                $queryArrets2 =  DB::table('consultations')
                    ->join('agents', 'consultations.agent_id', '=', 'agents.id')
                    ->whereDate('dateConsultation', '>=', $begin)
                    ->whereDate('dateConsultation', '<=', $end)
                    ->where('typeArrêt', '<>', 'non')
                    ->where('agents.sexe', '=', 'M')
                    ->where('motif_consultation_id', '=', $motif->id);

                if(isset($siteSelected)){
                    $queryArrets2->where('consultations.siteConsultation', $siteSelected);
                }

                if(isset($projetSelected) && is_array($projetSelected) && count($projetSelected) > 0){
                    $queryArrets2->whereIn('consultations.projet_id', $projetSelected);
                }


                $arrets = $queryArrets2->get();



                $returnArray['Masculin']["stats"][$key]['Arret'] = sizeof($arrets);
                $returnArray['Masculin']["stats"][$key]['Motif'] = $motif->intitule;
                $returnArray['Masculin']['TotalConsultation'] += sizeof($consultationsHomme);
                $returnArray['Masculin']['TotalArret'] += sizeof($arrets);
            }

        }
        return $returnArray;
    }
    public function getConsultationsByContagieux($begin, $end, $siteSelected = null, $projetSelected = null){
        $motifs = Motif_consultation::all();

        $returnArray = array();

        foreach ($motifs as $key => $motif) {


            $query =  DB::table('consultations')
                ->where('consultations.typeConsultation', '=', 'Interne')
                ->whereDate('dateConsultation', '>=', $begin)
                ->whereDate('dateConsultation', '<=', $end)
                ->where('maladie_contagieuse', '=', 'oui');

            if(!is_null($siteSelected)){
                $query->where('consultations.siteConsultation', '=', $siteSelected);
            }

            if(isset($projetSelected) && is_array($projetSelected) && count($projetSelected) > 0){
                $query->whereIn('consultations.projet_id', $projetSelected);
            }

            $consultations = $query->get();



            if(sizeof($consultations) > 0){
                $returnArray[$key]['Consultation'] = sizeof($consultations);


                $queryArrets =  DB::table('consultations')
                    ->where('consultations.typeConsultation', '=', 'Externe')
                    ->whereDate('dateConsultation', '>=', $begin)
                    ->whereDate('dateConsultation', '<=', $end)
                    ->where('typeArrêt', '<>', 'non');

                if(!is_null($siteSelected)){
                    $queryArrets->where('consultations.siteConsultation', '=', $siteSelected);
                }

                if(isset($projetSelected) && is_array($projetSelected) && count($projetSelected) > 0){
                    $queryArrets->where('consultations.projet_id', '=', $projetSelected);
                }

                $arrets = $queryArrets->get();

                $returnArray[$key]['Arret'] = sizeof($arrets);
            }

        }
        return $returnArray;
    }
    public function getArretsBySites($begin, $end, $siteSelected = null, $projetSelected = null){
        $sites = Site::all();
        $projet = Projet::all();
        $days = 0;
        $mins = 0;
        $hours = 0;
        $returnArray = array();
        $returnArray['Externe']['TotalConsultation'] = 0;
        $returnArray['Externe']['TotalArret'] = 0;
        $returnArray['Interne']['TotalConsultation'] = 0;
        $returnArray['Interne']['TotalArret'] = 0;



        if (isset($siteSelected) AND $siteSelected <>"all"){

          $sites = Site::where('id', $siteSelected)->get();
            if (isset($projetSelected)){
                $projetSelected = $projetSelected;
            }else{
                $projetSelected= Projet::where('site_id', $siteSelected)->get();
            }
        }else{
            $sites = Site::all();
            $projetSelected = Projet::all();
        }

        if ($sites !== null && is_object($sites)) {

            foreach ($sites as $key => $site) {
                //dd($sites, $site->id);
                $queryExterne =  DB::table('consultations')
                    ->where('typeConsultation', '=', 'Externe')
                    ->whereDate('dateConsultation', '>=', $begin)
                    ->whereDate('dateConsultation', '<=', $end)
                    ->where('siteConsultation', '=', $site->id)
                    ->where('typeArrêt', '<>', 'non');


                $queryInterne =  DB::table('consultations')
                    ->where('typeConsultation', '=', 'Interne')
                    ->whereDate('dateConsultation', '>=', $begin)
                    ->whereDate('dateConsultation', '<=', $end)
                    ->where('siteConsultation', '=', $site->id)
                    ->where('typeArrêt', '<>', 'non');

                $consultationInterne = $queryInterne->get();
                $consultationExterne = $queryExterne->get();

                if(!is_null($projetSelected)){
                    $consultationInterne->whereIn('consultations.projet_id', $projetSelected);
                }

                if(isset($projetSelected) && is_array($projetSelected) && count($projetSelected) > 0){
                    $consultationExterne->whereIn('consultations.projet_id', $projetSelected);
                }

                if(sizeof($consultationExterne) > 0){
                    $returnArray['Externe']["stats"][$key]['Site'] = $site->designation;
                    $returnArray['Externe']["stats"][$key]['Consultation'] = sizeof($consultationExterne);

                    $nbreJrs = 0;

                    foreach ($consultationExterne as $arret) {
                        $nbreJrs += $arret->duree_arret;
                    }

                        if((int)$nbreJrs > 24){
                        $days = 0;
                        $hours = floor (($nbreJrs - $days * 1440) / 60);
                        $mins = $nbreJrs - ($days * 1440) - ($hours * 60);
                        }

                    $returnArray['Externe']["stats"][$key]['Arret'] = $hours." h ".$mins." m";
                    $returnArray['Externe']['TotalConsultation'] += sizeof($consultationExterne);
                    $returnArray['Externe']['TotalArret'] += $nbreJrs;
                }

                if(sizeof($consultationInterne) > 0){
                    $returnArray['Interne']["stats"][$key]['Site'] = $site->designation;
                    $returnArray['Interne']["stats"][$key]['Consultation'] = sizeof($consultationInterne);

                    $nbreJrs = 0;

                    foreach ($consultationInterne as $arret) {

                        $nbreJrs += $arret->duree_arret;
                    }

                    if((int)$nbreJrs > 24){
                        $days = 0;
                        $hours = floor (($nbreJrs - $days * 1440) / 60);
                        $mins = $nbreJrs - ($days * 1440) - ($hours * 60);
                    }

                    $returnArray['Interne']["stats"][$key]['Arret'] = $hours." h ".$mins." m";
                    $returnArray['Interne']['TotalConsultation'] += sizeof($consultationInterne);
                    $returnArray['Interne']['TotalArret'] += $nbreJrs;
                }

            }

        }


        return ($returnArray );
    }
    public function getAccidentsBySites($begin, $end, $siteSelected = null, $projetSelected =null){
        $sites = Site::all();
        $projetSelected = Projet::all();


        $returnArray = array();


        $returnArray['Interne']['TotalConsultation'] = 0;
        $returnArray['Interne']['TotalArret'] = 0;

        foreach ($sites as $key => $site) {

            $queryInterne =  DB::table('consultations')
                ->where('typeConsultation', '=', 'Interne')
                ->whereDate('dateConsultation', '>=', $begin)
                ->whereDate('dateConsultation', '<=', $end)
                ->where('accidentPro', '=', 'oui')
                ->where('siteConsultation', '=', $site->id);

            if(isset($projetSelected) && is_array($projetSelected) && count($projetSelected) > 0){
                $queryInterne->where('consultations.projet_id', '=', $projetSelected);
            }

            $consultationInterne = $queryInterne->get();




            if(sizeof($consultationInterne) > 0){
                $returnArray['Interne']["stats"][$key]['Site'] = $site->designation;
                $returnArray['Interne']["stats"][$key]['Consultation'] = sizeof($consultationInterne);

                $nbreJrs = 0;

                foreach ($consultationInterne as $arret) {
                    $nbreJrs += $arret->duree_arret;
                }

                $returnArray['Interne']["stats"][$key]['Arret'] = $nbreJrs;

                $returnArray['Interne']['TotalConsultation'] += sizeof($consultationInterne);
                $returnArray['Interne']['TotalArret'] += $nbreJrs;
            }

        }

        return $returnArray;
    }
    public function getGlobalStats($begin, $end,  $siteSelected = null,  $projetSelected =null){


        $queryConsultation = DB::table('consultations')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
            ;


        $queryArret = DB::table('consultations')
        ->whereDate('consultations.dateConsultation', '>=', $begin)
        ->whereDate('consultations.dateConsultation', '<=', $end)
        ->where('consultations.typeArrêt', '<>', 'non');

        $queryInterne = DB::table('consultations')
        ->whereDate('consultations.dateConsultation', '>=', $begin)
        ->whereDate('consultations.dateConsultation', '<=', $end)
        ->where('consultations.typeConsultation', '=', 'Interne');


       //  dd($queryConsultation->get(), $queryArret->get(), $queryInterne->get());

        // dd($siteSelected);

        if(isset($siteSelected)){
            $queryConsultation =  $queryConsultation->where('consultations.siteConsultation', $siteSelected);
            $queryArret= $queryArret->where('consultations.siteConsultation', $siteSelected);
            $queryInterne= $queryInterne->where('consultations.siteConsultation', $siteSelected);

        };





        if(isset($projetSelected) && is_array($projetSelected) && count($projetSelected) > 0){
            $queryConsultation =   $queryConsultation->whereIn('consultations.projet_id', $projetSelected);
            $queryArret = $queryArret->whereIn('consultations.projet_id', $projetSelected);
            $queryInterne = $queryInterne->whereIn('consultations.projet_id', $projetSelected);

        };


      //  dd($queryConsultation->get(), $queryInterne->get(), $queryArret->get(), $siteSelected, $projetSelected);
     //

        $nbreConsultations =$queryConsultation->get();
        $nbreArrets =$queryArret->get();
        $queryInterne = $queryInterne->get();


        if(sizeof($nbreArrets) > 0){

            $totalMinutes = 0;

            foreach ($nbreArrets as $arret) {
                $totalMinutes += $arret->duree_arret;
            }
            $heures= floor($totalMinutes / 60);
            $minutes = $totalMinutes % 60;

        }else{
            $heures= 0;
            $minutes = 0;

        }






        if (sizeof($nbreConsultations)<> 0) {
            $resultatperInterne = round(100*sizeof($queryInterne)/sizeof($nbreConsultations),2);
            $resultatperExterne = round(100 - $resultatperInterne, 2);
        } else {

            $resultatperInterne = 0;
            $resultatperExterne = 0;

        }

        $returnArray['nbreConsultations'] = sizeof($nbreConsultations);
        $returnArray['nbreArrets'] = sizeof($nbreArrets);
        $returnArray['perInterne'] =$resultatperInterne;
        $returnArray['perExterne'] =$resultatperExterne;
        $returnArray['heure'] = $heures;
        $returnArray['minute'] = $minutes;

    // dd( $returnArray['nbreConsultations'],  $returnArray['nbreArrets'],  $returnArray['perInterne'], $returnArray['perExterne'],  $returnArray['heure'] ,  $returnArray['minute'] );

        return $returnArray;


    }
    public function getPathologieByTranche($begin, $end, $siteSelected = null, $projetSelected = null){

        $query = DB::table('consultations')
            ->join('agents', 'consultations.agent_id', '=', 'agents.id')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end);


        if(isset($siteSelected)){
            $query->where('consultations.siteConsultation', $siteSelected);
        }

        if(isset($projetSelected) && is_array($projetSelected) && count($projetSelected) > 0){
            $query->whereIn('consultations.projet_id', $projetSelected);
        }

        $consultations = $query->get();

        $bigArray = array();

        foreach ($consultations as $consultation) {
            $age = date('Y') - date('Y', strtotime($consultation->dateNaissance));

            if($age < 25){
                $key = '18 - 25';
            }elseif ($age > 25 AND $age < 30){
                $key = '25 - 30';
            }else{
                $key = '> 30';
            }

            if(isset($bigArray[$key][$consultation->motif_consultation_id])){
                $bigArray[$key][$consultation->motif_consultation_id]['Consultation'] += 1;
                if($consultation->typeArrêt <> 'non') {
                    $bigArray[$key][$consultation->motif_consultation_id]['Arret'] += 1;
                }
            }else{
                $pathologie = Motif_consultation::find($consultation->motif_consultation_id);
                $bigArray[$key][$consultation->motif_consultation_id]['Pathologie'] = $pathologie->intitule;
                $bigArray[$key][$consultation->motif_consultation_id]['Consultation'] = 1;
                if($consultation->typeArrêt <> 'non') {
                    $bigArray[$key][$consultation->motif_consultation_id]['Arret'] = 1;
                }else{
                    $bigArray[$key][$consultation->motif_consultation_id]['Arret'] = 0;
                }
            }
        }

        //echo('<pre>'); die(print_r($bigArray));

        $array = array();

        foreach ($bigArray as $key => $items) {
            //if(!empty($items)){
                $totalConsultation = 0;
                $totalArret = 0;
                foreach ($items as $item) {
                    //echo('<pre>'); die(print_r($item));
                    $totalConsultation += $item['Consultation'];
                    $totalArret += $item['Arret'];
                }


                $array[$key]['Consultation'] = $totalConsultation;
                $array[$key]['Arret'] = $totalArret;
                $array[$key]['Items'] = $items;


        }
        //echo('<pre>'); die(print_r($array));

        //echo('<pre>'); die(print_r($bigArray));

        return $array;
    }
        public function export()
    {
        return Excel::download(new ConsultationsExport, 'invoices.xlsx');
    }
    public function findProjet (Request $request){
        $p=Projet::select('id', 'designation')->where('site_id',$request->id)->take(100)->get();
        return response()->json($p);
    }
}



