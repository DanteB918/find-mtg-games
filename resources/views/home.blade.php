@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        You are logged in!
                    </div>
                    <div class="row">
                        Friends:
                        <p>See who's online! <a href="{{ route('friendslist') }}">Friend List</a></p>
                    </div>
                    <div class="row">
                        Games:
                        <p>to see all games, <a href = "{{ route('games') }}">Click Here</a>.</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
