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


        $statByPathologie = self::getConsultationsByMotif($begin, $end);

        $statByPathologieAndGenre = self::getConsultationsByMotifAndGenre($begin, $end);

        $statByPathologieAndContagieux = self::getConsultationsByContagieux($begin, $end);

        $arretsBySite = self::getArretsBySites($begin, $end);

        $accidentsBySite = self::getAccidentsBySites($begin, $end);

        $pathologieByTranche = self::getPathologieByTranche($begin, $end);


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
        ]);
    }

    public function filter(Request $request)
    {

        //echo'<pre>';die(print_r($_POST));
        $projets = Projet::all();
        $sites = Site::all();


        if(isset($_POST['datefilter']) AND $_POST['datefilter'] != ''){
            $temp = explode(' - ', $_POST['datefilter']);

            $begin = date('Y-m-d', strtotime($temp[0]));
            $end = date('Y-m-d', strtotime($temp[1]));
        }else{
            $begin = date('Y-m-d');
            $end = date('Y-m-d');
        }

        if(isset($_POST['siteSelected']) AND $_POST['siteSelected'] != 'all' AND is_numeric($_POST['siteSelected'])){
            $siteSelected = $_POST['siteSelected'];
            $projetSelected = Site::where('site_id', '=', $siteSelected);
          //  dd($projetSelected);

        }else{
            $siteSelected = null;
        }

        if(isset($_POST['projetSelected']) AND $_POST['projetSelected'] != 'all' AND is_numeric($_POST['projetSelected'])){
            $projetSelected = $_POST['projetSelected'];
        }else{
            $projetSelected = null;
        }



        $chartData = self::getStatsByMedecin($begin, $end, $siteSelected, $projetSelected);
        //echo'<pre>';die(print_r($chartData));

        $byTypeContrat = self::getArretByTypeContrat($begin, $end, $siteSelected, $projetSelected);

        $bySexe = self::getArretBySexe($begin, $end, $siteSelected, $projetSelected);

        $arretsByTranche = self::getArretByTranche($begin, $end, $siteSelected, $projetSelected);

        $byCouverture = self::getArretByCouverture($begin, $end, $siteSelected, $projetSelected);


        $byMaladiePro = self::getArretByMaladiePro($begin, $end, $siteSelected, $projetSelected);


        $statByPathologie = self::getConsultationsByMotif($begin, $end, $siteSelected, $projetSelected);

        $statByPathologieAndGenre = self::getConsultationsByMotifAndGenre($begin, $end, $siteSelected, $projetSelected);

        $statByPathologieAndContagieux = self::getConsultationsByContagieux($begin, $end, $siteSelected, $projetSelected);

        $arretsBySite = self::getArretsBySites($begin, $end, $siteSelected, $projetSelected);

        $accidentsBySite = self::getAccidentsBySites($begin, $end, $siteSelected, $projetSelected);

        $pathologieByTranche = self::getPathologieByTranche($begin, $end, $siteSelected, $projetSelected);


       // echo('<pre>'); die(print_r($accidentsBySite));

        $theSite = '';
        $theprojet ="";

        if(isset($_POST['siteSelected'])){
            $theSite = $_POST['siteSelected'];
        }
        if(isset($_POST['projetSelected'])){
            $theprojet = $_POST['projetSelected'];
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
            'byMaladiePro'=> $byMaladiePro
        ]);
    }

    public function getStatsByMedecin($begin, $end, $site = null){
        $users = User::all();

        $chartData = array();

        foreach ($users as $key => $user) {

            $chartData[$key]['y'] = $user->name;
            $chartData[$key]['a'] = 0;
            $chartData[$key]['b'] = 0;

            $consultations =  DB::table('consultations')
                ->where('etatValidite', '=', 'valide')
                ->where('typeConsultation', '=', 'Interne')
                ->where('user_id', '=', $user->id)
                ->whereDate('dateConsultation', '>=', $begin)
                ->whereDate('dateConsultation', '<=', $end)
                ->get();

            if(!empty($consultations)){
                foreach ($consultations as $consultation) {
                    if(is_null($site)){
                        $chartData[$key]['a'] += 1;
                        if($consultation->arretMaladie == 'oui'){
                            $chartData[$key]['b'] += 1;
                        }
                    }else{
                        if($site == $consultation->natureReception){
                            $chartData[$key]['a'] += 1;
                            if($consultation->arretMaladie == 'oui'){
                                $chartData[$key]['b'] += 1;
                            }
                        }
                    }
                }
            }
        }
        return $chartData;
    }

    public function getArretByTypeContrat($begin, $end, $site = null){
        $contrats = Contrat::all();

        $arrayContrat = array();

        foreach ($contrats as $key => $contrat) {
            $query = DB::table('consultations')
                ->join('agents', 'consultations.agent_id', '=', 'agents.id')
                ->whereDate('consultations.dateConsultation', '>=', $begin)
                ->whereDate('consultations.dateConsultation', '<=', $end)
                ->where('consultations.etatValidite', '=', 'valide')
                ->where('consultations.arretMaladie', '=', 'oui')
                ->where('agents.contrat_id', '=', $contrat->id);

            if(!is_null($site)){
                $query->where('natureReception', '=', $site);
            }

            $nombre = $query->get();

            $arrayContrat[$key]['label'] = $contrat->designation;
            $arrayContrat[$key]['value'] = sizeof($nombre);

        }

        return $arrayContrat;
    }

    public function getArretBySexe($begin, $end, $site = null){

        $array = array();

        $queryMasculin = DB::table('consultations')
            ->join('agents', 'consultations.agent_id', '=', 'agents.id')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
            ->where('consultations.etatValidite', '=', 'valide')
            ->where('consultations.arretMaladie', '=', 'oui')
            ->where('agents.sexe', '=', 'M');



        $queryFeminin = DB::table('consultations')
            ->join('agents', 'consultations.agent_id', '=', 'agents.id')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
            ->where('consultations.etatValidite', '=', 'valide')
            ->where('consultations.arretMaladie', '=', 'oui')
            ->where('agents.sexe', '=', 'F');

        if(!is_null($site)){
            $queryFeminin->where('natureReception', '=', $site);
            $queryMasculin->where('natureReception', '=', $site);
        }

        $masculin = $queryMasculin->get();
        $feminin = $queryFeminin->get();

        $array[0]['label'] = 'Masculin';
        $array[0]['value'] = sizeof($masculin);

        $array[1]['label'] = 'Féminin';
        $array[1]['value'] = sizeof($feminin);

        return $array;
    }

    public function getArretByTranche($begin, $end, $site = false){

        $array = array();

        $query = DB::table('consultations')
            ->join('agents', 'consultations.agent_id', '=', 'agents.id')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
            ->where('consultations.etatValidite', '=', 'valide');

        if(!is_null($site)){
            $query->where('natureReception', '=', $site);
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
            $age = date('Y') - date('Y', strtotime($consultation->dateNaissance));

            if($age < 25){
                $array[0]['a'] += 1;
                if($consultation->arretMaladie == 'oui'){
                    $array[0]['b'] += 1;
                }
            }elseif ($age > 25 AND $age < 30){
                $array[1]['a'] += 1;
                if($consultation->arretMaladie == 'oui'){
                    $array[1]['b'] += 1;
                }
            }else{
                $array[2]['a'] += 1;
                if($consultation->arretMaladie == 'oui'){
                    $array[2]['b'] += 1;
                }
            }
        }

        //echo('<pre>'); die(print_r($array));

        return $array;
    }

    public function getArretByCouverture($begin, $end, $site = false){

        $chartData = array();

        $queryOui = DB::table('consultations')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
            ->where('consultations.etatValidite', '=', 'valide')
            ->where('consultations.arretMaladie', '=', 'oui')
            ->where('consultations.assurance', '=', 'oui');

        $queryNon = DB::table('consultations')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
            ->where('consultations.etatValidite', '=', 'valide')
            ->where('consultations.arretMaladie', '=', 'oui')
            ->where('consultations.assurance', '=', 'non');

        if(!is_null($site)){
            $queryOui->where('natureReception', '=', $site);
            $queryNon->where('natureReception', '=', $site);
        }

        $oui = $queryOui->get();
        $non = $queryNon->get();

        $chartData[0]['y'] = 'Oui';
        $chartData[0]['a'] = sizeof($oui);

        $chartData[]['y'] = 'Non';
        $chartData[1]['a'] = sizeof($non);

        return $chartData;
    }

    public function getArretByMaladiePro($begin, $end, $site =false, $projets = false){

        $chartData = array();

        $queryOui = DB::table('consultations')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
            ->where('consultations.etatValidite', '=', 'valide')
            ->where('consultations.arretMaladie', '=', 'oui')
            ->where('consultations.maladie_prof', '=', 'oui');

        $queryNon = DB::table('consultations')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
            ->where('consultations.etatValidite', '=', 'valide')
            ->where('consultations.arretMaladie', '=', 'oui')
            ->where('consultations.maladie_prof', '=', 'non');

        if(!is_null($site)){
             if(!is_null($projets)){
                 $queryOui->where('natureReception', '=', $site)->where('projet_id', '=', $projets);
                 $queryNon->where('natureReception', '=', $site)->where('projet_id', '=', $projets);
             }
             $queryOui->where('natureReception', '=', $site);
             $queryNon->where('natureReception', '=', $site);
        }

        $oui = $queryOui->get();
        $non = $queryNon->get();

        $chartData[0]['y'] = 'Oui';
        $chartData[0]['a'] = sizeof($oui);

        $chartData[]['y'] = 'Non';
        $chartData[1]['a'] = sizeof($non);

        return $chartData;
    }

    public function getConsultationsByMotif($begin, $end, $site = false){
        $motifs = Motif_consultation::all();

        $returnArray = array();

        foreach ($motifs as $key => $motif) {



            $query =  DB::table('consultations')
                ->where('etatValidite', '=', 'valide')
                ->whereDate('dateConsultation', '>=', $begin)
                ->whereDate('dateConsultation', '<=', $end)
                ->where('motif_consultation_id', '=', $motif->id);

            if(!is_null($site)){
                $query->where('natureReception', '=', $site);
            }

            $consultations = $query->get();

            if(sizeof($consultations) > 0){
                $returnArray[$key]['Motif'] = $motif->intitule;
                $returnArray[$key]['Consultation'] = sizeof($consultations);


                $queryArrets =  DB::table('consultations')
                    ->where('consultations.etatValidite', '=', 'valide')
                    ->whereDate('dateConsultation', '>=', $begin)
                    ->whereDate('dateConsultation', '<=', $end)
                    ->where('arretMaladie', '=', 'oui')
                    ->where('motif_consultation_id', '=', $motif->id);

                if(!is_null($site)){
                    $queryArrets->where('natureReception', '=', $site);
                }

                $arrets = $queryArrets->get();

                $returnArray[$key]['Arret'] = sizeof($arrets);
            }

        }
        return $returnArray;
    }

    public function getConsultationsByMotifAndGenre($begin, $end, $site = false){
        $motifs = Motif_consultation::all();

        $returnArray = array();

        $returnArray['Féminin']['TotalConsultation'] = 0;
        $returnArray['Féminin']['TotalArret'] = 0;
        $returnArray['Masculin']['TotalConsultation'] = 0;
        $returnArray['Masculin']['TotalArret'] = 0;

        foreach ($motifs as $key => $motif) {



            $queryFemme =  DB::table('consultations')
                ->join('agents', 'consultations.agent_id', '=', 'agents.id')
                ->where('consultations.etatValidite', '=', 'valide')
                ->whereDate('dateConsultation', '>=', $begin)
                ->whereDate('dateConsultation', '<=', $end)
                ->where('agents.sexe', '=', 'F')
                ->where('motif_consultation_id', '=', $motif->id);

            $queryHomme =  DB::table('consultations')
                ->join('agents', 'consultations.agent_id', '=', 'agents.id')
                ->where('consultations.etatValidite', '=', 'valide')
                ->whereDate('dateConsultation', '>=', $begin)
                ->whereDate('dateConsultation', '<=', $end)
                ->where('agents.sexe', '=', 'M')
                ->where('motif_consultation_id', '=', $motif->id);

            if(!is_null($site)){
                $queryHomme->where('natureReception', '=', $site);
                $queryFemme->where('natureReception', '=', $site);
            }

            $consultationsHomme = $queryHomme->get();
            $consultationsFemme = $queryFemme->get();

            if(sizeof($consultationsFemme) > 0){
                $returnArray['Féminin']["stats"][$key]['Motif'] = $motif->intitule;
                $returnArray['Féminin']["stats"][$key]['Consultation'] = sizeof($consultationsFemme);

                $queryArrets =  DB::table('consultations')
                     ->join('agents', 'consultations.agent_id', '=', 'agents.id')
                    ->where('consultations.etatValidite', '=', 'valide')
                    ->whereDate('dateConsultation', '>=', $begin)
                    ->whereDate('dateConsultation', '<=', $end)
                    ->where('arretMaladie', '=', 'oui')
                    ->where('agents.sexe', '=', 'F')
                    ->where('motif_consultation_id', '=', $motif->id);

                if(!is_null($site)){
                    $queryArrets->where('natureReception', '=', $site);
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
                    ->where('consultations.etatValidite', '=', 'valide')
                    ->whereDate('dateConsultation', '>=', $begin)
                    ->whereDate('dateConsultation', '<=', $end)
                    ->where('arretMaladie', '=', 'oui')
                    ->where('agents.sexe', '=', 'M')
                    ->where('motif_consultation_id', '=', $motif->id);

                if(!is_null($site)){
                    $queryArrets2->where('natureReception', '=', $site);
                }

                $arrets = $queryArrets2->get();

                $returnArray['Masculin']["stats"][$key]['Arret'] = sizeof($arrets);

                $returnArray['Masculin']['TotalConsultation'] += sizeof($consultationsHomme);
                $returnArray['Masculin']['TotalArret'] += sizeof($arrets);
            }

        }
        return $returnArray;
    }

    public function getConsultationsByContagieux($begin, $end, $site = false){
        $motifs = Motif_consultation::all();

        $returnArray = array();

        foreach ($motifs as $key => $motif) {


            $query =  DB::table('consultations')
                ->where('consultations.etatValidite', '=', 'valide')
                ->whereDate('dateConsultation', '>=', $begin)
                ->whereDate('dateConsultation', '<=', $end)
                ->where('motif_consultation_id', '=', $motif->id)
                ->where('maladie_contagieuse', '=', 'oui');

            if(!is_null($site)){
                $query->where('natureReception', '=', $site);
            }

            $consultations = $query->get();

            if(sizeof($consultations) > 0){
                $returnArray[$key]['Motif'] = $motif->intitule;
                $returnArray[$key]['Consultation'] = sizeof($consultations);


                $queryArrets =  DB::table('consultations')
                    ->where('consultations.etatValidite', '=', 'valide')
                    ->whereDate('dateConsultation', '>=', $begin)
                    ->whereDate('dateConsultation', '<=', $end)
                    ->where('arretMaladie', '=', 'oui')
                    ->where('motif_consultation_id', '=', $motif->id);

                if(!is_null($site)){
                    $queryArrets->where('natureReception', '=', $site);
                }

                $arrets = $queryArrets->get();

                $returnArray[$key]['Arret'] = sizeof($arrets);
            }

        }
        return $returnArray;
    }

    public function getArretsBySites($begin, $end, $site = null){
        $sites = Site::all();

        $returnArray = array();

        $returnArray['Externe']['TotalConsultation'] = 0;
        $returnArray['Externe']['TotalArret'] = 0;
        $returnArray['Interne']['TotalConsultation'] = 0;
        $returnArray['Interne']['TotalArret'] = 0;

        foreach ($sites as $key => $site) {

            $queryExterne =  DB::table('consultations')
                ->where('etatValidite', '=', 'valide')
                ->where('typeConsultation', '=', 'Externe')
                ->whereDate('dateConsultation', '>=', $begin)
                ->whereDate('dateConsultation', '<=', $end)
                ->where('arretMaladie', '=', 'oui')
                ->where('natureReception', '=', $site->id);

            $queryInterne =  DB::table('consultations')
                ->where('etatValidite', '=', 'valide')
                ->where('typeConsultation', '=', 'Interne')
                ->whereDate('dateConsultation', '>=', $begin)
                ->whereDate('dateConsultation', '<=', $end)
                ->where('arretMaladie', '=', 'oui')
                ->where('natureReception', '=', $site->id);

            $consultationInterne = $queryInterne->get();
            $consultationExterne = $queryExterne->get();


            if(sizeof($consultationExterne) > 0){
                $returnArray['Externe']["stats"][$key]['Site'] = $site->designation;
                $returnArray['Externe']["stats"][$key]['Consultation'] = sizeof($consultationExterne);

                $nbreJrs = 0;

                foreach ($consultationExterne as $arret) {
                    $nbreJrs += $arret->duree_arret;
                }

                $returnArray['Externe']["stats"][$key]['Arret'] = $nbreJrs;

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

                $returnArray['Interne']["stats"][$key]['Arret'] = $nbreJrs;

                $returnArray['Interne']['TotalConsultation'] += sizeof($consultationInterne);
                $returnArray['Interne']['TotalArret'] += $nbreJrs;
            }

        }

        return $returnArray;
    }

    public function getAccidentsBySites($begin, $end, $site = null){
        $sites = Site::all();

        $returnArray = array();


        $returnArray['Interne']['TotalConsultation'] = 0;
        $returnArray['Interne']['TotalArret'] = 0;

        foreach ($sites as $key => $site) {

            $queryInterne =  DB::table('consultations')
                ->where('etatValidite', '=', 'valide')
                ->where('typeConsultation', '=', 'Interne')
                ->whereDate('dateConsultation', '>=', $begin)
                ->whereDate('dateConsultation', '<=', $end)
                ->where('accident', '=', 'oui')
                ->where('natureReception', '=', $site->id);

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

    public function getGlobalStats($begin, $end){

    }

    public function getPathologieByTranche($begin, $end, $site = false){

        $query = DB::table('consultations')
            ->join('agents', 'consultations.agent_id', '=', 'agents.id')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
            ->where('consultations.etatValidite', '=', 'valide');

        if(!is_null($site)){
            $query->where('natureReception', '=', $site);
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
                if($consultation->arretMaladie == 'oui') {
                    $bigArray[$key][$consultation->motif_consultation_id]['Arret'] += 1;
                }
            }else{
                $pathologie = Motif_consultation::find($consultation->motif_consultation_id);
                $bigArray[$key][$consultation->motif_consultation_id]['Pathologie'] = $pathologie->intitule;
                $bigArray[$key][$consultation->motif_consultation_id]['Consultation'] = 1;
                if($consultation->arretMaladie == 'oui') {
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

}
