<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ville\villeController;


Route::get('/villes', [villeController::class, 'getAllVille'])->name('getAllVille');
