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



//$azp_attrs,$azp_content,$azp_element
$azp_mID = $el_id = $el_class = $images_to_show = $hide_widget_on = ''; 

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_widget_booking',
    'azp-element-' . $azp_mID,
    $el_class,
);
// $animation_data = self::buildAnimation($azp_attrs);  
// $classes[] = $animation_data['trigger'];
// $classes[] = self::buildTypography($azp_attrs);//will return custom class for the element without dot 
// $azplgallerystyle = self::buildStyle($azp_attrs);

$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) );

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}

// var_dump($_POST);

// array(5) { ["checkout"]=> string(10) "2018-12-20" ["checkin"]=> string(10) "2018-12-19" ["lb_adults"]=> string(1) "1" ["lb_children"]=> string(1) "0" ["rooms"]=> array(1) { [5174]=> string(1) "2" } }
if(( $hide_widget_on_check = easybook_addons_is_hide_on_plans($hide_widget_on) ) !== 'true') :
if(get_post_meta( get_the_ID(), ESB_META_PREFIX.'rooms_ids', true ) != ''){
?>
<div class="<?php echo $classes; ?> authplan-hide-<?php echo $hide_widget_on_check;?>" <?php echo $el_id;?>>
    <div class="for-hide-on-author"></div>
	<div class="booking-form-wrap fl-wrap" id="listing-booking-form-sss">
	    <div class="booking-form-header">
	        <h3><?php esc_html_e( 'Book This Hotel: ', 'easybook-add-ons' ); ?></h3>  
	    </div>
	    <div class="booking-form-item">
	        <div class="booking-form-content">
	            <div id="bookingform-app" data-format="<?php _ex( 'DD/MM/YYYY', 'rooms booking date format', 'easybook-add-ons' ); ?>"></div>
	        </div>
	    </div>
	</div>
</div>
<?php
}

endif; 