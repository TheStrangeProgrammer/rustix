@extends('main')
@section('content')
    <div class="d-flex flex-fill flex-column">
        @if(Auth::check())
        <div class="head-text">
            <span class="welcome-text">Welcome back, <span class="my-auto align-self-center">{{ Auth::user()->name }}</span>
            </span>
            <span class="small-text">have a great day</span>
        </div>
        @endif
            <span class="gamemodes-text">GAMEMODES:</span>

    <div class="games-div">
        <a class="link-games" href="{{ URL::route('roulette') }}">
        <div class="card-game">
            <div class="top-card">
                <h5 class="game-text">ROULETTE</h5>
            </div>
            <div class="card-img-top-wrapper" style="background-image: url('../assets/Capture.svg'">
                <div class="d-flex card-overlay">
                    <a href="{{ URL::route('roulette') }}" class="play-button m-auto" style="color: white;">PLAY</a>
                </div>
            </div>
        </div>
        </a>
        <a class="link-games" href="{{ URL::route('x-roulette') }}">
            <div class="card-game">
                <a class="link-games" href="{{ URL::route('roulette') }}">
                    <div class="top-card">
                        <h5 class="game-text">X-ROULETTE</h5>
                    </div>
            <div class=" card-img-top-wrapper" style="background-image: url('../assets/Capture2.svg'">
                <div class="d-flex card-overlay">
                    <a href="{{ URL::route('x-roulette') }}" class="play-button m-auto"
                        style="color: white;">PLAY</a>
                </div>
            </div>

        </div>
        </a>
    </div>

    </div>
@endsection
@section('title', 'Home')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layouts/home.css') }}">
@endpush

