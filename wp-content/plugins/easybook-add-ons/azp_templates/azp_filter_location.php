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
$azp_mID = $el_id = $el_class = $title ='';

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

$s_id = uniqid('search_llocs-');
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
	<!-- col-list-search-input-item -->
    <?php 
    if(easybook_addons_get_option('filter_hide_loc') != 'yes'): ?>
        <?php
        $listing_locations = easybook_addons_get_listing_locations(true); 
        $search_loc = '';
        if(is_tax('listing_location')){ 
            $loc_term = get_term( get_queried_object_id(), 'listing_location' );
            if ( ! empty( $loc_term ) && ! is_wp_error( $loc_term ) ) $search_loc = $loc_term->slug;
        }else{
            if(isset( $_GET['llocs'] ) && !empty( $_GET['llocs'] )){
                $llocs = explode(',',$_GET['llocs']);
                $search_loc = sanitize_title( $llocs[0] ); 
            }
        }
    ?>
    <div class="col-list-search-input-item in-loc-dec fl-wrap not-vis-arrow">
        <label><?php echo $title; ?></label>
        <div class="listsearch-input-item">
             <select id="<?php echo esc_attr( $s_id ); ?>" data-placeholder="<?php esc_attr_e( 'All Cities',  'easybook-add-ons' );?>" class="chosen-select" name="llocs">
                <option value=""><?php esc_html_e( 'All Locations',  'easybook-add-ons' );?></option>
                <?php 
                foreach ($listing_locations as $loc => $loc_name) {
                    echo '<option value="'.$loc.'" '.selected( $search_loc, $loc,false).'>'.$loc_name.'</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <?php endif; // end filter location ?>
    <!-- col-list-search-input-item end -->
</div>