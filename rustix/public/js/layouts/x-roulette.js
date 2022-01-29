
var outcomes = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14];
var currentSecond;
var serverSecond;
var isPaused=false;
var selector=$(".roulette-selector");
var timer=$(".roulette-timer");
var progress=$(".round-time-bar div");
var wheel = $('.roulette-wrapper .roulette-wheel');
var overlay = $('#overlay');
var cardWidth = 136;
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
            color="x-roulette-image-1";
            image="1";
          }
          else {
            color="x-roulette-image-2";
            image="2";
          }
        } else {
          if(value%2==1){
            color="x-roulette-image-3";
            image="3";
          }
          else{
            color="x-roulette-image-4";
            image="4";
          }
        }
        if(value==6){
          color="x-roulette-image-5";
          image="5";
        }
        if(value==5){
          color="x-roulette-image-6";
          image="6";
        }
        if(value==7){
          color="x-roulette-image-7";
          image="7";
        }
        if(value==8){
            color="x-roulette-image-8";
            image="8";
          }
          if(value==9){
            color="x-roulette-image-9";
            image="9";
          }
          if(value==10){
            color="x-roulette-image-10";
            image="10";
          }
          if(value==11){
            color="x-roulette-image-11";
            image="11";
          }
          if(value==12){
            color="x-roulette-image-12";
            image="12";
          }
          if(value==13){
            color="x-roulette-image-13";
            image="13";
          }
          if(value==14){
            color="x-roulette-image-14";
            image="14";
          }
          if(value==15){
            color="x-roulette-image-15";
            image="15";
          }
          if(value==16){
            color="x-roulette-image-16";
            image="16";
          }

        row += "<div class='roulette-card "+color+"'><img class='img-custom' src='../assets/"+image+".svg'><\/div>";
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