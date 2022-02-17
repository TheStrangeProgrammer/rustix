@extends('main')
@section('content')
    @if ($inventory->success == true)
    <div class="flex-fill principal-div">
        <div class="head-inventory">
            <span>Your Withdraw.</span>
        </div>
            <div class="flex-fill inventory-wrapper">
                <div class="d-flex flex-wrap">

                    @foreach ($inventory->inventory as $item)
                        <div class="item">
                            <p class="d-none item-id">{{ $item->id }}</p>
                            <p class="d-none item-quantity">{{ $item->amount }}</p>

                            <p class="text-center fw-bold mt-1">{{ $item->name }}</p>
                            <img src="{{ $item->icon_url }}">



                            <div class="item-info">
                                <p class="me-auto px-2">Q: {{ $item->amount }}</p>
                                <p class="px-2">$: <span class="item-price">{{ $item->price }}</span></p>
                            </div>

                            <div class="d-flex">
                                <div class="d-none input-group input-group-sm item-quantity-input">
                                    <span class="input-group-text">Q</span>
                                    <input class="form-control" type="number" min="0" max="0" value="0">
                                </div>
                            </div>


                        </div>
                    @endforeach
                </div>
            </div>
            <div class="container-fluid inventory-sell ">
                <form method="POST" action="{{ URL::route('withdrawItems') }}">
                    @csrf
                    <div class="my-auto me-auto ms-5 right-span">
                        <span class="my-auto">You have selected<span class="span-13" >&nbsp;13</span></span>
                        <span class="align-items-center my-auto">&nbsp;items worth<span id="total">&nbsp;0</span></span>
                    </div>
                    <input id="item-list" class="d-none" type="text" name="itemList">
                    <input class="py-auto me-5 right-span" id="submit-item-list"
                        type="submit" value="trade for $143.66 coins">
                </form>
                </li>
            </div>
        </div>
    @else
        <p>You do not have the game or your inventory is private</p>
    @endif

@endsection
@section('title', 'Withdraw')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/partials/withdraw.css') }}">
@endpush
@push('js')
    <script src="{{ asset('js/partials/withdraw.js') }}"></script>
@endpush
