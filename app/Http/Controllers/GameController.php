<?php

namespace App\Http\Controllers;
use App\Models\Games;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function showGames(): View
    {
        $games = Games::getActiveGames();
        return view('games', compact('games'));
    }
    public function showMyGames(): View
    {
        $games = Games::showUsersGames();
        return view('my-games', compact('games'));
    }
    /**
    *   Request to join a game logic
    *   @param int $game_id = game ID
    */
    public function requestJoin(int $game_id)
    {
        Games::addPlayerToGame($game_id);
        return redirect()->back();
    }
    /**
    *   Leave Game
    *   @param int $game_id = game ID
    */
    public function leaveGame(int $game_id)
    {
        Games::leaveGame($game_id);
        return redirect()->back();
    }
    /**
    *   Create Game logic
    */
    public function createGameForm(): View
    {
        return view('game-form');
    }
    public function createGame(Request $request)
    {
        Games::createGame($request->all());
        return view('game-form-submitted');
    }

}
