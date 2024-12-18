<?php

use \App\Http\Controllers\conducteur\conducteurController;
use Illuminate\Support\Facades\Route;

Route::post('/contrat/conducteur/ajouter', [conducteurController::class, 'storeDriver'])->name('storeDriver');
Route::get('/contrat/conducteur/{id}', [conducteurController::class, 'getDriverOne'])->name('getDriverOne');
Route::post('/contrat/conducteur/modifier', [conducteurController::class, 'updateDriver'])->name('updateDriver');
Route::get('/contrat/conducteur/supprimer/{id}', [conducteurController::class, 'deleteDriver'])->name('deleteDriver');
Route::get('/drivers/api', [conducteurController::class, 'getDrivers'])->name('getDrivers');
