@extends('main')
@section('content')
    @if ($inventory->success == true)
        <div class="d-flex flex-column flex-fill h-100">
            <div class="flex-fill inventory-wrapper">
                <div class="d-flex flex-wrap inventory">

                    @foreach ($inventory->inventory as $item)
                        <div class="d-flex flex-column align-items-center border border-dark m-2 item">
                            <p class="d-none item-id">{{ $item->id }}</p>
                            <p class="d-none item-quantity">{{ $item->amount }}</p>

                            <p class="text-center fw-bold mt-1">{{ $item->name }}</p>
                            <img src="{{ $item->icon_url }}" width="100px">



                            <div class="d-flex flex-column item-info">
                                <p class="ms-2">Amount: {{ $item->amount }}</p>
                                <p class="ms-2 me-2 ">Price: {{ $item->price }}</p>
                            </div>

                            <div class="d-flex">
                                <div class="d-none input-group input-group-sm item-quantity-input">
                                    <span class="input-group-text">Quantity</span>
                                    <input class="form-control" type="number" min="0" max="0" value="0">
                                </div>
                            </div>


                        </div>
                    @endforeach
                </div>
            </div>
            <div class="d-flex container-fluid fw-bold inventory-sell p-2" style="background-color: #141620">
                <form class="d-inline mx-auto" method="POST" action="{{ URL::route('depositItems') }}">
                    @csrf
                    <p class="text-white d-inline me-5">Total: </p>
                    <input id="item-list" class="d-none" type="text" name="itemList">
                    <input class="text-white px-4 py-2" style="background-color:#14DB1A " id="submit-item-list"
                        type="submit" value="SELL">
                </form>
                </li>
            </div>
        </div>
    @else
        <p>You do not have the game or your inventory is private</p>
    @endif

@endsection
@section('title', 'Withdraw')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layouts/withdraw.css') }}">
@endsection
@section('js')
    <script src="{{ asset('js/layouts/withdraw.js') }}"></script>
@endsection