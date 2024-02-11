<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\auth\authController;
use \App\Http\Controllers\offer\offerController;
use \App\Http\Controllers\admin\AdminController;
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
Route::get('/', [authController::class, 'index'])->name('index');
Route::get('/confirmation-email', [authController::class, 'verifyEmail'])->name('verifyEmail');
Route::post('/changer-mot-de-passe', [authController::class, 'updatePassword'])->name('updatePassword');
Route::post('/login', [authController::class, 'login'])->name('login');
Route::get('/register', [authController::class, 'index2'])->name('register');
Route::get('/codeRequest', [authController::class, 'codeRequest'])->name('codeRequest');

//Route::middleware([\App\Http\Middleware\AuthUser::class])->group(function ()

Route::get('/discussion', [offerController::class, 'chat'])->name('chat');
Route::get('/discussions', [offerController::class, 'chatInverse'])->name('chatInverse');
Route::post('/envoyer-message', [offerController::class, 'sendChat'])->name('sendChat');
Route::get('/logout', [authController::class, 'logout'])->name('logout');

Route::get('/admin_home', [authController::class, 'login'])->name('admin_home');
Route::get('/affecter-utilisateur-entreprise', [authController::class, 'getUserEntreprise'])->name('getUserEntreprise');
Route::get('/affecter-utilisateur/{id}', [authController::class, 'affectUserEntreprise'])->name('affectUserEntreprise');
Route::get('/affecter-utilisateur/{id}', [authController::class, 'affectUserEntreprise'])->name('affectUserEntreprise');
Route::post('/utilisateur/modifier', [authController::class, 'updateUser'])->name('updateUser');
Route::get('/utilisateurs/supprimer/{id}', [authController::class, 'deleteUser'])->name('deleteUser');
Route::get('/profil', [authController::class,'getProfil'])->name('getProfil');
Route::post('profil/update', [authController::class,'updateProfil'])->name('updateProfil');
//Route::post('profile/update', [CarrierProfileController::class,'update'])->name('carrier.profile.update');

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
Route::get('/entreprise/{type}/{role}', [offerController::class, 'getEntreprise'])->name('getEntreprise');
//end Offer route

//Contrat, Car, Driver
Route::get('/contrat', [offerController::class, 'getContrat'])->name('getContrat');
Route::get('/contrat/{id}', [offerController::class, 'getContratDetail'])->name('getContratDetail');
Route::get('/contrat/modifier/{id}', [offerController::class, 'updateContrat'])->name('updateContrat');
Route::post('/contrat/modifier/contrat', [offerController::class, 'updateStoreContrat'])->name('updateStoreContrat');
Route::post('/camion/ajouter', [offerController::class, 'storeCar'])->name('storeCar');
Route::post('/contrat/camion/ajouter', [offerController::class, 'storeCarContrat'])->name('storeCarContrat');
Route::get('/contrat/camion/{id}', [offerController::class, 'getCarOne'])->name('getCarOne');
Route::post('/contrat/camion/modifier', [offerController::class, 'updateCar'])->name('updateCar');
Route::get('/contrat/camion/supprimer/{id}', [offerController::class, 'deleteCar'])->name('deleteCar');
Route::post('/contrat/conducteur/ajouter', [offerController::class, 'storeDriver'])->name('storeDriver');
Route::get('/contrat/conducteur/{id}', [offerController::class, 'getDriverOne'])->name('getDriverOne');
Route::post('/contrat/conducteur/modifier', [offerController::class, 'updateDriver'])->name('updateDriver');
Route::get('/contrat/conducteur/supprimer/{id}', [offerController::class, 'deleteDriver'])->name('deleteDriver');
Route::get('/contrat/print/{id}', [offerController::class, 'printContrat'])->name('printContrat');
Route::get('/vehicules', [offerController::class, 'getVehicule'])->name('getVehicule');
Route::get('/vehicules/api', [offerController::class, 'getVehicules'])->name('getVehicules');

//end Contrat route

//Les routes  ADMIN
Route::get('/admin.OfferShipper', [AdminController::class, 'displayOfferShipper'])->name('admin.OfferShipper');
Route::get('/admin.OfferTransporter', [AdminController::class, 'displayOfferTransporter'])->name('admin.OfferTransporter');
Route::get('/DisplayregisterAdmin', [AdminController::class, 'DisplayregisterAdmin'])->name('DisplayregisterAdmin');
Route::post('/registerAdmin', [AdminController::class, 'AdminRegister'])->name('registerForAdmin');

