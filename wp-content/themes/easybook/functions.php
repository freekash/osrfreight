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
 * EasyBook functions and definitions 
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */


/**
 * EasyBook only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '5.0', '<' ) ) { 
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

if(!isset($easybook_options)) $easybook_options = get_option( 'easybook_options', array() );  




/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function easybook_setup() {
	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'easybook' , get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	easybook_get_thumbnail_sizes();

	// Set the default content width.
	$GLOBALS['content_width'] = 744;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => esc_html__( 'Top Menu', 'easybook' ),
		'social' => esc_html__( 'Social Links Menu', 'easybook' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 225,
		'height'      => 44,
		'flex-width'  => true,
		'flex-height' => true,
		'header-text' => array( 'site-title', 'site-description' ),

	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', easybook_fonts_url() ) );

	
}
add_action( 'after_setup_theme', 'easybook_setup' );

if(!function_exists('easybook_get_thumbnail_sizes')){
    function easybook_get_thumbnail_sizes(){
    	// options default must have these values
    	if(!easybook_get_option('enable_custom_sizes')) return;
        $option_sizes = array(
        	'easybook-listing-grid'=>'thumb_size_opt_4',
        	'easybook-lcat-one'=>'thumb_size_opt_5',
        	'easybook-lcat-two'=>'thumb_size_opt_6',
        	'easybook-lcat-three'=>'thumb_size_opt_7',
        	'easybook-post-grid'=>'thumb_size_opt_8',
        	'easybook-featured-image'=>'thumb_size_opt_9',
        	'easybook-single-image'=>'thumb_size_opt_10',
        	'easybook-recent-post'=>'thumb_size_opt_11'
        );

       	foreach ($option_sizes as $name => $opt) {
       		$option_size = easybook_get_option($opt);
       		if($option_size !== false && is_array($option_size)){
       			$size_val = array(
       				'width' => (isset($option_size['width']) && !empty($option_size['width']) )? (int)$option_size['width'] : (int)'9999',
       				'height' => (isset($option_size['height']) && !empty($option_size['height']) )? (int)$option_size['height'] : (int)'9999',
       				'hard_crop' => (isset($option_size['hard_crop']) && !empty($option_size['hard_crop']) )? (bool)$option_size['hard_crop'] : (bool)'0',
       			);

       			add_image_size( $name, $size_val['width'], $size_val['height'], $size_val['hard_crop'] );
       		}
       	}
    }
}
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function easybook_content_width() {

	$content_width = $GLOBALS['content_width'];


	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 806;
	}

	/**
	 * Filter EasyBook content width of the theme.
	 *
	 * @since EasyBook 1.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'easybook_content_width', $content_width );
}
add_action( 'template_redirect', 'easybook_content_width', 0 );



/**
 * Add preconnect for Google Fonts.
 *
 * @since EasyBook 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function easybook_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'easybook-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => '//fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'easybook_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function easybook_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'easybook' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'easybook' ),
		'before_widget' => '<div id="%1$s" class="box-widget-item fl-wrap easybook-mainsidebar-widget main-sidebar-widget %2$s">', 
        'before_title' => '<div class="box-widget-item-header"><h3 class="widget-title">', 
        'after_title' => '</h3></div><div class="box-widget">',
        'after_widget' => '</div></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Page Sidebar', 'easybook' ),
		'id'            => 'sidebar-2',
		'description' => esc_html__('Appears in the sidebar section of the page template.', 'easybook'), 
        'before_widget' => '<div id="%1$s" class="box-widget-item fl-wrap easybook-pagesidebar-widget page-sidebar-widget %2$s">', 
        'before_title' => '<div class="box-widget-item-header"><h3 class="widget-title">', 
        'after_title' => '</h3></div><div class="box-widget">',
        'after_widget' => '</div></div>',
	) );

    register_sidebar( array(
        'name'          => esc_html__( 'Shop Sidebar', 'easybook' ),
        'id'            => 'sidebar-shop',
        'description' => esc_html__('Appears in the sidebar section of the shop pages.', 'easybook'), 
        'before_widget' => '<div id="%1$s" class="box-widget-item fl-wrap easybook-shopsidebar-widget shop-sidebar-widget %2$s">', 
        'before_title' => '<div class="box-widget-item-header"><h3 class="widget-title">', 
        'after_title' => '</h3></div><div class="box-widget">',
        'after_widget' => '</div></div>',
    ) );
     register_sidebar( array(
        'name'          => esc_html__( 'Languages Switcher', 'easybook' ),
        'id'            => 'sidebar-lang',
        'description' => esc_html__('Appears in the header section of the pages.', 'easybook'), 
        'before_widget' => '<div id="%1$s" class="fl-wrap easybook-lang-switcher lang-sidebar-widget %2$s">', 
        // 'before_title' => '<div class="box-widget-item-header"><h3 class="widget-title">', 
        // 'after_title' => '</h3></div><div class="box-widget">',
        'after_widget' => '</div>',
    ) );

    

	
	$footer_widgets = easybook_get_option('footer_widget'); 
	if ($footer_widgets) {
        foreach ($footer_widgets as  $widget) {
            if($widget['title']&&$widget['classes']){
                register_sidebar(
                    array(
                        'name' => $widget['title'], 
                        'id' => $widget['widid'],
                        'before_widget' => '<div id="%1$s" class="footer-widget fl-wrap %2$s">', 
                        'after_widget' => '</div>', 
                        'before_title' => '<h3 class="wid-tit">', 
                        'after_title' => '</h3>',
                    )
                );
            }
        }
    }

    $footer_widgets = easybook_get_option('footer_widgets_bottom',array());
    if ($footer_widgets) {
        foreach ($footer_widgets as  $widget) {
            if($widget['title']&&$widget['classes']){
                register_sidebar(
                    array(
                        'name' => $widget['title'], 
                        'id' => $widget['widid'], 
                        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">', 
                        'after_widget' => '</div>', 
                        'before_title' => '<h3 class="widgets-titles">', 
                        'after_title' => '</h3>',
                    )
                );
            }
        }
    }
    $footer_widgets = easybook_get_option('footer_widgets_top',array());
    if ($footer_widgets) {
        foreach ($footer_widgets as  $widget) {
            if($widget['title']&&$widget['classes']){
                register_sidebar(
                    array(
                        'name' => $widget['title'], 
                        'id' => $widget['widid'], 
                        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">', 
                        'after_widget' => '</div>', 
                        'before_title' => '<h3 class="widgets-titles">', 
                        'after_title' => '</h3>',
                    )
                );
            }
        }
    }



}
add_action( 'widgets_init', 'easybook_widgets_init' );


/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since EasyBook 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function easybook_excerpt_more( $link ) {
	
	return ' &hellip; ';
}
add_filter( 'excerpt_more', 'easybook_excerpt_more' );


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function easybook_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'easybook_pingback_header' );


/**
 * Register custom fonts.
 */
