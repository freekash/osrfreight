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


/**
 * Disable front-end builder
 */
// function easybook_vc_remove_frontend_links() {
//     vc_disable_frontend(); // this will disable frontend editor
// }
//add_action( 'vc_after_init', 'easybook_vc_remove_frontend_links' );

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
// add_action( 'vc_before_init', 'easybook_vcSetAsTheme' );
// if(!function_exists('easybook_vcSetAsTheme')){
//     function easybook_vcSetAsTheme() {
//         vc_set_as_theme($disable_updater = true);23456789]
//          
//     }
// }

function easybook_addons_register_wpbakerry_elements() {

    require_once ESB_ABSPATH .'includes/vc_elements/hero_section_vc.php';
    require_once ESB_ABSPATH .'includes/vc_elements/hero_slider_vc.php';
    require_once ESB_ABSPATH .'includes/vc_elements/hero_section_map_vc.php';


    require_once ESB_ABSPATH .'includes/vc_elements/accordion_vc.php';
    require_once ESB_ABSPATH .'includes/vc_elements/section_title_vc.php';
    require_once ESB_ABSPATH .'includes/vc_elements/section_title_left_vc.php';
    require_once ESB_ABSPATH .'includes/vc_elements/parallax_content_vc.php';

    require_once ESB_ABSPATH .'includes/vc_elements/listing_locations_vc.php';
    require_once ESB_ABSPATH .'includes/vc_elements/listing_categories_vc.php';
    require_once ESB_ABSPATH .'includes/vc_elements/listings_slider_vc.php';
    require_once ESB_ABSPATH .'includes/vc_elements/listing_slider_item_vc.php';
    require_once ESB_ABSPATH .'includes/vc_elements/listings_grid_vc.php';
    require_once ESB_ABSPATH .'includes/vc_elements/process_vc.php';
    require_once ESB_ABSPATH .'includes/vc_elements/counter_vc.php';
    require_once ESB_ABSPATH .'includes/vc_elements/collage_images_vc.php';
    require_once ESB_ABSPATH .'includes/vc_elements/testimonials_slider_vc.php';
    require_once ESB_ABSPATH .'includes/vc_elements/time_line_vc.php';
    require_once ESB_ABSPATH .'includes/vc_elements/posts_grid_vc.php';
    require_once ESB_ABSPATH .'includes/vc_elements/button_vc.php';
    require_once ESB_ABSPATH .'includes/vc_elements/popup_video_vc.php';
    require_once ESB_ABSPATH .'includes/vc_elements/members_grid_vc.php';
    require_once ESB_ABSPATH .'includes/vc_elements/google_map_vc.php';
    require_once ESB_ABSPATH .'includes/vc_elements/membership_plans_vc.php';
    require_once ESB_ABSPATH .'includes/vc_elements/asked_question_vc.php';
    require_once ESB_ABSPATH .'includes/vc_elements/our_partners_vc.php';
    

}
add_action( 'vc_before_init', 'easybook_addons_register_wpbakerry_elements' );

