@extends('main')
@section('content')
    @if ($deposit['success']==true)
    <div class="d-flex flex-wrap inventory">
        @foreach ($deposit['inventory'] as $item)
            <div class="item" style="background-image: url({{ $item['icon_url'] }});">
                <p>{{ $item['name'] }}</p>
                <p>{{ $item['amount'] }}</p>
            </div>



            @endforeach
        </div>
    @else
    <p>Too many requests</p>
    @endif
@endsection
@section('title',"Inventory")

