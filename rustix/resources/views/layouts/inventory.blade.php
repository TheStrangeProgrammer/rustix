@extends('main')
@section('content')
    @if ($inventory['success']==true)
    <div class="d-flex flex-column h-100">
        <div class="inventory-wrapper">
            <div class="d-flex flex-wrap inventory">
                @foreach ($inventory['inventory'] as $item)
                <div>
                <div class="item m-2 border border-dark ">               
                    <p class="text-center fw-bold mt-1">{{ $item['name'] }}</p>               
                        <div class="itemImage ms-5" style="background-image: url({{ $item['icon_url'] }});">                                 
                            <input class="d-none amountInput" type="text">
                        </div>
                    <p class="d-none id">{{ $item['id'] }}</p> 
                    <p class="amount ms-2 display">Amount: {{ $item['amount'] }}</p>
                    <p class="ms-2 me-2 display">Price: {{ $item['price'] }}</p> <br>
                 </div>
                 
                    <p class="display ms-3">Quantity</p>
                    <input type="number" class="number ">

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



