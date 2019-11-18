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


if(!isset($location)) $location = '';
if(!isset($contact_infos)) $contact_infos = array(
												'address' => '',												
												'latitude' => '',												
												'longitude' => '',												
												'phone' => '',												
												'email' => '',												
												'website' => '',												
											);
// new arg for hide location from back-end
if(!isset($hide_location)) $hide_location = false;
?>
<?php if($hide_location != true): ?>
<label><?php _e( 'Location<i class="fa fa-map-marker"></i>', 'easybook-add-ons' );?></label>
<input class="has-icon" id="location" type="text" name="locations" placeholder="<?php esc_attr_e( 'Region of your business', 'easybook-add-ons' );?>" value="<?php echo esc_attr( $location );?>"/>
<?php endif; ?>
<div class="contact-infos-wrap">
    <div class="row listing-submit-contacts-row">
        <div class="col-md-6 listing-submit-address-col">
            <label for="address"><?php esc_html_e( 'Address', 'easybook-add-ons' );?></label>
            <input type="text" id="contact_infos_address" name="address" placeholder="<?php esc_attr_e( 'Address of your business', 'easybook-add-ons' );?>" value="<?php echo esc_attr( $contact_infos['address'] );?>"/>

            <div class="row submit-latlng listing-submit-latlng-row">
                <div class="col-md-6">
                    <label for="latitude"><?php esc_html_e( 'Latitude', 'easybook-add-ons' );?></label>
                    <input type="text" id="contact_infos_latitude" name="latitude" value="<?php echo esc_attr( $contact_infos['latitude'] );?>"/>
                </div>
                <div class="col-md-6">
                    <label for="longitude"><?php esc_html_e( 'Longitude', 'easybook-add-ons' );?></label>
                    <input type="text" id="contact_infos_longitude" name="longitude" value="<?php echo esc_attr( $contact_infos['longitude'] );?>"/>
                </div>
            </div>
        </div>
        <!-- col-md-6 -->
        <div class="col-md-6 listing-submit-map-col">
            <div class="map-container">
                <div class="submitMap" data-lat="<?php echo esc_attr( $contact_infos['latitude'] );?>" data-lng="<?php echo esc_attr( $contact_infos['longitude'] );?>"></div>
            </div>
        </div>
    </div>
        	

    <label><?php esc_html_e( 'Phone', 'easybook-add-ons' );?><i class="fa fa-phone"></i></label>
    <input class="has-icon" type="text" name="author_phone" placeholder="<?php esc_attr_e( 'Your Phone', 'easybook-add-ons' );?>" value="<?php echo esc_attr( $contact_infos['phone'] );?>"/>
    <label><?php esc_html_e( 'Email', 'easybook-add-ons' );?><i class="fa fa-envelope-o"></i></label>
    <input class="has-icon" type="text" name="author_email" placeholder="<?php esc_attr_e( 'Your Email', 'easybook-add-ons' );?>" value="<?php echo esc_attr( $contact_infos['email'] );?>"/>
    <label><?php esc_html_e( 'Website', 'easybook-add-ons' );?><i class="fa fa-globe"></i></label>
    <input class="has-icon" type="text" name="author_website" placeholder="<?php esc_attr_e( 'Your Website', 'easybook-add-ons' );?>" value="<?php echo esc_attr( $contact_infos['website'] );?>"/>
</div>