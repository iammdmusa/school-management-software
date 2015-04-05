$(document).ready(function () {

	/* Add border to images */
	$('article a img, .gallery .slider_content img, .results a img, img.add_border, .description .main_image img, .similar_hotels .thumb img, .results_wide .thumb img').each( function () {
		$(this).wrap('<span class="with_border" />');
		$(this).before(
			'<span></span>'
		);
	});

	/* Search form selection */
	$('.search h2 span').click(function () {
		$('.search h2 span').removeClass('selected');
		$(this).addClass('selected')
		$('.search form').css('display', 'none');
		$('.search form[data-form="' + $(this).attr('data-form') + '"]').css('display', 'block');
	});

	/* Slider navigation */
	$('.slider_nav a').click(function (e) {
		e.preventDefault();
	});

	/* Sidebar image slider */
	$('.image_slider').each(function () {

		/* Functions */
		function resetInterval () {
			clearInterval(imageSliderInterval);
			imageSliderInterval = setInterval(next, 8000);
		}
		function next () {
			$('.image_slider .slides').children(':last').fadeOut(1000, function () {
				$(this).prependTo('.image_slider .slides').fadeIn(1);
			});
		}
		function previous () {
			$('.image_slider .slides').children(':last').fadeOut(1000, function () {
				$(this).prependTo('.image_slider .slides').fadeIn(1);
			});
		}

		/* Initialize */
		var imageSliderInterval;
		resetInterval();

		/* Controls */
		$('.image_slider .left').click(function () {
			next();
			resetInterval();
		});
		$('.image_slider .right').click(function () {
			previous();
			resetInterval();
		});

	});

	/* Gallery slider */
	$('.gallery').each(function () {

		/* Functions */
		function resetInterval () {
			clearInterval(gallerySliderInterval);
			gallerySliderInterval = setInterval(next, 8000);
		}
		function next () {
			$('.gallery .slider_content').animate({left: '-150px'}, 1500, function () {
				$('.gallery .slider_content').css({left: '0px'}).children(':first').remove().appendTo($('.gallery .slider_content'));
				$('.gallery .slider_content a').fancybox(); // Reinitialize Fancybox
			});
		}
		function previous () {
			$('.gallery .slider_content').css({left: '-=150px'}).children(':last').remove().prependTo($('.gallery .slider_content'));
			$('.gallery .slider_content a').fancybox(); // Reinitialize Fancybox
			$('.gallery .slider_content').stop().animate({left: '0px'}, 1500);
		}

		/* Initialize */
		var gallerySliderInterval;
		resetInterval();

		/* Controls */
		$('.gallery .left').click(function () {
			previous();
			resetInterval();
		});
		$('.gallery .right').click(function () {
			next();
			resetInterval();
		});

	});

	/* Homepage slider */
	$('.homepage_slider').each(function () {

		/* Functions */
		function resetInterval () {
			clearInterval(gallerySliderInterval);
			gallerySliderInterval = setInterval(next, 8000);
		}
		function next () {
			$('.homepage_slider').animate({left: '-880px'}, 1000, function () {
				$('.homepage_slider').css({left: '0px'}).children(':first').remove().appendTo($('.homepage_slider'));
			});
		}
		function previous () {
			$('.homepage_slider').css({left: '-880px'}).children(':last').remove().prependTo($('.homepage_slider'));
			$('.homepage_slider').animate({left: '0px'}, 1000);
		}

		/* Initialize */
		var gallerySliderInterval;
		resetInterval();

		/* Controls */
		$('header .slider_nav .left').click(function () {
			previous();
			resetInterval();
		});
		$('header .slider_nav .right').click(function () {
			next();
			resetInterval();
		});

	});

	/* Fancybox */
	$('.gallery .slider_content a').fancybox();
	$('.image_slider .slides a').fancybox();
	$('a.fancybox').fancybox();

	/* Datepicker */
	$('input.date').datepicker();

	/* Autocomplete */
	$('input[name="destination"]').autocomplete({
		source: [
			'All',
			'USA',
			'Canada',
			'Singapore',
			'France',
			'Italy',
			'Spain',
			'Greece',
			'Egypt',
			'United Kingdom',
			'Thailand'
		]
	});
	$('input[name="transportation"]').autocomplete({
		source: [
			'Plane',
			'Bus',
			'Ship',
			'Car'
		]
	});


	/* Contact form */
	$('#contact_form').submit(function () {
		$.ajax({
			type: 'POST',
			url: 'contact.php',
			data: {
				name: $('#contact_form input[type=text]').val(),
				email: $("#contact_form input[type=email]").val(),
				text: $("#contact_form textarea").val()
			},
			success: function(data) {
				if ( data == 'sent' ) {
					$('#contact_form .status').html('E-mail has been sent.');
				} else if ( data == 'invalid' ) {
					$('#contact_form .status').html('Your name, email or message is invalid.');
				} else {
					$('#contact_form .status').html('E-mail could not be sent.');					
				}
			},
			error: function () {
				$('#contact_form .status').html('E-mail could not be sent.');
			}
		});
		return false;
	});

});