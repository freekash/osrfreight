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

class CTH_Testimonials_Slider extends Widget_Base {

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
        return 'testimonials_slider'; 
    }

    // public function get_id() {
    //    	return 'header-search';
    // }

    public function get_title() {
        return __( 'Testimonials Slider', 'easybook-add-ons' );
    }

    public function get_icon() {
        // Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
        return 'fa fa-font';
    }

    /**
    * Get widget categories.
    *
    * Retrieve the widget categories.
    *
    * @since 1.0.0
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
            'testimonials',
            [
                    'label' => __( 'Repeater List', 'easybook-add-ons' ),
                    'type' => Controls_Manager::REPEATER,
                    'default' => [
                            [
                                'name' => 'Lisa Noory',
                                'job' => 'Restaurant Owner',
                                'rating' => '5',
                                'comment' => 'Qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram seacula quarta decima et quinta decima.',
                                'name_face' => 'Via Facebook',
                                'link' => 'http://facebook.com',
                            ],
                            [
                                'name' =>'Antony Moore',
                                'job' => 'Restaurant Owner',
                                'rating' => '4',
                                'comment' => 'Qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram seacula quarta decima et quinta decima.',
                                'name_face' => 'Via Facebook',
                                'link' => 'http://facebook.com',
                            ],
                            [
                                'name' => 'Austin Harisson',
                                'job' => 'Restaurant Owner',
                                'rating' => '5',
                                'comment' => 'Qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram seacula quarta decima et quinta decima.',
                                'name_face' => 'Via Facebook',
                                'link' => 'http://facebook.com',
                            ],
                            [
                                'name' =>  'Garry Colonsi',
                                'job' => 'Restaurant Owner',
                                'rating' => '3',
                                'comment' => 'Qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram seacula quarta decima et quinta decima.',
                                'name_face' => 'Via Facebook',
                                'link' => 'http://facebook.com',
                            ],
                    ],
                    'fields' => [
                            [
                                'name' => 'name',
                                'label' => __( 'Name', 'easybook-add-ons' ),
                                'type' => Controls_Manager::TEXT,
                                'default' => __( 'Lisa Noory' , 'easybook-add-ons' ),
                                'label_block' => true,
                            ],
                            [
                                'name' => 'job',
                                'label' => __( 'Job', 'easybook-add-ons' ),
                                'type' => Controls_Manager::TEXT,
                                'default' => __( 'Restaurant Owner' , 'easybook-add-ons' ),
                                'label_block' => true,
                            ],
                            [
                                'name' => 'comment',
                                'label' => __( 'Comment', 'easybook-add-ons' ),
                                'type' => Controls_Manager::WYSIWYG,
                                'default' => 'Qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram seacula quarta decima et quinta decima.',
                                'show_label' => false,
                            ],
                            [
                                'name' => 'avatar',
                                'label' => __('Avatar Image' , 'easybook-add-ons'),
                                'type' =>Controls_Manager::MEDIA,
                                'default' =>[
                                                'url'=> Utils::get_placeholder_image_src(),
                                            ]
                            ],
                            [
                                'name' => 'rating',
                                'label' => __( 'Rating', 'easybook-add-ons' ),
                                'type' => Controls_Manager::SELECT,
                                'default' => '5',
                                'options' => [
                                    '1'  => __( '1 Star', 'easybook-add-ons' ),
                                    '2' => __( '2 Stars', 'easybook-add-ons' ),
                                    '3' => __( '3 Stars', 'easybook-add-ons' ),
                                    '4' => __( '4 Stars', 'easybook-add-ons' ),
                                    '5'   => __( '5 Stars', 'easybook-add-ons' ),
                                 ],
                                'show_label' => false,
                            ],
                            [
                                'name' => 'name_face',
                                'label' => __( 'Name Facebook', 'easybook-add-ons' ),
                                'type' => Controls_Manager::TEXT,
                                'default' => __( 'Via Facebook' , 'easybook-add-ons' ),
                                'label_block' => true,
                            ],
                            [
                                'name' => 'link',
                                'label' => __( 'Link', 'easybook-add-ons' ),
                                'type' => Controls_Manager::URL,
                                'default' => [
                                            'url' => '',
                                            'is_external' => '',
                                        ],
                            ]
                    ],
                    'title_field' => '{{{ name }}}',
            ]
        );

        

        

        $this->end_controls_section();

    }

    protected function render( ) {

        $settings = $this->get_settings();
        $testimonials = $settings['testimonials'];
        if(!empty($testimonials)) :
        ?> 
        <div class="testimonials-carousel carousel fl-wrap slick-carouse-wrap">
            <div class="single-carousel fl-wrap">
            <?php 
            foreach ($testimonials as $key => $testi ) { 
                $rating_base = (int)easybook_addons_get_option('rating_base');
            ?>
                <!--slick-slide-item-->
                <div class="slick-slide-item">
                    <div class="testimonials-carousel-item">
                        <?php 
                        $avatar = $testi['avatar'];
                        if($avatar['id'] != '') echo '<div class="testimonilas-avatar">'.wp_get_attachment_image( $avatar['id'], 'thumbnail' ).'</div>';
                        ?>
                        <div class="listing-rating card-popup-raining" data-rating="<?php echo esc_attr( $testi['rating'] );?>" data-stars="<?php echo $rating_base;?>"></div>
                        <div class="review-owner fl-wrap"><?php if($testi['name']!= '') echo $testi['name']; ?> - <?php if($testi['job']!= '') echo '<span>'.$testi['job'].'</span>';  ?></div>
                        <?php echo $testi['comment'] ?>
                        <?php
                            $url = $testi['link']['url'];
                            $target = $testi['link']['is_external'] ? 'target="_blank"' : '';
                        ?>
                        <a href="<?php echo $url; ?>" <?php echo $target; ?> class="testim-link"><?php echo $testi['name_face']; ?></a>
                    </div>
                </div>
                <!--slick-slide-item end-->
            <?php
            } ?>
            </div>
                <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
                <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
        </div> 
        <?php
        endif;
        // end if if(!empty($testimonials))

    }

    // protected function _content_template() {
    //     
    //     <div class="section-title">
    //         <# if(settings.title){ #><h2>{{{settings.title}}}</h2><# } #>
    //         <# if(settings.over_title){ #><div class="section-subtitle">{{{settings.over_title}}}</div><# } #>
    //         <# if(settings.show_sep == 'yes'){ #><span class="section-separator"></span><# } #>
    //         {{{settings.sub_title}}}
    //     </div>
    //     <?php

    }


// Plugin::instance()->widgets_manager->register_widget( 'Elementor\Widget_Header_Search' );

// Plugin::$instance->elements_manager->create_element_instance

