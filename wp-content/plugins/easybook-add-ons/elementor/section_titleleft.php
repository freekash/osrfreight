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

class CTH_Section_Titleleft extends Widget_Base {

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
        return 'section_titleleft';
    }

    // public function get_id() {
    //    	return 'header-search';
    // }

    public function get_title() {
        return __( 'Section Title Left', 'easybook-add-ons' );
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
                'default' => 'Our Awesome <span>Story</span>',
                'label_block' => true,
                
            ]
        );
        $this->add_control(
            'content',
            [
                'label' => __( 'Sub Title', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '<h4>Check video presentation to find   out more about us .</h4>',
                'label_block' => true,
                
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

        


        $this->end_controls_section();

    }

    protected function render( ) {

        $settings = $this->get_settings();
        ?>
        <div class="section-title-left fl-wrap">
            <?php 
                if(!empty($settings['title'])) echo '<h3>'.$settings['title'].'</h3>';
                echo $settings['content'];
                if($settings['show_sep'] == 'yes') echo '<span class="fw-separator"></span>';
            ?>
        </div>
        <?php
    }

    protected function _content_template() {
        ?>
        <div class="section-title-left fl-wrap">
            <# if(settings.title){ #><h3>{{{settings.title}}}</h3><# } #>
            {{{settings.content}}}
            <# if(settings.show_sep=='yes'){ #><span class="section-separator fl-sec-sep"></span><# } #>
        </div>
        <?php
    }

   
   

}
