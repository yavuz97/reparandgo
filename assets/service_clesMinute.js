import $ from 'jquery'
import peScrollChange from './peScroll';
import 'owl.carousel'


jQuery(document).ready(function($) {
    "use strict";
    //  TESTIMONIALS CAROUSEL HOOK
    $('#clesSlider').owlCarousel({
        loop: true,
        center: true,
        items: 1,
        margin: 0,
        autoplay: true,
        dots:true,
        nav:true,
        autoplayTimeout: 8500,
        smartSpeed: 450,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            1170: {
                items: 3
            }
        }
    });
});


window.onload = function() {


    if (document.querySelector('.rellax')) {
        Rellax('.rellax', {
            speed: 2,
            center: true,
            round: true,
            vertical: true,
            horizontal: false,
        })
    }

    peScrollChange.init({
        elem: '.birCokAnahtar',
        trigger: '#firstContainer',
        classesToChange: 'show',
        offset: -10,
        // endPoint: document.querySelector('#serviceOrdi-dissableComputer-declancheur').offsetHeight
    });
    // peScrollChange.init({
    //     elem: '#clesMinuteTopCard',
    //     trigger: '#clesMinuteTopCard',
    //     classesToChange: 'yellowHover',
    //     offset: -10,
    //     // endPoint: document.querySelector('#serviceOrdi-dissableComputer-declancheur').offsetHeight
    // });
    //
    // peScrollChange.init({
    //     elem: '#clesMinuteTopCard2',
    //     trigger: '#clesMinuteTopCard2',
    //     classesToChange: 'yellowHover',
    //     offset: -10,
    //     // endPoint: document.querySelector('#serviceOrdi-dissableComputer-declancheur').offsetHeight
    // });
    //
    // peScrollChange.init({
    //     elem: '.hero-container-ClesDeux',
    //     trigger: '.hero-container-ClesDeux',
    //     classesToChange: 'yellowHover',
    //     offset: 450,
    //     // endPoint: document.querySelector('#serviceOrdi-dissableComputer-declancheur').offsetHeight
    // });



}