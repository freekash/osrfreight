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
$azp_mID = $el_id = $el_class = $images_to_show = $title = $filed_facts ='';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_filter_fact',
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
$facts = easybook_addons_get_listing_feature(true);
if (!empty($facts) && $facts != '') {
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
	<!--col-list-search-input-item -->
    <div class="col-list-search-input-item fl-wrap">
        <h4><?php echo $title; ?></h4>
        <div class="search-opt-container fl-wrap">
            <!-- Checkboxes -->
            <ul class="fl-wrap filter-tags half-tags">
                 <?php foreach ($facts as $value => $fact) { ?>
                         <li>
                            <div class="filter-tags-item_wrap">
                                <input id="check-<?php echo $value ?>" type="checkbox" name='lfeas[]' value="<?php echo $value ?>" > 
                                <label for="check-<?php echo $value ?>"><?php echo $fact; ?></label>
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