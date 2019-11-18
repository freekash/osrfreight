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
    "name"                      => esc_html__("Button", 'easybook-add-ons'),
    "description"               => esc_html__("Button",'easybook-add-ons'),
    "base"                      => "button_vc",
    "icon"                      => ESB_ABSPATH . "assets/cththemes-logo.png",
    "category"                  => __( 'EasyBook Theme', 'easybook-add-ons' ),
    "content_element"           => true,
    "show_settings_on_create"   => true,
    "params"                    => array(
        array(
            "type"        => "dropdown",
            "heading"     => __("Button Style", 'easybook-add-ons'),
            "param_name"  => "btn_style",
            "admin_label" => true,
            "value"       => array(
                            esc_html__( 'Button style 1', 'easybook-add-ons' ) => 'btn_style_1',
                            esc_html__( 'Button style 2', 'easybook-add-ons' ) => 'btn_style_2',
                            esc_html__( 'Button style 3', 'easybook-add-ons' ) => 'btn_style_3',
                        ),
            "std"         => "btn_style_1",
            "separator" => "before",
        ),
        array(
            "type" => "checkbox",
            "admin_label"   => true,
            "heading" => esc_html__("More than 1 button", 'easybook-add-ons'),
            "param_name" => "btn_s",
            "value" => array( 
                esc_html__('Yes', 'easybook-add-ons') => 'yes',   
            ),
            "std" => 'no',
        ),
        array(
            "type"        => "dropdown",
            "heading"     => __("Button color", 'easybook-add-ons'),
            "param_name"  => "bt_color",
            "admin_label" => true,
            "value"       => array(
                            esc_html__( 'Summer Sky', 'easybook-add-ons' ) => '',
                            esc_html__( 'Selective Yellow', 'easybook-add-ons' ) => '2',
                            esc_html__( 'Egyptian Blue', 'easybook-add-ons' ) => '3',
                        ),
            "std"         => "",
            "separator" => "before",
            // 'dependency' => array(
            //     'element' => 'btn_style',
            //     'value' => 'btn_style_1',
            // ),
        ),
        // params group
        array(
            'type' => 'param_group',
            "heading"       => esc_html__("Buttons", 'easybook-add-ons'),
            'param_name' => 'buttons',
            'value' => '',
            // Note params is mapped inside param-group:
            'params' => array(
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Name Button", 'easybook-add-ons'),
                    "param_name"    => "name_bt",
                    "value"         => "Download for iPhone",
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
                    "std"         => "fab fa-apple",
                    'dependency' => array(
                        'element' => 'name_bt',
                        'not_empty'   => true,
                    ),
                ),
                array(
                    "type"        => "vc_link",
                    "heading"     => __("Button Links", 'easybook-add-ons'),
                    "param_name"  => "links",
                    "value"       => "#",
                    "description"   => esc_html__( 'Enter links for each partner (Note: divide links with linebreaks (Enter) or | and no spaces)', 'easybook-add-ons' ). get_post_type_archive_link( 'listing' ),
                    'dependency' => array(
                        'element' => 'name_bt',
                        'not_empty'   => true,
                    ),
                ),
                array(
                    "type" => "checkbox",
                    "heading" => esc_html__("Is External Links", 'easybook-add-ons'),
                    "param_name" => "is_external",
                    "value" => array( 
                        esc_html__('Yes', 'easybook-add-ons') => 'yes',   
                    ),
                    "std"=>'yes',
                    'dependency' => array(
                        'element' => 'name_bt',
                        'not_empty'   => true,
                    ),
                ),
            ),
            'dependency' => array(
                'element' => 'btn_s',
                'not_empty' => true,
            ),
        ),
        array(
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Name Button", 'easybook-add-ons'),
            "param_name"    => "name_bt",
            "value"         => "Our Vimeo Chanel",
            // 'dependency' => array(
            //     'element' => 'btn_s',
            //     'not_empty' => false,
            // ),
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
        ),
        array(
            "type"        => "vc_link",
            "admin_label" => true,
            "heading"     => __("Button Links", 'easybook-add-ons'),
            "param_name"  => "links",
            "value"       => "#",
            "description"   => esc_html__( 'Enter links for each partner (Note: divide links with linebreaks (Enter) or | and no spaces)', 'easybook-add-ons' ). get_post_type_archive_link( 'listing' ),
            // 'dependency' => array(
            //     'element' => 'btn_s',
            //     'not_empty' => false,
            // ),
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
            // 'dependency' => array(
            //     'element' => 'btn_s',
            //     'not_empty' => false,
            // ),
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
    class WPBakeryShortCode_Button_Vc extends WPBakeryShortCode {}
}