// Add new Param in Row
function easybook_add_ons_add_vc_param(){
    if(function_exists('vc_set_shortcodes_templates_dir')) vc_set_shortcodes_templates_dir( ESB_ABSPATH.'/vc_templates/' );
    $new_row_params = array(
        array(
            "type" => "dropdown",
            'admin_label'   => true,
            "heading" => esc_html__('EasyBook Pre-defined Section Layout', 'easybook-add-ons'),
            "param_name" => "cth_layout",
            "value" => array(   
                            esc_html__('Default', 'easybook-add-ons') => 'default',  
                            esc_html__('Hero Section', 'easybook-add-ons') => 'cth_hero_sec',
                            esc_html__('Page Header Section', 'easybook-add-ons') => 'cth_head_sec',
                            esc_html__('Page Section', 'easybook-add-ons') => 'cth_page_sec',
                            esc_html__('Background Video', 'easybook-add-ons') => 'cth_video_bg_sec',
            ),
            "description" => esc_html__("Select one of the pre made page sections or using default", 'easybook-add-ons'), 
            "group" => __( 'EasyBook Theme', 'easybook-add-ons' ),
        ),

        array(                
            "type" => "dropdown",
            "heading" => esc_html__('Content Width', 'easybook-add-ons'),
            "param_name" => "cth_sec_width",
            "value" => array(   
                            esc_html__('Fullwidth','easybook-add-ons' ) => 'full-container',  
                            esc_html__('Wide','easybook-add-ons' ) => 'wide-container',  
                            esc_html__('Boxed','easybook-add-ons' ) => 'default-container',   
                            esc_html__('Small','easybook-add-ons' ) => 'small-container',
                        ),
            "std" => 'default-container',
            'dependency' => array(
                'element' => 'cth_layout',
                'value' => array( 'cth_hero_sec','cth_head_sec','cth_page_sec','cth_video_bg_sec'),
                'not_empty' => false,
            ),
            "group" => __( 'EasyBook Theme', 'easybook-add-ons' ),
        ),
        
        array(
                "type" => "dropdown",
                "heading" => esc_html__('Top/Bottom Padding', 'easybook-add-ons'),
                "param_name" => "cth_padding",
                "value" => array(   
                                esc_html__('No Padding', 'easybook-add-ons') => 'no-padding',                                                                               
                                esc_html__('Small Padding', 'easybook-add-ons') => 'small-padding',                                                                               
                                esc_html__('Medium Padding', 'easybook-add-ons') => 'medium-padding',                                                                               
                                esc_html__('Large Padding', 'easybook-add-ons') => 'large-padding',                                                                               
                                esc_html__('XLarge Padding', 'easybook-add-ons') => 'xlarge-padding',                                                                               
                            ),
                "std" => 'medium-padding',
                'dependency' => array(
                    'element' => 'cth_layout',
                    'value' => array( 'cth_hero_sec','cth_head_sec','cth_page_sec','cth_video_bg_sec' ),
                    'not_empty' => false,
                ),
               "group" => __( 'EasyBook Theme', 'easybook-add-ons' ),
            ) ,

            array(
                "type" => "dropdown",
                "heading" => esc_html__('Background Color', 'easybook-add-ons'),
                "param_name" => "cth_bg_color",
                "value" => array(   
                                esc_html__( 'Theme Color','easybook-add-ons' ) => 'color-bg',
                                esc_html__( 'White Color','easybook-add-ons' ) => 'white-color-bg',
                                esc_html__( 'Dark Color','easybook-add-ons' ) => 'dark-bg',
                                esc_html__( 'Gray Color','easybook-add-ons' ) => 'gray-bg',
                                esc_html__( 'Transparent Color','easybook-add-ons' ) => 'transparent-color-bg',
                            ),
                "std" => 'transparent-color-bg',
                'dependency' => array(
                    'element' => 'cth_layout',
                    'value' => array( 'cth_hero_sec','cth_head_sec','cth_page_sec','cth_video_bg_sec'),
                    'not_empty' => false,
                ),
                "group" => __( 'EasyBook Theme', 'easybook-add-ons' ),
            ) ,
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Color cover below the image', 'easybook-add-ons' ),
                'param_name' => 'cth_cover_color',
                'value'=>'',
                'dependency' => array(
                    'element' => 'cth_layout',
                    'value' => array( 'cth_hero_sec','cth_head_sec','cth_page_sec','cth_video_bg_sec'),
                    'not_empty' => false,
                ),

                "group" => __( 'EasyBook Theme', 'easybook-add-ons' ),
            ),
            array(
                "type" => "attach_image",
                "heading" => esc_html__('Parallax Background Image', 'easybook-add-ons'),
                "param_name" => "cth_parallax_bg",
                'dependency' => array(
                    'element' => 'cth_layout',
                    'value' => array('cth_hero_sec','cth_head_sec','cth_page_sec','cth_video_bg_sec'),
                    'not_empty' => false,
                ),
                "group" => __( 'EasyBook Theme', 'easybook-add-ons' ),
            ),
            array(
                "type"          => "textfield",
                // 'admin_label'   => true,
                "heading"       => esc_html__("Width Image", 'easybook-add-ons'),
                "param_name"    => "wt_bg_img",
                "value"         => "100%",
                'dependency' => array(
                    'element' => 'cth_parallax_bg',
                    'not_empty' => true,
                ),
                'edit_field_class' => 'vc_col-sm-3',
                "group" => __( 'EasyBook Theme', 'easybook-add-ons' ),
            ),
            array(
                "type"          => "textfield",
                // 'admin_label'   => true,
                "heading"       => esc_html__("Height Image", 'easybook-add-ons'),
                "param_name"    => "ht_bg_img",
                "value"         => "100%",
                'dependency' => array(
                    'element' => 'cth_parallax_bg',
                    'not_empty' => true,
                ),
                'edit_field_class' => 'vc_col-sm-3',
                "group" => __( 'EasyBook Theme', 'easybook-add-ons' ),
            ),

            array(        
                "type" => "dropdown",
                "heading" => esc_html__('Image Position', 'easybook-add-ons'),
                "param_name" => "cth_parallax_pos",
                "value" => array(   
                                esc_html__('Left','easybook-add-ons' ) => 'left',
                                esc_html__('Cover','easybook-add-ons' ) => 'cover',
                                esc_html__('Fixed','easybook-add-ons' ) => 'fixed',
                                esc_html__('Right','easybook-add-ons' ) => 'right',
                            ),
                "std" => 'cover',
                'dependency' => array(
                    'element' => 'cth_parallax_bg',
                    'not_empty' => true,
                ),
                'edit_field_class' => 'vc_col-sm-3',
                "group" => __( 'EasyBook Theme', 'easybook-add-ons' ),
            ) ,
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Image opacity', 'easybook-add-ons' ),
                'param_name' => 'cth_overlay_color',
                'value'=>   array(
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
                'dependency' => array(
                    'element' => 'cth_parallax_bg',
                    'not_empty' => true,
                ),
                "std"   => '0.5',
                'edit_field_class' => 'vc_col-sm-3',
                "group" => __( 'EasyBook Theme', 'easybook-add-ons' ),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__('Background Parallax Value', 'easybook-add-ons'),
                "param_name" => "cth_parallax_val",
                "value" => "'translateY': '200px'",
                "description" => esc_html__("Parallax CSS style values, separated by comma. Ex: 'translateX': '50px','translateY': '250px' ", 'easybook-add-ons').'<a href="'.esc_url('https://github.com/iprodev/Scrollax.js/blob/master/docs/Markup.md' ).'" target="_blank">'.esc_html__('Scrollax Documentation','easybook-add-ons' ).'</a>',
                'dependency' => array(
                    'element' => 'cth_parallax_bg',
                    'not_empty' => true,
                ),
                "group" => __( 'EasyBook Theme', 'easybook-add-ons' ),
            ) ,

             //====================
            array(
                                
                "type" => "dropdown",
                "heading" => esc_html__('Use Backgroud Videos', 'easybook-add-ons'),
                "param_name" => "use_bgvideo",
                "value" => array(   
                                esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                esc_html__('No', 'easybook-add-ons') => 'no',   
                            ),
                "std" => 'no',
                "group" => __( 'EasyBook Theme', 'easybook-add-ons' ),
            ) ,
             array(
                "type"          => "dropdown",
                // 'admin_label'   => true,
                "heading"       => esc_html__('Background Type', 'easybook-add-ons'),
                "param_name"    => "bg_type_videos",
                "value"         => array(   
                        esc_html__('Youtube Video', 'easybook-add-ons')=>'yt_video', 
                        esc_html__('Vimeo Video', 'easybook-add-ons')=>'vm_video', 
                        esc_html__('Hosted Video', 'easybook-add-ons')=>'ht_video',                                                                        
                ),
                "std"           => 'yt_video', 
                'dependency' => array(
                    'element' => 'use_bgvideo',
                    'value' => array( 'yes'),
                    'not_empty' => false,
                ),
                "group" => __( 'EasyBook Theme', 'easybook-add-ons' ),
            ),
            array(
                "type"          => "textfield",
                // 'admin_label'   => true,
                "heading"       => esc_html__(" Vimeo Video ID", 'easybook-add-ons'),
                "param_name"    => "video",
                "value"         => "Hg5iNVSp2z8",
                "description"   => esc_html__("Youtube or Vimeo Video ID. Ex: Hg5iNVSp2z8", 'easybook-add-ons'),
                'dependency' => array(
                    'element' => 'use_bgvideo',
                    'value' => array( 'yes'),
                    'not_empty' => false,
                ),
                "group" => __( 'EasyBook Theme', 'easybook-add-ons' ),
            ),
            array(
                    "type"          => "vc_link",
                    "holder"        => "div",
                    "heading"       => esc_html__("Youtube  Video URL ", 'easybook-add-ons'),
                    "param_name"    => "url_videos",
                    "value"         => "",
                    "description"   => "Youtube video URL",
                    'dependency' => array(
                        'element' => 'use_bgvideo',
                        'value' => array( 'yes'),
                        'not_empty' => false,
                    ),
                    "group" => __( 'EasyBook Theme', 'easybook-add-ons' ),
                ),
            array(
                    "type"          => "vc_link",
                    "holder"        => "div",
                    "heading"       => esc_html__("Hosted Video URL ", 'easybook-add-ons'),
                    "param_name"    => "url_video",
                    "value"         => "",
                    "description"   => "Your hosted video URL (should be in.mp4 format)",
                    'dependency' => array(
                        'element' => 'use_bgvideo',
                        'value' => array( 'yes'),
                        'not_empty' => false,
                    ),
                    "group" => __( 'EasyBook Theme', 'easybook-add-ons' ),
                ),

            // array(
            //     'type' => 'colorpicker',
            //     'heading' => esc_html__( 'Overlay Background Color', 'easybook-add-ons' ),
            //     'param_name' => 'cth_overlay_color',
            //     'value'=>'',
            //     'dependency' => array(
            //         'element' => 'cth_layout',
            //         'value' => array( 'cth_hero_sec','cth_head_sec','cth_page_sec','cth_video_bg_sec'),
            //         'not_empty' => false,
            //     ),

            //     "group" => __( 'EasyBook Theme', 'easybook-add-ons' ),
            // ),

            // array(
            //     "type"          => "attach_image",
            //     'admin_label'   => true,
            //     "heading"       => esc_html__("Top Background", 'easybook-add-ons'),
            //     "param_name"    => "decor_top_bg",
            //    'dependency' => array(
            //         'element' => 'cth_layout',
            //         'value' => array('cth_page_sec'),
            //         'not_empty' => false,
            //     ),
            //    "group" => __( 'EasyBook Theme', 'easybook-add-ons' ),
            // ),

            array(
                "type"          => "attach_image",
                'admin_label'   => true,
                "heading"       => esc_html__("Bottom Background", 'easybook-add-ons'),
                "param_name"    => "decor_bot_bg",
               'dependency' => array(
                    'element' => 'cth_layout',
                    'value' => array('cth_page_sec'),
                    'not_empty' => false,
                ),
               "group" => __( 'EasyBook Theme', 'easybook-add-ons' ),
            ),
            array(
                                
                "type" => "dropdown",
                "heading" => esc_html__('Use Bubble Decoration', 'easybook-add-ons'),
                "param_name" => "cth_bubble_canvas",
                "value" => array(   
                                esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                esc_html__('No', 'easybook-add-ons') => 'no',   
                                                                                                                
                            ),
                "std" => 'no',


               "group" => __( 'EasyBook Theme', 'easybook-add-ons' ),
            ) ,
            array(
                "type"          => "attach_image",
                'admin_label'   => true,
                "heading"       => esc_html__("Bottom Background", 'easybook-add-ons'),
                "param_name"    => "decor_bot_bg_hero",
                'dependency' => array(
                    'element' => 'cth_layout',
                    'value' => array('cth_hero_sec'),
                    'not_empty' => false,
                ),
               "group" => __( 'EasyBook Theme', 'easybook-add-ons' ),
            ),
            array(
                "type"          => "textfield",
                'admin_label'   => true,
                "heading"       => esc_html__("Scroll Section Link", 'easybook-add-ons'),
                "param_name"    => "sec_scroll_link",
                "value"         => "",
                // "description"   => esc_html__("Youtube or Vimeo Video ID. Ex: Hg5iNVSp2z8", 'easybook-add-ons'),
                'dependency' => array(
                    'element' => 'cth_layout',
                    'value' => array( 'cth_hero_sec'),
                    'not_empty' => false,
                ),
               "group" => __( 'EasyBook Theme', 'easybook-add-ons' ),
            ),

    );
    if(function_exists('vc_add_params'))
        vc_add_params('vc_row',$new_row_params);
}

