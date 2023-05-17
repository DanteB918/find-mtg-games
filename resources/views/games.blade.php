<?php use Illuminate\Support\Facades\Auth; ?>
@extends('layouts.app')

@section('content')

    <section>
        <a href="{{ route('createGameForm') }}" class="href">Create a new Game</a>
        <h1>Games:</h1>
        <?php 
        $user = Auth::user();
 
        // Get the currently authenticated user's ID...
        $id = Auth::id();
        
        ?>
        <?php //var_dump($user->username); ?>
        
        @if ($games)
        <ul>
                @foreach($games as $game)
                <?php if ($game->date >= date("Y-m-d")): ?>
                    <li>
                        {{ $game->state }}, {{$game->country}} <br />
                        When: {{$game->date}} at {{$game->time}} <br />
                        Power Level: {{$game->power_level}}<br />
                        Number of Players: {{$game->number_players}}<br />
                        Format: {{$game->format}} <br />
                        Description: {{$game->description}}<br />
                        <a href="#" class="btn">Request to come play!</a>
                    </li>
                <?php endif; ?>
                @endforeach
        </ul>
        <?php
        // Pagination logic
        if(empty($_GET['page'])){
            $next = 2;
            $prev = null;
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
    </section>
@endsection