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
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function easybook_body_classes( $classes ) {
	// Add class for globally reset
    $classes[] = 'body-easybook';
	// $classes[] = 'folio-archive-'.easybook_get_option('folio_layout');


    if(post_password_required()) $classes[] = 'is-protected-page';

	// Add class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Add class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add class if we're viewing the Customizer for easier styling of theme options.
	if ( is_customize_preview() ) {
		$classes[] = 'easybook-customizer';
	}

	// Add class on front page.
	if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
		$classes[] = 'easybook-front-page';
	}

	return $classes;
}
add_filter( 'body_class', 'easybook_body_classes' );



/**
 * Return attachment image link by using wp_get_attachment_image_src function
 *
 */
function easybook_get_attachment_thumb_link( $id, $size = 'thumbnail' ){
    $image_attributes = wp_get_attachment_image_src( $id, $size, false );
    if ( $image_attributes ) {
        return $image_attributes[0];
    }
    return '';
}

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since EasyBook 1.2
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function easybook_content_image_sizes_attr( $sizes, $size ) {
    return '';
}

add_filter( 'wp_calculate_image_sizes', 'easybook_content_image_sizes_attr', 10, 2 );


if(!function_exists('easybook_get_template_part')){
    /**
     * Load a template part into a template
     *
     * Makes it easy for a theme to reuse sections of code in a easy to overload way
     * for child themes.
     *
     * Includes the named template part for a theme or if a name is specified then a
     * specialised part will be included. If the theme contains no {slug}.php file
     * then no template will be included.
     *
     * The template is included using require, not require_once, so you may include the
     * same template part multiple times.
     *
     * For the $name parameter, if the file is called "{slug}-special.php" then specify
     * "special".
      * For the var parameter, simple create an array of variables you want to access in the template
     * and then access them e.g. 
     * 
     * array("var1=>"Something","var2"=>"Another One","var3"=>"heres a third";
     * 
     * becomes
     * 
     * $var1, $var2, $var3 within the template file.
     *
     *
     * @param string $slug The slug name for the generic template.
     * @param string $name The name of the specialised template.
     * @param array $vars The list of variables to carry over to the template
     * @author CTHthemes 
     * @ref http://www.zmastaa.com/2015/02/06/php-2/wordpress-passing-variables-get_template_part
     * @ref http://keithdevon.com/passing-variables-to-get_template_part-in-wordpress/
     */
    function easybook_get_template_part( $slug, $name = null, $vars = null ) {

        $template = "{$slug}.php";
        $name = (string) $name;
        if ( '' !== $name && ( file_exists( get_stylesheet_directory() ."/{$slug}-{$name}.php") || file_exists( get_template_directory() ."/{$slug}-{$name}.php") ) ) {
            $template = "{$slug}-{$name}.php";
        }

        if(isset($vars)) extract($vars);
        include(locate_template($template));
    }
}
if(!function_exists('easybook_get_the_password_form')){
    function easybook_get_the_password_form($post = 0){
        $post = get_post( $post );
        $label = 'pwbox-' . ( empty($post->ID) ? rand() : $post->ID );
        $output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">
        <p>' . esc_html__( 'This content is password protected. To view it please enter your password below:' , 'easybook') . '</p>
        <p class="post-password-fields"><label for="' . $label . '"><span class="screen-reader-text">' . esc_html__( 'Password:', 'easybook' ) . '</span><input name="post_password" id="' . $label . '" type="password" size="20" /></label><input type="submit" name="Submit" value="' . esc_attr_x( 'Enter', 'post password form', 'easybook' ) . '" /></p></form>
        ';

        return $output ;
    }
}
add_filter('the_password_form','easybook_get_the_password_form' );

if(!function_exists('easybook_get_kirki_dynamic_css')){
    function easybook_get_kirki_dynamic_css($styles){
        if(easybook_get_option('use_custom_color', false)){
            return $styles;
        }else{
            return '';
        }
    }
}
add_filter('kirki/easybook_configs/dynamic_css','easybook_get_kirki_dynamic_css' );


/**
 * Modify category count format
 *
 * @since EasyBook 1.0
 */
function easybook_custom_category_count_widget($output) {
    return preg_replace("/<\/a>\s*(\([\d]+\))\s*</", '</a><span>$1</span><', $output);
}
add_filter('wp_list_categories', 'easybook_custom_category_count_widget');

/**
 * Modify archive count format
 *
 * @since EasyBook 1.0
 */
function easybook_custom_archives_count_widget($link_html) {
    return preg_replace("/&nbsp;([\s(\d)]*)/", '<span>$1</span>', $link_html);
}
add_filter('get_archives_link', 'easybook_custom_archives_count_widget');


function easybook_style_widget_title($title){
    if(!$title) return '&nbsp;';

    return $title;
}
add_filter( 'widget_title', 'easybook_style_widget_title' );


function easybook_relative_protocol_url(){
    return is_ssl() ? 'https' : 'http';
}

// if( is_admin() && current_user_can( 'edit_users' ) ){
//     $blogusers = get_users( array( 'role__not_in' => array('administrator'), 'fields' => array( 'ID', 'first_name', 'last_name' ) ) );
//     // Array of stdClass objects.
//     foreach ( $blogusers as $user ) {
//         wp_update_user( array( 'ID' => $user->ID, 'display_name' => $user->first_name ) );
//     }
// }
