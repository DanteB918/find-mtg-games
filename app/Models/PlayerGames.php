<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Games;
use App\Models\User;

class PlayerGames extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'player_id', 
    ];

    public function game()
    {
        return $this->hasOne(Games::class, 'id', 'game_id');
    }
    public function player()
    {
        return $this->hasOne(User::class, 'id', 'player_id');
    }

}
