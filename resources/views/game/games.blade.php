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
    @include('game.game-sidebar')

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Games') }}</div>

                <div class="card-body">
                    @if ($games)
                    <div class="outter-games">
                        @each('game.game-loop', $games, 'game')
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
@include('game.game-ajax')
