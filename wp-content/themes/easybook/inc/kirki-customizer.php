<?php
/**
 * @package EasyBook - Hotel & Tour Booking WordPress Theme
 * @author CTHthemes - http://themeforest.net/user/cththemes
 * @date 03-10-2019
 * @since 1.1.7
 * @version 1.1.7
 * @copyright Copyright ( C ) 2014 - 2019 cththemes.com . All rights reserved.
 * @license GNU General Public License version 3 or later; see LICENSE
 */


/**
 * EasyBook: Kirki Customizer
 *
 */
add_action( 'customize_register', function( $wp_customize ) {
	/**
	 * The custom control class
	 */
	class Kirki_Controls_Thumbnail_Size_Control extends WP_Customize_Control { 
		public $type = 'thumbnail_size';

		public function __construct( $manager, $id, $args = array() ) {

			parent::__construct( $manager, $id, $args );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_scripts' ), 999 );

		}

		/**
		 * Enqueue control related scripts/styles.
		 *
		 * @access public
		 */
		public function enqueue_scripts() {
			wp_enqueue_style( 'cth-thumbnail_size-css', get_theme_file_uri( '/assets/admin/css/thumbnail_size.css' ), null );
			wp_enqueue_script( 'cth-thumbnail_size', get_theme_file_uri( '/assets/admin/js/thumbnail_size.js' ), array( 'jquery', 'customize-base'), false, true );
			
		}

		/**
		 * Refresh the parameters passed to the JavaScript via JSON.
		 *
		 * @see WP_Customize_Control::to_json()
		 */
		public function to_json() {
			parent::to_json();

			$this->json['default'] = $this->setting->default;
			if ( isset( $this->default ) ) {
				$this->json['default'] = $this->default;
			}
			$this->json['value']   = $this->sanitize( $this->value() ) ;
			$this->json['choices'] = $this->choices;
			$this->json['link']    = $this->get_link();
			$this->json['id']      = $this->id;

			$this->json['inputAttrs'] = '';
			foreach ( $this->input_attrs as $attr => $value ) {
				$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
			}

			foreach ( array_keys( $this->json['value'] ) as $key ) {
				if ( ! in_array( $key, array( 'width', 'height', 'hard_crop' ) ) && ! isset( $this->json['default'][ $key ] ) ) {
					unset( $this->json['value'][ $key ] );
				}
			}

			// Fix for https://github.com/aristath/kirki/issues/1405.
			foreach ( array_keys( $this->json['value'] ) as $key ) {
				if ( isset( $this->json['default'][ $key ] ) && false === $this->json['default'][ $key ] ) {
					unset( $this->json['value'][ $key ] );
				}
			}
		}

		protected  function sanitize( $value ) {

			if ( ! is_array( $value ) ) {
				return array();
			}

			foreach ( $value as $key => $val ) {
				switch ( $key ) {
					case 'width':
						$value['width'] = esc_attr( $val );
						break;
					case 'height':
						$value['height'] = esc_attr( $val );
						break;
					case 'hard_crop':
						if ( ! isset($val) ) {
							$value['hard_crop'] = '1';
						}
						break;
					
				} // End switch().
			} // End foreach().

			return $value;

		}

		/**
		 * An Underscore (JS) template for this control's content (but not its container).
		 *
		 * Class variables for this control class are available in the `data` JS object;
		 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
		 *
		 * @see WP_Customize_Control::print_template()
		 *
		 * @access protected
		 */
		protected function content_template() {
			?>
			<label class="customizer-text">
				<# if ( data.label ) { #><span class="customize-control-title">{{{ data.label }}}</span><# } #>
				<# if ( data.description ) { #><span class="description customize-control-description">{{{ data.description }}}</span><# } #>
			</label>

			<div class="wrapper">
				
				<div class="field-thumbnail-size-input input-prepend thumbnail_size-width">
                   	<span class="add-on"><?php esc_html_e( 'W', 'easybook' );?></span>
                    <label for="{{ data.id }}-width"><?php esc_html_e( 'Image Width', 'easybook' );?></label>
                    <input {{{ data.inputAttrs }}} placeholder="<?php esc_attr_e( 'Width', 'easybook' );?>" type="text" id="{{ data.id }}-width" name="_customize-thumbnail_size-width-{{ data.id }}" value="{{ data.value['width'] }}">
                </div>

                <div class="field-thumbnail-size-input input-prepend"><span  class="ts-add-on"><?php esc_html_e( ' x ', 'easybook' );?></span></div>

                <div class="field-thumbnail-size-input input-prepend thumbnail_size-height">
                   	<span class="add-on"><?php esc_html_e( 'H', 'easybook' );?></span>
                    <label for="{{ data.id }}-height"><?php esc_html_e( 'Image Height', 'easybook' );?></label>
                    <input {{{ data.inputAttrs }}} placeholder="<?php esc_attr_e( 'Height', 'easybook' );?>" type="text" id="{{ data.id }}-height" name="_customize-thumbnail_size-height-{{ data.id }}" value="{{ data.value['height'] }}">
                </div>

                <div class="field-thumbnail-size-input input-prepend"><span  class="ts-add-on"><?php esc_html_e( ' px ', 'easybook' );?></span></div>

                <div class="field-thumbnail-size-input thumbnail_size-hard_crop">
	                <label for="{{ data.id }}-hard_crop">
		                <input type="checkbox" id="{{ data.id }}-hard_crop" name="_customize-thumbnail_size-hard_crop-{{ data.id }}" value="1" <# if ( data.value['hard_crop'] === '1' ) { #> checked="checked"<# } #>>
		            	<?php esc_html_e( 'Hard Crop ', 'easybook' );?>
		            </label>
                    
                </div>
				
			</div>
			<#
			
			valueJSON = JSON.stringify( data.value ).replace( /'/g, '&#39' );
			#>
			<input class="thumbnail_size-hidden-value" type="text" name="{{ data.id }}" value='{{{ valueJSON }}}' {{{ data.link }}}>
			<?php
		}	

		/**
		 * Render the control's content.
		 *
		 * @see WP_Customize_Control::render_content()
		 */
		protected function render_content() {}
	}
	// Register the class so that it's JS template is available in the Customizer.
    $wp_customize->register_control_type( 'Kirki_Controls_Thumbnail_Size_Control' );

	// Register our custom control with Kirki
	add_filter( 'kirki/control_types', function( $controls ) {
		$controls['thumbnail_size'] = 'Kirki_Controls_Thumbnail_Size_Control';
		return $controls;
	} );

} );

// https://aristath.github.io/kirki/docs/getting-started/config.html
EasyBook_Kirki::add_config( 'easybook_configs', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'option', // theme_mod option
	'option_name'	=> 'easybook_options' // for option type
) );
// https://wordpress.stackexchange.com/questions/280278/site-identity-section-name