add_action('init','easybook_add_ons_add_vc_param' );

// function easybook_add_ons_add_vc_param(){
//     if(function_exists('vc_set_shortcodes_templates_dir')) vc_set_shortcodes_templates_dir( ESB_ABSPATH.'vc_templates/' );

//     $new_row_params = array(
//         array(
//             "type" => "dropdown",
//             "heading" => esc_html__('EasyBook Predefined Section Layout', 'easybook-add-ons'),
//             "param_name" => "cth_layout",
//             "value" => array(   
//                         // esc_html__('Default', 'easybook-add-ons') => 'default',  
//                         // esc_html__('EasyBook Home (Fullheight) Section', 'easybook-add-ons') => 'easybook_homefullheight_sec',
//                         // esc_html__('EasyBook Page Header Section', 'easybook-add-ons') => 'easybook_head_sec',
//                         // esc_html__('EasyBook Page Section', 'easybook-add-ons') => 'easybook_page_sec',
//                         // esc_html__('EasyBook Background Video', 'easybook-add-ons') => 'easybook_video_bg_sec',
//                         esc_html__('Default', 'easybook-add-ons') => 'default',  
//                         esc_html__('Hero Section', 'easybook-add-ons') => 'cth_hero_sec',
//                         esc_html__('Page Header Section', 'easybook-add-ons') => 'cth_head_sec',
//                         esc_html__('Page Section', 'easybook-add-ons') => 'cth_page_sec',
//                         esc_html__('Background Video', 'easybook-add-ons') => 'cth_video_bg_sec',
//                     ),
//             "description" => esc_html__("Select one of the pre made page sections or using default", 'easybook-add-ons'), 
//             "group" => "EasyBook Theme",
//         ), 



