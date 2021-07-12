
import $ from 'jquery'
import peScrollChange from './peScroll'


var mediaQery = window.matchMedia("(max-device-width : 480px)")

if (!mediaQery.matches) { // If media query matches

    $(window).on('load', function(){

        // Scroll Changes

        peScrollChange.init({
            elem: '.acerComputers',
            trigger: document.querySelector('#hero-image-navbar-trigger').offsetHeight,
            classesToChange: 'show',
        });


        peScrollChange.init({
            elem: '.serviceOrdi-dissableComputer',
            trigger: '#serviceOrdi-dissableComputer-declancheur',
            classesToChange: 'show',
            offset: -300,
            // endPoint: document.querySelector('#serviceOrdi-dissableComputer-declancheur').offsetHeight
        });



    })
}



