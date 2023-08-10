<?php
use App\Models\User;
?>
    <form method="GET" action="/search">
        <label for="{{ $searching_for }}">Search by Username:</label>
            <input type="text" name="{{ $searching_for }}" placeholder="{{ $placeholder }}" value="{{ $param }}" />
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
    <?php if ($_GET) : ?>
        <?php foreach ($results as $result) : ?>
            <?php  if ( $_GET['user'] ) : ?>
                <div class="row">
                    <div class="col-md-3">
                        <img src="<?= asset('images/profile_pics/' . $result->profile_pic); ?>" class="profile-container__pic" alt="Profile pic of {{__($result->username)}}" />
                    </div>
                <div class="col-md-7">
                        <p><?=$result->username;?></p>
                        <p>Location: <span>{{ $result->state }}, {{ $result->country }}</span></p>
                    </div>
                    <div class="col-md-2">
                    <p><?= User::currentUserOnlineStatus($result->id); ?></p>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach ?>
    <?php endif; ?>
</div>
