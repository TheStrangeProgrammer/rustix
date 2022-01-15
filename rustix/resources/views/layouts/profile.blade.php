@extends('main')
@section('content')

    <div class="d-flex flex-column h-70">
        <div>
            <h3>Profile</h3>
            <p>Total Deposited: {{ $totalDeposit }}</p>
            <p>Total Spent: {{ $totalSpent }}</p>
            <p>Total Withdrawed: {{ $totalWithdraw }}</p>

        </div>
        <div>
            <h3>Referrals</h3>
            <p>Your Code: {{ $referralCode }}</p>
            @if( Auth::user()->referredBy==null)
                <form method="POST" action="{{ URL::route('setReferral') }}">
                    @csrf
                    <input name="referrerCode" type="text">
                    <input type="submit">
                </form>
            @else
                <p>You are already referred to: {{ $referrerName }}</p>
            @endif
        </div>
        <p>Users Referred By You:</p>
        <div class="inventory-wrapper">
            <div class="d-flex flex-wrap inventory">
                @foreach ($referrals as $referal)
                <p class="ms-2 me-2">{{ $referal['name'] }}</p>
                @endforeach
            </div>
        </div>

    </div>

@endsection
@section('title',"Profile")
