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

class CTH_Button extends Widget_Base {

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
        return 'cthbutton';
    }

    // public function get_id() {
    //    	return 'header-search';
    // }

    public function get_title() {
        return __( 'Button', 'easybook-add-ons' );
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
            'section_images',
            [
                'label' => __( 'Content', 'easybook-add-ons' ),
            ]
        );
        $this->add_control(
            'name_bt',
            [
                'label'         => __( 'Name Button', 'easybook-add-ons' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => 'Our Vimeo Chanel',
                'label_block'   => true,
                
            ]
        );
        $this->add_control(
            'links',
            [
                'label' => __( 'Button Links', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXTAREA, // WYSIWYG,
                'default' => 'https://jquery.com/',
                'description' => __( 'Enter links for each partner (Note: divide links with linebreaks (Enter) or | and no spaces).', 'easybook-add-ons' ) 
            ]
        );
        $this->add_control(
            'icon',
            [
                'label'         => __( 'Icon', 'easybook-add-ons' ),
                'type'          => Controls_Manager::ICON,
                'default'       => 'fa fa-medkit'
                
            ]
        );
        $this->add_control(
            'class_css',
            [
                'label' => __( 'Extra class name', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'description' => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons'),
            ]
        );
        $this->end_controls_section();
    }

    protected function render( ) {
        $settings = $this->get_settings();
        $css_classes = array(
            'btn color-bg float-btn ',
            $settings['class_css'],
        );

        $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
         ?> 
            <a href="<?php echo $settings['links']; ?>" class="<?php echo esc_attr($css_class );?>"><?php echo $settings['name_bt']; ?><i class="<?php echo $settings['icon'];?>"></i></a>
        <?php

    }

    protected function _content_template() {}

   
    

}
