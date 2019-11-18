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
$azp_mID = $el_id = $el_class = $wid_title = $responsive = $order_by = $order = ''; 

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_rooms_slider',
    // 'list-single-main-item fl-wrap', 
    'azp-element-' . $azp_mID,
    $el_class,
);

$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) );  

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}
 
$lrooms = get_post_meta( get_the_ID(), ESB_META_PREFIX.'rooms_ids', true );  
$listing_type_ID = get_post_meta( get_the_ID(), ESB_META_PREFIX.'listing_type_id', true );
$child_pt = get_post_meta( $listing_type_ID, ESB_META_PREFIX.'child_type_meta', true );
$child_type = ($child_pt == 'product') ? 'product' : 'lrooms';
if (!empty($lrooms)) {
?>
<div class="<?php echo $classes;?>" <?php echo $el_id;?>>
    <div class="list-single-main-item fl-wrap">
        <?php if($wid_title != ''): ?>
        <div class="list-single-main-item-title fl-wrap">
            <h3><?php echo $wid_title; ?></h3>
        </div>
        <?php endif; ?>

        <?php 
        $slider_args = array();
        $slider_args['responsive'] = false;
        $slider_args['responsive'] = trim($responsive);
        
        $args = array(
            'post_type'         => $child_type,
            'post_status'       => 'publish',
            'post__in'          => $lrooms,
            'posts_per_page'    => -1,
            // 'author'            => $current_user->ID,
            'orderby'           => $order_by,
            'order'             => $order,

        );
        $posts_query = new \WP_Query($args);
        if($posts_query->have_posts()) :
        ?>
        <div class="listing-rooms-slider list-carousel">
            <!--listing-carousel-->
            <div class="listing-carousel fl-wrap" data-options='<?php echo json_encode($slider_args); ?>'>
            <?php 
            while($posts_query->have_posts()) : $posts_query->the_post();  ?>
                <div class="room-box slick-slide-item">
                    <?php 
                        echo easybook_addons_azp_parser_listing( $listing_type_ID  , 'preview_room', get_the_ID() );
                    ?>
                </div>
            <?php 
            endwhile; ?> 
            </div>
            <!--listing-carousel end-->
            <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
            <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
        </div>
        <!--  carousel end-->
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>     
    </div>
</div>
<?php } ?>
