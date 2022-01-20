@extends('main')
@section('content')
<div class="h-100" >
    <div class='roulette-wrapper flex-grow-0 p-2'>
        <div class='roulette-selector'></div>
        <div class='roulette-wheel'></div>
    </div>
    <p class="timer-custom">ROLLING IN: <span class="roulette-timer">0</span></p>
    <div class="round-time-bar"  style="--duration: 15;" data-style="smooth">
      <div></div>
    </div>
    <div class="d-flex justify-content-end bet-amount py-2 rounded-3">
      <button type="button" class="btn-bet" style="background-color: #0d0e14 !important">CLEAR</button>
      <button type="button" class="btn-bet">LAST</button>
      <button type="button" class="btn-bet">+1</button>
      <button type="button" class="btn-bet">+10</button>
      <button type="button" class="btn-bet">+100</button>
      <button type="button" class="btn-bet">+1000</button>
      <button type="button" class="btn-bet">1/2</button>
      <button type="button" class="btn-bet">X2</button>
      <button type="button" class="btn-bet">MAX</button>
    </div>

    <div class="bet-roulette p-3 mt-4">
      <ul role="toolbar" class="ms-2">

            <li class="bet mx-2 ">
              <div class="text-bet">
                <div class="d-inline me-0">
                  <img class="image-circle rounded-circle" style="background-color:#F95146" src='../assets/blade.svg' width="30" height="30">
                </div>
                <div class="d-inline ms-0">
                  <img class="image-circle rounded-circle" style="background-color:#F95146 " src='../assets/hook.svg' width="30" height="30">
                </div>
                <p class="d-inline">Win 2x</p>
              </div>
              <button class="col-md-12 button-bet zoom-in-out-box"  style="background-color: #F95146"  aria-setsize="4" aria-posinset="1">Place Bet</button>
            </li>

            <li class="bet mx-2">
              <div class="text-bet">
                <div class="d-inline me-0">
                  <img class="image-circle rounded-circle" style="background-color: #00C74D" src='../assets/R.svg' width="30" height="30">
                </div>
                <p class="d-inline">Win 4x</p>
              </div>
              <button class="col-md-12 button-bet zoom-in-out-box" style="background-color: #00C74D" aria-setsize="4" aria-posinset="2">Place Bet</button>
            </li>

            <li  class="bet mx-2">
              <div class="text-bet">
                <div class="d-inline me-0">
                  <img class="image-circle rounded-circle" style="background-color:#2D3035" src='../assets/shield.svg' width="30" height="30">
                </div>
                <div class="d-inline ms-0">
                  <img class="image-circle rounded-circle" style="background-color:#2D3035 " src='../assets/hook.svg' width="30" height="30">
                </div>
                <p class="d-inline">Win 2x</p>
              </div>
              <button class="col-md-12 button-bet zoom-in-out-box" style="background-color: #2D3035" aria-setsize="4" aria-posinset="3">Place Bet</button>
            </li > 

            <li  class="bet mx-2">
              <div class="text-bet">
                <div class="d-inline me-0">
                  <img class="image-circle rounded-circle" style="background-color:#F95146" src='../assets/hook.svg' width="30" height="30">
                </div>
                <div class="d-inline ms-0">
                  <img class="image-circle rounded-circle" style="background-color:#2D3035 " src='../assets/hook.svg' width="30" height="30">
                </div>
                <p class="d-inline">Win 2x</p>
              </div>
              <button class="col-md-12 button-bet zoom-in-out-box" style="background-color: #7c99b4" aria-setsize="4" aria-posinset="4">Place Bet</button>
            </li>
        
    </ul>

    </div>

   
</div>


@endsection
@section('title',"XRoulette")
@section('js')
<script>

$(document).ready(function() {
    var outcomes = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14];
    var outcome;
    initWheel(outcomes);
    $.getJSON( "getRouletteSpin", function( data ) {
        outcome=data;
        
    });



 	$('button').on('click', function(){
		var outcome = parseFloat($('input').val());
    spinWheel(outcome,outcomes);

  });
  var start = new Date(new Date().getTime()+(15*1000));

  setInterval(function() {
        $('.roulette-timer').text(Math.round((start - new Date) / 1000, 0));
    }, 1000);

});
function addOutcome(outcome){
    return "<div class='card red'>1<\/div>";
}
function initWheel(values){
    var $wheel = $('.roulette-wrapper .roulette-wheel');
  	var	row = "<div class='roulette-row'>";
    values.forEach(value => {
        var color;
        var image;
        if(value<6){
          if(value%2==0) {
            color="roulette-black";
            image="Shield";
          }
          else { 
            color="roulette-red";
            image="blade";
          }
        } else {
          if(value%2==1){
            color="roulette-black";
            image="Shield";
          } 
          else{
            color="roulette-red";
            image="blade";
          } 
        }
        if(value==6){
          color="roulette-house";
          image="R";
        } 
        if(value==5){
          color="roulette-bait-left";
          image="Hook";
        } 
        if(value==7){
          color="roulette-bait-right";
          image="Hook";
        } 

        row += "<div class='roulette-card "+color+"'><img src='../assets/"+image+".svg' width='60' height='60'><\/div>";
    });
	row += "<\/div>";

	for(var x = 0; x < 29; x++){
  	$wheel.append(row);
  }
}

function spinWheel(outcome,values){
  var wheel = $('.roulette-wrapper .roulette-wheel');
  var position = values.indexOf(outcome)-values.length/2;
    console.log(position);
  var cardCount = values.length;
  var cardWidth = 70;
  var cardMargin = 3 * 2;
  var card = cardWidth + cardMargin;
  var landingPosition = (cardCount * card)*5 + (position * card);

  var randomize = Math.floor(Math.random() * cardWidth)- cardWidth/2;

  landingPosition = landingPosition + randomize ;

  var object = {
		x: Math.floor(Math.random() * 50) / 100,
        y: Math.floor(Math.random() * 20) / 100
	};

  wheel.css({
		'transition-timing-function':'cubic-bezier(0,'+ object.x +','+ object.y + ',1)',
		'transition-duration':'6s',
		'transform':'translate3d(-'+landingPosition+'px, 0px, 0px)'
	});

  setTimeout(function(){
		wheel.css({
			'transition-timing-function':'',
			'transition-duration':'',
		});

    var resetTo = -(position * card + randomize);
	wheel.css('transform', 'translate3d('+resetTo+'px, 0px, 0px)');
  }, 6 * 1000);
}










</script>
@endsection
