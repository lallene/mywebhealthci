<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Motif_consultation;
use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $begin = date('Y-m-d');
        $end = date('Y-m-d');

        $chartData = self::getStatsByMedecin($begin, $end);

        $byTypeContrat = self::getArretByTypeContrat($begin, $end);

        $bySexe = self::getArretBySexe($begin, $end);

        $arretsByTranche = self::getArretByTranche($begin, $end);

        $byCouverture = self::getArretByCouverture($begin, $end);

        $statByPathologie = self::getConsultationsByMotif($begin, $end);

        $statByPathologieAndGenre = self::getConsultationsByMotifAndGenre($begin, $end);

        $statByPathologieAndContagieux = self::getConsultationsByContagieux($begin, $end);

        $arretsBySite = self::getArretsBySites($begin, $end);

        $pathologieByTranche = self::getPathologieByTranche($begin, $end);


        //echo('<pre>'); die(print_r($bySexe));



        return view('home', [
            'dataPoints' => $chartData,
            'byTypeContrat' => $byTypeContrat,
            'bySexe' => $bySexe,
            'byCouverture' => $byCouverture,
            'statByPathologie' => $statByPathologie,
            'statByPathologieAndGenre' => $statByPathologieAndGenre,
            'statByPathologieAndContagieux' => $statByPathologieAndContagieux,
            'arretsBySite' => $arretsBySite,
            'arretsByTranche' => $arretsByTranche,
            'pathologieByTranche' => $pathologieByTranche
        ]);
    }

    public function getStatsByMedecin($begin, $end){
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

                    $chartData[$key]['a'] += 1;
                    if($consultation->arretMaladie == 'oui'){
                        $chartData[$key]['b'] += 1;
                    }
                }
            }
        }
        return $chartData;
    }
    
    public function getArretByTypeContrat($begin, $end){
        $contrats = Contrat::all();

        $arrayContrat = array();

        foreach ($contrats as $key => $contrat) {
            $nombre = DB::table('consultations')
                ->join('agents', 'consultations.agent_id', '=', 'agents.id')
                ->whereDate('consultations.dateConsultation', '>=', $begin)
                ->whereDate('consultations.dateConsultation', '<=', $end)
                ->where('consultations.etatValidite', '=', 'valide')
                ->where('consultations.arretMaladie', '=', 'oui')
                ->where('agents.contrat_id', '=', $contrat->id)
                ->get();

            $arrayContrat[$key]['label'] = $contrat->designation;
            $arrayContrat[$key]['value'] = sizeof($nombre);

        }

        return $arrayContrat;
    }

    public function getArretBySexe($begin, $end){

        $array = array();

        $masculin = DB::table('consultations')
            ->join('agents', 'consultations.agent_id', '=', 'agents.id')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
            ->where('consultations.etatValidite', '=', 'valide')
            ->where('consultations.arretMaladie', '=', 'oui')
            ->where('agents.sexe', '=', 'M')
            ->get();

        $feminin = DB::table('consultations')
            ->join('agents', 'consultations.agent_id', '=', 'agents.id')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
            ->where('consultations.etatValidite', '=', 'valide')
            ->where('consultations.arretMaladie', '=', 'oui')
            ->where('agents.sexe', '=', 'F')
            ->get();

        $array[0]['label'] = 'Masculin';
        $array[0]['value'] = sizeof($masculin);

        $array[1]['label'] = 'Féminin';
        $array[1]['value'] = sizeof($feminin);

        return $array;
    }

    public function getArretByTranche($begin, $end){

        $array = array();

        $consultations = DB::table('consultations')
            ->join('agents', 'consultations.agent_id', '=', 'agents.id')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
            ->where('consultations.etatValidite', '=', 'valide')
            ->get();

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

    public function getArretByCouverture($begin, $end){

        $chartData = array();

        $oui = DB::table('consultations')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
            ->where('consultations.etatValidite', '=', 'valide')
            ->where('consultations.arretMaladie', '=', 'oui')
            ->where('consultations.assurance', '=', 'oui')
            ->get();

        $non = DB::table('consultations')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
            ->where('consultations.etatValidite', '=', 'valide')
            ->where('consultations.arretMaladie', '=', 'oui')
            ->where('consultations.assurance', '=', 'non')
            ->get();

        $chartData[0]['y'] = 'Oui';
        $chartData[0]['a'] = sizeof($oui);

        $chartData[]['y'] = 'Non';
        $chartData[1]['a'] = sizeof($non);

        return $chartData;
    }

    public function getConsultationsByMotif($begin, $end){
        $motifs = Motif_consultation::all();

        $returnArray = array();

        foreach ($motifs as $key => $motif) {



            $consultations =  DB::table('consultations')
                ->where('etatValidite', '=', 'valide')
                ->whereDate('created_at', '>=', $begin)
                ->whereDate('created_at', '<=', $end)
                ->where('motif_consultation_id', '=', $motif->id)
                ->get();

            if(sizeof($consultations) > 0){
                $returnArray[$key]['Motif'] = $motif->intitule;
                $returnArray[$key]['Consultation'] = sizeof($consultations);


                $arrets =  DB::table('consultations')
                    ->where('consultations.etatValidite', '=', 'valide')
                    ->whereDate('created_at', '>=', $begin)
                    ->whereDate('created_at', '<=', $end)
                    ->where('arretMaladie', '=', 'oui')
                    ->where('motif_consultation_id', '=', $motif->id)
                    ->get();

                $returnArray[$key]['Arret'] = sizeof($arrets);
            }

        }
        return $returnArray;
    }

    public function getConsultationsByMotifAndGenre($begin, $end){
        $motifs = Motif_consultation::all();

        $returnArray = array();

        $returnArray['Féminin']['TotalConsultation'] = 0;
        $returnArray['Féminin']['TotalArret'] = 0;
        $returnArray['Masculin']['TotalConsultation'] = 0;
        $returnArray['Masculin']['TotalArret'] = 0;

        foreach ($motifs as $key => $motif) {



            $consultationsFemme =  DB::table('consultations')
                ->join('agents', 'consultations.agent_id', '=', 'agents.id')
                ->where('consultations.etatValidite', '=', 'valide')
                ->whereDate('created_at', '>=', $begin)
                ->whereDate('created_at', '<=', $end)
                ->where('agents.sexe', '=', 'F')
                ->where('motif_consultation_id', '=', $motif->id)
                ->get();

            $consultationsHomme =  DB::table('consultations')
                ->join('agents', 'consultations.agent_id', '=', 'agents.id')
                ->where('consultations.etatValidite', '=', 'valide')
                ->whereDate('created_at', '>=', $begin)
                ->whereDate('created_at', '<=', $end)
                ->where('agents.sexe', '=', 'M')
                ->where('motif_consultation_id', '=', $motif->id)
                ->get();

            if(sizeof($consultationsFemme) > 0){
                $returnArray['Féminin']["stats"][$key]['Motif'] = $motif->intitule;
                $returnArray['Féminin']["stats"][$key]['Consultation'] = sizeof($consultationsFemme);

                $arrets =  DB::table('consultations')
                     ->join('agents', 'consultations.agent_id', '=', 'agents.id')
                    ->where('consultations.etatValidite', '=', 'valide')
                    ->whereDate('created_at', '>=', $begin)
                    ->whereDate('created_at', '<=', $end)
                    ->where('arretMaladie', '=', 'oui')
                    ->where('agents.sexe', '=', 'F')
                    ->where('motif_consultation_id', '=', $motif->id)
                    ->get();

                $returnArray['Féminin']["stats"][$key]['Arret'] = sizeof($arrets);

                $returnArray['Féminin']['TotalConsultation'] += sizeof($consultationsFemme);
                $returnArray['Féminin']['TotalArret'] += sizeof($arrets);
            }

            if(sizeof($consultationsHomme) > 0){
                $returnArray['Masculin']["stats"][$key]['Motif'] = $motif->intitule;
                $returnArray['Masculin']["stats"][$key]['Consultation'] = sizeof($consultationsHomme);


                $arrets =  DB::table('consultations')
                    ->join('agents', 'consultations.agent_id', '=', 'agents.id')
                    ->where('consultations.etatValidite', '=', 'valide')
                    ->whereDate('created_at', '>=', $begin)
                    ->whereDate('created_at', '<=', $end)
                    ->where('arretMaladie', '=', 'oui')
                    ->where('agents.sexe', '=', 'M')
                    ->where('motif_consultation_id', '=', $motif->id)
                    ->get();

                $returnArray['Masculin']["stats"][$key]['Arret'] = sizeof($arrets);

                $returnArray['Masculin']['TotalConsultation'] += sizeof($consultationsHomme);
                $returnArray['Masculin']['TotalArret'] += sizeof($arrets);
            }

        }
        return $returnArray;
    }

    public function getConsultationsByContagieux($begin, $end){
        $motifs = Motif_consultation::all();

        $returnArray = array();

        foreach ($motifs as $key => $motif) {


            $consultations =  DB::table('consultations')
                ->where('consultations.etatValidite', '=', 'valide')
                ->whereDate('created_at', '>=', $begin)
                ->whereDate('created_at', '<=', $end)
                ->where('motif_consultation_id', '=', $motif->id)
                ->where('maladie_contagieuse', '=', 'oui')
                ->get();

            if(sizeof($consultations) > 0){
                $returnArray[$key]['Motif'] = $motif->intitule;
                $returnArray[$key]['Consultation'] = sizeof($consultations);


                $arrets =  DB::table('consultations')
                    ->where('consultations.etatValidite', '=', 'valide')
                    ->whereDate('created_at', '>=', $begin)
                    ->whereDate('created_at', '<=', $end)
                    ->where('arretMaladie', '=', 'oui')
                    ->where('motif_consultation_id', '=', $motif->id)
                    ->get();

                $returnArray[$key]['Arret'] = sizeof($arrets);
            }

        }
        return $returnArray;
    }

    public function getArretsBySites($begin, $end){
        $sites = Site::all();

        $returnArray = array();

        $returnArray['Externe']['TotalConsultation'] = 0;
        $returnArray['Externe']['TotalArret'] = 0;
        $returnArray['Interne']['TotalConsultation'] = 0;
        $returnArray['Interne']['TotalArret'] = 0;

        foreach ($sites as $key => $site) {

            $consultationExterne =  DB::table('consultations')
                ->where('etatValidite', '=', 'valide')
                ->where('typeConsultation', '=', 'Externe')
                ->whereDate('dateConsultation', '>=', $begin)
                ->whereDate('dateConsultation', '<=', $end)
                ->where('arretMaladie', '=', 'oui')
                ->where('natureReception', '=', $site->id)
                ->get();

            $consultationInterne =  DB::table('consultations')
                ->where('etatValidite', '=', 'valide')
                ->where('typeConsultation', '=', 'Interne')
                ->whereDate('dateConsultation', '>=', $begin)
                ->whereDate('dateConsultation', '<=', $end)
                ->where('arretMaladie', '=', 'oui')
                ->where('natureReception', '=', $site->id)
                ->get();

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

    public function getGlobalStats($begin, $end){
        $consultations =  DB::table('consultations')
            ->where('etatValidite', '=', 'valide')
            ->whereDate('created_at', '>=', $begin)
            ->whereDate('created_at', '<=', $end)
            ->get();

        $arrets =  DB::table('consultations')
            ->where('etatValidite', '=', 'valide')
            ->whereDate('created_at', '>=', $begin)
            ->whereDate('created_at', '<=', $end)
            ->where('arretMaladie', '=', 'oui')
            ->get();

        $nbreTotalJrs = 0;

        foreach ($arrets as $arret) {
            if($arret->natureDuree == 'Jour')
                $nbreTotalJrs += $arret->nbrJour;
        }
    }

    public function getPathologieByTranche($begin, $end){

        $consultations = DB::table('consultations')
            ->join('agents', 'consultations.agent_id', '=', 'agents.id')
            ->whereDate('consultations.dateConsultation', '>=', $begin)
            ->whereDate('consultations.dateConsultation', '<=', $end)
            ->where('consultations.etatValidite', '=', 'valide')
            ->get();

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

}
