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


$css = $el_class = $icon = $title = $show_decor = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'process-item-wrap',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>

<div class="<?php echo esc_attr($css_class );?>">
    <div class="process-item">
        <?php if($icon) : ?><div class="time-line-icon"><i class="<?php echo $icon;?>"></i></div><?php endif; ?>
        <?php if($title) : ?><h4><?php echo $title;?></h4><?php endif; ?>
        <?php echo $desc;?>
    </div>
    <?php if($show_decor == 'yes') echo '<span class="pr-dec"></span>'; ?>
</div>