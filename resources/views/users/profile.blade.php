@extends('layouts.app')

@section('content')

<div class="container profile-container">
    <div class="row align-items-center">
    <?php if ( $user->profile_pic ) : ?>
        <div class="col-md-4">
            <img src="<?= asset('images/profile_pics/' . $user->profile_pic); ?>" class="profile-container__pic" alt="Profile pic of {{__($user->username)}}" />
        </div>
        <div class="col-md-8">
            <p><span class="profile-container__username">{{$user->username}}</span></p>
            <p>Location: <span>{{ $user->state }}, {{ $user->country }}</span></p>
            <p>Member Since: <span><?= date('Y-m-d', strtotime($user->created_at)); ?></span></p>
        </div>
    <?php else : ?>
        <div class="col-12" align="center">
            <p>{{$user->username}}</p>
            <p>Location: {{ $user->state }}, {{ $user->country }}</p>
            <p>Member Since: {{ $user->created_at }}</p>
        </div>

    <?php endif; ?>

       

        <?php if(Auth::id() === $user->id): //Show only if logged in user is same as current user. ?>
            <hr>
            <a href="/profile/{{Auth::id()}}/edit">Edit Profile</a>    
        <?php endif; ?>
        <p></p>
    </div>
</div>


@endsection