//         array(                     
//             "type" => "dropdown",
//             "heading" => esc_html__('Content Width', 'easybook-add-ons'),
//             "param_name" => "cth_sec_width",
//             "value" => array(   
//                         // esc_html__('Fullwidth','easybook-add-ons' ) => 'yes',  
//                         // esc_html__('Wide Boxed','easybook-add-ons' ) => 'wide',  
//                         // esc_html__('Small Boxed','easybook-add-ons' ) => 'no',
//                         esc_html__('Fullwidth','easybook-add-ons' ) => 'full-container',  
//                         esc_html__('Wide','easybook-add-ons' ) => 'wide-container',  
//                         esc_html__('Boxed','easybook-add-ons' ) => 'default-container',   
//                         esc_html__('Small','easybook-add-ons' ) => 'small-container',       
//                     ),
//             "std" => 'no',
//             'dependency' => array(
//                 'element' => 'cth_layout',
//                 'value' => array( 'easybook_homefullheight_sec','easybook_head_sec','easybook_page_sec','easybook_video_bg_sec'),
//                 'not_empty' => false,
//             ),
//             "group" => "EasyBook Theme",
//         ),

//         array(                   
//             "type" => "dropdown",
//             "heading" => esc_html__('No Padding', 'easybook-add-ons'),
//             "param_name" => "cth_padding",
//             "value" => array(   
//                         // esc_html__('Yes', 'easybook-add-ons') => 'yes',  
//                         // esc_html__('No', 'easybook-add-ons') => 'no',
//                         esc_html__('No Padding', 'easybook-add-ons') => 'no-padding',                                                                               
//                         esc_html__('Small Padding', 'easybook-add-ons') => 'small-padding',                                                                               
//                         esc_html__('Medium Padding', 'easybook-add-ons') => 'medium-padding',                                                                               
//                         esc_html__('Large Padding', 'easybook-add-ons') => 'large-padding',                                                                               
//                         esc_html__('XLarge Padding', 'easybook-add-ons') => 'xlarge-padding' 
//                     ),
//             "std" => 'no',
//             'dependency' => array(
//                 'element' => 'cth_layout',
//                 'value' => array( 'easybook_page_sec','easybook_head_sec','easybook_video_bg_sec'),
//                 'not_empty' => false,
//             ),
//             "group" => "EasyBook Theme",
//         ), 

