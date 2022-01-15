
<script src="{{ asset('js/app.js') }}"></script>
<script>
    $(document).ready(function() {
        if($(window).width()<=720){
            if(!$("#coins").hasClass("d-none")){
                $("#coins").addClass("d-none");
            }
            if($("#sidebar-and-content").hasClass("flex-row-reverse")){
                $("#sidebar-and-content").removeClass("flex-row-reverse").addClass("flex-column");
            }
        }else{
            if($("#coins").hasClass("d-none")){
                $("#coins").removeClass("d-none");
            }
            if(!$("#sidebar-and-content").hasClass("flex-row-reverse")){
                $("#sidebar-and-content").removeClass("flex-column").addClass("flex-row-reverse");
            }
        }

        $(window).resize(function(){
            if($(window).width()<=720){
                if(!$("#coins").hasClass("d-none")){
                $("#coins").addClass("d-none");
            }
            if($("#sidebar-and-content").hasClass("flex-row-reverse")){
                $("#sidebar-and-content").removeClass("flex-row-reverse").addClass("flex-column");
            }
        }else{
            if($("#coins").hasClass("d-none")){
                $("#coins").removeClass("d-none");
            }
            if(!$("#sidebar-and-content").hasClass("flex-row-reverse")){
                $("#sidebar-and-content").removeClass("flex-column").addClass("flex-row-reverse");
            }
        }
        });
    });

</script>
@yield('js')

