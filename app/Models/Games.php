<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['id', 'time', 'date', 'state', 'country', 'number_players', 'description', 'status', 'power_level', 'format'];
    protected $table = 'games';

    public static function getActiveGames()
    { //returns all active games
        return Games::orderby('date')
        ->orderby('time')
        ->paginate(10)
        ->where('status', 1);
    }
    public static function createGame($fields)
    {
        $status = array('status' => 1 ); //Appending true status to model
        $all_fields = array_merge($fields, $status);
        $newGame = Games::create($all_fields);
        $newGame->refresh();
    }
}
