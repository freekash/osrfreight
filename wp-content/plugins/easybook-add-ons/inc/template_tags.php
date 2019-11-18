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





function easybook_addons_get_user_role( $user_id = 0 ) {
    // https://core.trac.wordpress.org/ticket/22624
    $user = ( $user_id ) ? get_userdata( $user_id ) : wp_get_current_user();     
    return current( $user->roles );
}
function easybook_addons_get_user_role_name($role = ''){
    if($role == '') $role = easybook_addons_get_user_role();
    global $wp_roles;
    return translate_user_role( $wp_roles->roles[ $role ]['name']  , 'easybook-add-ons' );
}
// not used yet
function easybook_addons_get_author_roles(){
    if ( ! function_exists( 'get_editable_roles' ) ) {
        require_once ABSPATH . 'wp-admin/includes/user.php';
    }
    $roles = array('l_anyone'=>__( 'Anyone can', 'easybook-add-ons' ));  
    $editable_roles = array_reverse( get_editable_roles() );
    foreach ( $editable_roles as $role => $details ) {
        // $name = translate_user_role($details['name'] );
        // $roles[esc_attr( $role )] = translate_user_role($details['name'] );    
        // exclude 'administrator'
        if( 'administrator' !== esc_attr( $role ) ) $roles[esc_attr( $role )] = translate_user_role($details['name']  , 'easybook-add-ons' );
    }

    return $roles;
}

function easybook_addons_current_user_can($custom_cap = 'submit_listing'){ 
    $user_can = false;
    // check for submit listing capability
    if($custom_cap === 'submit_listing'){
        if( easybook_addons_get_option('users_can_submit_listing') == 'yes' ){
            $user_can = true;
        }elseif(current_user_can( 'submit_listing' )){
            $current_role = easybook_addons_get_user_role();
            if($current_role == 'administrator'){
                $user_can = true;
            }else{
                

                $user_current_subscription = easybook_addons_get_current_subscription();
                if($user_current_subscription){
                    $order_listings = get_post_meta( $user_current_subscription['id'], ESB_META_PREFIX.'listings', true );
                    if($user_current_subscription['plan_llimit'] == 'unlimited' || count((array)$order_listings) < (int)$user_current_subscription['plan_llimit'] ) $user_can = true;
                }

                // $user_membership = get_user_meta( get_current_user_id(), ESB_META_PREFIX.'member_plan', true );
                // $payment_date = get_user_meta( get_current_user_id(), ESB_META_PREFIX.'payment_date', true );

                // unlimited
                // if( get_post_meta( $user_membership , ESB_META_PREFIX.'lunlimited', true ) ){
                //     $user_can = true;
                // }else{
                //     // plan metas
                //     $plan_llimit = get_post_meta( $user_membership , ESB_META_PREFIX.'llimit', true );
                //     // get author listing post
                //     $l_args = array(
                //         'post_type'     =>  'listing', 
                //         'post_status'   => array( 'publish', 'pending', 'draft', 'future' ),
                //         'author' => get_current_user_id(),
                //         'date_query' => array(
                //             'relation' => 'OR',
                //             array(
                //                 'column' => 'post_date_gmt',
                //                 'after' => $payment_date,

                //                 // 'inclusive' => true,
                //             ),
                //             array(
                //                 'column' => 'post_date',
                //                 'after' => $payment_date,

                //                 // 'inclusive' => true,
                //             ),
                //             'inclusive' => true,
                            
                //         ),
                //         'posts_per_page' => -1,
                //     );
                    
                //     $l_posts = get_posts( $l_args );

                //     if( count($l_posts) < (int)$plan_llimit ) {
                //         $user_can = true;
                //     }

                //     // return false;
                // }
            }
            // end if not administrator
        }

        // if( easybook_addons_get_option('users_can_submit_listing') == 'yes' || current_user_can( 'submit_listing' ) ){
        //     $user_can = true;
        // }
    }
    if($custom_cap === 'view_listings_dashboard'){
        if( easybook_addons_get_option('users_can_submit_listing') == 'yes' || current_user_can( 'submit_listing' )){
            $user_can = true;
        }
    }
    // return false;
    return $user_can;
}

function easybook_addons_get_submit_link(){
    $current_sub = easybook_addons_get_current_subscription();
    // if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Current subscription: " .json_encode($current_sub). PHP_EOL, 3, ESB_LOG_FILE);
    // if($current_sub && $current_sub['valid']) 
    $dashboard_page_id = easybook_addons_get_option('dashboard_page');
    $free_submit_page = easybook_addons_get_option('free_submit_page');
    if($current_sub && $current_sub['valid'] ){
        if (is_user_logged_in() || $free_submit_page == 'default') {
            $submit_link = get_permalink($dashboard_page_id).'#/addListing';
        }else{
            $submit_link = get_permalink($dashboard_page_id).'#/addListing';
        }
    }else{
        $submit_link = get_permalink( easybook_addons_get_option('free_submit_page') );
    }

    return esc_url($submit_link);
}

/**
 * Return attachment image link by using wp_get_attachment_image_src function
 *
 */
function easybook_addons_get_attachment_thumb_link( $id, $size = 'thumbnail'){
    $image_attributes = wp_get_attachment_image_src( $id, $size, false );
    if ( $image_attributes ) {
        return $image_attributes[0];
    }
    return '';
}

function easybook_addons_get_current_url(){
    global $wp;
    // get current page with query string
    return add_query_arg( $_SERVER['QUERY_STRING'], '', home_url( $wp->request ) );

    
    // $current_url = home_url(add_query_arg(array(),$wp->request));
    // return $current_url;
}

/** 
 * get template part file related to plugin folder
 *
 */
if(!function_exists('easybook_addons_get_template_part')){
    /**
     * Load a template part into a template
     *
     * Makes it easy for a theme to reuse sections of code in a easy to overload way
     * for child themes.
     *
     * Includes the named template part for a theme or if a name is specified then a
     * specialised part will be included. If the theme contains no {slug}.php file
     * then no template will be included.
     *
     * The template is included using require, not require_once, so you may include the
     * same template part multiple times.
     *
     * For the $name parameter, if the file is called "{slug}-special.php" then specify
     * "special".
      * For the var parameter, simple create an array of variables you want to access in the template
     * and then access them e.g. 
     * 
     * array("var1=>"Something","var2"=>"Another One","var3"=>"heres a third";
     * 
     * becomes
     * 
     * $var1, $var2, $var3 within the template file.
     *
     * @since 1.0.0
     *
     * @param string $slug The slug name for the generic template.
     * @param string $name The name of the specialised template.
     * @param array $vars The list of variables to carry over to the template
     * @author CTHthemes 
     * @ref http://www.zmastaa.com/2015/02/06/php-2/wordpress-passing-variables-get_template_part
     * @ref http://keithdevon.com/passing-variables-to-get_template_part-in-wordpress/
     */
    function easybook_addons_get_template_part( $slug, $name = null, $vars = null, $include = true ) {

        $template = "{$slug}.php";
        $name = (string) $name;
        if ( '' !== $name ) {
            $template = "{$slug}-{$name}.php";
        }

        if(isset($vars)) extract($vars);
        if($located = locate_template( 'cth_listing/'.$template )){
            if($include) 
                include $located;
            else 
                return $located;
        }else{
            if($include) 
                include ESB_ABSPATH.$template;
            else 
                return ESB_ABSPATH.$template;
            
        }
        // include(easybook_addons_locate_template($template));
        
    }

 //    function easybook_addons_locate_template($template_names, $load = false, $require_once = true ) {
    //  $located = '';
    //  foreach ( (array) $template_names as $template_name ) {
    //      if ( !$template_name )
    //          continue;
    //      if ( file_exists(ESB_ABSPATH . '/' . $template_name)) {
    //          $located = ESB_ABSPATH . '/' . $template_name;
    //          break;
    //      } elseif ( file_exists(ESB_ABSPATH . '/' . $template_name) ) {
    //          $located = ESB_ABSPATH . '/' . $template_name;
    //          break;
    //      } elseif ( file_exists( ABSPATH . WPINC . '/theme-compat/' . $template_name ) ) {
    //          $located = ABSPATH . WPINC . '/theme-compat/' . $template_name;
    //          break;
    //      }
    //  }

    //  if ( $load && '' != $located )
    //      load_template( $located, $require_once );

    //  return $located;
    // }
}

function easybook_addons_get_working_days_array(){
    $days = array(
        'Monday' => __( 'Monday',  'easybook-add-ons' ),
        'Tuesday' => __( 'Tuesday',  'easybook-add-ons' ),
        'Wednesday' => __( 'Wednesday',  'easybook-add-ons' ),
        'Thursday' => __( 'Thursday',  'easybook-add-ons' ),
        'Friday' => __( 'Friday',  'easybook-add-ons' ),
        'Saturday' => __( 'Saturday',  'easybook-add-ons' ),
        'Sunday' => __( 'Sunday',  'easybook-add-ons' ),
    );
    return $days;
}

function easybook_addons_get_listing_working_hours_data( $post_id = 0 ){
    $data = array();
    $working_days = easybook_addons_get_working_days_array();
    $post_obj = get_post($post_id);
    if( $post_id == 0 || null == $post_obj || $post_obj->post_status == 'auto-draft' ){
        $data['timezone'] = easybook_addons_default_timezone();
        foreach ($working_days as $day => $dayLbl ) {
            $data[$day] = array(
                'static'    => 'enterHours',
                'hours'     => array(),
            );
        }
        return $data;
    }

    // $data['post'] = get_post($post_id);
    
    $data['timezone'] = get_post_meta( $post_id, ESB_META_PREFIX."wkh_tz", true );
    foreach ($working_days as $day => $dayLbl ) {
        $data[$day] = array(
            'static'    => get_post_meta( $post_id, ESB_META_PREFIX."wkh_status_{$day}", true ),
            'hours'     => array(),
        );
        $meta_hours = get_post_meta( $post_id, ESB_META_PREFIX."wkh_hours_{$day}", true );
        $meta_hours = array_filter(explode(" ", $meta_hours));
        foreach ($meta_hours as $hour) {
            $cl_op = array_filter(explode("-", $hour));
            if(count($cl_op) == 2) $data[$day]['hours'][] = array('open'=>$cl_op[0],'close'=>$cl_op[1]);
        }

    }

    return $data;
}

