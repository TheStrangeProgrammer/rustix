var endTime;
$.getJSON("faucet").done(function(data) {
    endTime = new Date(new Date().getTime() + data.serverTime*1000);
    if(data.claimed==true){
        $('#free-coins').parent().css('background-color','gray');

        setInterval(function() {
            var currentSecond = (endTime.getTime() - new Date().getTime()) / 1000;
            $("#free-coins").html(secondsToHms(currentSecond));
        },1000);
    }
});
$("#free-coins").click(function() {
    $.ajax({
        type:'POST',
        url:'faucet',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     }).done(function() {
        $('#free-coins').parent().css('background-color','gray');
        setInterval(function() {
            var currentSecond = (endTime.getTime() - new Date().getTime()) / 1000;
            $("#free-coins").html(secondsToHms(currentSecond));
        },1000);
     });

});
function secondsToHms(d) {
    d = Number(d);
    var h = Math.floor(d / 3600);
    var m = Math.floor(d % 3600 / 60);
    var s = Math.floor(d % 3600 % 60);

    var hDisplay = h > 0 ? h + (h == 1 ? " hour, " : " hours, ") : "";
    var mDisplay = m > 0 ? m + (m == 1 ? " minute, " : " minutes, ") : "";
    var sDisplay = s > 0 ? s + (s == 1 ? " second" : " seconds") : "";
    return hDisplay + mDisplay + sDisplay;
}
