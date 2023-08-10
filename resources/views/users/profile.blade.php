<?php
use \App\Models\User;
?>

@extends('layouts.app')

@section('content')

<div class="container profile-container">
    <div class="row align-items-center">
        <div class="col-md-4">
            <img src="<?= asset('images/profile_pics/' . $user->profile_pic); ?>" class="profile-container__pic" alt="Profile pic of {{__($user->username)}}" />
        </div>
        <div class="col-md-8">
            <p><span class="profile-container__username">{{$user->username}}</span></p>
            <p><?= User::currentUserOnlineStatus($user->id); ?></p>
            <p>Location: <span>{{ $user->state }}, {{ $user->country }}</span></p>
            <p>Member Since: <span><?= date('Y-m-d', strtotime($user->created_at)); ?></span></p>
        </div>
        
        <?php if( Auth::id() === $user->id ): //Show only if logged in user is same as current user. ?>
            <hr>
            <a href="/profile/{{Auth::id()}}/edit">Edit Profile</a>    
        <?php elseif(Auth::check()): ?>
            <livewire:add-friend-btn :user="$user" /> 
        <?php endif; ?>
        <p></p>
    </div>
</div>


@endsection