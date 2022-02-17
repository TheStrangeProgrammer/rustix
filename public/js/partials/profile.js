$(document).ready(function() {
    var pt = $('.p0 span:last-child');
    var text = parseFloat($(pt).text().replace(',', '.'));    

    if (text < 0) {
        $(".p0 span:last-child").css({
            'color': '#AF2901',
        })
    }
});