@extends('main')
@section('content')



    <div class="flex-column flex-container">
            <div class="p-3"> 
                <img src="{{ Auth::user()->avatar }}">
                <span>{{ Auth::user()->name }}</span>
            </div>
            <div class="head-buttons">
                <input id="butn" type="button" name="answer" value="Overview" onclick="showDiv()" />
                <input id="butn" type="button" name="answer" value="Referrals" onclick="showDiv2()" />
                <input id="butn" type="button" name="answer" value="History" onclick="showDiv3()" />
            </div>
            <div class=" profile-edit">        
            <div id="profile" style="display: none" class="answer_list">               
                                
                    <div class="head-information me-2">
                        <p>Total Deposited:</p>
                        <p>Total Spent:</p>
                        <p>Total Withdrawed:</p>
                        <input name="tradeToken" placeholder="Token here.." type="text" value="{{ $tradeToken }}">
                    </div>
                    
                    <div class="head-information ms-2 ">
                        <div class="d-flex d-inline">
                            <img src="assets/dollar_coin.svg">
                            <p >{{ $totalDeposit }}</p>
                        </div>
                        <div class="d-flex d-inline">
                            <img src="assets/dollar_coin.svg">
                            <p class="ms-3 py-2 ">{{ $totalSpent }}</p>
                        </div>
                        <div class="d-flex d-inline">
                            <img src="assets/dollar_coin.svg">
                            <p class="ms-3 py-2 ">{{ $totalWithdraw }}</p>
                        </div>
                        <form method="POST" action="{{ URL::route('setTradeToken') }}">
                            @csrf 
                            <input class="submit-btn" type="submit" value="Set Token">
                        </form>
                    </div>
            </div>
            
        
        <div class="d-flex"> 
            
            <div id="referrals" style="display:none" class="answer_list profile-borders">
                <div class="head-information me-2">
                    <p>Your Code: </p>
                    @if (Auth::user()->referredBy == null)
                        <form method="POST"
                            action="{{ URL::route('setReferral') }}">
                            @csrf
                            <input name="referrerCode" type="text">
                            
                        </form>
                    @else
                        <p>You are already referred to: {{ $referrerName }}</p>
                    @endif
                    <p >Users Referred By You:</p>
                </div>
                <div class="head-information ms-2">
                    <p>{{ $referralCode }}</p>
                        @foreach ($referrals as $referal)
                            <p class="ms-2 me-2">{{ $referal['name'] }}</p>
                        @endforeach
                        <input class="submit-btn" type="submit" value="Set Code">
                </div>
            </div>
            <div id="history" style="display: none" class="answer_list flex-child ">

                <div>

                </div>
                
            </div>
        </div>  
        </div>
    </div>
    
    @endsection
    @section('title', 'Profile')
    @section('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/layouts/profile.css') }}">
    @endsection
    @section('js')
        <script src="{{ asset('js/layouts/profile.js') }}"></script>
    @endsection

