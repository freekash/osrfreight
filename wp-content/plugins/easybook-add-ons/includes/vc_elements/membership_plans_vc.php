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
    "name"                      => esc_html__("Membership Plans", 'easybook-add-ons'),
    "description"               => esc_html__("Membership Plans",'easybook-add-ons'),
    "base"                      => "membership_plans_vc",
    "icon"                      => ESB_ABSPATH . "assets/cththemes-logo.png",
    "category"                  => __( 'EasyBook Theme', 'easybook-add-ons' ),
    "content_element"           => true,
    "show_settings_on_create"   => true,
    "params"                    => array(
        array(
            "type"          => "textfield",
            // "holder"        => "div",
            "admin_label"   => true,
            "heading"       => esc_html__("Enter Plan IDs", 'easybook-add-ons'),
            "param_name"    => "ids",
            "value"         => "",
            "description" => __('Enter Plan ids to show, separated by a comma. Leave empty to show all.', 'easybook-add-ons'),
        ),
        array(
            "type"          => "textfield",
            // "holder"        => "div",
            "admin_label"   => true,
            "heading"       => esc_html__("Or Plan IDs to Exclude", 'easybook-add-ons'),
            "param_name"    => "ids_not",
            "value"         => "",
            "description" => __('Enter plan ids to exclude, separated by a comma (,). Use if the field above is empty.', 'easybook-add-ons'),
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
            "type"          => "textfield",
            // "holder"        => "div",
            "admin_label"   => true,
            "heading"       => esc_html__("Best Price Item", 'easybook-add-ons'),
            "param_name"    => "best_price_item",
            "value"         => "1",
            "description"   => esc_html__("Best price item number. 1 for first item. Leave empty for none.", 'easybook-add-ons'),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Best Price Icon', 'easybook-add-ons' ),
            'param_name' => 'best_price_icon',
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'fontawesome',
                'iconsPerPage' => 200, // default 100, how many icons per/page to display
            ),
            "description"   => "Choose icon",
            "std"         => "fa fa-check",
        ),
        array(
            "type"          => "textfield",
            // "holder"        => "div",
            "admin_label"   => true,
            "heading"       => esc_html__("Best Price Recommended Text", 'easybook-add-ons'),
            "param_name"    => "best_price_text",
            "value"         => "Recommended",
            // "description"   => esc_html__("Min = 1 and Max = 20.", 'easybook-add-ons'),
        ),
        array(
            "type" => "checkbox",
            "admin_label"   => true,
            "heading" => esc_html__("Show Button Switcher Pricing", 'easybook-add-ons'),
            "param_name" => "show_pricing_switcher",
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
    class WPBakeryShortCode_Membership_Plans_Vc extends WPBakeryShortCode {}
}