//         array(
//             "type" => "dropdown",
//             "heading" => esc_html__('Background Color', 'easybook-add-ons'),
//             "param_name" => "cth_bg_color",
//             "value" => array(   
//                         // esc_html__( 'Theme Color','easybook-add-ons' ) => 'color-bg',
//                         // esc_html__( 'White Color','easybook-add-ons' ) => 'white-color-bg',
//                         // esc_html__( 'Dark Color','easybook-add-ons' ) => 'dark-bg',
//                         // esc_html__( 'Gray Color','easybook-add-ons' ) => 'gray-bg',
//                         // esc_html__( 'Transparent Color','easybook-add-ons' ) => 'transparent-color-bg',
//                         esc_html__( 'Theme Color','easybook-add-ons' ) => 'color-bg',
//                         esc_html__( 'White Color','easybook-add-ons' ) => 'white-color-bg',
//                         esc_html__( 'Dark Color','easybook-add-ons' ) => 'dark-bg',
//                         esc_html__( 'Gray Color','easybook-add-ons' ) => 'gray-bg',
//                         esc_html__( 'Transparent Color','easybook-add-ons' ) => 'transparent-color-bg',
//                     ),
//             "std" => 'transparent-color-bg',
//             'dependency' => array(
//                 'element' => 'cth_layout',
//                 'value' => array( 'easybook_homefullheight_sec','easybook_head_sec','easybook_page_sec','easybook_video_bg_sec'),
//                 'not_empty' => false,
//             ),
//             "group" => "EasyBook Theme",  
//         ), 


