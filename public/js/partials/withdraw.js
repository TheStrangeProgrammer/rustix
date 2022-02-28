var itemsToSell=[];
$("#withdraw-button").click(function (e) {
    e.stopImmediatePropagation();
    $(".withdraw").html("");
    $("#withdraw-total").html( "$"+Object.values(itemsToSell).reduce((p,c)=>p+c.amount*c.price/100,0));
    $("#withdraw-count").html( Object.values(itemsToSell).reduce((p,c)=>p+c.amount,0));
    $("#withdraw-coins").html( Object.values(itemsToSell).reduce((p,c)=>p+c.amount*c.price,0));
    itemsToSell=[];
    $.getJSON("withdraw/getItems").done(function( data ) {

        if(data.success==false) $(".withdraw").html("<p>You do not have any items or your withdraw is private</p>");
        Object.values(data.inventory).forEach(item => {
            let itemToDisplay=`
            <div class="d-flex flex-column align-items-center m-2 item">
                <span id="item-id" class="d-none">`+item.id+`</span>
                <span id="item-price" class="d-none">`+item.price+`</span>

                <p class="text-center fw-bold">`+item.name+`</p>
                <img src="`+item.icon_url+`" >

                <div class="d-flex flex-row justify-content-evenly w-100 item-info">
                    <p>$: <span class="item-price">`+item.price/100+`</span></p>
                </div>

            </div>
            `
            if(item.amount>1){
                for(let i=0;i<item.amount;i++){
                    $(".withdraw").append(itemToDisplay);
                }
            }else{
                $(".withdraw").append(itemToDisplay);
            }


        });


    });

});

$("body").on('click', 'div .withdraw .item',function (e) {
    e.stopImmediatePropagation();

    var itemDiv =  $(this);


    if(itemDiv.hasClass("item-selected")){
        itemDiv.removeClass("item-selected");

        var id = itemDiv.find("#item-id").text();
        var itemIndex = itemsToSell.findIndex(element => element.id == id);
        if(itemsToSell[itemIndex].amount<=1){
            itemsToSell.splice(itemIndex,1);
        }else{
            itemsToSell[itemIndex].amount-=1;
        }


    } else {
        itemDiv.addClass("item-selected");
        var id = itemDiv.find("#item-id").text();
        var itemIndex = itemsToSell.findIndex(element => element.id == id);
        if(itemIndex!=-1){
            itemsToSell[itemIndex].amount+=1;
        }else{
            var item = new Object();

            item.id=id;
            item.amount=1;
            item.price=itemDiv.find("#item-price").text();
            itemsToSell.push(item);
        }

    }

    console.log(itemsToSell);

    $("#withdraw-total").html("$"+Math.round(Object.values(itemsToSell).reduce((p,c)=>p+c.amount*c.price/100,0)*100)/100);
    $("#withdraw-coins").html(Object.values(itemsToSell).reduce((p,c)=>p+c.amount*c.price,0));
    $("#withdraw-count").html(Object.values(itemsToSell).reduce((p,c)=>p+c.amount,0));

});

$("body").on('change',".withdraw .item-quantity-input .form-control",function (e) {
    e.stopImmediatePropagation();

    var itemDiv = $(this).parent().parent().parent();
    var id = itemDiv.find("#item-id").text();
    var itemIndex = itemsToSell.findIndex(element => element.id == id);

    itemsToSell[itemIndex].amount=parseInt(itemDiv.find(".form-control").val());
    $("#withdraw-total").html( "$"+Math.round(Object.values(itemsToSell).reduce((p,c)=>p+c.amount*c.price/100,0)*100)/100);
    $("#withdraw-coins").html( Object.values(itemsToSell).reduce((p,c)=>p+c.amount*c.price,0));
    $("#withdraw-count").html( Object.values(itemsToSell).reduce((p,c)=>p+c.amount,0));
});
$("body").on('click',"#submit-withdraw-item-list",function (e) {
    e.stopImmediatePropagation();
    $.ajax({
        type:'POST',
        url:'withdraw/withdrawItems',
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
