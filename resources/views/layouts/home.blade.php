@extends('main')
@section('content')
    <div class="d-flex flex-wrap flex-fill">
        <div class="card-game">
            <div class="card-img-top-wrapper" style="background-image: url('../assets/roulette-game.svg'">
                <div class="d-flex card-overlay">
                    <a href="{{ URL::route('roulette') }}" class="play-button m-auto py-3" style="color: white;">PLAY</a>
                </div>
            </div>
            <div class="card-body">
                <h5 class="game-text">ROULETTE</h5>
            </div>
        </div>

        <div class="card-game">
            <div class=" card-img-top-wrapper" style="background-image: url('../assets/x-roulette2.svg'">
                <div class="d-flex card-overlay">
                    <a href="{{ URL::route('x-roulette') }}" class="play-button m-auto py-3"
                        style="color: white;">PLAY</a>
                </div>
            </div>
            <div class="card-body">
                <h5 class="game-text">X-ROULETTE</h5>
            </div>
        </div>

    </div>
@endsection
@section('title', 'Home')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layouts/home.css') }}">
@endpush

