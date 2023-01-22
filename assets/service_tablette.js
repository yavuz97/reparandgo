
import $ from 'jquery'
import peScrollChange from './peScroll'


var mediaQery = window.matchMedia("(max-device-width : 480px)")

if (!mediaQery.matches) { // If media query matches
    $(window).on('load', function(){

        // Scroll Changes


        peScrollChange.init({
            elem: '.ipadClined',
            trigger: document.querySelector('#hero-image-navbar-trigger').offsetHeight,
            classesToChange: 'show',
            // endPoint: document.querySelector('#sloganContent').offsetHeight
        });

        peScrollChange.init({
            elem: '.tabletteWhite',
            trigger: '.tabletteWhite',
            classesToChange: 'show',
            offset: -300,

        });

    })

}


