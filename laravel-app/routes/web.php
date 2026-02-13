<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

Route::get('/', [ChatController::class, 'index'])->name('home');
Route::post('/chat', [ChatController::class, 'sendMessage'])->name('chat.send');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');