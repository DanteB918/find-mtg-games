<?php
use App\Models\User;
?>
    <p class="header-text"> {{ ucfirst($searching_for) }} Search</p>
    <form method="GET" action="/search">
        <div class="search-row">
            <label for="{{ $searching_for }}">Username:</label>
            <input type="text" name="{{ $searching_for }}" placeholder="{{ $placeholder }}" value="{{ $param }}" />
            <button type="submit" class="btn btn-primary search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>
    <?php if ($_GET) : ?>
        <?php foreach ($results as $result) : ?>
            <?php  if ( $_GET['user'] ) : ?>
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
            <?php endif; ?>
        <?php endforeach ?>
    <?php endif; ?>
</div>
