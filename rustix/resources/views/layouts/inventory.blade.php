@extends('main')
@section('content')
    <div class="d-flex flex-wrap inventory">
        @foreach ($data['rgDescriptions'] as $item)

        <div class="item" style="background-image: url(https://steamcommunity-a.akamaihd.net/economy/image/{{ $item['icon_url'] }});">
            <p>{{ $item['name'] }}</p>
        </div>

        @endforeach
    </div>
@endsection
@section('title',"Inventory")
