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


// if( easybook_addons_check_package_single_field( 'hide_contacts_info' ) ) return;
// $contact_infos = get_post_meta( get_the_ID(), '_cth_contact_infos', true );
$contact_infos = array(
    'address' => get_post_meta( get_the_ID(), '_cth_address', true ),
    'latitude' => get_post_meta( get_the_ID(), '_cth_latitude', true ),
    'longitude' => get_post_meta( get_the_ID(), '_cth_longitude', true ),
    'phone' => get_post_meta( get_the_ID(), '_cth_author_phone', true ),
    'email' => get_post_meta( get_the_ID(), '_cth_author_email', true ),
    'website' => get_post_meta( get_the_ID(), '_cth_author_website', true ), 
);



?>
<div class="list-single-header-contacts fl-wrap"> 
    <ul>
    	<?php if(!empty($contact_infos['phone'])): ?> 
        <li><i class="far fa-phone"></i><a  href="tel:<?php echo esc_html( $contact_infos['phone'] );?>"><?php echo esc_html( $contact_infos['phone'] ) ;?></a></li>
        <?php endif;?>
        <?php if(!empty($contact_infos['latitude']) && !empty($contact_infos['longitude']) && !empty($contact_infos['address'])): ?>
        <li><i class="far fa-map-marker-alt"></i><a href="https://www.google.com/maps/search/?api=1&query=<?php echo $contact_infos['latitude'].','.$contact_infos['longitude'];?>" target="_blank"><?php echo esc_attr( $contact_infos['address'] );?></a></li>
        <?php endif;?>
        <?php if(!empty($contact_infos['email'])): ?>
        <li><i class="far fa-envelope"></i><a  href="mailto:<?php echo esc_html( $contact_infos['email'] ) ;?>"><?php echo esc_html( $contact_infos['email'] ) ;?></a></li>
        <?php endif;?>
    </ul>
</div>