EasyBook_Kirki::add_section( 'general_options', array(
    'title'          => esc_html__( 'General Options', 'easybook' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 120,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'toggle',
	'settings'    => 'show_loader',
	'label'       => esc_html__( 'Show Loader', 'easybook' ),
	'section'     => 'general_options',
	'default'     => '1',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'image',
	'settings'    => 'loader_icon',
	'label'       => esc_html__( 'Loader Icon', 'easybook' ),
	'section'     => 'general_options',
	'default'     => '',
	'priority'    => 10,
	'choices'     => array(
		'save_as' => 'id',
	),
	
) );

EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'toggle',
	'settings'    => 'enable_auto_update',
	'label'       => esc_html__( 'Enable Auto Update', 'easybook' ),
	'description' => esc_html__( 'Note: auto update feature is not for Envato Elements download.', 'easybook' ),
	'section'     => 'general_options',
	'default'     => '0',
	'priority'    => 10,
) );

EasyBook_Kirki::add_section( 'header_options', array(
    'title'          => esc_html__( 'Header Options', 'easybook' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 130,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'textarea',
	'settings'    => 'header_info',
	'label'       => esc_html__( 'Header Contacts Info', 'easybook' ),
	'description'       => esc_html__( 'Enter header contacts info for your site. Notice: only visible on large screen.', 'easybook' ),
	'section'     => 'header_options',
	'default'     => '',
	'priority'    => 10,
) );

EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'toggle',
	'settings'    => 'show_fixed_search',
	'label'       => esc_html__( 'Show Search', 'easybook' ),
	'section'     => 'header_options',
	'default'     => '1',
	'priority'    => 10,
) );

EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'toggle',
	'settings'    => 'show_mini_cart',
	'label'       => esc_html__( 'Show Cart', 'easybook' ),
	'section'     => 'header_options',
	'default'     => '1',
	'priority'    => 10,
) );

EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'select',
	'settings'    => 'user_menu_style',
	'label'       => esc_html__( 'Logged In Avatar', 'easybook' ),
	'section'     => 'header_options',
	'default'     => 'two',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
		'one' => esc_html__('Style One', 'easybook'),
        'two' => esc_html__('Style Two', 'easybook'),
	),
) );


