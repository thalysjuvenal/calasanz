"use strict";

window.addEventListener('load', function() {



//------------------------------------------------------------------------
//						OWL CAROUSEL OPTIONS
//------------------------------------------------------------------------

$('.carousel-single').owlCarousel({
    loop: false,
    margin: 0,
    nav: true,
    autoplay: true,
    autoplayHoverPause: true,
    autoHeight: false,
    items: 1,
    dots: true,
    navText: ['',''],
    rewind: true
});



//------------------------------------------------------------------------
//						OWL CAROUSEL OPTIONS
//------------------------------------------------------------------------

$('.carousel-single').owlCarousel({
    loop: false,
    margin: 0,
    nav: true,
    autoplay: true,
    autoplayHoverPause: true,
    autoHeight: false,
    items: 1,
    dots: true,
    navText: ['',''],
    rewind: true
});






//------------------------------------------------------------------------
//						OWL CAROUSEL OPTIONS
//------------------------------------------------------------------------

$('.carousel-3item').owlCarousel({
    loop: false,
    margin: 30,
    nav: true,
    navText: ['', ''],
    dotsEach: true,
    autoplay: true,
    autoplayHoverPause: true,
    rewind: true,
    startPosition: 1,
    responsive: {
        0: {
            items: 1
        },
        700: {
            items: 2
        },
        1200: {
            items: 3
        }
    }

});




});
