@extends('main')
@section('content')

<div class="flex-container">
    <div class="d-flex flex-column h-50 flex-child magenta ms-3" >
        <div style="border: 2px solid #25c52a">
            <h3 class="max-width: 100% text-center py-3" style="background-color: #0d0e14">Profile</h3>
            <p class="ms-3 my-4">Total Deposited: {{ $totalDeposit }}</p>
            <p class="ms-3 my-4">Total Spent: {{ $totalSpent }}</p>
            <p class="ms-3 my-4">Total Withdrawed: {{ $totalWithdraw }}</p>
            <form class="ms-3 my-4" method="POST" action="{{ URL::route('setTradeUrl') }}">
                @csrf
                <input name="tradeUrl" type="text">
                <input type="submit" value="Set Trade URL">
            </form>
        </div>
    <div style="border: 2px solid #25c52a">
        <div>
            <h3 class="max-width: 100%  mx-auto py-3 text-center" style="background-color: #0d0e14">Referrals</h3>
            <p class="ms-3 my-4">Your Code: {{ $referralCode }}</p>
            @if( Auth::user()->referredBy==null)
                <form class="ms-3 my-4 align-middle" method="POST" action="{{ URL::route('setReferral') }}">
                    @csrf
                    <input name="referrerCode" type="text">
                    <input type="submit" value="Set Code">
                </form>
            @else
                <p>You are already referred to: {{ $referrerName }}</p>
            @endif
        </div>
        <p class="ms-3 py-2">Users Referred By You:</p>
        <div class="inventory-wrapper">
            <div class="d-flex flex-wrap inventory">
                @foreach ($referrals as $referal)
                <p class="ms-2 me-2">{{ $referal['name'] }}</p>
                @endforeach
            </div>
        </div>
    </div>
    </div>
    <div class="d-flex flex-column h-50 flex-child magenta me-3">
    
    <div>
            <h3 class="max-width: 100%  mx-auto py-3 text-center mb-0 history-custom">History</h3>
    </div>
</div>
@endsection
@section('title',"Profile")