EasyBook_Kirki::add_section( 'thumbnails_options', array(
    'title'          => esc_html__( 'Thumbnail Sizes', 'easybook' ),
    'description'	=> esc_html__( 'These settings affect the display and dimensions of images in your pages.
Enter 9999 as Width value and uncheck Hard Crop to make your thumbnail dynamic width.
Enter 9999 as Height value and uncheck Hard Crop to make your thumbnail dynamic height.
Enter 9999 as Width and Height values to use full size image.
After changing these settings you may need using Regenerate Thumbnails plugin to regenerate your thumbnails', 'easybook' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 140,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'toggle',
	'settings'    => 'enable_custom_sizes',
	'label'       => esc_html__( 'Enable Custom Image Sizes', 'easybook' ),
	'section'     => 'thumbnails_options',
	'default'     => '0',
	'priority'    => 10,
	'transport'		=> 'postMessage',
) ); 

EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'thumbnail_size',
	'settings'    => 'thumb_size_opt_4',
	'label'       => esc_html__( 'Listing Grid', 'easybook' ),
	'description'       => esc_html__( 'Demo: Width - 408, Height - 270, Hard crop - checked', 'easybook' ),
	'section'     => 'thumbnails_options',
	'transport'		=> 'postMessage',
	'default'     => array(
		'width'		=> '408',
		'height'	=> '270',
		'hard_crop'	=> '1',
	),
	'priority'    => 10,
	
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'thumbnail_size',
	'settings'    => 'thumb_size_opt_5',
	'label'       => esc_html__( 'Listing Category Size One', 'easybook' ),
	'description'       => esc_html__( 'Demo: Width - 611, Height - 458, Hard crop - checked', 'easybook' ),
	'section'     => 'thumbnails_options',
	'transport'		=> 'postMessage',
	'default'     => array(
		'width'		=> '611',
		'height'	=> '458',
		'hard_crop'	=> '1',
	),
	'priority'    => 10,
	
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'thumbnail_size',
	'settings'    => 'thumb_size_opt_6',
	'label'       => esc_html__( 'Listing Category Size Two', 'easybook' ),
	'description'       => esc_html__( 'Demo: Width - 1243, Height - 458, Hard crop - checked', 'easybook' ),
	'section'     => 'thumbnails_options',
	'transport'		=> 'postMessage',
	'default'     => array(
		'width'		=> '1243',
		'height'	=> '458',
		'hard_crop'	=> '1',
	),
	'priority'    => 10,
	
) );

EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'thumbnail_size',
	'settings'    => 'thumb_size_opt_7',
	'label'       => esc_html__( 'Listing Category Size Three', 'easybook' ),
	'description'       => esc_html__( 'Demo: Width - 1894, Height - 458, Hard crop - checked', 'easybook' ),
	'section'     => 'thumbnails_options',
	'transport'		=> 'postMessage',
	'default'     => array(
		'width'		=> '1894',
		'height'	=> '458',
		'hard_crop'	=> '1',
	),
	'priority'    => 10,
	
) );

EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'thumbnail_size',
	'settings'    => 'thumb_size_opt_8',
	'label'       => esc_html__( 'Post Grid Thumbanil', 'easybook' ),
	'description'       => esc_html__( 'Demo: Width - 388, Height - 257, Hard crop - checked', 'easybook' ),
	'section'     => 'thumbnails_options',
	'transport'		=> 'postMessage',
	'default'     => array(
		'width'		=> '388',
		'height'	=> '257',
		'hard_crop'	=> '1',
	),
	'priority'    => 10,
	
) );

EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'thumbnail_size',
	'settings'    => 'thumb_size_opt_9',
	'label'       => esc_html__( 'Blog Thumbnail', 'easybook' ),
	'description'       => esc_html__( 'Demo: Width - 806, Height - 534, Hard crop - checked', 'easybook' ),
	'section'     => 'thumbnails_options',
	'transport'		=> 'postMessage',
	'default'     => array(
		'width'		=> '806',
		'height'	=> '534',
		'hard_crop'	=> '1',
	),
	'priority'    => 10,
	
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'thumbnail_size',
	'settings'    => 'thumb_size_opt_10',
	'label'       => esc_html__( 'Blog Single Thumbnail', 'easybook' ),
	'description'       => esc_html__( 'Demo: Width - 806, Height - 534, Hard crop - checked', 'easybook' ),
	'section'     => 'thumbnails_options',
	'transport'		=> 'postMessage',
	'default'     => array(
		'width'		=> '806',
		'height'	=> '534',
		'hard_crop'	=> '1',
	),
	'priority'    => 10,
	
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'thumbnail_size',
	'settings'    => 'thumb_size_opt_11',
	'label'       => esc_html__( 'Recent Post Widget', 'easybook' ),
	'description'       => esc_html__( 'Demo: Width - 114, Height - 76, Hard crop - checked', 'easybook' ),
	'section'     => 'thumbnails_options',
	'transport'		=> 'postMessage',
	'default'     => array(
		'width'		=> '114',
		'height'	=> '76',
		'hard_crop'	=> '1',
	),
	'priority'    => 10,
	
) );






