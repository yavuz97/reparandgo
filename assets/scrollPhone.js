const slider = document.querySelector('.itemsScroll');
let isDown = false;
let startX;
let scrollLeft;

slider.addEventListener('mousedown', (e) => {
    mouseUpFirst(e)
});
slider.addEventListener('pointerdown', (e) => {
    mouseUpFirst(e)
});
function mouseUpFirst(e){
    isDown = true;
    slider.classList.add('active');
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
    cancelMomentumTracking();
}

slider.addEventListener('mouseleave', () => {
    mouseLeaveFirst();
});
slider.addEventListener('pointerleave', () => {
    mouseLeaveFirst();
});
function mouseLeaveFirst(){
    isDown = false;
    slider.classList.remove('active');
}

slider.addEventListener('mouseup', () => {
    mouseUpSecond();
});
slider.addEventListener('pointerup', () => {
    mouseUpSecond();
});
function  mouseUpSecond(){
    isDown = false;
    slider.classList.remove('active');
    beginMomentumTracking();
}


slider.addEventListener('mousemove', (e) => {
    mouseMove(e, mediaQery);
});
slider.addEventListener('pointermove', (e) => {
    mouseMove(e, mediaQery);
});

var mediaQery = window.matchMedia("(max-device-width : 480px)")


function mouseMove(e, mediaQery){
    if(!isDown) return;
    e.preventDefault();
    const x = e.pageX - slider.offsetLeft;
    var walk;

    if (mediaQery.matches) { // If media query matches
        walk = (x - startX) * 23; //scroll-fast
    } else {
        walk = (x - startX) * 3; //scroll-fast
    }
    var prevScrollLeft = slider.scrollLeft;
    slider.scrollLeft = scrollLeft - walk;
    velX = slider.scrollLeft - prevScrollLeft;
}



// Momentum

var velX = 0;
var momentumID;

slider.addEventListener('wheel', (e) => {
    cancelMomentumTracking();
});

function beginMomentumTracking(){
    cancelMomentumTracking();
    momentumID = requestAnimationFrame(momentumLoop);
}
function cancelMomentumTracking(){
    cancelAnimationFrame(momentumID);
}
function momentumLoop(){
    slider.scrollLeft += velX;
    velX *= 0.95;
    if (Math.abs(velX) > 0.5){
        momentumID = requestAnimationFrame(momentumLoop);
    }
}