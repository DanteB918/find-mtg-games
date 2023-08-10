@extends('layouts.app')

@section('content')

  <div class="container lookup">
    <livewire:search :searching_for="'user'" /> 
  </div>
  
@endsection
