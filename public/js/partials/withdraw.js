
$("#withdraw-button").click(function (e) {
    $(".withdraw").html("");
    $.getJSON("withdraw/getItems").done(function( data ) {
        if(data.success==false) $(".withdraw").html("<p>There was an error loading withdraw</p>");
        Object.values(data.withdraw).forEach(item => {
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
            $(".withdraw").append(itemToDisplay);
        });


    });
});
var itemsToBuy=[];
$("body").on('click', 'div .withdraw .item',function (e) {
    e.preventDefault();

    var inputDiv = $(this).find(".item-quantity-overlay");
    var infoDiv = $(this).find(".item-info");
    var itemDiv =  $(this);

    if(itemDiv.hasClass("item-selected")){
        itemDiv.removeClass("item-selected");
        inputDiv.addClass("d-none");
        infoDiv.addClass("flex-row");


        var id = itemDiv.find(".item-id").text();

        var itemIndex = itemsToBuy.findIndex(element => element.id == id);
        itemsToBuy.splice(itemIndex,1);

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
        itemsToBuy.push(item)

    }
    $("#total").html( Object.values(itemsToBuy).reduce((p,c)=>p+c.amount*c.price,0));

});
$("body").on('click',".withdraw .item .item-quantity-input",function (e) {
    e.stopPropagation();
});
$("body").on('change',".withdraw .item-quantity-input .form-control",function (e) {
    e.preventDefault();

    var itemDiv = $(this).parent().parent();
    var id = itemDiv.find(".item-id").text();
    var itemIndex = itemsToBuy.findIndex(element => element.id == id);


    itemsToBuy[itemIndex].amount=itemDiv.find(".form-control").val();
    $("#total").html( Object.values(itemsToBuy).reduce((p,c)=>p+c.amount*c.price,0));
});
$("#submit-item-list").on('click',"#submit-item-list",function (e) {
    $("#item-list").val(JSON.stringify(itemsToBuy));
});
