(function($){
	"use strict";
	var TP_Event_Admin = {};

	TP_Event_Admin.init = function(){

		// widgets
		var forms = $('#widgets-right .widget-content');
		for( var i = 0; i <= forms.length; i++ )
		{
			var form = $(forms[i]);

			form.find('.tp_event_admin_widget:first').addClass('active');

			form.find( '.tp_event_widget_tab li a:first' ).addClass('button-primary');
			$(document).on('click', '.tp_event_widget_tab li a', function(e){
				e.preventDefault();
				var tab_content = $(this).attr('data-tab'),
					widget_content = $(this).parents('.widget-content'),
					parent = $(this).parents('.tp_event_widget_tab');
				parent.find( 'li a' ).removeClass('button-primary');
				$(this).addClass('button-primary');

				widget_content.find('.tp_event_admin_widget').removeClass('active');
				widget_content.find('.tp_event_admin_widget[data-status="'+tab_content+'"]').addClass('active');
				return false;
			});
		}

		TP_Event_Admin.admin_setting_tab();
	};

	// tab setting function
	TP_Event_Admin.admin_setting_tab = function()
	{
		// admin setting
		$('.tp_event_wrapper_content > div:not(:first)').hide();
		$( document ).on( 'click', '.tp_event_setting_wrapper .nav-tab-wrapper a', function( e ){
			e.preventDefault();

			var a_tabs = $('.tp_event_setting_wrapper .nav-tab-wrapper a');
			a_tabs.removeClass('nav-tab-active');
			var _self = $(this),
				_tab_id = _self.attr( 'data-tab' );

			_self.addClass( 'nav-tab-active' );
			$( '.tp_event_wrapper_content > div' ).hide();
			$( '.tp_event_wrapper_content #'+ _tab_id ).fadeIn();

			return false;
		});

		// event metabox
		$('.event_metabox_setting_section:not(:first)').hide();
		$( document ).on( 'click', '.event_metabox_setting a', function( e ){
			e.preventDefault();

			var a_tabs = $('.event_metabox_setting a');
			a_tabs.removeClass('nav-tab-active');
			var _self = $(this),
				_tab_id = _self.attr( 'id' );

			_self.addClass( 'nav-tab-active' );
			$('.event_metabox_setting_section').hide();
			$( '.event_metabox_setting_section[data-id^="'+_tab_id+'"]' ).fadeIn();

			return false;
		});

		$('#checkout > div:not(:first)').hide();
		$( document ).on( 'click', '.tp_event_setting_wrapper h3 a', function( e ){
			e.preventDefault();

			$('.tp_event_setting_wrapper h3 a').removeClass( 'active' );
			var _self = $(this),
				_data_id = _self.attr( 'id' );

			_self.addClass( 'active' );
			$('#checkout > div').hide();

			$('#checkout > div[data-tab-id^="'+_data_id+'"]').show();

		});
	};

	$(document).ready(function(){
		TP_Event_Admin.init();
	});
})(jQuery);