( function($) {
	$('.toggle-mobile-menu').click(function(e) {
			e.preventDefault();  // don't grab focus
			setTimeout(menuFunction,10);
	});
	
	
	$('.toggle-mobile-menu').keypress(function(event){ 
		var keyCode = (event.keyCode ? event.keyCode : event.which);   
		if (keyCode == 13) {
			$('.toggle-mobile-menu').trigger('click');
		}
	});
	

	

	$(document).ready(function(){

		$("#smobile-menu #primary-menu").append(
			'<li><a href="" id="accessibility-close-mobile-menu" style="padding:0;height:0;"></a></li>'
		);

		$("#accessibility-close-mobile-menu").focusin(function(e){
			$( document ).off("keydown");
			$('.toggle-mobile-menu').click();
			$('#primary a').first().focus();
			setTimeout(function(){$('#primary a').first().focus();},10);
		});

	});
	
	
	function menuFunction(){
		if($('body').hasClass('mobile-menu-active') ) {
			$( document ).on( 'keydown', function ( e ) {
				if ( e.keyCode === 27 ) { 
					$( document ).off("keydown");
					$("#accessibility-close-mobile-menu").trigger("focusin");
				}
			});
			
					console.log("its open");
			$('#smobile-menu .smenu-hide').off("keydown");
			$('#smobile-menu .smenu-hide').on('keydown', function (e) {
				if((e.keyCode === 9 && e.shiftKey)) {
					$('#smobile-menu .smenu-hide').off("keydown");
					$( document ).off("keydown");
					closeMenu(true);
				}
				if((e.keyCode === 13)) {
					$('#smobile-menu .smenu-hide').off("keydown");
					$( document ).off("keydown");
					closeMenu();
				}
			});
			
					$("#smobile-menu #primary-menu li a").first().focus();
			setTimeout(function(){
				$("#smobile-menu #primary-menu li a").first().focus();
			},10);
		}
	}
	
	function closeMenu(trigger = false){
					   //shift tab or enter on "menu" close menu
					 if(trigger){
						 $('.toggle-mobile-menu').trigger("click");
					 }
					//
					setTimeout(function(){
						$('.super-menu-inner .toggle-mobile-menu').focus();
					}, 10);
					$('.super-menu-inner .toggle-mobile-menu').focus();
	}
	
	
})(jQuery);