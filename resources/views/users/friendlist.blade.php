<?php
    use App\Models\Friends;
    use App\Models\User;
?>
@extends('layouts.app')

@section('content')
    <?php $friends = Friends::getAllUsersFriends(); ?>
		<div class="white-box container">
            <h1 class="header-text">Friends list:</h1>
            <?php if ( $friends ) : ?>
                <?php foreach( $friends as $result ) : ?>
                    <div class="row loop-border search">
                    <div class="col-3">
                        <a href="{{ route('profile', $result->id) }}">
                            <img src="<?= asset('images/profile_pics/' . $result->profile_pic); ?>" class="profile-container__pic" alt="Profile pic of {{__($result->username)}}" />
                        </a>
                    </div>
                    <div class="col-7">
                        <a href="{{ route('profile', $result->id) }}"><?=$result->username;?></a>
                        <p>Location: <span>{{ $result->state }}, {{ $result->country }}</span></p>
                    </div>
                    <div class="col-2">
                        <p><?= User::currentUserOnlineStatus($result->id); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No friends on file... yet!</p>
            <?php endif; ?>
            
		</div>
@endsection