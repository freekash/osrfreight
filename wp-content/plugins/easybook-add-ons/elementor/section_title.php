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

class CTH_Section_Title extends Widget_Base {

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
        return 'section_title';
    }

    // public function get_id() {
    //    	return 'header-search';
    // }

    public function get_title() {
        return __( 'Section Title', 'easybook-add-ons' );
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

        // $this->add_control(
        //     'local',
        //     [
        //         'label' => __( 'Section Title Location', 'easybook-add-ons' ),
        //         'type' => Controls_Manager::SELECT,
        //         'options' => [
        //             'left' => esc_html__('Left', 'easybook-add-ons'), 
        //             'center' => esc_html__('Center', 'easybook-add-ons'), 
        //             'right' => esc_html__('Right', 'easybook-add-ons'), 
        //         ],
        //         'default' => 'left',                
        //     ]
        // );

        $this->add_control(
            'sec_title_color',
            [
                'label' => __( 'Section Title Color', 'easybook-add-ons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'theme' => esc_html__('Theme', 'easybook-add-ons'), 
                    'white' => esc_html__('White', 'easybook-add-ons'), 
                    'dk-blue' => esc_html__('Dark Blue', 'easybook-add-ons'), 
                ],
                'default' => 'dk-blue',                
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Our Awesome <span>Story</span>',
                'label_block' => true,
                
            ]
        );

        // $this->add_control(
        //     'over_title',
        //     [
        //         'label' => __( 'Overlay Title', 'easybook-add-ons' ),
        //         'type' => Controls_Manager::TEXT,
        //         'default' => 'Catalog of Categories',
        //         'label_block' => true,
        //         // 'separator' => 'before'
                
        //     ]
        // );
        $this->add_control(
            'show_stars',
            [
                'label' => __( 'Show Stars', 'easybook-add-ons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Show', 'easybook-add-ons' ),
                'label_off' => __( 'Hide', 'easybook-add-ons' ),
                'return_value' => 'yes',
            ]
        );
        $this->add_control(
            'show_sep',
            [
                'label' => __( 'Show Separator', 'easybook-add-ons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Show', 'easybook-add-ons' ),
                'label_off' => __( 'Hide', 'easybook-add-ons' ),
                'return_value' => 'yes',
            ]
        );
        $this->add_control(
            'separator_color',
            [
                'label' => __( 'Separator Color', 'easybook-add-ons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'theme' => esc_html__('Theme', 'easybook-add-ons'), 
                    'yellow' => esc_html__('Yellow', 'easybook-add-ons'), 
                    'dk-blue' => esc_html__('Dark Blue', 'easybook-add-ons'), 
                ],
                'default' => 'dk-blue',                
            ]
        );
        $this->add_control(
            'sub_title',
            [
                'label' => __( 'Sub-Title', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXTAREA, // WYSIWYG,
                'default' => '<p>Explore some of the best tips from around the city from our partners and friends.</p>',
                // 'show_label' => false,
            ]
        );

        

        

        $this->end_controls_section();

    }

    protected function render( ) {

        $settings = $this->get_settings();
        ?>
        <div class="section-title section-title-<?php echo $settings['sec_title_color']; ?> fl-wrap">
            <?php if($settings['show_stars'] == 'yes')
             echo '<div class="section-title-separator"><span></span></div>'; ?>
            <?php if(!empty($settings['title'])) echo '<h2>'.$settings['title'].'</h2>'; ?>
            <!-- <?php if(!empty($settings['over_title'])) echo '<div class="section-subtitle">'.$settings['over_title'].'</div>'; ?> -->
            <?php 
            if($settings['show_sep'] == 'yes'): ?>
                <span class="section-separator section-separator-<?php echo $settings['separator_color']; ?>"></span> 
            <?php
                endif;
            ?>
            <?php echo $settings['sub_title'];?> 
        </div>
        <?php

    }

    protected function _content_template() {
        ?>
        <div class="section-title">
            <# if(settings.title){ #><h2>{{{settings.title}}}</h2><# } #>
            <# if(settings.over_title){ #><div class="section-subtitle">{{{settings.over_title}}}</div><# } #>
            <# if(settings.show_sep == 'yes'){ #><span class="section-separator"></span><# } #>
            {{{settings.sub_title}}}
        </div>
        <?php

    }

   
   

}

// Plugin::instance()->widgets_manager->register_widget( 'Elementor\Widget_Header_Search' );

// Plugin::$instance->elements_manager->create_element_instance

