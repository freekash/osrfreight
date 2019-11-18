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
    "name"                      => esc_html__("Posts Grid", 'easybook-add-ons'),
    "description"               => esc_html__("Posts Gird",'easybook-add-ons'),
    "base"                      => "posts_grid_vc",
    "icon"                      => ESB_ABSPATH . "assets/cththemes-logo.png",
    "category"                  => __( 'EasyBook Theme', 'easybook-add-ons' ),
    "content_element"           => true,
    "show_settings_on_create"   => true,
    "params"                    => array(
        array(
            "type"        => "textfield",
            "heading"     => __("Post Category IDs to include.", 'easybook-add-ons'),
            "param_name"  => "cat_ids",
            "admin_label" => true,
            "value"       => '',
            // "std"         => "",
            // "separator" => "before",
            "description"   => esc_html__("Enter post category ids to include, separated by a comma. Leave empty to get posts from all categories.", 'easybook-add-ons'),
        ),
        array(
            "type"        => "textfield",
            "heading"     => __("Enter Post IDs", 'easybook-add-ons'),
            "param_name"  => "ids",
            "admin_label" => true,
            "value"       => '',
            // "std"         => "",
            // "separator" => "before",
            "description"   => esc_html__("Enter Post ids to show, separated by a comma. Leave empty to show all.", 'easybook-add-ons'),
        ),
        array(
            "type"        => "textfield",
            "heading"     => __("Or Post IDs to Exclude", 'easybook-add-ons'),
            "param_name"  => "ids_not",
            "admin_label" => true,
            "value"       => '',
            // "std"         => "",
            // "separator" => "before",
            "description"   => esc_html__("Enter post ids to exclude, separated by a comma (,). Use if the field above is empty.", 'easybook-add-ons'),
        ),
        array(
            "type"        => "dropdown",
            "heading"     => __("Order by", 'easybook-add-ons'),
            "param_name"  => "order_by",
            "admin_label" => true,
            "value"       => array(
                        esc_html__('Date', 'easybook-add-ons') => 'date',
                        esc_html__('ID', 'easybook-add-ons') => 'ID',
                        esc_html__('Author', 'easybook-add-ons') => 'author',
                        esc_html__('Title', 'easybook-add-ons') => 'title', 
                        esc_html__('Modified', 'easybook-add-ons') => 'modified',
                        esc_html__('Random', 'easybook-add-ons') => 'rand',
                        esc_html__('Comment Count', 'easybook-add-ons') => 'comment_count',
                        esc_html__('Menu Order', 'easybook-add-ons') => 'menu_order',
                        esc_html__('ID order given (post__in)', 'easybook-add-ons') => 'post__in',
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
            "type"        => "dropdown",
            "admin_label"   => true,
            "heading"     => __("Space", 'easybook-add-ons'),
            "param_name"  => "space",
            "admin_label" => true,
            "value"       => array(
                        esc_html__('Extra Big', 'easybook-add-ons')   => 'exbig', 
                        esc_html__('Bigger', 'easybook-add-ons')      => 'mbig',
                        esc_html__('Big', 'easybook-add-ons')         => 'big',
                        esc_html__('Medium', 'easybook-add-ons')      => 'medium', 
                        esc_html__('Small', 'easybook-add-ons')       => 'small', 
                        esc_html__('Extra Small', 'easybook-add-ons') => 'extrasmall',  
                        esc_html__('None', 'easybook-add-ons')        => 'no',
                    ),
            "std"         => "mbig",
        ),
        array(
            "type"          => "textfield",
            // "holder"        => "div",
            "admin_label"   => true,
            "heading"       => esc_html__("Post Description Length", 'easybook-add-ons'),
            "param_name"    => "excerpt_length",
            "value"         => "250",
        ),
        array(
            "type" => "checkbox",
            "admin_label"   => true,
            "heading" => esc_html__("Show Author", 'easybook-add-ons'),
            "param_name" => "show_author",
            "value" => array( 
                esc_html__('Yes', 'easybook-add-ons') => 'yes',   
            ),
            "std"=>'yes', 
        ),
        array(
            "type" => "checkbox",
            "admin_label"   => true,
            "heading" => esc_html__("Show Date", 'easybook-add-ons'),
            "param_name" => "show_date",
            "value" => array( 
                esc_html__('Yes', 'easybook-add-ons') => 'yes',   
            ),
            "std"=>'yes', 
        ),
        array(
            "type" => "checkbox",
            "admin_label"   => true,
            "heading" => esc_html__("Show Views", 'easybook-add-ons'),
            "param_name" => "show_views",
            "value" => array( 
                esc_html__('Yes', 'easybook-add-ons') => 'yes',   
            ),
            "std"=>'yes', 
        ),
        array(
            "type" => "checkbox",
            "admin_label"   => true,
            "heading" => esc_html__("Show Categories", 'easybook-add-ons'),
            "param_name" => "show_cats",
            "value" => array( 
                esc_html__('Yes', 'easybook-add-ons') => 'yes',   
            ),
            "std"=>'yes', 
        ),
        array(
            "type"        => "vc_link",
            "admin_label" => true,
            "heading"     => __("Read All Link", 'easybook-add-ons'),
            "param_name"  => "read_all_link",
            "admin_label" => true,
            "value"       => "#",
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
            "admin_label"   => true,
            "heading"       => esc_html__("Button name", 'easybook-add-ons'),
            "param_name"    => "btn_name",
            "value"         => "Explore All Cities",
            // "description"   => esc_html__("Defined location width. Available values are x1(default),x2(x2 width),x3(x3 width), and separated by comma. Ex: x1,x1,x2,x1,x1,x1", 'easybook-add-ons'),
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
    class WPBakeryShortCode_Posts_Grid_Vc extends WPBakeryShortCode {}
}