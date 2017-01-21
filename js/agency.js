// Agency Theme JavaScript

(function($) {
    "use strict"; // Start of use strict

    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    });  
    
    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this); 
				if ($(this).attr('data-target') != '#') {       
        var url = $anchor.attr('href'), hash = "#" + url.split('#')[1];        
             alert(hash);
	        $('html, body').stop().animate({
							scrollTop: ($(hash).offset().top - 50)
	        }, 1250, 'easeInOutExpo'); 
        event.preventDefault();  
				}
    });  
 
    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function(){ 
            $('.navbar-toggle:visible').click();
    });

    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 100
        }
    })

})(jQuery); // End of use strict
