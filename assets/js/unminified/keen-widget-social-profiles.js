(function($){

	KeenWidgetSocialProfiles = {

		/**
		 * Init
		 */
		init: function()
		{
			this._init_toggle_settings();
			this._bind();
		},
		
		/**
		 * Binds events
		 */
		_bind: function()
		{
			$( document ).on('widget-updated widget-added', KeenWidgetSocialProfiles._init_toggle_settings );
			$( document ).on('change', '.keen-widget-social-profiles-fields .keen-widget-field-icon-style', KeenWidgetSocialProfiles._toggle_settings );
			$( document ).on('change', '.keen-widget-social-profiles-fields .keen-widget-field-color-type', KeenWidgetSocialProfiles._toggle_settings );
		},

		_init_toggle_settings: function() {
			$( '.keen-widget-social-profiles-fields' ).each(function(index, el) {
				var parent 		= $( el );
				var style 		= parent.find( '.keen-widget-field-icon-style' ).find('option:selected').val() || '';
				var color_type 	= parent.find( '.keen-widget-field-color-type' ).find('option:selected').val() || '';


				if( color_type === 'official-color' ) {
					parent.find('.keen-widget-field-icon-color').hide();
					parent.find('.keen-widget-field-icon-hover-color').hide();
					parent.find('.keen-widget-field-bg-hover-color').hide();
					parent.find('.keen-widget-field-bg-color').hide();
				} else {
					parent.find('.keen-widget-field-icon-color').show();
					parent.find('.keen-widget-field-icon-hover-color').show();
					parent.find('.keen-widget-field-bg-hover-color').show();
					parent.find('.keen-widget-field-bg-color').show();
					
					if( style === 'simple' ) {
						parent.find('.keen-widget-field-bg-hover-color').hide();
						parent.find('.keen-widget-field-bg-color').hide();
					} else {
						parent.find('.keen-widget-field-bg-hover-color').show();
						parent.find('.keen-widget-field-bg-color').show();
					}
				}
			
			});
		},

		_toggle_settings: function() {
			var style = $( this ).find('option:selected').val() || '';
			var parent = $( this ).closest('.keen-widget-social-profiles-fields');
			var color_type 	= parent.find( '.keen-widget-field-color-type' ).find('option:selected').val() || '';


			if( color_type === 'official-color' ) {
				parent.find('.keen-widget-field-icon-color').hide();
				parent.find('.keen-widget-field-icon-hover-color').hide();
				parent.find('.keen-widget-field-bg-hover-color').hide();
				parent.find('.keen-widget-field-bg-color').hide();
			} else {
				parent.find('.keen-widget-field-icon-color').show();
				parent.find('.keen-widget-field-icon-hover-color').show();
				parent.find('.keen-widget-field-bg-hover-color').show();
				parent.find('.keen-widget-field-bg-color').show();
				
				if( style === 'simple' ) {
					parent.find('.keen-widget-field-bg-hover-color').hide();
					parent.find('.keen-widget-field-bg-color').hide();
				} else {
					parent.find('.keen-widget-field-bg-hover-color').show();
					parent.find('.keen-widget-field-bg-color').show();
				}
			}
		}

	};

	/**
	 * Initialization
	 */
	$(function(){
		KeenWidgetSocialProfiles.init();
	});

})(jQuery);