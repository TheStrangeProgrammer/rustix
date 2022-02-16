$(document).ready(function() {
    var items=[];

    $(".item").click(function (e) {
        e.preventDefault();

        var inputDiv = $(this).find(".item-quantity-input");
        var infoDiv = $(this).find(".item-info");
        var itemDiv =  $(this);
        if(itemDiv.hasClass("item-selected")){
            itemDiv.removeClass("item-selected");
            inputDiv.addClass("d-none");
            infoDiv.addClass("flex-column");


            var id = itemDiv.find(".item-id").text();
            var itemIndex = items.findIndex(element => element.id == id);
            items.splice(itemIndex,itemIndex);
        } else {
            itemDiv.addClass("item-selected");
            inputDiv.removeClass("d-none");
            inputDiv.find(".form-control").attr("max",itemDiv.find(".item-quantity").text());
            infoDiv.removeClass("flex-column");

            var id = itemDiv.find(".item-id").text();
            var item = new Object();
            item.id=id;
            item.amount=0;
            item.price=itemDiv.find(".item-price").text();
            items.push(item)

        }

    });
    $(".item-quantity-input").click(function (e) {
        e.stopPropagation();
    });
    $(".item-quantity-input .form-control").change(function (e) {
        e.preventDefault();
        var itemDiv = $(this).parent().parent().parent();
        var id = itemDiv.find(".item-id").text();
        var itemIndex = items.findIndex(element => element.id == id);


        items[itemIndex].amount=itemDiv.find(".form-control").val();
        $("#total").html( Object.values(items).reduce((p,c)=>p+c.amount*c.price,0));
    });
    $("#submit-item-list").click(function (e) {
        $("#item-list").val(JSON.stringify(items));
    });
});
