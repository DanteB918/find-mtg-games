   <div class="inner-games row game-{{ $game->getKey() }} loop-border">
        <div class="inner-games__info col-md-8">
            Location: {{ $game->state }}, {{ $game->country }} <br />
            When: {{ $game->date }} at {{ date("g:i a", strtotime($game->time)) }}<br />
            Power Level: {{ $game->power_level }}<br />
            Number of Players: {{ $game->number_players }}<br />
            Format:  {{ $game->format }} <br />
            @if ($game->description)
                Description: {{ $game->description }}<br />
            @endif
            Created By: <a href="{{ route('profile', $game->created_by) }}">{{ \App\Models\User::find($game->created_by)->username }}</a>
        </div>
        <div class="inner-games__options col-md-4">
            <p>Players in game: <br />
                @foreach ($game->players as $player)
                    @php $player = $player->player @endphp
                    @if ($player->profile_pic)
                        <div class="col-md-2">
                            <a href="{{ route('profile', $player->getKey()) }}">
                                <img src="{{ asset('images/profile_pics/' . $player->profile_pic) }}" class="profile-container__pic" alt="Profile pic of {{__($player->username)}}" style="max-width:75px;" />
                            </a>
                        </div>
                        <a href="{{ route('profile', $player->getKey()) }}">{{ $player->username }}</a>
                        <br />
                    @else
                        <a href="{{ route('profile', $player->getKey()) }}">{{ $player->username }}</a>
                        <br />
                    @endif
                @endforeach
            </p>
            <p>{{ $game->players()->count() }} out of {{ $game->number_players }} players found.</p>
            <div class="bottom">
                <a href="{{ route('singleGame', $game->getKey()) }}" class="btn btn-secondary see-game">See Game</a>

                @if ($game->players->contains(auth()->id()) && $game->created_by != auth()->id())
                    <a href="{{ route('leaveGame', $game->getKey()) }}" class="btn btn-secondary leave-join-game">Leave Game</a>
                @elseif ($game->created_by === auth()->id())
                    <a onClick="deleteGame({{ $game->getKey() }})" class="btn btn-secondary delete-btn">Delete Game</a>
                @else
                    <a href="{{ route('requestJoin', $game->getKey()) }}" class="btn btn-secondary leave-join-game">Join Game</a>
                @endif
            </div>
        </div>
    </div>