
$("#deposit-button").click(function (e) {
    $(".inventory").html("");
    $.getJSON("deposit/getItems").done(function( data ) {
        if(data.success==false) $(".inventory").html("<p>You do not have any items or your inventory is private</p>");
        Object.values(data.inventory).forEach(item => {
            let itemToDisplay=`
            <div class="d-flex flex-column align-items-center m-2 item ">
                <p class="d-none item-id">`+item.id+`</p>
                <p class="d-none item-quantity">`+item.amount+`</p>

                <p class="text-center fw-bold">`+item.name+`</p>
                <img src="`+item.icon_url+`" >

                <div class="d-flex flex-row justify-content-evenly w-100 item-info">
                    <p>Q: `+item.amount+`</p>
                    <p>$: <span class="item-price">`+item.price+`</span></p>
                </div>
                <div class="d-none item-quantity-overlay">
                    <div class="input-group input-group-sm item-quantity-input">
                        <span class="input-group-text">Quantity</span>
                        <input class="form-control" type="number" min="0" max="0" value="0">
                    </div>
                </div>
            </div>
            `
            $(".inventory").append(itemToDisplay);
        });


    });
});
var itemsToSell=[];
$("body").on('click', 'div .inventory .item',function (e) {
    e.preventDefault();

    var inputDiv = $(this).find(".item-quantity-overlay");
    var infoDiv = $(this).find(".item-info");
    var itemDiv =  $(this);

    if(itemDiv.hasClass("item-selected")){
        itemDiv.removeClass("item-selected");
        inputDiv.addClass("d-none");
        infoDiv.addClass("flex-row");


        var id = itemDiv.find(".item-id").text();

        var itemIndex = itemsToSell.findIndex(element => element.id == id);
        itemsToSell.splice(itemIndex,1);

    } else {
        itemDiv.addClass("item-selected");
        inputDiv.removeClass("d-none");
        inputDiv.find(".form-control").attr("max",itemDiv.find(".item-quantity").text());
        inputDiv.find(".form-control").attr("value",1);
        infoDiv.removeClass("flex-row");

        var id = itemDiv.find(".item-id").text();
        var item = new Object();
        item.id=id;
        item.amount=1;
        item.price=itemDiv.find(".item-price").text();
        itemsToSell.push(item)

    }
    $("#total").html( Object.values(itemsToSell).reduce((p,c)=>p+c.amount*c.price,0));

});
$("body").on('click',".inventory .item .item-quantity-input",function (e) {
    e.stopPropagation();
});
$("body").on('change',".inventory .item-quantity-input .form-control",function (e) {
    e.preventDefault();

    var itemDiv = $(this).parent().parent();
    var id = itemDiv.find(".item-id").text();
    var itemIndex = itemsToSell.findIndex(element => element.id == id);


    itemsToSell[itemIndex].amount=itemDiv.find(".form-control").val();
    $("#total").html( Object.values(itemsToSell).reduce((p,c)=>p+c.amount*c.price,0));
});
$("#submit-item-list").on('click',"#submit-item-list",function (e) {
    $("#item-list").val(JSON.stringify(itemsToSell));
});
