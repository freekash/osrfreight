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


// $contact_infos = get_post_meta( get_the_ID(), '_cth_contact_infos', true );
$contact_infos = array(
                    // 'address' => get_post_meta( get_the_ID(), '_cth_contact_infos_address', true ),
                    'latitude' => get_post_meta( get_the_ID(), ESB_META_PREFIX.'latitude', true ),
                    'longitude' => get_post_meta( get_the_ID(), ESB_META_PREFIX.'longitude', true ),
                    'phone' => get_post_meta( get_the_ID(), ESB_META_PREFIX.'phone', true ),
                    'email' => get_post_meta( get_the_ID(), ESB_META_PREFIX.'email', true ),
                    // 'website' => get_post_meta( get_the_ID(), '_cth_contact_infos_website', true ),
                );


?>
<div class="mb-btns-wrap">
    <div class="mb-btns">
        
            <?php 
            if($contact_infos['phone']): ?>
            <a href="tel:<?php echo esc_html( $contact_infos['phone'] );?>" class="mb-btn mb-btn-call"><i class="fa fa-phone"></i></a>
            <?php endif;?>

            <?php 
            if($contact_infos['email']): ?>
            <!-- <a href="mailto:<?php echo esc_html( $contact_infos['email'] ) ;?>" class="mb-btn mb-btn-booking"><i class="fa fa-envelope"></i></a> -->
            <?php endif;?>

            <?php 
            if ('yes' == get_post_meta( get_the_ID(), '_cth_widget_booking', true ) && easybook_addons_get_option('submit_hide_booking_opt') != 'yes' ): ?>
            <a href="#listing-booking-widget" class="mb-btn mb-btn-booking cth-scroll-link"><i class="fa fa-envelope"></i></a>
            <?php endif;?>
            
            <?php 
            if($contact_infos['longitude'] != '' && $contact_infos['longitude'] != ''): ?>
            <a class="mb-btn mb-btn-direction" href="https://www.google.com/maps/search/?api=1&query=<?php echo $contact_infos['latitude'].','.$contact_infos['longitude'];?>" target="_blank"><i class="fa fa-map-marker"></i></a>
            <?php endif;?>
            
     
        
    </div>
</div>