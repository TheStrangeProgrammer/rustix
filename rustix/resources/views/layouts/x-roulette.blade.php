@extends('main')
@section('content')

    <div class="d-flex flex-column roulette">
        <div class="d-flex justify-content-start py-2 rounded-3 last-10">

        </div>
        <div class="d-flex flex-shrink-0 flex-grow-0 justify-content-center overflow-hidden roulette-wrapper w-100">
            <div class='roulette-selector'></div>
            <div class='d-flex roulette-wheel'></div>
        </div>
        <p class="timer-custom">ROLLING IN: <span class="roulette-timer">0</span></p>
        <div class="d-flex flex-shrink-0 rounded-pill round-time-bar">
            <div class="rounded-pill"></div>
        </div>
        <div class="d-flex bet-amount rounded-3">
            <button id="bet-button" class="m-2 btn-bet">Place Bet</button>
            <div class="d-flex flex-column flex-fill my-2 betamount">
                <div style="opacity: 50%">Multiplier</div>
                <div class="d-flex ">
                    <i class="bi bi-x"></i>

                    <input type="number" class="input-mult" value="1.00">
                </div>
            </div>
            <div class="d-flex flex-column flex-fill my-2 betamount">
                <div style="opacity: 50%">Bet amount</div>
                <div class="d-flex">
                    <img class="input-prefix " src="assets/dollar_coin.svg" width="16" height="16">

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


    <div class="d-flex flex-column m-2 bet-list">
        <div class="d-flex">
            <div class="me-auto p-2 ">
                <span class="score-bet fw-bold bet-total-number">0</span>
                <span class="fw-bold">Bets</span>
            </div>
            <div class="d-flex flex-row justify-content-end align-items-center me-2">
                <img class="me-1" src="assets/dollar_coin.svg" width="16" height="16">
                <span class="score-bet fw-bold bet-total-amount">0</span>
            </div>

        </div>
        <div class="bet-list-bets">

        </div>
    </div>
@endsection
@section('title', 'X-Roulette')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layouts/x-roulette.css') }}">
@endsection
@section('js')
    <script src="{{ asset('js/layouts/x-roulette.js') }}"></script>
@endsection
