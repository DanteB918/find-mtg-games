<?php

namespace App\Http\Controllers;
use App\Models\Games;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class GameController extends Controller
{
    public function createGameForm(): View
    {
        return view('game-form');
    }
    public function createGame(Request $request)
    {
        $time = $request->input('time');
        $number_players = $request->input('number_players');
        $date = $request->input('date');
        $state = $request->input('state');
        $country = $request->input('country');
        $power_level = $request->input('power_level');
        $description = $request->input('description');
        $format = $request->input('format');
        $data=array('time'=>$time,"number_players"=>$number_players,"date"=>$date,"state"=>$state,"country"=>$country,"power_level"=>$power_level, "description"=>$description, "format"=>$format, "status"=>true);
        DB::table('games')->insert($data);
        return view('game-form-submitted');
    }
    public function showGames(): View
    {
        $games = DB::table('games')->orderby('date')->select('*')->get();
        return view('games', compact('games'));
    }
}
