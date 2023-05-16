@extends('layouts.app')

@section('content')
<body>
    <h1>Game created successfully.</h1>
    <p><a href = "{{ route('createGameForm') }}">Click Here</a> to go back.</p>
    <p><a href = "{{ route('games') }}">Click Here</a> to see all games.</p>
   
</body>
@endsection