var itemsToSell=[];
$("#deposit-button").click(function (e) {
    $(".deposit").html("");
    $("#deposit-total").html( "$"+Object.values(itemsToSell).reduce((p,c)=>p+c.amount*c.price/100,0));
    $("#deposit-count").html( Object.values(itemsToSell).reduce((p,c)=>p+c.amount,0));
    $("#deposit-coins").html( Object.values(itemsToSell).reduce((p,c)=>p+c.amount*c.price,0));
    itemsToSell=[];
    $.getJSON("deposit/getItems").done(function( data ) {

        if(data.success==false) $(".deposit").html("<p>You do not have any items or your deposit is private</p>");
        Object.values(data.inventory).forEach(item => {
            let itemToDisplay=`
            <div class="d-flex flex-column align-items-center m-2 item">
                <span id="item-id" class="d-none">`+item.id+`</span>
                <span id="item-quantity" class="d-none">`+item.amount+`</span>
                <span id="item-price" class="d-none">`+item.price+`</span>

                <p class="text-center fw-bold">`+item.name+`</p>
                <img src="`+item.icon_url+`" >

                <div class="d-flex flex-row justify-content-evenly w-100 item-info">
                    <p>Q: `+item.amount+`</p>
                    <p>$: <span class="item-price">`+item.price/100+`</span></p>
                </div>
                <div class="d-none item-quantity-overlay">
                    <div class="input-group input-group-sm item-quantity-input">
                        <span class="input-group-text">Quantity</span>
                        <input class="form-control" type="number" min="0" max="0" value="0">
                    </div>
                </div>
            </div>
            `
            $(".deposit").append(itemToDisplay);
        });


    });

});

$("body").on('click', 'div .deposit .item',function (e) {
    e.preventDefault();

    var inputDiv = $(this).find(".item-quantity-overlay");
    var infoDiv = $(this).find(".item-info");
    var itemDiv =  $(this);

    if(itemDiv.hasClass("item-selected")){
        itemDiv.removeClass("item-selected");
        inputDiv.addClass("d-none");
        infoDiv.addClass("flex-row");


        var id = itemDiv.find("#item-id").text();

        var itemIndex = itemsToSell.findIndex(element => element.id == id);
        itemsToSell.splice(itemIndex,1);

    } else {
        itemDiv.addClass("item-selected");
        inputDiv.removeClass("d-none");
        inputDiv.find(".form-control").attr("max",itemDiv.find("#item-quantity").text());
        inputDiv.find(".form-control").attr("value",1);
        infoDiv.removeClass("flex-row");

        var id = itemDiv.find("#item-id").text();
        var item = new Object();
        item.id=id;
        item.amount=1;
        item.price=itemDiv.find("#item-price").text();
        itemsToSell.push(item)

    }
    $("#deposit-total").html( "$"+Math.round(Object.values(itemsToSell).reduce((p,c)=>p+c.amount*c.price/100,0)*100)/100);
    $("#deposit-coins").html( Object.values(itemsToSell).reduce((p,c)=>p+c.amount*c.price,0));
    $("#deposit-count").html( Object.values(itemsToSell).reduce((p,c)=>p+c.amount,0));

});
$("body").on('click',".deposit .item .item-quantity-input",function (e) {
    e.stopPropagation();
});
$("body").on('change',".deposit .item-quantity-input .form-control",function (e) {
    e.preventDefault();

    var itemDiv = $(this).parent().parent().parent();
    var id = itemDiv.find("#item-id").text();
    var itemIndex = itemsToSell.findIndex(element => element.id == id);

    itemsToSell[itemIndex].amount=parseInt(itemDiv.find(".form-control").val());
    $("#deposit-total").html( "$"+Math.round(Object.values(itemsToSell).reduce((p,c)=>p+c.amount*c.price/100,0)*100)/100);
    $("#deposit-coins").html( Object.values(itemsToSell).reduce((p,c)=>p+c.amount*c.price,0));
    $("#deposit-count").html( Object.values(itemsToSell).reduce((p,c)=>p+c.amount,0));
});
$("body").on('click',"#submit-deposit-item-list",function (e) {
    $.ajax({
        type:'POST',
        url:'deposit/depositItems',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify(itemsToSell)
     }).done(function(data){
         if(data.success==1){

         }else{

         }
     });
});
