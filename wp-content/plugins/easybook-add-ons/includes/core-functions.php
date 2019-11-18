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

   


function easybook_addons_get_option( $setting, $default = null ) { 
    global $easybook_addons_options;

    $default_options = array(
        'users_can_submit_listing'              => 'no',

        'maintenance_mode'                      => 'disable',
        'listings_count'                        => '6',

        'map_pos'                               => 'right',
        'filter_pos'                            => 'left_col',
        'columns_grid'                          => 'two',

        'listing_location_result_type'          => 'administrative_area_level_1',
        'country_restrictions'                  => '',

        'gmap_marker'                           => array(
            'url' => '',

            'id' => ''
        ),

        'payments_stripe_use_email'             => 'yes',

        'membership_package_expired_hide'       => 'no',
        'membership_single_expired_hide'        => 'no',

        // default submit listing will expired in days
        'listing_expire_days'                   => 30,

        'submit_redirect'                       => 'single',

        'single_show_rating'                    => '1',
        'rating_base'                           => 5,

        'gmap_default_lat'                      => '40.7',
        'gmap_default_long'                     => '-73.87',

        'enable_img_click'                      => 'no',
        'vat_tax'                               => 10,
        'auto_active_free_sub'                  => 'no',
        // 'search_include_tag'                    => 'no',
        // 'search_tax_relation'                   => 'AND',

        'ads_archive_enable'                    => 'yes',
        'ads_archive_count'                     => '2',
        'ads_archive_orderby'                   => 'date',
        'ads_archive_order'                     => 'DESC',

        'ads_category_enable'                   => 'yes',
        'ads_category_count'                    => '2',
        'ads_category_orderby'                  => 'date',
        'ads_category_order'                    => 'DESC',

        'ads_search_enable'                     => 'yes',
        'ads_search_count'                      => '2',
        'ads_search_orderby'                    => 'date',
        'ads_search_order'                      => 'DESC',

        'ads_sidebar_enable'                    => 'yes',
        'ads_sidebar_count'                     => '2',
        'ads_sidebar_orderby'                   => 'date',
        'ads_sidebar_order'                     => 'DESC',

        'ads_home_enable'                       => 'yes',
        'ads_home_count'                        => '2',
        'ads_home_orderby'                      => 'date',
        'ads_home_order'                        => 'DESC',

        'ads_custom_grid_enable'                => 'yes',
        'ads_custom_grid_count'                 => '2',
        'ads_custom_grid_orderby'               => 'date',
        'ads_custom_grid_order'                 => 'DESC',

        'listings_grid_layout'                  => 'grid',
        
        // 'submit_timezone_hide'                  => 'no',

        'use_clock_24h'                         => 'yes',
        'use_messages'                          => 'yes',

        'free_submit_page'                      => 'default',

        'new_user_email'                        => 'both',
        'register_auto_login'                   => 'no',

        'register_term_text'                    => 'By using the website, you accept the terms and conditions',
        'register_consent_data_text'            => 'Consent to processing of personal data',
        'register_role'                         => 'no',               
        // 'search_cat_level'                      => '0',
        // 'search_load_subcat'                    => 'yes',

        'gmap_default_zoom'                     => 10,
        'always_show_submit'                    => 'yes',

        'emails_section_customer_booking_insert_enable'     => 'yes',
        'emails_section_customer_booking_insert_subject'    => '',
        'emails_section_customer_booking_insert_temp'       => '',

        'emails_section_customer_booking_approved_enable'     => 'yes',
        'emails_section_customer_booking_approved_subject'    => '',
        'emails_section_customer_booking_approved_temp'       => '',

        'payments_form_enable'                  => 'yes',
        'payments_banktransfer_enable'          => 'yes',

        // 'booking_clock_24h'                     => 'yes',
        // 'time_picker_color'                     => '#4DB7FE',
        // 'add_cart_delay'                        => 3000,

        'booking_author_woo'                    => 'no',

        'submit_media_limit'                    => 3,
        'submit_media_limit_size'               => 2,

        'register_password'                     => 'no',
        'enable_g_recaptcah'                    => 'no',
        'g_recaptcha_site_key'                  => '',
        'g_recaptcha_secret_key'                => '',

        'listings_orderby'                      => 'date',
        'listings_order'                        => 'DESC',

        'db_hide_messages'                      => 'no',
        // 'db_hide_packages'                      => 'no',
        // 'db_hide_ads'                           => 'no',
        // 'db_hide_invoices'                      => 'no',
        'db_hide_bookings'                      => 'no',
        'db_hide_bookmarks'                     => 'no',
        'db_hide_withdrawals'                   => 'no',
        'db_hide_reviews'                       => 'no',
        'db_hide_invoices'                       => 'no',
        
        // 'db_hide_adnew'                         => 'no',

        'grid_wkhour'                           => 'yes',
        'grid_price'                            => 'yes',
        'grid_price_range'                      => 'yes',
        'grid_viewed_count'                     => 'yes',

        'listing_event_date'                    => 'yes',

        'feature_parent_group'                  => 'yes',

        // 'submit_hide_content_head'              => 'no',
        // 'submit_hide_head_background'           => 'no',
        // 'submit_hide_head_carousel'             => 'no',
        // 'submit_hide_head_video'                => 'no',
        // 'submit_hide_content_video'             => 'no',
        // 'submit_hide_content_gallery'           => 'no',
        // 'submit_hide_content_slider'            => 'no',
        // 'submit_hide_price_opt'                 => 'no',
        // 'submit_hide_faqs_opt'                  => 'no',
        // 'submit_hide_counter_opt'               => 'no',
        // 'submit_hide_workinghours_opt'          => 'no',
        // 'submit_hide_socials_opt'               => 'no',



        // 'filter_hide_string'                    => 'no',
        // 'filter_hide_loc'                       => 'no',
        // 'filter_hide_cat'                       => 'no',
        // 'filter_hide_address'                   => 'no',
        // 'filter_hide_event_date'                => 'no',
        // 'filter_hide_event_time'                => 'no',
        // 'filter_hide_open_now'                  => 'no',
        // 'filter_hide_price_range'               => 'no',
        // 'filter_hide_sortby'                    => 'no',



        'admin_bar_front'                       => 'no',

        // 'single_hide_contacts_info'             => 'no',
        // 'single_hide_booking_form_widget'       => 'no',
        // 'single_hide_addfeatures_widget'        => 'no',
        // 'single_hide_contacts_widget'           => 'no',
        // 'single_hide_author_widget'             => 'no',
        // 'single_hide_moreauthor_widget'         => 'no',


        'listing_address_format'                => 'formatted_address',
        'google_map_language'                   => '',
        'multiple_cat'                          => 'no',
        'allow_rating_imgs'                     => 'yes',
        'single_hide_weather_widget'            => 'no',

        'single_post_nav'                       => 'yes',
        'single_same_term'                      => '0',
        'filter_features'                       => array(),

        'register_no_redirect'                  => 'yes',
        'filter_ltags'                          => array(),

        'login_redirect_page'                   => 'cth_current_page',

        'emails_auth_claim_subject'             => '',
        'emails_auth_claim_temp'                => '',


        'single_hide_claim'                     => 'no',
        'single_hide_claimed'                   => 'yes',
        'approve_claim_after_paid'              => 'yes',
        'admin_bar_hide_roles'                  => array('l_customer','listing_author','subscriber','contributor','author'),
        'chatbox_message'                       => '',
        'messages_first_load'                   => 10,
        'messages_prev_load'                    => 5,
        
        'default_listing_type'                  => '',
        'admin_lplan'                           => 0,
        'free_lplan'                            => 0,
        'use_osm_map'                           => 'no',

        'currencies'                            => array(),
        // 'currency_base'         => 'USD',
        'invoice_author'                =>'EasyBook , Inc.<br />
                                        USA 27TH Brooklyn NY<br />
                                        <a href="#" >JessieManrty@domain.com</a><br />
                                        <a href="#">+4(333)123456</a> ',
        'checkout_success_page'                 => 'none',
        'checkout_redirect_after_add'       => 'yes',
        'booking_vat_include_fee'           => 'no',
        'checkout_individual'               => 'yes',

        'chat_default_contact'              => 0,
        'ck_hide_information'               => 'yes',
        'ck_hide_billing'                   => 'no',
        'ck_hide_tabs'                       => 'no',
        'ck_show_title'                     => 'yes',
        'ck_agree_terms'                    => 'no',
        'ck_terms'                          => '',

        'ajax_searchc_chage'                 => 'yes',
        'location_show_state'               => 'yes',
        'azp_cache'                         => 'no',
        'azp_css_external'                  => 'yes',

        'checkout_success'                  => 'default',
        'checkout_success_redirect'                  => 'yes',

        'listings_per'                      => 5,

        'gmap_type'                         => 'ROADMAP',
        'logreg_form_after'                 => '<p>For faster login or register use your social account.</p>[fbl_login_button redirect="" hide_if_logged="" size="large" type="continue_with" show_face="true"]',
        'show_listing_view'                 => 'no',
        'dashboard_view_stats'              => 'yes',
        'default_thumbnail'                 => ESB_DIR_URL .'assets/images/21.jpg',

        'login_delay'                           => 5000,
        'payfast_rate'                      => '13.9893',
        'log_reg_dis_nonce'                     => 'no',

        'lazy_load'                             => 'yes',
        'default_country'                       => 'US',


        'currency_symbol'                       => '$',
        'show_fchat'                            => 'yes',
        'service_fee'                            => 5,

        'ck_need_logged_in'                     => true,
        'ck_book_logged_in'                     => false,
    );
    $value = false;
    if ( isset( $easybook_addons_options[ $setting ] ) ) {
        $value = $easybook_addons_options[ $setting ];
    }else {
        if(isset($default)){
            $value = $default;
        }else if( isset( $default_options[ $setting ] ) ){
            $value = $default_options[ $setting ];
        }
    }

    return apply_filters( 'cth_addons_option_value', $value, $setting );

    return $value;
}

function esb_setcookie($name, $value, $expire = 0, $secure = false, $raw = false )
{
    if (!headers_sent()) {
        $path = SITECOOKIEPATH != COOKIEPATH ? SITECOOKIEPATH : COOKIEPATH;
        if( $raw === true ){
            setrawcookie($name, $value, $expire, $path, COOKIE_DOMAIN, $secure);
        }else{
            setcookie($name, $value, $expire, $path, COOKIE_DOMAIN, $secure);
        }
        
    }
}
// add_filter( 'cth_addons_option_value', function($value, $name){
//     if( $name == 'map_pos' && is_tax( 'listing_cat' ) &&  get_queried_object_id() == 100 ){
//         $value = 'hide';
//     }
//     return $value;
// }, 10, 2 );

// get active plan for setting selection
function easybook_addons_get_listing_plans(){
    $results = array();

    $post_args = array(
        'post_type'         => 'lplan',
        'posts_per_page'    => -1,
        'orderby'           => 'date',
        'order'             => 'DESC',
        'post_status'       => 'any'
    );

    $posts = get_posts( $post_args );
    if ( $posts ) {
        foreach ( $posts as $post ) {
            $results[$post->ID] = apply_filters( 'the_title' , $post->post_title );
            
        }
    }

    return $results;
}
function easybook_addons_gmt_to_local_timestamp( $gmt_timestamp ) {
    $iso_date        = date( 'Y-m-d H:i:s', $gmt_timestamp );
    $local_timestamp = get_date_from_gmt( $iso_date, 'U' );

    return $local_timestamp;
}


// $GLOBALS['easybook_ads'] = array();

/* add edit listing var */
function easybook_addons_add_query_vars_filter( $vars ){   
  $vars[] = "listing_id";
  $vars[] = "dashboard";
  $vars[] = "esb_add_to_cart";
  $vars[] = "quantity";
  // $vars[] = "ls_type";
  return $vars;
}
add_filter( 'query_vars', 'easybook_addons_add_query_vars_filter' );  

// filter document_title_parts for dasboard subpages

function easybook_addons_document_title_parts_filter( $title ){
    $dashboard_page_id = easybook_addons_get_option('dashboard_page');       
    $dashboard_var = get_query_var('dashboard');
    if(is_page($dashboard_page_id) && $dashboard_var != ''){
        $title['title'] .= ' - ' . easybook_addons_get_dashboard_subpage($dashboard_var);  
    }
    return $title;
}
add_filter( 'document_title_parts', 'easybook_addons_document_title_parts_filter', 10, 1 );  



function easybook_addons_listing_author_no_admin_access() {
    if(!wp_doing_ajax()){
        // $redirect = isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : home_url( '/' );
        // global $current_user;
        // $user_roles = $current_user->roles;
        // $user_role = array_shift($user_roles);


        // $user_role = easybook_addons_get_user_role();
        // if($user_role === 'listing_author' || $user_role === 'l_customer'){
        //     // $error = new WP_Error( 'error', __( "You don't have permission to access this page.", 'easybook-add-ons' ) );
        //     // echo $error->get_error_message();
        //     wp_die( __( "You don't have permission to access this page.", 'easybook-add-ons' ) );
        // }

        // $azp_csses = get_option( 'azp_csses' );echo json_encode($azp_csses);die;
        
        if( in_array( easybook_addons_get_user_role(), easybook_addons_get_option('admin_bar_hide_roles') ) ){
            wp_die( __( "You don't have permission to access this page.", 'easybook-add-ons' ) );
        }
    }
        
 }

add_action( 'admin_init', 'easybook_addons_listing_author_no_admin_access', 100 );


// custom template for single listing page
function easybook_addons_listing_single_template($single_template) {
    global $post;

    if ($post->post_type == 'listing') {
        $single_template = easybook_addons_get_template_part('templates/single', 'listing', null, false);
        // $single_template = ESB_ABSPATH . 'templates/single-listing.php';
    }
    return $single_template;
}
add_filter( 'single_template', 'easybook_addons_listing_single_template' );

