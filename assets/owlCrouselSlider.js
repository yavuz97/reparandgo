

import $ from 'jquery'
import peScrollChange from './peScroll'
import 'owl.carousel'


jQuery(document).ready(function($) {
    "use strict";
    //  TESTIMONIALS CAROUSEL HOOK
    $('.customers-testimonials').owlCarousel({
        loop: true,
        center: true,
        items: 3,
        margin: 0,
        autoplay: true,
        dots:true,
        autoplayTimeout: 8500,
        smartSpeed: 450,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            1170: {
                items: 3
            }
        }
    });
});


var mediaQery = window.matchMedia("(max-device-width : 480px)")

if (!mediaQery.matches) { // If media query matches
    $(window).on('load', function(){

        // Scroll Changes

        peScrollChange.init({
            elem: '.iphone-s1-6',
            trigger: '#sloganContent',
            classesToChange: 'show',
            offset: 20,
            // endPoint: document.querySelector('#sloganContent').offsetHeight
        });




        peScrollChange.init({
            elem: '.iphone-s3',
            trigger: '.iphone-s3',
            classesToChange: 'show',
            offset: 100,
        });

    })

}else{
    $(window).on('load', function(){

        peScrollChange.init({
            elem: '.iphone-s3',
            trigger: '.iphone-s3',
            classesToChange: 'show',
            offset: 100,
        });

    })
}



