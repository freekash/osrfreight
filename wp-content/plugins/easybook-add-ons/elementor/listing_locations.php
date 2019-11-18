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

class CTH_Listing_Locations extends Widget_Base {

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
        return 'listing_locations'; 
    } 

    // public function get_id() {
    //    	return 'header-search';
    // }

    public function get_title() {
        return __( 'Listing Locations', 'easybook-add-ons' );
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
                'label' => __( 'Locations Query', 'easybook-add-ons' ),
            ]
        );

        $this->add_control(
            'cat_ids',
            [
                'label' => __( 'Select Locations to include (Leave empty for ALL)', 'easybook-add-ons' ),
                'type' => Controls_Manager::SELECT2,
                'options' => easybook_addons_get_listing_locations_select2(),
                'multiple' => true,
                'label_block' => true,
                // 'default' => 'date',
                // 'separator' => 'before',
                // 'description' => esc_html__("Select how to sort retrieved posts. More at ", 'easybook-add-ons').'<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.', 
            ]
        );

        $this->add_control(
            'cat_ids_not',
            [
                'label' => __( 'Or Locations to exclude (Leave empty for ALL)', 'easybook-add-ons' ),
                'type' => Controls_Manager::SELECT2,
                'options' => easybook_addons_get_listing_locations_select2(),
                'multiple' => true,
                'label_block' => true,
                // 'default' => 'date',
                // 'separator' => 'before',
                // 'description' => esc_html__("Select how to sort retrieved posts. More at ", 'easybook-add-ons').'<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.', 
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => __( 'Order by', 'easybook-add-ons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'name' => esc_html__('Name', 'easybook-add-ons'), 
                    'slug' => esc_html__('Slug', 'easybook-add-ons'), 
                    'term_group' => esc_html__('Term Group', 'easybook-add-ons'), 
                    'term_id' => esc_html__('Term ID', 'easybook-add-ons'), 
                    'description' => esc_html__('Description', 'easybook-add-ons'),
                    'parent' => esc_html__('Parent', 'easybook-add-ons'),
                    'count' => esc_html__('Term Count', 'easybook-add-ons'),
                    'include' => esc_html__('For Include above', 'easybook-add-ons'),
                ],
                'default' => 'name',
                'separator' => 'before',
                'description' => esc_html__("Select how to sort retrieved categories. More at ", 'easybook-add-ons').'<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.', 
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
            'hide_empty',
            [
                'label' => __( 'Hide Empty', 'easybook-add-ons' ),
                'description' => esc_html__('Whether to hide categories not assigned to any listings', 'easybook-add-ons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '1',
                'label_on' => __( 'Yes', 'easybook-add-ons' ),
                'label_off' => __( 'No', 'easybook-add-ons' ),
                'return_value' => '1',
            ]
        );


        $this->add_control(
            'number',
            [
                'label' => __( 'Number of Locations to show', 'easybook-add-ons' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '6',
                'description' => esc_html__("Number of Locations to show (0 for all).", 'easybook-add-ons'),
                'min'     => 0,
                'step'     => 1,
                
            ]
        );

        

        $this->end_controls_section();

        $this->start_controls_section(
            'section_layout',
            [
                'label' => __( 'Locations Layout', 'easybook-add-ons' ),
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
                    'seven' => esc_html__('Seven Columns', 'easybook-add-ons'), 
                    'eight' => esc_html__('Eight Columns', 'easybook-add-ons'), 
                    'nine' => esc_html__('Nine Columns', 'easybook-add-ons'), 
                    'ten' => esc_html__('Ten Columns', 'easybook-add-ons'), 
                ],
                'default' => 'three',
                // 'description' => esc_html__("Number of posts to show (-1 for all).", 'easybook-add-ons'),
                
            ]
        );

        $this->add_control(
            'items_width',
            [
                'label' => __( 'Locations Items Width', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,

                'label_block' => true,
                // 'default' => 'date',
                // 'separator' => 'before',
                'description' => esc_html__('Defined location width. Available values are x1(default),x2(x2 width),x3(x3 width), and separated by comma. Ex: x1,x1,x2,x1,x1,x1', 'easybook-add-ons')
            ]
        );

        $this->add_control(
            'space',
            [
                'label' => __( 'Space', 'easybook-add-ons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'big' => esc_html__('Big', 'easybook-add-ons'), 
                    'medium' => esc_html__('Medium', 'easybook-add-ons'), 
                    'small' => esc_html__('Small', 'easybook-add-ons'), 
                    'extrasmall' => esc_html__('Extra Small', 'easybook-add-ons'), 
                    'no' => esc_html__('None', 'easybook-add-ons'), 
                    
                ],
                'default' => 'big',
                // 'description' => esc_html__("Number of posts to show (-1 for all).", 'easybook-add-ons'),
                
            ]
        );

        $this->add_control(
            'view_all_link',
            [
                'label' => __( 'View All Link', 'easybook-add-ons' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '',
                    'is_external' => '',
                ],
                'description' => __( 'Listing archive page: ', 'easybook-add-ons' ). get_post_type_archive_link( 'listing' ),
                'show_external' => true, // Show the 'open in new tab' button.
            ]
        );

        // $this->add_control(
        //     'show_author',
        //     [
        //         'label' => __( 'Show Author', 'easybook-add-ons' ),
        //         'type' => Controls_Manager::SWITCHER,
        //         'default' => 'yes',
        //         'label_on' => __( 'Show', 'easybook-add-ons' ),
        //         'label_off' => __( 'Hide', 'easybook-add-ons' ),
        //         'return_value' => 'yes',
        //     ]
        // );

       
        


        


        


        $this->end_controls_section();

    }

    protected function render( ) {
        $settings = $this->get_settings();
        $term_args = array(
            'taxonomy' => 'listing_location',
            'hide_empty' => (bool)$settings['hide_empty'],
            'orderby' => $settings['orderby'],
            'order' => $settings['order'],
            'number' => $settings['number'],
        );

        if(!empty($settings['cat_ids'])) $term_args['include']  = $settings['cat_ids'];
        elseif(!empty($settings['cat_ids_not'])) $term_args['exclude']  = $settings['cat_ids_not'];
        
        $listing_terms = get_terms( $term_args );

        

        if ( ! empty( $listing_terms ) && ! is_wp_error( $listing_terms ) ){
            
        

            $css_classes = array(
                'gallery-items fl-wrap mr-bot spad',
                $settings['columns_grid'] .'-columns',
                $settings['space'] .'-pad'
            );
            $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

            ?>
            <div class="<?php echo esc_attr( $css_class );?>">
                <div class="grid-sizer"></div>
                <?php 
                $items_width = explode(',',$settings['items_width']);
                // $items_width = array_filter($items_width);
                $key = 0;
                foreach ($listing_terms as $term) { 
                    
                    $imgid = '';
                    $lat = get_post_meta( $term->term_id ,ESB_META_PREFIX.'contact_infos_latitude', true );
                    $lng = get_post_meta( $term->term_id, ESB_META_PREFIX.'contact_infos_longitude', true );
                    $term_meta = get_term_meta( $term->term_id, ESB_META_PREFIX.'term_meta', true );
                    if(isset($term_meta['featured_img']) && !empty($term_meta['featured_img'])){
                       $imgid = $term_meta['featured_img']['id'];
                    }

                    $tnsize = 'easybook-lcat-one';

                    $item_cls = 'gallery-item';
                    if(isset($items_width[$key])){
                        switch ($items_width[$key]) {
                            case 'x2':
                                $item_cls .= ' gallery-item-second';
                                $tnsize = 'easybook-lcat-two';
                                break;
                            case 'x3':
                                $item_cls .= ' gallery-item-three';
                                $tnsize = 'easybook-lcat-three';
                                break;
                        }
                    }
                    ?>
                    <!-- gallery-item-->
                    <div id="listing_location-<?php echo esc_attr( $term->term_id );?>" class="<?php echo esc_attr( $item_cls ); ?>">
                        <div class="grid-item-holder">
                            <div class="listing-item-grid">
                                <?php if($imgid != '') echo '<a href="'.esc_url( get_term_link( $term ) ).'" class="listing-cat-link">' . wp_get_attachment_image( $imgid, $tnsize ) .'</a>'; ?>
                                <div class="listing-counter"><span><?php echo esc_html($term->count) ?> </span> <?php esc_html_e( 'Hotels', 'easybook-add-ons' ); ?></div>
                                <div class="listing-item-cat">
                                    <h3><a href="<?php echo esc_url( get_term_link( $term ) ) ?>"><?php echo esc_html($term->name); ?></a></h3>
                                    
                                    <div class="weather-grid"  data-city="<?php echo esc_html($term->name); ?>"></div>
                                   
                                    <?php echo term_description( $term->term_id, 'listing_location' ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- gallery-item end-->
                <?php
                    $key++;
                }
                // end foreach

                ?>
            </div>
            <?php
                $url = $settings['view_all_link']['url'];
                $target = $settings['view_all_link']['is_external'] ? 'target="_blank"' : '';
                if($url != '') echo '<div class="view-all-cats"><a href="' . $url . '" ' . $target .' class="btn color-bg">'.__('Explore All Cities','easybook-add-ons').'<i class="fa fa-angle-right"></i></a></div>';
            ?>
        <?php
        }
        // end if  ! empty( $listing_terms ) && ! is_wp_error( $listing_terms )


        

    }

    protected function _content_template() {}

   
    

}

