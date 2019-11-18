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



defined( 'ABSPATH' ) || exit;

class Esb_Class_Admin_Scripts {  

    private static $plugin_url;

    public static function init(){
        self::$plugin_url = plugin_dir_url(ESB_PLUGIN_FILE); 

        add_action( 'admin_footer', array(get_called_class(), 'price_templates') );

        add_action( 'admin_enqueue_scripts', array(get_called_class(), 'enqueue_scripts') );    
    }

    public static function price_templates(){
        ?>
        <script type="text/template" id="tmpl-currency">
            <?php easybook_addons_get_template_part( 'templates-inner/add-currency' );?>  
        </script>
        <script type="text/template" id="tmpl-user-social">
            <?php easybook_addons_get_template_part( 'templates-inner/user-social' );?>
        </script>

        <script type="text/template" id="tmpl-imageslist">
            <?php easybook_addons_get_template_part('templates-inner/image');?>
        </script>
        <?php
    }

    private static function enqueue_react_libraries(){
        wp_enqueue_script( 'react', self::$plugin_url ."assets/js/react.production.min.js" , array(), null , true );
        wp_enqueue_script( 'react-dom', self::$plugin_url ."assets/js/react-dom.production.min.js" , array(), null , true );
        wp_enqueue_script( 'react-router-dom', self::$plugin_url ."assets/js/react-router-dom.min.js" , array(), null , true );
        wp_enqueue_script( 'redux', self::$plugin_url ."assets/js/redux.min.js" , array(), null , true );
        wp_enqueue_script( 'react-redux', self::$plugin_url ."assets/js/react-redux.min.js" , array(), null , true );
        wp_enqueue_script( 'redux-thunk', self::$plugin_url ."assets/js/redux-thunk.min.js" , array(), null , true );
        wp_enqueue_script( 'qs', self::$plugin_url ."assets/js/qs.js" , array(), null , true );
        wp_enqueue_script( 'axios', self::$plugin_url ."assets/js/axios.min.js" , array(), null , true );
        wp_enqueue_script( 'Sortable', self::$plugin_url ."assets/js/Sortable.min.js" , array(), null , true );
        wp_enqueue_script( 'react-sortable', self::$plugin_url ."assets/js/react-sortable.min.js" , array(), null , true );
        wp_enqueue_script( 'plugin-js', self::$plugin_url ."assets/js/plugins.js" , array(), null , true );

        wp_enqueue_script( 'jquery-scrolltofixed', self::$plugin_url ."assets/js/jquery-scrolltofixed-min.js" , array(), null , true );

    }

