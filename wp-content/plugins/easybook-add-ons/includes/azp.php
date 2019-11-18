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



function easybook_addons_azp_elements(){ 
	$elements = array();


    $elements['azp_row'] = array(
        'name'                  => __('Row','easybook-add-ons'), 
        'category'              => __("structure",'easybook-add-ons'), 
        'desc'                  => __('Create Row/Column layout grid','easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/row.png',

        'hasownchild'=>'yes',
        'childtypename'=>'AzuraColumn',
        'childname'=>'Column',
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            
            array(
                'type'                  => 'text',
                'param_name'            => 'section_title',
                'label'                 => __('Section Title','easybook-add-ons'), 
                'desc'                  => '',
                'default'               => '',
                
            ),
            array(
                'type'                  => 'textarea',
                'param_name'            => 'content',
                'label'                 => __('Section Introtext (Can be use with html tags.)','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '',
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'title_align',
                'label'                 => __('Section Title Alignment','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'setleft',
                'value'                 => array(   
                    'setleft'                       => __('Left', 'easybook-add-ons'),
                    'setcenter'                     => __('Center', 'easybook-add-ons'),
                    'setright'                      => __('Right', 'easybook-add-ons'),                                                                              
                ),
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'fullwidth',
                'label'                 => __('Content width','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '0',
                'value'                 => array(   
                    '1'                     => __('Fluid width', 'easybook-add-ons'),
                    '0'                     => __('Fixed width', 'easybook-add-ons'),                                                                             
                ),
            ),

            array(
                'type'                  => 'select',
                'param_name'            => 'sec_width',
                'label'                 => __('Section Width','easybook-add-ons'),
                'desc'                  => __("Use Default for template content width" ,'easybook-add-ons'),
                'default'               => 'default',
                'value'                 => array(   
                    'default'                       => __('Default', 'easybook-add-ons'),
                    'fullscreen'                        => __('Fullscreen width', 'easybook-add-ons'),                                                                           
                ),
            ),

            array(
                'type'                  => 'switch',
                'param_name'            => 'is_fullheight',
                'label'                 => __('Is Fullscreen height','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '0',
                'value'                 => array(   
                    '1'                     => __('Yes', 'easybook-add-ons'),
                    '0'                     => __('No', 'easybook-add-ons'),                                                                              
                ),
            ),

            array(
                'type'                  => 'switch',
                'param_name'            => 'equal_height',
                'label'                 => __('Equal height','easybook-add-ons'),
                'desc'                  => __("Set this option to Yes if you want to set columns equal height." ,'easybook-add-ons'),
                'default'               => '0',
                'value'                 => array(   
                    '1'                     => __('Yes', 'easybook-add-ons'),
                    '0'                     => __('No', 'easybook-add-ons'),                                                                             
                ),
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'equal_height',
                'label'                 => __('Equal height','easybook-add-ons'),
                'desc'                  => __("Set this option to Yes if you want to set columns equal height." ,'easybook-add-ons'),
                'default'               => '0',
                'value'                 => array(   
                    '1'                     => __('Yes', 'easybook-add-ons'),
                    '0'                     => __('No', 'easybook-add-ons'),                                                                             
                ),
            ),

            array(
                'type'                  => 'switch',
                'param_name'            => 'use_parallax',
                'label'                 => __('Use Parallax','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '0',
                'value'                 => array(   
                    '1'                     => __('Yes', 'easybook-add-ons'),
                    '0'                     => __('No', 'easybook-add-ons'),                                                                               
                ),
            ),

            array(
                'type'                  => 'image',
                'param_name'            => 'parallax_image',
                'label'                 => __('Parallax Image','easybook-add-ons'),
                'desc'                  => __("If no image is selected, parallax will use background image from Style tab.", 'easybook-add-ons'),
                'default'               =>'',
                "depends_on"         => array(   
                    'element'   => 'use_parallax',  
                    'value'                 => array('1'),                                                                                
                    'has_value' => false,                                                                                
                ),
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'parallax_value',
                'label'                 => __('Parallax Value','easybook-add-ons'),
                'desc'                  => __("Pixel number. Which we are telling the browser is to move Parallax Image down every time we scroll down 100% of the viewport height and move Parallax Image up every time we scroll up 100% of the viewport height. Ex: 300 or -300 for reverse direction." ,'easybook-add-ons'),
                'default'               => '300',
                'rgba'          => true,
                "depends_on"         => array(   
                    'element'   => 'use_parallax',  
                    'value'                 => array('1'),                                                                                
                    'has_value' => false,                                                                                
                ),
            ),

            array(
                'type'                  => 'color',
                'param_name'            => 'overlay_color',
                'label'                 => __('Overlay Color','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '',
                'rgba'          => true,
                "depends_on"         => array(   
                    'element'   => 'use_parallax',  
                    'value'                 => array('1'),                                                                                
                    'has_value' => false,                                                                                
                ),
            ),
            
            array(
                'type'                  => 'select',
                'param_name'            => 'column_gap',
                'label'                 => __('Columns gap','easybook-add-ons'),
                'desc'                  => __("Gap between columns." ,'easybook-add-ons'),
                'default'               => '0',
                'value'                 => array(   
                    '0'                     => __('0px', 'easybook-add-ons'),
                    '1'                     => __('1px', 'easybook-add-ons'),
                    '2'                     => __('2px', 'easybook-add-ons'),
                    '3'                     => __('3px', 'easybook-add-ons'),
                    '4'                     => __('4px', 'easybook-add-ons'),
                    '5'                     => __('5px', 'easybook-add-ons'),
                    '10'                        => __('10px', 'easybook-add-ons'),
                    '15'                        => __('15px', 'easybook-add-ons'),
                    '20'                        => __('20px', 'easybook-add-ons'),
                    '25'                        => __('25px', 'easybook-add-ons'),
                    '30'                        => __('30px', 'easybook-add-ons'),
                    '35'                        => __('35px', 'easybook-add-ons'),
                    '40'                        => __('40px', 'easybook-add-ons'),
                    '45'                        => __('45px', 'easybook-add-ons'),
                    '50'                        => __('50px', 'easybook-add-ons'),                                                                           
                ),
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Section ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '',
                
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => '',
            ),

            array(
                'type'                  => 'colslayout', // this type for row element only
                'param_name'            => 'cols_layout',
                'label'                 => __('Columns Layout','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '100',
                'value'                 => array(   
                    '100'                     => __('100', 'easybook-add-ons'),
                    '50,50'                   => __('50-50', 'easybook-add-ons'),
                    '33,66'                   => __('33-66', 'easybook-add-ons'),
                    '66,33'                   => __('66-33', 'easybook-add-ons'),                                                                       
                    '33,33,33'                => __('33-33-33', 'easybook-add-ons'),                                                                       
                    '25,25,25,25'             => __('25-25-25-25', 'easybook-add-ons'),                                                                       
                    '20,20,20,20,20'          => __('20-20-20-20-20', 'easybook-add-ons'),                                                                       
                ),
            ),

        )
    );

    $elements['azp_rowinner'] = array(
        'name'                  => __('Row Inner','easybook-add-ons'),
        'desc'                  => __('Create Row/Column layout grid in parent column element','easybook-add-ons'),
        'category'              => __("structure",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/row.png',
        'hasownchild'=>'yes',
        'childtypename'=>'AzuraColumnInner',
        'childname'=>'Column Inner',
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            array(
                'type'                  => 'select',
                'param_name'            => 'column_gap',
                'label'                 => __('Columns gap','easybook-add-ons'),
                'desc'                  => __("Gap between columns." ,'easybook-add-ons'),
                'default'               => '0',
                'value'                 => array(   
                    '0'                     => __('0px', 'easybook-add-ons'),
                    '1'                     => __('1px', 'easybook-add-ons'),
                    '2'                     => __('2px', 'easybook-add-ons'),
                    '3'                     => __('3px', 'easybook-add-ons'),
                    '4'                     => __('4px', 'easybook-add-ons'),
                    '5'                     => __('5px', 'easybook-add-ons'),
                    '10'                        => __('10px', 'easybook-add-ons'),
                    '15'                        => __('15px', 'easybook-add-ons'),
                    '20'                        => __('20px', 'easybook-add-ons'),
                    '25'                        => __('25px', 'easybook-add-ons'),
                    '30'                        => __('30px', 'easybook-add-ons'),
                    '35'                        => __('35px', 'easybook-add-ons'),
                    '40'                        => __('40px', 'easybook-add-ons'),
                    '45'                        => __('45px', 'easybook-add-ons'),
                    '50'                        => __('50px', 'easybook-add-ons'),                                                                             
                ),
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'equal_height',
                'label'                 => __('Equal height','easybook-add-ons'),
                'desc'                  => __("Set this option to Yes if you want to set columns equal height." ,'easybook-add-ons'),
                'default'               => '0',
                'value'                 => array(   
                    '1'                     => __('Yes', 'easybook-add-ons'),
                    '0'                     => __('No', 'easybook-add-ons'),                                                                             
                ),
            ),
            
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('Row ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '',
                
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => '',
            ),

            array(
                'type'                  => 'colslayout', // this type for row element only
                'param_name'            => 'cols_layout',
                'label'                 => __('Columns Layout','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '100',
                'value'                 => array(   
                    '100'                     => __('100', 'easybook-add-ons'),
                    '50,50'                   => __('50-50', 'easybook-add-ons'),
                    '33,66'                   => __('33-66', 'easybook-add-ons'),
                    '66,33'                   => __('66-33', 'easybook-add-ons'),                                                                       
                    '33,33,33'                => __('33-33-33', 'easybook-add-ons'),                                                                       
                    '25,25,25,25'             => __('25-25-25-25', 'easybook-add-ons'),                                                                       
                    '20,20,20,20,20'          => __('20-20-20-20-20', 'easybook-add-ons'),                                                                       
                ),
            ),
            
        )
    );

	$elements['azp_column'] = array(
        'name'                          =>__( 'Column', 'easybook-add-ons' ),
        'category'                      => __("forrow",'easybook-add-ons'),
        'icon'                          => ESB_DIR_URL .'assets/azp-eles-icon/row.png',
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        // 'showResponsiveTab'=> true,
        'attrs' => array (

            array(
                'type'                  =>'width',
                'param_name'            =>'azp_rwid',
                'label'                 =>__( 'Column Width (%)', 'easybook-add-ons' ),
                'desc'                  => "",
                'default'               => ''
            ),

            // array(
            //     'type'                  =>'checkbox',
            //     'param_name'            =>'test_checkbox',
            //     'label'                 =>__( 'Test Checkbox', 'easybook-add-ons' ),
            //     'desc'                  => "" ,
            //     'value'                  => 'yes' ,
            //     'unchecked'                  => 'no' ,
            //     'default'               => 'yes'
            // ),

            // array(
            //     'type'                  =>'radio',
            //     'param_name'            =>'test_radio',
            //     'label'                 =>__( 'Test Radio', 'easybook-add-ons' ),
            //     'value'                  => array(
            //         'no'                    => __( 'No', 'easybook-add-ons' ),
            //         'yes'                    => __( 'Yes', 'easybook-add-ons' ),
            //         'test'                    => __( 'Test', 'easybook-add-ons' ),
            //     ),
            //     'desc'                  => "" ,
            //     'default'               => 'yes'
            // ),

            array(
                'type'					=>'text',
                'param_name'			=>'el_id',
                'label'					=>__( 'ID', 'easybook-add-ons' ),
                'desc' 					=> "" ,
                'default'				=>''
            ),
            
            array(
                'type'					=>'text',
                'param_name'			=>'el_class',
                'label'					=> __( 'Extra Class', 'easybook-add-ons' ),
                'desc' 					=> __( 'Use this field to add a class name and then refer to it in your CSS.', 'easybook-add-ons' ) ,
                'default' 				=>''
            ),
            
        )
    );

    $elements['azp_columninner'] = array(
        'name'                  => __('Column Inner','easybook-add-ons'),
        'category'              => __("forrowinner",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/row.png',
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        // 'showResponsiveTab'=> true,
        'attrs' => array (
            array(
                'type'                  =>'width',
                'param_name'            =>'azp_rwid',
                'label'                 =>__( 'Column Width (%)', 'easybook-add-ons' ),
                'desc'                  => "",
                'default'               => ''
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'label'                 => __('ID','easybook-add-ons'),
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

    $elements['azp_container'] = array(
        'name'                  => __('Container','easybook-add-ons'),
        'desc'                  => __('Create wrapper in parent column element','easybook-add-ons'),
        'category'              => __("structure",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/container.png',
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
            array(
                'type'                  => 'select',
                'param_name'            => 'wraptag',
                'label'                 => __('Wrapper Tag','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'div',
                'value'                 => array(
                    'div'                       => __('div', 'easybook-add-ons'),
                    'section'                       => __('section', 'easybook-add-ons'),
                    'article'                       => __('article', 'easybook-add-ons'),
                    'aside'                     => __('aside', 'easybook-add-ons'),
                    'ul'                        => __('ul', 'easybook-add-ons'),
                )
            ),
            
        )
    );

    $elements['azp_text'] = array(
        'name'                  => __('Text Block','easybook-add-ons'),
        'desc'                  => __('A block of text with WYSIWYG editor','easybook-add-ons'),
        'category'              => __("content",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/text-block.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=> true,
        'showTypographyTab'=> true,
        'showAnimationTab'=> true,
        'attrs' => array (
            // array(
            //     'type'                  => 'icon',
            //     'param_name'            => 'el_icon',
            //     'show_in_admin'         => true,
            //     'label'                 => __('Icon Selector','easybook-add-ons'),
            //     'desc'                  => '',
            //     'default'               => ''
            // ),

            // array(
            //     'type'                  => 'repeater',
            //     'param_name'            => 'el_repeater',
            //     'show_in_admin'         => true,
            //     'label'                 => __('Repeater Field','easybook-add-ons'),
            //     'desc'                  => '',
            //     'title_field'           => 'rp_text',
            //     'fields'                => array(
            //         array(
            //             'type'                  => 'text',
            //             'param_name'            => 'rp_text',
            //             'show_in_admin'         => true,
            //             'label'                 => __('Repeater Field Text','easybook-add-ons'),
            //             'desc'                  => '',
            //             'default'               => ''
            //         ),
            //         array(
            //             'type'                  => 'textarea',
            //             'param_name'            => 'rp_textarea',
            //             'show_in_admin'         => true,
            //             'label'                 => __('Repeater Field Textarea','easybook-add-ons'),
            //             'desc'                  => '',
            //             'default'               => ''
            //         ),
            //         array(
            //             'type'                  => 'image',
            //             'param_name'            => 'rp_img',
            //             'show_in_admin'         => true,
            //             'label'                 => __('Repeater Field Image','easybook-add-ons'),
            //             'desc'                  => '',
            //             'default'               => ''
            //         ),
            //     ),
            //     'default'               => array(
            //         // array('rp_text'=>'rp_text','rp_textarea'=>'rp_textarea') -> Objects are not valid as a React child (found: object with keys {rp_text, rp_textarea}).
            //     )
            // ),

            array(
                'type'                  => 'editor',
                
                'param_name'            => 'content',
                'label'                 => __('Content','easybook-add-ons'),
                'show_in_admin'         => true,
                'desc'                  => __("Text Content (Can be used with HTML tags)" ,'easybook-add-ons'),
                'default'               => '<h3>Back End Page Builder</h3><p>Build a responsive website and manage your content easily with super fast back-end builder. No programming knowledge required – create stunning and beautiful pages with drag and drop builder.</p>',
                'iscontent'             =>'yes'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'show_in_admin'         => true,
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'show_in_admin'         => true,
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );

    $elements['azp_image'] = array(
        'name'                  => __('Single Image','easybook-add-ons'),
        'desc'                  => __('','easybook-add-ons'),
        'category'              => __("content",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/image.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=>true,
        'showAnimationTab'=>true,
        'attrs' => array (
            array(
                'type'                  => 'images',
                'param_name'            => 'image_url',
                'label'                 => __('Image Source','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '',
                'show_in_admin'         => true,
            ),
            // array(
            //     'type'                  => 'text',
            //     'param_name'            => 'alttext',
            //     'label'                 => __('Alt Text','easybook-add-ons'),
            //     'desc'                  => '',
            //     'default'               => '',
            // ),
            array(
                'type'                  => 'select',
                'param_name'            => 'image_style',
                'label'                 => __("Image Style",'easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'default',
                'value'                 => array(
                    'default'                       => __('Default', 'easybook-add-ons'),
                    'circle'                        => __('Circle', 'easybook-add-ons'),
                    'thumbnail'                     => __('Thumbnail', 'easybook-add-ons'),
                    // 'withcontent'                        => __('Thumbnail with content', 'default'),
                )
                
            ),
            // array(
            //     'type'                  => 'select',
            //     'param_name'            => 'click_action',
            //     'label'                 => __("Click action",'easybook-add-ons'),
            //     'desc'                  => __("Select action for user click." ,'easybook-add-ons'),
            //     'default'               => 'none',
            //     'value'                 => array(
            //         'none'                      => __('None', 'easybook-add-ons'),
            //         'lightbox'                      => __('Open popup', 'easybook-add-ons'),
            //         'modal'                     => __('Open modal', 'easybook-add-ons'),
            //         'link'                      => __('Open link', 'easybook-add-ons'),
            //     )
                
            // ),
            // array(
            //     'type'                  => 'text',
            //     'param_name'            => 'modal_id',
            //     'label'                 => __('Modal ID','easybook-add-ons'),
            //     'desc'                  => __("Enter your modal ID here to open it." ,'easybook-add-ons'),
            //     'default'               => '',
            //     'depends_on' => array(
            //         'element' => 'click_action',
            //         'value'                 => array('modal'),
            //         'has_value' => false,
            //     ),
            // ),
            // array(
            //     'type'                  => 'image',
            //     'param_name'            => 'large_image',
            //     'label'                 => __('Popup image or video','easybook-add-ons'),
            //     'desc'                  => __("Large Image or Youtube, Vimeo, Soundcloud link for light box. Leave empty to use default." ,'easybook-add-ons'),
            //     'default'               => '',
            //     'depends_on'=> array(
            //         'element'=> 'click_action',
            //         'value'                 => array('lightbox'),
            //         'has_value' => false,
            //     ),
            // ),
            array(
                'type'                  => 'text',
                'param_name'            => 'video_link',
                'label'                 => __('Video url','easybook-add-ons'),
                'desc'                  => 'EX:https://www.youtube.com/watch?v=d9Q3vKl40Y8',
                'default'               => '',
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'name_video_link',
                'label'                 => __('Describes the video path.','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Promo Video',
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'image_link',
                'label'                 => __('Image Link','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '#',
                'depends_on'=> array(
                    'element'=> 'click_action',
                    'value'                 => array('link'),
                    'has_value' => false,
                ),
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'link_target',
                'label'                 => __("Open link in",'easybook-add-ons'),
                'desc'                  => '',
                'default'               => '_blank',
                'value'                 => array(
                    '_blank'                        => __('New tab', 'easybook-add-ons'),
                    '_self'                     => __('Current tab', 'easybook-add-ons'),
                ),
                'depends_on'=> array(
                    'element'=> 'click_action',
                    'value'                 => array('link'),
                    'has_value' => false,
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
                'default'               => '',
                
            ),

            
        )
    );
    
    $elements['azp_accordion'] = array(
        'name'                  => __('Accordion','easybook-add-ons'),
        'desc'                  => __('','easybook-add-ons'),
        'category'              => __("content",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/accordion.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=>true,
        'showAnimationTab'=>true,
        'attrs' => array (
             array(
                'type'                  => 'repeater',
                'param_name'            => 'contents_order',
                'show_in_admin'         => true,
                'label'                 => __('Accordion Items','easybook-add-ons'),
                'desc'                  => '',
                'title_field'           => 'rp_text',
                'fields'                => array(
                    array(
                        'type'                  => 'text',
                        'param_name'            => 'title',
                        'show_in_admin'         => true,
                        'label'                 => __('Title','easybook-add-ons'),
                        'desc'                  => '',
                        'default'               => 'Accordion #1'
                    ),
                    array(
                        'type'                  => 'textarea',
                        'param_name'            => 'content',
                        'show_in_admin'         => true,
                        'label'                 => __('Content','easybook-add-ons'),
                        'desc'                  => '',
                        'default'               => 'I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.'
                    ),
                    // array(
                    //     'type'                  => 'icon',
                    //     'param_name'            => 'icon',
                    //     'show_in_admin'         => true,
                    //     'label'                 => __('Icon','easybook-add-ons'),
                    //     'desc'                  => '',
                    //     'default'               => ''
                    // ),
                    // array(
                    //     'type'                  => 'icon',
                    //     'param_name'            => 'active_icon',
                    //     'show_in_admin'         => true,
                    //     'label'                 => __('Active Icon','easybook-add-ons'),
                    //     'desc'                  => '',
                    //     'default'               => ''
                    // ),
                ),
                'default'               => array(
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
                'default'               => '',
                
            ),

            
        )
    );
    $elements['azp_gallery'] = array(
        'name'                  => __('Image Gallery','easybook-add-ons'),
        'desc'                  => __('','easybook-add-ons'),
        'category'              => __("content",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/gallery.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=>true,
        'showAnimationTab'=>true,
        'attrs' => array (
            array(
                'type'                  => 'images',
                'param_name'            => 'image_url',
                'label'                 => __('Image Source','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '',
                'show_in_admin'         => true,
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'image_size',
                 'show_in_admin'         => true,
                'label'                 => __("Image Size",'easybook-add-ons'),
                'desc'                  => __("" ,'easybook-add-ons'),
                'default'               => 'thumbnail',
                'value'=> array(
                    'thumbnail'                  => __('Thumbnail - 150 x 150', 'easybook-add-ons'),
                    'medium'                     => __('Medium - 300 x 300', 'easybook-add-ons'),
                    'medium_large'               => __('Medium Large - 768 x 0', 'easybook-add-ons'),
                    'large'                      => __('large', 'easybook-add-ons'),
                    'full'                       => __('Full', 'easybook-add-ons'),
                )
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'grid_cols',
                'show_in_admin'         => true,
                'label'                 => __("Columns",'easybook-add-ons'),
                'desc'                  => __("" ,'easybook-add-ons'),
                'default'               => 'three',
                'value'                 => array(
                    'one'                     => __('One Column', 'easybook-add-ons'),
                    'two'                     => __('Two Column', 'easybook-add-ons'),
                    'three'                     => __('Three Columns', 'easybook-add-ons'),
                    'four'                     => __('Four Columns', 'easybook-add-ons'),
                    'five'                     => __('Five Columns', 'easybook-add-ons'),
                    'six'                     => __('Six Columns', 'easybook-add-ons'),
                    'seven'                     => __('Seven Columns', 'easybook-add-ons'),
                    'eight'                     => __('Eight Columns', 'easybook-add-ons'),
                    'nine'                     => __('Nine Columns', 'easybook-add-ons'),
                    'ten'                     => __('Ten Columns', 'easybook-add-ons'),
                )
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'items_width',
                'label'                 => __('Items Width','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Defined location width. Available values are x1(default),x2(x2 width),x3(x3 width), and separated by comma. Ex: x1,x1,x2,x1,x1,x1'
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'space',
                'show_in_admin'         => true,
                'label'                 => __("Space",'easybook-add-ons'),
                'desc'                  => __("" ,'easybook-add-ons'),
                'default'               => 'big',
                'value'                 => array(
                    'big'                     => __('Big', 'easybook-add-ons'),
                    'medium'                     => __('Medium', 'easybook-add-ons'),
                    'small'                     => __('Small', 'easybook-add-ons'),
                    'extrasmall'                     => __('Extra small', 'easybook-add-ons'),
                    'no'                     => __('None', 'easybook-add-ons'),
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
                'default'               => '',
                
            ),

            
        )
    );

    $elements['azp_carousel'] = array(
        'name'                  => __('Image Carousel','easybook-add-ons'),
        'desc'                  => __('','easybook-add-ons'),
        'category'              => __("content",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/image-carousel.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=>true,
        'showAnimationTab'=>true,
        'attrs' => array (
            array(
                'type'                  => 'images',
                'param_name'            => 'image_url',
                'show_in_admin'         => true,
                'label'                 => __('Image Source','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '',
                'show_in_admin'         => true,
            ),
            array(
                'type'                  => 'textarea',
                'param_name'            => 'link',
                'label'                 => __('link','easybook-add-ons'),
                'desc'                  => 'Enter links for each (Note: divide links with | or linebreaks (Enter) and no spaces).',
                'default'               => '#|#|#|#|#|#'
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'target',
                'show_in_admin'         => true,
                'label'                 => __("Target",'easybook-add-ons'),
                'desc'                  => __("" ,'easybook-add-ons'),
                'default'               => '_blank',
                'value'=> array(
                    '_blank'                  => __('Opens Image link in new window', 'easybook-add-ons'),
                    '_self'                     => __('Opens Image link in the same window', 'easybook-add-ons'),
                )
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'thumbnail_size',
                 'show_in_admin'         => true,
                'label'                 => __("Image Size",'easybook-add-ons'),
                'desc'                  => __("" ,'easybook-add-ons'),
                'default'               => 'thumbnail',
                'value'=> array(
                    'thumbnail'                  => __('Thumbnail - 150 x 150', 'easybook-add-ons'),
                    'medium'                     => __('Medium - 300 x 300', 'easybook-add-ons'),
                    'medium_large'               => __('Medium Large - 768 x 0', 'easybook-add-ons'),
                    'large'                      => __('large', 'easybook-add-ons'),
                    'full'                       => __('Full', 'easybook-add-ons'),
                )
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'spacing',
                'show_in_admin'         => true,
                'label'                 => __("Spacing",'easybook-add-ons'),
                'desc'                  => __("" ,'easybook-add-ons'),
                'default'               => '10',
                'value'                 => array(
                    '0'                     => __('None', 'easybook-add-ons'),
                    '1'                     => __('1px', 'easybook-add-ons'),
                    '2'                     => __('2px', 'easybook-add-ons'),
                    '3'                     => __('3px', 'easybook-add-ons'),
                    '4'                     => __('4px', 'easybook-add-ons'),
                    '5'                     => __('5px', 'easybook-add-ons'),
                    '10'                     => __('10px', 'easybook-add-ons'),
                    '15'                     => __('15px', 'easybook-add-ons'),
                    '20'                     => __('20px', 'easybook-add-ons'),
                    '25'                     => __('25px', 'easybook-add-ons'),
                    '30'                     => __('30px', 'easybook-add-ons'),
                )
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'responsive',
                'label'                 => __('responsive','easybook-add-ons'),
                'desc'                  => 'The format is: screen-size:number-items-display,larger-screen-size:number-items-display. Ex: 320:2,768:2,992:4,1200:5',
                'default'               => '320:2,768:2,992:2,1200:3'
            ),
             array(
                'type'                  => 'text',
                'param_name'            => 'speed',
                'label'                 => __('Speed','easybook-add-ons'),
                'desc'                  => 'Duration of transition between slides (in ms). Default: 1300',
                'default'               => '1300'
            ),
            // array(
            //     'type'                  => 'switch',
            //     'param_name'            => 'show_title',
            //     'show_in_admin'         => true,
            //     'label'                 => __('Show Title/Caption','easybook-add-ons'),
            //     'desc'                  => '',
            //     'default'               => 'yes',
            //     'value'                 => array(   
            //         'yes'          => __('Show', 'easybook-add-ons'), 
            //         'no'            => __('Hidden', 'easybook-add-ons'), 
            //      ),
            // ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'autoplay',
                'show_in_admin'         => true,
                'label'                 => __('Auto Play','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'no',
                'value'                 => array(   
                    'yes'          => __('Yes', 'easybook-add-ons'), 
                    'no'            => __('No', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'loop',
                'show_in_admin'         => true,
                'label'                 => __('Loop','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'yes',
                'value'                 => array(   
                    'yes'          => __('Yes', 'easybook-add-ons'), 
                    'no'            => __('No', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'show_navigation',
                'show_in_admin'         => true,
                'label'                 => __('Show Navigation','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'yes',
                'value'                 => array(   
                    'yes'          => __('Yes', 'easybook-add-ons'), 
                    'no'            => __('No', 'easybook-add-ons'), 
                 ),
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'show_dots',
                'show_in_admin'         => true,
                'label'                 => __('Show Dots','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'yes',
                'value'                 => array(   
                    'yes'          => __('Yes', 'easybook-add-ons'), 
                    'no'            => __('No', 'easybook-add-ons'), 
                 ),
            ),
            //  array(
            //     'type'                  => 'select',
            //     'param_name'            => 'wow_type',
            //     'show_in_admin'         => true,
            //     'label'                 => __('Reveal Animations When You Scroll','easybook-add-ons'),
            //     'desc'                  => '',
            //     'default'               => 'yes',
            //     'value'                 => array(   
            //         ''                      => __('None', 'easybook-add-ons'), 
            //         'bounceIn'              => __('BounceIn', 'easybook-add-ons'), 
            //         'bounceInDown'          => __('BounceInDown', 'easybook-add-ons'), 
            //         'bounceInLeft'          => __('bounceInLeft', 'easybook-add-ons'),
            //         'bounceInRight'         => __('bounceInRight', 'easybook-add-ons'), 
            //         'fadeIn'                => __('fadeIn', 'easybook-add-ons'),
            //         'fadeInUp'              => __('fadeInUp', 'easybook-add-ons'), 
            //         'fadeInDown'            => __('fadeInDown', 'easybook-add-ons'),

            //      ),
            // ),
            // array(
            //     'type'                  => 'text',
            //     'param_name'            => 'ani_time',
            //     'label'                 => __('Animations time','easybook-add-ons'),
            //     'desc'                  => '',
            //     'default'               => '1.0'
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
                'default'               => '',
                
            ),  
        )
    );
    $elements['azp_button'] = array(
        'name'                  => __('Button','easybook-add-ons'),
        'desc'                  => __('','easybook-add-ons'),
        'category'              => __("content",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/button.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=>true,
        'showAnimationTab'=>true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'name',
                'show_in_admin'         => true,
                'label'                 => __('Text','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'Text on the button'
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'shape',
                'show_in_admin'         => true,
                'label'                 => __("Shape",'easybook-add-ons'),
                'desc'                  => __("" ,'easybook-add-ons'),
                'default'               => 'square',
                'value'                 => array(
                    'rounded'                     => __('rounded', 'easybook-add-ons'),
                    'square'                     => __('Square', 'easybook-add-ons'),
                )
            ),
            array(
                'type'                  => 'icon',
                'param_name'            => 'icon',
                'show_in_admin'         => true,
                'label'                 => __('Icon','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'color',
                'show_in_admin'         => true,
                'label'                 => __("Color",'easybook-add-ons'),
                'desc'                  => __("" ,'easybook-add-ons'),
                'default'               => 'default',
                'value'                 => array(
                    'default'                     => __('Color Theme', 'easybook-add-ons'),
                    'primary'                     => __('Classic Blue', 'easybook-add-ons'),
                    'success'                     => __('Classic Green', 'easybook-add-ons'),
                    'warning'                     => __('Classic Orange', 'easybook-add-ons'),
                    'white'                     => __('white', 'easybook-add-ons'),
                    // 'black'                     => __('Clack', 'easybook-add-ons'), 
                )
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'size',
                'show_in_admin'         => true,
                'label'                 => __("Size",'easybook-add-ons'),
                'desc'                  => __("" ,'easybook-add-ons'),
                'default'               => 'md',
                'value'                 => array(
                    'xs'                     => __('Mini', 'easybook-add-ons'),
                    'sm'                     => __('Small', 'easybook-add-ons'),
                    'md'                     => __('Normal', 'easybook-add-ons'),
                    'lg'                     => __('Large', 'easybook-add-ons'),
                    'xl'                     => __('Extra Large', 'easybook-add-ons'),
                )
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'align',
                 'show_in_admin'         => true,
                'label'                 => __("Icon alignment",'easybook-add-ons'),
                'desc'                  => __("" ,'easybook-add-ons'),
                'default'               => 'left',
                'value'                 => array(
                    'left'                     => __('Left', 'easybook-add-ons'),
                    'center'                     => __('Center', 'easybook-add-ons'),
                    'right'                     => __('Right', 'easybook-add-ons'),
                )
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'link',
                'show_in_admin'         => true,
                'label'                 => __('URL (Link)','easybook-add-ons'),
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
                'default'               => '',
                
            ),     
        )
    );
    $elements['azp_contact_form'] = array(
        'name'                  => __(' Contact Form 7','easybook-add-ons'),
        'desc'                  => __('','easybook-add-ons'),
        'category'              => __("content",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/contactform.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=>true,
        'showAnimationTab'=>true,
        'attrs' => array (
            array(
                'type'                  => 'select',
                'param_name'            => 'f_id',
                 'show_in_admin'         => true,
                'label'                 => __("Select a form",'easybook-add-ons'),
                'desc'                  => __("" ,'easybook-add-ons'),
                'default'               => '',
                'value'                 => easybook_addons_get_contact_form7_forms(),
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'f_title',
                 'show_in_admin'         => true,
                'label'                 => __('Form Title','easybook-add-ons'),
                'desc'                  => __('(Optional) Title to search if no ID selected or cannot find by ID.','easybook-add-ons'),
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
                'default'               => '',
                
            ),  
        )
    );
    $elements['raw_html'] = array(
        'name'                  => __('Raw HTML','easybook-add-ons'),
        'desc'                  => '',
        'category'              => __("content",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/raw-html.png',
        'open_settings_on_create'=>true,
        'showStyleTab'          => true,
        'showTypographyTab'     => false,
        'showAnimationTab'      => true,
        'attrs' => array (
            
            array(
                'type'                  => 'raw_html',
                'param_name'            => 'content',
                'label'                 => __('Content','easybook-add-ons'),
                'show_in_admin'         => false,
                'desc'                  => __("HTML/JS Code" ,'easybook-add-ons'),
                'default'               => '',
                'iscontent'             => 'yes'
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'el_id',
                'show_in_admin'         => true,
                'label'                 => __('Element ID','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            
            array(
                'type'                  => 'text',
                'param_name'            => 'el_class',
                'show_in_admin'         => true,
                'label'                 => __('Extra Class','easybook-add-ons'),
                'desc'                  => __("Use this field to add a class name and then refer to it in your CSS." ,'easybook-add-ons'),
                'default'               => ''
            ),
            
        )
    );
    $elements['azp_cus_field'] = array(
        'name'                  => __('Custom Field','easybook-add-ons'),
        'desc'                  => __('','easybook-add-ons'),
        'category'              => __("Listings Get Field",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/icon.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=>true,
        'showAnimationTab'=>true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'field_title',
                'show_in_admin'         => true,
                'label'                 => __('Listing Field Title','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'repeater',
                'param_name'            => 'cus_field',
                // 'show_in_admin'         => true,
                'label'                 => __('Custom Field','easybook-add-ons'),
                'desc'                  => '',
                'title_field'           => 'rp_text',
                'fields'                => array(
                    array(
                        'type'                  => 'text',
                        'param_name'            => 'f_title',
                        'label'                 => __('Field Title','easybook-add-ons'),
                        'desc'                  => '',
                        'default'               => ''
                    ),
                    array(
                        'type'                  => 'text',
                        'param_name'            => 'f_name',
                        'label'                 => __('Field Name','easybook-add-ons'),
                        'desc'                  => '',
                        'default'               => ''
                    ),
                    array(
                        'type'                  => 'text',
                        'param_name'            => 'f_class',
                        'show_in_admin'         => true,
                        'label'                 => __('Field Class','easybook-add-ons'),
                        'desc'                  => '',
                        'default'               => ''
                    ),
                    array(
                        'type'                  => 'select',
                        'param_name'            => 'f_type',
                        'show_in_admin'         => true,
                        'label'                 => __("Type",'easybook-add-ons'),
                        'desc'                  => __("" ,'easybook-add-ons'),
                        'default'               => 'default',
                        'value'                 => array(
                            'image'                     => __('Single image', 'easybook-add-ons'),
                            'default'                     => __('Default', 'easybook-add-ons'),
                            'list'                     => __('List', 'easybook-add-ons'),
                            'gallery'                     => __('Gallery', 'easybook-add-ons'),
                        )
                    ),
                    array(
                        'type'                  => 'select',
                        'param_name'            => 'f_wid',
                        'label'                 => __('Width','easybook-add-ons'),
                        'desc'                  => '',
                        'default'               => 'col-md-12',
                        'value'                 => array( 
                            ''                              => __('None', 'easybook-add-ons'),  
                            'cus-wid-1'                      => __('1 Column - 1/12', 'easybook-add-ons'),
                            'cus-wid-2'                      => __('2 Columns - 1/6', 'easybook-add-ons'),
                            'cus-wid-3'                      => __('3 Columns - 1/4', 'easybook-add-ons'),
                            'cus-wid-4'                      => __('4 Columns - 1/3', 'easybook-add-ons'),
                            'cus-wid-5'                      => __('5 Columns - 5/12', 'easybook-add-ons'),
                            'cus-wid-6'                      => __('6 Columns - 1/2', 'easybook-add-ons'),
                            'cus-wid-7'                      => __('7 Columns - 7/12', 'easybook-add-ons'),
                            'cus-wid-8'                      => __('8 Columns - 2/3', 'easybook-add-ons'),
                            'cus-wid-9'                      => __('9 Columns - 1/4', 'easybook-add-ons'),
                            'cus-wid-10'                     => __('10 Columns - 5/6', 'easybook-add-ons'),
                            'cus-wid-11'                     => __('11 Columns - 11/12', 'easybook-add-ons'),
                            'cus-wid-12'                     => __('12 Columns - 1/1', 'easybook-add-ons'),
                        ),
                    ),
                ),
                'default'               => urlencode(json_encode(array(
                    array(
                        'f_title'   =>  'Field Title',
                        'f_name'    =>  'Field Name',
                        'f_type'    =>  'default',
                        'f_class'   =>  'Field Class',
                        'f_wid'     =>  'cus-wid-1',
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
                'default'               => '',
                
            ),

            
        )
    );
    $elements['azp_cus_field_bk'] = array(
        'name'                  => __('Custom Field','easybook-add-ons'),
        'desc'                  => __('','easybook-add-ons'),
        'category'              => __("Customs Get Field",'easybook-add-ons'),
        'icon'                  => ESB_DIR_URL .'assets/azp-eles-icon/icon.png',
        'open_settings_on_create'=>true,
        'showStyleTab'=>true,
        'showAnimationTab'=>true,
        'attrs' => array (
            array(
                'type'                  => 'text',
                'param_name'            => 'f_title',
                'show_in_admin'         => true,
                'label'                 => __('Field Title','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'text',
                'param_name'            => 'f_name',
                'show_in_admin'         => true,
                'label'                 => __('Field Name','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            // array(
            //     'type'                  => 'text',
            //     'param_name'            => 'f_class',
            //     'show_in_admin'         => true,
            //     'label'                 => __('Field Class','easybook-add-ons'),
            //     'desc'                  => '',
            //     'default'               => ''
            // ),
            array(
                'type'                  => 'select',
                'param_name'            => 'f_type',
                'show_in_admin'         => true,
                'label'                 => __("Type",'easybook-add-ons'),
                'desc'                  => __("" ,'easybook-add-ons'),
                'default'               => 'input',
                'value'                 => array(
                    'input'                    => __('Input', 'easybook-add-ons'),
                    'textarea'                  => __('Textarea', 'easybook-add-ons'),
                    'select'                     => __('Select', 'easybook-add-ons'),
                    'checkbox'                  => __('Checkbox', 'easybook-add-ons'),
                )
            ),
            // array(
            //     'type'                  => 'select',
            //     'param_name'            => 'f_wid',
            //     'show_in_admin'         => true,
            //     'label'                 => __('Width','easybook-add-ons'),
            //     'desc'                  => '',
            //     'default'               => 'col-md-12',
            //     'value'                 => array( 
            //         ''                              => __('None', 'easybook-add-ons'),  
            //         'col-md-1'                      => __('1 Column - 1/12', 'easybook-add-ons'),
            //         'col-md-2'                      => __('2 Columns - 1/6', 'easybook-add-ons'),
            //         'col-md-3'                      => __('3 Columns - 1/4', 'easybook-add-ons'),
            //         'col-md-4'                      => __('4 Columns - 1/3', 'easybook-add-ons'),
            //         'col-md-5'                      => __('5 Columns - 5/12', 'easybook-add-ons'),
            //         'col-md-6'                      => __('6 Columns - 1/2', 'easybook-add-ons'),
            //         'col-md-7'                      => __('7 Columns - 7/12', 'easybook-add-ons'),
            //         'col-md-8'                      => __('8 Columns - 2/3', 'easybook-add-ons'),
            //         'col-md-9'                      => __('9 Columns - 1/4', 'easybook-add-ons'),
            //         'col-md-10'                     => __('10 Columns - 5/6', 'easybook-add-ons'),
            //         'col-md-11'                     => __('11 Columns - 11/12', 'easybook-add-ons'),
            //         'col-md-12'                     => __('12 Columns - 1/1', 'easybook-add-ons'),
            //     ),
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
                'default'               => '',
                
            ),

            
        )
    );


    $new_elements = apply_filters( 'azp_register_elements', $elements );
    if(is_array($new_elements)) $elements = array_merge($elements, $new_elements);

    /* For Styles - Animations and Responsive tabs */

    $elements['AZPStyleOptions'] = array(
        'attrs' => array (
            array(
                'type'                  =>'dimension',
                'param_name'            =>'azp_margin',
                'label'                 => __( 'Margin', 'easybook-add-ons' ),
                'desc'                  => "" ,
                'default'               => '',
                'em_unit'               => false,
                // 'per_unit'              => false,
                // 'rem_unit'              => false,
            ),

            array(
                'type'                  =>'dimension',
                'param_name'            =>'azp_padding',
                'label'                 => __( 'Padding', 'easybook-add-ons' ),
                'desc'                  => "" ,
                'default'               => ''
            ),
            array(
                'type'                  =>'dimension',
                'param_name'            =>'azp_border_width',
                'label'                 => __( 'Border Width', 'easybook-add-ons' ),
                'desc'                  => "" ,
                'default'               => '',
                'em_unit'               => false,
            ),

            

            array(
                'type'                  => 'color',
                'param_name'            => 'azp_bd_color',
                'label'                 => __( 'Border Color', 'easybook-add-ons' ),
                'desc'                  => "" ,
                'default'               => '',
                //'rgba'                => true
            ),

            array(
                'type'                  => 'select',
                'param_name'            => 'azp_bd_style',
                'label'                 => __( 'Border Style', 'easybook-add-ons' ),
                'desc'                  => "" ,
                'default'               => '',
                "value"                 => array(   
                    ''                      => __( 'Default', 'easybook-add-ons' ),
                    'solid'                 => __( 'Solid', 'easybook-add-ons' ),
                    'dotted'                => __( 'Dotted', 'easybook-add-ons' ),
                    'dashed'                => __( 'Dashed', 'easybook-add-ons' ),
                    'none'                  => __( 'None', 'easybook-add-ons' ),
                    'hidden'                => __( 'Hidden', 'easybook-add-ons' ),
                    'double'                => __( 'Double', 'easybook-add-ons' ),
                    'groove'                => __( 'Groove', 'easybook-add-ons' ),
                    'ridge'                 => __( 'Ridge', 'easybook-add-ons' ),
                    'inset'                 => __( 'Inset', 'easybook-add-ons' ),
                    'outset'                => __( 'Outset', 'easybook-add-ons' ),
                    'initial'               => __( 'Initial', 'easybook-add-ons' ),
                    'inherit'               => __( 'Inherit', 'easybook-add-ons' ),
                ),
            ),


            array(
                'type'                  => 'color',
                'param_name'            => 'azp_bg_color',
                'label'                 => __('Background Color','easybook-add-ons'),
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'image',
                'param_name'            => 'azp_bg_image',
                'label'                 => __('Background Image','easybook-add-ons'),
                'fieldclass'            => 'input-small',
                'desc'                  => '',
                'default'               => ''
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'azp_bg_repeat',
                'label'                 => __('Background Repeat','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '',
                'value'                 => array(   
                    ''                     => __('Default - Repeat', 'easybook-add-ons'),
                    'repeat-x'             => __('Repeat X', 'easybook-add-ons'),
                    'repeat-y'             => __('Repeat Y', 'easybook-add-ons'),
                    'no-repeat'            => __('No Repeat', 'easybook-add-ons'),    

                ),
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'azp_bg_attachment',
                'label'                 => __('Background Attachment','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '',
                'value'                 => array(   
                    ''                     => __('Default - Scroll', 'easybook-add-ons'),
                    'fixed'                => __('Fixed', 'easybook-add-ons'),
                    'local'                => __('Local', 'easybook-add-ons'),
                    'initial'              => __( 'Initial', 'easybook-add-ons' ),
                    'inherit'              => __( 'Inherit', 'easybook-add-ons' ),
                ),
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'azp_bg_size',
                'label'                 => __('Background Size','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '',
                'value'                 => array(   
                    ''                     => __('Default - Auto', 'easybook-add-ons'),
                    'cover'                => __('Cover', 'easybook-add-ons'),
                    'contain'              => __('Contain', 'easybook-add-ons'),  

                ),
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'azp_bg_position',
                'label'                 => __('Background Position','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '',
                'value'                 => array(   
                    ''                     => __('Default', 'easybook-add-ons'),
                    'left top'             => __('Left - Top', 'easybook-add-ons'),
                    'left center'          => __('Left - Center', 'easybook-add-ons'),
                    'left bottom'          => __('Left - Bottom', 'easybook-add-ons'),
                    'right top'            => __('Right - Top', 'easybook-add-ons'),
                    'right center'         => __('Right - Center', 'easybook-add-ons'),
                    'right bottom'         => __('Right - Bottom', 'easybook-add-ons'),
                    'center top'           => __('Center - Top', 'easybook-add-ons'),
                    'center center'        => __('Center - Center', 'easybook-add-ons'),
                    'center bottom'        => __('Center - Bottom', 'easybook-add-ons'),
                ),
            ),
            // array(
            //     'type'                  => 'textarea',
            //     'param_name'            => 'additional_style',
            //     'label'                 => __('Additional Inline Style','easybook-add-ons'),
            //     'fieldclass'            => 'ele-inline-css',
            //     'desc'                  => '',
            //     'default'               => ''
            // ),
            
        )
    );

    
    // $elements['AZPTypoOptions'] = array(
    //     'attrs' => array (
    //         array(
    //             'type'                  => 'switch',
    //             'param_name'            => 'typo_tempfont',
    //             'label'                 => __('Use template font?','easybook-add-ons'),
    //             'desc'                  => __("Use default template font instead of custom Google font." ,'easybook-add-ons'),
    //             'default'               => '1',
    //             'value'                 => array(
    //                 '1'                     => __('Yes', 'easybook-add-ons'),
    //                 '0'                     => __('No', 'easybook-add-ons'),
    //             ),
    //         ),

    //         array(
    //             'type'                  => 'googlefonts',
    //             'param_name'            => 'typo_googlefont',
    //             'label'                 => __('Google Font','easybook-add-ons'),
    //             'desc'                  => '',
    //             'default'               => 'Roboto:regular',
    //             'depends_on'            => array(
    //                 'element'               =>'typo_tempfont',
    //                 'value'                 => array('0'),
    //                 'has_value'             => false
    //             ),
                
    //         ),
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'typo_fontsize',
    //             'label'                 => __('Font Size','easybook-add-ons'),
    //             'desc'                  => __("Unit included. Ex: 14px",'easybook-add-ons'),
    //             'default'               => ''
    //         ),
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'typo_lheight',
    //             'label'                 => __('Line Height','easybook-add-ons'),
    //             'desc'                  => __("Unit included: 28px or 1 for 'Font Size' value" ,'easybook-add-ons'),
    //             'default'               => '',
                
    //         ),
    //         array(
    //             'type'                  => 'color',
    //             'param_name'            => 'typo_textcolor',
    //             'label'                 => __('Text Color','easybook-add-ons'),
    //             'desc'                  => '',
    //             'default'               => ''
    //         ),
    //         array(
    //             'type'                  => 'select',
    //             'param_name'            => 'typo_textalign',
    //             'label'                 => __('Text Align','easybook-add-ons'),
    //             'desc'                  => '',
    //             'default'               => '',
    //             'value'                 => array(
    //                 ''                     => __('Template Default', 'easybook-add-ons'),
    //                 'left'                     => __('Left', 'easybook-add-ons'),
    //                 'right'                        => __('Right', 'easybook-add-ons'),
    //                 'center'                       => __('Center', 'easybook-add-ons'),
    //                 'justify'                       => __('Justify', 'easybook-add-ons'),
    //             ),
                
    //         ),

    //         array(
    //             'type'                  => 'select',
    //             'param_name'            => 'typo_texttransform',
    //             'label'                 => __('Text Transformation','easybook-add-ons'),
    //             'desc'                  => '',
    //             'default'               => '',
    //             'value'                 => array(
    //                 ''                     => __('Template Default', 'easybook-add-ons'),
    //                 'uppercase'                        => __('Uppercase', 'easybook-add-ons'),
    //                 'lowercase'                        => __('Lowercase', 'easybook-add-ons'),
    //                 'capitalize'                       => __('Capitalize', 'easybook-add-ons'),
    //             ),
                
    //         ),
            


            
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'typo_letterspacing',
    //             'label'                 => __('Letter Spacing','easybook-add-ons'),
    //             'desc'                  => __("Unit included. Ex: 3px" ,'easybook-add-ons'),
    //             'default'               => '',
                
    //         ),
            
    //         array(
    //             'type'                  => 'text',
    //             'param_name'            => 'typo_textindent',
    //             'label'                 => __('Text Indentation','easybook-add-ons'),
    //             'desc'                  => __("Specify the indentation of the first line of a text. Unit included. Ex: 50px" ,'easybook-add-ons'),
    //             'default'               => '',
                
    //         ),



            
    //     )
    // );

    
    //new animation from version 3
    $elements['AZPAnimationOptions'] = array(
        'attrs' => array (
            array(
                'type'                  => 'switch',
                'param_name'            => 'animation',
                'label'                 => __('Use Animation','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '0',
                'value'                 => array(   
                    '1'                     => __('Yes', 'easybook-add-ons'),
                    '0'                     => __('No', 'easybook-add-ons'),                                                                               
                ),
            ),
            

            array(
                'type'                  => 'animation',
                'param_name'            => 'animationtype',
                'label'                 => __('Animation Type','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'fadeIn',
                'value'                 => array(   
                    'bounce'                        => __('bounce', 'easybook-add-ons'),
                    'flash'                     => __('flash', 'easybook-add-ons'),
                    'pulse'                     => __('pulse', 'easybook-add-ons'),
                    'rubberBand'                        => __('rubberBand', 'easybook-add-ons'),
                    'shake'                     => __('shake', 'easybook-add-ons'),
                    'headShake'                     => __('headShake', 'easybook-add-ons'),
                    'swing'                     => __('swing', 'easybook-add-ons'),
                    'tada'                      => __('tada', 'easybook-add-ons'),
                    'jello'                     => __('jello', 'easybook-add-ons'),
                    'bounceIn'                      => __('bounceIn', 'easybook-add-ons'),
                    'bounceInDown'                      => __('bounceInDown', 'easybook-add-ons'),
                    'bounceInLeft'                      => __('bounceInLeft', 'easybook-add-ons'),
                    'bounceInRight'                     => __('bounceInRight', 'easybook-add-ons'),
                    'bounceInUp'                        => __('bounceInUp', 'easybook-add-ons'),
                    // 'bounceOut'                      => __('bounceOut', 'default'),
                    // 'bounceOutDown'                      => __('bounceOutDown', 'default'),
                    // 'bounceOutLeft'                      => __('bounceOutLeft', 'default'),
                    // 'bounceOutRight'                     => __('bounceOutRight', 'default'),
                    // 'bounceOutUp'                        => __('bounceOutUp', 'default'),
                    'fadeIn'                        => __('fadeIn', 'easybook-add-ons'),
                    'fadeInDown'                        => __('fadeInDown', 'easybook-add-ons'),
                    'fadeInDownBig'                     => __('fadeInDownBig', 'easybook-add-ons'),
                    'fadeInLeft'                        => __('fadeInLeft', 'easybook-add-ons'),
                    'fadeInLeftBig'                     => __('fadeInLeftBig', 'easybook-add-ons'),
                    'fadeInRight'                       => __('fadeInRight', 'easybook-add-ons'),
                    'fadeInRightBig'                        => __('fadeInRightBig', 'easybook-add-ons'),
                    'fadeInUp'                      => __('fadeInUp', 'easybook-add-ons'),
                    'fadeInUpBig'                       => __('fadeInUpBig', 'easybook-add-ons'),
                    // 'fadeOut'                        => __('fadeOut', 'default'),
                    // 'fadeOutDown'                        => __('fadeOutDown', 'default'),
                    // 'fadeOutDownBig'                     => __('fadeOutDownBig', 'default'),
                    // 'fadeOutLeft'                        => __('fadeOutLeft', 'default'),
                    // 'fadeOutLeftBig'                     => __('fadeOutLeftBig', 'default'),
                    // 'fadeOutRight'                       => __('fadeOutRight', 'default'),
                    // 'fadeOutRightBig'                        => __('fadeOutRightBig', 'default'),
                    // 'fadeOutUp'                      => __('fadeOutUp', 'default'),
                    // 'fadeOutUpBig'                       => __('fadeOutUpBig', 'default'),
                    'flipInX'                       => __('flipInX', 'easybook-add-ons'),
                    'flipInY'                       => __('flipInY', 'easybook-add-ons'),
                    // 'flipOutX'                       => __('flipOutX', 'default'),
                    // 'flipOutY'                       => __('flipOutY', 'default'),
                    'lightSpeedIn'                      => __('lightSpeedIn', 'easybook-add-ons'),
                    //'lightSpeedOut'                       => __('lightSpeedOut', 'default'),
                    'rotateIn'                      => __('rotateIn', 'easybook-add-ons'),
                    'rotateInDownLeft'                      => __('rotateInDownLeft', 'easybook-add-ons'),
                    'rotateInDownRight'                     => __('rotateInDownRight', 'easybook-add-ons'),
                    'rotateInUpLeft'                        => __('rotateInUpLeft', 'easybook-add-ons'),
                    'rotateInUpRight'                       => __('rotateInUpRight', 'easybook-add-ons'),
                    // 'rotateOut'                      => __('rotateOut', 'default'),
                    // 'rotateOutDownLeft'                      => __('rotateOutDownLeft', 'default'),
                    // 'rotateOutDownRight'                     => __('rotateOutDownRight', 'default'),
                    // 'rotateOutUpLeft'                        => __('rotateOutUpLeft', 'default'),
                    // 'rotateOutUpRight'                       => __('rotateOutUpRight', 'default'),
                    'hinge'                     => __('hinge', 'easybook-add-ons'),
                    'jackInTheBox'                      => __('jackInTheBox', 'easybook-add-ons'),
                    'rollIn'                        => __('rollIn', 'easybook-add-ons'),
                    //'rollOut'                     => __('rollOut', 'default'),
                    'zoomIn'                        => __('zoomIn', 'easybook-add-ons'),
                    'zoomInDown'                        => __('zoomInDown', 'easybook-add-ons'),
                    'zoomInLeft'                        => __('zoomInLeft', 'easybook-add-ons'),
                    'zoomInRight'                       => __('zoomInRight', 'easybook-add-ons'),
                    'zoomInUp'                      => __('zoomInUp', 'easybook-add-ons'),
                    // 'zoomOut'                        => __('zoomOut', 'default'),
                    // 'zoomOutDown'                        => __('zoomOutDown', 'default'),
                    // 'zoomOutLeft'                        => __('zoomOutLeft', 'default'),
                    // 'zoomOutRight'                       => __('zoomOutRight', 'default'),
                    // 'zoomOutUp'                      => __('zoomOutUp', 'default'),
                    'slideInDown'                       => __('slideInDown', 'easybook-add-ons'),
                    'slideInLeft'                       => __('slideInLeft', 'easybook-add-ons'),
                    'slideInRight'                      => __('slideInRight', 'easybook-add-ons'),
                    'slideInUp'                     => __('slideInUp', 'easybook-add-ons'),
                    // 'slideOutDown'                       => __('slideOutDown', 'default'),
                    // 'slideOutLeft'                       => __('slideOutLeft', 'default'),
                    // 'slideOutRight'                      => __('slideOutRight', 'default'),
                    // 'slideOutUp'                        => __('slideOutUp', 'default'),
                ),
            ),

            array(
                'type'                  => 'text',
                'param_name'            => 'animationdelay',
                'label'                 => __('Animation Delay','easybook-add-ons'),
                'desc'                  => __("Animation delay in milisecond" ,'easybook-add-ons'),
                'default'               => '100',
            ),
            
        )
    );

    $elements['AZPRespOptions'] = array(
        'attrs' => array (
            array(
                'type'                  => 'hidden',
                'param_name'            => 'azp_bwid',
                'label'                 => __( 'Base Width', 'easybook-add-ons' ),
                'desc'                  => "" ,
                'default'               => '100'
            ),
            array (
                'type'                  => 'label',
                'param_name'            => 'respdevice',
                'label'                 => __('Device','easybook-add-ons'),
                'desc'                  => '',
            ),
            array (
                'type'                  => 'label',
                'param_name'            => 'respoffset',
                'label'                 => __('Offset','easybook-add-ons'),
                'desc'                  => '',
            ),
            array (
                'type'                  => 'label',
                'param_name'            => 'respwidth',
                'label'                 => __('Width','easybook-add-ons'),
                'desc'                  => '',
            ),
            array (
                'type'                  => 'label',
                'param_name'            => 'resphideondevice',
                'label'                 => __('Hide on device','easybook-add-ons'),
                'desc'                  => '',
            ),
            array(
                'type'                  => 'clearfix',
            ),
            array (
                'type'                  => 'label',
                'param_name'            => 'devicedesktop',
                'label'                 => __('<i class="ti-desktop"></i>','easybook-add-ons'),
                'desc'                  => '',
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'lgoffsetclass',
                'label'                 => __('','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '',
                'value'                 => array(   
                    ''                      => __('Inherit from smaller', 'easybook-add-ons'), 
                    'col-lg-offset-0'                       => __('No offset', 'easybook-add-ons'), 
                    'col-lg-offset-1'                       => __('1 Column - 1/12', 'easybook-add-ons'), 
                    'col-lg-offset-2'                       => __('2 Columns - 1/6', 'easybook-add-ons'),  
                    'col-lg-offset-3'                       => __('3 Columns - 1/4', 'easybook-add-ons'),    
                    'col-lg-offset-4'                       => __('4 Columns - 1/3', 'easybook-add-ons'),    
                    'col-lg-offset-5'                       => __('5 Columns - 5/12', 'easybook-add-ons'),    
                    'col-lg-offset-6'                       => __('6 Columns - 1/2', 'easybook-add-ons'),    
                    'col-lg-offset-7'                       => __('7 Columns - 7/12', 'easybook-add-ons'),    
                    'col-lg-offset-8'                       => __('8 Columns - 2/3', 'easybook-add-ons'),    
                    'col-lg-offset-9'                       => __('9 Columns - 1/4', 'easybook-add-ons'),    
                    'col-lg-offset-10'                      => __('10 Columns - 5/6', 'easybook-add-ons'),    
                    'col-lg-offset-11'                      => __('11 Columns - 11/12', 'easybook-add-ons'),    
                    'col-lg-offset-12'                      => __('12 Columns - 1/1', 'easybook-add-ons'),     
                ),
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'lgwidthclass',
                'label'                 => __('','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '',
                'value'                 => array( 
                    ''                      => __('Inherit from smaller', 'easybook-add-ons'), 
                    'col-lg-1'                      => __('1 Column - 1/12', 'easybook-add-ons'), 
                    'col-lg-2'                      => __('2 Columns - 1/6', 'easybook-add-ons'),  
                    'col-lg-3'                      => __('3 Columns - 1/4', 'easybook-add-ons'),    
                    'col-lg-4'                      => __('4 Columns - 1/3', 'easybook-add-ons'),    
                    'col-lg-5'                      => __('5 Columns - 5/12', 'easybook-add-ons'),    
                    'col-lg-6'                      => __('6 Columns - 1/2', 'easybook-add-ons'),    
                    'col-lg-7'                      => __('7 Columns - 7/12', 'easybook-add-ons'),    
                    'col-lg-8'                      => __('8 Columns - 2/3', 'easybook-add-ons'),    
                    'col-lg-9'                      => __('9 Columns - 1/4', 'easybook-add-ons'),    
                    'col-lg-10'                     => __('10 Columns - 5/6', 'easybook-add-ons'),    
                    'col-lg-11'                     => __('11 Columns - 11/12', 'easybook-add-ons'),    
                    'col-lg-12'                     => __('12 Columns - 1/1', 'easybook-add-ons'),       

                ),
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'hidden-lg',
                'label'                 => __("Hide on desktop",'easybook-add-ons'),
                'desc'                  => '',
                'default'               => '0',
                'value'                 => array(
                    '1'                     => __('Yes', 'easybook-add-ons'),
                    '0'                     => __('No', 'easybook-add-ons'),
                )
                
            ),

            array(
                'type'                  => 'clearfix',
            ),

            array(
                'type'                  => 'label',
                'param_name'            => 'devicetablethoz',
                'label'                 => __('<i class="ti-tablet"></i>','easybook-add-ons'),
                'desc'                  => '',
            ),

            array(
                'type'                  => 'select',
                'param_name'            => 'mdoffsetclass',
                'label'                 => __('','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '',
                'value'                 => array(   
                    ''                      => __('Inherit from smaller', 'easybook-add-ons'),
                    'col-md-offset-0'                       => __('No offset', 'easybook-add-ons'),
                    'col-md-offset-1'                       => __('1 Column - 1/12', 'easybook-add-ons'),
                    'col-md-offset-2'                       => __('2 Columns - 1/6', 'easybook-add-ons'),
                    'col-md-offset-3'                       => __('3 Columns - 1/4', 'easybook-add-ons'),
                    'col-md-offset-4'                       => __('4 Columns - 1/3', 'easybook-add-ons'),
                    'col-md-offset-5'                       => __('5 Columns - 5/12', 'easybook-add-ons'),
                    'col-md-offset-6'                       => __('6 Columns - 1/2', 'easybook-add-ons'),
                    'col-md-offset-7'                       => __('7 Columns - 7/12', 'easybook-add-ons'),
                    'col-md-offset-8'                       => __('8 Columns - 2/3', 'easybook-add-ons'),
                    'col-md-offset-9'                       => __('9 Columns - 1/4', 'easybook-add-ons'),
                    'col-md-offset-10'                      => __('10 Columns - 5/6', 'easybook-add-ons'),
                    'col-md-offset-11'                      => __('11 Columns - 11/12', 'easybook-add-ons'),
                    'col-md-offset-12'                      => __('12 Columns - 1/1', 'easybook-add-ons'),

                ),
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'mdwidthclass',
                'label'                 => __('','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '',
                'value'                 => array( 
                    ''                      => __('Inherit from smaller', 'easybook-add-ons'),
                    'col-md-1'                      => __('1 Column - 1/12', 'easybook-add-ons'),
                    'col-md-2'                      => __('2 Columns - 1/6', 'easybook-add-ons'),
                    'col-md-3'                      => __('3 Columns - 1/4', 'easybook-add-ons'),
                    'col-md-4'                      => __('4 Columns - 1/3', 'easybook-add-ons'),
                    'col-md-5'                      => __('5 Columns - 5/12', 'easybook-add-ons'),
                    'col-md-6'                      => __('6 Columns - 1/2', 'easybook-add-ons'),
                    'col-md-7'                      => __('7 Columns - 7/12', 'easybook-add-ons'),
                    'col-md-8'                      => __('8 Columns - 2/3', 'easybook-add-ons'),
                    'col-md-9'                      => __('9 Columns - 1/4', 'easybook-add-ons'),
                    'col-md-10'                     => __('10 Columns - 5/6', 'easybook-add-ons'),
                    'col-md-11'                     => __('11 Columns - 11/12', 'easybook-add-ons'),
                    'col-md-12'                     => __('12 Columns - 1/1', 'easybook-add-ons'),
                ),
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'hidden-md',
                'label'                 => __("Hide on laptop",'easybook-add-ons'),
                'desc'                  => '',
                'default'               => '0',
                'value'                 => array(
                    '1'                     => __('Yes', 'easybook-add-ons'),
                    '0'                     => __('No', 'easybook-add-ons'),
                )
                
            ),
            array(
                'type'                  => 'clearfix',
            ),

            array(
                'type'                  => 'label',
                'param_name'            => 'devicetablet',
                'label'                 => __('<i class="ti-tablet"></i>','easybook-add-ons'),
                'desc'                  => '',
            ),

            array(
                'type'                  => 'select',
                'param_name'            => 'smoffsetclass',
                'label'                 => __('','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '',
                'value'                 => array(   
                    ''                      => __('Inherit from smaller', 'easybook-add-ons'),
                    'col-sm-offset-0'                       => __('No offset', 'easybook-add-ons'),
                    'col-sm-offset-1'                       => __('1 Column - 1/12', 'easybook-add-ons'),
                    'col-sm-offset-2'                       => __('2 Columns - 1/6', 'easybook-add-ons'),
                    'col-sm-offset-3'                       => __('3 Columns - 1/4', 'easybook-add-ons'),
                    'col-sm-offset-4'                       => __('4 Columns - 1/3', 'easybook-add-ons'),
                    'col-sm-offset-5'                       => __('5 Columns - 5/12', 'easybook-add-ons'),
                    'col-sm-offset-6'                       => __('6 Columns - 1/2', 'easybook-add-ons'),
                    'col-sm-offset-7'                       => __('7 Columns - 7/12', 'easybook-add-ons'),
                    'col-sm-offset-8'                       => __('8 Columns - 2/3', 'easybook-add-ons'),
                    'col-sm-offset-9'                       => __('9 Columns - 1/4', 'easybook-add-ons'),
                    'col-sm-offset-10'                      => __('10 Columns - 5/6', 'easybook-add-ons'),
                    'col-sm-offset-11'                      => __('11 Columns - 11/12', 'easybook-add-ons'),
                    'col-sm-offset-12'                      => __('12 Columns - 1/1', 'easybook-add-ons'),
                ),
            ),
            array(
                'type'                  => 'select',
                'param_name'            => 'columnwidthclass',
                'label'                 => __('Width','easybook-add-ons'),
                'desc'                  => '',
                'default'               => 'col-md-12',
                'value'                 => array(   
                    'col-md-1'                      => __('1 Column - 1/12', 'easybook-add-ons'),
                    'col-md-2'                      => __('2 Columns - 1/6', 'easybook-add-ons'),
                    'col-md-3'                      => __('3 Columns - 1/4', 'easybook-add-ons'),
                    'col-md-4'                      => __('4 Columns - 1/3', 'easybook-add-ons'),
                    'col-md-5'                      => __('5 Columns - 5/12', 'easybook-add-ons'),
                    'col-md-6'                      => __('6 Columns - 1/2', 'easybook-add-ons'),
                    'col-md-7'                      => __('7 Columns - 7/12', 'easybook-add-ons'),
                    'col-md-8'                      => __('8 Columns - 2/3', 'easybook-add-ons'),
                    'col-md-9'                      => __('9 Columns - 1/4', 'easybook-add-ons'),
                    'col-md-10'                     => __('10 Columns - 5/6', 'easybook-add-ons'),
                    'col-md-11'                     => __('11 Columns - 11/12', 'easybook-add-ons'),
                    'col-md-12'                     => __('12 Columns - 1/1', 'easybook-add-ons'),
                ),
            ),
            
            array(
                'type'                  => 'switch',
                'param_name'            => 'hidden-sm',
                'label'                 => __("Hide on tablet",'easybook-add-ons'),
                'desc'                  => '',
                'default'               => '0',
                'value'                 => array(
                    '1'                     => __('Yes', 'easybook-add-ons'),
                    '0'                     => __('No', 'easybook-add-ons'),
                )
                
            ),

            array(
                'type'                  => 'clearfix',
            ),

            array(
                'type'                  => 'label',
                'param_name'            => 'devicemobile',
                'label'                 => __('<i class="ti-mobile"></i>','easybook-add-ons'),
                'desc'                  => '',
            ),


            array(
                'type'                  => 'select',
                'param_name'            => 'xsoffsetclass',
                'label'                 => __('','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '',
                'value'                 => array(   
                    ''                      => __('No offset', 'easybook-add-ons'),
                    'col-xs-offset-1'                       => __('1 Column - 1/12', 'easybook-add-ons'),
                    'col-xs-offset-2'                       => __('2 Columns - 1/6', 'easybook-add-ons'),
                    'col-xs-offset-3'                       => __('3 Columns - 1/4', 'easybook-add-ons'),
                    'col-xs-offset-4'                       => __('4 Columns - 1/3', 'easybook-add-ons'),
                    'col-xs-offset-5'                       => __('5 Columns - 5/12', 'easybook-add-ons'),
                    'col-xs-offset-6'                       => __('6 Columns - 1/2', 'easybook-add-ons'),
                    'col-xs-offset-7'                       => __('7 Columns - 7/12', 'easybook-add-ons'),
                    'col-xs-offset-8'                       => __('8 Columns - 2/3', 'easybook-add-ons'),
                    'col-xs-offset-9'                       => __('9 Columns - 1/4', 'easybook-add-ons'),
                    'col-xs-offset-10'                      => __('10 Columns - 5/6', 'easybook-add-ons'),
                    'col-xs-offset-11'                      => __('11 Columns - 11/12', 'easybook-add-ons'),
                    'col-xs-offset-12'                      => __('12 Columns - 1/1', 'easybook-add-ons'),
                ),
            ),

            
            array(
                'type'                  => 'select',
                'param_name'            => 'xswidthclass',
                'label'                 => __('','easybook-add-ons'),
                'desc'                  => '',
                'default'               => '',
                'value'                 => array(   
                    ''                      => __('No Select', 'easybook-add-ons'),
                    'col-xs-1'                      => __('1 Column - 1/12', 'easybook-add-ons'),
                    'col-xs-2'                      => __('2 Columns - 1/6', 'easybook-add-ons'),
                    'col-xs-3'                      => __('3 Columns - 1/4', 'easybook-add-ons'),
                    'col-xs-4'                      => __('4 Columns - 1/3', 'easybook-add-ons'),
                    'col-xs-5'                      => __('5 Columns - 5/12', 'easybook-add-ons'),
                    'col-xs-6'                      => __('6 Columns - 1/2', 'easybook-add-ons'),
                    'col-xs-7'                      => __('7 Columns - 7/12', 'easybook-add-ons'),
                    'col-xs-8'                      => __('8 Columns - 2/3', 'easybook-add-ons'),
                    'col-xs-9'                      => __('9 Columns - 1/4', 'easybook-add-ons'),
                    'col-xs-10'                     => __('10 Columns - 5/6', 'easybook-add-ons'),
                    'col-xs-11'                     => __('11 Columns - 11/12', 'easybook-add-ons'),
                    'col-xs-12'                     => __('12 Columns - 1/1', 'easybook-add-ons'),
                ),
            ),
            array(
                'type'                  => 'switch',
                'param_name'            => 'hidden-xs',
                'label'                 => __("Hide on mobile",'easybook-add-ons'),
                'desc'                  => '',
                'default'               => '0',
                'value'                 => array(
                    '1'                     => __('Yes', 'easybook-add-ons'),
                    '0'                     => __('No', 'easybook-add-ons'),
                )
                
            ),

            array(
                'type'                  => 'clearfix',
            ),

        )
    );


    return $elements;

    // https://regex101.com/r/fTLd7P/1
}

add_action('wp_ajax_nopriv_easybook_addons_azp_fetch_images', 'easybook_addons_azp_fetch_images_callback');
add_action('wp_ajax_easybook_addons_azp_fetch_images', 'easybook_addons_azp_fetch_images_callback');
function easybook_addons_azp_fetch_images_callback(){
    $json = array(
        'success' => false,
        'data' => array(
            // 'POST'=>$_POST,
        ),
        'images'    => array()
    );
    $images = isset($_POST['images'])? $_POST['images'] : '';
    if(!empty($images)){
        $images = explode(",", $images);
        if( is_array($images) && !empty($images) ){
            foreach( $images as $id ){
                $json['images'][] = array(
                    'id'        => $id,
                    'url'       => wp_get_attachment_url( $id )
                );
            }
        }
    }
    $json['success'] = true;
    wp_send_json($json );
}

function easybook_addons_get_fontawesome_icons(){
    $icons = file_get_contents(ESB_ABSPATH.'assets/vendors/fontawesome/metadata/icons.json');
    $icons = json_decode($icons, true);
    $return = array();
    if(is_array($icons)){
        foreach ($icons as $name => $attrs) {
            $return[$name] = array();
            $return[$name]['label'] = $attrs['label'];
            $return[$name]['styles'] = $attrs['styles'];
        }
    }
    return $return;
}
