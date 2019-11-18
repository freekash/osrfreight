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
    "name"                      => esc_html__("Hero Section Map", 'easybook-add-ons'),
    "description"               => esc_html__("Hero Section Map",'easybook-add-ons'),
    "base"                      => "hero_section_map_vc",
    "icon"                      => ESB_ABSPATH . "assets/cththemes-logo.png",
    "category"                  => __( 'EasyBook Theme', 'easybook-add-ons' ),
    "content_element"           => true,
    "show_settings_on_create"   => true,
    "params"                    => array(
        array(
            "type"        => "textarea",
            "heading"     => __("Content", 'easybook-add-ons'),
            "param_name"  => "content",
            "admin_label" => true,
            "value"       => '',
        ),
        array(
            "type" => "checkbox",
            "admin_label"   => true,
            "heading" => esc_html__("Show Search Form", 'easybook-add-ons'),
            "param_name" => "show_search",
            "value" => array( 
                esc_html__('Yes', 'easybook-add-ons') => 'yes',   
            ),
            "std"=>'yes', 
        ),
        array(
            "type" => "checkbox",
            "admin_label"   => true,
            "heading" => esc_html__("Hide Text Field", 'easybook-add-ons'),
            "param_name" => "hide_text_field",
            "value" => array( 
                esc_html__('Yes', 'easybook-add-ons') => 'yes',   
            ),
            "std"=>'yes', 
            'dependency' => array(
                'element' => 'show_search',
                'value'   => 'yes',
            ),
        ),
        array(
            "type" => "checkbox",
            "admin_label"   => true,
            "heading" => esc_html__("Use Added Locations", 'easybook-add-ons'),
            "param_name" => "use_pre_locs",
            "value" => array( 
                esc_html__('Yes', 'easybook-add-ons') => 'yes',   
            ),
            "std"=>'yes', 
            'dependency' => array(
                'element' => 'show_search',
                'value'   => 'yes',
            ),
        ),
        array(
            "type"        => "textarea",
            "heading"     => __("Content after Search", 'easybook-add-ons'),
            "param_name"  => "content_after",
            "admin_label" => true,
            "value"       => '',
        ),
        array(
            "type"        => "textfield",
            "heading"     => __("Categories List", 'easybook-add-ons'),
            "param_name"  => "cats",
            "admin_label" => true,
            "value"       => '',
        ),
        array(
            "type"        => "textfield",
            "heading"     => __("Scroll button URL", 'easybook-add-ons'),
            "param_name"  => "scroll_url",
            "admin_label" => true,
            "value"       => '',
        ),
        array(
            "type"        => "textfield",
            "heading"     => __("Categories to get listings", 'easybook-add-ons'),
            "param_name"  => "cat_ids",
            "admin_label" => true,
            "value"       => '',
        ),
        array(
            "type"        => "textfield",
            "heading"     => __("Enter Post IDs", 'easybook-add-ons'),
            "param_name"  => "ids",
            "admin_label" => true,
            "value"       => '',
            'description' => __("Enter Post ids to show, separated by a comma. Leave empty to show all.", 'easybook-add-ons'),
        ),
        array(
            "type"        => "textfield",
            "heading"     => __("Or Post IDs to Exclude", 'easybook-add-ons'),
            "param_name"  => "ids_not",
            "admin_label" => true,
            "value"       => '',
            'description' => __("Enter post ids to exclude, separated by a comma (,). Use if the field above is empty.", 'easybook-add-ons'),
        ),
        array(
            "type"        => "textfield",
            "heading"     => __("Posts to show", 'easybook-add-ons'),
            "param_name"  => "posts_per_page",
            "admin_label" => true,
            "value"       => '6',
            'description' => esc_html__("Number of posts to show (-1 for all).", 'easybook-add-ons'),
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
    class WPBakeryShortCode_Hero_Section_Map_Vc extends WPBakeryShortCode {}
}