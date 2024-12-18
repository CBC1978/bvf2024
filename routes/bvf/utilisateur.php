<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Profile\ProfileController;
use \App\Http\Controllers\auth\authController;


Route::get('/notifications', [authController::class, 'getNotifications'])->name('getNotifications');
Route::get('/notifications/consulter', [authController::class, 'displayNotifications'])->name('displayNotifications');
Route::get('/admin_home', [authController::class, 'login'])->name('admin_home');
Route::get('/affecter-utilisateur-entreprise', [authController::class, 'getUserEntreprise'])->name('getUserEntreprise');
Route::get('/affecter-utilisateur/{id}', [authController::class, 'affectUserEntreprise'])->name('affectUserEntreprise');
Route::get('/affecter-utilisateur/{id}', [authController::class, 'affectUserEntreprise'])->name('affectUserEntreprise');
Route::post('/utilisateur/modifier', [authController::class, 'updateUser'])->name('updateUser');
Route::get('/utilisateurs/supprimer/{id}', [authController::class, 'deleteUser'])->name('deleteUser');
Route::get('/profil', [authController::class,'getProfil'])->name('getProfil');
Route::post('profil/update', [authController::class,'updateProfil'])->name('updateProfil');
Route::get('/profile', [ProfileController::class, 'affichage'])->name('profile.affichage');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/utilisateurs/valide', [authController::class, 'getUsersValide'])->name('getUsersValide');
Route::get('/utilisateurs/signature', [authController::class, 'getSignatures'])->name('getSignatures');
Route::post('/utilisateurs/signature/store', [authController::class, 'storeSignature'])->name('storeSignature');
Route::get('/utilisateur/session/update', [authController::class, 'updateSession'])->name('updateSession');
Route::get('/utilisateur/{id}', [authController::class, 'getUserOne'])->name('getUserOne');
Route::get('/utilisateur/{action}/{id}', [authController::class, 'updateStatutUser'])->name('updateStatutUser');
Route::get('/utilisateurs/en-attente', [authController::class, 'getUsersNoValide'])->name('getUsersNoValide');
Route::get('/utilisateurs/valide', [authController::class, 'getUsersValide'])->name('getUsersValide');
Route::get('/logout', [authController::class, 'logout'])->name('logout');
