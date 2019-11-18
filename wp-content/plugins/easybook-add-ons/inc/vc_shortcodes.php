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



function easybook_add_ons_register_vc_elements(){
    if(function_exists('vc_map')){
        vc_map( array(
        "name"                      => esc_html__("Home Slider", 'easybook-add-ons'),
        "description"               => esc_html__("Home Page Slider using swiper plugin",'easybook-add-ons'),
        "base"                      => "easybook_swiper",
        "category"                  => 'EasyBook Theme',
        "as_parent"                 => array('only' => 'easybook_swiper_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        "content_element"           => true,
        "show_settings_on_create"   => false,
        "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
        ////"html_template"             => EASYBOOK_ADD_ONS_DIR.'vc_templates/easybook_swiper.php',
        "params"                    => array(
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Speed", 'easybook-add-ons'),
                "param_name"    => "speed",
                "value"         =>'1000',
                "description"   => esc_html__("Duration of transition between slides (in ms). Default: 1000", 'easybook-add-ons')
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Direction', 'easybook-add-ons'),
                "param_name"    => "direction",
                "value"         => array(   
                                    esc_html__('Horizontal', 'easybook-add-ons') => 'horizontal',  
                                    esc_html__('Vertical', 'easybook-add-ons') => 'vertical',                                                                                
                                ),
                'std'           => 'horizontal'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Effect', 'easybook-add-ons'),
                "param_name"    => "effect",
                "value"         => array(   
                                    esc_html__('Slide', 'easybook-add-ons') => 'slide',  
                                    esc_html__('Fade', 'easybook-add-ons') => 'fade',                                                                                
                                    esc_html__('Cube', 'easybook-add-ons') => 'cube',                                                                                
                                    esc_html__('Coverflow', 'easybook-add-ons') => 'coverflow',                                                                                
                                    esc_html__('Flip', 'easybook-add-ons') => 'flip',                                                                                
                                ),
                'std'           => 'slide'
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Auto Play", 'easybook-add-ons'),
                "param_name"    => "autoplay",
                "description"   => esc_html__("Number in mili-second (5000), leave it blank to disable", 'easybook-add-ons'),
                'value'         => '5000'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Loop', 'easybook-add-ons'),
                "param_name"    => "loop",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no',  
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',                                                                                
                                ),
                "description"   => esc_html__("Set this to Yes to enable continuous loop mode", 'easybook-add-ons'), 
                'std'           =>'yes'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Show Navigation', 'easybook-add-ons'),
                "param_name"    => "show_nav",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                    esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                ),
                'std'           =>'yes'
            ),
            // array(
            //     "type"          => "dropdown",
            //     "class"         =>"",
            //     "heading"       => esc_html__('Show Progress', 'easybook-add-ons'),
            //     "param_name"    => "show_progress",
            //     "value"         => array(   
            //                         esc_html__('Yes', 'easybook-add-ons') => 'yes',  
            //                         esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
            //                     ),
            //     'std'           =>'yes'
            // ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Mouse Wheel Control', 'easybook-add-ons'),
                "param_name"    => "mousewheel",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                    esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                ),
                "description"   => esc_html__("Set this to Yes if you want to enable navigation through slides using mouse wheel", 'easybook-add-ons'), 
                'std'           =>'yes'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Keyboard Control', 'easybook-add-ons'),
                "param_name"    => "keyboard",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                    esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                ),
                "description"   => esc_html__("Set this to Yes if you want to enable navigation through slides using keyboard arrows", 'easybook-add-ons'), 
                'std'           =>'yes'
            ),
            
             
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Disable Image Zoom', 'easybook-add-ons'),
                "param_name"    => "disable_zoom",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no', 
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                                                                                                   
                                ),
                'std'           =>'no'
                
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Enable Gallery', 'easybook-add-ons'),
                "param_name"    => "enable_gallery",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no', 
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                                                                                                   
                                ),
                'std'           =>'yes',
                'dependency'    => array(
                    'element'   => 'disable_zoom',
                    'value'     => array('no'),
                    'not_empty' => false
                ),
                
            ),
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__('Show Fullscreen Button', 'easybook-add-ons'),
                "param_name"    => "show_fullscreen_toggle",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no', 
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                                                                                                   
                                ),
                'std'           =>'yes'
                
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
                "param_name"    => "el_class",
                "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
            ),

            array(
                'type'          => 'css_editor',
                'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
                'param_name'    => 'css',
                'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
            ),
            
        ),
        'admin_enqueue_js'      => EASYBOOK_ADD_ONS_DIR_URL . "inc/assets/easybook-elements.js",
        "js_view"               => 'VcColumnView'
    ));

    vc_map( array(
        "name"                      => esc_html__("Slide Item", 'easybook-add-ons'),
        "base"                      => "easybook_swiper_item",
        "content_element"           => true,
        "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
        ////"html_template"             => EASYBOOK_ADD_ONS_DIR.'vc_templates/easybook_swiper_item.php',
        "as_child"                  => array('only' => 'easybook_swiper'),
        "params"                    => array(
            array(
                "type"          => "attach_image",
                "holder"        => "div",
                "class"         => "ajax-vc-img",
                "heading"       => esc_html__("Slide Image", 'easybook-add-ons'),
                "param_name"    => "slideimg",
                "description"   => esc_html__("Slide Image", 'easybook-add-ons'),
                'value'         => '1351'
            ),
            array(
                "type"          => "textarea_html",
                //"holder"      => "div",
                "heading"       => esc_html__("Slide Content", 'easybook-add-ons'),
                "param_name"    => "content",
                "description"   => esc_html__("Slide Content", 'easybook-add-ons'),
                'value'         => '<h2>EasyBook Photography <br /> Studio</h2>
<div class="clearfix"></div>
<p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary .</p>
<div class="separator inline-sep sep-w"></div>
<div><a href="'.esc_url( home_url('/portfolio/' )).'" class="btn float-btn flat-btn">Our portfolio</a></div>'
            ),  
            array(
                "type"          => "textfield",
                "class"         => "",
                "heading"       => esc_html__("Overlay Opacity", 'easybook-add-ons'),
                "param_name"    => "opacity",
                "value"         => "0.3",
                "description"   => esc_html__("Overlay Opacity value 0.0 - 1. Default: 0.3", 'easybook-add-ons')
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
                "param_name"    => "el_class",
                "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
            ),
            array(
                'type'          => 'css_editor',
                'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
                'param_name'    => 'css',
                'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
            ),
            
            
        ),
            
        'js_view'               =>'EasyBookImagesView'
    ));

    //Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_EasyBook_Swiper extends WPBakeryShortCodesContainer {}
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_EasyBook_Swiper_Item extends WPBakeryShortCode {     
        }
    }

    vc_map( array(
        "name"                      => esc_html__("Home Slider", 'easybook-add-ons'),
        "description"               => esc_html__("with multi images selected",'easybook-add-ons'),
        "base"                      => "easybook_swiper_multiimgs",
        "category"                  => 'EasyBook Theme',
        
        "content_element"           => true,
        "show_settings_on_create"   => true,
        "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
        ////"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_swiper_multiimgs.php',
        "params"                    => array(
            array(
                "type"          => "attach_images",
                "holder"        => "div",
                "class"         => "ajax-vc-img",
                "heading"       => esc_html__("Slide Images", 'easybook-add-ons'),
                "param_name"    => "slideimages",
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Speed", 'easybook-add-ons'),
                "param_name"    => "speed",
                "value"         =>'1000',
                "description"   => esc_html__("Duration of transition between slides (in ms). Default: 1000", 'easybook-add-ons')
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Direction', 'easybook-add-ons'),
                "param_name"    => "direction",
                "value"         => array(   
                                    esc_html__('Horizontal', 'easybook-add-ons') => 'horizontal',  
                                    esc_html__('Vertical', 'easybook-add-ons') => 'vertical',                                                                                
                                ),
                'std'           => 'horizontal'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Effect', 'easybook-add-ons'),
                "param_name"    => "effect",
                "value"         => array(   
                                    esc_html__('Slide', 'easybook-add-ons') => 'slide',  
                                    esc_html__('Fade', 'easybook-add-ons') => 'fade',                                                                                
                                    esc_html__('Cube', 'easybook-add-ons') => 'cube',                                                                                
                                    esc_html__('Coverflow', 'easybook-add-ons') => 'coverflow',                                                                                
                                    esc_html__('Flip', 'easybook-add-ons') => 'flip',                                                                                
                                ),
                'std'           => 'slide'
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Auto Play", 'easybook-add-ons'),
                "param_name"    => "autoplay",
                "description"   => esc_html__("Number in mili-second (5000), leave it blank to disable", 'easybook-add-ons'),
                'value'         => '5000'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Loop', 'easybook-add-ons'),
                "param_name"    => "loop",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no',  
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',                                                                                
                                ),
                "description"   => esc_html__("Set this to Yes to enable continuous loop mode", 'easybook-add-ons'), 
                'std'           =>'yes'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Show Navigation', 'easybook-add-ons'),
                "param_name"    => "show_nav",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                    esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                ),
                'std'           =>'yes'
            ),
            // array(
            //     "type"          => "dropdown",
            //     "class"         =>"",
            //     "heading"       => esc_html__('Show Progress', 'easybook-add-ons'),
            //     "param_name"    => "show_progress",
            //     "value"         => array(   
            //                         esc_html__('Yes', 'easybook-add-ons') => 'yes',  
            //                         esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
            //                     ),
            //     'std'           =>'yes'
            // ),
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__('Show Fullscreen Button', 'easybook-add-ons'),
                "param_name"    => "show_fullscreen_toggle",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no', 
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                                                                                                   
                                ),
                'std'           =>'yes'
                
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Disable Image Zoom', 'easybook-add-ons'),
                "param_name"    => "disable_zoom",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no', 
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                                                                                                   
                                ),
                'std'           =>'no'
                
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Enable Gallery', 'easybook-add-ons'),
                "param_name"    => "enable_gallery",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no', 
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                                                                                                   
                                ),
                'std'           =>'yes',
                'dependency'    => array(
                    'element'   => 'disable_zoom',
                    'value'     => array('no'),
                    'not_empty' => false
                ),
                
            ),

            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Mouse Wheel Control', 'easybook-add-ons'),
                "param_name"    => "mousewheel",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                    esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                ),
                "description"   => esc_html__("Set this to Yes if you want to enable navigation through slides using mouse wheel", 'easybook-add-ons'), 
                'std'           =>'yes'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Keyboard Control', 'easybook-add-ons'),
                "param_name"    => "keyboard",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                    esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                ),
                "description"   => esc_html__("Set this to Yes if you want to enable navigation through slides using keyboard arrows", 'easybook-add-ons'), 
                'std'           =>'yes'
            ),
            
            array(
                "type"          => "textfield",
                "class"         => "",
                "heading"       => esc_html__("Overlay Opacity", 'easybook-add-ons'),
                "param_name"    => "opacity",
                "value"         => "0.3",
                "description"   => esc_html__("Overlay Opacity value 0.0 - 1. Default: 0.3", 'easybook-add-ons')
            ), 

            
            
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
                "param_name"    => "el_class",
                "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
            ),
            array(
                'type'          => 'css_editor',
                'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
                'param_name'    => 'css',
                'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
            ),
            
        ),
        'admin_enqueue_js'      => EASYBOOK_ADD_ONS_DIR_URL . "inc/assets/easybook-elements.js",
        'js_view'=> 'EasyBookImagesView',
    ));

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_EasyBook_Swiper_Multiimgs extends WPBakeryShortCode {}
    }

    vc_map( array(
        "name"                      => esc_html__("Home Image", 'easybook-add-ons'),
        "base"                      => "easybook_home_image",
        "content_element"           => true,
        "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
        ////"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_home_image.php',
        "category"                  => 'EasyBook Theme',
        "show_settings_on_create"   => true,
        "params"                    => array(
            array(
                "type"          => "attach_image",
                "holder"        => "div",
                "class"         => "ajax-vc-img",
                "heading"       => esc_html__("Background Image", 'easybook-add-ons'),
                "param_name"    => "bgimg",
                "description"   => esc_html__("Background image", 'easybook-add-ons'),
                "value"         => "1350"
            ),
            array(
                "type"          => "textarea_html",
                "holder"        => "div",
                "heading"       => esc_html__("Content", 'easybook-add-ons'),
                "param_name"    => "content",
                "value"         => '<h2>EasyBook Photography <br /> Studio</h2>
<div class="clearfix"></div>
<p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary .</p>
<div class="clearfix"></div>
<a href="'.esc_url(home_url('/portfolio/' )).'" class="btn float-btn flat-btn">Our portfolio</a>'
            ), 
             
            
            
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Overlay Opacity", 'easybook-add-ons'),
                "param_name"    => "opacity",
                "value"         => "0.3",
                "description"   => esc_html__("Overlay Opacity value 0.0 - 1. Default 0.3", 'easybook-add-ons')
            ),

            array(
                "type"          => "dropdown",
                "heading"       => esc_html__('Show Fullscreen Button', 'easybook-add-ons'),
                "param_name"    => "show_fullscreen_toggle",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no', 
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                                                                                                   
                                ),
                'std'           =>'yes'
                
            ),

            
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
                "param_name"    => "el_class",
                "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
            ),
            array(
                'type'          => 'css_editor',
                'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
                'param_name'    => 'css',
                'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
            ),
        ),
        'admin_enqueue_js'      => EASYBOOK_ADD_ONS_DIR_URL . "inc/assets/easybook-elements.js",
        'js_view'               => 'EasyBookImagesView',

    ));

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_EasyBook_Home_Image extends WPBakeryShortCode {}
    }

    vc_map( array(
        "name"                      => esc_html__("Home Youtube Video", 'easybook-add-ons'),
        "base"                      => "easybook_home_youtube_video",
        "content_element"           => true,
        "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
        ////"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_home_youtube_video.php',
        "category"                  => 'EasyBook Theme',
        "show_settings_on_create"   => true,
        "params"                    => array(
            array(
                "type"          => "textarea_html",
                "holder"        => "div",
                "heading"       => esc_html__("Content", 'easybook-add-ons'),
                "param_name"    => "content",
                "value"         => '<h2>EasyBook Photography <br /> Studio</h2>
<div class="clearfix"></div>
<p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary .</p>
<div class="clearfix"></div>
<a href="'.esc_url(home_url('/portfolio/' )).'" class="btn float-btn flat-btn">Our portfolio</a>'
            ), 

            array(
                "type"          => "textfield",
                "class"         => "",
                "heading"       => esc_html__("Your Youtube Video ID", 'easybook-add-ons'),
                "param_name"    => "video",
                "value"         => "Hg5iNVSp2z8",
                "description"   => esc_html__("Your Youtube Video ID. Ex: Hg5iNVSp2z8", 'easybook-add-ons')
            ),
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__('Loop', 'easybook-add-ons'),
                "param_name"    => "loop",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => '1',  
                                    esc_html__('No', 'easybook-add-ons') => '0',                                                                                
                ),
                "std"           =>"1"
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Video Quality', 'easybook-add-ons'),
                "param_name"    => "quality",
                "value"         => array(   
                                    esc_html__( 'Default' , 'easybook-add-ons' )  => 'default',  
                                    esc_html__( 'Small' , 'easybook-add-ons' )    => 'small',  
                                    esc_html__( 'Medium' , 'easybook-add-ons' )   => 'medium',  
                                    esc_html__( 'Large' , 'easybook-add-ons' )    => 'large',  
                                    esc_html__( 'HD720' , 'easybook-add-ons' )    => 'hd720',  
                                    esc_html__( 'HD1080' , 'easybook-add-ons' )   => 'hd1080',  
                                    esc_html__( 'Highres' , 'easybook-add-ons' )  => 'highres',                                                                           
                ),
                "std"           => 'highres', 
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Mute', 'easybook-add-ons'),
                "param_name"    => "mute",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => '1',  
                                    esc_html__('No', 'easybook-add-ons') => '0',                                                                                
                ),
                "std"           =>"1"
            ),

            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Fit to Background', 'easybook-add-ons'),
                "param_name"    => "fittobackground",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => '1',  
                                    esc_html__('No', 'easybook-add-ons') => '0',                                                                                
                                ),
                "std"           => '1', 
                "description"   => esc_html__("Fits to background vs fitting to the container specified with width", 'easybook-add-ons'),
            ),
            
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Pause on scroll', 'easybook-add-ons'),
                "param_name"    => "pauseonscroll",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => '1',  
                                    esc_html__('No', 'easybook-add-ons') => '0',                                                                                
                                ),
                "std"           => '0', 
            ),
            array(
                "type"          => "attach_image",
                "holder"        => "div",
                "class"         => "ajax-vc-img",
                "heading"       => esc_html__("Background Image", 'easybook-add-ons'),
                "param_name"    => "bgimg",
                "description"   => esc_html__("Background image", 'easybook-add-ons'),
                "value"         => "1350"
            ),

            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Overlay Opacity", 'easybook-add-ons'),
                "param_name"    => "opacity",
                "value"         => "0.3",
                "description"   => esc_html__("Overlay Opacity value 0.0 - 1. Default 0.3", 'easybook-add-ons')
            ),

            

            array(
                "type"          => "dropdown",
                "heading"       => esc_html__('Show Fullscreen Button', 'easybook-add-ons'),
                "param_name"    => "show_fullscreen_toggle",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no', 
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                                                                                                   
                                ),
                'std'           =>'yes'
                
            ),

            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
                "param_name"    => "el_class",
                "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
            ),
            array(
                'type'          => 'css_editor',
                'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
                'param_name'    => 'css',
                'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
            ),
        ),
        'admin_enqueue_js'      => EASYBOOK_ADD_ONS_DIR_URL . "inc/assets/easybook-elements.js",
        'js_view'               => 'EasyBookImagesView',
    ));

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_EasyBook_Home_Youtube_Video extends WPBakeryShortCode {     
        }
    }

    vc_map( array(
        "name"                      => esc_html__("Home Vimeo Video", 'easybook-add-ons'),
        "base"                      => "easybook_home_vimeo_video",
        "content_element"           => true,
        "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
        ////"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_home_vimeo_video.php',
        "category"                  => 'EasyBook Theme',
        "show_settings_on_create"   => true,
        "params"                    => array(
            array(
                "type"          => "textarea_html",
                "holder"        => "div",
                "heading"       => esc_html__("Content", 'easybook-add-ons'),
                "param_name"    => "content",
                "value"         => '<h2>EasyBook Photography <br /> Studio</h2>
<div class="clearfix"></div>
<p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary .</p>
<div class="clearfix"></div>
<a href="'.esc_url(home_url('/portfolio/' )).'" class="btn float-btn flat-btn">Our portfolio</a>'
            ),   
             
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Your Vimeo Video ID", 'easybook-add-ons'),
                "param_name"    => "video",
                "value"         => "97871257",
                "description"   => esc_html__("Your Vimeo Video ID: 97871257", 'easybook-add-ons')
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Video Quality', 'easybook-add-ons'),
                "param_name"    => "quality",
                "value"         => array(   
                                    esc_html__( '4K' , 'easybook-add-ons' )       => '4K',  
                                    esc_html__( '2K' , 'easybook-add-ons' )       => '2K',  
                                    esc_html__( '1080P' , 'easybook-add-ons' )    => '1080p',  
                                    esc_html__( '720P' , 'easybook-add-ons' )     => '720p',  
                                    esc_html__( '540P' , 'easybook-add-ons' )     => '540p',  
                                    esc_html__( '360P' , 'easybook-add-ons' )     => '360p',                                                                            
                ),
                "std"           => '1080p', 
            ),
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__('Mute', 'easybook-add-ons'),
                "param_name"    => "mute",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => '1',  
                                    esc_html__('No', 'easybook-add-ons') => '0',                                                                                
                ),
                "std"           =>"1"
            ),

            array(
                "type"          => "dropdown",
                "heading"       => esc_html__('Loop', 'easybook-add-ons'),
                "param_name"    => "loop",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => '1',  
                                    esc_html__('No', 'easybook-add-ons') => '0',                                                                                
                ),
                "std"           =>"1"
            ),
            
            array(
                "type"          => "attach_image",
                "holder"        => "div",
                "class"         => "ajax-vc-img",
                "heading"       => esc_html__("Background Image", 'easybook-add-ons'),
                "param_name"    => "bgimg",
                "description"   => esc_html__("Background image", 'easybook-add-ons'),
                "value"         => "1350"
            ),

            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Overlay Opacity", 'easybook-add-ons'),
                "param_name"    => "opacity",
                "value"         => "0.3",
                "description"   => esc_html__("Overlay Opacity value 0.0 - 1. Default 0.3", 'easybook-add-ons')
            ),

            

            array(
                "type"          => "dropdown",
                "heading"       => esc_html__('Show Fullscreen Button', 'easybook-add-ons'),
                "param_name"    => "show_fullscreen_toggle",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no', 
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                                                                                                   
                                ),
                'std'           =>'yes'
                
            ),

            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
                "param_name"    => "el_class",
                "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
            ),
            array(
                'type'          => 'css_editor',
                'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
                'param_name'    => 'css',
                'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
            ),
        ),
        'admin_enqueue_js'      => EASYBOOK_ADD_ONS_DIR_URL . "inc/assets/easybook-elements.js",
        'js_view'               => 'EasyBookImagesView',
    ));

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_EasyBook_Home_Vimeo_Video extends WPBakeryShortCode {     
        }
    }

    vc_map( array(
        "name"                      => esc_html__("Home Hosted Video", 'easybook-add-ons'),
        "base"                      => "easybook_home_video",
        "content_element"           => true,
        "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
        ////"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_home_video.php',
        "category"                  => 'EasyBook Theme',
        "show_settings_on_create"   => true,
        "params"                    => array(
            array(
                "type"          => "textarea_html",
                "holder"        => "div",
                "heading"       => esc_html__("Content", 'easybook-add-ons'),
                "param_name"    => "content",
                "value"         => '<h2>EasyBook Photography <br /> Studio</h2>
<div class="clearfix"></div>
<p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary .</p>
<div class="clearfix"></div>
<a href="'.esc_url(home_url('/portfolio/' )).'" class="btn float-btn flat-btn">Our portfolio</a>'
            ), 
             
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Your Video URL", 'easybook-add-ons'),
                "param_name"    => "video",
                "value"         => esc_url( home_url( '/wp-content/uploads/2017/09/1.mp4' ) ),
                "description"   => esc_html__("Your video file have to be in .mp4 format.", 'easybook-add-ons')
            ),
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__('Mute', 'easybook-add-ons'),
                "param_name"    => "mute",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => '1',  
                                    esc_html__('No', 'easybook-add-ons') => '0',                                                                                
                ),
                "std"           =>"1"
            ),

            array(
                "type"          => "dropdown",
                "heading"       => esc_html__('Loop', 'easybook-add-ons'),
                "param_name"    => "loop",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => '1',  
                                    esc_html__('No', 'easybook-add-ons') => '0',                                                                                
                ),
                "std"           =>"1"
            ),
            
            array(
                "type"          => "attach_image",
                "holder"        => "div",
                "class"         => "ajax-vc-img",
                "heading"       => esc_html__("Background Image", 'easybook-add-ons'),
                "param_name"    => "bgimg",
                "description"   => esc_html__("Background image", 'easybook-add-ons'),
                "value"         => "1350"
            ),

            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Overlay Opacity", 'easybook-add-ons'),
                "param_name"    => "opacity",
                "value"         => "0.3",
                "description"   => esc_html__("Overlay Opacity value 0.0 - 1. Default 0.3", 'easybook-add-ons')
            ),

            

            array(
                "type"          => "dropdown",
                "heading"       => esc_html__('Show Fullscreen Button', 'easybook-add-ons'),
                "param_name"    => "show_fullscreen_toggle",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no', 
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                                                                                                   
                                ),
                'std'           =>'yes'
                
            ),

            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
                "param_name"    => "el_class",
                "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
            ),
            array(
                'type'          => 'css_editor',
                'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
                'param_name'    => 'css',
                'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
            ),
        ),
        'admin_enqueue_js'      => EASYBOOK_ADD_ONS_DIR_URL . "inc/assets/easybook-elements.js",
        'js_view'               => 'EasyBookImagesView',
    ));

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_EasyBook_Home_Video extends WPBakeryShortCode {     
        }
    }

    vc_map( array(
       "name"                       => esc_html__("Home Slideshow", 'easybook-add-ons'),
       "base"                       => "easybook_home_slideshow",
       "class"                      => "",
       "icon"                       => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
        ////"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_home_slideshow.php',
       "category"                   => 'EasyBook Theme',
       "show_settings_on_create"    => true,
       "params"                     => array(
            
            array(
                "type"          => "textarea_html",
                "holder"        => "div",
                "heading"       => esc_html__("Content", 'easybook-add-ons'),
                "param_name"    => "content",
                "value"         => '<h2>EasyBook Photography <br /> Studio</h2>
<div class="clearfix"></div>
<p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary .</p>
<div class="clearfix"></div>
<a href="'.esc_url(home_url('/portfolio/' )).'" class="btn float-btn flat-btn">Our portfolio</a>'
            ),

            array(
                "type"          => "attach_images",
                "holder"        => "div",
                "class"         => "ajax-vc-img",
                "heading"       => esc_html__("Background Images", 'easybook-add-ons'),
                "param_name"    => "slideimgs",
                "description"   => esc_html__("Background slideshow images", 'easybook-add-ons'),
                "value"         => "1356,1360,1352,1350"
            ),

            array(
                "type"          => "dropdown",
                "heading"       => esc_html__('Kenburns Effect', 'easybook-add-ons'),
                "param_name"    => "use_kenburns",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no',  
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',                                                                                
                                ),
                
                'std'           =>'no'
            ),

            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Speed", 'easybook-add-ons'),
                "param_name"    => "speed",
                "value"         =>'1000',
                "description"   => esc_html__("Duration of transition between slides (in ms). Default: 1000", 'easybook-add-ons')
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Direction', 'easybook-add-ons'),
                "param_name"    => "direction",
                "value"         => array(   
                                    esc_html__('Horizontal', 'easybook-add-ons') => 'horizontal',  
                                    esc_html__('Vertical', 'easybook-add-ons') => 'vertical',                                                                                
                                ),
                'std'           => 'horizontal'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Effect', 'easybook-add-ons'),
                "param_name"    => "effect",
                "value"         => array(   
                                    esc_html__('Slide', 'easybook-add-ons') => 'slide',  
                                    esc_html__('Fade', 'easybook-add-ons') => 'fade',                                                                                
                                    esc_html__('Cube', 'easybook-add-ons') => 'cube',                                                                                
                                    esc_html__('Coverflow', 'easybook-add-ons') => 'coverflow',                                                                                
                                    esc_html__('Flip', 'easybook-add-ons') => 'flip',                                                                                
                                ),
                'std'           => 'fade'
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Auto Play", 'easybook-add-ons'),
                "param_name"    => "autoplay",
                "description"   => esc_html__("Number in mili-second (5000), leave it blank to disable", 'easybook-add-ons'),
                'value'         => '5000'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Loop', 'easybook-add-ons'),
                "param_name"    => "loop",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no',  
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',                                                                                
                                ),
                "description"   => esc_html__("Set this to Yes to enable continuous loop mode", 'easybook-add-ons'), 
                'std'           =>'yes'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Show Progress', 'easybook-add-ons'),
                "param_name"    => "show_progress",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                    esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                ),
                'std'           =>'yes'
            ),
            // array(
            //     "type"          => "dropdown",
            //     "class"         =>"",
            //     "heading"       => esc_html__('Mouse Wheel Control', 'easybook-add-ons'),
            //     "param_name"    => "mousewheel",
            //     "value"         => array(   
            //                         esc_html__('Yes', 'easybook-add-ons') => 'yes',  
            //                         esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
            //                     ),
            //     "description"   => esc_html__("Set this to Yes if you want to enable navigation through slides using mouse wheel", 'easybook-add-ons'), 
            //     'std'           =>'no'
            // ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Keyboard Control', 'easybook-add-ons'),
                "param_name"    => "keyboard",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                    esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                ),
                "description"   => esc_html__("Set this to Yes if you want to enable navigation through slides using keyboard arrows", 'easybook-add-ons'), 
                'std'           =>'yes'
            ),
            
            array(
                "type"          => "textfield",
                "class"         => "",
                "heading"       => esc_html__("Overlay Opacity", 'easybook-add-ons'),
                "param_name"    => "opacity",
                "value"         => "0.2",
                "description"   => esc_html__("Overlay Opacity value 0.0 - 1. Default: 0.3", 'easybook-add-ons')
            ), 

            array(
                "type"          => "dropdown",
                "heading"       => esc_html__('Show Fullscreen Button', 'easybook-add-ons'),
                "param_name"    => "show_fullscreen_toggle",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no', 
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                                                                                                   
                                ),
                'std'           =>'yes'
                
            ),

            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
                "param_name"    => "el_class",
                "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
            ),
            array(
                'type'          => 'css_editor',
                'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
                'param_name'    => 'css',
                'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
            ),
            
        ),
        'admin_enqueue_js'      => EASYBOOK_ADD_ONS_DIR_URL . "inc/assets/easybook-elements.js",
        'js_view'               => 'EasyBookImagesView',
    ));
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_EasyBook_Home_Slideshow extends WPBakeryShortCode {}
    }

    vc_map( array(
        "name"                      => esc_html__("Home Carousel", 'easybook-add-ons'),
        "description"               => esc_html__("Home carousel using swiper plugin",'easybook-add-ons'),
        "base"                      => "easybook_carousel",
        "category"                  => 'EasyBook Theme',
        "as_parent"                 => array('only' => 'easybook_carousel_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        "content_element"           => true,
        "show_settings_on_create"   => false,
        "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
        ////"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_carousel.php',
        "params"                    => array(
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Speed", 'easybook-add-ons'),
                "param_name"    => "speed",
                "value"         =>'1000',
                "description"   => esc_html__("Duration of transition between slides (in ms). Default: 1000", 'easybook-add-ons')
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Direction', 'easybook-add-ons'),
                "param_name"    => "direction",
                "value"         => array(   
                                    esc_html__('Horizontal', 'easybook-add-ons') => 'horizontal',  
                                    esc_html__('Vertical', 'easybook-add-ons') => 'vertical',                                                                                
                                ),
                'std'           => 'horizontal'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Effect', 'easybook-add-ons'),
                "param_name"    => "effect",
                "value"         => array(   
                                    esc_html__('Slide', 'easybook-add-ons') => 'slide',  
                                    esc_html__('Fade', 'easybook-add-ons') => 'fade',                                                                                
                                    esc_html__('Cube', 'easybook-add-ons') => 'cube',                                                                                
                                    esc_html__('Coverflow', 'easybook-add-ons') => 'coverflow',                                                                                
                                    esc_html__('Flip', 'easybook-add-ons') => 'flip',                                                                                
                                ),
                'std'           => 'slide'
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Auto Play", 'easybook-add-ons'),
                "param_name"    => "autoplay",
                "description"   => esc_html__("Number in mili-second (5000), leave it blank to disable", 'easybook-add-ons'),
                'value'         => ''
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Free Mode', 'easybook-add-ons'),
                "param_name"    => "free_mode",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no',  
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',                                                                                
                                ),
                "description"   => esc_html__("Slides will not have fixed positions", 'easybook-add-ons'), 
                'std'           =>'yes'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Center Mode', 'easybook-add-ons'),
                "param_name"    => "centre_mode",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no',  
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',                                                                                
                                ),
                "description"   => esc_html__("Active slide will be centered", 'easybook-add-ons'), 
                'std'           =>'no'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Loop', 'easybook-add-ons'),
                "param_name"    => "loop",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no',  
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',                                                                                
                                ),
                "description"   => esc_html__("Set this to Yes to enable continuous loop mode", 'easybook-add-ons'), 
                'std'           =>'no'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Show Navigation', 'easybook-add-ons'),
                "param_name"    => "show_nav",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                    esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                ),
                'std'           =>'yes'
            ),

            array(
                "type"          => "dropdown",
                "heading"       => esc_html__('Show Fullscreen Button', 'easybook-add-ons'),
                "param_name"    => "show_fullscreen_toggle",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no', 
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                                                                                                   
                                ),
                'std'           =>'yes'
                
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Disable Image Zoom', 'easybook-add-ons'),
                "param_name"    => "disable_zoom",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no', 
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                                                                                                   
                                ),
                'std'           =>'no'
                
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Enable Gallery', 'easybook-add-ons'),
                "param_name"    => "enable_gallery",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no', 
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                                                                                                   
                                ),
                'std'           =>'yes',
                'dependency'    => array(
                    'element'   => 'disable_zoom',
                    'value'     => array('no'),
                    'not_empty' => false
                ),
                
            ),
            
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Mouse Wheel Control', 'easybook-add-ons'),
                "param_name"    => "mousewheel",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                    esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                ),
                "description"   => esc_html__("Set this to Yes if you want to enable navigation through slides using mouse wheel", 'easybook-add-ons'), 
                'std'           =>'yes'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Keyboard Control', 'easybook-add-ons'),
                "param_name"    => "keyboard",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                    esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                ),
                "description"   => esc_html__("Set this to Yes if you want to enable navigation through slides using keyboard arrows", 'easybook-add-ons'), 
                'std'           =>'yes'
            ),
            
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Show Info', 'easybook-add-ons'),
                "param_name"    => "folio_item_style",
                "value"         => array(   
                                    esc_html__( 'Show on Image', 'easybook-add-ons' ) => 'default-thumb-info',  
                                    esc_html__( 'Show on hover', 'easybook-add-ons' ) => 'hid-det-items',                                                                              
                                    esc_html__( 'Bellow Thumbnail', 'easybook-add-ons' ) => 'vis-thumb-info',                                                                              
                                ),
                
                'std'           =>'default-thumb-info'
            ),
            
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
                "param_name"    => "el_class",
                "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
            ),

            array(
                'type'          => 'css_editor',
                'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
                'param_name'    => 'css',
                'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
            ),
            
        ),
        'admin_enqueue_js'      => EASYBOOK_ADD_ONS_DIR_URL . "inc/assets/easybook-elements.js",
        "js_view"               => 'VcColumnView'
    ));

    vc_map( array(
        "name"                      => esc_html__("Slide Item", 'easybook-add-ons'),
        "base"                      => "easybook_carousel_item",
        "content_element"           => true,
        "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
        ////"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_carousel_item.php',
        "as_child"                  => array('only' => 'easybook_carousel'),
        "params"                    => array(
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Slide Type', 'easybook-add-ons'),
                "param_name"    => "slide_type",
                "value"         => array(   
                                    esc_html__('Normal', 'easybook-add-ons') => 'normal',  
                                    esc_html__('Intro', 'easybook-add-ons') => 'intro',                                                                                
                                ),
                
                'std'           =>'normal'
            ),
            array(
                "type"          => "attach_image",
                "holder"        => "div",
                "class"         => "ajax-vc-img",
                "heading"       => esc_html__("Slide Image", 'easybook-add-ons'),
                "param_name"    => "slideimg",
                "description"   => esc_html__("Slide Image", 'easybook-add-ons'),
                'value'         => '1381'
            ),
            array(
                "type"          => "textarea_html",
                //"holder"      => "div",
                "heading"       => esc_html__("Slide Content", 'easybook-add-ons'),
                "param_name"    => "content",
                "description"   => esc_html__("Slide Content", 'easybook-add-ons'),
                'value'         => '<h3><a href="'.esc_url( home_url('/portfolio/new-acropolis-museum/' )).'">New Acropolis <br /> Museum</a></h3>
<p>Here you can place an optional description of your  Project</p>
<div><a href="'.esc_url( home_url('/portfolio/new-acropolis-museum/' )).'" class="btn float-btn flat-btn">View Project</a></div>'
            ),  
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
                "param_name"    => "el_class",
                "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
            ),
            array(
                'type'          => 'css_editor',
                'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
                'param_name'    => 'css',
                'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
            ),
            
            
        ),
            
        'js_view'               =>'EasyBookImagesView'
    ));

    //Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_EasyBook_Carousel extends WPBakeryShortCodesContainer {}
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_EasyBook_Carousel_Item extends WPBakeryShortCode {     
        }
    }

    vc_map( array(
        "name"                      => esc_html__("Home Carousel", 'easybook-add-ons'),
        "description"               => esc_html__("with multi images selection",'easybook-add-ons'),
        "base"                      => "easybook_carousel_multiimgs",
        "category"                  => 'EasyBook Theme',
        "content_element"           => true,
        "show_settings_on_create"   => true,
        "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
        ////"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_carousel_multiimgs.php',
        "params"                    => array(
            array(
                "type"          => "attach_images",
                "holder"        => "div",
                "class"         => "ajax-vc-img",
                "heading"       => esc_html__("Slide Images", 'easybook-add-ons'),
                "param_name"    => "slideimages",
                "value"         => '1381,1382,1383,1384,1387,1385,1386'
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Speed", 'easybook-add-ons'),
                "param_name"    => "speed",
                "value"         =>'1000',
                "description"   => esc_html__("Duration of transition between slides (in ms). Default: 1000", 'easybook-add-ons')
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Direction', 'easybook-add-ons'),
                "param_name"    => "direction",
                "value"         => array(   
                                    esc_html__('Horizontal', 'easybook-add-ons') => 'horizontal',  
                                    esc_html__('Vertical', 'easybook-add-ons') => 'vertical',                                                                                
                                ),
                'std'           => 'horizontal'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Effect', 'easybook-add-ons'),
                "param_name"    => "effect",
                "value"         => array(   
                                    esc_html__('Slide', 'easybook-add-ons') => 'slide',  
                                    esc_html__('Fade', 'easybook-add-ons') => 'fade',                                                                                
                                    esc_html__('Cube', 'easybook-add-ons') => 'cube',                                                                                
                                    esc_html__('Coverflow', 'easybook-add-ons') => 'coverflow',                                                                                
                                    esc_html__('Flip', 'easybook-add-ons') => 'flip',                                                                                
                                ),
                'std'           => 'slide'
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Auto Play", 'easybook-add-ons'),
                "param_name"    => "autoplay",
                "description"   => esc_html__("Number in mili-second (5000), leave it blank to disable", 'easybook-add-ons'),
                'value'         => ''
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Free Mode', 'easybook-add-ons'),
                "param_name"    => "free_mode",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no',  
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',                                                                                
                                ),
                "description"   => esc_html__("Slides will not have fixed positions", 'easybook-add-ons'), 
                'std'           =>'yes'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Center Mode', 'easybook-add-ons'),
                "param_name"    => "centre_mode",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no',  
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',                                                                                
                                ),
                "description"   => esc_html__("Active slide will be centered", 'easybook-add-ons'), 
                'std'           =>'no'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Loop', 'easybook-add-ons'),
                "param_name"    => "loop",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no',  
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',                                                                                
                                ),
                "description"   => esc_html__("Set this to Yes to enable continuous loop mode", 'easybook-add-ons'), 
                'std'           =>'no'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Show Navigation', 'easybook-add-ons'),
                "param_name"    => "show_nav",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                    esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                ),
                'std'           =>'yes'
            ),

            array(
                "type"          => "dropdown",
                "heading"       => esc_html__('Show Fullscreen Button', 'easybook-add-ons'),
                "param_name"    => "show_fullscreen_toggle",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no', 
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                                                                                                   
                                ),
                'std'           =>'yes'
                
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Disable Image Zoom', 'easybook-add-ons'),
                "param_name"    => "disable_zoom",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no', 
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                                                                                                   
                                ),
                'std'           =>'no'
                
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Enable Gallery', 'easybook-add-ons'),
                "param_name"    => "enable_gallery",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no', 
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                                                                                                   
                                ),
                'std'           =>'yes',
                'dependency'    => array(
                    'element'   => 'disable_zoom',
                    'value'     => array('no'),
                    'not_empty' => false
                ),
                
            ),
            
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Mouse Wheel Control', 'easybook-add-ons'),
                "param_name"    => "mousewheel",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                    esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                ),
                "description"   => esc_html__("Set this to Yes if you want to enable navigation through slides using mouse wheel", 'easybook-add-ons'), 
                'std'           =>'yes'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Keyboard Control', 'easybook-add-ons'),
                "param_name"    => "keyboard",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                    esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                ),
                "description"   => esc_html__("Set this to Yes if you want to enable navigation through slides using keyboard arrows", 'easybook-add-ons'), 
                'std'           =>'yes'
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
                "param_name"    => "el_class",
                "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
            ),

            array(
                'type'          => 'css_editor',
                'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
                'param_name'    => 'css',
                'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
            ),
            
        ),
        'admin_enqueue_js'      => EASYBOOK_ADD_ONS_DIR_URL . "inc/assets/easybook-elements.js",
        'js_view'=> 'EasyBookImagesView',
    ));

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_EasyBook_Carousel_Multiimgs extends WPBakeryShortCode {}
    }

    vc_map( array(
        "name"                      => esc_html__("Portfolios Carousel", 'easybook-add-ons'),
        "description"               => esc_html__("Carousel slider of portfolio items",'easybook-add-ons'),
        "base"                      => "easybook_portfolios_carousel",
        "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
        ////"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_portfolios_carousel.php',
        "category"                  => 'EasyBook Portfolio',
        "show_settings_on_create"   => true,
        "params"                    => array(
            array(
                "type"          => "textarea_html",
                "holder"        => "div",
                "heading"       => esc_html__("Intro slide content", 'easybook-add-ons'),
                "param_name"    => "content",
                'value'         => '<h2>Our Portfolio</h2>
<h3>Integer dictum</h3>
<div class="separator sep-b"></div>
<div class="clearfix"></div>
<div><a href="'.esc_url( home_url('/portfolio/' )).'" class="btn">View Portfolio</a></div>'
            ),  
        
            array(
                "type"          => "textfield", 
                "heading"       => esc_html__("Portfolio Category IDs to exclude", 'easybook-add-ons'), 
                "param_name"    => "cat_ids", 
                "description"   => esc_html__("Enter portfolio category ids to exclude, separated by a comma. Leave empty to display all categories.", 'easybook-add-ons'),
                "value"         => '',
            ), 
            array(
                "type"          => "dropdown", 
                "class"         => "", 
                "heading"       => esc_html__('Order Portfolio Categories by', 'easybook-add-ons'), 
                "param_name"    => "cat_order_by", 
                "value"         => array(
                    esc_html__('Name', 'easybook-add-ons')    => 'name', 
                    esc_html__('ID', 'easybook-add-ons')      => 'id', 
                    esc_html__('Count', 'easybook-add-ons')   => 'count', 
                    esc_html__('Slug', 'easybook-add-ons')    => 'slug', 
                    esc_html__('None', 'easybook-add-ons')    => 'none',
                ), 
                "std"           => 'name',
            ), 
            array(
                "type"          => "dropdown", 
                "class"         => "", 
                "heading"       => esc_html__('Sort Order', 'easybook-add-ons'), 
                "param_name"    => "cat_order", 
                "value"         => array(
                    esc_html__('Ascending', 'easybook-add-ons')   => 'ASC',
                    esc_html__('Descending', 'easybook-add-ons')  => 'DESC', 
                    
                ), 
                "std"           => 'ASC',
            ), 
            array(
                "type"          => "dropdown", 
                "class"         => "", 
                "heading"       => esc_html__('Show Filter', 'easybook-add-ons'), 
                "param_name"    => "show_filter", 
                "value"         => array(
                    esc_html__('Yes', 'easybook-add-ons')     => 'yes', 
                    esc_html__('No', 'easybook-add-ons')      => 'no', 
                ),  
                "std"           => 'no',
            ),
            
            array(
                "type"          => "textfield", 
                "holder"        => "div",
                "heading"       => esc_html__("Enter Portfolio IDs", 'easybook-add-ons'), 
                "param_name"    => "ids", 
                "description"   => esc_html__("Enter portfolio ids to show, separated by a comma.", 'easybook-add-ons')
            ), 
            array(
                "type"          => "textfield", 
                "heading"       => esc_html__("Portfolio IDs to Exclude", 'easybook-add-ons'), 
                "param_name"    => "ids_not", 
                "description"   => esc_html__("Enter portfolio ids to exclude, separated by a comma. Use if the field above is empty. Leave empty to get all.", 'easybook-add-ons')
            ), 
            array(
                "type"          => "dropdown", 
                "class"         => "", 
                "heading"       => esc_html__('Order Portfolios by', 'easybook-add-ons'), 
                "param_name"    => "order_by", 
                "value"         => array(
                                    esc_html__('Date', 'easybook-add-ons') => 'date', 
                                    esc_html__('ID', 'easybook-add-ons') => 'ID', 
                                    esc_html__('Author', 'easybook-add-ons') => 'author', 
                                    esc_html__('Title', 'easybook-add-ons') => 'title', 
                                    esc_html__('Modified', 'easybook-add-ons') => 'modified',
                                    esc_html__('Random', 'easybook-add-ons') => 'rand',
                ), 
                "description"   => esc_html__("Order Portfolios by", 'easybook-add-ons'), 
                "std"           => 'date',
            ), 
            array(
                "type"          => "dropdown", 
                "class"         => "", 
                "heading"       => esc_html__('Sort Order', 'easybook-add-ons'), 
                "param_name"    => "order", 
                "value"         => array(
                                    esc_html__('Ascending', 'easybook-add-ons') => 'ASC',
                                    esc_html__('Descending', 'easybook-add-ons') => 'DESC', 
                    
                ), 
                "description"   => esc_html__("Order Portfolios", 'easybook-add-ons'),
                "std"           => 'DESC',
            ), 
            array(
                "type"          => "textfield",
                "holder"        => "div",
                "heading"       => esc_html__("Post to show", 'easybook-add-ons'),
                "param_name"    => "posts_per_page",
                "description"   => esc_html__("Number of portfolio items to show (-1 for all).", 'easybook-add-ons'),
                "value"         => '10',
            ),

            array(
                "type"          => "dropdown",
                "heading"       => esc_html__('Show Pagination', 'easybook-add-ons'),
                "param_name"    => "show_pagination",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no', 
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                                                                                                   
                                ),
                'std'           =>'no'
                
            ),
            
            
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Show Info', 'easybook-add-ons'),
                "param_name"    => "folio_item_style",
                "value"         => array(   
                                    esc_html__( 'Show on Image', 'easybook-add-ons' ) => 'default-thumb-info',  
                                    esc_html__( 'Show on hover', 'easybook-add-ons' ) => 'hid-det-items',                                                                              
                                    esc_html__( 'Bellow Thumbnail', 'easybook-add-ons' ) => 'vis-thumb-info',                                                                              
                                ),
                
                'std'           =>'default-thumb-info'
            ),

             
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Speed", 'easybook-add-ons'),
                "param_name"    => "speed",
                "value"         =>'1000',
                "description"   => esc_html__("Duration of transition between slides (in ms). Default: 1000", 'easybook-add-ons')
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Direction', 'easybook-add-ons'),
                "param_name"    => "direction",
                "value"         => array(   
                                    esc_html__('Horizontal', 'easybook-add-ons') => 'horizontal',  
                                    esc_html__('Vertical', 'easybook-add-ons') => 'vertical',                                                                                
                                ),
                'std'           => 'horizontal'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Effect', 'easybook-add-ons'),
                "param_name"    => "effect",
                "value"         => array(   
                                    esc_html__('Slide', 'easybook-add-ons') => 'slide',  
                                    esc_html__('Fade', 'easybook-add-ons') => 'fade',                                                                                
                                    esc_html__('Cube', 'easybook-add-ons') => 'cube',                                                                                
                                    esc_html__('Coverflow', 'easybook-add-ons') => 'coverflow',                                                                                
                                    esc_html__('Flip', 'easybook-add-ons') => 'flip',                                                                                
                                ),
                'std'           => 'slide'
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Auto Play", 'easybook-add-ons'),
                "param_name"    => "autoplay",
                "description"   => esc_html__("Number in mili-second (5000), leave it blank to disable", 'easybook-add-ons'),
                'value'         => ''
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Free Mode', 'easybook-add-ons'),
                "param_name"    => "free_mode",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no',  
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',                                                                                
                                ),
                "description"   => esc_html__("Slides will not have fixed positions", 'easybook-add-ons'), 
                'std'           =>'yes'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Center Mode', 'easybook-add-ons'),
                "param_name"    => "centre_mode",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no',  
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',                                                                                
                                ),
                "description"   => esc_html__("Active slide will be centered", 'easybook-add-ons'), 
                'std'           =>'no'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Loop', 'easybook-add-ons'),
                "param_name"    => "loop",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no',  
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',                                                                                
                                ),
                "description"   => esc_html__("Set this to Yes to enable continuous loop mode", 'easybook-add-ons'), 
                'std'           =>'no'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Show Navigation', 'easybook-add-ons'),
                "param_name"    => "show_nav",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                    esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                ),
                'std'           =>'no'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Show Scrollbar', 'easybook-add-ons'),
                "param_name"    => "show_scrollbar",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                    esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                ),
                'std'           =>'yes'
            ),
            

            array(
                "type"          => "dropdown",
                "heading"       => esc_html__('Show Fullscreen Button', 'easybook-add-ons'),
                "param_name"    => "show_fullscreen_toggle",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no', 
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                                                                                                   
                                ),
                'std'           =>'no'
                
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Disable Image Zoom', 'easybook-add-ons'),
                "param_name"    => "disable_zoom",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no', 
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                                                                                                   
                                ),
                'std'           =>'no'
                
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Enable Gallery', 'easybook-add-ons'),
                "param_name"    => "enable_gallery",
                "value"         => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no', 
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                                                                                                   
                                ),
                'std'           =>'yes',
                'dependency'    => array(
                    'element'   => 'disable_zoom',
                    'value'     => array('no'),
                    'not_empty' => false
                ),
                
            ),
            
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Mouse Wheel Control', 'easybook-add-ons'),
                "param_name"    => "mousewheel",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                    esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                ),
                "description"   => esc_html__("Set this to Yes if you want to enable navigation through slides using mouse wheel", 'easybook-add-ons'), 
                'std'           =>'yes'
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Keyboard Control', 'easybook-add-ons'),
                "param_name"    => "keyboard",
                "value"         => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                    esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                ),
                "description"   => esc_html__("Set this to Yes if you want to enable navigation through slides using keyboard arrows", 'easybook-add-ons'), 
                'std'           =>'yes'
            ),



            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
                "param_name"    => "el_class",
                "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
            ),
            array(
                'type'          => 'css_editor',
                'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
                'param_name'    => 'css',
                'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
            ),
        )
    ));
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_EasyBook_Portfolios_Carousel extends WPBakeryShortCode {}
    }

    vc_map( array(
        "name"                      => esc_html__("Portfolios List", 'easybook-add-ons'),
        "description"               => esc_html__("List of portfolio items",'easybook-add-ons'),
        "base"                      => "easybook_portfolios_list",
        "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
        ////"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_portfolios_parallax.php',
        "category"                  => 'EasyBook Portfolio',
        "show_settings_on_create"   => true,
        "params"                    => array(
            array(
                "type"          => "textfield", 
                "heading"       => esc_html__("Portfolio Category IDs to include", 'easybook-add-ons'), 
                "param_name"    => "cat_ids", 
                "description"   => esc_html__("Enter portfolio category ids to include, separated by a comma. Leave empty to display all categories.", 'easybook-add-ons')
            ), 
             
            
            array(
                "type"          => "textfield", 
                "holder"        => "div",
                "heading"       => esc_html__("Enter Portfolio IDs", 'easybook-add-ons'), 
                "param_name"    => "ids", 
                "description"   => esc_html__("Enter portfolio ids to show, separated by a comma.", 'easybook-add-ons')
            ), 
            array(
                "type"          => "textfield", 
                "heading"       => esc_html__("Portfolio IDs to Exclude", 'easybook-add-ons'), 
                "param_name"    => "ids_not", 
                "description"   => esc_html__("Enter portfolio ids to exclude, separated by a comma. Use if the field above is empty. Leave empty to get all.", 'easybook-add-ons')
            ), 
            array(
                "type"          => "dropdown", 
                "class"         => "", 
                "heading"       => esc_html__('Order Portfolios by', 'easybook-add-ons'), 
                "param_name"    => "order_by", 
                "value"         => array(
                                    esc_html__('Date', 'easybook-add-ons') => 'date', 
                                    esc_html__('ID', 'easybook-add-ons') => 'ID', 
                                    esc_html__('Author', 'easybook-add-ons') => 'author', 
                                    esc_html__('Title', 'easybook-add-ons') => 'title', 
                                    esc_html__('Modified', 'easybook-add-ons') => 'modified',
                                    esc_html__('Random', 'easybook-add-ons') => 'rand',
                ), 
                "description"   => esc_html__("Order Portfolios by", 'easybook-add-ons'), 
                "std"           => 'date',
            ), 
            array(
                "type"          => "dropdown", 
                "class"         => "", 
                "heading"       => esc_html__('Sort Order', 'easybook-add-ons'), 
                "param_name"    => "order", 
                "value"         => array(
                                    esc_html__('Ascending', 'easybook-add-ons') => 'ASC',
                                    esc_html__('Descending', 'easybook-add-ons') => 'DESC', 
                    
                ), 
                "description"   => esc_html__("Order Portfolios", 'easybook-add-ons'),
                "std"           => 'DESC',
            ), 
            array(
                "type"          => "textfield",
                "holder"        => "div",
                "heading"       => esc_html__("Post to show", 'easybook-add-ons'),
                "param_name"    => "posts_per_page",
                "description"   => esc_html__("Number of portfolio items to show (-1 for all).", 'easybook-add-ons'),
                "value"         => '4',
            ),
            array(
                "type"          => "dropdown", 
                "heading"       => esc_html__('Show Title', 'easybook-add-ons'), 
                "param_name"    => "show_title", 
                "value"         => array(
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',
                                    esc_html__('No', 'easybook-add-ons') => 'no',
                ), 
                "std"           => 'yes',
            ), 
            array(
                "type"          => "dropdown", 
                "heading"       => esc_html__('Show Category', 'easybook-add-ons'), 
                "param_name"    => "show_cat", 
                "value"         => array(
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',
                                    esc_html__('No', 'easybook-add-ons') => 'no',
                ), 
                "std"           => 'yes',
            ), 
            array(
                "type"          => "dropdown", 
                "class"         => "", 
                "heading"       => esc_html__('Show Excerpt', 'easybook-add-ons'), 
                "param_name"    => "show_excerpt", 
                "value"         => array(
                                    esc_html__('No', 'easybook-add-ons') => 'no',
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes', 
                ), 
                "std"           => 'yes',
            ), 


            array(
                "type"              => "dropdown", 
                "class"             => "", 
                "heading"           => esc_html__('Show Pagination', 'easybook-add-ons'), 
                "param_name"        => "show_pagination", 
                "value"             => array(
                    esc_html__('Yes', 'easybook-add-ons')         => 'yes', 
                    esc_html__('No', 'easybook-add-ons')          => 'no', 
                ), 
                "std"               => 'yes',
                
            ), 


            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
                "param_name"    => "el_class",
                "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
            ),
            array(
                'type'          => 'css_editor',
                'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
                'param_name'    => 'css',
                'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
            ),
        )
    ));
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_EasyBook_Portfolios_List extends WPBakeryShortCode {}
    }
    

    // vc_map( array(
    //         "name"                      => esc_html__("Circle Progress", 'easybook-add-ons'),
    //         "base"                      => "easybook_circle_progress",
    //         "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
    //         ////"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_circle_progress.php',
    //         "category"                  => 'EasyBook Theme',
    //         "show_settings_on_create"   => true,
    //         "params"                    => array(
                
    //             array(
    //                 "type"          => "textfield",
    //                 'admin_label'   => true,
    //                 "heading"       => esc_html__("Value", 'easybook-add-ons'),
    //                 'description'   => esc_html__('Enter value for graph (Note: choose range from 0 to 100).','easybook-add-ons' ),
    //                 "param_name"    => "value",
    //                 "value"         => "85"
    //             ),
    //             array(
    //                 "type"          => "textfield",
    //                 'admin_label'   => true,
    //                 "heading"       => esc_html__("Units", 'easybook-add-ons'),
    //                 'description'   => esc_html__('Enter measurement units (Example: %, px, points, etc. Note: graph value and units will be appended to graph title).','easybook-add-ons' ),
    //                 "param_name"    => "units",
    //                 "value"         => ""
    //             ),

    //             array(
    //                 "type"          => "textfield",
    //                 'admin_label'   => true,
    //                 "heading"       => esc_html__("Width", 'easybook-add-ons'),
    //                 'description'   => esc_html__('Pixel value for the graph width.','easybook-add-ons' ),
    //                 "param_name"    => "width",
    //                 "value"         => "150"
    //             ),

    //             array(
    //                 "type"          => "textfield",
    //                 'admin_label'   => true,
    //                 "heading"       => esc_html__("Line Width", 'easybook-add-ons'),
    //                 'description'   => esc_html__('Pixel value for the graph line width.','easybook-add-ons' ),
    //                 "param_name"    => "line_width",
    //                 "value"         => "40"
    //             ),

    //             array(
    //                 "type"          => "colorpicker",
    //                 'admin_label'   => true,
    //                 "heading"       => esc_html__("Color", 'easybook-add-ons'),
    //                 "param_name"    => "color",
    //                 "value"         => '#292929',
    //             ),

    //             array(
    //                 "type"          => "textarea",
    //                 "heading"       => esc_html__("Description", 'easybook-add-ons'),
    //                 "param_name"    => "content",
    //                 'admin_label'   => true,
    //                 "value"         =>'<h4>Design</h4>'
    //             ),  

    //             array(
    //                 "type"          => "textfield",
    //                 "heading"       => esc_html__("Extraclass", "easybook"),
    //                 "param_name"    => "el_class",
    //                 "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "easybook"),
    //                 "value"         => ""
    //             ),
    //             array(
    //                 'type'          => 'css_editor',
    //                 'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
    //                 'param_name'    => 'css',
    //                 'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
    //             ),
    //         )
    // ));
    // if ( class_exists( 'WPBakeryShortCode' ) ) {
    //     class WPBakeryShortCode_EasyBook_Circle_Progress extends WPBakeryShortCode {}
    // }

    vc_map( array(
           "name"      => esc_html__("Skills Bar", 'easybook-add-ons'),
           "description" => esc_html__("Animated skills bar",'easybook-add-ons'),
           "base"      => "easybook_skills",
           "class"     => "",
           "icon" => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
           "category"  => 'EasyBook Theme',
           "show_settings_on_create" => true,
           "params"    => array(
                
                array(
                    'type' => 'param_group',
                    'heading' => esc_html__( 'Values', 'easybook-add-ons' ),
                    'param_name' => 'values',
                    'description' => esc_html__( 'Enter values for graph - value, title and color.', 'easybook-add-ons' ),
                    'value' => urlencode( json_encode( array(
                        array(
                            'label' => 'Photoshop',
                            'value' => '95',
                        ),
                        array(
                            'label' => 'Illustrator',
                            'value' => '65',
                        ),
                        array(
                            'label' => '3D MAX',
                            'value' => '75',
                        ),
                        array(
                            'label' => 'Google ScketchUp',
                            'value' => '90',
                        ),
                    ) ) ),
                    'params' => array(
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__( 'Label', 'easybook-add-ons' ),
                            'param_name' => 'label',
                            'description' => esc_html__( 'Enter text used as title of bar.', 'easybook-add-ons' ),
                            'admin_label' => true,
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__( 'Value', 'easybook-add-ons' ),
                            'param_name' => 'value',
                            'description' => esc_html__( 'Enter value of bar.', 'easybook-add-ons' ),
                            'admin_label' => true,
                        ),
                    ),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Extra class name", 'easybook-add-ons'),
                    "param_name" => "el_class",
                    "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => esc_html__( 'Css', 'easybook-add-ons' ),
                    'param_name' => 'css',
                    'group' => esc_html__( 'Design options', 'easybook-add-ons' ),
                ),
            )));

        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_EasyBook_Skills extends WPBakeryShortCode {}
        }


    

        // vc_map( array(
        //    "name"      => esc_html__("Icons List", 'easybook-add-ons'),
        //    "description" => esc_html__("List of icons with link",'easybook-add-ons'),
        //    "base"      => "easybook_icons",
        //    "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
        //     ////"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_icons.php',
        //    "category"  => 'EasyBook Theme',
        //    "show_settings_on_create" => true,
        //    "params"    => array(
                
        //         array(
        //             'type' => 'param_group',
        //             'heading' => esc_html__( 'Icons', 'easybook-add-ons' ),
        //             'param_name' => 'values',
        //             'description' => esc_html__( 'Select icons with its link and title.', 'easybook-add-ons' ),
        //             'value' => json_encode( array(
        //                 array(
        //                     'text' => 'Follow us on Facebook',
        //                     'url' => '#',
        //                     'icon' => 'fa fa-facebook',
        //                     'target' => '_blank',
        //                 ),
        //                 array(
        //                     'text' => 'Follow us on Twitter',
        //                     'url' => '#',
        //                     'icon' => 'fa fa-twitter',
        //                     'target' => '_blank',
        //                 ),
        //                 array(
        //                     'text' => 'Follow us on Instagram',
        //                     'url' => '#',
        //                     'icon' => 'fa fa-instagram',
        //                     'target' => '_blank',
        //                 ),

        //                 array(
        //                     'text' => 'Follow us on Pinterest',
        //                     'url' => '#',
        //                     'icon' => 'fa fa-pinterest',
        //                     'target' => '_blank',
        //                 ),
        //                 array(
        //                     'text' => 'Follow us on Tumblr',
        //                     'url' => '#',
        //                     'icon' => 'fa fa-tumblr',
        //                     'target' => '_blank',
        //                 ),
                        
                        
        //             ) ),
        //             'params' => array(
        //                 array(
        //                     'type' => 'iconpicker',
        //                     'heading' => esc_html__( 'Icon', 'easybook-add-ons' ),
        //                     'param_name' => 'icon',
        //                     'settings' => array(
        //                         'emptyIcon' => false, // default true, display an "EMPTY" icon?
        //                         'type' => 'fontawesome',
        //                     ),
        //                 ),
        //                 array(
        //                     'type' => 'textfield',
        //                     'heading' => esc_html__( 'Icon Text', 'easybook-add-ons' ),
        //                     'param_name' => 'text',
        //                     'admin_label' => true,
        //                 ),
        //                 array(
        //                     'type' => 'textfield',
        //                     'heading' => esc_html__( 'Icon URL', 'easybook-add-ons' ),
        //                     'param_name' => 'url',
        //                     'admin_label' => true,
        //                 ),
        //                 array(
        //                     'type' => 'textfield',
        //                     'heading' => esc_html__( 'URL Target (_blank or _self)', 'easybook-add-ons' ),
        //                     'param_name' => 'target',
        //                     'value' => '_blank',
        //                 ),
                        
        //             ),
        //         ),

        //         array(
        //             "type" => "dropdown",
        //             "holder"=>"div",
        //             "admin_label"=> true ,
        //             "heading" => esc_html__('Columns Grid', 'easybook-add-ons'),
        //             "param_name" => "columns",
        //             "value" => array(   
        //                 esc_html__('One Column', 'easybook-add-ons') => 'one',  
        //                 esc_html__('Two Columns', 'easybook-add-ons') => 'two',  
        //                 esc_html__('Three Columns', 'easybook-add-ons') => 'three',        
        //                 esc_html__('Four Columns', 'easybook-add-ons') => 'four',        
        //                 esc_html__('Five Columns', 'easybook-add-ons') => 'five',        
        //                 esc_html__('Six Columns', 'easybook-add-ons') => 'six',        
        //                 esc_html__('Seven Columns', 'easybook-add-ons') => 'seven',        
        //                 esc_html__('Eight Columns', 'easybook-add-ons') => 'eight',        
        //                 esc_html__('Nine Columns', 'easybook-add-ons') => 'nine',        
        //                 esc_html__('Ten Columns', 'easybook-add-ons') => 'ten',        
        //             ),
                   
        //             "std"=>'five',    
        //         ),

        //         array(
        //             "type" => "textfield",
        //             "heading" => esc_html__("Extra class name", "easybook"),
        //             "param_name" => "el_class",
        //             "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "easybook")
        //         ),
        //         array(
        //             'type' => 'css_editor',
        //             'heading' => esc_html__( 'Css', 'easybook-add-ons' ),
        //             'param_name' => 'css',
        //             'group' => esc_html__( 'Design options', 'easybook-add-ons' ),
        //         ),
        //     )));

        // if ( class_exists( 'WPBakeryShortCode' ) ) {
        //     class WPBakeryShortCode_EasyBook_Icons extends WPBakeryShortCode {}
        // }

        // vc_map( array(
        //    "name"      => esc_html__("EasyBook Button", 'easybook-add-ons'),
        //    "base"      => "easybook_button",
        //    "class"     => "",
        //    "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
        //     ////"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_button.php',
        //    "category"  => 'EasyBook Theme',
        //    "show_settings_on_create" => true,
        //    "params"    => array(
        //         array(
        //             'type' => 'textfield',
        //             'heading' => esc_html__( 'Button Title', 'easybook-add-ons' ),
        //             'holder' => 'div',
        //             'param_name' => 'title',
        //             'value' => "View More",
        //         ),

        //         array(
        //             'type' => 'iconpicker',
        //             'heading' => esc_html__( 'Icon', 'easybook-add-ons' ),
        //             'param_name' => 'icon',
        //             'value' => '', // default value to backend editor admin_label
        //             'settings' => array(
        //                 'emptyIcon' => true,
        //                 // default true, display an "EMPTY" icon?
        //                 'iconsPerPage' => 4000,
        //                 // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
        //             ),
        //             'description' => esc_html__( 'Select icon from library.', 'easybook-add-ons' ),
        //         ),

        //         array(
        //             "type" => "vc_link",
        //             "heading" => esc_html__("Button Link", "easybook"),
        //             "param_name" => "link",
    
        //         ),

                
        //         array(
        //             "type" => "dropdown",
        //             "heading" => esc_html__('Is Page Scrolling Button?', 'easybook-add-ons'),
        //             "param_name" => "is_scrolling",
        //             "value" => array(   
        //                             esc_html__('Yes', 'easybook-add-ons') => 'yes',  
        //                             esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
        //                         ),
        //             "std" => 'no', 
        //         ),
        
        //         array(
        //             "type" => "textfield",
        //             "heading" => esc_html__("Extra class name", "easybook"),
        //             "param_name" => "el_class",
        //             "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "easybook")
        //         ),
        //         array(
        //             'type' => 'css_editor',
        //             'heading' => esc_html__( 'Css', 'easybook-add-ons' ),
        //             'param_name' => 'css',
        //             'group' => esc_html__( 'Design options', 'easybook-add-ons' ),
        //         ),
        //     )));

        // if ( class_exists( 'WPBakeryShortCode' ) ) {
        //     class WPBakeryShortCode_EasyBook_Button extends WPBakeryShortCode {}
        // }

        // vc_map( array(
        //     "name" => esc_html__("Image Popup", 'easybook-add-ons'),
        //     "base" => "easybook_image",
        //     "content_element" => true,
        //     "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
        //     ////"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_image.php',
        //     "category"  => 'EasyBook Theme',
        //     "show_settings_on_create" => true,
        //     "params" => array(
                
        //         array(
        //             "type"      => "attach_image",
        //             "holder"    => "div",
        //             "class"     => "ajax-vc-img",
        //             "heading"   => esc_html__("Image Source", 'easybook-add-ons'),
        //             "param_name"=> "img",
        //             "value"=>'824'
        //         ),

        //         array(
        //             "type" => "textfield",
        //             'admin_label'   => true,
        //             "heading" => esc_html__("Image size", 'easybook-add-ons'),
        //             "param_name" => "thumbnail_size",
        //             "description" => esc_html__('Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height).','easybook-add-ons' ),
        //             "value"=> 'full',
        //         ),

        //         array(
        //             "type" => "colorpicker",
        //             'admin_label'   => true,
        //             "heading" => esc_html__("Overlay Color", 'easybook-add-ons'),
        //             "param_name" => "over_color",
        //             "value"=> '#000',
        //         ),

        //         array(
        //             "type" => "dropdown",
        //             "class"=>"",
        //             "heading" => esc_html__('Click Action', 'easybook-add-ons'),
        //             "param_name" => "action",
        //             "value" => array(   
        //                             esc_html__('Image Popup', 'easybook-add-ons') => 'image',  
        //                             esc_html__('Video Popup', 'easybook-add-ons') => 'video',                                                                                
                                                                                                                   
        //                         ),
        //             "std" => 'image', 
        //         ),

        //         array(
        //             "type"      => "attach_image",
        //             "holder"    => "div",
        //             "class"     => "ajax-vc-img",
        //             "heading"   => esc_html__("Popup Image", 'easybook-add-ons'),
        //             "description"   => esc_html__("Leave empty to use thumbnail image.", 'easybook-add-ons'),
        //             "param_name"=> "popup_img",
        //             "value"     => '',
        //             'dependency'=> array(
        //                 'element'=>'action',
        //                 'value'=>array('image'),
        //                 'not_empty'=>false
        //             )
        //         ),

        //         array(
        //             "type"      => "textfield",
        //             'admin_label'   => true,
        //             "heading"   => esc_html__("Popup Video URL", 'easybook-add-ons'),
        //             "param_name"=> "video_url",
        //             "value"     => "https://vimeo.com/24506451",
        //             'dependency'=> array(
        //                 'element'=>'action',
        //                 'value'=>array('video'),
        //                 'not_empty'=>false
        //             )
        //         ),
        //         array(
        //             "type" => "textfield",
        //             "heading" => esc_html__("Extra class name", 'easybook-add-ons'),
        //             "param_name" => "el_class",
        //             "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
        //         ),
                
        //         array(
        //             'type' => 'css_editor',
        //             'heading' => esc_html__( 'Css', 'easybook-add-ons' ),
        //             'param_name' => 'css',
        //             'group' => esc_html__( 'Design options', 'easybook-add-ons' ),
        //         ),
                
        //     ),
        //     'admin_enqueue_js'      => EASYBOOK_ADD_ONS_DIR_URL . "inc/assets/easybook-elements.js",
        //     'js_view'=> 'EasyBookImagesView',
        // ));

        // if ( class_exists( 'WPBakeryShortCode' ) ) {
        //     class WPBakeryShortCode_EasyBook_Image extends WPBakeryShortCode {     
        //     }
        // }


        vc_map( array(
            "name"                      => esc_html__("Animated Counter", 'easybook-add-ons'),
            "base"                      => "easybook_counter",
            "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_counter.php',
            "category"                  => 'EasyBook Theme',
            "show_settings_on_create"   => true,
            "params"                    => array(
                
                array(
                    "type"          => "textfield",
                    'admin_label'   => true,
                    "heading"       => esc_html__("Number", 'easybook-add-ons'),
                    "param_name"    => "number",
                    "value"         => "461"
                ),
                array(
                    "type"          => "textarea",
                    'admin_label'   => true,
                    "heading"       => esc_html__("Content", 'easybook-add-ons'),
                    "param_name"    => "content",
                    "value"         =>'<h6>Finished projects</h6>',
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => esc_html__( 'Icon', 'easybook-add-ons' ),
                    'param_name'    => 'icon_class',
                    'value'         => '', // default value to backend editor admin_label
                    'settings'      => array(
                        'emptyIcon'     => true,
                        // default true, display an "EMPTY" icon?
                        'iconsPerPage'  => 4000,
                        // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                    ),
                    
                ),
                // array(
                //     "type"          => "dropdown",
                //     "heading"       => esc_html__('Is last item on row', 'easybook-add-ons'),
                //     "param_name"    => "is_last",
                //     "value"         => array(   
                //                         esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                //                         esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                //                     ),
                //     "std"           => 'no', 
                // ),

                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Extraclass", 'easybook-add-ons'),
                    "param_name"    => "el_class",
                    "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons'),
                    "value"         => ""
                ),
                array(
                    'type'          => 'css_editor',
                    'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
                    'param_name'    => 'css',
                    'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
                ),
            )
    ));
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_EasyBook_Counter extends WPBakeryShortCode {}
    }

    vc_map( array(
        "name"                      => esc_html__("Header Title", 'easybook-add-ons'),
        "description"               => esc_html__("Title for header section",'easybook-add-ons'),
        "base"                      => "easybook_head_title",
        "content_element"           => true,
        "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
        //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_head_title.php',
        "category"                  => 'EasyBook Theme',
        "show_settings_on_create"   => true,
        "params"                    => array(
            
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Title Text", 'easybook-add-ons'),
                "param_name"    => "title_text",
                'admin_label'   => true,
                "value"         => "Our Portfolio",

            ),
            array(
                "type"          => "textarea_html",
                "heading"       => esc_html__("More Info", 'easybook-add-ons'),
                "param_name"    => "content",
                'admin_label'   => true,
                'value'         => '<h4>Praesent nec leo venenatis elit semper aliquet id ac enim.</h4>'
                
            ), 

            
            array(
                "type"          => "textfield", 
                "heading"       => esc_html__('Scroll button URL', 'easybook-add-ons'), 
                "param_name"    => "scroll_url", 
                'admin_label'   => true,
                "value"         => ''

            ), 
            array(
                'type'          => 'iconpicker',
                'heading'       => esc_html__( 'Scroll button Icon', 'easybook-add-ons' ),
                'param_name'    => 'scroll_icon',
                'value'         => 'fa fa-long-arrow-down',
                'settings'      => array(
                    'emptyIcon' => true, // default true, display an "EMPTY" icon?
                    'type'      => 'fontawesome',
                ),
                'dependency'    => array(
                    'element'   => 'scroll_url',
                    'not_empty' => true
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
        )
    ));

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_EasyBook_Head_Title extends WPBakeryShortCode {}
    }
        
    vc_map( array(
        "name"                      => esc_html__("Section Title", 'easybook-add-ons'),
        "description"               => esc_html__("Section Title for EasyBook",'easybook-add-ons'),
        "base"                      => "easybook_section_title",
        "content_element"           => true,
        "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
        //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_section_title.php',
        "category"                  => 'EasyBook Theme',
        "show_settings_on_create"   => true,
        "params"                    => array(
            
            array(
                "type"          => "textfield",
                "holder"        => "div",
                "heading"       => esc_html__("Title Text", 'easybook-add-ons'),
                "param_name"    => "title_text",
                "value"         => "About Us",

            ),
            array(
                "type"          => "textarea_html",
                "holder"        => "div",
                "heading"       => esc_html__("More Info", 'easybook-add-ons'),
                "param_name"    => "content",
                "value"         => "",
                
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
        )
    ));

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_EasyBook_Section_Title extends WPBakeryShortCode {}
    }


    vc_map( array(
        "name"                          => esc_html__("Single Service", 'easybook-add-ons'),
        "base"                          => "easybook_service",
        "content_element"               => true,
        "icon"                          => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
        //"html_template"                 => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_service.php',
        "category"                      => 'EasyBook Theme',
        "show_settings_on_create"       => true,
        "params"                        => array(
            
            array(
                "type"              => "textfield",
                "admin_label"       => true,
                "heading"           => esc_html__("Service Title", 'easybook-add-ons'),
                "param_name"        => "ser_title",
                "value"             => "Wedding Photography",
         
            ),

            array(
                "type"              => "attach_image",
                "holder"            => "div",
                "class"             => "ajax-vc-img",
                "heading"           => esc_html__("Service Image", 'easybook-add-ons'),
                "param_name"        => "ser_img",
                "value"             => '',
            ),
            
            array(
                "type"              => "textarea_html",
                "admin_label"       => true,
                "heading"           => esc_html__("More Info", 'easybook-add-ons'),
                "param_name"        => "content",
                "value"             => '<p> Sed blandit, dolor id aliquam vestibulum, nibh elit imperdiet turpis, quis molestie quam erat vel nisi.</p>
<ul>
    <li><a href="#">Portraits</a></li>
    <li><a href="#">Weddings</a></li>
    <li><a href="#">Commercials</a></li>
</ul>'
            ),  

            array(
                "type"              => "textfield",
                "admin_label"       => true,
                "heading"           => esc_html__("Service Price", 'easybook-add-ons'),
                "param_name"        => "ser_price",
                "value"             => "-span- Price: -span- $250-$1200",
              
            ),
             
            
            array(
                "type"              => "textfield",
                "heading"           => esc_html__("Extra class name", 'easybook-add-ons'),
                "param_name"        => "el_class",
                "description"       => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons'),
                "value"             => "",
            ),

            array(
                'type'              => 'css_editor',
                'heading'           => esc_html__( 'Css', 'easybook-add-ons' ),
                'param_name'        => 'css',
                'group'             => esc_html__( 'Design options', 'easybook-add-ons' ),
            ),
            
        ),
        'admin_enqueue_js'      => EASYBOOK_ADD_ONS_DIR_URL . "inc/assets/easybook-elements.js",
        'js_view'=> 'EasyBookImagesView',
    ));

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_EasyBook_Service extends WPBakeryShortCode {}
    }

    vc_map( array(
            "name"      => esc_html__("Testimonial Slider", 'easybook-add-ons'),

            "base"      => "easybook_testimonials",
            "class"     => "",
            "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_testimonials.php',
            "category"  => 'EasyBook Theme',
            "show_settings_on_create" => true,
            "params"    => array(
                array(
                    "type"      => "textfield",
                    "holder"    => "div",
                    "class"     => "",
                    "heading"   => esc_html__("Count", 'easybook-add-ons'),
                    "param_name"=> "count",
                    "value"     => "3",
                    "description" => esc_html__("Number of testimonials to show", 'easybook-add-ons')
                ),
                array(
                    "type" => "dropdown",
                    "class"=>"",
                    "heading" => esc_html__('Order by', 'easybook-add-ons'),
                    "param_name" => "order_by",
                    "value" => array(   
                        esc_html__('Date', 'easybook-add-ons') => 'date',  
                        esc_html__('ID', 'easybook-add-ons') => 'ID',  
                        esc_html__('Author', 'easybook-add-ons') => 'author',       
                        esc_html__('Title', 'easybook-add-ons') => 'title',  
                        esc_html__('Modified', 'easybook-add-ons') => 'modified',  
                    ),
                    "description" => esc_html__("Order by", 'easybook-add-ons'),  
                    "std"=>'date',    
                ),
                array(
                    "type" => "dropdown",
                    "class"=>"",
                    "heading" => esc_html__('Sort Order', 'easybook-add-ons'),
                    "param_name" => "order",
                    "value" => array(   
                                    esc_html__('Descending', 'easybook-add-ons') => 'DESC',
                                    esc_html__('Ascending', 'easybook-add-ons') => 'ASC',  
                                                                                                                      
                                    ),  
                    "std" => "DESC"   
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Or Enter Testimonial IDs", 'easybook-add-ons'),
                    "param_name" => "ids",
                    "description" => esc_html__("Enter testimonial ids to show, separated by a comma. (ex: 99,100)", 'easybook-add-ons')
                ),
                array(
                    "type" => "dropdown",
                    "class"=>"",
                    "heading" => esc_html__('Show Avatar', 'easybook-add-ons'),
                    "param_name" => "show_avatar",
                    "value" => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no',  
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',
                                    
                                                                                                                      
                                    ),
                       
                    "std" => "no"     
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Show Title", 'easybook-add-ons'),
                    "param_name" => "show_title",
          
                    "value" => array( 
                        esc_html__('No', 'easybook-add-ons') => 'no',  
                        esc_html__('Yes', 'easybook-add-ons') => 'yes',   
                        
                          
                    ),
                    "std"=>'yes', 
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Show Rating", 'easybook-add-ons'),
                    "param_name" => "show_rating",
                  
                    "value" => array( 
                        esc_html__('No', 'easybook-add-ons') => 'no',  
                        esc_html__('Yes', 'easybook-add-ons') => 'yes',   
                        
                          
                    ),
                    "std"=>'yes', 
                ),


                


                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Speed", 'easybook-add-ons'),
                    "param_name" => "speed",
                    "value"=>'1000',
                    "description" => esc_html__("Duration of transition between slides (in ms). Default: 1000", 'easybook-add-ons')
                ),
                array(
                    "type" => "dropdown",
                    "class"=>"",
                    "heading" => esc_html__('Direction', 'easybook-add-ons'),
                    "param_name" => "direction",
                    "value" => array(   
                                    esc_html__('Horizontal', 'easybook-add-ons') => 'horizontal',  
                                    esc_html__('Vertical', 'easybook-add-ons') => 'vertical',                                                                                
                                ),
                    'std' => 'horizontal'
                ),
                array(
                    "type" => "dropdown",
                    "class"=>"",
                    "heading" => esc_html__('Effect', 'easybook-add-ons'),
                    "param_name" => "effect",
                    "value" => array(   
                                    esc_html__('Slide', 'easybook-add-ons') => 'slide',  
                                    esc_html__('Fade', 'easybook-add-ons') => 'fade',                                                                                
                                    esc_html__('Cube', 'easybook-add-ons') => 'cube',                                                                                
                                    esc_html__('Coverflow', 'easybook-add-ons') => 'coverflow',                                                                                
                                    esc_html__('Flip', 'easybook-add-ons') => 'flip',                                                                                
                                ),
                    'std' => 'slide'
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Auto Play", 'easybook-add-ons'),
                    "param_name" => "autoplay",
                    "description" => esc_html__("Number in mili-second (5000), leave it blank to disable", 'easybook-add-ons'),
                    'value'=> ''
                ),
                array(
                    "type" => "dropdown",
                    "class"=>"",
                    "heading" => esc_html__('Loop', 'easybook-add-ons'),
                    "param_name" => "loop",
                    "value" => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no',  
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',                                                                                
                                ),
                    "description" => esc_html__("Set this to Yes to enable continuous loop mode", 'easybook-add-ons'), 
                    'std'=>'yes'
                ),
                array(
                    "type" => "dropdown",
                    "class"=>"",
                    "heading" => esc_html__('Mouse Wheel Control', 'easybook-add-ons'),
                    "param_name" => "mousewheel",
                    "value" => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                    esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                ),
                    "description" => esc_html__("Set this to Yes if you want to enable navigation through slides using mouse wheel", 'easybook-add-ons'), 
                    'std'=>'no'
                ),
                array(
                    "type" => "dropdown",
                    "class"=>"",
                    "heading" => esc_html__('Keyboard Control', 'easybook-add-ons'),
                    "param_name" => "keyboard",
                    "value" => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                    esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                ),
                    "description" => esc_html__("Set this to Yes if you want to enable navigation through slides using keyboard arrows", 'easybook-add-ons'), 
                    'std'=>'yes'
                ),

                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Show Navigation", 'easybook-add-ons'),
                    "param_name" => "show_navigation",
             
                    "value" => array( 
                        esc_html__('No', 'easybook-add-ons') => 'no',  
                        esc_html__('Yes', 'easybook-add-ons') => 'yes',   
                        
                          
                    ),
                    "std"=>'yes', 
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Show Slider Count", 'easybook-add-ons'),
                    "param_name" => "show_count",
                    
                    "value" => array( 
                        esc_html__('No', 'easybook-add-ons') => 'no',  
                        esc_html__('Yes', 'easybook-add-ons') => 'yes',   
                        
                          
                    ),
                    "std"=>'yes', 
                ),

                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Extra class name", 'easybook-add-ons'),
                    "param_name" => "el_class",
                    "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => esc_html__( 'Css', 'easybook-add-ons' ),
                    'param_name' => 'css',
                    'group' => esc_html__( 'Design options', 'easybook-add-ons' ),
                ),
            )));

        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_EasyBook_Testimonials extends WPBakeryShortCode {}
        }


        vc_map( array(
            "name"      => esc_html__("Single Testimonial", 'easybook-add-ons'),
            "base"      => "easybook_single_testimonial",
            "class"     => "",
            "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_single_testimonial.php',
            "category"  => 'EasyBook Theme',
            "show_settings_on_create" => true,
            "params"    => array(
                
                array(
                    "type" => "textfield",
                    "holder"=>"div",
                    "heading" => esc_html__("Testimonial ID", 'easybook-add-ons'),
                    "param_name" => "id",
                    "value" => "191",
                    "description" => esc_html__("Enter testimonial id to show. Ex: 190", 'easybook-add-ons')
                ),
                array(
                    "type" => "dropdown",
                    "class"=>"",
                    "heading" => esc_html__('Show Avatar', 'easybook-add-ons'),
                    "param_name" => "show_avatar",
                    "value" => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'no',  
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',
                                    
                                                                                                                      
                                    ),
                    "description" => esc_html__("Show avatar", 'easybook-add-ons'),    
                    "std" => "yes"     
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Show Title", 'easybook-add-ons'),
                    "param_name" => "show_title",
  
                    "value" => array( 
                        esc_html__('No', 'easybook-add-ons') => 'no',  
                        esc_html__('Yes', 'easybook-add-ons') => 'yes',   
                        
                          
                    ),
                    "std"=>'yes', 
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Show Rating", 'easybook-add-ons'),
                    "param_name" => "show_rating",
                
                    "value" => array( 
                        esc_html__('No', 'easybook-add-ons') => 'no',  
                        esc_html__('Yes', 'easybook-add-ons') => 'yes',   
                        
                          
                    ),
                    "std"=>'yes', 
                ),

                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Extra class name", 'easybook-add-ons'),
                    "param_name" => "el_class",
                    "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => esc_html__( 'Css', 'easybook-add-ons' ),
                    'param_name' => 'css',
                    'group' => esc_html__( 'Design options', 'easybook-add-ons' ),
                ),
            )));

        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_EasyBook_Single_Testimonial extends WPBakeryShortCode {}
        }


