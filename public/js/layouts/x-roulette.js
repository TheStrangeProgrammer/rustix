

var wheel = $('.roulette-wheel');

var inputBet = $('.input-bet');


var cardWidth = 136;
var cardMargin = 3 * 2;
var card = cardWidth + cardMargin;




$.getJSON("api/x-roulette/spin").done(function( data ) {
    let main = $('.main');
    let overlay = $('#overlay');

    var timer=$(".roulette-timer");
    var progress=$(".round-time-bar div");
    var getSpin=false;

    var serverSecond=data['currentSecond'];

    var outcomes = data['outcomes'];
    initWheel(outcomes);
    displayLast10(data['rouletteLast10']);
    setWheelLocation(getPosition(data['outcome'],outcomes),Math.floor(Math.random() * cardWidth)- cardWidth/2);

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
            $.getJSON( "api/x-roulette/spin").done(function( data ) {
                serverSecond=data['currentSecond'];
                outcomes = data['outcomes'];
                initWheel(outcomes);
                if(serverSecond==0) serverSecond=30;
                endTime = new Date(new Date().getTime() + serverSecond*1000);
                currentSecond = (endTime.getTime() - new Date().getTime()) / 1000;
                spinWheel(getPosition(data['outcome'],outcomes),outcomes,function () {displayLast10(data['rouletteLast10']);  });
            });
        }
        currentSecond = (endTime.getTime() - new Date().getTime()) / 1000;
    }, 10);

    setInterval(function() {
        $.getJSON( "api/x-roulette/bets").done(function( data ) {
            betValues = Object.values(data['bets']).sort(function(a, b){return b.amount - a.amount});
            $(".bet-total-number").html(Object.keys(data['bets']).length);
            $(".bet-total-amount").html(betValues.reduce((p,c)=>p+c.amount,0));
            var betList="";
            for(const key in betValues){
                betList+=addBet(betValues[key].name,betValues[key].avatar,betValues[key].amount,betValues[key].bet)
            }
            $(".bet-list-bets").html(betList);
        });
    }, 1000);
});

$('#bet-button').click(function() {
    $.ajax({
        type:'POST',
        url:'x-roulette/bet',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify({  bet:parseFloat($('.input-mult').val()) , betAmount:parseInt($('.input-bet').val()) })
     });
});



function addBet(name,avatar,amount,mult){
    return `<div class="d-flex flex-fill mt-2 ps-2 bg-list">
                <div class="me-auto p-2">
                    <img class="image-circle rounded-circle" style="background-color:#F95146"  src='`+avatar+`'
                        width="30" height="30">
                    <span class="fw-bold">`+name+`</span>
                </div>
                <div class="d-flex flex-row justify-content-end align-items-center me-2">
                    <i class="bi bi-x"></i>
                    <span class="score-bet fw-bold">`+mult+`</span>
                </div>
                <div class="d-flex flex-row justify-content-end align-items-center me-2">
                    <img class="me-1" src="assets/dollar_coin.svg" width="16" height="16">
                    <span class="score-bet fw-bold">`+amount+`</span>
                </div>
            </div>`
}


function displayLast10(last10){
    var last10html="";
    for (let i = 0; i < 10; i++) {
        last10html += createLastImage(valueToColor(last10[i]),last10[i]);
    }
    $('.last-10').html(last10html);
}

function createLastImage(color,value){
    return "<div class='x-roulette-card-last "+color+"'>x"+value+"</div>";
}
function createCard(color,image,value){
    return "<div class='roulette-card "+color+"'><img  src='../assets/"+image+".svg' width='110' height='110' ><span >x"+value+"</span></div>";
}

function getPosition(outcome,values){
    return outcome-values.length/2+0.5;
}

function valueToColor(value){
    color="";
    if(value<=1)
        color="x-roulette-red";
    else if(value<2)
        color="x-roulette-light-green";
    else if(value<5)
        color="x-roulette-green";
    else if(value<10)
        color="x-roulette-light-blue";
    else if(value<50)
        color="x-roulette-blue";
    else if(value<100)
        color="x-roulette-light-purple";
    else if(value<1000)
        color="x-roulette-purple";
    else if(value<100000)
        color="x-roulette-gold";
    else
        color="x-roulette-rainbow";
    return color;
}
function valueToImage(value){
    image="";
    if(value<=1)
        image="1";
    else if(value<1.25)
        image="2";
    else if(value<1.50)
        image="3";
    else if(value<2)
        image="4";
    else if(value<3)
        image="5";
    else if(value<4)
        image="6";
    else if(value<5)
        image="7";
    else if(value<10)
        image="8";
    else if(value<50)
        image="9";
    else if(value<100)
        image="10";
    else if(value<500)
        image="11";
    else if(value<1000)
        image="12";
    else if(value<5000)
        image="13";
    else if(value<10000)
        image="14";
    else if(value<100000)
        image="15";
    else
        image="16";
    return image;
}


function initWheel(values){

  	var	row = "<div class='d-flex roulette-row'>";
    values.forEach(value => {
        row += createCard(valueToColor(value),valueToImage(value),value);
    });
	row += "<\/div>";
    wheel.empty();
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

$("#button-amount-clear").click(function(){
    $(".input-bet").val(parseInt($(".input-bet").val())*0);
});

$("#button-amount-max").click(function(){
    $(".input-bet").val(parseInt($("#balance").html()));
});
