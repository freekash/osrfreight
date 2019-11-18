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

class Esb_Class_Frontend_Scripts {

    private static $plugin_url;

    public static function init(){
        self::$plugin_url = plugin_dir_url(ESB_PLUGIN_FILE);    

        add_action( 'wp_enqueue_scripts', array(get_called_class(), 'enqueue_scripts') );       
        // withdrawal
        // earning - user meta
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
        

    }

    public static function enqueue_scripts(){
        global $wp_query;
        // global $post;

        wp_enqueue_style( 'select2' , self::$plugin_url ."assets/css/select2.min.css", false ); 
        // wp_enqueue_style( 'jscrollpane' , self::$plugin_url ."assets/css/jquery.jscrollpane.css", false ); 
        wp_enqueue_style( 'fontawesome' , self::$plugin_url ."assets/vendors/fontawesome/css/all.min.css", false ); 
        wp_enqueue_style( 'datetimepicker.jquery', self::$plugin_url .'assets/admin/datetimepicker/jquery.datetimepicker.min.css' );
        wp_enqueue_style( 'plugins-css' , self::$plugin_url ."assets/css/plugins.css", false ); 
        wp_enqueue_style( 'easybook-addons' , self::$plugin_url ."assets/css/easybook-add-ons.min.css", false ); 
        wp_enqueue_style( 'owl-carousel-css' , self::$plugin_url ."assets/css/owl.carousel.min.css", false );
        wp_enqueue_style( 'owl-carousel-default' , self::$plugin_url ."assets/css/owl.theme.default.min.css", false );
        

        if(easybook_addons_get_option('azp_css_external') == 'yes'){
            $upload = wp_upload_dir();
            $upload_url = $upload['baseurl'];
            wp_enqueue_style( 'listing_types' , $upload_url ."/azp/css/listing_types.css", false ); 
        }else{
            $azp_csses = Esb_Class_Listing_Type_CPT::get_azp_css();
            wp_add_inline_style( 'easybook-addons', $azp_csses ); 
        }
        
        // wp_enqueue_script( 'backbone.marionette', self::$plugin_url ."assets/js/backbone.marionette.min.js" , array('jquery','backbone','underscore'), null , true );
        // wp_enqueue_script( 'jquery.selectbox', self::$plugin_url ."assets/js/jquery.selectbox.min.js" , array(), null , true );
        wp_enqueue_script( 'select2', self::$plugin_url ."assets/js/select2.min.js" , array('jquery'), null , true );
        // wp_enqueue_script( 'mousewheel', self::$plugin_url ."assets/js/jquery.mousewheel.js" , array(), null , true );
        // wp_enqueue_script( 'jscrollpane', self::$plugin_url ."assets/js/jquery.jscrollpane.min.js" , array(), null , true );
        // 
        wp_enqueue_script( 'plugin-js', self::$plugin_url ."assets/js/plugins.js" , array(), null , true );
        wp_enqueue_script( 'owl-carousel', self::$plugin_url ."assets/js/owl.carousel.min.js" , array(), null , true );
        wp_enqueue_script('datetimepicker.jquery', self::$plugin_url . 'assets/admin/datetimepicker/jquery.datetimepicker.full.min.js', array('jquery'), null, true);
        
        
        

        if(easybook_addons_get_option('use_osm_map')=='yes'){
            wp_enqueue_style( 'openlayers' , self::$plugin_url ."assets/css/ol.css", false ); 
            wp_enqueue_script( 'openlayers', self::$plugin_url ."assets/js/ol.js" , array(), null , true );
        }else{
            $gmap_api_key = easybook_addons_get_option('gmap_api_key');
            $google_map_language = easybook_addons_get_option('google_map_language')? '&language='.easybook_addons_get_option('google_map_language') : '';

            wp_enqueue_script("googleapis", "https://maps.googleapis.com/maps/api/js?key=$gmap_api_key&libraries=places$google_map_language",array(),false,true);
            wp_enqueue_script( 'infobox', self::$plugin_url ."assets/js/infobox.js" , array('googleapis'), null , true );
            wp_enqueue_script( 'markerclusterer', self::$plugin_url ."assets/js/markerclusterer.min.js" , array('googleapis'), null , true );
            wp_enqueue_script( 'oms', self::$plugin_url ."assets/js/oms.min.js" , array(), null , true );
        }

        
        if( easybook_addons_must_enqueue_media() ) wp_enqueue_media();

        

        wp_enqueue_script( 'chart.js', self::$plugin_url ."assets/js/Chart.js" , array(), null , true );

        wp_enqueue_script( 'easybook-addons', self::$plugin_url ."assets/js/easybook-add-ons.min.js" , array('wp-i18n', 'underscore','masonry','jquery-ui-sortable'), null , true );

        // AIzaSyChCXNJOoVajjJ1KvF3g0kq63yb5KQLPMA

        // wp_enqueue_script( 'easybook-app', self::$plugin_url ."assets/js/easybook-app.js" , array('backbone.marionette','jquery.selectbox','easybook-gmap'), null , true );

        $curr_user_data = array(
            'id'                => 0,
            'display_name'      =>'',
            'avatar'            => '',
            'can_upload'        => false,

            'role'              => false,
            'is_author'         => false,
        );

        if(is_user_logged_in()){
            $current_user = wp_get_current_user();
            $curr_user_data = array(
                'id'                    => $current_user->ID,
                'display_name'          => $current_user->display_name,
                'avatar'                => get_avatar($current_user->user_email,'150','https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=150', $current_user->display_name ),

                'can_upload'            => current_user_can('upload_files'),
                'role'                  => easybook_addons_get_user_role(),
                'is_author'             => Esb_Class_Membership::is_author(),
            );
        }


        $gmap_marker = easybook_addons_get_option('gmap_marker');
        // $listing_type_ids = array();
        // // $listing_type_opts = array();
        // $listing_types_posts = get_posts( array(
        //     'post_type'         => 'listing_type',
        //     'posts_per_page'    => -1,
        //     'post_status'       => 'publish',
        // ) );
        // if($listing_types_posts){
        //     foreach ($listing_types_posts as $ltype) {
        //         $listing_type_ids[] = $ltype->ID;
        //         // $listing_type_opts[] = array(
        //         //     'ID'                => $ltype->ID,
        //         //     'title'             => get_the_title( $ltype ),
        //         //     'icon'              => '',
        //         //     'description'       => '',
        //         // );
        //     }
        // }

        $checkout_page_id = easybook_addons_get_option('checkout_page');
        // $image_logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
        $image_logo = easybook_addons_get_option('invoice_logo');
        $_easybook_add_ons = array(
            'url'           => esc_url(admin_url( 'admin-ajax.php' ) ),
            'nonce'         => wp_create_nonce( 'easybook-add-ons' ),
            'posted_on'     => __('Posted on ','easybook-add-ons'),
            'reply'         => __('Reply','easybook-add-ons'),
            'retweet'       => __('Retweet','easybook-add-ons'),
            'favorite'      => __('Favorite','easybook-add-ons'),
            'pl_w'          => __('Please wait...','easybook-add-ons'),
            'like'          => esc_html__( 'Like', 'easybook-add-ons' ),
            'unlike'        => esc_html__( 'Unlike', 'easybook-add-ons' ),
            'marker'        => $gmap_marker['id']? wp_get_attachment_url( $gmap_marker['id'] ) : self::$plugin_url ."assets/images/marker2.png",
            'center_lat'    => floatval(easybook_addons_get_option('gmap_default_lat')),
            'center_lng'    => floatval(easybook_addons_get_option('gmap_default_long')),
            'map_zoom'      => easybook_addons_get_option('gmap_default_zoom'),
            'free_map'      => easybook_addons_get_option('use_osm_map'),
            'gmap_type'     => easybook_addons_get_option('gmap_type'),
            'socials'       => easybook_addons_get_socials_list(),
            // 'logo'          => esc_url( $image_logo[0] ),
            'logo'          => esc_url( easybook_addons_get_attachment_thumb_link($image_logo['id'],'bg-image') ),
            'info'          => easybook_addons_get_option('invoice_author'),

            'login_delay'     => easybook_addons_get_option('login_delay'),
            // 'coupon_type'   => easybook_addons_get_coupon_type(get_queried_object_id()),

            

            // for ajax search
            // 'is_search'     => is_search(),
            // 'is_tax_cat'    => is_tax('listing_cat'),
            // 'is_tax_loc'    => is_tax('listing_location'),
            // 'is_tax_fea'    => is_tax('listing_feature'),
            // 'query_vars'    =>  $wp_query->query_vars ,

            'location_type' => easybook_addons_get_option('listing_location_result_type'),
            'address_format'   => array_filter( explode(",", easybook_addons_get_option('listing_address_format') ) ),
            'country_restrictions' => easybook_addons_get_option('country_restrictions'),

            'disable_bubble'    => easybook_addons_get_option('disable_bubble', 'no'), 

            // 'filter_subcats'    => easybook_addons_get_option('search_load_subcat'), 

            'lb_approved'       => __( 'Approved', 'easybook-add-ons' ),

            // 'lb_24h'            => easybook_addons_get_option('booking_clock_24h') == 'yes'? true: false,
            // 'td_color'          => easybook_addons_get_option('time_picker_color'), 
            // 'lb_delay'          => easybook_addons_get_option('add_cart_delay'), 
            'md_limit'          => easybook_addons_get_option('submit_media_limit'), 
            'md_limit_msg'      => sprintf(__( 'Max upload files is %s', 'easybook-add-ons' ), easybook_addons_get_option('submit_media_limit') ), 
            'md_limit_size'     => easybook_addons_get_option('submit_media_limit_size'), 
            'md_limit_size_msg' => sprintf(__( 'Max upload file size is %s MB', 'easybook-add-ons' ), easybook_addons_get_option('submit_media_limit_size') ), 

            'search'            => __( 'Search...', 'easybook-add-ons' ),

            'gcaptcha'          => ( easybook_addons_get_option('enable_g_recaptcah') == 'yes' && easybook_addons_get_option('g_recaptcha_site_key') != '' )? true: false,
            'gcaptcha_key'      => easybook_addons_get_option('g_recaptcha_site_key'),

            
            'weather_strings'   => array(
                'days' => array(
                    _x( 'Sunday', 'weather widget', 'easybook-add-ons' ),
                    _x( 'Monday', 'weather widget', 'easybook-add-ons' ),
                    _x( 'Tuesday', 'weather widget', 'easybook-add-ons' ),
                    _x( 'Wednesday', 'weather widget', 'easybook-add-ons' ),
                    _x( 'Thursday', 'weather widget', 'easybook-add-ons' ),
                    _x( 'Friday', 'weather widget', 'easybook-add-ons' ),
                    _x( 'Saturday', 'weather widget', 'easybook-add-ons' ),
                ),
                'min'   => _x( 'Min', 'weather widget', 'easybook-add-ons' ),
                'max'   => _x( 'Max', 'weather widget', 'easybook-add-ons' ),
                'direction' => array(
                    _x( 'N', 'wind direction', 'easybook-add-ons' ),
                    _x( 'NNE', 'wind direction', 'easybook-add-ons' ),
                    _x( 'NE', 'wind direction', 'easybook-add-ons' ),
                    _x( 'ENE', 'wind direction', 'easybook-add-ons' ),
                    _x( 'E', 'wind direction', 'easybook-add-ons' ),
                    _x( 'ESE', 'wind direction', 'easybook-add-ons' ),
                    _x( 'SE', 'wind direction', 'easybook-add-ons' ),
                    _x( 'SSE', 'wind direction', 'easybook-add-ons' ),
                    _x( 'S', 'wind direction', 'easybook-add-ons' ),
                    _x( 'SSW', 'wind direction', 'easybook-add-ons' ),
                    _x( 'SW', 'wind direction', 'easybook-add-ons' ),
                    _x( 'WSW', 'wind direction', 'easybook-add-ons' ),
                    _x( 'W', 'wind direction', 'easybook-add-ons' ),
                    _x( 'WNW', 'wind direction', 'easybook-add-ons' ),
                    _x( 'NW', 'wind direction', 'easybook-add-ons' ),
                    _x( 'NNW', 'wind direction', 'easybook-add-ons' ),
                ),
            ),
            'i18n'          => array(
                'del-listing'               => __( "Are you sure want to delete {{listing_title}} listing and its data?\nThe listing is permanently deleted.", 'easybook-add-ons' ),
                'cancel-booking'            => __( "Are you sure want to cancel {{booking_title}} booking?", 'easybook-add-ons' ),
                'approve-booking'           => __( "Are you sure want to approve {{booking_title}} booking?", 'easybook-add-ons' ),
                'del-booking'               => __( "Are you sure want to delete {{booking_title}} booking and its data?\nThe booking is permanently deleted.", 'easybook-add-ons' ),
                'del-message'               => __( "Are you sure want to cancel {{message_title}} message?", 'easybook-add-ons' ),
                       'btn_save_c'         => __( 'Save Changes',  'easybook-add-ons' ),
                'btn_close'                 => __( 'Close me',  'easybook-add-ons' ),
                'btn_send'                  => __( 'Send Listing',  'easybook-add-ons' ),
                'btn_add_F'                 => __( 'Add Fact +',  'easybook-add-ons' ),
                'fact_title'                => __( 'Fact Title',  'easybook-add-ons' ),
                'fact_number'               => __( 'Fact Number',  'easybook-add-ons' ),
                'fact_icon'                 => __( 'Fact Icon',  'easybook-add-ons' ),
                'faq_title'                 => __( 'Question',  'easybook-add-ons' ),
                'faq_content'               => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',  'easybook-add-ons' ),
                'btn_add_Faq'               => __( 'Add FAQ','easybook-add-ons' ),
                'btn_add_S'                 => __( 'Add Social +',  'easybook-add-ons' ),
                'btn_add_R'                 => __( 'Add Room +',  'easybook-add-ons' ),
                'btn_add_Ame'               => __( 'Add Amenitie +',  'easybook-add-ons' ),
                'chat_fr_owner'             => __( 'Chat With Owner',  'easybook-add-ons' ),
                'chat_fr_login'             => __( 'Login to chat',  'easybook-add-ons' ),
                'chat_fr_cwith'             => __( 'You is chatting with  ',  'easybook-add-ons' ),
                'chat_fr_conver'             => __( 'Conversation list',  'easybook-add-ons' ),
                'image_upload'              => __( ' Click here to upload',  'easybook-add-ons' ),
                'location_country'          =>  __( 'Country',  'easybook-add-ons' ),
                'location_state'            => __( 'State',  'easybook-add-ons' ),
                'location_city'             =>  __( 'City',  'easybook-add-ons' ),

                'book_dates'             =>  __( 'Dates',  'easybook-add-ons' ),
                'book_services'             =>  __( 'Extra Services',  'easybook-add-ons' ),
                'book_ad'             =>  __( 'ADULTS',  'easybook-add-ons' ),
                'book_chi'             =>  __( 'CHILDREN',  'easybook-add-ons' ),
                'book_avr'             =>  __( 'Available Rooms',  'easybook-add-ons' ),
                'book_ts'             =>  __( 'Total Cost',  'easybook-add-ons' ),
                'book_chev'             =>  __( 'Check availability',  'easybook-add-ons' ),
                'book_bn'             =>  __( 'Book Now',  'easybook-add-ons' ),
                'checkout_can'             =>  __( 'Cancel',  'easybook-add-ons' ),
                'checkout_app'             =>  __( 'Apply',  'easybook-add-ons' ),
                'roomsl_avai'             =>  __( 'Available:',  'easybook-add-ons' ),
                'roomsl_maxg'             =>  __( 'Max Guests: ',  'easybook-add-ons' ),
                'roomsl_quan'             =>  __( 'Quantity',  'easybook-add-ons' ),

                // 'select_images'  => __( 'Select Images',  'easybook-add-ons' ),
                // 'select'  => __( 'Select',  'easybook-add-ons' ),
                'btn_add_S'  => __( 'Add Social +',  'easybook-add-ons' ),
                'btn_add_S'  => __( 'Add Social +',  'easybook-add-ons' ),
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
                'coupon_format'           => __( 'Format: YYYY-MM-DD HH:MM:SS',  'easybook-add-ons' ),

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
                'bk_services'           => __( 'Services: ',  'easybook-add-ons' ),

               
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

                'submit' => __( 'Submit' , 'easybook-add-ons' ),

                'ltype_title'       => _x( 'Listing type', 'Listing type', 'easybook-add-ons' ),
                'ltype_desc'       => _x( 'Listing type description', 'Listing type', 'easybook-add-ons' ),
                'wkh_enter'       => _x( 'Enter Hours', 'Working hour', 'easybook-add-ons' ),
                'wkh_open'       => _x( 'Open all day', 'Working hour', 'easybook-add-ons' ),
                'wkh_close'       => _x( 'Close all day', 'Working hour', 'easybook-add-ons' ),
                'calen_lock'       => _x( 'Lock this month', 'Calendar', 'easybook-add-ons' ),
                'calen_unlock'       => _x( 'Unlock this month', 'Calendar', 'easybook-add-ons' ),


                'chat_type_msg'    => __( 'Type Message', 'easybook-add-ons' ),
                'save'    => __( 'Save', 'easybook-add-ons' ),
                'cancel' => __( 'Cancel' , 'easybook-add-ons' ),
                'cal_event_start'    => __( 'Event start time: ', 'easybook-add-ons' ),
                'cal_event_end'    => __( 'Event end date: ', 'easybook-add-ons' ),
                'cal_opts'    => __( 'Options', 'easybook-add-ons' ),

                'wth_payments'       => __( 'PayPal / Stripe Email', 'easybook-add-ons' ),
                'wth_amount'       => __( 'Amount ', 'easybook-add-ons' ),
                'wth_plh_email'       => __( 'email@gmail.com', 'easybook-add-ons' ),
                'wth_acount_balance'       => __( 'Account Balance', 'easybook-add-ons' ),
                'wth_will_process'       => __( 'Your request will be processed on ', 'easybook-add-ons' ),
                'wth_no_request'       => __( 'You have no withdrawal request', 'easybook-add-ons' ),

                'bt_slots'       => __( 'Add Time Slot', 'easybook-add-ons' ),
                'slot_time'       => __( 'Time', 'easybook-add-ons' ),
                'slot_guests'       => __( 'Guests', 'easybook-add-ons' ),
                'slot_available'       => __( 'Available slots', 'easybook-add-ons' ),

                'preview_btn'           => __( 'Preview', 'easybook-add-ons' ),
                'wdfunds'           => __( 'Withdraw Funds', 'easybook-add-ons' ),

                'your_listings'           => __( 'Your Listings', 'easybook-add-ons' ),
                'pending_listings'           => __( 'Pending Listings', 'easybook-add-ons' ),
                'no_listings'           => __( 'You have no listing', 'easybook-add-ons' ),
                
            ),
            'curr_user'                     => $curr_user_data,


            // 'listing_types'                 => $listing_type_ids,
            // 'listing_type_opts'             => $listing_type_opts,
            'listing_type_opts'             => Esb_Class_Membership::author_listing_types(),

            

            // for listing booking
            'post_id'                       => get_queried_object_id(),
            'ckot_url'                      => esc_url(get_permalink($checkout_page_id)),

            'currency'                      => easybook_addons_get_currency_attrs(),
            'base_currency'                 => easybook_addons_get_base_currency(),

            'chatbox_message'               => easybook_addons_get_option('chatbox_message'), 
            'ajax_search_chage'             => easybook_addons_get_option('ajax_search_chage') == 'yes' ? true : false, 

            // 'wpeditor'                      => easybook_addons_get_wp_editor(),

        );
        // if(is_singular('listing')){
        //     $_easybook_add_ons['slid'] = 
        // }
        wp_localize_script( 'easybook-addons', '_easybook_add_ons', $_easybook_add_ons );

        if( function_exists('wp_set_script_translations') ) wp_set_script_translations( 'easybook-addons', 'easybook-add-ons' );

        if( easybook_addons_must_enqueue_editor() )  wp_enqueue_editor();
        
        self::enqueue_react_libraries();

        // echo '<pre>';

        // var_dump( easybook_addons_get_listing_type_fields_meta() );


        $_easybook_dashboard = array(
            'current_url'       => easybook_addons_get_current_url(),
            'dashboard_url'     => get_permalink( easybook_addons_get_option('dashboard_page') ),
            'locations'         =>   easybook_addons_get_listing_locations(),
            'author'            => easybook_addons_author_profile(),
            // 'review'            => easybook_addons_review(),
            'update_status'     => easybook_addons_update_status(),
            'socials'           => easybook_addons_get_socials_list(),
            'files'             => easybook_addons_cont_fiels_select(),
            'feature'           => easybook_addons_get_listing_features(),
            'rooms'             => easybook_addons_get_rooms_type_fields_obj(),

            'posts_per_page'    => get_option( 'posts_per_page' ),

            'plans'             => easybook_addons_get_current_subscription(), 
            // 'yourPlan'          => easybook_addons_listing_plans(),
            'roles'             => easybook_addons_get_user_role(), 
            'add_listing_url'   => easybook_addons_add_listing_url(),
            'payment'           => easybook_addons_get_payment_methods(),
            'db_hide_messages'  => easybook_addons_get_option('db_hide_messages'),
            'db_hide_bookings'  => easybook_addons_get_option('db_hide_bookings'), 
            'db_hide_reviews'   => easybook_addons_get_option('db_hide_reviews'),
            'db_hide_invoices'   => easybook_addons_get_option('db_hide_invoices'),
            'db_hide_withdrawals' => easybook_addons_get_option('db_hide_withdrawals'),

            'location_show_state'       => easybook_addons_get_option('location_show_state'),

            'i18n' => array(
                'breadcrumbs_home'     => __( 'Home',  'easybook-add-ons' ),
                'before_breadcrumbs_current'  => __( 'Dashboard',  'easybook-add-ons' ),
                'breadcrumbs_current'  => __( 'Profile page',  'easybook-add-ons' ),

                'tab_name'             => __( 'Dashboard Menu ',  'easybook-add-ons' ),
                'tab_profile'          => __( 'Dashboard',  'easybook-add-ons' ),
                'tab_pro_edit'         => __( 'Edit Profile ',  'easybook-add-ons' ),
                'tab_pro_change_pass'  => __( 'Change Password',  'easybook-add-ons' ),
                'tab_chats'            => __( ' Chats ',  'easybook-add-ons' ),
                'tab_listings'         => __( ' My listings',  'easybook-add-ons' ),
                'tab_lis_pending'      => __( 'Pending',  'easybook-add-ons' ),
                'tab_lis_expire'       => __( 'Expire',  'easybook-add-ons' ),
                'tab_lis_add'          => __( 'Add Listing',  'easybook-add-ons' ),
                'tab_bookings'         => __( ' Bookings ',  'easybook-add-ons' ),
                'tab_reviews'          => __( ' Comments ',  'easybook-add-ons' ),
                'tab_rew_your_rew'     => __( 'Comments for you',  'easybook-add-ons' ),
                'tab_add_liss'         => __( ' Add Listings ',  'easybook-add-ons' ),
                'tab_add_room'         => __( ' Add Room ',  'easybook-add-ons' ),
                'tab_invoices'         => __( 'Invoices',  'easybook-add-ons' ),
                'tab_withdrawals'         => __( 'Withdrawals',  'easybook-add-ons' ),

                'das_h3_recent'        => __( 'Recent Activities',  'easybook-add-ons' ),
                'das_p_recent'         => __( 'You have no activity',  'easybook-add-ons' ),

                'chats_h3'             => __( 'Inbox',  'easybook-add-ons' ),
                'change_pas_h3'        => __( ' Change Password',  'easybook-add-ons' ),
                'change_pas_lb_CP'     => __( 'Current Password',  'easybook-add-ons' ),
                'change_pas_lb_NP'     => __( 'New Password',  'easybook-add-ons' ),
                'change_pas_lb_CNP'    => __( 'Confirm New Password',  'easybook-add-ons' ),

                'inner_chat_op_W'      => __( 'Week',  'easybook-add-ons' ),
                'inner_chat_op_M'      => __( 'Month',  'easybook-add-ons' ),
                'inner_chat_op_Y'      => __( 'Year',  'easybook-add-ons' ),
                'chart_alltime'        => __( 'All time', 'easybook-add-ons' ),
                'chart_views_lbl'      => __( 'Listing Views', 'easybook-add-ons' ),
                'chart_earnings_lbl'   => __( 'Earnings', 'easybook-add-ons' ),



                'inner_listing_li_E'   => __( 'Edit ',  'easybook-add-ons' ),
                'inner_listing_li_D'   => __( 'Delete ',  'easybook-add-ons' ),

                'author_review_h3'     => __( 'Comments for your listings',  'easybook-add-ons' ),

                'likebtn'   => __( 'Like Button',  'easybook-add-ons' ),
                'welcome'   => __( 'Welcome',  'easybook-add-ons' ),
                'listings'  => __( 'Listings',  'easybook-add-ons' ),
                'bookings'  => __( 'Bookings',  'easybook-add-ons' ),
                'reviews'   => __( 'Commnents',  'easybook-add-ons' ),
                'log_out'   => __( 'Log Out ',  'easybook-add-ons' ),

                'profile_h3_profile' => __( ' Your Profile',  'easybook-add-ons' ),
                'profile_h3_plan'    => __( 'Your  Tariff Plan',  'easybook-add-ons' ),
                'profile_h3_social'  => __( 'Your  Socials',  'easybook-add-ons' ),

                'profile_lb_FN'      => __( 'First Name ',  'easybook-add-ons' ),
                'profile_lb_LN'      => __( 'Last Name ',  'easybook-add-ons' ),
                'profile_lb_DN'      => __( 'Display Name ',  'easybook-add-ons' ),
                'profile_lb_P'       => __( 'Phone',  'easybook-add-ons' ),
                'profile_lb_A'       => __( ' Adress ',  'easybook-add-ons' ),
                'profile_lb_W'       => __( ' Website ',  'easybook-add-ons' ),
                'profile_lb_N'       => __( ' Notes',  'easybook-add-ons' ),
                'profile_lb_CA'      => __( 'Change Avatar',  'easybook-add-ons' ),
                'profile_lb_EM'      => __( 'Contact Email',  'easybook-add-ons' ),
                'profile_lb_CE'      => __( 'Registered Email',  'easybook-add-ons' ),



                'planmenu_span'      => __( 'Tariff Plan : ',  'easybook-add-ons' ),
                'planmenu_a'         => __( 'Extended',  'easybook-add-ons' ),
                'planmenu_p_before'  => __( 'You Are on ',  'easybook-add-ons' ),
                'planmenu_p_after'   => __( ' . Use link bellow to view details or upgrade. ',  'easybook-add-ons' ),
                'planmenu_a_btn'     => __( 'Details',  'easybook-add-ons' ),

                'sidebar_a'          => __( 'Add Listing',  'easybook-add-ons' ), 
                
                'review_h3'  => __( 'Your Comments',  'easybook-add-ons' ),
                'review_p'   => __( 'You have no comment',  'easybook-add-ons' ),
                'invoices_h3'  => __( 'Invoices',  'easybook-add-ons' ),
                'invoices_p'   => __( 'You have no invoice yet!',  'easybook-add-ons' ),
                'invoices_t'   => __( 'Title',  'easybook-add-ons' ),
                'invoices_pl'   => __( 'Plan',  'easybook-add-ons' ),
                'invoices_d'   => __( 'Date',  'easybook-add-ons' ),
                'invoices_e'   => __( 'End',  'easybook-add-ons' ),
                'invoices_am'   => __( 'Amount',  'easybook-add-ons' ),
                'invoices_ac'   => __( 'Action',  'easybook-add-ons' ),
                'invoices_vi'   => __( 'View',  'easybook-add-ons' ), 
                'invoices_cr'   => __( 'Created:',  'easybook-add-ons' ),
                'invoices_pm'   => __( 'Payment Method',  'easybook-add-ons' ),
                'invoices_ck'   => __( 'Check #',  'easybook-add-ons' ),
                'invoices_cke'   => __( ' Check ',  'easybook-add-ons' ),
                'invoices_op'   => __( 'Option',  'easybook-add-ons' ),
                'invoices_det'   => __( 'Details',  'easybook-add-ons' ),
                'invoices_tot'   => __( 'Total: ',  'easybook-add-ons' ),
                'invoices_print'   => __( 'Print this invoice',  'easybook-add-ons' ),

                'btn_save_c' => __( 'Save Changes',  'easybook-add-ons' ),
                'btn_close'  => __( 'Close me',  'easybook-add-ons' ),
                'btn_send'   => __( 'Send Listing',  'easybook-add-ons' ),
                
                'btn_add_F'  => __( 'Add Fact +',  'easybook-add-ons' ),
                'fact_title'  => __( 'Fact Title',  'easybook-add-ons' ),
                'fact_number'  => __( 'Fact Number',  'easybook-add-ons' ),
                'fact_icon'  => __( 'Fact Icon',  'easybook-add-ons' ),


                'faq_title'  => __( 'Question',  'easybook-add-ons' ),
                'faq_content'  => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',  'easybook-add-ons' ),
                'btn_add_Faq'  => __( 'Add FAQ','easybook-add-ons' ),

                'btn_add_S'  => __( 'Add Social +',  'easybook-add-ons' ),
                'btn_add_R'  => __( 'Add Room +',  'easybook-add-ons' ),

                'image_upload'  => __( ' Click here to upload',  'easybook-add-ons' ),
                'booking_title'  => __( 'Listing Item :',  'easybook-add-ons' ),
                'booking_person'  => __( 'Persons :',  'easybook-add-ons' ),
                'booking_person_sub'  => __( 'Peoples',  'easybook-add-ons' ),
                'booking_date'  => __( 'Booking Date :',  'easybook-add-ons' ),
                'booking_mail'  => __( 'Mail :',  'easybook-add-ons' ),
                'booking_phone'  => __( 'Phone :',  'easybook-add-ons' ),
                'booking_pay'  => __( 'Payment State :',  'easybook-add-ons' ),
                'booking_pay_sub1'  => __( 'Paid',  'easybook-add-ons' ),
                'booking_pay_sub2'  => __( '  using ',  'easybook-add-ons' ),
                'booking_approved'  => __( 'Approved',  'easybook-add-ons' ),
                'booking_cancel'  => __( 'Cancel',  'easybook-add-ons' ),
                'booking_canceled'  => __( 'Canceled',  'easybook-add-ons' ),
                'booking_approve'  => __( 'Approve',  'easybook-add-ons' ),
                'booking_delete'  => __( 'Delete',  'easybook-add-ons' ),
                'booking_tickets'  => __( 'Tickets: ',  'easybook-add-ons' ),
                'booking_date_event'  => __( 'Date Event: ',  'easybook-add-ons' ),

                'bt_continue'  => __( 'Continue',  'easybook-add-ons' ),
                'bt_balance'  => __( ' Keep my balance',  'easybook-add-ons' ),
                'review_on'  => __( ' on ',  'easybook-add-ons' ),
                'no_ltype'  => __( 'There is no listing type. Please contact to site owner for more details.',  'easybook-add-ons' ),
                'tab_withdrawals'  => __( 'Withdrawals',  'easybook-add-ons' ),
                'tab_book_listing'  => __( 'Listing',  'easybook-add-ons' ),
                'btn_send'  => __( 'Send',  'easybook-add-ons' ),

                'th_mount'  => __( 'Amount',  'easybook-add-ons' ),
                'th_method'  => __( 'Method',  'easybook-add-ons' ),
                'th_to'  => __( 'To',  'easybook-add-ons' ),
                'th_date'  => __( 'Date Submitted',  'easybook-add-ons' ),
                'th_status'  => __( 'Status',  'easybook-add-ons' ),



                // 'select_images'  => __( 'Select Images',  'easybook-add-ons' ),
                // 'select'  => __( 'Select',  'easybook-add-ons' ),
                'btn_add_S'  => __( 'Add Social +',  'easybook-add-ons' ),
                'btn_add_S'  => __( 'Add Social +',  'easybook-add-ons' ),
                 'calendar_dis_number'  => __( 'Select the number of months displayed.',  'easybook-add-ons' ),
                'calendar_number_one'  => __( 'One Months',  'easybook-add-ons' ),
                'calendar_number_two'  => __( 'Two Months',  'easybook-add-ons' ),
                'calendar_number_three'  => __( 'Three Months',  'easybook-add-ons' ),
                'calendar_number_four'  => __( 'Four Months',  'easybook-add-ons' ),
                'calendar_number_five'  => __( 'Five Months',  'easybook-add-ons' ),
                'calendar_number_six'  => __( 'Six Months',  'easybook-add-ons' ),
                'calendar_number_seven'  => __( 'Seven Months',  'easybook-add-ons' ),
               
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

                // earnings
                'earnings_title' => __( 'Your Earnings', 'easybook-add-ons' ),
                'th_date_' => __( 'Date', 'easybook-add-ons' ),
                'th_total_' => __( 'Total', 'easybook-add-ons' ),
                'th_fee_' => __( 'Author Fee', 'easybook-add-ons' ),
                'th_earning_' => __( 'Earning', 'easybook-add-ons' ),
                'th_order_' => __( 'Order', 'easybook-add-ons' ),
                'go_back' => __( 'Go back', 'easybook-add-ons' ),
                'no_earning' => __( 'You have no earning.' , 'easybook-add-ons' ),

                'cancel' => __( 'Cancel' , 'easybook-add-ons' ),

                
                'adcampaigns_title'     => __( 'Your Listing AD Campaigns', 'easybook-add-ons' ),
                'no_adcampaign'     => __( 'You have no listing ad campaign', 'easybook-add-ons' ),
                'tab_adcampaigns'     => __( 'Listing AD', 'easybook-add-ons' ),

                'th_id_'     => __( 'ID', 'easybook-add-ons' ),
                'th_adpackage'     => __( 'AD Package', 'easybook-add-ons' ),
                'th_adlisting'     => __( 'For Listing', 'easybook-add-ons' ),
                'th_adend'     => __( 'End Date', 'easybook-add-ons' ),
                'th_adstatus'     => __( 'Status', 'easybook-add-ons' ),
                'new_campaign'      => __( 'Add new campaign', 'easybook-add-ons' ),



                
            ),
            // nonce for rest api - Cookie Authentication
            'nonce' => wp_create_nonce( 'wp_rest' ),

        );

        wp_localize_script( 'easybook-addons', '_easybook_dashboard', $_easybook_dashboard );

        wp_enqueue_script( 'easybook-react-app', self::$plugin_url ."assets/js/easybook-react-app.min.js" , array('easybook-addons'), null , true );

        wp_enqueue_script( 'easybook-chat-app', self::$plugin_url ."assets/js/easybook-chat-app.min.js" , array('easybook-addons'), null , true );
        
        if( function_exists('wp_set_script_translations') ) wp_set_script_translations( 'easybook-react-app', 'easybook-add-ons' );
        // google reCAPTCHA - v2
        if( easybook_addons_get_option('enable_g_recaptcah') == 'yes' && easybook_addons_get_option('g_recaptcha_site_key') != '' )
            wp_enqueue_script( 'g-recaptcha', "https://www.google.com/recaptcha/api.js?onload=cthCaptchaCallback&render=explicit#cthasync#cthdefer" , array('easybook-addons'), null , true );


        // for Stripe payment
        if( is_page( easybook_addons_get_option('checkout_page') ) ){
            wp_enqueue_script( 'checkout.stripe', 'https://checkout.stripe.com/checkout.js' , array(), null , false );
            wp_enqueue_script( 'add-ons-payments', self::$plugin_url ."assets/js/payments.min.js" , array('jquery', 'checkout.stripe'), null , true );
            $stripe_logo = easybook_addons_get_option('stripe_logo');
            $_easybook_add_ons_payments = array(
                'site_title'            => get_bloginfo('name'),
                // 'site_desc'         => get_bloginfo('description'),
                'logo'                  => $stripe_logo['url'],
                'publishable_key'       => easybook_addons_get_option('payments_test_mode') == 'yes'? easybook_addons_get_option('payments_stripe_test_public') : easybook_addons_get_option('payments_stripe_live_public'),
                'currency_code'         => easybook_addons_get_option('currency','USD'),

                'one_time_text'         => __( 'Pay for {{plan}}', 'easybook-add-ons' ),
                'recurring_text'        => __( 'Subscription for {{plan}}', 'easybook-add-ons' ),
                'use_email'             => easybook_addons_get_option('payments_stripe_use_email') == 'yes'? true : false,


                // 'url'           => esc_url(admin_url( 'admin-ajax.php' ) ),
                // 'nonce'         => wp_create_nonce( 'easybook-add-ons' ),
                

            );
            wp_localize_script( 'add-ons-payments', '_easybook_add_ons_payments', $_easybook_add_ons_payments );
        }
        
    }
}

Esb_Class_Frontend_Scripts::init();