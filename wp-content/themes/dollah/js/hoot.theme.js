jQuery(document).ready(function($) {
	"use strict";

	/*** Init lightslider ***/

	if( 'undefined' == typeof dollahData || 'undefined' == typeof dollahData.lightSlider || 'enable' == dollahData.lightSlider ) {
		if (typeof $.fn.lightSlider != 'undefined') {
			$(".lightSlider").each(function(i){
				var self = $(this),
					settings = {
						item: 1,
						slideMove: 1, // https://github.com/sachinchoolur/lightslider/issues/118
						slideMargin: 0,
						mode: "slide",
						auto: true,
						loop: true,
						slideEndAnimatoin: false,
						slideEndAnimation: false,
						pause: 5000,
						adaptiveHeight: true,
						},
					selfData = self.data(),
					responsiveitem = (parseInt(selfData.responsiveitem)) ? parseInt(selfData.responsiveitem) : 2,
					breakpoint = (parseInt(selfData.breakpoint)) ? parseInt(selfData.breakpoint) : 960,
					customs = {
						item: selfData.item,
						slideMove: selfData.slidemove,
						slideMargin: selfData.slidemargin,
						mode: selfData.mode,
						auto: selfData.auto,
						loop: selfData.loop,
						slideEndAnimatoin: selfData.slideendanimation,
						slideEndAnimation: selfData.slideendanimation,
						pause: selfData.pause,
						adaptiveHeight: selfData.adaptiveheight,
						};
				$.extend(settings,customs);
				if( settings.item >= 2 ) { /* Its a carousel */
					settings.responsive =  [ {	breakpoint: breakpoint,
												settings: {
													item: responsiveitem,
													}
												}, ];
				}
				self.lightSlider(settings);
			});
		}
	}

	/*** Superfish Navigation ***/

	if( 'undefined' == typeof dollahData || 'undefined' == typeof dollahData.superfish || 'enable' == dollahData.superfish ) {
		if (typeof $.fn.superfish != 'undefined') {
			$('.sf-menu').superfish({
				delay: 500,						// delay on mouseout 
				animation: {height: 'show'},	// animation for submenu open. Do not use 'toggle' #bug
				animationOut: {opacity:'hide'},	// animation for submenu hide
				speed: 200,						// faster animation speed 
				speedOut: 'fast',				// faster animation speed
				disableHI: false,				// set to true to disable hoverIntent detection // default = false
			});
		}
	}

	/*** Responsive Navigation ***/

	if( 'undefined' == typeof dollahData || 'undefined' == typeof dollahData.menuToggle || 'enable' == dollahData.menuToggle ) {
		$( '.menu-toggle' ).click( function() {
			if ( $(this).parent().is('.mobilemenu-fixed') )
				$(this).parent().toggleClass( 'mobilemenu-open' );
			else
				$( this ).siblings( '.wrap, .menu-items' ).slideToggle();
			$( this ).toggleClass( 'active' );
		});
		$('body').click(function (e) {
			if (!$(e.target).is('.nav-menu *, .nav-menu'))
				$( '.menu-toggle.active' ).click();
		});
	}

	/*** Header Serach ***/

	var $headerSearchContainer = $('.header-aside-search');
	if ($headerSearchContainer.length) {
		$('.header-aside-search i.fa-search').on('click', function(){
			$headerSearchContainer.addClass('expand');
			$headerSearchContainer.find('input.searchtext').focus();
		});
		$('.header-aside-search .js-search-placeholder').on('click', function(){
			$headerSearchContainer.removeClass('expand');
		});
		$(document).click(function(e) {
			if (!$headerSearchContainer.is(e.target) && $headerSearchContainer.has(e.target).length === 0)
				$headerSearchContainer.removeClass('expand');
		});
	}

	/*** Responsive Videos : Target your .container, .wrapper, .post, etc. ***/

	if( 'undefined' == typeof dollahData || 'undefined' == typeof dollahData.fitVids || 'enable' == dollahData.fitVids ) {
		if (jQuery.fn.fitVids)
			$("#content").fitVids();
	}

	/*** Post Grid, List ***/

	$('.post-grid-widget .post-gridunit-image, .posts-list-widget .posts-listunit-image').each(function(){
		var self = $(this),
			bgimg = self.find('img').attr('src');
		self.css('background-image', 'url("' + bgimg + '")' ).addClass('imgloaded');
	});

});