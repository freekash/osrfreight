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



$address = get_post_meta( get_the_ID(), '_cth_address', true );
$latitude = get_post_meta( get_the_ID(), '_cth_latitude', true );
$longitude = get_post_meta( get_the_ID(), '_cth_longitude', true );
$phone = get_post_meta( get_the_ID(), '_cth_author_phone', true );
$email = get_post_meta( get_the_ID(), '_cth_author_email', true );
$website = get_post_meta( get_the_ID(), '_cth_author_website', true );


?>
<div class="box-widget-item fl-wrap" id="listing-contacts-widget">
	    <div class="box-widget-item-header">
	        <h3><?php esc_html_e( 'Contact Information', 'easybook-add-ons' );?></h3>
	    </div>
	    <div class="box-widget">
	        <div class="box-widget-content">
	            <div class="list-author-widget-contacts list-item-widget-contacts">
	                <ul>
	                    <?php
	                    if($address != '' && $longitude != '' && $latitude != ''): ?>
	                    <li class="list-contact-address"><span><?php _e( '<i class="fal fa-map-marker"></i> Address :', 'easybook-add-ons' );?></span> <a href="https://www.google.com/maps/search/?api=1&query=<?php echo $latitude.','.$longitude;?>" target="_blank"><?php echo esc_attr( $address );?></a></li>
	                    <?php endif;?>
	                    <?php 
	                    if($phone): ?>
	                    <li class="list-contact-phone"><span><?php _e( '<i class="fa fa-phone"></i> Phone :', 'easybook-add-ons' );?></span> <a href="tel:<?php echo esc_html( $phone );?>"><?php echo esc_html( $phone ) ;?></a></li>
	                    <?php endif;?>
	                    <?php 
	                    if($email): ?>
	                    <li class="list-contact-email"><span><?php _e( '<i class="fal fa-envelope"></i> Mail :', 'easybook-add-ons' );?></span> <a href="mailto:<?php echo esc_html( $email ) ;?>"><?php echo esc_html( $email ) ;?></a></li>
	                    <?php endif;?>
	                    <?php 
	                    if($website): ?>
	                    <li class="list-contact-website"><span><?php _e( '<i class="fal fa-browser"></i> Website :', 'easybook-add-ons' );?></span> <a href="<?php echo esc_url( $website ) ;?>" target="_blank"><?php echo esc_html( $website ) ;?></a></li>
	                    <?php endif;?>
	                </ul>
	            </div>
	            <?php 
	            $socials = get_post_meta( get_the_ID(), '_cth_socials', true );
	            if(is_array($socials) && count($socials)) : ?>
	            <div class="list-widget-social">
	                <ul>
	                    <?php 
	                    foreach ($socials as $social) {
	                        echo '<li><a href="'.esc_url( $social['url'] ).'" target="_blank" ><i class="fab fa-'.esc_attr( $social['name'] ).'"></i></a></li>';
	                    }
	                    ?>
	                </ul>
	            </div>
	            <?php 
	            endif;?>
	        </div>
	    </div>
	</div>