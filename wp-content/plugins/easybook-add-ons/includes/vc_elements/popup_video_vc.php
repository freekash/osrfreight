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
    "name"                      => esc_html__("Popup Video", 'easybook-add-ons'),
    "description"               => esc_html__("Popup Video",'easybook-add-ons'),
    "base"                      => "popup_video_vc",
    "icon"                      => ESB_ABSPATH . "assets/cththemes-logo.png",
    "category"                  => __( 'EasyBook Theme', 'easybook-add-ons' ),
    "content_element"           => true,
    "show_settings_on_create"   => true,
    "params"                    => array(
        array(
            "type"        => "vc_link",
            "admin_label" => true,
            "heading"     => __("Video URL", 'easybook-add-ons'),
            "param_name"  => "video_url",
            "admin_label" => true,
            "value"       => "https://vimeo.com/264074381",
            "description"   => esc_html__( 'Your Youtube, Vimeo or hosted video url. Ex: https://vimeo.com/264074381', 'easybook-add-ons' ). get_post_type_archive_link( 'listing' ),
        ),
        array(
            "type"          => "attach_image",
            "holder"        => "div",
            "class"         => "cth-vc-images",
            "heading"       => esc_html__("Image", 'easybook-add-ons'),
            "param_name"    => "image",
            "description"   => "Only choose one image",
        ),
        array(
            "type"          => "textfield",
            // "holder"        => "div",
            "admin_label"   => true,
            "heading"       => esc_html__("Video Title", 'easybook-add-ons'),
            "param_name"    => "video_title",
            "value"         => "Our Video Presentation",
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Button Icon', 'easybook-add-ons' ),
            'param_name' => 'icon',
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'fontawesome',
                'iconsPerPage' => 200, // default 100, how many icons per/page to display
            ),
            "description"   => "Choose icon",
            "std"         => "fa fa-play",
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
    'admin_enqueue_js'      => ESB_ABSPATH . "assets/js/wpbakerry-eles.js", // need "holder"    => "div" and "class"     => "cth-vc-images" option for attach_image, attach_images type
    'js_view' => 'CTHVCImages',
));
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Popup_Video_Vc extends WPBakeryShortCode {}
}