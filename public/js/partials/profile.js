$(document).ready(function() {
    var pt = $('.p0 span:last-child');
    var text = parseFloat($(pt).text().replace(',', '.'));

    if (text < 0) {
        $(".p0 span:last-child").css({
            'color': '#AF2901',
        })
    }
});
$("#profile-button").click(function (e) {
    e.stopImmediatePropagation();
    $("#bet-history").html("");
    $.getJSON("profile/getProfile").done(function( data ) {
        $("#total-deposited").html(data.totalDeposited);
        $("#total-gambled").html(data.totalGambled);
        let profit = data.totalDeposited-data.totalGambled;
        if(profit<0) $("#profit").css("color","red");
        else $("#profit").css("color","green");
        $("#profit").html(profit);
        $("#trade-token").val(data.tradeToken);
        var history=data.betHistory;
        Object.values(history).slice().reverse().forEach(element => {
            let backgroundColor;
            let wonText="";
            if(element.won==true){
                backgroundColor="background-color: #00C74D";
                wonText="Won";
            }else{
                backgroundColor="background-color: #AF2929";
                wonText="Lost";
            }
            let dateTime = new Date(element.time);
            let printedDateTime="";
            if(isToday(dateTime)){
                printedDateTime=element.time.replace(/.+T/, ' ').replace(/\..+/, '');
            }else{
                printedDateTime=element.time.replace(/T.+/, ' ');
            }
            $("#bet-history").append(`
                        <div class="total-deposited2 text-edit" style="`
                        +backgroundColor+
                        `">
                            <span >`+wonText+` `+element.amount+` coins:</span>
                            <span class="ms-auto ">`+element.game+`</span>
                            <span class="ms-auto ">`+printedDateTime+`</span>
                        </div>
            `);
        });

    });
});
$("#update-trade-url").click(function (e) {
    e.stopImmediatePropagation();
    $.ajax({
        type:'POST',
        url:'profile/setTradeToken',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify({"tradeUrl":$("#trade-token").val()})
     }).done(function(data){

     });
});
function isToday(someDate){
    const today = new Date()
    return someDate.getDate() == today.getDate() &&
      someDate.getMonth() == today.getMonth() &&
      someDate.getFullYear() == today.getFullYear()
  }
