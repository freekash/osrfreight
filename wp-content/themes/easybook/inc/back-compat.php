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
 * EasyBook back compat functionality
 *
 * Prevents EasyBook from running on WordPress versions prior to 5.0,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 5.0.
 *
 */

/**
 * Prevent switching to EasyBook on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since EasyBook 1.0
 */
function easybook_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'easybook_upgrade_notice' );
}
add_action( 'after_switch_theme', 'easybook_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * EasyBook on WordPress versions prior to 5.0.
 *
 * @since EasyBook 1.0
 *
 * @global string $wp_version WordPress version.
 */
function easybook_upgrade_notice() {
	$message = sprintf( esc_html__( 'EasyBook requires at least WordPress version 5.0. You are running version %s. Please upgrade and try again.', 'easybook' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 5.0.
 *
 * @since EasyBook 1.0
 *
 * @global string $wp_version WordPress version.
 */
function easybook_customize() {
	wp_die( sprintf( esc_html__( 'EasyBook requires at least WordPress version 5.0. You are running version %s. Please upgrade and try again.', 'easybook' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'easybook_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 5.0.
 *
 * @since EasyBook 1.0
 *
 * @global string $wp_version WordPress version.
 */
function easybook_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( esc_html__( 'EasyBook requires at least WordPress version 5.0. You are running version %s. Please upgrade and try again.', 'easybook' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'easybook_preview' );
