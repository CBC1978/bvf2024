<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\auth\authController;
use \App\Http\Controllers\offer\offerController;
use Illuminate\Routing\AbstractRouteCollection;
use \App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Carrier\profile\CarrierProfileController;
use App\Http\Controllers\Shipper\profile\ShipperProfile1Controller;
use App\Http\Controllers\Profile\ProfileController;

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
Route::get('/discussion', [offerController::class, 'chat'])->name('chat');
Route::get('/discussions', [offerController::class, 'chatInverse'])->name('chatInverse');
Route::post('/envoyer-message', [offerController::class, 'sendChat'])->name('sendChat');
Route::get('/logout', [authController::class, 'logout'])->name('logout');
Route::get('/', [authController::class, 'index'])->name('index');
Route::get('/confirmation-email', [authController::class, 'verifyEmail'])->name('verifyEmail');

Route::post('/changer-mot-de-passe', [authController::class, 'updatePassword'])->name('updatePassword');
Route::post('/login', [authController::class, 'login'])->name('login');
Route::get('/admin_home', [authController::class, 'login'])->name('admin_home');
//Auth end routes

//Offer routes
Route::get('/villes', [offerController::class, 'getAllVille'])->name('getVille');
Route::get('/type-car', [offerController::class, 'getAllTypeCar'])->name('getAllTypeCar');
Route::get('/brand-car', [offerController::class, 'getAllBrandCar'])->name('getAllBrandCar');
Route::get('/cars', [offerController::class, 'getCarByCarrier'])->name('getCarByCarrier');
Route::get('/accueil', [offerController::class, 'home'])->name('home');
Route::get('/offres', [offerController::class, 'getOffers'])->name('getOffers');
Route::get('/offres-reçues', [offerController::class, 'getOffersReceived'])->name('getOffersReceived');
Route::get('/offres-reçues/detail/{id}', [offerController::class, 'getOffersReceivedDetail'])->name('getOffersReceivedDetail');
Route::get('/offre/{id}', [offerController::class, 'getOfferOne'])->name('getOfferOne');
Route::get('/offre/statut/modifier/{id}/{action}', [offerController::class, 'updateStatutOffer'])->name('updateStatutOffer');
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
Route::get('/email/test', [offerController::class, 'sendEmail'])->name('sendEmail');
//end Offer route


//Contrat, Car, Driver
Route::get('/contrat', [offerController::class, 'getContrat'])->name('getContrat');
Route::get('/contrat/{id}', [offerController::class, 'getContratDetail'])->name('getContratDetail');
Route::get('/contrat/modifier/{id}', [offerController::class, 'updateContrat'])->name('updateContrat');
Route::post('/contrat/modifier/contrat', [offerController::class, 'updateStoreContrat'])->name('updateStoreContrat');
Route::post('/contrat/camion/ajouter', [offerController::class, 'storeCar'])->name('storeCar');
Route::get('/contrat/camion/{id}', [offerController::class, 'getCarOne'])->name('getCarOne');
Route::post('/contrat/camion/modifier', [offerController::class, 'updateCar'])->name('updateCar');
Route::get('/contrat/camion/supprimer/{id}', [offerController::class, 'deleteCar'])->name('deleteCar');
Route::post('/contrat/conducteur/ajouter', [offerController::class, 'storeDriver'])->name('storeDriver');
Route::get('/contrat/conducteur/{id}', [offerController::class, 'getDriverOne'])->name('getDriverOne');
Route::post('/contrat/conducteur/modifier', [offerController::class, 'updateDriver'])->name('updateDriver');
Route::get('/contrat/conducteur/supprimer/{id}', [offerController::class, 'deleteDriver'])->name('deleteDriver');
Route::get('/contrat/print/{id}', [offerController::class, 'printContrat'])->name('printContrat');

//end Contrat route

//Les routes  ADMIN
Route::get('/admin.OfferShipper', [AdminController::class, 'displayOfferShipper'])->name('admin.OfferShipper');
Route::get('/admin.OfferTransporter', [AdminController::class, 'displayOfferTransporter'])->name('admin.OfferTransporter');
Route::get('/DisplayregisterAdmin', [AdminController::class, 'DisplayregisterAdmin'])->name('DisplayregisterAdmin');
Route::post('/registerAdmin', [AdminController::class, 'AdminRegister'])->name('registerForAdmin');



Route::prefix('annonces')->group(function () {
    Route::get('/', [AdminController::class, 'displayAnnouncement'])->name('annonces.a_annonce');
    Route::get('/transport-offer', [AdminController::class, 'displayAnnounceTransport'])->name('annonces.a_annonceTransporter');

});

Route::get('/transporteur', [AdminController::class, 'displayEntrepriseTransporteur'])->name('transporteur');
Route::get('/chargeur', [AdminController::class, 'displayEntrepriseChargeur'])->name('chargeur');
Route::post('/assigner-entreprise-user', [AdminController::class, 'assignEntrepriseToUser'])->name('admin.assigner-entreprise-user');
Route::post('/ajouter-transporteur', [AdminController::class, 'addCarrier'])->name('admin.ajouter-transporteur');
Route::post('/ajouter-expediteur', [AdminController::class, 'addShipper'])->name('admin.ajouter-expediteur');

// Profil admin
Route::get('admin/profile', [AdminController::class,'displayProfile'])->name('admin.profile.affichage');
Route::get('admin/profile/update', [AdminController::class,'updateUserProfile'])->name('admin.profile.update');
Route::get('admin/profile/update', [AdminController::class,'update'])->name('admin.profile.update');
Route::post('admin/profile/update', [AdminController::class,'update'])->name('admin.profile.update');
Route::get('admin/profile', [AdminController::class,'affichage'])->name('admin.profile.affichage');

//profil transporteur
Route::get('/profile', [CarrierProfileController::class,'affichage'])->name('carrier.profile.affichage');
Route::get('profile/update', [CarrierProfileController::class,'update'])->name('carrier.profile.update');
Route::post('profile/update', [CarrierProfileController::class,'update'])->name('carrier.profile.update');

//Profil


// Route pour afficher le profil
Route::get('/profile', [ProfileController::class, 'affichage'])->name('profile.affichage');
// Route pour mettre à jour le profil
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// end offer routes

//Utilisateurs routes
    Route::get('/utilisateurs/valide', [authController::class, 'getUsersValide'])->name('getUsersValide');
    Route::get('/utilisateurs/en-attente', [authController::class, 'getUsersNoValide'])->name('getUsersNoValide');
    Route::get('/register', [authController::class, 'index2'])->name('register');
    Route::post('/register', [authController::class, 'register'])->name('registerUser');
    Route::get('/codeRequest', [authController::class, 'codeRequest'])->name('codeRequest');
    Route::post('/otp-verify', [authController::class, 'otpVerify'])->name('otpVerify');

Route::get('/admin.OfferShipper', [AdminController::class, 'displayOfferShipper'])->name('admin.OfferShipper');
Route::get('/admin.OfferTransporter', [AdminController::class, 'displayOfferTransporter'])->name('admin.OfferTransporter');
// end offer routes

//Utilisateurs routes
Route::get('/utilisateurs/valide', [authController::class, 'getUsersValide'])->name('getUsersValide');
//end Utilisateurs routes
