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

    



add_filter( 'azp_register_elements', 'easybook_addons_register_azp_elements' );                 

function easybook_addons_register_azp_elements($elements){ 
    $new_elements = array();
    $new_elements['azp_shortcode'] = array( 
        'name'                  => __('Shortcode','easybook-add-ons'),
        'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),  
        'category'              => __("content",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/text-block.png',   
        'open_settings_on_create'=>true,
        // 'showStyleTab'=> true,
        // 'showTypographyTab'=> true,
        // 'showAnimationTab'=> true,azp_widget_content_info
        'attrs' => array (
            array(
                'type'                  => 'textarea',  
                'param_name'            => 'content',
                'label'                 => __('Shortcode Content','easybook-add-ons'), 
                'show_in_admin'         => true,
                'desc'                  => '',
                'default'               => '',
                'iscontent'             =>'yes'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['lheader_sec'] = array(
        'name'                      => __('Header Section','easybook-add-ons'),
        
        'category'                  => __("Header",'easybook-add-ons'),
        'icon'                      => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'   =>true,
        'showStyleTab'              => true,
        'showTypographyTab'         => true,
        'showAnimationTab'          => true,
        'is_section'                => true,
        'attrs' => array (
            array(
                'type'                  => 'switch',
                'param_name'            => 'ratings',
                'show_in_admin'         => true,
                'label'                 => __('Listing Rating','easybook-add-ons'),
                'desc'                  => 'Show or Hide Listing Rating in the posts.',
                'default'               => 'show',
                'value'                 => array(   
                    'show'          => __('Show', 'easybook-add-ons'), 
                    'hidden'            => __('Hide', 'easybook-add-ons'), 
                 ),
            ),
            
            array(
                'type'                  => 'switch',
                'param_name'            => 'share',
                'show_in_admin'         => true,
                'label'                 => __('Listing Share','easybook-add-ons'),
                'desc'                  => 'Show or Hide Listing Share in the posts.',
                'default'               => 'show',
                'value'                 => array(   
                    'show'          => __('Show', 'easybook-add-ons'), 
                    'hidden'            => __('Hide', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'price',
                'show_in_admin'         => true,
                'label'                 => __('Listing Price','easybook-add-ons'),
                'desc'                  => 'Show or Hide Listing Price in the posts.',
                'default'               => 'show',
                'value'                 => array(   
                    'show'          => __('Show', 'easybook-add-ons'), 
                    'hidden'            => __('Hide', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'breadcrumb',
                'show_in_admin'         => true,
                'label'                 => __('Breadcrumb','easybook-add-ons'),
                'desc'                  => 'Show or Hide breadcrumb in the posts.',
                'default'               => 'show',
                'value'                 => array(   
                    'show'          => __('Show', 'easybook-add-ons'), 
                    'hidden'            => __('Hide', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'login_contac_hidden',
                'show_in_admin'         => true,
                'label'                 => __('Listing Contact','easybook-add-ons'),
                'desc'                  => 'Hide contacts for guest',
                'default'               => 'show',
                'value'                 => array(   
                    'show'         => __('Show', 'easybook-add-ons'), 
                    'hidden'       => __('Hide', 'easybook-add-ons'), 
                ),
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_lheader_bgimage'] = array(
        'name'                  => __('Backgroud Image','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Header",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'switch',
                'param_name'            => 'ratings',
                'show_in_admin'         => true,
                'label'                 => __('Listing Rating','easybook-add-ons'),
                'desc'                  => 'Show or Hide Listing Rating in the posts.',
                'default'               => 'show',
                'value'                 => array(   
                    'show'          => __('Show', 'easybook-add-ons'), 
                    'hidden'            => __('Hide', 'easybook-add-ons'), 
                 ),
            ),
            // array(
            //     'type'                  => 'switch',
            //     'param_name'            => 'contacts',
            //     'show_in_admin'         => true,
            //     'label'                 => __('Listing Contacts','easybook-add-ons'),
            //     'desc'                  => 'Show or Hide Listing Contacts in the posts.',
            //     'default'               => 'show',
            //     'value'                 => array(   
            //         'show'          => __('Show', 'easybook-add-ons'), 
            //         'hidden'            => __('Hide', 'easybook-add-ons'), 
            //      ),
            // ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'share',
                'show_in_admin'         => true,
                'label'                 => __('Listing Share','easybook-add-ons'),
                'desc'                  => 'Show or Hide Listing Share in the posts.',
                'default'               => 'show',
                'value'                 => array(   
                    'show'          => __('Show', 'easybook-add-ons'), 
                    'hidden'            => __('Hide', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'price',
                'show_in_admin'         => true,
                'label'                 => __('Listing Price','easybook-add-ons'),
                'desc'                  => 'Show or Hide Listing Price in the posts.',
                'default'               => 'show',
                'value'                 => array(   
                    'show'          => __('Show', 'easybook-add-ons'), 
                    'hidden'            => __('Hide', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'breadcrumb',
                'show_in_admin'         => true,
                'label'                 => __('Breadcrumb','easybook-add-ons'),
                'desc'                  => 'Show or Hide breadcrumb in the posts.',
                'default'               => 'show',
                'value'                 => array(   
                    'show'          => __('Show', 'easybook-add-ons'), 
                    'hidden'            => __('Hide', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'login_contac_hidden',
                'show_in_admin'         => true,
                'label'                 => __('Listing Contact','easybook-add-ons'),
                'desc'                  => 'Hide contacts for guest',
                'default'               => 'show',
                'value'                 => array(   
                    'show'         => __('Show', 'easybook-add-ons'), 
                    'hidden'       => __('Hide', 'easybook-add-ons'), 
                ),
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_lheader_bgvideo'] = array(
        'name'                  => __('Backgroud Video','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Header",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
               array(
                'type'                  => 'switch',
                'param_name'            => 'ratings',
                'show_in_admin'         => true,
                'label'                 => __('Listing Rating','easybook-add-ons'),
                'desc'                  => 'Show or Hide Listing Rating in the posts.',
                'default'               => 'show',
                'value'                 => array(   
                    'show'          => __('Show', 'easybook-add-ons'), 
                    'hidden'            => __('Hide', 'easybook-add-ons'), 
                 ),
            ),
            // array(
            //     'type'                  => 'switch',
            //     'param_name'            => 'contacts',
            //     'show_in_admin'         => true,
            //     'label'                 => __('Listing Contacts','easybook-add-ons'),
            //     'desc'                  => 'Show or Hide Listing Contacts in the posts.',
            //     'default'               => 'show',
            //     'value'                 => array(   
            //         'show'          => __('Show', 'easybook-add-ons'), 
            //         'hidden'            => __('Hide', 'easybook-add-ons'), 
            //      ),
            // ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'share',
                'show_in_admin'         => true,
                'label'                 => __('Listing Share','easybook-add-ons'),
                'desc'                  => 'Show or Hide Listing Share in the posts.',
                'default'               => 'show',
                'value'                 => array(   
                    'show'          => __('Show', 'easybook-add-ons'), 
                    'hidden'            => __('Hide', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'price',
                'show_in_admin'         => true,
                'label'                 => __('Listing Price','easybook-add-ons'),
                'desc'                  => 'Show or Hide Listing Price in the posts.',
                'default'               => 'show',
                'value'                 => array(   
                    'show'          => __('Show', 'easybook-add-ons'), 
                    'hidden'            => __('Hide', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'breadcrumb',
                'show_in_admin'         => true,
                'label'                 => __('Breadcrumb','easybook-add-ons'),
                'desc'                  => 'Show or Hide breadcrumb in the posts.',
                'default'               => 'show',
                'value'                 => array(   
                    'show'          => __('Show', 'easybook-add-ons'), 
                    'hidden'            => __('Hide', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'login_contac_hidden',
                'show_in_admin'         => true,
                'label'                 => __('Listing Contact','easybook-add-ons'),
                'desc'                  => 'Hide contacts for guest',
                'default'               => 'show',
                'value'                 => array(   
                    'show'         => __('Show', 'easybook-add-ons'), 
                    'hidden'       => __('Hide', 'easybook-add-ons'), 
                ),
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_lheader_carousel'] = array(
        'name'                  => __('Carousel','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Header",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png', 
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_lscroll_nav'] = array(
        'name'                  => __('Listing Scroll Navbar','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Navbar",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'switch',
                'param_name'            => 'show_mobile',
                'show_in_admin'         => true,
                'label'                 => __('Show on mobile?','easybook-add-ons'),
                // 'desc'                  => '',
                'default'               => 'no',
                'value'                 => array(   
                    'yes'          => __('Yes', 'easybook-add-ons'), 
                    'no'            => __('No', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'repeater',
                'param_name'            => 'contents_order',
                // 'show_in_admin'         => true,
                'label'                 => __('Repeater Field','easybook-add-ons'),
                'desc'                  => '',
                'title_field'           => 'rp_text',
                'fields'                => array(
                    array(
                        'type'                  => 'text',
                        'param_name'            => 'title',
                        'show_in_admin'         => true,
                        'label'                 => __('Repeater Field Title','easybook-add-ons'),
                        'desc'                  => '',
                        'default'               => 'gallery'
                    ),
                    array(
                        'type'                  => 'text',
                        'param_name'            => 'sec_id',
                        'show_in_admin'         => true,
                        'label'                 => __('Repeater Field Section ID','easybook-add-ons'),
                        'desc'                  => '',
                        'default'               => '#sec_gallery'
                    ),
                    array(
                        'type'                  => 'switch',
                        'param_name'            => 'show_mobile',
                        'show_in_admin'         => true,
                        'label'                 => __('Show on mobile?','easybook-add-ons'),
                        // 'desc'                  => '',
                        'default'               => 'no',
                        'value'                 => array(   
                            'yes'          => __('Yes', 'easybook-add-ons'), 
                            'no'            => __('No', 'easybook-add-ons'), 
                         ),
                    ),
                ),
                'default'     => urlencode(json_encode(array(
                    array(
                        'title'         => 'default title',
                        'sec_id'         => 'sec_id',
                        'show_mobile'         => 'no',
                    ),
                    array(
                        'title'         => 'default title 2',
                        'sec_id'         => 'sec_id_2',
                        'show_mobile'         => 'no',
                    ),
                ))),
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_lgallery'] = array(
        'name'                  => __('Gallery','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Listing",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'images_to_show',
                'show_in_admin'         => true,
                'label'                 => __('Number of images to show','easybook-add-ons'),
                // 'desc'                  => '',
                'default'               => '3'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'items_width',
                'show_in_admin'         => true,
                'label'                 => __('Gallery Items Width','easybook-add-ons'),
                'desc'                  => __("Defined gallery width. Available values are x1(default),x2(x2 width),x3(x3 width), and separated by comma. Ex: x1,x1,x2,x1,x1,x1" ,'easybook-add-ons'),
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_lslider'] = array(
        'name'                  => __('Slider','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Listing",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_lscroll_column'] = array(
        'name'                  => __('Scroll Column','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Listing",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'switch',
                'param_name'            => 'show_share',
                'show_in_admin'         => true,
                'label'                 => __('Item Share','easybook-add-ons'),
                'desc'                  => 'Show or Hide item share on the scroll.',
                'default'               => 'show',
                'value'                 => array(   
                    'show'          => __('Show', 'easybook-add-ons'), 
                    'hidden'            => __('Hide', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'show_review',
                'show_in_admin'         => true,
                'label'                 => __('Item Add Comment','easybook-add-ons'),
                'desc'                  => 'Show or Hide item add review on the scroll.',
                'default'               => 'show',
                'value'                 => array(   
                    'show'          => __('Show', 'easybook-add-ons'), 
                    'hidden'            => __('Hide', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'show_bookmarks',
                'show_in_admin'         => true,
                'label'                 => __('Item Bookmarks','easybook-add-ons'),
                'desc'                  => 'Show or Hide item Bookmarks on the scroll.',
                'default'               => 'show',
                'value'                 => array(   
                    'show'          => __('Show', 'easybook-add-ons'), 
                    'hidden'            => __('Hide', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'show_book',
                'show_in_admin'         => true,
                'label'                 => __('Item Booking','easybook-add-ons'),
                'desc'                  => 'Show or Hide item booking on the scroll.',
                'default'               => 'show',
                'value'                 => array(   
                    'show'          => __('Show', 'easybook-add-ons'), 
                    'hidden'            => __('Hide', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_lpromo_video'] = array(
        'name'                  => __('Listing Promo Video','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Listing",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'image',
                'param_name'            => 'bk_img',
                'show_in_admin'         => true,
                'label'                 => __('background Image','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_facts'] = array(
        'name'                  => __('Facts','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Listing",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_lcontent'] = array(
        'name'                  => __('Content','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Listing",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_lfeatures'] = array(
        'name'                  => __('Features','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Listing",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'num_feature',
                'label'                 => __('Number of Feature to show','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '5'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_ltags'] = array(
        'name'                  => __('Tags','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Listing",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_listing_tags'] = array(
        'name'                      => __('Listing Tags (NEW)','easybook-add-ons'),
        // 'desc'                   => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'                  => __("Listing",'easybook-add-ons'),
        'icon'                      => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'   => true,
        'showStyleTab'              => true,
        'showTypographyTab'         => true,
        'showAnimationTab'          => true,
        'attrs'                     => array (

            
            array(
                'type'                  => 'text',
                'param_name'            => 'wid_title',
                'label'                 => __('Widget Title','easybook-add-ons'),
                // 'desc'                  => '',
                'default'               => 'Listing Tags'
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                // 'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_lFAQuestion'] = array(
        'name'                  => __('FAQuestion','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Listing",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_lRooms'] = array(
        'name'                  => __('Rooms','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Listing",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            // array(
            //     'type'                  => 'text',
            //     'param_name'            => 'posts_per_page',
            //     'show_in_admin'         => true,
            //     'label'                 => __('Posts to show','easybook-add-ons'),
            //     'desc'                  => __("Number of posts to show (-1 for all)." ,'easybook-add-ons'),
            //     'default'               => '-1'
            // ),
            array(
                'type'                  => 'select',
                'param_name'            => 'order_by',
                'show_in_admin'         => true,
                'label'                 => __('Order by','easybook-add-ons'),
                'desc'                  => 'Select how to sort retrieved posts.',
                'default'               => 'date',
                'value'                 => array(   
                    'date'          => __('Date', 'easybook-add-ons'), 
                    'ID'            => __('ID', 'easybook-add-ons'), 
                    'author'        => __('Author', 'easybook-add-ons'), 
                    'title'         => __('Title', 'easybook-add-ons'), 
                    'modified'      => __('Modified', 'easybook-add-ons'),
                    'rand'          => __('Random', 'easybook-add-ons'),
                    // 'comment_count' => __('Comment Count', 'easybook-add-ons'),
                    // 'menu_order'    => __('Menu Order', 'easybook-add-ons'),
                    // 'post__in'      => __('ID order given (post__in)', 'easybook-add-ons')
                 ),
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'order',
                'show_in_admin'         => true,
                'label'                 => __('Sort Order','easybook-add-ons'),
                'desc'                  => 'Select Ascending or Descending order.',
                'default'               => 'DESC',
                'value'                 => array(   
                    'ASC' => __('Ascending', 'easybook-add-ons'), 
                    'DESC' => __('Descending', 'easybook-add-ons')                                                                           
                ),
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );

    $new_elements['azp_rooms_slider'] = array(
        'name'                  => __('Rooms Slider','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Listing",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'wid_title',
                'show_in_admin'         => true,
                'label'                 => __('Widget Title','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Rooms Slider'
            ),
            
            array(
                'type'                  => 'select',
                'param_name'            => 'order_by',
                'show_in_admin'         => true,
                'label'                 => __('Order by','easybook-add-ons'),
                'desc'                  => 'Select how to sort retrieved posts.',
                'default'               => 'date',
                'value'                 => array(   
                    'date'          => __('Date', 'easybook-add-ons'), 
                    'ID'            => __('ID', 'easybook-add-ons'), 
                    'author'        => __('Author', 'easybook-add-ons'), 
                    'title'         => __('Title', 'easybook-add-ons'), 
                    'modified'      => __('Modified', 'easybook-add-ons'),
                    'rand'          => __('Random', 'easybook-add-ons'),
                    // 'comment_count' => __('Comment Count', 'easybook-add-ons'),
                    // 'menu_order'    => __('Menu Order', 'easybook-add-ons'),
                    // 'post__in'      => __('ID order given (post__in)', 'easybook-add-ons')
                 ),
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'order',
                'show_in_admin'         => true,
                'label'                 => __('Sort Order','easybook-add-ons'),
                'desc'                  => 'Select Ascending or Descending order.',
                'default'               => 'DESC',
                'value'                 => array(   
                    'ASC' => __('Ascending', 'easybook-add-ons'), 
                    'DESC' => __('Descending', 'easybook-add-ons')                                                                           
                ),
            ),
            array(
                "type"                  => "text",
                "label"                 => esc_html__("Responsive", 'easybook-add-ons'),
                "param_name"            => "responsive",
                "desc"                  => esc_html__("The format is: screen-size:number-items-display,larger-screen-size:number-items-display. Ex: 320:1,768:2,1500:3", 'easybook-add-ons'),
                "default"               => "320:1,768:1,1500:1"
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                // 'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );

    $new_elements['lstreetview'] = array(
        'name'                    => __('Google Street View', 'easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'                => __("Listing", 'easybook-add-ons'),
        'icon'                    => ESB_DIR_URL . 'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create' => true,
        'showStyleTab'            => true,
        'showTypographyTab'       => true,
        'showAnimationTab'        => true,
        // 'template_folder'         => 'single/',
        'attrs'                   => array(
            array(
                'type'          => 'text',
                'param_name'    => 'title',
                'show_in_admin' => true,
                'label'         => __('Title', 'easybook-add-ons'),
                'default'       => 'Street View',
            ),

            array(
                'type'       => 'text',
                'param_name' => 'el_id',
                'label'      => __('Element ID', 'easybook-add-ons'),
                'desc'       => '',
                'default'    => '',
            ),

            array(
                'type'       => 'text',
                'param_name' => 'el_class',
                'label'      => __('Extra Class', 'easybook-add-ons'),
                'desc'       => __("Use this field to add a class name and then refer to it in your CSS.", 'easybook-add-ons'),
                'default'    => '',
            ),

        ),
    );
    
    $new_elements['azp_lcomments'] = array(
        'name'                  => __('Comments','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Listing",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    
    $new_elements['azp_lcontent_head_info'] = array(
        'name'                  => __('Content Head Info','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Listing",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            // array(
            //     'type'                  => 'switch',
            //     'param_name'            => 'show_',
            //     'show_in_admin'         => true,
            //     'label'                 => __('','easybook-add-ons'),
            //     'desc'                  => 'Show or Hide.',
            //     'default'               => 'show',
            //     'value'                 => array(   
            //         'show'          => __('Show', 'easybook-add-ons'), 
            //         'hidden'            => __('Hide', 'easybook-add-ons'), 
            //      ),
            // ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_listing_near_posts'] = array(
        'name'                  => __('Near Posts','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Listing",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            // array(
            //     'type'                  => 'text',
            //     'param_name'            => 'ids',
            //     'show_in_admin'         => true,
            //     'label'                 => __('Enter Post IDs','easybook-add-ons'),
            //     'desc'                  => __("Enter Post ids to show, separated by a comma. Leave empty to show all" ,'easybook-add-ons'),
            //     'default'               => ''
            // ),
            array(
                'type'                  => 'text',
                'param_name'            => 'posts_per_page',
                'show_in_admin'         => true,
                'label'                 => __('Posts to show','easybook-add-ons'),
                'desc'                  => __("Number of posts to show (-1 for all)." ,'easybook-add-ons'),
                'default'               => '-1'
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'order_by',
                'show_in_admin'         => true,
                'label'                 => __('Order by','easybook-add-ons'),
                'desc'                  => 'Select how to sort retrieved posts.',
                'default'               => 'date',
                'value'                 => array(   
                    'date'          => __('Date', 'easybook-add-ons'), 
                    'ID'            => __('ID', 'easybook-add-ons'), 
                    'author'        => __('Author', 'easybook-add-ons'), 
                    'title'         => __('Title', 'easybook-add-ons'), 
                    'modified'      => __('Modified', 'easybook-add-ons'),
                    'rand'          => __('Random', 'easybook-add-ons'),
                    'comment_count' => __('Comment Count', 'easybook-add-ons'),
                    'menu_order'    => __('Menu Order', 'easybook-add-ons'),
                    'post__in'      => __('ID order given (post__in)', 'easybook-add-ons')
                 ),
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'order',
                'show_in_admin'         => true,
                'label'                 => __('Sort Order','easybook-add-ons'),
                'desc'                  => 'Select Ascending or Descending order.',
                'default'               => 'DESC',
                'value'                 => array(   
                    'ASC' => __('Ascending', 'easybook-add-ons'), 
                    'DESC' => __('Descending', 'easybook-add-ons')                                                                           
                ),
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_lbreadcrumbs'] = array(
        'name'                  => __('Breadcrumbs','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Listing",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'), 
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );

    $new_elements['azp_listing_team_memeber'] = array(
        'name'                  => __('Members Grid','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Listing",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'title_item',
                'show_in_admin'         => true,
                'label'                 => __('Enter Title Item','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Event Speakers  '
            ),
            
            array(
                'type'                  => 'select',
                'param_name'            => 'columns_grid',
                'show_in_admin'         => true,
                'label'                 => __('Columns Grid','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'three',
                'value'                 => array(   
                    'one'       => esc_html__('One Column', 'easybook-add-ons'), 
                    'two'       => esc_html__('Two Columns', 'easybook-add-ons'), 
                    'three'     => esc_html__('Three Columns', 'easybook-add-ons'), 
                    'four'      => esc_html__('Four Columns', 'easybook-add-ons'), 
                    'five'      => esc_html__('Five Columns', 'easybook-add-ons'), 
                    'six'       => esc_html__('Six Columns', 'easybook-add-ons'), 
                    'seven'     => esc_html__('Seven Columns', 'easybook-add-ons'), 
                    'eight'     => esc_html__('Eight Columns', 'easybook-add-ons'), 
                    'nine'      => esc_html__('Nine Columns', 'easybook-add-ons'), 
                    'ten'       => esc_html__('Ten Columns', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'space',
                'show_in_admin'         => true,
                'label'                 => __('Space','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'medium',
                'value'                 => array(   
                    'exbig' => esc_html__('Extra Big', 'easybook-add-ons'), 
                    'mbig' => esc_html__('Bigger', 'easybook-add-ons'), 
                    'big' => esc_html__('Big', 'easybook-add-ons'), 
                    'medium' => esc_html__('Medium', 'easybook-add-ons'), 
                    'small' => esc_html__('Small', 'easybook-add-ons'), 
                    'extrasmall' => esc_html__('Extra Small', 'easybook-add-ons'), 
                    'no' => esc_html__('None', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );

    $new_elements['azp_members_slider'] = array(
        'name'                  => __('Members Slider (NEW)','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Listing",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'wid_title',
                'show_in_admin'         => true,
                'label'                 => __('Widget Title','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Members Slider'
            ),
            array(
                "type"                  => "text",
                "label"                 => esc_html__("Responsive", 'easybook-add-ons'),
                "param_name"            => "responsive",
                "desc"                  => esc_html__("The format is: screen-size:number-items-display,larger-screen-size:number-items-display. Ex: 320:1,768:2,1500:3", 'easybook-add-ons'),
                "default"               => "320:1,768:2,1500:3"
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );

    $new_elements['azp_availability_calendar'] = array(
        'name'                  => __('Availability Calendar (NEW)','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Listing",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        // 'showStyleTab'=> true,
        // 'showTypographyTab'=> true,
        // 'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'wid_title',
                'label'                 => __('Widget Title','easybook-add-ons'),
                // 'desc'                  => '',
                'default'               => 'Availability Calendar'
            ),

            array(
                'type'                  => 'select',
                'param_name'            => 'dates_source',
                'show_in_admin'         => true,
                'label'                 => __('Dates from','easybook-add-ons'),
                // 'desc'                  => 'Select Ascending or Descending order.',
                'default'               => 'listing_dates',
                'value'                 => array(   
                    'listing_dates'           => __('Available Dates (NEW)', 'easybook-add-ons'), 
                    // 'tour_calendar_metas'   => __('Tour Dates', 'easybook-add-ons'), 
                    'hotel_room_dates'      => __('Hotel Room Dates', 'easybook-add-ons'), 
                    // 'house_dates'           => __('House Dates', 'easybook-add-ons'), 
                    
                    // 'event_dates'           => __('Event Dates', 'easybook-add-ons'),                                                     
                ),
            ),

            

            array(
                'type'                  => 'text',
                'param_name'            => 'showing',
                'label'                 => __('Months to show','easybook-add-ons'),
                // 'desc'                  => '',
                'default'               => '2'
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'max',
                'label'                 => __('Max Months','easybook-add-ons'),
                // 'desc'                  => '',
                'default'               => '12'
            ),

            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );

    $new_elements['azp_similar_listings'] = array(
        'name'                  => __('Similar Listings (NEW)','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Listing",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        // 'showStyleTab'=> true,
        // 'showTypographyTab'=> true,
        // 'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'wid_title',
                'label'                 => __('Widget Title','easybook-add-ons'),
                // 'desc'                  => '',
                'default'               => 'Similar Listings'
            ),

            array(
                'type'                  => 'select',
                'param_name'            => 'taxonomy',
                'show_in_admin'         => true,
                'label'                 => __('Listings related','easybook-add-ons'),
                // 'desc'                  => 'Select Ascending or Descending order.',
                'default'               => 'listing_cat',
                'value'                 => array(   
                    'listing_cat' => __('Same Categories', 'easybook-add-ons'), 
                    'listing_location' => __('Same Locations', 'easybook-add-ons'), 
                    'listing_feature' => __('Same Features', 'easybook-add-ons'), 
                    'listing_tag' => __('Same Tags', 'easybook-add-ons'),                                                                 
                ),
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'posts_per_page',
                'show_in_admin'         => true,
                'label'                 => __('Listings to show','easybook-add-ons'),
                'desc'                  => __("Number of listings to show (-1 for all)." ,'easybook-add-ons'),
                'default'               => '3'
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'order_by',
                'show_in_admin'         => true,
                'label'                 => __('Order by','easybook-add-ons'),
                // 'desc'                  => 'Select how to sort retrieved posts.',
                'default'               => 'date',
                'value'                 => array(   
                    'date'          => __('Date', 'easybook-add-ons'), 
                    'ID'            => __('ID', 'easybook-add-ons'), 
                    'author'        => __('Author', 'easybook-add-ons'), 
                    'title'         => __('Title', 'easybook-add-ons'), 
                    'modified'      => __('Modified', 'easybook-add-ons'),
                    'rand'          => __('Random', 'easybook-add-ons'),
                    'comment_count' => __('Comment Count', 'easybook-add-ons'),
                    'menu_order'    => __('Menu Order', 'easybook-add-ons'),
                    // 'post__in'      => __('ID order given (post__in)', 'easybook-add-ons')
                 ),
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'order',
                'show_in_admin'         => true,
                'label'                 => __('Sort Order','easybook-add-ons'),
                // 'desc'                  => 'Select Ascending or Descending order.',
                'default'               => 'DESC',
                'value'                 => array(   
                    'ASC' => __('Ascending', 'easybook-add-ons'), 
                    'DESC' => __('Descending', 'easybook-add-ons')                                                                           
                ),
            ),

            array(
                "type"                  => "text",
                "label"                 => esc_html__("Responsive", 'easybook-add-ons'),
                "param_name"            => "responsive",
                "desc"                  => esc_html__("The format is: screen-size:number-items-display,larger-screen-size:number-items-display. Ex: 528:1,800:2,1224:3,1500:4", 'easybook-add-ons'),
                "default"               => "528:1,800:2,1224:2,1500:2"
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    
    $new_elements['azp_widget_content_info'] = array(
        'name'                  => __('Widget Content Info','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Widget",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );

    $new_elements['azp_general_booking'] = array(
        'name'                  => __('General Booking (NEW)','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Widget",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        // 'showStyleTab'=> true,
        // 'showTypographyTab'=> true,
        // 'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'wid_title',
                'label'                 => __('Widget Title','easybook-add-ons'),
                // 'desc'                  => '',
                'default'               => 'Listing Booking'
            ),
            array(
                'type'                  => 'checkbox',
                'param_name'            => 'hide_widget_on',
                // 'show_in_admin'         => true,
                'label'                 => __('Hide this widget on','easybook-add-ons'),
                'desc'                  => __('Hide on logout user or based author plan?','easybook-add-ons'),
                'default'               => '',
                'value'                 => easybook_addons_loggedin_plans_options(),
                'multiple'              => true,
                'show_toggle'           => true,
            ),

            array(
                'type'                  => 'select',
                'param_name'            => 'bprice',
                // 'show_in_admin'         => true,
                'label'                 => __('Price Based','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'per_night',
                'value'                 => array(   
                    'per_person'            => __('Per person', 'easybook-add-ons'), 
                    'per_night'             => __('Per night', 'easybook-add-ons'), 
                    'night_person'          => __('Per person/night', 'easybook-add-ons'), 
                    'per_day'               => __('Per day', 'easybook-add-ons'), 
                    'day_person'            => __('Per person/day', 'easybook-add-ons'), 
                    'none'                  => __('No listing price', 'easybook-add-ons'), 
                    
                 ),
            ),

            array(
                'type'                  => 'switch',
                'param_name'            => 'checkin_show',
                // 'show_in_admin'         => true,
                'label'                 => __('Show Checkin?','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '1',
                'value'                 => array(   
                    '1'             => __('Yes', 'easybook-add-ons'), 
                    '0'             => __('No', 'easybook-add-ons'), 
                 ),
            ),

            array(
                'type'                  => 'switch',
                'param_name'            => 'checkout_show',
                // 'show_in_admin'         => true,
                'label'                 => __('Show Checkout?','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '1',
                'value'                 => array(   
                    '1'             => __('Yes', 'easybook-add-ons'), 
                    '0'             => __('No', 'easybook-add-ons'), 
                 ),
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'dlabel',
                'label'                 => __('Date picker label','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Date'
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'dicon',
                'label'                 => __('Date picker icon','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'fal fa-calendar-check'
            ),

            

            array(
                'type'                  => 'select',
                'param_name'            => 'dformat',
                'show_in_admin'         => true,
                'label'                 => __('Date Format','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'DD/MM/YYYY',
                'value'                 => array(   
                    'DD-MM-YYYY'                 => __('28-02-2019', 'easybook-add-ons'), 
                    'DD/MM/YYYY'                 => __('28/02/2019', 'easybook-add-ons'), 

                    'MM-DD-YYYY'                 => __('02-28-2019', 'easybook-add-ons'), 
                    'MM/DD/YYYY'                 => __('02/28/2019', 'easybook-add-ons'), 
                    
                    'YYYY-MM-DD'                 => __('2019-02-28', 'easybook-add-ons'), 
                    'YYYY/MM/DD'                 => __('2019/02/28', 'easybook-add-ons'), 
                 ),
            ),

            array(
                'type'                  => 'switch',
                'param_name'            => 'slots_show',
                // 'show_in_admin'         => true,
                'label'                 => __('Show Time Slots?','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '0',
                'value'                 => array(   
                    '1'             => __('Yes', 'easybook-add-ons'), 
                    '0'             => __('No', 'easybook-add-ons'), 
                 ),
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'sllable',
                'label'                 => __('Time slots label','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Time Slots'
            ),

            array(
                'type'                  => 'switch',
                'param_name'            => 'tpicker_show',
                // 'show_in_admin'         => true,
                'label'                 => __('Show Time Picker?','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '1',
                'value'                 => array(   
                    '1'             => __('Yes', 'easybook-add-ons'), 
                    '0'             => __('No', 'easybook-add-ons'), 
                 ),
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'tlabel',
                'label'                 => __('Time picker label','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Time'
            ),

            array(
                'type'                  => 'select',
                'param_name'            => 'tformat',
                'show_in_admin'         => true,
                'label'                 => __('Time Format','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'H:i:s',
                'value'                 => array(   
                    'g:i a'                 => __('8:30 am', 'easybook-add-ons'), 
                    'g:i A'                 => __('8:30 AM', 'easybook-add-ons'), 
                    'h:i a'                 => __('08:30 am', 'easybook-add-ons'), 
                    'h:i A'                 => __('08:30 AM', 'easybook-add-ons'), 
                    'G:i:s'                 => __('8:30:00 (24-hour)', 'easybook-add-ons'), 
                    'H:i:s'                 => __('08:30:00 (24-hour)', 'easybook-add-ons'), 
                 ),
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'ticon',
                'label'                 => __('Time picker icon','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'fal fa-clock'
            ),

            

            

            array(
                'type'                  => 'switch',
                'param_name'            => 'adult_show',
                // 'show_in_admin'         => true,
                'label'                 => __('Show Adults?','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '1',
                'value'                 => array(   
                    '1'          => __('Yes', 'easybook-add-ons'), 
                    '0'            => __('No', 'easybook-add-ons'), 
                 ),
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'adult_lbl',
                'label'                 => __('Adults field label','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Adults'
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'adult_desc',
                'label'                 => __('Adults field description','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Age 18+'
            ),

            array(
                'type'                  => 'switch',
                'param_name'            => 'child_show',
                // 'show_in_admin'         => true,
                'label'                 => __('Show Children?','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '1',
                'value'                 => array(   
                    '1'          => __('Yes', 'easybook-add-ons'), 
                    '0'            => __('No', 'easybook-add-ons'), 
                 ),
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'child_lbl',
                'label'                 => __('Children field label','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Children'
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'child_desc',
                'label'                 => __('Children field description','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Age 6-17'
            ),

            array(
                'type'                  => 'switch',
                'param_name'            => 'infant_show',
                // 'show_in_admin'         => true,
                'label'                 => __('Show Infant?','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '1',
                'value'                 => array(   
                    '1'          => __('Yes', 'easybook-add-ons'), 
                    '0'            => __('No', 'easybook-add-ons'), 
                 ),
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'infant_lbl',
                'label'                 => __('Infant field label','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Infant'
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'infant_desc',
                'label'                 => __('Infant field description','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Age 0-5'
            ),

            

            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );

    $new_elements['azp_tour_booking'] = array(
        'name'                  => __('Tour Booking (NEW)','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Widget",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        // 'showStyleTab'=> true,
        // 'showTypographyTab'=> true,
        // 'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'wid_title',
                'label'                 => __('Widget Title','easybook-add-ons'),
                // 'desc'                  => '',
                'default'               => 'Tour Booking'
            ),
            array(
                'type'                  => 'checkbox',
                'param_name'            => 'hide_widget_on',
                // 'show_in_admin'         => true,
                'label'                 => __('Hide this widget on','easybook-add-ons'),
                'desc'                  => __('Hide on logout user or based author plan?','easybook-add-ons'),
                'default'               => '',
                'value'                 => easybook_addons_loggedin_plans_options(),
                'multiple'              => true,
                'show_toggle'           => true,
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'dlabel',
                'label'                 => __('Date picker label','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Date'
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'dicon',
                'label'                 => __('Date picker icon','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'fal fa-calendar-check'
            ),

            

            array(
                'type'                  => 'select',
                'param_name'            => 'dformat',
                'show_in_admin'         => true,
                'label'                 => __('Date Format','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'DD/MM/YYYY',
                'value'                 => array(   
                    'DD-MM-YYYY'                 => __('28-02-2019', 'easybook-add-ons'), 
                    'DD/MM/YYYY'                 => __('28/02/2019', 'easybook-add-ons'), 

                    'MM-DD-YYYY'                 => __('02-28-2019', 'easybook-add-ons'), 
                    'MM/DD/YYYY'                 => __('02/28/2019', 'easybook-add-ons'), 
                    
                    'YYYY-MM-DD'                 => __('2019-02-28', 'easybook-add-ons'), 
                    'YYYY/MM/DD'                 => __('2019/02/28', 'easybook-add-ons'), 
                 ),
            ),

            array(
                'type'                  => 'switch',
                'param_name'            => 'adult_show',
                // 'show_in_admin'         => true,
                'label'                 => __('Show Adults?','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '1',
                'value'                 => array(   
                    '1'          => __('Yes', 'easybook-add-ons'), 
                    '0'            => __('No', 'easybook-add-ons'), 
                 ),
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'adult_lbl',
                'label'                 => __('Adults field label','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Adults'
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'adult_desc',
                'label'                 => __('Adults field description','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Age 18+'
            ),

            array(
                'type'                  => 'switch',
                'param_name'            => 'child_show',
                // 'show_in_admin'         => true,
                'label'                 => __('Show Children?','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '1',
                'value'                 => array(   
                    '1'          => __('Yes', 'easybook-add-ons'), 
                    '0'            => __('No', 'easybook-add-ons'), 
                 ),
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'child_lbl',
                'label'                 => __('Children field label','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Children'
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'child_desc',
                'label'                 => __('Children field description','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Age 6-17'
            ),

            array(
                'type'                  => 'switch',
                'param_name'            => 'infant_show',
                // 'show_in_admin'         => true,
                'label'                 => __('Show Infant?','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '1',
                'value'                 => array(   
                    '1'          => __('Yes', 'easybook-add-ons'), 
                    '0'            => __('No', 'easybook-add-ons'), 
                 ),
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'infant_lbl',
                'label'                 => __('Infant field label','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Infant'
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'infant_desc',
                'label'                 => __('Infant field description','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Age 0-5'
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );

    $new_elements['azp_slot_booking'] = array(
        'name'                  => __('Time Slot Booking (NEW)','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Widget",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        // 'showStyleTab'=> true,
        // 'showTypographyTab'=> true,
        // 'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'wid_title',
                'label'                 => __('Widget Title','easybook-add-ons'),
                // 'desc'                  => '',
                'default'               => 'Time Slot Booking'
            ),
            array(
                'type'                  => 'checkbox',
                'param_name'            => 'hide_widget_on',
                // 'show_in_admin'         => true,
                'label'                 => __('Hide this widget on','easybook-add-ons'),
                'desc'                  => __('Hide on logout user or based author plan?','easybook-add-ons'),
                'default'               => '',
                'value'                 => easybook_addons_loggedin_plans_options(),
                'multiple'              => true,
                'show_toggle'           => true,
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'dlabel',
                'label'                 => __('Date picker label','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Date'
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'dicon',
                'label'                 => __('Date picker icon','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'fal fa-calendar-check'
            ),

            

            array(
                'type'                  => 'select',
                'param_name'            => 'dformat',
                'show_in_admin'         => true,
                'label'                 => __('Date Format','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'DD/MM/YYYY',
                'value'                 => array(   
                    'DD-MM-YYYY'                 => __('28-02-2019', 'easybook-add-ons'), 
                    'DD/MM/YYYY'                 => __('28/02/2019', 'easybook-add-ons'), 

                    'MM-DD-YYYY'                 => __('02-28-2019', 'easybook-add-ons'), 
                    'MM/DD/YYYY'                 => __('02/28/2019', 'easybook-add-ons'), 
                    
                    'YYYY-MM-DD'                 => __('2019-02-28', 'easybook-add-ons'), 
                    'YYYY/MM/DD'                 => __('2019/02/28', 'easybook-add-ons'), 
                 ),
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'tlabel',
                'label'                 => __('Time slots label','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Time Slots'
            ),

            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );

    $new_elements['azp_time_booking'] = array(
        'name'                  => __('Time Picker Booking (NEW)','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Widget",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        // 'showStyleTab'=> true,
        // 'showTypographyTab'=> true,
        // 'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'wid_title',
                'label'                 => __('Widget Title','easybook-add-ons'),
                // 'desc'                  => '',
                'default'               => 'Time Picker Booking'
            ),
            array(
                'type'                  => 'checkbox',
                'param_name'            => 'hide_widget_on',
                // 'show_in_admin'         => true,
                'label'                 => __('Hide this widget on','easybook-add-ons'),
                'desc'                  => __('Hide on logout user or based author plan?','easybook-add-ons'),
                'default'               => '',
                'value'                 => easybook_addons_loggedin_plans_options(),
                'multiple'              => true,
                'show_toggle'           => true,
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'dlabel',
                'label'                 => __('Date picker label','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Date'
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'dicon',
                'label'                 => __('Date picker icon','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'fal fa-calendar-check'
            ),

            

            array(
                'type'                  => 'select',
                'param_name'            => 'dformat',
                'show_in_admin'         => true,
                'label'                 => __('Date Format','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'DD/MM/YYYY',
                'value'                 => array(   
                    'DD-MM-YYYY'                 => __('28-02-2019', 'easybook-add-ons'), 
                    'DD/MM/YYYY'                 => __('28/02/2019', 'easybook-add-ons'), 

                    'MM-DD-YYYY'                 => __('02-28-2019', 'easybook-add-ons'), 
                    'MM/DD/YYYY'                 => __('02/28/2019', 'easybook-add-ons'), 
                    
                    'YYYY-MM-DD'                 => __('2019-02-28', 'easybook-add-ons'), 
                    'YYYY/MM/DD'                 => __('2019/02/28', 'easybook-add-ons'), 
                 ),
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'tlabel',
                'label'                 => __('Time picker label','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Time'
            ),

            array(
                'type'                  => 'select',
                'param_name'            => 'tformat',
                'show_in_admin'         => true,
                'label'                 => __('Time Format','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'H:i:s',
                'value'                 => array(   
                    'g:i a'                 => __('8:30 am', 'easybook-add-ons'), 
                    'g:i A'                 => __('8:30 AM', 'easybook-add-ons'), 
                    'h:i a'                 => __('08:30 am', 'easybook-add-ons'), 
                    'h:i A'                 => __('08:30 AM', 'easybook-add-ons'), 
                    'G:i:s'                 => __('8:30:00 (24-hour)', 'easybook-add-ons'), 
                    'H:i:s'                 => __('08:30:00 (24-hour)', 'easybook-add-ons'), 
                 ),
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'ticon',
                'label'                 => __('Time picker icon','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'fal fa-clock'
            ),

            array(
                'type'                  => 'switch',
                'param_name'            => 'adult_show',
                // 'show_in_admin'         => true,
                'label'                 => __('Show Adults?','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '1',
                'value'                 => array(   
                    '1'          => __('Yes', 'easybook-add-ons'), 
                    '0'            => __('No', 'easybook-add-ons'), 
                 ),
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'adult_lbl',
                'label'                 => __('Adults field label','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Adults'
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'adult_desc',
                'label'                 => __('Adults field description','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Age 18+'
            ),

            array(
                'type'                  => 'switch',
                'param_name'            => 'child_show',
                // 'show_in_admin'         => true,
                'label'                 => __('Show Children?','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '1',
                'value'                 => array(   
                    '1'          => __('Yes', 'easybook-add-ons'), 
                    '0'            => __('No', 'easybook-add-ons'), 
                 ),
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'child_lbl',
                'label'                 => __('Children field label','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Children'
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'child_desc',
                'label'                 => __('Children field description','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Age 6-17'
            ),

            array(
                'type'                  => 'switch',
                'param_name'            => 'infant_show',
                // 'show_in_admin'         => true,
                'label'                 => __('Show Infant?','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '1',
                'value'                 => array(   
                    '1'          => __('Yes', 'easybook-add-ons'), 
                    '0'            => __('No', 'easybook-add-ons'), 
                 ),
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'infant_lbl',
                'label'                 => __('Infant field label','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Infant'
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'infant_desc',
                'label'                 => __('Infant field description','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Age 0-5'
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    
    $new_elements['azp_rental_booking'] = array(
        'name'                  => __('Rental Booking (NEW)','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Widget",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        // 'showStyleTab'=> true,
        // 'showTypographyTab'=> true,
        // 'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'wid_title',
                'label'                 => __('Widget Title','easybook-add-ons'),
                // 'desc'                  => '',
                'default'               => 'Rental Booking'
            ),
            array(
                'type'                  => 'checkbox',
                'param_name'            => 'hide_widget_on',
                // 'show_in_admin'         => true,
                'label'                 => __('Hide this widget on','easybook-add-ons'),
                'desc'                  => __('Hide on logout user or based author plan?','easybook-add-ons'),
                'default'               => '',
                'value'                 => easybook_addons_loggedin_plans_options(),
                'multiple'              => true,
                'show_toggle'           => true,
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'dlabel',
                'label'                 => __('Date picker label','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Date'
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'dicon',
                'label'                 => __('Date picker icon','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'fal fa-calendar-check'
            ),

            

            array(
                'type'                  => 'select',
                'param_name'            => 'dformat',
                'show_in_admin'         => true,
                'label'                 => __('Date Format','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'DD/MM/YYYY',
                'value'                 => array(   
                    'DD-MM-YYYY'                 => __('28-02-2019', 'easybook-add-ons'), 
                    'DD/MM/YYYY'                 => __('28/02/2019', 'easybook-add-ons'), 

                    'MM-DD-YYYY'                 => __('02-28-2019', 'easybook-add-ons'), 
                    'MM/DD/YYYY'                 => __('02/28/2019', 'easybook-add-ons'), 
                    
                    'YYYY-MM-DD'                 => __('2019-02-28', 'easybook-add-ons'), 
                    'YYYY/MM/DD'                 => __('2019/02/28', 'easybook-add-ons'), 
                 ),
            ),


            array(
                'type'                  => 'switch',
                'param_name'            => 'adult_show',
                // 'show_in_admin'         => true,
                'label'                 => __('Show Adults?','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '1',
                'value'                 => array(   
                    '1'          => __('Yes', 'easybook-add-ons'), 
                    '0'            => __('No', 'easybook-add-ons'), 
                 ),
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'adult_lbl',
                'label'                 => __('Adults field label','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Adults'
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'adult_desc',
                'label'                 => __('Adults field description','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Age 18+'
            ),

            array(
                'type'                  => 'switch',
                'param_name'            => 'child_show',
                // 'show_in_admin'         => true,
                'label'                 => __('Show Children?','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '1',
                'value'                 => array(   
                    '1'          => __('Yes', 'easybook-add-ons'), 
                    '0'            => __('No', 'easybook-add-ons'), 
                 ),
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'child_lbl',
                'label'                 => __('Children field label','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Children'
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'child_desc',
                'label'                 => __('Children field description','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Age 6-17'
            ),

            array(
                'type'                  => 'switch',
                'param_name'            => 'infant_show',
                // 'show_in_admin'         => true,
                'label'                 => __('Show Infant?','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '1',
                'value'                 => array(   
                    '1'          => __('Yes', 'easybook-add-ons'), 
                    '0'            => __('No', 'easybook-add-ons'), 
                 ),
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'infant_lbl',
                'label'                 => __('Infant field label','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Infant'
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'infant_desc',
                'label'                 => __('Infant field description','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Age 0-5'
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );

    $new_elements['booking_inquiry'] = array(
        'name'                    => __('Booking Inquiry (NEW)', 'easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'                => __("Widget", 'easybook-add-ons'),
        'icon'                    => ESB_DIR_URL . 'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create' => true,
        // 'showStyleTab'=> true,
        // 'showTypographyTab'=> true,
        // 'showAnimationTab'=> true,
        'attrs'                   => array(
            array(
                'type'          => 'text',
                'param_name'    => 'title',
                'show_in_admin' => true,
                'label'         => __('Title', 'easybook-add-ons'),
                'default'       => 'Booking Inquiry',
            ),

            array(
                'type'        => 'checkbox',
                'param_name'  => 'hide_widget_on',
                // 'show_in_admin'         => true,
                'label'       => __('Hide this widget on', 'easybook-add-ons'),
                'desc'        => __('Hide on logout user or based author plan?', 'easybook-add-ons'),
                'default'     => '',
                'value'       => easybook_addons_loggedin_plans_options(),
                'multiple'    => true,
                'show_toggle' => true,
            ),

            array(
                'type'          => 'switch',
                'param_name'    => 'show_name',
                'show_in_admin' => true,
                'label'         => __('Show name on logged in user?', 'easybook-add-ons'),
                'desc'          => '',
                'default'       => 'no',
                'value'         => array(
                    'yes' => __('Yes', 'easybook-add-ons'),
                    'no'  => __('No', 'easybook-add-ons'),
                ),
            ),

            array(
                'type'          => 'switch',
                'param_name'    => 'show_email',
                'show_in_admin' => true,
                'label'         => __('Show email on logged in user?', 'easybook-add-ons'),
                'desc'          => '',
                'default'       => 'no',
                'value'         => array(
                    'yes' => __('Yes', 'easybook-add-ons'),
                    'no'  => __('No', 'easybook-add-ons'),
                ),
            ),

            array(
                'type'          => 'switch',
                'param_name'    => 'show_phone',
                'show_in_admin' => true,
                'label'         => __('Show phone on logged in user?', 'easybook-add-ons'),
                'desc'          => '',
                'default'       => 'yes',
                'value'         => array(
                    'yes' => __('Yes', 'easybook-add-ons'),
                    'no'  => __('No', 'easybook-add-ons'),
                ),
            ),

            array(
                'type'       => 'switch',
                'param_name' => 'checkin_show',
                // 'show_in_admin'         => true,
                'label'      => __('Show Checkin?', 'easybook-add-ons'),
                'desc'       => '',
                'default'    => '1',
                'value'      => array(
                    '1' => __('Yes', 'easybook-add-ons'),
                    '0' => __('No', 'easybook-add-ons'),
                ),
            ),

            array(
                'type'       => 'switch',
                'param_name' => 'checkout_show',
                // 'show_in_admin'         => true,
                'label'      => __('Show Checkout?', 'easybook-add-ons'),
                'desc'       => '',
                'default'    => '1',
                'value'      => array(
                    '1' => __('Yes', 'easybook-add-ons'),
                    '0' => __('No', 'easybook-add-ons'),
                ),
            ),

            array(
                'type'       => 'text',
                'param_name' => 'dlabel',
                'label'      => __('Date picker label', 'easybook-add-ons'),
                'desc'       => '',
                'default'    => 'Date',
            ),

            array(
                'type'       => 'icon',
                'param_name' => 'dicon',
                'label'      => __('Date picker icon', 'easybook-add-ons'),
                'desc'       => '',
                'default'    => 'fal fa-calendar-check',
            ),

            array(
                'type'          => 'select',
                'param_name'    => 'dformat',
                'show_in_admin' => true,
                'label'         => __('Date Format', 'easybook-add-ons'),
                'desc'          => '',
                'default'       => 'DD/MM/YYYY',
                'value'         => array(
                    'DD-MM-YYYY' => __('28-02-2019', 'easybook-add-ons'),
                    'DD/MM/YYYY' => __('28/02/2019', 'easybook-add-ons'),

                    'MM-DD-YYYY' => __('02-28-2019', 'easybook-add-ons'),
                    'MM/DD/YYYY' => __('02/28/2019', 'easybook-add-ons'),

                    'YYYY-MM-DD' => __('2019-02-28', 'easybook-add-ons'),
                    'YYYY/MM/DD' => __('2019/02/28', 'easybook-add-ons'),
                ),
            ),

            array(
                'type'       => 'switch',
                'param_name' => 'slots_show',
                // 'show_in_admin'         => true,
                'label'      => __('Show Time Slots?', 'easybook-add-ons'),
                'desc'       => '',
                'default'    => '0',
                'value'      => array(
                    '1' => __('Yes', 'easybook-add-ons'),
                    '0' => __('No', 'easybook-add-ons'),
                ),
            ),

            array(
                'type'       => 'text',
                'param_name' => 'sllable',
                'label'      => __('Time slots label', 'easybook-add-ons'),
                'desc'       => '',
                'default'    => 'Time Slots',
            ),

            array(
                'type'       => 'switch',
                'param_name' => 'tpicker_show',
                // 'show_in_admin'         => true,
                'label'      => __('Show Time Picker?', 'easybook-add-ons'),
                'desc'       => '',
                'default'    => '1',
                'value'      => array(
                    '1' => __('Yes', 'easybook-add-ons'),
                    '0' => __('No', 'easybook-add-ons'),
                ),
            ),

            array(
                'type'       => 'text',
                'param_name' => 'tlabel',
                'label'      => __('Time picker label', 'easybook-add-ons'),
                'desc'       => '',
                'default'    => 'Time',
            ),

            array(
                'type'          => 'select',
                'param_name'    => 'tformat',
                'show_in_admin' => true,
                'label'         => __('Time Format', 'easybook-add-ons'),
                'desc'          => '',
                'default'       => 'H:i:s',
                'value'         => array(
                    'g:i a' => __('8:30 am', 'easybook-add-ons'),
                    'g:i A' => __('8:30 AM', 'easybook-add-ons'),
                    'h:i a' => __('08:30 am', 'easybook-add-ons'),
                    'h:i A' => __('08:30 AM', 'easybook-add-ons'),
                    'G:i:s' => __('8:30:00 (24-hour)', 'easybook-add-ons'),
                    'H:i:s' => __('08:30:00 (24-hour)', 'easybook-add-ons'),
                ),
            ),

            array(
                'type'       => 'icon',
                'param_name' => 'ticon',
                'label'      => __('Time picker icon', 'easybook-add-ons'),
                'desc'       => '',
                'default'    => 'fal fa-clock',
            ),

            array(
                'type'       => 'switch',
                'param_name' => 'adult_show',
                // 'show_in_admin'         => true,
                'label'      => __('Show Adults?', 'easybook-add-ons'),
                'desc'       => '',
                'default'    => '1',
                'value'      => array(
                    '1' => __('Yes', 'easybook-add-ons'),
                    '0' => __('No', 'easybook-add-ons'),
                ),
            ),

            array(
                'type'       => 'text',
                'param_name' => 'adult_lbl',
                'label'      => __('Adults field label', 'easybook-add-ons'),
                'desc'       => '',
                'default'    => 'Adults',
            ),

            array(
                'type'       => 'text',
                'param_name' => 'adult_desc',
                'label'      => __('Adults field description', 'easybook-add-ons'),
                'desc'       => '',
                'default'    => 'Age 18+',
            ),

            array(
                'type'       => 'switch',
                'param_name' => 'child_show',
                // 'show_in_admin'         => true,
                'label'      => __('Show Children?', 'easybook-add-ons'),
                'desc'       => '',
                'default'    => '1',
                'value'      => array(
                    '1' => __('Yes', 'easybook-add-ons'),
                    '0' => __('No', 'easybook-add-ons'),
                ),
            ),

            array(
                'type'       => 'text',
                'param_name' => 'child_lbl',
                'label'      => __('Children field label', 'easybook-add-ons'),
                'desc'       => '',
                'default'    => 'Children',
            ),

            array(
                'type'       => 'text',
                'param_name' => 'child_desc',
                'label'      => __('Children field description', 'easybook-add-ons'),
                'desc'       => '',
                'default'    => 'Age 6-17',
            ),

            array(
                'type'       => 'switch',
                'param_name' => 'infant_show',
                // 'show_in_admin'         => true,
                'label'      => __('Show Infant?', 'easybook-add-ons'),
                'desc'       => '',
                'default'    => '1',
                'value'      => array(
                    '1' => __('Yes', 'easybook-add-ons'),
                    '0' => __('No', 'easybook-add-ons'),
                ),
            ),

            array(
                'type'       => 'text',
                'param_name' => 'infant_lbl',
                'label'      => __('Infant field label', 'easybook-add-ons'),
                'desc'       => '',
                'default'    => 'Infant',
            ),

            array(
                'type'       => 'text',
                'param_name' => 'infant_desc',
                'label'      => __('Infant field description', 'easybook-add-ons'),
                'desc'       => '',
                'default'    => 'Age 0-5',
            ),

            array(
                'type'          => 'switch',
                'param_name'    => 'show_notes',
                'show_in_admin' => true,
                'label'         => __('Show Additional Infos', 'easybook-add-ons'),
                'desc'          => '',
                'default'       => 'no',
                'value'         => array(
                    'yes' => __('Yes', 'easybook-add-ons'),
                    'no'  => __('No', 'easybook-add-ons'),
                ),
            ),

            array(
                'type'       => 'text',
                'param_name' => 'el_id',
                'label'      => __('Element ID', 'easybook-add-ons'),
                // 'desc'                  => '',
                'default'    => '',
            ),

            array(
                'type'       => 'text',
                'param_name' => 'el_class',
                'label'      => __('Extra Class', 'easybook-add-ons'),
                'desc'       => __("Use this field to add a class name and then refer to it in your CSS.", 'easybook-add-ons'),
                'default'    => '',
            ),

        ),
    );

    $new_elements['azp_widget_booking'] = array(
        'name'                  => __('Widget Booking','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Widget",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        // 'showStyleTab'=> true,
        // 'showTypographyTab'=> true,
        // 'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'checkbox',
                'param_name'            => 'hide_widget_on',
                // 'show_in_admin'         => true,
                'label'                 => __('Hide this widget on','easybook-add-ons'),
                'desc'                  => __('Hide on logout user or based author plan?','easybook-add-ons'),
                'default'               => '',
                'value'                 => easybook_addons_loggedin_plans_options(),
                'multiple'              => true,
                'show_toggle'           => true,
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'show_name',
                'show_in_admin'         => true,
                'label'                 => __('Show name on logged in user?','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'no',
                'value'                 => array(   
                    'yes'          => __('Yes', 'easybook-add-ons'), 
                    'no'            => __('No', 'easybook-add-ons'), 
                 ),
            ),

            array(
                'type'                  => 'switch',
                'param_name'            => 'show_email',
                'show_in_admin'         => true,
                'label'                 => __('Show email on logged in user?','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'no',
                'value'                 => array(   
                    'yes'          => __('Yes', 'easybook-add-ons'), 
                    'no'            => __('No', 'easybook-add-ons'), 
                 ),
            ),


            array(
                'type'                  => 'switch',
                'param_name'            => 'show_phone',
                'show_in_admin'         => true,
                'label'                 => __('Show phone on logged in user?','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'yes',
                'value'                 => array(   
                    'yes'          => __('Yes', 'easybook-add-ons'), 
                    'no'            => __('No', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_widget_banner'] = array(
        'name'                  => __('Widget Banner','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Widget",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'checkbox',
                'param_name'            => 'hide_widget_on',
                // 'show_in_admin'         => true,
                'label'                 => __('Hide this widget on','easybook-add-ons'),
                'desc'                  => __('Hide on logout user or based author plan?','easybook-add-ons'),
                'default'               => '',
                'value'                 => easybook_addons_loggedin_plans_options(),
                'multiple'              => true,
                'show_toggle'           => true,
            ),
            // array(
            //     'type'                  => 'textarea',
            //     'param_name'            => 'dec_banner',
            //     'label'                 => __('Description Banner','easybook-add-ons'),
            //     // 'desc'                  => '',
            //     'default'               => 'Get a discount 20% when ordering a room from three days.'
            // ),
            array(
                'type'                  => 'editor',
                
                'param_name'            => 'content_baner',
                'label'                 => __('Content','easybook-add-ons'),
                'show_in_admin'         => true,
                'desc'                  => __("Text Content)" ,'easybook-add-ons'),
                'default'               => '<h4>Get a discount <span>20%</span> when ordering a room from three days.</h4>',
                'iscontent'             =>'yes'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'book_url',
                'label'                 => __('Link Booking','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '#'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_widget_contacts'] = array(
        'name'                  => __('Widget Contacts','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Widget",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'checkbox',
                'param_name'            => 'hide_widget_on',
                // 'show_in_admin'         => true,
                'label'                 => __('Hide this widget on','easybook-add-ons'),
                'desc'                  => __('Hide on logout user or based author plan?','easybook-add-ons'),
                'default'               => '',
                'value'                 => easybook_addons_loggedin_plans_options(),
                'multiple'              => true,
                'show_toggle'           => true,
            ),

            array(
                'type'                  => 'checkbox',
                'param_name'            => 'hide_contacts_on',
                // 'show_in_admin'         => true,
                'label'                 => __('Hide contacts on','easybook-add-ons'),
                'desc'                  => __('Hide on logout user or based author plan?','easybook-add-ons'),
                'default'               => '',
                'value'                 => easybook_addons_loggedin_plans_options(),
                'multiple'              => true,
                'show_toggle'           => true,
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_widget_price_range'] = array(
        'name'                  => __('Widget Price Range','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Widget",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'checkbox',
                'param_name'            => 'hide_widget_on',
                // 'show_in_admin'         => true,
                'label'                 => __('Hide this widget on','easybook-add-ons'),
                'desc'                  => __('Hide on logout user or based author plan?','easybook-add-ons'),
                'default'               => '',
                'value'                 => easybook_addons_loggedin_plans_options(),
                'multiple'              => true,
                'show_toggle'           => true,
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_widget_counter_event_dates'] = array(
        'name'                      => __('Widget Counter - Event Dates','easybook-add-ons'),
        // 'desc'                   => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'                  => __("Widget",'easybook-add-ons'),
        'icon'                      => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'   => true,
        'showStyleTab'              => true,
        'showTypographyTab'         => true,
        'showAnimationTab'          => true,
        'attrs' => array (
            array(
                'type'                  => 'checkbox',
                'param_name'            => 'hide_widget_on',
                // 'show_in_admin'         => true,
                'label'                 => __('Hide this widget on','easybook-add-ons'),
                'desc'                  => __('Hide on logout user or based author plan?','easybook-add-ons'),
                'default'               => '',
                'value'                 => easybook_addons_loggedin_plans_options(),
                'multiple'              => true,
                'show_toggle'           => true,
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'show_dates',
                'show_in_admin'         => true,
                'label'                 => __('Show event dates','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'yes',
                'value'                 => array(   
                    'yes'          => __('Yes', 'easybook-add-ons'), 
                    'no'            => __('No', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'dates_to_show',
                'label'                 => __('Number of first dates to show?','easybook-add-ons'),
                // 'desc'                  => '',
                'default'               => '3'
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'show_end',
                'show_in_admin'         => true,
                'label'                 => __('Show end date','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'yes',
                'value'                 => array(   
                    'yes'          => __('Yes', 'easybook-add-ons'), 
                    'no'            => __('No', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                // 'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_widget_event_dates'] = array(
        'name'                      => __('Widget Event Dates (NEW)','easybook-add-ons'),
        // 'desc'                   => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'                  => __("Widget",'easybook-add-ons'),
        'icon'                      => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'   =>true,
        'showStyleTab'              => true,
        'showTypographyTab'         => true,
        'showAnimationTab'          => true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'wid_title',
                'label'                 => __('Widget Title','easybook-add-ons'),
                // 'desc'                  => '',
                'default'               => 'Event Dates'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'dates_to_show',
                'label'                 => __('Number of first dates to show?','easybook-add-ons'),
                // 'desc'                  => '',
                'default'               => '3'
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'show_end',
                'show_in_admin'         => true,
                'label'                 => __('Show end date','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'yes',
                'value'                 => array(   
                    'yes'          => __('Yes', 'easybook-add-ons'), 
                    'no'            => __('No', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                // 'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_widget_weather'] = array(
        'name'                  => __('Widget weather','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Widget",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'checkbox',
                'param_name'            => 'hide_widget_on',
                // 'show_in_admin'         => true,
                'label'                 => __('Hide this widget on','easybook-add-ons'),
                'desc'                  => __('Hide on logout user or based author plan?','easybook-add-ons'),
                'default'               => '',
                'value'                 => easybook_addons_loggedin_plans_options(),
                'multiple'              => true,
                'show_toggle'           => true,
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_widget_author'] = array(
        'name'                  => __('Widget Author','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Widget",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'checkbox',
                'param_name'            => 'hide_widget_on',
                // 'show_in_admin'         => true,
                'label'                 => __('Hide this widget on','easybook-add-ons'),
                'desc'                  => __('Hide on logout user or based author plan?','easybook-add-ons'),
                'default'               => '',
                'value'                 => easybook_addons_loggedin_plans_options(),
                'multiple'              => true,
                'show_toggle'           => true,
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_widget_recommended'] = array(
        'name'                  => __('Widget Recommended','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Widget",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'checkbox',
                'param_name'            => 'hide_widget_on',
                // 'show_in_admin'         => true,
                'label'                 => __('Hide this widget on','easybook-add-ons'),
                'desc'                  => __('Hide on logout user or based author plan?','easybook-add-ons'),
                'default'               => '',
                'value'                 => easybook_addons_loggedin_plans_options(),
                'multiple'              => true,
                'show_toggle'           => true,
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'ids',
                'show_in_admin'         => true,
                'label'                 => __('Enter Post IDs','easybook-add-ons'),
                'desc'                  => __("Enter Post ids to show, separated by a comma. Leave empty to show all" ,'easybook-add-ons'),
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'posts_per_page',
                'show_in_admin'         => true,
                'label'                 => __('Posts to show','easybook-add-ons'),
                'desc'                  => __("Number of posts to show (-1 for all)." ,'easybook-add-ons'),
                'default'               => '-1'
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'order_by',
                'show_in_admin'         => true,
                'label'                 => __('Order by','easybook-add-ons'),
                'desc'                  => 'Select how to sort retrieved posts.',
                'default'               => 'date',
                'value'                 => array(   
                    'date'          => __('Date', 'easybook-add-ons'), 
                    'ID'            => __('ID', 'easybook-add-ons'), 
                    'author'        => __('Author', 'easybook-add-ons'), 
                    'title'         => __('Title', 'easybook-add-ons'), 
                    'modified'      => __('Modified', 'easybook-add-ons'),
                    'rand'          => __('Random', 'easybook-add-ons'),
                    'comment_count' => __('Comment Count', 'easybook-add-ons'),
                    'menu_order'    => __('Menu Order', 'easybook-add-ons'),
                    'post__in'      => __('ID order given (post__in)', 'easybook-add-ons')
                 ),
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'order',
                'show_in_admin'         => true,
                'label'                 => __('Sort Order','easybook-add-ons'),
                'desc'                  => 'Select Ascending or Descending order.',
                'default'               => 'DESC',
                'value'                 => array(   
                    'ASC' => __('Ascending', 'easybook-add-ons'), 
                    'DESC' => __('Descending', 'easybook-add-ons')                                                                           
                ),
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class', 
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_widget_ads'] = array(
        'name'                  => __('Widget Listing Author Ads ','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Widget",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_widget_author_message'] = array(
        'name'                  => __('Widget Listing Author Message','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Widget",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'checkbox',
                'param_name'            => 'hide_widget_on',
                // 'show_in_admin'         => true,
                'label'                 => __('Hide this widget on','easybook-add-ons'),
                'desc'                  => __('Hide on logout user or based author plan?','easybook-add-ons'),
                'default'               => '',
                'value'                 => easybook_addons_loggedin_plans_options(),
                'multiple'              => true,
                'show_toggle'           => true,
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['author_message'] = array(
        'name'                  => __('Author Message (NEW)','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Widget",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'checkbox',
                'param_name'            => 'hide_widget_on',
                // 'show_in_admin'         => true,
                'label'                 => __('Hide this widget on','easybook-add-ons'),
                'desc'                  => __('Hide on logout user or based author plan?','easybook-add-ons'),
                'default'               => '',
                'value'                 => easybook_addons_loggedin_plans_options(),
                'multiple'              => true,
                'show_toggle'           => true,
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_widget_booking_v2'] = array(
        'name'                  => __('Widget Booking Event','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Widget",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'checkbox',
                'param_name'            => 'hide_widget_on',
                // 'show_in_admin'         => true,
                'label'                 => __('Hide this widget on','easybook-add-ons'),
                'desc'                  => __('Hide on logout user or based author plan?','easybook-add-ons'),
                'default'               => '',
                'value'                 => easybook_addons_loggedin_plans_options(),
                'multiple'              => true,
                'show_toggle'           => true,
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'custom_price',
                'show_in_admin'         => true,
                'label'                 => __('Please input custom field name event price','easybook-add-ons'),
                'desc'                  => __("ex:price_from" ,'easybook-add-ons'),
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'custom_date',
                'show_in_admin'         => true,
                'label'                 => __('Please input custom field name event date','easybook-add-ons'),
                'desc'                  => __("ex:levent_date" ,'easybook-add-ons'),
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_widget_booking_product'] = array(
        'name'                  => __('Widget Booking Product','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Widget",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'checkbox',
                'param_name'            => 'hide_widget_on',
                // 'show_in_admin'         => true,
                'label'                 => __('Hide this widget on','easybook-add-ons'),
                'desc'                  => __('Hide on logout user or based author plan?','easybook-add-ons'),
                'default'               => '',
                'value'                 => easybook_addons_loggedin_plans_options(),
                'multiple'              => true,
                'show_toggle'           => true,
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_widget_coupon'] = array(
        'name'                  => __('Widget Discount Coupon','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Widget",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'dis_coupon',
                'show_in_admin'         => true,
                'label'                 => __('Display coupon','easybook-add-ons'),
                'desc'                  => __('Which coupon you want to show in this widget? 1 for first item.','easybook-add-ons'),
                'default'               => '1',
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    

// $new_elements['azp_widget_near_post'] = array(
//         'name'                  => __('Widget Near Posts','easybook-add-ons'),
//         // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
//         'category'              => __("Widget",'easybook-add-ons'),
//         'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
//         'open_settings_on_create'=>true,
//         'showStyleTab'=> true,
//         'showTypographyTab'=> true,
//         'showAnimationTab'=> true,
//         'attrs' => array (
//             array(
//                 'type'                  => 'text',
//                 'param_name'            => 'ids',
//                 'show_in_admin'         => true,
//                 'label'                 => __('Enter Post IDs','easybook-add-ons'),
//                 'desc'                  => __("Enter Post ids to show, separated by a comma. Leave empty to show all" ,'easybook-add-ons'),
//                 'default'               => ''
//             ),
//             array(
//                 'type'                  => 'text',
//                 'param_name'            => 'posts_per_page',
//                 'show_in_admin'         => true,
//                 'label'                 => __('Posts to show','easybook-add-ons'),
//                 'desc'                  => __("Number of posts to show (-1 for all)." ,'easybook-add-ons'),
//                 'default'               => '-1'
//             ),
//             array(
//                 'type'                  => 'select',
//                 'param_name'            => 'order_by',
//                 'show_in_admin'         => true,
//                 'label'                 => __('Order by','easybook-add-ons'),
//                 'desc'                  => 'Select how to sort retrieved posts.',
//                 'default'               => 'date',
//                 'value'                 => array(   
//                     'date'          => __('Date', 'easybook-add-ons'), 
//                     'ID'            => __('ID', 'easybook-add-ons'), 
//                     'author'        => __('Author', 'easybook-add-ons'), 
//                     'title'         => __('Title', 'easybook-add-ons'), 
//                     'modified'      => __('Modified', 'easybook-add-ons'),
//                     'rand'          => __('Random', 'easybook-add-ons'),
//                     'comment_count' => __('Comment Count', 'easybook-add-ons'),
//                     'menu_order'    => __('Menu Order', 'easybook-add-ons'),
//                     'post__in'      => __('ID order given (post__in)', 'easybook-add-ons')
//                  ),
//             ),
//             array(
//                 'type'                  => 'select',
//                 'param_name'            => 'order',
//                 'show_in_admin'         => true,
//                 'label'                 => __('Sort Order','easybook-add-ons'),
//                 'desc'                  => 'Select Ascending or Descending order.',
//                 'default'               => 'DESC',
//                 'value'                 => array(   
//                     'ASC' => __('Ascending', 'easybook-add-ons'), 
//                     'DESC' => __('Descending', 'easybook-add-ons')                                                                           
//                 ),
//             ),
//             array(
//                 'type'                  => 'text',
//                 'param_name'            => 'el_id',
//                 'label'                 => __('Element ID','easybook-add-ons'),
//                 'desc'                  => '',
//                 'default'               => ''
//             ),
            
//             array(
//                 'type'                  => 'text',
//                 'param_name'            => 'el_class',
//                 'label'                 => __('Extra Class','easybook-add-ons'),
//                 'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
//                 'default'               => ''
//             ),
            
//         )
//     );

    $new_elements['azp_mobile_btns'] = array(
        'name'                  => __('Mobile Buttons (NEW)','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Widget",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'switch',
                'param_name'            => 'show_phone',
                'show_in_admin'         => true,
                'label'                 => __('Show phone','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'yes',
                'value'                 => array(   
                    'yes'          => __('Yes', 'easybook-add-ons'), 
                    'no'            => __('No', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'show_email',
                'show_in_admin'         => true,
                'label'                 => __('Show email','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'no',
                'value'                 => array(   
                    'yes'          => __('Yes', 'easybook-add-ons'), 
                    'no'            => __('No', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'show_direction',
                'show_in_admin'         => true,
                'label'                 => __('Show get direction','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'yes',
                'value'                 => array(   
                    'yes'          => __('Yes', 'easybook-add-ons'), 
                    'no'            => __('No', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                // 'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );

    $new_elements['azp_sroom_gallery'] = array(
        'name'                  => __('Gallery','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Single Room",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_sroom_facts'] = array(
        'name'                  => __('Facts','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Single Room",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_sroom_features'] = array(
        'name'                  => __('Features','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Single Room",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'num_feature',
                'label'                 => __('Number of Feature to show','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '5'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_sroom_content'] = array(
        'name'                  => __('Content','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Single Room",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'title',
                'show_in_admin'         => true,
                'label'                 => __('Title','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Details'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_sroom_calendar'] = array(
        'name'                  => __('Calendar','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Single Room",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    // $new_elements['azp_sroom_quantity'] = array(
    //     'name'                  => __('Room Quantity','easybook-add-ons'),
    //     // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
    //     'category'              => __("Single Room",'easybook-add-ons'),
    //     'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
    //     'open_settings_on_create'=>true,
    //     'showStyleTab'=> true,
    //     'showTypographyTab'=> true,
    //     'showAnimationTab'=> true,
    //     'attrs' => array (
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'el_id',
    //             'label'                 => __('Element ID','easybook-add-ons'),
    //             'desc'                  => '',
    //             'default'               => ''
    //         ),
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'el_class',
    //             'label'                 => __('Extra Class','easybook-add-ons'),
    //             'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
    //             'default'               => ''
    //         ),
            
    //     )
    // );
    $new_elements['azp_sroom_button'] = array(
        'name'                  => __('Room Button','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Single Room",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'bt_name',
                'show_in_admin'         => true,
                'label'                 => __('Button Name','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Book Now'
            ),
            array(
                'type'                  => 'icon',
                'param_name'            => 'bt_icon',
                'show_in_admin'         => true,
                'label'                 => __('Icon Selector','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'bt_url',
                'show_in_admin'         => true,
                'label'                 => __('Link Button','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '#'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );
    // $new_elements['azp_sroom_addcart'] = array(
    //     'name'                  => __('Add To Cart','easybook-add-ons'),
    //     // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
    //     'category'              => __("Single Room",'easybook-add-ons'),
    //     'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
    //     'open_settings_on_create'=>true,
    //     'showStyleTab'=> true,
    //     'showTypographyTab'=> true,
    //     'showAnimationTab'=> true,
    //     'attrs' => array (
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'el_id',
    //             'label'                 => __('Element ID','easybook-add-ons'),
    //             'desc'                  => '',
    //             'default'               => ''
    //         ),
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'el_class',
    //             'label'                 => __('Extra Class','easybook-add-ons'),
    //             'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
    //             'default'               => ''
    //         ), 
    //     )
    // );
    $new_elements['azp_filter_category'] = array(
        'name'                  => __('Categories (NEW)','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Filter",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text', 
                'param_name'            => 'title',
                'show_in_admin'         => true,
                'label'                 => __('Title','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Category'
            ),
            array(
                'type'                  => 'checkbox',
                'param_name'            => 'cats',
                // 'show_in_admin'         => true,
                'label'                 => __('Categories','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '',
                'value'                 => easybook_addons_lcats_options(),
                'multiple'              => true,
                'show_toggle'           => true,
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'max_level',
                'show_in_admin'         => true,
                'label'                 => __('Child categories level','easybook-add-ons'),
                // 'desc'                  => 'Select how to sort retrieved posts.',
                'default'               => '0',
                'value'                 => array(   
                    '0'           => __('Hide children', 'easybook-add-ons'), 
                    '1'           => __('Level 1', 'easybook-add-ons'), 
                    '2'           => __('Level 2', 'easybook-add-ons'), 
                    '3'           => __('Level 3', 'easybook-add-ons'), 
                    
                 ),
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'hide_empty',
                'show_in_admin'         => true,
                'label'                 => __('Hide empty child?','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'yes',
                'value'                 => array(   
                    'yes'          => __('Yes', 'easybook-add-ons'), 
                    'no'            => __('No', 'easybook-add-ons'), 
                 ),
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_filter_location'] = array(
        'name'                  => __('Locations','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Filter",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text', 
                'param_name'            => 'title',
                'show_in_admin'         => true,
                'label'                 => __('Title','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Location'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_filter_ltags'] = array(
        'name'                  => __('Listing Tags (NEW)','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Filter",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'wid_title',
                'label'                 => __('Title','easybook-add-ons'),
                // 'desc'                  => '',
                'default'               => 'Filter by Tags'
            ),
            array(
                'type'                  => 'checkbox',
                'param_name'            => 'tags',
                // 'show_in_admin'         => true,
                'label'                 => __('Filter tags','easybook-add-ons'),
                // 'desc'                  => __('Hide on logout user or based author plan?','easybook-add-ons'),
                'default'               => '',
                'value'                 => easybook_addons_listing_ltags_options(),
                'multiple'              => true,
                'show_toggle'           => true,
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                // 'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );
    $new_elements['azp_filter_destination'] = array(
        'name'                  => __('Destination','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Filter",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text', 
                'param_name'            => 'title',
                'show_in_admin'         => true,
                'label'                 => __('Title','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Destination'
            ),
            array(
                'type'                  => 'icon',
                'param_name'            => 'azp_icon',
                'show_in_admin'         => true,
                'label'                 => __('Icon Selector','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'filter_dis',
                'show_in_admin'         => true,
                'label'                 => __('Select where to display','easybook-add-ons'),
                // 'desc'                  => 'Select how to sort retrieved posts.',
                'default'               => 'listing',
                'value'                 => array(   
                    'listing'           => __('Filter Listing', 'easybook-add-ons'), 
                    'header'            => __('Filter Header', 'easybook-add-ons'), 
                    'hero'              => __('Filter Hero Section', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_filter_date'] = array(
        'name'                  => __('Date IN-OUT','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Filter",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text', 
                'param_name'            => 'title',
                'show_in_admin'         => true,
                'label'                 => __('Title','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Date In-Out '
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'filter_dis',
                'show_in_admin'         => true,
                'label'                 => __('Select where to display','easybook-add-ons'),
                // 'desc'                  => 'Select how to sort retrieved posts.',
                'default'               => 'listing',
                'value'                 => array(   
                    'listing'          => __('Filter Listing', 'easybook-add-ons'), 
                    'header'            => __('Filter Header', 'easybook-add-ons'), 
                    'hero'        => __('Filter Hero Section', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'icon',
                'param_name'            => 'azp_icon',
                'show_in_admin'         => true,
                'label'                 => __('Icon Selector','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_filter_room'] = array(
        'name'                  => __('Option Room','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Filter",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text', 
                'param_name'            => 'title',
                'show_in_admin'         => true,
                'label'                 => __('Title','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Rooms'
            ),
            array(
                'type'                  => 'icon',
                'param_name'            => 'azp_icon',
                'show_in_admin'         => true,
                'label'                 => __('Icon Selector','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text', 
                'param_name'            => 'max',
                'show_in_admin'         => true,
                'label'                 => __('Quantity Max','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '30'
            ),
            array(
                'type'                  => 'text', 
                'param_name'            => 'min',
                'show_in_admin'         => true,
                'label'                 => __('Quantity Min','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '1'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_filter_adults'] = array(
        'name'                  => __('Option Adults','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Filter",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text', 
                'param_name'            => 'title',
                'show_in_admin'         => true,
                'label'                 => __('Title','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Adults'
            ),
            array(
                'type'                  => 'icon',
                'param_name'            => 'azp_icon',
                'show_in_admin'         => true,
                'label'                 => __('Icon Selector','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text', 
                'param_name'            => 'max',
                'show_in_admin'         => true,
                'label'                 => __('Quantity Max','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '30'
            ),
            array(
                'type'                  => 'text', 
                'param_name'            => 'min',
                'show_in_admin'         => true,
                'label'                 => __('Quantity Min','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '1'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_filter_children'] = array(
        'name'                  => __('Option Children','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Filter",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text', 
                'param_name'            => 'title',
                'show_in_admin'         => true,
                'label'                 => __('Title','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Children'
            ),
            array(
                'type'                  => 'icon',
                'param_name'            => 'azp_icon',
                'show_in_admin'         => true,
                'label'                 => __('Icon Selector','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text', 
                'param_name'            => 'max',
                'show_in_admin'         => true,
                'label'                 => __('Quantity Max','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '30'
            ),
            array(
                'type'                  => 'text', 
                'param_name'            => 'min',
                'show_in_admin'         => true,
                'label'                 => __('Quantity Min','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '1'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_filter_price'] = array(
        'name'                  => __('Price Range','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Filter",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text', 
                'param_name'            => 'title',
                'show_in_admin'         => true,
                'label'                 => __('Title','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Price Range'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'rmin',
                'label'                 => __('Min value','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '0'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'rmax',
                'label'                 => __('Max value','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '200'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'rstep',
                'label'                 => __('Step change','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '10'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'rfrom',
                'label'                 => __('Initial from  value','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '10'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'rto',
                'label'                 => __('Initial to  value','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '100'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );
    $new_elements['azp_filter_button'] = array(
        'name'                  => __('Filter Button','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Filter",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'bt_name',
                'show_in_admin'         => true,
                'label'                 => __('Button Name','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Search'
            ),
            array(
                'type'                  => 'icon',
                'param_name'            => 'bt_icon',
                'show_in_admin'         => true,
                'label'                 => __('Icon Selector','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'filter_dis',
                'show_in_admin'         => true,
                'label'                 => __('Select where to display','easybook-add-ons'),
                // 'desc'                  => 'Select how to sort retrieved posts.',
                'default'               => 'listing',
                'value'                 => array(   
                    'listing'          => __('Filter Listing', 'easybook-add-ons'), 
                    'header'            => __('Filter Header', 'easybook-add-ons'), 
                    'hero'        => __('Filter Hero Section', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );
    $new_elements['azp_filterbt_option'] = array(
        'name'                  => __('Button Filter More Option','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Filter",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'bt_name',
                'show_in_admin'         => true,
                'label'                 => __('Button Name','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'More Option'
            ),
            array(
                'type'                  => 'icon',
                'param_name'            => 'bt_icon',
                'show_in_admin'         => true,
                'label'                 => __('Icon Selector','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );
    $new_elements['azp_filter_rating'] = array(
        'name'                  => __('Filter Rating','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Filter",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text', 
                'param_name'            => 'title',
                'show_in_admin'         => true,
                'label'                 => __('Title','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Star Rating'
            ),
            array(
                'type'                  => 'repeater',
                'param_name'            => 'filed_rate',
                'show_in_admin'         => true,
                'label'                 => __('Repeater Field','easybook-add-ons'),
                'desc'                  => '',
                'title_field'           => 'rp_text',
                'fields'                => array(
                    array(
                        'type'                  => 'text',
                        'param_name'            => 'star',
                        'show_in_admin'         => true,
                        'label'                 => __('Stars Value','easybook-add-ons'),
                        'desc'                  => '',
                        'default'               => '5'
                    ),
                    array(
                        'type'                  => 'text',
                        'param_name'            => 'label',
                        'show_in_admin'         => true,
                        'label'                 => __('Label','easybook-add-ons'),
                        'desc'                  => '',
                        'default'               => '5 STARS'
                    ),
                ),
                'default'               => array(
                    // array('rp_text'=>'rp_text','rp_textarea'=>'rp_textarea') -> Objects are not valid as a React child (found: object with keys {rp_text, rp_textarea}).
                )
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );
    $new_elements['azp_filter_fact'] = array(
        'name'                  => __('Filter Facilities','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Filter",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text', 
                'param_name'            => 'title',
                'show_in_admin'         => true,
                'label'                 => __('Title','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Facilities'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );

    // $new_elements['azp_preview_image'] = array(
    //     'name'                  => __('Backgroud Image','easybook-add-ons'),
    //     // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
    //     'category'              => __("Preview Card",'easybook-add-ons'),
    //     'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
    //     'open_settings_on_create'=>true,
    //     'showStyleTab'=> true,
    //     'showTypographyTab'=> true,
    //     'showAnimationTab'=> true,
    //     'attrs' => array (
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'el_id',
    //             'label'                 => __('Element ID','easybook-add-ons'),
    //             'desc'                  => '',
    //             'default'               => ''
    //         ),
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'el_class',
    //             'label'                 => __('Extra Class','easybook-add-ons'),
    //             'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
    //             'default'               => ''
    //         ), 
    //     )
    // );
    // $new_elements['azp_preview_avatar'] = array(
    //     'name'                  => __('Author Info','easybook-add-ons'),
    //     // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
    //     'category'              => __("Preview Card",'easybook-add-ons'),
    //     'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
    //     'open_settings_on_create'=>true,
    //     'showStyleTab'=> true,
    //     'showTypographyTab'=> true,
    //     'showAnimationTab'=> true,
    //     'attrs' => array (
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'el_id',
    //             'label'                 => __('Element ID','easybook-add-ons'),
    //             'desc'                  => '',
    //             'default'               => ''
    //         ),
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'el_class',
    //             'label'                 => __('Extra Class','easybook-add-ons'),
    //             'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
    //             'default'               => ''
    //         ), 
    //     )
    // );
    // $new_elements['azp_preview_sale'] = array(
    //     'name'                  => __('Price Sale','easybook-add-ons'),
    //     // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
    //     'category'              => __("Preview Card",'easybook-add-ons'),
    //     'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
    //     'open_settings_on_create'=>true,
    //     'showStyleTab'=> true,
    //     'showTypographyTab'=> true,
    //     'showAnimationTab'=> true,
    //     'attrs' => array (
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'el_id',
    //             'label'                 => __('Element ID','easybook-add-ons'),
    //             'desc'                  => '',
    //             'default'               => ''
    //         ),
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'el_class',
    //             'label'                 => __('Extra Class','easybook-add-ons'),
    //             'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
    //             'default'               => ''
    //         ), 
    //     )
    // );
    // $new_elements['azp_preview_rating'] = array(
    //     'name'                  => __('Rating','easybook-add-ons'),
    //     // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
    //     'category'              => __("Preview Card",'easybook-add-ons'),
    //     'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
    //     'open_settings_on_create'=>true,
    //     'showStyleTab'=> true,
    //     'showTypographyTab'=> true,
    //     'showAnimationTab'=> true,
    //     'attrs' => array (
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'el_id',
    //             'label'                 => __('Element ID','easybook-add-ons'),
    //             'desc'                  => '',
    //             'default'               => ''
    //         ),
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'el_class',
    //             'label'                 => __('Extra Class','easybook-add-ons'),
    //             'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
    //             'default'               => ''
    //         ), 
    //     )
    // );
    // $new_elements['azp_preview_title'] = array(
    //     'name'                  => __('Section Title','easybook-add-ons'),
    //     // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
    //     'category'              => __("Preview Card",'easybook-add-ons'),
    //     'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
    //     'open_settings_on_create'=>true,
    //     'showStyleTab'=> true,
    //     'showTypographyTab'=> true,
    //     'showAnimationTab'=> true,
    //     'attrs' => array (
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'el_id',
    //             'label'                 => __('Element ID','easybook-add-ons'),
    //             'desc'                  => '',
    //             'default'               => ''
    //         ),
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'el_class',
    //             'label'                 => __('Extra Class','easybook-add-ons'),
    //             'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
    //             'default'               => ''
    //         ), 
    //     )
    // );
    // $new_elements['azp_preview_address'] = array(
    //     'name'                  => __('Address','easybook-add-ons'),
    //     // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
    //     'category'              => __("Preview Card",'easybook-add-ons'),
    //     'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
    //     'open_settings_on_create'=>true,
    //     'showStyleTab'=> true,
    //     'showTypographyTab'=> true,
    //     'showAnimationTab'=> true,
    //     'attrs' => array (
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'el_id',
    //             'label'                 => __('Element ID','easybook-add-ons'),
    //             'desc'                  => '',
    //             'default'               => ''
    //         ),
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'el_class',
    //             'label'                 => __('Extra Class','easybook-add-ons'),
    //             'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
    //             'default'               => ''
    //         ), 
    //     )
    // );
    // $new_elements['azp_preview_content'] = array(
    //     'name'                  => __('Content','easybook-add-ons'),
    //     // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
    //     'category'              => __("Preview Card",'easybook-add-ons'),
    //     'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
    //     'open_settings_on_create'=>true,
    //     'showStyleTab'=> true,
    //     'showTypographyTab'=> true,
    //     'showAnimationTab'=> true,
    //     'attrs' => array (
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'el_id',
    //             'label'                 => __('Element ID','easybook-add-ons'),
    //             'desc'                  => '',
    //             'default'               => ''
    //         ),
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'el_class',
    //             'label'                 => __('Extra Class','easybook-add-ons'),
    //             'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
    //             'default'               => ''
    //         ), 
    //     )
    // );
    // $new_elements['azp_preview_fact'] = array(
    //     'name'                  => __('Facilities','easybook-add-ons'),
    //     // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
    //     'category'              => __("Preview Card",'easybook-add-ons'),
    //     'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
    //     'open_settings_on_create'=>true,
    //     'showStyleTab'=> true,
    //     'showTypographyTab'=> true,
    //     'showAnimationTab'=> true,
    //     'attrs' => array (
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'el_id',
    //             'label'                 => __('Element ID','easybook-add-ons'),
    //             'desc'                  => '',
    //             'default'               => ''
    //         ),
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'el_class',
    //             'label'                 => __('Extra Class','easybook-add-ons'),
    //             'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
    //             'default'               => ''
    //         ), 
    //     )
    // );
    // $new_elements['azp_preview_price'] = array(
    //     'name'                  => __('Average Price','easybook-add-ons'),
    //     // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
    //     'category'              => __("Preview Card",'easybook-add-ons'),
    //     'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
    //     'open_settings_on_create'=>true,
    //     'showStyleTab'=> true,
    //     'showTypographyTab'=> true,
    //     'showAnimationTab'=> true,
    //     'attrs' => array (
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'el_id',
    //             'label'                 => __('Element ID','easybook-add-ons'),
    //             'desc'                  => '',
    //             'default'               => ''
    //         ),
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'el_class',
    //             'label'                 => __('Extra Class','easybook-add-ons'),
    //             'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
    //             'default'               => ''
    //         ), 
    //     )
    // );
    // $new_elements['azp_preview_opt'] = array(
    //     'name'                  => __('Option List','easybook-add-ons'),
    //     // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
    //     'category'              => __("Preview Card",'easybook-add-ons'),
    //     'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
    //     'open_settings_on_create'=>true,
    //     'showStyleTab'=> true,
    //     'showTypographyTab'=> true,
    //     'showAnimationTab'=> true,
    //     'attrs' => array (
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'el_id',
    //             'label'                 => __('Element ID','easybook-add-ons'),
    //             'desc'                  => '',
    //             'default'               => ''
    //         ),
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'el_class',
    //             'label'                 => __('Extra Class','easybook-add-ons'),
    //             'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
    //             'default'               => ''
    //         ), 
    //     )
    // );
    $new_elements['azp_sbook_room'] = array(
        'name'                  => __('Room Type','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Form Booking",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text', 
                'param_name'            => 'title',
                'show_in_admin'         => true,
                'label'                 => __('Title','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Room Type'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );
    $new_elements['azp_sbook_date'] = array(
        'name'                  => __('Booking Date','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Form Booking",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text', 
                'param_name'            => 'title',
                'show_in_admin'         => true,
                'label'                 => __('Title','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'When'
            ),
            array(
                'type'                  => 'icon',
                'param_name'            => 'azp_icon',
                'show_in_admin'         => true,
                'label'                 => __('Icon Selector','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );
    $new_elements['azp_sbook_adults'] = array(
        'name'                  => __('Adults','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Form Booking",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text', 
                'param_name'            => 'title',
                'show_in_admin'         => true,
                'label'                 => __('Title','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Adults'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );
    $new_elements['azp_sbook_children'] = array(
        'name'                  => __('Children','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Form Booking",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text', 
                'param_name'            => 'title',
                'show_in_admin'         => true,
                'label'                 => __('Title','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Children'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );
    $new_elements['azp_sbook_button'] = array(
        'name'                  => __('Booking Button','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Form Booking",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text', 
                'param_name'            => 'title',
                'show_in_admin'         => true,
                'label'                 => __('Title','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'BOOK NOW'
            ),
            array(
                'type'                  => 'icon',
                'param_name'            => 'azp_icon',
                'show_in_admin'         => true,
                'label'                 => __('Icon Selector','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );
    //========
    $new_elements['azp_proom_gallery'] = array(
        'name'                  => __('Gallery','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Preview Room",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'icon',
                'param_name'            => 'azp_icon',
                'show_in_admin'         => true,
                'label'                 => __('Icon Selector','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_proom_features'] = array(
        'name'                  => __('Features','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Preview Room",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'num_feature',
                'label'                 => __('Number of Features to show','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '5'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_proom_title'] = array(
        'name'                  => __('Title','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Preview Room",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_proom_content'] = array(
        'name'                  => __('Content','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Preview Room",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'title',
                'show_in_admin'         => true,
                'label'                 => __('Title','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Details'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_proom_price'] = array(
        'name'                  => __('Price','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Preview Room",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'cur_syb',
                'show_in_admin'         => true,
                'label'                 => __('Currency symbol','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '$'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
      $new_elements['azp_proom_guests'] = array(
        'name'                  => __('Guests','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Preview Room",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $new_elements['azp_proom_button'] = array(
        'name'                  => __('Room Button Details','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Preview Room",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'bt_name',
                'show_in_admin'         => true,
                'label'                 => __('Button Name','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Details'
            ),
            array(
                'type'                  => 'icon',
                'param_name'            => 'bt_icon',
                'show_in_admin'         => true,
                'label'                 => __('Icon Selector','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            // array(
            //     'type'                  => 'text',
            //     'param_name'            => 'bt_url',
            //     'show_in_admin'         => true,
            //     'label'                 => __('Link Button','easybook-add-ons'),
            //     'desc'                  => '',
            //     'default'               => '#'
            // ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );
    $new_elements['azp_proom_addcart'] = array(
        'name'                  => __('Add To Cart','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Preview Room",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );

     $new_elements['azp_ptmpl_image'] = array(
        'name'                  => __('Backgroud Image','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Preview Template",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );
    $new_elements['azp_ptmpl_avatar'] = array(
        'name'                  => __('Author Info','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Preview Template",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );
    $new_elements['azp_ptmpl_sale'] = array(
        'name'                  => __('Price Sale','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Preview Template",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );
    $new_elements['azp_ptmpl_rating'] = array(
        'name'                  => __('Rating','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Preview Template",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );
    $new_elements['azp_ptmpl_title'] = array(
        'name'                  => __('Listing Title','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Preview Template",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );
    $new_elements['azp_ptmpl_address'] = array(
        'name'                  => __('Address','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Preview Template",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );
    $new_elements['azp_ptmpl_content'] = array(
        'name'                  => __('Content','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Preview Template",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );
    $new_elements['azp_ptmpl_fact'] = array(
        'name'                  => __('Facilities','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Preview Template",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );
    $new_elements['azp_ptmpl_price'] = array(
        'name'                  => __('Average Price','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Preview Template",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );
    $new_elements['azp_ptmpl_opt'] = array(
        'name'                  => __('Option List','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Preview Template",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );

    $new_elements['azp_ptmpl_event_status'] = array(
        'name'                  => __('Event Status (NEW)','easybook-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','easybook-add-ons'),
        'category'              => __("Preview Template",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Element ID','easybook-add-ons'),
                // 'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ), 
        )
    );



    
 
    return $new_elements;
}
