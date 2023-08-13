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
        return view('game.games', compact('games'));
    }
    public function showMyGames(): View
    {
        $games = Games::showUsersGames();
        return view('game.my-games', compact('games'));
    }
    public function deleteGame(int $game_id)
    {
        Games::deleteGame($game_id);
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
     *  Single Game Page
     */
    public function singleGame(int $game_id)
    {
        $game = Games::findGame($game_id);
        return view('game.single-game', compact('game'));
    }
    /**
    *   Create Game logic
    */
    public function createGameForm(): View
    {
        return view('game.game-form');
    }
    public function createGame(Request $request)
    {
        $request->validate([
            'time' => ['required', 'string', 'max:30'],
            'date' => ['required', 'string', 'max:10'],
            'state' => ['required', 'string', 'max:3'],
            'country' => ['required', 'string', 'max:3'],
            'power_level' => ['required', 'integer', 'max:10', 'min:1'],
            'number_players' => ['required', 'integer'],
            'format' => ['required', 'string'],
            'description' => ['nullable', 'string', 'min:10', 'max:200'],
        ]);
        $newGame = Games::createGame($request->all());
        session()->flash('message', 'Game successfully created');
        return redirect()->to(route('singleGame', $newGame->id));

    }

}
