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
    "name"                      => esc_html__("Listings Slider", 'easybook-add-ons'),
    "description"               => esc_html__("Listings Slider",'easybook-add-ons'),
    "base"                      => "listings_slider_vc",
    "icon"                      => ESB_ABSPATH . "assets/cththemes-logo.png",
    "category"                  => __( 'EasyBook Theme', 'easybook-add-ons' ),
    "content_element"           => true,
    "show_settings_on_create"   => true,
    "params"                    => array(
        array(
            "type"        => "textfield",
            "heading"     => __("Categories to get listings. (Leave empty for ALL)", 'easybook-add-ons'),
            "param_name"  => "cat_ids",
            "admin_label" => true,
            "value"       => '',
            // "std"         => "",
            // "separator" => "before",
        ),
        array(
            "type"        => "textfield",
            "heading"     => __("Enter Post IDs.", 'easybook-add-ons'),
            "param_name"  => "ids",
            "admin_label" => true,
            "value"       => '',
            // "std"         => "",
            // "separator" => "before",
            'description' => __("Enter Post ids to show, separated by a comma. Leave empty to show all.", 'easybook-add-ons')
        ),
        array(
            "type"        => "textfield",
            "heading"     => __("Or Post IDs to Exclude.", 'easybook-add-ons'),
            "param_name"  => "ids_not",
            "admin_label" => true,
            "value"       => '',
            // "std"         => "",
            // "separator" => "before",
            'description' => __("Enter post ids to exclude, separated by a comma (,). Use if the field above is empty.", 'easybook-add-ons')
        ),
        array(
            "type"        => "dropdown",
            "heading"     => __("Order by", 'easybook-add-ons'),
            "param_name"  => "order_by",
            "admin_label" => true,
            "value"       => array(
                            'date'          => esc_html__('Date', 'easybook-add-ons'), 
                            'ID'            => esc_html__('ID', 'easybook-add-ons'), 
                            'author'        => esc_html__('Author', 'easybook-add-ons'), 
                            'title'         => esc_html__('Title', 'easybook-add-ons'), 
                            'modified'      => esc_html__('Modified', 'easybook-add-ons'),
                            'rand'          => esc_html__('Random', 'easybook-add-ons'),
                            'comment_count' => esc_html__('Comment Count', 'easybook-add-ons'),
                            'menu_order'    => esc_html__('Menu Order', 'easybook-add-ons'),
                            'post__in'      => esc_html__('ID order given (post__in)', 'easybook-add-ons'),
                        ),
            "std"         => "date",
            "separator" => "before",
            "description" => esc_html__("Select how to sort retrieved categories. More at ", 'easybook-add-ons').'<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.', 
        ),
        array(
            "type"        => "dropdown",
            "heading"     => __("Sort Order", 'easybook-add-ons'),
            "param_name"  => "order",
            "admin_label" => true,
            "value"       => array(
                            esc_html__( 'Ascending', 'easybook-add-ons' ) => 'ASC',
                            esc_html__( 'Descending', 'easybook-add-ons' ) => 'DESC',
                        ),
            "std"         => "DESC",
            "separator" => "before",
            "description" => esc_html__("Select Ascending or Descending order. More at", 'easybook-add-ons').'<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.', 
        ),
        array(
            "type"          => "textfield",
            // "holder"        => "div",
            "admin_label"   => true,
            "heading"       => esc_html__("Number of Locations to show", 'easybook-add-ons'),
            "param_name"    => "posts_per_page",
            "value"         => "3",
            "description"   => esc_html__("Number of Locations to show (-1 for all).", 'easybook-add-ons'),
        ),
        
        array(
            "type"        => "vc_link",
            "admin_label" => true,
            "heading"     => __("Read All Link", 'easybook-add-ons'),
            "param_name"  => "read_all_link",
            "admin_label" => true,
            "value"       => "#",
            // "std"         => "big",
            // "description"   => esc_html__( 'Listing archive page: ', 'easybook-add-ons' ). get_post_type_archive_link( 'listing' ),
        ),
        array(
            "type" => "checkbox",
            "admin_label"   => true,
            "heading" => esc_html__("Show Pagination", 'easybook-add-ons'),
            "param_name" => "show_pagination",
            "value" => array( 
                esc_html__('Yes', 'easybook-add-ons') => 'yes',   
            ),
            "std"=>'',
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
    class WPBakeryShortCode_Listings_Slider_Vc extends WPBakeryShortCode {}
}