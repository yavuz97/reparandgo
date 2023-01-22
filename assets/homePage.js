

import $ from 'jquery'
import peScrollChange from './peScroll'
import 'select2/dist/css/select2.css'
import select2 from 'select2/dist/js/select2'




var mediaQery = window.matchMedia("(max-device-width : 480px)")

if (!mediaQery.matches) { // If media query matches
    $(window).on('load', function () {

        // Scroll Changes

        peScrollChange.init({
            elem: '.iphone-s1-6',
            trigger: '.iphone-s1-6',
            classesToChange: 'show',
            offset: 300,
            // endPoint: document.querySelector('#sloganContent').offsetHeight
        });



    })
}



