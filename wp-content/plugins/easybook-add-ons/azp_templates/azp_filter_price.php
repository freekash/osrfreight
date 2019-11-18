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
$azp_mID = $el_id = $el_class = $title = '';
$rmax = $rmin = $rstep = $rfrom = $rto = '';
// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_filter_price',
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

$currency_attrs = easybook_addons_get_currency_attrs();
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
    <!-- col-list-search-input-item -->
    <div class="search-input-item">
        <div class="range-slider-title"><?php echo $title ?></div>
        <div class="range-slider-wrap fl-wrap">
            <input class="price-range-slider" data-type="double" data-from="<?php echo floatval($rfrom) * $currency_attrs['rate']; ?>" data-to="<?php echo floatval($rto) * $currency_attrs['rate']; ?>" data-step="<?php echo floatval($rstep) * $currency_attrs['rate']; ?>" data-min="<?php echo floatval($rmin) * $currency_attrs['rate']; ?>" data-max="<?php echo floatval($rmax) * $currency_attrs['rate']; ?>" data-prefix="<?php echo $currency_attrs['symbol']; ?>" data-prettify-separator="<?php echo $currency_attrs['ths_sep']; ?>">
            <input type="hidden" name="price_range" id="price_range_hidden" value="">
        </div>
    </div>
    <!-- col-list-search-input-item end --> 
</div>