EasyBook_Kirki::add_section( 'color_options', array(
    'title'          => esc_html__( 'Colors & Fonts - Options', 'easybook' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 150,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'toggle',
	'settings'    => 'use_custom_color',
	'label'       => esc_html__( 'Use Custom Colors', 'easybook' ),
	'description'       => wp_kses(__('Set this option to <b>Yes</b> if you want to use color variants bellow.', 'easybook'), array('b'=>array(),'strong'=>array(),'p'=>array()) ),
	'section'     => 'color_options',
	'default'     => '0',
	'priority'    => 10,
) );

EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'color',
	'settings'    => 'theme-color',
	'label'       => esc_html__( 'Theme Color', 'easybook' ), 
	'description'       => esc_html__( 'Default: #4DB7FE', 'easybook' ),
	'section'     => 'color_options',
	'default'     => '#4DB7FE',
	'priority'    => 10,
	
) );

EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'color',
	'settings'    => 'theme-color-second',
	'label'       => esc_html__( 'Theme Secondary Color', 'easybook' ),
	'description'       => esc_html__( 'Default: #5ECFB1', 'easybook' ),
	'section'     => 'color_options',
	'default'     => '#5ECFB1',
	'priority'    => 10,
	
) );

EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'color',
	'settings'    => 'theme-color-third',
	'label'       => esc_html__( 'Button Hover Color - Theme third color', 'easybook' ),
	'description'       => esc_html__( 'Default: #2F3B59', 'easybook' ),
	'section'     => 'color_options',
	'default'     => '#2F3B59',
	'priority'    => 10,
	
) );

EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'color',
	'settings'    => 'main-bg-color',
	'label'       => esc_html__( 'Body Background Color', 'easybook' ),
	'description'       => esc_html__( 'Default: #2F3B59', 'easybook' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
) );

EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'color',
	'settings'    => 'loader-bg-color',
	'label'       => esc_html__( 'Loader Background Color', 'easybook' ),
	'description'       => esc_html__( 'Default: #2F3B59', 'easybook' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
) );

EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'color',
	'settings'    => 'body-text-color',
	'label'       => esc_html__( 'Body Text Color', 'easybook' ),
	'description'       => esc_html__( 'Default: #000000', 'easybook' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'color',
	'settings'    => 'paragraph-color',
	'label'       => esc_html__( 'Paragraph Color', 'easybook' ),
	'description'       => esc_html__( 'Default: #878C9F', 'easybook' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'color',
	'settings'    => 'link_color',
	'label'       => esc_html__( 'Link Color', 'easybook' ),
	'description'       => esc_html__( 'Default: #000000', 'easybook' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'color',
	'settings'    => 'link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'easybook' ),
	'description'       => esc_html__( 'Default: #4DB7FE', 'easybook' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'color',
	'settings'    => 'link_active_color',
	'label'       => esc_html__( 'Link Active Color', 'easybook' ),
	'description'       => esc_html__( 'Default: #000000', 'easybook' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        	=> 'color',
	'settings'    	=> 'header-bg-color',
	'label'       	=> esc_html__( 'Header Bg Color', 'easybook' ),
	'description'       => esc_html__( 'Default: #2F3B59', 'easybook' ),
	'section'     	=> 'color_options',
	'default'     	=> '',
	'choices'     	=> array(
		'alpha' 	=> true,
	),
	'priority'    	=> 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'color',
	'settings'    => 'header-text-color',
	'label'       => esc_html__( 'Header Color', 'easybook' ),
	'description'       => esc_html__( 'Default: #ffffff', 'easybook' ),
	'section'     => 'color_options',
	'default'     => '',
	'choices'     => array(
		'alpha' 	=> true,
	),
	'priority'    => 10,
) );  
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'color',
	'settings'    => 'submenu-bg-color',
	'label'       => esc_html__( 'Submenu Background Color', 'easybook' ),
	'description'       => esc_html__( 'Default: #ffffff', 'easybook' ),
	'section'     => 'color_options',
	'default'     => '',
	'choices'     => array(
		'alpha' 	=> true,
	),
	'priority'    => 10,
) );          
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'color',
	'settings'    => 'mainmenu_color',
	'label'       => esc_html__( 'Menu Color', 'easybook' ),
	'description'       => esc_html__( 'Default: #ffffff', 'easybook' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'color',
	'settings'    => 'mainmenu_hover_color',
	'label'       => esc_html__( 'Menu Hover Color', 'easybook' ),
	'description'       => esc_html__( 'Default: #4DB7FE', 'easybook' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'color',
	'settings'    => 'mainmenu_active_color',
	'label'       => esc_html__( 'Menu Active Color', 'easybook' ),
	'description'       => esc_html__( 'Default: #4DB7FE', 'easybook' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'color',
	'settings'    => 'submenu_color',
	'label'       => esc_html__( 'Submenu Color', 'easybook' ),
	'description'       => esc_html__( 'Default: #000000', 'easybook' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'color',
	'settings'    => 'submenu_hover_color',
	'label'       => esc_html__( 'Submenu Hover Color', 'easybook' ),
	'description'       => esc_html__( 'Default: #4DB7FE', 'easybook' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'color',
	'settings'    => 'submenu_active_color',
	'label'       => esc_html__( 'Submenu Active Color', 'easybook' ),
	'description'       => esc_html__( 'Default: #4DB7FE', 'easybook' ),
	'section'     => 'color_options',
	'default'     => '',
	'priority'    => 10,
) );           

EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'color',
	'settings'    => 'footer-bg-color',
	'label'       => esc_html__( 'Footer Background Color', 'easybook' ),
	'description'       => esc_html__( 'Default: #2C3B5A', 'easybook' ),
	'section'     => 'color_options',
	'default'     => '',
	'choices'     => array(
		'alpha' 	=> true,
	),
	'priority'    => 10,
) );           
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'color',
	'settings'    => 'footer-text-color',
	'label'       => esc_html__( 'Footer Color', 'easybook' ),
	'description'       => esc_html__( 'Default: #878C9F', 'easybook' ),
	'section'     => 'color_options',
	'default'     => '',
	'choices'     => array(
		'alpha' 	=> true,
	),
	'priority'    => 10,
) );   

EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'color',
	'settings'    => 'subfooter-bg-color',
	'label'       => esc_html__( 'Footer Copyright Background Color', 'easybook' ),
	'description'       => esc_html__( 'Default: #2C3B5A', 'easybook' ),
	'section'     => 'color_options',
	'default'     => '',
	'choices'     => array(
		'alpha' 	=> true,
	),
	'priority'    => 10,
) ); 

EasyBook_Kirki::add_field( 'easybook_configs', array(
    'type'        => 'toggle',
    'settings'    => 'use_custom_fonts',
    'label'       => esc_html__( 'Use Custom Fonts', 'easybook' ),
    'description'       => wp_kses(__('Set this option to <b>Yes</b> if you want to use font variants bellow.', 'easybook'), array('b'=>array(),'strong'=>array(),'p'=>array()) ),
    'section'     => 'color_options',
    'default'     => '0',
    'priority'    => 10,
) );

EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'typography',
	'settings'    => 'body-font',
	'label'       => esc_html__( 'Body Font', 'easybook' ),
	'description'       => wp_kses(__('<p>Specify the body font properties.</br> Default </br>font-family: inherit </br>font-size: 13px </br>font-weight: 400</p>', 'easybook'), array( 'br'=>array(),'p'=>array(), ) ),
	'section'     => 'color_options',
	'default'     => array(
		'font-family'    => 'inherit',
	),
	'priority'    => 10,
) );          
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'typography',
	'settings'    => 'heading-font',
	'label'       => esc_html__( 'Heading Font', 'easybook' ),
	'description'       => wp_kses(__('<p>Specify the body font properties.</br> Default </br>font-family: inherit', 'easybook'), array( 'br'=>array(),'p'=>array(), ) ),
	'section'     => 'color_options',
	'default'     => array(
		'font-family'    => 'inherit',
	),
	'priority'    => 10,
) ); 
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'typography',
	'settings'    => 'paragraph-font',
	'label'       => esc_html__( 'Paragraph Font', 'easybook' ),
	'description'       => wp_kses(__('<p>Specify the body font properties.</br> Default </br>font-family: inherit </br>font-size: 12px </br>font-weight: 400</p>', 'easybook'), array( 'br'=>array(),'p'=>array(), ) ),
	'section'     => 'color_options',
	'default'     => array(
		'font-family'    => 'inherit',
	),
	'priority'    => 10,
) ); 
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'typography',
	'settings'    => 'theme-bolder-font',
	'label'       => esc_html__( 'EasyBook Bolder Font', 'easybook' ),
	'description'       => wp_kses(__('<p>Specify the body font properties.</br> Default </br>font-family: Montserrat', 'easybook'), array( 'br'=>array(),'p'=>array(), ) ),
	'section'     => 'color_options',
	'default'     => array(
		'font-family'    => 'inherit',
	),
	'priority'    => 10,
) ); 
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'typography',
	'settings'    => 'theme-italic-font',
	'label'       => esc_html__( 'EasyBook Italic Font', 'easybook' ),
	'description'       => wp_kses(__('<p>Specify the body font properties.</br> Default </br>font-family: Georgia </br>font-style: italic</p>', 'easybook'), array( 'br'=>array(),'p'=>array(), ) ),
	'section'     => 'color_options',
	'default'     => array(
		'font-family'    => 'Georgia',
		'variant'        => 'italic',
	),
	'priority'    => 10,
) ); 




// for blog settings
EasyBook_Kirki::add_panel( 'blog_panel', array(
    'priority'    => 160,
    'title'       => esc_html__( 'Blog Options', 'easybook' ),
    'description' => esc_html__( 'My Description', 'easybook' ),
) );


