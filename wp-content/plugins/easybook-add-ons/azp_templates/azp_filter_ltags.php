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
$azp_mID = $el_id = $el_class = $title = $tags = $wid_title = '';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_filter_ltags',
    'azp-element-' . $azp_mID,
    $el_class,
);
$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) ); 

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}
$tags = explode("||", $tags);
$tags = array_filter($tags);
if( empty($tags) ) return;
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
    <div class="listing-filter-tags">
        <?php if($wid_title != ''): ?>
        <h4 class="field-head"><?php echo $wid_title; ?></h4>
        <?php endif; ?>
        <div class="listing-ftags">
        <?php 
        foreach ($tags as $tag_id) {
            $ltag = get_term( $tag_id, 'listing_tag' );
            if ( $ltag != null && ! is_wp_error( $ltag ) ){
            ?>
            <div class="ltag-filter-wrap">
                <div class="switchbtn text-center">
                    <input id="listing_tags_filter_<?php echo $tag_id;?>" class="switchbtn-checkbox" type="checkbox" value="<?php echo $tag_id;?>" name="listing_tags[]">
                    <label class="switchbtn-label" for="listing_tags_filter_<?php echo $tag_id;?>"><?php echo $ltag->name;?></label>
                </div>
            </div>
            <?php
            }
        }
        ?>
        </div>
    </div>
</div>