function easybook_addons_get_working_hours_array(){
    $hours = array(
        '0:00' => __( '0:00 AM',  'easybook-add-ons' ),
        '0:30' => __( '0:30 AM',  'easybook-add-ons' ),

        '1:00' => __( '1:00 AM',  'easybook-add-ons' ),
        '1:30' => __( '1:30 AM',  'easybook-add-ons' ),

        '2:00' => __( '2:30 AM',  'easybook-add-ons' ),
        '2:30' => __( '2:30 AM',  'easybook-add-ons' ),

        '3:00' => __( '3:00 AM',  'easybook-add-ons' ),
        '3:30' => __( '3:30 AM',  'easybook-add-ons' ),
        
        '4:00' => __( '4:00 AM',  'easybook-add-ons' ),
        '4:30' => __( '4:30 AM',  'easybook-add-ons' ),

        '5:00' => __( '5:00 AM',  'easybook-add-ons' ),
        '5:30' => __( '5:30 AM',  'easybook-add-ons' ),

        '6:00' => __( '6:00 AM',  'easybook-add-ons' ),
        '6:30' => __( '6:30 AM',  'easybook-add-ons' ),

        '7:00' => __( '7:00 AM',  'easybook-add-ons' ),
        '7:30' => __( '7:30 AM',  'easybook-add-ons' ),

        '8:00' => __( '8:00 AM',  'easybook-add-ons' ),
        '8:30' => __( '8:30 AM',  'easybook-add-ons' ),

        '9:00' => __( '9:00 AM',  'easybook-add-ons' ),
        '9:30' => __( '9:30 AM',  'easybook-add-ons' ),

        '10:00' => __( '10:00 AM',  'easybook-add-ons' ),
        '10:30' => __( '10:30 AM',  'easybook-add-ons' ),

        '11:00' => __( '11:00 AM',  'easybook-add-ons' ),
        '11:30' => __( '11:30 AM',  'easybook-add-ons' ),

        '12:00' => __( '12:00 PM',  'easybook-add-ons' ),
        '12:30' => __( '12:30 PM',  'easybook-add-ons' ),

        '13:00' => __( '1:00 PM',  'easybook-add-ons' ),
        '13:30' => __( '1:30 PM',  'easybook-add-ons' ),

        '14:00' => __( '2:00 PM',  'easybook-add-ons' ),
        '14:30' => __( '2:30 PM',  'easybook-add-ons' ),

        '15:00' => __( '3:00 PM',  'easybook-add-ons' ),
        '15:30' => __( '3:30 PM',  'easybook-add-ons' ),

        '16:00' => __( '4:00 PM',  'easybook-add-ons' ),
        '16:30' => __( '4:30 PM',  'easybook-add-ons' ),

        '17:00' => __( '5:00 PM',  'easybook-add-ons' ),
        '17:30' => __( '5:30 PM',  'easybook-add-ons' ),

        '18:00' => __( '6:00 PM',  'easybook-add-ons' ),
        '18:30' => __( '6:30 PM',  'easybook-add-ons' ),

        '19:00' => __( '7:00 PM',  'easybook-add-ons' ),
        '19:30' => __( '7:30 PM',  'easybook-add-ons' ),

        '20:00' => __( '8:00 PM',  'easybook-add-ons' ),
        '20:30' => __( '8:30 PM',  'easybook-add-ons' ),

        '21:00' => __( '9:00 PM',  'easybook-add-ons' ),
        '21:30' => __( '9:30 PM',  'easybook-add-ons' ),

        '22:00' => __( '10:00 PM',  'easybook-add-ons' ),
        '22:30' => __( '10:30 PM',  'easybook-add-ons' ),

        '23:00' => __( '11:00 PM',  'easybook-add-ons' ),
        '23:30' => __( '11:30 PM',  'easybook-add-ons' ),

        '24:00' => __( '12:00 PM',  'easybook-add-ons' ),
        
    );
    if(easybook_addons_get_option('use_clock_24h') == 'yes'){
        $hours = array(
            '0:00' => __( '00:00',  'easybook-add-ons' ),
            '0:30' => __( '00:30',  'easybook-add-ons' ),

            '1:00' => __( '01:00',  'easybook-add-ons' ),
            '1:30' => __( '01:30',  'easybook-add-ons' ),

            '2:00' => __( '02:30',  'easybook-add-ons' ),
            '2:30' => __( '02:30',  'easybook-add-ons' ),

            '3:00' => __( '03:00',  'easybook-add-ons' ),
            '3:30' => __( '03:30',  'easybook-add-ons' ),
            
            '4:00' => __( '04:00',  'easybook-add-ons' ),
            '4:30' => __( '04:30',  'easybook-add-ons' ),

            '5:00' => __( '05:00',  'easybook-add-ons' ),
            '5:30' => __( '05:30',  'easybook-add-ons' ),

            '6:00' => __( '06:00',  'easybook-add-ons' ),
            '6:30' => __( '06:30',  'easybook-add-ons' ),

            '7:00' => __( '07:00',  'easybook-add-ons' ),
            '7:30' => __( '07:30',  'easybook-add-ons' ),

            '8:00' => __( '08:00',  'easybook-add-ons' ),
            '8:30' => __( '08:30',  'easybook-add-ons' ),

            '9:00' => __( '09:00',  'easybook-add-ons' ),
            '9:30' => __( '09:30',  'easybook-add-ons' ),

            '10:00' => __( '10:00',  'easybook-add-ons' ),
            '10:30' => __( '10:30',  'easybook-add-ons' ),

            '11:00' => __( '11:00',  'easybook-add-ons' ),
            '11:30' => __( '11:30',  'easybook-add-ons' ),

            '12:00' => __( '12:00',  'easybook-add-ons' ),
            '12:30' => __( '12:30',  'easybook-add-ons' ),

            '13:00' => __( '13:00',  'easybook-add-ons' ),
            '13:30' => __( '13:30',  'easybook-add-ons' ),

            '14:00' => __( '14:00',  'easybook-add-ons' ),
            '14:30' => __( '14:30',  'easybook-add-ons' ),

            '15:00' => __( '15:00',  'easybook-add-ons' ),
            '15:30' => __( '15:30',  'easybook-add-ons' ),

            '16:00' => __( '16:00',  'easybook-add-ons' ),
            '16:30' => __( '16:30',  'easybook-add-ons' ),

            '17:00' => __( '17:00',  'easybook-add-ons' ),
            '17:30' => __( '17:30',  'easybook-add-ons' ),

            '18:00' => __( '18:00',  'easybook-add-ons' ),
            '18:30' => __( '18:30',  'easybook-add-ons' ),

            '19:00' => __( '19:00',  'easybook-add-ons' ),
            '19:30' => __( '19:30',  'easybook-add-ons' ),

            '20:00' => __( '20:00',  'easybook-add-ons' ),
            '20:30' => __( '20:30',  'easybook-add-ons' ),

            '21:00' => __( '21:00',  'easybook-add-ons' ),
            '21:30' => __( '21:30',  'easybook-add-ons' ),

            '22:00' => __( '22:00',  'easybook-add-ons' ),
            '22:30' => __( '22:30',  'easybook-add-ons' ),

            '23:00' => __( '23:00',  'easybook-add-ons' ),
            '23:30' => __( '23:30',  'easybook-add-ons' ),

            '24:00' => __( '24:00',  'easybook-add-ons' ),
            
        );
    }
    return $hours;
}

function easybook_addons_generate_timezone_list()
{
    static $regions = array(
        DateTimeZone::AFRICA,
        DateTimeZone::AMERICA,
        DateTimeZone::ANTARCTICA,
        DateTimeZone::ASIA,
        DateTimeZone::ATLANTIC,
        DateTimeZone::AUSTRALIA,
        DateTimeZone::EUROPE,
        DateTimeZone::INDIAN,
        DateTimeZone::PACIFIC,
    );

    $timezones = array();
    foreach( $regions as $region )
    {
        $timezones = array_merge( $timezones, DateTimeZone::listIdentifiers( $region ) );
    }

    $timezone_offsets = array();
    foreach( $timezones as $timezone )
    {
        $tz = new DateTimeZone($timezone);
        $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
    }

    // sort timezone by offset
    asort($timezone_offsets);

    $timezone_list = array();
    foreach( $timezone_offsets as $timezone => $offset )
    {
        $offset_prefix = $offset < 0 ? '-' : '+';
        $offset_formatted = gmdate( 'H:i', abs($offset) );

        $pretty_offset = "UTC${offset_prefix}${offset_formatted}";

        $timezone_list[$timezone] = "(${pretty_offset}) $timezone";
    }

    return $timezone_list;
}

