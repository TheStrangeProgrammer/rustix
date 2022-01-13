@extends('main')
@section('content')
    @if ($inventory['success']==true)
    <div class="d-flex flex-column h-100">
        <div class="inventory-wrapper">
            <div class="d-flex flex-wrap inventory">
                @foreach ($inventory['inventory'] as $item)
                    <div class="item" >
                        <div class="itemImage" style="background-image: url({{ $item['icon_url'] }});">
                            <p class="d-none id">{{ $item['id'] }}</p>
                            <p>{{ $item['name'] }}</p>
                            <p class="amount">{{ $item['amount'] }}</p>
                            <p>{{ $item['price'] }}$</p>
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



