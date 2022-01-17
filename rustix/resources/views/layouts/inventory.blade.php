@extends('main')
@section('content')
    @if ($inventory['success']==true)
    <div class="d-flex flex-column h-100">
        <div class="inventory-wrapper">
            <div class="d-flex flex-wrap inventory">

                @foreach ($inventory['inventory'] as $item)
                <div class="d-flex flex-column align-items-center m-2 border border-dark item">
                    <p class="d-none item-id">{{ $item['id'] }}</p>
                    <p class="d-none item-quantity">{{ $item['amount'] }}</p>

                    <p class="text-center fw-bold mt-1">{{ $item['name'] }}</p>
                    <img src="{{ $item['icon_url'] }}" width="100px">


                    <div class="d-flex" >
                        <p class="ms-2">Amount: {{ $item['amount'] }}</p>
                        <p class="ms-2 me-2 ">Price: {{ $item['price'] }}</p>
                    </div>

                    <div class="d-flex">
                        <div class="d-none input-group input-group-sm item-quantity-input">
                            <span class="input-group-text">Quantity</span>
                            <input class="form-control" type="number" min="0" max="0" value="0">
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
        <span class="d-flex justify-content-end fw-bold px-3"> 
        <div class="btn-group dropup">
            <button type="button" class="btn btn-secondary dropdown-toggle" style="background-color: #0d0e14" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-cart-check"></i>
            </button>
                <ul class="dropdown-menu second-one text-center " style="background-color: #0d0e14" >
                   <li><p class="py-2 text-white">Total: </p></li>
                   <li class="py-3 rounded-2" style="background-color: #14DB1A"><form method="POST" action="{{ URL::route('depositItems') }}">
                       @csrf
                         <input id="item-list" class="d-none" type="text" name="itemList">
                         <input class="text-white"  id="submit-item-list" type="submit" value="SELL"> 
                  </form></li> 
                </ul>
              </div>
        
            
            
        </span>
        

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
        var items=[];

        $(".item-select").click(function (e) {
            e.preventDefault();
            var inputDiv = $(this).parent();
            var itemDiv = inputDiv.parent();
            $(this).addClass("d-none");
            inputDiv.find(".item-cancel").removeClass("d-none");
            inputDiv.find(".item-quantity-input").removeClass("d-none");
            inputDiv.find(".form-control").attr("max",itemDiv.find(".item-quantity").text());

            var id = itemDiv.find(".item-id").text();
            var item = new Object();
            item.id=id;
            item.quantity=0;
            items.push(item)
        });
        $(".item-cancel").click(function (e) {
            e.preventDefault();
            $(this).addClass("d-none");
            $(this).parent().find(".item-select").removeClass("d-none");
            $(this).parent().find(".item-quantity-input").addClass("d-none");
            var itemDiv = $(this).parent().parent();
            var id = itemDiv.find(".item-id").text();
            var itemIndex = items.findIndex(element => element.id == id);
            items.splice(itemIndex,itemIndex);
        });
        $(".item-quantity-input").change(function (e) {
            e.preventDefault();
            var itemDiv = $(this).parent().parent();
            var id = itemDiv.find(".item-id").text();
            var itemIndex = items.findIndex(element => element.id == id);
            items[itemIndex].quantity=$(this).find(".form-control").val();
        });
        $("#submit-item-list").click(function (e) {
            $("#item-list").val(JSON.stringify(items));
        });
    });
</script>
@endsection
