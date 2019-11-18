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
$azp_mID = $el_id = $el_class = $title = $azp_icon = '';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_sbook_date',
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
    <div class="bookdate-container  fl-wrap">
        <label><i class="<?php echo $azp_icon; ?>"></i><?php echo $title; ?> </label>
        <input type="text" placeholder="Date In-Out" name="lb_date" value="" autocomplete="off"/>
        <input type="hidden" name="ltime-from" value="">
        <input type="hidden" name="ltime-to" value="">
        <input type="hidden" name="lday" value="">
        <div class="bookdate-container-dayscounter"><i class="far fa-question-circle"></i><span>Days : <strong id="totaldays">0</strong></span>
        </div>
    </div>
</div>