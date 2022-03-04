$("#referrals-button").click(function (e) {
    e.stopImmediatePropagation();
    $("#referrals-history").html("");


    $.getJSON("referrals/getReferrals").done(function( data ) {

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
