
<script src="{{ asset('js/app.js') }}"></script>
<script>
    var items = [];
    $(document).ready(function() {
        $('.item').click(function(event) {
            if($(event.target).hasClass("item")){
                if($(this).hasClass("itemActive")){
                $(this).removeClass("itemActive");
                $(this).find(".amountInput").addClass("d-none");
                items = items.filter(it => it.id!=$(this).find(".id").text());
            }else{
                $(this).addClass("itemActive");
                $(this).find(".amountInput").removeClass("d-none");
                var item =new Object();
                item.id= $(this).find(".id").text();
                item.amount=$(this).find(".amount").text();
                items.push(item);
            }
            }

        })
        $('.amountInput').change(function() {
            if($(this).hasClass("itemActive")){
                items.find(it => it.id);
                item.amount=$(this).text();
            }else{

            }
        })
    });
    $(document).ready(function() {
        if($(".navbar-toggler").is(":visible")){
            $(".navbar-nav").addClass("");
        } else{
            $(".navbar-nav").removeClass("");
        }
    });
   </script>
