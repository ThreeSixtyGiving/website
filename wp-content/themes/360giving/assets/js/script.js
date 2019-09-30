jQuery(document).ready(function($){

	// Sliders
	if ( $('.header-banner ul.slider li').length > 0 ) {
		$('.header-banner ul.slider').slick({
			dots: false,
			arrows: true,
			responsive: [
				{
					breakpoint: 580,
					settings: {
						arrows: false,
						dots: true
					}
				}
			]
		});
	}
	if ( $('.content-slider').length > 0 ) {
		$('.content-slider').slick();
	}

	// Search
	$('.search-toggle').on('click', function(e){
		e.preventDefault();
		$('.search-wrapper').toggleClass('search-active');
		$(this).find('i').toggleClass('fa-search-minus')
	})

	// Expand Button
	function expandCollapse() {
		var button = $('.collapse-btn');
		var closed = button.data('closed');
		var open = button.data('open');

		setTimeout(function(){
			if (button.attr('aria-expanded') === 'false') {
				button.text(closed);
			} else {
				button.text(open);
			}
		}), 100;
	}
	expandCollapse();
	$('.collapse-btn').on('click', function(){
		expandCollapse();
	});

	// Headroom
	var header = document.querySelector('.site-header');
	var headroom = new Headroom(header, {
		offset : 120
	});
	//headroom.init();

	// Wrap iFrames
	$('iframe').wrap('<div class="iframe-wrapper"/>');

	// Countup
	if ($('.stats').length) {
		var options = {
			useGrouping : true,
			separator : ',',
			decimal : '.',
			prefix : '',
			suffix : '',
		};

		var stat_1 = new CountUp('stat-1', 0, $('#stat-1').text(), 0, 4, options);
		var stat_2 = new CountUp('stat-2', 0, $('#stat-2').text(), 0, 4, options);
		var stat_3 = new CountUp('stat-3', 0, $('#stat-3').text(), 0, 4, options);
		var stat_4 = new CountUp('stat-4', 0, $('#stat-4').text(), 0, 4, options);


		$(window).scroll(function(){

			var windowHeight  = $(window).height() - 200;
			var distance      = ($('.stats').offset().top - $(window).scrollTop());

			if (distance < windowHeight) {
				stat_1.start();
				stat_2.start();
				stat_3.start();
				stat_4.start();
			}

		});
	}

	$('#offcanvas-menu nav>ul.uk-nav>li.menu-item-has-children').append('<span class="show-subnav"><i class="fa fa-angle-right"></i></span>');
	$('.show-subnav').on('click', function(){
		$(this).prev('ul').slideToggle();
		$(this).find('i').toggleClass('fa-angle-right');
		$(this).find('i').toggleClass('fa-angle-down');
	});

	// Timeline
	$(function () {
		$('.timeline a[href*=#]:not([href=#])').click(function () {
			$(".timeline-nav li").removeClass('active');
			$(this).parents('li').addClass('active');
			if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[id=' + this.hash.slice(1) + ']');
				if (target.length) {
					$('html,body').animate({
						scrollTop: target.offset().top - 40
					}, 700);
					return false;
				}
			}
		});
	});

});

// Timeline Nav
if (jQuery('.timeline').length) {
	timelineTop = jQuery('.timeline').offset().top,
	timelineRight = jQuery(window).width() - (jQuery('.timeline-nav').offset().left + jQuery('.timeline-nav').width());
	jQuery(window).scroll(function() {
		if (jQuery(this).scrollTop() > timelineTop) {
			jQuery('.timeline-nav').addClass('fix-nav');
			jQuery('.timeline-nav').css('right', timelineRight);
		} else {
			jQuery('.timeline-nav').removeClass('fix-nav');
		}
	});
}