function easybook_fonts_url() {
	$fonts_url = '';
    $font_families     = array();

    
    if ( 'off' !== esc_html_x( 'on', 'Nunito font: on or off', 'easybook' ) ) {
        $font_families[] = 'Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i';
    }

    
    if ( 'off' !== esc_html_x( 'on', 'Montserrat font: on or off', 'easybook' ) ) {
        $font_families[] = 'Montserrat:400,500,600,700,800,900';
    }

    if ( 'off' !== esc_html_x( 'on', 'Quicksand font: on or off', 'easybook' ) ) {
        $font_families[] = 'Quicksand:300,400,500,700';
    }


    if ( $font_families ) {
    	$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'cyrillic,cyrillic-ext,latin-ext,vietnamese' ),
		);

        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }

    return esc_url_raw( $fonts_url );

}

/**
 * Enqueue scripts and styles.
 */
function easybook_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'easybook-fonts', easybook_fonts_url(), array(), null );
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.7.0'); 
    wp_enqueue_style( 'lightgallery', get_template_directory_uri() . '/assets/css/lightgallery.min.css', array(), '1.2.13'); 
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.min.css', array(), '1.9.0'); 
    // wp_enqueue_style( 'daterangepicker', get_theme_file_uri( '/assets/css/daterangepicker.css' ), array(  ), null );
	wp_enqueue_style( 'easybook-plugins', get_theme_file_uri( '/assets/css/plugins.css' ), array(  ), null );
	// Theme stylesheet.
	wp_enqueue_style( 'easybook-style', get_stylesheet_uri() );
	wp_enqueue_style( 'easybook-color', get_theme_file_uri( '/assets/css/color.min.css' ), array(  ), null );
    if(easybook_get_option('use_custom_color', false) && easybook_get_option('theme-color') != '#4DB7FE'){
        wp_add_inline_style( 'easybook-color', easybook_overridestyle() );
    }
    wp_add_inline_style( 'easybook-color', easybook_custom_fonts() );
    wp_enqueue_script( "jquery-easing", get_theme_file_uri( '/assets/js/jquery.easing.min.js' ), array('jquery'), '1.4.0', true);
    wp_enqueue_script( "jquery-appear", get_theme_file_uri( '/assets/js/jquery.appear.js' ) , array(), '0.3.6', true);
    wp_enqueue_script( "scrollax", get_theme_file_uri( '/assets/js/Scrollax.js' ) , '1.0.0', true);
    wp_enqueue_script( "jquery-countto", get_theme_file_uri( '/assets/js/jquery.countTo.js' ) , array(), null, true);
    wp_enqueue_script( "slidingmenu", get_theme_file_uri( '/assets/js/navigation.js' ) , array(), null, true);
    wp_enqueue_script( "jquery-slick", get_theme_file_uri( '/assets/js/slick.min.js' ) , array(), '1.9.0', true);
    wp_enqueue_script( "lightgallery", get_theme_file_uri( '/assets/js/lightgallery.min.js' ) , array(), '1.2.13', true);
    wp_enqueue_script( "singlepagenav", get_theme_file_uri( '/assets/js/jquery.singlePageNav.min.js' ) , array(), null, true);
    wp_enqueue_script( "moment", get_theme_file_uri( '/assets/js/moment.min.js' ) , array(), '1.2.13', true);
    // wp_enqueue_script( "daterangepicker", get_theme_file_uri( '/assets/js/daterangepicker.js' ) , array(), null , true);
    wp_enqueue_script( "fontawesome-iconpicker", get_theme_file_uri( '/assets/js/fontawesome-iconpicker.min.js' ) , array(), null , true);
	wp_enqueue_script( 'easybook-scripts', get_theme_file_uri( '/assets/js/scripts.js' ), array( 'jquery', 'imagesloaded' ), null , true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'easybook_scripts' );

