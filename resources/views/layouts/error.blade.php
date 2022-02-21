@extends('main')
@section('content')

    <div class="error">
        <div>
            <img src="assets/warning.png" height="120px" width="120px" alt="">
        </div>
        <div>
            <p>ERROR!</p>
            <p>{{ $error }}</p>
            <button onclick="history.back()">Close</button>
        </div>
    </div>

@endsection
@section('title', 'Error')
