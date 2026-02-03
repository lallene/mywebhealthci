<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicamentStockController extends Controller
{
     /**
     * Retourne la liste des médicaments utilisés avec leur stock restant
     */

     public function UsedMedoc(Request $request)
{
    $stocks = DB::table('medicament_stocks')
        ->join('medications', 'medicament_stocks.medicament_id', '=', 'medications.id')
        ->leftJoin('transaction_medicaments', 'medicament_stocks.id', '=', 'transaction_medicaments.stock_id')
        ->leftJoin('type_distributions', 'medications.distribution_type_id', '=', 'type_distributions.id')
        ->select(
            'medications.id as medicament_id',
            'medications.supply_date',
            'medications.name as medicament',
            'medications.famille_medicament',
            'medications.unit_price',
            'medications.supplier',
            'type_distributions.name as type_distribution',
            'medicament_stocks.created_at as stock_created_at',
            'medicament_stocks.qte as stock_total',
            DB::raw('COALESCE(SUM(transaction_medicaments.qte),0) as total_used'),
            DB::raw('GREATEST(medicament_stocks.qte - COALESCE(SUM(transaction_medicaments.qte),0),0) as stock_rest')
        )
        ->groupBy(
            'medications.id',
            'medications.supply_date',
            'medications.name',
            'medications.famille_medicament',
            'medications.unit_price',
            'medications.supplier',
            'type_distributions.name',
            'medicament_stocks.created_at',
            'medicament_stocks.qte'
        )
        ->having('stock_rest', '>', 0)
        ->orderBy('medications.supply_date', 'asc') // on prend du plus ancien pour calculer la date min
        ->get();

    // Transformation en JSON groupé par semaine et famille
    $result = [];
    foreach ($stocks as $stock) {
        $week = 'S' . date('W', strtotime($stock->supply_date));

        if (!isset($result[$week])) {
            $result[$week] = [
                'approvisionnement' => $stock->supply_date, // première date rencontrée pour cette semaine = la plus ancienne
                'familles' => []
            ];
        }

        $famille = $stock->famille_medicament ?? 'Autres';
        if (!isset($result[$week]['familles'][$famille])) {
            $result[$week]['familles'][$famille] = [];
        }

        $result[$week]['familles'][$famille][] = [
            'medicament' => $stock->medicament,
            'stock_created_at' => $stock->stock_created_at,
            'supplier' => $stock->supplier,
            'type_distribution' => $stock->type_distribution,
            'unit_price' => $stock->unit_price,
            'stock_total' => $stock->stock_total,
            'total_used' => $stock->total_used,
            'stock_rest' => $stock->stock_rest
        ];
    }

    // Tri des semaines du plus récent au plus ancien
    uksort($result, function($a, $b) use ($result) {
        $dateA = strtotime($result[$a]['approvisionnement']);
        $dateB = strtotime($result[$b]['approvisionnement']);
        return $dateB <=> $dateA; // inverse pour du plus récent au plus ancien
    });

    return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);

}


public function topUsersMedicaments(Request $request)
{
    $baseQuery = DB::table('transaction_medicaments as t')
        ->join('medicament_stocks as s', 't.stock_id', '=', 's.id')
        ->join('medications as m', 's.medicament_id', '=', 'm.id')
        ->join('consultations as cons', 't.consultation_id', '=', 'cons.id')
        ->join('agents as a', 'cons.agent_id', '=', 'a.id')
        ->join('contrats as c', 'a.contrat_id', '=', 'c.id')
        ->join('sub_fonctions as f', 'a.sousfonction_id', '=', 'f.id')
        ->join('projets as p', 'a.projet_id', '=', 'p.id')
        ->join('sites', 'p.site_id', '=', 'sites.id')
        ->select(
            'm.supply_date',
            'a.id',
            'a.nom',
            'a.prenom',
            'a.work_email as email',
            'c.designation as contrat',
            'f.intitule as fonction',
            DB::raw('MAX(p.designation) as projet'),
            DB::raw('MAX(sites.designation) as site'),
            DB::raw('COUNT(t.consultation_id) as nbre_consultations'),
            DB::raw('SUM(t.qte) as total_comprimes'),
            DB::raw('ROW_NUMBER() OVER (PARTITION BY m.supply_date ORDER BY SUM(t.qte) DESC) as rang')
        )
        ->groupBy(
            'm.supply_date',
            'a.id',
            'a.nom',
            'a.prenom',
            'a.work_email',
            'c.designation',
            'f.intitule'
        );

    $rows = DB::table(DB::raw("({$baseQuery->toSql()}) as sub"))
        ->mergeBindings($baseQuery)
        ->where('rang', '<=', 10)
        ->orderByDesc('supply_date')
        ->orderBy('rang')
        ->get();

    $grouped = $rows->groupBy('supply_date')->map(function ($items, $date) {
        return [
            'supply_date' => $date,
            'data' => $items->values()
        ];
    })->values();

    return response()->json($grouped, 200, [], JSON_UNESCAPED_UNICODE);
}



