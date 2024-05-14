<?php

use App\Http\Controllers\NavigationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/player', [NavigationController::class, 'findPlayer'])->name('generalView');
Route::get('/stats/{username}', [NavigationController::class, 'serverStats'])->name('serverStats');
Route::get('/skyblock/{username}', [NavigationController::class, 'skyblockStats'])->name('skyblockStats');
