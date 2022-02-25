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
        Object.values(history).forEach(element => {
            let backgroundColor;
            if(element.won==true){
                backgroundColor="background-color: #00C74D";
            }else{
                backgroundColor="background-color: #AF2929";
            }
            $("#bet-history").append(`
                        <div class="total-deposited2 text-edit" style="`
                        +backgroundColor+
                        `">
                            <span >Won `+element.amount+` coins:</span>
                            <span class="ms-auto ">`+element.game+`</span>
                            <span class="ms-auto ">`+element.time+`</span>
                        </div>
            `);
        });

    });
});
