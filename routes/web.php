<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\auth\authController;
use \App\Http\Controllers\offer\offerController;

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

//Auth routes
Route::get('/', [authController::class, 'index'])->name('index');
Route::get('/confirmation-email', [authController::class, 'verifyEmail'])->name('verifyEmail');

Route::post('/changer-mot-de-passe', [authController::class, 'updatePassword'])->name('updatePassword');
Route::post('/login', [authController::class, 'login'])->name('login');
//Auth end routes

//Offer routes
Route::get('/villes', [offerController::class, 'getAllVille'])->name('getVille');
Route::get('/type-car', [offerController::class, 'getAllTypeCar'])->name('getAllTypeCar');
Route::get('/accueil', [offerController::class, 'home'])->name('home');
Route::get('/offres', [offerController::class, 'getOffers'])->name('getOffers');
Route::get('/offres-reçues', [offerController::class, 'getOffersReceived'])->name('getOffersReceived');
Route::get('/offre/{id}', [offerController::class, 'getOfferOne'])->name('getOfferOne');
Route::get('/offres-non-reçues', [offerController::class, 'getOffersNotReceived'])->name('getOffersNotReceived');
Route::post('/postuler-offre', [offerController::class, 'storeApplyOffer'])->name('storeApplyOffer');
Route::post('/publier-offre', [offerController::class, 'storePublishOffer'])->name('storePublishOffer');
Route::post('/modifier-offre-publier', [offerController::class, 'updatePublishOffer'])->name('updatePublishOffer');
Route::get('/supprimer-offre/{id}', [offerController::class, 'deletePublishOffer'])->name('deletePublishOffer');

// end offer routes
