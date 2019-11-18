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


$css = $el_class = $name = $job = $comment = $avatar = $rating = $name_face = $link = $is_external = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    '',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
$href = vc_build_link( $link ); 

$rating_base = (int)easybook_addons_get_option('rating_base');
?>

<!--slick-slide-item-->
<div class="slick-slide-item">
    <div class="testimonials-carousel-item">
        <?php 
        if($avatar != '') echo '<div class="testimonilas-avatar">'.wp_get_attachment_image( $avatar, 'thumbnail' ).'</div>';
        ?>
        <div class="listing-rating card-popup-raining" data-rating="<?php echo esc_attr( $rating );?>" data-stars="<?php echo $rating_base;?>"></div>
        <div class="review-owner fl-wrap"><?php if($name!= '') echo $name; ?> - <?php if($job!= '') echo '<span>'.$job.'</span>';  ?></div>
        <p><?php echo $comment; ?></p>
        <?php
            $url = $href['url'];
            $target = ($is_external == 'yes') ? 'target="_blank"' : '';
        ?>
        <a href="<?php echo $url; ?>" <?php echo $target; ?> class="testim-link"><?php echo $name_face; ?></a>
    </div>
</div>
<!--slick-slide-item end-->
