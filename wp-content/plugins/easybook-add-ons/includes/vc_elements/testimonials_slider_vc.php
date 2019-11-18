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
    "name"                      => esc_html__("Testimonials Slider", 'easybook-add-ons'),
    "description"               => esc_html__("Testimonials Slider",'easybook-add-ons'),
    "base"                      => "testimonials_slider_vc",
    "icon"                      => ESB_ABSPATH . "assets/cththemes-logo.png",
    "category"                  => __( 'EasyBook Theme', 'easybook-add-ons' ),
    "as_parent"                 => array('only' => 'testimonials_slider_item_vc'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
    "name"                      => esc_html__("Item", 'easybook-add-ons'),
    "description"               => esc_html__("Item",'easybook-add-ons'),
    "base"                      => "testimonials_slider_item_vc",
    "icon"                      => ESB_ABSPATH . "assets/cththemes-logo.png",
    // "category"                  => __( 'EasyBook Theme', 'easybook-add-ons' ),
    "as_child"                  => array('only' => 'testimonials_slider_vc'),
    "content_element"           => true,
    "show_settings_on_create"   => true,
    "params"                    => array(
        array(
            "type"          => "textfield",
            // "holder"        => "div",
            "admin_label"   => true,
            "heading"       => esc_html__("Name", 'easybook-add-ons'),
            "param_name"    => "name",
            "value"         => "Lisa Noory",
        ),
        array(
            "type"          => "textfield",
            // "holder"        => "div",
            "admin_label"   => true,
            "heading"       => esc_html__("Job", 'easybook-add-ons'),
            "param_name"    => "job",
            "value"         => "Restaurant Owner",
        ),
        array(
            "type"          => "textarea",
            // "holder"        => "div",
            "admin_label"   => true,
            "heading"       => esc_html__("Comment", 'easybook-add-ons'),
            "param_name"    => "comment",
            "value"         => "Qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram seacula quarta decima et quinta decima.",
        ),
        array(
            "type"          => "attach_image",
            "holder"        => "div",
            "class"         => "cth-vc-images",
            "heading"       => esc_html__("Avatar Image", 'easybook-add-ons'),
            "param_name"    => "avatar",
            // "description"   => "Only choose one image",
        ),
        array(
            "type"        => "dropdown",
            "heading"     => __("Rating", 'easybook-add-ons'),
            "param_name"  => "rating",
            "admin_label" => true,
            "value"       => array(
                            esc_html__( '1 Star', 'easybook-add-ons' )  => '1',
                            esc_html__( '2 Stars', 'easybook-add-ons' ) => '2',
                            esc_html__( '3 Stars', 'easybook-add-ons' ) => '3',
                            esc_html__( '4 Stars', 'easybook-add-ons' ) => '4',
                            esc_html__( '5 Stars', 'easybook-add-ons' ) => '5',
                        ),
            "std"         => "5",
        ),
        array(
            "type"          => "textfield",
            // "holder"        => "div",
            "admin_label"   => true,
            "heading"       => esc_html__("Name Facebook", 'easybook-add-ons'),
            "param_name"    => "name_face",
            "value"         => "Via Facebook",
            // "description"   => esc_html__( 'Left position (%) related to element (top-left corner) ', 'easybook-add-ons' ),
        ),
        array(
            "type"        => "vc_link",
            "admin_label" => true,
            "heading"     => __("Link", 'easybook-add-ons'),
            "param_name"  => "link",
            "admin_label" => true,
            "value"       => "#",
            'dependency' => array(
                'element' => 'name_face',
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
                'element' => 'name_face',
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
    'js_view'               =>'InshotImagesView',
    'admin_enqueue_js'      => ESB_ABSPATH . "assets/js/wpbakerry-eles.js", // need "holder"    => "div" and "class"     => "cth-vc-images" option for attach_image, attach_images type
    'js_view' => 'CTHVCImages',
));
//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Testimonials_Slider_Vc extends WPBakeryShortCodesContainer {}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Testimonials_Slider_Item_Vc extends WPBakeryShortCode {}
}

