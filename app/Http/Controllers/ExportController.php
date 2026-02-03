<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function index()
    {
        // Simuler des données (à remplacer par les vraies données depuis la base)
        $medicaments = [
            ['nom' => 'Paracétamol', 'consommation' => 50],
            ['nom' => 'Ibuprofène', 'consommation' => 30],
            ['nom' => 'Amoxicilline', 'consommation' => 15],
            ['nom' => 'Aspirine', 'consommation' => 70],
            ['nom' => 'Doliprane', 'consommation' => 25]
        ];

        return view('rapport.liste', compact('medicaments'));
    }

    public function exportToCSV()
    {
        // Simuler des données (à remplacer par les vraies données depuis la base)
        $medicaments = [
            ['nom' => 'Paracétamol', 'consommation' => 50],
            ['nom' => 'Ibuprofène', 'consommation' => 30],
            ['nom' => 'Amoxicilline', 'consommation' => 15],
            ['nom' => 'Aspirine', 'consommation' => 70],
            ['nom' => 'Doliprane', 'consommation' => 25]
        ];

        // Créer le contenu CSV
        $csvContent = "Médicament,Consommation\n";
        foreach ($medicaments as $medicament) {
            $csvContent .= "{$medicament['nom']},{$medicament['consommation']}\n";
        }

        // Créer un fichier CSV en mémoire
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="consommation_medicaments.csv"',
        ];

        return response($csvContent, 200, $headers);
    }
    

}
