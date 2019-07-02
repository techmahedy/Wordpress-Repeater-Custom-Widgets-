(function($){

	KeenWidgetListIcons = {

		/**
		 * Init
		 */
		init: function()
		{
			this._bind();
			this._init_toggle_settings();
		},
		
		/**
		 * Binds events
		 */
		_bind: function()
		{
			$( document ).on('widget-updated widget-added', KeenWidgetListIcons._init_toggle_settings );
			$( document ).on('change', '.keen-widget-list-icons-fields .keen-widget-field-imageoricon', KeenWidgetListIcons._toggle_settings );
			$( document ).on('click', '.keen-widget-list-icons-fields .keen-repeater-container .actions', KeenWidgetListIcons._init_toggle_settings );
			$( document ).on('change', '.keen-widget-list-icons-fields .keen-widget-field-divider', KeenWidgetListIcons._toggle_divider_settings );

		},

		_init_toggle_settings: function() {
			$( '.keen-widget-list-icons-fields .keen-repeater-sortable .keen-repeater-field' ).each(function(index, el) {
				var parent = $( el );
				var image = parent.find( '.keen-widget-field-imageoricon' ).find('option:selected').val() || '';
				var divider = parent.find( '.keen-widget-field-divider' ).find('option:selected').val() || '';

				if( image === 'image' ) {
					parent.find('.keen-field-image-wrapper').show();
					parent.find('.keen-widget-icon-selector').hide();
				} else {
					parent.find('.keen-widget-icon-selector').show();
					parent.find('.keen-field-image-wrapper').hide();
				}

				if( divider === 'yes' ) {
					parent.find('.keen-widget-field-divider_weight').show();
					parent.find('.keen-widget-field-divider_style').show();
					parent.find('.keen-widget-field-divider_color').show();
				} else {
					parent.find('.keen-widget-field-divider_weight').hide();
					parent.find('.keen-widget-field-divider_style').hide();
					parent.find('.keen-widget-field-divider_color').hide();
				}
			});
		},

		_toggle_settings: function() {
			var image = $( this ).find('option:selected').val() || '';
			var parent = $( this ).closest('.keen-widget-list-icons-fields');

			if( image === 'image' ) {
				parent.find('.keen-field-image-wrapper').show();
				parent.find('.keen-widget-icon-selector').hide();
			} else {
				parent.find('.keen-widget-icon-selector').show();
				parent.find('.keen-field-image-wrapper').hide();
			}
		},

		_toggle_divider_settings: function() {
			var divider = $( this ).find('option:selected').val() || '';
			var parent  = $( this ).closest('.keen-widget-list-icons-fields');

			if( divider === 'yes' ) {
				parent.find('.keen-widget-field-divider_weight').show();
				parent.find('.keen-widget-field-divider_style').show();
				parent.find('.keen-widget-field-divider_color').show();
			} else {
				parent.find('.keen-widget-field-divider_weight').hide();
				parent.find('.keen-widget-field-divider_style').hide();
				parent.find('.keen-widget-field-divider_color').hide();
			}
		}

	};

	/**
	 * Initialization
	 */
	$(function(){
		KeenWidgetListIcons.init();
	});

})(jQuery);