// owl carousel in header
$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    autoplay: true,
    nav:true,
    navText: ["<span class='glyphicon glyphicon-menu-left'></span>","<span class='glyphicon glyphicon-menu-right'></span>"],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});
