@extends('main')
@section('content')

    <div class='roulette-wrapper'>
        <div class='roulette-selector'></div>
        <div class='roulette-wheel'></div>
    </div>
    <p>Timer:<span class="roulette-timer">0</span></p>
    <input placeholder='roulette-outcome'>
    <button>
      Spin Wheel
    </button>



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
