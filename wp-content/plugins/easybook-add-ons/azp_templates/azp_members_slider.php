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
$azp_mID = $el_id = $el_class = $wid_title = $responsive = ''; 

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_members_slider',
    // 'list-single-main-item fl-wrap', 
    'azp-element-' . $azp_mID,
    $el_class,
);

$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) );  

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}

$lmembers = get_post_meta( get_the_ID(), '_cth_lmember', true );
if (!empty($lmembers)) {
?>
<div class="<?php echo $classes;?>" <?php echo $el_id;?>>
    <div class="list-single-main-items">
        <?php if($wid_title != ''): ?>
        <div class="list-single-main-item-title fl-wrap">
            <h3><?php echo $wid_title; ?></h3>
        </div>
        <?php endif; ?>

        <?php 
        $slider_args = array();
        $slider_args['responsive'] = false;
        $slider_args['responsive'] = trim($responsive);
        ?>
        <div class="listing-members-slider list-carousel">
            <!--listing-carousel-->
            <div class="listing-carousel fl-wrap" data-options='<?php echo json_encode($slider_args); ?>'>
            <?php 
            foreach ((array)$lmembers as $key => $member) { ?>
                <div class="team-box slick-slide-item">
                    <?php easybook_addons_get_template_part('template-parts/member', false, array('member'=>$member)); ?>
                </div>
            <?php } ?> 
            </div>
            <!--listing-carousel end-->
            <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
            <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
        </div>
        <!--  carousel end-->
    </div>
</div>
<?php } ?>
