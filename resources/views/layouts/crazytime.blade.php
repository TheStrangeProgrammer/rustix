@extends('main')
@section('content')
<div class="d-flex flex-column w-100">
    <div class="d-flex w-100 roll-first-div" style="font-family: 'Neometric'">
        <div class="multiplier-div hidden-mobile">
            <span class="multiplier-span">MULTIPLIER</span>
            <div class="d-flex justify-content-center" style="height: 5.21vw">
                <input type="number" value="1" class="input-mult">
                <input type="number" value="15" class="input-mult">
            </div>
            
        </div>
        <div class="img-roll">
            <img src="assets/Roll.svg" >
        </div>
        <div class="div-text-won hidden-mobile">
            <span>13 people won 13.883$ on this round : </span>
            <span>George won 1.334$ Alex won 334$ Adi won 114.33$ Caca won 13.11$</span>
        </div>
    </div>
    <div class="hidden-div" style="width: 45%">
        <div class="multiplier-div">
            <span class="multiplier-span">MULTIPLIER</span>
            <div class="d-flex justify-content-center" style="height: 5.21vw">
                <input type="number" value="1" class="input-mult">
                <input type="number" value="15" class="input-mult">
            </div>
            
        </div>
        <div class="div-text-won ms-2">
            <span>13 people won 13.883$ on this round : </span>
            <span>George won 1.334$ Alex won 334$ Adi won 114.33$ Caca won 13.11$</span>
        </div>
    </div>
    <div class="bot-div">
        <div class="d-flex w-25"></div>
        <div class="d-flex flex-column div-bets">
            <div class="d-flex div-cards">
                <div class="d-flex flex-row first-cards">
                    <div class="card-crazy color-crazy1">
                        <span class="line-crazy" style="background-color: #A5D8D7"></span>
                        <span class="nr-crazy1 nr-crazy">1</span>
                        <span class="line-crazy" style="background-color: #A5D8D7"></span>
                    </div>
                    <div class="card-crazy color-crazy2">
                        <span class="line-crazy" style="background-color: #FDDD8A"></span>
                        <span class="nr-crazy2 nr-crazy">2</span>
                        <span class="line-crazy" style="background-color: #FDDD8A"></span>
                    </div>
                </div>
                <div class="d-flex flex-row last-cards">
                    <div class="card-crazy color-crazy3">
                        <button id="deposit-button" class="nr-crazy w-100 h-100" data-bs-toggle="modal"
                        data-bs-target="#COINFLIP" style="box-shadow: none">COINFLIP</button>
                    </div>
                    <div class="card-crazy color-crazy4">
                        <button id="deposit-button" class="nr-crazy w-100 h-100" data-bs-toggle="modal"
                        data-bs-target="#PACHINKO" style="box-shadow: none">PACHINKO</button>
                    </div>
                </div>
                
            </div>
            <div class="d-flex div-cards w-50">
                <div class="d-flex flex-row first-cards">
                    <div class="card-crazy color-crazy5">
                        <span class="line-crazy" style="background-color: #DEAABB"></span>
                        <span class="nr-crazy3 nr-crazy">1</span>
                        <span class="line-crazy" style="background-color: #DEAABB"></span>
                    </div>
                    <div class="card-crazy color-crazy6">
                        <span class="line-crazy" style="background-color: #C2BAF1"></span>
                        <span class="nr-crazy4 nr-crazy">2</span>
                        <span class="line-crazy" style="background-color: #C2BAF1"></span>
                    </div>
                </div>
                <div class="d-flex flex-row last-cards">
                    <div class="card-crazy color-crazy7">
                        <span class="nr-crazy" style="box-shadow: none">CASH HUNT</span>
                    </div>
                    <div class="card-crazy color-crazy8">
                        <span class="nr-crazy" style="box-shadow: none">CRAZY TIME</span>
                    </div>
                </div>
            </div>
            <div class="d-flex div-cards left-crazy-circles">
                    <span  class="text-bottom">13$ on this round.</span>
                    <div class="d-flex align-self-center">
                        <span class="circle-crazy">0.1</span>
                        <span class="circle-crazy">0.5</span>
                        <span class="circle-crazy">1</span>
                        <span class="circle-crazy">5</span>
                        <span class="circle-crazy">25</span>
                    </div>
                <div class="btn-clear div-card-clear">
                    <button>CLEAR</button>
                </div>
                
        </div>
        
</div>
<div class="right-circle">
    <div class="second-div-circles">
        <span class="circle-right">1</span>
        <span class="circle-right color-circle">2</span>
        <span class="circle-right">1</span>
        <span class="circle-right">1</span>
        <span class="circle-right">1</span>
    </div>
    <div class="second-div-circles mt-2">
        <span class="circle-right color-circle">2</span>
        <span class="circle-right color-circle">2</span>
        <span class="circle-right color-circle">2</span>
        <span class="circle-right">1</span>
        <span class="circle-right">1</span>
    </div>
</div>
</div>
@endsection
@section('title', 'Crazy-Time')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layouts/crazytime.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layouts/home.css') }}">
@endpush
@push('js')
    <script src="{{ asset('js/layouts/crazytime.js') }}"></script>
@endpush
