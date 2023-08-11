<?php 
use Illuminate\Support\Facades\Auth;
use \App\Models\User;
use \App\Models\Games;
//Blade part for looping through games.
$current_user_ids = Games::currentPlayers($game->id);
$players_in_game = User::showAllUsersInArray($current_user_ids); 
$num_players_in_game = count($players_in_game);     
?>
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
            Created By: <a href="/profile/<?=$game->created_by?>"><?= User::findUser($game->created_by)->username ?></a>
        </div>
        <div class="inner-games__options col-md-4">
            <p>Players in game: <br />
                <?php for ($i=0; $i <= $num_players_in_game - 1; $i++): ?>
                    <?php if ( $players_in_game[$i]->profile_pic ) : ?>
                            <div class="col-md-2">
                                <a href="/profile/<?=$players_in_game[$i]->id?>">
                                    <img src="<?= asset('images/profile_pics/' . $players_in_game[$i]->profile_pic); ?>" class="profile-container__pic" alt="Profile pic of {{__($players_in_game[$i]->username)}}" style="max-width:75px;" />
                                </a>
                            </div>
                            <a href="/profile/<?=$players_in_game[$i]->id?>"><?=$players_in_game[$i]->username; ?></a>
                            <br />
                    <?php else : ?>
                        <a href="/profile/<?=$players_in_game[$i]->id?>"><?=$players_in_game[$i]->username; ?></a>
                        <br />
                    <?php endif; ?>
                
                <?php endfor; ?>
            </p>
            <p><?= $num_players_in_game; ?> out of <?= $game->number_players ?> players found.</p>
            <div class="bottom">
                <a href="/game/<?=$game->id;?>" class="btn btn-secondary see-game">See Game</a>

                <?php if(in_array(Auth::id(), $current_user_ids) && $game->created_by != Auth::id()): ?>
                    <a href="/games/<?=$game->id;?>/leave" class="btn btn-secondary leave-join-game">Leave Game</a>
                <?php elseif($game->created_by === Auth::id() && $game->status === 1): ?>
                    <a onClick="deleteGame(<?=$game->id;?>)" class="btn btn-secondary delete-btn">Delete Game</a>
                <?php else: ?>
                    <a href="/games/<?=$game->id;?>/join" class="btn btn-secondary leave-join-game">Join Game</a>
                <?php endif;?>
            </div>
        </div>
    </div>