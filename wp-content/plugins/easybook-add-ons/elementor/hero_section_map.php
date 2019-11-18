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

class CTH_Hero_Section_Map extends Widget_Base {

    /**
    * Get widget name.
    *
    * Retrieve alert widget name.
    *
    * @since 1.0.0
    * @access public
    *
    * @return string Widget name.
    * 
    */
    public function get_name() {
        return 'hero_section_map';
    }

    // public function get_id() {
    //    	return 'header-search';
    // }

    public function get_title() {
        return __( 'Hero Section Map', 'easybook-add-ons' );
    }

    public function get_icon() {
        // Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
        return 'fa fa-trophy';
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
            'section_content',
            [
                'label' => __( 'Content', 'easybook-add-ons' ),
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => __( 'Content', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXTAREA, // WYSIWYG,
                'default' => '',
                'show_label' => false,
            ]
        );

        

        $this->add_control(
            'show_search',
            [
                'label' => __( 'Show Search Form', 'easybook-add-ons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Show', 'easybook-add-ons' ),
                'label_off' => __( 'Hide', 'easybook-add-ons' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'hide_text_field',
            [
                'label' => __( 'Hide Text Field', 'easybook-add-ons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __( 'Show', 'easybook-add-ons' ),
                'label_off' => __( 'Hide', 'easybook-add-ons' ),
                'return_value' => 'yes',
                'condition' => [
                    'show_search' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'use_pre_locs',
            [
                'label' => __( 'Use Added Locations', 'easybook-add-ons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __( 'Yes', 'easybook-add-ons' ),
                'label_off' => __( 'No', 'easybook-add-ons' ),
                'return_value' => 'yes',
                'condition' => [
                    'show_search' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'content_after',
            [
                'label' => __( 'Content After Search', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXTAREA, // WYSIWYG,
                'default' => '',
                'show_label' => false,
            ]
        );

        $this->add_control(
            'cats',
            [
                'label' => __( 'Categories List', 'easybook-add-ons' ),
                'type' => Controls_Manager::SELECT2,
                'options' => easybook_addons_get_listing_categories_select2(),
                'multiple' => true,
                'label_block' => true,
                'default'   => ''
            ]
        );
        

        $this->add_control(
            'scroll_url',
            [
                'label' => __( 'Scroll button URL', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                
            ]
        );

        

        $this->end_controls_section();

        $this->start_controls_section(
            'section_background',
            [
                'label' => __( 'Listings Map Data', 'easybook-add-ons' ),
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
                
            ]
        );

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
            'use_geolocation',
            [
                'label' => __( 'Or Show listings nearby user location?', 'easybook-add-ons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Yes', 'easybook-add-ons' ),
                'label_off' => __( 'No', 'easybook-add-ons' ),
                'return_value' => 'yes',
                
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


    }

    protected function render( ) {

        $settings = $this->get_settings();

        if(!empty($settings['ids'])){
            $ids = explode(",", $settings['ids']);
            $post_args = array(
                'post_type' => 'listing',
                'posts_per_page'=> $settings['posts_per_page'],
                'post__in' => $ids,
                'post_status' => 'publish'
            );
        }elseif(!empty($settings['ids_not'])){
            $ids_not = explode(",", $settings['ids_not']);
            $post_args = array(
                'post_type' => 'listing',
                'posts_per_page'=> $settings['posts_per_page'],
                'post__not_in' => $ids_not,
                'post_status' => 'publish'
            );
        }else{
            $post_args = array(
                'post_type' => 'listing',
                'posts_per_page'=> $settings['posts_per_page'],
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

        if( $settings['featured_only'] == 'yes'){
            $post_args['meta_query'] =  array(
                                            array(
                                                'key'     => ESB_META_PREFIX .'featured',
                                                'value'   => '1',
                                                'type'      => 'NUMERIC'
                                            ),
                                        );
        }

        if( $settings['use_geolocation'] == 'yes'){
            $post_args['suppress_filters'] = false; // for additional wpdb query
            $post_args['cthqueryid'] = 'auto-locate';
        }

        $gmap_listing = array();
        $posts_query = new \WP_Query($post_args);
        if(!$posts_query->have_posts()) { 
            $post_args['suppress_filters'] = true;
            $post_args['cthqueryid'] = 'normal';
            $posts_query = new \WP_Query($post_args);
        }
        if($posts_query->have_posts()) { 
            // var_dump($posts_query);
            while($posts_query->have_posts()){ 
                $posts_query->the_post();
                $gmap_listing[] = easybook_addons_get_map_data();
            }
        }
        wp_reset_postdata();
        wp_localize_script( 'easybook-addons', '_easybook_add_ons_map', $gmap_listing);
        ?>
        <!-- home-map--> 
        <section class="hero-section-map elementor-hero-section">
            <div class="home-map fl-wrap">
                <!-- Map -->
                <div class="map-container fw-map2">
                    <?php if(easybook_addons_get_option('use_osm_map') == 'yes'): ?>
                    <div id="map-osm-main"></div>
                    
                <?php else: ?>
                    <div id="map-main"></div>
                <?php endif; ?>
                </div>
                <!-- Map end --> 

                <div class="absolute-main-search-input">
                    <div class="container">
                        <?php 
                        if(!empty($settings['content'])): ?>
                            <div class="intro-item fl-wrap">
                                <?php echo $settings['content'];?>
                            </div>
                        <?php 
                        endif;?>
                        <?php  if($settings['show_search'] == 'yes') easybook_addons_get_template_part('templates/hero_search_form'); ?>
                         <?php 
                            if(!empty($settings['content_after'])): ?>
                            <div class="intro-item-after fl-wrap">
                                <?php echo $settings['content_after'];?>
                            </div>
                        <?php 
                        endif;?>
                    </div>
                </div>
                <!-- home-map end-->  
                <?php 
                if(!empty($settings['scroll_url'])): ?>
                    <div class="header-sec-link">
                        <div class="container"><a href="<?php echo $settings['scroll_url'];?>" class="custom-scroll-link color-bg"><i class="fal fa-angle-double-down"></i></a></div>
                    </div>
                <?php 
                endif;?>
            </div>
        </section>
        <!-- section end -->
        <?php //easybook_addons_get_template_part('templates/tmpls'); ?>
        <?php
    }

}