    public static function enqueue_scripts($hook){
        wp_enqueue_media();
        wp_enqueue_style( 'wp-color-picker');
        wp_enqueue_script( 'wp-color-picker');
        wp_enqueue_editor();
        
        // Load only on ?page=mypluginname
        // var_dump($hook);
        wp_enqueue_style( 'select2', self::$plugin_url .'assets/css/select2.min.css' );
        wp_enqueue_style( 'fontawesome' , self::$plugin_url ."assets/vendors/fontawesome/css/all.min.css", false ); 

        

        wp_enqueue_style( 'easybook-add-ons', self::$plugin_url .'assets/css/admin.css' ); 

        wp_enqueue_style( 'datetimepicker.jquery', self::$plugin_url .'assets/admin/datetimepicker/jquery.datetimepicker.min.css' );

        

        //free map or google map
        if(easybook_addons_get_option('use_osm_map')){
            wp_enqueue_style( 'openlayers' , self::$plugin_url ."assets/css/ol.css", false ); 
            wp_enqueue_script( 'openlayers', self::$plugin_url ."assets/js/ol.js" , array(), null , true );

        }else{
            $gmap_api_key = easybook_addons_get_option('gmap_api_key');
            wp_enqueue_script("googleapis", "https://maps.googleapis.com/maps/api/js?key=$gmap_api_key&libraries=places",array(),false,true);
        }
        
        wp_enqueue_script('datetimepicker.jquery', self::$plugin_url . 'assets/admin/datetimepicker/jquery.datetimepicker.full.min.js', array('jquery'), null, true);

        wp_enqueue_script('easybook-addons-admin', self::$plugin_url . 'assets/js/addons-admin.min.js', array('jquery','jquery-ui-sortable', 'wp-i18n'), null, true);

        $curr_user_data = array(
            'id'    => 0,
            'display_name'  =>'',
            'avatar'        => '',
            'can_upload'        => false,
        );

        if(is_user_logged_in()){
            $current_user = wp_get_current_user();
            $curr_user_data = array(
                'id'            => $current_user->ID, 
                'display_name'  => $current_user->display_name,
                'avatar'  => get_avatar($current_user->user_email,'150','https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=150', $current_user->display_name ),

                'can_upload'        => current_user_can('upload_files'),
            );
        }
        $_easybook_add_ons_admin = array(
            'center_lat'    => floatval(easybook_addons_get_option('gmap_default_lat')), 
            'center_lng'    => floatval(easybook_addons_get_option('gmap_default_long')),
            'files'         => easybook_addons_cont_fiels_select(), 
            'socials'       => easybook_addons_get_socials_list(),
            'curr_user'     => $curr_user_data,
            'ltypeid'        => easybook_addons_single_listing_types(),
            'url'           => esc_url(admin_url( 'admin-ajax.php' )),
            'nonce'         => wp_create_nonce( 'easybook-add-ons' ),
            // 'plans'         => easybook_addons_listing_plans(),
        );
        wp_localize_script( 'easybook-addons-admin', '_easybook_add_ons_admin', $_easybook_add_ons_admin );

        if( function_exists('wp_set_script_translations') ) wp_set_script_translations( 'easybook-addons-admin', 'easybook-add-ons' );

        $screen = get_current_screen();
        if (  $screen->base == 'post' && ($screen->post_type == 'listing_type' || $screen->post_type == 'listing' || $screen->post_type == 'lrooms' || $screen->post_type == 'product') ) {
            self::enqueue_react_libraries();
            $_easybook_add_ons_adminapp = array(
                'i18n' => array(
                    'profile'      => __( 'Profile',  'easybook-add-ons' ),

                    'tab_general'  => __( 'General',  'easybook-add-ons' ),
                    'tab_fields'   => __( 'Fields',  'easybook-add-ons' ),
                    'tab_single'   => __( 'Single',  'easybook-add-ons' ),
                    'tab_cards'    => __( 'Cards',  'easybook-add-ons' ),
                    'tab_filter'   => __( 'Filter',  'easybook-add-ons' ),
                    'tab_advanced'   => __( 'Advanced',  'easybook-add-ons' ),
                    'tab_advanced_schema'   => __( 'Schema Markup',  'easybook-add-ons' ),

                    'nav_title_L'      => __( 'Listing',  'easybook-add-ons' ),
                    'nav_title_R'      => __( 'Room',  'easybook-add-ons' ),
                    'nav_title_FB'     => __( 'Form Booking',  'easybook-add-ons' ),
                    'nav_title_Ra'     => __( 'Rating',  'easybook-add-ons' ),
                    'nav_title_Fi_L'   => __( 'Filter Listing',  'easybook-add-ons' ),
                    'nav_title_Fi_HS'  => __( 'Filter Hero Section',  'easybook-add-ons' ),
                    'nav_title_Fi_H'   => __( 'Filter Header',  'easybook-add-ons' ),


                    // Comp - inners - AddForm
                    'opt_val_choose'   => __( 'Chose...',  'easybook-add-ons' ),
                    'opt_val_input'    => __( 'Input',  'easybook-add-ons' ),
                    'opt_val_check'    => __( 'Checkbox',  'easybook-add-ons' ),
                    'opt_val_text'     => __( 'Textarea',  'easybook-add-ons' ),
                    'opt_val_Wysiwyg'  => __( 'Wysiwyg Editor',  'easybook-add-ons' ),
                    'opt_val_select'   => __( 'Select',  'easybook-add-ons' ),
                    'opt_val_radio'    => __( 'Radio',  'easybook-add-ons' ),
                    'opt_val_switch'   => __( 'Switch',  'easybook-add-ons' ),
                    'opt_val_img'      => __( 'Image',  'easybook-add-ons' ),
                    'opt_val_muti'      => __( 'Multiple select',  'easybook-add-ons' ),
                    'opt_val_number'      => __( 'Number',  'easybook-add-ons' ),


                    'opt_val_img'      => __( 'Image',  'easybook-add-ons' ),
                    'opt_val_img'      => __( 'Image',  'easybook-add-ons' ),
                    'opt_val_img'      => __( 'Image',  'easybook-add-ons' ),
                    'opt_val_img'      => __( 'Image',  'easybook-add-ons' ),
                    'opt_val_img'      => __( 'Image',  'easybook-add-ons' ),
                    'opt_val_img'      => __( 'Image',  'easybook-add-ons' ),

                    'lable_loca_Fi_SorG'    => __( 'Is Single Image', 'easybook-add-ons' ),
                    'lable_loca_Fi_C'       => __( 'Preview Columns', 'easybook-add-ons' ),
                    // 'opt_val_N'        => __( 'None',  'easybook-add-ons' ),
                    'opt_val_Y'        => __( 'Yes',  'easybook-add-ons' ),
                    'opt_val_N'        => __( 'No',  'easybook-add-ons' ),


                    // Comp - general
                    'label_title_icon'           => __( 'Icon',  'easybook-add-ons' ),
                    'label_title_singular_name'  => __( 'Singular name (e.g.Business)',  'easybook-add-ons' ),
                    'label_title_plural_name'    => __( 'Plural name (e.g.Business)',  'easybook-add-ons' ),
                    'label_title_child_ptype'  => __( 'Choose custom post type in parent listings type',  'easybook-add-ons' ),
                    // Label, H2, Span title
                    'title'          => __( 'This is listing type General tab',  'easybook-add-ons' ),
                    'lable_title_S'  => __( 'Select Type',  'easybook-add-ons' ),
                    'lable_title_A'  => __( 'Add Listing Room',  'easybook-add-ons' ),
                    'lable_title_A_Fi'  => __( 'Add Field Rating',  'easybook-add-ons' ),

                    'lable_loca_T'   => __( 'TOP',  'easybook-add-ons' ),
                    'lable_loca_R'   => __( 'RIGHT',  'easybook-add-ons' ),
                    'lable_loca_B'   => __( 'BOTTOM',  'easybook-add-ons' ),
                    'lable_loca_L'   => __( 'LEFT',  'easybook-add-ons' ),

                    'lable_title_O'        => __( 'Option value',  'easybook-add-ons' ),

                    'lable_title_Fi_ID'    => __( 'Field ID',  'easybook-add-ons' ),
                    'lable_title_Fi_T'     => __( 'Field Title',  'easybook-add-ons' ),
                    'lable_title_Fi_N'     => __( 'Field Name',  'easybook-add-ons' ),
                    'lable_title_Fi_L'     => __( 'Field Label',  'easybook-add-ons' ),
                    'lable_title_Fi_I'     => __( 'Field Icon',  'easybook-add-ons' ),
                    'lable_title_Fi_D'     => __( 'Field Description',  'easybook-add-ons' ),
                    'lable_title_Fi_de'     => __( 'Field Default',  'easybook-add-ons' ),
                    'lable_title_Fi_ra_sy'     => __( 'Field Rating System',  'easybook-add-ons' ),
                    'lable_title_Fi_V'     => __( 'Field Value',  'easybook-add-ons' ),
                    'lable_title_Fi_Df_V'  => __( 'Default Value',  'easybook-add-ons' ),
                    'lable_title_Fi_W'     => __( 'Field Width',  'easybook-add-ons' ),
                    'lable_title_Fi_C'     => __( 'Field column',  'easybook-add-ons' ),
                    'lable_title_Fi_SorG'  => __( 'Field single or Gallery',  'easybook-add-ons' ),
                    'lable_title_Fi_Re'  => __( 'Required',  'easybook-add-ons' ),
                    'lable_title_Fi_admin'  => __( 'Show Dashboard Admin',  'easybook-add-ons' ),
                    'lable_title_Fi_dec_op'  => __( 'Hidden Description',  'easybook-add-ons' ),

                    'lable_title_TT'       => __( 'Title Text',  'easybook-add-ons' ),
                    'lable_title_TD'       => __( 'Title Description',  'easybook-add-ons' ),


                    'span_title_C'   => __( ' Click here or drop files to upload',  'easybook-add-ons' ),
                    'span_title_Cl'  => __( ' Click here to upload',  'easybook-add-ons' ),
                    'span_title_P'   => __( 'PX',  'easybook-add-ons' ),
                    'span_title_E'   => __( 'EM',  'easybook-add-ons' ),
                    'span_title_R'   => __( 'REM',  'easybook-add-ons' ),
                    'span_title_S'   => __( ' Select images',  'easybook-add-ons' ),
                    'span_title'     => __( '%',  'easybook-add-ons' ),


                    // Button
                    'btn_s'      => __( 'Save',  'easybook-add-ons' ),
                    'btn_save'   => __( 'Save Change',  'easybook-add-ons' ),
                    'btn_add_Fi' => __( 'Add Field ',  'easybook-add-ons' ),
                    'btn_add_F'  => __( 'Add Facts  ',  'easybook-add-ons' ),
                    'btn_add_R'  => __( 'Add Room',  'easybook-add-ons' ),
                    'btn_add_S'  => __( 'Add Social',  'easybook-add-ons' ),
                    'btn_add_O'  => __( 'Add Option',  'easybook-add-ons' ),
                    'btn_link_V' => __( 'Link values',  'easybook-add-ons' ),

                    'validate_error' => __( 'was used by another field. Please try with other value.',  'easybook-add-ons' ),
                    'max_room' => __( 'Max Rooms',  'easybook-add-ons' ),
                    'template_erro' => __( 'Template name must not be empty.',  'easybook-add-ons' ),
                    'template_save' => __( 'Saved Page Templates',  'easybook-add-ons' ),
                    'template_append' => __( 'Append previosly saved template to the current layout',  'easybook-add-ons' ),

                    'opt_lbl' => __( 'Label',  'easybook-add-ons' ),
                    'opt_val' => __( 'Value',  'easybook-add-ons' ),

                    'schema_name' => __( 'Schema Name',  'easybook-add-ons' ),
                    'schema_value' => __( 'Schema Value',  'easybook-add-ons' ),
                    'schema_use_listing' => __( 'Use listing info',  'easybook-add-ons' ),


                ),
                // azp elements
                'azp_elements' => easybook_addons_azp_elements(),
                'fontawesome'   => easybook_addons_get_fontawesome_icons(),
                'schema'            => easybook_addons_schema_listing_metas(),
            );
            wp_enqueue_script( 'easybook-react-adminapp', self::$plugin_url ."assets/js/easybook-react-adminapp.min.js" , array('underscore','easybook-addons-admin'), null , true );
            wp_localize_script( 'easybook-react-adminapp', '_easybook_add_ons_adminapp', $_easybook_add_ons_adminapp );
             //======================
            $listing_type_opts = array();
            $listing_types_posts = get_posts( array(
                'post_type'         => 'listing_type',
                'posts_per_page'    => -1,
                'post_status'       => 'publish',
                'fields'            => 'ids',
            ) );
            if($listing_types_posts){
                foreach ($listing_types_posts as $ltid) {
                    $listing_type_opts[] = array(
                        'ID'            => $ltid,
                        'title'            => get_the_title( $ltid ),
                        'icon'              => '',
                        'description'       => '',
                    );
                }
            }
            $room_type_opts = array(
                array(
                    'ID'    => '0',
                    'title'    => __( 'Choose Listing type', 'easybook-add-ons' ),
                )
            );
            $room_types_posts = get_posts( array(
                'post_type'         => 'listing',
                'posts_per_page'    => -1,
                'post_status'       => 'publish',
                'fields'            => 'ids',
            ) );
            if($room_types_posts){
                foreach ($room_types_posts as $ltid) {
                    $room_type_opts[] = array(
                        'ID'            => $ltid,
                        'title'            => get_the_title( $ltid ),
                        'icon'              => '',
                        'description'       => '',
                    );
                }
            }
             $type_child_nth = array( array(
                'none'          => 'None',
            ));
            $room_pt = get_post_type_object('lrooms');
            $type_child_nth[] =  array(
                'lrooms'    =>  $room_pt->labels->singular_name,
            );
            if(post_type_exists('product')) {
                $product_pt = get_post_type_object('product');
                $type_child_nth[] =  array(
                    'product'    =>$product_pt->labels->singular_name,
                );
            }
            $child_ptype = '';
            $child_pty = get_post_meta( get_queried_object_id(), ESB_META_PREFIX.'general_field_meta', true );
            if(!empty($child_pty) && $child_pty != '') {
                $child_ptype = $child_pty;
            }
            $gmap_marker = easybook_addons_get_option('gmap_marker');
            $_easybook_add_ons = array(
                'url'                           => esc_url(admin_url( 'admin-ajax.php' ) ),
                'nonce'                         => wp_create_nonce( 'easybook-add-ons' ),
                // 'listing_types'                 => $listing_type_ids,
                'listing_type_opts'             => $listing_type_opts,
                'room_type_opts'                => $room_type_opts,
                'id_post'                       => get_the_ID(),
                'curr_user'                     => $curr_user_data,
                'socials'                       => easybook_addons_get_socials_list(),
                'marker'                        => $gmap_marker['url']? $gmap_marker['url'] : self::$plugin_url ."assets/images/marker2.png",
                'center_lat'                    => floatval(easybook_addons_get_option('gmap_default_lat')),
                'center_lng'                    => floatval(easybook_addons_get_option('gmap_default_long')),
                'map_zoom'                      => easybook_addons_get_option('gmap_default_zoom'),
                'free_map'                      => easybook_addons_get_option('use_osm_map'),
                'features'                      => easybook_addons_get_listing_features(),
                
                'cats'                          => easybook_addons_get_listing_cats(),
                'locs'                          => easybook_addons_get_listing_locs(),

                'child_pt_title'                => $type_child_nth,
                'child_ptype'               => $child_ptype,
                'i18n' => array(
                    'btn_add_F'  => __( 'Add Fact +',  'easybook-add-ons' ),
                    'fact_title'  => __( 'Fact Title',  'easybook-add-ons' ),
                    'fact_number'  => __( 'Fact Number',  'easybook-add-ons' ),
                    'fact_icon'  => __( 'Fact Icon',  'easybook-add-ons' ),
                    'slect_rtype'=> __( 'Choose Listing type',  'easybook-add-ons' ),

                    'faq_title'  => __( 'Question',  'easybook-add-ons' ),
                    'faq_content'  => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',  'easybook-add-ons' ),
                    'btn_add_Faq'  => __( 'Add FAQ','easybook-add-ons' ),

                    'btn_add_S'  => __( 'Add Social +',  'easybook-add-ons' ),
                    'btn_add_R'  => __( 'Add Room +',  'easybook-add-ons' ),
                    'btn_add_Ame'  => __( 'Add Amenitie +',  'easybook-add-ons' ),

                    'image_upload'  => __( ' Click here to upload',  'easybook-add-ons' ),
                    // 'select_images'  => __( 'Select Images',  'easybook-add-ons' ),
                    // 'select'  => __( 'Select',  'easybook-add-ons' ),
                    'btn_add_S'  => __( 'Add Social +',  'easybook-add-ons' ),
                    'btn_add_S'  => __( 'Add Social +',  'easybook-add-ons' ),
                    'btn_save_c' => __( 'Save Changes',  'easybook-add-ons' ),
                    'btn_close'  => __( 'Close me',  'easybook-add-ons' ),
                    'btn_send'   => __( 'Send Listing',  'easybook-add-ons' ),
                     'calendar_dis_number'  => __( 'Select the number of months displayed.',  'easybook-add-ons' ),
                    'calendar_number_one'  => __( 'One Months',  'easybook-add-ons' ),
                    'calendar_number_two'  => __( 'Two Months',  'easybook-add-ons' ),
                    'calendar_number_three'  => __( 'Three Months',  'easybook-add-ons' ),
                    'calendar_number_four'  => __( 'Four Months',  'easybook-add-ons' ),
                    'calendar_number_five'  => __( 'Five Months',  'easybook-add-ons' ),
                    'calendar_number_six'  => __( 'Six Months',  'easybook-add-ons' ),
                    'calendar_number_seven'  => __( 'Seven Months',  'easybook-add-ons' ),

                    'coupon_code'           => __( 'Coupon code',  'easybook-add-ons' ),
                    'coupon_discount'       => __( 'Discount type',  'easybook-add-ons' ),
                    'coupon_percentage'           => __( 'Percentage discount',  'easybook-add-ons' ),
                    'coupon_fix_cart'           => __( 'Fixed cart discount',  'easybook-add-ons' ),
                    'coupon_desc'           => __( 'Description',  'easybook-add-ons' ),
                    'coupon_show'           => __( 'Display content in widget banner?',  'easybook-add-ons' ),
                    'coupon_amount'           => __( 'Discount amount',  'easybook-add-ons' ),
                    'coupon_qtt'           => __( 'Coupon quantity',  'easybook-add-ons' ),
                    'coupon_expiry'           => __( 'Coupon expiry date',  'easybook-add-ons' ),
                    'coupon_format'           => __( 'Format:YY-mm-dd HH:ii:ss',  'easybook-add-ons' ),


                    'bt_coupon'           => __( 'Add Coupon',  'easybook-add-ons' ),
                    'bt_services'           => __( 'Add Service',  'easybook-add-ons' ),
                    'services_name'           => __( 'Service Name',  'easybook-add-ons' ),
                    'services_desc'           => __( 'Description',  'easybook-add-ons' ),
                    'services_price'           => __( 'Service Price',  'easybook-add-ons' ),
                    'bt_member'           => __( 'Add Member',  'easybook-add-ons' ),
                    'member_name'           => __( 'Name: ',  'easybook-add-ons' ),
                    'member_job'           => __( 'Job or Position: ',  'easybook-add-ons' ),
                    'member_desc'           => __( 'Description',  'easybook-add-ons' ),
                    'member_img'           => __( 'Image',  'easybook-add-ons' ),
                    'memeber_social'           => __( 'Socials',  'easybook-add-ons' ),
                   
                    'days' => array(
                        _x( 'Sun', 'calendar', 'easybook-add-ons' ),
                        _x( 'Mon', 'calendar', 'easybook-add-ons' ),
                        _x( 'Tue', 'calendar', 'easybook-add-ons' ),
                        _x( 'Wed', 'calendar', 'easybook-add-ons' ),
                        _x( 'Thu', 'calendar', 'easybook-add-ons' ),
                        _x( 'Fri', 'calendar', 'easybook-add-ons' ),
                        _x( 'Sat', 'calendar', 'easybook-add-ons' ),
                    ),
                    'months' => array(
                        _x( 'January', 'calendar', 'easybook-add-ons' ),
                        _x( 'February', 'calendar', 'easybook-add-ons' ),
                        _x( 'March', 'calendar', 'easybook-add-ons' ),
                        _x( 'April', 'calendar', 'easybook-add-ons' ),
                        _x( 'May', 'calendar', 'easybook-add-ons' ),
                        _x( 'June', 'calendar', 'easybook-add-ons' ),
                        _x( 'July', 'calendar', 'easybook-add-ons' ),
                        _x( 'August', 'calendar', 'easybook-add-ons' ),
                        _x( 'September', 'calendar', 'easybook-add-ons' ),
                        _x( 'October', 'calendar', 'easybook-add-ons' ),
                        _x( 'November', 'calendar', 'easybook-add-ons' ),
                        _x( 'December', 'calendar', 'easybook-add-ons' ),
                    ),

                    'ltype_title'       => _x( 'Listing type', 'Listing type', 'easybook-add-ons' ),
                    'ltype_desc'       => _x( 'Listing type description', 'Listing type', 'easybook-add-ons' ),
                    'wkh_enter'       => _x( 'Enter Hours', 'Working hour', 'easybook-add-ons' ),
                    'wkh_open'       => _x( 'Open all day', 'Working hour', 'easybook-add-ons' ),
                    'wkh_close'       => _x( 'Close all day', 'Working hour', 'easybook-add-ons' ),
                    'calen_lock'       => _x( 'Lock this month', 'Calendar', 'easybook-add-ons' ),
                    'calen_unlock'       => _x( 'Unlock this month', 'Calendar', 'easybook-add-ons' ),

                    'cancel' => __( 'Cancel' , 'easybook-add-ons' ),
                    'submit' => __( 'Submit' , 'easybook-add-ons' ),

                    'save'    => __( 'Save', 'easybook-add-ons' ),
                    'cal_event_start'    => __( 'Event start time: ', 'easybook-add-ons' ),
                    'cal_event_end'    => __( 'Event end date: ', 'easybook-add-ons' ),
                    'cal_opts'    => __( 'Options', 'easybook-add-ons' ),

                    'bt_slots'       => __( 'Add Time Slot', 'easybook-add-ons' ),
                    'slot_time'       => __( 'Time', 'easybook-add-ons' ),
                    'slot_guests'       => __( 'Guests', 'easybook-add-ons' ),
                    'slot_available'       => __( 'Available slots', 'easybook-add-ons' ),
                    

                )

            );
            wp_localize_script( 'easybook-react-adminapp', '_easybook_add_ons', $_easybook_add_ons );

            if( function_exists('wp_set_script_translations') ) wp_set_script_translations( 'easybook-react-adminapp', 'easybook-add-ons' );
            //========================
        }
        if($hook != 'settings_page_easybook-addons') {
            return;
        }
        
        wp_enqueue_script('easybook_addons_image', self::$plugin_url . 'inc/assets/upload_file.js', array('jquery'), null, true);
        // wp_enqueue_style( 'custom_wp_admin_css', plugins_url('admin-style.css', __FILE__) );
        wp_enqueue_script('select2', self::$plugin_url . 'assets/js/select2.min.js', array('jquery'), null, true);
        wp_enqueue_script('easybook-add-ons-options', self::$plugin_url . 'assets/js/addons-options.js', array('select2'), null, true);
    }

}

Esb_Class_Admin_Scripts::init();