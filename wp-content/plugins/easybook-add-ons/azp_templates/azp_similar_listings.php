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
$azp_mID = $el_id = $el_class = $posts_per_page = $order_by = $order = $wid_title = $responsive = $taxonomy = '';  

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_similar_listings',
    'azp-element-' . $azp_mID,
    $el_class,
);

$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) );  

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}

$terms_ids = array();
$terms = get_the_terms( get_the_ID(), $taxonomy );
if ( $terms && ! is_wp_error( $terms ) ) {
    foreach ( $terms as $term ) {
        $terms_ids[] = $term->term_id;
    }
}
$post_args = array(
    'post_type'         => 'listing',  
    'post__not_in'      => array(get_the_ID()),
    'orderby'           => $order_by,
    'order'             => $order, 
    'posts_per_page'    => $posts_per_page,
    'tax_query' => array(
        array(
            'taxonomy' => $taxonomy,
            'field'    => 'term_id',
            'terms'    => $terms_ids,
        ),
    ),
);
$posts_query = new \WP_Query($post_args);
if($posts_query->have_posts()) : ?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
    <div class="list-single-main-items">
        <?php if($wid_title != ''): ?>
        <div class="list-single-main-item-title fl-wrap">
            <h3><?php echo $wid_title; ?></h3>
        </div>
        <?php endif; ?>
        <?php 
        $slider_args = array();
        $slider_args['responsive'] = false;
        // if($responsive != ''){
        //     $responsive_arr = explode(",", $responsive);

        // } 
        $slider_args['responsive'] = trim($responsive);
        ?>
        <div class="listing-similar-posts list-carousel fl-wrap card-listing slick-carouse-wrap">
            <!--listing-carousel-->
            <div class="listing-carousel fl-wrap" data-options='<?php echo json_encode($slider_args); ?>'>
            <?php 
                while($posts_query->have_posts()) : $posts_query->the_post(); 
                    easybook_addons_get_template_part('template-parts/listing', false, array('for_slider'=>true));
                endwhile;
            ?> 
            </div>
            <!--listing-carousel end-->
            <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
            <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
        </div>
        <!--  carousel end-->
    </div>
</div> 
<?php endif;
wp_reset_postdata();
