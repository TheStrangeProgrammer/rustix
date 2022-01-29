
var outcomes = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14];
var wheel = $('.roulette-wheel');
var last100Red = $('.last-100-red');
var last100Green = $('.last-100-green');
var last100Black = $('.last-100-black');
var last7 = $('.last-7');
var inputBet = $('.input-bet');


var cardWidth = 70;
var cardMargin = 3 * 2;
var card = cardWidth + cardMargin;


initWheel(outcomes);

$.getJSON( "getRouletteSpin").done(function( data ) {
    let main = $('.main');
    let overlay = $('#overlay');

    var timer=$(".roulette-timer");
    var progress=$(".round-time-bar div");
    var getSpin=false;

    var serverSecond=data['currentSecond'];

    displayLast100(data['rouletteLast100']);
    setWheelLocation(getPosition(data['outcome'],outcomes));

    overlay.css("display","none");
    main.css("display","flex");

    var endTime = new Date(new Date().getTime() + serverSecond*1000);
    var currentSecond = (endTime.getTime() - new Date().getTime()) / 1000;
    setInterval(function() {
        if(currentSecond>20.00){
            timer.parent().css("opacity","0");
        }else if(currentSecond<=0){
            timer.text(0);
            timer.parent().fadeTo("slow","0");
            progress.css("width","0%");
            getSpin=true;
            endTime = new Date(new Date().getTime() + 30*1000);
        }else{
            timer.parent().css("opacity","1");
            timer.text(currentSecond.toFixed(2));
            progress.css("width",currentSecond*5+"%");
        }

        if(getSpin){
            getSpin=false;
            $.getJSON( "getRouletteSpin").done(function( data ) {
                serverSecond=data['currentSecond'];
                if(serverSecond==0) serverSecond=30;
                endTime = new Date(new Date().getTime() + serverSecond*1000);
                currentSecond = (endTime.getTime() - new Date().getTime()) / 1000;
                spinWheel(getPosition(data['outcome'],outcomes),outcomes,function () {displayLast100(data['rouletteLast100']);  });
            });
        }
        currentSecond = (endTime.getTime() - new Date().getTime()) / 1000;
    }, 10);
});

$('#bet-red').click(function() {
    $.ajax({
        type:'POST',
        url:'placeBet',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify({  bet:0 , betAmount:parseInt(inputBet.val()) })
     });
});
$('#bet-green').click(function() {
    $.ajax({
        type:'POST',
        url:'placeBet',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify({  bet:1 , betAmount:parseInt(inputBet.val()) })
     });
});
$('#bet-black').click(function() {
    $.ajax({
        type:'POST',
        url:'placeBet',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify({  bet:2 , betAmount:parseInt(inputBet.val()) })
     });
});
$('#bet-bait').click(function() {
    $.ajax({
        type:'POST',
        url:'placeBet',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify({  bet:3 , betAmount:parseInt(inputBet.val()) })
     });
});


function displayLast100(last100){
    var last7html="";
    var lastTotalRed=0;
    var lastTotalGreen=0;
    var lastTotalBlack=0;
    for (let i = 0; i < 100; i++) {
        let color = valueToColor(last100[i]);
        if(color=="roulette-black"){
            lastTotalBlack++;
        }
        if(color=="roulette-red"){
            lastTotalRed++;
        }
        if(color=="roulette-house"){
            lastTotalGreen++;
        }
        if(i<7){
            last7html += createRoundImage(color,valueToImage(last100[i]));
        }
    }
    last100Red.html(lastTotalRed.toString());
    last100Green.html(lastTotalGreen.toString());
    last100Black.html(lastTotalBlack.toString());
    last7.html(last7html);
}

function createRoundImage(color,image){
    return "<img class='image-circle rounded-circle "+color+"'src='../assets/"+image+".svg' width='30' height='30'>";
}
function createCard(color,image){
    return "<img class='roulette-card "+color+"'src='../assets/"+image+".svg' width='60' height='60'>";
}

function getPosition(outcome,values){
    return values.indexOf(outcome)-values.length/2+0.5;
}

function valueToColor(value){
    if(value<7){
        if(value%2==0) {
            color="roulette-black";
        }
        else {
            color="roulette-red";
        }
    }
    if(value==7){
        color="roulette-house";
    }
    if(value>7){
        if(value%2==1){
            color="roulette-black";
        }
        else{
            color="roulette-red";
        }
    }

    return color;
}
function valueToImage(value){
    if(value<6){
        if(value%2==0) {
            image="Shield";
        }
        else {
            image="blade";
        }
    }
    if(value==6){
        image="Hook";
    }
    if(value==7){
        image="R";
    }
    if(value==8){
        image="Hook";
    }
    if(value>8) {
        if(value%2==1){
            image="Shield";
        }
        else{
            image="blade";
        }
    }

    return image;
}

function initWheel(values){
  	var	row = "<div class='d-flex roulette-row'>";
    values.forEach(value => {
        row += createCard(valueToColor(value),valueToImage(value));
    });
	row += "<\/div>";

	for(let x = 0; x < 13; x++){
  	wheel.append(row);
  }
}

function spinWheel(position,values,callback = function(){}){


  let cardCount = values.length;


  let landingPosition = (cardCount * card)*5 + (position * card);

  var randomize = Math.floor(Math.random() * cardWidth)- cardWidth/2;

  landingPosition = landingPosition + randomize ;

  let object = {
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
    callback();
  }, 6 * 1000);
}

function setWheelLocation(position,randomize=-cardWidth/2){
    wheel.css({
        'transition-timing-function':'',
        'transition-duration':'',
    });
    let resetTo = -(position * card + randomize);
    wheel.css('transform', 'translate3d('+resetTo+'px, 0px, 0px)');
}

$("#button-amount-1").click(function(){
    $(".input-bet").val(parseInt($(".input-bet").val())+1);
});
