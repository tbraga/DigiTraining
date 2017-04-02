(function($) {

	"use strict";
	var Core = {
		initialized: false,
		initialize: function () {

			if (this.initialized)
				return;
			this.initialized = true;
			this.build();
		},
		build: function () {
			// Dropdown menu
			this.cotentslide();
			// Owl carousel init
			this.initOwlCarousel();
			// Stick slider init
			this.initStickSlider();
			// Fixed header
			this.fixedHeader();
			// Progress bar animation
			//this.progressBarAnimation();
			// Wow init
			this.wowInit();
			// Loader
			this.loaderInit();
			// Start video
			//this.startVideo();
			// Toggle search
			this.toggleSearch();
			// Top slider init
			//this.initSliderPro();
		},
		cotentslide: function (options) {

			var scrollPane = $(".scroll-pane"),
					scrollContent = $(".scroll-content");
			//build slider
			var scrollbar = $(".scroll-bar").slider({
				slide: function (event, ui) {
					if (scrollContent.width() > scrollPane.width()) {
						scrollContent.css("margin-left", Math.round(
								ui.value / 100 * (scrollPane.width() - scrollContent.width())
								) + "px");
					} else {
						scrollContent.css("margin-left", 0);
					}
				}
			});
			//append icon to handle
			var handleHelper = scrollbar.find(".ui-slider-handle")
					.mousedown(function () {
						scrollbar.width(handleHelper.width());
					})
					.mouseup(function () {
						scrollbar.width("100%");
					})
					.append("<span class='ui-icon ui-icon-grip-dotted-vertical'></span>")
					.wrap("<div class='ui-handle-helper-parent'></div>").parent();
			//change overflow to hidden now that slider handles the scrolling
			scrollPane.css("overflow", "hidden");
			//size scrollbar and handle proportionally to scroll distance
			function sizeScrollbar() {
				var remainder = scrollContent.width() - scrollPane.width();
				var proportion = remainder / scrollContent.width();
				var handleSize = scrollPane.width() - (proportion * scrollPane.width());
				scrollbar.find(".ui-slider-handle").css({
					width: handleSize,
					"margin-left": -handleSize / 2
				});
				handleHelper.width("").width(scrollbar.width() - handleSize);
			}

			//change handle position on window resize
			$(window).resize(function () {
				sizeScrollbar();
			});
			//init scrollbar size
			setTimeout(sizeScrollbar, 10); //safari wants a timeout

		},
		initStickSlider: function (options) {
			$(".enable-stick-slider").each(function (i) {
				var $stick = $(this);
				$stick.slick({
					responsive: [
						{
							breakpoint: 500,
							settings: {
								slidesToShow: 1,
								slidesToScroll: 1
							}
						}
					]
				});
			});

		},
		initOwlCarousel: function (options) {

			$(".enable-owl-carousel").each(function (i) {
				var $owl = $(this);
				var navigationData = $owl.data('navigation');
				var paginationData = $owl.data('pagination');
				var singleItemData = $owl.data('single-item');
				var autoPlayData = $owl.data('auto-play');
				var transitionStyleData = $owl.data('transition-style');
				var mainSliderData = $owl.data('main-text-animation');
				var afterInitDelay = $owl.data('after-init-delay');
				var stopOnHoverData = $owl.data('stop-on-hover');
				var min600 = $owl.data('min600');
				var min800 = $owl.data('min800');
				var min1200 = $owl.data('min1200');
				$owl.owlCarousel({
					navigation: navigationData,
					pagination: paginationData,
					singleItem: singleItemData,
					autoPlay: autoPlayData,
					transitionStyle: transitionStyleData,
					stopOnHover: stopOnHoverData,
					navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
					itemsCustom: [
						[0, 1],
						[600, min600],
						[800, min800],
						[1200, min1200]
					],
					afterInit: function (elem) {
						if (mainSliderData) {
							setTimeout(function () {
								$('.main-slider_zoomIn').css('visibility', 'visible').removeClass('zoomIn').addClass('zoomIn');
								$('.main-slider_fadeInLeft').css('visibility', 'visible').removeClass('fadeInLeft').addClass('fadeInLeft');
								$('.main-slider_fadeInLeftBig').css('visibility', 'visible').removeClass('fadeInLeftBig').addClass('fadeInLeftBig');
								$('.main-slider_fadeInRightBig').css('visibility', 'visible').removeClass('fadeInRightBig').addClass('fadeInRightBig');
							}, afterInitDelay);
						}
					},
					beforeMove: function (elem) {
						if (mainSliderData) {
							$('.main-slider_zoomIn').css('visibility', 'hidden').removeClass('zoomIn');
							$('.main-slider_slideInUp').css('visibility', 'hidden').removeClass('slideInUp');
							$('.main-slider_fadeInLeft').css('visibility', 'hidden').removeClass('fadeInLeft');
							$('.main-slider_fadeInRight').css('visibility', 'hidden').removeClass('fadeInRight');
							$('.main-slider_fadeInLeftBig').css('visibility', 'hidden').removeClass('fadeInLeftBig');
							$('.main-slider_fadeInRightBig').css('visibility', 'hidden').removeClass('fadeInRightBig');
						}
					},
					afterMove: sliderContentAnimate,
					afterUpdate: sliderContentAnimate,
				});
			});
			function sliderContentAnimate(elem) {
				var $elem = elem;
				var afterMoveDelay = $elem.data('after-move-delay');
				var mainSliderData = $elem.data('main-text-animation');
				if (mainSliderData) {
					setTimeout(function () {
						$('.main-slider_zoomIn').css('visibility', 'visible').addClass('zoomIn');
						$('.main-slider_slideInUp').css('visibility', 'visible').addClass('slideInUp');
						$('.main-slider_fadeInLeft').css('visibility', 'visible').addClass('fadeInLeft');
						$('.main-slider_fadeInRight').css('visibility', 'visible').addClass('fadeInRight');
						$('.main-slider_fadeInLeftBig').css('visibility', 'visible').addClass('fadeInLeftBig');
						$('.main-slider_fadeInRightBig').css('visibility', 'visible').addClass('fadeInRightBig');
					}, afterMoveDelay);
				}
			}
		},
		fixedHeader: function (options) {
            
			if ($(window).width() > 767) {
				// Fixed Header
				var topOffset = $(window).scrollTop();
				if (topOffset > 0) {
					$('body').addClass('fixed-header');
				}
				$(window).on('scroll', function () {
					var fromTop = $(this).scrollTop();
					if (fromTop > 0) {
						$('body').addClass('fixed-header');
					} else {
						$('body').removeClass('fixed-header');
					}

				});
			}
            
            
            $( window ).resize(function() {
  
                
                	if ($(window).width() > 767) {
				// Fixed Header
				var topOffset = $(window).scrollTop();
				if (topOffset > 0) {
					$('body').addClass('fixed-header');
				}
				$(window).on('scroll', function () {
					var fromTop = $(this).scrollTop();
					if (fromTop > 0) {
						$('body').addClass('fixed-header');
					} else {
						$('body').removeClass('fixed-header');
					}

				});
			}
            
            
                
          });
            
            
            
            
		},
        
        
		wowInit: function () {
			var scrollingAnimations = $('body').data("scrolling-animations");
			if (scrollingAnimations) {
				new WOW().init();
			}
		},
		loaderInit: function () {
			$(window).on('load', function () {
				var $preloader = $('#page-preloader'),
						$spinner = $preloader.find('.spinner');
				$spinner.fadeOut();
				$preloader.delay(350).fadeOut(800);
			});
		},
		toggleSearch: function () {
			$(document).on('click', "#search-open, #search-close", function () {
				$('.header').toggleClass('search-open');
			});
		},
	};
	Core.initialize();

	/////////////////////////////////////
	//  Chars Start
	/////////////////////////////////////

	$('.chart').onScreen({
		container: window,
		direction: 'vertical',
		tolerance: 100,
		doIn: function () {
			$(this).easyPieChart({
				barColor: false,
				trackColor: false,
				scaleColor: false,
				scaleLength: false,
				lineCap: false,
				lineWidth: false,
				size: false,
				animate: 7000,


				onStep: function(from, to, percent) {

					$(this.el).find('.percent').text(Math.round(percent));

				}

			});
		}
	});

	/****** FLICKR STARTS */
	$('.basicuse').each(function(){
		var elbrusFlickrLimit = $(this).attr('data-limit'),
			elbrusFlickrId = $(this).attr('data-id');

		$(this).jflickrfeed({
			limit: elbrusFlickrLimit,
			qstrings: {
				id: elbrusFlickrId
			},
			itemTemplate: '<li><a href="{{image_b}}" rel="prettyPhoto[flickr-'+elbrusFlickrId+']"><img src="{{image_s}}" alt="{{title}}" /></a></li>',
			itemCallback: function() {
				prettyPhoto({
					changepicturecallback: function() {
						$('.pp_pic_holder').show();
					}
				});
			}

		});
	});

	/****** FLICKR ENDS */

	/****** LOAD TIMELINE STARTS */

	$('.plus-ico').click( function() {
		var x = $('.container-timeline').children('.hidden:first');
		$(x).removeClass('hidden');
		if ( !x.next('.hidden').length ) {
			$(this).text('').addClass('inactive');
		}
	});

	/****** LOAD TIMELINE ENDS */


	/****** VC SECTION ANCHOR FULL-WIDTH STARTS */


	function fullWidthSection() {

		var windowWidth = $(window).width();
		var widthContainer = $('.container').width();

		var fullWidth1 = windowWidth - widthContainer;
		var fullWidth2 = fullWidth1 / 2;

		$('.js_stretch_anchor').css("width", windowWidth);
		$('.js_stretch_anchor').css("margin-left", -fullWidth2);


	}

	fullWidthSection();
	$(window).resize(function() {
		fullWidthSection()
	});

	/****** VC SECTION ANCHOR FULL-WIDTH ENDS */



	$(window).load(function() {

		console.log('contact us');

		jQuery("#menu-item-855").click(function(e) {
			e.preventDefault();
			jQuery('html, body').animate({
				scrollTop: jQuery('.contact-us-section').offset().top - 114
			}, 1000);		
		});

		/****** ISOTOP STARTS */

		var blog_container = $('.blog-masonry-holder');

		blog_container.imagesLoaded(function() {
			blog_container.isotope({
				// options
				itemSelector: '.item',
				layoutMode: 'masonry',
			});
		});

		var portfolio_container = $('.portfolio-masonry-holder');

		portfolio_container.imagesLoaded(function() {
			portfolio_container.isotope({
				// options
				itemSelector: '.item',
				layoutMode: 'masonry',
			});
		});

		$('.folio-isotop-filter a').on( 'click', function() {

			var container = $('.portfolio-masonry-holder');
			var filterValue = $(this).attr('data-filter');

			//don't proceed if already selected
			if ($(this).hasClass('selected')) {
				return false;
			}
			var $portfolio_optionSet = $(this).parents('.folio-option-set');
			$portfolio_optionSet.find('.selected').removeClass('selected');
			$(this).addClass('selected');

			filterValue = filterValue === 'false' ? false : filterValue;
			portfolio_container.isotope({ filter: filterValue });
			return false;
		});

		/****** ISOTOP ENDS */

	});

	/****** PRETTYPHOTO */

	function prettyPhoto(){
		"use strict";

		$('a[data-rel]').each(function() {
			$(this).attr('rel', $(this).data('rel'));
		});

		$("a[rel^='prettyPhoto']").prettyPhoto({
			animation_speed: 'normal', /* fast/slow/normal */
			slideshow: false, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: false, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			horizontal_padding: 0,
			default_width: 680,
			default_height: 495,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			deeplinking: false,
			social_tools: false,
			iframe_markup: '<iframe src ="{path}" allowfullscreen="true"  width="{width}" height="{height}" frameborder="no"></iframe>'
		});
	}
	prettyPhoto();


	/****** LOAD MORE PORTFOLIO STARTS */

	function loadMore() {
		"use strict";

		$('.load-more a').on('click', function(e)  {
			e.preventDefault();

			var current_page = $(this).parent().attr('data-current');
			var max_pages = $(this).parent().attr('data-max-pages');
			var wrapper_id = '#'+$(this).parents('.portfolio-list-section').attr('id');
			var link = $(this).attr('href');
			var $container = wrapper_id+' .portfolio-masonry-holder';
			var container = $($container);
			var $anchor = wrapper_id+' .portfolio-pagination .load-more a';
			var next_href = $(this).attr('href'); // Get URL for the next set of posts
			var btn = $(this);

			var load_more_holder = $(this).parents('.portfolio-pagination');
			var loading_holder   = $(this).parents('.portfolio-pagination').next();

			load_more_holder.hide();
			loading_holder.show();

			$('.folio-isotop-filter li').find('.selected').removeClass('selected');
			$('.folio-isotop-filter ul li:first a').addClass('selected');

			container.isotope({ filter: '*' });

			$.get(link+'', function(data){

				console.log(wrapper_id);

				var new_content = $($container, data).wrapInner('').html(); // Grab just the content
				next_href = $($anchor, data).attr('href'); // Get the new href

				$(container, data).waitForImages(function() {

					container.append( new_content );
					// trigger isotope again after images have been loaded
					container.imagesLoaded( function() {
						container.isotope( 'reloadItems' ).isotope({ sortBy: 'original-order' });
					});

					container.children().removeClass('wow');

					prettyPhoto();
					current_page++;

					if( max_pages > current_page ) {
						btn.attr('href', next_href); // Change the next URL
					} else {
						btn.parent().remove();
					}

					container.children('.portfolio-pagination:last').remove(); // Remove the original navigation

					load_more_holder.show();
					loading_holder.hide();

					btn.parent().attr('data-current', current_page);
				});

			});
		});
	}
	loadMore();

	/****** LOAD MORE PORTFOLIO ENDS */

	// main menu
	 $(".dropdown").hover(
		function() {
			$('.wrap-inside-nav', this).stop(true, true).slideDown("fast");
			$(this).toggleClass('open');
		},
		function() {
			$('.wrap-inside-nav', this).stop(true, true).slideUp("fast");
			$(this).toggleClass('open');
		}
	);


	$(".navbar-with-inside>li").hover(
		function() {
			$(this).children('.wrap-inside-nav').fadeIn("fast");
		},
		function() {
			$(this).children('.wrap-inside-nav').fadeOut("fast");
	});

	// mobile sidebar nav menu
	$( '.navbar-with-inside li:has(ul)' ).doubleTapToGo();


	// Yellow Pencil: Visual CSS Style Editor
	function is_yellow_pencil() {
		if ($("body").hasClass("yp-yellow-pencil")) {
			return true;
		} else {
			return false;
		}
	}


}(jQuery));