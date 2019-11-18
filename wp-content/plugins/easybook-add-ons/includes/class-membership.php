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

class Esb_Class_Membership{

    public static function init(){
        add_action( 'easybook_addons_lorder_change_status_to_completed', array( __CLASS__, 'status_to_completed' ), 10, 1 );
    }

    public static function status_to_completed($order_id = 0){
        if(is_numeric($order_id)&&(int)$order_id > 0){
            $order_post = get_post($order_id);
            if (null != $order_post){
                $plan_id = get_post_meta( $order_id, ESB_META_PREFIX.'plan_id', true );
                $plan_period = get_post_meta( $plan_id, ESB_META_PREFIX.'period', true );
                $plan_interval = get_post_meta( $plan_id, ESB_META_PREFIX.'interval', true );
                if($plan_interval){
                    $expire = easybook_add_ons_cal_next_date('', $plan_period, $plan_interval);
                }else{
                    $expire = easybook_add_ons_cal_next_date('', 'day', easybook_addons_get_option('listing_expire_days') );
                }

                $data = array(
                    'pm_status'                 => 'completed',
                    'user_id'                   => get_post_meta( $order_id, ESB_META_PREFIX.'user_id', true ),
                    'item_number'               => $plan_id, // this is listing plan id
                    'pm_date'                   => current_time('mysql'), // Time at which the object was created. Measured in seconds since the Unix epoch.
                    'order_id'                  => $order_id,
                    'recurring_subscription'    => false, // not used

                    'txn_id'                    => uniqid('manual_sub'), // invoice id

                    // for stripe period
                    'payment_method'            => __( 'Manual Subscription', 'easybook-add-ons' ),
                    'period_start'              => current_time('mysql'),
                    'period_end'                => $expire,

                );
                self::active_membership($data, false);

            }
        }

    }

