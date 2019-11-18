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
$azp_mID = $el_id = $el_class = $columns_grid = $space = $title_item = ''; 

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_listing_team_memeber',
    // 'list-single-main-item fl-wrap', 
    'azp-element-' . $azp_mID,
    $el_class,
);

$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) );  

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}

$css_classes = array(
    'items-grid-holder section-team',
    $space.'-pad',
    $columns_grid.'-cols',
);

$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
$lmembers = get_post_meta( get_the_ID(), '_cth_lmember', true );
if (!empty($lmembers)) {
?>
<div class="<?php echo $classes;?>" <?php echo $el_id;?>>
    <div class="list-single-main-items">
        <?php if($title_item != ''): ?>
        <div class="list-single-main-item-title fl-wrap">
            <h3><?php echo $title_item; ?></h3>
        </div>
        <?php endif; ?>

        <div class="<?php echo $css_class;?>">
            <?php 
                foreach ((array)$lmembers as $key => $member) {
            ?>
                <!-- team-item -->
                <div id="<?php echo 'item-'.$key.'' ?>"<?php post_class('items-grid-item team-box'); ?>>
                    <?php easybook_addons_get_template_part('template-parts/member', false, array('member'=>$member)); ?>
                </div>
                <!-- team-item end  -->
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>