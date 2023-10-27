   <div class="inner-games row game-<?=$game->id?> loop-border">
        <div class="inner-games__info col-md-8">
            Location: <?= $game->state ?>, <?=$game->country?> <br />
            When: <?= $game->date ?> at <?= date("g:i a", strtotime($game->time)); ?><br />
            Power Level: <?= $game->power_level ?><br />
            Number of Players: <?= $game->number_players ?><br />
            Format: <?= $game->format ?> <br />
            <?php if ($game->description) : ?>
                Description: <?= $game->description ?><br />
            <?php endif; ?>
            Created By: <a href="/profile/<?=$game->created_by?>"><?= \App\Models\User::find($game->created_by)->username ?></a>
        </div>
        <div class="inner-games__options col-md-4">
            <p>Players in game: <br />
                @foreach ($game->players as $player)
                    @php $player = $player->player @endphp
                    @if ($player->profile_pic)
                        <div class="col-md-2">
                            <a href="/profile/<?=$player->getKey()?>">
                                <img src="<?= asset('images/profile_pics/' . $player->profile_pic); ?>" class="profile-container__pic" alt="Profile pic of {{__($player->username)}}" style="max-width:75px;" />
                            </a>
                        </div>
                        <a href="/profile/<?=$player->id?>"><?=$player->username; ?></a>
                        <br />
                    @else
                        <a href="/profile/<?=$player->id?>"><?=$player->username; ?></a>
                        <br />
                    @endif
                @endforeach
            </p>
            <p><?= $game->players()->count(); ?> out of <?= $game->number_players ?> players found.</p>
            <div class="bottom">
                <a href="/game/<?=$game->id;?>" class="btn btn-secondary see-game">See Game</a>

                <?php if( $game->players->contains(auth()->id()) && $game->created_by != auth()->id()): ?>
                    <a href="/games/<?=$game->id;?>/leave" class="btn btn-secondary leave-join-game">Leave Game</a>
                <?php elseif($game->created_by === auth()->id() && $game->status === 1): ?>
                    <a onClick="deleteGame(<?=$game->id;?>)" class="btn btn-secondary delete-btn">Delete Game</a>
                <?php else: ?>
                    <a href="/games/<?=$game->id;?>/join" class="btn btn-secondary leave-join-game">Join Game</a>
                <?php endif;?>
            </div>
        </div>
    </div>