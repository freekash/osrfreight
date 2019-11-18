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
    "name"                      => esc_html__("Parallax Content", 'easybook-add-ons'),
    "description"               => esc_html__("Parallax Content",'easybook-add-ons'),
    "base"                      => "parallax_content_vc",
    "icon"                      => ESB_ABSPATH . "assets/cththemes-logo.png",
    "category"                  => __( 'EasyBook Theme', 'easybook-add-ons' ),
    "content_element"           => true,
    "show_settings_on_create"   => true,
    "params"                    => array(
        array(
            "type"        => "dropdown",
            "heading"     => __("Location", 'easybook-add-ons'),
            "param_name"  => "local",
            "admin_label" => true,
            "value"       => array(
                                esc_html__('Left', 'easybook-add-ons') => 'left',
                                esc_html__('Center', 'easybook-add-ons') => 'center',
                                esc_html__('Right', 'easybook-add-ons') => 'right',
            ),
            'std'         => 'center',
        ),
        array(
            "type"        => "textfield",
            "heading"     => __("Title", 'easybook-add-ons'),
            "param_name"  => "title",
            "admin_label" => true,
            "value"       => 'Need more information',
        ),
        array(
            "type"        => "textarea_html",
            "heading"     => __("Content", 'easybook-add-ons'),
            "param_name"  => "content",
            "admin_label" => true,
            "value"       => __("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.", 'easybook-add-ons'),
        ),
        array(
            "type" => "checkbox",
            "admin_label"   => true,
            "heading" => esc_html__("Show Separator", 'easybook-add-ons'),
            "param_name" => "show_separator",
            "value" => array( 
                esc_html__('Yes', 'easybook-add-ons') => 'yes',   
            ),
            "std"=>'no',
        ),
        array(
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Button Text", 'easybook-add-ons'),
            "param_name"    => "btn_text",
            "value"         => "Get in Touch  ",
        ),
        array(
            "type"        => "vc_link",
            "admin_label" => true,
            "heading"     => __("Button Links", 'easybook-add-ons'),
            "param_name"  => "links",
            "admin_label" => true,
            "value"       => "#",
            "description"   => esc_html__( 'Enter links for each partner (Note: divide links with linebreaks (Enter) or | and no spaces)', 'easybook-add-ons' ). get_post_type_archive_link( 'listing' ),
            'dependency' => array(
                'element' => 'btn_text',
                'not_empty' => true,
            ),
        ),
        array(
            "type" => "checkbox",
            "admin_label"   => true,
            "heading" => esc_html__("Is External Links", 'easybook-add-ons'),
            "param_name" => "is_external",
            "value" => array( 
                esc_html__('Yes', 'easybook-add-ons') => 'yes',   
            ),
            "std"=>'yes',
            'dependency' => array(
                'element' => 'btn_text',
                'not_empty' => true,
            ),
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
    class WPBakeryShortCode_Parallax_Content_Vc extends WPBakeryShortCode {}
}