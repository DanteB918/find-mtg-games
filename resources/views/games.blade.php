<?php 
use Illuminate\Support\Facades\Auth;
use \App\Models\User;
use \App\Models\Games;

?>
@extends('layouts.app')

@section('content')
<p align="center">We sort all games by date, time, and the results that are closest to you.</p>

<div class="container">
    <div class="row justify-content-center">
    @include('game-sidebar')

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Games') }}</div>

                <div class="card-body">
                    @if ($games)
                    <div class="outter-games">
                            @foreach($games as $game)

                            <?php 
                                $current_user_ids = Games::currentPlayers($game->id);
                             ?>
                                <?php 
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
                                       <p><?= $num_players_in_game; ?> out of {{ $game->number_players }} players found.</p>
                                        <div class="bottom">
                                            <?php if(in_array(Auth::id(), $current_user_ids) && $game->created_by != Auth::id()): ?>
                                                <a href="/games/<?=$game->id;?>/leave" class="btn btn-secondary">Leave Game</a>
                                            <?php elseif($game->created_by === Auth::id() && $game->status === 1): ?>
                                                <a href="/games/<?=$game->id;?>/delete" class="btn btn-secondary">Delete Game</a>
                                            <?php else: ?>
                                                <a href="/games/<?=$game->id;?>/join" class="btn btn-secondary">Join Game</a>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                    </div>
                    {{$games->links()}}
                    @else
                    <p>No Games Found</p>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

