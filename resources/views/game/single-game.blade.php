<?php 
use Illuminate\Support\Facades\Auth;
use \App\Models\User;
use \App\Models\Games;

?>
@extends('layouts.app')

@section('content')
<p align="center">Get ready for your game!</p>
<p align="center">
    <a href="{{ route('games') }}" class="back">Back to games <i class="fa-solid fa-dice-d20"></i></a>
</p>
<div class="container single-game">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Game:') }}</div>

                <div class="card-body">
                    @if ($game)
                    <div class="outter-games">
                        @include('game.game-loop')
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
@include('game.game-ajax')
