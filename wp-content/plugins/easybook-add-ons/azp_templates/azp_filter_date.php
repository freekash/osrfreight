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
$azp_mID = $el_id = $el_class = $azp_icon = $title = $filter_dis =''; 

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_filter_date',
    'azp-element-' . $azp_mID, 
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
// var_dump($filter_dis);


?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
    <?php if ($filter_dis == 'listing'): ?>
        <!-- col-list-search-input-item -->
        <div class="col-list-search-input-item in-loc-dec date-container  fl-wrap">
            <div class="cth-daterange-picker"
                data-name="checkin" 
                data-name2="checkout" 
                data-format="<?php _ex( 'DD/MM/YYYY', 'Date range picker format', 'easybook-add-ons' ); ?>" 
                data-default=""
                data-label="<?php echo esc_attr( $title ); ?>" 
                data-icon="<?php echo $azp_icon;?>" 
                data-selected="slot_date"
            ></div>


                

        </div>
        <!-- col-list-search-input-item end -->
    <?php elseif($filter_dis == 'header'): ?>
        <div class="header-search-input-item fl-wrap date-parent"> 
            <div class="cth-daterange-picker"
                data-name="checkin" 
                data-name2="checkout" 
                data-format="<?php _ex( 'DD/MM/YYYY', 'Date range picker format', 'easybook-add-ons' ); ?>" 
                data-default=""
                data-label="<?php echo esc_attr( $title ); ?>" 
                data-icon="<?php echo $azp_icon;?>" 
                data-selected="slot_date"
            ></div>
        </div>
    <?php else: ?>
        <div class="main-search-input-item main-date-parent main-search-input-item_small fl-wrap">
            <div class="cth-daterange-picker"
                data-name="checkin" 
                data-name2="checkout" 
                data-format="<?php _ex( 'DD/MM/YYYY', 'Date range picker format', 'easybook-add-ons' ); ?>" 
                data-default=""
                data-label="<?php echo esc_attr( $title ); ?>" 
                data-icon="<?php echo $azp_icon;?>" 
                data-selected="slot_date"
            ></div>
        </div>
    <?php endif ?>
</div>
