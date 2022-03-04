@extends('main')
@section('content')
    <div class="d-flex flex-fill flex-column">
        @if (Auth::check())
            <div class="head-text">
                <span class="welcome-text">Welcome back, <span
                        class="my-auto align-self-center">{{ Auth::user()->name }}</span>
                </span>
                <span class="small-text">have a great day</span>
            </div>
        @endif
        <span class="gamemodes-text">GAMEMODES:</span>

        <div class="games-div">
            <a class="card-game" href="{{ URL::route('roulette') }}">
                <div class="top-card">
                    <h5 class="game-text">ROULETTE</h5>
                </div>
                <div class="card-img-top-wrapper" style="background-image: url('../assets/Capture.svg'">
                    <div class="d-flex card-overlay">
                        <p class="play-button m-auto" style="color: white;">PLAY</p>
                    </div>
                </div>
            </a>
            <a class="card-game" href="{{ URL::route('x-roulette') }}">
                <div class="top-card">
                    <h5 class="game-text">X-ROULETTE</h5>
                </div>
                <div class=" card-img-top-wrapper" style="background-image: url('../assets/Capture2.svg'">
                    <div class="d-flex card-overlay">
                        <p class="play-button m-auto" style="color: white;">PLAY</p>
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
