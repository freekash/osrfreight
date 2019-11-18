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


$css = $el_class = $video_url = $image = $video_title = $icon = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'video-box fl-wrap',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
$href = vc_build_link($video_url);
$url = $href['url'];
?>

<div class="<?php echo esc_attr( $css_class ); ?>">
    <?php if($image) echo wp_get_attachment_image( $image, 'full' ); ?>
    <?php if($url != ''): ?><a class="video-box-btn image-popup" href="<?php echo esc_url( $url);?>"><i class="<?php echo esc_attr( $icon );?>" aria-hidden="true"></i></a>
    <span class="video-box-title"><?php echo $video_title;?></span>
<?php endif; ?>
</div>