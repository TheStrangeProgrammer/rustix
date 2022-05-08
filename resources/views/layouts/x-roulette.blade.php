@extends('main')
@section('content')

<div class="d-flex w-100 div-main-x-roulette">

    <div class="x-roulette">
        <div class="last-10"></div>
        <div class="roulette-wrapper flex-fill">
            <div class='roulette-selector'></div>
            <div class='roulette-background'></div>
            <div class='d-flex roulette-wheel'></div>
        </div>
        <p class="timer-custom">ROLLING IN: <span class="roulette-timer">0</span></p>
        <div class="round-time-bar">
            <div class="rounded-pill"></div>
        </div>
        <div class="bet-section ">
            <button id="bet-button" class="m-2 btn-bet">Place Bet</button>
            <div class="bet-amount">
                <div style="opacity: 50%">Multiplier</div>
                <div class="d-flex" >
                    <span style="opacity: 50%">x</span>
                    <input type="number" class="input-mult" value="1.01">
                </div>
            </div>
            <div class="flex-fill bet-amount">
                <div style="opacity: 50%">Bet amount</div>
                <div class="d-flex">
                    <span class="dollar-bet">$</span>
                    <input type="number" class="input-bet" value="0">
                </div>
            </div>
            <div class="d-flex justify-content-evenly my-2">
                <button id="button-amount-clear" type="button" class="btn-clear">CLEAR</button>
                <button id="button-amount-max" type="button" class="btn-bet">MAX</button>
                <button id="button-amount-repeat"  type="button" class="btn-bet ">REPEAT</button>
            </div>
        </div>
    </div>


    <div class="bet-list">
        <div class="d-flex">
            <div class="me-auto p-2 ">
                <span class="score-bet bet-total-number">0</span>
                <span class="fw-bold">Bets</span>
            </div>
            <div class="user-bets">
                <span class="dollar-bet-bet">$</span>
                <span class="score-bet bet-total-amount">0</span>
            </div>

        </div>
        <div class="bet-list-bets ">
            
        </div>
    </div>
    
</div>
@endsection
@section('title', 'X-Roulette')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layouts/x-roulette.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layouts/home.css') }}">
@endpush
@push('js')
    <script src="{{ asset('js/layouts/x-roulette.js') }}"></script>
@endpush