    public static function active_membership($pm_datas = array(), $stripe_date = false){

        $plan_post = get_post( $pm_datas['item_number'] );
        $order_id = $pm_datas['order_id'];
        // check if the plan is deleted
        if(null == $plan_post || 'trash' == $plan_post->post_status ){
            return;
            // if(get_post_meta( $order_id, ESB_META_PREFIX.'plan_period', true ) == '') return;  // also need check for plan datas attached to order in case of deleted plan post
        }
        $plan_id = $plan_post->ID;
        $from_date = current_time( 'mysql' ); //$stripe_date === 'utc' ? $pm_datas['pm_date'] : ( $stripe_date ? easybook_add_ons_charge_date( $pm_datas['pm_date'] ) : easybook_add_ons_payment_date( $pm_datas['pm_date'] ) );

        $plan_period = get_post_meta( $plan_id, ESB_META_PREFIX.'period', true );
        $plan_interval = get_post_meta( $plan_id, ESB_META_PREFIX.'interval', true );

        if(get_post_meta( $order_id, ESB_META_PREFIX.'yearly_price', true ) === '1'){
            $plan_period = 'year';
            $plan_interval = 1;
        }

        $end_date = easybook_add_ons_cal_next_date($from_date, $plan_period, $plan_interval);
        // need to update user to listing author membership
        // with $pm_datas['item_number'] -> plan_id
        // with $pm_datas['listing_id'] -> listing_id
        $user_id = $pm_datas['user_id'];

        $author_fee = get_post_meta( $plan_id, ESB_META_PREFIX.'author_fee', true );



        // update role for subscriber and listing customer only 
        $current_role = easybook_addons_get_user_role($user_id);
        // only update role if lower role
        if(in_array($current_role, array( 'author', 'contributor', 'subscriber', 'l_customer' ))){
            $user_id_new = wp_update_user( array( 'ID' => $user_id, 'role' => 'listing_author' ) );
            if ( is_wp_error( $user_id_new ) ) {
                if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Can not update user role to listing_author" . PHP_EOL, 3, ESB_LOG_FILE);
            }else{
                easybook_addons_add_user_notification($user_id, array(
                    'type' => 'role_change',
                ));
            }

                

        }

        if ( !update_user_meta( $user_id, ESB_META_PREFIX.'member_plan',  $plan_id ) ) {
            if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Update user membership plan id failure or same existing value" . PHP_EOL, 3, ESB_LOG_FILE);
        }
        // payment date $pm_datas['pm_date']
        
        if ( !update_user_meta( $user_id, ESB_META_PREFIX.'payment_date',  $from_date ) ) {
            if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Can not update payment_date user data" . PHP_EOL, 3, ESB_LOG_FILE);
        }

        update_user_meta( $user_id, ESB_META_PREFIX.'end_date',  $end_date );

        // update author free
        if ( !update_user_meta( $user_id, ESB_META_PREFIX.'author_fee',  $author_fee ) ) {
            if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Can not update author_fee user data" . PHP_EOL, 3, ESB_LOG_FILE);
        }

        if ( !update_user_meta( $user_id, ESB_META_PREFIX.'order_id',  $order_id ) ) {
            if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Update user membership order id failure or same existing value" . PHP_EOL, 3, ESB_LOG_FILE);
        }

        // update user order/subscription ids array
        // $user_orders = get_user_meta($user_id,  ESB_META_PREFIX.'subscriptions', true );
        // if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "User orders before" . json_encode($user_orders). PHP_EOL, 3, ESB_LOG_FILE);
        // if( is_array($user_orders) ){
        //     if( !in_array($order_id, $user_orders) ) $user_orders[] = $order_id;
        // }else{
        //     $user_orders = array($order_id);
        // }
        // if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "User orders after" . json_encode($user_orders). PHP_EOL, 3, ESB_LOG_FILE);
        // if ( !update_user_meta( $user_id, ESB_META_PREFIX.'subscriptions',  $user_orders ) ) {
        //     if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Can not update subscriptions user data" . PHP_EOL, 3, ESB_LOG_FILE);
        // }



        
        // update listing status to publish if enabled
        // if(easybook_addons_get_option('auto_publish_paid_listings','no') == 'yes'){
            
        //     $listing_post = array(
        //         'ID'            => $pm_datas['listing_id'],
        //         'post_status'       => 'publish',
        //     );
        //     $listing_id = wp_update_post( $listing_post, true );                          
        //     if (ESB_DEBUG && is_wp_error($listing_id)) {
        //         if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Update listing post error: " . $listing_id->get_error_message() . PHP_EOL, 3, ESB_LOG_FILE);
        //     }
        // }
        // update order status
        if ( !update_post_meta( $order_id, ESB_META_PREFIX.'status',  $pm_datas['pm_status'] ) ) {
            if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Change order status to {$pm_datas['pm_status']} failure" . PHP_EOL, 3, ESB_LOG_FILE);
        }
        // update author fee
        update_post_meta( $order_id, ESB_META_PREFIX.'author_fee',  $author_fee );
        // update payment count - useful for check recurring payment
        $payment_count = get_post_meta( $order_id, ESB_META_PREFIX.'payment_count', true );
        if(!$payment_count) $payment_count = 1;
        else $payment_count += 1;
        if ( !update_post_meta( $order_id, ESB_META_PREFIX.'payment_count',  $payment_count ) ) {
            if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Change order payment_count to $payment_count failure" . PHP_EOL, 3, ESB_LOG_FILE);
        }

        /// ALSO USE ORDER AS AUTHOR SUBSCRIPTION RECORD
        if ( !update_post_meta( $order_id, ESB_META_PREFIX.'plan_id',  $pm_datas['item_number'] ) ) {
            if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Update order/subscription plan id failure or same existing value" . PHP_EOL, 3, ESB_LOG_FILE);
        }
        // valid date from - only add active date for newly created order - not for next payment
        if(get_post_meta( $order_id, ESB_META_PREFIX.'from_date', true ) == ''){
            if ( !update_post_meta( $order_id, ESB_META_PREFIX.'from_date',  $from_date ) ) {
                if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Can not update from_date order/subscription data" . PHP_EOL, 3, ESB_LOG_FILE);
            }
        }
        // add plan datas to order/subscription
        
        if($plan_period){
            if ( !update_post_meta( $order_id, ESB_META_PREFIX.'plan_period',  $plan_period ) ) {
                if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Update order/subscription plan period failure or same existing value" . PHP_EOL, 3, ESB_LOG_FILE);
            }
            if ( !update_post_meta( $order_id, ESB_META_PREFIX.'plan_interval',  $plan_interval ) ) {
                if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Update order/subscription plan interval failure or same existing value" . PHP_EOL, 3, ESB_LOG_FILE);
            }
            
            // calculate expired date
            
            if ( !update_post_meta( $order_id, ESB_META_PREFIX.'end_date',  $end_date ) ) {
                if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Can not update end_date order/subscription data" . PHP_EOL, 3, ESB_LOG_FILE);
            }

            // listing submission limit
            $limit = get_post_meta( $plan_id , ESB_META_PREFIX.'lunlimited', true )? 'unlimited' : get_post_meta( $plan_id , ESB_META_PREFIX.'llimit', true );
            if ( !update_post_meta( $order_id, ESB_META_PREFIX.'plan_llimit',  $limit ) ) {
                if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Can not update plan_llimit order/subscription data" . PHP_EOL, 3, ESB_LOG_FILE);
            }
            
        }
        if( get_post_meta( $plan_id, ESB_META_PREFIX.'lnever_expire', true ) ){
            update_post_meta( $order_id, ESB_META_PREFIX.'end_date',  'NEVER' );

            update_user_meta( $user_id, ESB_META_PREFIX.'end_date',  'NEVER' );

        }
        // update trial end date 
        if($pm_datas['pm_status'] == 'trialing'){
            $trial_interval = get_post_meta( $plan_id , ESB_META_PREFIX.'trial_interval', true );
            $trial_period = get_post_meta( $plan_id , ESB_META_PREFIX.'trial_period', true );

            if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Order trial_interval: $trial_interval" . PHP_EOL, 3, ESB_LOG_FILE);
            if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Order trial_period: $trial_period" . PHP_EOL, 3, ESB_LOG_FILE);


            if ( !update_post_meta( $order_id, ESB_META_PREFIX.'end_date',  easybook_add_ons_cal_next_date($from_date, $trial_period, $trial_interval) ) ) {
                if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Can not update end_date order/subscription data" . PHP_EOL, 3, ESB_LOG_FILE);
            }
        }
        // check for existing purchase code
        if(get_post_meta( $order_id, ESB_META_PREFIX.'purchase_code', true ) == ''){
            if ( !update_post_meta( $order_id, ESB_META_PREFIX.'purchase_code',  easybook_addons_create_purchase_code() ) ) {
                if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Can not update purchase_code order/subscription data" . PHP_EOL, 3, ESB_LOG_FILE);
            }
        }

        // update order/subscription transaction ids array - paypal: txn_id
        if(isset($pm_datas['txn_id']) && $pm_datas['txn_id'] != ''){
            // create new invoice post
            
            $required_data = array(
                'order_id'  => $order_id,
                'user_id'  => $user_id,
                'user_name'  => __( 'No user', 'easybook-add-ons' ),
                'user_email'  => __( 'No user email', 'easybook-add-ons' ),
                'from_date'  => get_post_meta( $order_id, ESB_META_PREFIX.'from_date', true ),
                'end_date'  => get_post_meta( $order_id, ESB_META_PREFIX.'end_date', true ),
                'payment'  => get_post_meta( $order_id, ESB_META_PREFIX.'payment_method', true ),
                'txn_id'  => $pm_datas['txn_id'],

                'plan_title'  => get_the_title( $plan_id ),
                'quantity'  => get_post_meta( $order_id, ESB_META_PREFIX.'quantity', true ),
                'amount'  => get_post_meta( $order_id, ESB_META_PREFIX.'amount', true ),
                'tax'  => 0, // maybe change in the future
                'charged_to'  => '', // maybe change in the future
            );
            $user_datas = get_user_by( 'ID', $user_id );
            if( $user_datas ){
                $required_data['user_name'] = $user_datas->display_name;
                $required_data['user_email'] = $user_datas->user_email;
                $required_data['charged_to'] = $user_datas->user_email;
            }

            $new_invoice = easybook_addons_create_invoice($required_data);
            if($new_invoice != false){
                $order_transactions = get_post_meta($order_id,  ESB_META_PREFIX.'transactions', true );
                if( is_array($order_transactions) ){

                    if(!array_search($new_invoice, $order_transactions)){
                        $order_transactions[] = $new_invoice;
                    }

                    // if (!array_key_exists($pm_datas['txn_id'],$order_transactions)){
                    //     $order_transactions[$pm_datas['txn_id']] = array(
                    //         'txn_id' => $pm_datas['txn_id'],
                    //         'quantity' => get_post_meta( $order_id, ESB_META_PREFIX.'quantity', true ),
                    //         'amount' => get_post_meta( $order_id, ESB_META_PREFIX.'amount', true ),
                    //         'plan_id' => get_post_meta( $order_id, ESB_META_PREFIX.'plan_id', true ),
                    //     );
                    // }
                }else{
                    $order_transactions = array($new_invoice);
                    // $order_transactions = array();
                    // $order_transactions[$pm_datas['txn_id']] = array(
                    //     'txn_id' => $pm_datas['txn_id'],
                    //     'quantity' => get_post_meta( $order_id, ESB_META_PREFIX.'quantity', true ),
                    //     'amount' => get_post_meta( $order_id, ESB_META_PREFIX.'amount', true ),
                    //     'plan_id' => get_post_meta( $order_id, ESB_META_PREFIX.'plan_id', true ),
                        
                    // );
                }
                if ( !update_post_meta( $order_id, ESB_META_PREFIX.'transactions',  $order_transactions ) ) {
                    if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Can not update transactions order/subscription data" . PHP_EOL, 3, ESB_LOG_FILE);
                }
            }

                
        }

        // will create new linvoice post type to store user invoices
        if(get_post_meta( $order_id, ESB_META_PREFIX.'is_recurring', true ) == 'on' && isset($pm_datas['subscription_id'])){

            if( !update_post_meta( $order_id, ESB_META_PREFIX.'subscription_id',  $pm_datas['subscription_id'] ) ){
                if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Can not update order subscription_id data" . PHP_EOL, 3, ESB_LOG_FILE);
            }
        }

        // for recurring subscription
        if( isset($pm_datas['recurring_subscription']) && $pm_datas['recurring_subscription']){ // for stripe
            // to do tasks
        }

        do_action( 'easybook_addons_order_completed', $order_id );

    }