function easybook_addons_get_meta_values( $key = '', $type = 'post', $status = 'publish' ) {
    global $wpdb;
    $metas = array();
    if( empty( $key ) )
        return $metas;
    if( is_array( $status ) && count( $status ) ){
        $w_status = " AND (";

        $statuswheres = array();

        foreach ($status as $stval) {
            $statuswheres[] = $wpdb->prepare("p.post_status = %s", $stval);
        }

        $w_status .= implode(' OR ', $statuswheres);

        $w_status .= ") ";

    }else{
        $w_status = $wpdb->prepare(" AND p.post_status = %s", $status);
    }
    
    $r = $wpdb->get_results( $wpdb->prepare( "
        SELECT p.ID, pm.meta_value FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = '%s' 
        AND p.post_type = '%s'
        $w_status 
    ", $key, $type ));

    foreach ( $r as $my_r )
        $metas[$my_r->ID] = $my_r->meta_value;

    return $metas;
}


function easybook_addons_re_format_date( $string,$format = 'Y-m-d H:i:s' ){
    $datetime = date_create( $string );
    if ( ! $datetime ) {
        return gmdate( $format );
    }
    return $datetime->format( $format );
}

function easybook_addons_get_gmt_from_date( $string, $tz = '', $format = 'Y-m-d H:i:s' ){
    if( !$tz ) $tz = get_option( 'timezone_string' );
    if ( $tz ) {
            $datetime = date_create( $string, new DateTimeZone( $tz ) );
            if ( ! $datetime ) {
                    return gmdate( $format, 0 );
            }
            $datetime->setTimezone( new DateTimeZone( 'UTC' ) );
            $string_gmt = $datetime->format( $format );
    } else {
            if ( ! preg_match( '#([0-9]{1,4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#', $string, $matches ) ) {
                    $datetime = strtotime( $string );
                    if ( false === $datetime ) {
                            return gmdate( $format, 0 );
                    }
                    return gmdate( $format, $datetime );
            }
            $string_time = gmmktime( $matches[4], $matches[5], $matches[6], $matches[2], $matches[3], $matches[1] );
            $string_gmt = gmdate( $format, $string_time - get_option( 'gmt_offset' ) * HOUR_IN_SECONDS );
    }
    return $string_gmt;
}

function easybook_addons_tz_offset_to_name($offset)
{
    $offset *= 3600; // convert hour offset to seconds
    $abbrarray = timezone_abbreviations_list();
    if($abbrarray){
        foreach ($abbrarray as $abbr)
        {
            foreach ($abbr as $city)
            {
                if ($city['offset'] == $offset)
                {
                    return $city['timezone_id'];
                }
            }
        }
    }

    return 'UTC';
    // return false;
}

function easybook_addons_get_current_time_details($tz = ''){
    if( !$tz ) $tz = get_option( 'timezone_string' );
    if( $tz ){
        $listingTimezone = new DateTimeZone( $tz );
    }else if( get_option( 'gmt_offset' ) ){
        $tz = easybook_addons_tz_offset_to_name( get_option( 'gmt_offset' ) );//timezone_name_from_abbr('', get_option( 'gmt_offset' ) * HOUR_IN_SECONDS );
        $listingTimezone = new DateTimeZone( $tz );
    }else{
        $listingTimezone = new DateTimeZone( 'UTC' );
    }

    
    // $utcTimezone        = new DateTimeZone('UTC');
    // $utcDateTime        = new DateTime('now', $utcTimezone);
    $currentDateTime    = new DateTime('now', $listingTimezone);
    $prevDateTime    = new DateTime('now-1day', $listingTimezone);
    return array(
        // 'tz_offset'     => $listingTimezone->getOffset($utcDateTime),
        'tz_offset'     => $currentDateTime->format('Z'),
        'day'           => $currentDateTime->format('l'),
        'hour'          => $currentDateTime->format('G.i'),
        'date'          => $currentDateTime->format('Y-m-d H:i:s'),

        'prev_day'      => $prevDateTime->format('l'),
    );
}


function easybook_addons_get_working_hours($post_ID = 0){

    $return = array(
        'timezone' => 'UTC + 0',
        'status' => 'closed',
        'statusText' => __( 'Now Closed',  'easybook-add-ons' ),
        'days_hours' => array()
    );

    if(!is_numeric($post_ID) || !$post_ID) return $return;


    $post_working_hours = get_post_meta( $post_ID, '_cth_working_hours', true ) ;

    if($post_working_hours){
        // $default_timezone = date_default_timezone_get();

        $working_days = easybook_addons_get_working_days_array();
        $working_hours_arr = easybook_addons_get_working_hours_array();

        // date_default_timezone_set($post_working_hours['timezone']);

        $current_time_details = easybook_addons_get_current_time_details($post_working_hours['timezone']);
        $tz_offset = $current_time_details['tz_offset']/3600;
        // $tz_offset = date('Z')/3600;
        if($tz_offset < 0){
            $return['timezone'] = __( 'UTC - ', 'easybook-add-ons' ) .(string)(-1*$tz_offset);
        }else{
            $return['timezone'] = __( 'UTC + ', 'easybook-add-ons' ) ."{$tz_offset}";
        }

        $curDy = $current_time_details['day']; //date('l');
        $prevDy = $current_time_details['prev_day'];

        foreach ($working_days as $day => $dayLbl) {

            $dayVals = $post_working_hours[$day];
            if(isset($dayVals['static'])){

                // $return['days_hours'][$dayLbl] = array(__( 'Day Off', 'easybook-add-ons' ));

                // if($day == $curDy){
                //     $return['statusText'] = __( 'Now Closed',  'easybook-add-ons' );
                //     $return['status'] = 'closed';
                // }
                if($dayVals['static'] == 'closeAllDay'){
                    $return['days_hours'][$dayLbl] = array(__( 'Day Off', 'easybook-add-ons' ));
                }elseif($dayVals['static'] == 'openAllDay'){
                    $return['days_hours'][$dayLbl] = array(__( 'Open all day', 'easybook-add-ons' ));
                    if($day == $curDy){
                        $return['statusText'] = __( 'Now Opening',  'easybook-add-ons' );
                        $return['status'] = 'opening';
                    }
                }elseif($dayVals['static'] == 'enterHours' && isset($dayVals['hours']) && count($dayVals['hours'])){
                    $return['days_hours'][$dayLbl] = array();
                    // $curHr = date('H:i'); // 06:30
                    $curHr = floatval( $current_time_details['hour'] ); //date('G.i'); // 6:30

                    foreach ($dayVals['hours'] as $hr) {
                        $ophrAfter = floatval( str_replace(":", ".", $hr['open']) );
                        $clhrAfter = floatval( str_replace(":", ".", $hr['close']) );
                        // check for prev day hour if current day closed
                        if($day == $prevDy){
                            if( $ophrAfter > $clhrAfter && $curHr < $clhrAfter ){
                                $return['statusText'] = __( 'Now Opening',  'easybook-add-ons' );
                                $return['status'] = 'opening';
                            }
                        }
                        if($day == $curDy){
                            if( $ophrAfter <= $clhrAfter ){
                                if( $curHr >= $ophrAfter && $curHr <= $clhrAfter ){
                                    $return['statusText'] = __( 'Now Opening',  'easybook-add-ons' );
                                    $return['status'] = 'opening';
                                }
                            }else{
                                if( $curHr >= $ophrAfter ){
                                    $return['statusText'] = __( 'Now Opening',  'easybook-add-ons' );
                                    $return['status'] = 'opening';
                                }
                            }
                        }
                        // only check status for current day

                        $return['days_hours'][$dayLbl][] = '<span>' .$working_hours_arr[$hr['open']] . ' - ' . $working_hours_arr[$hr['close']] .'</span>' ;

                    }

                    // check for prev day hour if current day closed
                    // if( $return['status'] == 'closed' ){
                    //     $prevDayVals = $post_working_hours[$prevDy];
                    //     if($prevDayVals['static'] == 'enterHours' && isset($prevDayVals['hours']) && count($prevDayVals['hours'])){
                    //         foreach ($prevDayVals['hours'] as $hr) {
                    //             $ophrAfter = floatval( str_replace(":", ".", $hr['open']) );
                    //             $clhrAfter = floatval( str_replace(":", ".", $hr['close']) );
                    //             if( $ophrAfter > $clhrAfter && $curHr < $clhrAfter ){
                    //                 $return['statusText'] = __( 'Now Opening',  'easybook-add-ons' );
                    //                 $return['status'] = 'opening';
                    //             }
                    //         }
                    //     }
                    // }

                }
                // end if $dayVals['static']
            }
            // end if isset($dayVals['static'])
        } 
        // end foreach
        // set back to default timezone
        // date_default_timezone_set($default_timezone);

        // check for listing event
        $levent_date = trim( get_post_meta( $post_ID, ESB_META_PREFIX.'levent_date', true ) .' '. get_post_meta( $post_ID, ESB_META_PREFIX.'levent_time', true ) );
        $levent_end_date = trim( get_post_meta( $post_ID, ESB_META_PREFIX.'levent_end_date', true ) .' '. get_post_meta( $post_ID, ESB_META_PREFIX.'levent_end_time', true ) );
        if( $levent_date != '' && $levent_date > $current_time_details['date'] ){
            $return['status'] = 'closed';
            $return['statusText'] = __( 'Event not start',  'easybook-add-ons' );
        }
        if( $levent_end_date != '' && $levent_end_date < $current_time_details['date'] ){
            $return['status'] = 'closed';
            $return['statusText'] = __( 'Event Ended',  'easybook-add-ons' );
        }


    }
    // end if $post_working_hours

    return $return;

        
}

function easybook_addons_get_socials_list(){

    $socials = array(
        'facebook' => __( 'Facebook',  'easybook-add-ons' ),
        'twitter' => __( 'Twitter',  'easybook-add-ons' ),
        'youtube' => __( 'Youtube',  'easybook-add-ons' ),
        'vimeo' => __( 'Vimeo',  'easybook-add-ons' ),
        'instagram' => __( 'Instagram',  'easybook-add-ons' ),
        'vk' => __( 'Vkontakte',  'easybook-add-ons' ),
        'reddit' => __( 'Reddit',  'easybook-add-ons' ),
        'pinterest' => __( 'Pinterest',  'easybook-add-ons' ),
        'vine' => __( 'Vine Camera',  'easybook-add-ons' ),
        'tumblr' => __( 'Tumblr',  'easybook-add-ons' ),
        'flickr' => __( 'Flickr',  'easybook-add-ons' ),
        'google-plus-g' => __( 'Google+',  'easybook-add-ons' ),
        'linkedin' => __( 'LinkedIn',  'easybook-add-ons' ),
        'whatsapp' => __( 'Whatsapp',  'easybook-add-ons' ),
        'meetup' => __( 'Meetup',  'easybook-add-ons' ),
        'custom_icon' => __( 'Custom',  'easybook-add-ons' ),
    );

    return $socials ;

}

function easybook_addons_get_checkbox_room_list(){

    $checkbox_room = array(
        'name' => __( 'Free WiFi',  'easybook-add-ons' ),
        'name' => __( '1 Bathroom',  'easybook-add-ons' ),
        'name' => __( 'Air conditioner',  'easybook-add-ons' ),
        'name' => __( 'Tv Inside',  'easybook-add-ons' ),
        'name' => __( 'Breakfast',  'easybook-add-ons' ),
    );

    return $checkbox_room ;

}
function easybook_addons_get_checkbox_list(){

    $checkbox = array(
        'name' => __( 'Free WiFi',  'easybook-add-ons' ),
        'name' => __( 'Parking',  'easybook-add-ons' ),
        'name' => __( 'Fitness Center',  'easybook-add-ons' ),
        'name' => __( 'Non-smoking Rooms',  'easybook-add-ons' ),
        'name' => __( 'Airport Shuttle',  'easybook-add-ons' ),
        'name' => __( 'Air Conditioning',  'easybook-add-ons' ),
    );

    return $checkbox ;

}      

function easybook_addons_get_listing_price_range($range = '', $single = false){

    $ranges = array(
        'none' => __( 'None',  'easybook-add-ons' ),
        'inexpensive' => __( '&dollar; - Inexpensive',  'easybook-add-ons' ),
        'moderate' => __( '&dollar;&dollar; - Moderate',  'easybook-add-ons' ),
        'pricey' => __( '&dollar;&dollar;&dollar; - Pricey',  'easybook-add-ons' ),
        'ultrahigh' => __( '&dollar;&dollar;&dollar;&dollar; - Ultra High',  'easybook-add-ons' ),
    );
    if($range!='' && isset($ranges[$range])) return $ranges[$range];

    if($single) 
        return '';
    else
        return $ranges;

}  
// facebook login
// https://www.codexworld.com/login-with-facebook-using-php/
// https://stackoverflow.com/questions/12069703/facebook-login-for-wordpress-without-a-plugin
// https://developers.facebook.com/docs/php/howto/example_facebook_login
// https://developers.facebook.com/docs/facebook-login/web#logindialog 


function easybook_addons_the_excerpt_max_charlength($charlength = 150, $echo = true) {
    $excerpt = get_the_excerpt();
    $charlength++;

    $return = $excerpt;

    if ( mb_strlen( $excerpt ) > $charlength ) {
        $subex = mb_substr( $excerpt, 0, $charlength - 5 );
        $exwords = explode( ' ', $subex );
        $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
        if ( $excut < 0 ) {
            $return = mb_substr( $subex, 0, $excut );
        } else {
            $return = $subex;
        }
        $return .= esc_html__( '...', 'easybook-add-ons' );
    }
    if(!$echo) return $return;
    else echo $return;
}
// post archive pagination
function easybook_addons_pagination(){

    the_posts_pagination( array(
        'prev_text' =>  wp_kses(__('<i class="fa fa-caret-left"></i>','easybook-add-ons'),array('i'=>array('class'=>array(),),) ) ,
        'next_text' =>  wp_kses(__('<i class="fa fa-caret-right"></i>','easybook-add-ons'),array('i'=>array('class'=>array(),),) ) ,
        'screen_reader_text' => esc_html__( 'Posts navigation', 'easybook-add-ons' ),
    ) );

}

function easybook_addons_ajax_pagination($pages = '', $range = 2, $current_query = ''){
    $showitems = ($range * 2) + 1;
    
    if ($current_query == '') {
        global $paged;
        if (empty($paged)) $paged = 1;
    }else {
        $paged = $current_query->query_vars['paged'];
    }
    
    if ($pages == '') {
        if ($current_query == '') {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if (!$pages) {
                $pages = 1;
            }
        } 
        else {
            $pages = $current_query->max_num_pages;
        }
    }
    if (1 < $pages) {
        echo '<span class="section-separator"></span>
        <nav class="navigation pagination custom-pagination ajax-pagination" role="navigation">
            <div class="nav-links">';

                // if ($paged > 1) echo '<a data-page="'.($paged - 1).'" href="#" class="prev page-numbers ajax-pagi-item">'.__('<i class="fa fa-caret-left" aria-hidden="true"></i>','easybook-add-ons').'</a>';
                
                for ($i = 1; $i <= $pages; $i++) {
                    if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                        echo ($paged == $i) ? '<span data-page="'.$i.'" aria-current="page" class="page-numbers current">' . $i . "</span>" : '<a data-page="'.$i.'" href="#" class="page-numbers ajax-pagi-item">' . $i . '</a>';
                    }
                }

                // if ($paged < $pages) echo '<a data-page="'.($paged + 1).'" href="#" class="next page-numbers ajax-pagi-item">'.__('<i class="fa fa-caret-right" aria-hidden="true"></i>','easybook-add-ons').'</a>';
            
            echo'</div>
        </nav>';
    }
}



/**
 * Pagination for custom query page
 *
 * @since EasyBook 1.0
 */
if (!function_exists('easybook_addons_custom_pagination')) {
    function easybook_addons_custom_pagination($pages = '', $range = 2, $current_query = '') {
        // var_dump($pages);die;
        $showitems = ($range * 2) + 1;
        
        if ($current_query == '') {
            global $paged;
            if (empty($paged)) $paged = 1;
        } 
        else {
            $paged = $current_query->query_vars['paged'];
        }
        
        if ($pages == '') {
            if ($current_query == '') {
                global $wp_query;
                $pages = $wp_query->max_num_pages;
                if (!$pages) {
                    $pages = 1;
                }
            } 
            else {
                $pages = $current_query->max_num_pages;
            }
        }
        
        if (1 < $pages) {
            echo '<span class="section-separator"></span>
            <nav class="navigation pagination custom-pagination" role="navigation">
                <h2 class="screen-reader-text">'.__( 'Posts navigation',  'easybook-add-ons' ).'</h2>
                <div class="nav-links">';

                    if ($paged > 1) echo '<a href="' . get_pagenum_link($paged - 1) . '" class="prev page-numbers">'.__('<i class="fa fa-caret-left" aria-hidden="true"></i>','easybook-add-ons').'</a>';
                    
                    for ($i = 1; $i <= $pages; $i++) {
                        if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                            echo ($paged == $i) ? '<span aria-current="page" class="page-numbers current">' . $i . "</span>" : "<a href='" . get_pagenum_link($i) . "' class='page-numbers'>" . $i . "</a>";
                        }
                    }

                    if ($paged < $pages) echo '<a href="' . get_pagenum_link($paged + 1) . '" class="next page-numbers">'.__('<i class="fa fa-caret-right" aria-hidden="true"></i>','easybook-add-ons').'</a>';
                echo'</div>
            </nav>';
        }

    }
}
// 0 for root level and so on
function easybook_addons_get_listing_categories($max_level = 3){
    $listing_cats = get_terms( array(
        'taxonomy' => 'listing_cat',
        'hide_empty' => false
    ) );

    $listing_cats_arr = array();
    easybook_addons_parse_listing_cats($listing_cats,$listing_cats_arr,0,-1,$max_level);

    return $listing_cats_arr;
}

