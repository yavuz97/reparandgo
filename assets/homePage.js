

import $ from 'jquery'
import peScrollChange from './peScroll'



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


        // peScrollChange.init({
        //     elem: '.iphone-s3',
        //     trigger: '.iphone-s3',
        //     classesToChange: 'show',
        //     offset: 100,
        // });

    })
}
// }else{
//     $(window).on('load', function(){
//
//         peScrollChange.init({
//             elem: '.iphone-s3',
//             trigger: '.iphone-s3',
//             classesToChange: 'show',
//             offset: 100,
//         });
//
//     })
// }



