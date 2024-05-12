<?php

use App\Http\Controllers\PlayerController;
use App\Http\Controllers\GeneralController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/player', [PlayerController::class, 'show'])->name('player.show');
Route::get('/stats/{username}', [GeneralController::class, 'serverStats'])->name('serverStats');
Route::get('/skyblock/{username}', [GeneralController::class, 'skyblockStats'])->name('skyblockStats');