function easybook_addons_parse_listing_cats($cats = array(),&$return =array(),$parent_id = 0,$curlevel = -1,$maxlevel = 3){
    $return = $return? $return : array();
    if ( !empty($cats) ){
        foreach( $cats as $cat ) {
            if( $cat->parent == $parent_id ) {
                // $return[$cat->term_id] = array('name'=>$cat->name,'level'=>$curlevel+1,'children'=>array());
                $return[] = array('id'=>$cat->term_id,'name'=>$cat->name,'level'=>$curlevel+1,'value'=>$cat->term_id,'label'=>$cat->name);
                // if($return[$cat->term_id]['level'] < $maxlevel ) $this->parse_listing_cats($cats,$return[$cat->term_id]['children'],$cat->term_id,$return[$cat->term_id]['level']);
                if($curlevel+1 < $maxlevel ) easybook_addons_parse_listing_cats($cats,$return,$cat->term_id,$curlevel+1,$maxlevel);

                
            }
        }
    }
    return $return;
}


function easybook_addons_get_listing_categories_select2(){
    $cats = easybook_addons_get_listing_categories();
    if(!empty($cats)){
        $return = array();
        foreach ($cats as $cat ){
            // $return[] = array($cat['id'] => str_repeat("-", $cat['level']).$cat['name']);
            $return[$cat['id']] = str_repeat("-", $cat['level']).$cat['name'];
        }
        return $return;
    }else{
        return array();
    }
}
function easybook_addons_get_listing_locations_select2(){
    $listing_locs = get_terms( array(
        'taxonomy' => 'listing_location',
        'hide_empty' => false
    ) );
    if ( ! empty( $listing_locs ) && ! is_wp_error( $listing_locs ) ){
        $return = array();
        foreach ($listing_locs as $loc ){
            $return[$loc->term_id] = $loc->name;
        }
        return $return;
    }else{
        return array();
    }
}

function easybook_addons_get_listing_locations($hide_empty = false){
    $listing_locs = get_terms( array(
        'taxonomy' => 'listing_location',
        'hide_empty' => $hide_empty
    ) );

    $locations = array();
    if ( ! empty( $listing_locs ) && ! is_wp_error( $listing_locs ) ){
        foreach ( $listing_locs as $loc ) {
            $locations[$loc->slug] = $loc->name;
        }
    }
    
    return $locations;
}

function easybook_addons_get_listing_feature($hide_empty = false){
    $listing_feat = get_terms( array(
        'taxonomy' => 'listing_feature',
        'hide_empty' => $hide_empty
    ) );

    $feature = array();
    if ( ! empty( $listing_feat ) && ! is_wp_error( $listing_feat ) ){
        foreach ( $listing_feat as $feat ) {
            $feature[$feat->slug] = $feat->name;
        }
    }
    return $feature;
}

function easybook_addons_get_edit_listing_url($listing_id = null){

    $edit_page_id = easybook_addons_get_option('edit_page');

    if(!isset($listing_id)) $listing_id = get_the_ID();

    return add_query_arg( 'listing_id', $listing_id,  get_permalink( $edit_page_id ) );
}


