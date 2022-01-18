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
    var outcomes;
    $.getJSON( "getRouletteSpin", function( data ) {
        console.log(data);
        outcomes=data;
        initWheel(data);
    });



 	$('button').on('click', function(){
		var outcome = parseFloat($('input').val());
    spinWheel(outcome,outcomes);

  });
  var start = new Date(new Date().getTime()+(15*1000));

  setInterval(function() {
        $('.roulette-timer').text(Math.round((start - new Date) / 1000, 0));
    }, 1000);
setInterval(
    document.elementFromPoint(x, y);
)
});
function addOutcome(outcome){
    return "<div class='card red'>1<\/div>";
}
function initWheel(values,outcome){
    var $wheel = $('.roulette-wrapper .roulette-wheel');
  		row = "<div class='roulette-row'>";
    values.forEach(value => {
        var color;
        if(value<2) color="black";
        else if(value<10) color="green";
        else color="red";
        row += "<div class='card "+color+"'>x"+value+"<\/div>";
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
  var cardWidth = 75;
  var cardMargin = 3 * 2;
  var card = cardWidth + cardMargin;
  var landingPosition = (cardCount * card)*5 + (position * card);

  var randomize = Math.floor(Math.random() * cardWidth);

  landingPosition = landingPosition + randomize;

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