//         array(                 
//             "type" => "dropdown",
//             "heading" => esc_html__('Background Video Type', 'easybook-add-ons'),
//             "param_name" => "bg_video_type",
//             "value" => array(   
//                        esc_html__('Youtube Video','easybook-add-ons' ) => 'youtube',  
//                        esc_html__('Vimeo Video','easybook-add-ons' ) => 'vimeo',  
//                        esc_html__('Hosted Video','easybook-add-ons' ) => 'hosted',  
//                     ),
//             "std" => 'hosted',
//             'dependency' => array(
//                 'element' => 'cth_layout',
//                 'value' => array('easybook_video_bg_sec'),
//                 'not_empty' => false,
//             ),
//             "group" => "EasyBook Theme",
//         ), 


//         array(
//             "type" => "textfield",
//             "heading" => esc_html__('Video URL', 'easybook-add-ons'),
//             "param_name" => "bg_video",
//             "value" => "",
//             "description" => esc_html__("Enter your Youtube, Vimeo video ID or URL for hosted video.", 'easybook-add-ons'),
//             'dependency' => array(
//                 'element' => 'cth_layout',
//                 'value'     => array('easybook_video_bg_sec'),
//                 'not_empty' => false,
//             ),
//             "group" => "EasyBook Theme",
//         ),


//         array(
//             "type"          => "dropdown",
//             "heading"       => esc_html__('Mute', 'easybook-add-ons'),
//             "param_name"    => "bg_video_mute",
//             "value"         => array(   
//                                 esc_html__('Yes', 'easybook-add-ons') => '1',  
//                                 esc_html__('No', 'easybook-add-ons') => '0',
//                             ),
//             "std"           =>"1",
//             'dependency' => array(
//                 'element' => 'bg_video',
//                 'not_empty' => true,
//             ),
//             "group" => "EasyBook Theme",  
//         ),

//         array(
//             "type"          => "dropdown",
//             "heading"       => esc_html__('Loop', 'easybook-add-ons'),
//             "param_name"    => "bg_video_loop",
//             "value"         => array(   
//                                     esc_html__('Yes', 'easybook-add-ons') => '1',  
//                                     esc_html__('No', 'easybook-add-ons') => '0',                                                                                
//                             ),
//             "std"           =>"1",
//             'dependency' => array(
//                 'element' => 'bg_video',
//                 'not_empty' => true,
//             ),
//             "group" => "EasyBook Theme",  
//         ),

//         array(
//             "type" => "attach_image",
//             "heading" => esc_html__('Parallax Background Image', 'easybook-add-ons'),
//             "param_name" => "parallax_inner",
//             'dependency' => array(
//                 'element' => 'cth_layout',
//                 'value' => array('easybook_homefullheight_sec','easybook_head_sec', 'easybook_page_sec','easybook_video_bg_sec'),
//                 'not_empty' => false,
//             ),
//             "group" => "EasyBook Theme",
//         ),


//         array(
//             'type' => 'colorpicker',
//             'heading' => esc_html__( 'Overlay Background Color', 'easybook-add-ons' ),
//             'param_name' => 'overlay_color',
//             'value'=>'rgba(0,0,0,1)',
//             'description' => esc_html__( 'Select custom background color color.', 'easybook-add-ons' ),
//             'dependency' => array(
//                 'element' => 'parallax_inner',
//                 'not_empty' => true,
//             ),

//             "group" => "EasyBook Theme",
//         ),

//         array(
//             "type" => "textfield",
//             "heading" => esc_html__('Background Parallax Value', 'easybook-add-ons'),
//             "param_name" => "parallax_inner_val",
//             "value" => "",
//             "description" => esc_html__("Parallax CSS style values, separated by comma. Ex: 'translateX': '50px','translateY': '250px' ", 'easybook-add-ons').'<a href="'.esc_url('https://github.com/iprodev/Scrollax.js/blob/master/docs/Markup.md' ).'" target="_blank">'.esc_html__('Scrollax Documentation','easybook-add-ons' ).'</a>',
//             'dependency' => array(
//                 'element' => 'parallax_inner',
//                 'not_empty' => true,
//             ),
//             "group" => "EasyBook Theme",
//         ),
//     );
        
//     if(function_exists('vc_add_params'))
//         vc_add_params('vc_row',$new_row_params);
// }

// add_action('init','easybook_add_ons_add_vc_param' );