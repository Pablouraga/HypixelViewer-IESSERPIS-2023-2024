<?php

use App\Http\Controllers\NavigationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //Reiniciamos la variable username almacenada en la sesion
    session(['username' => null]);
    return view('index');
})->name('index');

Route::get('/player', [NavigationController::class, 'findPlayer'])->name('generalView');
Route::get('/stats/{username}', [NavigationController::class, 'serverStats'])->name('serverStats');
Route::get('/auctions/{username}', [NavigationController::class, 'auctionHistory'])->name('auctionHistory');
Route::get('/skyblock/{username}', [NavigationController::class, 'skyblockStats'])->name('skyblockStats');
Route::get('/guild/{username}', [NavigationController::class, 'guildDetails'])->name('guildDetails');
