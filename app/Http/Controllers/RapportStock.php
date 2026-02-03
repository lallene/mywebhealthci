<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Exports\ConsultationsExport;
use App\Mail\exportmail;
use App\Mail\Insertion_massive;
use App\Mail\Rapport_chargeflux;
use App\Models\Consultation;
use App\Mail\rapport_cf;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class RapportController extends Controller
{
    private $templatePath = 'rapport';
    private $link = 'rapport';
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Ressources Humaines');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $_GET['datededebut']= null;
        $test = null;
        $_GET['datedefin'] = null;


        $date = new DateTime();
        $date->modify('-3 days');
        $from = $date->format('Y-m-d');

        $to =date('Y-m-d');

               $cons =DB::table('consultations')
               ->whereDate('consultations.dateConsultation', '>=', $from)
               ->whereDate('consultations.dateConsultation', '<=', $to)
               ->join('projets', 'consultations.projet_id', '=', 'projets.id')
                ->join('agents', 'consultations.agent_id', '=', 'agents.id')
                ->select(
                    'projets.designation as projet',
                    'agents.Matricule_salarie as workday_id',
                    'agents.prenom as prenom',
                    'agents.nom as nom',
                    'consultations.typeArrêt as typearret',
                    'consultations.duree_arret',
                    'consultations.debutArret',
                    'consultations.dateReprise',
                    'consultations.siteConsultation',
                    'consultations.created_at as created_at'
                )

               ->get();

             //s   dd($cons);

                return view($this->templatePath . '.rapport', [
                    'titre' => "Rapport consultation",
                    'cons' => $cons,
                    'test' => $test,
                    'link' => $this->link,
                    'to'=> $to,
                    "from" => $from
                ]);
    }

    public function rapport (Request  $request  ){

        $_GET['datededebut']= $request->datededebut;
        $test = 'yes';
        $_GET['datedefin'] =$request->datedefin;

        $from = $request->datededebut;
        $to =$request->datedefin;

        $cons =DB::table('consultations')
        ->whereDate('consultations.dateConsultation', '>=', $from)
        ->whereDate('consultations.dateConsultation', '<=', $to)
        ->join('projets', 'consultations.projet_id', '=', 'projets.id')
         ->join('agents', 'consultations.agent_id', '=', 'agents.id')
         ->select(
             'projets.designation as projet',
             'agents.iris as iris',
             'agents.prenom as prenom',
             'agents.Matricule_salarie as workday_id',
             'agents.nom as nom',
             'consultations.typeArrêt as typearret',
             'consultations.duree_arret',
             'consultations.debutArret',
             'consultations.dateReprise',
             'consultations.siteConsultation',
             'consultations.created_at as created_at'
         )

        ->get();

      //   dd($cons);

         return view($this->templatePath . '.rapport', [
             'titre' => "Rapport consultation",
             'cons' => $cons,
             'test' => $test,
             'link' => $this->link,
             'to'=> $to,
             "from" => $from
         ]);

    }


    public function export(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        return Excel::download(new ConsultationsExport($from, $to), 'consultations.xlsx');
    }

    public function sendMailWitchExecel(Request $request){
        $datedebutexport = $request->from;
        $datefinexport = $request->to;


        Mail::to('lallene.achi@concentrix.com')->send(new Rapport_chargeflux($datedebutexport, $datefinexport ));


        return redirect()->route('rapport')->with('success','Rapport envoyé avec succès');

        $date_export = date('r');
        $datedebutexport = $request->from;
        $datefinexport = $request->to;

      Mail::send('emails.export', [
            'date_export' => $date_export,
            'datedebutexport' => $datedebutexport,
            'datefinexport' => $datefinexport,
        ], function($message) use ($datedebutexport, $datefinexport) {
            $message->to('lallene.achi@concentrix.com')
                    ->subject("My Webhealth CI - Rapport du ")
                    ->attach(Excel::download(new ConsultationsExport($datedebutexport, $datefinexport), 'report.xlsx')->getFile(), [
                        'as' => 'MyWebhealthCI_report.xlsx'
                    ]);
        });




    }

    public function UsedMedoc(Request $request)
{
    $stocks = DB::table('medicament_stocks')
        ->join('medications', 'medicament_stocks.medicament_id', '=', 'medications.id')
        ->leftJoin('transaction_medicaments', 'medicament_stocks.id', '=', 'transaction_medicaments.stock_id')
        ->leftJoin('consultations', 'transaction_medicaments.consultation_id', '=', 'consultations.id')
        ->leftJoin('projets', 'consultations.projet_id', '=', 'projets.id')
        ->leftJoin('sites', 'projets.site_id', '=', 'sites.id')
        ->leftJoin('type_distributions', 'medications.distribution_type_id', '=', 'type_distributions.id')
        ->select(
            'medications.id',
            'medications.name',
            'medicament_stocks.created_at as stock_created_at',
            'medicament_stocks.qte as stock_total',
            'medications.supply_date',
            'medications.supplier',
            'medications.expiration_date',
            'medications.famille_medicament',
            'medications.unit_price',
            'type_distributions.name as type_distribution',
            DB::raw('COALESCE(SUM(transaction_medicaments.qte), 0) as total_used'),
            DB::raw("GREATEST(medicament_stocks.qte - COALESCE(SUM(transaction_medicaments.qte), 0), 0) AS stock_rest")
        )
        ->groupBy(
            'medications.id',
            'medications.name',
            'medicament_stocks.created_at',
            'medicament_stocks.qte',
            'medications.supply_date',
            'medications.supplier',
            'medications.expiration_date',
            'medications.famille_medicament',
            'medications.unit_price',
            'type_distributions.name'
        )
        ->having('stock_rest', '>', 0)
        ->orderByDesc('total_used')
        ->get();
    //dd($stocks);

    return response()->json($stocks);
}

    }

