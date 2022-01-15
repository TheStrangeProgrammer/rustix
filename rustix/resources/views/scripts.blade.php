
<script src="{{ asset('js/app.js') }}"></script>
<script>
    function responsiveSet(){


    }
    $(document).ready(function() {
        if($(window).width()<=720){
            if($("#sidebar-and-content").hasClass("flex-row-reverse")){
                $("#sidebar-and-content").removeClass("flex-row-reverse").addClass("flex-column");
            }
        }else{
            if(!$("#sidebar-and-content").hasClass("flex-row-reverse")){
                $("#sidebar-and-content").removeClass("flex-column").addClass("flex-row-reverse");
            }
        }

        $(window).resize(function(){
            if($(window).width()<=720){
            if($("#sidebar-and-content").hasClass("flex-row-reverse")){
                $("#sidebar-and-content").removeClass("flex-row-reverse").addClass("flex-column");
            }
        }else{
            if(!$("#sidebar-and-content").hasClass("flex-row-reverse")){
                $("#sidebar-and-content").removeClass("flex-column").addClass("flex-row-reverse");
            }
        }
        });
    });

   </script>
