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

class Esb_Class_Ajax_Handler{

    public static function init(){   
        $ajax_actions = array(
            'checkout_form',
            'fetch_weather',
            'easybook_mailchimp',
            'easybook_get_tweets',
            'easybook_single_room', 
            'easybook_addons_chat_lauthor_message',
            'easybook_addons_submit_booking_listing',  
            // 'easybook_addons_booking_listing'
        );
        foreach ($ajax_actions as $action) {
            $funname = str_replace('easybook_addons_', '', $action); 
            $funname = str_replace('easybook_', '', $funname);
            add_action('wp_ajax_nopriv_'.$action, array( __CLASS__, $funname )); 
            add_action('wp_ajax_'.$action, array( __CLASS__, $funname ));
        }
        $logged_in_ajax_actions = array(
            'withdrawals_get',
            'withdrawals_save',
            'withdrawals_cancel',
            'earnings_get',
            'adcampaigns_get',
            'adcampaigns_submit',
            'invoice_get',

        );
        foreach ($logged_in_ajax_actions as $logged_in_ajax_actions) {
            add_action('wp_ajax_'.$logged_in_ajax_actions, array( __CLASS__, $logged_in_ajax_actions ));
        }

        $not_logged_in_ajax_actions = array(
            'easybook-login',
            'easybook-register',
            'easybook-forgetpsw',
        );
        foreach ($not_logged_in_ajax_actions as $action) {
            $funname = str_replace('easybook_addons_', '', $action);
            $funname = str_replace('easybook-', '', $funname);
            add_action('wp_ajax_nopriv_'.$action, array( __CLASS__, $funname .'_callback' ));
        }
    }
    public static function checkout_form(){ 

        $json = array(
            'success' => false,
            'data' => array(
                // 'POST'=>$_POST,

                // 'price_total' => ESB_ADO()->cart->get_total(),
                // 'cart_details' => ESB_ADO()->cart->get_cart_details()
                // get cart data ok
            ),

            

        );
        self::verify_nonce('esb-checkout-security');
        // wp_send_json( $json );

        $cart_details = ESB_ADO()->cart->get_cart_details();
        $insert_posts = array();
        if(is_array($cart_details) && !empty($cart_details)){
            // update user billing
            (new Esb_Class_Checkout())->update_user_billing();
            foreach ($cart_details as $c_key => $c_data) {
                $c_data['payment-method'] = !empty($_POST['payment-method']) ? $_POST['payment-method'] : 'free';
                if(isset($c_data['cart_item_type']) && $c_data['cart_item_type'] == 'plan'){
                    // $c_data['payment-method'] = (isset($_POST['payment-method']) && $_POST['payment-method']) ? $_POST['payment-method'] : 'free';
                    $insert_id = self::insert_membership_post($c_data);
                    if($insert_id) $insert_posts[] = $insert_id;
                }elseif(isset($c_data['cart_item_type']) && $c_data['cart_item_type'] == 'ad'){
                    $insert_posts[] = $c_data['product_id'];
                }else{
                    $quantity = '';
                    $cart_coupon = ESB_ADO()->cart->get_coupon_code();
                    $insert_id = self::insert_booking_post($c_data,$quantity, $cart_coupon);
                    $json['insert_id'] = $insert_id;
                    if($insert_id) $insert_posts[] = $insert_id;
                }
            }

        }
        // 
        if(!empty($insert_posts)){
            
            $price_total = ESB_ADO()->cart->get_total();
            // get first inserted posts item
            $inserted_post_first = reset($insert_posts);
            $inserted_post_first_pt = get_post_type($inserted_post_first);
            $item_number = 999;
            if($inserted_post_first_pt == 'lbooking'){
                $item_number = get_post_meta( $inserted_post_first, ESB_META_PREFIX.'listing_id', true );
                do_action('easybook_addons_insert_booking_after',$inserted_post_first);
            }elseif($inserted_post_first_pt == 'lorder'){
                $item_number = get_post_meta( $inserted_post_first, ESB_META_PREFIX.'plan_id', true );
            }elseif($inserted_post_first_pt == 'cthads'){
                $item_number = get_post_meta( $inserted_post_first, ESB_META_PREFIX.'plan_id', true );
                update_post_meta( $inserted_post_first, ESB_META_PREFIX.'price_total', $price_total );
                
            }
            $inserted_posts_text = implode("-", $insert_posts);
            // need to check if allow checkout as guest
            // $current_user = wp_get_current_user();

            $payment_method = (isset($_POST['payment-method']) && $_POST['payment-method']) ? $_POST['payment-method'] : 'free';
            // where payment method
            if( (float)$price_total > 0 ){
                $process_results = array(
                    'success'   => false,
                    'url'       => ''
                );
                $stripeEmail = (isset($_POST['stripeEmail']) && $_POST['stripeEmail'] !='' ) ? $_POST['stripeEmail'] : '';
                $data_checkout = array(
                    'inserted_post_first'       => $inserted_post_first,
                    'stripeEmail'               => $stripeEmail,
                    'inserted_posts_text'       => $inserted_posts_text,
                );
                $esb_payments = ESB_ADO()->payment_methods;
                if(isset($esb_payments[$payment_method])) $process_results = $esb_payments[$payment_method]->process_payment_checkout($data_checkout);
                
            }
            // end payment methods
            if ( $payment_method == 'free' || $payment_method == 'banktransfer' || $payment_method ==  'submitform' || $payment_method ==  'cod' ) {
                $process_results = array(
                    'success'   => true,
                    'url'       => '',// get_permalink(easybook_addons_get_option('checkout_success')),
                );
            }

            $json['success'] = $process_results['success'];
                

            ESB_ADO()->cart->empty_cart();

            if(!isset($process_results['url']) || $process_results['url'] == ''){
                if(easybook_addons_get_option('checkout_success_redirect') == 'yes' && $_POST['payment-method'] != 'payfast')
                    $json['url'] = get_permalink(easybook_addons_get_option('checkout_success'));
                else
                    $json['result'] = apply_filters( 'the_content', get_post_field('post_content', easybook_addons_get_option('checkout_success')) ); //get_the_content( easybook_addons_get_option('checkout_success') );
            }else{
                $json['url'] = $process_results['url'];
            }
        }
        $json['insert_posts'] = $insert_posts;
        // var_dump($_POST);
        // die;
        wp_send_json( $json );
    }

