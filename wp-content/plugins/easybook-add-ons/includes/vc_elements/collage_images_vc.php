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
    "name"                      => esc_html__("Collage Images", 'easybook-add-ons'),
    "description"               => esc_html__("Collage Images",'easybook-add-ons'),
    "base"                      => "collage_images_vc",
    "icon"                      => ESB_ABSPATH . "assets/cththemes-logo.png",
    "category"                  => __( 'EasyBook Theme', 'easybook-add-ons' ),
    "as_parent"                 => array('only' => 'collage_images_item_vc'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element"           => true,
    "show_settings_on_create"   => true,
    "params"                    => array(
        array(
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Title", 'easybook-add-ons'),
            "param_name"    => "title",
            "value"         => "Easy<span>Book</span>",
        ),
        // // params group
        // array(
        //     'type' => 'param_group',
        //     "heading"       => esc_html__("Images", 'easybook-add-ons'),
        //     // "admin_label"   => true,
        //     'param_name' => 'images',
        //     'value' => '',
        //     // Note params is mapped inside param-group:
        //     'params' => array(
        //         array(
        //             "type" => "checkbox",
        //             "admin_label"   => true,
        //             "heading" => esc_html__("Background", 'easybook-add-ons'),
        //             "param_name" => "bgimage",
        //             "value" => array( 
        //                 esc_html__('Yes', 'easybook-add-ons') => 'yes',   
        //             ),
        //             "std"=>'',
        //             "description"   => "Choose in the first place.",
        //         ),
        //         array(
        //             "type"          => "textfield",
        //             // "holder"        => "div",
        //             "admin_label"   => true,
        //             "heading"       => esc_html__("Image Title", 'easybook-add-ons'),
        //             "param_name"    => "title",
        //             "value"         => "For editing only",
        //         ),
        //         array(
        //             "type"          => "attach_image",
        //             "holder"        => "div",
        //             "class"         => "cth-vc-images",
        //             "heading"       => esc_html__("Image", 'easybook-add-ons'),
        //             "param_name"    => "image",
        //             // "description"   => "Only choose one image",
        //         ),
        //         array(
        //             "type"          => "textfield",
        //             // "holder"        => "div",
        //             "admin_label"   => true,
        //             "heading"       => esc_html__("Left Position", 'easybook-add-ons'),
        //             "param_name"    => "left_pos",
        //             "value"         => "23",
        //             "description"   => esc_html__( 'Left position (%) related to element (top-left corner) ', 'easybook-add-ons' ),
        //         ),
        //         array(
        //             "type"          => "textfield",
        //             // "holder"        => "div",
        //             "admin_label"   => true,
        //             "heading"       => esc_html__("Top Position", 'easybook-add-ons'),
        //             "param_name"    => "top_pos",
        //             "value"         => "10",
        //             "description"   => esc_html__( 'Top position (%) related to element (top-left corner) ', 'easybook-add-ons' ),
        //         ),
        //         array(
        //             "type"          => "textfield",
        //             // "holder"        => "div",
        //             "admin_label"   => true,
        //             "heading"       => esc_html__("Zindex", 'easybook-add-ons'),
        //             "param_name"    => "zindex",
        //             "value"         => "10",
        //             "description"   => esc_html__( 'Use to control image displaying in Z axis.', 'easybook-add-ons' ),
        //         ),
        //         array(
        //             "type" => "checkbox",
        //             "admin_label"   => true,
        //             "heading" => esc_html__("Animation Image?", 'easybook-add-ons'),
        //             "param_name" => "use_animation",
        //             "value" => array( 
        //                 esc_html__('Yes', 'easybook-add-ons') => 'yes',   
        //             ),
        //             "std"=>'', 
        //         ),
        //         array(
        //             "type"          => "textfield",
        //             // "holder"        => "div",
        //             "admin_label"   => true,
        //             "heading"       => esc_html__("Animation Duration Order", 'easybook-add-ons'),
        //             "param_name"    => "order",
        //             "value"         => "1",
        //             "description"   => esc_html__( 'Choose from 1 to 5: 1-0s, 2-2.5s, 3-3.5s, 4-4.5s, 5-5.5s', 'easybook-add-ons' ),
        //             'dependency'  => array(
        //                 'element' => 'use_animation',
        //                 'value'   => 'yes',
        //             ),
        //         ),
        //         array(
        //             "type" => "checkbox",
        //             "admin_label"   => true,
        //             "heading" => esc_html__("Display content?", 'easybook-add-ons'),
        //             "param_name" => "use_content",
        //             "value" => array( 
        //                 esc_html__('Yes', 'easybook-add-ons') => 'yes',   
        //             ),
        //             "std"=>'', 
        //         ),
        //         array(
        //             "type"          => "textfield",
        //             // "holder"        => "div",
        //             "admin_label"   => true,
        //             "heading"       => esc_html__("Content", 'easybook-add-ons'),
        //             "param_name"    => "text_content",
        //             "value"         => "Booking now",
        //             "description"   => esc_html__( 'For editing only', 'easybook-add-ons' ),
        //             'dependency'  => array(
        //                 'element' => 'use_content',
        //                 'value'   => 'yes',
        //             ),
        //         ),
        //         array(
        //             "type" => "checkbox",
        //             "admin_label"   => true,
        //             "heading" => esc_html__("Display Icon?", 'easybook-add-ons'),
        //             "param_name" => "show_icon",
        //             "value" => array( 
        //                 esc_html__('Yes', 'easybook-add-ons') => 'yes',   
        //             ),
        //             "std"=>'', 
        //         ),
        //         array(
        //             'type' => 'iconpicker',
        //             'heading' => esc_html__( 'Icon', 'easybook-add-ons' ),
        //             'param_name' => 'icon',
        //             'settings' => array(
        //                 'emptyIcon' => false, // default true, display an "EMPTY" icon?
        //                 'type' => 'fontawesome',
        //                 'iconsPerPage' => 200, // default 100, how many icons per/page to display
        //             ),
        //             "description"   => "Choose icon",
        //             "std"         => "",
        //             'dependency'  => array(
        //                 'element' => 'show_icon',
        //                 'value'   => 'yes',
        //             ),
        //         ),
        //     ),
        // ),
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
    "name"                      => esc_html__("Images", 'easybook-add-ons'),
    "description"               => esc_html__("Images",'easybook-add-ons'),
    "base"                      => "collage_images_item_vc",
    "icon"                      => ESB_ABSPATH . "assets/cththemes-logo.png",
    // "category"                  => __( 'EasyBook Theme', 'easybook-add-ons' ),
    "as_child"                  => array('only' => 'collage_images_vc'),
    "content_element"           => true,
    "show_settings_on_create"   => true,
    "params"                    => array(
        array(
            "type" => "checkbox",
            "admin_label"   => true,
            "heading" => esc_html__("Background", 'easybook-add-ons'),
            "param_name" => "bgimage",
            "value" => array( 
                esc_html__('Yes', 'easybook-add-ons') => 'yes',   
            ),
            "std"=>'',
            "description"   => "Choose in the first place.",
        ),
        array(
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Image Title", 'easybook-add-ons'),
            "param_name"    => "title",
            "value"         => "For editing only",
        ),
        array(
            "type"          => "attach_image",
            "holder"        => "div",
            "class"         => "cth-vc-images",
            "heading"       => esc_html__("Image", 'easybook-add-ons'),
            "param_name"    => "image",
        ),
        array(
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Top Position", 'easybook-add-ons'),
            "param_name"    => "top_pos",
            "value"         => "10",
            "description"   => esc_html__( 'Top position (%) related to element (top-left corner) ', 'easybook-add-ons' ),
        ),
        array(
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Left Position", 'easybook-add-ons'),
            "param_name"    => "left_pos",
            "value"         => "23",
            "description"   => esc_html__( 'Left position (%) related to element (top-left corner) ', 'easybook-add-ons' ),
        ),
        array(
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Zindex", 'easybook-add-ons'),
            "param_name"    => "zindex",
            "value"         => "10",
            "description"   => esc_html__( 'Use to control image displaying in Z axis.', 'easybook-add-ons' ),
        ),
        array(
            "type" => "checkbox",
            "admin_label"   => true,
            "heading" => esc_html__("Animation Image?", 'easybook-add-ons'),
            "param_name" => "use_animation",
            "value" => array( 
                esc_html__('Yes', 'easybook-add-ons') => 'yes',   
            ),
            "std"=>'', 
        ),
        array(
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Animation Duration Order", 'easybook-add-ons'),
            "param_name"    => "order",
            "value"         => "1",
            "description"   => esc_html__( 'Choose from 1 to 5: 1-0s, 2-2.5s, 3-3.5s, 4-4.5s, 5-5.5s', 'easybook-add-ons' ),
            'dependency'  => array(
                'element' => 'use_animation',
                'value'   => 'yes',
            ),
        ),
        array(
            "type" => "checkbox",
            "admin_label"   => true,
            "heading" => esc_html__("Display content?", 'easybook-add-ons'),
            "param_name" => "use_content",
            "value" => array( 
                esc_html__('Yes', 'easybook-add-ons') => 'yes',   
            ),
            "std"=>'', 
        ),
        array(
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Content", 'easybook-add-ons'),
            "param_name"    => "text_content",
            "value"         => "Booking now",
            "description"   => esc_html__( 'For editing only', 'easybook-add-ons' ),
            'dependency'  => array(
                'element' => 'use_content',
                'value'   => 'yes',
            ),
        ),
        array(
            "type" => "checkbox",
            "admin_label"   => true,
            "heading" => esc_html__("Display Icon?", 'easybook-add-ons'),
            "param_name" => "show_icon",
            "value" => array( 
                esc_html__('Yes', 'easybook-add-ons') => 'yes',   
            ),
            "std"=>'', 
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
            "std"         => "",
            'dependency'  => array(
                'element' => 'show_icon',
                'value'   => 'yes',
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
    class WPBakeryShortCode_Collage_Images_Vc extends WPBakeryShortCodesContainer {}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Collage_Images_Item_Vc extends WPBakeryShortCode {}
}

