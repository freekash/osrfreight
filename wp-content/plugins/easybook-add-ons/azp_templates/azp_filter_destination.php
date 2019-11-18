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
$azp_mID = $el_id = $el_class = $azp_icon = $title = $filter_dis = '';  

// var_dump($azp_attrs); 
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_filter_destination', 
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
$search_string = '';
if(isset($_GET['search_term'])) $search_string = $_GET['search_term'];
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
    <?php if ($filter_dis == 'listing'): ?>
        <!-- col-list-search-input-item -->
            <div class="col-list-search-input-item fl-wrap location autocomplete-container">
                <label><?php echo $title; ?></label>
                <?php if($azp_icon != ''):?>
                    <span class="header-search-input-item-icon"><i class="<?php echo $azp_icon;?>"></i></span>
                <?php endif; ?>
                <input type="text" placeholder="<?php echo esc_attr_x( 'Hotel , City...', 'hero search placeholder','easybook-add-ons' ) ?>" name="search_term" value="<?php echo $search_string; ?>" class="autocomplete-input"/>
                <a href="#" class="get-current-city"><i class="fal fa-dot-circle"></i></a>
            </div>
            <!-- col-list-search-input-item end --> 
    <?php elseif($filter_dis == 'header'): ?>
        <div class="header-search-input-item fl-wrap location autocomplete-container">
            <label><?php echo $title; ?></label>
            <?php if($azp_icon != ''):?>
                <span class="header-search-input-item-icon"><i class="<?php echo $azp_icon;?>"></i></span>
            <?php endif; ?>
            <input type="text" placeholder="<?php echo esc_attr_x( 'Hotel , City...', 'hero search placeholder','easybook-add-ons' ) ?>"  name="search_term" value="<?php echo $search_string; ?>" class="autocomplete-input"/>
            <a href="#" class="get-current-city"><i class="fa fa-dot-circle-o"></i></a>
        </div>
    <?php else: ?>
        <div class="main-search-input-item lsearch-string location autocomplete-container">
            <span class="inpt_dec"><i class="fal fa-map-marker"></i></span>
            <input type="text" placeholder="<?php echo esc_attr_x( 'Hotel , City...', 'hero search placeholder','easybook-add-ons' ) ?>" name="search_term"  value="<?php echo $search_string; ?>" class="autocomplete-input"/>
            <a href="#" class="get-current-city"><i class="fal fa-dot-circle"></i></a>
        </div>
        
    <?php endif ?>
</div>