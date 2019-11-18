wp.customize.controlConstructor['thumbnail_size'] = wp.customize.Control.extend({

	// When we're finished loading continue processing
	ready: function() {

		'use strict';

		var control = this;

		// Init the control.
		if ( ! _.isUndefined( window.kirkiControlLoader ) && _.isFunction( kirkiControlLoader ) ) {
			kirkiControlLoader( control );
		} else {
			control.initKirkiControl();
		}
	},

	initKirkiControl: function() {

		'use strict';
		var control = this,
		    value   = control.setting._value;


			this.container.on( 'change keyup paste', '.thumbnail_size-width input', function() {
				control.saveValue( 'width', jQuery( this ).val() );
			});

			this.container.on( 'change keyup paste', '.thumbnail_size-height input', function() {
				control.saveValue( 'height', jQuery( this ).val() );
			});

			this.container.on( 'change', '.thumbnail_size-hard_crop input', function() {
				if(jQuery(this).is( ':checked' )){
					control.saveValue( 'hard_crop', jQuery( this ).val() );
				}else{
					control.saveValue( 'hard_crop', '0' );
				}
				
			});


		
	},

	
	

	/**
	 * Gets the value.
	 */
	getValue: function() {

		'use strict';

		var control   = this,
		    input     = control.container.find( '.thumbnail_size-hidden-value' ),
		    valueJSON = jQuery( input ).val();

		return valueJSON;
	},

	/**
	 * Saves the value.
	 */
	saveValue: function( property, value ) {

		'use strict';
		var control = this,
		    input   = control.container.find( '.thumbnail_size-hidden-value' ),
		    val     = control.setting._value;
		val[ property ] = value;

		jQuery( input ).attr( 'value', JSON.stringify( val ) ).trigger( 'change' );
		control.setting.set( val );


	}
});
