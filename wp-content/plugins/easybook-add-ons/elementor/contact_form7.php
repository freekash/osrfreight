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

class CTH_Contact_Form7 extends Widget_Base {

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
        return 'contact_form7';
    }

    // public function get_id() {
    //    	return 'header-search';
    // }

    public function get_title() {
        return __( 'Contact Form 7', 'easybook-add-ons' );
    }

    public function get_icon() {
        // Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
        return 'fa fa-paper-plane-o';
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
            'f_id',
            [
                'label'       => __( 'Select a form', 'easybook-add-ons' ),
                'type' => Controls_Manager::SELECT,
                'default' => '100',
                'options' => easybook_addons_get_contact_form7_forms(),
                
            ]
        );

        $this->add_control(
            'f_title',
            [
                'label'       => __( 'Form Title', 'easybook-add-ons' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'description' => __( '(Optional) Title to search if no ID selected or cannot find by ID.', 'easybook-add-ons' ),
                'label_block' => true
            ]
        );
        

        $this->end_controls_section();

        

    }

    protected function render( ) {
        $settings = $this->get_settings();
        $attrs = '';
        if($settings['f_id']) $attrs .= ' id="'.$settings['f_id'].'"';
        elseif($settings['f_title']) $attrs .= ' title="'.$settings['f_title'].'"';

        $shortcode = do_shortcode( '[contact-form-7'.$attrs.']' ) ;
        ?>
        <div class="contact-form7"><?php echo $shortcode;?></div>
        <?php
    }

    // protected function _content_template() {}

   
    

}

