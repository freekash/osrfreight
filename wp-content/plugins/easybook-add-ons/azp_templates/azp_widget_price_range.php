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
    'azp_widget_price_range',
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
$price_from = get_post_meta( get_the_ID(), ESB_META_PREFIX.'price_from', true );
$price_to = get_post_meta( get_the_ID(), ESB_META_PREFIX.'price_to', true );
if(( $hide_widget_on_check = easybook_addons_is_hide_on_plans($hide_widget_on) ) !== 'true') :
if(!empty($price_to) && !empty($price_from ) ):
?>
<div class="<?php echo $classes; ?> authplan-hide-<?php echo $hide_widget_on_check;?>" <?php echo $el_id;?>>
    <div class="for-hide-on-author"></div>
	<!--box-widget-item -->
	<div class="box-widget-item fl-wrap" id="listing-price-range-widget">
	    <div class="box-widget-item-header">
	        <h3><?php _e( 'Price Range', 'easybook-add-ons' ); ?></h3>
	    </div>
	    <div class="box-widget">
	         <div class="box-widget-content">
	            <div class="claim-price-wdget fl-wrap">

	                <div class="claim-price-wdget-content fl-wrap">
	                    <?php 
	                    if($price_from != '') :  ?>
	                    <div class="pricerange fl-wrap">
	                    <?php 
	                        _e( '<span class="lprice-text">Price : </span>', 'easybook-add-ons' );
	                        echo '<span class="lprice-from">'.easybook_addons_get_price_formated($price_from).'</span>';
	                        if($price_to != '') echo __( ' - ', 'easybook-add-ons' ) . '<span class="lprice-to">'. easybook_addons_get_price_formated($price_to).'</span>';

	                    ?>
	                    </div>
	                    <?php 
	                    if('yes' == _x( 'no', 'Show Add to cart button on listing price range. yes or no', 'easybook-add-ons' )  && easybook_addons_is_woocommerce_activated()){ ?>
	                    <div class="listing-add-cart">
	                        <a class="btn color-bg" href="<?php echo easybook_addons_get_add_to_cart_url( get_the_ID() );?>"><?php _e( 'Add to cart', 'easybook-add-ons' ); ?></a>
	                    </div>
	                    <?php } ?>
	                    <?php 
	                    endif; ?>
                        <?php if( get_post_meta( get_the_ID() , ESB_META_PREFIX.'verified', true ) != '1' || ( get_post_meta( get_the_ID() , ESB_META_PREFIX.'verified', true ) == '1' && easybook_addons_get_option('single_hide_claimed') != 'yes' ) ): ?>
                        <div class="claim-widget-link fl-wrap">
                            <?php _e( '<span>Own or work here?</span>', 'easybook-add-ons' ); ?>
                            <?php if(is_user_logged_in()) : ?>
                            <a class="open-listing-claim" href="#">
                            <?php else : ?>
                            <a class="logreg-modal-open" href="#" data-message="<?php esc_attr_e( 'You must be logged in to claim listing.', 'easybook-add-ons' ); ?>">
                            <?php endif; ?>
                                <?php _e( 'Claim Now!', 'easybook-add-ons' ); ?>
                            </a>
                            
                        </div>
                        <?php endif; ?>
	                </div>  

	            </div>
	         </div>
	    </div>
	</div>
	<!--box-widget-item end -->
</div>
<?php endif; 

endif; 