// get dashboard subpages - related with dashboard shortcode page.
function easybook_addons_get_dashboard_subpage($var = ''){

    $subpages = array(
        'listings' => __( 'Your Listings', 'easybook-add-ons' ),
        'reviews' => __( 'Your Comments', 'easybook-add-ons' ),
        'changepass' => __( 'Change Password', 'easybook-add-ons' ),
        'messages' => __( 'Your Messages', 'easybook-add-ons' ),
        'bookings' => __( 'Your Bookings', 'easybook-add-ons' ),
        'bookmarks' => __( 'Bookmarks', 'easybook-add-ons' ),
        'profile' => __( 'Edit Profile', 'easybook-add-ons' ),
        'packages' => __( 'Packages', 'easybook-add-ons' ),
        'invoices' => __( 'Invoices', 'easybook-add-ons' ),
        'ads' => __( 'AD Campaigns', 'easybook-add-ons' ),
    );

    if($var != '' && isset($subpages[$var])){
        return $subpages[$var];
    }

    return get_the_title( easybook_addons_get_option('dashboard_page') );
}

if(!function_exists('easybook_addons_breadcrumbs')){
    function easybook_addons_breadcrumbs($classes='') {
               
        // Settings
        $breadcrums_id      = 'breadcrumbs';
        $breadcrums_class   = 'breadcrumbs '.$classes;
        $home_title         = esc_html__('Home','easybook-add-ons');
        $blog_title         = esc_html__('Blog','easybook-add-ons');


        // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
        // $custom_taxonomy    = 'product_cat,portfolio_cat,cth_speaker';
        // $custom_taxonomy    = 'listing_cat,listing_feature,listing_location';
        $custom_taxonomy    = 'listing_cat';

        $custom_post_types = array(
                                'listing' => esc_html_x('Listing','listing archive in breadcrumb','easybook-add-ons'),
                                'product' => esc_html_x('Products','product archive in breadcrumb','easybook-add-ons'),
                                
                            );
          
        // Get the query & post information
        global $post;
          
        // Do not display on the homepage
        if ( !is_front_page() ) {
          
            // Build the breadcrums
            echo '<div id="' . esc_attr($breadcrums_id ) . '" class="' . esc_attr($breadcrums_class ) . '">';
              
            // Home page
            echo '<a class="breadcrumb-link breadcrumb-home" href="' . esc_url( home_url('/') ) . '" title="' . esc_attr($home_title ) . '">' . esc_html($home_title ) . '</a>';

            if(is_home()){
                // Blog page
                echo '<span class="breadcrumb-current breadcrumb-item-blog">' . esc_html($blog_title ) . '</span>';
            }
              
            if ( is_archive() && !is_tax() ) {

                // If post is a custom post type
                $post_type = get_post_type();

                if($post_type && array_key_exists($post_type, $custom_post_types)){
                    echo '<span class="breadcrumb-current breadcrumb-item-custom-post-type-' . esc_attr( $post_type ) . '">' . esc_html( $custom_post_types[$post_type] ) . '</span>';
                }else{
                    echo '<span class="breadcrumb-current breadcrumb-item-archive">' . get_the_archive_title() . '</span>';
                }
                 
            } else if ( is_archive() && is_tax() ) {
                 
                // If post is a custom post type
                $post_type = get_post_type();
                 
                // If it is a custom post type display name and link
                if($post_type && $post_type != 'post') {
                     
                    $post_type_object = get_post_type_object($post_type);
                    $post_type_archive = get_post_type_archive_link($post_type);
                 
                    echo '<a class="breadcrumb-link breadcrumb-custom-post-type-' . esc_attr( $post_type ) . '" href="' . esc_url($post_type_archive ) . '" title="' .  esc_attr( $post_type_object->labels->name ) . '">' . esc_html( $post_type_object->labels->name ) . '</a>';
                 
                }
                 
                $custom_tax_name = get_queried_object()->name;
                echo '<span class="breadcrumb-current bread-item-archive">' . esc_html( $custom_tax_name ) . '</span>';
                 
            } else if ( is_single() ) {
                
                // If post is a custom post type
                $post_type = get_post_type();
                $last_category = '';
                // If it is a custom post type (not support custom taxonomy) display name and link
                if( !in_array( $post_type, array('post','listing') ) ) {
                     
                    $post_type_object = get_post_type_object($post_type);
                    $post_type_archive = get_post_type_archive_link($post_type);

                    if(array_key_exists($post_type, $custom_post_types)){
                        echo '<a class="breadcrumb-link breadcrumb-cat breadcrumb-custom-post-type-' . esc_attr( $post_type ) . '" href="' . esc_url($post_type_archive ) . '" title="' . esc_attr( $custom_post_types[$post_type] ) . '">' . esc_html( $custom_post_types[$post_type] ) . '</a>';
                    }else{
                        echo '<a class="breadcrumb-link breadcrumb-cat breadcrumb-custom-post-type-' . esc_attr( $post_type ) . '" href="' . esc_url($post_type_archive ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '">' . esc_html( $post_type_object->labels->name ) . '</a>';
                    }
                    
                    echo '<span class="breadcrumb-current breadcrumb-item-' . esc_attr( $post->ID ) . '" title="' . esc_attr( get_the_title() ) . '">' . get_the_title() . '</span>';
                }elseif($post_type == 'post'){
                    // Get post category info
                    $category = get_the_category();
                     
                    // Get last category post is in
                    
                    if($category){
                        $last_cateogries = array_values($category);
                        $last_category = end($last_cateogries);
                     
                        // Get parent any categories and create array
                        $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                        $cat_parents = explode(',',$get_cat_parents);
                         
                        // Loop through parent categories and store in variable $cat_display
                        $cat_display = '';
                        foreach($cat_parents as $parents) {
                            $cat_display .= '<span class="breadcrumb-current breadcrumb-item-cat">'.esc_html( $parents ).'</span>';
                            
                        }
                    }
                    
                    if(!empty($last_category)) {
                        echo wp_kses_post($cat_display );
                        echo '<span class="breadcrumb-current breadcrumb-item-' . esc_attr( $post->ID ) . '" title="' . esc_attr( get_the_title() ). '">' . get_the_title() . '</span>';
                         
                    // Else if post is in a custom taxonomy
                    }
                }
                    
                     
                // If it's a custom post type within a custom taxonomy
                if(empty($last_category) && !empty($custom_taxonomy)) {
                    $custom_taxonomy_arr = explode(",", $custom_taxonomy) ;
                    foreach ($custom_taxonomy_arr as $key => $custom_taxonomy_val) {
                        $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy_val );
                        if($taxonomy_terms && !($taxonomy_terms instanceof WP_Error) ){
                            $cat_id         = $taxonomy_terms[0]->term_id;
                            $cat_nicename   = $taxonomy_terms[0]->slug;
                            $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy_val);
                            $cat_name       = $taxonomy_terms[0]->name;

                            if(!empty($cat_id)) {
                         
                                echo '<a class="breadcrumb-link bread-cat-' . esc_attr( $cat_id ) . ' bread-cat-' . esc_attr( $cat_nicename ) . '" href="' . esc_url($cat_link ) . '" title="' . esc_attr( $cat_name ) . '">' . esc_html( $cat_name ) . '</a>';
                                
                                echo '<span class="breadcrumb-current breadcrumb-item-' . esc_attr( $post->ID ) . '" title="' . esc_attr( get_the_title() ) . '">' . get_the_title() . '</span>';
                             
                            }
                        }

                     } 
                    
                  
                }
                 
                
                 
            } else if ( is_category() ) {
                  
                // Category page
                echo '<span class="breadcrumb-current breadcrumb-item-cat-' . esc_attr( $category[0]->term_id ) . ' bread-cat-' . esc_attr( $category[0]->category_nicename ) . '">' . esc_html( $category[0]->cat_name ) . '</span>';
                  
            } else if ( is_page() ) {
                
                $dashboard_page_id = easybook_addons_get_option('dashboard_page');
                $dashboard_var = get_query_var('dashboard');

                // Standard page
                if( $post->post_parent ){

                    $parents = '';
                      
                    // If child page, get parents 
                    $anc = get_post_ancestors( $post->ID );
                      
                    // Get parents in the right order
                    $anc = array_reverse($anc);
                      
                    // Parent page loop
                    foreach ( $anc as $ancestor ) {
                        $parents .= '<a class="breadcrumb-link breadcrumb-parent-' . esc_attr( $ancestor ) . '" href="' . esc_url(get_permalink($ancestor) ) . '" title="' . esc_attr( get_the_title($ancestor) ). '">' . get_the_title($ancestor) . '</a>';
                        
                    }
                      
                    // Display parent pages
                    echo wp_kses_post($parents );

                    if(is_page($dashboard_page_id) && $dashboard_var != ''){

                        // dashboard page
                        echo '<a class="breadcrumb-link breadcrumb-dashboard" href="' . esc_url(get_permalink($dashboard_page_id) ) . '" title="' . esc_attr( get_the_title($dashboard_page_id) ) . '">' . get_the_title($dashboard_page_id) . '</a>';
                        // Current page
                        echo '<span class="breadcrumb-current breadcrumb-dashboard-subpage" title="' . esc_attr( easybook_addons_get_dashboard_subpage($dashboard_var) ). '">' . easybook_addons_get_dashboard_subpage($dashboard_var) . '</span>';

                    }else{
                      
                        // Current page
                        echo '<span class="breadcrumb-current breadcrumb-item-page-' . esc_attr( $post->ID ). '" title="' . esc_attr( get_the_title(  ) ) . '">' . get_the_title() . '</span>';
                    }
                    
                      
                } else {
                      
                    // Just display current page if not parents
                    if(is_page($dashboard_page_id) && $dashboard_var != ''){

                        // dashboard page
                        echo '<a class="breadcrumb-link breadcrumb-dashboard" href="' . esc_url(get_permalink($dashboard_page_id) ) . '" title="' . esc_attr( get_the_title($dashboard_page_id) ) . '">' . get_the_title($dashboard_page_id) . '</a>';
                        // Current page
                        echo '<span class="breadcrumb-current breadcrumb-dashboard-subpage" title="' . esc_attr( easybook_addons_get_dashboard_subpage($dashboard_var) ). '">' . easybook_addons_get_dashboard_subpage($dashboard_var) . '</span>';

                    }else{
                      
                        // Current page
                        echo '<span class="breadcrumb-current breadcrumb-item-page-' . esc_attr( $post->ID ) . '" title="' . esc_attr( get_the_title() ) . '">' . get_the_title() . '</span>';
                    }
                      
                }
                  
            } else if ( is_tag() ) {
                  
                // Tag page
                  
                // Get tag information
                $term_id = get_query_var('tag_id');
                $taxonomy = 'post_tag';
                $args ='include=' . $term_id;
                $terms = get_terms( $taxonomy, $args );
                  
                // Display the tag name
                echo '<span class="breadcrumb-current breadcrumb-item-tag-' . esc_attr( $terms[0]->term_id ) . ' bread-tag-' . esc_attr( $terms[0]->slug ) . '">' . esc_attr( $terms[0]->name ) . '</span>';
              
            } elseif ( is_day() ) {
                  
                // Day archive
                  
                // Year link
                echo '<a class="breadcrumb-link breadcrumb-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . esc_html__(' Archives','easybook-add-ons').'</a>';
                
                  
                // Month link
                echo '<a class="breadcrumb-link breadcrumb-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . esc_html__(' Archives','easybook-add-ons').'</a>';
                
                  
                // Day display
                echo '<span class="breadcrumb-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') .  esc_html__(' Archives','easybook-add-ons').'</span>';
                  
            } else if ( is_month() ) {
                  
                // Month Archive
                  
                // Year link
                echo '<a class="breadcrumb-link breadcrumb-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . esc_html__(' Archives','easybook-add-ons').'</a>';
                
                  
                // Month display
                echo '<span class="breadcrumb-current breadcrumb-month breadcrumb-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . esc_html__(' Archives','easybook-add-ons').'</span>';
                  
            } else if ( is_year() ) {
                  
                // Display year archive
                echo '<strong class="breadcrumb-current breadcrumb-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . esc_html__(' Archives','easybook-add-ons').'</span>';
                  
            } else if ( is_author() ) {
                  
                // Auhor archive
                  
                // Get the author information
                global $author;
                $userdata = get_userdata( $author );
                  
                // Display author name
                echo '<span class="breadcrumb-current breadcrumb-current-' . esc_attr( $userdata->user_nicename ) . '" title="' . esc_attr( $userdata->display_name ) . '">' .  esc_html__(' Author: ','easybook-add-ons') . esc_html( $userdata->display_name ) . '</span>';
              
            } else if ( get_query_var('paged') ) {
                  
                // Paginated archives
                echo '<a href="#" class="breadcrumb-current breadcrumb-current-' . get_query_var('paged') . '" title="'.esc_attr__('Page','easybook-add-ons') . get_query_var('paged') . '">'.esc_html__('Page','easybook-add-ons') . ' ' . get_query_var('paged') . '</a>';
                  
            } else if ( is_search() ) {
              
                // Search results page
                echo '<span class="breadcrumb-current breadcrumb-current-' . get_search_query() . '" title="'.esc_attr__('Search results for: ','easybook-add-ons') . get_search_query() . '">'.esc_html__('Search results for: ','easybook-add-ons') . get_search_query() . '</span>';
              
            } elseif ( is_404() ) {
                  
                // 404 page
                echo '<span class="breadcrumb-current breadcrumb-current-404">' . esc_html__('Error 404','easybook-add-ons') . '</span>';
            }
          
            echo '</div>';
              
        }
          
    }
}