// custom template for listing search page
add_action( 'parse_request', 'easybook_addons_parse_request_callback' );
function easybook_addons_parse_request_callback( $query ) {
    if (  isset($_GET['search_term']) ) {
        $query->query_vars[ 'post_type' ] = 'listing';
    }
    return $query;
}
// https://wordpress.stackexchange.com/questions/89886/how-to-create-a-custom-search-for-custom-post-type
function easybook_addons_listing_search_template($template)   {    
    global $wp_query; 
    if( is_post_type_archive('listing') || is_tax('listing_cat') || is_tax('listing_feature') || is_tax('listing_location') || is_tax('listing_tag') ){
        // return locate_template('listing-search.php');  //  redirect to listing-search.php
        $template = easybook_addons_get_template_part('templates/listing', 'search', null, false);
        // $template = ESB_ABSPATH . 'templates/listing-search.php';
    }elseif( array_key_exists('author', $wp_query->query_vars) && !empty($wp_query->query_vars['author']) && array_key_exists('author_name', $wp_query->query_vars) && !empty($wp_query->query_vars['author_name']) ){
        global $laumember;
        $laumember = new WP_User( $wp_query->query_vars["author"] );
        if( $laumember->exists() )
        {
            $template = easybook_addons_get_template_part('templates/listing', 'author', null, false);
            // $template = ESB_ABSPATH . 'templates/listing-author.php';
        }
    }
    return $template;   
}
add_filter('template_include', 'easybook_addons_listing_search_template');



function easybook_addons_listing_search_result($query) {
    if ( ! is_admin() && $query->is_main_query() ) {
        

        if ( is_post_type_archive('listing') || is_tax('listing_cat') || is_tax('listing_feature') || is_tax('listing_location') || is_tax('listing_tag') || 'listing' == $query->get('post_type') ) {
            $ad_posts_args = array();
            $ad_posts = array();
            if(is_search()){
                if(easybook_addons_get_option('ads_search_enable') == 'yes'){
                    $ad_posts_args = array(
                        'post_type'             => 'listing', 
                        'orderby'               => easybook_addons_get_option('ads_search_orderby'),
                        'order'                 => easybook_addons_get_option('ads_search_order'),
                        'posts_per_page'        => easybook_addons_get_option('ads_search_count'),
                        'meta_query'            => array(
                            'relation' => 'AND',
                            array(
                                'key'     => ESB_META_PREFIX.'is_ad',
                                'value'   => '1',
                            ),
                            array(
                                'key'     => ESB_META_PREFIX.'ad_position_search',
                                'value'   => '1',
                            ),
                            array(
                                'key'     => ESB_META_PREFIX.'ad_expire',
                                'value'   => current_time('mysql', 0),
                                'compare' => '>=',
                                'type'    => 'DATETIME',
                            ),
                        ),

                    );
                }
            }elseif(is_tax('listing_cat')){
                if(easybook_addons_get_option('ads_category_enable') == 'yes'){
                    $ad_posts_args = array(
                        'post_type'             => 'listing', 
                        'orderby'               => easybook_addons_get_option('ads_category_orderby'),
                        'order'                 => easybook_addons_get_option('ads_category_order'),
                        'posts_per_page'        => easybook_addons_get_option('ads_category_count'),
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'listing_cat',
                                'field'    => 'term_id',
                                'terms'    => get_queried_object_id(),
                            ),
                        ),

                        'meta_query'            => array(
                            'relation' => 'AND',
                            array(
                                'key'     => ESB_META_PREFIX.'is_ad',
                                'value'   => '1',
                            ),
                            array(
                                'key'     => ESB_META_PREFIX.'ad_position_category',
                                'value'   => '1',
                            ),
                            array(
                                'key'     => ESB_META_PREFIX.'ad_expire',
                                'value'   => current_time('mysql', 0),
                                'compare' => '>=',
                                'type'    => 'DATETIME',
                            ),
                        ),

                    );
                }
            }elseif(is_post_type_archive('listing')){
                if(easybook_addons_get_option('ads_archive_enable') == 'yes'){
                    $ad_posts_args = array(
                        'post_type'             => 'listing', 
                        'orderby'               => easybook_addons_get_option('ads_archive_orderby'),
                        'order'                 => easybook_addons_get_option('ads_archive_order'),
                        'posts_per_page'        => easybook_addons_get_option('ads_archive_count'),
                        'meta_query'            => array(
                            'relation' => 'AND',
                            array(
                                'key'     => ESB_META_PREFIX.'is_ad',
                                'value'   => '1',
                            ),
                            array(
                                'key'     => ESB_META_PREFIX.'ad_position_archive',
                                'value'   => '1',
                            ),
                            array(
                                'key'     => ESB_META_PREFIX.'ad_expire',
                                'value'   => current_time('mysql', 0),
                                'compare' => '>=',
                                'type'    => 'DATETIME',
                            ),
                        ),

                    );
                }
            }
            if(!empty($ad_posts_args)){

                if(easybook_addons_get_option('listings_orderby') == 'listing_featured'){
                    $ad_posts_args['meta_key'] = ESB_META_PREFIX.'featured';
                    $ad_posts_args['orderby'] = 'meta_value';
                }
                
                // The Query
                $posts_query = new WP_Query( $ad_posts_args );
                
                if($posts_query->have_posts()) :
                    
                    while($posts_query->have_posts()) : $posts_query->the_post();
                        $ad_posts[] = get_the_ID();
                        
                    endwhile;
                endif;

                wp_reset_postdata();
            }

            $GLOBALS['main_ads'] = $ad_posts;

            if(!empty($ad_posts)) $query->set('post__not_in', $ad_posts );

            // http://localhost:8888/wpclean/?search_term=&search_term=&checkin=2018-12-17&checkout=2018-12-21&adults=1&children=0&post_type=listing
            if( isset($_GET['checkin']) && $_GET['checkin'] != '' ){

                $post__in_sum = easybook_addons_listing_available_date( $_GET['checkin'] );

                if( isset($_GET['checkout']) && $_GET['checkout'] != '' ){
                    $avai_check_args = array(
                        'checkin'   => $_GET['checkin'],
                        'checkout'   => $_GET['checkout'],
                        'listing_id'   => 0,
                    );
                    $listing_availables = easybook_addons_get_available_listings($avai_check_args);
                    if(is_array($listing_availables) && !empty($listing_availables)){
                        $post__in = array();
                        foreach ($listing_availables as $avai) {
                            if( isset($avai->id) && (int)$avai->id > 0){
                                if(isset($_GET['no_rooms']) && (int)$_GET['no_rooms'] > 1){
                                    $avai_check_args['listing_id'] = $avai->id;
                                    // check quantity
                                    $double_check = easybook_addons_get_available_listings($avai_check_args);
                                    if(!empty($double_check)){
                                        $room_quans = array_map(function($room){
                                            return ((int)$room->quantities > 0) ? (int)$room->quantities : 0;
                                        },$double_check);
                                        $room_quans = array_filter($room_quans);
                                        if(array_sum($room_quans) >= $_GET['no_rooms']) $post__in[] = $avai->id;
                                    }
                                }else{
                                    $post__in[] = $avai->id;
                                }
                                
                            }
                        }
                        $post__in_sum = array_merge($post__in_sum, $post__in);
                    } 
                }
                // end checkout check
                $post__in_sum = array_filter($post__in_sum);
                if(!empty($post__in_sum)) $query->set('post__in', $post__in_sum );

            }

            // listing meta search
            $meta_queries = array();
           

            $add_queries = array();
            // http://localhost:8888/easybook/?s=L&lcats%5B%5D=92&post_type=listing&lfeas%5B%5D=200&llocs%5B%5D=10

            

            // php 5.5+
            if( isset($_GET['lcats']) && !empty( array_filter($_GET['lcats']) ) ){

                

                $add_queries[] =    array(
                                        'taxonomy' => 'listing_cat',
                                        'field'    => 'term_id',
                                        'terms'    => $_GET['lcats'],
                                    );

            }else if( $_SERVER['SERVER_NAME'] == 'easybook.cththemes.net' || $_SERVER['SERVER_NAME'] == 'easybook.cththemes.com' || $_SERVER['SERVER_NAME'] == 'easybook2.cththemes.com'){

                $add_queries[] =    array(
                                        'taxonomy' => 'listing_cat',
                                        'field'    => 'term_id',
                                        'terms'    => array( 309 ),
                                        'operator' => 'NOT IN',
                                        // 'include_children'  => false, // default true
                                    );
            }
            if( isset($_GET['lfeas']) && !empty( array_filter($_GET['lfeas']) ) ){

                $add_queries[] =    array(
                                        'taxonomy' => 'listing_feature',
                                        'field'    => 'term_id',
                                        'terms'    => $_GET['lfeas'],
                                    );

            }
            if( isset($_GET['llocs']) && !empty($_GET['llocs'] ) ){
                $llocs = explode(',',$_GET['llocs']);
                $add_queries[] =    array(
                                        'taxonomy' => 'listing_location',
                                        'field'    => 'slug',
                                        'terms'    => array_filter( $llocs, function($loc){ return sanitize_title( $loc ); } ),
                                    );

            }

            if( isset($_GET['listing_tags']) && !empty( array_filter($_GET['listing_tags']) ) ){

                $add_queries[] =    array(
                                        'taxonomy' => 'listing_tag',
                                        'field'    => 'term_id',
                                        'terms'    => $_GET['listing_tags'],
                                        'operator' => 'AND', // default IN
                                    );

            }

            if(!empty($add_queries)){
                $add_queries['relation'] = easybook_addons_get_option('search_tax_relation');
                $query->set('tax_query', $add_queries);
            }  

            if(!empty($meta_queries)) $query->set('meta_query', $meta_queries);

            $query->set('posts_per_page', easybook_addons_get_option('listings_count'));
            $query->set('orderby', easybook_addons_get_option('listings_orderby'));
            $query->set('order', easybook_addons_get_option('listings_order'));
            // https://wordpress.stackexchange.com/questions/45413/using-orderby-and-meta-value-num-to-order-numbers-first-then-strings
            if(easybook_addons_get_option('listings_orderby') == 'listing_featured'){
                $query->set('meta_key', ESB_META_PREFIX.'featured');
                $query->set('orderby', 'meta_value');
            }

            // $query->set('meta_key', ESB_META_PREFIX.'featured');
            // $query->set('orderby', 'meta_value');
            // $query->set('order', 'DESC');

            // for additional search
            $query->set('suppress_filters', false);
            $query->set('cthqueryid', 'main-search');

            // fix search cache result
            $query->set('cache_results', false);
            $query->set('update_post_meta_cache', false);
            $query->set('update_post_term_cache', false);
        }
        
        // if ( $query->is_tag() ) {
        //     $query->set( 'post_type', array( 'post','nav_menu_item','listing' ) );
        // }
        
    }
}

add_action( 'pre_get_posts', 'easybook_addons_listing_search_result' );


function easybook_addons_listing_search_where($where, $q){
    global $wpdb;
    if ( ! is_admin() && $q->is_main_query() ) {
        // if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Is search" . PHP_EOL, 3, ESB_LOG_FILE);
        // if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). json_encode($q) . PHP_EOL, 3, ESB_LOG_FILE);
        if (is_search() && 'listing' == get_query_var('post_type') )
            $where .= "OR (t.name LIKE '%".get_search_query()."%' AND {$wpdb->posts}.post_status = 'publish')";
    }
    return $where;
}

function easybook_addons_listing_search_join($join, $q){
    global $wpdb;
    if ( ! is_admin() && $q->is_main_query() ) {
        if ( is_search() && 'listing' == get_query_var('post_type') )
            $join .= "LEFT JOIN {$wpdb->term_relationships} tr ON {$wpdb->posts}.ID = tr.object_id INNER JOIN {$wpdb->term_taxonomy} tt ON tt.term_taxonomy_id=tr.term_taxonomy_id INNER JOIN {$wpdb->terms} t ON t.term_id = tt.term_id";
    }
    return $join;
}

function easybook_addons_listing_search_groupby($groupby, $q){
    global $wpdb;
    if ( ! is_admin() && $q->is_main_query() ) {
        // we need to group on post ID
        $groupby_id = "{$wpdb->posts}.ID";
        if(!is_search() || strpos($groupby, $groupby_id) !== false || 'listing' != get_query_var('post_type')) return $groupby;

        // groupby was empty, use ours
        if(!strlen(trim($groupby))) return $groupby_id;

        // wasn't empty, append ours
        return $groupby.", ".$groupby_id;
    }

    return $groupby;
}

// add_filter('posts_where','easybook_addons_listing_search_where', 10, 2);
// add_filter('posts_join', 'easybook_addons_listing_search_join', 10, 2);
// add_filter('posts_groupby', 'easybook_addons_listing_search_groupby', 10, 2);

// function easybook_addons_add_tag_custom_type($query){
//     if ( ! is_admin() && $query->is_main_query() ) {
//         // add support post_tag to listing post
//         if( is_tag() && empty($query->query_vars['suppress_filters']) ){
//             $post_types = (array)$query->get('post_type');

//             $query->set('post_type', array('post','nav_menu_item','listing'));
//         }
//     }
    
//     return $query;
// }

// add_filter( 'pre_get_posts', 'easybook_addons_add_tag_custom_type' );

function easybook_addons_auto_login_new_user( $user_id ) {
    
    wp_set_current_user($user_id);

    // Set the global user object
    // $current_user = get_user_by( 'id', $user_id );

    // set the WP login cookie
    $secure_cookie = is_ssl() ? true : false;

    wp_set_auth_cookie( $user_id, true, $secure_cookie ); // This function does not return a value

}
// do not remove the callback function
// add_action( 'user_register', 'easybook_addons_auto_login_new_user' );
// https://codex.wordpress.org/Plugin_API/Action_Reference/user_register

