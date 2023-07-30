@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4 profile-pic">
            <?php if ($user->profile_pic) : ?>
                <img src="<?= asset('images/profile_pics/' . $user->profile_pic); ?>" alt="Profile pic of {{__($user->username)}}" />
            <?php endif; ?>
        </div>
        <div class="col-md-8">
            <p>{{$user->username}}</p>
            <p>Location: {{ $user->state }}, {{ $user->country }}</p>
            <p>Member Since: {{ $user->created_at }}</p>
        </div>

       

        <?php if(Auth::id() === $user->id): //Show only if logged in user is same as current user. ?>
            <hr>
            <a href="/profile/{{Auth::id()}}/edit">Edit Profile</a>    
        <?php endif; ?>
        <p></p>
    </div>
</div>


@endsection