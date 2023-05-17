<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Games extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['id', 'time', 'date', 'state', 'country', 'number_players', 'description', 'status', 'power_level', 'format', 'created_by', 'current_players'];
    protected $table = 'games';
    protected $casts = [
        'current_players' => 'array',
      ];

    public static function getActiveGames()
    { //returns all active games
        return Games::orderby('date')
        ->orderby('time')
        ->paginate(10)
        ->where('status', 1);
    }
    public static function createGame($fields)
    {
        $status = array('status' => 1, 'created_by' => Auth::id(), 'current_players' => [Auth::id()]); //Appending true status to model
        $all_fields = array_merge($fields, $status);
        $newGame = Games::create($all_fields);
        $newGame->refresh();
    }
}
