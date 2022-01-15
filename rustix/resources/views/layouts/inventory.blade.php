@extends('main')
@section('content')
    @if ($inventory['success']==true)
    <div class="d-flex flex-column h-100">
        <div class="inventory-wrapper">
            <div class="d-flex flex-wrap inventory">

                @foreach ($inventory['inventory'] as $item)
                <div class="d-flex flex-column align-items-center m-2 border border-dark item">
                    <p class="d-none id">{{ $item['id'] }}</p>
                    <input class="d-none amountInput" type="text">

                    <p class="text-center fw-bold mt-1">{{ $item['name'] }}</p>
                    <img src="{{ $item['icon_url'] }}" width="100px">


                    <div class="d-flex" >
                        <p class="ms-2 amount">Amount: {{ $item['amount'] }}</p>
                        <p class="ms-2 me-2 ">Price: {{ $item['price'] }}</p>
                    </div>

                    <div class="d-flex">
                        <p class="ms-3">Quantity</p>
                        <input type="number" class="number " max="">
                        <button class="cancel"></button>
                        <button class="select"></button>
                    </div>


                 </div>
                @endforeach
            </div>
        </div>
        <div>
            <form method="POST" action="{{ URL::route('depositItems') }}">
                @csrf
                <input id="items" class="d-none" type="text">
                <button>Sell</button>
            </form>

        </div>
    </div>
    @else
    <p>You do not have the game or your inventory is private</p>
    @endif

@endsection
@section('title',"Inventory")