// modify tag cloud
function easybook_widget_tag_cloud_args($args = array()){
    $args['number'] = 7; // default 45

    return $args;
}
add_filter( 'widget_tag_cloud_args', 'easybook_widget_tag_cloud_args' );


/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/include-kirki.php' );
require get_parent_theme_file_path( '/inc/cththemes-kirki.php' );
require get_parent_theme_file_path( '/inc/kirki-customizer.php' );


/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );
require get_parent_theme_file_path( '/inc/color-patterns.php' );


require_once get_parent_theme_file_path( '/inc/woo-init.php' );


/**
 * Implement the One Click Demo Import plugin
 *
 * @since EasyBook 1.0
 */
require_once get_parent_theme_file_path( '/inc/one-click-import-data.php' );



if( true == easybook_get_option('enable_auto_update') ){
    require_once get_parent_theme_file_path( '/lib/update/cththemes-auto-update.php' );
}

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_parent_theme_file_path( '/lib/class-tgm-plugin-activation.php' );

add_action('tgmpa_register', 'easybook_register_required_plugins');

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function easybook_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        array(
            'name' => esc_html__('Elementor Page Builder','easybook'),
             // The plugin name.
            'slug' => 'elementor',
             // The plugin slug (typically the folder name).
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(easybook_relative_protocol_url().'://wordpress.org/plugins/elementor/' ),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => 'elementor_load_plugin_textdomain',
            'class_to_check'            => '\Elementor\Plugin'
        ), 

        array(
            'name' => esc_html__('Contact Form 7','easybook'),
             // The plugin name.
            'slug' => 'contact-form-7',
             // The plugin slug (typically the folder name).
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(easybook_relative_protocol_url().'://wordpress.org/plugins/contact-form-7/' ),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => 'wpcf7',
            'class_to_check'            => 'WPCF7'
        ), 

        array(
            'name' => esc_html__('CMB2','easybook'),
             // The plugin name.
            'slug' => 'cmb2',
             // The plugin slug (typically the folder name).
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(easybook_relative_protocol_url().'://wordpress.org/support/plugin/cmb2'),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => 'cmb2_bootstrap',
            'class_to_check'            => 'CMB2_Base'
        ),
        array(
            'name' => esc_html__('Kirki','easybook'),
             // The plugin name.
            'slug' => 'kirki',
             // The plugin slug (typically the folder name).
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(easybook_relative_protocol_url().'://wordpress.org/plugins/kirki/'),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => '',
            'class_to_check'            => 'Kirki'
        ),
        array(
            'name' => esc_html__('EasyBook Add-ons','easybook' ),
             // The plugin name.
            'slug' => 'easybook-add-ons',
             // The plugin slug (typically the folder name).
            // 'source' => cththemes_auto_update()->api()->deferred_download( 5302, 'install_plugin' ), // 'easybook-add-ons.zip',
            'source' => 'easybook-add-ons.zip', // 'easybook-add-ons.zip',
             // The plugin source.
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.

            'function_to_check'         => '',
            'class_to_check'            => 'EasyBook_Addons'
        ), 

        array(
            'name' => esc_html__('EasyBook WooCommerce Payments','easybook' ),
             // The plugin name.
            'slug' => 'easybook-woo-payments',
             // The plugin slug (typically the folder name).
            // 'source' => cththemes_auto_update()->api()->deferred_download( 5368, 'install_plugin' ), // 'easybook-add-ons.zip',
            'source' => 'easybook-woo-payments.zip', // 'easybook-add-ons.zip',
             // The plugin source.
            'required' => false,
             // If false, the plugin is only 'recommended' instead of required.

            'function_to_check'         => '',
            'class_to_check'            => 'CTH_Woo_Payments'
        ), 


        array(
            'name' => esc_html__('Loco Translate','easybook'),
             // The plugin name.
            'slug' => 'loco-translate',
             // The plugin slug (typically the folder name).
            'required' => false,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(easybook_relative_protocol_url().'://wordpress.org/plugins/loco-translate/'),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => 'loco_autoload',
            'class_to_check'            => 'Loco_Locale'
        ),

        
        // array(
        //     'name' => esc_html__('Envato Market','easybook' ),
        //      // The plugin name.
        //     'slug' => 'envato-market',
        //      // The plugin slug (typically the folder name).
        //     'source' => esc_url(easybook_relative_protocol_url().'://envato.github.io/wp-envato-market/dist/envato-market.zip' ),
        //      // The plugin source.
        //     'required' => true,
        //      // If false, the plugin is only 'recommended' instead of required.
        //     'external_url' => esc_url('//envato.github.io/wp-envato-market/' ),
        //      // If set, overrides default API URL and points to an external URL.

        //     'function_to_check'         => 'envato_market',
        //     'class_to_check'            => 'Envato_Market'
        // ),

        array('name' => esc_html__('One Click Demo Import','easybook'),
             // The plugin name.
            'slug' => 'one-click-demo-import',
             // The plugin slug (typically the folder name).
            'required' => false,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(easybook_relative_protocol_url().'://wordpress.org/plugins/one-click-demo-import/'),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => '',
            'class_to_check'            => 'OCDI_Plugin'
        ),

        array('name' => esc_html__('Regenerate Thumbnails','easybook'),
             // The plugin name.
            'slug' => 'regenerate-thumbnails',
             // The plugin slug (typically the folder name).
            'required' => false,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(easybook_relative_protocol_url().'://wordpress.org/plugins/regenerate-thumbnails/' ),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => 'RegenerateThumbnails',
            'class_to_check'            => 'RegenerateThumbnails'
        ),

        array('name' => esc_html__('WP Facebook Login for WordPress','easybook'),
             // The plugin name.
            'slug' => 'wp-facebook-login',
             // The plugin slug (typically the folder name).
            'required' => false,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(easybook_relative_protocol_url().'://wordpress.org/plugins/wp-facebook-login/' ),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => 'run_facebook_login',
            'class_to_check'            => 'Facebook_Login'
        ),

        array('name' => esc_html__('WordPress Social Login (Facebook, Google, Twitter)','easybook'),
             // The plugin name.
            'slug' => 'miniorange-login-openid',
             // The plugin slug (typically the folder name).
            'required' => false,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(easybook_relative_protocol_url().'://wordpress.org/plugins/miniorange-login-openid/' ),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => '',
            'class_to_check'            => 'Miniorange_OpenID_SSO'
        ),




    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id'           => 'easybook',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => get_template_directory() . '/lib/plugins/',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

        
    );

    tgmpa( $plugins, $config );
}




