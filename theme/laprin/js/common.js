// menu btn : open & close : toggle
$(document).on('click','.menu-toggle',function() {
    if($('#gnb').hasClass('on')) {
        $('body').removeClass('menu-opened');
        $('html,body').scrollTop(scrollHeight);

        $('#gnb').removeClass('on');
    } else {
        scrollHeight = $(window).scrollTop();

        $('body').addClass('menu-opened');
        $('#gnb').addClass('on');
    }
});

// 2depth menu Mouseover
$(document).on("mouseenter focusin", '#gnb .menu > li', function () {
    if(!$(this).hasClass('on')) {
        $('#gnb .menu > li').not(this).removeClass('on');
        $('#gnb .menu > li').not(this).find('.sub-drop').slideUp(200);

        $(this).addClass('on');
        $('#header .submenu-dim').addClass('on');
        $(this).find('.sub-drop:not(:animated)').slideDown(300);
    }
});

// 2depth menu Close
$(document).on("focusin", '.language-select button', function () {
    $('#header .submenu-dim').removeClass('on');
    $('#gnb .menu > li').removeClass('on');
    $('#gnb .menu > li').find('.sub-drop').slideUp(200);
});
$(document).on("mouseleave", '#header .submenu-dim', function () {
    if($(this).hasClass('on')) {
        $('#gnb .menu > li').removeClass('on');
        $('#gnb .menu > li').find('.sub-drop').slideUp(200);
        $(this).removeClass('on');
    }
});
$(document).on("mouseenter focusin", '#container, #container *', function () {
    $('#gnb .menu > li').removeClass('on');
    $('#gnb .menu > li').find('.sub-drop').slideUp(200);
    $('#header .submenu-dim').removeClass('on');
});

// header fixed
function headerTop() {
    var scrlTop = $(window).scrollTop();

    if(scrlTop > 59) {
        $('#wrapper').addClass('scrolled-header');
    } else {
        $('#wrapper').removeClass('scrolled-header');
    }
}

// language : toggle event
$(document).on('click', '.language-select > button', function() {
    if($(this).hasClass('active')) {
        $(this).removeClass('active');
        $(this).siblings('ul').slideUp(200);
    } else {
        $(this).addClass('active');
        $(this).siblings('ul').slideDown(200);
    }
});

// fadeIn+top Parallax
function fadeInTopParallax() {
    var bottom_of_window = $(window).scrollTop() + $(window).height();

    $('.fadeInTop').each(function() {
        var object_bottom = $(this).offset().top + $(this).height()*0.2;
        if( bottom_of_window > object_bottom ) {
            if(!$(this).hasClass('fadeInTop-complete')) {
                $(this).animate({opacity:1,top:0},200).addClass('fadeInTop-complete');
            }
        }
    });
    $('.fadeInTopItem').not('.fadeInTop-complete').each(function() {
        $(this).addClass('fadeInTop-active');
        var item_bottom = $(this).offset().top + $(this).height()*0.3;

        if( bottom_of_window > item_bottom ) {
            var animating_object = $('.fadeInTop-active');
            if(animating_object.length) {
                var delay_index = $(this).parents('.fadeInTopGroup').find('.fadeInTopItem').index(this);
                var ani_sec = 200 * (1 + delay_index/10);
                var del_sec = delay_index+'00';

                $(this).animate({top:0},ani_sec);
                $(this).delay(del_sec).animate({opacity:1},10).addClass('fadeInTop-complete').removeClass('fadeInTop-active');
            }
        }
    });
}


// accordion
$(document).on('click','.accordion-list .question-btn',function() {
    var thisList = $(this).parent('li');
    if(thisList.hasClass('active')) {
        thisList.removeClass('active');
        $(this).siblings('.answer-box').slideUp(300);
    } else {
        thisList.siblings('li').removeClass('active');
        thisList.siblings('li').find('.answer-box').slideUp(300);

        thisList.addClass('active');
        $(this).siblings('.answer-box').slideDown(300);
    }
});

// right menu : scroll
function rightQuick() {
    var wingTop = 264;

    var scrlTop = $(window).scrollTop();
    var wingPosition	= (scrlTop + wingTop) + "px";

    $('#right_quick').stop().animate({
        top: wingPosition
    }, 500);
}

// go top : event
$(document).on('click', '#go_top', function() {
    $('html, body').animate({ scrollTop : 0 }, 500);
    return false;
});

$(window).on({
    "load" : function() {
        headerTop();
        fadeInTopParallax();
        rightQuick();
    },
    "scroll" : function() {
        headerTop();
        fadeInTopParallax();
        rightQuick();
    },
    "resize" : function() {
        headerTop();
        fadeInTopParallax();
        rightQuick();
    }
});