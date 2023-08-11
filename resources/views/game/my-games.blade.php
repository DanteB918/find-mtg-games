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
    @include('game.game-sidebar')

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('My Games') }}</div>

                <div class="card-body">
                    @if ($games)
                    <div class="outter-games">
                            @foreach($games as $game)
                                @include('game.game-loop')
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
@include('game.game-ajax')
