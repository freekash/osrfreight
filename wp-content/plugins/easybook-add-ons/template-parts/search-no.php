<?php
/**
 * @package EasyBook Add-Ons
 * @description A custom plugin for EasyBook - Hotel & Tour Booking WordPress Theme
 * @author CTHthemes - http://themeforest.net/user/cththemes
 * @date 03-10-2019
 * @version 1.1.7
 * @copyright Copyright ( C ) 2014 - 2019 cththemes.com . All rights reserved.
 * @license GNU General Public License version 3 or later; see LICENSE
 */


?>
<div class="no-results-search">
	<h2><?php esc_html_e( 'No Results', 'easybook-add-ons' );?></h2>
	<p><?php esc_html_e( 'There are no listings matching your search.', 'easybook-add-ons' );?></p>
	<p><?php echo sprintf(__( 'Try changing your search filters or <a href="%1$s" class="reset-filter-link">Reset Filter</a>', 'easybook-add-ons' ), easybook_addons_get_current_url() );?></p>
</div>