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
                    {{ __('You are logged in!') }}
                    </div>
                    <div class="row">
                    {{ __('Games:') }}
                    <p><a href = "{{ route('games') }}">Click Here</a> to see all games.</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
