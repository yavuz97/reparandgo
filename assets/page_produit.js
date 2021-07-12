
import $ from 'jquery'
import peScrollChange from './peScroll'

var mediaQery = window.matchMedia("(max-device-width : 480px)")

if (!mediaQery.matches) { // If media query matches
    $(document).scroll(function() {
        checkOffset();
    });

    function checkOffset() {
        if($('#social-float').offset().top + $('#social-float').height()
            >= $('#abc').offset().top - 10){
            $('#social-float').css('position', 'absolute');
            $('#social-float').addClass( "bottom-0" );
        }


        if($(document).scrollTop() + window.innerHeight < $('#abc').offset().top){
            $('#social-float').css('position', 'fixed'); // restore when you scroll up

        }
    }
}


