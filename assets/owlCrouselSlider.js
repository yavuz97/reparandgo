

import $ from 'jquery'
import 'owl.carousel'


jQuery(document).ready(function($) {
    "use strict";
    //  TESTIMONIALS CAROUSEL HOOK
    $('.customers-testimonials').owlCarousel({
        loop: true,
        center: true,
        items: 4,
        margin: -10,
        dots:true,
        responsive: {
            0: {
                items: 4
            },
            768: {
                items: 4
            },
            1170: {
                items: 4
            }
        }
    });
});





