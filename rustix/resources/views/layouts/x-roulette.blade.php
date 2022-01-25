@extends('main')
@section('content')

    <div id="overlay" class="d-flex justify-content-center align-items-center">
        <div class="spinner-border text-light" style="width: 10rem; height: 10rem;" role="status">
        </div>
    </div>


    <div class="d-flex flex-column last-100">
        <div class="last-percent justify-content-start fw-bold ">
            <div class="label d-inline">Last 100</div>
            <div class="d-inline ms-2 ">
                <span class="rounded-circle circle-score" style="background-color: #F95146"></span>
                <span class="score-bet">45</span>
            </div>
            <div class="d-inline ms-2 ">
                <span class="rounded-circle circle-score" style="background-color: #00C74D"></span>
                <span class="score-bet">5</span>
            </div>
            <div class="d-inline ms-2 ">
                <span class="rounded-circle circle-score" style="background-color: #2D3035"></span>
                <span class="score-bet">47</span>
            </div>
        </div>
        <div class="d-flex mt-3">
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
    <div class="d-flex justify-content-end bet-amount py-2 rounded-3">
        <div class="flex-column flex-fill betamount">
            <div style="opacity: 50%">Bet amount</div>
            <div class="d-inline">
                <img class="input-prefix " src="assets/dollar_coin.svg" width="16" height="16">
            </div>
            <input type="number" class="input-bet">
        </div>
        <button type="button" class="btn-clear">CLEAR</button>
        <button type="button" class="btn-bet ">LAST</button>
        <button type="button" class="btn-bet">+1</button>
        <button type="button" class="btn-bet">+10</button>
        <button type="button" class="btn-bet">+100</button>
        <button type="button" class="btn-bet">+1000</button>
        <button type="button" class="btn-bet">1/2</button>
        <button type="button" class="btn-bet">X2</button>
        <button type="button" class="btn-bet">MAX</button>
    </div>

    <div class="p-3 mt-4">
        <div class="d-flex ms-2 bet-roulette">

            <div class="d-flex flex-column flex-fill m-2 ">
                <div class="d-flex flex-column flex-fill bet">
                    <div class="d-flex justify-content-center align-items-center text-bet">
                        <img class=" image-circle rounded-circle" style="background-color:#F95146" src='../assets/blade.svg'
                            width="30" height="30">
                        <img class=" image-circle rounded-circle" style="background-color:#F95146 " src='../assets/hook.svg'
                            width="30" height="30">
                        <span class="mx-1">Win 2x</span>
                    </div>
                    <button class="button-bet zoom-in-out-box" style="background-color: #F95146" aria-setsize="4"
                        aria-posinset="1">Place Bet</button>
                </div>
                <div class="d-flex">
                    <div class="me-auto p-2 ">
                        <span class="score-bet fw-bold">6</span>
                        <span class="fw-bold">Bets</span>
                    </div>
                    <div class="d-flex flex-row justify-content-end align-items-center me-2">
                        <img class="me-1" src="assets/dollar_coin.svg" width="16" height="16">
                        <span class="score-bet fw-bold">32</span>
                    </div>

                </div>
                <div class="d-flex mt-2 ps-2 bg-list">
                    <div class="me-auto p-2">
                        <img class="image-circle rounded-circle" style="background-color:#F95146" src='../assets/hook.svg'
                            width="30" height="30">
                        <span class="fw-bold">Joe</span>
                    </div>
                    <div class="d-flex flex-row justify-content-end align-items-center me-2">
                        <img class="me-1" src="assets/dollar_coin.svg" width="16" height="16">
                        <span class="score-bet fw-bold">1.200</span>
                    </div>

                </div>
            </div>

            <div class="d-flex flex-column flex-fill m-2">
                <div class="d-flex flex-column flex-fill bet">
                    <div class="d-flex justify-content-center align-items-center text-bet">
                        <img class=" image-circle rounded-circle" style="background-color: #00C74D" src='../assets/R.svg'
                            width="30" height="30">
                        <span class="mx-1">Win 14x</span>
                    </div>
                    <button class="button-bet zoom-in-out-box" style="background-color: #00C74D" aria-setsize="4"
                        aria-posinset="2">Place Bet</button>
                </div>
                <div class="d-flex">
                    <div class="me-auto p-2 ">
                        <span class="score-bet fw-bold">6</span>
                        <span class="fw-bold">Bets</span>
                    </div>
                    <div class="d-flex flex-row justify-content-end align-items-center me-2">
                        <img class="me-1" src="assets/dollar_coin.svg" width="16" height="16">
                        <span class="score-bet fw-bold">32</span>
                    </div>

                </div>
                <div class="d-flex mt-2 ps-2 bg-list">
                    <div class="me-auto p-2">
                        <img class=" image-circle rounded-circle" style="background-color:#F95146" src='../assets/hook.svg'
                            width="30" height="30">
                        <span class="fw-bold">Joe</span>
                    </div>
                    <div class="d-flex flex-row justify-content-end align-items-center me-2">
                        <img class="me-1" src="assets/dollar_coin.svg" width="16" height="16">
                        <span class="score-bet fw-bold">1.200</span>
                    </div>

                </div>
            </div>


            <div class="d-flex flex-column flex-fill m-2">
                <div class="d-flex flex-column flex-fill bet">
                    <div class="d-flex justify-content-center align-items-center text-bet">
                        <img class=" image-circle rounded-circle" style="background-color:#2D3035"
                            src='../assets/shield.svg' width="30" height="30">
                        <img class=" image-circle rounded-circle" style="background-color:#2D3035 " src='../assets/hook.svg'
                            width="30" height="30">
                        <span class="mx-1">Win 2x</span>
                    </div>
                    <button class="button-bet zoom-in-out-box" style="background-color: #2D3035" aria-setsize="4"
                        aria-posinset="3">Place Bet</button>
                </div>
                <div class="d-flex">
                    <div class="me-auto p-2 ">
                        <span class="score-bet fw-bold">6</span>
                        <span class="fw-bold">Bets</span>
                    </div>
                    <div class="d-flex flex-row justify-content-end align-items-center me-2">
                        <img class="me-1" src="assets/dollar_coin.svg" width="16" height="16">
                        <span class="score-bet fw-bold">32</span>
                    </div>

                </div>
                <div class="d-flex mt-2 ps-2 bg-list">
                    <div class="me-auto p-2">
                        <img class=" image-circle rounded-circle" style="background-color:#F95146" src='../assets/hook.svg'
                            width="30" height="30">
                        <span class="fw-bold">Joe</span>
                    </div>
                    <div class="d-flex flex-row justify-content-end align-items-center me-2">
                        <img class="me-1" src="assets/dollar_coin.svg" width="16" height="16">
                        <span class="score-bet fw-bold">1.200</span>
                    </div>

                </div>

            </div>

            <div class="d-flex flex-column flex-fill m-2">
                <div class="d-flex flex-column flex-fill bet">
                    <div class="d-flex justify-content-center align-items-center text-bet">
                        <img class=" image-circle rounded-circle" style="background-color:#F95146" src='../assets/hook.svg'
                            width="30" height="30">
                        <img class=" image-circle rounded-circle" style="background-color:#2D3035 "
                            src='../assets/hook.svg' width="30" height="30">
                        <span class="mx-1">Win 7x</span>
                    </div>
                    <button class="button-bet zoom-in-out-box" style="background-color: #7c99b4" aria-setsize="4"
                        aria-posinset="4">Place Bet</button>
                </div>
                <div class="d-flex">
                    <div class="me-auto p-2 ">
                        <span class="score-bet fw-bold">6</span>
                        <span class="fw-bold">Bets</span>
                    </div>
                    <div class="d-flex flex-row justify-content-end align-items-center me-2">
                        <img class="me-1" src="assets/dollar_coin.svg" width="16" height="16">
                        <span class="score-bet fw-bold">32</span>
                    </div>

                </div>
                <div class="d-flex mt-2 ps-2 bg-list">
                    <div class="me-auto p-2">
                        <img class=" image-circle rounded-circle" style="background-color:#F95146" src='../assets/hook.svg'
                            width="30" height="30">
                        <span class="fw-bold">Joe</span>
                    </div>
                    <div class="d-flex flex-row justify-content-end align-items-center me-2">
                        <img class="me-1" src="assets/dollar_coin.svg" width="16" height="16">
                        <span class="score-bet fw-bold">1.200</span>
                    </div>

                </div>
            </div>

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
