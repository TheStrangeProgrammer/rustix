$("butn").click(function(){ // when any button is clicked
    $("butn").removeClass("active"); //delete all "active" classes from all buttons
    $(this).addClass("active"); //assign the "active" class only to the one that was clicked
    return false;
});

function showDiv() { 
    document.getElementById('profile').style.display = "flex";
    if(showDiv){
        document.getElementById('referrals').style.display = "none";
        document.getElementById('history').style.display = "none";
    }
 }
 function showDiv2() {
    document.getElementById('referrals').style.display = "flex";
    if(showDiv2){
        document.getElementById('profile').style.display = "none";
        document.getElementById('history').style.display = "none";
    }
 }
 function showDiv3() {
    document.getElementById('history').style.display = "flex";
    if(showDiv3){
        document.getElementById('profile').style.display = "none";
        document.getElementById('referrals').style.display = "none";

    }
 }
 