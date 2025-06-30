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
Route::get('upload/file', [authController::class,'importFile']);
Route::get('/entreprise/{type}/{role}', [offerController::class, 'getEntreprise'])->name('getEntreprise');
Route::post('/register', [authController::class, 'register'])->name('registerUser');
Route::post('/otp-verify', [authController::class, 'otpVerify'])->name('otpVerify');

Route::get('/confirmation-email', [authController::class, 'verifyEmail'])->name('verifyEmail');
Route::post('/changer-mot-de-passe', [authController::class, 'updatePassword'])->name('updatePassword');
Route::post('/login', [authController::class, 'login'])->name('login');
Route::get('/register', [authController::class, 'index2'])->name('register');
Route::get('/codeRequest', [authController::class, 'codeRequest'])->name('codeRequest');

Route::middleware(['login'])->group(function (){

//BVF
require __DIR__.'/bvf/offer.php';
require __DIR__.'/bvf/admin.php';
require __DIR__.'/bvf/utilisateur.php';
require __DIR__.'/bvf/contrat.php';
require __DIR__.'/bvf/ville.php';
require __DIR__.'/bvf/voiture.php';
require __DIR__.'/bvf/conducteur.php';
require __DIR__.'/bvf/chat.php';

});
