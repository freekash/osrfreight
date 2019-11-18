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
<div class="fl-wrap list-single-header-column">
    <a href="#listing-booking-form-sss" class="lisd-link"><i class="fal fa-bookmark"></i><?php esc_html_e( '  Book Now ', 'easybook-add-ons' ); ?></a>
    <a class="custom-scroll-link lisd-link" href="#listing-add-review"><i class="fal fa-comment-alt-check"></i><?php esc_html_e( 'Add Comment ', 'easybook-add-ons' ); ?></a>
    <?php if(easybook_addons_get_option('show_listing_view') === 'yes'): ?><span class="viewed-counter lisd-link"><?php echo sprintf(__( '<i class="fal fa-eye"></i> Viewed - %s', 'easybook-add-ons' ), Esb_Class_LStats::get_stats(get_the_ID())); ?></span><?php endif; ?>
</div>


