@extends('main')
@section('content')

<div class="d-flex m-5 cola">asdf</div>

@endsection
@section('title', 'admin')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layouts/admin.css') }}">
@endpush
@push('js')
    <script src="{{ asset('js/layouts/profile.js') }}"></script>
@endpush
