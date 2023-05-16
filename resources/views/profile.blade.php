@extends('layouts.app')

@section('content')
<?php 
$current_user = Auth::id();
?>
<div class="container">
    <div class="row">
    <?php var_dump($user); ?>
        <p>{{$user->username}}</p>
        <p>{{ $user->id }}</p>
        <?php if($current_user === $user->id): //Show only if logged in user is same as current user. ?>
        <hr>

            <a href="#">Edit Profile</a>    
            
        <?php endif; ?>
        <p></p>
    </div>
</div>


@endsection