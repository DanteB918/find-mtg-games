@extends('layouts.app')

@section('content')
<a href="{{ route('games') }}">See All Games</a>
    <section style="display: flex; justify-content: center; align-items: center;">
        <form method="post" action="{{ route('createGame') }}" style="display:flex; flex-direction:column;">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>"><input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <input type='time' name="time" placeholder="Time"/>
            <input type='date' name="date" placeholder="Date"/>
            <input type='text' name="state" placeholder="State"/>
            <input type='text' name="country" placeholder="Country"/>
            <input type='number' name="power_level" placeholder="Power Level"/>
            <input type='number' name="number_players" placeholder="# of Players"/>
            <input type='text' name="format" placeholder="Game Format"/>
            <textarea name="description" placeholder="description"></textarea>
            <input type="submit" />
        </form>
    </section>
@endsection
@include('footer')
@include('game.game-ajax')
