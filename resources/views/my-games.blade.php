<?php 
use Illuminate\Support\Facades\Auth;
use \App\Models\User;
use \App\Models\Games;

?>
@extends('layouts.app')

@section('content')
<p align="center">Your past and current games.</p>


<div class="container">
    <div class="row justify-content-center">
    @include('game-sidebar')

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('My Games') }}</div>

                <div class="card-body">
                    @if ($games)
                    <div class="outter-games">
                            @foreach($games as $game)
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
                                            <?php if($game->currentUserInGame() && $game->date >= date("Y-m-d") && $game->created_by != Auth::id() && $game->status === 1): ?>
                                                <a href="/games/<?=$game->id;?>/leave" class="btn btn-secondary">Leave Game</a>
                                            <?php elseif($game->created_by === Auth::id() && $game->status === 1): ?>
                                                <a href="/games/<?=$game->id;?>/delete" class="btn btn-secondary">Delete Game</a>
                                                
                                            <?php endif;?>
                                            <?php if($game->date >= date("Y-m-d") && $num_players_in_game === $game->number_players): ?>
                                                <br /><span class="green">Completed <i class="fa-solid fa-check"></i></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                    </div>
                    <?php

                     // Pagination logic
                     if(!empty($_GET['page'])){
                        $current_page = $_GET['page'];
                        $next = $current_page += 1;
                        $prev = $current_page -= 2;
                        
                        //if less than 5 results on page, only going back is an option
                        if (count($games) < 4){
                            $next = null;
                        }
                    }else{
                        $next = 2;
                        $prev = null;
                        //if less than 5 results on page, only going back is an option
                        if (count($games) < 4){
                            $next = null;
                        }
                    };
                    ?>
                    <?php if ($prev):?>
                        <a href="/my-games/?page=<?=$prev?>" class="btn">{{ __('Previous') }}</a>
                    <?php endif; ?>
                    <?php if ($next):?>
                        <a href="/my-games/?page=<?=$next?>" class="btn">{{ __('Next') }}</a>
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

