
<script src="{{ asset('js/app.js') }}"></script>
<script>
    var items = [];
    $(document).ready(function() {
        $('.item').click(function() {
            if($(this).hasClass("itemActive")){
                $(this).removeClass("itemActive");
                items = items.filter(it => it.id!=$(this).find(".id").text());
            }else{
                $(this).addClass("itemActive");
                var item =new Object();
                item.id= $(this).find(".id").text();
                item.amount=$(this).find(".amount").text();
                items.push(item);
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
