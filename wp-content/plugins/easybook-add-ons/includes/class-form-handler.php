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

class Esb_Class_Form_Handler{

    public static function init(){

        add_action( 'wp_loaded', array( __CLASS__, 'add_to_cart_action' ), 20 ); 
        add_action( 'wp_loaded', array( __CLASS__, 'add_to_cart_link_action' ), 20 ); 
        add_action( 'wp_loaded', array( __CLASS__, 'add_to_cart_event_action' ), 20 ); 
        add_action( 'wp_loaded', array( __CLASS__, 'add_free_mem' ), 20 );
        add_action( 'wp_loaded', array( __CLASS__, 'add_to_coupon_action' ), 20 ); 
        // for ipn
        add_action( 'wp_loaded', array( __CLASS__, 'check_webhooks' ) );  

        // add to cart get
        add_action( 'wp_loaded', array( __CLASS__, 'add_to_cart_get' ), 20 ); 

    }

    public static function verify_nonce($action_name = ''){
        if (!isset($_REQUEST['_wpnonce']) || $action_name == '' || ! wp_verify_nonce( $_REQUEST['_wpnonce'], $action_name ) ){
            return ;
        }

    }

    // for user add their custom link to add plan to card
    // https://support.cththemes.com/?topic=refer-to-listing-checkout/
    // domain.com/?action=esb_to_cart_get&product_id=123
    public static function add_to_cart_get(){
        if ( !isset( $_GET['action'] ) || $_GET['action'] != 'esb_to_cart_get') {
            return;
        }
        if ( !isset( $_GET['product_id'] ) || $_GET['product_id'] == '') {
            return;
        }

        $product = $_GET['product_id'];
        $adding_post      = get_post( $product );

        if ( ! $adding_post ) {
            return;
        }

        $was_added = false;

        if($adding_post->post_type == 'lplan'){
                
            if((float)get_post_meta( $product, '_price', true ) <= 0) 
                self::insert_free_subscription($product);
            else{
                $cart_item_data = array( 
                    'quantity'          => 1,
                    'yearly_price'      =>  '0',
                );
                $cart_item_data = apply_filters('esb_addons_plan_cart_item_data', $cart_item_data, $product);
                $was_added = self::add_to_cart_handler_plan( $product, $cart_item_data );
            }
        }


        // If we added the listing to the cart we can now optionally do a redirect.
        if ( $was_added && 'yes' === easybook_addons_get_option( 'checkout_redirect_after_add' )) {
            wp_safe_redirect( get_permalink( easybook_addons_get_option('checkout_page') ) );
            exit;
        }
    }

    public static function add_free_mem(){

        if ( !isset( $_POST['action'] ) || $_POST['action'] != 'esb_add_free_mem') {
            return;
        }

        self::verify_nonce('easybook-add-to-cart');

        self::insert_free_subscription( $_POST['product_id'] );

        do_action( 'cth_free_membership_added', $_POST['product_id'] );

        // redirect after add free package
        wp_safe_redirect( get_permalink( easybook_addons_get_option('checkout_success_page') ) );
        exit;
    }

    private static function insert_free_subscription($plan_id = 0){
        $cart_data = array(
            'product_id'                => $plan_id,
            'subtotal'                  => 0,
            'subtotal_vat'              => 0,
            'price_total'                    => 0,
            'quantity'                  => 1,
            'is_recurring'              => 0,
            'yearly_price'              => 0,
            'interval'                  => get_post_meta( $plan_id, ESB_META_PREFIX.'interval', true ),
            'period'                    => get_post_meta( $plan_id, ESB_META_PREFIX.'period', true ),
            'trial_interval'            => 0,
            'trial_period'              => 'day',

            'payment-method'            => 'free',
        );
        $order_id = Esb_Class_Ajax_Handler::insert_membership_post($cart_data);

        if($order_id){
            if(easybook_addons_get_option('auto_active_free_sub') == 'yes'){
                Esb_Class_Membership::status_to_completed($order_id);
            }
        }
    }