// edit listing link
function easybook_addons_edit_listing_link($id = 0){
    if(!(int)$id) $id = get_the_ID();
    if ( !current_user_can( 'edit_post', $id ) ) 
        return;
    echo '<a href="'.esc_url(get_permalink(easybook_addons_get_option('dashboard_page')).'#/editListing/'.$id ).'">'.__( 'Edit <i className="fal fa-edit"></i>', 'easybook-add-ons' ).'</a>';
}

function easybook_addons_edit_listing_url($id = 0){
    if(!$id) $id = get_the_ID();
    if ( !current_user_can( 'edit_post', $id ) ) 
        return;
    
    return esc_url(get_permalink(easybook_addons_get_option('dashboard_page')).'#/editListing/'.$id );
}

function easybook_addons_get_contact_form7_forms(){
    $forms = get_posts( 'post_type=wpcf7_contact_form&posts_per_page=-1' );

    $results = array();
    if ( $forms ) {
        $results[] = __( 'Select A Form', 'easybook-add-ons' );
        foreach ( $forms as $form ) {
            $results[ $form->ID ] = $form->post_title;
        }
        // array_unshift( $results, __( 'Select A Form', 'easybook-add-ons' ) );
        // $results[] = __( 'Select A Form', 'easybook-add-ons' );
    } else {
        $results[] =  __( 'No contact forms found', 'easybook-add-ons' ) ;
    }

    return $results;
}
// echo socials share content
function easybook_addons_echo_socials_share(){
    $widgets_share_names = easybook_addons_get_option('widgets_share_names','facebook, pinterest, googleplus, twitter, linkedin');
    if($widgets_share_names !=''):
    ?>
    <div class="share-holder hid-share">
        <div class="showshare"><span class="share-show"><?php esc_html_e( 'Share ', 'easybook-add-ons' ); ?></span><span class="share-close"><?php esc_html_e( 'Close ', 'easybook-add-ons' ); ?></span><i class="fa fa-share"></i></div>
        <div class="share-container isShare" data-share="<?php echo esc_attr( trim($widgets_share_names, ", \t\n\r\0\x0B") ); ?>"></div>
    </div>
    <?php
    endif;  
}

// for payment
function easybook_addons_get_currency_array(){
    $world_curr = array (
        'ALL' => 'Albania Lek',
        'AFN' => 'Afghanistan Afghani',
        'ARS' => 'Argentina Peso',
        'AWG' => 'Aruba Guilder',
        'AUD' => 'Australia Dollar',
        'AZN' => 'Azerbaijan New Manat',
        'BSD' => 'Bahamas Dollar',
        'BBD' => 'Barbados Dollar',
        'BDT' => 'Bangladeshi taka',
        'BYR' => 'Belarus Ruble',
        'BZD' => 'Belize Dollar',
        'BMD' => 'Bermuda Dollar',
        'BOB' => 'Bolivia Boliviano',
        'BAM' => 'Bosnia and Herzegovina Convertible Marka',
        'BWP' => 'Botswana Pula',
        'BGN' => 'Bulgaria Lev',
        'BRL' => 'Brazil Real',
        'BND' => 'Brunei Darussalam Dollar',
        'KHR' => 'Cambodia Riel',
        'CAD' => 'Canada Dollar',
        'KYD' => 'Cayman Islands Dollar',
        'CLP' => 'Chile Peso',
        'CNY' => 'China Yuan Renminbi',
        'COP' => 'Colombia Peso',
        'CRC' => 'Costa Rica Colon',
        'HRK' => 'Croatia Kuna',
        'CUP' => 'Cuba Peso',
        'CZK' => 'Czech Republic Koruna',
        'DKK' => 'Denmark Krone',
        'DOP' => 'Dominican Republic Peso',
        'XCD' => 'East Caribbean Dollar',
        'EGP' => 'Egypt Pound',
        'SVC' => 'El Salvador Colon',
        'EEK' => 'Estonia Kroon',
        'EUR' => 'Euro Member Countries',
        'FKP' => 'Falkland Islands (Malvinas) Pound',
        'FJD' => 'Fiji Dollar',
        'GHC' => 'Ghana Cedis',
        'GIP' => 'Gibraltar Pound',
        'GTQ' => 'Guatemala Quetzal',
        'GGP' => 'Guernsey Pound',
        'GYD' => 'Guyana Dollar',
        'HNL' => 'Honduras Lempira',
        'HKD' => 'Hong Kong Dollar',
        'HUF' => 'Hungary Forint',
        'ISK' => 'Iceland Krona',
        'INR' => 'India Rupee',
        'IDR' => 'Indonesia Rupiah',
        'IRR' => 'Iran Rial',
        'IMP' => 'Isle of Man Pound',
        'ILS' => 'Israel Shekel',
        'JMD' => 'Jamaica Dollar',
        'JPY' => 'Japan Yen',
        'JEP' => 'Jersey Pound',
        'KZT' => 'Kazakhstan Tenge',
        'KPW' => 'Korea (North) Won',
        'KRW' => 'Korea (South) Won',
        'KGS' => 'Kyrgyzstan Som',
        'LAK' => 'Laos Kip',
        'LVL' => 'Latvia Lat',
        'LBP' => 'Lebanon Pound',
        'LRD' => 'Liberia Dollar',
        'LTL' => 'Lithuania Litas',
        'MKD' => 'Macedonia Denar',
        'MYR' => 'Malaysia Ringgit',
        'MUR' => 'Mauritius Rupee',
        'MXN' => 'Mexico Peso',
        'MNT' => 'Mongolia Tughrik',
        'MZN' => 'Mozambique Metical',
        'NAD' => 'Namibia Dollar',
        'NPR' => 'Nepal Rupee',
        'ANG' => 'Netherlands Antilles Guilder',
        'NZD' => 'New Zealand Dollar',
        'NIO' => 'Nicaragua Cordoba',
        'NGN' => 'Nigeria Naira',
        'NOK' => 'Norway Krone',
        'OMR' => 'Oman Rial',
        'PKR' => 'Pakistan Rupee',
        'PAB' => 'Panama Balboa',
        'PYG' => 'Paraguay Guarani',
        'PEN' => 'Peru Nuevo Sol',
        'PHP' => 'Philippines Peso',
        'PLN' => 'Poland Zloty',
        'QAR' => 'Qatar Riyal',
        'RON' => 'Romania New Leu',
        'RUB' => 'Russia Ruble',
        'SHP' => 'Saint Helena Pound',
        'SAR' => 'Saudi Arabia Riyal',
        'RSD' => 'Serbia Dinar',
        'SCR' => 'Seychelles Rupee',
        'SGD' => 'Singapore Dollar',
        'SBD' => 'Solomon Islands Dollar',
        'SOS' => 'Somalia Shilling',
        'ZAR' => 'South Africa Rand',
        'LKR' => 'Sri Lanka Rupee',
        'SEK' => 'Sweden Krona',
        'CHF' => 'Switzerland Franc',
        'SRD' => 'Suriname Dollar',
        'SYP' => 'Syria Pound',
        'TWD' => 'Taiwan New Dollar',
        'THB' => 'Thailand Baht',
        'TTD' => 'Trinidad and Tobago Dollar',
        'TRY' => 'Turkey Lira',
        'TRL' => 'Turkey Lira',
        'TVD' => 'Tuvalu Dollar',
        'UAH' => 'Ukraine Hryvna',
        'GBP' => 'United Kingdom Pound',
        'UGX' => 'Uganda Shilling',
        'USD' => 'United States Dollar',
        'UYU' => 'Uruguay Peso',
        'UZS' => 'Uzbekistan Som',
        'VEF' => 'Venezuela Bolivar',
        'VND' => 'Viet Nam Dong (₫)',
        'YER' => 'Yemen Rial',
        'ZWD' => 'Zimbabwe Dollar',
        'CFA' => 'CFA Franc' ,

        'KSH' => 'Kenya shillings',
    );
    $paypal_curr = array(
        "USD" => "US Dollars ($) - Paypal acceptable", 
        "EUR" => "Euros (€) - Paypal acceptable",
        "GBP" => "Pounds Sterling (£) - Paypal acceptable",
        "AUD" => "Australian Dollars ($) - Paypal acceptable",
        "BRL" => "Brazilian Real (R$) - Paypal acceptable",
        "CAD" => "Canadian Dollars ($) - Paypal acceptable",
        "CZK" => "Czech Koruna - Paypal acceptable",
        "DKK" => "Danish Krone - Paypal acceptable",
        "HKD" => "Hong Kong Dollar ($) - Paypal acceptable",
        "HUF" => "Hungarian Forint - Paypal acceptable",
        "ILS" => "Israeli Shekel (₪) - Paypal acceptable",
        "JPY" => "Japanese Yen (¥) - Paypal acceptable",
        "MYR" => "Malaysian Ringgits - Paypal acceptable",
        "MXN" => "Mexican Peso ($) - Paypal acceptable",
        "NZD" => "New Zealand Dollar ($) - Paypal acceptable",
        "NOK" => "Norwegian Krone - Paypal acceptable",
        "PHP" => "Philippine Pesos - Paypal acceptable",
        "PLN" => "Polish Zloty - Paypal acceptable",
        "SGD" => "Singapore Dollar ($) - Paypal acceptable",
        "SEK" => "Swedish Krona - Paypal acceptable",
        "CHF" => "Swiss Franc - Paypal acceptable",
        "TWD" => "Taiwan New Dollars - Paypal acceptable",
        "THB" => "Thai Baht (฿) - Paypal acceptable",
        "INR" => "Indian Rupee (₹) - Paypal acceptable",
        "TRY" => "Turkish Lira (₺) - Paypal acceptable",
        "RIAL" => "Iranian Rial (﷼) - Paypal acceptable",
        "RUB"  => "Russian Rubles - Paypal acceptable",

    );

    return array_merge($world_curr, $paypal_curr);
}
function easybook_addons_get_plan_prices($plan_id = 0, $raw_price = 0){
    
    if($raw_price) 
        $price = $raw_price;
    else 
        $price = get_post_meta( $plan_id, '_price', true );
    
    $price = floatval($price);

    $vat_percent = 0;// easybook_addons_get_option('vat_tax');

    $tax = floatval($vat_percent) * $price / 100;

    $total = $price + $tax ;

    return array(
        'price' => $price,
        'tax' => $tax,
        'total' => $total,
    );

}
// function easybook_addons_get_booking_prices($room_id = 0){
    
