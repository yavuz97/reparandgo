var peScrollChange=function(){"use strict";var e=function(e){function n(){function e(){for(var e=0;e<l.length;e++)i.classList.add(l[e])}function n(){for(var e=0;e<l.length;e++)i.classList.remove(l[e])}var o,s,i=1===r.elem.nodeType?r.elem:document.querySelector(r.elem),a=r.classesToChange||"nav-bg",l=a.split(" ");isNaN(r.trigger)?(s=1===r.trigger.nodeType?r.trigger:document.querySelector(r.trigger),o=s.getBoundingClientRect().top+t()-i.offsetHeight+r.offset,o=o>0?o:i.offsetHeight):o=r.trigger;var g=t();0!==r.endPoint?g>=o&&g<=o+r.endPoint?r.removeClass?n():e():r.removeClass?e():n():g>=o?r.removeClass?n():e():r.removeClass?e():n()}function t(){return window.pageYOffset||document.documentElement.scrollTop}var r={elem:".navbar",trigger:50,classesToChange:"nav-bg",offset:0,removeClass:!1,endPoint:0};for(var o in e)e.hasOwnProperty(o)&&(r[o]=e[o]);window.addEventListener("scroll",n),window.addEventListener("load",n)};return{init:e}}();

$(window).load(function(){
    peScrollChange.init({
        elem: '.navbar',
        trigger: document.querySelector('#hero-image-navbar-trigger').offsetHeight,
        classesToChange: 'nav-transp',
        removeClass: true,
    });

})