//         vc_map( array(
//             "name"      => esc_html__("Our Clients", 'easybook-add-ons'),
//             "description" => esc_html__("List of our clients or partners",'easybook-add-ons'),
//             "base"      => "easybook_clients",
//             "class"     => "",
//             "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
//             //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_clients.php',
//             "category"  => 'EasyBook Theme',

//             "show_settings_on_create" => true,
//             "params"    => array(

//                 array(
//                     "type"      => "attach_images",
//                     "holder"    => "div",
//                     "class"     => "ajax-vc-img",
//                     "heading"   => esc_html__("Partner Images", 'easybook-add-ons'),
//                     "param_name"=> "partnerimgs",
           
//                     "value"     => '876,872,875,874,873',
//                 ),



//                 array(
//                     "type"      => "textarea",
//                     "holder"    => "span",
//                     "class"     => "",
//                     "heading"   => esc_html__("Partner Links", 'easybook-add-ons'),
//                     "param_name"=> "content",
//                     "value"     => '#
// #
// #
// #
// #',
//                     "description" => esc_html__("Enter links for each partner (Note: divide links with linebreaks (Enter) and no spaces).", 'easybook-add-ons')
//                 ),
//                 array(
//                     "type" => "dropdown",
//                     "class"=>"",
//                     "heading" => esc_html__('Target', 'easybook-add-ons'),
//                     "param_name" => "target",
//                     "value" => array(   
//                                     esc_html__('Opens Partner link in new window', 'easybook-add-ons') => '_blank',  
//                                     esc_html__('Opens Partner link in the same window', 'easybook-add-ons') => '_self',                                                                               
//                                 ),
//                     "std" => '_blank', 
//                 ),




