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

    protected $fillable = [
        'id',
        'time', 
        'date', 
        'state', 
        'country', 
        'number_players', 
        'description', 
        'status', 
        'power_level', 
        'format', 
        'created_by', 
        'current_players'];
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
    private function checkIfNotFull() //Set Status from false to true (inactive to active)
    {
        if (count($this->current_players) < $this->number_players){
            $this->status = true;
        }
        $this->update();
    }
    public function currentUserInGame() //Check if current user is a part of game.
    {
        if(in_array(Auth::id(), $this->current_players)){
            return true;
        }
    }
    /**
    *   Function for returning all active games, sorted by time and date.
    *   @return array of games that are active.
    */
    public static function getActiveGames()
    { 
        return Games::orderby('date')
        ->orderby('time')
        ->paginate(10)
        ->where('status', 1);
    }
    /**
    *   Function for returning all games, sorted by status.
    *   @return array of games
    */
    public static function getAllGames()
    { 
        return Games::orderby('status', 'DESC')
        ->paginate(10);
    }
    /**
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
    /**
    *   Function for returning array of current player's ID's registered to a game.
    *   @param int $game_id = ID of game.  
    *   @return array $the_game->current_players = ID's of all players in game.
    */
    public static function currentPlayers(int $game_id)
    {
        $the_game = Games::where('id', $game_id)->first();
        $the_game->refresh();
        return $the_game->current_players;
    }
    /**
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
    /**
    *   Removing player from game once they have pressed the leave game button.
    *   @param int $game_id = ID of game.  
    */
    public static function leaveGame(int $game_id)
    {
        $game = Games::where('id', $game_id)->first();
        if (in_array(Auth::id(), $game->current_players) && Auth::id() != $game->created_by){
            $game_without_user = array_diff($game->current_players, [Auth::id()]);
            $game->current_players = $game_without_user;
        }
        $game->checkIfNotFull();
        $game->update();
        $game->refresh();
    }
    /**
     * Showing All Games for a given user.
     * @return array $userGames = array of games that the user is part of.
     */
    public static function showUsersGames()
    {
        $userGames = [];
        foreach (Games::getAllGames() as $game){
            if ($game->currentUserInGame()){
                array_push($userGames, $game);
            }
        }
        return $userGames;
    }
}
