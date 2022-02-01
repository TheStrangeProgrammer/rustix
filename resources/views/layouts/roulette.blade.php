@extends('main')
@section('content')

    <div class="d-flex flex-column last-100">
        <div class="d-flex flex-row last-percent justify-content-start fw-bold align-items-center">
            <div class="label d-inline">Last 100</div>
            <div class="d-flex flex-row ms-2 align-items-center">
                <div class="rounded-circle circle-score ms-1" style="background-color: #F95146" ></div>
                <span class="score-bet ms-1 last-100-red">45</span>
            </div>
            <div class="d-flex flex-row ms-2 align-items-center">
                <span class="rounded-circle circle-score ms-1" style="background-color: #00C74D"></span>
                <span class="score-bet ms-1 last-100-green">5</span>
            </div>
            <div class="d-flex flex-row ms-2 align-items-center">
                <span class="rounded-circle circle-score ms-1" style="background-color: #2D3035"></span>
                <span class="score-bet ms-1 last-100-black">47</span>
            </div>
            <div class="d-flex flex-row ms-2 align-items-center">
                <span class="rounded-circle circle-score ms-1" style="background: linear-gradient(90deg,#7c99b4 50%,#de4c41 50%)"></span>
                <span class="score-bet ms-1 last-100-bait-red">47</span>
            </div>
            <div class="d-flex flex-row ms-2 align-items-center">
                <span class="rounded-circle circle-score ms-1" style="background: linear-gradient(90deg,#7c99b4 50%,#31353d 50%"></span>
                <span class="score-bet ms-1 last-100-bait-black">47</span>
            </div>
        </div>
        <div class="d-flex mt-3 last-7">
            <img class="image-circle rounded-circle" style="background-color:#F95146" src='../assets/blade.svg' width="30"
                height="30">
            <img class="image-circle rounded-circle" style="background-color:#F95146" src='../assets/blade.svg' width="30"
                height="30">
            <img class="image-circle rounded-circle" style="background-color:#F95146" src='../assets/blade.svg' width="30"
                height="30">
            <img class="image-circle rounded-circle" style="background-color:#2D3035" src='../assets/blade.svg' width="30"
                height="30">
            <img class="image-circle rounded-circle" style="background-color:#00C74D" src='../assets/blade.svg' width="30"
                height="30">
        </div>
    </div>


    <div class="d-flex flex-shrink-0 justify-content-center overflow-hidden roulette-wrapper ">
        <div class='roulette-selector'></div>
        <div class='d-flex roulette-wheel'></div>
    </div>
    <p class="timer-custom">ROLLING IN: <span class="roulette-timer">0</span></p>
    <div class="d-flex flex-shrink-0 rounded-pill round-time-bar">
        <div class="rounded-pill"></div>
    </div>
    <div class="d-flex bet-amount py-2 rounded-3">

        <div class="d-flex flex-column flex-fill betamount">
            <div style="opacity: 50%">Bet amount</div>
            <div class="d-flex">
                <img class="input-prefix " src="assets/dollar_coin.svg" width="16" height="16">
                <input type="number" class="input-bet" value="0">
            </div>
        </div>
        <button id="button-amount-clear" type="button" class="btn-clear">CLEAR</button>
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
        <div class="d-flex ms-2 bet-roulette">

            <div id="bet-list-red" class="d-flex flex-column m-2 bet-list">
                <div class="d-flex flex-column bet">
                    <div class="d-flex justify-content-center align-items-center text-bet">
                        <img class=" image-circle rounded-circle" style="background-color:#F95146" src='../assets/blade.svg'
                            width="30" height="30">
                        <img class=" image-circle rounded-circle" style="background-color:#F95146 " src='../assets/Hook.svg'
                            width="30" height="30">
                        <span class="mx-1">Win 2x</span>
                    </div>
                    <button id="bet-red" class="button-bet zoom-in-out-box" style="background-color: #F95146" aria-setsize="4"
                        aria-posinset="1">Place Bet</button>
                </div>
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

            <div id="bet-list-green" class="d-flex flex-column m-2 bet-list" >
                <div class="d-flex flex-column bet">
                    <div class="d-flex justify-content-center align-items-center text-bet">
                        <img class=" image-circle rounded-circle" style="background-color: #00C74D" src='../assets/R.svg'
                            width="30" height="30">
                        <span class="mx-1">Win 14x</span>
                    </div>
                    <button id="bet-green" class="button-bet zoom-in-out-box" style="background-color: #00C74D" aria-setsize="4"
                        aria-posinset="2">Place Bet</button>
                </div>
                <div class="d-flex">
                    <div class="me-auto p-2 ">
                        <span class="score-bet fw-bold bet-total-number">0</span>
                        <span class="fw-bold">Bets</span>
                    </div>
                    <div class="d-flex flex-row justify-content-end align-items-center me-2">
                        <img class="me-1 " src="assets/dollar_coin.svg" width="16" height="16">
                        <span class="score-bet fw-bold bet-total-amount">0</span>
                    </div>
                </div>
                <div class="bet-list-bets">

                </div>
            </div>


            <div id="bet-list-black" class="d-flex flex-column m-2 bet-list">
                <div class="d-flex flex-column bet">
                    <div class="d-flex justify-content-center align-items-center text-bet">
                        <img class="rounded-circle" style="background-color:#2D3035"
                            src='../assets/Shield.svg' width="30" height="30">
                        <img class="rounded-circle" style="background-color:#2D3035 " src='../assets/Hook.svg'
                            width="30" height="30">
                        <span class="mx-1">Win 2x</span>
                    </div>
                    <button id="bet-black" class="button-bet zoom-in-out-box" style="background-color: #2D3035" aria-setsize="4"
                        aria-posinset="3">Place Bet</button>
                </div>
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

            <div id="bet-list-bait" class="d-flex flex-column m-2 bet-list">
                <div class="d-flex flex-column bet">
                    <div class="d-flex justify-content-center align-items-center text-bet">
                        <img class=" image-circle rounded-circle" style="background-color:#F95146" src='../assets/Hook.svg'
                            width="30" height="30">
                        <img class=" image-circle rounded-circle" style="background-color:#2D3035 "
                            src='../assets/Hook.svg' width="30" height="30">
                        <span class="mx-1">Win 7x</span>
                    </div>
                    <button id="bet-bait" class="button-bet zoom-in-out-box" style="background-color: #7c99b4" aria-setsize="4"
                        aria-posinset="4">Place Bet</button>
                </div>
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
