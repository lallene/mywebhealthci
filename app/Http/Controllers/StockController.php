<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\TransactionMedicament;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Medication;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\JsonResponse;


class StockController extends Controller
{


public function index()
{

   $maxDateTime = DB::table('medicament_stocks')->max('created_at');
   $maxDate = substr($maxDateTime, 0, 10);

  try {
        $stocks = DB::table('medicament_stocks')
            ->join('medications', 'medicament_stocks.medicament_id', '=', 'medications.id') // corrigé ici
            ->join('users', 'medicament_stocks.user_id', '=', 'users.id')
            ->whereDate('medicament_stocks.created_at', $maxDate)
            ->select(
                'medicament_stocks.id as stock_id',
                'medicament_stocks.medicament_id', // corrigé ici
                'medications.name as medication_name',
                'medications.famille_medicament',
                'medicament_stocks.qte',
                'medicament_stocks.created_at',
                'users.name as user_name',
                DB::raw('ROUND((medicament_stocks.qte * 30) / 100) as seuil')
            )
            ->get();

        return response()->json($stocks);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Erreur serveur : ' . $e->getMessage()
        ], 500);
    }

}




     public function show($id)
     {
         $stocks = Stock::with(['Medication'])->findOrFail($id);
         return response()->json($stocks);
     }


    public function prestocks()
    {
        // Requête pour récupérer les médicaments validés et additionner les stocks des sites
        $prestocks = DB::table('medications')
            ->leftJoin('stocks', 'medications.id', '=', 'stocks.medication_id') // Jointure avec stocks
            ->select(
                'medications.id',
                'medications.name',
                'medications.famille_medicament',
                'medications.stock_quantity', // Quantité totale du médicament attendue
                DB::raw('COALESCE(SUM(stocks.stock_site_1), 0) + COALESCE(SUM(stocks.stock_site_2), 0) + COALESCE(SUM(stocks.stock_site_3), 0) AS total_stock_sites') // Somme des stocks des sites
            )
            ->where('medications.validation', 1) // Filtrer les médicaments validés
                        ->whereDate('supply_date', '=', '2025-05-26')

            ->groupBy('medications.id', 'medications.name', 'medications.famille_medicament', 'medications.stock_quantity') // Regrouper par médicament
            ->havingRaw('total_stock_sites != medications.stock_quantity') // Vérifier la différence de stock
            ->get();

        // Ajouter la différence de stock pour chaque médicament
        $prestocks->map(function ($medication) {
            $medication->stock_difference = $medication->stock_quantity - $medication->total_stock_sites; // Calcul de la différence
            return $medication;
        });

        return response()->json($prestocks);
    }


    private function getReseauFromIP($ip)
{
    // Exemple de correspondance IP -> Réseau (À adapter selon ton infra)
    $reseaux = [
        '10.225.2.' => 1,
        '10.225.34.' => 2,
        '10.225.66' => 3,
    ];

    foreach ($reseaux as $prefixe => $reseau) {
        if (strpos($ip, $prefixe) === 0) {
            return $reseau;
        }
    }

    return null; // Réseau inconnu
}



public function stock_disponibles(Request $request, $id)
{
   // $ip = $request->ip();
   // $site = $this->getReseauFromIP($ip);

   $siterequest = DB::table('agents')
   ->join('projets', 'agents.projet_id', '=', 'projets.id')
   ->join('sites', 'projets.site_id', '=', 'sites.id')
   ->select('sites.id') // ou 'sites.nom', 'sites.id', etc. selon ce que tu veux récupérer
   ->where('agents.id', '=', $id)
   ->first();

   if (!$siterequest) {
    return response()->json([
        'error' => 'Aucun site trouvé pour cet agent.',
    ], 404);
    }
   $site = $siterequest->id;


    $search = $request->input('search', '');
    $stock_column = 'stock_site_' . $site;

    try {
        $oldestStockIds = DB::table('stocks')
            ->select(DB::raw('MIN(id) as stock_id'), 'medication_id')
            ->where($stock_column, '>', 0)
            ->groupBy('medication_id');

        // Étape 2 : Jointure avec les bons stocks
        $stocks = DB::table('medications')
            ->joinSub($oldestStockIds, 'oldest_stocks', function ($join) {
                $join->on('medications.id', '=', 'oldest_stocks.medication_id');
            })
            ->join('stocks', 'stocks.id', '=', 'oldest_stocks.stock_id')
            ->leftJoin('transaction_medicaments', 'stocks.id', '=', 'transaction_medicaments.stock_id')
            ->select(
                'medications.id',
                'medications.name',
                'medications.tablet_count',
                'stocks.id as stock_id',
                'stocks.created_at',
                DB::raw("FLOOR(stocks.$stock_column) as stock_initial"),
                DB::raw("FLOOR(stocks.$stock_column * medications.tablet_count - COALESCE(SUM(transaction_medicaments.qte), 0)) AS stock")
            )
            ->when($search, function ($query) use ($search) {
                $query->where('medications.name', 'like', "%{$search}%");
            })
            ->groupBy(
                'medications.id',
                'medications.name',
                'medications.tablet_count',
                'stocks.id',
                'stocks.created_at',
                "stocks.$stock_column"
            )
            ->havingRaw('stock > 0')
            ->orderBy('stocks.created_at')
            ->paginate(10);

        return response()->json([
            'data' => $stocks->items(),
            'current_page' => $stocks->currentPage(),
            'last_page' => $stocks->lastPage(),
            'per_page' => $stocks->perPage(),
            'total' => $stocks->total(),
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Erreur lors de la récupération des médicaments.',
            'message' => $e->getMessage()
        ], 500);
    }
}



