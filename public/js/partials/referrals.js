$("#referrals-button").click(function (e) {
    e.stopImmediatePropagation();
    $("#referrals-history").html("");


    $.getJSON("referrals/getReferrals").done(function( data ) {

        if(data.referralCode!=null){
            $("#set-referral").val(data.referralCode);
            $(".ref-button").parent().css("opacity","0.5");
            $(".ref-button").attr("disabled", true);
        }
        if(data.referredBy!=null){
            $("#claim-referral").val(data.referredBy);
            $(".claim-button").parent().css("opacity","0.5");
            $(".claim-button").attr("disabled", true);
        }



        var referrals = data.referrals;

        Object.values(referrals).slice().reverse().forEach(element => {
            $("#referrals-history").append(`
                <div class="ref-list text-edit  " >
                    <span class="Name">`+element.name+` used your code</span>
                    <span class="Coins ">100 Coins</span>
                </div>
            `)
        });

    });
});
$(".ref-button").click(function (e) {
    e.stopImmediatePropagation();
    $.ajax({
        type:'POST',
        url:'referrals/set',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify({"referralCode":$("#set-referral").val()})
     }).done(function(data){
         if(data.success==1){

         }else{

         }
     });
});
$(".claim-button").click(function (e) {
    e.stopImmediatePropagation();
    $.ajax({
        type:'POST',
        url:'referrals/claim',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify({referrerCode:$("#claim-referral").val()})
     }).done(function(data){
         if(data.success==1){

         }else{

         }
     });
});