    public static function deactive_membership($order_id = 0){
        $order_post = get_post( $order_id );
        // check if the subscription post is deleted
        if(null == $order_post || 'trash' == $order_post->post_status ){
            return;
        }
        // update subscribe post
        update_post_meta( $order_id, ESB_META_PREFIX.'status', 'expired' );

        // author id
        $user_id = get_post_meta( $order_id, ESB_META_PREFIX.'user_id', true );
        // update author subscribe datas
        update_user_meta( $user_id, ESB_META_PREFIX.'member_plan', '' );
        update_user_meta( $user_id, ESB_META_PREFIX.'end_date', '' );

        // update author listings status
        $expired_listings = get_posts( 
            array(
                'post_type'         => 'listing',
                'posts_per_page'    => -1,
                'post_status'       => 'publish',
                'post_author'       => $user_id,
                'fields'            => 'ids'
            ) 
        );
        if(!empty($expired_listings)){
            foreach ($expired_listings as $exlist) {
                if ( wp_update_post( array('ID' => $exlist, 'post_status' => 'pending') ) == 0 ) {
                    
                }else{
                    update_post_meta( $exlist, ESB_META_PREFIX.'expired', '1' );
                }

                do_action( 'esb_addons_listing_expired', $exlist );
                // $expired_authors[] = get_post_meta( $exsub->ID, ESB_META_PREFIX.'user_id', true ); // $exsub->post_author;
                // $expired_posts[] = $exsub->ID;
            }
            // $expired_authors = array_unique($expired_authors);
        }

    }

