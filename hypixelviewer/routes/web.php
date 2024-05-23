<?php

use App\Http\Controllers\NavigationController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
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

Route::get('/login', function () {
    return view('users.login');
})->name('loginForm');

Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/signup', function () {
    return view('users.signup');
})->name('signupForm');

Route::post('/signup', [UserController::class, 'signup'])->name('signup');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/edit', [UserController::class, 'edit'])->name('editProfile');

Route::patch('/edit', [UserController::class, 'update'])->name('updateProfile');

Route::get('/profile', [UserController::class, 'show'])->name('showProfile');

Route::get('/ticket', [TicketController::class, 'create'])->name('createTicket');

Route::post('/ticket', [TicketController::class, 'store'])->name('storeTicket');

Route::get('/tickets/all', [TicketController::class, 'index'])->name('tickets.index');
Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');
