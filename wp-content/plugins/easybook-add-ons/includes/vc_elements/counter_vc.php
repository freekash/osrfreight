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
    "name"                      => esc_html__("Counter", 'easybook-add-ons'),
    "description"               => esc_html__("Counter",'easybook-add-ons'),
    "base"                      => "counter_vc",
    "icon"                      => ESB_ABSPATH . "assets/cththemes-logo.png",
    "category"                  => __( 'EasyBook Theme', 'easybook-add-ons' ),
    "content_element"           => true,
    "show_settings_on_create"   => true,
    "params"                    => array(
        array(
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Number", 'easybook-add-ons'),
            "param_name"    => "number",
            "value"         => "254",
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
            "std"         => "fa fa-map-o",
        ),
        array(
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Title", 'easybook-add-ons'),
            "param_name"    => "title",
            "value"         => "New Listing Every Week",
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
    class WPBakeryShortCode_Counter_Vc extends WPBakeryShortCode {}
}