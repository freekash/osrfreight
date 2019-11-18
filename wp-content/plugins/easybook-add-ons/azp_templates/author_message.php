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
$azp_mID = $el_id = $el_class = $hide_widget_on = ''; 
extract($azp_attrs);

$classes = array(
	'azp_element',
    'widget_author_message', 
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
if(get_current_user_id() != get_the_author_meta( 'ID' )):    
?>
	<div class="<?php echo $classes; ?> authplan-hide-<?php echo $hide_widget_on_check;?>" <?php echo $el_id;?>>
        <div class="for-hide-on-author"></div>
		<div class="box-widget-item fl-wrap">
	        <div class="box-widget-item-header">
	            <h3><?php esc_html_e( 'Get in Touch : ', 'easybook-add-ons' ); ?></h3>
	        </div>
	        <div class="box-widget">
	            <div class="box-widget-content">
	            	<form class="author-message-form custom-form" action="#" method="post">
                        <fieldset>
                        
                            <label><i class="fal fa-user"></i></i></label>
                            <input name="lmsg_name" class="has-icon" type="text" placeholder="<?php esc_attr_e( 'Your Name*', 'easybook-add-ons' ); ?>" value="" required="required">
                            <div class="clearfix"></div>
                            <label><i class="fal fa-envelope"></i></label>
                            <input name="lmsg_email" class="has-icon" type="text" placeholder="<?php esc_attr_e( 'Email Address*', 'easybook-add-ons' ); ?>" value="" required="required">
                            <label><i class="fa fa-phone"></i></label>
                            <input name="lmsg_phone" class="has-icon" type="text" placeholder="<?php esc_attr_e( 'Phone', 'easybook-add-ons' ); ?>" value="">
                        
                            <textarea name="lmsg_message" cols="40" rows="3" placeholder="<?php esc_attr_e( 'Your message:', 'easybook-add-ons' ); ?>"></textarea>
                        </fieldset>
                        <input type="hidden" name="authid" value="<?php echo get_the_author_meta( 'ID' ); ?>">
                        <input type="hidden" name="listing_id" value="<?php echo get_the_ID(); ?>">
                        <button class="btn big-btn color-bg flat-btn" type="submit"><?php _e( 'Send Message <i class="fa fa-angle-right"></i>', 'easybook-add-ons' ); ?></button>
                    </form>


	            </div>
	        </div>
	    </div>
	</div>
<?php endif; ?>
<?php endif; 