//Routes Notifications
Route::get('/notifications', [authController::class, 'getNotifications'])->name('getNotifications');
Route::get('/notifications/consulter', [authController::class, 'displayNotifications'])->name('displayNotifications');


//End routes notifications


Route::prefix('annonces')->group(function () {
    Route::get('/', [AdminController::class, 'displayAnnouncement'])->name('annonces.a_annonce');
    Route::get('/transport-offer', [AdminController::class, 'displayAnnounceTransport'])->name('annonces.a_annonceTransporter');

});
//Admin routes
Route::get('/transporteur', [AdminController::class, 'displayEntrepriseTransporteur'])->name('transporteur');
Route::get('/transporteur/liste', [AdminController::class, 'getCarriers'])->name('getCarriers');
Route::get('/transporteur/{id}', [AdminController::class, 'getCarrierUsers'])->name('getCarrierUsers');
Route::get('/affecter-user-transporteur/{id}', [AdminController::class, 'assignCarrierUsers'])->name('assignCarrierUsers');
Route::get('/chargeur', [AdminController::class, 'displayEntrepriseChargeur'])->name('chargeur');
Route::get('/chargeur/liste', [AdminController::class, 'getShippers'])->name('getShippers');
Route::get('/modifier-chargeur/{id}', [AdminController::class, 'getShipperOne'])->name('getShipperOne');
Route::get('/chargeur/{id}', [AdminController::class, 'getShipperUsers'])->name('getShipperUsers');
Route::post('/modifier-chargeur', [AdminController::class, 'updateShipper'])->name('updateShipper');
Route::post('/assigner-entreprise-user', [AdminController::class, 'assignEntrepriseToUser'])->name('admin.assigner-entreprise-user');
Route::post('/ajouter-transporteur', [AdminController::class, 'addCarrier'])->name('admin.ajouter-transporteur');
Route::post('/ajouter-chargeur', [AdminController::class, 'addShipper'])->name('admin.ajouter-chargeur');
Route::post('/modifier-transporteur', [AdminController::class, 'updateCarrier'])->name('updateCarrier');

Route::get('/modifier-transporteur/{id}', [AdminController::class, 'getCarrierOne'])->name('getCarrierOne');
Route::post('/ajouter-expediteur', [AdminController::class, 'addShipper'])->name('admin.ajouter-expediteur');

//end admin route

// Profil admin
Route::get('admin/profile', [AdminController::class,'displayProfile'])->name('admin.profile.affichage');
Route::get('admin/profile/update', [AdminController::class,'updateUserProfile'])->name('admin.profile.update');
Route::get('admin/profile/update', [AdminController::class,'update'])->name('admin.profile.update');
Route::post('admin/profile/update', [AdminController::class,'update'])->name('admin.profile.update');
Route::get('admin/profile', [AdminController::class,'affichage'])->name('admin.profile.affichage');


//Profil
// Route pour afficher le profil
Route::get('/profile', [ProfileController::class, 'affichage'])->name('profile.affichage');
// Route pour mettre à jour le profil
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// end offer routes

//Utilisateurs routes
Route::get('/utilisateurs/valide', [authController::class, 'getUsersValide'])->name('getUsersValide');
Route::get('/utilisateur/session/update', [authController::class, 'updateSession'])->name('updateSession');
Route::get('/utilisateur/{id}', [authController::class, 'getUserOne'])->name('getUserOne');
Route::get('/utilisateur/{action}/{id}', [authController::class, 'updateStatutUser'])->name('updateStatutUser');
Route::get('/utilisateurs/en-attente', [authController::class, 'getUsersNoValide'])->name('getUsersNoValide');

Route::post('/register', [authController::class, 'register'])->name('registerUser');

Route::post('/otp-verify', [authController::class, 'otpVerify'])->name('otpVerify');

Route::get('/admin.OfferShipper', [AdminController::class, 'displayOfferShipper'])->name('admin.OfferShipper');
Route::get('/admin.OfferTransporter', [AdminController::class, 'displayOfferTransporter'])->name('admin.OfferTransporter');
// end offer routes

//Utilisateurs routes
Route::get('/utilisateurs/valide', [authController::class, 'getUsersValide'])->name('getUsersValide');
//end Utilisateurs routes

//});
