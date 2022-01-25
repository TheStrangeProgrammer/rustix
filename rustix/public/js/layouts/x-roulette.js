
var outcomes = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14];
var currentSecond;
var serverSecond;
var isPaused=false;
var selector=$(".roulette-selector");
var timer=$(".roulette-timer");
var progress=$(".round-time-bar div");
var wheel = $('.roulette-wrapper .roulette-wheel');
var overlay = $('#overlay');
var cardWidth = 70;
var cardMargin = 3 * 2;
var card = cardWidth + cardMargin;
var main = $('.main');

initWheel(outcomes);
$.getJSON( "getRouletteSpin").done(function( data ) {
    var position = outcomes.indexOf(data['outcome'])-outcomes.length/2;
    serverSecond=data['currentSecond'];
    console.log(serverSecond);
    setWheelLocation(position);

    overlay.css("display","none");
    main.css("display","flex");

    var endTime = new Date(new Date().getTime() + serverSecond*1000);
    currentSecond = (endTime.getTime() - new Date().getTime()) / 1000;
    setInterval(function() {
        if(currentSecond>20.00){
            isPaused=true;
            setTimeout(function(){
                isPaused=false;
            }, currentSecond*100);
        }
        if(currentSecond<=0.00&&!isPaused){
            isPaused=true;
            $.getJSON( "getRouletteSpin").done(function( data ) {
                serverSecond=data['currentSecond'];
                if(serverSecond==0) serverSecond=30;
                endTime = new Date(new Date().getTime() + serverSecond*1000);
                currentSecond = (endTime.getTime() - new Date().getTime()) / 1000;
                console.log(currentSecond);
                spinWheel(data['outcome'],outcomes);
            });
            setTimeout(function(){
                isPaused=false;
            }, 10000);
        }

        if(!isPaused){
            timer.text(currentSecond.toFixed(2));
            progress.css("width",currentSecond*5+"%");
            // $('.round-time-bar .progress-bar').attr("aria-valuenow",(currentSecond*5).toFixed(2));

            var position = selector.offset();
            // console.log(position);
            var elem = document.elementsFromPoint(position.left, position.top);
            $(elem).find("card").css("background-color", "red");

        }
        currentSecond = (endTime.getTime() - new Date().getTime()) / 1000;
    }, 10);
});



function addOutcome(outcome){
    return "<div class='card red'>1<\/div>";
}
function initWheel(values){
    var $wheel = $('.roulette-wrapper .roulette-wheel');
  	var	row = "<div class='d-flex roulette-row'>";
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

  var position = values.indexOf(outcome)-values.length/2;
  var cardCount = values.length;


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
    setWheelLocation(position,randomize);
  }, 6 * 1000);
}

function setWheelLocation(position,randomize=-cardWidth/2){
    wheel.css({
        'transition-timing-function':'',
        'transition-duration':'',
    });
    var resetTo = -(position * card + randomize);
    wheel.css('transform', 'translate3d('+resetTo+'px, 0px, 0px)');
}
