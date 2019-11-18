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
    "name"                      => esc_html__("Section Title", 'easybook-add-ons'),
    "description"               => esc_html__("Section Title",'easybook-add-ons'),
    "base"                      => "section_title_vc",
    "icon"                      => ESB_ABSPATH . "assets/cththemes-logo.png",
    "category"                  => __( 'EasyBook Theme', 'easybook-add-ons' ),
    "content_element"           => true,
    "show_settings_on_create"   => true,
    "params"                    => array(
        array(
            "type"        => "dropdown",
            "heading"     => __("Loacation", 'easybook-add-ons'),
            "param_name"  => "loca_sec",
            "admin_label" => true,
            "value"       => array(
                                esc_html__( 'Left', 'easybook-add-ons' ) => 'left',
                                esc_html__( 'Center', 'easybook-add-ons' ) => 'center',
                                esc_html__( 'Right', 'easybook-add-ons' ) => 'right',
                            ),
            "std"         => "center",
            "separator" => "before",
        ),
        array(
            "type"        => "dropdown",
            "heading"     => __("Heading Color", 'easybook-add-ons'),
            "param_name"  => "h_color",
            "admin_label" => true,
            "value"       => array(
                                esc_html__( 'Theme', 'easybook-add-ons' ) => 'theme',
                                esc_html__( 'White', 'easybook-add-ons' ) => 'white',
                                esc_html__( 'Dark Blue', 'easybook-add-ons' ) => 'dk-blue',
                            ),
            "std"         => "dk-blue",
            "separator" => "before",
        ),
        array(
            "type"          => "textfield",
            // "holder"        => "div",
            "admin_label"   => true,
            "heading"       => esc_html__("Title", 'easybook-add-ons'),
            "param_name"    => "title",
            "value"         => "Popular Destination",
        ),
        array(
            "type" => "checkbox",
            "admin_label"   => true,
            "heading" => esc_html__("Show Stars", 'easybook-add-ons'),
            "param_name" => "show_starts",
            "value" => array( 
                esc_html__('Yes', 'easybook-add-ons') => 'yes',   
            ),
            "std"=>'yes', 
        ),
        array(
            "type" => "checkbox",
            "admin_label"   => true,
            "heading" => esc_html__("Show Separator", 'easybook-add-ons'),
            "param_name" => "show_separator",
            "value" => array( 
                esc_html__('Yes', 'easybook-add-ons') => 'yes',   
            ),
            "std"=>'yes',
        ),
        array(
            "type"        => "dropdown",
            "heading"     => __("Separator Color", 'easybook-add-ons'),
            "param_name"  => "separator_color",
            "admin_label" => true,
            "value"       => array(
                                esc_html__( 'Theme', 'easybook-add-ons' ) => 'theme',
                                esc_html__( 'Yellow', 'easybook-add-ons' ) => 'yellow',
                                esc_html__( 'Dark Blue', 'easybook-add-ons' ) => 'dk-blue',
                            ),
            "std"         => "dk-blue",
            "separator" => "before",
            'dependency'  => array(
                'element' => 'show_separator',
                'value'   => 'yes',
            ),
        ),
        array(
            "type"          => "textarea_html",
            // "holder"      => "div",
            "admin_label" => true,
            "heading"       => esc_html__("Sub-Title", 'easybook-add-ons'),
            "param_name"    => "content",
            'value'         => 'Explore some of the best tips from around the city from our partners and friends.',
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
    class WPBakeryShortCode_Section_Title_Vc extends WPBakeryShortCode {}
}