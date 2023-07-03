<div class="col-md-2 game-sidebar">
        <div class="card">
        <div class="card-header">{{ __('Game Options') }}</div>
            <div class="card-body" >
                <a href="{{ route('createGameForm') }}" class="btn btn-primary">Create a new Game</a>
                <a href="{{ route('games') }}" class="btn btn-primary">See All Games</a>
                <a href="{{ route('myGames') }}" class="btn btn-primary">My Games</a>
            </div>
        </div>
    </div>