    public static function get_listing_type_data($posts = array()){
        $listing_types = array();
        if(!empty($posts)){
            foreach ((array)$posts as $ltid) {
                $listing_types[] = array(
                    'ID'            => $ltid,
                    'title'         => get_the_title( $ltid ),
                    'icon'          => '',
                    'description'   => '',
                );
            }
        }
        return $listing_types;
    }

    public static function admin_listing_types(){
        $posts = get_posts( array(
            'fields'            => 'ids',
            'post_type'         => 'listing_type',
            'posts_per_page'    => -1,
            'post_status'       => 'publish',
        ) );
        return self::get_listing_type_data($posts);
    }

    public static function author_listing_types(){
        $listing_types = array();
        if(is_user_logged_in()){
            // admin is allow adding all types
            if(easybook_addons_get_user_role() == 'administrator')
            {
                return self::admin_listing_types();
            }
            $member_plan = get_user_meta( get_current_user_id(), ESB_META_PREFIX.'member_plan', true );
            if($member_plan != ''){
                $plan_ltypes = (array)get_post_meta( $member_plan, ESB_META_PREFIX.'listing_types', true  );
                return self::get_listing_type_data($plan_ltypes);
            }
        }
        return $listing_types;
    }

    public static function author_listing_types_ids(){
        $allow_types = self::author_listing_types();
        $allow_types = array_map(function($type){
            return $type['ID'];
        }, $allow_types);

        return $allow_types;
    }

