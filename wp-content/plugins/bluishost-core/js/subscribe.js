/*

[Main Script]

Project: Bluishost
Version: 1.1
Author : themelooks.com

*/

(function ($) {
    'use strict';
    
    
	$( function(){
			
		/* ------------------------------------------------------------------------- *
        * Mail Chimp ajax
        * ------------------------------------------------------------------------- */
				
        var $subscribeForm = $('#subscribe_submit');
     
		
        $subscribeForm.on('submit', function (event) {

			var $t = $(this),
			email = $('#sectsubscribe_email').val();
			$.ajax({
				
				type: 'POST',
				url: subscribeajax.action_url,
				data: {
				  sectsubscribe_email: email,
				  action: 'bluishost_subscribe_ajax',
				  security: subscribeajax.security
				},
				success: function( data ){

				  $(".newsletter").append(data);
				  
				}
			});
          
			event.preventDefault();
		  
        });

        /* ------------------------------------------------------------------------- *
        * Footer Mail Chimp ajax
        * ------------------------------------------------------------------------- */
				
        var $subscribeForm = $('#footer_subscribe_submit');
     
		
        $subscribeForm.on('submit', function (event) {

			var $t = $(this),
			email = $('#footersubscribe_email').val();
			$.ajax({
				
				type: 'POST',
				url: subscribeajax.action_url,
				data: {
				  footersubscribe_email: email,
				  action: 'bluishost_subscribe_ajax',
				  security: subscribeajax.security
				},
				success: function( data ){

				  $(".subscribe-form").append(data);
				  
				}
			});
          
			event.preventDefault();
		  
        });

		
	} );
     
    
})(jQuery);
