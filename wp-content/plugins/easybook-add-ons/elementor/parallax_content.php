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

class CTH_Parallax_Content extends Widget_Base {

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
        return 'parallax_content';
    }

    // public function get_id() {
    //    	return 'header-search';
    // }

    public function get_title() {
        return __( 'Parallax Content', 'easybook-add-ons' );
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
            'title',
            [
                'label' => __( 'Title', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Need more information',
                'label_block' => true,
                
            ]
        );
        $this->add_control(
            'sub_title',
            [
                'label' => __( 'Content', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '<h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</h3>',
                'label_block' => true,
                
            ]
        );
        $this->add_control(
          'link',
              [
                 'label' => __( 'Button Link', 'easybook-add-ons' ),
                 'type' => Controls_Manager::URL,
                 'default'=>[
                                'url' => 'http://',
                                'is_external' => '',
                            ],
                 'show_external' => true, // Show the 'open in new tab' button.
              ]
        );
        $this->add_control(
            'btn_text',
            [
                'label' => __( 'Button Text', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Get in Touch  ',
                'label_block' => true,
                
            ]
        );
        $this->add_control(
            'show_separator',
            [
                'label' => __( 'Show Separator', 'easybook-add-ons' ),
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
        $link = $settings['link'];
        $target = $link['is_external'] ? 'target="_blank"' : '';
        ?>
        <div class="parallax-content">
            <div class="intro-item fl-wrap">
                <?php 
                    if($settings['title'] !='') echo '<h2>'.$settings['title'].'</h2>';
                    if($settings['show_separator'] == 'yes'){ echo '<span class="section-separator"></span>'; };
                    echo $settings['sub_title'];
                    if($settings['link']) echo '<a class="btn color-bg" href="'.$link['url'].'">'.$settings['btn_text'].'<i class="fa fa-envelope"></i></a>';
                ?>
            </div>
        </div>
        <?php

    }

    protected function _content_template() {
        ?>
        <div class="parallax-content">
            <div class="intro-item fl-wrap">
                <# if(settings.title){ #><h2>{{{settings.title}}}</h2><# } #>
                <# if(settings.show_separator == 'yes'){#> <span class="section-separator"></span><# } #>
                {{{settings.sub_title}}}
                <# // JavaScript code 
                var target = settings.link.is_external ? 'target="_blank"' : '';
                #>
                <# if(settings.link.url !=''){ #><a class="btn color-bg" href="{{ settings.link.url }}" {{ target }}>{{{settings.btn_text}}}</a><# } #>
            </div>
        </div>
        <?php
    }



}

   
   



// Plugin::instance()->widgets_manager->register_widget( 'Elementor\Widget_Header_Search' );

// Plugin::$instance->elements_manager->create_element_instance