function easybook_addons_generate_password($length = 12) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }

    return $result;
}



function easybook_addons_get_booking_statuses_array($defauls = array() ) {
    if(empty($defauls)){
        $defauls = array(
            // paypal
            'pending'=> __('Pending','easybook-add-ons'), 
            'completed'=> __('Completed','easybook-add-ons'), 
            'failed'=> __('Failed','easybook-add-ons'), 
            'refunded'=> __('Refunded','easybook-add-ons'), 
            // stripe
            'created'=> __('Created','easybook-add-ons'), 
            'trialing'=>__('Trialing','easybook-add-ons'), 
            'active'=>__('Active','easybook-add-ons'), 
            'past_due'=>__('Past Due','easybook-add-ons'), 
            'canceled'=>__('Canceled','easybook-add-ons') ,
            'unpaid'=>__('Unpaid','easybook-add-ons') 
        );
    }

    return $defauls ;
}
function easybook_addons_get_booking_status_text($status = 'pending'){
    $statuses = easybook_addons_get_booking_statuses_array();
    if(isset($statuses[$status])) return $statuses[$status];
    return $statuses['pending'];
}



function easybook_addons_get_google_contry_codes($country = '', $lowercase = false){

    $countries = array(
        'AF' => __("Afghanistan", 'easybook-add-ons'),
        'AL' => __("Albania", 'easybook-add-ons'),
        'DZ' => __("Algeria", 'easybook-add-ons'),
        'AS' => __("American Samoa", 'easybook-add-ons'),
        'AD' => __("Andorra", 'easybook-add-ons'),
        'AO' => __("Angola", 'easybook-add-ons'),
        'AI' => __("Anguilla", 'easybook-add-ons'),
        'AQ' => __("Antarctica", 'easybook-add-ons'),
        'AG' => __("Antigua and Barbuda", 'easybook-add-ons'),
        'AR' => __("Argentina", 'easybook-add-ons'),
        'AM' => __("Armenia", 'easybook-add-ons'),
        'AW' => __("Aruba", 'easybook-add-ons'),
        'AU' => __("Australia", 'easybook-add-ons'),
        'AT' => __("Austria", 'easybook-add-ons'),
        'AZ' => __("Azerbaijan", 'easybook-add-ons'),
        'BS' => __("Bahamas", 'easybook-add-ons'),
        'BH' => __("Bahrain", 'easybook-add-ons'),
        'BD' => __("Bangladesh", 'easybook-add-ons'),
        'BB' => __("Barbados", 'easybook-add-ons'),
        'BY' => __("Belarus", 'easybook-add-ons'),
        'BE' => __("Belgium", 'easybook-add-ons'),
        'BZ' => __("Belize", 'easybook-add-ons'),
        'BJ' => __("Benin", 'easybook-add-ons'),
        'BM' => __("Bermuda", 'easybook-add-ons'),
        'BT' => __("Bhutan", 'easybook-add-ons'),
        'BO' => __("Bolivia", 'easybook-add-ons'),
        'BA' => __("Bosnia and Herzegovina", 'easybook-add-ons'),
        'BW' => __("Botswana", 'easybook-add-ons'),
        'BV' => __("Bouvet Island", 'easybook-add-ons'),
        'BR' => __("Brazil", 'easybook-add-ons'),
        'IO' => __("British Indian Ocean Territory", 'easybook-add-ons'),
        'BN' => __("Brunei Darussalam", 'easybook-add-ons'),
        'BG' => __("Bulgaria", 'easybook-add-ons'),
        'BF' => __("Burkina Faso", 'easybook-add-ons'),
        'BI' => __("Burundi", 'easybook-add-ons'),
        'KH' => __("Cambodia", 'easybook-add-ons'),
        'CM' => __("Cameroon", 'easybook-add-ons'),
        'CA' => __("Canada", 'easybook-add-ons'),
        'CV' => __("Cape Verde", 'easybook-add-ons'),
        'KY' => __("Cayman Islands", 'easybook-add-ons'),
        'CF' => __("Central African Republic", 'easybook-add-ons'),
        'TD' => __("Chad", 'easybook-add-ons'),
        'CL' => __("Chile", 'easybook-add-ons'),
        'CN' => __("China", 'easybook-add-ons'),
        'CX' => __("Christmas Island", 'easybook-add-ons'),
        'CC' => __("Cocos (Keeling) Islands", 'easybook-add-ons'),
        'CO' => __("Colombia", 'easybook-add-ons'),
        'KM' => __("Comoros", 'easybook-add-ons'),
        'CG' => __("Congo", 'easybook-add-ons'),
        'CD' => __("Congo, the Democratic Republic of the", 'easybook-add-ons'),
        'CK' => __("Cook Islands", 'easybook-add-ons'),
        'CR' => __("Costa Rica", 'easybook-add-ons'),
        'CI' => __("Cote D'ivoire", 'easybook-add-ons'),
        'HR' => __("Croatia", 'easybook-add-ons'),
        'CU' => __("Cuba", 'easybook-add-ons'),
        'CY' => __("Cyprus", 'easybook-add-ons'),
        'CZ' => __("Czech Republic", 'easybook-add-ons'),
        'DK' => __("Denmark", 'easybook-add-ons'),
        'DJ' => __("Djibouti", 'easybook-add-ons'),
        'DM' => __("Dominica", 'easybook-add-ons'),
        'DO' => __("Dominican Republic", 'easybook-add-ons'),
        'EC' => __("Ecuador", 'easybook-add-ons'),
        'EG' => __("Egypt", 'easybook-add-ons'),
        'SV' => __("El Salvador", 'easybook-add-ons'),
        'GQ' => __("Equatorial Guinea", 'easybook-add-ons'),
        'ER' => __("Eritrea", 'easybook-add-ons'),
        'EE' => __("Estonia", 'easybook-add-ons'),
        'ET' => __("Ethiopia", 'easybook-add-ons'),
        'FK' => __("Falkland Islands (Malvinas)", 'easybook-add-ons'),
        'FO' => __("Faroe Islands", 'easybook-add-ons'),
        'FJ' => __("Fiji", 'easybook-add-ons'),
        'FI' => __("Finland", 'easybook-add-ons'),
        'FR' => __("France", 'easybook-add-ons'),
        'GF' => __("French Guiana", 'easybook-add-ons'),
        'PF' => __("French Polynesia", 'easybook-add-ons'),
        'TF' => __("French Southern Territories", 'easybook-add-ons'),
        'GA' => __("Gabon", 'easybook-add-ons'),
        'GM' => __("Gambia", 'easybook-add-ons'),
        'GE' => __("Georgia", 'easybook-add-ons'),
        'DE' => __("Germany", 'easybook-add-ons'),
        'GH' => __("Ghana", 'easybook-add-ons'),
        'GI' => __("Gibraltar", 'easybook-add-ons'),
        'GR' => __("Greece", 'easybook-add-ons'),
        'GL' => __("Greenland", 'easybook-add-ons'),
        'GD' => __("Grenada", 'easybook-add-ons'),
        'GP' => __("Guadeloupe", 'easybook-add-ons'),
        'GU' => __("Guam", 'easybook-add-ons'),
        'GT' => __("Guatemala", 'easybook-add-ons'),
        'GN' => __("Guinea", 'easybook-add-ons'),
        'GW' => __("Guinea-Bissau", 'easybook-add-ons'),
        'GY' => __("Guyana", 'easybook-add-ons'),
        'HT' => __("Haiti", 'easybook-add-ons'),
        'HM' => __("Heard Island and Mcdonald Islands", 'easybook-add-ons'),
        'VA' => __("Holy See (Vatican City State)", 'easybook-add-ons'),
        'HN' => __("Honduras", 'easybook-add-ons'),
        'HK' => __("Hong Kong", 'easybook-add-ons'),
        'HU' => __("Hungary", 'easybook-add-ons'),
        'IS' => __("Iceland", 'easybook-add-ons'),
        'IN' => __("India", 'easybook-add-ons'),
        'ID' => __("Indonesia", 'easybook-add-ons'),
        'IR' => __("Iran, Islamic Republic of", 'easybook-add-ons'),
        'IQ' => __("Iraq", 'easybook-add-ons'),
        'IE' => __("Ireland", 'easybook-add-ons'),
        'IL' => __("Israel", 'easybook-add-ons'),
        'IT' => __("Italy", 'easybook-add-ons'),
        'JM' => __("Jamaica", 'easybook-add-ons'),
        'JP' => __("Japan", 'easybook-add-ons'),
        'JO' => __("Jordan", 'easybook-add-ons'),
        'KZ' => __("Kazakhstan", 'easybook-add-ons'),
        'KE' => __("Kenya", 'easybook-add-ons'),
        'KI' => __("Kiribati", 'easybook-add-ons'),
        'KP' => __("Korea, Democratic People's Republic of", 'easybook-add-ons'),
        'KR' => __("Korea, Republic of", 'easybook-add-ons'),
        'KW' => __("Kuwait", 'easybook-add-ons'),
        'KG' => __("Kyrgyzstan", 'easybook-add-ons'),
        'LA' => __("Lao People's Democratic Republic", 'easybook-add-ons'),
        'LV' => __("Latvia", 'easybook-add-ons'),
        'LB' => __("Lebanon", 'easybook-add-ons'),
        'LS' => __("Lesotho", 'easybook-add-ons'),
        'LR' => __("Liberia", 'easybook-add-ons'),
        'LY' => __("Libyan Arab Jamahiriya", 'easybook-add-ons'),
        'LI' => __("Liechtenstein", 'easybook-add-ons'),
        'LT' => __("Lithuania", 'easybook-add-ons'),
        'LU' => __("Luxembourg", 'easybook-add-ons'),
        'MO' => __("Macao", 'easybook-add-ons'),
        'MK' => __("Macedonia, the Former Yugosalv Republic of", 'easybook-add-ons'),
        'MG' => __("Madagascar", 'easybook-add-ons'),
        'MW' => __("Malawi", 'easybook-add-ons'),
        'MY' => __("Malaysia", 'easybook-add-ons'),
        'MV' => __("Maldives", 'easybook-add-ons'),
        'ML' => __("Mali", 'easybook-add-ons'),
        'MT' => __("Malta", 'easybook-add-ons'),
        'MH' => __("Marshall Islands", 'easybook-add-ons'),
        'MQ' => __("Martinique", 'easybook-add-ons'),
        'MR' => __("Mauritania", 'easybook-add-ons'),
        'MU' => __("Mauritius", 'easybook-add-ons'),
        'YT' => __("Mayotte", 'easybook-add-ons'),
        'MX' => __("Mexico", 'easybook-add-ons'),
        'FM' => __("Micronesia, Federated States of", 'easybook-add-ons'),
        'MD' => __("Moldova, Republic of", 'easybook-add-ons'),
        'MC' => __("Monaco", 'easybook-add-ons'),
        'MN' => __("Mongolia", 'easybook-add-ons'),
        'MS' => __("Montserrat", 'easybook-add-ons'),
        'MA' => __("Morocco", 'easybook-add-ons'),
        'MZ' => __("Mozambique", 'easybook-add-ons'),
        'MM' => __("Myanmar", 'easybook-add-ons'),
        'NA' => __("Namibia", 'easybook-add-ons'),
        'NR' => __("Nauru", 'easybook-add-ons'),
        'NP' => __("Nepal", 'easybook-add-ons'),
        'NL' => __("Netherlands", 'easybook-add-ons'),
        'AN' => __("Netherlands Antilles", 'easybook-add-ons'),
        'NC' => __("New Caledonia", 'easybook-add-ons'),
        'NZ' => __("New Zealand", 'easybook-add-ons'),
        'NI' => __("Nicaragua", 'easybook-add-ons'),
        'NE' => __("Niger", 'easybook-add-ons'),
        'NG' => __("Nigeria", 'easybook-add-ons'),
        'NU' => __("Niue", 'easybook-add-ons'),
        'NF' => __("Norfolk Island", 'easybook-add-ons'),
        'MP' => __("Northern Mariana Islands", 'easybook-add-ons'),
        'NO' => __("Norway", 'easybook-add-ons'),
        'OM' => __("Oman", 'easybook-add-ons'),
        'PK' => __("Pakistan", 'easybook-add-ons'),
        'PW' => __("Palau", 'easybook-add-ons'),
        'PS' => __("Palestinian Territory, Occupied", 'easybook-add-ons'),
        'PA' => __("Panama", 'easybook-add-ons'),
        'PG' => __("Papua New Guinea", 'easybook-add-ons'),
        'PY' => __("Paraguay", 'easybook-add-ons'),
        'PE' => __("Peru", 'easybook-add-ons'),
        'PH' => __("Philippines", 'easybook-add-ons'),
        'PN' => __("Pitcairn", 'easybook-add-ons'),
        'PL' => __("Poland", 'easybook-add-ons'),
        'PT' => __("Portugal", 'easybook-add-ons'),
        'PR' => __("Puerto Rico", 'easybook-add-ons'),
        'QA' => __("Qatar", 'easybook-add-ons'),
        'RE' => __("Reunion", 'easybook-add-ons'),
        'RO' => __("Romania", 'easybook-add-ons'),
        'RU' => __("Russian Federation", 'easybook-add-ons'),
        'RW' => __("Rwanda", 'easybook-add-ons'),
        'SH' => __("Saint Helena", 'easybook-add-ons'),
        'KN' => __("Saint Kitts and Nevis", 'easybook-add-ons'),
        'LC' => __("Saint Lucia", 'easybook-add-ons'),
        'PM' => __("Saint Pierre and Miquelon", 'easybook-add-ons'),
        'VC' => __("Saint Vincent and the Grenadines", 'easybook-add-ons'),
        'WS' => __("Samoa", 'easybook-add-ons'),
        'SM' => __("San Marino", 'easybook-add-ons'),
        'ST' => __("Sao Tome and Principe", 'easybook-add-ons'),
        'SA' => __("Saudi Arabia", 'easybook-add-ons'),
        'SN' => __("Senegal", 'easybook-add-ons'),
        'CS' => __("Serbia and Montenegro", 'easybook-add-ons'),
        'SC' => __("Seychelles", 'easybook-add-ons'),
        'SL' => __("Sierra Leone", 'easybook-add-ons'),
        'SG' => __("Singapore", 'easybook-add-ons'),
        'SK' => __("Slovakia", 'easybook-add-ons'),
        'SI' => __("Slovenia", 'easybook-add-ons'),
        'SB' => __("Solomon Islands", 'easybook-add-ons'),
        'SO' => __("Somalia", 'easybook-add-ons'),
        'ZA' => __("South Africa", 'easybook-add-ons'),
        'GS' => __("South Georgia and the South Sandwich Islands", 'easybook-add-ons'),
        'ES' => __("Spain", 'easybook-add-ons'),
        'LK' => __("Sri Lanka", 'easybook-add-ons'),
        'SD' => __("Sudan", 'easybook-add-ons'),
        'SR' => __("Suriname", 'easybook-add-ons'),
        'SJ' => __("Svalbard and Jan Mayen", 'easybook-add-ons'),
        'SZ' => __("Swaziland", 'easybook-add-ons'),
        'SE' => __("Sweden", 'easybook-add-ons'),
        'CH' => __("Switzerland", 'easybook-add-ons'),
        'SY' => __("Syrian Arab Republic", 'easybook-add-ons'),
        'TW' => __("Taiwan, Province of China", 'easybook-add-ons'),
        'TJ' => __("Tajikistan", 'easybook-add-ons'),
        'TZ' => __("Tanzania, United Republic of", 'easybook-add-ons'),
        'TH' => __("Thailand", 'easybook-add-ons'),
        'TL' => __("Timor-Leste", 'easybook-add-ons'),
        'TG' => __("Togo", 'easybook-add-ons'),
        'TK' => __("Tokelau", 'easybook-add-ons'),
        'TO' => __("Tonga", 'easybook-add-ons'),
        'TT' => __("Trinidad and Tobago", 'easybook-add-ons'),
        'TN' => __("Tunisia", 'easybook-add-ons'),
        'TR' => __("Turkey", 'easybook-add-ons'),
        'TM' => __("Turkmenistan", 'easybook-add-ons'),
        'TC' => __("Turks and Caicos Islands", 'easybook-add-ons'),
        'TV' => __("Tuvalu", 'easybook-add-ons'),
        'UG' => __("Uganda", 'easybook-add-ons'),
        'UA' => __("Ukraine", 'easybook-add-ons'),
        'AE' => __("United Arab Emirates", 'easybook-add-ons'),
        'UK' => __("United Kingdom", 'easybook-add-ons'),
        'US' => __("United States", 'easybook-add-ons'),
        'UM' => __("United States Minor Outlying Islands", 'easybook-add-ons'),
        'UY' => __("Uruguay", 'easybook-add-ons'),
        'UZ' => __("Uzbekistan", 'easybook-add-ons'),
        'VU' => __("Vanuatu", 'easybook-add-ons'),
        'VE' => __("Venezuela", 'easybook-add-ons'),
        'VN' => __("Viet Nam", 'easybook-add-ons'),
        'VG' => __("Virgin Islands, British", 'easybook-add-ons'),
        'VI' => __("Virgin Islands, U.S.", 'easybook-add-ons'),
        'WF' => __("Wallis and Futuna", 'easybook-add-ons'),
        'EH' => __("Western Sahara", 'easybook-add-ons'),
        'YE' => __("Yemen", 'easybook-add-ons'),
        'ZM' => __("Zambia", 'easybook-add-ons'),
        'ZW' => __("Zimbabwe", 'easybook-add-ons'),
    );
    
    if($country != '' && isset($countries[$country])) return $countries[$country];

    if($country != '') return $country;

    if($lowercase){
        $new_countries = array();
        foreach ($countries as $code => $name) {
            $new_countries[strtolower($code)] = $name;
        }

        return $new_countries;
    }

    return $countries;
}

