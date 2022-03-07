$(document).ready(function(){
    $(".dropdown-game").hover(function(){
        var dropdownMenu = $(this).children(".dropdown-game-menu");
        if(dropdownMenu.is(":visible")){
            dropdownMenu.parent().toggleClass("open");
        }
    });
});