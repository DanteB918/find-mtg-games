@extends('layouts.app')

@section('content')
<section>
    <h1>Game created successfully.</h1>
    <p><a href = "{{ route('createGameForm') }}">Click Here</a> to go back.</p>
    <p><a href = "{{ route('games') }}">Click Here</a> to see all games.</p>
   
</section>
@endsection
@include('game.game-ajax')
