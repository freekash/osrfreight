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


$css = $el_class = $map_lat = $map_lng = $map_address = $zoom = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'map-container',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

?>
<div class="<?php echo esc_attr( $css_class ); ?>">
    <?php if(easybook_addons_get_option('use_osm_map') == 'yes'): ?>
        <div id="<?php echo uniqid('singleMapOSM'); ?>" class="singleMapOSM" data-lat="<?php echo $map_lat;?>" data-lng="<?php echo $map_lng;?>" data-loc="<?php echo $map_address;?>" data-zoom="<?php echo $zoom;?>"></div>
    <?php else: ?>
        <div class="singleMap" data-lat="<?php echo $map_lat;?>" data-lng="<?php echo $map_lng;?>" data-loc="<?php echo $map_address;?>" data-zoom="<?php echo $zoom;?>" style="height: <?php echo $height.'px'; ?>"></div>
    <?php endif; ?>
</div>