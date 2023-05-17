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
    /*
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
