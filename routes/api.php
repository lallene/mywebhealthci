<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\TypeDistributionController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\Motif_consultationController;
use App\Http\Controllers\MedocRapportController;
use App\Http\Controllers\RapportStockController;
use Illuminate\Http\Request;
use App\Http\Controllers\MedicamentStockController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/agents', [AgentController::class, 'index'])->name('new');

Route::resource('type-distributions', TypeDistributionController::class)->except(['create', 'edit']);

Route::resource('medications', MedicationController::class);
Route::resource('stocks', StockController::class);


Route::put('/medications/{id}/validate', [MedicationController::class, 'validateMedication']);
route::get('/prestocks', [StockController::class, 'prestocks'])->name('prestocks');

Route::get('/motifs', [Motif_consultationController::class, 'getMotifsJson'])->name('motifs');
//Route::get('/stock-disponible/{id}', [StockController::class, 'showStockSite'])->name('stock_disponible');
Route::get('/api/consommation-medicaments', [MedocRapportController::class, 'getConsommationMedicamentJSON']);

Route::get('/stocks/gestion-globale', [StockController::class, 'showStocks'])->name('stocks.gestionGlobale');

Route::get('/stocks', [StockController::class, 'index']);

Route::get('/dispo', [StockController::class, 'getStockParDate']);
Route::get('/StockGlobal', [StockController::class, 'getStockParSite'])->name('stocks.sites');


Route::get('/medicaments/used', [MedicamentStockController::class, 'UsedMedoc']);
Route::get('/medicaments/top-users', [MedicamentStockController::class, 'topUsersMedicaments'])
    ->name('api.medicaments.top-users');
Route::get('/medicaments/top-medecins', [MedicamentStockController::class, 'topMedecinsParDate']);

Route::get('/medicaments/top-projets', [MedicamentStockController::class, 'topProjetsParSite'])
     ->name('medicaments.top-projets');


Route::get('/medicaments/comparer-stocks', [MedicamentStockController::class, 'comparerStocksParSupplyDate'])
    ->name('medicaments.comparer-stocks'); // <-- plus cohérent avec GET







