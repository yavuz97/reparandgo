
import $ from 'jquery'
import peScrollChange from './peScroll'

$(document).scroll(function() {
    checkOffset();
});

function checkOffset() {
    if($('#social-float').offset().top + $('#social-float').height()
        >= $('#abc').offset().top - 10){
        $('#imageCol').css('display', 'flex');
        $('#imageCol').css('align-items', 'flex-end');
        $('#social-float').css('position', 'absolute');
    }


    if($(document).scrollTop() + window.innerHeight < $('#abc').offset().top){
        $('#imageCol').css('display', 'block');
        $('#social-float').css('position', 'fixed'); // restore when you scroll up

    }
}

