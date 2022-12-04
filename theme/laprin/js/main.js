$(document).ready(function() {
    // Visual Slider
    var visualSlide = $('.visual-area .slide-wrap');
    visualSlide.slick({
        fade: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplaySpeed: 3000,
        speed: 900,
        autoplay: true,
        pauseOnHover: false,
        pauseOnFocus: false,
        focusOnSelect: false,
        dots: true,
        arrows: true,
        prevArrow: $('.visual-area .prev-btn'),
        nextArrow: $('.visual-area .next-btn')
    });
    visualSlide.addClass('animation-slider');
    // On before slide change
    visualSlide.find('.slide-01 .slogan, .slide-01 .sub, .slide-01 .more-btn').css({
        top: 0,
        opacity: 1
    });
    visualSlide.on('beforeChange', function(){
        $('.each-slide[aria-hidden="true"]', this).find('.slogan, .sub, .more-btn').delay(400).animate({
            top: 0,
            opacity: 1
        },0);
    });
    visualSlide.on('afterChange', function(){
        $('.each-slide[aria-hidden="true"]', this).find('.slogan, .sub, .more-btn').css({
            top: 40,
            opacity: 0
        });
    });

    // Quick Menu Slider
    $('.quick-menu .slide-wrap').slick({
        infinite: false,
        slidesToShow: 6,
        slidesToScroll: 6,
        speed: 400,
        autoplay: false,
        pauseOnHover: false,
        dots: false,
        arrows: false
        /* responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4
                }
            }
        ] */
    });

    // Most Popular Slider
    $('.most-popular .slide-wrap').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        speed: 500,
        autoplaySpeed: 3000,
        autoplay: true,
        pauseOnHover: false,
        pauseOnFocus: false,
        focusOnSelect: false,
        dots: false,
        arrows: true,
        prevArrow: $('.most-popular .prev-btn'),
        nextArrow: $('.most-popular .next-btn')
    });

    // Why LaPrin Slider
    $('.why-laprin .slide-wrap').slick({
        infinite: true,
        centerMode: true,
        variableWidth: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 800,
        autoplay: true,
        pauseOnHover: false,
        pauseOnFocus: false,
        focusOnSelect: false,
        dots: true,
        arrows: true,
        prevArrow: $('.why-laprin .prev-btn'),
        nextArrow: $('.why-laprin .next-btn')
    });
});