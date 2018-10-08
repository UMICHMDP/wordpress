jQuery(window).load(function () {
	jQuery('#TS_Portfolio_GAA_inner-selection-button').click(function() {
		event.stopPropagation();
	    jQuery('#TS_Portfolio_GAA_inner-selection-button-dropdown').fadeToggle(250);
	});
	jQuery('html').click(function() {
		jQuery('#TS_Portfolio_GAA_inner-selection-button-dropdown').fadeOut(250);
	});
	jQuery('.TS_Portfolio_GAA_inner-content-image').each(function() {
		var this_element = jQuery(this);
		this_element.height(this_element.find('img:first-child').height());
		this_element.find('.TS_Portfolio_GAA_inner-content-image-hover').height(this_element.find('img:first-child').height());
	});
	function resize_popup()
	{
		var window_width = window.innerWidth;	
		var window_height = window.innerHeight;	
		var max_image_width = window.innerWidth - ((35*2)+(window_width/100*40));
		var max_image_height = window.innerHeight - 200;
		var image_width = jQuery('#TS_Portfolio_GAA_fullscreen-image img').width();
		var image_height = jQuery('#TS_Portfolio_GAA_fullscreen-image img').height();
		var image_WH_ratio = image_width/image_height;
		var image_HW_ratio = image_height/image_width;
		var image_new_width = max_image_height*image_WH_ratio;
		var image_new_height = max_image_width*image_HW_ratio;
		jQuery('#TS_Portfolio_GAA_fullscreen-image').width(max_image_width);
		jQuery('#TS_Portfolio_GAA_fullscreen-image').height(max_image_height);

		if(max_image_width > 2 && max_image_height > 2)
		{
			if(image_new_height>max_image_height)
			{
				jQuery('#TS_Portfolio_GAA_fullscreen-image img').width(image_new_width);
				jQuery('#TS_Portfolio_GAA_fullscreen-image img').height(max_image_height);
				jQuery('#TS_Portfolio_GAA_fullscreen-image img').css('margin-top',-max_image_height/2);
				jQuery('#TS_Portfolio_GAA_fullscreen-image img').css('margin-left',-image_new_width/2);
			}
			else
			{
				jQuery('#TS_Portfolio_GAA_fullscreen-image img').width(max_image_width);
				jQuery('#TS_Portfolio_GAA_fullscreen-image img').height(image_new_height);
				jQuery('#TS_Portfolio_GAA_fullscreen-image img').css('margin-top',-image_new_height/2);	
				jQuery('#TS_Portfolio_GAA_fullscreen-image img').css('margin-left',-max_image_width/2);		
			}
		}
	}
	function open_close_gallery()
	{
		var this_element = '';
		jQuery('.TS_Portfolio_GAA_inner-content-image-hover').click(function() {
			jQuery('#TS_Portfolio_GAA_fullscreen-image').find('img').remove();
			this_element = jQuery(this);
			this_element.parent().find('img').clone().appendTo('#TS_Portfolio_GAA_fullscreen-image');
		    jQuery('#TS_Portfolio_GAA_fullscreen').show();    
		    jQuery('#TS_Portfolio_GAA_fullscreen').removeClass('fadeOut').addClass('fadeIn');    
		    jQuery('#TS_Portfolio_GAA_fullscreen-image').removeClass('fadeOutDown').addClass('fadeInDown');
		    resize_popup();
		});	
		jQuery('#TS_Portfolio_GAA_fullscreen-inner-close').click(function() {
			jQuery('#TS_Portfolio_GAA_fullscreen').removeClass('fadeIn').addClass('fadeOut').delay(500).hide(0);
		 	jQuery('#TS_Portfolio_GAA_fullscreen-image').removeClass('fadeInDown').addClass('fadeOutDown');
		});	
	}
	function next_slide()
	{
		jQuery('#TS_Portfolio_GAA_fullscreen-image img:last-child').insertBefore( jQuery('#TS_Portfolio_GAA_fullscreen-image img:first-child') );
	}
	function previous_slide()
	{
		jQuery('#TS_Portfolio_GAA_fullscreen-image img:first-child').insertAfter( jQuery('#TS_Portfolio_GAA_fullscreen-image img:last-child') );
	}
	jQuery(document).keydown(function(e) {
	    switch(e.which) {
	        case 37: // left
		        previous_slide();
		        break;
	        case 38: // up
		        next_slide();
		        break;
	        case 39: // right
		        next_slide();
		        break;    
	        case 40: // down
		        previous_slide();
		        break;
	        default: return; // exit this handler for other keys
	    }
	    e.preventDefault(); // prevent the default action (scroll / move caret)
	});
	resize_popup();
	jQuery( window ).resize(function() {
		resize_popup();
	});
	open_close_gallery();    
	jQuery('#TS_Portfolio_GAA_fullscreen-inner-right').click(function() {
	 	next_slide();
	});	
	jQuery('#TS_Portfolio_GAA_fullscreen-inner-left').click(function() {
	 	previous_slide();
	});	
});