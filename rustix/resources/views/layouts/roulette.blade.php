@extends('main')
@section('content')
<div class="h-100">
    <div class='roulette-wrapper flex-grow-0 p-2 rounded-3'>
        <div class='roulette-selector'></div>
        <div class='roulette-wheel'></div>
    </div>
    <p class="timer-custom">ROLLING IN: <span class="roulette-timer">0</span></p>
    <div class="round-time-bar"  style="--duration: 15;" data-style="smooth">
      <div></div>
    </div>

    <div>
      <ul role="toolbar" class="d-inline">
        <li class="d-inline"><button aria-setsize="4" aria-posinset="1">Button 1</button></li>
        <li class="d-inline"><button aria-setsize="4" aria-posinset="2">Button 2</button></li>
        <li class="d-inline"><button aria-setsize="4" aria-posinset="3">Button 3</button></li>
        <li class="d-inline"><button aria-setsize="4" aria-posinset="4">Button 4</button></li>
    </ul>

    </div>

    <input placeholder='roulette-outcome'>
    <button>
      Spin Wheel
    </button>
</div>


@endsection
@section('title',"XRoulette")

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/layouts/roulette.css')}}">
@endsection
@section('js')
<script src="{{ asset('js/layouts/roulette.js') }}"></script>
@endsection
