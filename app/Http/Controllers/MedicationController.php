<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MedicationsImport;

class MedicationController extends Controller
{



    // Afficher tous les médicaments
    public function index()
    {
        $medicaments = Medication::with(['TypeDistribution', 'Site'])
        ->orderBy('name', 'asc') // Tri par ordre alphabétique (ASC)
    ->where('validation', '=', 0)
        ->get();

    return response()->json($medicaments);

    }

    // Afficher un médicament spécifique
    public function show($id)
    {
        $medicament = Medication::with(['TypeDistribution', 'Site', 'TransactionMedicament'])->findOrFail($id);
        return response()->json($medicament);
    }

    // Ajouter un nouveau médicament
    public function store(Request $request)
    {

        \Log::info('Données reçues pour l\'ajout d\'un médicament:', $request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'stock_quantity' => 'required|integer',
            'expiration_date' => 'required|date',
            'supplier' => 'required|string',
            'supply_date' => 'required|date',
            'unit_price' => 'required|numeric',
            'tablet_count' => 'required|integer',
            'distribution_type_id' => 'required|exists:type_distributions,id', // Assurez-vous que ce champ correspond à un ID valide
            'famille_medicament' => 'nullable|string', // Si ce champ peut être vide

        ]);

        $alertThreshold = $request->input('alert_threshold', null);
        if (is_null($alertThreshold)) {
            $alertThreshold = $request->input('stock_quantity') * 0.30;
        }

        $validation = $request->input('validation', false);

        $medicament = Medication::create([
            'name' => $request->name,
            'stock_quantity' => $request->stock_quantity,
            'alert_threshold' => $alertThreshold,
            'expiration_date' => $request->expiration_date,
            'supplier' => $request->supplier,
            'supply_date' => $request->supply_date,
            'unit_price' => $request->unit_price,
            'tablet_count' => $request->tablet_count,
            'distribution_type_id' => $request->distribution_type_id,
            'validation' => $validation,
            'site_id' => $request->site_id ?? null,
            'famille_medicament'  => $request->famille_medicament,
        ]);

        return response()->json($medicament, 201);
    }

    public function validateMedications(Request $request)
    {
        \Log::info($request->all());

        try {
            $request->validate([
                'ids' => 'required|array',
                'ids.*' => 'exists:medications,id'
            ]);

            Medication::whereIn('id', $request->ids)->update(['validation' => true]);

            return response()->json(['message' => 'Médicaments validés avec succès']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    // Mettre à jour un médicament
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'stock_quantity' => 'required|integer',
            'expiration_date' => 'required|date',
            'supplier' => 'required|string',
            'supply_date' => 'required|date',
            'unit_price' => 'required|numeric',
            'tablet_count' => 'required|integer',
            'distribution_type_id' => 'required|exists:type_distributions,id', // Assurez-vous que ce champ correspond à un ID valide
            'famille_medicament' => 'nullable|string', // Si ce champ peut être vide
        ]);

        $medicament = Medication::findOrFail($id);

        $alertThreshold = $request->input('alert_threshold', null);
        if (is_null($alertThreshold)) {
            $alertThreshold = $request->input('stock_quantity') * 0.30;
        }

        $medicament->update([
            'name' => $request->name,
            'stock_quantity' => $request->stock_quantity,
            'alert_threshold' => $alertThreshold,
            'expiration_date' => $request->expiration_date,
            'supplier' => $request->supplier,
            'supply_date' => $request->supply_date,
            'unit_price' => $request->unit_price,
            'tablet_count' => $request->tablet_count,
            'distribution_type_id' => $request->distribution_type_id,
            'famille_medicament' => $request->famille_medicament,
            'site_id' => $request->site_id ?? $medicament->site_id,
        ]);

        return response()->json($medicament);
    }

        public function getMedicationById($id)
    {
        $medication = Medication::find($id);

        if ($medication) {
            return response()->json($medication); // Retourne les données du médicament en JSON
        }

        return response()->json(['message' => 'Médicament non trouvé'], 404);
    }

        public function validateMedication($id)
    {
        $medication = Medication::findOrFail($id);
        $medication->validation = 1;
        $medication->save();

        return response()->json(['message' => 'Médicament validé avec succès.']);
    }

    // Supprimer un médicament
    public function destroy($id)
    {
        $medicament = Medication::findOrFail($id);
        $medicament->delete();

        return response()->json(['message' => 'Médicament supprimé avec succès']);
    }

    public function showImportForm()
    {
        return view('medications');
    }

    public function import(Request $request)
    {
        // Validation du fichier
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        // Importation des données du fichier
        try {
            Excel::import(new MedicationsImport, $request->file('file'));
            return redirect()->route('medications')->with('success', 'Médicaments importés avec succès!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de l\'importation : ' . $e->getMessage());
        }
    }


}
