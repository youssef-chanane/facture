<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', [App\Http\Controllers\TaxeController::class, 'index']);

Auth::routes();
//home page
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//facture routes
Route::get('/factures/{taxe}/create', [App\Http\Controllers\FactureController::class, 'create'])->name('factures.create');
Route::get('factures/{facture}/show',[App\Http\Controllers\FactureController::class, 'show'])->name('factures.show');
Route::post('/factures/{taxe}', [App\Http\Controllers\FactureController::class, 'store'])->name('factures.store');
//taxes routes
Route::get('/taxes/trimestriel', [App\Http\Controllers\TaxeController::class, 'trimestriel'])->name('taxes.trimestriel');
Route::get('/taxes/annuel', [App\Http\Controllers\TaxeController::class, 'annuel'])->name('taxes.annuel');
Route::get('/taxes/mensuel', [App\Http\Controllers\TaxeController::class, 'mensuel'])->name('taxes.mensuel');
Route::resource('/taxes','TaxeController');
//client route
Route::resource('/clients','ClientController');
//counter route
Route::resource('/counters','CounterController');
// Route::resource('/factures','FactureController');