jQuery(function ($) {
    'use strict';
    
    // Mean Menu JS
	jQuery('.mean-menu').meanmenu({ 
		meanScreenWidth: "991"
	});

	// START MENU JS
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 50) {
            $('.navbar-area').addClass('is-sticky');
        } else {
            $('.navbar-area').removeClass('is-sticky');
        }
    });			
 
    $('.navbar-nav .nav-item .nav-link').on('click', function(e){
        var anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $(anchor.attr('href')).offset().top - 50
        }, 1500);
        e.preventDefault();
    });
   
    $(document).on('click','.navbar-collapse.active',function(e) {
        if( $(e.target).is('a') && $(e.target).attr('class') != 'dropdown-toggle' ) {
            $(this).collapse('hide');
        }
    });	

    $('.navbar .navbar-nav li a').on('click', function(){
		$('.navbar-collapse').removeClass('active');
	});

    // Navbar Toggler
    $(".navbar-toggler").on('click',  function() {
        $('.collapse.navbar-collapse').toggleClass('active');
    });
    
    // Footer and Copyright Click Animate JS
    $('div .default-link-animate ul li a').on('click', function(e){
        var anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $(anchor.attr('href')).offset().top - 50
        }, 1500);
        e.preventDefault();
    });

    // PRELOADER
	jQuery(window).on('load',function(){
		jQuery(".loader").fadeOut(500);
	});

    // Popup youtube JS
	$('.popup-youtube').magnificPopup({
		disableOn: 320,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,

		fixedContentPos: false
	});

    // Feature Slider JS
	$('.soft-feature-slider').owlCarousel({
		loop:true,
		margin: 10,
        nav: false,
		dots: true,
		smartSpeed: 1000,
		autoplay:true,
		autoplayTimeout:4000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:2,
            },
            1000:{
                items:3,
            }
        }
    });

    // Offer Slider JS
	$('.soft-offer-slider').owlCarousel({
        rtl:true,
		loop:true,
		margin: 15,
        nav: true,
		dots: false,
		smartSpeed: 1000,
		autoplay:true,
		autoplayTimeout:4000,
        autoplayHoverPause:true,
        navText: [
			"<i class='bx bx-chevron-left'></i>",
			"<i class='bx bx-chevron-right'></i>"
        ],
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:3,
            },
            1000:{
                items:5,
            }
        }
	});
    
    // Sidebar Modal
    $ (document).ready (function () {
        $ (".modal a").not (".dropdown-toggle").on ("click", function () {
            $ (".modal").modal ("hide");
        });
    });

    // Nice Select JS
    $('select').niceSelect();
    
    // People Slider JS
    $('.host-people-slider').on('initialized.owl.carousel changed.owl.carousel', function(e) {
        if (!e.namespace)  {
        return;
        }
        var carousel = e.relatedTarget;
        $('.slider-counter').text(carousel.relative(carousel.current()) + 1 + '/' + carousel.items().length);
    })
    .owlCarousel({
        loop:true,
        margin: 15,
        stagePadding: 80,
        nav: true,
        dots: false,
        smartSpeed: 1000,
        autoplay:true,
        autoplayTimeout:4000,
        autoplayHoverPause:true,
        navText: [
			"<i class='bx bx-left-arrow-alt'></i>",
			"<i class='bx bx-right-arrow-alt'></i>"
        ],
        responsive:{
            0:{
                items:1,
                stagePadding: 20,
            },
            600:{
                items:2,
            },
            1000:{
                items:3,
            }
        }
    });

    // User Slider JS
    $('.ride-user-slider').on('initialized.owl.carousel changed.owl.carousel', function(e) {
        if (!e.namespace)  {
        return;
        }
        var carousel = e.relatedTarget;
        $('.slider-counter').text(carousel.relative(carousel.current()) + 1 + '/' + carousel.items().length);
    })
    .owlCarousel({
        items: 1,
        loop:true,
        margin: 15,
        nav: true,
        dots: false,
        smartSpeed: 1000,
        autoplay:true,
        autoplayTimeout:4000,
        autoplayHoverPause:true,
        navText: [
            "<i class='bx bx-left-arrow-alt'></i>",
            "<i class='bx bx-right-arrow-alt'></i>"
        ],
    });

    // Search Box JS
    $('.search-toggle').addClass('closed');

    $('.search-toggle .search-icon').click(function(e) {
        if ($('.search-toggle').hasClass('closed')) {
        $('.search-toggle').removeClass('closed').addClass('opened');
        $('.search-toggle, .search-area').addClass('opened');
        $('#search-terms').focus();
        } else {
        $('.search-toggle').removeClass('opened').addClass('closed');
        $('.search-toggle, .search-area').removeClass('opened');
        }
    });

    // Company Logo Slider JS
	$('.company-logo-slider').owlCarousel({
		loop:true,
		margin: 10,
        nav: false,
		dots: false,
		smartSpeed: 1000,
		autoplay:true,
		autoplayTimeout:4000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:2,
            },
            600:{
                items:3,
            },
            1000:{
                items:5,
            }
        }
    });

    // Charity Cause Slider JS
	$('.charity-cause-slider').owlCarousel({
        loop:true,
		margin: 0,
        nav: false,
		dots: true,
		smartSpeed: 1000,
		autoplay:true,
		autoplayTimeout:4000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:2,
            },
            1000:{
                items:3,
            }
        }
    });

    // Charity Team Slider JS
	$('.charity-team-slider').owlCarousel({
        loop:true,
		margin: 0,
        nav: false,
		dots: true,
		smartSpeed: 1000,
		autoplay:true,
		autoplayTimeout:4000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:2,
            },
            1000:{
                items:3,
            }
        }
    });

    // Charity Testimonial Slider JS
    $('.charity-testimonial-slider').on('initialized.owl.carousel changed.owl.carousel', function(e) {
        if (!e.namespace)  {
        return;
        }
        var carousel = e.relatedTarget;
        $('.slider-counter').text(carousel.relative(carousel.current()) + 1 + '/' + carousel.items().length);
    })
    .owlCarousel({
        items: 1,
        loop:true,
        margin: 15,
        nav: true,
        dots: false,
        smartSpeed: 1000,
        autoplay:true,
        autoplayTimeout:4000,
        autoplayHoverPause:true,
        navText: [
            "<i class='bx bx-left-arrow-alt'></i>",
            "<i class='bx bx-right-arrow-alt'></i>"
        ],
    });

    // Charity Wide Slider JS
	$('.charity-wide-slider').owlCarousel({
        items: 1,
        loop:true,
		margin: 0,
        nav: true,
		dots: false,
		smartSpeed: 1000,
		autoplay:true,
		autoplayTimeout:4000,
        autoplayHoverPause:true,
        navText: [
            "<i class='bx bx-left-arrow-alt'></i>",
            "<i class='bx bx-right-arrow-alt'></i>"
        ],
    });

    // Progress Bar JS
    $(".progress-bar").loading();

    // Screenshoot Slider JS
    $('.center').slick({
        centerMode: true,
        centerPadding: '60px',
        slidesToShow: 5,
        focusOnSelect: true,
        autoplay:true,
		autoplaySpeed:3000,
        pauseOnHover:true,
        
        responsive: [
          {
            breakpoint: 768,
            settings: {
              arrows: false,
              centerMode: true,
              centerPadding: '40px',
              slidesToShow: 3
            }
          },
          {
            breakpoint: 480,
            settings: {
              arrows: false,
              centerMode: true,
              centerPadding: '40px',
              slidesToShow: 1
            }
          }
        ]
    });

    // Slick Slider JS
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
		fade: true,
        asNavFor: '.slider-nav'
    });
	$('.slider-nav').slick({
		slidesToShow: 5,
		slidesToScroll: 1,
		asNavFor: '.slider-for',
		dots: false,
		focusOnSelect: true,
		prevArrow: false,
		nextArrow: false,
		centerMode: true,
		focusOnSelect: true,
		variableWidth: true,
		responsive: [
		    {
		        breakpoint: 3000,
		        setting: {
		            slidesToShow: 3
		        }
		    },
		    {
		        breakpoint: 1400,
		        setting: {
		            slidesToShow: 2
		        }

		    },
		    {
		        breakpoint: 800,
		        setting: {
		            slidesToShow: 1
		        }

		    }
		]
	});

    // Accordion JS
    $('.accordion > li:eq(0) a').addClass('active').next().slideDown();
    $('.accordion a').click(function(j) {
        var dropDown = $(this).closest('li').find('p');
        $(this).closest('.accordion').find('p').not(dropDown).slideUp();
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $(this).closest('.accordion').find('a.active').removeClass('active');
            $(this).addClass('active');
        }
        dropDown.stop(false, true).slideToggle();
        j.preventDefault();
    });

    // Export Service Slider JS
	$('.export-service-slider').owlCarousel({
        center: true,
        loop:true,
		margin: 0,
        nav: false,
		dots: true,
		smartSpeed: 1000,
		autoplay:true,
		autoplayTimeout:4000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:2,
            },
            1000:{
                items:3,
            }
        }
    });

    //Wow JS
    new WOW().init();

    // Export Testimonial Slider JS
	$('.export-testimonial-slider').owlCarousel({
        loop:true,
		margin: 15,
        nav: false,
		dots: false,
		smartSpeed: 1000,
		autoplay:true,
		autoplayTimeout:4000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:2,
            },
            1000:{
                items:2,
            }
        }
    });

    let elm = document.getElementById("days");
    if(elm){

        const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24;
    
        let countDown = new Date('Jan 01, 2022 00:00:00').getTime(),
        x = setInterval(function() {
    
        let now = new Date().getTime(),
            distance = countDown - now;
    
        document.getElementById('days').innerText = Math.floor(distance / (day)),
            document.getElementById('hours').innerText = Math.floor((distance % (day)) / (hour)),
            document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute)),
            document.getElementById('seconds').innerText = Math.floor((distance % (minute)) / second);
        }, second)
    };

    // Swiper Slider JS
    var swiper = new Swiper('.swiper-container', {
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
          renderBullet: function (index, className) {
            return '<span class="' + className + '">' + (index + 1) + '</span>';
          },
        },
    });

    // Event Blog Slider JS
	$('.event-blog-slider').owlCarousel({
        loop:true,
		margin: 0,
        nav: false,
		dots: true,
		smartSpeed: 1000,
		autoplay:true,
		autoplayTimeout:4000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:2,
            },
            1000:{
                items:3,
            }
        }
    });

    // SEO Banner Slider JS
	$('.seo-banner-slider').owlCarousel({
        loop:true,
		margin: 10,
        nav: true,
		dots: false,
		smartSpeed: 1000,
		autoplay:true,
		autoplayTimeout:4000,
        autoplayHoverPause:true,
        navText: [
			"<i class='bx bx-chevron-left'></i>",
			"<i class='bx bx-chevron-right'></i>"
        ],
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:2,
            },
            800:{
                items:3,
            },
            900:{
                items:4,
            },
            1000:{
                items:4,
            }
        }
    });

    // Tabs JS
	$('.tab ul.tabs').addClass('active').find('> li:eq(0)').addClass('current');
	$('.tab ul.tabs li').on('click', function (g) {
		var tab = $(this).closest('.tab'), 
		index = $(this).closest('li').index();
		tab.find('ul.tabs > li').removeClass('current');
		$(this).closest('li').addClass('current');
		tab.find('.tab_content').find('div.tabs_item').not('div.tabs_item:eq(' + index + ')').slideUp();
		tab.find('.tab_content').find('div.tabs_item:eq(' + index + ')').slideDown();
		g.preventDefault();
    });
    
    // Input Plus & Minus Number JS
	$('.input-counter').each(function() {
		var spinner = jQuery(this),
		input = spinner.find('input[type="text"]'),
		btnUp = spinner.find('.plus-btn'),
		btnDown = spinner.find('.minus-btn'),
		min = input.attr('min'),
		max = input.attr('max');
		
		btnUp.on('click', function() {
			var oldValue = parseFloat(input.val());
			if (oldValue >= max) {
				var newVal = oldValue;
			} else {
				var newVal = oldValue + 1;
			}
			spinner.find("input").val(newVal);
			spinner.find("input").trigger("change");
		});
		btnDown.on('click', function() {
			var oldValue = parseFloat(input.val());
			if (oldValue <= min) {
				var newVal = oldValue;
			} else {
				var newVal = oldValue - 1;
			}
			spinner.find("input").val(newVal);
			spinner.find("input").trigger("change");
		});
	});

    // Subscribe form
	$(".newsletter-form").validator().on("submit", function (event) {
		if (event.isDefaultPrevented()) {
		// handle the invalid form...
		formErrorSub();
		submitMSGSub(false, "Please enter your email correctly.");
		} else {
		// everything looks good!
		event.preventDefault();
		}
	});
	function callbackFunction (resp) {
		if (resp.result === "success") {
		formSuccessSub();
		}
		else {
		formErrorSub();
		}
	}
	function formSuccessSub(){
		$(".newsletter-form")[0].reset();
		submitMSGSub(true, "Thank you for subscribing!");
		setTimeout(function() {
		$("#validator-newsletter").addClass('hide');
		}, 4000)
	}
	function formErrorSub(){
		$(".newsletter-form").addClass("animated shake");
		setTimeout(function() {
		$(".newsletter-form").removeClass("animated shake");
		}, 1000)
	}
	function submitMSGSub(valid, msg){
		if(valid){
		var msgClasses = "validation-success";
		} else {
		var msgClasses = "validation-danger";
		}
		$("#validator-newsletter").removeClass().addClass(msgClasses).text(msg);
	}
	
	// AJAX MailChimp
	$(".newsletter-form").ajaxChimp({
		url: "https://envytheme.us20.list-manage.com/subscribe/post?u=60e1ffe2e8a68ce1204cd39a5&amp;id=42d6d188d9", // Your url MailChimp
		callback: callbackFunction
    });
    
    
}(jQuery));
