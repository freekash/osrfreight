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

class CTH_Listings_Grid extends Widget_Base {
 
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
        return 'listings_grid';
    }

    // public function get_id() {
    //    	return 'header-search';
    // }

    public function get_title() {
        return __( 'Listings Grid', 'easybook-add-ons' ); 
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

        // if(is_front_page()) {
        //     $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        // } else {
        //     $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        // }

        if(!empty($settings['ids'])){
            $ids = explode(",", $settings['ids']);
            $post_args = array(
                'post_type' => 'listing',
                'paged' => 1,
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
                'paged' => 1,
                'posts_per_page'=> $settings['posts_per_page'],
                'post__not_in' => $ids_not,
                'orderby'=> $settings['order_by'],
                'order'=> $settings['order'],

                'post_status' => 'publish'
            );
        }else{
            $post_args = array(
                'post_type' => 'listing',
                'paged' => 1,
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





        if(!empty($settings['cat_ids'])) $post_args['tax_query'] =  array(
                                                                        array(
                                                                            'taxonomy' => 'listing_cat',
                                                                            'field'    => 'term_id',
                                                                            'terms'    => $settings['cat_ids'],
                                                                        ),
                                                                    );

        $meta_queries = array();
        if( $settings['featured_only'] == 'yes'){
            $meta_queries[] =   array(
                                    'key'     => ESB_META_PREFIX .'featured',
                                    'value'   => '1',
                                    'type'      => 'NUMERIC'
                                );
        }
        if(!empty($meta_queries)) $post_args['meta_query'] = $meta_queries;


        $class_width = ($settings['map_pos'] != 'top' && $settings['map_pos'] != 'hidden') ? $settings['map_width'] : '';
        $css_classes = array(
            'listings-grid-wrap clearfix',
            $settings['columns_grid'].'-cols',
            'map-width-'.$class_width
        );

        $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

        ?>
        <!-- carousel -->
        <div class="<?php echo esc_attr( $css_class );?>">
        <?php 
        $filter_wrap_cl = '';
        switch ($settings['map_pos']) {
            case 'left':
                $map_wrap_cl = 'listings-has-map column-map left-pos-map fix-map hid-mob-map';
                $list_wrap_cl = 'right-list';
                $filter_wrap_cl = 'right-filter';
                break;
            case 'right':
                $map_wrap_cl = 'listings-has-map column-map right-pos-map fix-map hid-mob-map';
                $list_wrap_cl = 'left-list';
                break;
            case 'top':
                $map_wrap_cl = 'listings-has-map fw-map top-post-map big_map hid-mob-map';
                $list_wrap_cl = 'fh-col-list-wrap left-list';
                break;
            default:
                $map_wrap_cl = 'listings-has-map column-map right-pos-map fix-map hid-mob-map';
                $list_wrap_cl = 'fh-col-list-wrap left-list fix-mar-map';
                break;
                }
        
        if($settings['filter_pos'] == 'left_col'){
            $map_wrap_cl .= ' map-lcol-filter';
            $list_wrap_cl .= ' list-lcol-filter';
        }
        ?>
        <?php 
        if($settings['map_pos'] != 'hide' && $settings['map_pos'] != 'top'): ?> 

            <div class="map-container <?php echo esc_attr( $map_wrap_cl ); ?>">
                <?php if(easybook_addons_get_option('use_osm_map') == 'yes'): ?>
                    <div id="map-osm-main"></div>
                    
                <?php else: ?>
                    <div id="map-main"></div>
                    <ul class="mapnavigation">
                        <li><a href="#" class="prevmap-nav"><i class="fas fa-caret-left"></i><?php esc_html_e( 'Prev', 'easybook-add-ons' ); ?></a></li>
                        <li><a href="#" class="nextmap-nav"><?php esc_html_e( 'Next', 'easybook-add-ons' ); ?><i class="fas fa-caret-right"></i></a></li>
                    </ul>
                    
                <?php endif; ?>
                <div class="map-close"><i class="fas fa-times"></i></div>
            </div>
            <!-- Map end -->  
        <?php endif; ?>
        <?php if($settings['map_pos'] != 'hide' && $settings['map_pos'] == 'top'): ?>
            <div class="map-container <?php echo esc_attr( $map_wrap_cl ); ?>">
                <?php if(easybook_addons_get_option('use_osm_map') == 'yes'): ?>
                    <div id="map-osm-main"></div>
                <?php else: ?>
                    <div id="map-main"></div>
                    <ul class="mapnavigation">
                        <li><a href="#" class="prevmap-nav"><i class="fas fa-caret-left"></i><?php esc_html_e( 'Prev', 'easybook-add-ons' ); ?></a></li>
                        <li><a href="#" class="nextmap-nav"><?php esc_html_e( 'Next', 'easybook-add-ons' ); ?><i class="fas fa-caret-right"></i></a></li>
                    </ul>
                    
                <?php endif; ?>
                <div class="map-close"><i class="fas fa-times"></i></div>
            </div>
            <!-- Map end -->
            <div class="breadcrumbs-fs fl-wrap">
                <div class="container">
                     <?php easybook_breadcrumbs(); ?>  
                </div>
            </div>
        <?php endif; ?>
        <?php if($settings['filter_pos'] == 'left_col'): ?>
        <div class="col-filter-wrap col-filter <?php echo esc_attr( $filter_wrap_cl ); ?>">
            <div class="container">
                <div class="mobile-list-controls fl-wrap">
                    <div class="container">
                        <div class="mlc show-hidden-column-map schm"><i class="fal fa-map-marked-alt"></i><?php esc_html_e( ' Show Map', 'easybook-add-ons' ); ?></div>
                        <div class="mlc show-list-wrap-search"><i class="fal fa-filter"></i><?php esc_html_e( ' Filter', 'easybook-add-ons' ); ?></div>
                    </div>
                </div>
                <div class="fl-wrap listing-search-sidebar">
                    <?php easybook_addons_get_template_part('templates/filter_form', '', $filter_args); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <!--col-list-wrap -->   
            <div class="col-list-wrap col-list-wrap-main <?php echo esc_attr( $list_wrap_cl ); ?> <?php if($settings['map_pos'] == 'top') echo 'col-list-top'?>">
                <?php if($settings['filter_pos'] == 'top'): ?>
                <div class="mobile-list-controls fl-wrap">
                    <div class="container">
                        <?php if ($settings['map_pos'] != 'hide') {?>
                            <div class="mlc show-hidden-column-map schm"><i class="fal fa-map-marked-alt"></i><?php esc_html_e( ' Show Map', 'easybook-add-ons' ); ?></div>
                            <div class="mlc show-list-wrap-search"><i class="fal fa-filter"></i><?php esc_html_e( ' Filter', 'easybook-add-ons' ); ?></div>
                        <?php }else{?>
                             <div class="mlc show-list-wrap-search fl-wrap"><i class="fal fa-filter"></i><?php esc_html_e( ' Filter', 'easybook-add-ons' ); ?></div>
                        <?php } ?>
                    </div>
                </div>
                <?php if($settings['map_pos'] == 'left' || $settings['map_pos'] == 'right'){?>
                     <?php easybook_addons_get_template_part( 'templates/filter_form', '', $filter_args ); ?>
                <?php }else{ ?>
                    <div class="fl-wrap top-filter-wrap">
                        <div class="container">
                             <?php easybook_addons_get_template_part( 'templates/filter_form', '', $filter_args ); ?>
                        </div>
                    </div>
                <?php } ?>
                <?php elseif($settings['filter_pos'] == 'left_col'): ?>
                <div class="mobile-list-controls fl-wrap">
                    <div class="container">
                        <div class="mlc show-hidden-column-map schm"><i class="fal fa-map-marked-alt"></i><?php esc_html_e( ' Show Map', 'easybook-add-ons' ); ?></div>
                        <div class="mlc show-list-wrap-search"><i class="fal fa-filter"></i><?php esc_html_e( ' Filter', 'easybook-add-ons' ); ?></div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if ($settings['filter_pos'] == 'left_col'|| $settings['filter_pos'] == 'left' && $settings['map_pos'] == 'top') {?>
                   <div class="mobile-list-controls fl-wrap">
                        <div class="container">
                            <div class="mlc show-hidden-column-map schm"><i class="fal fa-map-marked-alt"></i><?php esc_html_e( ' Show Map', 'easybook-add-ons' ); ?></div>
                            <div class="mlc show-list-wrap-search"><i class="fal fa-filter"></i><?php esc_html_e( ' Filter', 'easybook-add-ons' ); ?></div>
                        </div>
                    </div>
                <?php } ?>
                <!-- list-main-wrap-->
                <div class="<?php if($settings['map_pos'] != 'top' && $settings['filter_pos'] != 'left') echo 'list-main-wrap'?> fl-wrap card-listing">
                    <a class="custom-scroll-link back-to-filters" href="#lisfw"><i class="fas fa-angle-up"></i>
                        <span><?php esc_html_e( 'Back to Filters', 'easybook-add-ons' ); ?></span></a> 
                    <div class="container"> 
                        <div class="row">
                            <?php 
                            if($settings['filter_pos'] == 'left'):?>
                            <div class="mobile-list-controls fl-wrap">
                                <div class="container">
                                    <div class="mlc show-hidden-column-map schm"><i class="fal fa-map-marked-alt"></i> <?php esc_html_e( ' Show Map', 'easybook-add-ons' ); ?></div> 
                                    <div class="mlc show-list-wrap-search"><i class="fal fa-filter"></i><?php esc_html_e( ' Filter', 'easybook-add-ons' ); ?></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fl-wrap listing-search-sidebar ">
                                    <?php easybook_addons_get_template_part('templates/filter_form', '', $filter_args ); ?>
                                </div>
                            </div>
                            <?php endif;?>
                            <?php 
                            if($settings['map_pos'] == 'top' && $settings['filter_pos'] == 'left'):?>
                                  <div class="mobile-list-controls fl-wrap" style="margin-bottom: 50px;margin-top:0;">
                                    <div class="container">
                                        <div class="mlc show-hidden-column-map schm"><i class="fal fa-map-marked-alt"></i> <?php esc_html_e( ' Show Map', 'easybook-add-ons' ); ?></div>
                                        <div class="mlc show-list-wrap-search"><i class="fal fa-filter"></i><?php esc_html_e( ' Filter', 'easybook-add-ons' ); ?></div>
                                    </div>
                                </div>
                            <?php 
                               endif; 
                                ?>
                            <?php 
                            if($settings['filter_pos'] == 'left'||$settings['filter_pos'] == 'right'):?>
                            <div class="col-md-8">
                            <?php else : ?>
                            <div class="col-md-12">
                            <?php endif;?>
                                 <div class="listsearch-header fl-wrap">
                                    <div class="list-main-wrap-title fl-wrap">
                                        <h2><?php esc_html_e( 'Results For : ',  'easybook-add-ons' );?><span><?php esc_html_e( 'All Listing',  'easybook-add-ons' );?></span></h2>
                                    </div>
                                    <!-- list-main-wrap-opt-->
                                    <div class="list-main-wrap-opt fl-wrap">
                                        <!-- price-opt-->
                                        <div class="price-opt">
                                            <span class="price-opt-title"><?php esc_html_e( 'Sort results by:',  'easybook-add-ons' );?></span>
                                            <div class="listsearch-input-item">
                                                <select data-placeholder="Popularity" class="chosen-select no-search-select" name="morderby">
                                                    <option value="popularity"><?php esc_html_e( 'Popularity',  'easybook-add-ons' );?></option>
                                                    <option value="average_rating"><?php esc_html_e( 'Average rating',  'easybook-add-ons' );?></option>
                                                    <option value="price_low"><?php esc_html_e( 'Price: low to high',  'easybook-add-ons' );?></option>
                                                    <option value="price_high"><?php esc_html_e( 'Price: high to low',  'easybook-add-ons' );?></option>
                                                </select>
                                            </div>
                                            <?php  ?>
                                        </div>
                                        <!-- price-opt end-->
                                        <!-- price-opt-->
                                        <div class="listing-view-layout grid-opt">
                                            <ul>
                                                <li><a class="grid<?php if(easybook_addons_get_option('listings_grid_layout')=='grid') echo ' active';?>" href="#"><i class="fas fa-th-large"></i></a></li>
                                                <li><a class="list<?php if(easybook_addons_get_option('listings_grid_layout')=='list') echo ' active';?>" href="#"><i class="fas fa-bars"></i></i></a></li>
                                            </ul>
                                        </div>
                                        <!-- price-opt end-->                             
                                    </div>
                                    <!-- list-main-wrap-opt end-->
                                </div>
                                <div class="listing-term-desc"></div>
                                <div id="listing-items" class="listing-items pot-fl clearfix">
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
                                    easybook_addons_ajax_pagination($posts_query->max_num_pages,$range = 2, $posts_query);
                                    ?>
                                </div>
                                <?php
                                }
                                // end if has_posts
                                // wp_localize_script( 'easybook-addons', '_easybook_add_ons_locs', $action_args);
                                // wp_localize_script( 'easybook-addons', '_easybook_add_ons_eqv', $posts_query->query_vars);

              
                                ?>
                            </div>
                            <!-- end col-md-8 -->
                            <?php 
                            if($settings['filter_pos'] == 'right'):?>
                            <div class="col-md-4">
                                <?php if ($settings['map_pos'] == 'hide'){ ?>
                                    <div class="mobile-list-controls fl-wrap" style="margin-bottom: 50px;margin-top:0;">
                                        <div class="container">
                                            <div class="mlc show-list-wrap-search fl-wrap"><i class="fal fa-filter"></i> Filter</div>
                                        </div>
                                    </div>
                                <?php }else{ ?>
                                    <div class="mobile-list-controls fl-wrap">
                                        <div class="container">
                                            <div class="mlc show-hidden-column-map schm"><i class="fal fa-map-marked-alt"></i><?php esc_html_e( ' Show Map', 'easybook-add-ons' ); ?></div> 
                                            <div class="mlc show-list-wrap-search"><i class="fal fa-filter"></i><?php esc_html_e( ' Filter', 'easybook-add-ons' ); ?></div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="fl-wrap listing-search-sidebar">
                                    <?php easybook_addons_get_template_part('templates/filter_form', '', $filter_args ); ?>
                                </div>
                            </div>
                            <?php endif;?>

                        </div> 
                        <!-- end row -->
                    </div>
                    <!-- end container -->
                </div>
                <!-- list-main-wrap end-->
            </div>
            <!--col-list-wrap -->  
            <!-- <div class="limit-box fl-wrap"></div> -->
        </div>
        <!--  listings-grid-wrap end-->

        <div class="limit-box fl-wrap"></div>
        
        <?php //easybook_addons_get_template_part('templates/tmpls'); ?>

        <?php wp_reset_postdata();?>
        <?php

    }

    // protected function _content_template() {}

   
    

}