    public static function add_to_cart_link_action(){
        // var_dump(get_query_var('esb_add_to_cart', 'default_add_to_cart'));
        // var_dump(get_query_var('quantity', 'default_quantity'));

        // var_dump($_GET['esb_add_to_cart']);
        // var_dump($_GET['quantity']);

        if ( !isset( $_GET['esb_add_to_cart'] ) || $_GET['esb_add_to_cart'] == '') {
            return;
        }

        self::verify_nonce('esb_add_to_cart');

        nocache_headers();
        $product_id          = absint( $_GET['esb_add_to_cart'] );
        $was_added   = false;
        $adding_post      = get_post( $product_id );

        if ( ! $adding_post ) {
            return;
        }

        $quantity = isset($_GET['quantity']) ? absint( $_GET['quantity'] ) : 1;
        if(!$quantity) $quantity = 1;

        if($adding_post->post_type == 'cthads'){
            $cart_item_data = array( 
                'quantity'          => $quantity,
                'yearly_price'      => (isset($_POST['yearly_price'])) ? $_POST['yearly_price'] : '0',
            );
            $cart_item_data = apply_filters('esb_addons_ad_cart_item_data', $cart_item_data, $product_id);
            $was_added = self::add_to_cart_handler_ad( $product_id, $cart_item_data );
        }

        // If we added the listing to the cart we can now optionally do a redirect.
        // if ( $was_added && 'yes' === easybook_addons_get_option( 'checkout_redirect_after_add' )) {
        //     $checkout_page_id = easybook_addons_get_option('checkout_page');
        //     wp_safe_redirect( get_permalink($checkout_page_id) );
        //     exit;
        // }
        
    }

