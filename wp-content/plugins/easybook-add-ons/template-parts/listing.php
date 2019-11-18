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



// $is_ad_meta = get_post_meta( get_the_ID(), ESB_META_PREFIX.'is_ad', true);
// $ad_expire_meta = get_post_meta( get_the_ID(), ESB_META_PREFIX.'ad_expire', true);
// $is_ad = false;
// if($is_ad_meta == 'yes' && $ad_expire_meta >= current_time('mysql', 1) ) $is_ad = true; 
if(!isset($is_ad)) $is_ad = false;
$GLOBALS['is_lad'] = $is_ad;
// for default list layout
if(!isset($for_slider)) $for_slider = false;

$map_datas = array();
$cls = 'listing-item';
if($for_slider) 
    $cls .= ' slick-slide-item';
else{
	if(easybook_addons_get_option('listings_grid_layout')=='list') {
	    $cls .= ' list-layout';  
	}
	$map_datas = easybook_addons_get_map_data();
}
	
?>

<!-- listing-item -->
<div class="<?php echo esc_attr( $cls ); ?>" <?php // post_class($cls); ?> data-postid="<?php echo get_the_ID(); ?>"<?php if(!empty($map_datas)) echo "data-lmap='".json_encode($map_datas)."'"; ?>>
    <article class="geodir-category-listing fl-wrap">
        <?php 
            echo easybook_addons_azp_parser_listing( get_post_meta( get_the_ID(), ESB_META_PREFIX.'listing_type_id', true ) , 'preview' );  
        ?>
    </article>
</div>
<!-- listing-item end-->  
