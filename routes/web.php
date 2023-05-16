<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

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
    if(Auth::check()){
        return redirect('/games');
    }
});

Auth::routes();

//Create new game
Route::get('/create-game', [GameController::class, 'createGameForm'])->name('createGameForm');
Route::post('/create-game', [GameController::class, 'createGame'])->name('createGame');


//Show All games
Route::get('/games', [GameController::class, 'showGames'])->name('games');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
