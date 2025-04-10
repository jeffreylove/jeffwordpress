/*
WordPress Hack
----------------------------------
Wrap all document in to following.
jQuery(document).ready(function($) {
	...
});
*/
jQuery(document).ready(function($) {

$(document).ready(function(e) {
/* To add and remove active class on clicked li of navigation. */
var selector = 'nav li';

$(selector).on('click', function(){
    $(selector).removeClass('active');
    $(this).addClass('active');
});
/* END */

/* To add class first and last on first and last of all li. */
$('ul').children('li:first-child').addClass('first');
$('ul').children('li:last-child').addClass('last');
/* END */

});
/*Bootstrap menu on hover*/
// Bootstrap menu magic
  /*$(window).resize(function() {
    if ($(window).width() < 768) {
      $(".dropdown-toggle").attr('data-toggle', 'dropdown');
    } else {
      $(".dropdown-toggle").removeAttr('data-toggle dropdown');
    }
  });*/
/*Bootstrap menu on hover*/
/* === Sticky Menu Removed === */
    // Sticky navbar functionality removed as requested
			

			// Search
	jQuery( '#search-button' ).click( function () {
		console.log( "Open Search, Search Centered" );
		$( "div.mk-fullscreen-search-overlay" ).addClass( "mk-fullscreen-search-overlay-show" );
	} );
	jQuery( "a.mk-fullscreen-close" ).click( function () {
		console.log( "Closed Search" );
		$( "div.mk-fullscreen-search-overlay" ).removeClass( "mk-fullscreen-search-overlay-show" );
	} );
/*Search End*/
	
	// Home Page Featured Blog Slider JS Starts	

	$(document).ready(function() {
  // Swiper: Slider
      new Swiper('.blogSwiper-container', {
          loop: false,
          navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
         },
      speed: 0, // Disabled animations by setting speed to 0
        autoplay: false, // Disabled autoplay
		  pagination: {
            el: '.swiper-pagination',
            clickable: true,
            renderBullet: function (index, className) {
              return `<span class="outer-dot swiper-pagination-bullet"><span class="inner-dot"></span></span>`;
            },
          },
          slidesPerView:1,
          paginationClickable: true,
          spaceBetween: 20,
          effect: 'fade', // Use fade effect for no sliding animation
          fadeEffect: {
            crossFade: false // Disable crossfade effect
          },
          initialSlide: 0, // Start with the first slide
          simulateTouch: false // Disable touch simulation
      });
  });
	
	
$(".single-blog").click(function(){
	const clickedElement =$(this).find( "a" ).attr("href");
	window.location.href =  clickedElement;
  
});
	
	
	
});