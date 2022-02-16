@extends('main')
@section('content')



    <div class="box-div">
        <span class="head-profile text-edit">Your Profile.</span>
        <div class="box-columns">
            <div class="text-edit flex-fill col-div">
                <span class="first-span-edit">Stats</span>
                <div class="total-deposited text-edit" style="background-color: rgba(53,59,84,1)">
                    <span class="p-2">Total Deposited:</span>
                    <span class="ms-auto p-2">$653.44</span>
                </div>
                <div class="total-deposited text-edit" >
                    <span class="p-2">Total Grambled:</span>
                    <span class="ms-auto p-2">$953.66</span>
                </div>
                <div class="total-deposited text-edit p0" style="background-color: rgba(53,59,84,1)">
                    <span class="p-2 ">Profit:</span>
                    <span class="ms-auto p-2">
                        -321,88
                    </span>
                </div>
                <span class="first-span-edit" style="padding: 2.625rem 0">Setting</span>
                <div class="total-deposited text-edit" style="background-color: rgba(53,59,84,1)">
                    <span class="p-2">Trade URL:</span>
                </div>
                <div class="total-deposited">
                    <a class="p-2 text-edit" style="opacity: 0.24" href="https://steamcommunity.com/profiles/76561198141872103/tradeoffers">https://steamcommunity.com/profiles/76561198141872103/tradeoffers</a>
                </div>
                <div class="total-deposited text-edit" style="background-color: rgba(53,59,84,1)">
                    <span class="p-2">Help me find my steam trade link</span>
                    <a class="btn-bet ms-auto text-edit" href="https://steamcommunity.com/profiles/76561198141872103/tradeoffers">Update</a>
                </div>
                    <div class="flex-fill avatar-edit"> 
                        <img src="{{ Auth::user()->avatar }}">
                        <span class="text-edit">MOD</span>
                        <span>{{ Auth::user()->name }}</span>
                    </div>
            </div>
            <div class="text-edit flex-fill col-div" style="background-color: #0d0e14">
                <span class="first-span-edit">Betting History</span>
            <div class="scroll">
                <div class="total-deposited text-edit" style="background-color: #00C74D">
                    <span class="p-2">Won 1337 coins:</span>
                    <span class="ms-auto p-2">x-roulette</span>
                    <span class="ms-auto p-2">02:44am</span>
                </div>
                <div class="ScrollStyle">
                  
                <div class="total-deposited  text-edit" style="background-color: #00C74D">
                    <span class="p-2">Won 1337 coins:</span>
                    <span class="ms-auto p-2">roulette</span>
                    <span class="ms-auto p-2">03:14pm</span>
                </div>
                <div class="total-deposited text-edit" style="background-color: rgba(175,41,41,1)">
                    <span class="p-2">Lost 1337 coins:</span>
                    <span class="ms-auto p-2">crazytime</span>
                    <span class="ms-auto p-2">10-03-22</span>
                </div>
                <div class="total-deposited text-edit" style="background-color: #00C74D">
                    <span class="p-2">Won 1337 coins:</span>
                    <span class="ms-auto p-2">x-roulette</span>
                    <span class="ms-auto p-2">02:44am</span>
                </div>
                <div class="total-deposited text-edit" style="background-color: rgba(175,41,41,1)">
                    <span class="p-2">Lost 1337 coins:</span>
                    <span class="ms-auto p-2">x-roulette</span>
                    <span class="ms-auto p-2">02:44am</span>
                </div>
            </div>
        </div>

            
    </div>
    </div>

    <!--
            <div class="p-3"> 
                <img src="{{ Auth::user()->avatar }}">
                <span>{{ Auth::user()->name }}</span>
            </div>
           -->
    @endsection
    @section('title', 'Profile')
    @section('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/layouts/profile.css') }}">
    @endsection
    @section('js')
        <script src="{{ asset('js/layouts/profile.js') }}"></script>
    @endsection