EasyBook_Kirki::add_section( 'blog_header', array(
    'title'          => esc_html__( 'Blog Header', 'easybook' ),
    'description'    => esc_html__( 'These options are for your blog list page: ' , 'easybook') .esc_url(home_url('?post_type=post' )),
    'panel'          => 'blog_panel', // Not typically needed.
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'toggle',
	'settings'    => 'show_blog_header',
	'label'       => esc_html__( 'Show Header', 'easybook' ),
	'section'     => 'blog_header',
	'default'     => '0',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'text',
	'settings'    => 'blog_head_title',
	'label'       => esc_html__( 'Header Title', 'easybook' ),
	'section'     => 'blog_header',
	'default'     => 'Our Last News',
	'priority'    => 10,
	
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'textarea',
	'settings'    => 'blog_head_intro',
	'label'       => esc_html__( 'Header Intro', 'easybook' ),
	'section'     => 'blog_header',
	'default'     => '<h4>Praesent nec leo venenatis elit semper aliquet id ac enim.</h4>
<span class="separator inline-sep sep-w"></span>',
	'priority'    => 10,
	
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'image',
	'settings'    => 'blog_header_image',
	'label'       => esc_html__( 'Header Background', 'easybook' ),
	'section'     => 'blog_header',
	'default'     => get_template_directory_uri().'/assets/images/bg/3.jpg',
	'priority'    => 10,
	
) );



EasyBook_Kirki::add_section( 'blog_list', array(
    'title'          => esc_html__( 'List View', 'easybook' ),
    'description'    => esc_html__( 'These options are for your blog list page: ' , 'easybook') .esc_url(home_url('?post_type=post' )),
    'panel'          => 'blog_panel', // Not typically needed.
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'radio-image',
	'settings'    => 'blog_layout',
	'label'       => esc_html__( 'Blog Sidebar Layout', 'easybook' ),
	'section'     => 'blog_list',
	'default'     => 'right_sidebar',
	'priority'    => 10,
	'choices'     => array(
		'fullwidth' => get_template_directory_uri() . '/assets/admin/images/1c.png',
		'left_sidebar' => get_template_directory_uri() . '/assets/admin/images/2cl.png',
		'right_sidebar' => get_template_directory_uri() . '/assets/admin/images/2cr.png',
		
	),
) );

EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'select',
	'settings'    => 'blog-sidebar-width',
	'label'       => esc_html__( 'Sidebar Width', 'easybook' ),
	'description'       => esc_html__( 'Based on Bootstrap 12 columns.', 'easybook' ),
	'section'     => 'blog_list',
	'default'     => '4',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
		'2' => esc_html__('2 Columns', 'easybook'),
        '3' => esc_html__('3 Columns', 'easybook'),
        '4' => esc_html__('4 Columns', 'easybook'),
        '5' => esc_html__('5 Columns', 'easybook'),
        '6' => esc_html__('6 Columns', 'easybook'),
	),
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'select',
	'settings'    => 'blog_post_format',
	'label'       => esc_html__( 'Choose how to display posts on the post page', 'easybook' ),
	'section'     => 'blog_list',
	'default'     => '1',
	'priority'    => 10,
	'choices'     => array(
		'1' => esc_html__('1 Columns', 'easybook'),
        '2' => esc_html__('2 Columns', 'easybook'),
	),
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'toggle',
	'settings'    => 'blog_show_format',
	'label'       => esc_html__( 'Show Post Format on posts page', 'easybook' ),
	'section'     => 'blog_list',
	'default'     => '1',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'toggle',
	'settings'    => 'blog_date',
	'label'       => esc_html__( 'Show Date', 'easybook' ),
	'section'     => 'blog_list',
	'default'     => '1',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'toggle',
	'settings'    => 'blog_author',
	'label'       => esc_html__( 'Show Author', 'easybook' ),
	'section'     => 'blog_list',
	'default'     => '0',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'toggle',
	'settings'    => 'blog_cats',
	'label'       => esc_html__( 'Show Categories', 'easybook' ),
	'section'     => 'blog_list',
	'default'     => '1',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
    'type'        => 'toggle',
    'settings'    => 'blog_views',
    'label'       => esc_html__( 'Show Views Count', 'easybook' ),
    'section'     => 'blog_list',
    'default'     => '0',
    'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'toggle',
	'settings'    => 'blog_tags',
	'label'       => esc_html__( 'Show Tags', 'easybook' ),
	'section'     => 'blog_list',
	'default'     => '1',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'toggle',
	'settings'    => 'blog_comments',
	'label'       => esc_html__( 'Show Comments', 'easybook' ),
	'section'     => 'blog_list',
	'default'     => '0',
	'priority'    => 10,
) );

