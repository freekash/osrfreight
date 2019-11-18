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


$css = $el_class = $h_color = $title = $show_starts = $show_separator = $separator_color = $content = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'section-title',
    'section-title-'.$h_color,
    'fl-wrap',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>

<div class="<?php echo esc_attr($css_class );?>">
    <?php if($show_starts == 'yes')
     echo '<div class="section-title-separator"><span></span></div>'; ?>
    <?php if(!empty($title)) echo '<h2>'.$title.'</h2>'; ?>
    <?php 
    if($show_separator == 'yes'): ?>
        <span class="section-separator section-separator-<?php echo $separator_color; ?>"></span> 
    <?php
        endif;
    ?>
    <?php echo $sub_title; ?> 
</div>