    public static function can_add($user_id = 0){
        if(is_user_logged_in()) $user_id = get_current_user_id();

        if( !$user_id ) return false;

        // admin is allow adding all types
        if(easybook_addons_get_user_role($user_id) == 'administrator'){
            return true;
        }
        $member_plan = get_user_meta( $user_id, ESB_META_PREFIX.'member_plan', true );
        if($member_plan != ''){
            $end_date = get_user_meta( $user_id, ESB_META_PREFIX .'end_date', true );
            if($end_date == 'NEVER' || ($end_date != '' && easybook_addons_compare_dates('now', $end_date, '<=') )){
                if(get_post_meta( $member_plan, ESB_META_PREFIX .'lunlimited', true ) === 'on') 
                    return true;
                
                $limit = get_post_meta( $member_plan, ESB_META_PREFIX .'llimit', true );
                $limit = $limit ? $limit : 1;
                if(count_user_posts($user_id, 'listing') < (int)$limit) 
                    return true;

                // $posts = get_posts(array(
                //     'fields'                => 'ids',
                //     'post_type'             => 'listing',
                //     'author'                => $user_id,
                //     'posts_per_page'        => -1,
                //     'post_status'           => array('publish', 'pending'),
                // ));

                // if()
            }
        }

        return false;
    }

    public static function expire_date($user_id = 0){
        if(is_user_logged_in()) $user_id = get_current_user_id();
        // admin is allow adding all types
        if(easybook_addons_get_user_role($user_id) == 'administrator'){
            return 'NEVER';
        }
        $member_plan = get_user_meta( $user_id, ESB_META_PREFIX.'member_plan', true );
        if($member_plan != ''){
            $end_date = get_user_meta( $user_id, ESB_META_PREFIX .'end_date', true );
                return $end_date;
        }
        return easybook_add_ons_cal_next_date('', 'day', easybook_addons_get_option('listing_expire_days') );
    }

    public static function is_author($user_id = 0){
        if(is_user_logged_in()) $user_id = get_current_user_id();

        if( !$user_id ) return false;

        $author_roles = apply_filters( 'esb_author_roles', array('administrator','listing_author') );

        if( in_array(easybook_addons_get_user_role($user_id), $author_roles) ) return true;

        return false;
    }

}
Esb_Class_Membership::init();

/*

add_filter( 'post_password_required', function($required, $post){
    // check if is your specific page id
    if($post->ID == 100){ // change 100 with your page id
        if(is_user_logged_in() == false){
            // hide page for not logged in users
            return true; // 
        }else{
            $user_plan = get_user_meta( get_current_user_id(), ESB_META_PREFIX.'member_plan', true );
            if($user_plan == 1000){ // change 1000 with plan id allowed for the page id
                return false;
            }

        }
        return true;
    }

    return $required;

}, 10, 2 );

*/



