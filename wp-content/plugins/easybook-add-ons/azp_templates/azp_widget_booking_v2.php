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
$azp_mID = $el_id = $el_class = $custom_price = $hide_widget_on = ''; 
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_widget_booking_event',
    'azp-element-' . $azp_mID, 
    $el_class,
);
// $animation_data = self::buildAnimation($azp_attrs);  
// $classes[] = $animation_data['trigger'];
// $classes[] = self::buildTypography($azp_attrs);//will return custom class for the element without dot
// $azptextstyle = self::buildStyle($azp_attrs);
$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) ); 
if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}
if(( $hide_widget_on_check = easybook_addons_is_hide_on_plans($hide_widget_on) ) !== 'true') :
?>
<div class="<?php echo $classes; ?> authplan-hide-<?php echo $hide_widget_on_check;?>" <?php echo $el_id;?>>
    <div class="for-hide-on-author"></div>
	<div class="box-widget-item fl-wrap" id="listing-booking-widget">
	    <div class="box-widget-item-header">
	        <h3><?php esc_html_e( 'Booking: ', 'easybook-add-ons' ); ?></h3>
	    </div>
	    <div class="box-widgets">
	        <div class="box-widget-content">
	            <form class="listing-booking-form custom-form book-form" method="post"> 
	                <fieldset>
	                	<div class="booking-ticket-warp fl-wrap">
	                		<a href="#" class="bk-tick" data-lprice="<?php echo get_post_meta( get_the_ID(), ESB_META_PREFIX.$custom_price, true );?>"><?php esc_html_e( 'Tickets ', 'easybook-add-ons' ); ?><span class="qtyTotal" name="qtyTotal">1</span><i class="fas fa-angle-down"></i></a>
	                		<div class="quantity-item-bk">
		                        <div class="quantity-search quantity-item">
						            <input type="number" class="qty"  min="1" max="300" step="1" value="1">
						        </div>
	                		</div>	
	                	</div>
                        <?php 
                        if(is_user_logged_in()) { ?>
                        	<button class="btn big-btn color-bg flat-btn lbooking-submit" type="submit"><?php esc_html_e( 'Book Now', 'easybook-add-ons' ); ?><i class="fa fa-angle-right"></i></button>
                        	<input type="hidden" name="qty" value="1">
                        	<input type="hidden" name="lprice" value="<?php echo get_post_meta( get_the_ID(), ESB_META_PREFIX.$custom_price, true );?>">
                        	<input type="hidden"name="ldate" value="<?php echo get_post_meta( get_the_ID(), ESB_META_PREFIX.$custom_date, true );?>">
			                <input  type="hidden" name="product_id" value="<?php echo get_the_ID();?>">
			                <input  type="hidden" name="action" value="esb_add_to_cart_event">
			                <input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce( 'easybook-add-to-cart-event' ); ?>"> 
                        <?php }else{ ?>
                        	<button class="btn big-btn color-bg lbooking-submit flat-btn logreg-modal-open" type="submit"  data-message="<?php esc_attr_e( 'Logging in to book.', 'easybook-add-ons' ); ?>"><?php esc_html_e( 'Login to Book', 'easybook-add-ons' ); ?><i class="fa fa-angle-right"></i></button>
                         <?php } ?> 	
	                </fieldset>
	                <div class="total-coast fl-wrap"><strong><?php esc_html_e( 'Total Cost', 'easybook-add-ons' ); ?></strong> <span id="total-bki">0</span><span><?php esc_html_e( '$ ', 'easybook-add-ons' ); ?></span></div>
	            </form>
	        </div>
	    </div>
	</div>
</div>
<?php endif; 
