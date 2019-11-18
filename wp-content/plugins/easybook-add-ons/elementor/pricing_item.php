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

class CTH_Pricing_Item extends Widget_Base {

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
        return 'pricing_item';
    }

    // public function get_id() {
    //    	return 'header-search';
    // }

    public function get_title() {
        return __( 'Pricing Item', 'easybook-add-ons' );
    }

    public function get_icon() {
        // Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
        return 'eicon-counter';
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
            'title',
            [
                'label' => __( 'Title', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Extended',
                'label_block' => true,
                
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __( 'SubTitle', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Developer',
                'label_block' => true,
                
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => __( 'Price', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => '99',
                'label_block' => true,
                
            ]
        );

        $this->add_control(
            'currency',
            [
                'label' => __( 'Currency', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => '$',
                
            ]
        );

        $this->add_control(
            'period',
            [
                'label' => __( 'Currency', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Per month',
                
            ]
        );

        $this->add_control(
            'features',
            [
                'label' => __( 'Features', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXTAREA, //WYSIWYG,
                'default' => '<ul>
    <li>Ten Listings</li>
    <li>Lifetime Availability</li>
    <li>Featured In Search Results</li>
    <li>24/7 Support</li>
</ul>
<a href="#" class="price-link">Choose Extended</a>',
                
                'show_label' => false,
            ]
        );


        $this->add_control(
            'is_featured',
            [
                'label' => __( 'Featured Price', 'easybook-add-ons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __( 'Yes', 'easybook-add-ons' ),
                'label_off' => __( 'No', 'easybook-add-ons' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            're_icon',
            [
                'label' => __( 'Recommended Icon', 'easybook-add-ons' ),
                'type' => Controls_Manager::ICON,
                'default' => 'fa fa-check',
                'label_block' => true,
            ]
        );
        $this->add_control(
            're_text',
            [
                'label' => __( 'Recommended Text', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Recommended',
                'label_block' => true,
                
            ]
        );








        

        

        

        $this->end_controls_section();

        

    }

    protected function render( ) {
        $settings = $this->get_settings();



        ?>
        <div class="price-item<?php if($settings['is_featured'] == 'yes') echo ' best-price';?>">
            <div class="price-head op1">
                <?php if($settings['title'] !='') echo '<h3>'.$settings['title'].'</h3>'; ?>
                <?php if($settings['sub_title'] !='') echo '<h4>'.$settings['sub_title'].'</h4>'; ?>
            </div>
            <div class="price-content fl-wrap">
                <div class="price-num fl-wrap">
                    <?php 
                    if($settings['currency'] !='') echo '<span class="curen">'.$settings['currency'].'</span>'; 
                    if($settings['price'] !='') echo '<span class="price-num-item">'.$settings['price'].'</span>'; 
                    if($settings['period'] !='') echo '<div class="price-num-desc">'.$settings['period'].'</div>'; 
                    ?>
                </div>
                <div class="price-desc fl-wrap">
                    <?php 
                    if($settings['features'] !='') echo $settings['features'];
                    
                    if($settings['re_icon'] !='' || $settings['re_text'] != ''){ ?>
                        <div class="recomm-price">
                            <?php if($settings['re_icon'] !='') echo '<i class="'.$settings['re_icon'].'"></i>'; ?>
                            <?php if($settings['re_text'] !='') echo '<span class="recomm-text">'.$settings['re_text'].'</span>'; ?>
                        </div>
                    <?php
                    } 

                     ?>
                </div>
            </div>
        </div>
        <?php
    }

    protected function _content_template() {}

   
    

}