    public static function verify_nonce($action_name = ''){
        if (!isset($_REQUEST['_wpnonce']) || $action_name == '' || ! wp_verify_nonce( $_REQUEST['_wpnonce'], $action_name ) ){
            wp_send_json( array(
                'success'   => false,
                'error'     => esc_html__( 'Security checked!, Cheatn huh?', 'easybook-add-ons' )
            ) );
        }

    }
    public static function insert_membership_post($cart_data = array()){
        if(!is_user_logged_in()) return false;
        $current_user = wp_get_current_user();
        $plan_id = $cart_data['product_id'];
        // add new order to back-end
        $order_datas = array();
        $order_datas['post_title'] = sprintf(__( '%1$s subscription from %2$s', 'easybook-add-ons' ), get_the_title( $plan_id ), $current_user->display_name);
        $order_datas['post_content'] = '';
        //$order_datas['post_author'] = '0';// default 0 for no author assigned
        $order_datas['post_status'] = 'publish';
        $order_datas['post_type'] = 'lorder';

        do_action( 'easybook_addons_insert_order_before', $order_datas );

        $lorder_id = wp_insert_post($order_datas ,true );

        if (!is_wp_error($lorder_id)) {

            easybook_addons_add_user_notification($current_user->ID, array(
                'type' => 'new_order',
                'entity_id'     => $lorder_id
            ));

            // increase plan pm_count - payment count
            $plan_pm_count = get_post_meta( $plan_id , ESB_META_PREFIX.'pm_count', true );
            $plan_pm_count += 1;
            update_post_meta( $plan_id , ESB_META_PREFIX.'pm_count', $plan_pm_count );
            $order_metas = array(
                'plan_id'                       => $plan_id, // plan id
                'subtotal'                        => $cart_data['subtotal'],
                'subtotal_vat'                        => $cart_data['subtotal_vat'],
                'amount'                        => $cart_data['price_total'],
                'quantity'                      => $cart_data['quantity'],
                'currency_code'                 => 'USD',
                'custom'                        => $lorder_id .'|'. $current_user->ID .'|'. $current_user->user_email .'|renew_no',
                'user_id'                       => $current_user->ID,
                'email'                         => $current_user->user_email,
                'first_name'                    => $current_user->user_firstname,
                'last_name'                     => $current_user->user_lastname,
                'display_name'                  => $current_user->display_name,
                'author_fee'                    => get_post_meta( $plan_id, ESB_META_PREFIX.'author_fee', true ),



                'payment_method'                => $cart_data['payment-method'], // banktransfer - paypal - stripe


                'is_recurring'             => $cart_data['is_recurring'], // is recurring plan



                'is_per_listing_sub'            => 'no', // is per listing subscription

                'end_date'                      => easybook_add_ons_cal_next_date('', 'day', easybook_addons_get_option('listing_expire_days') ),

                'yearly_price'                  => $cart_data['yearly_price'],
            );
            $order_metas['interval'] = $cart_data['interval'];
            $order_metas['period'] = $cart_data['period'];


            $order_metas['status'] = 'pending'; // pending - completed - failed - refunded
            $order_metas['payment_count'] = '0';

            $order_metas['notes'] = '';
            if(isset($_POST['notes'])) $order_metas['notes'] = $_POST['notes'];

            if(!empty($cart_data['trial_interval']) && !empty($cart_data['trial_period'])){
                $order_metas['trial_interval'] = $cart_data['trial_interval'];
                $order_metas['trial_period'] = $cart_data['trial_period'];
                // update trialling
                // $order_metas['status'] = 'trialing'; // pending - completed - failed - refunded
            }
            foreach ($order_metas as $key => $value) {
                update_post_meta( $lorder_id, ESB_META_PREFIX.$key,  $value  );
            }
            do_action( 'easybook_addons_insert_order_after', $lorder_id, $plan_id );
            
            return $lorder_id;
        }
        return false;
    }
    public static function insert_booking_post($cart_data = array(),$quantity = '',$coupon_code = ''){
        $listing_id = $cart_data['listing_id'];
        if(is_numeric($listing_id) && (int)$listing_id > 0){
            $booking_title = __( '%1$s booking by %2$s', 'easybook-add-ons' ); 
            $booking_datas = array();
            $booking_metas_loggedin = array();
            $current_user = wp_get_current_user();
            if( $current_user->exists() ){
                $lb_name = $current_user->display_name;
                $lb_email = get_user_meta( $current_user->ID, ESB_META_PREFIX.'email', true);
                $lb_phone = get_user_meta( $current_user->ID, ESB_META_PREFIX.'phone', true);
            }
            // override user details by booking details
            if( isset($_POST['first_name']) && isset($_POST['last_name']) ){
                $lb_name = trim($_POST['first_name'] . ' '. $_POST['last_name']);
            }elseif( isset($_POST['billing_first_name']) && isset($_POST['billing_last_name']) ){
                $lb_name = trim($_POST['billing_first_name'] . ' '. $_POST['billing_last_name']);
            }

            if( !empty($_POST['user_email']) ){
                $lb_email = $_POST['user_email'];
            }elseif( !empty($_POST['billing_email']) ){
                $lb_email = $_POST['billing_email'];
            }

            if( !empty($_POST['phone']) ){
                $lb_phone = $_POST['phone'];
            }elseif( !empty($_POST['billing_phone']) ){
                $lb_phone = $_POST['billing_phone'];
            }

            if( empty($lb_email) && $current_user->exists() ) $lb_email = $current_user->user_email;

            $booking_datas['post_title'] = sprintf( $booking_title, get_the_title( $listing_id ), $lb_name );

            $booking_datas['post_content'] = '';
            //$booking_datas['post_author'] = '0';// default 0 for no author assigned
            $booking_datas['post_status'] = 'publish';
            $booking_datas['post_type'] = 'lbooking';

            do_action( 'easybook_addons_insert_booking_before', $booking_datas );

            $booking_id = wp_insert_post($booking_datas ,true );

            if (!is_wp_error($booking_id)) {
                $listing_author_id = get_post_field( 'post_author', $listing_id );
                easybook_addons_add_user_notification($listing_author_id, array(
                    'type' => 'new_booking',
                    'entity_id'     => $listing_id,
                    'actor_id'      => $current_user->ID
                ));

                // insert cth_booking post 
                $cth_booking_datas = array(
                    'booking_id'                => $booking_id,
                    'listing_id'                => $listing_id,
                    'guest_id'                  => $current_user->ID,
                    'status'                    => 0,
                );
                if(isset($cart_data['checkin'])) $cth_booking_datas['date_from'] = easybook_addons_booking_date($cart_data['checkin']);
                if(isset($cart_data['checkout'])) $cth_booking_datas['date_to'] = easybook_addons_booking_date($cart_data['checkout']);

                if(isset($cart_data['rooms']) && !empty($cart_data['rooms'])){
                    foreach ((array)$cart_data['rooms'] as $cart_room) {
                        if(isset($cart_room['ID']) && isset($cart_room['quantity']) && (int)$cart_room['quantity'] > 0){
                            $cth_booking_datas['room_id'] = $cart_room['ID'];
                            $cth_booking_datas['quantity'] = (int)$cart_room['quantity'];
                            self::insert_cth_booking($cth_booking_datas);
                        }
                        
                    }
                }

                $meta_fields = array(
                    'rooms'               => 'array',
                    'checkin'              => 'text',
                    'checkout'              => 'text',
                    'nights'              => 'text',
                    'days'              => 'text',
                    'adults'              => 'text',
                    'children'              => 'text',
                    'infants'              => 'text',
                    'subtotal'              => 'text',
                    'subtotal_fee'              => 'text',
                    'subtotal_vat'              => 'text',
                    'price_total'              => 'text',
                    'qty'                   => 'text',
                    'date_event'            => 'text',

                    'booking_type'            => 'text',
                    'price_based'            => 'text',
                    // 'addservices'            => 'array',
                    'adult_price'            => 'text',
                    'children_price'            => 'text',
                    'infant_price'            => 'text',

                    'day_prices'            => 'array',
                    'adult_prices'            => 'array',
                    'children_prices'            => 'array',
                    'infant_prices'            => 'array',
                );

                $meta_fields = apply_filters( 'esb_booking_meta_fields', $meta_fields );
                $booking_metas = array();
                foreach($meta_fields as $field => $ftype){
                    if(isset($cart_data[$field])) 
                        $booking_metas[$field] = $cart_data[$field] ;
                    else{
                        if($ftype == 'array'){
                            $booking_metas[$field] = array();
                        }else{
                            $booking_metas[$field] = '';
                        }
                    } 
                }
                $booking_metas['listing_id'] = $listing_id;
                $booking_metas['lb_status'] = 'pending'; // pending - completed - failed - refunded - canceled
                // user id for non logged in user, will be override with loggedin info
                $booking_metas['user_id'] = $current_user->ID;
                $booking_metas['lauthor_id'] = $listing_author_id;

                $booking_metas['lb_name'] =  $lb_name;
                $booking_metas['lb_email'] =  $lb_email;
                $booking_metas['lb_phone'] =  $lb_phone;

                $booking_metas['payment_method'] =  $cart_data['payment-method']; // banktransfer - paypal - stripe

                
                // merge with logged in customser data
                $booking_metas = array_merge($booking_metas,$booking_metas_loggedin);

                $booking_metas['notes'] = '';
                if(isset($_POST['notes'])) $booking_metas['notes'] = $_POST['notes'];

                // woo payment
                // $booking_metas['payment_method'] = 'woo'; // banktransfer - paypal - stripe - woo 

                // $cmb_prefix = '_cth_';
                foreach ($booking_metas as $key => $value) {
                    // https://codex.wordpress.org/Function_Reference/update_post_meta
                    // Returns meta_id if the meta doesn't exist, otherwise returns true on success and false on failure. 
                    // NOTE: If the meta_value passed to this function is the same as the value that is already in the database, this function returns false.
                    if ( !update_post_meta( $booking_id, ESB_META_PREFIX.$key,  $value  ) ) {
                        $json['data'][] = sprintf(__('Insert booking %s meta failure or existing meta value','easybook-add-ons'),$key);
                        // wp_send_json($json );
                    }
                }

                // update billing
                self::update_booking_billing($booking_id);

                if (isset($cart_data['addservices']) && is_array($cart_data['addservices']) && !empty($cart_data['addservices']) ){
                     update_post_meta( $booking_id, ESB_META_PREFIX.'addservices', $cart_data['addservices']);     
                }
                // slot booking
                if ( isset($cart_data['slots']) && is_array($cart_data['slots']) && !empty($cart_data['slots']) ){
                    update_post_meta( $booking_id, ESB_META_PREFIX.'slots', $cart_data['slots']);     
                    update_post_meta( $booking_id, ESB_META_PREFIX.'slots_text', implode("|", $cart_data['slots'] ) );     
                }
                // tpicker booking
                if ( isset($cart_data['times']) && is_array($cart_data['times']) && !empty($cart_data['times']) ){
                    update_post_meta( $booking_id, ESB_META_PREFIX.'times', $cart_data['times']);     
                    update_post_meta( $booking_id, ESB_META_PREFIX.'times_text', implode("|", $cart_data['times'] ) );     
                }
                if (!empty($coupon_code) && $coupon_code != '') {
                    update_post_meta( $booking_id, ESB_META_PREFIX.'bkcoupon',  $coupon_code );
                    self::update_quantity_coupon($coupon_code);
                }
                if(!empty($quantity) && $quantity != '' && $quantity > 0){
                    update_post_meta( $booking_id, ESB_META_PREFIX.'quantity',  $quantity );

                    $rid = '';
                    $rprice = '';
                    if(isset($cart_data['rooms']) && !empty($cart_data['rooms'])){
                        foreach ((array)$cart_data['rooms'] as $cart_room) {
                            if(isset($cart_room['ID']) && isset($cart_room['quantity']) && (int)$cart_room['quantity'] > 0){
                                $rid = $cart_room['ID'];
                            }  
                        }
                        $rprice = get_post_meta($rid,ESB_META_PREFIX.'_price',true);
                    }
                    $rooms_price = 0;
                    $rooms_price += $quantity * $rprice;
                    $price_total_room = $rooms_price + $cart_data['subtotal_fee'] + $cart_data['subtotal_vat'];
                    update_post_meta( $booking_id, ESB_META_PREFIX.'price_total_room',  $price_total_room);
                } 

                do_action( 'esb_insert_booking_after', $booking_id , $cart_data);
                return $booking_id;
            }
        }
        return false;
    }