//     $price = get_post_meta( $room_id, '_cth__price', true );
    
//     $price = floatval($price);

//     $vat_percent = easybook_addons_get_option('vat_tax');

//     $tax = floatval($vat_percent) * $price / 100;

//     $total = $price + $tax ;

//     return array(
//         'price' => $price,
//         'tax' => $tax,
//         'total' => $total,
//     );

// }
function easybook_addons_get_stripe_amount($amount=0){
    // The amount (in cents) that's shown to the user. Note that you will still have to explicitly include the amount when you create a charge using the API.
    // $20 -> 2000
    return $amount*100;
}
function easybook_addons_get_currency(){

    $return = easybook_addons_get_option('currency', 'USD') ;
    if(isset($_COOKIE["esb_currency"])){
        $currency = stripslashes($_COOKIE['esb_currency']);
        if($currency != '' && array_key_exists($currency, easybook_addons_get_currency_array())) $return = $currency;
    }
    return apply_filters('esb_currency', $return);
}
function easybook_addons_find_currency($currency = null){
    if( $currency == null ) $currency = easybook_addons_get_currency();
    return array_filter((array)easybook_addons_get_option('currencies'), function($cur) use ($currency) {
        return is_array($cur) && isset($cur['currency']) && $cur['currency'] == $currency;
    });
}
function easybook_addons_get_currency_rate($currency = null){
    $foundCurrs = easybook_addons_find_currency($currency);
    if(!empty($foundCurrs)){
        $foundCurr = reset($foundCurrs);
        return (float)$foundCurr['rate'];
    }
    return 1;
}
function easybook_addons_get_base_currency(){
    $base_curr = easybook_addons_get_option('currency', 'USD');
    return array(
        'currency'                  => $base_curr,
        'symbol'                    => easybook_addons_get_option('currency_symbol','$'),
        'rate'                      => '1',
        'sb_pos'                    => easybook_addons_get_option('currency_pos','left'),
        'decimal'                   => easybook_addons_get_option('decimals','2'),
        'ths_sep'                   => easybook_addons_get_option('thousand_sep',','),
        'dec_sep'                   => easybook_addons_get_option('decimal_sep','.'),
    );
}
function easybook_addons_get_currency_attrs(){
    $currency_attrs = array();
    $foundCurrs = easybook_addons_find_currency();
    if(!empty($foundCurrs)){
        // var_dump($foundCurrs);reset()
        $foundCurr = reset($foundCurrs);

        $currency_attrs = array(
            'rate'              => $foundCurr['rate'] ? : 1,
            'decimal'           => $foundCurr['decimal'],
            'dec_sep'           => $foundCurr['dec_sep'] ,
            'ths_sep'           => $foundCurr['ths_sep'] ,
            'symbol'            => $foundCurr['symbol'],
            'sb_pos'            => $foundCurr['sb_pos'] ,
            'currency'          => $foundCurr['currency'] ,
        );

        // $currency_attrs = array(
        //     'rate'          => $foundCurr['rate'] ? : 1,
        //     'decimal'          => $foundCurr['number_decimal'],
        //     'dec_sep'          => $foundCurr['decimal_separator'] ,
        //     'ths_sep'          => $foundCurr['thousand_separator'] ,
        //     'symbol'          => $foundCurr['symbol'],
        //     'sb_pos'          => $foundCurr['position'] ,
        //     'currency'          => $foundCurr['curr'] ,
        // );

    }else{
        $currency_attrs = easybook_addons_get_base_currency();
    }

    return apply_filters( 'esb_currency_attrs', $currency_attrs );

}
function easybook_addons_get_price_formated($price = 0, $show_symbol = true){
    $price = floatval($price);

    if( is_admin() && !wp_doing_ajax() ){
        $curr_attrs = easybook_addons_get_base_currency();
    }else{
        $curr_attrs = easybook_addons_get_currency_attrs();
    }

    $return = number_format( (float)$price  * $curr_attrs['rate'], $curr_attrs['decimal'], $curr_attrs['dec_sep'], $curr_attrs['ths_sep'] );
    if($show_symbol){
        $currency = $curr_attrs['symbol'];
        $currency_pos = $curr_attrs['sb_pos'];
        switch ($currency_pos) {
            case 'left':
                $return = $currency .$return;
                break;
            case 'right':
                $return .= $currency;
                break;
            case 'right_space':
                $return .= '&nbsp;'. $currency;
                break;
            default:
                $return = $currency . '&nbsp;'. $return;
                break;
        }
        
    }
    return $return;
}
function easybook_addons_get_price($price = 0){
    $price = floatval($price);
    $curr_attrs = easybook_addons_get_currency_attrs();
    return  $price * floatval($curr_attrs['rate']);
}
function easybook_addons_parse_price($price = 0){
    $price = floatval($price);
    if(empty($price)) return 0;
    $curr_attrs = easybook_addons_get_currency_attrs();
    if(!empty($curr_attrs['rate'])){
        return $price / floatval($curr_attrs['rate']);
    }
    return $price;
}
function easybook_addons_get_currency_symbol(){
    $curr_attrs = easybook_addons_get_currency_attrs();
    return $curr_attrs['symbol'];
}
// function easybook_addons_calculate_yearly_price($price, $period, $interval, $yearly_sale) {
//     return '$';
// }
function easybook_addons_get_order_method_text($method = '',$is_array = false){
    $methods = array(
        'free' => __( 'Free', 'easybook-add-ons' ),
        'submitform' => __( 'Submit Form', 'easybook-add-ons' ),
        'cod' => __( 'Cash on delivery', 'easybook-add-ons' ),
        'banktransfer' => __( 'Bank Transfer', 'easybook-add-ons' ),
        'request' => __( 'Booking Request', 'easybook-add-ons' ),
        // 'paypal' => __( 'Paypal', 'easybook-add-ons' ),
        // 'stripe' => __( 'Stripe', 'easybook-add-ons' ),
        // 'woo' => __( 'WooCommerce Integration', 'easybook-add-ons' ),
        // 'payfast' => __( 'PayFast', 'easybook-add-ons' ),
    );
    $methods = (array)apply_filters( 'esb_payment_method_texts', $methods );
    if(isset($methods[$method])) return $methods[$method];
    elseif ($is_array != false) return $methods;
    else return reset($methods);
    
}

