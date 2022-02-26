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
    $.getJSON("profile/getProfile").done(function( data ) {
        $("#total-deposited").html(data.totalDeposited);
        $("#total-gambled").html(data.totalGambled);
        let profit = data.totalDeposited-data.totalGambled;
        if(profit<0) $("#profit").css("color","red");
        else $("#profit").css("color","green");
        $("#profit").html(profit);
        $("#trade-token").val(data.tradeToken);
        $('#myModal').modal({backdrop: 'static', keyboard: false})  
        modal.className = "Modal is-visuallyHidden";

    });
});
