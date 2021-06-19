

import $ from 'jquery'
import peScrollChange from './peScroll'






$(window).on('load', function(){

    // Scroll Changes

    peScrollChange.init({
        elem: '.iphone-s1-6',
        trigger: '#sloganContent',
        classesToChange: 'show',
        offset: 20,
        endPoint: document.querySelector('#sloganContent').offsetHeight
    });




    peScrollChange.init({
        elem: '.iphone-s3',
        trigger: '.iphone-s3',
        classesToChange: 'show',
        offset: 100,
    });

})



