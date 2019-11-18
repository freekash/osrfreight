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


$css = $el_class = $accordions = $active = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'accordion accordion-wrap',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
$accordions = vc_param_group_parse_atts($atts['accordions']);
// var_dump($accordions);
$active_item = $active - 1; 
?>

<?php if(is_array($accordions) && !empty($accordions) ): ?>
<div class="<?php echo esc_attr($css_class); ?>">
<?php
    foreach ($accordions as $key => $accordion) { 
    	?>
    	<a class="toggle<?php if($active_item == $key) echo ' act-accordion';?>" href="#"> <?php echo esc_html($accordion['title']); ?> <i class="fa fa-angle-down"></i></a>
    	<div class="accordion-inner<?php if($active_item == $key) echo ' visible';?>">
        	<p><?php echo $accordion['content']; ?></p>
    	</div>
    <?php } ?>
</div>
<?php endif; ?>