    public static function update_booking_billing( $booking_id = 0 ){
        $billing_fields = array(

            'billing_first_name' => 'text',
            'billing_last_name'  => 'text',
            'billing_company'    => 'text',
            'billing_city'       => 'text',
            'billing_country'    => 'text',
            'billing_address_1'  => 'text',
            'billing_address_2'  => 'text',
            'billing_state'      => 'text',
            'billing_postcode'   => 'text',
            'billing_phone'      => 'text',
            'billing_email'      => 'text',
        );
        $billing_metas = array();
        foreach($billing_fields as $field => $ftype){
            if(isset($_POST[$field])) 
                $billing_metas[$field] = $_POST[$field] ;
            else{
                if($ftype == 'array'){
                    $billing_metas[$field] = array();
                }else{
                    $billing_metas[$field] = '';
                }
            } 
        }
        update_post_meta( $booking_id, ESB_META_PREFIX.'billing_metas', $billing_metas );
        // foreach ($billing_metas as $key => $value) {
        //     update_post_meta( $booking_id, $key,  $value  );
        // }
    }

    private static function insert_cth_booking($data = array()){
        global $wpdb;
        $booking_table = $wpdb->prefix . 'cth_booking';
        if(is_array($data) && !empty($data)){
            $result = $wpdb->insert( 
                $booking_table, 
                $data
            );
            // end inshert chat
            // https://codex.wordpress.org/Class_Reference/wpdb#INSERT_row
            if($result != false) return $wpdb->insert_id;
        }
        return false;   
    }
    protected static function update_quantity_coupon($coupon_code){
        $coupon_post = get_posts(
            array(
                'post_type'         => 'cthcoupons',
                'posts_per_page'    => 1,
                'post_status'       => 'publish',
                'fields'            => 'ids',
                'meta_query'        => array(
                    array(
                        'key'           => ESB_META_PREFIX.'coupon_code',
                        'value'         => $coupon_code,
                    ),
                    // array(
                    //     'key'           => ESB_META_PREFIX.'for_coupon_listing_id',
                    //     'value'         => $listing_id,
                    // )
                )
            )
        );
        if(!empty($coupon_post)){
            $coupon_id = reset($coupon_post);
            $coupon_qty = get_post_meta($coupon_id, ESB_META_PREFIX.'coupon_qty', true);
            if ( is_numeric($coupon_qty) && $coupon_qty > 0) {
                update_post_meta( $coupon_id, ESB_META_PREFIX.'coupon_qty',  $coupon_qty - 1 );
            } 
        }
    }

