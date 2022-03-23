$(document).ready(function(){
    $(".dropdown-game").hover(function(){
        var dropdownMenu = $(this).children(".dropdown-game-menu");
        if(dropdownMenu.is(":visible")){
            dropdownMenu.parent().toggleClass("open");
        }
    });
});

function myFunction_1() {
    var x = document.getElementById("myDIV");
    var y = document.getElementById("myDIV2");
    var z = document.getElementById("btn-1")
    if (x.style.display === "none") {
      x.style.display = "flex";
      z.style.display = "flex"
    } else {
      x.style.display = "none";
    }
  }
  
  function myFunction_2() {
    var y = document.getElementById("myDIV2");
    if (y.style.display === "none") {
      y.style.display = "flex";
    } else {
      y.style.display = "none";
    }
  }