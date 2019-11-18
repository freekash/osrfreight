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
class Esb_Class_Payment_Stripe extends Esb_Class_Payment{
	// private $inserted_post_first = '';
	// private $methods = array();
	// protected $payment_url = '';
	// private $payments = array();
	public function int() {
       	$this->includes();
        $this->payment_methods_texts();
        $this-> payment_methods();
    }
    public function includes() {
    	require_once ESB_ABSPATH.'posttypes/payment-stripe.php';	
    }
    public function payment_methods_texts(){
		add_filter('esb_payment_method_texts' ,array($this, 'get_method_payment_text')); 
    }
    public function get_method_payment_text($methods){
    	$method = array(
    		'stripe' => __( 'Stripe', 'easybook-add-ons' ),
    	);
    	$result = array_merge($methods, $method);
    	return $result;
    }
    public function payment_methods(){
    	add_filter('esb_payment_methods' ,array($this, 'get_method_payment'));
    }
    public function get_method_payment($payments){
        if(easybook_addons_get_option('payments_stripe_enable') == 'yes'){
        	$payments['stripe'] = array(
                'title' => __( 'Stripe', 'easybook-add-ons' ),
                'icon' => ESB_DIR_URL.'assets/images/stripe.png',
                'desc' => easybook_addons_get_option('payments_stripe_desc',''),
                'checkout_text' => __( 'Pay Now', 'easybook-add-ons' ),
            );
        }
    	return $payments;
    }
    public function process_payment_checkout($data_checkout){
        $inserted_post_first = $data_checkout['inserted_post_first'];
        $price_total = ESB_ADO()->cart->get_total();
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
        $inserted_posts_text = $data_checkout['inserted_posts_text'];
        $current_user = wp_get_current_user();

        $stripe_local = ESB_DEBUG && ($_SERVER['SERVER_NAME'] == 'localhost'|| $_SERVER['SERVER_NAME'] == 'local.ser');

        if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Stripe Local: " . $stripe_local . PHP_EOL, 3, ESB_LOG_FILE);
        
        // for stripe payment method
        $payment_class = new CTH_Payment_Stripe();
        $stripeEmail = $data_checkout['stripeEmail'];
        // for recurring - subscription payment
        if( get_post_meta( $inserted_post_first , ESB_META_PREFIX.'is_recurring', true ) == 'on' && get_post_meta( $item_number , ESB_META_PREFIX.'stripe_plan_id', true ) != '' ){ // recurring package - for membership only

            $subscription_metas = array(
                'esb_plan_id'               => $item_number, // make unique meta key for site identifing
                'order_id'                  => $inserted_post_first,
                'order_post_type'           => $inserted_post_first_pt,    
                'order_ids'                 => $inserted_posts_text,
                'user_id'                   => $current_user->ID,
                'user_email'                => $current_user->user_email,
                'renew'                     => 'no',
                'subscription'              => 'yes'
            );
            $stripe_args = array(
                'items' => array(
                    array(
                        'plan' => get_post_meta( $item_number , ESB_META_PREFIX.'stripe_plan_id', true ),
                        'quantity'  => 1
                    ),
                ),
                // 'metadata'      => $subscription_metas
            );
            
            if(!empty($trial_interval) && !empty($trial_period)){
                $stripe_args['trial_period_days'] = easybook_add_ons_get_stripe_duration( $trial_interval, $trial_period );

                $subscription_metas['trial_interval']   = $trial_interval;
                $subscription_metas['trial_period']     = $trial_period;
            }
            $stripe_args['metadata'] = $subscription_metas;
            $subscription_obj = $payment_class->processRecurring($stripe_args);

            if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Insert order post error: " . json_encode($subscription_obj) . PHP_EOL, 3, ESB_LOG_FILE);

            // create charge success
            if($subscription_obj && isset($subscription_obj->status)){

            }
            
            // for local test only
            if($stripe_local && isset($subscription_obj->status) /*&& $subscription_obj->status === 'active'*/ ){ // or trialing for in trial period
                Esb_Class_Membership::active_membership(array(
                    'pm_status'                 => $subscription_obj->status,
                    'user_id'                   => $current_user->ID,
                    'item_number'               => $item_number, // this is listing plan id
                    'pm_date'                   => $subscription_obj->created, // or use start for correction
                    'order_id'                  => $inserted_post_first,
                    'recurring_subscription'    => true, // not used

                    'txn_id'                    => $subscription_obj->id,
                    'subscription_id'           => $subscription_obj->id,
                ), 
                true);
                // this shortcode should be added in success payment page
                // do_shortcode( '[affiliate_conversion_script amount="10" description="My Description" context="easybook-Add-Ons" reference="'.$lorder_id.'" status="pending"]' );
            }

        } // end stripe recurring subscription
        else{
            
            $charge_metas = array(
                'esb_plan_id'               => $item_number, // make unique meta key for site identifing
                'order_id'                  => $inserted_post_first,
                'order_post_type'                   => $inserted_post_first_pt,

                'order_ids'                 => $inserted_posts_text,
                'user_id'                   => $current_user->ID,
                
                'user_email'                => $current_user->user_email,
                'renew'                     => 'no',
                'subscription'              => 'no'
            );
            $stripe_args = array(
                // 'customer'   => $customer->id, // will be added from the class
                'amount'        => easybook_addons_get_stripe_amount( $price_total ),
                // 'currency'   => easybook_addons_get_option('currency','USD'), // lowercase will be added from the class
                'description'   => sprintf( __( 'Payment from %s', 'easybook-add-ons' ), $stripeEmail ), 
                'receipt_email' => $stripeEmail,
                'metadata'      => $charge_metas
            );

            $charge_obj = $payment_class->processOneTime($stripe_args);
            // create charge success
            if($charge_obj && isset($charge_obj->status)){

            }
            // for local test only
            if($stripe_local && isset($charge_obj->status) && $charge_obj->status === 'succeeded'){
                if($inserted_post_first_pt == 'lbooking')
                    Esb_Class_Booking::approve_booking($inserted_post_first);
                elseif($inserted_post_first_pt == 'cthads')
                    Esb_Class_ADs::active_ad($inserted_post_first);
                elseif($inserted_post_first_pt == 'lorder')
                    Esb_Class_Membership::active_membership(array(
                        'pm_status'                 => 'completed',
                        'user_id'                   => $current_user->ID,
                        'item_number'               => $item_number, // this is listing plan id
                        'pm_date'                   => $charge_obj->created, // or use start for correction
                        'order_id'                  => $inserted_post_first,
                        'recurring_subscription'    => false, // not used

                        // update order transactions
                        // for one time payment is balance_transaction data
                        'txn_id'                    => $charge_obj->balance_transaction
                    ), 
                    true);

            }
        }
        $process_results = array(
        	'success'   => true,
            'url'       => '',
        );
        return $process_results;
    }
    public function process_payment_check_webhooks(){
        $payment_class = new CTH_Payment_Stripe();
        $payment_class->checkWebHooks();
    }

}
$class_Stripe = new Esb_Class_Payment_Stripe();
$class_Stripe->int();