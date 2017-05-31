jQuery(document).ready(function($) {		
	//Do some changing with header on scroll
	$(window).scroll(function() {
		var scroll = $(window).scrollTop();
		if (scroll >= 110) {
        	$('.site-header').addClass('scroll');
		} else {
			$('.site-header').removeClass('scroll');
		}
	});
		
	$('.home-slider').unslider({
		autoplay: true,
		speed: 1200,
		delay: 8000,
		nav: false,
		animation: 'fade'
	});
	
	//Adding svg arrows to buttons
	$('.btn, .button, button, input[type="button"]').append('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" viewBox="0 0 7 12" xml:space="preserve"><path d="M0,0v3L3.5,6L0,9v3l7-6L0,0z"/></svg>');
	
	//Wrap elements on project pages
	$( '.archive.category-project .aside-gallery, .archive.category-project .archive-description, .archive .category-project.entry' ).wrapAll( '<div class="wrap archive-content" />');
	$( '.archive.category-project .archive-description, .archive .category-residential.entry, .archive .category-commercial.entry, .archive .category-alterations.entry' ).wrapAll( '<aside class="aside-archive" />');
	
});
