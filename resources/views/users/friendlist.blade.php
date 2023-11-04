<?php
    use App\Models\Friends;
    use App\Models\User;
?>
@extends('layouts.app')

@section('content')
        <div class="white-box container">
            <h1 class="header-text">Friends list:</h1>
            @if ( $friends->isNotEmpty() )
                <?php foreach( $friends as $friend ) : ?>
                    <div class="row loop-border search">
                    <div class="col-3">
                        <a href="{{ route('profile', $friend->id) }}">
                            <img src="<?= asset('images/profile_pics/' . $friend->profile_pic); ?>" class="profile-container__pic" alt="Profile pic of {{__($friend->username)}}" />
                        </a>
                    </div>
                    <div class="col-7">
                        <a href="{{ route('profile', $friend->id) }}"><?=$friend->username;?></a>
                        <p>Location: <span>{{ $friend->state }}, {{ $friend->country }}</span></p>
                    </div>
                    <div class="col-2">
                        <p><?= User::currentUserOnlineStatus($friend->id); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            @else
                <p>No friends on file... yet!</p>
            @endif
        </div>
@endsection