public function stock_disponible(Request $request, $id)
{

    $search = $request->input('search', '');

    try {
       $maxDateTime = DB::table('medicament_stocks')->max('created_at');
$maxDate = substr($maxDateTime, 0, 10);


    $stocks = DB::table('medicament_stocks')
    ->join('medications', 'medicament_stocks.medicament_id', '=', 'medications.id')
    ->leftJoin('transaction_medicaments', 'medicament_stocks.id', '=', 'transaction_medicaments.stock_id')
    ->whereDate('medicament_stocks.created_at', $maxDate)
    ->when($search ?? null, function ($query, $search) {
        $query->where('medications.name', 'like', "%{$search}%");
    })
    ->whereIn('medicament_stocks.id', function ($query) {
        $query->selectRaw('MAX(ms.id)')
            ->from('medicament_stocks as ms')
            ->join('medications as m', 'ms.medicament_id', '=', 'm.id')
            ->groupBy('m.name');
    })
    ->select(
        'medications.id',
        'medications.name',
        'medications.tablet_count',
        'medicament_stocks.id as stock_id',
        'medicament_stocks.created_at',
        'medicament_stocks.qte',
        DB::raw("FLOOR(medicament_stocks.qte - COALESCE(SUM(transaction_medicaments.qte), 0)) AS stock")
    )
    ->groupBy(
        'medications.id',
        'medications.name',
        'medications.tablet_count',
        'medicament_stocks.id',
        'medicament_stocks.created_at',
        'medicament_stocks.qte'
    )
    ->havingRaw('FLOOR(medicament_stocks.qte - COALESCE(SUM(transaction_medicaments.qte), 0)) > 0')
    ->orderBy('medicament_stocks.id', 'desc')
    ->paginate(10);


   // dd($stocks);

        return response()->json([
            'data' => $stocks->items(),
            'current_page' => $stocks->currentPage(),
            'last_page' => $stocks->lastPage(),
            'per_page' => $stocks->perPage(),
            'total' => $stocks->total(),
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Erreur lors de la récupération des médicaments.',
            'message' => $e->getMessage()
        ], 500);
    }
}




public function datatableView()
{
    return view('stocks.datatable');
}


