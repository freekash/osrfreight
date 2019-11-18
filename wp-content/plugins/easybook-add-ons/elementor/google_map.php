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

class CTH_Google_Map extends Widget_Base {

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
        return 'google_map';
    }

    // public function get_id() {
    //    	return 'header-search';
    // }

    public function get_title() {
        return __( 'Google Map', 'easybook-add-ons' );
    }

    public function get_icon() {
        // Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
        return 'eicon-google-maps';
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
                'label' => __( 'Map Position', 'easybook-add-ons' ),
            ]
        );

        
        $this->add_control(
            'map_lat',
            [
                'label' => __( 'Address Latitude', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => '40.7143528',
                'description' => __('Enter your address latitude. You can get value from: ', 'easybook-add-ons').'<a href="'.esc_url('http://www.gps-coordinates.net/').'" target="_blank">'.esc_url('http://www.gps-coordinates.net/').'</a>',
                'label_block' => true,
                
            ]
        );

        $this->add_control(
            'map_lng',
            [
                'label' => __( 'Address Longtitude', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => '-74.0059731',
                'description' => __('Enter your address longtitude. You can get value from: ', 'easybook-add-ons').'<a href="'.esc_url('http://www.gps-coordinates.net/').'" target="_blank">'.esc_url('http://www.gps-coordinates.net/').'</a>',
                'label_block' => true,
                
            ]
        );

    
        $this->add_control(
            'map_address',
            [
                'label' => __( 'Address String', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Our office - New York City',
                'label_block' => true,
                
            ]
        );

        $this->add_control(
            'zoom',
            [
                'label' => __( 'Zoom Level', 'easybook-add-ons' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 14,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 20,
                    ],
                ],
            ]
        );


        $this->add_control(
            'height',
            [
                'label' => __( 'Height', 'easybook-add-ons' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 300,
                ],
                'range' => [
                    'px' => [
                        'min' => 40,
                        'max' => 1440,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .singleMap' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        


        
        //         array(
        //             "type"      => "attach_image",
        //             "class"     => "",
        //             "heading"   => esc_html__("Map Marker", 'easybook-add-ons'),
        //             "param_name"=> "map_marker",
        //             "value"     => "",
        //             "description" => esc_html__("Upload google map marker or leave it empty to use default.", 'easybook-add-ons')
        //         ),
        //         array(
        //             "type" => "textfield",
        //             "class"=>"",
        //             // "holder"=>'div',
        //             "heading" => esc_html__('Map Height', 'easybook-add-ons'),
        //             "param_name" => "map_height",
        //             "value" => "500",
        //             "description" => esc_html__("Enter your map height in pixel. Default: 500", 'easybook-add-ons'), 
                    
        //         ),
        //         array(
        //             "type" => "dropdown",
        //             "class"=>"",
        //             "heading" => esc_html__('Use Default Style', 'easybook-add-ons'),
        //             "param_name" => "default_style",
        //             "value" => array(   
        //                             esc_html__('No', 'easybook-add-ons') => 'false',  
        //                             esc_html__('Yes', 'easybook-add-ons') => 'true',                                                                                
        //                         ),
        //             "description" => esc_html__("Set this to Yes to use default Google map style.", 'easybook-add-ons'), 
        //             'std'=>'false'
        //         ),
        //         array(
        //             "type" => "dropdown",
                    
        //             "heading" => esc_html__('Show Zoom Control', 'easybook-add-ons'),
        //             "param_name" => "zoom_control",
        //             "value" => array(   
        //                             esc_html__('Yes', 'easybook-add-ons') => '1',  
        //                             esc_html__('No', 'easybook-add-ons') => '0',                                                                                
        //                         ),
                    
        //             'std'=>'1'
        //         ),
        //         array(
        //             "type" => "dropdown",
                    
        //             "heading" => esc_html__('Show MapType Control', 'easybook-add-ons'),
        //             "param_name" => "maptype_control",
        //             "value" => array(   
        //                             esc_html__('Yes', 'easybook-add-ons') => '1',  
        //                             esc_html__('No', 'easybook-add-ons') => '0',                                                                                
        //                         ),
                    
        //             'std'=>'1'
        //         ),
        //         array(
        //             "type" => "dropdown",
                    
        //             "heading" => esc_html__('Show Scale Control', 'easybook-add-ons'),
        //             "param_name" => "scale_control",
        //             "value" => array(   
        //                             esc_html__('Yes', 'easybook-add-ons') => '1',  
        //                             esc_html__('No', 'easybook-add-ons') => '0',                                                                                
        //                         ),
                    
        //             'std'=>'1'
        //         ),
        //         array(
        //             "type" => "dropdown",
                    
        //             "heading" => esc_html__('Scroll Wheel Control', 'easybook-add-ons'),
        //             "param_name" => "scroll_wheel",
        //             "value" => array(   
        //                             esc_html__('Yes', 'easybook-add-ons') => '1',  
        //                             esc_html__('No', 'easybook-add-ons') => '0',                                                                                
        //                         ),
                    
        //             'std'=>'0'
        //         ),
        //         array(
        //             "type" => "dropdown",
                    
        //             "heading" => esc_html__('EasyBook View Control', 'easybook-add-ons'),
        //             "param_name" => "easybook_view",
        //             "value" => array(   
        //                             esc_html__('Yes', 'easybook-add-ons') => '1',  
        //                             esc_html__('No', 'easybook-add-ons') => '0',                                                                                
        //                         ),
                    
        //             'std'=>'1'
        //         ),
        //         array(
        //             "type" => "dropdown",
                    
        //             "heading" => esc_html__('Draggable Control', 'easybook-add-ons'),
        //             "param_name" => "draggable",
        //             "value" => array(   
        //                             esc_html__('Yes', 'easybook-add-ons') => '1',  
        //                             esc_html__('No', 'easybook-add-ons') => '0',                                                                                
        //                         ),
                    
        //             'std'=>'1'
        //         ),

        

        

        $this->end_controls_section();

        

    }

    protected function render( ) {
        $settings = $this->get_settings();
        // $dataArr = array();
        // $dataArr['zoom'] = (int)$settings['zoom'];

        // $dataArr['zoomControl'] = (bool)$zoom_control;
        // $dataArr['mapTypeControl'] = (bool)$maptype_control;
        // $dataArr['scaleControl'] = (bool)$scale_control;
        // $dataArr['scrollwheel'] = (bool)$scroll_wheel;
        // $dataArr['easybookViewControl'] = (bool)$easybook_view;
        // $dataArr['draggable'] = (bool)$draggable;
        ?>
        <div class="map-container">
            <?php if(easybook_addons_get_option('use_osm_map') == 'yes'): ?>
                <div id="<?php echo uniqid('singleMapOSM'); ?>" class="singleMapOSM" data-lat="<?php echo $settings['map_lat'];?>" data-lng="<?php echo $settings['map_lng'];?>" data-loc="<?php echo $settings['map_address'];?>" data-zoom="<?php echo $settings['zoom']['size'];?>"></div>
            <?php else: ?>
                <div class="singleMap" data-lat="<?php echo $settings['map_lat'];?>" data-lng="<?php echo $settings['map_lng'];?>" data-loc="<?php echo $settings['map_address'];?>" data-zoom="<?php echo $settings['zoom']['size'];?>"></div>
            <?php endif; ?>
        </div>
        <?php
    }

    protected function _content_template() {}

   
    

}

