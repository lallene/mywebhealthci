<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\MedocRapportController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\MedicamentStockController;
use App\Http\Controllers\RapportConsultationController;




use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::get('/findProjet/{id}', [HomeController::class, 'findProjet'])->name('findProjet');


Auth::routes();


Route::group(['middleware' => ['auth']], function() {
    Route::resource('profil', \App\Http\Controllers\RoleController::class);
    Route::resource('permission', \App\Http\Controllers\PermissionController::class);
    Route::resource('site', \App\Http\Controllers\SiteController::class);
    Route::resource('societe', \App\Http\Controllers\SocieteController::class);
    Route::resource('famille', \App\Http\Controllers\FamilleemploiController::class);
    Route::resource('emploi', \App\Http\Controllers\EmploiController::class);
    Route::resource('fonction', \App\Http\Controllers\FonctionController::class);
    Route::resource('sub_fonction', \App\Http\Controllers\Sub_FonctionController::class);
    Route::resource('typecontrat', \App\Http\Controllers\ContratController::class);
    Route::resource('motif_consultation', \App\Http\Controllers\Motif_consultationController::class);
    Route::resource('consultation', \App\Http\Controllers\ConsultationController::class);
    Route::resource('justificatif_externe', \App\Http\Controllers\JustificatifController::class);
    Route::resource('projet', \App\Http\Controllers\ProjetController::class);
    Route::resource('effectif', \App\Http\Controllers\AgentController::class);
    Route::resource('medicament', \App\Http\Controllers\MedicamentController::class);
    //Route::resource('matricle', \App\Http\Controllers\MatriculeControlleur::class);
});




// Routes pour l'utilisateur
Route::prefix('utilisateurs')->middleware(['auth', 'role:IT'])->group(function() {
    // Afficher la liste des utilisateurs
    Route::get('/', [UtilisateurController::class, 'index'])->name('users.index');

    // Afficher le formulaire de création d'un utilisateur
    Route::get('/create', [UtilisateurController::class, 'create'])->name('users.create');

    // Enregistrer un nouvel utilisateur
    Route::post('/', [UtilisateurController::class, 'store'])->name('users.store');

    // Afficher les détails d'un utilisateur
    Route::get('{id}', [UtilisateurController::class, 'show'])->name('users.show');

    // Afficher le formulaire de modification d'un utilisateur
    Route::get('{id}/edit', [UtilisateurController::class, 'edit'])->name('users.edit');

    // Mettre à jour un utilisateur
    Route::put('{id}', [UtilisateurController::class, 'update'])->name('users.update');

    // Supprimer un utilisateur
    Route::delete('{id}', [UtilisateurController::class, 'destroy'])->name('users.destroy');



});

Route::get('change-password', [UtilisateurController::class, 'showChangePasswordForm'])->name('changePassword');
Route::post('change-password', [UtilisateurController::class, 'updatePassword'])->name('updatePassword');
Route::get('profil/permission/{id}', [\App\Http\Controllers\RoleController::class, 'permissions']);
Route::get('profil/addPermission/{id}', [\App\Http\Controllers\RoleController::class, 'addPermission']);
Route::post('profil/grantPermission/{id}', [\App\Http\Controllers\RoleController::class, 'grantPermission']);
Route::get('profil/revoquer/{idRole}/{idPermission}', [\App\Http\Controllers\RoleController::class, 'revoquer']);

Route::post('/effectif/import', [App\Http\Controllers\AgentController::class, 'import'])->name('import_agent');

Route::get('/agents', function () {
    return view('configuration.consultation.newsearch'); // Remplacez 'agents.index' par le chemin de votre vue Blade
})->name('newconsultation');

// Route pour rechercher les agents via API
Route::get('api/agents', [AgentController::class, 'index']);
Route::get('/effectifs',[App\Http\Controllers\AgentController::class, 'liste'])->name('effectifs'); // Remplacez 'agents.index' par le chemin de votre vue Blade


