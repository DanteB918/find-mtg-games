<?php

namespace App\Models;
use App\Models\User;
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

    private function checkIfFull() //Set Status from true to false (active to inactive)
    {
        if (count($this->current_players) >= $this->number_players){
            $this->status = false;
        }
        $this->update();
    }
    /*
    *   Function for returning all active games, sorted by time and date.
    *   @return array of games that are active.
    */
    public static function getActiveGames()
    { //returns all active games
        return Games::orderby('date')
        ->orderby('time')
        ->paginate(10)
        ->where('status', 1);
    }
    /*
    *   Logic for creating new games.
    *   @param array $fields = POST fields for creating new game.
    */
    public static function createGame(array $fields)
    {
        $status = array('status' => 1, 'created_by' => Auth::id(), 'current_players' => [Auth::id()]); //Appending required data.
        $all_fields = array_merge($fields, $status);
        $newGame = Games::create($all_fields);
        $newGame->refresh();
    }
    /*
    *   Function for returning array of current player's ID's registered to a game.
    *   @param int $game_id = ID of game.  
    *   @returns array $the_game->current_players = ID's of all players in game.
    */
    public static function currentPlayers(int $game_id)
    {
        $the_game = Games::where('id', $game_id)->first();
        $the_game->refresh();
        return $the_game->current_players;
    }
    /*
    *   Adding a player to a game once they have pressed the button to join.
    *   @param int $game_id = ID of game.  
    */
    public static function addPlayerToGame(int $game_id)
    {
        $game = Games::where('id', $game_id)->first();
        foreach ($game->current_players as $player){ //Check if player applying is already a part of the game.
            if($player === Auth::id()){
                return false;
            }
        }        
        $current_users = $game->current_players;
        array_push($current_users, Auth::id());
        $game->current_players = $current_users;
        $game->checkIfFull();
        $game->update();
        $game->refresh();
    }

}