    public static function withdrawals_get(){
        $json = array(
            'success' => false,
            'data' => array(
                // 'POST'=>$_POST,
            ),
            'earning' => 0,
            // 'posts' => array(),
            // 'pagi' => array(),

        );
        self::verify_nonce('easybook-add-ons');

        $user_id = isset($_POST['user_id'])? $_POST['user_id'] : 0; 
        if( is_numeric($user_id) && $user_id > 0 ){

            $json['earning'] = Esb_Class_Earning::getBalance($user_id);

            $withdrawals = Esb_Class_Withdrawals::getWithdrawalsPosts($user_id);

            $json['posts'] = $withdrawals['posts'];
            $json['pagi']   = $withdrawals['pagi'];

            $json['success'] = true;

            
            // $history_list = get_posts(array(
            //     'post_type'        => 'lwithdrawal', 
            //     'fields'           => 'id',
            //     'posts_per_page'   => -1,
            //     // 'author'           =>  $user_id,
            //     // 'post_status'      => 'publish',
            // ));
            // $json['data']['history'][] = (object) array(
            //     'name'      =>  $history_list->post_name,
            //     'payments'  =>  easybook_addons_get_order_method_text(get_post_meta( $history_list->ID, ESB_META_PREFIX.'payment_method', true )),
            //     'cost'      =>  easybook_addons_get_price_formated( get_post_meta( $history_list->ID, ESB_META_PREFIX.'amount', true ) ),
            //     'date'      =>  $history_list->post_date,
            //     'status'    =>  easybook_addons_get_booking_status_text(get_post_meta( $history_list->ID, ESB_META_PREFIX.'status', true )),
            // );
        }else{
            $json['error'] = __( 'The author id is incorrect.', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }



        wp_send_json( $json );
    }
    public static function withdrawals_save(){
        $json = array(
            'success' => false,
            'data' => array(
                // 'POST'=>$_POST,
            ),

            'earning'   => 0,

        );
        self::verify_nonce('easybook-add-ons');

        $user_id =  get_current_user_id();
        if($user_id == 0 || !isset($_POST['user_id']) || (int)$_POST['user_id'] !== $user_id){
            $json['error'] = __( 'The author id is incorrect.', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }

        // for email address
        if (!isset($_POST['withdrawal_email']) || !filter_var($_POST['withdrawal_email'], FILTER_VALIDATE_EMAIL)) {
            // invalid emailaddress
            $json['error'] = __( 'The email address is invalid.', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }

        // check withdrawal amount
        if(!isset($_POST['amount'])){
            $json['error'] = sprintf(__( 'The minimum withdrawal amount is %s USD', 'easybook-add-ons' ), 50);
            wp_send_json($json );
        }
        $amount = (float) $_POST['amount'];
        $earning = (float) Esb_Class_Earning::getBalance($user_id); 
        

        if($amount > $earning){
            $json['error'] = sprintf(__( 'The maximum withdrawal amount is {amount} USD', 'easybook-add-ons' ), $earning);
            wp_send_json($json );
        }elseif($amount < 50){
            $json['error'] = sprintf(__( 'The minimum withdrawal amount is %s USD', 'easybook-add-ons' ), 50);
            wp_send_json($json );
        }

        $post_datas = array();
        $post_datas['post_status'] = 'publish';
        $post_datas['post_type'] = 'lwithdrawal';
        $post_id = wp_insert_post($post_datas ,true );
        if (!is_wp_error($post_id)) {
            $post_metas = array(
                'payment_method' => $_POST['payment_method'],
                'withdrawal_email'   => $_POST['withdrawal_email'],
                'amount'         => $amount,
                'status'         => 'pending',
                'user_id'         => $user_id,
            );
            
            foreach ($post_metas as $key => $value) {
                update_post_meta( $post_id, ESB_META_PREFIX.$key,  $value  );
            }

            Esb_Class_Earning::insert_withdrawal($post_id);

            $json['earning'] = $earning - $amount ;

            $withdrawals = Esb_Class_Withdrawals::getWithdrawalsPosts($user_id);

            $json['posts'] = $withdrawals['posts'];
            $json['pagi']   = $withdrawals['pagi'];

            easybook_addons_add_user_notification($user_id, array(
                'type' => 'withdrawal_new',
                'entity_id'     => $post_id
            ));

            $json['message'] = __( 'Your withdrawal request has been received. We will check it soon.', 'easybook-add-ons' ) ;
            $json['success'] = true;
        }else{
            $json['error'] = esc_html__( 'Can not submit withdrawal post', 'easybook-add-ons' ) ;
        }  
        wp_send_json( $json );
    }

    public static function withdrawals_cancel(){
        $json = array(
            'success' => false,
            'data' => array(
                // 'POST'=>$_POST,
            ),

            'earning'   => 0,

        );
        self::verify_nonce('easybook-add-ons');

        $user_id =  get_current_user_id();
        if($user_id == 0 || !isset($_POST['user_id']) || (int)$_POST['user_id'] !== $user_id){
            $json['error'] = __( 'The author id is incorrect.', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }

        if( isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0 ){
            $deleted_post = wp_delete_post( $_POST['id'], true );
            if($deleted_post){
                $json['earning'] = Esb_Class_Earning::getBalance($user_id);

                $withdrawals = Esb_Class_Withdrawals::getWithdrawalsPosts($user_id);

                $json['posts'] = $withdrawals['posts'];
                $json['pagi']   = $withdrawals['pagi'];

                $json['success'] = true;
            }else{
                $json['error'] = __( 'Can not cancel the withdrawal request', 'easybook-add-ons' );
                wp_send_json($json );
            }
        }else{
            $json['error'] = __( 'Invalid withdrawal post id', 'easybook-add-ons' );
            wp_send_json($json );
        } 
        wp_send_json( $json );
    }

    

    public static function earnings_get(){
        $json = array(
            'success' => false,
            'data' => array(
                // 'POST'=>$_POST,
            ),
            // 'posts' => array(),
            // 'pagi' => array(),

        );

        // wp_send_json( $json );
        
        self::verify_nonce('easybook-add-ons');

        $user_id = isset($_POST['user_id'])? $_POST['user_id'] : 0; 
        if( is_numeric($user_id) && $user_id > 0 ){
            $earnings = Esb_Class_Earning::getEarningsPosts($user_id);
            // $json['earnings'] = $earnings;
            $json['posts'] = $earnings['posts'];
            $json['pagi']   = $earnings['pagi'];
            $json['success'] = true;
        }else{
            $json['error'] = __( 'The author id is incorrect.', 'easybook-add-ons' ) ;
            
        }
        wp_send_json( $json );
    }

    public static function adcampaigns_get(){
        $json = array(
            'success' => false,
            'data' => array(
                'POST'=>$_POST,
            ),
            // 'posts' => array(),
            // 'pagi' => array(),

        );

        // wp_send_json( $json );
        
        self::verify_nonce('easybook-add-ons');

        $user_id = isset($_POST['user_id'])? $_POST['user_id'] : 0; 
        if( is_numeric($user_id) && $user_id > 0 ){

            $posts = Esb_Class_ADs::getPosts($user_id);
            // $json['posts'] = $posts;
            $json['posts'] = $posts['posts'];
            $json['pagi']   = $posts['pagi'];
            $json['success'] = true;
        }else{
            $json['error'] = __( 'The author id is incorrect.', 'easybook-add-ons' ) ;
            
        }
        wp_send_json( $json );
    }

    public static function adcampaigns_submit(){
        $json = array(
            'success' => false,
            'data' => array(
                'POST'=>$_POST,
            ),
        );
        self::verify_nonce('easybook-add-ons');

        $user_id =  get_current_user_id();
        if($user_id == 0 || !isset($_POST['user_id']) || (int)$_POST['user_id'] !== $user_id){
            $json['error'] = __( 'The author id is incorrect.', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }

        $ad_type = isset($_POST['ad-type']) && $_POST['ad-type'] != '' ? $_POST['ad-type'] : 'listing';

        if(!isset($_POST['ad-listing'])){
            $json['error'] = __( 'Please select a listing for AD campaign', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }
        $listing_id = $_POST['ad-listing'];


        $listing_post = get_post($listing_id);
        // // display none on incorrect listing or not authorize listing item
        if(null == $listing_post ){
            $json['error'] = __( 'The listing id is incorrect.', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }
        // ad package term
        $ad_package = get_term( $_POST['ad-package'], 'cthads_package' );
        // display none on incorrect plan
        if ( empty( $ad_package ) || is_wp_error( $ad_package ) ){
            $json['error'] = __( 'The ad package is incorrect.', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }

        
        $var_ad_title = $ad_package->name;
        $var_ad_id = $ad_package->term_id;

        $raw_price = get_term_meta( $var_ad_id, ESB_META_PREFIX.'ad_price', true );


        // add new ad to back-end
        $cthads_datas = array();
        $cthads_datas['post_title'] = sprintf(__( '%1$s for %2$s', 'easybook-add-ons' ), $var_ad_title, $listing_post->post_title);
        $cthads_datas['post_content'] = '';
        $cthads_datas['post_author'] = $user_id;
        $cthads_datas['post_status'] = 'publish';
        $cthads_datas['post_type'] = 'cthads';

        $cthads_datas['tax_input']['cthads_package'] = array($var_ad_id);

        do_action( 'easybook_addons_insert_ad_before', $cthads_datas );

        $cthads_id = wp_insert_post($cthads_datas ,true );

        if (!is_wp_error($cthads_id)) {

            $current_user = wp_get_current_user(); 

            // increase ad pacakge pm_count - payment count
            $plan_pm_count = get_term_meta( $var_ad_id , ESB_META_PREFIX.'pm_count', true );
            $plan_pm_count += 1;
            update_term_meta( $var_ad_id , ESB_META_PREFIX.'pm_count', $plan_pm_count );

            $is_recurring_plan = get_term_meta( $var_ad_id , ESB_META_PREFIX.'is_recurring', true );

            // $plan_interval = get_term_meta( $var_ad_id, ESB_META_PREFIX.'ad_interval', true );
            // $plan_period = get_term_meta( $var_ad_id, ESB_META_PREFIX.'ad_period', true );
            // if($plan_interval){
            //     $expire = easybook_add_ons_cal_next_date('', $plan_period, $plan_interval) ;
            // }else{
            //     $expire = easybook_add_ons_cal_next_date('', 'day', easybook_addons_get_option('listing_expire_days') );
            // }

            // $end_date = get_post_meta( $post_ID, ESB_META_PREFIX.'end_date', true );
                    
           
            $cthads_metas = array(
                'listing_id'                    => $listing_id, // listing id
                'plan_id'                       => $var_ad_id, // ad package id
                'amount'                        => $raw_price,
                'quantity'                      => 1,
                'currency_code'                 => easybook_addons_get_option('currency','USD'),
                'custom'                        => $cthads_id .'|'. $listing_id .'|'. $current_user->ID .'|'. $current_user->user_email .'|renew_no|subscription_no|ad_yes',
                'user_id'                       => $current_user->ID,
                'email'                         => $current_user->user_email,
                'first_name'                    => $current_user->user_firstname,
                'last_name'                     => $current_user->user_lastname,
                'display_name'                  => $current_user->display_name,



                'payment_method'                => 'banktransfer', // banktransfer - paypal - stripe


                'is_recurring_plan'             => $is_recurring_plan, // is recurring plan



                'is_per_listing_sub'            => 'yes', // is per listing subscription

                // for ad campaign type
                'order_type'                    => 'listing_ad',

                'ad_type'                       => $ad_type,
            );
            $cthads_metas['status'] = 'pending'; // pending - completed - failed - refunded
            $cthads_metas['payment_count'] = '0';



            // $cmb_prefix = '_cth_';
            foreach ($cthads_metas as $key => $value) {
                update_post_meta( $cthads_id, ESB_META_PREFIX.$key,  $value  );
            }
            update_post_meta( $cthads_id, '_price',  $raw_price  );


            do_action( 'easybook_addons_insert_ad_after', $cthads_id, $listing_id, $var_ad_id );

            easybook_addons_add_user_notification(
                $user_id,
                array(
                    'type'          => 'new_ad',
                    'entity_id'     => $cthads_id
                )
            );

            $cart_item_data = array( 
                'quantity'          => 1,
                'yearly_price'      => (isset($_POST['yearly_price'])) ? $_POST['yearly_price'] : '0',
            );
            $cart_item_data = apply_filters('esb_addons_ad_cart_item_data', $cart_item_data, $cthads_id);
            $was_added = Esb_Class_Form_Handler::add_to_cart_handler_ad( $cthads_id, $cart_item_data );


            $checkout_url = get_permalink( easybook_addons_get_option('checkout_page') );
            if ( $was_added && 'yes' === easybook_addons_get_option( 'checkout_redirect_after_add' )) {
                $json['url'] =  $checkout_url;
                // wp_safe_redirect( get_permalink( easybook_addons_get_option('checkout_page') ) );
                // exit;
            }


            $json['message'] = apply_filters( 
                'esb_listing_ad_added_message', 
                sprintf(__( 'Your listing AD is added. Please follow the link bellow to complete payment<br />%s', 'easybook-add-ons' ), '<a href="'.$checkout_url.'">'.__( 'Pay now', 'easybook-add-ons' ).'</a>' ),
                $cthads_id, $listing_id, $var_ad_id
            );

            $json['success'] = true;

        }else{
            $json['error'] = esc_html__( 'Can not submit listing ad', 'easybook-add-ons' ) ;
        }
        wp_send_json($json );

    }

    public static function invoice_get(){
        $json = array(
            'success' => false, 
            'data' => array(
                'POST'=>$_POST, 
            ),
            'invoice' => array(),
        );
        self::verify_nonce('easybook-add-ons');
        $user_id =  get_current_user_id();
        if($user_id == 0 || !isset($_POST['user_id']) || (int)$_POST['user_id'] !== $user_id){
            $json['error'] = __( 'You are not allowed to view this invoice', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }

        $id = isset($_POST['id'])? $_POST['id'] : 0;  
        if( is_numeric($id) && $id > 0 ){

            if( get_post_meta( $id , ESB_META_PREFIX.'user_id', true ) != $user_id){
                $json['error'] = __( 'You are not allowed to view this invoice', 'easybook-add-ons' ) ;
                wp_send_json($json );
            }

            $user_obj = get_userdata($user_id);

            $json['invoice'] = (object) array(
                'ID'            => $id,
                'title'         => get_the_title($id),
                'payment'       => easybook_addons_get_order_method_text(get_post_meta( $id, ESB_META_PREFIX.'payment', true )),
                'plan_title'    => get_post_meta( $id, ESB_META_PREFIX.'plan_title', true ),
                'from_date'     => get_post_meta( $id, ESB_META_PREFIX.'from_date', true),
                'end_date'      => get_post_meta( $id, ESB_META_PREFIX.'end_date', true),
                'amount'        => easybook_addons_get_price_formated( get_post_meta( $id, ESB_META_PREFIX.'amount', true ) ),
                'user_name'     => $user_obj->display_name,
                'user_email'    => $user_obj->user_email,
                'phone'         => get_user_meta($user_id,ESB_META_PREFIX.'phone',true),
                'creat'         => get_the_date('', $id),
            );

            $json['success'] = true;
        }else{
            $json['error'] = __( 'The invoice id is incorrect.', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }
        
        wp_send_json($json );
    }

    

    

    public static function file_get_contents_stream($fn, $content_type = '') { 
        $opts = array( 
            'http' => array( 
                'method'=>"GET", 
                'header'=>"Content-Type: text/html;" 
            ) 
        ); 
        if($content_type != '') $opts['http']['header'] = "Content-Type: {$content_type};";

        $context = stream_context_create($opts); 
        $result = @file_get_contents($fn, false, $context); 
        return $result; 
    } 

    private static function generate_nonce() {
        $mt = microtime();
        $rand = mt_rand();

        return md5($mt . $rand); // md5s look nicer than numbers
    }
    private static function generate_timestamp() {
        return time();
    }
    private static function urlencode_rfc3986($input) {
        if (is_array($input)) {
            return array_map(array(__CLASS__, 'urlencode_rfc3986'), $input);
        } else if (is_scalar($input)) {
            return str_replace(
                '+',
                ' ',
                str_replace('%7E', '~', rawurlencode($input))
            );
        } else {
            return '';
        }
    }
    public static function featch_yahoo_weather(){
        $key = 'dj0yJmk9OGx5RUZ4RFFxTWJNJnM9Y29uc3VtZXJzZWNyZXQmc3Y9MCZ4PTAw';
        $sigmeth = 'HMAC-SHA1';


        $key_parts = array(
            $key
        );

        $key_parts = self::urlencode_rfc3986($key_parts);
        $signature = implode('&', $key_parts);


        $params = [
            // "realm"                  => $realm, /* optional */
            "oauth_consumer_key"     => $key,
            // "oauth_token"            => $token,
            "oauth_signature_method" => $sigmeth,
            "oauth_timestamp"        => self::generate_timestamp(),
            "oauth_nonce"            => self::generate_nonce(),
            "oauth_signature"        => base64_encode( hash_hmac('sha1', 'yahoo_wather', $signature, true) ),
            "oauth_version"         => '1.0',
        ];

        $params = http_build_query($params, null, ',', PHP_QUERY_RFC3986);

        $opts = ["https" => ["header" => "Authorization: OAuth " . $params]];

        $context = stream_context_create($opts);

        $url = "https://weather-ydn-yql.media.yahoo.com/forecastrss?w=2442047&u=c";
        

        $context = stream_context_create($opts); 
        $result = @file_get_contents($url, false, $context); 
        if($result == false) return $params;
        return $result; 
    }

    public static function fetch_weather(){

        $json = array(
            'success' => false,
            'data' => array(
                // 'POST'=>$_POST,
            ),
        );
        
        self::verify_nonce('easybook-add-ons');

        $locale = get_locale();
        if($locale == '') $locale = 'en_US';
        $locale = strtolower($locale);
        if($locale != 'zh_cn' || $locale != 'zh_tw') $locale = preg_replace('/_.+$/m', '', trim($locale));
        
        $params = array(
            'appid'             => easybook_addons_get_option('weather_api'),
            // 'q'              => isset($_POST['location']) ? $_POST['location'] : '',
            // 'lat'               => '35',
            // 'lon'               => '139',
            'units'             => 'metric',
            'lang'              => $locale,
        );

        if(isset($_POST['lat']) && isset($_POST['lon'])){
            $params['lat'] = $_POST['lat'];
            $params['lon'] = $_POST['lon'];
        }else{
            $params['q'] = isset($_POST['location']) ? trim($_POST['location'], " ,") : '';
        }

        $params = http_build_query($params, null, '&', PHP_QUERY_RFC3986);

        // $weather_api = easybook_addons_get_option('weather_api');

        // $api_url = "https://api.openweathermap.org/data/2.5/weather?lat=35&lon=139&appid={$weather_api}"; // -> https://prntscr.com/m3z1hb

        $api_url = "https://api.openweathermap.org/data/2.5/forecast?{$params}"; // -> http://prntscr.com/m3z59g

        if(isset($_POST['view']) && $_POST['view'] == 'simple') $api_url = "https://api.openweathermap.org/data/2.5/weather?{$params}"; // -> https://prntscr.com/m3z1hb

        // $json['url'] = $api_url;

        $result = self::file_get_contents_stream($api_url, 'application/json'); // JSON - Content-Type: application/json | JSONP = Content-Type: application/javascript
        
        // if( ESB_DEBUG ) error_log(date('[Y-m-d H:i e] - '). "openweathermap - current: " . $result . PHP_EOL, 3, './openweathermap-current.log');
        // if( ESB_DEBUG ) error_log(date('[Y-m-d H:i e] - '). "openweathermap - forecast: " . $result . PHP_EOL, 3, './openweathermap-forecast.log');

        if($result === false){
            $json['error'] = __( 'Weather request error. Please make sure that your api is entered.', 'easybook-add-ons' );
        }
        else{
            $json['success'] = true;
            $json['result'] = json_decode($result);
        }

        // $json['yahoo'] = self::featch_yahoo_weather(); // current return false
        // 'success' => false,
        wp_send_json( $json );


    }

    public static function forgetpsw_callback() {
        $json = array(
            'success' => false,
            'data' => array(
                // 'POST'=>$_POST,
            )
        );

        if(easybook_addons_get_option('log_reg_dis_nonce') != 'yes' ) self::verify_nonce('easybook-forgetpsw');

        
        // if(easybook_addons_get_option('log_reg_dis_nonce') != 'yes' ){
        //     $nonce = $_POST['_nonce'];
            
        //     if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        //         $json['error'] = esc_html__( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ;
        //         wp_send_json($json );
        //     }
        // }

            

        if ( empty( $_POST['user_login'] ) || ! is_string( $_POST['user_login'] ) ) {
            $json['error'] = esc_html__( 'Enter a username or email address.', 'easybook-add-ons' ) ;
            wp_send_json($json );
        } elseif ( strpos( $_POST['user_login'], '@' ) ) {
            $user_data = get_user_by( 'email', trim( wp_unslash( $_POST['user_login'] ) ) );
            if ( empty( $user_data ) ){
                $json['error'] = esc_html__( 'There is no user registered with that email address.', 'easybook-add-ons' ) ;
                wp_send_json($json );
            }
        } else {
            $login = trim($_POST['user_login']);
            $user_data = get_user_by('login', $login);
        }

        if ( !$user_data ) {
            $json['error'] = esc_html__( 'Invalid username or email.', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }

        // Redefining user_login ensures we return the right case in the email.
        $user_login = $user_data->user_login;
        $user_email = $user_data->user_email;
        $key = get_password_reset_key( $user_data );

        if ( is_wp_error( $key ) ) {
            $json['error'] = esc_html__( 'There is something wrong. Please try again.', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }

        if ( is_multisite() ) {
            $site_name = get_network()->site_name;
        } else {
            /*
             * The blogname option is escaped with esc_html on the way into the database
             * in sanitize_option we want to reverse this for the plain text arena of emails.
             */
            $site_name = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
        }

        $message = __( 'Someone has requested a password reset for the following account:','easybook-add-ons' ) . "\r\n\r\n";
        /* translators: %s: site name */
        $message .= sprintf( __( 'Site Name: %s','easybook-add-ons'), $site_name ) . "\r\n\r\n";
        /* translators: %s: user login */
        $message .= sprintf( __( 'Username: %s','easybook-add-ons'), $user_login ) . "\r\n\r\n";
        $message .= __( 'If this was a mistake, just ignore this email and nothing will happen.' ,'easybook-add-ons') . "\r\n\r\n";
        $message .= __( 'To reset your password, visit the following address:' ,'easybook-add-ons') . "\r\n\r\n";
        $message .= '<' . network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' ) . ">\r\n";

        /* translators: Password reset email subject. %s: Site name */
        $title = sprintf( __( '[%s] Password Reset' ,'easybook-add-ons'), $site_name );

        
        if ( $message && !wp_mail( $user_email, wp_specialchars_decode( $title ), $message ) ){
            $json['error'] = esc_html__( 'The email could not be sent.', 'easybook-add-ons' ) ;
            wp_send_json($json );

        }

        $json['success'] = true;
        $json['message'] = apply_filters( 'easybook_addons_reset_password_message', __( 'Your Password is reset. Check your email to complete the action.', 'easybook-add-ons' ) );


        wp_send_json($json );

    }

    public static function register_callback() {
        $json = array(
            'success' => false,
            'data' => array(
                '_POST'=>$_POST
            )
        );
        // var_dump($_POST);
        // wp_send_json($json );
        if( get_option( 'users_can_register' ) != 1){
            $json['error'] = esc_html__( 'User registration feature is disabled.', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }

        //wp_send_json($json );

        // verify google reCAPTCHA
        if( easybook_addons_verify_recaptcha() === false ){
            $json['error'] = esc_html__( 'reCAPTCHA failed, please try again.', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }

        if(easybook_addons_get_option('log_reg_dis_nonce') != 'yes' ) self::verify_nonce('easybook-register');

        // check for corrent email
        if ( !is_email( $_POST['email'] ) ) {
            $json['error'] = esc_html__( 'Invalid email address.', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }

        $new_user_data = array(
            'user_login' => $_POST['username'],
            'first_name' => $_POST['username'],
            'user_pass'  => wp_generate_password( 12, false ), // $_POST['password'], // // When creating an user, `user_pass` is expected.
            'user_email' => $_POST['email'],
            // 'role'       => 'l_customer' //'subscriber'
        );
        if(easybook_addons_get_option('register_role') == 'yes' && isset($_POST['reg_lauthor']) && $_POST['reg_lauthor'] != 0) {
            $new_user_data['role'] = 'listing_author'; 
        }
        if(isset($_POST['password'])){
            $new_user_data['user_pass'] = $_POST['password'];
        }

        $user_id = wp_insert_user( $new_user_data );

        //On success
        if ( ! is_wp_error( $user_id ) ) {
            $json['success'] = true;
            // echo "User created : ". $user_id;
            // send login
            if(easybook_addons_get_option('new_user_email') != 'none') wp_new_user_notification( $user_id, null, easybook_addons_get_option('new_user_email') );

            $json['user_id'] = $user_id;

            if(easybook_addons_get_option('register_auto_login') == 'yes') easybook_addons_auto_login_new_user( $user_id );
            
            do_action( 'easybook_addons_register_user', $user_id, false );

            // // Set the global user object
            // $current_user = get_user_by( 'id', $user_id );

            // // set the WP login cookie
            // $secure_cookie = is_ssl() ? true : false;

            // wp_set_auth_cookie( $user_id, true, $secure_cookie ); // This function does not return a value.

            if( easybook_addons_get_option('register_no_redirect') != 'yes' && isset($_POST['redirection']) ) $json['redirection'] =  esc_url($_POST['redirection']); 

            
            $json['message'] = __( 'Successfully registered. Check your email address for the password.', 'easybook-add-ons' );

        }else{
            $json['error'] = $user_id->get_error_message() ;
            $json['new_user_data'] = $new_user_data ;

        }

        wp_send_json( $json );

    }

    public static function login_callback() {

        $json = array(
            'success' => false,
            'data' => array(
                '_POST'=>$_POST
            )
        );

        // wp_send_json($json );

        // verify google reCAPTCHA
        if( easybook_addons_verify_recaptcha() === false ){
            $json['error'] = esc_html__( 'reCAPTCHA failed, please try again.', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }

        if(easybook_addons_get_option('log_reg_dis_nonce') != 'yes' )  self::verify_nonce('easybook-login');

        
        // https://codex.wordpress.org/Function_Reference/wp_signon
        // NOTE: If you don't provide $credentials, wp_signon uses the $_POST variable (the keys being "log", "pwd" and "rememberme").
        
        // set the WP login cookie
        $secure_cookie = is_ssl() ? true : false;
        $user = wp_signon( NULL, $secure_cookie );

        if ( is_wp_error($user) ) {
            $json['error'] = $user->get_error_message();
        } else {
            $json['success'] = true;
            do_action( 'easybook_addons_user_login' );
            // easybook_addons_auto_login_new_user( $user->ID );

            $json['userID'] = $user->ID;
            if( isset($_POST['redirection']) ) $json['redirection'] =  esc_url($_POST['redirection']); 

            $json['message'] = __( 'Login success! The page will be reload.', 'easybook-add-ons' );
        }

        wp_send_json($json );
    }

    public static function mailchimp() {
        require_once ESB_ABSPATH .'inc/classes/Drewm/CTHMailChimp.php';

        $output = array(
            'success'   => false
        );
        self::verify_nonce('easybook_mailchimp');

        if(isset($_POST['_list_id'])&& $_POST['_list_id']){
            $list_id = $_POST['_list_id'];
        }else{
            $list_id = easybook_addons_get_option('mailchimp_list_id'); 
        }

        /*
         * ------------------------------------
         * Mailchimp Email Configuration
         * ------------------------------------
         */
        $MailChimp = new CTH_MailChimp( easybook_addons_get_option('mailchimp_api') );

        $result = $MailChimp->post("lists/$list_id/members", array(
            'email_address' => $_POST['email'],
            'status'        => 'subscribed'
        ) );

        if ($MailChimp->success()) {
            $output['success'] = true;
            $output['message'] = esc_html__('Almost finished. Please check your email and verify.','easybook-add-ons' );
            $output['last_response'] = $MailChimp->getLastResponse();
        } else {
            $output['message'] = esc_html__('Oops. Something went wrong!','easybook-add-ons' );
            $output['last_response'] = $MailChimp->getLastResponse();
        }

        wp_send_json( $output );
    }

    public static function get_tweets(){
        require_once ESB_ABSPATH . "inc/twitter-api/twitteroauth/twitteroauth.php";

        self::verify_nonce('easybook-add-ons');
            
        // Cache Settings
        // define('CACHE_ENABLED', false);
        // define('CACHE_LIFETIME', 3600); // in seconds
        // define('HASH_SALT', md5(ESB_ABSPATH."inc/twitter-api/"));

        $consumer_key = easybook_addons_get_option('consumer_key');
        $consumer_secret = easybook_addons_get_option('consumer_secret');
        $access_token = easybook_addons_get_option('access_token');
        $access_token_secret = easybook_addons_get_option('access_token_secret');

        // wp_send_json( array(
        //     'consumer_key'   => $consumer_key,
        //     'consumer_secret'   => $consumer_secret,
        //     'access_token'   => $access_token,
        //     'access_token_secret'   => $access_token_secret,
        // ) );

        // Check if keys are in place
        if ($consumer_key == '' || $consumer_secret == '' || $access_token == '' || $access_token_secret == '') {
            wp_send_json( esc_html__( 'You need a consumer key and secret keys. Get one from','easybook-add-ons' ).'<a href="'.esc_url('https://apps.twitter.com/' ).'" target="_blank">apps.twitter.com</a>' ) ;
        }

        // If count of tweets is not fall back to default setting
        $username = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $number = filter_input(INPUT_GET, 'count', FILTER_SANITIZE_NUMBER_INT);
        $exclude_replies = filter_input(INPUT_GET, 'exclude_replies', FILTER_SANITIZE_SPECIAL_CHARS);
        $list_slug = filter_input(INPUT_GET, 'list', FILTER_SANITIZE_SPECIAL_CHARS);
        $hashtag = filter_input(INPUT_GET, 'hashtag', FILTER_SANITIZE_SPECIAL_CHARS);
        
        
        // Connect
        $connection = new CTH_TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
        //easybook_add_ons_getConnectionWithToken($consumer_key, $consumer_secret, $access_token, $access_token_secret);
        
        // Get Tweets
        if (!empty($list_slug)) {
          $params = array(
              'owner_screen_name' => $username,
              'slug' => $list_slug,
              'per_page' => $number
          );

          $url = '/lists/statuses';
        } else if($hashtag) {
          $params = array(
              'count' => $number,
              'q' => '#'.$hashtag
          );

          $url = '/search/tweets';
        } else {
          $params = array(
              'count' => $number,
              'exclude_replies' => $exclude_replies,
              'screen_name' => $username
          );

          $url = '/statuses/user_timeline';
        }

        $tweets = $connection->get($url, $params);

        wp_send_json($tweets);

    }

    public static function single_room() {
        self::verify_nonce('easybook-add-ons');
        ob_start();
        ?>
        <!--ajax-modal-wrap -->
        <div class="ajax-modal-wrap fl-wrap">
            <div class="ajax-modal-close"><i class="fal fa-times"></i></div>
            <!--ajax-modal-item-->
            <div class="ajax-modal-item fl-wrap">
                <div class="ajax-modal-item-inner">
                    <?php 
                    $room_id = ( isset( $_POST['rid'] ) && is_numeric( $_POST['rid'] ) ) ? (int)$_POST['rid'] : 0;
                    if(!$room_id){
                        _e( '<p class="sroom-error">Invalid room id</p>', 'easybook-add-ons' );
                    }else{
                        $listing_id = get_post_meta( $room_id, ESB_META_PREFIX.'for_listing_id', true );
                        if($listing_id == ''){
                            _e( '<p class="sroom-error">Invalid listing id for room</p>', 'easybook-add-ons' );
                        }else{
                            global $post;
                            $post = get_post($room_id);
                            if(!$post){
                                _e( '<p class="sroom-error">Invalid room post</p>', 'easybook-add-ons' );
                            }else{
                                setup_postdata( $post );
                                echo easybook_addons_azp_parser_listing( get_post_meta( $listing_id, ESB_META_PREFIX.'listing_type_id', true ) , 'single_room', get_the_ID() );
                            }
                            wp_reset_postdata();                        }
                    }
                    ?>
                </div>
                <!--ajax-modal-item-inner-->
            </div>
            <!--ajax-modal-item-->
        </div>
        <!--ajax-modal-wrap end -->
        <?php
        // $result = ob_get_clean(); 

        echo ob_get_clean();

        wp_die(); // this is required to terminate immediately and return a proper response

    }

    //Chat single listing message***************************************
    public static function chat_lauthor_message() {
        global $wpdb;
        $json = array(
            'success' => false,
            'data' => array(
                'POST'=>$_POST,
            )
        );
        // self::verify_nonce('easybook-add-ons');
        // var_dump($_POST);
        // wp_send_json($json );
        $nonce = $_POST['_nonce'];
        if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
            $json['data']['error'] = __( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }

        $authid = isset($_POST['authid'])? $_POST['authid'] : 0;
        if( is_numeric($authid) && $authid > 0 ){
            $from_user_id = 0;
            if( isset($_POST['lmsg_name']) && isset($_POST['lmsg_email']) ){
                // register new user
                // check for corrent email
                if ( !is_email( $_POST['lmsg_email'] ) ) {
                    $json['data']['error'] = __( 'Invalid email address.', 'easybook-add-ons' ) ;
                    wp_send_json($json );
                }
                $new_user_data = array(
                    'user_login' => $_POST['lmsg_name'],
                    'user_pass'  => wp_generate_password( 12, false ),
                    'user_email' => $_POST['lmsg_email'],
                    // 'role'       => 'l_customer' //'subscriber'
                );

                $from_user_id = wp_insert_user( $new_user_data );

                if ( ! is_wp_error( $from_user_id ) ) {
                    // send login
                    if(easybook_addons_get_option('new_user_email') != 'none') wp_new_user_notification( $from_user_id, null, easybook_addons_get_option('new_user_email') );
                }else{
                    $json['data']['error'] = $from_user_id->get_error_message() ;
                    wp_send_json($json );
                }
            }else{
                if(!is_user_logged_in()){ // no logged in user and invalid form
                    $json['data']['error'] = __( 'Invalid message form without name and email.', 'easybook-add-ons' );
                    wp_send_json($json );
                }
                $from_user_id = get_current_user_id();
            }

            // check for sending user
            if(is_numeric($from_user_id) && $from_user_id ){
                $chat_table = $wpdb->prefix . 'cth_chat';
                $chat_reply_table = $wpdb->prefix . 'cth_chat_reply';

                $chat_id_checked = 0;
                $time = time();
                $ip = $_SERVER['REMOTE_ADDR'];

                $chatids = $wpdb->get_col( "SELECT c_id FROM $chat_table WHERE ((user_one ='$from_user_id' AND user_two ='$authid') OR (user_one ='$authid' AND user_two ='$from_user_id')) ");

                if(!$chatids){
                    // create new chat row

                    $result = $wpdb->insert( 
                        $chat_table, 
                        array( 
                            
                            'user_one'  => $from_user_id, 
                            'user_two'  => $authid, 
                            'ip'        => $ip, 
                            'time'      => $time, 
                        ) 
                    );
                    // end inshert chat
                    // https://codex.wordpress.org/Class_Reference/wpdb#INSERT_row
                    if($result != false){
                        $chat_id_checked = $wpdb->insert_id;
                    }
                }else {
                    $chat_id_checked =  reset($chatids);
                }

                if($chat_id_checked){
                    $result = $wpdb->insert( 
                        $chat_reply_table, 
                        array( 
                            
                            'user_id_fk'    => $from_user_id, 
                            'reply'         => $_POST['lmsg_message'], 
                            'ip'            => $ip, 
                            'time'          => $time, 
                            'c_id_fk'       => $chat_id_checked
                        ) 
                    );
                    if($result != false){
                        $json['data']['message'] = apply_filters( 'easybook_addons_insert_message_message', __( 'Your message is received. The listing author will contact with you soon.<br />You can also login with your email to manage messages.<br />Thank you.', 'easybook-add-ons' ) );
                        do_action( 'cth_chat_lauthor_message' );
                    }else{
                        $json['data']['error'] = __( 'Can not create chat message.', 'easybook-add-ons' );
                        wp_send_json($json );
                    }
                }else{
                    $json['data']['error'] = __( 'Can not create chat contact.', 'easybook-add-ons' );
                    wp_send_json($json );
                }

            }else{
                $json['data']['error'] = __( 'Invalide user.', 'easybook-add-ons' );
                wp_send_json($json );
            }

        }else{
            $json['data']['error'] = __( 'The author id is incorrect.', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }
        $json['success'] = true;
        wp_send_json($json );

    }
    public function submit_booking_listing(){
        $json = array(
            'success' => false,
            'data' => array(
                // 'POST'=>$_POST,
            )
        );
        $nonce = $_POST['_nonce'];
        if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
            $json['data']['error'] = __( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }

        // $lid = isset($_POST['lid'])? $_POST['lid'] : 0;
        // if( is_numeric($lid) && $lid > 0 ){
           

        // }else{
        //     $json['data']['error'] = __( 'The listing id is incorrect.', 'easybook-add-ons' ) ;
        //     wp_send_json($json );
        // }
        $json['success'] = true;
        wp_send_json( $json );

    }
    public function booking_listing() {
        $json = array(
            'success' => true,
            'data' => array(
                'POST'=>$_POST,
            )
        );
        // wp_send_json($json );
        $nonce = $_POST['_nonce'];
        
        if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
            $json['success'] = false;
            $json['data']['error'] = esc_html__( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }


        $listing_id = $_POST['slid'];
        $rid = $_POST['rid'];
        if(is_numeric($listing_id) && (int)$listing_id > 0){
            $rooms_price = 0;
            $cart_item_data = array();
            $current_user   = wp_get_current_user();
            $room_post      = get_post($rid);
            $rooms = array();
            $room       = array(
                'ID' =>  $room_post->ID,
                'title'         => get_the_title( $rid ),
                'price'         => get_post_meta( $rid, '_price', true ),
                'quantity'      => (int)$_POST['quantity'],
            );
            $rooms[] = $room;
            $rooms_price += $room['quantity'] * $room['price'];
            $default_vat = easybook_addons_get_option('vat_tax', 10);
            $subtotal_fee = $rooms_price *  ((float)$default_vat / 100);
            if(easybook_addons_get_option('booking_vat_include_fee') == 'yes'){
                $subtotal_vat = ($rooms_price + $subtotal_fee)* (float)(5 / 100);
            }
            else{
                $subtotal_vat = $rooms_price * (float)($default_vat / 100  );
            }
            
            $price_total = $rooms_price + $subtotal_fee + $subtotal_vat;
            // var_dump( $data['price_total']);
            $checkin     = ($_POST['checkin'] != '') ? $_POST['checkin'] : '';
            $checkout    = ($_POST['checkout'] != '') ? $_POST['checkout'] : '';
            $nights      = easybook_addons_booking_nights($checkin, $checkout);
            $adults      = ($_POST['adults'] != '') ? $_POST['adults'] : '';
            $children    = ($_POST['children'] != '') ? $_POST['children'] : '';

            $cart_item_data = array(
                'rooms'              => $rooms,
                'checkin'           => $checkin ,
                'checkout'          => $checkout,
                'nights'            => $nights,
                'adults'            => $adults,
                'children'          => $children,
                'price_total'       => $price_total,
                'subtotal_fee'      => $subtotal_fee,
                'subtotal_vat'      => $subtotal_vat,
                'user_id'           => $current_user->ID,
                'listing_id'        => $listing_id,
            );

            // add_filter('woocommerce_add_cart_item',$cart_item_data);


            if(session_id() == '')
                session_start(); 
            $_SESSION['esb_user_custom_data'] = $cart_item_data;


            if(isset($_POST['checkin']) && $_POST['checkin'] != '' && isset($_POST['checkout']) && $_POST['checkout'] != ''){
                $available = easybook_addons_get_available_listings(
                    array(
                        'checkin'   => $_POST['checkin'],
                        'checkout'   => $_POST['checkout'],
                        'listing_id'   => $listing_id,
                    )
                );

            }
            //Add product to WooCommerce cart.
            if (!empty( $available) && is_array( $available)) {
                $quantity = (isset($_POST['quantity']) && is_numeric($_POST['quantity']) && $_POST['quantity'] )? $_POST['quantity'] : 1;
                $json['data']['url'] = easybook_addons_get_add_to_cart_url( $rid, $quantity );
            }else{
                $json['data']['message'] = apply_filters( 'easybook_addons_insert_booking_message', __( 'The room is empty.<br>Thank you.', 'easybook-add-ons' ) );
            }
        
            $json['success'] = true;

        }else{
            $json['success'] = false;
            $json['data']['error'] = esc_html__( 'The listing id is incorrect.', 'easybook-add-ons' ) ;
        }

        wp_send_json($json );

    }
  
}   
    

Esb_Class_Ajax_Handler::init();