<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CardController;


//Home Page
Route::get('/', function () {
    if(Auth::check()){
        return view('home');
    }else{
        return view('front-page');
    }
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Search page
Route::get('/search', [App\Http\Controllers\UserController::class, 'search'])->name('search');

/**
 * Begin User Routes
 */

 Auth::routes();


//User profile page
Route::get('/profile/{id}', [UserController::class, 'findProfile'])->name('profile');

//Edit user
Route::get('/profile/{id}/edit', [UserController::class, 'EditProfileView'])->name('editProfileGet')->middleware('auth');
Route::post('/profile/edit-complete', [UserController::class, 'editProfile'])->name('editProfilePost')->middleware('auth');

Route::get('/friends', [App\Http\Controllers\UserController::class, 'friendsList'])->name('friendslist');

/**
 * End User Routes
 *-----------------------------------------
 * Begin Game Routes
 */

 //Create new game
Route::get('/create-game', [GameController::class, 'createGameForm'])->name('createGameForm')->middleware('auth');
Route::post('/create-game', [GameController::class, 'createGame'])->name('createGame')->middleware('auth');
//Single Game
Route::get('/game/{id}', [GameController::class, 'singleGame'])->name('singleGame')->middleware('auth');


//Request to join game
Route::get('/games/{id}/join', [GameController::class, 'requestJoin'])->name('requestJoin')->middleware('auth');
//Leave Game
Route::get('/games/{id}/leave', [GameController::class, 'leaveGame'])->name('leaveGame')->middleware('auth');
//Delete Game
Route::delete('/games/{id}/delete', [GameController::class, 'deleteGame'])->name('deleteGame');
//My Games
Route::get('/my-games', [GameController::class, 'showMyGames'])->name('myGames')->middleware('auth');
//Show All games
Route::get('/games', [GameController::class, 'showGames'])->name('games')->middleware('auth');

/**
 * End Game Routes
 *-----------------------------------------
 * Begin Notification Routes
 */

 Route::delete('/notification/{id}/delete', [NotificationController::class, 'deleteNotification'])->name('deleteNotify');

 
/**
 * End Game Routes
 *  *-----------------------------------------
 * Begin Card Routes
 */
Route::get('/card-lookup', [CardController::class, 'cardLookup'])->name('card-lookup')->middleware('auth');
Route::get('/deck-builder', [CardController::class, 'deckBuilder'])->name('deck-builder')->middleware('auth');


