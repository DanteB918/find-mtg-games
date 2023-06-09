@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <p>{{$user->username}}</p>
        <p>Location: {{ $user->state }}, {{ $user->country }}</p>
        <p>Member Since: {{ $user->created_at }}</p>

        
        <?php if(Auth::id() === $user->id): //Show only if logged in user is same as current user. ?>
            <hr>
            <a href="/profile/{{Auth::id()}}/edit">Edit Profile</a>    
        <?php endif; ?>
        <p></p>
    </div>
</div>


@endsection