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
$azp_mID = $el_id = $el_class = $images_to_show = $title = $filed_rate = ''; 

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_filter_rating',
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
if (!empty($filed_rate) && $filed_rate != '') {
    $filed_rate = json_decode(urldecode($filed_rate) , true) ;
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
	<!--col-list-search-input-item -->
    <div class="col-list-search-input-item fl-wrap">
        <h4><?php echo $title;?></h4>
        <div class="search-opt-container fl-wrap">
            <!-- Checkboxes -->
            <ul class="fl-wrap filter-tags">
                <?php foreach ($filed_rate as $key => $rate) { ?>
                        <li class="five-star-rating">
                            <div class="star-rating-item_wrap">
                                <input id="check-aa<?php echo $key ?>" type="radio" name="rating" value="<?php echo $rate['star'] ?>">
                                <label for="check-aa<?php echo $key; ?>"><span class="listing-rating card-popup-rainingvis" data-starrating2="<?php echo $rate['star']; ?>"><span><?php echo $rate['label']; ?></span></span></label>
                            </div>
                        </li>
                <?php   
                    }
                ?>  
            </ul>
            <!-- Checkboxes end -->
        </div>
    </div>
    <!--col-list-search-input-item end--> 
</div>
<?php } ?>