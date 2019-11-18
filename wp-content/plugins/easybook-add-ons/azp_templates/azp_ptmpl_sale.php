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
$azp_mID = $el_id = $el_class = $images_to_show = '';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_ptmpl_sale',
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
$sale_percent = get_post_meta( get_the_ID(), ESB_META_PREFIX.'sale_price', true );
$featured = get_post_meta( get_the_ID(), ESB_META_PREFIX.'featured', true );
if($sale_percent != '' || $featured == '1'):
?>
	<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
		<?php if($sale_percent != ''): ?>
			<div class="preview_sale">
				<div class="sale-window<?php if($sale_percent >= 50) echo ' big-sale';?>"><?php echo sprintf(__( 'Sale %s %%', 'easybook-add-ons' ), $sale_percent); ?></div>
			</div>
		<?php endif; ?>
		<?php if($featured == '1'): ?>
	    	<div class="listing-featured<?php if($sale_percent != '') echo ' listing-featured-fix';?>"><?php _e( 'Featured', 'easybook-add-ons' ); ?></div>
	    <?php endif; ?>
	</div>
<?php endif;