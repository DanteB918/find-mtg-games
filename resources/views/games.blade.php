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
    <div class="col-md-2">
        <div class="card">
        <div class="card-header">{{ __('Game Options') }}</div>
            <div class="card-body" >
                <a href="{{ route('createGameForm') }}" class="btn btn-primary">Create a new Game</a>
            </div>
        </div>
    </div>

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
                            <?php if ($game->date >= date("Y-m-d") && $game->status === 1): ?>
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
                                        Created By: <a href="/profile/<?=$game->created_by?>">{{ User::findUser($game->created_by)->username; }}</a>
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
                                            <?php if(in_array(Auth::id(), $current_user_ids)): ?>
                                                <a href="/games/<?=$game->id;?>/leave" class="btn btn-secondary">Leave Game</a>
                                            <?php else: ?>
                                                <a href="/games/<?=$game->id;?>" class="btn btn-secondary">Join Game</a>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            @endforeach
                    </div>
                    <?php
                    // Pagination logic
                    if(empty($_GET['page'])){
                        $next = 2;
                        $prev = null;
                        //if less than 10 results on page, only going back is an option
                        if (count($games) < 10){
                            $next = null;
                        }
                    }else{
                        $current_page = $_GET['page'];
                        $next = $current_page +=1;
                        $prev = $current_page -= 2;
                        
                        //if less than 10 results on page, only going back is an option
                        if (count($games) < 10){
                            $next = null;
                        }

                        
                    };



                    ?>
                    <?php if ($prev):?>
                        <a href="/games/?page=<?=$prev?>" class="btn">{{ __('Previous') }}</a>
                    <?php endif; ?>
                    <?php if ($next):?>
                        <a href="/games/?page=<?=$next?>" class="btn">{{ __('Next') }}</a>
                    <?php endif; ?>
                    @else
                    <p>No Games Found</p>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