    public static function add_to_cart_action(){

        if ( !isset( $_POST['action'] ) || $_POST['action'] != 'esb_add_to_cart') {
            return;
        }

        self::verify_nonce('easybook-add-to-cart');
        nocache_headers();
        $listing_id          = absint( $_POST['product_id'] );
        $was_added   = false;
        $adding_post      = get_post( $listing_id );

        if ( ! $adding_post ) {
            return;
        }

        if($adding_post->post_type == 'lplan'){
            $cart_item_data = array( 
                'quantity'          => 1,
                'yearly_price'      => (isset($_POST['yearly_price'])) ? $_POST['yearly_price'] : '0',
            );
            $cart_item_data = apply_filters('esb_addons_plan_cart_item_data', $cart_item_data, $listing_id);
            if((float)get_post_meta( $listing_id, '_price', true ) <= 0) 
                self::insert_free_subscription($listing_id);
            else
                $was_added = self::add_to_cart_handler_plan( $listing_id, $cart_item_data );
        }else{
            $checkin =  (isset($_POST['checkin']) && $_POST['checkin'] != '') ? $_POST['checkin'] : '';
            $checkout = (isset($_POST['checkout']) && $_POST['checkout'] != '') ? $_POST['checkout'] : '';
            $adults = (isset($_POST['adults']) && $_POST['adults'] != '') ? $_POST['adults'] : '';
            $children = (isset($_POST['children']) && $_POST['children'] != '') ? $_POST['children'] : '';
            $infants = (isset($_POST['infants']) && $_POST['infants'] != '') ? $_POST['infants'] : '';
            $rooms = (isset($_POST['rooms']) && $_POST['rooms'] != '') ? $_POST['rooms'] : array();
            $addservices= (isset($_POST['addservices']) && !empty($_POST['addservices'])) ? $_POST['addservices'] : array();
            $slots = ( isset($_POST['slots']) && !empty($_POST['slots']) ) ? $_POST['slots'] : array();
            $times = ( isset($_POST['times']) && !empty($_POST['times']) ) ? $_POST['times'] : array();
    
            $price_based = (isset($_POST['price_based']) && $_POST['price_based'] != '') ? $_POST['price_based'] : 'per_night';
            $booking_type = (isset($_POST['booking_type']) && $_POST['booking_type'] != '') ? $_POST['booking_type'] : 'rooms';
            if($booking_type == 'tour'){
                if( ( (int)$adults + (int)$children + (int)$infants ) < 1 ) return;
            }else if($booking_type == 'slot' ){
                // if( empty($slots) ) return;
            }else if($booking_type == 'tpicker' ){
                // if( empty($times) || ( (int)$adults + (int)$children + (int)$infants ) < 1 ) return;
            }else if($booking_type == 'rooms' || $booking_type == 'rental'){
                $nights = easybook_addons_booking_nights($checkin, $checkout);
                if($nights <= 0 || ((int)$adults + (int)$children + (int)$infants) < 1){
                    // expose an error
                    return;
                }
            }

                

            // booking_type
            $cart_item_data = array(
                'checkin'               => $checkin,
                'checkout'              => $checkout,
                'adults'                => (int)$adults,
                'children'              => (int)$children,
                'infants'               => (int)$infants,
                'rooms'                 => $rooms,
                'addservices'           => $addservices,
                'slots'                 => $slots,
                'times'                 => $times,
                'booking_type'          => $booking_type,
                'price_based'           => $price_based,
            );

            
            $cart_item_data = apply_filters( 'esb_addons_listing_cart_item_data', $cart_item_data, $listing_id);

            $was_added = self::add_to_cart_handler_listing( $listing_id, $cart_item_data );
        }


        // If we added the listing to the cart we can now optionally do a redirect.
        if ( $was_added && 'yes' === easybook_addons_get_option( 'checkout_redirect_after_add' )) {
            $checkout_page_id = easybook_addons_get_option('checkout_page');
            wp_safe_redirect( get_permalink($checkout_page_id) );
            exit;
        }


        // var_dump($_POST);

//         array(7) {
//   ["checkout"]=>
//   string(10) "2018-12-25"
//   ["checkin"]=>
//   string(10) "2018-12-24"
//   ["adults"]=>
//   string(1) "1"
//   ["children"]=>
//   string(1) "0"
//   ["rooms"]=>
//   array(2) {
//     [5178]=>
//     string(1) "1"
//     [5174]=>
//     string(1) "1"
//   }
//   ["listing_id"]=>
//   string(4) "1886"
//   ["action"]=>
//   string(19) "listing_add_to_cart"
// }

 


    }
    public static function add_to_cart_event_action(){

        if ( !isset( $_POST['action'] ) || $_POST['action'] != 'esb_add_to_cart_event') {
            return;
        }

        self::verify_nonce('easybook-add-to-cart-event');

        nocache_headers();
        $listing_id          = absint( $_POST['product_id'] );
        $was_added   = false;
        $adding_post      = get_post( $listing_id );
         if ( ! $adding_post ) {
            return;
        }
        $qty = (isset($_POST['qty']) && $_POST['qty'] != '') ? $_POST['qty'] : '';
        $lprice = (isset($_POST['lprice']) && $_POST['lprice'] != '') ? $_POST['lprice'] : 0;
        $date_event = (isset($_POST['ldate']) && $_POST['ldate'] != '') ? $_POST['ldate'] : '';
        $addservices= (isset($_POST['addservices']) && $_POST['addservices'] != '') ? $_POST['addservices'] : array();
        $cart_item_data = array(
            'checkin'       => '',
            'checkout'      => '',
            'adults'        => '',
            'children'      => '',
            'infants'       => '',
            'rooms'         => array(),
            'qty'           =>  (int)$qty,
            'lprice'        => $lprice,
            'date_event'    => $date_event,  
            'addservices'   => $addservices,      

        );
        $cart_item_data = apply_filters( 'esb_addons_listing_cart_item_data', $cart_item_data, $listing_id);
        $was_added = self::add_to_cart_handler_listing( $listing_id, $cart_item_data );
       
        if ( $was_added && 'yes' === easybook_addons_get_option( 'checkout_redirect_after_add' )) {
            $checkout_page_id = easybook_addons_get_option('checkout_page');
            wp_safe_redirect( get_permalink($checkout_page_id) );
            exit;
        }
    }
    public static function add_to_coupon_action(){

        if ( !isset( $_POST['action'] ) || $_POST['action'] != 'esb_add_to_coupon') {
            return;
        }
        self::verify_nonce('easybook-add-to-coupon');

        // need to check if the coupon code is valid?
        $coupon_code = (isset($_POST['coupon_code']) && $_POST['coupon_code'] != '') ? $_POST['coupon_code'] : '';

        if(empty($coupon_code)) 
            return;

        $lid = isset($_POST['lid']) ? $_POST['lid'] : 0;
        if(empty($lid)) 
            return;

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
                    array(
                        'key'           => ESB_META_PREFIX.'for_coupon_listing_id',
                        'value'         => $lid,
                    )
                )
            )
        );
        if(empty($coupon_post))
            return;

        $coupon_id = reset($coupon_post);

        // double check for listing coupon
        $listing_coupon_ids = get_post_meta($lid, ESB_META_PREFIX.'coupon_ids', true);
        if( empty($listing_coupon_ids) || !is_array($listing_coupon_ids) || !in_array($coupon_id, $listing_coupon_ids))
            return;

        $expire_date = get_post_meta($coupon_id, ESB_META_PREFIX.'coupon_expiry_date', true);
        $not_expired_yet = easybook_addons_compare_dates($expire_date ,'now','>=');
        $coupon_qty = get_post_meta($coupon_id, ESB_META_PREFIX.'coupon_qty', true);
        
        if( $coupon_id != '' && $coupon_qty > 0 && $not_expired_yet ){
            ESB_ADO()->cart->set_cart_coupon($coupon_code);
        }
          
    }

    private static function add_to_cart_handler_plan( $plan_id, $cart_item_data ) {
        $passed_validation  = apply_filters( 'esb_add_to_cart_validation', true, $plan_id, $cart_item_data );
        if ( $passed_validation && false !== ESB_ADO()->cart->add_plan_to_cart(  $plan_id, $cart_item_data ) ) {
            return true;
        }
        return false;
    }
    

    private static function add_to_cart_handler_listing( $listing_id, $cart_item_data ) {
        $passed_validation  = apply_filters( 'esb_add_to_cart_validation', true, $listing_id, $cart_item_data );
        if ( $passed_validation && false !== ESB_ADO()->cart->add_to_cart(  $listing_id, $cart_item_data ) ) {
            return true;
        }
        return false;
    }

    private static function add_to_cart_handler_ad( $ad_id, $cart_item_data ) {
        $passed_validation  = apply_filters( 'esb_add_to_cart_validation', true, $ad_id, $cart_item_data );
        if ( $passed_validation && false !== ESB_ADO()->cart->add_ad_to_cart(  $ad_id, $cart_item_data ) ) {
            return true;
        }
        return false;
    }

    public static function check_webhooks(){

        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'cth_ppipn':
                    $esb_payment_paypal = new Esb_Class_Payment_Paypal();
                    $esb_payment_paypal->process_payment_check_webhooks();
                    break;
                case 'esb_stripewebhook':
                    $esb_payment_stripe = new Esb_Class_Payment_Stripe();
                    $esb_payment_stripe->process_payment_check_webhooks();
                    break;
                case 'cth_pfipn':
                    $esb_payment_payfast = new Esb_Class_Payment_Payfast();
                    $esb_payment_payfast->process_payment_check_webhooks();
                    break;
            }
            
        }

        // if(isset($_GET['action']) && $_GET['action'] === 'cth_ppipn'){
        //     require_once ESB_ABSPATH.'posttypes/payment-paypal.php';
        //     $payment_class = new CTH_Payment_Paypal();
        //     $pm_datas = $payment_class->extractPaymentData();
        //     // var_dump($pm_datas);

        //     if(!isset($pm_datas['order_ids']) || empty($pm_datas['order_ids'])) return;

        //     foreach ($pm_datas['order_ids'] as $order_id) {
        //         $order_pt = get_post_type($order_id); // (string|false) Post type on success, false on failure.
        //         if($order_pt == 'lbooking'){
        //             // for booking
        //             if( $pm_datas['pm_status'] === 'Trialing' ){
        //                 // active trial membership
        //                 $pm_datas['pm_status'] = 'trialing';
        //                 // easybook_add_ons_active_membership($pm_datas, false);
        //             }elseif ($pm_datas['pm_status'] === 'Completed') {
        //                 //The payment has been completed, and the funds have been added successfully to your account balance.
        //                 $pm_datas['pm_status'] = 'completed';
        //                 // easybook_add_ons_active_membership($pm_datas, false);
        //                 // Esb_Class_Booking::paypal_completed_check($pm_datas, $order_id);

        //                 if($payment_data['pm_amount'] == get_post_meta( $order_id, ESB_META_PREFIX.'price_total', true )) 
        //                     Esb_Class_Booking::approve_booking($order_id);

        //             }elseif($pm_datas['pm_status'] === 'Refunded'){
        //                 //The payment has been refunded


        //                 // $order_id = $pm_datas['order_id'];
        //                 // if ( !update_post_meta( $order_id, ESB_META_PREFIX.'status',  'refunded' ) ) {
        //                 //     if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Change order status to refunded failure" . PHP_EOL, 3, ESB_LOG_FILE);
        //                 // }
        //                 // do_action( 'easybook_addons_order_refunded', $order_id );
        //             }else{
        //                 //The payment has other status include false (boolean)
        //             }

        //         }elseif($order_pt == 'cthads'){
        //             if ($pm_datas['pm_status'] === 'Completed') {
        //                 // if($payment_data['pm_amount'] == get_post_meta( $order_id, ESB_META_PREFIX.'price_total', true )) 
        //                     Esb_Class_ADs::active_ad($order_id);

        //             }
        //         }elseif($order_pt == 'lorder'){
        //             // for membership
        //             if( $pm_datas['pm_status'] === 'Trialing' ){
        //                 // active trial membership
        //                 $pm_datas['pm_status'] = 'trialing';
        //                 $pm_datas['order_id'] = $order_id;
        //                 // easybook_add_ons_active_membership($pm_datas, false);
        //                 Esb_Class_Membership::active_membership($pm_datas);
        //             }elseif ($pm_datas['pm_status'] === 'Completed') {
        //                 //The payment has been completed, and the funds have been added successfully to your account balance.
        //                 $pm_datas['pm_status'] = 'completed';
        //                 // easybook_add_ons_active_membership($pm_datas, false);
        //                 // Esb_Class_Booking::paypal_completed_check($pm_datas, $order_id);

        //                 if($payment_data['pm_amount'] == get_post_meta( $order_id, ESB_META_PREFIX.'price_total', true )) 
        //                     Esb_Class_Membership::active_membership($pm_datas);

        //             }elseif($pm_datas['pm_status'] === 'Refunded'){
        //                 //The payment has been refunded


        //                 // $order_id = $pm_datas['order_id'];
        //                 // if ( !update_post_meta( $order_id, ESB_META_PREFIX.'status',  'refunded' ) ) {
        //                 //     if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Change order status to refunded failure" . PHP_EOL, 3, ESB_LOG_FILE);
        //                 // }
        //                 // do_action( 'easybook_addons_order_refunded', $order_id );
        //             }else{
        //                 //The payment has other status include false (boolean)
        //             }

        //         }
        //     }
        // }

        // // membership stripe payment webhook
        // if(isset($_GET['action']) && $_GET['action'] === 'esb_stripewebhook'){
        // // server https://easybook.cththemes.com/?action=esb_stripewebhook

        //     require_once ESB_ABSPATH.'posttypes/payment-stripe.php';
        //     $payment_class = new CTH_Payment_Stripe();

        //     $payment_class->checkWebHooks();

        //     // $pm_datas = $payment_class->extractPaymentData();


        // }
        // // end membership stripe payment webhook
        // if(isset($_GET['action']) && $_GET['action']==='cth_pfipn'){

        //     require_once ESB_ABSPATH.'posttypes/payment-payfast.php';

        //     $payment_class = new CTH_Payment_Payfast();

        //     $pm_datas = $payment_class->extractPaymentData();
        //     // var_dump($pm_datas);

        //     if(!isset($pm_datas['order_ids']) || empty($pm_datas['order_ids'])) return;

        //     foreach ($pm_datas['order_ids'] as $order_id) {
        //         $order_pt = get_post_type($order_id); // (string|false) Post type on success, false on failure.
        //         if($order_pt == 'lbooking'){
        //             // for booking
        //             if ($pm_datas['pm_status'] === 'COMPLETE') {
        //                 $pm_datas['pm_status'] = 'completed';
        //                 // if($payment_data['amount_gross'] == get_post_meta( $order_id, ESB_META_PREFIX.'price_total', true )) 
        //                     Esb_Class_Booking::approve_booking($order_id);   
        //             }else{
        //                 //The payment has other status include false (boolean)
        //             }
        //         }elseif($order_pt == 'cthads'){
        //             if ($pm_datas['pm_status'] === 'COMPLETE') {
        //                 // if($payment_data['pm_amount'] == get_post_meta( $order_id, ESB_META_PREFIX.'price_total', true )) 
        //                     Esb_Class_ADs::active_ad($order_id);

        //             }
        //         }elseif($order_pt == 'lorder'){
        //             // for membership
        //             if ($pm_datas['pm_status'] === 'COMPLETE') {
        //                 //The payment has been completed, and the funds have been added successfully to your account balance.
        //                 $pm_datas['pm_status'] = 'completed';
        //                 // if($payment_data['amount_gross'] == get_post_meta( $order_id, ESB_META_PREFIX.'price_total', true )) 
        //                     Esb_Class_Membership::active_membership($pm_datas);
        //             }else{
        //                 //The payment has other status include false (boolean)
        //             }

        //         }
        //     }
            
        //     // Esb_Class_Membership::active_membership($pm_datas);
        // }
        
    }
}

Esb_Class_Form_Handler::init();