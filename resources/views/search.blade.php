@extends('layouts.app')

@section('content')

  <div class="container white-box">
    <livewire:search :searching_for="'user'" /> 
  </div>
  
@endsection
