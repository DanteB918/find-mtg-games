@extends('layouts.app')

@section('content')
<?php 
$current_user = Auth::id();
?>
<div class="container">
    <div class="row">
        <p>{{$user->username}}</p>
        <p>Location: {{ $user->state }}, {{ $user->country }}</p>
        <p>Member Since: {{ $user->created_at }}</p>

        
        <?php if($current_user === $user->id): //Show only if logged in user is same as current user. ?>
        <hr>

            <a href="/profile/{{$current_user}}/edit">Edit Profile</a>    
            
        <?php endif; ?>
        <p></p>
    </div>
</div>


@endsection