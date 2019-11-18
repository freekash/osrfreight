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
$el_id = $el_class =$bt_name = $bt_icon = $filter_dis = '';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
	'azp-element-' . $azp_mID,
    'azp_filter_button',
    $el_class,
);
// $animation_data = self::buildAnimation($azp_attrs); 
// $classes[] = $animation_data['trigger'];
// $classes[] = self::buildTypography($azp_attrs);//will return custom class for the element without dot
// $azplgallerystyle = self::buildStyle($azp_attrs);

$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) );

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
    <?php if ($filter_dis == 'listing'): ?>
        <div class="search-input-item">
	        <div class="col-list-search-input-item fl-wrap">
	            <button type="submit" class="header-search-button" ><?php echo $bt_name; ?><i class="<?php echo $bt_icon;?>"></i></button>
	            <!-- <input type="hidden" name="post_type" value="listing"> -->
	        </div>
	    </div>
	<?php elseif($filter_dis == 'header'): ?>
		<div class="header-search-input-item fl-wrap">
	        <button class="header-search-button" type="submit"><?php echo $bt_name; ?><i class="<?php echo $bt_icon;?>"></i></button>
	        <!-- <input type="hidden" name="post_type" value="listing"> -->
	    </div>
    <?php else: ?>
         <button class="main-search-button" type="submit"><?php echo $bt_name; ?><i class="<?php echo $bt_icon;?>"></i></button>
         <!-- <input type="hidden" name="post_type" value="listing"> -->
    <?php endif ?>
</div>
