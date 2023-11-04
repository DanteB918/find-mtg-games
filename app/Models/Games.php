<?php

namespace App\Models;
use App\Models\User;
use App\Models\Notifications;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Games extends Model
{
    use HasFactory;

    protected $attributes = [
        'status' => 1,
    ];

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

    protected static function booted()
    {
        static::created(function ($newGame) {
            PlayerGames::create([
                'game_id' => $newGame->getKey(),
                'player_id' => $newGame->created_by
            ]);
        });
    }

    public function players()
    {
        return $this->hasMany(PlayerGames::class, 'game_id');
    }

    private function checkIfFull(): void
    {
        if ($this->players->count() >= $this->number_players){
            $this->update(['status' => 0]);
        }
    }

    public static function getActiveGames()
    { 
        return Games::where('date', '>=', Now())
            ->where('status', 1)
            ->orderby('date', 'ASC')
            ->orderby('time', 'ASC')
            ->paginate(5);
    }

    public static function getAllGames()
    { 
        return Games::orderby('status', 'DESC')
            ->paginate(5);
    }

    public function addPlayerToGame(int $game_id): void
    {
        $game = Games::findOrFail($game_id);

        $game->checkIfFull();

        abort_if($game->status == 0, 403);


        PlayerGames::create([
            'game_id' => $game_id,
            'player_id' => auth()->id()
        ]);

        foreach ($game->players as $player) {
            $player = $player->player;

            if($player->getKey() === Auth::id()){ 
                Notifications::newNotification('You have successfully joined the game.', Auth::id(), $player->getKey(), '/game/' . $game->id);
            }else{
                Notifications::newNotification($player->username . ' has joined the game.', Auth::id(), $player->getKey(), '/game/' . $game->id);
            }
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'created_by');
    }

    public static function leaveGame(int $game_id): void
    {
        $game = Games::findOrFail($game_id);

        if ($game->players->contains(auth()->id()) && auth()->id() != $game->created_by){
            $game->players->each(function($player) {
                auth()->id() === $player->player_id ? $player->delete() : null;
            });
        }

        $game->update(['status' => 1]);

        foreach ($game->players as $player) {
            $player = $player->player;
            if($player->getKey() === auth()->id()){ 
                Notifications::newNotification('You have left the game.', auth()->id(), $player->getKey(), '/game/' . $game->getKey());
            }else{
                Notifications::newNotification($player->username . ' has left the game.', auth()->id(), $player->getKey(), '/game/' . $game->getKey());
            }
        }
    }

    public static function deleteGame(int $game_id): void
    {
        $game = Games::findOrFail($game_id);

        abort_if(! $game->created_by === Auth::id(), 403);

        foreach ($game->players as $player) {

            $player = $player->player;

            if(! $player->getKey() === Auth::id()){ 
                Notifications::newNotification($player->username . ' has deleted the game.', auth()->id(), $player->getKey(), '#');
            }
        }

        $game->delete();
    }

    public function showUsersGames()
    {
        return Games::where('status', 1)
            ->whereHas('players', fn($q) => $q->where('player_id', auth()->id()))
            ->orderby('status', 'DESC')
            ->paginate(5);
    }
}
