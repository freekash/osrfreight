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
    "name"                      => esc_html__("Hero Section", 'easybook-add-ons'),
    "description"               => esc_html__("Hero Section", 'easybook-add-ons'),
    "base"                      => "hero_section_vc",
    "icon"                      => ESB_ABSPATH . "assets/cththemes-logo.png",
    "category"                  => esc_html__( 'EasyBook Theme', 'easybook-add-ons' ),
    "content_element"           => true,
    "show_settings_on_create"   => true,
    "params"                    => array(
        array(
            "type"        => "dropdown",
            "heading"     => __("Background Type", 'easybook-add-ons'),
            "param_name"  => "bg_type",
            "admin_label" => true,
            "value"       => array(
                                esc_html__( 'Parallax Image', 'easybook-add-ons' ) => 'image',
                                esc_html__( 'Slideshow Images', 'easybook-add-ons' ) => 'slideshow',
                                esc_html__( 'Youtube Video', 'easybook-add-ons' ) => 'yt_video',
                                esc_html__( 'Vimeo Video', 'easybook-add-ons' ) => 'vm_video',
                                esc_html__( 'Hosted Video', 'easybook-add-ons' ) => 'ht_video',
                            ),
            "std"         => "image",
            "separator" => "before",
            // "description" => "Select the icon or image to display.",
        ),
        array(
            "type"          => "attach_image",
            "holder"        => "div",
            "class"         => "cth-vc-images",
            "heading"       => esc_html__("Background Image", 'easybook-add-ons'),
            "param_name"    => "bgimage",
            "description"   => "Only choose one image",
            'dependency'  => array(
                'element' => 'bg_type',
                'value'   => array('yt_video','vm_video','image','ht_video'),
            ),
        ),
        array(
            "type"          => "attach_images",
            "holder"        => "div",
            "class"         => "cth-vc-images",
            "heading"       => esc_html__("Slideshow Images", 'easybook-add-ons'),
            "param_name"    => "slideshow_imgs",
            'dependency' => array(
                'element' => 'bg_type',
                'value' => 'slideshow',
            ),
        ),
        array(
            "type"          => "textfield",
            // "holder"        => "div",
            "admin_label"   => true,
            "heading"       => esc_html__("Youtube or Vimeo Video ID", 'easybook-add-ons'),
            "param_name"    => "video_id",
            "value"         => "",
            'description' => esc_html__( 'Your Youtube or Vimeo video ID: Hg5iNVSp2z8', 'easybook-add-ons' ),
            'dependency' => array(
                'element' => 'bg_type',
                'value' => array( 'yt_video', 'vm_video' ),
            ),
        ),
        array(
            "type"          => "textfield",
            // "holder"        => "div",
            "admin_label"   => true,
            "heading"       => esc_html__("Hosted Video URL", 'easybook-add-ons'),
            "param_name"    => "video_url",
            "value"         => "",
            'description' => esc_html__( 'Your hosted video URL (should be in.mp4 format)', 'easybook-add-ons' ),
            'dependency' => array(
                'element' => 'bg_type',
                'value' => 'ht_video',
            ),
        ),
        array(
            "type"        => "dropdown",
            "heading"     => __("Overlay Opacity", 'easybook-add-ons'),
            "param_name"  => "overlay_opa",
            "admin_label" => true,
            "value"       => array(
                            esc_html__( 'None', 'easybook-add-ons' ) => '',
                            esc_html__( '0.1', 'easybook-add-ons' ) => '0.1',
                            esc_html__( '0.2', 'easybook-add-ons' ) => '0.2',
                            esc_html__( '0.3', 'easybook-add-ons' ) => '0.3',
                            esc_html__( '0.4', 'easybook-add-ons' ) => '0.4',
                            esc_html__( '0.5', 'easybook-add-ons' ) => '0.5',
                            esc_html__( '0.6', 'easybook-add-ons' ) => '0.6',
                            esc_html__( '0.7', 'easybook-add-ons' ) => '0.7',
                            esc_html__( '0.8', 'easybook-add-ons' ) => '0.8',
                            esc_html__( '0.9', 'easybook-add-ons' ) => '0.9',
                            esc_html__( '1', 'easybook-add-ons' )   => '1',
                            ),
            "std"         => "0.5",
            "description" => esc_html__( 'Overlay Opacity value 0.0 - 1. Default 0.5', 'easybook-add-ons' ),
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
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Title", 'easybook-add-ons'),
            "param_name"    => "title",
            "value"         => "We will help you to find all",
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
            "type"          => "textarea_html",
            // "holder"      => "div",
            "admin_label" => true,
            "heading"       => esc_html__("Sub-Title", 'easybook-add-ons'),
            "param_name"    => "content",
            'value'         => 'Find great places , hotels , restourants , shops.',
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
            "std"=>'', 
            'dependency' => array(
                'element' => 'show_search',
                'value' => 'yes',
            ),
        ),
        array(
            "type"          => "textfield",
            "holder"        => "div",
            "heading"       => esc_html__("Content After Search", 'easybook-add-ons'),
            "param_name"    => "content_after",
            'value'         => '',
        ),
        array(
            "type"          => "textfield",
            // "holder"        => "div",
            "admin_label"   => true,
            "heading"       => esc_html__("Scroll button URL", 'easybook-add-ons'),
            "param_name"    => "scroll_url",
            "value"         => "#sec2",
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
    'js_view'=> 'CTHVCImages',
));
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Hero_Section_Vc extends WPBakeryShortCode {}
}