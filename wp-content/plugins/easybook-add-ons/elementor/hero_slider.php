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

class CTH_Hero_Slider extends Widget_Base {

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
        return 'hero_slider';
    }

    // public function get_id() {
    //    	return 'header-search';
    // }

    public function get_title() {
        return __( 'Hero Slider', 'easybook-add-ons' );
    }

    public function get_icon() {
        // Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
        return 'eicon-accordion';
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
            'section_images',
            [
                'label' => __( 'Slides', 'easybook-add-ons' ),
            ]
        );

        

        $this->add_control(
            'slides',
            [
                'label' => __( 'Slide Items', 'easybook-add-ons' ),
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'title' => 'Slide 1',
                        'image' => array(
                            'id' => '2252',
                            'url' => 'http://localhost:8888/easybook/wp-content/uploads/2018/03/12-1.jpg'
                        ),
                        'show_search' => 'yes',
                        'hide_text_field' => 'no',
                        'use_pre_locs' => 'no',
                        'cats' => array(),
                        'content' => '<h2>We will help you to find all</h2>
<h3>Find great places , hotels , restourants , shops.</h3>',
                    ],
                    [
                        'title' => 'Slide 2',
                        'image' => array(
                            'id' => '2254',
                            'url' => 'http://localhost:8888/easybook/wp-content/uploads/2018/03/17-1.jpg'
                        ),
                        'show_search' => 'no',
                        'hide_text_field' => 'no',
                        'use_pre_locs' => 'no',
                        'cats' => array(49,48,47,50,51),
                        'content' => '<h2>Discover Our Categories</h2>
<h3>Constant care and attention to the patients makes good record.</h3>',
                    ],
                    
                ],
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => __( 'Title (for editing only)', 'easybook-add-ons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => 'Slide Title',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'image',
                        'label' => __( 'Image', 'easybook-add-ons' ),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name' => 'content',
                        'label' => __( 'Content', 'easybook-add-ons' ),
                        'type' => Controls_Manager::WYSIWYG,
                        'default' => '<h2>Discover Our Categories</h2>
<h3>Constant care and attention to the patients makes good record.</h3>',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'show_search',
                        'label' => __( 'Show Search Form', 'easybook-add-ons' ),
                        'type' => Controls_Manager::SWITCHER,
                        'default' => 'no',
                        'label_on' => __( 'Yes', 'easybook-add-ons' ),
                        'label_off' => __( 'No', 'easybook-add-ons' ),
                        'return_value' => 'yes',
                    ],
                    [
                        'name' => 'hide_text_field',
                        'label' => __( 'Hide Text Field', 'easybook-add-ons' ),
                        'type' => Controls_Manager::SWITCHER,
                        'default' => 'no',
                        'label_on' => __( 'Yes', 'easybook-add-ons' ),
                        'label_off' => __( 'No', 'easybook-add-ons' ),
                        'return_value' => 'yes',
                        'condition' => [
                            'show_search' => 'yes',
                        ],
                    ],

                    [
                        'name' => 'use_pre_locs',
                        'label' => __( 'Use Added Locations', 'easybook-add-ons' ),
                        'type' => Controls_Manager::SWITCHER,
                        'default' => 'no',
                        'label_on' => __( 'Yes', 'easybook-add-ons' ),
                        'label_off' => __( 'No', 'easybook-add-ons' ),
                        'return_value' => 'yes',
                        'condition' => [
                            'show_search' => 'yes',
                        ],
                    ],


                    [
                        'name' => 'cats',
                        'label' => __( 'Categories List', 'easybook-add-ons' ),
                        'type' => Controls_Manager::SELECT2,
                        'options' => easybook_addons_get_listing_categories_select2(),
                        'multiple' => true,
                        'label_block' => true,
                    ],
                    
                ],
                'title_field' => '{{{ title }}}',
            ]
        );


        // $this->add_control(
        //     'active',
        //     [
        //         'label'   => __( 'Active Item - 0 for first item', 'easybook-add-ons' ),
        //         'type'    => Controls_Manager::NUMBER,
        //         'default' => 0,
        //         'min'     => 0,
        //         'max'     => 100,
        //         'step'    => 1,
        //         'label_block' => true,
        //     ]
        // );
        

        $this->end_controls_section();

    }

    protected function render( ) {
        $settings = $this->get_settings();
        if(is_array($settings['slides']) && !empty($settings['slides']) ):
        ?>
        <!--section -->
        <section class="hero-section no-dadding"  id="sec1">
            <div class="slider-container-wrap slick-carouse-wrap fl-wrap">
                <div class="slider-container">
                    <?php
                    foreach ($settings['slides'] as $key => $slide) {
                    ?>
                    <!-- slideshow-item --> 
                    <div class="slider-item fl-wrap">
                        <div class="bg bg-ser" data-bg="<?php echo esc_url( easybook_addons_get_attachment_thumb_link($slide['image']['id'], 'bg-image') ); ?>"></div>
                        <div class="overlay"></div>
                        <div class="hero-section-wrap fl-wrap">
                            <div class="container">
                                <?php 
                                if(!empty($slide['content'])): ?>
                                <div class="intro-item fl-wrap">
                                    <?php echo do_shortcode( $slide['content'] );?>
                                </div>
                                <?php 
                                endif;?>
                                <?php if($slide['show_search'] == 'yes') easybook_addons_get_template_part('templates/hero_search_form', '', array('hide_text_field' => $slide['hide_text_field'], 'use_pre_locs' => $slide['use_pre_locs'] ) ); ?>
                                <?php 
                                if(is_array($slide['cats']) && !empty($slide['cats'])){ ?>
                                <div class="box-cat-container">
                                <?php
                                    foreach ($slide['cats'] as $cat) {
                                        $term = get_term( $cat, 'listing_cat');
                                        if ( empty( $term ) || is_wp_error( $term ) ) continue;
                                        $term_meta = get_term_meta( $term->term_id, ESB_META_PREFIX.'term_meta', true );
                                        $imgid = 0;
                                        if(isset($term_meta['featured_img']) && !empty($term_meta['featured_img'])){
                                           $imgid = $term_meta['featured_img']['id'];
                                        }
                                    ?>
                                    <!--box-cat-->
                                    <a href="<?php echo esc_url( get_term_link( $term ) ) ?>" class="box-cat color-bg" data-bgscr="<?php echo esc_url( easybook_addons_get_attachment_thumb_link($imgid, 'bg-image') ); ?>">
                                        <?php if(isset($term_meta['icon_class'])) echo '<i class="'.$term_meta['icon_class'].'"></i>'; ?>
                                        <h4><?php echo esc_html($term->name) ?></h4>
                                    </a>
                                    <!--box-cat end-->
                                    <?php
                                    } ?>
                                </div>
                                <!-- end box-cat-container -->
                                <?php
                                }


                                ?>
                            </div>
                        </div>
                    </div>
                    <!--  slideshow-item end  -->
                    <?php
                    }
                    ?>
                </div>
                <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
                <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
            </div>
        </section>
        <!-- section end -->
        <?php
        endif;
    }

    // protected function _content_template() {}
    // end _content_template



}
