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


$css = $el_class = $local = $title = $show_separator = $btn_text = $links = $is_external = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'parallax-content',
    'parallax-'.$local,
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
$href = vc_build_link( $links );
$url = ($href['url'] != '') ? $href['url'] : '#';
$target = ($is_external == 'yes') ? 'target="_blank"' : '';
?>
<div class="<?php echo esc_attr($css_class); ?>">
    <div class="intro-item fl-wrap">
        <?php 
            if($title !='') echo '<h2>'.$title.'</h2>';
            if($show_separator == 'yes'){ echo '<span class="section-separator"></span>'; }; ?>
                <h3><?php echo $content; ?></h3> 
            <?php
            if($url != '') echo '<a class="btn color-bg" href="'.$url.'" '.$target.'>'.$btn_text.'<i class="fa fa-envelope"></i></a>';
        ?>
    </div>
</div>