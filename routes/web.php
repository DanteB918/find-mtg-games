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

/**
 * Begin User Routes
 */

 Auth::routes();

Route::middleware('auth')->group(function () {
    //Search page
    Route::get('/search', [App\Http\Controllers\UserController::class, 'search'])->name('search');

    //User profile page
    Route::get('/profile/{id}', [UserController::class, 'findProfile'])->name('profile');

    //Edit user
    Route::get('/profile/{id}/edit', [UserController::class, 'EditProfileView'])->name('editProfileGet');
    Route::post('/profile/edit-complete', [UserController::class, 'editProfile'])->name('editProfilePost');

    //Friends stuff
    Route::get('/friends', [App\Http\Controllers\UserController::class, 'friendsList'])->name('friendslist');

    /**
     * End User Routes
     *-----------------------------------------
     * Begin Game Routes
     */

    //Create new game
    Route::get('/create-game', [GameController::class, 'createGameForm'])->name('createGameForm');
    Route::post('/create-game', [GameController::class, 'createGame'])->name('createGame');
    //Single Game
    Route::get('/game/{id}', [GameController::class, 'singleGame'])->name('singleGame');
    //Request to join game
    Route::get('/games/{id}/join', [GameController::class, 'requestJoin'])->name('requestJoin');
    //Leave Game
    Route::get('/games/{id}/leave', [GameController::class, 'leaveGame'])->name('leaveGame');
    //Delete Game
    Route::delete('/games/{id}/delete', [GameController::class, 'deleteGame'])->name('deleteGame');
    //My Games
    Route::get('/my-games', [GameController::class, 'showMyGames'])->name('myGames');
    //Show All games
    Route::get('/games', [GameController::class, 'showGames'])->name('games');

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
    Route::get('/deck-builder', [CardController::class, 'deckBuilder'])->name('deck-builder');
    Route::get('/card-lookup', [CardController::class, 'cardLookup'])->name('card-lookup');
});
