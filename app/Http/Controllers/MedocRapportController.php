<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Projet;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MedocRapportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $projets = Projet::all();
        $sites = Site::all();
        $begin = date('Y-m-d');
        $end = date('Y-m-d');
        $dataPoints = null;

        return view('rapport.dashboard', [
            'projets' => $projets,
            'sites' => $sites,
            'consommationGlobale' => $this->getConsommationMedicament($begin, $end),
            'consommationParProjetEtSite' => $this->getConsommationParProjetEtSite($begin, $end),
            'evolutionBudgetPharmacie' => $this->getEvolutionBudgetPharmacie($begin, $end),
            'coutAchatsEtConsommations' => $this->getCoutAchatsEtConsommations($begin, $end),
            'medicamentsEnRupture' => $this->getMedicamentsEnRupture(null),
            'medicamentsSeuilCritique' => $this->getMedicamentsSeuilCritique(null),
            'medicamentsPeremptionProche' => $this->getMedicamentsProchePeremption(null),
            'evolutionStocksConsommation' => $this->getEvolutionStockEtConsommation($begin, $end),
            'historiqueMouvements' => $this->getHistoriqueMouvementsStock($begin, $end),
            'stockFaibleRotation' => $this->getStockFaibleRotation(null),
            'stockMort' => $this->getStockMort(null),
            'test' => null,
            'dataPoints' => $dataPoints
        ]);
    }

    public function filter(Request $request)
    {
        $request->validate([
            'datedebut' => 'required|date',
            'datefin' => 'required|date|after_or_equal:datedebut',
        ]);

        $begin = $request->input('datedebut');
        $end = $request->input('datefin');

        $siteSelected = is_numeric($request->input('siteConsultation')) ? $request->input('siteConsultation') : null;
        $projetSelected = $request->input('projetSelected') ?? [];

        if (!$projetSelected && $siteSelected) {
            $projetSelected = Projet::where('site_id', $siteSelected)->pluck('id')->toArray();
        }

        return view('rapport.medoc', [
            'projets' => Projet::all(),
            'sites' => Site::all(),
            'theSite' => $siteSelected,
            'theprojet' => $projetSelected,
            'periode' => date('d/m/Y', strtotime($begin)) . ' - ' . date('d/m/Y', strtotime($end)),
            'consommationGlobale' => $this->getConsommationMedicament($begin, $end),
            'consommationParProjetEtSite' => $this->getConsommationParProjetEtSite($begin, $end),
            'evolutionBudgetPharmacie' => $this->getEvolutionBudgetPharmacie($begin, $end),
            'coutAchatsEtConsommations' => $this->getCoutAchatsEtConsommations($begin, $end),
            'medicamentsEnRupture' => $this->getMedicamentsEnRupture($siteSelected),
            'medicamentsSeuilCritique' => $this->getMedicamentsSeuilCritique($siteSelected),
            'medicamentsPeremptionProche' => $this->getMedicamentsProchePeremption($siteSelected),
            'evolutionStocksConsommation' => $this->getEvolutionStockEtConsommation($begin, $end),
            'historiqueMouvements' => $this->getHistoriqueMouvementsStock($begin, $end),
            'stockFaibleRotation' => $this->getStockFaibleRotation($siteSelected),
            'stockMort' => $this->getStockMort($siteSelected),
        ]);
    }

    public function getConsommationMedicament($begin, $end)
    {
        $begin = '2024-07-01';
        $end = now()->format('Y-m-d');
        $data = DB::table('transaction_medicaments')
            ->join('medications', 'transaction_medicaments.medication_id', '=', 'medications.id')
            ->whereBetween('transaction_medicaments.created_at', [$begin, $end])
            ->select(
                'medications.id',
                'medications.name as name',
                DB::raw('(medications.stock_quantity * medications.tablet_count) as stock_initial'),
                DB::raw('SUM(transaction_medicaments.qte) as quantite_utilisee'),
                DB::raw('(medications.stock_quantity * medications.tablet_count) - SUM(transaction_medicaments.qte) as stock_restant')
            )
            ->groupBy('medications.id', 'medications.name', 'medications.stock_quantity', 'medications.tablet_count')
            ->orderByDesc('quantite_utilisee')
            ->get();
    
        // Transformez les résultats en un format utilisable par un graphique
        $labels = [];
        $quantiteUtilisee = [];
        $stockRestant = [];

       // dd($labels, $quantiteUtilisee, $stockRestant);
    
        foreach ($data as $item) {
            $labels[] = $item->name;
            $quantiteUtilisee[] = $item->quantite_utilisee;
            $stockRestant[] = $item->stock_restant;
        }
    
        return [
            'labels' => $labels,
            'quantite_utilisee' => $quantiteUtilisee,
            'stock_restant' => $stockRestant,
        ];
    }
    


  

    // Placeholders pour les méthodes complémentaires que vous devez compléter
    public function getConsommationParProjetEtSite($begin, $end) { return []; }
    public function getEvolutionBudgetPharmacie($begin, $end) { return []; }
    public function getCoutAchatsEtConsommations($begin, $end) { return []; }
    public function getMedicamentsEnRupture($site = null) { return []; }
    public function getMedicamentsSeuilCritique($site = null) { return []; }
    public function getMedicamentsProchePeremption($site = null) { return []; }
    public function getEvolutionStockEtConsommation($begin, $end) { return []; }
    public function getHistoriqueMouvementsStock($begin, $end) { return []; }
    public function getStockFaibleRotation($site = null) { return []; }
    public function getStockMort($site = null) { return []; }
}
