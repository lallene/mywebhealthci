<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('profil', \App\Http\Controllers\RoleController::class);
    Route::resource('permission', \App\Http\Controllers\PermissionController::class);
    Route::resource('user', \App\Http\Controllers\UtilisateurController::class);
    Route::resource('site', \App\Http\Controllers\SiteController::class);
    Route::resource('societe', \App\Http\Controllers\SocieteController::class);
    Route::resource('famille', \App\Http\Controllers\FamilleemploiController::class);
    Route::resource('emploi', \App\Http\Controllers\EmploiController::class);
    Route::resource('fonction', \App\Http\Controllers\FonctionController::class);
    Route::resource('sub_fonction', \App\Http\Controllers\Sub_FonctionController::class);
    Route::resource('typecontrat', \App\Http\Controllers\ContratController::class);
    Route::resource('agent_sante', \App\Http\Controllers\Agent_santeController::class);
    Route::resource('motif_consultation', \App\Http\Controllers\Motif_consultationController::class);
    Route::resource('maladie_contagieuse', \App\Http\Controllers\Maladie_contagieuseController::class);
    Route::resource('maladie_prof', \App\Http\Controllers\Maladie_profController::class);
    Route::resource('consultation', \App\Http\Controllers\ConsultationController::class);
    Route::resource('justificatif_externe', \App\Http\Controllers\Justificatif_externeController::class);
    Route::resource('projet', \App\Http\Controllers\ProjetController::class);
    //Route::resource('teste', \App\Http\Controllers\TesteController::class);

    Route::resource('effectif', \App\Http\Controllers\AgentController::class);
    Route::resource('medicament', \App\Http\Controllers\MedicamentController::class);
});


Route::get('profil/permission/{id}', [\App\Http\Controllers\RoleController::class, 'permissions']);
Route::get('profil/addPermission/{id}', [\App\Http\Controllers\RoleController::class, 'addPermission']);
Route::post('profil/grantPermission/{id}', [\App\Http\Controllers\RoleController::class, 'grantPermission']);
Route::get('profil/revoquer/{idRole}/{idPermission}', [\App\Http\Controllers\RoleController::class, 'revoquer']);
