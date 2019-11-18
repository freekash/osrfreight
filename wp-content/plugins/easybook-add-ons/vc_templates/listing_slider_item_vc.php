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
    'light-carousel fl-wrap card-listing slick-carouse-wrap',
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

<div class="<?php echo esc_attr( $css_class );?>">
    <!--listing-carousel-->
    <div class="light-carousel-wrap fl-wrap">
    <?php 
    $posts_query = new \WP_Query($post_args);
    if($posts_query->have_posts()) : ?>
        <?php while($posts_query->have_posts()) : $posts_query->the_post(); 
        $rating_base = (int)easybook_addons_get_option('rating_base');
    ?>
        <!--slick-slide-item-->
        <div id="post-<?php the_ID(); ?>" <?php post_class('slick-slide-item'); ?>>
            <div class="hotel-card fl-wrap title-sin_item">
                <div class="geodir-category-img card-post">
                    
                    <a href="<?php the_permalink(  );?>">
                    <?php
                    echo wp_get_attachment_image( easybook_addons_get_listing_thumbnail( get_the_ID() ) , 'easybook-listing-grid', false, array('class'=>'respimg') );
                    ?>
                    </a>
                    
                        <div class="listing-counter">
                            <?php echo sprintf(
                                __( 'Awg/Night %s', 'easybook-add-ons' ), 
                                '<strong class="per-night-price">'.easybook_addons_get_price_formated( easybook_addons_get_average_price()).'</strong>'
                            ) ?>
                        </div>
                    <?php 
                    $sale_price = get_post_meta( get_the_ID(), ESB_META_PREFIX.'sale_price', true );
                    $sale_price_class = ($sale_price >= 50) ? 'big-sale' : '';
                    if($sale_price != ''):?>
                        <div class="sale-window <?php echo $sale_price_class; ?>"><?php echo sprintf(__( 'Sale %s %%', 'easybook-add-ons' ), $sale_price); ?></div>
                    <?php endif; ?>
                    <div class="geodir-category-opt">
                        <?php 
                            $rating = easybook_addons_get_average_ratings(get_the_ID()); 
                            if (!empty($rating)): ?>
                               <div class="listing-rating card-popup-rainingvis" data-starrating2="<?php echo $rating['sum'];?>" data-stars="<?php echo $rating_base;?>"></div>
                        <?php endif; ?>
                        <h4 class="title-sin_map"><a href="<?php echo esc_url( get_permalink() ) ?>"><?php the_title(); ?></a></h4>
                         <?php
                            $contact_infos = array(
                                'address' => get_post_meta( get_the_ID(), '_cth_address', true ),
                                'latitude' => get_post_meta( get_the_ID(), '_cth_latitude', true ),
                                'longitude' => get_post_meta( get_the_ID(), '_cth_longitude', true ),
                            );
                        ?>
                        <div class="geodir-category-location"><a href="#" class="single-map-item" data-lat="<?php echo $contact_infos['latitude'];?>" data-lng="<?php echo $contact_infos['longitude'];?>" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ) ?>"><i class="fas fa-map-marker-alt"></i><?php echo esc_html( $contact_infos['address'] );?></a></div>
                        <div class="rate-class-name">
                            <div class="rate-class-warp">
                            <?php if (!empty($rating)):?>
                                <div class="score">
                                    <strong class="review-text"><?php echo easybook_addons_rating_text($rating['sum']); ?></strong>
                                    <?php
                                    echo sprintf( _nx( '%s comment', '%s comments', (int)$rating['count'], 'comments count', 'easybook-add-ons' ), (int)$rating['count'] );
                                    ?>
                                </div>
                                <span><?php echo $rating['sum']; ?></span> 
                                <?php // else:
                                    // esc_html_e( 'Not comment yet', 'easybook-add-ons' );
                                 endif; ?>
                            </div>                                           
                        </div>



                    </div>
                </div>
            </div>
        </div>
        <!--slick-slide-item-->
        <?php endwhile; ?>
    <?php endif; ?> 
    </div>
    <!--listing-carousel end-->
    <div class="swiper-button-prev sw-btn"><i class="fal fa-angle-left"></i></div>
    <div class="swiper-button-next sw-btn"><i class="fal fa-angle-right"></i></div>
</div>
<!--  carousel end-->
<?php wp_reset_postdata();?>


