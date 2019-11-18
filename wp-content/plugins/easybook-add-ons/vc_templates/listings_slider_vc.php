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



$css = $el_class = $cat_ids = $ids = $ids_not = $order_by = $order = $posts_per_page = $read_all_link = $show_pagination = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'list-carousel fl-wrap card-listing slick-carouse-wrap',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
$href = vc_build_link( $read_all_link );
?>
<?php 
if(is_front_page()) {
    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
} else {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
}

if(!empty($ids)){
    $ids = explode(",", $ids);
    $post_args = array(
        'post_type' => 'listing',
        'paged' => $paged,
        'posts_per_page'=> $posts_per_page,
        'post__in' => $ids,
        'orderby'=> $order_by,
        'order'=> $order,
        'post_status' => 'publish'
    );
}elseif(!empty($ids_not)){
    $ids_not = explode(",", $ids_not);
    $post_args = array(
        'post_type' => 'listing',
        'paged' => $paged,
        'posts_per_page'=> $posts_per_page,
        'post__not_in' => $ids_not,
        'orderby'=> $order_by,
        'order'=> $order,

        'post_status' => 'publish'
    );
}else{
    $post_args = array(
        'post_type' => 'listing',
        'paged' => $paged,
        'posts_per_page'=> $posts_per_page,
        'orderby'=> $order_by,
        'order'=> $order,

        'post_status' => 'publish'
    );
}    

if(!empty($cat_ids)) 
    $post_args['tax_query'] =  array(
        array(
            'taxonomy' => 'listing_cat',
            'field'    => 'term_id',
            'terms'    => $cat_ids,
        ),
    );
$meta_queries = array();

if(!empty($meta_queries)) $post_args['meta_query'] = $meta_queries; ?>
<?php 
    do_action( 'easybook_addons_elementor_listing_slider_before');
    $action_args = array(
        'gmap_listings' => array()
    );
    $posts_query = new \WP_Query($post_args);
    if($posts_query->have_posts()) : ?>
        <?php while($posts_query->have_posts()) : $posts_query->the_post();  

        // $action_args['gmap_listings'][] = easybook_addons_get_listing_post_data();
        // do_action_ref_array( 'easybook_addons_elementor_listing_slider_after', array(&$action_args) );
        endwhile; ?>
    <?php endif; ?> 
<?php  //wp_localize_script( 'easybook-addons', '_easybook_add_ons_slider', $action_args['gmap_listings']); ?>

<!-- carousel -->
<div class="<?php echo esc_attr( $css_class );?>">
    <!--listing-carousel-->
    <div class="listing-carousel  fl-wrap" data-items='<?php echo rawurlencode(json_encode($action_args['gmap_listings']));?>'></div>
    <!--listing-carousel end-->
    <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
    <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
</div>
<!--  carousel end-->
<?php //easybook_addons_get_template_part('templates/tmpls'); ?>
<?php wp_reset_postdata();?>
<?php


