
// Set full screen background image on homepage

function full_screen() {
	var windowHeight = $(window).height();
	var windowWidth = $(window).width();

	if(windowHeight <= 650 && windowWidth > 767) {
		$(".row--parallax--1, .featured").css("height", "650");
	} else if (windowWidth <= 767 && windowHeight <= 550) {
		$(".row--parallax--1, .featured").css("height", "550");
	} else {
		$(".row--parallax--1, .featured").css("height", windowHeight);
	}
};

// vertically center homepage text
function center_vertical() {
	var windowHeight = parseInt($(window).height());
	var containerHeight = parseInt($('.row--parallax--1').height());
	var contentHeight = parseInt($('.featured').height());
	var centeredPadding = (((containerHeight - contentHeight) / 2) / windowHeight) * 100;
	centeredPadding = centeredPadding.toString() + 'vh' + ' ' + '0';

	$('.featured').css('padding', centeredPadding);

};

// touch screen fix

function is_touch_device() {
 return (('ontouchstart' in window)
      || (navigator.MaxTouchPoints > 0)
      || (navigator.msMaxTouchPoints > 0));
};

// header

function init() {
    window.addEventListener('scroll', function(e){
        var distanceY = window.pageYOffset || document.documentElement.scrollTop,
            shrinkOn = '200',
            header = document.querySelector("header");
        if (distanceY > shrinkOn) {
            $(header).addClass("row--header--smaller");
        } else {
            if ($(header).hasClass("row--header--smaller")) {
                $(header).removeClass("row--header--smaller");
            }
        }
        var fixedOn = '65',
        	mobileHeader = document.querySelector(".row--mobile-nav");
        if (distanceY > fixedOn) {
        	$(mobileHeader).addClass("row--mobile-nav--fixed");
        } else {
        	if ($(mobileHeader).hasClass("row--mobile-nav--fixed")) {
        		$(mobileHeader).removeClass("row--mobile-nav--fixed");
        	}
        }
    });
}

jQuery(window).load(function() {

	init();
	
	if ($('body').hasClass('home') || !$('body').hasClass('ie')) {
		full_screen();
//		center_vertical();
	}

	if ($('body').hasClass('single')) {
		$('#nav-menu-item-17').addClass('current-page-ancestor');
		
		$('.flexslider').flexslider({
			animation: "slide"
		});
	}
  
});

jQuery(window).resize(function() {
	if ($('body').hasClass('home') || !$('body').hasClass('ie')) {
		full_screen();
//		center_vertical();
	}

});


jQuery(document).ready(function() {
	$('.button a').addClass('button__link');

	//ios double tap fix
	$('nav a').on('click touchend', function(e) {
		var el = $(this);
		var link = el.attr('href');
		window.location = link;
	});
	

	$('a[href="#mobile-nav"]').click(function() {
		$('.mobile-nav__list').slideToggle(300);
		return false;
	});
	
});