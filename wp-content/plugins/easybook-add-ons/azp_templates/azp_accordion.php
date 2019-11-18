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
$azp_mID = $el_id = $el_class = $contents_order  = '';
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_accordion',
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
$contents_order = json_decode(urldecode($contents_order) , true) ;
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>> 
	 <div class="accordion accordion-wrap mar-top">
        <?php
            foreach ($contents_order as $key => $content) { ?>
                <a class="toggle<?php if($key == 0) echo ' act-accordion';?>" href="#"> <?php echo esc_html($content['title']); ?><span></span></a>
                <div class="accordion-inner<?php if($key == 0) echo ' visible';?>">
                    <?php echo $content['content']; ?>
                </div>
        <?php
            }
        ?>
    </div>
</div>