// for subscription plan
function easybook_add_ons_get_subscription_duration_units($unit = ''){
    $duration_units = array(
        // 'hour'          => esc_html__( 'Hour', 'easybook-add-ons' ),
        'day'           => esc_html__( 'Days', 'easybook-add-ons' ),
        'week'          => esc_html__( 'Weeks', 'easybook-add-ons' ),
        'month'         => esc_html__( 'Months', 'easybook-add-ons' ),
        'year'          => esc_html__( 'Years', 'easybook-add-ons' ),
    );
    if( !empty($unit) && isset( $duration_units[$unit] ) ) return $duration_units[$unit];

    return $duration_units;
}
//
function easybook_add_ons_get_paypal_duration_unit($unit = ''){
    /*
    D. Days. Valid range for p3 is 1 to 90.
    W. Weeks. Valid range for p3 is 1 to 52.
    M. Months. Valid range for p3 is 1 to 24.
    Y. Years. Valid range for p3 is 1 to 5.
    */

    $default = array(
        'day' => 'D',
        'week' => 'W',
        'month' => 'M',
        'year' => 'Y',
    );

    if( !empty($unit) && isset( $default[$unit] ) ) return $default[$unit];

    return $default['month'];
}
function easybook_add_ons_get_paypal_duration($duration = '', $unit = ''){
    if($duration){
        $duration_unit = easybook_add_ons_get_paypal_duration_unit($unit);
        switch ($duration_unit) {
            case 'D':
                if((int)$duration > 90) return 90;
                return (int)$duration;
                break;
            case 'W':
                if((int)$duration > 52) return 52;
                return (int)$duration;
                break;
            case 'M':
                if((int)$duration > 24) return 24;
                return (int)$duration;
                break;
            case 'Y':
                if((int)$duration > 5) return 5;
                return (int)$duration;
                break;
            
        }
    }

    return 1;

}

function easybook_add_ons_get_stripe_duration($duration = '', $unit = ''){
    if($duration){
        switch ($unit) {
            case 'day':
                return (int)$duration;
                break;
            case 'week':
                return 7*$duration;
                break;
            case 'month':
                return 30*$duration;
                break;
            case 'year':
                return 365*$duration;
                break;
            
        }
    }
    return 1;

}
function easybook_add_ons_get_payfast_duration_unit($unit = ''){

    $default = array(
        'day' => 'D',
        'week' => 'W',
        'month' => 'Monthly',
        'year' => 'Annual',
    );

    if( !empty($unit) && isset( $default[$unit] ) ){
        if($unit == 'day' || $unit == 'week' || $unit == 'month'){
            return $default['month'];
        }else{
            return $default['year'];
        } 
    } 

    return $default['month'];
}
function easybook_addons_get_current_subscription($user_ID = 0, $per_listing = false){
    if(!$user_ID){
        // return false when no user
        if(!is_user_logged_in()) return false;
        $user_ID = get_current_user_id();
    }

    $per_listing_sub = $per_listing ? 'yes' : 'no';

    $args = array(
        'posts_per_page'   => 1,
        'orderby'          => 'date',
        'order'            => 'DESC',
        // 'meta_key'         => ESB_META_PREFIX.'user_id',
        // 'meta_value'       => $user_ID,

        'post_author'       => $user_ID,
        'post_type'        => 'lorder',
        'post_status'      => 'publish',

        'meta_query' => array(
            'relation'  => 'AND',
            array(
                'relation'  => 'OR',
                array(
                    'key' => ESB_META_PREFIX.'status',
                    'value' => 'completed',
                ),
                array(
                    'key' => ESB_META_PREFIX.'status',
                    'value' => 'trialing',
                ),
            ),
            array(
                'key' => ESB_META_PREFIX.'user_id',
                'value' => $user_ID,
            ),
            array(
                'relation'  => 'OR',
                array(
                    'key'     => ESB_META_PREFIX.'end_date',
                    'value'   => 'NEVER',
                ),
                array(
                    'key'     => ESB_META_PREFIX.'end_date',
                    'value'   => current_time('mysql', 1),
                    'compare' => '>=',
                    'type'    => 'DATETIME',
                ),
            ),
            array(
                'key'     => ESB_META_PREFIX.'is_per_listing_sub',
                'value'   => $per_listing_sub,
            ),
        )

    );
    $posts_array = get_posts( $args );

    if(count($posts_array)){
        $order = $posts_array[0];
        $order_listings = get_post_meta( $order->ID, ESB_META_PREFIX.'listings', true );
        $order_limit = get_post_meta( $order->ID, ESB_META_PREFIX.'plan_llimit', true );
        return array(
            'id'            => $order->ID,
            'plan_id'       => get_post_meta( $order->ID, ESB_META_PREFIX.'plan_id', true ),
            'end_date'      => get_post_meta( $order->ID, ESB_META_PREFIX.'end_date', true ),
            'title'         => get_the_title( get_post_meta( $order->ID, ESB_META_PREFIX.'plan_id', true )),
            // listings attached to the subscription
            'listings'      => $order_listings,
            'plan_llimit'   => $order_limit, // unlimited or number

            'valid'         => count((array)$order_listings) < (int)$order_limit
        );
    }


    return false;


}
// for listing claim
function easybook_add_ons_get_claim_status($status = ''){
    $defaults = array(
        'pending'                   => esc_html__( 'Pending', 'easybook-add-ons' ),
        'asked_charge'              => esc_html__( 'Asked charge fee', 'easybook-add-ons' ),
        'paid'                      => esc_html__( 'Paid', 'easybook-add-ons' ),
        'approved'                  => esc_html__( 'Appproved', 'easybook-add-ons' ),
        'decline'                   => esc_html__( 'Decline', 'easybook-add-ons' ),
    );

    if($status != '' && isset($defaults[$status])) return $defaults[$status];

    return $defaults;
    
}

// for user notification
function easybook_addons_user_add_notification( $user_id = 0, $message = array() ){
    $user = get_user_by('ID', $user_id);
    if(!$user) return;

    if(!isset($message['type']) || !isset($message['message'])) return;

    $notifications = get_user_meta( $user->ID, ESB_META_PREFIX.'notifications', true );
    if(empty($notifications)) $notifications = array();

    $notifications[uniqid($message['type'])] = $message['message'];

    update_user_meta( $user->ID, ESB_META_PREFIX.'notifications', $notifications );

}




function easybook_addons_get_post_status($status){
    $statuses = array(
        'publish' => __( 'Publish', 'easybook-add-ons' ),
        'pending' => __( 'Pending', 'easybook-add-ons' ),
        'draft' => __( 'Draft', 'easybook-add-ons' ),
        'auto-draft' => __( 'Auto Draft', 'easybook-add-ons' ),
        'future' => __( 'Future', 'easybook-add-ons' ),
        'private' => __( 'Private', 'easybook-add-ons' ),
        'inherit' => __( 'Inherit', 'easybook-add-ons' ),
        'trash' => __( 'Trash', 'easybook-add-ons' ),
    );

    if(!empty($status) && isset($statuses[$status])) return $statuses[$status];

    return $statuses;

}
// display pacakge status - depends on backend order status and its expired date
function easybook_addons_get_package_status( $status ) {
    $statuses = array(
        'completed_in_time' => __( 'Active', 'easybook-add-ons' ),
        'completed_expired' => __( 'Expired', 'easybook-add-ons' ),
        'pending_in_time' => __( 'Pending', 'easybook-add-ons' ),
        'pending_expired' => __( 'Pending - Expired', 'easybook-add-ons' ),

        'trialing_in_time' => __( 'Trialing', 'easybook-add-ons' ),
        'trialing_expired' => __( 'Trialing - Expired', 'easybook-add-ons' ),
        
    );
    if(!empty($status) && isset($statuses[$status])) return $statuses[$status];

    return $statuses['pending_in_time'];
}
function easybook_addons_get_package_time_status($post_ID){
    $end_date = get_post_meta( $post_ID, ESB_META_PREFIX.'end_date', true );
    $current_date = current_time( 'mysql' , 1);
    if($end_date >= $current_date)
        return 'in_time';
    else
        return 'expired';
}
// get order/package/membership payment type - One Time or Recurring
function easybook_addons_get_order_type($meta = ''){
    if($meta == 'on'){
        // on is because using cmb2
        return __( 'Recurring', 'easybook-add-ons' );
    }

    return __( 'One Time', 'easybook-add-ons' );
}

function easybook_addons_get_post_orderby($order = ''){
    $orders = array(
        'none'  => __( 'No order', 'easybook-add-ons' ),
        'ID'  => __( 'Order by post id', 'easybook-add-ons' ),
        'author'  => __( 'Order by author', 'easybook-add-ons' ),
        'title'  => __( 'Order by post title', 'easybook-add-ons' ),
        'name'  => __( 'Order by post slug', 'easybook-add-ons' ),
        'type'  => __( 'Order by post type', 'easybook-add-ons' ),
        'date'  => __( 'Order by date', 'easybook-add-ons' ),
        'modified'  => __( 'Order by last modified date', 'easybook-add-ons' ),
        'parent'  => __( 'Order by post parent id', 'easybook-add-ons' ),
        'rand'  => __( 'Random order', 'easybook-add-ons' ),
        'comment_count'  => __( 'Order by number of comments', 'easybook-add-ons' ),
        'relevance'  => __( 'Order by search terms', 'easybook-add-ons' ),
        'menu_order'  => __( 'Order by Page Order', 'easybook-add-ons' ),
    );

    if(!empty($order) && isset($orders[$order])) return $orders[$order];

    return $orders;
}

