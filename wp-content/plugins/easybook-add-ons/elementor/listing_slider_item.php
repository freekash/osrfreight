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



namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class CTH_Listing_Slider_Item extends Widget_Base { 

    /**
    * Get widget name.
    *
    * Retrieve alert widget name.
    *
    * @since 1.0.0
    * @access public
    *
    * @return string Widget name.
    */
    public function get_name() {
        return 'listing_slider_item'; 
    }

    // public function get_id() {
    //    	return 'header-search';
    // }

    public function get_title() {
        return __( 'Listing Slider Item', 'easybook-add-ons' ); 
    }

    public function get_icon() {
        // Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
        return 'eicon-gallery-justified';
    }

    /**
    * Get widget categories.
    *
    * Retrieve the widget categories.
    *
    * @since 1.0.10
    * @access public
    *
    * @return array Widget categories.
    */
    public function get_categories() {
        return [ 'easybook-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_query',
            [
                'label' => __( 'Posts Query', 'easybook-add-ons' ),
            ]
        );

        $this->add_control(
            'cat_ids',
            [
                'label' => __( 'Categories to get listings', 'easybook-add-ons' ),
                'type' => Controls_Manager::SELECT2,
                'options' => easybook_addons_get_listing_categories_select2(),
                'multiple' => true,
                'label_block' => true,
                // 'default' => 'date',
                // 'separator' => 'before',
                // 'description' => esc_html__("Select how to sort retrieved posts. More at ", 'easybook-add-ons').'<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.', 
            ]
        );


        // $this->add_control(
        //     'cat_ids',
        //     [
        //         'label' => __( 'Post Category IDs to include', 'easybook-add-ons' ),
        //         'type' => Controls_Manager::TEXT,
        //         'default' => '',
        //         'label_block' => true,
        //         'description' => __("Enter post category ids to include, separated by a comma. Leave empty to get posts from all categories.", 'easybook-add-ons')
                
        //     ]
        // );

        $this->add_control(
            'ids',
            [
                'label' => __( 'Enter Post IDs', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'description' => __("Enter Post ids to show, separated by a comma. Leave empty to show all.", 'easybook-add-ons')
                
            ]
        );
        $this->add_control(
            'ids_not',
            [
                'label' => __( 'Or Post IDs to Exclude', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'description' => __("Enter post ids to exclude, separated by a comma (,). Use if the field above is empty.", 'easybook-add-ons')
                
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => __( 'Order by', 'easybook-add-ons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'date' => esc_html__('Date', 'easybook-add-ons'), 
                    'ID' => esc_html__('ID', 'easybook-add-ons'), 
                    'author' => esc_html__('Author', 'easybook-add-ons'), 
                    'title' => esc_html__('Title', 'easybook-add-ons'), 
                    'modified' => esc_html__('Modified', 'easybook-add-ons'),
                    'rand' => esc_html__('Random', 'easybook-add-ons'),
                    'comment_count' => esc_html__('Comment Count', 'easybook-add-ons'),
                    'menu_order' => esc_html__('Menu Order', 'easybook-add-ons'),
                    'post__in' => esc_html__('ID order given (post__in)', 'easybook-add-ons'),
                ],
                'default' => 'date',
                'separator' => 'before',
                'description' => esc_html__("Select how to sort retrieved posts. More at ", 'easybook-add-ons').'<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.', 
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => __( 'Sort Order', 'easybook-add-ons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => esc_html__('Ascending', 'easybook-add-ons'), 
                    'DESC' => esc_html__('Descending', 'easybook-add-ons'), 
                ],
                'default' => 'DESC',
                'separator' => 'before',
                'description' => esc_html__("Select Ascending or Descending order. More at", 'easybook-add-ons').'<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.', 
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __( 'Posts to show', 'easybook-add-ons' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '3',
                'description' => esc_html__("Number of posts to show (-1 for all).", 'easybook-add-ons'),
                
            ]
        );

        

        $this->end_controls_section();

        $this->start_controls_section(
            'section_layout',
            [
                'label' => __( 'Posts Layout', 'easybook-add-ons' ),
            ]
        );

        // $this->add_control(
        //     'columns_grid',
        //     [
        //         'label' => __( 'Columns Grid', 'easybook-add-ons' ),
        //         'type' => Controls_Manager::SELECT,
        //         'options' => [
        //             'one' => esc_html__('One Column', 'easybook-add-ons'), 
        //             'two' => esc_html__('Two Columns', 'easybook-add-ons'), 
        //             'three' => esc_html__('Three Columns', 'easybook-add-ons'), 
        //             'four' => esc_html__('Four Columns', 'easybook-add-ons'), 
        //             'five' => esc_html__('Five Columns', 'easybook-add-ons'), 
        //             'six' => esc_html__('Six Columns', 'easybook-add-ons'), 
        //         ],
        //         'default' => 'three',
        //         // 'description' => esc_html__("Number of posts to show (-1 for all).", 'easybook-add-ons'),
                
        //     ]
        // );

        

        $this->add_control(
            'read_all_link',
            [
                'label' => __( 'Read All URL', 'easybook-add-ons' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => 'http://',
                    'is_external' => '',
                ],
                'show_external' => true, // Show the 'open in new tab' button.
            ]
        );


        $this->add_control(
            'show_pagination',
            [
                'label' => __( 'Show Pagination', 'easybook-add-ons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __( 'Show', 'easybook-add-ons' ),
                'label_off' => __( 'Hide', 'easybook-add-ons' ),
                'return_value' => 'yes',
            ]
        );


        


        $this->end_controls_section();

    }

    protected function render( ) {

        $settings = $this->get_settings();

        if(is_front_page()) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        } else {
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }

        if(!empty($settings['ids'])){
            $ids = explode(",", $settings['ids']);
            $post_args = array(
                'post_type' => 'listing',
                'paged' => $paged,
                'posts_per_page'=> $settings['posts_per_page'],
                'post__in' => $ids,
                'orderby'=> $settings['order_by'],
                'order'=> $settings['order'],
                'post_status' => 'publish'
            );
        }elseif(!empty($settings['ids_not'])){
            $ids_not = explode(",", $settings['ids_not']);
            $post_args = array(
                'post_type' => 'listing',
                'paged' => $paged,
                'posts_per_page'=> $settings['posts_per_page'],
                'post__not_in' => $ids_not,
                'orderby'=> $settings['order_by'],
                'order'=> $settings['order'],

                'post_status' => 'publish'
            );
        }else{
            $post_args = array(
                'post_type' => 'listing',
                'paged' => $paged,
                'posts_per_page'=> $settings['posts_per_page'],
                'orderby'=> $settings['order_by'],
                'order'=> $settings['order'],

                'post_status' => 'publish'
            );
        }





        if(!empty($settings['cat_ids'])) $post_args['tax_query'] =  array(
            array(
                'taxonomy' => 'listing_cat',
                'field'    => 'term_id',
                'terms'    => $settings['cat_ids'],
            ),
        );

        // listing meta search
        $meta_queries = array();
        // check for membership expired
        // if(easybook_addons_get_option('membership_package_expired_hide') == 'yes'){
        //     $meta_queries['relation'] = 'OR';
        //     $meta_queries[] = array(
        //         'key'     => ESB_META_PREFIX.'expire_date',
        //         'value'   => current_time('mysql', 1),
        //         'compare' => '>=',
        //         'type'    => 'DATETIME',
        //     );
        //     $meta_queries[] = array(
        //         'key'     => ESB_META_PREFIX.'expire_date',
        //         'value'   => 'NEVER',
        //         'compare' => '=',
        //     );

        // }

        if(!empty($meta_queries)) $post_args['meta_query'] = $meta_queries;


        // $css_classes = array(
        //     'light-carouselfl-wrap card-listing slick-carouse-wrap',
        //     // 'posts-grid-',//.$settings['columns_grid']
        // );

        // $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

        ?>
        <!-- carousel -->
        <div class="light-carousel fl-wrap card-listing slick-carouse-wrap">
            <!--listing-carousel-->
            <div class="light-carousel-wrap  fl-wrap">
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
        <?php

    }

    protected function _content_template() {}

   
    

}
