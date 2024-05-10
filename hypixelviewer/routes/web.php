<?php

use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/player', [PlayerController::class, 'show'])->name('player.show');
