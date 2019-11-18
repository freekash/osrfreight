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

class CTH_Listings_Grid_New extends Widget_Base {

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
        return 'listings_grid_new';
    }

    // public function get_id() {
    //    	return 'header-search';
    // }

    public function get_title() {
        return __( 'Listings Grid - NEW', 'easybook-add-ons' );
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
                'label' => __( 'Listings Query', 'easybook-add-ons' ),
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
                'default' => '6',
                'min' => -1,
                'description' => esc_html__("Number of posts to show (-1 for all).", 'easybook-add-ons'),
                
            ]
        );

        

        $this->end_controls_section();

        $this->start_controls_section(
            'section_layout',
            [
                'label' => __( 'Listings Layout', 'easybook-add-ons' ),
            ]
        );

        // $this->add_control(
        //     'title',
        //     [
        //         'label' => __( 'Title Text', 'easybook-add-ons' ),
        //         'type' => Controls_Manager::TEXT,
        //         'default' => 'Results For : <span>All Listings</span>',
        //         'label_block' => true,
                
        //     ]
        // );

        

        $this->add_control(
            'map_pos',
            [
                'label' => __( 'Map Position', 'easybook-add-ons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'top' => esc_html__('Top', 'easybook-add-ons'), 
                    'left' => esc_html__('Left', 'easybook-add-ons'), 
                    'right' => esc_html__('Right', 'easybook-add-ons'), 
                    'hide' => esc_html__('Hide', 'easybook-add-ons'), 
                ],
                'default' => 'right',
                'description' => esc_html__("Select Google Map position", 'easybook-add-ons'), 
            ]
        );
        $this->add_control(
            'map_width',
            [
                'label' => __( 'Map Width', 'easybook-add-ons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '30' => esc_html__('30%', 'easybook-add-ons'), 
                    '40' => esc_html__('40%', 'easybook-add-ons'), 
                    '50' => esc_html__('50%', 'easybook-add-ons'), 
                    '60' => esc_html__('60%', 'easybook-add-ons'), 
                    '70' => esc_html__('70%', 'easybook-add-ons'), 
                ],
                'default' => '50',
                'description' => esc_html__("Select Google Map width", 'easybook-add-ons'), 
            ]
        );

        $this->add_control(
            'filter_pos',
            [
                'label' => __( 'Filter Position', 'easybook-add-ons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'top' => esc_html__('Top', 'easybook-add-ons'), 
                    'left' => esc_html__('Left', 'easybook-add-ons'), 
                    'right' => esc_html__('Right', 'easybook-add-ons'), 
                    'left_col' => esc_html__('Column Left', 'easybook-add-ons'), 
                ],
                'default' => 'top',
                // 'condition' => [
                //     'map_pos' => ['top','hide'],
                // ],
                'description' => esc_html__("Select Listing Filter position", 'easybook-add-ons'), 
            ]
        );

        $this->add_control(
            'columns_grid',
            [
                'label' => __( 'Columns Grid', 'easybook-add-ons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'one' => esc_html__('One Column', 'easybook-add-ons'), 
                    'two' => esc_html__('Two Columns', 'easybook-add-ons'), 
                    'three' => esc_html__('Three Columns', 'easybook-add-ons'), 
                    'four' => esc_html__('Four Columns', 'easybook-add-ons'), 
                    'five' => esc_html__('Five Columns', 'easybook-add-ons'), 
                    'six' => esc_html__('Six Columns', 'easybook-add-ons'), 
                ],
                'default' => 'three',
                // 'description' => esc_html__("Number of posts to show (-1 for all).", 'easybook-add-ons'),
                
            ]
        );

        

        // $this->add_control(
        //     'read_all_link',
        //     [
        //         'label' => __( 'Read All URL', 'easybook-add-ons' ),
        //         'type' => Controls_Manager::URL,
        //         'default' => [
        //             'url' => 'http://',
        //             'is_external' => '',
        //         ],
        //         'show_external' => true, // Show the 'open in new tab' button.
        //     ]
        // );


        $this->add_control(
            'show_pagination',
            [
                'label' => __( 'Show Pagination', 'easybook-add-ons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Show', 'easybook-add-ons' ),
                'label_off' => __( 'Hide', 'easybook-add-ons' ),
                'return_value' => 'yes',
            ]
        );
        // $this->add_control(
        //     'show_load_more',
        //     [
        //         'label' => __( 'Show Load More', 'easybook-add-ons' ),
        //         'type' => Controls_Manager::SWITCHER,
        //         'default' => 'yes',
        //         'label_on' => __( 'Show', 'easybook-add-ons' ),
        //         'label_off' => __( 'Hide', 'easybook-add-ons' ),
        //         'return_value' => 'no',
        //     ]
        // );


        


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

        $filter_args = array(
            'posts_per_page'=> $settings['posts_per_page'],
            'orderby'=> $settings['order_by'],
            'order'=> $settings['order'],
        );

        if($settings['order_by'] == 'listing_featured'){
            $post_args['meta_key'] = ESB_META_PREFIX.'featured';
            $post_args['orderby'] = 'meta_value_num';
            
            $filter_args['meta_key'] = ESB_META_PREFIX.'featured';
            $filter_args['orderby'] = 'meta_value_num';
        }



        $tax_queries = array();

        
        if(!empty($settings['cat_ids'])){
            $tax_queries[] =    array(
                                    'taxonomy' => 'listing_cat',
                                    'field'    => 'term_id',
                                    'terms'    => $settings['cat_ids'],
                                );
        }
        if(!empty($settings['loc_ids'])){
            $tax_queries[] =    array(
                                    'taxonomy' => 'listing_location',
                                    'field'    => 'term_id',
                                    'terms'    => $settings['loc_ids'],
                                );
        }

        if(!empty($tax_queries)){
            // if( count($tax_queries) > 1 ) $tax_queries['relation'] = 'AND';
            $post_args['tax_query'] = $tax_queries;
        } 

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
            'listings-grid-wrap clearfix',
            $settings['columns_grid'].'-cols'
        );

        $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

        ?>
        <!-- carousel -->
        <div class="<?php echo esc_attr( $css_class );?>">
               
        
                <!-- list-main-wrap-->
                <div class="list-main-wrap fl-wrap card-listing">
                    
                    <div class="container"> 
                        <div class="row">
                            
                            <div class="col-md-12">

                                <div id="listing-items" class="listing-items clearfix">
                                <?php
                                $action_args = array(
                                    'listings' => array()
                                );
                                // https://codex.wordpress.org/Function_Reference/do_action_ref_array
                                do_action_ref_array( 'easybook_addons_elementor_listings_grid_before', array(&$action_args) );

                                $posts_query = new \WP_Query($post_args);
                                if($posts_query->have_posts()) :
                                    /* Start the Loop */
                                    while($posts_query->have_posts()) : $posts_query->the_post(); 
                                        easybook_addons_get_template_part('template-parts/listing');
                                        $action_args['listings'][] = get_the_ID();

                                    endwhile;

                                elseif(empty($action_args['listings'])):

                                    easybook_addons_get_template_part('template-parts/search-no');

                                endif;
                                ?>
                                </div>
                                <?php
                                if($settings['show_pagination'] == 'yes'){
                                ?>
                                <div class="listings-pagination-wrap">
                                    <?php
                                    easybook_addons_custom_pagination($posts_query->max_num_pages,$range = 2, $posts_query);
                                    ?>
                                </div>
                                <?php
                                }
                                // end if has_posts
                                // wp_localize_script( 'easybook-addons', '_easybook_add_ons_locs', $action_args); 
                                // wp_localize_script( 'easybook-addons', '_easybook_add_ons_eqv', $posts_query->query_vars);

              
                                ?>
                            </div>
                            <!-- end col-md-12 -->
                            

                        </div> 
                        <!-- end row -->
                    </div>
                    <!-- end container -->
                </div>
                <!-- list-main-wrap end-->
            
        </div>
        <!--  listings-grid-wrap end-->
        
        <?php
         // easybook_addons_get_template_part('templates/tmpls'); 
         ?>

        <?php wp_reset_postdata();?>
        <?php

    }

    // protected function _content_template() {}

   
    

}
