<?php
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\voiture\voitureController;

Route::get('/type-car', [voitureController::class, 'getAllTypeCar'])->name('getAllTypeCar');
Route::get('/brand-car', [voitureController::class, 'getAllBrandCar'])->name('getAllBrandCar');
Route::get('/cars', [voitureController::class, 'getCarByCarrier'])->name('getCarByCarrier');
Route::get('/transport/car/{id}', [voitureController::class, 'getTransportCar'])->name('getTransportCar');
Route::post('/camion/ajouter', [voitureController::class, 'storeCar'])->name('storeCar');
Route::get('/contrat/camion/{id}', [voitureController::class, 'getCarOne'])->name('getCarOne');
Route::post('/contrat/camion/modifier', [voitureController::class, 'updateCar'])->name('updateCar');
Route::get('/contrat/camion/supprimer/{id}', [voitureController::class, 'deleteCar'])->name('deleteCar');
Route::post('/contrat/camion/ajouter', [voitureController::class, 'storeCarContrat'])->name('storeCarContrat');
Route::get('/vehicules', [voitureController::class, 'getVehicule'])->name('getVehicule');
Route::get('/vehicules/api', [voitureController::class, 'getVehicules'])->name('getVehicules');
