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
 * Displays top navigation
 *
 */

?>
<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'easybook' ); ?>">
    <?php 
    wp_nav_menu( 
    	array(
			'theme_location'     => 'top',
			'container'          => '',
            'container_class'    => '',
            'container_id'       => '',
			'menu_id'            => 'top-menu',
		) 
	); 
	?>
</nav><!-- #site-navigation -->
