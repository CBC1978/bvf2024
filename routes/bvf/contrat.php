<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\contrat\contratController;

//Contrat
Route::get('/contrat', [contratController::class, 'getContrat'])->name('getContrat');
Route::get('/contrat/{id}', [contratController::class, 'getContratDetail'])->name('getContratDetail');
Route::get('/contrat/modifier/{id}', [contratController::class, 'updateContrat'])->name('updateContrat');
Route::post('/contrat/modifier/contrat', [contratController::class, 'updateStoreContrat'])->name('updateStoreContrat');
Route::get('/contrat/print/{id}', [contratController::class, 'printContrat'])->name('printContrat');
