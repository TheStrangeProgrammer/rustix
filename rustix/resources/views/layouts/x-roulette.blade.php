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
        <div class="d-flex justify-content-center " style="margin-top: 50px">
            <div class="d-flex flex-column">
                <span class="text-center text-wager">WAGER</span>
                <div class="d-flex flex-row wager">
                    <span class="fw-bolder my-auto" style="color: rgb(255, 255, 255);">$</span>
                    <input type="number" class="my-auto ms-2 input-wager input-bet">
                </div>
            </div>
            <div class="d-flex flex-column ms-2">
                <span class="text-center text-wager">MULTIPLIER</span>
                <div class="d-flex flex-row wager">
                    <span class="fw-bolder my-auto" style="color: rgb(255, 255, 255);">x</span>
                    <input type="number" class="my-auto ms-2 input-wager input-mult">
                </div>
            </div>

            <div class="d-flex ms-2  align-self-end">
                <button type="button" class=" max-btn">MAX BET</button>
            </div>
            <div class="d-flex ms-2  align-self-end">
                <button type="button" class=" max-btn">PLACE BET</button>
            </div>
            <button type="button" class="d-flex ms-2 align-self-end replay">
                <img src="assets/replay.svg" style="color-adjust: white" width="41" height="41">
            </button>
        </div>
    </div>


    <div class="d-flex flex-column flex-fill m-2 p-2 flex-shrink-1 bet">
        <div class="d-flex flex-column flex-fill ">
            <div class="d-flex flex-column">
                <div class="me-auto p-2 ">
                    <span class="fw-bold">Top Bets</span>
                </div>
                <div class="d-flex mt-2 ps-2 bg-list">
                    <div class="me-auto p-2">
                        <img class=" image-circle rounded-circle" style="background-color:#F95146" src='../assets/hook.svg'
                            width="30" height="30">
                        <span class="fw-bold">Joe</span>
                    </div>
                    <div class="d-flex flex-row justify-content-end align-items-center p-2 me-2">
                        <span class="score-bet fw-bold">x2</span>
                        <span class="fw-bolder ms-3 ">$</span>
                        <span class="score-bet fw-bold">1.000</span>
                    </div>

                </div>
            </div>
            <div class="d-flex flex-column mt-3">
                <div class="me-auto p-2 ">
                    <span class="fw-bold">All Bets</span>
                </div>
                <div class="d-flex mt-2 ps-2 bg-list">
                    <div class="me-auto p-2">
                        <img class=" image-circle rounded-circle" style="background-color:#F95146" src='../assets/hook.svg'
                            width="30" height="30">
                        <span class="fw-bold">Joe</span>
                    </div>
                    <div class="d-flex flex-row justify-content-end align-items-center p-2 me-2">
                        <span class="score-bet fw-bold">x2</span>
                        <span class="fw-bolder ms-3 ">$</span>
                        <span class="score-bet fw-bold">1.000</span>
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
