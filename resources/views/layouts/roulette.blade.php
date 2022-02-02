@extends('main')
@section('content')

    <div class="last-100">
        <div class="last-percent style-top-circles">
            <div>Last 100</div>
            <div class="style-top-circles">
                <div class=" circle-score" style="background-color: #F95146" ></div>
                <span class="score-bet last-100-red">45</span>
            </div>
            <div class="style-top-circles">
                <span class=" circle-score"  style="background-color: #00C74D"></span>
                <span class="score-bet last-100-green">5</span>
            </div>
            <div class="style-top-circles">
                <span class=" circle-score " style="background-color: #2D3035"></span>
                <span class="score-bet last-100-black">47</span>
            </div>
            <div class="style-top-circles">
                <span class=" circle-score " style="background: linear-gradient(90deg,#7c99b4 50%,#de4c41 50%)"></span>
                <span class="score-bet last-100-bait-red">47</span>
            </div>
            <div class="style-top-circles">
                <span class="circle-score" style="background: linear-gradient(90deg,#7c99b4 50%,#31353d 50%"></span>
                <span class="score-bet last-100-bait-black">47</span>
            </div>
        </div>
        <div class="last-7">
            <img class="image-circle">
            <img class="image-circle">
            <img class="image-circle">
            <img class="image-circle">
            <img class="image-circle">
    </div>


    <div class="roulette-wrapper ">
        <div class='roulette-selector'></div>
        <div class='d-flex roulette-wheel'></div>
    </div>
    <p class="timer-custom">ROLLING IN: 
        <span class="roulette-timer">0</span></p>
    <div class="round-time-bar">
        <div class="rounded-pill"></div>
    </div>
    <div class="bet-amount-bar">

        <div class="d-flex flex-column flex-fill bet-amount-section">
            <div style="opacity: 50%">Bet amount</div>
            <div class="d-flex">
                <img class="input-prefix " src="assets/dollar_coin.svg" width="16" height="16">
                <input type="number" class="input-bet" value="0">
            </div>
        </div>
        <button id="button-amount-clear" type="button">CLEAR</button>
        <button id="button-amount-last"  type="button" class="btn-bet ">LAST</button>
        <button id="button-amount-1" type="button" class="btn-bet">+1</button>
        <button id="button-amount-10" type="button" class="btn-bet">+10</button>
        <button id="button-amount-100" type="button" class="btn-bet">+100</button>
        <button id="button-amount-1000" type="button" class="btn-bet">+1000</button>
        <button id="button-amount-2" type="button" class="btn-bet">1/2</button>
        <button id="button-amount-x2" type="button" class="btn-bet">X2</button>
        <button id="button-amount-max" type="button" class="btn-bet">MAX</button>
    </div>

    <div class="p-3 mt-4">
        <div class="bet-roulette">
            <div id="bet-list-red" class="bet-list">
                <div class="bet">
                    <div class="text-bet">
                        <img class=" image-circle" src='../assets/Blade.svg'>
                        <img class=" image-circle" src='../assets/Hook.svg'>
                        <span class="mx-1">Win 2x</span>
                    </div>
                    <button id="bet-red" class="button-bet ">Place Bet</button>
                </div>
                <div class="d-flex">
                    <div class="me-auto p-2 ">
                        <span class="score-bet bet-total-number">0</span>
                        <span class="fw-bold">Bets</span>
                    </div>
                    <div class="btn-coin">
                        <img src="assets/dollar_coin.svg">
                        <span class="score-bet bet-total-amount">0</span>
                    </div>
                </div>
                <div class="bet-list-bets">

                </div>
            </div>

            <div id="bet-list-green" class="bet-list" >
                <div class="bet">
                    <div class="text-bet">
                        <img class=" image-circle" src='../assets/R.svg'>
                        <span class="mx-1">Win 14x</span>
                    </div>
                    <button id="bet-green" class="button-bet">Place Bet</button>
                </div>
                <div class="d-flex">
                    <div class="me-auto p-2 ">
                        <span class="score-bet bet-total-number">0</span>
                        <span class="fw-bold">Bets</span>
                    </div>
                    <div class="btn-coin">
                        <img src="assets/dollar_coin.svg">
                        <span class="score-bet bet-total-amount">0</span>
                    </div>
                </div>
                <div class="bet-list-bets">

                </div>
            </div>


            <div id="bet-list-black" class="bet-list">
                <div class="bet">
                    <div class="text-bet">
                        <img class=" image-circle " src='../assets/Shield.svg'>
                        <img class=" image-circle " src='../assets/Hook.svg'>
                        <span class="mx-1">Win 2x</span>
                    </div>
                    <button id="bet-black" class="button-bet">Place Bet</button>
                </div>
                <div class="d-flex">
                    <div class="me-auto p-2 ">
                        <span class="score-bet bet-total-number">0</span>
                        <span class="fw-bold">Bets</span>
                    </div>
                    <div class="btn-coin">
                        <img src="assets/dollar_coin.svg">
                        <span class="score-bet bet-total-amount">0</span>
                    </div>
                </div>
                <div class="bet-list-bets">

                </div>
            </div>

            <div id="bet-list-bait" class="bet-list">
                <div class="bet">
                    <div class="text-bet">
                        <img class=" image-circle " style="background-color:#F95146" src='../assets/Hook.svg'>
                        <img class=" image-circle " style="background-color:#2D3035 " src='../assets/Hook.svg'>
                        <span class="mx-1">Win 7x</span>
                    </div>
                    <button id="bet-bait" class="button-bet">Place Bet</button>
                </div>
                <div class="d-flex">
                    <div class="me-auto p-2 ">
                        <span class="score-bet bet-total-number">0</span>
                        <span class="fw-bold">Bets</span>
                    </div>
                    <div class="btn-coin">
                        <img src="assets/dollar_coin.svg">
                        <span class="score-bet bet-total-amount">0</span>
                    </div>

                </div>
                <div class="bet-list-bets">

                </div>
            </div>

        </div>

    </div>


@endsection
@section('title', 'Roulette')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layouts/roulette.css') }}">
@endsection
@section('js')
    <script src="{{ asset('js/layouts/roulette.js') }}"></script>
@endsection
