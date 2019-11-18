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
$azp_mID = $el_id = $el_class = $title =  $cats = $max_level = $hide_empty = '';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_filter_category',
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

$s_id = uniqid('search_lcats-');
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
	<!-- col-list-search-input-item -->
    <?php 
    // $listing_cats = easybook_addons_get_listing_categories(easybook_addons_get_option('search_cat_level'));
    $listing_cats = easybook_addons_filter_cats($cats, $max_level, $hide_empty);
    $search_cats = array();
    if(is_tax('listing_cat')){
        $search_cats = array(get_queried_object_id());
    }else{
        if(isset($_GET['lcats'])&&is_array($_GET['lcats'])){
            $search_cats = array_filter($_GET['lcats']);
        } 
    }
    ?>
    <div class="col-list-search-input-item in-loc-dec fl-wrap not-vis-arrow">
        <label><?php echo $title; ?></label>
        <div class="listsearch-input-item">
             <select id="<?php echo esc_attr( $s_id ); ?>" data-placeholder="<?php esc_attr_e( 'All Categories',  'easybook-add-ons' );?>" class="chosen-select" name="lcats[]">
                <option value=""><?php esc_html_e( 'All Categories',  'easybook-add-ons' );?></option>
                <?php 
                foreach ($listing_cats as $cat) {
                    if(in_array($cat['id'], $search_cats)){
                        echo '<option value="'.$cat['id'].'" selected>'.str_repeat('-', $cat['level']).$cat['name'].'</option>';
                    }else{
                        echo '<option value="'.$cat['id'].'">'.str_repeat('-', $cat['level']).$cat['name'].'</option>';
                    }
                    
                }
                ?>
            </select>
        </div>
    </div>
    
    <!-- col-list-search-input-item end -->
</div>