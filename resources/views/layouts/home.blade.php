@extends('main')
@section('content')
    <div class="d-flex flex-fill flex-column">
        <div class="head-text">
            <span class="welcome-text">Welcome back, <span class="my-auto align-self-center">{{ Auth::user()->name }}</span>
            </span>
            <span class="small-text">have a great day</span>
        </div>
            <span class="gamemodes-text">GAMEMODES:</span>
    <div class="games-div">
        <a href="{{ URL::route('roulette') }}" class="card-game">
            <div class="d-flex p-3">
                <h5 class="game-text">ROULETTE</h5>
            </div>
            <div class="card-img-top-wrapper" style="background-image: url('../assets/roulette-game.svg'">

            </div>
        </a>

        <a href="{{ URL::route('roulette') }}" class="card-game">
            <div class="d-flex p-3">
                <h5 class="game-text">X-ROULETTE</h5>
            </div>
            <div class=" card-img-top-wrapper" style="background-image: url('../assets/x-roulette2.svg'">

            </div>

        </a>
    </div>
    </div>
@endsection
@section('title', 'Home')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layouts/home.css') }}">
@endpush

