<?php

use \App\Http\Controllers\admin\AdminController;
use Illuminate\Support\Facades\Route;

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
Route::get('/modifier-chargeur-statut/{id}', [AdminController::class, 'updateShipperStatut'])->name('updateShipperStatut');
Route::post('/assigner-entreprise-user', [AdminController::class, 'assignEntrepriseToUser'])->name('admin.assigner-entreprise-user');
Route::post('/ajouter-transporteur', [AdminController::class, 'addCarrier'])->name('admin.ajouter-transporteur');
Route::post('/ajouter-chargeur', [AdminController::class, 'addShipper'])->name('admin.ajouter-chargeur');
Route::post('/modifier-transporteur', [AdminController::class, 'updateCarrier'])->name('updateCarrier');
Route::get('/modifier-transporteur-statut/{id}', [AdminController::class, 'updateCarrierStatut'])->name('updateCarrierStatut');

Route::get('/modifier-transporteur/{id}', [AdminController::class, 'getCarrierOne'])->name('getCarrierOne');
Route::post('/ajouter-expediteur', [AdminController::class, 'addShipper'])->name('admin.ajouter-expediteur');
Route::prefix('annonces')->group(function () {
    Route::get('/', [AdminController::class, 'displayAnnouncement'])->name('annonces.a_annonce');
    Route::get('/transport-offer', [AdminController::class, 'displayAnnounceTransport'])->name('annonces.a_annonceTransporter');

});
Route::get('admin/profile', [AdminController::class,'displayProfile'])->name('admin.profile.affichage');
Route::get('admin/profile/update', [AdminController::class,'updateUserProfile'])->name('admin.profile.update');
Route::get('admin/profile/update', [AdminController::class,'update'])->name('admin.profile.update');
Route::post('admin/profile/update', [AdminController::class,'update'])->name('admin.profile.update');
Route::get('admin/profile', [AdminController::class,'affichage'])->name('admin.profile.affichage');
Route::get('/admin/OfferShipper', [AdminController::class, 'displayOfferShipper'])->name('admin.OfferShipper');
Route::get('/admin/OfferShipper/{id}', [AdminController::class, 'displayOfferShipperOne'])->name('admin.displayOfferShipperOne');
Route::get('/admin.OfferTransporter', [AdminController::class, 'displayOfferTransporter'])->name('admin.OfferTransporter');
Route::get('/admin.OfferShipper', [AdminController::class, 'displayOfferShipper'])->name('admin.OfferShipper');
Route::get('/admin.OfferTransporter', [AdminController::class, 'displayOfferTransporter'])->name('admin.OfferTransporter');
Route::get('/DisplayregisterAdmin', [AdminController::class, 'DisplayregisterAdmin'])->name('DisplayregisterAdmin');
Route::post('/registerAdmin', [AdminController::class, 'AdminRegister'])->name('registerForAdmin');
