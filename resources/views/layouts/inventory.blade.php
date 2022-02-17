@extends('main')
@section('content')
    @if ($inventory['success'] == true)
        <div class="d-flex flex-column flex-fill h-100">
            <div class="head-inventory">
                <span>Your inventory.</span>
            </div>
            <div class="flex-fill inventory-wrapper">
                <div class="d-flex flex-wrap inventory">

                    @foreach ($inventory['inventory'] as $item)
                        <div class="d-flex flex-column align-items-center m-2 item ">
                            <p class="d-none item-id">{{ $item['id'] }}</p>
                            <p class="d-none item-quantity">{{ $item['amount'] }}</p>

                            <p class="text-center fw-bold">{{ $item['name'] }}</p>
                            <img src="{{ $item['icon_url'] }}" >



                            <div class="d-flex flex-row w-100 item-info">
                                <p class="me-auto px-3">Q: {{ $item['amount'] }}</p>
                                <p class="px-3">$: <span class="item-price">{{ $item['price'] }}</span></p>
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
            <div class="d-flex container-fluid  fw-bold inventory-sell p-2" style="background-color: #141620">
                <form class="d-inline mx-auto" method="POST" action="{{ URL::route('depositItems') }}">
                    @csrf
                    <p class="text-white d-inline me-5">Total: <span id="total">0</span></p>
                    <input id="item-list" class="d-none" type="text" name="itemList">
                    <input class="text-white px-4 py-2" style="background-color:#14DB1A " id="submit-item-list"
                        type="submit" value="SELL">
                </form>
                </li>
            </div>
        </div>
    @else
        <p>You do not have any items or your inventory is private</p>
    @endif

@endsection
@section('title', 'Inventory')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/partials/inventory.css') }}">
@endpush
@push('js')
    <script src="{{ asset('js/partials/inventory.js') }}"></script>
@endpush
