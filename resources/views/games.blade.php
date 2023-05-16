<?php use Illuminate\Support\Facades\Auth; ?>
@extends('layouts.app')

@section('content')

    <body>
        <a href="{{ route('createGameForm') }}" class="href">Create a new Game</a>
        <h1>Games:</h1>
        <?php 
        $user = Auth::user();
 
        // Get the currently authenticated user's ID...
        $id = Auth::id();
        
        ?>
        <?php var_dump($user->username); ?>
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
        @else
        <p>No Games Found</p>
        @endif
    </body>
@endsection