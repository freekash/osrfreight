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


$css = $el_class = $bgimage = $title = $image = $left_pos = $top_pos = $zindex = $use_animation = $order = $use_content = $text_content = $show_icon = $icon = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>

<?php 
// foreach ($settings['images'] as $key => $image) {
    if ($use_content == 'yes') { 
        $img_class = ($show_icon == 'yes' ? 'collage-image-input' :'collage-image-btn color2-bg');
    }else{
        $img_class = ($bgimage == 'yes' ? 'main-collage-image' : 'images-collage-item images-collage-other');
    }

    if($use_animation == 'yes') $img_class .= ' cim-'.$order;
    $img_datas = '';
    if($left_pos) $img_datas .= ' data-position-left="'.$left_pos.'"';
    if($top_pos) $img_datas .= ' data-position-top="'.$top_pos.'"';
    if($zindex) $img_datas .= ' data-zindex="'.$zindex.'"';

    $img_size = ($bgimage == 'yes' ? 'full' : array(90,90));
    $animation_duration = ($bgimage == 'yes' ? 'animation-duration-0s' : 'animation-duration-');
    ?>
    <div class="<?php echo esc_attr($css_class).' '.$img_class; ?>" <?php echo $img_datas; ?>>
        <?php 
        if ($use_content == 'yes'){
            echo $text_content;
            if ($show_icon == 'yes'){ ?>
                <i class="<?php echo $icon; ?>"></i>
            <?php }
        }else{
            echo wp_get_attachment_image( $image,  $img_size );
        }
        ?>
    </div>
<?php 
// }
?>