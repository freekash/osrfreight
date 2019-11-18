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
$azp_mID = $el_id = $el_class = $images_to_show =$contact_infos= '';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_ptmpl_opt',
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
$latitude = get_post_meta( get_the_ID(), '_cth_latitude', true );
$longitude = get_post_meta( get_the_ID(), '_cth_longitude', true );
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>  
    <div class="preview-opt fl-wrap">
        <div class="geodir-opt-list clearfix">
            
            <a href="#" class="single-map-item" data-lat="<?php echo esc_attr( $latitude ); ?>" data-lng="<?php echo esc_attr( $longitude ); ?>" data-title="<?php the_title_attribute(); ?>" data-url="<?php the_permalink(  ); ?>"><i class="fal fa-map-marker-alt"></i><span class="geodir-opt-tooltip"><?php _e( 'On the map', 'easybook-add-ons' ); ?></span></a>
                
            <?php if(!is_user_logged_in()): ?>
                <a href="#" class="save-btn logreg-modal-open tooltipwrap tooltip-right" data-message="<?php esc_attr_e( 'Logging in first to save this listing.', 'easybook-add-ons' ); ?>"><i class="fal fa-heart"></i><span class="geodir-opt-tooltip"><?php _e( 'Save', 'easybook-add-ons' ); ?></span></a>
            <?php elseif( easybook_addons_already_bookmarked(get_the_ID()) ): ?>
                <a href="javascript:void(0);" class="save-btn tooltipwrap tooltip-right" data-id="<?php the_ID(); ?>"><i class="fas fa-heart"></i><span class="geodir-opt-tooltip"><?php _e( 'Saved', 'easybook-add-ons' ); ?></span></a>
            <?php else: ?>
                <a href="#" class="save-btn bookmark-listing-btn tooltipwrap tooltip-right" data-id="<?php the_ID(); ?>" data-tooltip="tooltip" ><i class="fal fa-heart"></i><span class="geodir-opt-tooltip"><?php _e( 'Save', 'easybook-add-ons' ); ?></span></a>
            <?php endif; ?>
            <a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo esc_attr( $latitude ); ?>,<?php echo esc_attr( $longitude ); ?>" class="geodir-js-booking" target="_blank"><i class="fal fa-exchange"></i><span class="geodir-opt-tooltip">
            <?php _e( 'Find Directions', 'easybook-add-ons' ); ?></span></a> 
        </div>
    </div>
</div>