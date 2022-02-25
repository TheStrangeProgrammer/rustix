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
        data.betHistory.forEach(element => {
            $("#bet-history").append(`
                        <div class="total-deposited2 text-edit" style="background-color: #00C74D">
                            <span >Won `+element.amount+` coins:</span>
                            <span class="ms-auto ">`+element.game+`</span>
                            <span class="ms-auto ">`+element.time+`</span>
                        </div>
            `);
        });

    });
});