Route::post('/importprojet', [App\Http\Controllers\ProjetController::class, 'import']);
Route::post('/importemploi', [App\Http\Controllers\EmploiController::class, 'import']);
Route::post('/importsubfonction', [App\Http\Controllers\Sub_FonctionController::class, 'import']);
Route::post('/importmotif', [App\Http\Controllers\Motif_consultationController::class, 'import']);
Route::post('/importmatricule', [App\Http\Controllers\MatriculeControlleur::class, 'import']);
Route::get('home/export/', [HomeController::class, 'export']);



Route::post('/getAgent/{id}', [\App\Http\Controllers\AgentController::class, 'getAgentByIris'])->name('getAgent');
Route::get('/consulter/{id}', [\App\Http\Controllers\ConsultationController::class, 'consulter']);
Route::get('/reception/{id}', [\App\Http\Controllers\JustificatifController::class, 'reception']);
Route::get('/recherche', [App\Http\Controllers\SearchController::class, 'index'])->name('recherche');
Route::get('/iris', [App\Http\Controllers\search_irisController::class, 'index'])->name('iris');
Route::get('/iris/simple', [App\Http\Controllers\search_irisController::class, 'simple'])->name('simple_search');
Route::get('/iris/export', [App\Http\Controllers\search_irisController::class, 'export'])->name('simple_search_export');
Route::get('/recherce/advance', [App\Http\Controllers\SearchController::class, 'advance'])->name('advance_search');
Route::get('/dashboard',[\App\Http\Controllers\HomeController::class, 'filter'])->name('filter');
Route::get('/recherce/export/', [App\Http\Controllers\SearchController::class, 'export'])->name('exprot_consultation');



Route::get('/rapport', [App\Http\Controllers\RapportController::class, 'index'])->name('rapport');
Route::get('/rapport/search', [App\Http\Controllers\RapportController::class, 'rapport'])->name('rapport_search');
Route::get('/rapport/envoi}', [App\Http\Controllers\RapportController::class, 'export'])->name('rapportsend');


Route::get('/rapport/envoi/', [App\Http\Controllers\SearchController::class, 'export'])->name('rapportsearch');



Route::get('/historique', [ConsultationController::class, 'histo'])->name('historique');




Route::get('/home/preview', [App\Http\Controllers\HomeController::class, 'preview'])->name('dashboardpreview');
Route::get('/home/download', [App\Http\Controllers\HomeController::class, 'download'])->name('dashboarddownload');



Route::get('/send-rapport', [App\Http\Controllers\RapportController::class, 'sendMailWitchExecel'])->name('sendMailWitchExecel');

Route::get('/type-distributions', function () {
    return view('type_distributions.index');
})->name('type-distributions');



Route::get('/medications', function () {
    return view('medications.index');
})->name('medications');



Route::get('/medications/affectation', function () {
    return view('medications.affectation');
})->name('medications.affectation');



Route::get('/stocks', function () {
    return view('stocks.index');
})->name('stocks');

Route::get('/check', function () {
    return view('configuration.consultation.check');
})->name('check');



// Affiche la vue Blade
Route::get('/medicaments/used/view', function () {
    return view('medicaments.used');
});





Route::get('/medicaments/top-users', function () {
    return view('medicaments.top_users');
})->name('medicaments.top-users-view');


Route::get('/medicaments/top-medecins', function () {
    return view('medicaments.top_medecins');
})->name('api.medicaments.medecin');


Route::get('/medicaments/top-projets', function () {
    return view('medicaments.top_projets');
})->name('api.medicaments.projets');

Route::get('/medicaments/compare-stocks', function () {
    return view('medicaments.compare_stocks');
})->name('api.medicaments.compare');

// API pour UsedMedoc
Route::get('/api/medicaments/used', [MedicamentStockController::class, 'UsedMedoc'])
    ->name('api.medicaments.used');


// Affichage des données
Route::get('/export-medicaments', [ExportMedicamentController::class, 'index'])->name('export.medicaments');
// Exporter les données au format CSV
Route::get('/export-medicaments/csv', [ExportMedicamentController::class, 'exportToCSV'])->name('export.medicaments.csv');


