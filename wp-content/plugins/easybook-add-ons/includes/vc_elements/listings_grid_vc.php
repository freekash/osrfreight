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
    "name"                      => esc_html__("Listings Grid", 'easybook-add-ons'),
    "description"               => esc_html__("Listings Gird",'easybook-add-ons'),
    "base"                      => "listings_grid_vc",
    "icon"                      => ESB_ABSPATH . "assets/cththemes-logo.png",
    "category"                  => __( 'EasyBook Theme', 'easybook-add-ons' ),
    "content_element"           => true,
    "show_settings_on_create"   => true,
    "params"                    => array(
        array(
            "type"        => "dropdown",
            "heading"     => __("Categories to get listings", 'easybook-add-ons'),
            "param_name"  => "cat_ids",
            "admin_label" => true,
            "value"       => easybook_addons_get_listing_categories_select2(),
            "std"         => "",
            "separator" => "before", 
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
            "value"         => "6",
            "description"   => esc_html__("Number of Locations to show (-1 for all).", 'easybook-add-ons'),
        ),
        array(
            "type"        => "dropdown",
            "admin_label"   => true,
            "heading"     => __("Map Position", 'easybook-add-ons'),
            "param_name"  => "map_pos",
            "admin_label" => true,
            "value"       => array(
                                esc_html__( 'Top', 'easybook-add-ons' ) => 'top',
                                esc_html__( 'Left', 'easybook-add-ons' ) => 'left',
                                esc_html__( 'Right', 'easybook-add-ons' ) => 'right',
                                esc_html__( 'Hide', 'easybook-add-ons' ) => 'hide',
                            ),
            "std"         => "right",
        ),
        array(
            "type"        => "dropdown",
            "admin_label"   => true,
            "heading"     => __("Map Width", 'easybook-add-ons'),
            "param_name"  => "map_width",
            "admin_label" => true,
            "value"       => array(
                                esc_html__('30%', 'easybook-add-ons') => '30', 
                                esc_html__('40%', 'easybook-add-ons') => '40',
                                esc_html__('50%', 'easybook-add-ons') => '50',
                                esc_html__('60%', 'easybook-add-ons') => '60', 
                                esc_html__('70%', 'easybook-add-ons') => '70', 
                            ),
            "std"         => "50",
            'description' => esc_html__("Select Google Map width", 'easybook-add-ons'), 
        ),

        array(
            "type"        => "dropdown",
            "admin_label"   => true,
            "heading"     => __("Filter Position", 'easybook-add-ons'),
            "param_name"  => "filter_pos",
            "admin_label" => true,
            "value"       => array(
                                esc_html__( 'Top', 'easybook-add-ons' ) => 'top',
                                esc_html__( 'Left', 'easybook-add-ons' ) => 'left',
                                esc_html__( 'Right', 'easybook-add-ons' ) => 'right',
                                esc_html__( 'Column Left', 'easybook-add-ons' ) => 'left_col',
                            ),
            "std"         => "top",
            'description' => esc_html__("Select Google Map width", 'easybook-add-ons'), 
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
                            ),
            "std"         => "three",
        ),
        array(
            "type" => "checkbox",
            "admin_label"   => true,
            "heading" => esc_html__("Show Pagination", 'easybook-add-ons'),
            "param_name" => "show_pagination",
            "value" => array( 
                esc_html__('Yes', 'easybook-add-ons') => 'yes',   
            ),
            "std"=>'yes',
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
    class WPBakeryShortCode_Listings_Grid_Vc extends WPBakeryShortCode {}
}