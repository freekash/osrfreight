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
    'azp_proom_quantity',
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
    <div class="quantity fl-wrap clearfix">
        <span><i class="fa fa-user-plus"></i><?php esc_attr_e( 'Quantity: ', 'easybook-add-ons' ); ?></span>
        <div class="quantity-item" data-min="1">
            <input type="button" value="-" class="minus">
            <input type="text" name="quantity" value="1" class="qty" size="4" required="required">
            <input type="button" value="+" class="plus">
        </div>
    </div>
</div>