function easybook_addons_get_payment_methods($method = ''){
    $payments = array();
    if(easybook_addons_get_option('payments_form_enable') == 'yes'){
        $payments['submitform'] = array(
            'title' => __( 'Submit Form', 'easybook-add-ons' ),
            
            'icon' => get_site_icon_url(),
            'desc' => easybook_addons_get_option('payments_form_details',''),

            'checkout_text' => __( 'Place Order', 'easybook-add-ons' ),
        );
    }
    if(easybook_addons_get_option('payments_cod_enable') == 'yes'){
        $payments['cod'] = array(
            'title' => __( 'Cash on delivery', 'easybook-add-ons' ),
            
            'icon' => '', //get_site_icon_url(),
            'desc' => easybook_addons_get_option('payments_cod_details',''),

            'checkout_text' => __( 'Place Order', 'easybook-add-ons' ),
        );
    }
    // banktransfer
    if(easybook_addons_get_option('payments_banktransfer_enable') == 'yes'){
        $payments['banktransfer'] = array(
            'title' => __( 'Bank Transfer', 'easybook-add-ons' ),
            
            'icon' => ESB_DIR_URL.'assets/images/bank-transfer.png',
            'desc' => easybook_addons_get_option('payments_banktransfer_details',''),

            'checkout_text' => __( 'Place Order', 'easybook-add-ons' ),
        );
    }
    
    $payments = (array)apply_filters( 'esb_payment_methods', $payments );
    if(isset($payments[$method])) return $payments[$method];
    else return $payments;
}

// convert PDT (Paypal time to UTC) --> NOTE: need to return to local date
function easybook_add_ons_payment_date($date ='', $format = 'Y-m-d H:i:s'){

    // $dateObj = new DateTime($date, new DateTimeZone('America/Los_Angeles'));
    $dateObj = new DateTime($date);
    // $tz = new DateTimeZone('Europe/London');04:31:57+Apr+21,+2018+PDT04:31:57+Apr+21,+2018+PDT
    $tz = new DateTimeZone('UTC');
    $dateObj->setTimezone($tz);

    // $stamp = $dateObj->format('U');
    // $zone = $tz->getTransitions($stamp, $stamp);
    // if(!$zone[0]['isdst']) $dateObj->modify('+1 hour');

    // return $dateObj->format($format); // --> this will return gmt date

    return get_date_from_gmt( $dateObj->format('Y-m-d H:i:s'), $format );


    // $dateObj = new DateTime($date, new DateTimeZone('America/Los_Angeles'));
    // // echo "The time in Los Angeles is " . $dateObj->format('Y-m-d H:i:s') . "<br />";
    // $dateObj->setTimezone(new DateTimeZone('Europe/London'));
    // // echo "The time in London is " . $dateObj->format('Y-m-d H:i:s') . "<br />";

    // return $dateObj->format('Y-m-d H:i:s');



    // $tz = new DateTimeZone('America/Los_Angeles');  
    // $dateObj = new DateTime($date);
    // $dateObj->setTimezone($tz);
    // $stamp = $dateObj->format('U');
    // $zone = $tz->getTransitions($stamp, $stamp);
    // if(!$zone[0]['isdst']) $dateObj->modify('+1 hour');
    // return $dateObj->format('Y-m-d H:i:s');
}

// convert Unix epoch timestamp to UTC (Stripe time to UTC)  --> Note this return local time not UTC
function easybook_add_ons_charge_date($timestamp ='', $format = 'Y-m-d H:i:s'){
    $dateObj = new DateTime();
    $dateObj->setTimestamp($timestamp);
    
    return $dateObj->format($format);
}
// convert PDT (Paypal time to UTC)
function easybook_addons_booking_date($date = 'now', $format = 'Ymd'){
    $dateObj = new DateTime($date);
    return $dateObj->format($format);
}
function easybook_addons_booking_nights($checkin = 'now', $checkout = 'now'){
    if($checkout == '') $checkout = $checkin;
    $datetime_checkin = new DateTime($checkin);
    $datetime_checkout = new DateTime($checkout);
    if($datetime_checkin && $datetime_checkout){
        // $interval = $datetime_checkin->diff($datetime_checkout);
        return (int)$datetime_checkin->diff($datetime_checkout)->format('%a');
    }
    return 0;

    // $date1 = new DateTime("2010-07-06");
    // $date2 = new DateTime("2010-07-09");

    // // this calculates the diff between two dates, which is the number of nights
    // $numberOfNights= $date2->diff($date1)->format("%a"); 
}
function easybook_addons_booking_date_modify($date = 'now', $modify = 0, $format = 'Ymd'){
    $dateObj = new DateTime($date);
    if($dateObj){
        $dateObj->modify($modify .' days');
        return $dateObj->format($format);
    }
    return false; 
}
function easybook_addons_date_format($date ='', $time = false){
    if($date == 'NEVER') return $date;
    $dateObj = new DateTime($date);

    $format = get_option('date_format');
    if($time) $format .= ' '.get_option( 'time_format' );
    
    return $dateObj->format($format);
}

function easybook_add_ons_cal_next_date($date = '', $period = 'day', $interval = 0, $format = 'Y-m-d H:i:s'){
    $dateObj = new DateTime($date);

    if($interval){
        switch ($period) {
            case 'day':
                easybook_add_ons_add_days($dateObj, $interval);
                break;
            case 'week':
                easybook_add_ons_add_weeks($dateObj, $interval);
                break;
            case 'month':
                easybook_add_ons_add_months($dateObj, $interval);
                break;
            case 'year':
                easybook_add_ons_add_years($dateObj, $interval);
                break;
            
        }
    }

    return $dateObj->format($format);
}

function easybook_addons_compare_dates($date_one = '', $date_two = '', $compare = '<'){
    $date_one = new DateTime($date_one);
    $date_two = new DateTime($date_two);

    switch ($compare) {
        case '<=':
            return $date_one <= $date_two;
            break;
        case '=':
            return $date_one == $date_two;
            break;
        case '>=':
            return $date_one >= $date_two;
            break;
        case '<':
            return $date_one < $date_two;
            break;
        case '>':
            return $date_one > $date_two;
            break;
        default:
            return $date_one < $date_two;
            break;
    }
}
// for changing data base on plan period
function easybook_add_ons_add_months($date,$months = 0){
     
    $init=clone $date;
    $modifier=$months.' months';
    $back_modifier =-$months.' months';
    
    $date->modify($modifier);
    $back_to_init= clone $date;
    $back_to_init->modify($back_modifier);
    
    while($init->format('m')!=$back_to_init->format('m')){
    $date->modify('-1 day')    ;
    $back_to_init= clone $date;
    $back_to_init->modify($back_modifier);    
    }
    
    /*
    if($months<0&&$date->format('m')>$init->format('m'))
    while($date->format('m')-12-$init->format('m')!=$months%12)
    $date->modify('-1 day');
    else
    if($months>0&&$date->format('m')<$init->format('m'))
    while($date->format('m')+12-$init->format('m')!=$months%12)
    $date->modify('-1 day');
    else
    while($date->format('m')-$init->format('m')!=$months%12)
    $date->modify('-1 day');
    */
    
}
 
function easybook_add_ons_add_years($date,$years = 0){
    
    $init=clone $date;
    $modifier=$years.' years';
    $date->modify($modifier);
    
    while($date->format('m')!=$init->format('m'))
    $date->modify('-1 day');
    
    
} 
function easybook_add_ons_add_weeks($date, $weeks = 0){
    // $init=clone $date;
    $modifier=$weeks.' weeks';
    $date->modify($modifier);
}
function easybook_add_ons_add_days($date, $days = 0){
    // $init=clone $date;
    $modifier= $days.' days';
    $date->modify($modifier);
}
// end changing date function

function easybook_add_ons_get_plan_period_text($interval = 1, $period = 'month'){
    $period_texts = array(
        'hour'          => esc_html__( 'hour', 'easybook-add-ons' ),
        'day'           => esc_html__( 'day', 'easybook-add-ons' ),
        'week'          => esc_html__( 'week', 'easybook-add-ons' ),
        'month'         => esc_html__( 'month', 'easybook-add-ons' ),
        'year'          => esc_html__( 'year', 'easybook-add-ons' ),
    );
    if($interval){
        $formatted_period = $period_texts[$period];
        if($interval > 1) $formatted_period = sprintf( _nx( '%2$s', '%1$d %2$ss', $interval, 'period text', 'easybook-add-ons' ), number_format_i18n( $interval ), $period_texts[$period] );
        return sprintf(__( '<span class="period-per">Per</span> %s', 'easybook-add-ons' ), $formatted_period);
    }

    return __( '', 'easybook-add-ons' );

    // $formatted_period = _n( $period_texts[$period], '%s '.$period_texts[$period], $interval, 'easybook-add-ons' );


    
}

function easybook_add_ons_get_plan_trial_text($interval = 1, $period = 'month'){
    $period_texts = array(
        'hour'          => esc_html__( 'hour', 'easybook-add-ons' ),
        'day'           => esc_html__( 'day', 'easybook-add-ons' ),
        'week'          => esc_html__( 'week', 'easybook-add-ons' ),
        'month'         => esc_html__( 'month', 'easybook-add-ons' ),
        'year'          => esc_html__( 'year', 'easybook-add-ons' ),
    );
    if($interval){
        $formatted_period = $period_texts[$period];
        if($interval > 1) $formatted_period = sprintf(__( '%d %ss', 'easybook-add-ons' ), $interval, $period_texts[$period] );
        return sprintf(__( '<span class="trial-per">for</span> %s', 'easybook-add-ons' ), $formatted_period);
    }

    return __( '', 'easybook-add-ons' );
}