//                 array(
//                     "type" => "dropdown",
//                     "class"=>"",
//                     "heading" => esc_html__('Columns Grid', 'easybook-add-ons'),
//                     "param_name" => "columns",
//                     "value" => array(   
//                         esc_html__('One Column', 'easybook-add-ons') => 'one',  
//                         esc_html__('Two Columns', 'easybook-add-ons') => 'two',  
//                         esc_html__('Three Columns', 'easybook-add-ons') => 'three',        
//                         esc_html__('Four Columns', 'easybook-add-ons') => 'four',        
//                         esc_html__('Five Columns', 'easybook-add-ons') => 'five',        
//                         esc_html__('Six Columns', 'easybook-add-ons') => 'six',        
//                         esc_html__('Seven Columns', 'easybook-add-ons') => 'seven',        
//                         esc_html__('Eight Columns', 'easybook-add-ons') => 'eight',        
//                         esc_html__('Nine Columns', 'easybook-add-ons') => 'nine',        
//                         esc_html__('Ten Columns', 'easybook-add-ons') => 'ten',        
//                     ),
                   
//                     "std"=>'five',    
//                 ),

//                 array(
//                     "type" => "textfield",
//                     "holder" => "div",
//                     "heading" => esc_html__("Thumbnail size", 'easybook-add-ons'),
//                     "param_name" => "thumbnail_size",
//                     "description" => esc_html__('Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height).','easybook-add-ons' ),
//                     "value"=> 'easybook-partner',
                    
