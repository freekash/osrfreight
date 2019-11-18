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


// if(!easybook_addons_get_option('single_show_rating')) return;
$rating = easybook_addons_get_average_ratings(get_the_ID());       
if($rating):
?>
<div class="listing-rating card-popup-rainingvis" data-rating="<?php echo esc_attr( $rating['rating'] );?>" data-stars="<?php echo esc_attr( easybook_addons_get_option('rating_base') ); ?>">
    <!-- <span>(<?php echo esc_html( $rating['count'] );?><?php esc_html_e( ' comments',  'easybook-add-ons' );?>)</span> -->
</div>
<?php else : ?>
<!-- <div class="listing-rating">
    <span><?php esc_html_e( 'Not comment yet', 'easybook-add-ons' );?></span>
</div> -->
<?php endif;
