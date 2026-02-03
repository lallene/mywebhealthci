<?php

namespace App\Imports;

use App\Models\Medication;
use App\Models\MedicamentStock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class MedicationsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        try {
            // Nettoyage des valeurs
            $row = array_map(function ($value) {
                return is_string($value) ? trim($value) : $value;
            }, $row);

            $type_distribution = DB::table('type_distributions')
                ->where('name', $row['type_de_distribution'] ?? '')
                ->value('id') ?? 14;

            $date_dexpiration = (!empty($row['date_dexpiration']) && is_numeric($row['date_dexpiration']))
                ? Date::excelToDateTimeObject($row['date_dexpiration'])->format('Y-m-d')
                : null;

            $date_de_livraison = (!empty($row['date_de_livraison']) && is_numeric($row['date_de_livraison']))
                ? Date::excelToDateTimeObject($row['date_de_livraison'])->format('Y-m-d')
                : null;

            $quantite = (int) ($row['quantite'] ?? 0);
            $comprimés_par_boite = (int) ($row['quantite_de_comprimes_par_boite'] ?? 0);
            $alertThreshold = $quantite * 0.30;
            $nom = $row['nom_du_medicament'] ?? null;

            // Recherche ou création du médicament
            $medication = Medication::firstOrCreate([
                'name' => $nom,
                'supply_date' => $date_de_livraison,
            ], [
                'expiration_date'      => $date_dexpiration,
                'stock_quantity'       => $quantite,
                'supplier'             => $row['fournisseur'] ?? 'Non spécifié',
                'unit_price'           => $row['prix_unitaire_xof'] ?? 0,
                'tablet_count'         => $comprimés_par_boite,
                'distribution_type_id' => $type_distribution,
                'alert_threshold'      => $alertThreshold,
                'famille_medicament'   => $row['famille_du_medicament'] ?? 'Non spécifié',
                'validation'           => 0,
            ]);

            if (!$medication->wasRecentlyCreated) {
                $medication->update([
                    'expiration_date'      => $date_dexpiration,
                    'stock_quantity'       => $quantite,
                    'supplier'             => $row['fournisseur'] ?? 'Non spécifié',
                    'unit_price'           => $row['prix_unitaire_xof'] ?? 0,
                    'tablet_count'         => $comprimés_par_boite,
                    'distribution_type_id' => $type_distribution,
                    'alert_threshold'      => $alertThreshold,
                    'famille_medicament'   => $row['famille_du_medicament'] ?? 'Non spécifié',
                    'validation'           => 0,
                ]);
            }

            // Calcul quantité totale
            $qte_totale = $quantite * $comprimés_par_boite;

            // Création ou mise à jour dans la table medicament_stocks
            MedicamentStock::updateOrCreate(
                ['medicament_id' => $medication->id],
                [
                    'qte' => $qte_totale,
                    'user_id' => Auth::id() ?? 1,
                ]
            );

            Log::info("Médicament traité : $nom - Stock mis à jour.");

            return $medication;

        } catch (\Exception $e) {
            Log::error("Erreur d'importation : " . $e->getMessage(), ['row' => $row]);
            return null;
        }
    }
}
