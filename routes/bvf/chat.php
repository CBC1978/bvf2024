<?php


use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\chat\chatController;

Route::get('/discussion', [chatController::class, 'chat'])->name('chat');
Route::get('/discussions', [chatController::class, 'chatInverse'])->name('chatInverse');
Route::post('/envoyer-message', [chatController::class, 'sendChat'])->name('sendChat');