function easybook_addons_get_listing_content_order_default(){
    return array('promo_video','content','gallery','slider','faqs','speaker','rooms','amenities');
}
function easybook_addons_get_listing_widget_order_default(){
    return array('countdown','price_range','booking','weather','contacts','author','moreauthor');
}

function easybook_addons_display_recaptcha($ele_id){
    if( easybook_addons_get_option('enable_g_recaptcah') == 'yes' && easybook_addons_get_option('g_recaptcha_site_key') != '' ) 
        echo '<div id="'.$ele_id.'" class="cth-recaptcha mt-20"></div>';
}

function easybook_addons_verify_recaptcha(){
        
    if( easybook_addons_get_option('enable_g_recaptcah') == 'yes' && easybook_addons_get_option('g_recaptcha_secret_key') != '' ){
        if( !isset( $_POST['g-recaptcha-response'] ) || empty( $_POST['g-recaptcha-response'] ) ) return false;

        // $response = wp_remote_get( 
        //     add_query_arg( 
        //         array(
        //             'secret'   => easybook_addons_get_option('g_recaptcha_secret_key'),
        //             'response' => isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '',
        //             'remoteip' => isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']
        //         ), 
        //         'https://www.google.com/recaptcha/api/siteverify' 
        //     ) 
        // );

        $response = wp_remote_post( 
            'https://www.google.com/recaptcha/api/siteverify' ,
            array(
                'body' =>   array(
                                'secret'   => easybook_addons_get_option('g_recaptcha_secret_key'),
                                'response' => $_POST['g-recaptcha-response'],
                                'remoteip' => isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']
                            )
            )
        );

        // return json_decode( $response['body'] ); // captcha: {success: true, challenge_ts: "2019-03-19T09:58:27Z", hostname: "localhost"}

        if( is_wp_error( $response ) || empty($response['body']) || ! ($json = json_decode( $response['body'] )) || ! $json->success ) {
            //return new WP_Error( 'validation-error',  __('reCAPTCHA validation failed. Please try again.' ) );
            return false;
        }

        return true;
    }

    return true;
}
// https://stackoverflow.com/questions/10808109/script-tag-async-defer
function easybook_addons_add_async_forscript($url)
{
    if(is_admin()){
        return str_replace(array('#cthasync','#cthdefer'), '', $url);
    }else{
        if(strpos($url, '#cthasync') !== false) $url = str_replace('#cthasync', '', $url)."' async='async"; 
        if(strpos($url, '#cthdefer') !== false) $url = str_replace('#cthdefer', '', $url)."' defer='defer"; 
    }

    return $url;


    // if (strpos($url, '#cthasync')===false)
    //     return $url;
    // else if (is_admin())
    //     return str_replace('#cthasync', '', $url);
    // else
    //     return str_replace('#cthasync', '', $url)."' async='async"; 
}
add_filter('clean_url', 'easybook_addons_add_async_forscript', 11, 1);


function easybook_addons_check_package_field($field_name='', $is_single = false, $user_ID = 0){
    
    if($field_name!=''){
        if($is_single){
            if($plan_id = get_post_meta( get_the_ID(), ESB_META_PREFIX.'plan_id', true ) ){
                return get_post_meta( $plan_id, ESB_META_PREFIX.$field_name, true );
            }elseif( $order_id = get_post_meta( get_the_ID(), ESB_META_PREFIX.'order_id', true ) ){
                return get_post_meta( get_post_meta( $order_id, ESB_META_PREFIX.'plan_id', true ), ESB_META_PREFIX.$field_name, true );
            }else{
                // show all for administrator
                //if( easybook_addons_get_user_role() == 'administrator' ) return false;
                return easybook_addons_get_option('submit_'.$field_name);
            }
        }
        $user_current_subscription = easybook_addons_get_current_subscription( $user_ID );
        if( false == $user_current_subscription || false == $user_current_subscription['valid'] ){
            // get default setting field
            return easybook_addons_get_option('submit_'.$field_name);
        }else{
            // get package setting field
            return get_post_meta( $user_current_subscription['plan_id'], ESB_META_PREFIX.$field_name, true );
        }
    }
    return false;

}

function easybook_addons_check_package_single_field($field_name='', $listing_ID = 0){
    // show all for administrator
    //if( easybook_addons_get_user_role() == 'administrator' ) return false;
    if($field_name!=''){
        if(empty($listing_ID)){
            $listing_ID = get_the_ID();
        }
        if($plan_id = get_post_meta( $listing_ID, ESB_META_PREFIX.'plan_id', true ) ){
            return get_post_meta( $plan_id, ESB_META_PREFIX.$field_name, true );
        }elseif( $order_id = get_post_meta( $listing_ID, ESB_META_PREFIX.'order_id', true ) ){
            return get_post_meta( get_post_meta( $order_id, ESB_META_PREFIX.'plan_id', true ), ESB_META_PREFIX.$field_name, true );
        }else{
            return easybook_addons_get_option('single_'.$field_name);
        }
    }
    return false;
}
function easybook_addons_get_active_plan_ids(){

    $post_args = array(
        'fields'            => 'ids',
        'post_type'         => 'lplan',
        'posts_per_page'    => -1,
        'post_status'       => 'publish'
    );

    return get_posts($post_args);

}

// handle image upload with multiple files
function easybook_addons_handle_image_multiple_upload($field_name, $post_id = 0){
    $return_array = array();

    if($field_name != '' && isset($_FILES[$field_name])){
        $process_files = array();
        $field_name_files = $_FILES[$field_name];  
        foreach ($field_name_files['name'] as $key => $value) {            
            if ($field_name_files['name'][$key]) {
                $file = array( 
                    'name' => $field_name_files['name'][$key],
                    'type' => $field_name_files['type'][$key], 
                    'tmp_name' => $field_name_files['tmp_name'][$key], 
                    'error' => $field_name_files['error'][$key],
                    'size' => $field_name_files['size'][$key]
                ); 
                $process_files[] = $file;
                
            }
        } 

        

        foreach ($process_files as $key => $file) {
                
            $movefile = easybook_addons_handle_image_upload($file);

            if(is_array($movefile)){

                // https://wordpress.stackexchange.com/questions/40301/how-do-i-set-a-featured-image-thumbnail-by-image-url-when-using-wp-insert-post
                // https://codex.wordpress.org/Function_Reference/wp_insert_attachment
                // Prepare an array of post data for the attachment.
                $attachment = array(
                    // 'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
                    'post_mime_type' => $movefile['type'],
                    'post_title'     => sanitize_file_name(basename($movefile['file'])),
                    'post_content'   => '',
                    'post_status'    => 'inherit'
                );

                // // Insert the attachment.
                $attach_id = wp_insert_attachment( $attachment, $movefile['file'], $post_id );

                if($attach_id != 0){
                    // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
                    require_once( ABSPATH . 'wp-admin/includes/image.php' );

                    // Generate the metadata for the attachment, and update the database record.
                    $attach_data = wp_generate_attachment_metadata( $attach_id, $movefile['file'] );
                    // return value from update_post_meta -  https://codex.wordpress.org/Function_Reference/update_post_meta
                    // Returns meta_id if the meta doesn't exist, otherwise returns true on success and false on failure. NOTE: If the meta_value passed to this function is the same as the value that is already in the database, this function returns false.
                    wp_update_attachment_metadata( $attach_id, $attach_data );
                    // Post meta ID on success, false on failure.
                    // $json['data']['meta_id'] = set_post_thumbnail( $listing_id, $attach_id );

                    // $headerimgsMeta[] = array( $attach_id , wp_get_attachment_url( $attach_id ) );
                    $return_array[$attach_id] = wp_get_attachment_url( $attach_id ) ;
                }

            }

        }

        

    }
    // end if check

    return $return_array;
}

// https://codex.wordpress.org/Function_Reference/wp_handle_upload
function easybook_addons_handle_image_upload($uploadedfile){
    if ( ! function_exists( 'wp_handle_upload' ) ) {
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
    }

    // check to make sure its a successful upload
    if ($uploadedfile['error'] !== UPLOAD_ERR_OK) return 'No file was uploaded.';
    // $uploadedfile = $_FILES['file'];
    if( $uploadedfile['size']/1024/1024 > easybook_addons_get_option('submit_media_limit_size') ){
        if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "File uploaded is too large. " . $uploadedfile['size']/1024/1024 . PHP_EOL, 3, ESB_LOG_FILE);
        return 'File uploaded is too large';
    }

    $upload_overrides = array( 'test_form' => false );

    $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

    if ( $movefile && ! isset( $movefile['error'] ) ) {
        // echo "File is valid, and was successfully uploaded.\n";
        // var_dump( $movefile );
        return $movefile;
    } else {
        /**
         * Error generated by _wp_handle_upload()
         * @see _wp_handle_upload() in wp-admin/includes/file.php
         */
        return $movefile['error'];
    }
}
function easybook_addons_limit_upload_size( $file ) {

    // Set the desired file size limit
    $file_size_limit = easybook_addons_get_option('submit_media_limit_size'); // in MB
    // exclude admins
    if ( ! current_user_can( 'manage_options' ) ) {

        $current_size = $file['size'];
        $current_size = $current_size / 1024 / 1024; //get size in MB

        if ( $current_size > $file_size_limit ) {
            $file['error'] = sprintf( __( 'ERROR: File size limit is %d MB.', 'easybook-add-ons' ), $file_size_limit );
        }

    }
    return $file;
}
add_filter ( 'wp_handle_upload_prefilter', 'easybook_addons_limit_upload_size', 10, 1 );


function easybook_addons_post_nav( $tax = 'category' ) {
    
    if( easybook_addons_get_option('single_post_nav' ) != 'yes' ) return ;

    $prev_post = get_adjacent_post( easybook_addons_get_option('single_same_term' ) , '', true, $tax );
    $next_post = get_adjacent_post( easybook_addons_get_option('single_same_term' ) , '', false, $tax );

    if ( is_a( $prev_post, 'WP_Post' ) || is_a( $next_post, 'WP_Post' ) ) :
?>
<div class="post-nav single-post-nav listing-post-nav fl-wrap">
<?php
    if ( is_a( $prev_post, 'WP_Post' ) ) :
    ?>
    <a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="post-link prev-post-link" title="<?php echo esc_attr( get_the_title($prev_post->ID ) ); ?>"><i class="fa fa-angle-left"></i><?php esc_html_e('Prev','easybook-add-ons' );?><span class="clearfix"><?php echo get_the_title($prev_post->ID ); ?></span></a>
    <?php 
    endif ; ?>
<?php
    if ( is_a( $next_post, 'WP_Post' ) ) :
    ?>
    <a href="<?php echo get_permalink( $next_post->ID ); ?>" class="post-link next-post-link" title="<?php echo esc_attr( get_the_title($next_post->ID ) ); ?>"><i class="fa fa-angle-right"></i><?php esc_html_e('Next','easybook-add-ons' );?><span class="clearfix"><?php echo get_the_title($next_post->ID ); ?></span></a>
    <?php 
    endif ; ?>
</div>
<?php
    endif;
}


function easybook_addons_get_url_check_out($postID = 0,$roomID = 0){
    $checkout_page_id = easybook_addons_get_option('checkout_page');
    $args = array(
        'listing_id' => $postID,
        'lb_room'   => $roomID,
    );
    $url = add_query_arg( $args, get_permalink($checkout_page_id));
   
    return $url ;
}

