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
    "name"                      => esc_html__("Listing Categories", 'easybook-add-ons'),
    "description"               => esc_html__("Listing Categories",'easybook-add-ons'),
    "base"                      => "listing_categories_vc",
    "icon"                      => ESB_ABSPATH . "assets/cththemes-logo.png",
    "category"                  => __( 'EasyBook Theme', 'easybook-add-ons' ),
    "content_element"           => true,
    "show_settings_on_create"   => true,
    "params"                    => array(
        array(
            "type"        => "textfield",
            "heading"     => __("Select Categories to include (Leave empty for ALL)", 'easybook-add-ons'),
            "param_name"  => "cat_ids",
            "admin_label" => true,
            "value"       => '',
            // "std"         => "",
            // "separator" => "before",
        ),
        array(
            "type"        => "textfield",
            "heading"     => __("Or Categories to exclude (Leave empty for ALL)", 'easybook-add-ons'),
            "param_name"  => "cat_ids_not",
            "admin_label" => true,
            "value"       => '',
            // "std"         => "",
            // "separator" => "before",
        ),
        array(
            "type"        => "dropdown",
            "heading"     => __("Order by", 'easybook-add-ons'),
            "param_name"  => "orderby",
            "admin_label" => true,
            "value"       => array(
                            esc_html__( 'Name', 'easybook-add-ons' ) => 'name',
                            esc_html__( 'Slug', 'easybook-add-ons' ) => 'slug',
                            esc_html__( 'Term Group', 'easybook-add-ons' ) => 'term_group',
                            esc_html__( 'Term ID', 'easybook-add-ons' ) => 'term_id',
                            esc_html__( 'Description', 'easybook-add-ons' ) => 'description',
                            esc_html__( 'Parent', 'easybook-add-ons' ) => 'parent',
                            esc_html__( 'Term Count', 'easybook-add-ons' ) => 'count',
                            esc_html__( 'For Include above', 'easybook-add-ons' ) => 'include',
                        ),
            "std"         => "name",
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
            "type" => "checkbox",
            "admin_label"   => true,
            "heading" => esc_html__("Hide Empty", 'easybook-add-ons'),
            "param_name" => "hide_empty",
            "value" => array( 
                esc_html__('Yes', 'easybook-add-ons') => 'yes',   
            ),
            "std"=>'yes', 
            "description" => esc_html__('Whether to hide categories not assigned to any listings.', 'easybook-add-ons'),
        ),
        array(
            "type"          => "textfield",
            // "holder"        => "div",
            "admin_label"   => true,
            "heading"       => esc_html__("Number of Categories to show", 'easybook-add-ons'),
            "param_name"    => "number",
            "value"         => "0",
            "description"   => esc_html__("Number of Categories to show (0 for all).", 'easybook-add-ons'),
        ),
        
        array(
            "type"        => "dropdown",
            "admin_label"   => true,
            "heading"     => __("Columns Grid", 'easybook-add-ons'),
            "param_name"  => "columns_grid",
            "admin_label" => true,
            "value"       => array(
                        esc_html__( 'One Column', 'easybook-add-ons' ) => 'one',
                        esc_html__( 'Two Columns', 'easybook-add-ons' ) => 'two',
                        esc_html__( 'Three Columns', 'easybook-add-ons' ) => 'three',
                        esc_html__( 'Four Columns', 'easybook-add-ons' ) => 'four',
                        esc_html__( 'Five Columns', 'easybook-add-ons' ) => 'five',
                        esc_html__( 'Six Columns', 'easybook-add-ons' ) => 'six',
                        esc_html__( 'Seven Columns', 'easybook-add-ons' ) => 'seven',
                        esc_html__( 'Eight Columns', 'easybook-add-ons' ) => 'eight',
                        esc_html__( 'Nine Columns', 'easybook-add-ons' ) => 'nine',
                        esc_html__( 'Ten Columns', 'easybook-add-ons' ) => 'ten',
                    ),
            "std"         => "three",
        ),
        array(
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Categories Items Width", 'easybook-add-ons'),
            "param_name"    => "items_width",
            "value"         => "x1,x1,x1,x1,x1,x1",
            "description"   => esc_html__("Defined category width. Available values are x1(default),x2(x2 width),x3(x3 width), and separated by comma. Ex: x1,x1,x2,x1,x1,x1", 'easybook-add-ons'),
        ),
        array(
            "type"        => "dropdown",
            "admin_label"   => true,
            "heading"     => __("Space", 'easybook-add-ons'),
            "param_name"  => "space",
            "admin_label" => true,
            "value"       => array(
                        esc_html__( 'Big', 'easybook-add-ons' ) => 'big',
                        esc_html__( 'Medium', 'easybook-add-ons' ) => 'medium',
                        esc_html__( 'Small', 'easybook-add-ons' ) => 'small',
                        esc_html__( 'Extra Small', 'easybook-add-ons' ) => 'extrasmall',
                        esc_html__( 'None', 'easybook-add-ons' ) => 'no',
                    ),
            "std"         => "big",
        ),
        array(
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Button name", 'easybook-add-ons'),
            "param_name"    => "btn_name",
            "value"         => "Explore All Cities",
        ),
        array(
            "type"        => "vc_link",
            "admin_label" => true,
            "heading"     => __("View All Link", 'easybook-add-ons'),
            "param_name"  => "view_all_link",
            "admin_label" => true,
            "value"       => "#",
            "std"         => "big",
            "description"   => esc_html__( 'Listing archive page: ', 'easybook-add-ons' ). get_post_type_archive_link( 'listing' ),
            'dependency' => array(
                'element' => 'btn_name',
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
                'element' => 'btn_name',
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
));
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Listing_Categories_Vc extends WPBakeryShortCode {}
}