public function gestionGlobale()
{

    return view('stocks.datatable'); // Adapté selon le chemin de ta vue Blade
}
// okay
public function visualiserEtatStocks(Request $request)
{
    //dd(date('d/m/Y'));

    $utilisationParSite = DB::table('transaction_medicaments')
        ->join('medications', 'transaction_medicaments.medication_id', '=', 'medications.id')
        ->join('stocks', 'medications.id', '=', 'stocks.medication_id')
        ->where('medications.tablet_count', '>', 1)
        ->select(
            'transaction_medicaments.medication_id',
            'medications.name as medication_name',
            'transaction_medicaments.site_id',
            'medications.stock_quantity as qte_medoc',
            'medications.tablet_count as nombre_medoc',
            'stocks.stock_site_1 as s1',
            'stocks.stock_site_2 as s2',
            'stocks.stock_site_3 as s3',
            DB::raw('SUM(transaction_medicaments.qte) as qte_utilisee_site')
        )
        ->groupBy(
            'transaction_medicaments.medication_id',
            'transaction_medicaments.site_id',
            'medications.name',
            'stocks.stock_site_1',
            'stocks.stock_site_2',
            'stocks.stock_site_3',
            'medications.stock_quantity',
            'medications.tablet_count'
        )
        ->get();

    // Traitement des données
    $result = $utilisationParSite->groupBy('medication_id')->map(function ($group) {
        $first = $group->first();
        $siteUtilisation = [1 => 0, 2 => 0, 3 => 0];

        foreach ($group as $item) {
            $siteUtilisation[$item->site_id] = $item->qte_utilisee_site;
        }

        $globalInitial = $first->nombre_medoc * $first->qte_medoc;
        $globalUtilise = $siteUtilisation[1] + $siteUtilisation[2] + $siteUtilisation[3];
        $globalRestant = $globalInitial - $globalUtilise;

        return [
            'medication_name' => $first->medication_name,
            'qte_medoc' => $first->qte_medoc,
            'nombre_medoc' => $first->nombre_medoc,
            'stock_initial_site_1' => $first->s1 * $first->nombre_medoc,
            'stock_initial_site_2' => $first->s2 * $first->nombre_medoc,
            'stock_initial_site_3' => $first->s3 * $first->nombre_medoc,
            'stock_restant_site_1' => ($first->s1 * $first->nombre_medoc) - $siteUtilisation[1],
            'stock_restant_site_2' => ($first->s2 * $first->nombre_medoc) - $siteUtilisation[2],
            'stock_restant_site_3' => ($first->s3 * $first->nombre_medoc) - $siteUtilisation[3],
            'site_1_utilise' => $siteUtilisation[1],
            'site_2_utilise' => $siteUtilisation[2],
            'site_3_utilise' => $siteUtilisation[3],
            'global_initial' => $globalInitial,
            'global_utilise' => $globalUtilise,
            'global_restant' => $globalRestant,
        ];
    })->values();

    // Top 10 pour le graphique
    $top10 = $result->sortByDesc('global_utilise')->take(5)->values();

    return view('stocks.visualiseretatstocks', compact('result', 'top10'));
}



public function showStockSite(Request $request)
{
    // Récupération des quantités utilisées par médicament et projet
    $medicationUsage = DB::table('transaction_medicaments')
        ->join('medications', 'transaction_medicaments.medication_id', '=', 'medications.id')
        ->join('projets', 'transaction_medicaments.projet_id', '=', 'projets.id')
        ->select(
            'medications.name as medication_name',
            'projets.designation as project_name',
            DB::raw('SUM(transaction_medicaments.qte) as quantity_used')
        )
        ->groupBy('medications.name', 'projets.designation')
        ->orderBy('medications.name')
        ->get();

    $structuredData = $medicationUsage->groupBy('medication_name')->map(function ($group) {
        $first = $group->first();
        $totalQuantityUsed = $group->sum('quantity_used');

        $data = [
            'medication_name' => $first->medication_name,
            'total_quantity_used' => $totalQuantityUsed,
            'projets' => [],
        ];

        foreach ($group as $item) {
            // Calculer la quantité utilisée par projet
            $data['projets'][$item->project_name] = ($data['projets'][$item->project_name] ?? 0) + $item->quantity_used;
        }

        // Aplatir les données pour les projets
        $flattenedData = [];
        foreach ($data['projets'] as $project => $qty) {
            // Calculer le pourcentage pour chaque projet
            $percentageProject = ($qty / $data['total_quantity_used']) * 100;

            $flattenedData[] = [
                'medication_name' => $data['medication_name'],
                'project' => $project,
                'quantity_project' => $qty,
                'percentage_project' => round($percentageProject, 2), // Arrondir à 2 décimales
            ];
        }

        return $flattenedData;
    });

    // Fusionner toutes les lignes aplaties dans une seule collection
    $flatData = $structuredData->flatten(1);

 //   dd($flatData);

    // Retourner les données à la vue
    return view('stocks.showstocksite', compact('flatData'));
}