function easybook_addons_get_average_price($listing_id = 0){
    if($listing_id == 0) $listing_id = get_the_ID();
    // $rooms_ids = get_post_meta( $listing_id, ESB_META_PREFIX.'rooms_ids', true );
    // $rooms_prices = array();
    // if( is_array($rooms_ids) && !empty($rooms_ids) ){
    //     foreach ($rooms_ids as $rid) {
    //         $rooms_prices[] = (float) get_post_meta( $rid, '_price', true );
    //     }
    // }
    // if(!empty($rooms_prices)) 
    //     $lprice =  round((array_sum($rooms_prices) / count($rooms_prices)), 2, PHP_ROUND_HALF_UP);
    // else
    //     $lprice = get_post_meta( $listing_id, '_price', true );

    $lprice = get_post_meta( $listing_id, '_price', true );

    return apply_filters( 'esb_listing_average_price', $lprice, $listing_id );
}
function easybook_addons_upload_dirs($base_name = 'azp', $child = ''){
    $upload = wp_upload_dir();
    $upload_dir = $upload['basedir'];
    $base_dir = $upload_dir . DIRECTORY_SEPARATOR . $base_name;
    // if (! is_dir($base_dir)) {
    //    mkdir( $base_dir, 0755 );
    // }
    wp_mkdir_p( $base_dir );
    if($child != ''){
        $child_dir = $base_dir . DIRECTORY_SEPARATOR . $child;
        // if (! is_dir($child_dir)) 
        //     mkdir( $child_dir, 0755 );

        wp_mkdir_p( $child_dir );

        return $child_dir;
    }
    return $base_dir;
}
function easybook_addons_azp_parser_listing($listing_type_id = 0, $builder = '', $post_id = 0, $language = '', $currency = ''){
    if( empty($listing_type_id) || null === get_post($listing_type_id) ) 
        $listing_type_id = easybook_addons_get_option('default_listing_type');

    $shortcode = get_post_meta( (int)$listing_type_id, ESB_META_PREFIX . $builder . '_layout', true );
    return (new AZPParser)->doContentShortcode($shortcode);

    // $shortcode = get_post_meta( (int)$listing_type_id, ESB_META_PREFIX . $builder . '_layout', true );
    // $azp_parser = new AZPParser();
    // return $azp_parser->doContentShortcode($shortcode);
    
    if($language == '') $language = get_locale();
    if($language == '') $language = 'en_US';

    $currency = easybook_addons_get_currency();

    $cache_group = "azp_group_{$listing_type_id}";
    $new_cache_name = "azp_{$builder}_{$language}_{$currency}";
    if( $post_id ){
        $new_cache_name = "azp_{$post_id}_{$builder}_{$language}_{$currency}";
    }
    $azp_store_cache = wp_cache_get( $new_cache_name,  $cache_group);
    if ( false === $azp_store_cache ) {
        $shortcode = get_post_meta( (int)$listing_type_id, ESB_META_PREFIX . $builder . '_layout', true );
        $azp_parser = new AZPParser();
        $azp_store_cache = $azp_parser->doContentShortcode($shortcode);
        // do not cache for single layout
        if ( easybook_addons_get_option('azp_cache') == 'yes' && $builder != 'single' ) wp_cache_set( $new_cache_name, $azp_store_cache, $cache_group, DAY_IN_SECONDS );
    } 
    // Do something with $result;
    return $azp_store_cache;


    $last_modified_ltype_post = get_post_modified_time('G', true, $listing_type_id);

    // // azp caches folder
    // $upload = wp_upload_dir();
    // // $upload_path = $upload['path'];
    // $upload_path = $upload['basedir'] . DIRECTORY_SEPARATOR . 'azp' . DIRECTORY_SEPARATOR;

    $upload_path = easybook_addons_upload_dirs('azp', $builder);
    
    // cache file name
    $cache_name = "{$listing_type_id}";
    if($post_id){
        $cache_name = "{$post_id}";

        $last_modified_post = get_post_modified_time('G', true, $post_id);
        if($last_modified_post && $last_modified_post > $last_modified_ltype_post) $last_modified_ltype_post = $last_modified_post;
    }
    $cache_file = $upload_path . DIRECTORY_SEPARATOR . "{$cache_name}_{$language}_{$currency}";

    $cache_file = apply_filters( 'esb_azp_listing_cache_file', $cache_file, $listing_type_id, $post_id, $language, $currency );

    if( $builder != 'single' && file_exists($cache_file) && (filemtime($cache_file) > ($last_modified_ltype_post - 60 * 1 ))  && easybook_addons_get_option('azp_cache') == 'yes' ) {
        // Cache file is less than five minutes old. 
        // Don't bother refreshing, just use the file as-is.
        $layout = file_get_contents($cache_file);
    }else{
        // Our cache is out-of-date, so load the data from our remote server,
        // and also save it over our cache for next time.
        $shortcode = get_post_meta( (int)$listing_type_id, ESB_META_PREFIX . $builder . '_layout', true );
        $layout = (new AZPParser())->doContentShortcode($shortcode);
        // do not save cache for single listing
        if($builder != 'single' && easybook_addons_get_option('azp_cache') == 'yes') file_put_contents($cache_file, $layout, LOCK_EX); //-> not create file;
        // file_put_contents($cache_file, $layout);
    }

    return $layout;
}

function easybook_addons_get_filter_variable($cookie_name = '', $default = 0){
    if(!empty($cookie_name)){
        if(isset($_COOKIE[$cookie_name]) && !empty($_COOKIE[$cookie_name])) return $_COOKIE[$cookie_name];
    }
    return $default;

    // $checkin_val = 0;
    // if(isset($_COOKIE['esb_checkin']) && $_COOKIE['esb_checkin'] != '' ) $checkin_val = $_COOKIE['esb_checkin'];

}
function easybook_addons_get_filter_checkinout($cookie_name = '', $modify = 0){
    $default = easybook_addons_booking_date_modify('', $modify, 'Y-m-d');
    if(!empty($cookie_name)){
        if(isset($_COOKIE[$cookie_name]) && !empty($_COOKIE[$cookie_name])) 
            $cookie_val = $_COOKIE[$cookie_name];
        else 
            $cookie_val = $default;
        if(easybook_addons_booking_nights('now', $cookie_val)) return $cookie_val;
    }
    return $default;
}
function easybook_addons_get_listing_type_options(){
    $options = array();
    $posts = get_posts( array(
        'fields'            => 'ids',
        'post_type'         => 'listing_type',
        'posts_per_page'    => -1,
        'post_status'       => 'publish',

    ) );
    if($posts){
        foreach ($posts as $ltid) {
            $options[$ltid] = get_the_title( $ltid );
        }
    }
    return $options;
}
function easybook_addons_format_pricing_yearly_sale($reduction = 0){
    if(!empty($reduction)){
        return sprintf(__( '-%d%%', 'easybook-add-ons' ), $reduction);
    }
    return '';
}

function easybook_addons_calculate_yearly_price($price = 0, $period = 'month', $interval = 1, $sale = 0){
    // period - day/week/month/year
    if($price <= 0 || $interval <= 0) return 0;
    switch ($period) {
        case 'day':
            $yearly_price = 365*($price/$interval);
            break;
        case 'week':
            $yearly_price = 52*($price/$interval);
            break;
        case 'month':
            $yearly_price = 12*($price/$interval);
            break;
        default:
            $yearly_price = 1*($price/$interval);
            break;
    }
    return $yearly_price * (100 - $sale)/100;
}

function easybook_addons_add_listing_url(){
    if( is_user_logged_in() && ( get_user_meta( get_current_user_id(), ESB_META_PREFIX.'member_plan', true ) != '' || easybook_addons_get_user_role() == 'administrator' ) ){
        return get_permalink( easybook_addons_get_option('dashboard_page') ).'#/addListing';
    }else return get_permalink( easybook_addons_get_option('free_submit_page') );
}
function easybook_addons_dashboard_screen($screen = ''){
    if($screen != '') 
        return get_permalink( easybook_addons_get_option('dashboard_page') ).'#/'.$screen;
    else
        return get_permalink( easybook_addons_get_option('dashboard_page') );
}

function easybook_addons_encodeURIComponent($str) {
    $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
    return strtr(rawurlencode($str), $revert);
}

function easybook_addons_create_purchase_code($suffix = ''){
    if (function_exists('com_create_guid'))
    {
        if($suffix != '') 
            return trim(com_create_guid(), '{}').'-'.$suffix;
        else
            return trim(com_create_guid(), '{}');
    }

    $format = '%04X%04X-%04X-%04X-%04X-%04X%04X%04X';
    if($suffix != '') $format .= '-'.$suffix;
    return sprintf($format, mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

// create new invoice
function easybook_addons_create_invoice($data){

    // $required_data = array(
    //     'order_id',
    //     'user_id',
    //     'user_name',
    //     'user_email',
    //     'from_date',
    //     'end_date',
    //     'payment',
    //     'txn_id',

    //     'plan_title',
    //     'quantity',
    //     'amount',
    //     'tax',
    //     'charged_to',
    // );

    $invoice_datas                      = array();
    $invoice_datas['post_title']        = sprintf(__( 'Invoice for package #%s', 'easybook-add-ons' ), $data['order_id']);
    $invoice_datas['post_content']      = '';
    $invoice_datas['post_author']       = $data['user_id'];
    $invoice_datas['post_status']       = 'publish';
    $invoice_datas['post_type']         = 'cthinvoice';

    do_action( 'easybook_addons_insert_invoice_before', $invoice_datas );

    $cthinvoice_id = wp_insert_post($invoice_datas ,true );

    if (!is_wp_error($cthinvoice_id)) {
        // if( easybook_addons_get_option('db_hide_invoices') != 'yes' ){
        //     easybook_addons_user_add_notification($data['user_id'], array(
        //         'type'          => 'new_invoice',
        //         'message'       => sprintf(__( 'You have a new invoice. ID: %s', 'easybook-add-ons' ), $cthinvoice_id ),
        //         'object'        => $cthinvoice_id
        //     ));
        // }

        // easybook_addons_user_add_notification($data['user_id'], array(
        //     'type' => 'new_invoice',
        //     'entity_id'     => $cthinvoice_id,
        // ));
            

        $meta_datas = array(
            'order_id'                  => $data['order_id'],

            'user_id'                   => $data['user_id'],
            'user_name'                 => $data['user_name'],
            'user_email'                => $data['user_email'],
            
            'from_date'                 => $data['from_date'],
            'end_date'                  => $data['end_date'],
            'payment'                   => $data['payment'],
            'txn_id'                    => $data['txn_id'],

            'plan_title'                => $data['plan_title'],
            'quantity'                  => $data['quantity'],
            'amount'                    => $data['amount'], // will be order total - 
            'tax'                       => $data['tax'], // maybe not needed
            'charged_to'                => $data['charged_to'], // if want to display card number

            'for_listing_ad'            => (isset($data['for_listing_ad']) && $data['for_listing_ad'] == 'yes') ? 'yes' : 'no',
        );

        foreach ($meta_datas as $key => $value){
            if ( !update_post_meta( $cthinvoice_id, ESB_META_PREFIX.$key, $value ) ) {
                if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). sprintf(__('Insert invoice %s meta failure or existing meta value','easybook-add-ons'),$key) . PHP_EOL, 3, ESB_LOG_FILE);
            }
        }

        do_action( 'easybook_addons_new_invoice', $cthinvoice_id );

        return $cthinvoice_id;

    }

    return false;

}
function easybook_addons_dashboard_posts_per_page(){

    $posts_per_page = easybook_addons_get_option('listings_per');
    if(!is_numeric($posts_per_page)) 
        return 5;
    else 
        return intval($posts_per_page);
}

function easybook_addons_add_to_cart_link($product_id = 0, $quantity = 1){
    $checkout_page_id = easybook_addons_get_option('checkout_page');
    // if(empty($quantity)) $quantity = 1;
    $args = array(
        'esb_add_to_cart' => $product_id,
        // 'quantity'   => $quantity,
        // '_wpnonce'          => wp_create_nonce( -1 ),
    );
    if($quantity > 1) $args['quantity'] = $quantity;
    $url = add_query_arg( $args, get_permalink($checkout_page_id));

    return wp_nonce_url($url, 'esb_add_to_cart');
}

function easybook_addons_listing_ad_positions($pos = ''){
    $positions = array(
                    'sidebar'=> esc_html__('Sidebar','easybook-add-ons'),
                    'archive'=> esc_html__('Listing Archive','easybook-add-ons'),
                    'category'=> esc_html__('Listing Category','easybook-add-ons'),
                    'search'=> esc_html__('Listing Search','easybook-add-ons'),
                    'home'=> esc_html__('Elementor Listings Slider','easybook-add-ons'),
                    'custom_grid' => esc_html__('Elementor Listings Grid','easybook-add-ons'),
                );
    $positions = apply_filters( 'easybook_addons_ad_positions', $positions );
    if(!empty($pos) && isset($positions[$pos])) return $positions[$pos];

    return $positions;
}

function easybook_addons_ad_listing_before_loop(){
    if(easybook_addons_get_option('search_infor_before') == '') return;
    ?>
    <div class="listing-loop-before">
        <?php echo do_shortcode(easybook_addons_get_option('search_infor_before')) ?>
    </div>
    <?php
}
add_action( 'easybook_addons_listings_loop_before', 'easybook_addons_ad_listing_before_loop' );
function easybook_addons_ad_listing_after_loop(){
    if(easybook_addons_get_option('search_infor_after') == '') return;
    ?>
    <div class="listing-loop-after">
        <?php echo do_shortcode(easybook_addons_get_option('search_infor_after')) ?>
    </div>
    <?php
}
add_action( 'easybook_addons_listings_loop_after', 'easybook_addons_ad_listing_after_loop' );



function easybook_addons_get_listing_cats(){
    $return = array();
    $taxonomies = get_terms( array(
        'taxonomy'          => 'listing_cat',
        'hide_empty'        => false,
        'parent'            => 0,
    ) );
    if ( $taxonomies && ! is_wp_error( $taxonomies ) ){ 
        foreach ( $taxonomies as $term ) {
            $return[] = array(
                'name' => $term->name,
                'id'   =>  $term->term_id,
            );      
        }
    }
    return $return;
}
function easybook_addons_get_listing_locs(){
    $return = array();
    $taxonomies = get_terms( array(
        'taxonomy'          => 'listing_location',
        'hide_empty'        => false,
        'parent'            => 0,
    ) );
    if ( $taxonomies && ! is_wp_error( $taxonomies ) ){ 
        foreach ( $taxonomies as $term ) {
            $return[] = array(
                'name' => $term->name,
                'id'   =>  $term->term_id,
            );      
        }
    }
    return $return;
}
// If Redux is running as a plugin, this will remove the demo notice and links
add_action( 'redux/loaded', function(){
    // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
    if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
        remove_filter( 'plugin_row_meta', array(
            ReduxFrameworkPlugin::instance(),
            'plugin_metalinks'
        ), null, 2 );

        // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
        remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
    }
} );

