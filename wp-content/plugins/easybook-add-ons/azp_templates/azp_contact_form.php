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
$azp_mID = $el_id = $el_class = $f_id = $f_title = $attrs = '';  
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_contact_form',
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
if($f_id) $attrs .= ' id="'.$f_id.'"';
elseif($f_title) $attrs .= ' title="'.$f_title.'"';
$shortcode = do_shortcode( '[contact-form-7'.$attrs.']' ) ;
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>> 
	<div class="contact-form7"><?php echo $shortcode;?></div>
</div>