public function showMedicationUsage(Request $request)
{
    $usage = DB::table('transaction_medicaments')
        ->join('medications', 'transaction_medicaments.medication_id', '=', 'medications.id')
        ->join('consultations', 'transaction_medicaments.consultation_id', '=', 'consultations.id')
        ->join('type_distributions', 'medications.distribution_type_id', '=', 'type_distributions.id')
        ->join('projets', 'transaction_medicaments.projet_id', '=', 'projets.id')
        ->join('sites', 'transaction_medicaments.site_id', '=', 'sites.id')
        ->join('agents', 'consultations.agent_id', '=', 'agents.id')
        ->join('sub_fonctions', 'agents.sousfonction_id', '=', 'sub_fonctions.id')

        ->select(
            'medications.supply_date as Datedacquisition',
            'medications.stock_quantity as QuantiteBoîte',
            'medications.tablet_count as Quantitecomprime',
            'medications.unit_price as unit_price',
            'type_distributions.name as type_distribution',
            'medications.famille_medicament as FamilleMedicament',
            'projets.designation as projet',
            'sites.designation as site',
            'medications.name as medication_name',
            'sub_fonctions.intitule as fonction',
            'agents.prenom',
            'agents.nom',
            DB::raw('SUM(transaction_medicaments.qte) as total_quantity')
        )
        ->groupBy(
            'medications.name',
            'agents.nom',
            'agents.prenom',
            'medications.supply_date',
            'medications.famille_medicament',
            'medications.stock_quantity',
            'medications.tablet_count',
            'medications.unit_price',
            'type_distributions.name',
            'projets.designation',
            'sites.designation',
            'sub_fonctions.intitule'
        )
        ->orderBy('medications.name')
        ->get();

   // dd($usage);

    return view('stocks.medication_usage', ['data' => $usage]);
}










    public function store(Request $request)
{

    $validated = $request->validate([
        'medication_id' => 'required|exists:medications,id',
        'stock_site_1' => 'required|integer',
        'stock_site_2' => 'required|integer',
        'stock_site_3' => 'required|integer',
        'user_id' => 'required|exists:users,id'
    ]);

    // Création d'un nouveau stock sans modification des existants
    $stock = Stock::create([
        'medication_id' => $validated['medication_id'],
        'stock_site_1' => $validated['stock_site_1'],
        'stock_site_2' => $validated['stock_site_2'],
        'stock_site_3' => $validated['stock_site_3'],
        'user_id' => $validated['user_id'],
    ]);

    return response()->json(['message' => 'Stock ajouté avec succès!', 'stock' => $stock], 201);
}



public function getStockParDate(): JsonResponse
{
    try {
        // Étape 1 : récupérer les stocks avec infos de médicament
        $stocks = DB::table('medicament_stocks')
            ->join('medications', 'medicament_stocks.medicament_id', '=', 'medications.id')
            ->select(
                'medications.id as medication_id',
                'medications.name as medication_name',
                'medications.supply_date',
                'medicament_stocks.qte as total_stock',
            )
            ->get()
            ->keyBy('medication_id'); // clé pour lookup rapide

        // Étape 2 : récupérer les consommations groupées par médicament, site, projet
        $usage = DB::table('transaction_medicaments')
            ->join('consultations', 'transaction_medicaments.consultation_id', '=', 'consultations.id')
            ->join('projets', 'consultations.projet_id', '=', 'projets.id')
            ->join('sites', 'projets.site_id', '=', 'sites.id')
            ->join('medicament_stocks', 'transaction_medicaments.stock_id', '=', 'medicament_stocks.id')
            ->select(
                'medicament_stocks.medicament_id',
                'sites.id as site_id',
                'sites.designation as site_name',
                'projets.id as projet_id',
                'projets.designation as projet_name',
                DB::raw('SUM(transaction_medicaments.qte) as qty_used')
            )
            ->groupBy('medicament_stocks.medicament_id', 'sites.id', 'sites.designation', 'projets.id', 'projets.designation')
            ->get();

        // Étape 3 : regrouper les données en PHP
        $result = [];

        foreach ($stocks as $medication) {
            $medicationUsage = $usage->where('medicament_id', $medication->medication_id);

            $sites = [];

            // Regroupement usage par site > projet
            foreach ($medicationUsage as $u) {
                $sites[$u->site_id]['site_name'] = $u->site_name;
                $sites[$u->site_id]['used'] = ($sites[$u->site_id]['used'] ?? 0) + $u->qty_used;

                $sites[$u->site_id]['projects'][$u->projet_id] = [
                    'projet_name' => $u->projet_name,
                    'used' => $u->qty_used,
                ];
            }

            $total_used = array_sum(array_column($sites, 'used'));

            $result[$medication->supply_date]['supply_date'] = $medication->supply_date;
            $result[$medication->supply_date]['medications'][$medication->medication_id] = [
                'medication_name' => $medication->medication_name,
                'total_stock' => $medication->total_stock,
                'total_used' => $total_used,
                'available_stock' => $medication->total_stock - $total_used,
                'sites' => $sites,
            ];
        }

        // Réindexer par valeurs (enlever clés numériques possibles)
        $final = array_values($result);

        return response()->json($final);

    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Erreur serveur : ' . $e->getMessage()
        ], 500);
    }
}