function easybook_addons_get_calendar_type_dates($post_id = 0){
    $dates_string = get_post_meta( $post_id, ESB_META_PREFIX.'listing_dates', true );
    if(!empty($dates_string)){
        $event_dates = explode(";", $dates_string);
        $event_dates = array_filter($event_dates);
        // sort date asc
        asort($event_dates);
        return $event_dates;
    }
    return array();
}
function easybook_addons_get_event_dates($post_id = 0, $nexts = true){
    $event_dates = easybook_addons_get_calendar_type_dates( $post_id );
    if( empty($event_dates) ) 
        return array();
    $dates_metas = get_post_meta( $post_id, ESB_META_PREFIX.'listing_dates_metas', true );

    // old version
    $levent_time = get_post_meta( $post_id, ESB_META_PREFIX.'levent_time', true );

    $dates_ad_meta = array();
    $curr = current_time( 'Ymd' );
    foreach ($event_dates as $date) {
        if( $nexts === false || $nexts && $curr <= $date ){
            $metas = array(
                'start_date' => '',
                'start_time' => '',
                'end_date'  => '',
            );
            if(isset($dates_metas[$date])){
                if(isset($dates_metas[$date]['start_time'])){
                    $metas['start_time'] = $dates_metas[$date]['start_time'];
                }else{
                    $metas['start_time'] = $levent_time;
                }
                if(isset($dates_metas[$date]['end_date']))
                    $metas['end_date'] = $dates_metas[$date]['end_date'];
            }else{
                $metas['start_time'] = $levent_time;
                $metas['end_date'] = easybook_addons_format_cal_date( $date );
            }

            $metas['start_date'] = easybook_addons_format_cal_date( $date ) .' ' . $metas['start_time'];

            $dates_ad_meta[$date] = $metas;
        }
            
    }
    
    return $dates_ad_meta;
}
function easybook_addons_next_event_date($post_id = 0){
    $event_dates = easybook_addons_get_event_dates($post_id);
    if(empty($event_dates)) 
        return array();

    return reset($event_dates);
}

function easybook_addons_format_cal_date($date){
    if($date != '' && strlen($date) === 8){
        $date = substr($date, 0, 4) . '-' . substr($date, 4, 2) . '-' . substr($date, -2);
    }
    return $date;
}
function easybook_addons_get_event_time_string($post_id = 0){
    $next_date = easybook_addons_next_event_date($post_id);
    if(empty($next_date)) 
        return '';
    return sprintf( __( 'Next event will begin on <span>%s</span> at <span>%s</span>', 'easybook-add-ons' ), date_i18n( get_option( 'date_format' ), strtotime( $next_date['start_date'] ) ), date_i18n( get_option( 'time_format' ), strtotime( $next_date['start_date'] ) ) );
}

function easybook_addons_loggedin_plans_options(){
    $results = array(
        // ''                      => __( 'None', 'easybook-add-ons' ),
        'logout_user'           => __( 'Logout user', 'easybook-add-ons' ),
    );

    $post_args = array(
        'post_type'             => 'lplan',
        'posts_per_page'        => -1,
        'orderby'               => 'date',
        'order'                 => 'DESC',
        'post_status'           => 'publish',
        'fields'                => 'ids',
    );
    $posts = get_posts( $post_args );
    if ( $posts ) {
        foreach ( $posts as $post ) {
            // $results[$post->ID] = apply_filters( 'the_title' , $post->post_title );
            $results[$post] = sprintf( __( '%s plan', 'easybook-add-ons' ), get_the_title( $post ) );
        }
    }

    $results = (array) apply_filters( 'esb_hide_on_plans', $results );

    return $results;
}

function easybook_addons_is_hide_on_plans($hide_on_plans = '', $post_id = 0){
    if($hide_on_plans == '') 
        return 'false';
    
    $hide_on_plans = explode("||", $hide_on_plans);

    if( in_array('logout_user', $hide_on_plans) && !is_user_logged_in()  ) return 'true';

    if( $post_id == 0 ) 
        $author_id = get_the_author_meta('ID');
    else
        $author_id = get_post_field( 'post_author', $post_id );

    if(easybook_addons_get_user_role($author_id) == 'administrator')
        return 'false';

    // $member_plan = get_user_meta( $author_id, ESB_META_PREFIX.'member_plan', true );
    if( in_array( get_user_meta( $author_id, ESB_META_PREFIX.'member_plan', true ) , $hide_on_plans ) ){
        if( get_current_user_id() == $author_id )
            return 'on-author';
        else
            return 'true';
    }

    return 'false';
}
function easybook_addons_check_hide_on_logout_user($hide_on_plans = ''){
    if(is_user_logged_in()){
        return false;
    }else{
        $hide_on_plans = explode("||", $hide_on_plans);
        if( in_array('logout_user', $hide_on_plans) ) 
            return true;
    }
    return false;
}

function easybook_addons_payfast_frequency($duration = '', $period = ''){
    if($duration){
        switch ($period) {
            case 'day':
            case 'week':
                return 3;
                break;
            case 'month':
                if($duration > 3)
                    return 5;
                else if($duration > 2)
                    return 4;
                else 
                    return 3;
                break;
            case 'year':
                return 6;
                break;
            
        }
    }
    return 3; 
    // numeric:
    // 3- Monthly
    // 4- Quarterly
    // 5- Biannual
    // 6- Annual
}
function easybook_addons_alphanumeric($str = ''){
    return preg_replace('/[^a-zA-Z0-9]/', "", $str);
}
function easybook_addons_must_enqueue_media(){
    if( current_user_can( 'upload_files' ) ){
        // $submit_page = easybook_addons_get_option('submit_page');
        // $edit_page = easybook_addons_get_option('edit_page');
        $dashboard_page = easybook_addons_get_option('dashboard_page');
        if( /*( $submit_page!='' && is_page($submit_page) ) || ( $edit_page!='' && is_page($edit_page) ) || */ ( $dashboard_page!='' && is_page($dashboard_page) ) ) 
            return true;
    }
    return false;
}
function easybook_addons_must_enqueue_editor(){
    // $submit_page = easybook_addons_get_option('submit_page');
    // $edit_page = easybook_addons_get_option('edit_page');
    $dashboard_page = easybook_addons_get_option('dashboard_page');
    if( /*( $submit_page!='' && is_page($submit_page) ) || ( $edit_page!='' && is_page($edit_page) ) || */ ( $dashboard_page!='' && is_page($dashboard_page) ) ) 
        return true;

    return false;
}

function easybook_addons_get_map_data($lid = 0){
    if($lid == 0) $lid = get_the_ID();
    $rating = easybook_addons_get_average_ratings($lid);
    $wkhour = easybook_addons_get_working_hours($lid);
    // $price_range = get_post_meta( $lid, ESB_META_PREFIX.'price_range', true );
    // $levent_date = get_post_meta( $lid, ESB_META_PREFIX.'levent_date', true );
    // $levent_time = get_post_meta( $lid, ESB_META_PREFIX.'levent_time', true );
    // $typeID      =  get_post_meta( $lid, ESB_META_PREFIX.'listing_type_id', true );
    // if(empty($typeID)) $typeID = easybook_addons_get_option('default_listing_type'); 

    $listing_post = array(
        'url'                       => get_the_permalink($lid),
        'rating'                    => $rating,
        'cats'                      => array(),
        'title'                     => get_the_title( $lid ),
        // 'excerpt'                   => easybook_addons_the_excerpt_max_charlength(easybook_addons_get_option('excerpt_length','55'),false), // get_the_excerpt(),
        // 'thumbnail'                 =>'',
        // 'phone'                     =>'',
        // 'latitude'                  =>'',
        // 'longitude'                 =>'',
        // 'address'                   =>'',
        // 'like_stats'                => easybook_addons_get_likes_stats($lid),
        // 'author_avatar'             => get_avatar_url( get_the_author_meta('user_email'), array('size'=>80, 'default'=>'https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=80') ),
        // get_avatar(get_the_author_meta('user_email'),'80','https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=80', get_the_author_meta( 'display_name' ) ),
        // 'author_url'                => get_author_posts_url( get_the_author_meta( 'ID' )),
        // 'author_name'               => get_the_author(),

        'ID'                        => $lid,
        'status'                    => $wkhour['status'],
        'statusText'                => $wkhour['statusText'],
        // 'bookmarked'                => easybook_addons_already_bookmarked($lid),
        'price_from'                => get_post_meta( $lid, ESB_META_PREFIX.'price_from', true ),
        'price_to'                  => get_post_meta( $lid, ESB_META_PREFIX.'price_to', true ),
        // 'price_from_formated'       => easybook_addons_get_price_formated(get_post_meta( $lid, ESB_META_PREFIX.'price_from', true )),
        // 'price_to_formated'         => easybook_addons_get_price_formated(get_post_meta( $lid, ESB_META_PREFIX.'price_to', true )),

        'verified'                  => get_post_meta( $lid, ESB_META_PREFIX.'verified', true ),
        // 'price_range'               => ( $price_range != '' && $price_range != 'none' )? easybook_addons_get_listing_price_range( $price_range ) : '',

        // 'view'                      => Esb_Class_LStats::get_stats($lid),
        // 'levent_date'               => $levent_date,
        // 'levent_time'               => $levent_time,
        // 'event_date_text'           => $levent_date !='' ? sprintf( __( 'Next event will begin on <span>%s</span> at <span>%s</span>', 'easybook-add-ons' ), date_i18n( get_option( 'date_format' ), strtotime( $levent_date.' '.$levent_time ) ), date_i18n( get_option( 'time_format' ), strtotime( $levent_date.' '.$levent_time ) ) ) : '',
        

        // 'hide_author_info'          => easybook_addons_check_package_single_field( 'hide_author_info' ),

        'gmap_marker'               => '',
        'featured'                  => get_post_meta( $lid, ESB_META_PREFIX.'featured', true ),
        // 'typeID'                    => $typeID, 
        // 'is_ad'                     => $is_ad,
    );

    $listing_post['thumbnail'] = esc_url( easybook_addons_get_attachment_thumb_link( easybook_addons_get_listing_thumbnail( $lid ) ,'easybook-listing-grid') );

    $cats = get_the_terms($lid, 'listing_cat');
    if ( $cats && ! is_wp_error( $cats ) ){
        // echo '<div class="list-single-header-cat fl-wrap">';
        foreach( $cats as $key => $cat){

            // echo sprintf( '<a href="%1$s" class="listing-geodir-category">%2$s</a> ',
            //     esc_url( get_term_link( $cat->term_id, 'listing_cat' ) ),
            //     esc_html( $cat->name )
            // );
            if($listing_post['gmap_marker'] == ''){
                $term_meta = get_term_meta( $cat->term_id, ESB_META_PREFIX.'term_meta', true );
                if(isset($term_meta['gmap_marker']) && !empty($term_meta['gmap_marker'])){
                    $listing_post['gmap_marker'] = wp_get_attachment_url( $term_meta['gmap_marker']['id'] );
                }
            }

            $listing_post['cats'][$cat->name] = sprintf( '<a href="%1$s" class="listing-geodir-category">%2$s</a> ',
                esc_url( get_term_link( $cat->term_id, 'listing_cat' ) ),
                esc_html( $cat->name )
            );
        }
        // echo '</div>';
    }

    $listing_post['phone'] = get_post_meta( $lid, '_cth_author_phone', true );
    $listing_post['latitude'] = get_post_meta( $lid, '_cth_latitude', true );
    $listing_post['longitude'] = get_post_meta( $lid, '_cth_longitude', true );
    $listing_post['address'] = get_post_meta( $lid, '_cth_address', true );
    $listing_post['email'] = get_post_meta( $lid, '_cth_author_email', true );
    $listing_post['website'] = get_post_meta( $lid, '_cth_author_website', true );

    $listing_post = (array)apply_filters( 'easybook_listing_map_data', $listing_post );

    return json_decode(json_encode($listing_post));
}

add_action( 'wp_head', function(){
    if( is_singular( 'listing') ){
        global $post;
        easybook_addons_print_schema( $post->ID );
    }
}, 99 );

