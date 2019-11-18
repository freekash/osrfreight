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
    "name"                      => esc_html__("Hero Slider", 'easybook-add-ons'),
    "description"               => esc_html__("Hero Slider",'easybook-add-ons'),
    "base"                      => "hero_slider_vc",
    "icon"                      => ESB_ABSPATH . "assets/cththemes-logo.png",
    "category"                  => __( 'EasyBook Theme', 'easybook-add-ons' ),
    "as_parent"                 => array('only' => 'hero_slider_item_vc'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element"           => true,
    "show_settings_on_create"   => true,
    "params"                    => array(
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

    "js_view"               => 'VcColumnView',
));
vc_map( array(
    "name"                      => esc_html__("Hero Slider Item", 'easybook-add-ons'),
    "description"               => esc_html__("Hero Slider Item",'easybook-add-ons'),
    "base"                      => "hero_slider_item_vc",
    "icon"                      => ESB_ABSPATH . "assets/cththemes-logo.png",
    // "category"                  => __( 'EasyBook Theme', 'easybook-add-ons' ),
    "as_child"                  => array('only' => 'hero_slider_vc'),
    "content_element"           => true,
    "show_settings_on_create"   => true,
    "params"                    => array(
        array(
            "type"          => "attach_image",
            "holder"        => "div",
            "class"         => "cth-vc-images",
            "heading"       => esc_html__("Image", 'easybook-add-ons'),
            "param_name"    => "image",
            // "description"   => "Only choose one image",
        ),
        array(
            "type"        => "dropdown",
            "heading"     => __("Content Location", 'easybook-add-ons'),
            "param_name"  => "cont_local",
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
            "type"          => "textfield",
            // "holder"        => "div",
            "admin_label"   => true,
            "heading"       => esc_html__("Title (for editing only)", 'easybook-add-ons'),
            "param_name"    => "title",
            "value"         => "Slide Title",
        ),
        array(
            "type"          => "textfield",
            // "holder"        => "div",
            "admin_label"   => true,
            "heading"       => esc_html__("Sub title", 'easybook-add-ons'),
            "param_name"    => "sub_title",
            "value"         => "<h3>Let's start exploring the world together with EasyBook</h3>",
            // "description"   => esc_html__( 'Top position (%) related to element (top-left corner) ', 'easybook-add-ons' ),
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
            "heading" => esc_html__("Show Button", 'easybook-add-ons'),
            "param_name" => "show_btn",
            "value" => array( 
                esc_html__('Yes', 'easybook-add-ons') => 'yes',   
            ),
            "std"=>'no', 
        ),
        array(
            "type"        => "dropdown",
            "heading"     => __("Button color", 'easybook-add-ons'),
            "param_name"  => "btn_color",
            "admin_label" => true,
            "value"       => array(
                            esc_html__( 'Summer Sky', 'easybook-add-ons' ) => '',
                            esc_html__( 'Selective Yellow', 'easybook-add-ons' ) => '2',
                            esc_html__( 'Egyptian Blue', 'easybook-add-ons' ) => '3',
                        ),
            "std"         => "",
            "separator" => "before",
            "dependency"  => array(
                'element' => 'show_btn',
                'value'   => 'yes',
            ),
        ),
        array(
            "type"          => "textfield",
            // "holder"        => "div",
            "admin_label"   => true,
            "heading"       => esc_html__("Name Button", 'easybook-add-ons'),
            "param_name"    => "name_btn",
            "value"         => "View all hotels",
            "dependency"  => array(
                'element' => 'show_btn',
                'value'   => 'yes',
            ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'easybook-add-ons' ),
            'param_name' => 'icon',
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'fontawesome',
                'iconsPerPage' => 200, // default 100, how many icons per/page to display
            ),
            "description"   => "Choose icon",
            "std"         => "fa fa-caret-right",
            "dependency"  => array(
                'element' => 'show_btn',
                'value'   => 'yes',
            ),
        ),
        array(
            "type"        => "vc_link",
            "admin_label" => true,
            "heading"     => __("Button Links", 'easybook-add-ons'),
            "param_name"  => "links",
            "admin_label" => true,
            "value"       => "#",
            "description"   => esc_html__( 'Enter links for each partner (Note: divide links with linebreaks (Enter) or | and no spaces)', 'easybook-add-ons' ). get_post_type_archive_link( 'listing' ),
            "dependency"  => array(
                'element' => 'show_btn',
                'value'   => 'yes',
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
            "dependency"  => array(
                'element' => 'show_btn',
                'value'   => 'yes',
            ),
        ),
        array(
            "type"          => "textfield",
            // "holder"        => "div",
            "admin_label"   => true,
            "heading"       => esc_html__("Enter Post ID", 'easybook-add-ons'),
            "param_name"    => "id",
            "value"         => "",
            "description"   => esc_html__( 'Enter Post ids to show, separated by a comma. Leave empty to show all.', 'easybook-add-ons' ),
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
    'js_view'               =>'InshotImagesView',
    'admin_enqueue_js'      => ESB_ABSPATH . "assets/js/wpbakerry-eles.js", // need "holder"    => "div" and "class"     => "cth-vc-images" option for attach_image, attach_images type
    'js_view' => 'CTHVCImages',
));
//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Hero_Slider_Vc extends WPBakeryShortCodesContainer {}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Hero_Slider_Item_Vc extends WPBakeryShortCode {}
}