public function  getStockParDateDetaille(): JsonResponse
{
    try {
        $data = DB::table('medicament_stocks')
            ->join('medications', 'medicament_stocks.medicament_id', '=', 'medications.id')
            ->leftJoin('transaction_medicaments', 'medicament_stocks.id', '=', 'transaction_medicaments.stock_id')
            ->leftJoin('consultations', 'transaction_medicaments.consultation_id', '=', 'consultations.id')
            ->leftJoin('projets', 'consultations.projet_id', '=', 'projets.id')
            ->leftJoin('sites', 'projets.site_id', '=', 'sites.id')
            ->select(
                'medications.id as medication_id',
                'medications.name as medication_name',
                'medications.supply_date',
                'medicament_stocks.qte as total_stock',
                // Total utilisé global
                DB::raw('IFNULL(SUM(transaction_medicaments.qte), 0) as total_used'),

                // Total utilisé site 1 (exemple id = 1)
                DB::raw("SUM(CASE WHEN sites.id = 1 THEN transaction_medicaments.qte ELSE 0 END) as site1_used"),

                // Total utilisé site 2 (exemple id = 2)
                DB::raw("SUM(CASE WHEN sites.id = 2 THEN transaction_medicaments.qte ELSE 0 END) as site2_used"),

                // Total utilisé site 3 (exemple id = 3)
                DB::raw("SUM(CASE WHEN sites.id = 3 THEN transaction_medicaments.qte ELSE 0 END) as site3_used"),

                // Stock disponible global
                DB::raw('(medicament_stocks.qte - IFNULL(SUM(transaction_medicaments.qte), 0)) as available_stock'),

                DB::raw('COUNT(DISTINCT consultations.id) as consultation_count'),
            )
            ->groupBy(
                'medications.id',
                'medications.name',
                'medications.supply_date',
                'medicament_stocks.qte',
            )
            ->orderBy('medications.supply_date', 'asc')
            ->get()
            ->groupBy('supply_date')
            ->map(function ($items, $date) {
                return [
                    'supply_date' => $date,
                    'medications' => $items->values()
                ];
            })
            ->values();

        return response()->json($data);

    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Erreur serveur : ' . $e->getMessage()
        ], 500);
    }
}

public function showStocks()
{
    try {
        $data = $this->getStockParDate();

        if ($data instanceof \Illuminate\Http\JsonResponse) {
            $data = json_decode($data->getContent(), true);
        }

        return view('stocks.stocks', compact('data'));

    } catch (\Exception $e) {
        // Pour debug uniquement
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
public function getStockParSite(): JsonResponse
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
            'medicament_stocks.created_at',
            'medicament_stocks.qte as Stock_total',
            'medications.supply_date',
            'medications.supplier',
            'medications.expiration_date',
            'medications.famille_medicament',
            'medications.unit_price',
            'type_distributions.name as type_distribution',
            DB::raw('COALESCE(SUM(transaction_medicaments.qte), 0) as total_used'),
            DB::raw("FLOOR(medicament_stocks.qte - COALESCE(SUM(transaction_medicaments.qte), 0)) AS stock_rest"),
            DB::raw("SUM(CASE WHEN sites.id = 1 THEN transaction_medicaments.qte ELSE 0 END) as site1_used"),
            DB::raw("SUM(CASE WHEN sites.id = 2 THEN transaction_medicaments.qte ELSE 0 END) as site2_used"),
            DB::raw("SUM(CASE WHEN sites.id = 3 THEN transaction_medicaments.qte ELSE 0 END) as site3_used")
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
        ->havingRaw('stock_rest > 0')
        ->orderBy('stock_rest', 'desc')
        ->get();

    // Récupérer les dates distinctes
    $dates = DB::table('medications')
        ->selectRaw('DISTINCT DATE(supply_date) as supply_date')
        ->orderBy('supply_date', 'desc')
        ->pluck('supply_date');

    return response()->json([
        'data' => $stocks,
        'dates' => $dates
    ]);
}






public function destroy($id)
{


    $stock = Stock::find($id);
    if (!$stock) {
        return response()->json(['error' => 'Stock non trouvé'], 404);
    }

    try {
        $stock->delete();
        return response()->json(['message' => 'Stock supprimé avec succès'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Erreur lors de la suppression du stock'], 500);
    }


}
}
