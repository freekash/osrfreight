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




function easybook_addons_elementor_listing_slider_ads(){
    if(easybook_addons_get_option('ads_home_enable') != 'yes') 
        return;
    
    $args = array(
        'post_type'             => 'listing', 
        'orderby'               => easybook_addons_get_option('ads_home_orderby'),
        'order'                 => easybook_addons_get_option('ads_home_order'),
        'posts_per_page'        => easybook_addons_get_option('ads_home_count'),
        'meta_query'            => array(
            'relation' => 'AND',
            array(
                'key'     => ESB_META_PREFIX.'is_ad',
                'value'   => '1',
            ),
            array(
                    'key'     => ESB_META_PREFIX.'ad_position_home',
                    'value'   => '1',
            ),
            array(
                'key'     => ESB_META_PREFIX.'ad_expire',
                'value'   => current_time('mysql', 1),
                'compare' => '>=',
                'type'    => 'DATETIME',
            ),
        ),

    );

    // The Query
    $posts_query = new WP_Query( $args );
    if($posts_query->have_posts()) :

        while($posts_query->have_posts()) : $posts_query->the_post();
            ?>
            <!--slick-slide-item-->
            <?php easybook_addons_get_template_part('template-parts/listing', false, array('is_ad'=>true,'for_slider'=>true));?>
            <!--slick-slide-item-->
            <?php
        endwhile;
        wp_reset_postdata();
    endif;
}
add_action( 'easybook_addons_elementor_listing_slider_before', 'easybook_addons_elementor_listing_slider_ads' );

function easybook_addons_listing_loop_before_ads(&$action_args){

    if(!empty($GLOBALS['main_ads'])){
        // var_dump($GLOBALS['main_ads']);
        // The Query
        $posts_query = new WP_Query( 
            array(
                'post_type'   => 'listing', 
                'post__in'   => $GLOBALS['main_ads'], 
                'posts_per_page'   => -1 
            ) 
        );
        
        if($posts_query->have_posts()) :
            while($posts_query->have_posts()) : $posts_query->the_post();
                easybook_addons_get_template_part('template-parts/listing', false, array('is_ad'=>true));
                $action_args['listings'][] = get_the_ID(); // for count listing post only -> not display no listing on ads
            endwhile;
        endif;

        wp_reset_postdata();
    }  
}
add_action( 'easybook_addons_listing_loop_before', 'easybook_addons_listing_loop_before_ads' );

function easybook_addons_elementor_listings_grid_before_ads(&$action_args){
    if(easybook_addons_get_option('ads_custom_grid_enable') != 'yes') return;

    $posts_args = array(
        'post_type'             => 'listing', 
        'orderby'               => easybook_addons_get_option('ads_custom_grid_orderby'),
        'order'                 => easybook_addons_get_option('ads_custom_grid_order'),
        'posts_per_page'        => easybook_addons_get_option('ads_custom_grid_count'),
        // 'post__not_in'          => array(get_the_ID()),

        'meta_query'            => array(
            'relation' => 'AND',
            array(
                'key'     => ESB_META_PREFIX.'is_ad',
                'value'   => '1',
            ),
            array(
                'key'     => ESB_META_PREFIX.'ad_position_custom_grid',
                'value'   => '1',
            ),
            array(
                'key'     => ESB_META_PREFIX.'ad_expire',
                'value'   => current_time('mysql', 1),
                'compare' => '>=',
                'type'    => 'DATETIME',
            ),
        ),

    );

    // The Query
    $posts_query = new WP_Query( $posts_args );
    
    if($posts_query->have_posts()) :
        while($posts_query->have_posts()) : $posts_query->the_post();
            easybook_addons_get_template_part('template-parts/listing', false, array('is_ad'=>true));
            $action_args['listings'][] = get_the_ID(); // for count listing post only -> not display no listing on ads
        endwhile;
    endif;

    wp_reset_postdata();
        
}
add_action( 'easybook_addons_elementor_listings_grid_before', 'easybook_addons_elementor_listings_grid_before_ads' );