Route::get('/rapport-medo', [MedocRapportController::class, 'index'])->name('medoc');


Route::get('/medicaments/import', [MedicationController::class, 'showImportForm'])->name('medicaments.import');
Route::post('/medicaments/import', [MedicationController::class, 'import'])->name('medicaments.import.post');
Route::get('/medication/{id}', [MedicationController::class, 'getMedicationById']);

Route::get('/export-medicaments', [ExportController::class, 'index'])->name('export.medicaments');
Route::get('/export-medicaments/csv', [ExportController::class, 'exportToCSV'])->name('export.medicaments.csv');


Route::prefix('medicaments')->name('medicaments.')->group(function () {

    Route::get('consommation', function () {
        return view('medicaments.consommation_medicaments');
    })->name('consommation');

    Route::get('consommation-par-projet-site', function () {
        return view('medicaments.consommation_par_projet_site');
    })->name('consommation_par_projet_site');

    Route::get('evolution-budget-pharmacie', function () {
        return view('medicaments.evolution_budget_pharmacie');
    })->name('evolution_budget_pharmacie');

    Route::get('cout-achats-consommations', function () {
        return view('medicaments.cout_achats_consommations');
    })->name('cout_achats_consommations');

    Route::get('rupture-ou-seuil-critique', function () {
        return view('medicaments.medicaments_rupture_seuil_critique');
    })->name('rupture_seuil_critique');

    Route::get('proches-peremption', function () {
        return view('medicaments.medicaments_proches_peremption');
    })->name('proches_peremption');

    Route::get('evolution-stocks-consommation', function () {
        return view('medicaments.evolution_stocks_consommation');
    })->name('evolution_stocks_consommation');

    Route::get('historique-mouvements-stock', function () {
        return view('medicaments.historique_mouvements_stock');
    })->name('historique_mouvements_stock');

});





Route::get('/test-consommation', [MedocRapportController::class, 'getTestConsommation']);
Route::get('/consommationtest', [MedocRapportController::class, 'getConsommationMedicament']);
Route::get('/stocks/stats', [StockController::class, 'showStocks'])->name('stocks.show');

Route::get('/stocksparsite', function () {
    return view('stocks.stockparsite');
})->name('stocks.stockparsite');






Route::prefix('medicaments')->middleware(['auth'])->group(function() {
    Route::get('/', [MedicationController::class, 'index'])->name('medicaments.index');
    Route::get('/create', [MedicationController::class, 'create'])->name('medicaments.create');
    Route::post('/', [MedicationController::class, 'store'])->name('medicaments.store');
    Route::get('{id}', [MedicationController::class, 'show'])->name('medicaments.show');
    Route::get('{id}/edit', [MedicationController::class, 'edit'])->name('medicaments.edit');
    Route::put('{id}', [MedicationController::class, 'update'])->name('medicaments.update');
    Route::delete('{id}', [MedicationController::class, 'destroy'])->name('medicaments.destroy');

});

Route::get('/stocks/visualiserEtatStocks', [StockController::class, 'visualiserEtatStocks'])->name('visualiserEtatStocks');
Route::get('/stocks/showMedicationUsage', [StockController::class, 'showMedicationUsage'])->name('showMedicationUsage');
Route::get('/stocks/showStockSite', [StockController::class, 'showStockSite'])->name('showStockSite');
Route::get('/stock-disponible/{agent}', [StockController::class, 'stock_disponible']);
Route::get('/tests', [StockController::class, 'index']);






Route::get('/rapports', [RapportConsultationController::class, 'index'])->name('rapport.index');
Route::get('/api/consultations', [RapportConsultationController::class, 'getConsultationsJson'])->name('rapport.api');
Route::post('/rapports/send-mail', [RapportConsultationController::class, 'sendReportByMail'])->name('rapport.sendMail');
Route::delete('/consultations/{id}', [App\Http\Controllers\ConsultationController::class, 'destroy'])->name('consultations.destroy');





Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
