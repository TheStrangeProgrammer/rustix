
var outcomes = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14];
var wheel = $('.roulette-wheel');
var inputBet = $('.input-bet');


var cardWidth = 70;
var cardMargin = 3 * 2;
var card = cardWidth + cardMargin;


initWheel(outcomes);

$.getJSON("api/roulette/spin").done(function( data ) {
    let main = $('.main');
    let overlay = $('#overlay-loading');

    var timer=$(".roulette-timer");
    var progress=$(".round-time-bar div");
    var getSpin=false;

    var serverSecond=data['currentSecond'];

    displayLast100(data['rouletteLast100']);
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
            $.getJSON( "api/roulette/spin").done(function( data ) {
                serverSecond=data['currentSecond'];
                if(serverSecond==0) serverSecond=30;
                endTime = new Date(new Date().getTime() + serverSecond*1000);
                currentSecond = (endTime.getTime() - new Date().getTime()) / 1000;
                spinWheel(getPosition(data['outcome'],outcomes),outcomes,function () {displayLast100(data['rouletteLast100']);  });
            });
        }
        currentSecond = (endTime.getTime() - new Date().getTime()) / 1000;
    }, 10);

    setInterval(function() {
        $.getJSON( "api/roulette/bets").done(function( data ) {
            updateBets($("#bet-list-red"),data['bets'].red);
            updateBets($("#bet-list-black"),data['bets'].black);
            updateBets($("#bet-list-green"),data['bets'].green);
            updateBets($("#bet-list-bait"),data['bets'].bait);
        });
    }, 1000);
});

$('#bet-red').click(function() {
    $.ajax({
        type:'POST',
        url:'roulette/bet',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify({  bet:0 , betAmount:parseInt(inputBet.val()) })
     });
});
$('#bet-green').click(function() {
    $.ajax({
        type:'POST',
        url:'roulette/bet',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify({  bet:1 , betAmount:parseInt(inputBet.val()) })
     });
});
$('#bet-black').click(function() {
    $.ajax({
        type:'POST',
        url:'roulette/bet',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify({  bet:2 , betAmount:parseInt(inputBet.val()) })
     });
});
$('#bet-bait').click(function() {
    $.ajax({
        type:'POST',
        url:'roulette/bet',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify({  bet:3 , betAmount:parseInt(inputBet.val()) })
     });
});

function updateBets(betlist,bets){
    betValues = Object.values(bets).sort(function(a, b){return b.amount - a.amount});
    betlist.find(".bet-total-number").html(Object.keys(bets).length);
    betlist.find(".bet-total-amount").html(betValues.reduce((p,c)=>p+c.amount,0));
    var betList="";
    for(const key in betValues){
        betList+=addBet(betValues[key].name,betValues[key].avatar,betValues[key].amount)
    }
    betlist.find(".bet-list-bets").html(betList);
}
function addBet(name,avatar,amount){
    return `<div class="bet-list-bet">
                <div>
                    <img class="image-circle" style="background-color:#F95146"  src='`+avatar+`'width="30" height="30">
                    <span class="fw-bold">`+name+`</span>
                </div>
                <div>
                    <img  src="assets/dollar_coin.svg" width="16" height="16">
                    <span class="score-bet fw-bold">`+amount+`</span>
                </div>
            </div>`
}


function displayLast100(last100){
    var last7html="";
    var lastTotalRed=0;
    var lastTotalGreen=0;
    var lastTotalBlack=0;
    var lastTotalBaitRed=0;
    var lastTotalBaitBlack=0;

    for (let i = 0; i < 100; i++) {
        let color = valueToColor(last100[i]);
        let image = valueToImage(last100[i]);
        if(color=="roulette-black"){
            lastTotalBlack++;
            if(image=="hook"){
                lastTotalBaitBlack++;
            }
        }
        if(color=="roulette-red"){
            lastTotalRed++;
            if(image=="hook"){
                lastTotalBaitRed++;
            }
        }
        if(color=="roulette-house"){
            lastTotalGreen++;
        }


        if(i<7){
            last7html += createRoundImage(color,image);
        }
    }

    $('.last-100-red').html(lastTotalRed.toString());
    $('.last-100-green').html(lastTotalGreen.toString());
    $('.last-100-black').html(lastTotalBlack.toString());
    $('.last-100-bait-red').html(lastTotalBaitRed.toString());
    $('.last-100-bait-black').html(lastTotalBaitBlack.toString());
    $('.last-7').html(last7html);
}

function createRoundImage(color,image){
    return "<img class='image-circle rounded-circle "+color+"'src='../assets/roulette/"+image+".svg' width='30' height='30'>";
}
function createCard(color,image){
    return "<img class='roulette-card "+color+"'src='../assets/roulette/"+image+".svg' width='60' height='60'>";
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
            image="black";
        }
        else {
            image="red";
        }
    }
    if(value==6){
        image="hook";
    }
    if(value==7){
        image="house";
    }
    if(value==8){
        image="hook";
    }
    if(value>8) {
        if(value%2==1){
            image="black";
        }
        else{
            image="red";
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

var last=0;
$("#input-bet").change(function(){
    let input = $(".input-bet").val();
    if(input > parseInt($("#balance").html())){
        $(".input-bet").val(input);
    }
});

$("#button-amount-clear").click(function(){
    last=0;
    $(".input-bet").val(last);
});
$("#button-amount-last").click(function(){
    $(".input-bet").val(last);
});
$("#button-amount-1").click(function(){
    last=parseInt($(".input-bet").val())+1;
    $(".input-bet").val(last);
});
$("#button-amount-10").click(function(){
    last=parseInt($(".input-bet").val())+10;
    $(".input-bet").val(last);
});
$("#button-amount-100").click(function(){
    last=parseInt($(".input-bet").val())+100;
    $(".input-bet").val(last);
});
$("#button-amount-1000").click(function(){
    last=parseInt($(".input-bet").val())+1000;
    $(".input-bet").val(last);
});
$("#button-amount-2").click(function(){
    last=parseInt($(".input-bet").val())/2;
    $(".input-bet").val(last);
});
$("#button-amount-x2").click(function(){
    last=parseInt($(".input-bet").val())*2;
    $(".input-bet").val(last);
});

$("#button-amount-max").click(function(){
    last=parseInt($("#balance").html());
    $(".input-bet").val(last);
});
