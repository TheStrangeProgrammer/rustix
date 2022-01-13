
<script src="{{ asset('js/app.js') }}"></script>
<script>
    var items = [];
    $(document).ready(function() {
        $('.item').click(function() {
            if($(this).hasClass("itemActive")){
                $(this).removeClass("itemActive");
            }else{
                $(this).addClass("itemActive");
                var item =new Object();
                item.id= $(this).find(".id").text();
                item.amount=$(this).find(".amount").text();
                items.push(item);
                console.log(items);
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
