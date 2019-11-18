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
    "name"                      => esc_html__("Asked Question", 'easybook-add-ons'),
    "description"               => esc_html__("Asked Question",'easybook-add-ons'),
    "base"                      => "asked_question_vc",
    "icon"                      => ESB_ABSPATH . "assets/cththemes-logo.png",
    "category"                  => __( 'EasyBook Theme', 'easybook-add-ons' ),
    "content_element"           => true,
    "show_settings_on_create"   => true,
    "params"                    => array(
        array(
            "type"          => "textfield",
            // "holder"        => "div",
            "admin_label"   => true,
            "heading"       => esc_html__("Title", 'easybook-add-ons'),
            "param_name"    => "title",
            "value"         => "Frequently Asked Question",
        ),
        // params group
        array(
            'type' => 'param_group',
             "heading"       => esc_html__("Set of questions", 'easybook-add-ons'),
            'param_name' => 'asked_question',
            'value' => '',
            // Note params is mapped inside param-group:
            'params' => array(
                array(
                    'type' => 'textfield',
                    "holder"        => "div",
                    "admin_label"   => true,
                    'value' => 'Payments',
                    'heading' => esc_html__("Question Title", 'easybook-add-ons'),
                    'param_name' => 'question_title',
                ),
                array(
                    "type"          => "textarea",
                    "heading"       => esc_html__("Content", 'easybook-add-ons'),
                    "param_name"    => "content",
                    "value"         => "Qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram seacula quarta decima et quinta decima.",
                ),
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
    class WPBakeryShortCode_Asked_Question_Vc extends WPBakeryShortCode {}
}
