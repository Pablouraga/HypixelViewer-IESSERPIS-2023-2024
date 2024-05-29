<?php

use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //Reiniciamos la variable username almacenada en la sesion
    session(['username' => null]);
    if (Auth::check()) {
        $user = auth()->user();
        $favourites = $user->favourites;
        return view('index', ['favourites' => $favourites]);
    }
    return view('index');
})->name('index');
// Route::get('/', [PlayerController::class, 'index'])->name('index');

//Player routes
Route::POST('/player', [PlayerController::class, 'playerFind'])->name('playerFind');
Route::get('/player/{username}', [PlayerController::class, 'show'])->name('playerShow');
Route::get('/stats/{username}', [PlayerController::class, 'serverStats'])->name('serverStats');
Route::get('/auctions/{username}', [PlayerController::class, 'auctionHistory'])->name('auctionHistory');
Route::get('/skyblock/{username}', [PlayerController::class, 'skyblockStats'])->name('skyblockStats');
Route::get('/guild/{username}', [PlayerController::class, 'guildDetails'])->name('guildDetails');
Route::patch('/player/togglefavourite', [PlayerController::class, 'toggleFavourite'])->name('toggleFavourite');

//Auth routes
Route::get('/login', function () {
    return view('users.login');
})->name('loginForm');

Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/signup', function () {
    return view('users.signup');
})->name('signupForm');

Route::post('/signup', [UserController::class, 'signup'])->name('signup');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

//User routes
Route::get('/edit', [UserController::class, 'edit'])->name('editProfile');
Route::patch('/edit', [UserController::class, 'update'])->name('updateProfile');
Route::get('/profile', [UserController::class, 'show'])->name('showProfile');

Route::post('/player/add', [UserController::class, 'addUserAsFriend'])->name('addUser');

//Ticket routes
Route::get('/ticket', [TicketController::class, 'create'])->name('createTicket');

Route::post('/ticket', [TicketController::class, 'store'])->name('storeTicket');

Route::get('/tickets/all', [TicketController::class, 'index'])->name('tickets.index');
Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
Route::delete('/tickets/{ticket}/delete', [TicketController::class, 'destroy'])->name('tickets.destroy');
