<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');

});

Auth::routes();

//User profile page
Route::get('/profile/{id}', [UserController::class, 'findProfile'])->name('profile')->middleware('auth');


//Create new game
Route::get('/create-game', [GameController::class, 'createGameForm'])->name('createGameForm')->middleware('auth');;
Route::post('/create-game', [GameController::class, 'createGame'])->name('createGame')->middleware('auth');;


//Show All games
Route::get('/games', [GameController::class, 'showGames'])->name('games')->middleware('auth');;


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
