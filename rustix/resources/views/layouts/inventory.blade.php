@extends('main')
@section('content')
    @if ($inventory['success']==true)
    <div class="d-flex flex-column h-100">
        <div class="inventory-wrapper">
            <div class="d-flex flex-wrap inventory">

                @foreach ($inventory['inventory'] as $item)
                <div class="d-flex flex-column align-items-center m-2 border border-dark item">
                    <p class="d-none id">{{ $item['id'] }}</p>

                    <p class="text-center fw-bold mt-1">{{ $item['name'] }}</p>
                    <img src="{{ $item['icon_url'] }}" width="100px">


                    <div class="d-flex" >
                        <p class="ms-2 item-quantity">Amount: {{ $item['amount'] }}</p>
                        <p class="ms-2 me-2 ">Price: {{ $item['price'] }}</p>
                    </div>

                    <div class="d-flex">
                        <div class="d-none input-group input-group-sm item-quantity-input">
                            <span class="input-group-text">Quantity</span>
                            <input class="form-control" type="number" min="0">
                        </div>
                        <button class="d-none ms-1 item-cancel">
                            <i class="bi bi-x-circle"></i>
                        </button>
                        <button class="ms-1 item-select">
                            <i class="bi bi-plus-circle"></i>
                        </button>
                    </div>


                 </div>
                @endforeach
            </div>
        </div>
        <div>
            <form method="POST" action="{{ URL::route('depositItems') }}">
                @csrf
                <input id="items" class="d-none" type="text">
                <input type="submit" value="Sell">
            </form>

        </div>
    </div>
    @else
    <p>You do not have the game or your inventory is private</p>
    @endif

@endsection
@section('title',"Inventory")
@section('js')
<script>
    $(document).ready(function() {
        $(".item-quantity-input").find("form-control").attr("max",$(".item-quantity").text());

        $(".item-select").click(function (e) {
            e.preventDefault();
            $(this).addClass("d-none");
            $(this).parent().find(".item-cancel").removeClass("d-none");
            $(this).parent().find(".item-quantity-input").removeClass("d-none");
        });
        $(".item-cancel").click(function (e) {
            e.preventDefault();
            $(this).addClass("d-none");
            $(this).parent().find(".item-select").removeClass("d-none");

            $(this).parent().find(".item-quantity-input").addClass("d-none");
        });
        $(".item-quantity-input").change(function (e) {
            e.preventDefault();

        });

    });
</script>
@endsection
