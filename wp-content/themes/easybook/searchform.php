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



?>
<form role="search" method="get" action="<?php echo esc_url(home_url( '/' ) ); ?>" class="fl-wrap">
    <input name="s" type="text" class="search" placeholder="<?php echo esc_attr_x( 'Search...', 'search input placeholder','easybook' ) ?>" value="<?php echo get_search_query() ?>" />
    <button class="search-submit" type="submit"><i class="fa fa-search transition"></i> </button>
</form>
