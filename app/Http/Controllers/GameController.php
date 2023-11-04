<?php

namespace App\Http\Controllers;
use App\Models\Games;
use Illuminate\Http\Request;

class GameController extends Controller
{
    protected Games $game;

    public function __construct(Games $game)
    {
        $this->game = new Games();
    }

    public function showGames()
    {
        $games = $this->game->getActiveGames();
        return view('game.games', compact('games'));
    }
    public function showMyGames()
    {
        $games = $this->game->showUsersGames();

        return view('game.my-games', compact('games'));
    }
    public function deleteGame(int $game_id)
    {
        $this->game->deleteGame($game_id);
    }
    /**
    *   Request to join a game logic
    *   @param int $game_id = game ID
    */
    public function requestJoin(int $game_id)
    {
        $this->game->addPlayerToGame($game_id);
        return redirect()->back();
    }
    /**
    *   Leave Game
    *   @param int $game_id = game ID
    */
    public function leaveGame(int $game_id)
    {
        $this->game->leaveGame($game_id);
        return redirect()->back();
    }
    /**
     *  Single Game Page
     */
    public function singleGame(int $game_id)
    {
        $game = Games::findOrFail($game_id);

        return view('game.single-game', compact('game'));
    }
    /**
    *   Create Game logic
    */
    public function createGameForm()
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

        $newGame = Games::create([
            'time' => request()->input('time'),
            'date' => request()->input('date'),
            'state' => request()->input('state'),
            'country' => request()->input('country'),
            'created_by' => auth()->id(),
            'power_level' => request()->input('power_level'),
            'number_players' => request()->input('number_players'),
            'format' => request()->input('format'),
            'description' => request()->input('description'),
        ]);

        session()->flash('message', 'Game successfully created');

        return redirect()->to(route('singleGame', $newGame));
    }

}
