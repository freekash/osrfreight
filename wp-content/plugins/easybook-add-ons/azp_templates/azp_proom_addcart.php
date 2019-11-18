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
$azp_mID = $el_id = $el_class = $bt_name = $bt_icon  = $bt_url = '';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_proom_addcart',
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
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
	<div class="proom-button fl-wrap">
		<input type="hidden" name="rid" value="<?php echo get_the_ID() ?>">
		<input type="hidden" name="slid" class="get-listing-ids" value="">
		<input type="hidden" name="action" value="add-to-cart">
		 <input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce( 'add-to-cart' ); ?>"> 
		<?php if (is_user_logged_in()) {?>
			<a  class="btn color-bg flat-btn lroom-option-submit"><?php _e( 'Add to cart', 'easybook-add-ons' ); ?></a>
		<?php }else{ ?>
			<a class="btn color-bg flat-btn logreg-modal-open" data-message="<?php esc_attr_e( 'Logging in to book this listing.', 'easybook-add-ons' ); ?>"><?php _e( 'Add to cart', 'easybook-add-ons' ); ?></a>
		<?php } ?>
		<div class="lroom-options">
			<div class="row">
				<div class=" col-md-6">
					<div class="room-opt-field">
						<span><?php esc_html_e( 'Quantity: ', 'easybook-add-ons' ); ?></span>
			             <div class="quantity-search">
				            <input type="number" name="quantity"  min="1" max="999" step="1" value="1">
				        </div>
					</div>
		        </div>
	            <div class="col-md-6">
	            	<div class="room-opt-field">
						<span><?php esc_html_e( 'Dates: ', 'easybook-add-ons' ); ?></span>                               
	                	<input type="text" class="listing-search-dates" placeholder="When" autocomplete="off" />
					</div>
		            <input type="hidden" name="checkin"   value="<?php echo easybook_addons_get_filter_checkinout('esb_checkin', 0); ?>"/>
		            <input type="hidden" name="checkout"   value="<?php echo easybook_addons_get_filter_checkinout('esb_checkout', 1); ?>"/>
	            </div>
	        </div>
	        <div class="row">
				<div class=" col-md-6">
					<div class="room-opt-field">
						<span><?php esc_html_e( 'Adults: ', 'easybook-add-ons' ); ?></span>   
			             <div class="quantity-search">
				            <input type="number" name="adults"  min="1" max="999" step="1" value="1">
				        </div>
					</div>
		        </div>
	            <div class="col-md-6"> 
	            	<div class="room-opt-field">
						<span><?php esc_html_e( 'Children: ', 'easybook-add-ons' ); ?></span>                                 
		                 <div class="quantity-search">
				            <input type="number" name="children"  min="0" max="999" step="1" value="0">
				        </div>
					</div>
	            </div>
	        </div>
	        <button type="submit" class="btn color-bg flat-btn lroom-submit"><i class="fa fa-angle-right"></i><?php _e( 'Submit', 'easybook-add-ons' ); ?></button>
		</div>

		
	</div>
</div>