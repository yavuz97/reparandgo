/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import './styles/style.css';
import './styles/clesMinute.css';
import './styles/computerReparation.css';
import './styles/tabletteReparation.css';
import './styles/tamponImpression.css';

// start the Stimulus application
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css'
import $ from 'jquery'

console.log("je suis la")
import peScrollChange from './peScroll'

$(window).on('load', function(){
    console.log("windows load");
    peScrollChange.init({
        elem: '.navbar',
        trigger: document.querySelector('#hero-image-navbar-trigger').offsetHeight,
        classesToChange: 'nav-transp',
        removeClass: true,
    });

})



