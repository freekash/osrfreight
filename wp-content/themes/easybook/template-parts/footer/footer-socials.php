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
 * Displays footer widgets if assigned
 *
 */

?>
<div class="footer-social">
	<?php
	if ( has_nav_menu( 'social' ) ) : 
		wp_nav_menu( array(
			'theme_location' => 'social',
			'menu_class'     => 'social-links-menu',
			'container'       => '',
            'container_class' => '',
            'container_id'    => '',
			'depth'          => 1,
			'link_before'    => '<span>',
			'link_after'     => '</span>',
		) );
	endif;
	?>
</div>