public function topMedecinsParDate(Request $request)
{
    // ID du rôle "Corps médical"
    $roleId = Role::where('name', 'Corps médical')->first()->id;

    // Base query : somme des médicaments par médecin et par supply_date
    $baseQuery = DB::table('transaction_medicaments as t')
        ->join('medicament_stocks as s', 't.stock_id', '=', 's.id')
        ->join('medications as m', 's.medicament_id', '=', 'm.id') // <-- jointure pour supply_date
        ->join('consultations as c', 't.consultation_id', '=', 'c.id')
        ->join('users as u', 'c.user_id', '=', 'u.id')
        ->join('model_has_roles as mhr', function($join) use ($roleId) {
            $join->on('u.id', '=', 'mhr.model_id')
                 ->where('mhr.role_id', '=', $roleId);
        })
        ->select(
            'm.supply_date',      // <-- prend supply_date depuis medications
            'u.id',
            'u.name',

            DB::raw('SUM(t.qte) as total_comprimes'),
            DB::raw('COUNT(t.consultation_id) as nbre_consultations'),

            DB::raw('ROW_NUMBER() OVER (PARTITION BY m.supply_date ORDER BY SUM(t.qte) DESC) as rang')
        )
        ->groupBy('m.supply_date', 'u.id', 'u.name');

    // Récupérer les top médecins par date
    $rows = DB::table(DB::raw("({$baseQuery->toSql()}) as sub"))
        ->mergeBindings($baseQuery)
        ->where('rang', '<=', 10)
        ->orderByDesc('supply_date')
        ->orderBy('rang')
        ->get();

    // Regrouper par supply_date pour le front
    $grouped = $rows->groupBy('supply_date')->map(function ($items, $date) {
        return [
            'supply_date' => $date,
            'data' => $items->values() // réindexe le tableau
        ];
    })->values();

    return response()->json($grouped, 200, [], JSON_UNESCAPED_UNICODE);
}


public function topProjetsParSite(Request $request)
{
    $data = DB::table('transaction_medicaments as t')
        ->join('medicament_stocks as s', 't.stock_id', '=', 's.id')
        ->join('medications as m', 's.medicament_id', '=', 'm.id')
        ->join('consultations as c', 't.consultation_id', '=', 'c.id')
        ->join('users as u', 'c.user_id', '=', 'u.id')
        ->join('projets as p', 'c.projet_id', '=', 'p.id')
        ->join('sites as site', 'p.site_id', '=', 'site.id')
        ->select(
            'm.supply_date',
            'site.designation as site_name',
            'p.designation as projet_name',
            DB::raw('COUNT(DISTINCT c.id) as nbre_consultations'),
            DB::raw('SUM(t.qte) as nbre_medicament_used')
        )
        ->groupBy('m.supply_date', 'site.designation', 'p.designation')
        ->orderBy('m.supply_date', 'desc')
        ->orderBy('site.designation')
        ->get();

    // Regrouper par supply_date → site → projets et trier les projets par nb de comprimés utilisés
    $grouped = $data->groupBy('supply_date')->map(function($items, $supply_date) {
        return [
            'supply_date' => $supply_date,
            'sites' => $items->groupBy('site_name')->map(function($projects, $site_name) {
                $sortedProjects = $projects->sortByDesc('nbre_medicament_used');
                return [
                    'site_name' => $site_name,
                    'projets' => $sortedProjects->map(function($proj) {
                        return [
                            'projet_name' => $proj->projet_name,
                            'nbre_consultations' => $proj->nbre_consultations,
                            'nbre_medicament_used' => $proj->nbre_medicament_used,
                        ];
                    })->values()
                ];
            })->values()
        ];
    })->values();

    return response()->json($grouped, 200, [], JSON_UNESCAPED_UNICODE);
}


public function comparerStocksParSupplyDate()
{
    // Récupérer toutes les dates distinctes d’approvisionnement triées
    $supplyDates = DB::table('medications')
        ->select('supply_date')
        ->whereNotNull('supply_date')
        ->distinct()
        ->orderBy('supply_date')
        ->pluck('supply_date')
        ->toArray();

    $result = [];

    foreach ($supplyDates as $index => $startDate) {
        $endDate = $supplyDates[$index + 1] ?? now()->toDateString();

        $stocks = DB::table('medicament_stocks as stock')
            ->join('medications as m', 'stock.medicament_id', '=', 'm.id')
            ->leftJoin('transaction_medicaments as t', function($join) use ($startDate, $endDate) {
                $join->on('t.stock_id', '=', 'stock.id')
                     ->whereBetween('t.created_at', [$startDate, $endDate]);
            })
           ->selectRaw(
    '? as intervalle,
     SUM(m.stock_quantity * m.tablet_count) as qte_initiale,
     COALESCE(SUM(t.qte),0) as qte_utilisee,
     (SUM(m.stock_quantity * m.tablet_count) - COALESCE(SUM(t.qte),0)) as qte_restante',
    ["$startDate au $endDate"]
)
            ->first();

        $result[] = $stocks;
    }

    return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);
}









}
