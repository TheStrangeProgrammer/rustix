@extends('main')
@section('content')

<div class="d-flex m-5 cola">Go into steam, accept the trade then press continue</div>
<form class="d-inline mx-auto" method="POST" action="{{ URL::route('depositContinue') }}">
    @csrf
    <input class="text-white px-4 py-2" style="background-color:#14DB1A " id="submit-item-list" type="submit" value="Continue">
</form>

@endsection
@section('title', 'Accept')