EasyBook_Kirki::add_section( 'blog_single', array(
    'title'          => esc_html__( 'Single Post View', 'easybook' ),
    'description'    => esc_html__( 'Add custom CSS here' , 'easybook'),
    'panel'          => 'blog_panel', // Not typically needed.
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'select',
	'settings'    => 'blog-single-sidebar-width',
	'label'       => esc_html__( 'Sidebar Width', 'easybook' ),
	'description'       => esc_html__( 'Based on Bootstrap 12 columns.', 'easybook' ),
	'section'     => 'blog_single',
	'default'     => '4',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
		'2' => esc_html__('2 Columns', 'easybook'),
        '3' => esc_html__('3 Columns', 'easybook'),
        '4' => esc_html__('4 Columns', 'easybook'),
        '5' => esc_html__('5 Columns', 'easybook'),
        '6' => esc_html__('6 Columns', 'easybook'),
	),
) );

EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'toggle',
	'settings'    => 'single_featured',
	'label'       => esc_html__( 'Show Featured Image', 'easybook' ),
	'section'     => 'blog_single',
	'default'     => '1',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'toggle',
	'settings'    => 'single_date',
	'label'       => esc_html__( 'Show Date', 'easybook' ),
	'section'     => 'blog_single',
	'default'     => '1',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'toggle',
	'settings'    => 'single_author',
	'label'       => esc_html__( 'Show Author', 'easybook' ),
	'section'     => 'blog_single',
	'default'     => '0',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'toggle',
	'settings'    => 'single_cats',
	'label'       => esc_html__( 'Show Categories', 'easybook' ),
	'section'     => 'blog_single',
	'default'     => '1',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
    'type'        => 'toggle',
    'settings'    => 'single_views',
    'label'       => esc_html__( 'Show Views Count', 'easybook' ),
    'section'     => 'blog_list',
    'default'     => '0',
    'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'toggle',
	'settings'    => 'single_tags',
	'label'       => esc_html__( 'Show Tags', 'easybook' ),
	'section'     => 'blog_single',
	'default'     => '1',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'toggle',
	'settings'    => 'single_comments',
	'label'       => esc_html__( 'Show Comments', 'easybook' ),
	'section'     => 'blog_single',
	'default'     => '0',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'toggle',
	'settings'    => 'single_author_block',
	'label'       => esc_html__( 'Show Author Block', 'easybook' ),
	'section'     => 'blog_single',
	'default'     => '1',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'toggle',
	'settings'    => 'single_post_nav',
	'label'       => esc_html__( 'Show post navigation', 'easybook' ),
	'section'     => 'blog_single',
	'default'     => '1',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'toggle',
	'settings'    => 'single_same_term',
	'label'       => esc_html__( 'Next/Prev posts should be in same category', 'easybook' ),
	'section'     => 'blog_single',
	'default'     => '0',
	'priority'    => 10,
) );


EasyBook_Kirki::add_section( 'footer_options', array(
    'title'          => esc_html__( 'Footer Options', 'easybook' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'repeater',
	'label'       => esc_attr__( 'Footer Widgets Top', 'easybook' ),
	'section'     => 'footer_options',
	'priority'    => 10,
	'row_label' => array(
		'type'  => 'field',
		'value' => esc_attr__('Widget Area', 'easybook' ),
		'field' => 'title',
	),
	'settings'    => 'footer_widgets_top',
	'default'     => array(
		array(
            'title' => esc_attr__( 'Our Partners', 'easybook' ),
            'classes'  => 'col-md-12 col-sm-12',
            'widid'    => 'footer-our-partner',
        ),
	),
	'fields' => array(
		'title' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Widget Title', 'easybook' ),
			'description' => esc_attr__( 'This will be the label for your widget area', 'easybook' ),
			'default'     => '',
		),
		'classes' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Widget Classes', 'easybook' ),
			'description' => esc_attr__( 'This will be used to layout your widget', 'easybook' ),
			'default'     => 'col-md-3',
		),
		'widid' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Widget ID', 'easybook' ),
			'description' => esc_attr__( 'This value must be unique. And don\'t change it after.', 'easybook' ),
			'default'     => 'widget-id-1',
		),
	)
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'repeater',
	'label'       => esc_attr__( 'Footer Widgets', 'easybook' ),
	'section'     => 'footer_options',
	'priority'    => 10,
	'row_label' => array(
		'type'  => 'field',
		'value' => esc_attr__('Widget Area', 'easybook' ),
		'field' => 'title',
	),
	'settings'    => 'footer_widget',
	'default'     => easybook_get_footer_widgets_default(),
	'fields' => array(
		'title' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Widget Title', 'easybook' ),
			'description' => esc_attr__( 'This will be the label for your widget area', 'easybook' ),
			'default'     => '',
		),
		'classes' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Widget Classes', 'easybook' ),
			'description' => esc_attr__( 'This will be used to layout your widget', 'easybook' ),
			'default'     => 'col-md-3',
		),
		'widid' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Widget ID', 'easybook' ),
			'description' => esc_attr__( 'This value must be unique. And don\'t change it after.', 'easybook' ),
			'default'     => 'widget-id-1',
		),
	)
) );

EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'repeater',
	'label'       => esc_attr__( 'Footer Widgets Bottom', 'easybook' ),
	'section'     => 'footer_options',
	'priority'    => 10,
	'row_label' => array(
		'type'  => 'field',
		'value' => esc_attr__('Widget Area', 'easybook' ),
		'field' => 'title',
	),
	'settings'    => 'footer_widgets_bottom',
	'default'     => array(
		array(
            'title' => esc_attr__( 'Get in Touch', 'easybook' ),
            'classes'  => 'col-sm-12 col-md-4 hide-wid-title',
            'widid'    => 'footer-get-in-touch',
        ),
        array(
            'title' => esc_attr__( 'Customer support', 'easybook' ),
            'classes'  => 'col-sm-12 col-md-8 hide-wid-title',
            'widid'    => 'footer-customer-support',
        ),
	),
	'fields' => array(
		'title' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Widget Title', 'easybook' ),
			'description' => esc_attr__( 'This will be the label for your widget area', 'easybook' ),
			'default'     => '',
		),
		'classes' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Widget Classes', 'easybook' ),
			'description' => esc_attr__( 'This will be used to layout your widget', 'easybook' ),
			'default'     => 'col-md-3',
		),
		'widid' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Widget ID', 'easybook' ),
			'description' => esc_attr__( 'This value must be unique. And don\'t change it after.', 'easybook' ),
			'default'     => 'widget-id-1',
		),
	)
) );


EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'image',
	'settings'    => 'footer_backg',
	'label'       => esc_html__( 'Footer Background', 'easybook' ),
	'section'     => 'footer_options',
	'default'     => '',
	'priority'    => 10,
	'choices'     => array(
		'save_as' => 'id',
	),
	
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'select',
	'settings'    => 'show_subscribe',
	'label'       => esc_html__( 'Show Footer Subscribe', 'easybook' ),
	'section'     => 'footer_options',
	'default'     => 'no',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
		'yes' => esc_html__('Show', 'easybook'),
        'no' => esc_html__('Hidden', 'easybook'),
	),
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'textarea',
	'settings'    => 'footer_subscribe',
	'label'       => esc_html__( 'Subscribe Text', 'easybook' ),
	'description'       => esc_html__( 'Enter footer subscribe text for your site.', 'easybook' ),
	'section'     => 'footer_options',
	'default'     => '<h3>Subscribe</h3>
<p>Want to be notified when we launch a new template or an udpate. Just sign up and well send you a notification by email.</p>',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'textarea',
	'settings'    => 'footer_copyright',
	'label'       => esc_html__( 'Copyright Text', 'easybook' ),
	'description'       => esc_html__( 'Enter footer copyright text for your site.', 'easybook' ),
	'section'     => 'footer_options',
	'default'     => '<span class="ft-copy">&#169; EasyBook 2019. All rights reserved. </span>',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'textarea',
	'settings'    => 'subfooter_nav',
	'label'       => esc_html__( 'Sub Text', 'easybook' ),
	'description'       => esc_html__( 'Enter sub footer text for your site.', 'easybook' ),
	'section'     => 'footer_options',
	'default'     => '<div class="subfooter-lang">
					    <div class="subfooter-show-lang"><span>Eng</span><i class="fa fa-caret-up"></i></div>
					    <ul class="subfooter-lang-tooltip">
					        <li><a href="#">Dutch</a></li>
					        <li><a href="#">Italian</a></li>
					        <li><a href="#">French</a></li>
					        <li><a href="#">Spanish</a></li>
					    </ul>
					</div>
					<div class="subfooter-nav">
					    <ul>
					        <li><a href="#">Terms of use</a></li>
					        <li><a href="#">Privacy Policy</a></li>
					        <li><a href="#">Blog</a></li>
					    </ul>
					</div>',
	'priority'    => 10,
) );
// 404 error page
EasyBook_Kirki::add_section( 'error404_options', array(
    'title'          => esc_html__( 'Error 404 Options', 'easybook' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'image',
	'settings'    => 'error404_bg',
	'label'       => esc_html__( 'Background Image', 'easybook' ),
	'section'     => 'error404_options',
	'default'     => get_template_directory_uri().'/assets/images/bg/29.jpg',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'textarea',
	'settings'    => 'error404_msg',
	'label'       => esc_html__( 'Additional Message', 'easybook' ),
	'section'     => 'error404_options',
	'default'     => '',
	'priority'    => 10,
) );
EasyBook_Kirki::add_field( 'easybook_configs', array(
	'type'        => 'toggle',
	'settings'    => 'error404_btn',
	'label'       => esc_html__( 'Show back Home', 'easybook' ),
	'section'     => 'error404_options',
	'default'     => '1',
	'priority'    => 10,
) );