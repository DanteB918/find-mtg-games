<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    use HasFactory;
    protected $fillable = ['ID', 'time', 'date', 'state', 'country', 'number_players', 'status', 'power_level', 'format'];
    protected $table = 'games';
}
