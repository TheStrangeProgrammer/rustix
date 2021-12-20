//LOADER
$(document).ready(function(){
	setTimeout(
	  function() 
	  {
		$('#loader').fadeOut();
	  }, 100);

});
//MODALE
$('.modal').hide();

$('.btnModal').click(function(){	
	$('#'+this.innerHTML).fadeIn(150);
	$('body').addClass('noscroll');
});

var closeModal = function(){
	$('.modal').fadeOut(150);
	$('body').removeClass('noscroll');
}

$('.closeModalBTN').click(function(){	
	closeModal();
});

$('.modal').click(function(){
	if(event.target.className.split(" ")[0] == 'modal')
    closeModal(); 
});

//TOGGLES
$('.dropdown').hide();
$('.toggler').click(function(){
	var concatenare = '#' + $(this).attr('apartine');
	$(concatenare).slideToggle(150);
	$('.toggler').closest('.caca').toggleClass('rotatedHorizontal');
});

//CHAT TOGGLE
$('#chatToggleBTN').click(function(){
	$('#chat').toggleClass('collapsedChat');
	$('#chat .right').toggleClass('none');
	$('#content').toggleClass('fullWidthContent');
	$('#chatToggleBTN').toggleClass('rotatedHorizontal');
});

$('.btnChoice').click(function(){
	$(this).parent('.dropdown').hide();
	if($(this).parent()[0].id == 'userDropDown'){
		$('#mobileNav').hide();
		$('#mobileNav #userDropDownBTN i').toggleClass('rotatedVertical');
	};
})













let color1 = '#14db1a';
let color2 = '#292d3a';
let theWheel = new Winwheel({
    'numSegments': 8,
    'outerRadius': 150,
    'textFontSize': 17,
    'segments':
        [{
                'fillStyle': color2,
                'text': 'Prize 1'
            },
            {
                'fillStyle': color1,
                'text': 'Prize 2'
            },
            {
                'fillStyle': color2,
                'text': 'Prize 3'
            },
            {
                'fillStyle': color1,
                'text': 'Prize 4'
            },
            {
                'fillStyle': color2,
                'text': 'Prize 5'
            },
            {
                'fillStyle': color1,
                'text': 'Prize 6'
            },
            {
                'fillStyle': color2,
                'text': 'Prize 7'
            },
            {
                'fillStyle': color1,
                'text': 'Prize 8'
            }
        ],
    'animation': // Specify the animation to use.
    {
        'type': 'spinToStop',
        'duration': 3,
        'spins': 3,
        'callbackFinished': alertPrize
    }
});
//VARS USED
let wheelSpinning = false;
//SPIN BUTTON
function startSpin() {
    if (wheelSpinning == false) {
        $('#spin_button').fadeOut();
        theWheel.startAnimation();
        wheelSpinning = true;
    }
}
//ALERT PRIZE
function alertPrize(indicatedSegment) {
    alert("You have won " + indicatedSegment.text);
}