@extends('main')
@section('content')
<section id="content">
    <div id="test" class="flexcol center">
        <div id="wheel" class="flexcol center">
            <i class="fas fa-caret-down" style="font-size:3rem;position:relative;top:23px;color:'#f9f9f9';"></i>
            <canvas id="canvas" width="300" height="300"></canvas>
        </div>
        <button onClick="startSpin();" id="spin_button" class="spin pad10 bggreen mt15">spin me</button>
    </div>
</section>
    @endsection
