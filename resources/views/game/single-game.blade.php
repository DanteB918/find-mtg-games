<?php 
use Illuminate\Support\Facades\Auth;
use \App\Models\User;
use \App\Models\Games;

?>
@extends('layouts.app')

@section('content')
<p align="center">Get ready for your game!</p>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Games') }}</div>

                <div class="card-body">
                    @if ($game)
                    <div class="outter-games">
                    <?php 
                                $current_user_ids = Games::currentPlayers($game->id);
                                $players_in_game = User::showAllUsersInArray($current_user_ids); 
                                $num_players_in_game = count($players_in_game);       
                             ?>
                                <div class="inner-games row">
                                    <div class="inner-games__info col-md-8">
                                        {{__('Location:')}} {{ $game->state }}, {{$game->country}} <br />
                                        When: {{$game->date}} at <?= date("g:i a", strtotime($game->time)); ?><br />
                                        Power Level: {{$game->power_level}}<br />
                                        Number of Players: {{$game->number_players}}<br />
                                        Format: {{$game->format}} <br />
                                        Description: {{$game->description}}<br />
                                        Created By: <a href="/profile/<?=$game->created_by?>">{{ User::findUser($game->created_by)->username }}</a>
                                    </div>
                                    <div class="inner-games__options col-md-4">
                                        <p>Players in game: 
                                            <?php for ($i=0; $i <= $num_players_in_game - 1; $i++): ?>
                                                    <a href="/profile/<?=$players_in_game[$i]->id?>"><?=$players_in_game[$i]->username; ?></a>
                                                    <br />
                                            <?php endfor; ?>
                                        </p>

                                    </div>
                                </div>
                    </div>
                  
                    @else
                    <p>Game not found.</p>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
