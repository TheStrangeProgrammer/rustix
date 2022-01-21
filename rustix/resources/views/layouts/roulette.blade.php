@extends('main')
@section('content')
<div class="h-100" >
    <div class='roulette-wrapper flex-grow-0 p-2'>
        <div class='roulette-selector'></div>
        <div class='roulette-wheel'></div>
    </div>
    <p class="timer-custom">ROLLING IN: <span class="roulette-timer">0</span></p>
    <div class="round-time-bar"  style="--duration: 15;" data-style="smooth">
      <div></div>
    </div>
    <div class="d-flex justify-content-end bet-amount py-2 rounded-3">
      <button type="button" class="btn-bet" style="background-color: #0d0e14 !important">CLEAR</button>
      <button type="button" class="btn-bet">LAST</button>
      <button type="button" class="btn-bet">+1</button>
      <button type="button" class="btn-bet">+10</button>
      <button type="button" class="btn-bet">+100</button>
      <button type="button" class="btn-bet">+1000</button>
      <button type="button" class="btn-bet">1/2</button>
      <button type="button" class="btn-bet">X2</button>
      <button type="button" class="btn-bet">MAX</button>
    </div>

    <div class="bet-roulette p-3 mt-4">
      <ul role="toolbar" class="ms-2">

            <li class="bet mx-2 ">
              <div class="text-bet">
                <div class="d-inline me-0">
                  <img class="image-circle rounded-circle" style="background-color:#F95146" src='../assets/blade.svg' width="30" height="30">
                </div>
                <div class="d-inline ms-0">
                  <img class="image-circle rounded-circle" style="background-color:#F95146 " src='../assets/hook.svg' width="30" height="30">
                </div>
                <p class="d-inline">Win 2x</p>
              </div>
              <button class="col-md-12 button-bet zoom-in-out-box"  style="background-color: #F95146"  aria-setsize="4" aria-posinset="1">Place Bet</button>
            </li>

            <li class="bet mx-2">
              <div class="text-bet">
                <div class="d-inline me-0">
                  <img class="image-circle rounded-circle" style="background-color: #00C74D" src='../assets/R.svg' width="30" height="30">
                </div>
                <p class="d-inline">Win 4x</p>
              </div>
              <button class="col-md-12 button-bet zoom-in-out-box" style="background-color: #00C74D" aria-setsize="4" aria-posinset="2">Place Bet</button>
            </li>

            <li  class="bet mx-2">
              <div class="text-bet">
                <div class="d-inline me-0">
                  <img class="image-circle rounded-circle" style="background-color:#2D3035" src='../assets/shield.svg' width="30" height="30">
                </div>
                <div class="d-inline ms-0">
                  <img class="image-circle rounded-circle" style="background-color:#2D3035 " src='../assets/hook.svg' width="30" height="30">
                </div>
                <p class="d-inline">Win 2x</p>
              </div>
              <button class="col-md-12 button-bet zoom-in-out-box" style="background-color: #2D3035" aria-setsize="4" aria-posinset="3">Place Bet</button>
            </li >

            <li  class="bet mx-2">
              <div class="text-bet">
                <div class="d-inline me-0">
                  <img class="image-circle rounded-circle" style="background-color:#F95146" src='../assets/hook.svg' width="30" height="30">
                </div>
                <div class="d-inline ms-0">
                  <img class="image-circle rounded-circle" style="background-color:#2D3035 " src='../assets/hook.svg' width="30" height="30">
                </div>
                <p class="d-inline">Win 2x</p>
              </div>
              <button class="col-md-12 button-bet zoom-in-out-box" style="background-color: #7c99b4" aria-setsize="4" aria-posinset="4">Place Bet</button>
            </li>

    </ul>

    </div>


</div>


@endsection
@section('title',"XRoulette")

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/layouts/roulette.css')}}">
@endsection
@section('js')
<script src="{{ asset('js/layouts/roulette.js') }}"></script>
@endsection
