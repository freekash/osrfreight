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


$css = $el_class = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'testimonials-carousel carousel fl-wrap slick-carouse-wrap',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>

<div class="<?php echo esc_attr($css_class); ?>">
    <div class="single-carousel fl-wrap">
	    <?php echo wpb_js_remove_wpautop($content);?>
	</div>
	<div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
    <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
</div>