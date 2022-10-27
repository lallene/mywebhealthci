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
});


Route::get('profil/permission/{id}', [\App\Http\Controllers\RoleController::class, 'permissions']);
Route::get('profil/addPermission/{id}', [\App\Http\Controllers\RoleController::class, 'addPermission']);
Route::post('profil/grantPermission/{id}', [\App\Http\Controllers\RoleController::class, 'grantPermission']);
Route::get('profil/revoquer/{idRole}/{idPermission}', [\App\Http\Controllers\RoleController::class, 'revoquer']);
