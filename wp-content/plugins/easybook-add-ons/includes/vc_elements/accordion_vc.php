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
    "name"                      => esc_html__("Accordion", 'easybook-add-ons'),
    "description"               => esc_html__("Accordion",'easybook-add-ons'),
    "base"                      => "accordion_vc",
    "icon"                      => ESB_ABSPATH . "assets/cththemes-logo.png",
    "category"                  => __( 'EasyBook Theme', 'easybook-add-ons' ),
    "content_element"           => true,
    "show_settings_on_create"   => true,
    "params"                    => array(
        // params group
        array(
            'type' => 'param_group',
             "heading"       => esc_html__("Accordion Item", 'easybook-add-ons'),
            'param_name' => 'accordions',
            'value' => '',
            // Note params is mapped inside param-group:
            'params' => array(
                array(
                    'type' => 'textfield',
                    "holder"        => "div",
                    "admin_label"   => true,
                    'value' => 'Accordion Title',
                    'heading' => esc_html__("Title", 'easybook-add-ons'),
                    'param_name' => 'title',
                ),
                array(
                    "type"          => "textarea",
                    "heading"       => esc_html__("Content", 'easybook-add-ons'),
                    "param_name"    => "content",
                    "value"         => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat purus viverra.",
                ),
            ),
        ),
        array(
            "type"          => "textfield",
            // "holder"        => "div",
            "admin_label"   => true,
            "heading"       => esc_html__("Active Item", 'easybook-add-ons'),
            "param_name"    => "active",
            "value"         => "1",
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
    class WPBakeryShortCode_Accordion_Vc extends WPBakeryShortCode {}
}
