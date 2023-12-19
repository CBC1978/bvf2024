<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\auth\authController;
use \App\Http\Controllers\offer\offerController;
use Illuminate\Routing\AbstractRouteCollection;


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
Route::post('/logout', [authController::class, 'logout'])->name('logout');
Route::get('/', [authController::class, 'index'])->name('index');
Route::get('/confirmation-email', [authController::class, 'verifyEmail'])->name('verifyEmail');

Route::post('/changer-mot-de-passe', [authController::class, 'updatePassword'])->name('updatePassword');
Route::post('/login', [authController::class, 'login'])->name('login');
Route::get('/admin_home', [authController::class, 'login'])->name('admin_home');
//Auth end routes

//Offer routes
Route::get('/villes', [offerController::class, 'getAllVille'])->name('getVille');
Route::get('/type-car', [offerController::class, 'getAllTypeCar'])->name('getAllTypeCar');
Route::get('/accueil', [offerController::class, 'home'])->name('home');
Route::get('/offres', [offerController::class, 'getOffers'])->name('getOffers');
Route::get('/offres-reçues', [offerController::class, 'getOffersReceived'])->name('getOffersReceived');
Route::get('/offre/{id}', [offerController::class, 'getOfferOne'])->name('getOfferOne');
Route::get('/offre-publie/{id}', [offerController::class, 'getOfferPublishOne'])->name('getOfferPublishOne');
Route::get('/offre-postulée/{id}', [offerController::class, 'getOfferApplyOne'])->name('getOfferApplyOne');
Route::get('/offres-non-reçues', [offerController::class, 'getOffersNotReceived'])->name('getOffersNotReceived');
Route::get('/mes-offres-postulées', [offerController::class, 'getOffersApply'])->name('getOffersApply');
Route::post('/postuler-offre', [offerController::class, 'storeApplyOffer'])->name('storeApplyOffer');
Route::post('/publier-offre', [offerController::class, 'storePublishOffer'])->name('storePublishOffer');
Route::post('/modifier-offre-publier', [offerController::class, 'updatePublishOffer'])->name('updatePublishOffer');
Route::post('/modifier-offre-postuler', [offerController::class, 'updateApplyOffer'])->name('updateApplyOffer');
Route::get('/supprimer-offre/{id}', [offerController::class, 'deletePublishOffer'])->name('deletePublishOffer');
Route::get('/supprimer-offre-postulées/{id}', [offerController::class, 'deleteApplyOffer'])->name('deleteApplyOffer');

//Les routes  ADMIN
Route::prefix('annonces')->group(function () {
    Route::get('/', [AdminController::class, 'displayAnnouncement'])->name('annonces.a_annonce');
    Route::get('/transport-offer', [AdminController::class, 'displayAnnounceTransport'])->name('annonces.a_annonceTransporter');
    
});
// end offer routes

//Utilisateurs routes
    Route::get('/utilisateurs/valide', [authController::class, 'getUsersValide'])->name('getUsersValide');


//end Utilisateurs routes
