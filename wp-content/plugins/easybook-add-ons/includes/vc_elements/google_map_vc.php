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


vc_map( array(
    "name"                      => esc_html__("Google Map", 'easybook-add-ons'),
    "description"               => esc_html__("Google Map",'easybook-add-ons'),
    "base"                      => "google_map_vc",
    "icon"                      => ESB_ABSPATH . "assets/cththemes-logo.png",
    "category"                  => __( 'EasyBook Theme', 'easybook-add-ons' ),
    "content_element"           => true,
    "show_settings_on_create"   => true,
    "params"                    => array(
        array(
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Address Latitude", 'easybook-add-ons'),
            "param_name"    => "map_lat",
            "value"         => "40.7143528",
            "description" => __('Enter your address latitude. You can get value from: ', 'easybook-add-ons').'<a href="'.esc_url('http://www.gps-coordinates.net/').'" target="_blank">'.esc_url('http://www.gps-coordinates.net/').'</a>',
        ),
        array(
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Address Longtitude", 'easybook-add-ons'),
            "param_name"    => "map_lng",
            "value"         => "-74.0059731",
            "description" => __('Enter your address longtitude. You can get value from: ', 'easybook-add-ons').'<a href="'.esc_url('http://www.gps-coordinates.net/').'" target="_blank">'.esc_url('http://www.gps-coordinates.net/').'</a>',
        ),
        array(
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Address String", 'easybook-add-ons'),
            "param_name"    => "map_address",
            "value"         => "Our office - New York City",
        ),
        array(
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Zoom Level", 'easybook-add-ons'),
            "param_name"    => "zoom",
            "value"         => "14",
            "description"   => esc_html__("Min = 1 and Max = 20.", 'easybook-add-ons'),
        ),
        array(
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Height", 'easybook-add-ons'),
            "param_name"    => "height",
            "value"         => "300",
            "description"   => esc_html__("Min = 40 and Max = 1440.", 'easybook-add-ons'),
        ),

        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
            "param_name"    => "el_class",
            "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons'),
            "value"         => "",
        ),

        array(
            'type'          => 'css_editor',
            'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
            'param_name'    => 'css',
            'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
        ),
    ),
));
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Google_Map_Vc extends WPBakeryShortCode {}
}