//                 ),
                
//                 array(
//                     "type" => "textfield",
//                     "heading" => esc_html__("Extra class name", 'easybook-add-ons'),
//                     "param_name" => "el_class",
//                     "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
//                 ),
//                 array(
//                     'type' => 'css_editor',
//                     'heading' => esc_html__( 'Css', 'easybook-add-ons' ),
//                     'param_name' => 'css',
//                     'group' => esc_html__( 'Design options', 'easybook-add-ons' ),
//                 ),
//             ),
//             'admin_enqueue_js'      => EASYBOOK_ADD_ONS_DIR_URL . "inc/assets/easybook-elements.js",
//             'js_view'=> 'EasyBookImagesView',
//         ));

//         if ( class_exists( 'WPBakeryShortCode' ) ) {
//             class WPBakeryShortCode_EasyBook_Clients extends WPBakeryShortCode {}
//         }


        vc_map( array(
            "name"      => esc_html__("Portfolios Masonry", 'easybook-add-ons'),
            "description" => esc_html__("Masonry layout of portfolio items",'easybook-add-ons'),
            "base"      => "easybook_portfolios",
            "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_portfolios.php',
           "category"  => 'EasyBook Portfolio',
           "show_settings_on_create" => true,
           "params"    => array(
                array(
                    "type"          => "dropdown", 
                    "heading"       => esc_html__('Layout', 'easybook-add-ons'), 
                    "param_name"    => "layout", 
                    "value"         => array(
                        esc_html__('Normal', 'easybook-add-ons') => 'masonry', 
                        esc_html__('Sidebar Filter', 'easybook-add-ons') => 'sidebar-filter', 
                    ), 
                    "std"           => 'masonry',
                ),

                

                array(
                    "type"          => "dropdown",
                    "class"         =>"",
                    "heading"       => esc_html__('Show Info', 'easybook-add-ons'),
                    "param_name"    => "folio_item_style",
                    "value"         => array(   
                                        esc_html__( 'Show on Image', 'easybook-add-ons' ) => 'default-thumb-info',  
                                        esc_html__( 'Show on hover', 'easybook-add-ons' ) => 'hid-det-items',                                                                              
                                        esc_html__( 'Bellow Thumbnail', 'easybook-add-ons' ) => 'vis-thumb-info',                                                                              
                                    ),
                    
                    'std'           =>'hid-det-items'
                ),


                array(
                    "type"          => "textfield", 
                    "heading"       => esc_html__("Portfolio Category IDs to exclude", 'easybook-add-ons'), 
                    "param_name"    => "cat_ids", 
                    "description"   => esc_html__("Enter portfolio category ids to exclude, separated by a comma. Leave empty to display all categories.", 'easybook-add-ons'),
                    "value"         => '',
                ), 
                array(
                    "type"          => "dropdown", 
                    "class"         => "", 
                    "heading"       => esc_html__('Order Portfolio Categories by', 'easybook-add-ons'), 
                    "param_name"    => "cat_order_by", 
                    "value"         => array(
                        esc_html__('Name', 'easybook-add-ons')    => 'name', 
                        esc_html__('ID', 'easybook-add-ons')      => 'id', 
                        esc_html__('Count', 'easybook-add-ons')   => 'count', 
                        esc_html__('Slug', 'easybook-add-ons')    => 'slug', 
                        esc_html__('None', 'easybook-add-ons')    => 'none',
                    ), 
                    "std"           => 'name',
                ), 
                array(
                    "type"          => "dropdown", 
                    "class"         => "", 
                    "heading"       => esc_html__('Sort Order', 'easybook-add-ons'), 
                    "param_name"    => "cat_order", 
                    "value"         => array(
                        esc_html__('Ascending', 'easybook-add-ons')   => 'ASC',
                        esc_html__('Descending', 'easybook-add-ons')  => 'DESC', 
                        
                    ), 
                    "std"           => 'ASC',
                ), 
                array(
                    "type"          => "dropdown", 
                    "class"         => "", 
                    "heading"       => esc_html__('Show Filter', 'easybook-add-ons'), 
                    "param_name"    => "show_filter", 
                    "value"         => array(
                        esc_html__('Yes', 'easybook-add-ons')     => 'yes', 
                        esc_html__('No', 'easybook-add-ons')      => 'no', 
                    ),  
                    "std"           => 'yes',
                ),
                
                // array(
                //     "type"          => "dropdown", 
                //     "heading"       => esc_html__('Is Sidebar Filter', 'easybook-add-ons'), 
                //     "param_name"    => "sidebar_filter", 
                //     "value"         => array(
                //         esc_html__('Yes', 'easybook-add-ons')     => 'yes', 
                //         esc_html__('No', 'easybook-add-ons')      => 'no', 
                //     ),  
                //     "std"           => 'no',
                //     'dependency'        => array(
                //         'element'   => 'show_filter',
                //         'value'     => array( 'yes' ),
                //         'not_empty' => false,
                //     ),
                // ),
                // array(
                //     "type" => "textfield", 
                //     "holder" => "div",
                //     "heading" => esc_html__("Sidebar Title", 'easybook-add-ons'), 
                //     "param_name" => "sidebar_title", 
                //     'value'         => 'Our Portfolios',
                //     'dependency'        => array(
                //         'element'   => 'sidebar_filter',
                //         'value'     => array( 'yes' ),
                //         'not_empty' => false,
                //     ),
                // ), 
                // array(
                //     "type" => "dropdown", 
                //     "class" => "", 
                //     "heading" => esc_html__('Filter Width', 'easybook-add-ons'), 
                //     "param_name" => "filter_width", 
                //     "value" => array(
                //         esc_html__('Fixed Width', 'easybook-add-ons') => 'container', 
                //         esc_html__('Fullwidth', 'easybook-add-ons') => 'full-container', 
                //     ), 
                    
                //     "std" => 'full-container',
                //     'dependency'        => array(
                //         'element'   => 'show_filter',
                //         'value'     => array( 'yes' ),
                //         'not_empty' => false,
                //     ),
                // ), 

                // array(
                //     "type" => "dropdown", 
                //     "class" => "", 
                //     "heading" => esc_html__('Show Counter', 'easybook-add-ons'), 
                //     "param_name" => "show_counter", 
                //     "value" => array(
                //         esc_html__('Yes', 'easybook-add-ons') => 'yes', 
                //         esc_html__('No', 'easybook-add-ons') => 'no', 
                //     ), 
                    
                //     "std" => 'yes',
                //     'dependency'        => array(
                //         'element'   => 'show_filter',
                //         'value'     => array( 'yes' ),
                //         'not_empty' => false,
                //     ),
                // ), 

                array(
                    "type" => "textfield", 
                    "holder" => "div",
                    "heading" => esc_html__("Enter Portfolio IDs", 'easybook-add-ons'), 
                    "param_name" => "ids", 
                    "description" => esc_html__("Enter portfolio ids to show, separated by a comma. Leave empty to get all.", 'easybook-add-ons')
                ), 
                array(
                    "type" => "textfield", 
                    // "holder" => "div",
                    "heading" => esc_html__("Portfolio IDs to Exclude", 'easybook-add-ons'), 
                    "param_name" => "ids_not", 
                    "description" => esc_html__("Enter portfolio ids to exclude, separated by a comma. Use if the field above is empty. Leave empty to get all.", 'easybook-add-ons')
                ), 
                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Order Portfolios by', 'easybook-add-ons'), 
                    "param_name" => "order_by", 
                    "value" => array(
                        esc_html__('Date', 'easybook-add-ons') => 'date', 
                        esc_html__('ID', 'easybook-add-ons') => 'ID', 
                        esc_html__('Author', 'easybook-add-ons') => 'author', 
                        esc_html__('Title', 'easybook-add-ons') => 'title', 
                        esc_html__('Modified', 'easybook-add-ons') => 'modified',
                    ), 
                    "description" => esc_html__("Order Portfolios by", 'easybook-add-ons'), 
                    "std" => 'date',
                ), 
                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Order Portfolios', 'easybook-add-ons'), 
                    "param_name" => "order", 
                    "value" => array(
                        esc_html__('Ascending', 'easybook-add-ons') => 'ASC',
                        esc_html__('Descending', 'easybook-add-ons') => 'DESC', 
                        
                    ), 
                    "description" => esc_html__("Order Portfolios", 'easybook-add-ons'),
                    "std" => 'DESC',
                ), 
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "heading" => esc_html__("Post to show", 'easybook-add-ons'),
                    "param_name" => "posts_per_page",
                    "description" => esc_html__("Number of portfolio items to show (-1 for all).", 'easybook-add-ons'),
                    "value"=> '12',
                ),

                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Content Width', 'easybook-add-ons'), 
                    "param_name" => "folio_content_width", 
                    "value" => array(
                        esc_html__('Small Boxed', 'easybook-add-ons') => 'boxed-container',
                        esc_html__('Wide Boxed', 'easybook-add-ons') => 'big-container', 
                        esc_html__('Fullwidth', 'easybook-add-ons') => 'full-container', 
                        
                    ), 
                    
                    "std" => 'full-container',
                ),


                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Grid Columns', 'easybook-add-ons'), 
                    "param_name" => "columns_grid", 
                    "value" => array(
                        esc_html__('One Column', 'easybook-add-ons') => 'one',
                        esc_html__('Two Columns', 'easybook-add-ons') => 'two', 
                        esc_html__('Three Columns', 'easybook-add-ons') => 'three', 
                        esc_html__('Four Columns', 'easybook-add-ons') => 'four', 
                        esc_html__('Five Columns', 'easybook-add-ons') => 'five', 
                        esc_html__('Six Columns', 'easybook-add-ons') => 'six', 
                        esc_html__('Seven Columns', 'easybook-add-ons') => 'seven', 
                        esc_html__('Eight Columns', 'easybook-add-ons') => 'eight', 
                        esc_html__('Nine Columns', 'easybook-add-ons') => 'nine', 
                        esc_html__('Ten Columns', 'easybook-add-ons') => 'ten', 
                        
                    ), 
                    
                    "std" => 'four',
                ),
                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Spacing', 'easybook-add-ons'), 
                    "param_name" => "spacing", 
                    "value" => array(
                        esc_html__('Extra Small', 'easybook-add-ons') => 'extrasmall',
                        esc_html__('Small', 'easybook-add-ons') => 'small',
                        esc_html__('Medium', 'easybook-add-ons') => 'medium',
                        esc_html__('Big', 'easybook-add-ons') => 'big', 
                        esc_html__('None', 'easybook-add-ons') => 'no',  
                        
                    ), 
                    "std" => 'extrasmall',
                ),

                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Show Categories', 'easybook-add-ons'), 
                    "param_name" => "show_cat", 
                    "value" => array(
                        esc_html__('Yes', 'easybook-add-ons') => 'yes', 
                        esc_html__('No', 'easybook-add-ons') => 'no', 
                    ), 
                    
                    "std" => 'yes',
                ), 

                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Show Excerpt', 'easybook-add-ons'), 
                    "param_name" => "show_excerpt", 
                    "value" => array(
                        esc_html__('No', 'easybook-add-ons') => 'no',
                        esc_html__('Yes', 'easybook-add-ons') => 'yes', 
                         
                    ), 
                  
                    "std" => 'no',
                ), 
                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Show View Project', 'easybook-add-ons'), 
                    "param_name" => "show_view_project", 
                    "value" => array(
                        esc_html__('Yes', 'easybook-add-ons') => 'yes', 
                        esc_html__('No', 'easybook-add-ons') => 'no', 
                    ), 
                
                    "std" => 'yes',
                ), 


                


                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Enable Gallery', 'easybook-add-ons'), 
                    "param_name" => "enable_gallery", 
                    "value" => array(
                        esc_html__('Yes', 'easybook-add-ons') => 'yes', 
                        esc_html__('No', 'easybook-add-ons') => 'no', 
                    ), 
                    "std" => 'yes',
                    
                ), 

                
                array(
                    "type"              => "dropdown", 
                    "class"             => "", 
                    "heading"           => esc_html__('Use INFINITE scroll to load more items?', 'easybook-add-ons'), 
                    "param_name"        => "show_loadmore", 
                    "value" => array(
                        esc_html__('Yes', 'easybook-add-ons')     => 'yes', 
                        esc_html__('No', 'easybook-add-ons')      => 'no', 
                    ), 
                    "std"               => 'yes',
                ), 

                array(
                    "type"              => "textfield",
                    "holder"            => "div",
                    "heading"           => esc_html__("Load more items", 'easybook-add-ons'),
                    "param_name"        => "loadmore_posts",
                    "description"       => esc_html__("Number of items to get on additional load.", 'easybook-add-ons'),
                    "value"             => '3',
                    'dependency'        => array(
                        'element'   => 'show_loadmore',
                        'value'     => array( 'yes' ),
                        'not_empty' => false,
                    ),
                ),

                array(
                    "type"              => "dropdown", 
                    "class"             => "", 
                    "heading"           => esc_html__('Show Pagination', 'easybook-add-ons'), 
                    "param_name"        => "show_pagination", 
                    "value"             => array(
                        esc_html__('Yes', 'easybook-add-ons')         => 'yes', 
                        esc_html__('No', 'easybook-add-ons')          => 'no', 
                    ), 
                    "std"               => 'no',
                    'dependency'        => array(
                        'element'   => 'show_loadmore',
                        'value'     => array( 'no' ),
                        'not_empty' => false,
                    ),
                ), 


                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
                    "param_name"    => "el_class",
                    "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
                ),
                array(
                    'type'          => 'css_editor',
                    'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
                    'param_name'    => 'css',
                    'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
                ),


            )));


        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_EasyBook_Portfolios extends WPBakeryShortCode {}
        }


    // vc_map( array(
    //     "name"                      => esc_html__("Image Carousel", 'easybook-add-ons'),
    //     "description"               => esc_html__("with multi images selection",'easybook-add-ons'),
    //     "base"                      => "easybook_image_carousel",
    //     "category"                  => 'EasyBook Portfolio',
    //     "content_element"           => true,
    //     "show_settings_on_create"   => true,
    //     "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
    //     //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_image_carousel.php',
    //     "params"                    => array(
    //         array(
    //             "type"          => "attach_images",
    //             "holder"        => "div",
    //             "class"         => "ajax-vc-img",
    //             "heading"       => esc_html__("Slide Images", 'easybook-add-ons'),
    //             "param_name"    => "slideimages",
    //         ),
    //         array(
    //             "type"          => "textfield",
    //             "heading"       => esc_html__("Speed", 'easybook-add-ons'),
    //             "param_name"    => "speed",
    //             "value"         =>'1000',
    //             "description"   => esc_html__("Duration of transition between slides (in ms). Default: 1000", 'easybook-add-ons')
    //         ),
    //         array(
    //             "type"          => "dropdown",
    //             "class"         =>"",
    //             "heading"       => esc_html__('Direction', 'easybook-add-ons'),
    //             "param_name"    => "direction",
    //             "value"         => array(   
    //                                 esc_html__('Horizontal', 'easybook-add-ons') => 'horizontal',  
    //                                 esc_html__('Vertical', 'easybook-add-ons') => 'vertical',                                                                                
    //                             ),
    //             'std'           => 'horizontal'
    //         ),
    //         array(
    //             "type"          => "dropdown",
    //             "class"         =>"",
    //             "heading"       => esc_html__('Effect', 'easybook-add-ons'),
    //             "param_name"    => "effect",
    //             "value"         => array(   
    //                                 esc_html__('Slide', 'easybook-add-ons') => 'slide',  
    //                                 esc_html__('Fade', 'easybook-add-ons') => 'fade',                                                                                
    //                                 esc_html__('Cube', 'easybook-add-ons') => 'cube',                                                                                
    //                                 esc_html__('Coverflow', 'easybook-add-ons') => 'coverflow',                                                                                
    //                                 esc_html__('Flip', 'easybook-add-ons') => 'flip',                                                                                
    //                             ),
    //             'std'           => 'slide'
    //         ),
    //         array(
    //             "type"          => "textfield",
    //             "heading"       => esc_html__("Auto Play", 'easybook-add-ons'),
    //             "param_name"    => "autoplay",
    //             "description"   => esc_html__("Number in mili-second (5000), leave it blank to disable", 'easybook-add-ons'),
    //             'value'         => ''
    //         ),
    //         array(
    //             "type"          => "dropdown",
    //             "class"         =>"",
    //             "heading"       => esc_html__('Loop', 'easybook-add-ons'),
    //             "param_name"    => "loop",
    //             "value"         => array(   
    //                                 esc_html__('No', 'easybook-add-ons') => 'no',  
    //                                 esc_html__('Yes', 'easybook-add-ons') => 'yes',                                                                                
    //                             ),
    //             "description"   => esc_html__("Set this to Yes to enable continuous loop mode", 'easybook-add-ons'), 
    //             'std'           =>'no'
    //         ),
    //         array(
    //             "type"          => "dropdown",
    //             "class"         =>"",
    //             "heading"       => esc_html__('Show Navigation', 'easybook-add-ons'),
    //             "param_name"    => "show_nav",
    //             "value"         => array(   
    //                                 esc_html__('Yes', 'easybook-add-ons') => 'yes',  
    //                                 esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
    //                             ),
    //             'std'           =>'yes'
    //         ),
    //         array(
    //             "type"          => "dropdown",
    //             "class"         =>"",
    //             "heading"       => esc_html__('Show Scroll Bar', 'easybook-add-ons'),
    //             "param_name"    => "show_scrollbar",
    //             "value"         => array(   
    //                                 esc_html__('Yes', 'easybook-add-ons') => 'yes',  
    //                                 esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
    //                             ),
    //             'std'           =>'yes'
    //         ),
    //         array(
    //             "type"          => "dropdown",
    //             "class"         =>"",
    //             "heading"       => esc_html__('Mouse Wheel Control', 'easybook-add-ons'),
    //             "param_name"    => "mousewheel",
    //             "value"         => array(   
    //                                 esc_html__('Yes', 'easybook-add-ons') => 'yes',  
    //                                 esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
    //                             ),
    //             "description"   => esc_html__("Set this to Yes if you want to enable navigation through slides using mouse wheel", 'easybook-add-ons'), 
    //             'std'           =>'no'
    //         ),
    //         array(
    //             "type"          => "dropdown",
    //             "class"         =>"",
    //             "heading"       => esc_html__('Keyboard Control', 'easybook-add-ons'),
    //             "param_name"    => "keyboard",
    //             "value"         => array(   
    //                                 esc_html__('Yes', 'easybook-add-ons') => 'yes',  
    //                                 esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
    //                             ),
    //             "description"   => esc_html__("Set this to Yes if you want to enable navigation through slides using keyboard arrows", 'easybook-add-ons'), 
    //             'std'           =>'yes'
    //         ),
            
             
    //         array(
    //             "type"          => "dropdown",
    //             "class"         =>"",
    //             "heading"       => esc_html__('Disable Image Zoom', 'easybook-add-ons'),
    //             "param_name"    => "disable_zoom",
    //             "value"         => array(   
    //                                 esc_html__('No', 'easybook-add-ons') => 'no', 
    //                                 esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                                                                                                   
    //                             ),
    //             'std'           =>'no'
                
    //         ),
    //         array(
    //             "type"          => "textfield",
    //             "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
    //             "param_name"    => "el_class",
    //             "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
    //         ),

    //         array(
    //             'type'          => 'css_editor',
    //             'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
    //             'param_name'    => 'css',
    //             'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
    //         ),
            
    //     ),
    //     'admin_enqueue_js'      => EASYBOOK_ADD_ONS_DIR_URL . "inc/assets/easybook-elements.js",
    //     'js_view'=> 'EasyBookImagesView',
    // ));

    // if ( class_exists( 'WPBakeryShortCode' ) ) {
    //     class WPBakeryShortCode_EasyBook_Image_Carousel extends WPBakeryShortCode {}
    // }
        

        // vc_map( array(
        //     "name"      => esc_html__("Post Masonry Grid", 'easybook-add-ons'),
            
        //     "base"      => "easybook_post_masonry_list",
        //     "class"     => "",
        //     "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
        //     //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_post_masonry_list.php',
        //     "category"  => 'EasyBook Theme',
        //     "show_settings_on_create" => true,
        //     "params"    => array( 
        //         array(
        //             "type" => "textfield", 
        //             "heading" => esc_html__("Post Category IDs to include", 'easybook-add-ons'), 
        //             "param_name" => "cat_ids", 
        //             "description" => esc_html__("Enter post category ids to include, separated by a comma. Leave empty to get posts from all categories.", 'easybook-add-ons')
        //         ), 
        //         array(
        //             "type" => "textfield", 
        //             "holder" => "div",
        //             "heading" => esc_html__("Enter Post IDs", 'easybook-add-ons'), 
        //             "param_name" => "ids", 
        //             "description" => esc_html__("Enter Post ids to show, separated by a comma. Leave empty to show all.", 'easybook-add-ons')
        //         ), 
        //         array(
        //             "type" => "textfield", 
                    
        //             "heading" => esc_html__("Or Post IDs to Exclude", 'easybook-add-ons'), 
        //             "param_name" => "ids_not", 
        //             "description" => esc_html__("Enter post ids to exclude, separated by a comma (,). Use if the field above is empty.", 'easybook-add-ons')
        //         ), 
                
        //         array(
        //             "type" => "dropdown", 
        //             "class" => "", 
        //             "heading" => esc_html__('Order by', 'easybook-add-ons'), 
        //             "param_name" => "order_by", 
        //             "value" => array(
        //                 esc_html__('Date', 'easybook-add-ons') => 'date', 
        //                 esc_html__('ID', 'easybook-add-ons') => 'ID', 
        //                 esc_html__('Author', 'easybook-add-ons') => 'author', 
        //                 esc_html__('Title', 'easybook-add-ons') => 'title', 
        //                 esc_html__('Modified', 'easybook-add-ons') => 'modified',
        //                 esc_html__('Random', 'easybook-add-ons') => 'rand',
        //                 esc_html__('Comment Count', 'easybook-add-ons') => 'comment_count',
        //                 esc_html__('Menu Order', 'easybook-add-ons') => 'menu_order',
        //             ), 
        //             "description" => esc_html__("Select how to sort retrieved posts. More at ", 'easybook-add-ons').'<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.', 
        //             "std" => 'date',
        //         ), 
        //         array(
        //             "type" => "dropdown", 
        //             "class" => "", 
        //             "heading" => esc_html__('Sort Order', 'easybook-add-ons'), 
        //             "param_name" => "order", 
        //             "value" => array(
        //                 esc_html__('Ascending', 'easybook-add-ons') => 'ASC',
        //                 esc_html__('Descending', 'easybook-add-ons') => 'DESC', 
                        
        //             ), 
        //             "description" => esc_html__("Select Ascending or Descending order. More at", 'easybook-add-ons').'<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.', 
        //             "std" => 'DESC',
        //         ), 
        //         array(
        //             "type" => "textfield",
        //             "holder" => "div",
        //             "heading" => esc_html__("Posts to show", 'easybook-add-ons'),
        //             "param_name" => "posts_per_page",
        //             "description" => esc_html__("Number of posts to show (-1 for all).", 'easybook-add-ons'),
        //             "value"=> '8',
        //         ),

        //         array(
        //             "type" => "dropdown", 
        //             "class" => "", 
        //             "heading" => esc_html__('Columns Grid', 'easybook-add-ons'), 
        //             "param_name" => "columns_grid", 
        //             "value" => array(
        //                 esc_html__('One Column', 'easybook-add-ons') => 'one',
        //                 esc_html__('Two Columns', 'easybook-add-ons') => 'two', 
        //                 esc_html__('Three Columns', 'easybook-add-ons') => 'three', 
        //                 esc_html__('Four Columns', 'easybook-add-ons') => 'four', 
        //                 esc_html__('Five Columns', 'easybook-add-ons') => 'five', 
                        
        //             ), 
                    
        //             "std" => 'two',
        //         ),
                
        //         array(
        //             "type" => "dropdown", 
        //             "class" => "", 
        //             "heading" => esc_html__('Show Pagination', 'easybook-add-ons'), 
        //             "param_name" => "show_pagination", 
        //             "value" => array(
        //                 esc_html__('Yes', 'easybook-add-ons') => 'yes', 
        //                 esc_html__('No', 'easybook-add-ons') => 'no', 
        //             ), 
                    
        //             "std" => 'yes',
        //         ), 
                
        //         array(
        //             "type" => "textfield",
        //             "heading" => esc_html__("Extra class name", 'easybook-add-ons'),
        //             "param_name" => "el_class",
        //             "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
        //         ),
        //         array(
        //             'type' => 'css_editor',
        //             'heading' => esc_html__( 'Css', 'easybook-add-ons' ),
        //             'param_name' => 'css',
        //             'group' => esc_html__( 'Design options', 'easybook-add-ons' ),
        //         ),

        //     )));


        // if ( class_exists( 'WPBakeryShortCode' ) ) {
        //     class WPBakeryShortCode_EasyBook_Post_Masonry_List extends WPBakeryShortCode {}
        // }

        vc_map( array(
            "name"      => esc_html__("Posts List", 'easybook-add-ons'),
            "base"      => "easybook_posts",
            "class"     => "",
            "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_posts.php',
            "category"  => 'EasyBook Theme',
            "show_settings_on_create" => true,
            "params"    => array( 
                array(
                    "type" => "textfield", 
                    "heading" => esc_html__("Post Category IDs to include", 'easybook-add-ons'), 
                    "param_name" => "cat_ids", 
                    "description" => esc_html__("Enter post category ids to include, separated by a comma. Leave empty to get posts from all categories.", 'easybook-add-ons')
                ), 
                array(
                    "type" => "textfield", 
                    "holder" => "div",
                    "heading" => esc_html__("Enter Post IDs", 'easybook-add-ons'), 
                    "param_name" => "ids", 
                    "description" => esc_html__("Enter Post ids to show, separated by a comma. Leave empty to show all.", 'easybook-add-ons')
                ), 
                array(
                    "type" => "textfield", 
                    // "holder" => "div",
                    "heading" => esc_html__("Or Post IDs to Exclude", 'easybook-add-ons'), 
                    "param_name" => "ids_not", 
                    "description" => esc_html__("Enter post ids to exclude, separated by a comma (,). Use if the field above is empty.", 'easybook-add-ons')
                ), 
                
                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Order by', 'easybook-add-ons'), 
                    "param_name" => "order_by", 
                    "value" => array(
                        esc_html__('Date', 'easybook-add-ons') => 'date', 
                        esc_html__('ID', 'easybook-add-ons') => 'ID', 
                        esc_html__('Author', 'easybook-add-ons') => 'author', 
                        esc_html__('Title', 'easybook-add-ons') => 'title', 
                        esc_html__('Modified', 'easybook-add-ons') => 'modified',
                        esc_html__('Random', 'easybook-add-ons') => 'rand',
                        esc_html__('Comment Count', 'easybook-add-ons') => 'comment_count',
                        esc_html__('Menu Order', 'easybook-add-ons') => 'menu_order',
                    ), 
                    "description" => esc_html__("Select how to sort retrieved posts. More at ", 'easybook-add-ons').'<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.', 
                    "std" => 'date',
                ), 
                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Sort Order', 'easybook-add-ons'), 
                    "param_name" => "order", 
                    "value" => array(
                        esc_html__('Ascending', 'easybook-add-ons') => 'ASC',
                        esc_html__('Descending', 'easybook-add-ons') => 'DESC', 
                        
                    ), 
                    "description" => esc_html__("Select Ascending or Descending order. More at", 'easybook-add-ons').'<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.', 
                    "std" => 'DESC',
                ), 
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "heading" => esc_html__("Posts to show", 'easybook-add-ons'),
                    "param_name" => "posts_per_page",
                    "description" => esc_html__("Number of posts to show (-1 for all).", 'easybook-add-ons'),
                    "value"=> '5',
                ),

                
                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Show Pagination', 'easybook-add-ons'), 
                    "param_name" => "show_pagination", 
                    "value" => array(
                        esc_html__('Yes', 'easybook-add-ons') => 'yes', 
                        esc_html__('No', 'easybook-add-ons') => 'no', 
                    ), 
                    
                    "std" => 'yes',
                ), 
                
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Extra class name", 'easybook-add-ons'),
                    "param_name" => "el_class",
                    "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => esc_html__( 'Css', 'easybook-add-ons' ),
                    'param_name' => 'css',
                    'group' => esc_html__( 'Design options', 'easybook-add-ons' ),
                ),

            )));


        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_EasyBook_Posts extends WPBakeryShortCode {}
        }



        vc_map( array(
            "name"      => esc_html__("Google Map", 'easybook-add-ons'),
            "description" => esc_html__("EasyBook google map style",'easybook-add-ons'),
            "base"      => "easybook_gmap",
            "class"     => "",
            "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_gmap.php',
            "category"  => 'EasyBook Theme',
            
            "show_settings_on_create" => true,
            "params"    => array(
                array(
                    "type" => "textfield",
                    "class"=>"",
                    "holder"=>'div',
                    "heading" => esc_html__('Address Latitude', 'easybook-add-ons'),
                    "param_name" => "map_lat",
                    "value" => "40.7143528",
                    "description" => wp_kses(__("Enter your address latitude. You can get your value from: <a href='http://www.gps-coordinates.net/' target='_blank'>http://www.gps-coordinates.net/</a>", 'easybook-add-ons'),array('a'=>array('href'=>array(),'target'=>array()))),
                ),
                array(
                    "type" => "textfield",
                    "class"=>"",
                    "holder"=>'div',
                    "heading" => esc_html__('Address Longtitude', 'easybook-add-ons'),
                    "param_name" => "map_long",
                    "value" => "-74.0059731",
                    "description" => wp_kses(__("Enter your address longtitude. You can get your value from: <a href='http://www.gps-coordinates.net/' target='_blank'>http://www.gps-coordinates.net/</a>", 'easybook-add-ons'),array('a'=>array('href'=>array(),'target'=>array()))), 
                    
                ),
                array(
                    "type" => "textfield",
                    "class"=>"",
                    "holder"=>'div',
                    "heading" => esc_html__('Address String', 'easybook-add-ons'),
                    "param_name" => "map_address",
                    "value" => "Our office - New York City",
                    "description" => esc_html__("Address String", 'easybook-add-ons'), 
                ),
                array(
                    "type"      => "textarea",
                    "class"     => "",
                    "holder"     => "span",
                    "heading"   => esc_html__("Additional Address Setting", 'easybook-add-ons'),
                    "param_name"=> "add_address",
                    "value"     => "",
                    "description" => wp_kses(__("Address must be separated by `|`. Format: Latitude;Longitude;String_Address<p>Ex: 40.7168183;-73.9973402;EasyBook - Washington|40.73334016;-73.99330616;EasyBook - Florida</p>", 'easybook-add-ons'),array('p'=>array('class'=>array(),),) ), 
                ),
                array(
                    "type" => "textfield",
                    "class"=>"",
                    "holder"=>'div',
                    "heading" => esc_html__('Map Zoom', 'easybook-add-ons'),
                    "param_name" => "map_zoom",
                    "value" => "14",
                    "description" => esc_html__("Map Zoom", 'easybook-add-ons'), 
                    
                ),
                array(
                    "type"      => "attach_image",
                    "class"     => "",
                    "heading"   => esc_html__("Map Marker", 'easybook-add-ons'),
                    "param_name"=> "map_marker",
                    "value"     => "",
                    "description" => esc_html__("Upload google map marker or leave it empty to use default.", 'easybook-add-ons')
                ),
                array(
                    "type" => "textfield",
                    "class"=>"",
                    // "holder"=>'div',
                    "heading" => esc_html__('Map Height', 'easybook-add-ons'),
                    "param_name" => "map_height",
                    "value" => "500",
                    "description" => esc_html__("Enter your map height in pixel. Default: 500", 'easybook-add-ons'), 
                    
                ),
                array(
                    "type" => "dropdown",
                    "class"=>"",
                    "heading" => esc_html__('Use Default Style', 'easybook-add-ons'),
                    "param_name" => "default_style",
                    "value" => array(   
                                    esc_html__('No', 'easybook-add-ons') => 'false',  
                                    esc_html__('Yes', 'easybook-add-ons') => 'true',                                                                                
                                ),
                    "description" => esc_html__("Set this to Yes to use default Google map style.", 'easybook-add-ons'), 
                    'std'=>'false'
                ),
                array(
                    "type" => "dropdown",
                    
                    "heading" => esc_html__('Show Zoom Control', 'easybook-add-ons'),
                    "param_name" => "zoom_control",
                    "value" => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => '1',  
                                    esc_html__('No', 'easybook-add-ons') => '0',                                                                                
                                ),
                    
                    'std'=>'1'
                ),
                array(
                    "type" => "dropdown",
                    
                    "heading" => esc_html__('Show MapType Control', 'easybook-add-ons'),
                    "param_name" => "maptype_control",
                    "value" => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => '1',  
                                    esc_html__('No', 'easybook-add-ons') => '0',                                                                                
                                ),
                    
                    'std'=>'1'
                ),
                array(
                    "type" => "dropdown",
                    
                    "heading" => esc_html__('Show Scale Control', 'easybook-add-ons'),
                    "param_name" => "scale_control",
                    "value" => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => '1',  
                                    esc_html__('No', 'easybook-add-ons') => '0',                                                                                
                                ),
                    
                    'std'=>'1'
                ),
                array(
                    "type" => "dropdown",
                    
                    "heading" => esc_html__('Scroll Wheel Control', 'easybook-add-ons'),
                    "param_name" => "scroll_wheel",
                    "value" => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => '1',  
                                    esc_html__('No', 'easybook-add-ons') => '0',                                                                                
                                ),
                    
                    'std'=>'0'
                ),
                array(
                    "type" => "dropdown",
                    
                    "heading" => esc_html__('EasyBook View Control', 'easybook-add-ons'),
                    "param_name" => "easybook_view",
                    "value" => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => '1',  
                                    esc_html__('No', 'easybook-add-ons') => '0',                                                                                
                                ),
                    
                    'std'=>'1'
                ),
                array(
                    "type" => "dropdown",
                    
                    "heading" => esc_html__('Draggable Control', 'easybook-add-ons'),
                    "param_name" => "draggable",
                    "value" => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => '1',  
                                    esc_html__('No', 'easybook-add-ons') => '0',                                                                                
                                ),
                    
                    'std'=>'1'
                ),
                
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Extra class name", 'easybook-add-ons'),
                    "param_name" => "el_class",
                    "value"=>'',
                    "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
                ),

                array(
                    'type' => 'css_editor',
                    'heading' => esc_html__( 'Css', 'easybook-add-ons' ),
                    'param_name' => 'css',
                    'group' => esc_html__( 'Design options', 'easybook-add-ons' ),
                ),
            )
        ));

        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_EasyBook_Gmap extends WPBakeryShortCode {}
        }



        

        vc_map( array(
            "name"                      => esc_html__("Members Grid", 'easybook-add-ons'),
            "description"               => esc_html__("A column grid of member elements",'easybook-add-ons'),
            "base"                      => "easybook_members",
            "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_members.php',
            "category"                  => 'EasyBook Theme',
            "show_settings_on_create"   => true,
            "params"                    => array(
                array(
                    "type"          => "textfield",
                    "holder"        => "div",
                    "class"         => "",
                    "heading"       => esc_html__("Count", 'easybook-add-ons'),
                    "param_name"    => "count",
                    "value"         => "3",
                    "description"   => esc_html__("Number of Members to show. -1 to display all.", 'easybook-add-ons')
                ),
                array(
                    "type"          => "dropdown",
                    "class"         =>"",
                    "heading"       => esc_html__('Order by', 'easybook-add-ons'),
                    "param_name"    => "order_by",
                    "value"         => array(   
                        esc_html__('Date', 'easybook-add-ons')        => 'date',  
                        esc_html__('ID', 'easybook-add-ons')          => 'ID',  
                        esc_html__('Author', 'easybook-add-ons')      => 'author',       
                        esc_html__('Title', 'easybook-add-ons')       => 'title',  
                        esc_html__('Modified', 'easybook-add-ons')    => 'modified',  
                    ),
                    "description"   => esc_html__("Order by", 'easybook-add-ons'),  
                    "std"           =>'date',    
                ),
                array(
                    "type"          => "dropdown",
                    "class"         =>"",
                    "heading"       => esc_html__('Sort Order', 'easybook-add-ons'),
                    "param_name"    => "order",
                    "value"         => array(   
                        esc_html__('Descending', 'easybook-add-ons')  => 'DESC',
                        esc_html__('Ascending', 'easybook-add-ons')   => 'ASC',  
                                                                                                                      
                    ),
                    "description"   => esc_html__("Order", 'easybook-add-ons'),    
                    "std"           =>"DESC",  
                ),


                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Or Enter Member IDs", 'easybook-add-ons'),
                    "param_name"    => "ids",
                    "description"   => esc_html__("Enter Member ids to show, separated by a comma. (ex: 99,100)", 'easybook-add-ons')
                ),
                
                
                array(
                    "type"          => "dropdown", 
                    "class"         => "", 
                    "heading"       => esc_html__('Grid Columns', 'easybook-add-ons'), 
                    "param_name"    => "thumbnail_cols", 
                    "value"         => array(
                        esc_html__('One Column', 'easybook-add-ons')      => 'col-md-12',
                        esc_html__('Two Columns', 'easybook-add-ons')     => 'col-md-6', 
                        
                        esc_html__('Three Columns', 'easybook-add-ons')   => 'col-md-4', 
                        
                        esc_html__('Four Columns', 'easybook-add-ons')    => 'col-md-3', 
                        esc_html__('Six Columns', 'easybook-add-ons')     => 'col-md-2', 
                         
                    ), 
                    
                    "std"           => 'col-md-6',
                ), 
                array(
                    "type"          => "dropdown", 
                    "class"         => "", 
                    "heading"       => esc_html__('Tablet Grid Columns', 'easybook-add-ons'), 
                    "param_name"    => "tablet_cols", 
                    "value"         => array(
                        esc_html__('One Column', 'easybook-add-ons')      => 'col-sm-12',
                        esc_html__('Two Columns', 'easybook-add-ons')     => 'col-sm-6', 
                        
                        esc_html__('Three Columns', 'easybook-add-ons')   => 'col-sm-4', 
                        
                        esc_html__('Four Columns', 'easybook-add-ons')    => 'col-sm-3', 
                        esc_html__('Six Columns', 'easybook-add-ons')     => 'col-sm-2', 
                        
                        
                        
                         
                    ), 
                    
                    "std"           => 'col-sm-6',
                ), 
                array(
                    "type"          => "dropdown", 
                    "class"         => "", 
                    "heading"       => esc_html__('Mobile Grid Columns', 'easybook-add-ons'), 
                    "param_name"    => "mobile_cols", 
                    "value"         => array(
                        esc_html__('One Column', 'easybook-add-ons')      => 'col-xs-12',
                        esc_html__('Two Columns', 'easybook-add-ons')     => 'col-xs-6', 
                        
                        esc_html__('Three Columns', 'easybook-add-ons')   => 'col-xs-4', 
                        
                        esc_html__('Four Columns', 'easybook-add-ons')    => 'col-xs-3', 
                        esc_html__('Six Columns', 'easybook-add-ons')     => 'col-xs-2', 
                        
                        
                        
                         
                    ), 
                    
                    "std"           => 'col-xs-12',
                ), 
                
                

                array(
                    "type"          => "dropdown", 
                    "class"         => "", 
                    "heading"       => esc_html__('Show Excerpt', 'easybook-add-ons'), 
                    "param_name"    => "show_excerpt", 
                    "value"         => array(
                        esc_html__('Yes', 'easybook-add-ons')     => 'yes', 
                        esc_html__('No', 'easybook-add-ons')      => 'no', 
                    ), 
                    
                    "std"           => 'yes',
                ),

                array(
                    "type"          => "dropdown", 
                    "class"         => "", 
                    "heading"       => esc_html__('Link to Member detail\'s page', 'easybook-add-ons'), 
                    "param_name"    => "show_readmore", 
                    "value"         => array(
                        esc_html__('Yes', 'easybook-add-ons')     => 'yes', 
                        esc_html__('No', 'easybook-add-ons')      => 'no', 
                    ), 
                    
                    "std"           => 'yes',
                ),

                array(
                    "type"          => "dropdown", 
                    "class"         => "", 
                    "heading"       => esc_html__('Show Pagination', 'easybook-add-ons'), 
                    "param_name"    => "show_pagination", 
                    "value"         => array(
                        esc_html__('Yes', 'easybook-add-ons')     => 'yes', 
                        esc_html__('No', 'easybook-add-ons')      => 'no', 
                    ), 
                    
                    "std"           => 'no',
                ),

                

                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
                    "param_name"    => "el_class",
                    "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
                ),
                array(
                    'type'          => 'css_editor',
                    'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
                    'param_name'    => 'css',
                    'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
                ),
            )));

        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_EasyBook_Members extends WPBakeryShortCode {}
        }


        vc_map( array(
           "name"      => esc_html__("Single Member", 'easybook-add-ons'),
           "description" => esc_html__("Single member",'easybook-add-ons'),
           "base"      => "easybook_member",
           "class"     => "",
            "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_member.php',
           "category"  => 'EasyBook Theme',
           "show_settings_on_create" => true,
           "params"    => array(
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Enter Member ID", 'easybook-add-ons'),
                    "param_name" => "id",
                    "description" => esc_html__("Enter Member id to show (Ex: 99).", 'easybook-add-ons')
                ), 
                
                

                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Show Excerpt', 'easybook-add-ons'), 
                    "param_name" => "show_excerpt", 
                    "value" => array(
                        esc_html__('Yes', 'easybook-add-ons') => 'yes', 
                        esc_html__('No', 'easybook-add-ons') => 'no', 
                    ), 
                    
                    "std" => 'yes',
                ),

                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Link to Member detail\'s page', 'easybook-add-ons'), 
                    "param_name" => "show_readmore", 
                    "value" => array(
                        esc_html__('Yes', 'easybook-add-ons') => 'yes', 
                        esc_html__('No', 'easybook-add-ons') => 'no', 
                    ), 
                    
                    "std" => 'yes',
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Extra class name", 'easybook-add-ons'),
                    "param_name" => "el_class",
                    "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => esc_html__( 'Css', 'easybook-add-ons' ),
                    'param_name' => 'css',
                    'group' => esc_html__( 'Design options', 'easybook-add-ons' ),
                ),
            )
        ));
        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_EasyBook_Member extends WPBakeryShortCode {}
        }

        // vc_map( array(
        //     "name"                      => esc_html__("Resumes List", 'easybook-add-ons'),
        //     "description"               => esc_html__("A list of EasyBook Resumes items",'easybook-add-ons'),
        //     "base"                      => "easybook_resumes",
        //     "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
        //     //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_resumes.php',
        //     "category"                  => 'EasyBook Theme',
        //     "show_settings_on_create"   => true,
        //     "params"                    => array(
        //         array(
        //             "type"          => "textfield",
        //             "admin_label"   => true,
        //             "heading"       => esc_html__("Count", 'easybook-add-ons'),
        //             "param_name"    => "count",
        //             "value"         => "3",
        //             "description"   => esc_html__("Number of Resumes to show. -1 to display all.", 'easybook-add-ons')
        //         ),
        //         array(
        //             "type"          => "dropdown",
        //             "heading"       => esc_html__('Order by', 'easybook-add-ons'),
        //             "param_name"    => "order_by",
        //             "value"         => array(   
        //                 esc_html__('Date', 'easybook-add-ons')        => 'date',  
        //                 esc_html__('ID', 'easybook-add-ons')          => 'ID',  
        //                 esc_html__('Author', 'easybook-add-ons')      => 'author',       
        //                 esc_html__('Title', 'easybook-add-ons')       => 'title',  
        //                 esc_html__('Modified', 'easybook-add-ons')    => 'modified',  
        //             ),
        //             "description"   => esc_html__("Order by", 'easybook-add-ons'),  
        //             "std"           =>'date',    
        //         ),
        //         array(
        //             "type"          => "dropdown",
        //             "heading"       => esc_html__('Sort Order', 'easybook-add-ons'),
        //             "param_name"    => "order",
        //             "value"         => array(   
        //                 esc_html__('Descending', 'easybook-add-ons')  => 'DESC',
        //                 esc_html__('Ascending', 'easybook-add-ons')   => 'ASC',  
                                                                                                                      
        //             ),
        //             "description"   => esc_html__("Order", 'easybook-add-ons'),    
        //             "std"           =>"DESC",  
        //         ),


        //         array(
        //             "type"          => "textfield",
        //             "heading"       => esc_html__("Or Enter Resume IDs", "easybook"),
        //             "param_name"    => "ids",
        //             "description"   => esc_html__("Enter Resume ids to show, separated by a comma. (ex: 99,100)", "easybook")
        //         ),
                
                
        //         array(
        //             "type"          => "dropdown", 
        //             "class"         => "", 
        //             "heading"       => esc_html__('Grid Columns', 'easybook-add-ons'), 
        //             "param_name"    => "thumbnail_cols", 
        //             "value"         => array(
        //                 esc_html__('One Column', 'easybook-add-ons')      => 'col-md-12',
        //                 esc_html__('Two Columns', 'easybook-add-ons')     => 'col-md-6', 
        //                 esc_html__('Three Columns', 'easybook-add-ons')   => 'col-md-4', 
                          
        //             ), 
        //             "std"           => 'col-md-12',
        //         ), 
        //         array(
        //             "type"          => "textfield", 
        //             "heading"       => esc_html__('Date Columns', 'easybook-add-ons'), 
        //             "description"   => esc_html__('Number of columns width (based on Bootstrap 12 columns) for Resume date. Leave empty to hide.', 'easybook-add-ons'), 
        //             "param_name"    => "date_cols", 
        //             "std"           => '4',
        //         ), 
        //         array(
        //             "type"          => "dropdown", 
        //             "heading"       => esc_html__('Content Type', 'easybook-add-ons'), 
        //             "param_name"    => "content_type", 
        //             "value"         => array(
        //                 esc_html__('Full Content', 'easybook-add-ons')    => 'content', 
        //                 esc_html__('Excerpt', 'easybook-add-ons')         => 'excerpt', 
        //                 esc_html__('None', 'easybook-add-ons')            => 'none', 
        //             ), 
                    
        //             "std"           => 'content',
        //         ),
        //         array(
        //             "type"          => "dropdown", 
        //             "class"         => "", 
        //             "heading"       => esc_html__('Link to Resume detail\'s page', 'easybook-add-ons'), 
        //             "param_name"    => "show_readmore", 
        //             "value"         => array(
        //                 esc_html__('Yes', 'easybook-add-ons')     => 'yes', 
        //                 esc_html__('No', 'easybook-add-ons')      => 'no', 
        //             ), 
                    
        //             "std"           => 'no',
        //         ),

        //         array(
        //             "type"          => "dropdown", 
        //             "class"         => "", 
        //             "heading"       => esc_html__('Show Pagination', 'easybook-add-ons'), 
        //             "param_name"    => "show_pagination", 
        //             "value"         => array(
        //                 esc_html__('Yes', 'easybook-add-ons')     => 'yes', 
        //                 esc_html__('No', 'easybook-add-ons')      => 'no', 
        //             ), 
                    
        //             "std"           => 'yes',
        //         ),

                

        //         array(
        //             "type"          => "textfield",
        //             "heading"       => esc_html__("Extra class name", "easybook"),
        //             "param_name"    => "el_class",
        //             "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "easybook")
        //         ),
        //         array(
        //             'type'          => 'css_editor',
        //             'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
        //             'param_name'    => 'css',
        //             'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
        //         ),
        //     )));

        // if ( class_exists( 'WPBakeryShortCode' ) ) {
        //     class WPBakeryShortCode_EasyBook_Resumes extends WPBakeryShortCode {}
        // }


        vc_map( array(
            "name" => esc_html__("Landing Slider", 'easybook-add-ons'),
            "description" => esc_html__("Home Slider using swiper plugin",'easybook-add-ons'),
            "base" => "easybook_landing",
            "category"  => 'EasyBook Theme',
            "as_parent" => array('only' => 'easybook_landing_item'), 
            "content_element" => true,
            "show_settings_on_create" => true,
            "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_landing.php',
            "params" => array(
                array(
                    'type' => 'textarea',
                    'heading' => esc_html__( 'Introduction Text', 'easybook-add-ons' ),
                    'param_name' => 'introtext',

                    'value'=> '<div class="preview-title">
    <img src="'.get_template_directory_uri().'/assets/images/logo.png" alt="">
    <h3>Photography / Portfolio  Template</h3>
    <h4>Select Demo : </h4> 
</div>',
                ),

                array(
                    "type"      => "attach_image",
                    "heading"   => esc_html__("Right decoration image", 'easybook-add-ons'),
                    "param_name"=> "ver_img",
                    'value'=> '703'
                    
                ),


                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Speed", 'easybook-add-ons'),
                    "param_name"    => "speed",
                    "value"         =>'1200',
                    "description"   => esc_html__("Duration of transition between slides (in ms). Default: 1000", 'easybook-add-ons')
                ),
                array(
                    "type"          => "dropdown",
                    "class"         =>"",
                    "heading"       => esc_html__('Direction', 'easybook-add-ons'),
                    "param_name"    => "direction",
                    "value"         => array(   
                                        esc_html__('Horizontal', 'easybook-add-ons') => 'horizontal',  
                                        esc_html__('Vertical', 'easybook-add-ons') => 'vertical',                                                                                
                                    ),
                    'std'           => 'vertical'
                ),
                array(
                    "type"          => "dropdown",
                    "class"         =>"",
                    "heading"       => esc_html__('Effect', 'easybook-add-ons'),
                    "param_name"    => "effect",
                    "value"         => array(   
                                        esc_html__('Slide', 'easybook-add-ons') => 'slide',  
                                        esc_html__('Fade', 'easybook-add-ons') => 'fade',                                                                                
                                        esc_html__('Cube', 'easybook-add-ons') => 'cube',                                                                                
                                        esc_html__('Coverflow', 'easybook-add-ons') => 'coverflow',                                                                                
                                        esc_html__('Flip', 'easybook-add-ons') => 'flip',                                                                                
                                    ),
                    'std'           => 'slide'
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Auto Play", 'easybook-add-ons'),
                    "param_name"    => "autoplay",
                    "description"   => esc_html__("Number in mili-second (5000), leave it blank to disable", 'easybook-add-ons'),
                    'value'         => ''
                ),
                array(
                    "type"          => "dropdown",
                    "class"         =>"",
                    "heading"       => esc_html__('Loop', 'easybook-add-ons'),
                    "param_name"    => "loop",
                    "value"         => array(   
                                        esc_html__('No', 'easybook-add-ons') => 'no',  
                                        esc_html__('Yes', 'easybook-add-ons') => 'yes',                                                                                
                                    ),
                    "description"   => esc_html__("Set this to Yes to enable continuous loop mode", 'easybook-add-ons'), 
                    'std'           =>'no'
                ),
                array(
                    "type"          => "dropdown",
                    "class"         =>"",
                    "heading"       => esc_html__('Show Navigation', 'easybook-add-ons'),
                    "param_name"    => "show_nav",
                    "value"         => array(   
                                        esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                        esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                    ),
                    'std'           =>'yes'
                ),
                // array(
                //     "type"          => "dropdown",
                //     "class"         =>"",
                //     "heading"       => esc_html__('Show Progress', 'easybook-add-ons'),
                //     "param_name"    => "show_progress",
                //     "value"         => array(   
                //                         esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                //                         esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                //                     ),
                //     'std'           =>'yes'
                // ),
                array(
                    "type"          => "dropdown",
                    "class"         =>"",
                    "heading"       => esc_html__('Mouse Wheel Control', 'easybook-add-ons'),
                    "param_name"    => "mousewheel",
                    "value"         => array(   
                                        esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                        esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                    ),
                    "description"   => esc_html__("Set this to Yes if you want to enable navigation through slides using mouse wheel", 'easybook-add-ons'), 
                    'std'           =>'yes'
                ),
                array(
                    "type"          => "dropdown",
                    "class"         =>"",
                    "heading"       => esc_html__('Keyboard Control', 'easybook-add-ons'),
                    "param_name"    => "keyboard",
                    "value"         => array(   
                                        esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                        esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                    ),
                    "description"   => esc_html__("Set this to Yes if you want to enable navigation through slides using keyboard arrows", 'easybook-add-ons'), 
                    'std'           =>'yes'
                ),
                
              
                array(
                    "type" => "dropdown",
                    "class"=>"",
                    "heading" => esc_html__('Use Normal Size', 'easybook-add-ons'),
                    "param_name" => "use_normal_size",
                    "value" => array(   
                                    esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                    esc_html__('No', 'easybook-add-ons') => 'no', 
                                    
                                                                                                                   
                                ),
        
                    'std'=>'no'
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Extra class name", 'easybook-add-ons'),
                    "param_name" => "el_class",
                    "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => esc_html__( 'Css', 'easybook-add-ons' ),
                    'param_name' => 'css',
                    'group' => esc_html__( 'Design options', 'easybook-add-ons' ),
                ),
                
            ),
            "js_view" => 'VcColumnView'
        ));

        vc_map( array(
            "name" => esc_html__("Landing Slide Item", 'easybook-add-ons'),
            "base" => "easybook_landing_item",
            "content_element" => true,
            "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_landing_item.php',
            "as_child" => array('only' => 'easybook_landing'),
            "params" => array(
                
                array(
                    "type"          => "textfield",
                    "holder"        => "div",
                    "heading"       => esc_html__("Slide title", 'easybook-add-ons'),
                    "param_name"    => "title",
                    "value"         => 'Carousel'
                ),
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__('Use Slide Link', 'easybook-add-ons'),
                    "param_name"    => "use_link",
                    "value"         => array(   
                                        esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                        esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                    ),
                    "std"           => 'yes'
                    
                ),
                array(
                    "type"          => "textfield",
                    "holder"        => "div",
                    "heading"       => esc_html__("Slide Link", 'easybook-add-ons'),
                    "param_name"    => "link",
                    'dependency'    => array(
                        'element'   => 'use_link',
                        'value'     => array( 'yes' ),
                        'not_empty' => false,
                    ),
                    "value"         => esc_url( home_url('/home-carousel/' ) )
                ),
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__('Target', 'easybook-add-ons'),
                    "param_name"    => "target",
                    "value"         => array(   
                                        esc_html__('New Window', 'easybook-add-ons')      => '_blank',  
                                        esc_html__('Current Window', 'easybook-add-ons')            => '_self',                                                                                                                                                             
                                    ),
                    'dependency'    => array(
                                        'element'   => 'use_link',
                                        'value'     => array( 'yes' ),
                                        'not_empty' => false,
                                    ),
                    'std'           => '_blank'
                    
                ),
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__('Slide Content Type', 'easybook-add-ons'),
                    "param_name"    => "slide_content_type",
                    "value"         => array(   
                                        esc_html__('Iframe', 'easybook-add-ons') => 'iframe',  
                                        esc_html__('Image', 'easybook-add-ons') => 'image',                                                                                
                                    ),
                    "std"           => 'iframe'
                    
                ),
                array(
                    "type"          => "attach_image",
                    "holder"        => "div",
                    "class"         => "ajax-vc-img",
                    "heading"       => esc_html__("Slide Image", 'easybook-add-ons'),
                    "param_name"    => "slideimg",
                    'dependency'    => array(
                                        'element'   => 'slide_content_type',
                                        'value'     => array( 'image' ),
                                        'not_empty' => false,
                                    ),
                    'value'         => '1652'
                ),
                
                array(
                    "type"      => "textarea_html",
                    "holder"    => "div",
                    "heading"   => esc_html__("Slide Content", 'easybook-add-ons'),
                    "param_name"=> "content",
                ),  
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Extra class name", 'easybook-add-ons'),
                    "param_name" => "el_class",
                    "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
                ),
                
                array(
                    'type' => 'css_editor',
                    'heading' => esc_html__( 'Css', 'easybook-add-ons' ),
                    'param_name' => 'css',
                    'group' => esc_html__( 'Design options', 'easybook-add-ons' ),
                ),
                
            ),
            'admin_enqueue_js'      => EASYBOOK_ADD_ONS_DIR_URL . "inc/assets/easybook-elements.js",
            'js_view'=> 'EasyBookImagesView',
        ));

        
        if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
            class WPBakeryShortCode_EasyBook_Landing extends WPBakeryShortCodesContainer {}
        }
        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_EasyBook_Landing_Item extends WPBakeryShortCode {     
            }
        }



    // vc_map( array(
    //     "name" => esc_html__("Landing Page", 'easybook-add-ons'),
    //     "description" => esc_html__("Showcase your demos",'easybook-add-ons'),
    //     "base" => "easybook_landing",
    //     "category"  => 'EasyBook Theme',
    //     "as_parent" => array('only' => 'easybook_landing_item'), 
    //     "content_element" => true,
    //     "show_settings_on_create" => true,
    //     "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
    //     //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_landing.php',
    //     "params" => array(
    //         array(
    //             "type"          => "attach_image",
    //             'admin_label'   => true,
    //             "heading"       => esc_html__("Light Demos Logo", 'easybook-add-ons'),
    //             "param_name"    => "light_logo",
    //             'value'         => '806'
               
    //         ),
    //         array(
    //             "type"          => "attach_image",
    //             'admin_label'   => true,
    //             "heading"       => esc_html__("Dark Demos Logo", 'easybook-add-ons'),
    //             "param_name"    => "dark_logo",
    //             'value'         => '1146'
               
    //         ),
    //         array(
    //             'type'          => 'textarea',
    //             'heading'       => esc_html__( 'Introduction Text', 'easybook-add-ons' ),
    //             'param_name'    => 'introtext',
    //             'value'         => '<h2>Creative Responsive Architecture WordPress <br />Theme</h2>',
    //         ),

    //         array(
    //             "type"          => "vc_link",
    //             "heading"       => esc_html__("Cal To Action Link", "easybook"),
    //             "param_name"    => "cta_link",
    //             'value'         => 'url:'. esc_url( 'https://themeforest.net/user/cththemes/portfolio?ref=cththemes' ) .'|title:Buy Now $59|target:_blank'

    //         ),
    //         array(
    //             "type" => "textfield",
    //             "heading" => esc_html__("Extra class name", 'easybook-add-ons'),
    //             "param_name" => "el_class",
    //             "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
    //         ),
    //         array(
    //             'type' => 'css_editor',
    //             'heading' => esc_html__( 'Css', 'easybook-add-ons' ),
    //             'param_name' => 'css',
    //             'group' => esc_html__( 'Design options', 'easybook-add-ons' ),
    //         ),
            
    //     ),
    //     "js_view" => 'VcColumnView'
    // ));

    // vc_map( array(
    //     "name" => esc_html__("Landing Item", 'easybook-add-ons'),
    //     "base" => "easybook_landing_item",
    //     "content_element" => true,
    //     "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
    //     //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_landing_item.php',
    //     "as_child" => array('only' => 'easybook_landing'),
    //     "params" => array(
    //         array(
    //             "type"              => "textfield",
    //             'admin_label'       => true,
    //             "heading"           => esc_html__("Title", 'easybook-add-ons'),
    //             "param_name"        => "title",
    //             'value'             => 'Light Skin'
    //         ),
    //         array(
    //             "type"              => "textarea",
    //             'admin_label'       => true,
    //             "heading"           => esc_html__("SubTitle", 'easybook-add-ons'),
    //             "param_name"        => "subtitle",
    //             'value'             => ''
    //         ),
    //         array(
    //             'type' => 'param_group',
    //             'heading' => esc_html__( 'Demos', 'easybook-add-ons' ),
    //             'param_name' => 'demos',
    //             'params' => array(
    //                 array(
    //                     'type'          => 'textfield',
    //                     'heading'       => esc_html__( 'Demo title', 'easybook-add-ons' ),
    //                     'param_name'    => 'demo_title',
    //                     'admin_label'   => true,
    //                     'value'         => 'Slider'
    //                 ),
    //                 array(
    //                     "type"          => "attach_image",
    //                     'admin_label'   => true,
    //                     "heading"       => esc_html__("Demo Thumbnail", 'easybook-add-ons'),
    //                     "param_name"    => "demo_img",
    //                     'value'         => '1163'
                       
    //                 ),
    //                 array(
    //                     "type"          => "vc_link",
    //                     "heading"       => esc_html__("Demo Button 1", "easybook"),
    //                     "param_name"    => "demo_prev1",
    //                     'value'         => 'url:'.esc_url( home_url('/home-slider/' ) ).'|title:Multipage|target:_blank'
        
    //                 ),
    //                 array(
    //                     "type"          => "vc_link",
    //                     "heading"       => esc_html__("Demo Button 2", "easybook"),
    //                     "param_name"    => "demo_prev2",
    //                     'value'         => 'url:'.esc_url( home_url('/onepage-slider/' ) ).'|title:Onepage|target:_blank'
    //                 ),
                    
    //             ),
    //         ),
    //         array(
    //             "type"                  => "dropdown",
    //             "heading"               => esc_html__('Is Dark Demo?', 'easybook-add-ons'),
    //             "param_name"            => "is_dark",
    //             "value"                 => array(   
    //                 esc_html__('Yes', 'easybook-add-ons')     => 'yes',  
    //                 esc_html__('No', 'easybook-add-ons')      => 'no',                                                                                           
    //             ),
    //             'std'                   =>'no'
    //         ),
    //         array(
    //             "type" => "textfield",
    //             "heading" => esc_html__("Extra class name", 'easybook-add-ons'),
    //             "param_name" => "el_class",
    //             "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
    //         ),
            
    //         array(
    //             'type' => 'css_editor',
    //             'heading' => esc_html__( 'Css', 'easybook-add-ons' ),
    //             'param_name' => 'css',
    //             'group' => esc_html__( 'Design options', 'easybook-add-ons' ),
    //         ),
            
    //     )
    // ));

    
    // if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    //     class WPBakeryShortCode_EasyBook_Landing extends WPBakeryShortCodesContainer {}
    // }
    // if ( class_exists( 'WPBakeryShortCode' ) ) {
    //     class WPBakeryShortCode_EasyBook_Landing_Item extends WPBakeryShortCode {     
    //     }
    // }



        vc_map( array(
            "name"      => esc_html__("Gallery Masonry", 'easybook-add-ons'),
            "description" => esc_html__("with images selected",'easybook-add-ons'),
            "base"      => "easybook_images_gallery",
            "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_images_gallery.php',
            "category"  => 'EasyBook Portfolio',
            "params"    => array(

                array(
                    "type"          => "attach_images",
                    "holder"        => "div",
                    "class"         => "ajax-vc-img",
                    "heading"       => esc_html__("Image Source", 'easybook-add-ons'),
                    "param_name"    => "galleryimgs",
                    'value'         => '1381,1382,1398,1384,1385,1386,1387,1388,1389,1390'
                   
                ),

                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("First Load items", 'easybook-add-ons'),
                    "param_name"    => "loaded",
                    "value"         => '10',
                    "description"   => esc_html__("Number of images you want to display in the first load. Should be maller than your total images number to use INFINITE scroll option bellow.", 'easybook-add-ons')
                ),

                array(
                    "type"          => "dropdown",
                    "class"         => "",
                    "heading"       => esc_html__('Use INFINITE scroll load more items?', 'easybook-add-ons'),
                    "param_name"    => "show_loadmore",
                    "value"         => array(   
                        esc_html__('Yes', 'easybook-add-ons')     => 'yes',  
                        esc_html__('No', 'easybook-add-ons')      => 'no',  
                    ), 
                    "std"           =>'yes',    
                    "description"   => esc_html__("Images will automatically load and adding when you scroll to the bottom.", 'easybook-add-ons')
                ),

                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Load more items", 'easybook-add-ons'),
                    "param_name"    => "lmore_items",
                    "value"         => '3',
                    "description"   => esc_html__("Number of images you want to get in the next loadings.", 'easybook-add-ons')
                ),

                array(
                    "type"          => "dropdown",
                    "class"         => "",
                    "heading"       => esc_html__('Columns Grid', 'easybook-add-ons'),
                    "param_name"    => "columns",
                    "value"         => array(   
                        esc_html__('One Column', 'easybook-add-ons')      => 'one',  
                        esc_html__('Two Columns', 'easybook-add-ons')     => 'two',  
                        esc_html__('Three Columns', 'easybook-add-ons')   => 'three',        
                        esc_html__('Four Columns', 'easybook-add-ons')    => 'four',        
                        esc_html__('Five Columns', 'easybook-add-ons')    => 'five',        
                    ),
                    "std"           =>'three',    
                ),
                array(
                    "type"          => "dropdown", 
                    "class"         => "", 
                    "heading"       => esc_html__('Spacing', 'easybook-add-ons'), 
                    "param_name"    => "spacing", 
                    "value"         => array(
                        esc_html__('None', 'easybook-add-ons')            => 'none', 
                        esc_html__('Extra Small', 'easybook-add-ons')     => 'extrasmall',
                        esc_html__('Small', 'easybook-add-ons')           => 'small',
                        esc_html__('Medium', 'easybook-add-ons')          => 'medium',
                        esc_html__('Big', 'easybook-add-ons')             => 'big', 
                    ), 
                    "std"           => 'extrasmall',
                ),

                array(
                    "type"          => "dropdown",
                    "class"         =>"",
                    "heading"       => esc_html__('Show image title', 'easybook-add-ons'),
                    "param_name"    => "show_img_title",
                    "value"         => array(   
                        esc_html__('Yes', 'easybook-add-ons')         => 'yes',  
                        esc_html__('No', 'easybook-add-ons')          => 'no',  
                    ), 
                    "std"           =>'no',    
                ),

                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__('Show image description', 'easybook-add-ons'),
                    "param_name"    => "show_img_desc",
                    "value"         => array(   
                        esc_html__('Yes', 'easybook-add-ons')         => 'yes',  
                        esc_html__('No', 'easybook-add-ons')          => 'no',  
                    ), 
                    "std"           =>'no',    
                ),

                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__('Use Popup Gallery', 'easybook-add-ons'),
                    "param_name"    => "show_zoom",
                    "value"         => array(   
                        esc_html__('Yes', 'easybook-add-ons')     => 'yes',  
                        esc_html__('No', 'easybook-add-ons')      => 'no',  
                    ), 
                    "std"           =>'yes',    
                ),

                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__('Show filter', 'easybook-add-ons'),
                    "param_name"    => "show_filter",
                    "value"         => array(   
                        esc_html__('Yes', 'easybook-add-ons')     => 'yes',  
                        esc_html__('No', 'easybook-add-ons')      => 'no',  
                    ), 
                    "std"           =>'no',    
                ),

                array(
                    "type"          => "textarea",
                    "heading"       => esc_html__("Filter List", 'easybook-add-ons'),
                    "param_name"    => "filter_list",
                    "value"         => 'Departments|Design|Houses|Interior',
                    "description"   => esc_html__("Note: separate filter texts with | character. Ex: \"Departments|Design|Houses|Interior\". Each image can have one or more filter texts in its caption field wrapped with \"-f-FILTER_TEXT-f-\" ( -f-Departments-f- ) and separate by a space or linebreak.", 'easybook-add-ons'),
                    'dependency'    => array(
                        'element'   => 'show_filter',
                        'value'     => array( 'yes'),
                        'not_empty' => false,
                    ),
                ),

                
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
                    "param_name"    => "el_class",
                    "value"         =>'',
                    "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
                ),
                array(
                    'type'          => 'css_editor',
                    'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
                    'param_name'    => 'css',
                    'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
                ),
            ),
            'admin_enqueue_js'      => EASYBOOK_ADD_ONS_DIR_URL . "inc/assets/easybook-elements.js",
            'js_view'=> 'EasyBookImagesView',
        ));

        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_EasyBook_Images_Gallery extends WPBakeryShortCode {}
        }


        // vc_map( array(
        //     "name"                      => esc_html__("Fullwidth Slider", 'easybook-add-ons'),
        //     "description"               => esc_html__("with multi images selected",'easybook-add-ons'),
        //     "base"                      => "easybook_fullwidth_slider",
        //     "category"                  => 'EasyBook Portfolio',
        //     "content_element"           => true,
        //     "show_settings_on_create"   => true,
        //     "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
        //     //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_fullwidth_slider.php',
        //     "params"                    => array(
        //         array(
        //             "type"          => "attach_images",
        //             "holder"        => "div",
        //             "class"         => "ajax-vc-img",
        //             "heading"       => esc_html__("Slide Images", 'easybook-add-ons'),
        //             "param_name"    => "slideimages",
        //             'value'         => '889,907,895,901,888,894,904'
        //         ),
        //         array(
        //             "type"          => "textfield",
        //             "heading"       => esc_html__("Speed", 'easybook-add-ons'),
        //             "param_name"    => "speed",
        //             "value"         =>'1000',
        //             "description"   => esc_html__("Duration of transition between slides (in ms). Default: 1000", 'easybook-add-ons')
        //         ),
        //         array(
        //             "type"          => "dropdown",
        //             "class"         =>"",
        //             "heading"       => esc_html__('Direction', 'easybook-add-ons'),
        //             "param_name"    => "direction",
        //             "value"         => array(   
        //                                 esc_html__('Horizontal', 'easybook-add-ons') => 'horizontal',  
        //                                 esc_html__('Vertical', 'easybook-add-ons') => 'vertical',                                                                                
        //                             ),
        //             'std'           => 'horizontal'
        //         ),
        //         array(
        //             "type"          => "dropdown",
        //             "class"         =>"",
        //             "heading"       => esc_html__('Effect', 'easybook-add-ons'),
        //             "param_name"    => "effect",
        //             "value"         => array(   
        //                                 esc_html__('Slide', 'easybook-add-ons') => 'slide',  
        //                                 esc_html__('Fade', 'easybook-add-ons') => 'fade',                                                                                
        //                                 esc_html__('Cube', 'easybook-add-ons') => 'cube',                                                                                
        //                                 esc_html__('Coverflow', 'easybook-add-ons') => 'coverflow',                                                                                
        //                                 esc_html__('Flip', 'easybook-add-ons') => 'flip',                                                                                
        //                             ),
        //             'std'           => 'slide'
        //         ),
        //         array(
        //             "type"          => "textfield",
        //             "heading"       => esc_html__("Auto Play", 'easybook-add-ons'),
        //             "param_name"    => "autoplay",
        //             "description"   => esc_html__("Number in mili-second (5000), leave it blank to disable", 'easybook-add-ons'),
        //             'value'         => ''
        //         ),
        //         array(
        //             "type"          => "dropdown",
        //             "class"         =>"",
        //             "heading"       => esc_html__('Loop', 'easybook-add-ons'),
        //             "param_name"    => "loop",
        //             "value"         => array(   
        //                                 esc_html__('No', 'easybook-add-ons') => 'no',  
        //                                 esc_html__('Yes', 'easybook-add-ons') => 'yes',                                                                                
        //                             ),
        //             "description"   => esc_html__("Set this to Yes to enable continuous loop mode", 'easybook-add-ons'), 
        //             'std'           =>'yes'
        //         ),
        //         array(
        //             "type"          => "dropdown",
        //             "class"         =>"",
        //             "heading"       => esc_html__('Show Navigation', 'easybook-add-ons'),
        //             "param_name"    => "show_nav",
        //             "value"         => array(   
        //                                 esc_html__('Yes', 'easybook-add-ons') => 'yes',  
        //                                 esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
        //                             ),
        //             'std'           =>'yes'
        //         ),
                
        //         array(
        //             "type"          => "dropdown",
        //             "class"         =>"",
        //             "heading"       => esc_html__('Mouse Wheel Control', 'easybook-add-ons'),
        //             "param_name"    => "mousewheel",
        //             "value"         => array(   
        //                                 esc_html__('Yes', 'easybook-add-ons') => 'yes',  
        //                                 esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
        //                             ),
        //             "description"   => esc_html__("Set this to Yes if you want to enable navigation through slides using mouse wheel", 'easybook-add-ons'), 
        //             'std'           =>'no'
        //         ),
        //         array(
        //             "type"          => "dropdown",
        //             "class"         =>"",
        //             "heading"       => esc_html__('Keyboard Control', 'easybook-add-ons'),
        //             "param_name"    => "keyboard",
        //             "value"         => array(   
        //                                 esc_html__('Yes', 'easybook-add-ons') => 'yes',  
        //                                 esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
        //                             ),
        //             "description"   => esc_html__("Set this to Yes if you want to enable navigation through slides using keyboard arrows", 'easybook-add-ons'), 
        //             'std'           =>'yes'
        //         ),

        //         array(
        //             "type"          => "textfield",
        //             "heading"       => esc_html__("Parallax Value", 'easybook-add-ons'),
        //             "param_name"    => "parallax_value",
        //             "description"   => esc_html__("Parallax CSS style values, separated by comma. Ex: translateY: '250px' ", 'easybook-add-ons').'<a href="'.esc_url('https://github.com/iprodev/Scrollax.js/blob/master/docs/Markup.md' ).'" target="_blank">'.esc_html__('Scrollax Documentation','easybook-add-ons' ).'</a>',
        //             "value"         => "translateY: '250px'"
        //         ),
        //         array(
        //             "type"          => "dropdown",
        //             "class"         =>"",
        //             "heading"       => esc_html__('Disable Image Zoom', 'easybook-add-ons'),
        //             "param_name"    => "disable_zoom",
        //             "value"         => array(   
        //                                 esc_html__('No', 'easybook-add-ons') => 'no', 
        //                                 esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                                                                                                       
        //                             ),
        //             'std'           =>'no'
                    
        //         ),
        //         array(
        //             "type"          => "textfield",
        //             "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
        //             "param_name"    => "el_class",
        //             "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
        //         ),
        //         array(
        //             'type'          => 'css_editor',
        //             'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
        //             'param_name'    => 'css',
        //             'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
        //         ),
                
        //     ),
        //     'admin_enqueue_js'      => EASYBOOK_ADD_ONS_DIR_URL . "inc/assets/easybook-elements.js",
        //     'js_view'=> 'EasyBookImagesView',
        // ));

        // if ( class_exists( 'WPBakeryShortCode' ) ) {
        //     class WPBakeryShortCode_EasyBook_Fullwidth_Slider extends WPBakeryShortCode {}
        // }

        vc_map( array(
            "name" => esc_html__("Images Slider", 'easybook-add-ons'),
            "description" => esc_html__("with multi images selected",'easybook-add-ons'),
            "base" => "easybook_slider",
            "category"  => 'EasyBook Portfolio',
            "content_element" => true,
            "show_settings_on_create" => true,
            
            "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_slider.php',
            "params" => array(
                array(
                    "type"          => "attach_images",
                    "holder"        => "div",
                    "class"         => "ajax-vc-img",
                    "heading"       => esc_html__("Slide Images", 'easybook-add-ons'),
                    "param_name"    => "slideimages",
                    'value'         => '1398,1381,1383'
                ),
                array(
                    "type"          => "textfield",
                    'admin_label'   => true,
                    "heading"       => esc_html__("Image size", 'easybook-add-ons'),
                    "param_name"    => "thumbnail_size",
                    "description"   => esc_html__('Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height).','easybook-add-ons' ),
                    "value"         => 'full',
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Speed", 'easybook-add-ons'),
                    "param_name"    => "speed",
                    "value"         =>'1000',
                    "description"   => esc_html__("Duration of transition between slides (in ms). Default: 1000", 'easybook-add-ons')
                ),
                array(
                    "type"          => "dropdown",
                    "class"         =>"",
                    "heading"       => esc_html__('Direction', 'easybook-add-ons'),
                    "param_name"    => "direction",
                    "value"         => array(   
                                        esc_html__('Horizontal', 'easybook-add-ons') => 'horizontal',  
                                        esc_html__('Vertical', 'easybook-add-ons') => 'vertical',                                                                                
                                    ),
                    'std'           => 'horizontal'
                ),
                array(
                    "type"          => "dropdown",
                    "class"         =>"",
                    "heading"       => esc_html__('Effect', 'easybook-add-ons'),
                    "param_name"    => "effect",
                    "value"         => array(   
                                        esc_html__('Slide', 'easybook-add-ons') => 'slide',  
                                        esc_html__('Fade', 'easybook-add-ons') => 'fade',                                                                                
                                        esc_html__('Cube', 'easybook-add-ons') => 'cube',                                                                                
                                        esc_html__('Coverflow', 'easybook-add-ons') => 'coverflow',                                                                                
                                        esc_html__('Flip', 'easybook-add-ons') => 'flip',                                                                                
                                    ),
                    'std'           => 'slide'
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Auto Play", 'easybook-add-ons'),
                    "param_name"    => "autoplay",
                    "description"   => esc_html__("Number in mili-second (5000), leave it blank to disable", 'easybook-add-ons'),
                    'value'         => ''
                ),
                array(
                    "type"          => "dropdown",
                    "class"         =>"",
                    "heading"       => esc_html__('Loop', 'easybook-add-ons'),
                    "param_name"    => "loop",
                    "value"         => array(   
                                        esc_html__('No', 'easybook-add-ons') => 'no',  
                                        esc_html__('Yes', 'easybook-add-ons') => 'yes',                                                                                
                                    ),
                    "description"   => esc_html__("Set this to Yes to enable continuous loop mode", 'easybook-add-ons'), 
                    'std'           =>'yes'
                ),
                array(
                    "type"          => "dropdown",
                    "class"         =>"",
                    "heading"       => esc_html__('Show Navigation', 'easybook-add-ons'),
                    "param_name"    => "show_nav",
                    "value"         => array(   
                                        esc_html__('Yes', 'easybook-add-ons') => 'yes',  
                                        esc_html__('No', 'easybook-add-ons') => 'no',                                                                                
                                    ),
                    'std'           =>'yes'
                ),
                
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
                    "param_name"    => "el_class",
                    "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
                ),
                array(
                    'type'          => 'css_editor',
                    'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
                    'param_name'    => 'css',
                    'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
                ),
                
            ),
            'admin_enqueue_js'      => EASYBOOK_ADD_ONS_DIR_URL . "inc/assets/easybook-elements.js",
            'js_view'=> 'EasyBookImagesView',
        ) );

        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_EasyBook_Slider extends WPBakeryShortCode {}
        }
    

        vc_map( array(
            "name"                      => esc_html__("Portfolio Title", 'easybook-add-ons'),
            "base"                      => "easybook_portfolio_title",
            "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_portfolio_title.php',
            "category"                  => 'EasyBook Portfolio',
            "show_settings_on_create"   => false,
            "params"                    => array(
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
                    "param_name"    => "el_class",
                    "value"         =>'',
                    "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
                ),
                array(
                    'type'          => 'css_editor',
                    'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
                    'param_name'    => 'css',
                    'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
                ),
            )
        ));

        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_EasyBook_Portfolio_Title extends WPBakeryShortCode {}
        }

        // vc_map( array(
        //     "name"                      => esc_html__("Portfolio Tags", 'easybook-add-ons'),
        //     "base"                      => "easybook_portfolio_tags",
        //     "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
        //     //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_portfolio_tags.php',
        //     "category"                  => 'EasyBook Portfolio',
        //     "show_settings_on_create"   => false,
        //     "params"                    => array(
        //         array(
        //             "type"          => "textfield",
        //             "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
        //             "param_name"    => "el_class",
        //             "value"         =>'',
        //             "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
        //         ),
        //         array(
        //             'type'          => 'css_editor',
        //             'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
        //             'param_name'    => 'css',
        //             'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
        //         ),
        //     )
        // ));

        // if ( class_exists( 'WPBakeryShortCode' ) ) {
        //     class WPBakeryShortCode_EasyBook_Portfolio_Tags extends WPBakeryShortCode {}
        // }

        vc_map( array(
            "name"                      => esc_html__("Portfolio Content", 'easybook-add-ons'),
            "base"                      => "easybook_portfolio_content",
            "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_portfolio_content.php',
            "category"                  => 'EasyBook Portfolio',
            "show_settings_on_create"   => true,
            "params"                    => array(
                array(
                    "type"          => "textarea_html",
                    "heading"       => esc_html__("Content", 'easybook-add-ons'),
                    "holder"        =>'div',
                    "param_name"    => "content",
                    "value"         =>'<p>Nulla scelerisque, enim id elementum suscipit, magna odio fermentum arcu, nec dictum nibh nibh et magna. </p>
<p>Praesent nec leo venenatis elit semper aliquet id ac enim. Maecenas nec mi leo. Etiam venenatis ut dui non hendrerit. Integer dictum, diam vitae blandit accumsan, dolor odio tempus arcu, vel ultrices nisi nibh vitae ligula.</p>',        
                ),
                
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
                    "param_name"    => "el_class",
                    "value"         =>'',
                    "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
                ),
                array(
                    'type'          => 'css_editor',
                    'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
                    'param_name'    => 'css',
                    'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
                ),
            )
        ));

        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_EasyBook_Portfolio_Content extends WPBakeryShortCode {}
        }

        vc_map( array(
            "name"                      => esc_html__("Portfolio Details", 'easybook-add-ons'),
            "base"                      => "easybook_portfolio_details",
            "category"                  => 'EasyBook Portfolio',
            "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
            "html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_portfolio_details.php',
            "show_settings_on_create"   => true,
            "params"                    => array(
                array(
                    "type"          => "textarea_raw_html",
                    "heading"       => esc_html__("Content", 'easybook-add-ons'),
                    "holder"        =>'div',
                    "param_name"    => "content",
                    "value"         =>base64_encode(rawurlencode('<ul>
    <li>
        <span>Location</span>
        <a href="#">NY , USA</a>
    </li>
    <li>
        <span>Category</span>
        <a href="#">Travel</a>
    </li>
    <li>
        <span>Model</span>
        <a href="#">Austin Onishe</a>
    </li>
    <li>
        <span>Camera</span>
        <a href="#">Canon 6d</a>
    </li>
</ul>')),
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
                    "param_name"    => "el_class",
                    "value"         =>'',
                    "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
                ),
                array(
                    'type'          => 'css_editor',
                    'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
                    'param_name'    => 'css',
                    'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
                ),
            )
        ));

        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_EasyBook_Portfolio_Details extends WPBakeryShortCode {}
        }
        
        vc_map( array(
            "name"      => esc_html__("Portfolio Nav", 'easybook-add-ons'),
            "base"      => "easybook_portfolio_nav",
            "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_portfolio_nav.php',
            "category"  => 'EasyBook Portfolio',
            "show_settings_on_create" => true,
            "params"    => array(
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__('In Same Terms', 'easybook-add-ons'),
                    "description"   => esc_html__("Whether previous/next posts must be within the same taxonomy term as the current post.", 'easybook-add-ons'),
                    "param_name"    => "same_term",
                    "value"         => array(   
                        esc_html__('No', 'easybook-add-ons')      => 'no', 
                        esc_html__('Yes', 'easybook-add-ons')     => 'yes',                                                                                
                    ),
                    "std"           => 'no', 
                ),
                // array(
                //     "type"          => "dropdown",
                //     "class"         =>"",
                //     "heading"       => esc_html__('Show All Projects', 'easybook-add-ons'),
                //     "param_name"    => "show_all",
                //     "value"         => array(   
                //         esc_html__('No', 'easybook-add-ons')      => 'no', 
                //         esc_html__('Yes', 'easybook-add-ons')     => 'yes',                                                                                
                //     ),
                //     "std"           => 'yes', 
                // ),
                // array(
                //     "type"          => "textfield",
                //     "heading"       => esc_html__("All Projects Link", 'easybook-add-ons'),
                //     "param_name"    => "all_link",
                //     "value"         => '',
                //     "description"   => esc_html__("Leave empty to use default portfolio archive link.", 'easybook-add-ons'),
                //     "dependency"    => array(
                //         'element'   => 'show_all',
                //         'value'     => array('yes'),
                //         'not_empty' => false
                //     )
                // ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Extra class name", 'easybook-add-ons'),
                    "param_name"    => "el_class",
                    "value"         => '',
                    "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
                ),
                array(
                    'type'          => 'css_editor',
                    'heading'       => esc_html__( 'Css', 'easybook-add-ons' ),
                    'param_name'    => 'css',
                    'group'         => esc_html__( 'Design options', 'easybook-add-ons' ),
                ),
            )
        ));

        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_EasyBook_Portfolio_Nav extends WPBakeryShortCode {}
        }

        vc_map( array(
            "name"      => esc_html__("Portfolio Comment", 'easybook-add-ons'),
        
            "base"      => "easybook_portfolio_comment",
        
            "icon"                      => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => EASYBOOK_ADD_ONS_DIR.'/vc_templates/easybook_portfolio_comment.php',
            "category"  => 'EasyBook Portfolio',
     
            "show_settings_on_create" => false,
            "params"    => array(
                
                
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Extra class name", 'easybook-add-ons'),
                    "param_name" => "el_class",
                    "value"=>'',
                    "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => esc_html__( 'Css', 'easybook-add-ons' ),
                    'param_name' => 'css',
                    'group' => esc_html__( 'Design options', 'easybook-add-ons' ),
                ),
            )
        ));

        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_EasyBook_Portfolio_Comment extends WPBakeryShortCode {}
        }


        vc_map( array(
            "name"      => esc_html__("Share Post", 'easybook-add-ons'),
            "base"      => "easybook_share_post",
            "icon" => EASYBOOK_ADD_ONS_DIR_URL . "assets/cththemes-logo.png",
            "category"  => 'EasyBook Portfolio',
            "show_settings_on_create" => false,
            "params"    => array(


                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Extra class name", 'easybook-add-ons'),
                    "holder" => "div",
                    "param_name" => "share_names",
                    "value"=>'facebook,pinterest,googleplus,twitter,linkedin',
                    "description" => esc_html__("Enter your social share names separated by a comma. Available names: facebook,twitter,linkedin,in1,tumblr,digg,googleplus,reddit,pinterest,stumbleupon,email,vk", 'easybook-add-ons')
                ),
                
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Extra class name", 'easybook-add-ons'),
                    "param_name" => "el_class",
                    "value"=>'',
                    "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons')
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => esc_html__( 'Css', 'easybook-add-ons' ),
                    'param_name' => 'css',
                    'group' => esc_html__( 'Design options', 'easybook-add-ons' ),
                ),
            )
        ));

        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_EasyBook_Share_Post extends WPBakeryShortCode {}
        }
        

    }
}
add_action('init','easybook_add_ons_register_vc_elements' );
