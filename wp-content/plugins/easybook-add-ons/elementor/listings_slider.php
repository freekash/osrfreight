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

class CTH_Listings_Slider extends Widget_Base {

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
        return 'listings_slider';
    }

    // public function get_id() {
    //    	return 'header-search';
    // }

    public function get_title() {
        return __( 'Listings Slider', 'easybook-add-ons' );
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
            'featured_only',
            [
                'label' => __( 'Show featured listings only?', 'easybook-add-ons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __( 'Yes', 'easybook-add-ons' ),
                'label_off' => __( 'No', 'easybook-add-ons' ),
                'return_value' => 'yes',
                
            ]
        );


        $this->add_control(
            'posts_per_page',
            [
                'label' => __( 'Posts to show', 'easybook-add-ons' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '12',
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

        if( $settings['featured_only'] == 'yes'){
            $meta_queries[] =   array(
                                    'key'     => ESB_META_PREFIX .'featured',
                                    'value'   => '1',
                                    'type'      => 'NUMERIC'
                                );
        }

        if(!empty($meta_queries)) $post_args['meta_query'] = $meta_queries;


        $css_classes = array(
            'list-carousel fl-wrap card-listing slick-carouse-wrap',
            // 'posts-grid-',//.$settings['columns_grid']
        );

        $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

        ?>
        <!-- carousel -->
        <div class="<?php echo esc_attr( $css_class );?>">
            <!--listing-carousel-->
            <div class="listing-carousel  fl-wrap">
                <?php 
                do_action( 'easybook_addons_elementor_listing_slider_before');
                $posts_query = new \WP_Query($post_args);
                if($posts_query->have_posts()) : ?>
                    <?php 
                    while($posts_query->have_posts()) : $posts_query->the_post(); 
                        easybook_addons_get_template_part('template-parts/listing', false, array('for_slider'=>true));
                    endwhile; ?>
                <?php endif; ?> 
            </div>
            <!--listing-carousel end-->
            <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
            <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
        </div>
        <!--  carousel end-->
        <?php 
        wp_reset_postdata();

    }

    // protected function _content_template() {}

   
    

}