function easybook_addons_print_schema($lid = 0, $ltype = 0){
    if(empty($ltype)) $ltype = get_post_meta( $lid, ESB_META_PREFIX .'listing_type_id', true );
    $schemas = get_post_meta( $ltype, ESB_META_PREFIX.'schema_markup', true );

    $schemas = json_decode($schemas, true);
    if(empty($schemas)) return ;

    // var_dump($schemas);

    $schema_markup = array();
    foreach ($schemas as $key => $schema) {
        if( !empty($schema['name']) && !empty($schema['value']) ){
            if(is_array($schema['value'])){
                $childs = array();
                foreach ($schema['value'] as $child) {
                    if(is_array($child['value'])){
                        $childs_two = array();
                        foreach ($child['value'] as $child_two) {
                            if(!is_array($child_two['value'])){
                                $childs_two[$child_two['name']] = easybook_addons_parse_schema_value($lid, $child_two['value'], $schema['name'].'/'.$child['name'].'/'.$child_two['name']);
                            }
                        }
                        $childs[$child['name']] = $childs_two;
                    }else{
                        $childs[$child['name']] = easybook_addons_parse_schema_value($lid, $child['value'], $schema['name'].'/'.$child['name']);
                    }
                }
                $schema_markup[$schema['name']] = $childs;
            }else{
                // $value = 
                $schema_markup[$schema['name']] = easybook_addons_parse_schema_value($lid, $schema['value'], $schema['name']);
            }
            
        }
    }
    // var_dump($schema_markup);
    $schema_markup = (array) apply_filters( 'easybook_addons_schema_markup', $schema_markup, $lid );
    ?>
    <script type="application/ld+json"><?php echo json_encode($schema_markup); ?></script>
    <?php
}
function easybook_addons_parse_schema_value($id = 0, $value = '', $name = ''){
    $rating = easybook_addons_get_average_ratings($id);
    switch ($value) {
        case '{{title}}':
            $value = get_the_title( $id );
            break;
        case '{{excerpt}}':
            $value = apply_filters('the_excerpt', get_post_field('post_excerpt', $id)); // get_the_excerpt( $id );
            break;
        case '{{thumbnail}}':
            $value = get_the_post_thumbnail_url( $id, 'post-thumbnail' );
            break;
        case '{{image}}':
            $value = get_the_post_thumbnail_url( $id, 'full' );
            break;
        case '{{url}}':
            $value = get_the_permalink( $id );
            break;

        case '{{price}}':
            $value = get_post_meta( $id, '_price', true );
            break;

        case '{{phone}}':
            $value = get_post_meta( $id, '_cth_author_phone', true );
            break;
        case '{{website}}':
            $value = get_post_meta( $id, '_cth_author_website', true );
            break;
        case '{{email}}':
            $value = get_post_meta( $id, '_cth_author_email', true );
            break;
        case '{{address}}':
            $value = get_post_meta( $id, '_cth_address', true );
            break;
        case '{{latitude}}':
            $value = get_post_meta( $id, '_cth_latitude', true );
            break;
        case '{{longitude}}':
            $value = get_post_meta( $id, '_cth_longitude', true );
            break;
        case '{{reviewValue}}':
            $value = $rating['rating'];
            break;
        case '{{reviewCount}}':
            $value = $rating['count'];
            break;
        case '{{priceRange}}':
            $value = easybook_addons_schema_price_range( $id );
            break;
        case '{{lowPrice}}':
            $value = get_post_meta( $id, ESB_META_PREFIX.'price_from', true );
            break;
        case '{{highPrice}}':
            $value = get_post_meta( $id, ESB_META_PREFIX.'price_to', true );
            break;
        case '{{openingHours}}':
            $value = easybook_addons_schema_working_hours( $id );
            break;
        case '{{startDate}}':
            $value = easybook_addons_schema_startDate( $id );
            break;
        case '{{endDate}}':
            $value = easybook_addons_schema_endDate( $id );
            break;
        case '{{currency}}':
            $value = easybook_addons_get_currency();
            break;
        case '{{speakers/trainers}}':
            $value = easybook_addons_schema_speakers( $id );
            break;
    }
    return apply_filters( 'easybook_schema_value', $value, $id, $name );
}
function easybook_addons_schema_listing_metas(){
    $metas = array(
        '{{title}}'                     => __( 'Listing Title', 'easybook-add-ons' ),
        '{{excerpt}}'                     => __( 'Listing Excerpt', 'easybook-add-ons' ),
        '{{thumbnail}}'                     => __( 'Listing Thumbnail', 'easybook-add-ons' ),
        '{{image}}'                     => __( 'Listing Full Image', 'easybook-add-ons' ),
        '{{url}}'                     => __( 'Listing URL', 'easybook-add-ons' ),
        '{{phone}}'                     => __( 'Phone number', 'easybook-add-ons' ),
        '{{website}}'                     => __( 'Website', 'easybook-add-ons' ),
        '{{email}}'                     => __( 'Email', 'easybook-add-ons' ),
        '{{address}}'                     => __( 'Address', 'easybook-add-ons' ),
        '{{openingHours}}'                     => __( 'Opening Hours', 'easybook-add-ons' ),

        '{{reviewValue}}'                     => __( 'Review Value', 'easybook-add-ons' ),
        '{{reviewCount}}'                     => __( 'Review Count', 'easybook-add-ons' ),

        '{{priceRange}}'                     => __( 'Price Range', 'easybook-add-ons' ),
        '{{lowPrice}}'                     => __( 'Lowest price', 'easybook-add-ons' ),
        '{{highPrice}}'                     => __( 'Highest price', 'easybook-add-ons' ),
        '{{startDate}}'                     => __( 'Evant Start Date', 'easybook-add-ons' ),
        '{{endDate}}'                     => __( 'Evant End Date', 'easybook-add-ons' ),
        '{{price}}'                     => __( 'Listing price', 'easybook-add-ons' ),
        '{{currency}}'                     => __( 'Listing currency', 'easybook-add-ons' ),
        '{{speakers/trainers}}'                     => __( 'Speakers/Trainers', 'easybook-add-ons' ),

    );
    return (array)apply_filters( 'easybook_schema_listing_metas', $metas );
}

function easybook_addons_schema_price_range( $id = 0 ){

    $price_from = get_post_meta( $id, ESB_META_PREFIX.'price_from', true );
    if($price_from != ''){
        $price_to = get_post_meta( $id, ESB_META_PREFIX.'price_to', true );
        if($price_to != '') 
            return $price_from.'-'.$price_to;
        else
            return $price_from;
    }else{
        $range = get_post_meta( $id, ESB_META_PREFIX.'price_range', true );
        $ranges = array(
            'none' => '',
            'inexpensive' => '$',
            'moderate' => '$$',
            'pricey' => '$$$',
            'ultrahigh' => '$$$$',
        );
        if(isset($ranges[$range])) 
            return $ranges[$range];
    }
    return '';
}  

function easybook_addons_schema_working_hours($post_ID = 0){

    $return = array(
        'Mo-Su',
    );
    if(!is_numeric($post_ID) || !$post_ID) return $return;
    $post_working_hours = easybook_addons_get_listing_working_hours_data($post_ID);
    if($post_working_hours){
        // $working_days = easybook_addons_get_working_days_array();
        $working_days = array(
            'Monday' => 'Mo',
            'Tuesday' => 'Tu',
            'Wednesday' => 'We',
            'Thursday' => 'Th',
            'Friday' => 'Fr',
            'Saturday' => 'Sa',
            'Sunday' => 'Su',
        );
        $working_hours_arr = easybook_addons_get_working_hours_array();
        $current_time_details = easybook_addons_get_current_time_details($post_working_hours['timezone']);
        // var_dump($current_time_details);
        $tz_offset = $current_time_details['tz_offset']/3600;

        $return['days_hours'] = array();
        
        foreach ($working_days as $day => $dayLbl) {

            $dayVals = $post_working_hours[$day];
            if(isset($dayVals['static'])){
                // if($dayVals['static'] == 'closeAllDay'){
                //     $return['days_hours'][$dayLbl] = 'close';
                // }else
                if($dayVals['static'] == 'openAllDay'){
                    $return['days_hours'][$dayLbl] = '00:00-24:00';
                }elseif($dayVals['static'] == 'enterHours' && isset($dayVals['hours']) && count($dayVals['hours'])){
                    $return['days_hours'][$dayLbl] = array();
                    foreach ($dayVals['hours'] as $hr) {
                        $return['days_hours'][$dayLbl][] = $hr['open'] .'-'. $hr['close'];
                    }
                }
                // end if $dayVals['static']
            }
            // end if isset($dayVals['static'])
        } 

        if(!empty($return['days_hours'])){
            $return_str = [];
            foreach ($return['days_hours'] as $lbl => $value) {
                if(!empty($value)){
                    if(is_array($value)){
                        $return_str[] = $lbl . ' ' . implode(',', $value);
                    }else
                        $return_str[] = $lbl . ' ' . $value;
                } 
            }

            return $return_str;
        }

    }
    // end if $post_working_hours

    return $return;

        
}

function easybook_addons_schema_startDate($post_id = 0){
    $next_date = easybook_addons_next_event_date($post_id);
    if(empty($next_date)) 
        return '';
    $timezone = get_post_meta( $post_id, ESB_META_PREFIX."wkh_tz", true );
    return easybook_addons_get_gmt_from_date( $next_date['start_date'], $timezone, 'c' );
}
function easybook_addons_schema_endDate($post_id = 0){
    $next_date = easybook_addons_next_event_date($post_id);
    if(empty($next_date)) 
        return '';

    $timezone = get_post_meta( $post_id, ESB_META_PREFIX."wkh_tz", true );
    return easybook_addons_get_gmt_from_date( $next_date['end_date'], $timezone, 'c' );
}
function easybook_addons_schema_speakers( $post_id = 0 ){
    $lmember = get_post_meta( $post_id, ESB_META_PREFIX.'lmember', true );
    if (!empty($lmember)) {
        $members_schema = array();
        foreach ((array)$lmember as $member) {
            $members_schema[] = array(
                '@type'=>'Person',
                'name'=> $member['name']
            );
        }
        return $members_schema;
    }
    return '';
}
function easybook_addons_get_wp_editor(){
    ob_start();

    wp_editor(
        '%%EDITORCONTENT%%',
        'customwpeditor',
        [
            'editor_class' => 'custom-wpeditor-wrap',
            'editor_height' => 200,
        ]
    );

    $editor = ob_get_clean();

    return $editor;
}
function easybook_addons_default_timezone(){
    $tz = get_option( 'timezone_string' );
    if( $tz ){
        return $tz;
    }else if( get_option( 'gmt_offset' ) ){
        return easybook_addons_tz_offset_to_name( get_option( 'gmt_offset' ) );
    }
    return 'UTC';
}

function easybook_addons_listing_ltags_options() {
    $ltags = array();
    $terms = get_terms( 
        array(
            'taxonomy' => 'listing_tag',
            'hide_empty' => false,
            'orderby'       => 'count',
            'order'       => 'DESC',
        ) 
    );
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
        foreach ( $terms as $term ) {
            $ltags[$term->term_id] = $term->name;
        }
    }
    $ltags = (array) apply_filters( 'cth_filter_ltags_options', $ltags );

    return $ltags;
}

function easybook_addons_listing_max_guests($listing_id = 0){
    if($listing_id == 0) $listing_id = get_the_ID();
    $max_guest = get_post_meta( $listing_id, ESB_META_PREFIX.'max_guests', true );
    if(empty($max_guest)) $max_guest = 5;
    
    return apply_filters( 'esb_listing_max_guests', $max_guest, $listing_id );
}

add_action('wp_ajax_get_curr_rate', 'easybook_addons_get_curr_rate_callback');
function easybook_addons_get_curr_rate_callback(){

    $json = array(
        'success' => false,
        'data' => array(
            // 'POST'=>$_POST,
        ),
        'debug'         => false,
    );
    $params = array(
        'compact'             => 'ultra',
        'apiKey'              => apply_filters( 'cth_currconv_api', '39dd0de7891d0b93c9d0' ), 
        //; _x( '39dd0de7891d0b93c9d0', 'Change with your currencyconverterapi.com API key', 'default' ),
        
    );
    if( isset($_POST['base']) &&  isset($_POST['curr']) ){
        $params['q'] = $_POST['base'].'_'.$_POST['curr'];
    }else{
        $params['q'] = 'EUR_USD';
    }
    $params_str = http_build_query($params, null, '&', PHP_QUERY_RFC3986);
    $api_url = "https://free.currconv.com/api/v7/convert?{$params_str}";
    $response = wp_remote_get( esc_url_raw( $api_url ) );
    if ( is_wp_error( $response ) ) {
        $json['error'] = __( 'currencyconverterapi.com request error!', 'easybook-add-ons' );
    }else{
        /* Will result in $api_response being an array of data,
        parsed from the JSON response of the API listed above */
        $api_response = json_decode( wp_remote_retrieve_body( $response ), true );

        $json['success'] = true;

        $json['rate'] = $api_response[$params['q']];
    }
    wp_send_json( $json );
}

function easybook_addons_lcats_options( $with_child = false ){
    $args = array(
            'taxonomy' => 'listing_cat',
            'hide_empty' => false,
        );
    if(false == $with_child) $args['parent'] = 0;
    $terms = get_terms( $args );
    
    $results = array();
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
        foreach ( $terms as $term ) {
            $results[$term->term_id] = $term->name;
        }
    }

    $results = (array) apply_filters( 'esb_lcats_options', $results );

    return $results;
}
function easybook_addons_filter_cats($cats = '', $max_level = 0, $hide_empty = 'yes' ){
    if($cats == '') 
        return easybook_addons_get_listing_categories(easybook_addons_get_option('search_cat_level'));

    $results = array();
    $terms = explode('||', $cats);
    $level = 0;
    foreach ($terms as $term) {
        $term_obj = get_term($term, 'listing_cat');
        if ( ! empty( $term_obj ) && ! is_wp_error( $term_obj ) ){

            $results[] = array( 'id'=>$term_obj->term_id, 'name'=>$term_obj->name, 'level'=> 0 );
            if( $max_level != '' && $level < $max_level ){
                $ccats = easybook_addons_filter_child_cats($term_obj->term_id, $level+1 , $max_level, $hide_empty);

                $results = array_merge($results, $ccats);
            }
        } 
    }

    return $results;

}
function easybook_addons_filter_child_cats($cat = 0, $level = 0, $max_level = 0, $hide_empty = 'yes'){
    $args = array(
        'taxonomy'          => 'listing_cat',
        'hide_empty'        => $hide_empty == 'yes' ? true : false,
        'parent'            => $cat
    );
    $terms = get_terms( $args );
    $results = array();
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
        foreach ( $terms as $term ) {
            $results[] = array( 'id'=>$term->term_id, 'name'=>$term->name, 'level'=> $level );
            if( $max_level != '' && $level < $max_level ){
                $ccats = easybook_addons_filter_child_cats($term->term_id, $level+1 , $max_level, $hide_empty);
                $results = array_merge($results, $ccats);
            }
        }
    }
    return $results;
}
function easybook_addons_get_listing_thumbnail($post_id = 0){
    $post_thumbnail_id = get_post_thumbnail_id( $post_id );
    if( !empty($post_thumbnail_id) ){
        return $post_thumbnail_id;
    }

    $terms = get_the_terms( $post_id, 'listing_cat' );
    if( $terms && ! is_wp_error( $terms ) ){
        $fterm = reset($terms);
        $term_meta = get_term_meta( $fterm->term_id, ESB_META_PREFIX.'term_meta', true );
        if( isset($term_meta['featured_img']) && !empty($term_meta['featured_img']) && !empty($term_meta['featured_img']['id']) )
            $post_thumbnail_id = $term_meta['featured_img']['id'];
    }
    if( !empty($post_thumbnail_id) ){
        return $post_thumbnail_id;
    }

    $default_thumbnail = easybook_addons_get_option('default_thumbnail');
    if( $default_thumbnail && !empty($default_thumbnail['id']) )
        return $default_thumbnail['id'];
}
