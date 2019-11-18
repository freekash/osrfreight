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
    "name"                      => esc_html__("Time Line", 'easybook-add-ons'),
    "description"               => esc_html__("Time Line",'easybook-add-ons'),
    "base"                      => "time_line_vc",
    "icon"                      => ESB_ABSPATH . "assets/cththemes-logo.png",
    "category"                  => __( 'EasyBook Theme', 'easybook-add-ons' ),
    "content_element"           => true,
    "show_settings_on_create"   => true,
    "params"                    => array(
        // params group
        array(
            'type' => 'param_group',
             "heading"       => esc_html__("Time Line Items", 'easybook-add-ons'),
            'param_name' => 'time_lines',
            'value' => '',
            // Note params is mapped inside param-group:
            'params' => array(
                // array(
                //     'type' => 'textfield',
                //     // "admin_label"   => true,
                //     'value' => 'Step 1',
                //     'heading' => esc_html__("Step", 'easybook-add-ons'),
                //     'param_name' => 'step',
                // ),
                // array(
                //     'type' => 'textfield',
                //     // "admin_label"   => true,
                //     'value' => '01 . ',
                //     'heading' => esc_html__("Step Num", 'easybook-add-ons'),
                //     'param_name' => 'step_num',
                // ),
                array(
                    'type' => 'textfield',
                    "admin_label"   => true,
                    'value' => 'Find Interesting Place',
                    'heading' => esc_html__("Title", 'easybook-add-ons'),
                    'param_name' => 'title',
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
                    "description"   => esc_html__( 'Choose icon', 'easybook-add-ons' ),
                    "std"         => "fa fa-map-o",
                ),
                array(
                    "type"          => "textarea",
                    "heading"       => esc_html__("Content", 'easybook-add-ons'),
                    "param_name"    => "content",
                    "value"         => "Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.",
                ),
                array(
                    "type"          => "attach_image",
                    "holder"        => "div",
                    "class"         => "cth-vc-images",
                    "heading"       => esc_html__("Image", 'easybook-add-ons'),
                    "param_name"    => "image",
                ),
                array(
                    'type' => 'vc_link',
                    // "holder"        => "div",
                    // "admin_label"   => true,
                    'value' => '',
                    'heading' => esc_html__("Or Video URL", 'easybook-add-ons'),
                    'param_name' => 'link_video',
                    "description"   => esc_html__( 'https://www.youtube.com/watch?v=xpVfcZ0ZcFM', 'easybook-add-ons' ),
                ),
            ),
        ),
        array(
            "type"        => "dropdown",
            "heading"     => __("First Content Side", 'easybook-add-ons'),
            "param_name"  => "first_side",
            "admin_label" => true,
            "value"       => array(
                            esc_html__( 'Left', 'easybook-add-ons' ) => 'left',
                            esc_html__( 'Right', 'easybook-add-ons' ) => 'right',
                        ),
            "std"         => "left",
            "separator" => "before",
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'End Icon', 'easybook-add-ons' ),
            'param_name' => 'end_icon',
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'fontawesome',
                'iconsPerPage' => 200, // default 100, how many icons per/page to display
            ),
            "description"   => esc_html__( 'Choose icon', 'easybook-add-ons' ),
            "std"         => "fa fa-check",
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
));
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Time_Line_Vc extends WPBakeryShortCode {}
}
