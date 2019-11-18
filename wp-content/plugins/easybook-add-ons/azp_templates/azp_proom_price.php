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
$azp_mID = $el_id = $el_class = $images_to_show = $cur_syb = '';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_proom_price',
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
$room_price = get_post_meta( get_the_ID(), '_price', true );
if ($room_price !== ''): 
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
	<div class="proom-price">
		<span class="rooms-price">
            <?php echo sprintf(
                __( '%s / night', 'easybook-add-ons' ), 
                '<strong class="per-night-price">'.easybook_addons_get_price_formated($room_price).'</strong>'
            ) ?>
        </span>
	</div>
</div>
<?php endif ?>