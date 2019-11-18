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

class Esb_Class_Booking{

    public static function init(){
        add_action( 'before_delete_post', array( __CLASS__, 'before_delete_post' ), 10, 1 );
        add_action( 'easybook_addons_lbooking_change_status_to_completed', array( __CLASS__, 'approve_booking' ), 10, 1 );
    }

    public static function approve_booking($booking_id = 0){
        if(is_numeric($booking_id)&&(int)$booking_id > 0){
            $listing_id = get_post_meta( $booking_id, ESB_META_PREFIX.'listing_id', true );
            $booking_user_id = get_post_meta( $booking_id, ESB_META_PREFIX.'user_id', true );
                // not for manual approved
                update_post_meta( $booking_id, ESB_META_PREFIX.'lb_status',  'completed'  );

            // if ( !update_post_meta( $booking_id, ESB_META_PREFIX.'lb_status',  'completed'  ) ) {
            //     if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Update booking status to completed failure" . PHP_EOL, 3, ESB_LOG_FILE);
            // }else{
                easybook_addons_add_user_notification($booking_user_id, array(
                    'type' => 'booking_approved',
                    'entity_id'     => $listing_id
                ));
                // update author earning
                $listing_author_id = get_post_field( 'post_author', $listing_id );
                if($listing_author_id){

                    // $earning_before = Esb_Class_Earning::getBalance($listing_author_id); 

                    $inserted_earning = Esb_Class_Earning::insert($booking_id, $listing_author_id, $listing_id);
                    // update author earning meta for double check
                    // if($inserted_earning !== false){
                    //     $author_earning = get_user_meta($listing_author_id, ESB_META_PREFIX.'earning', true);

                    //     if($earning_before == 0 && $author_earning != $earning_before) 
                    //         $author_earning = $inserted_earning;
                    //     else
                    //         $author_earning = $inserted_earning + floatval($author_earning);

                    //     update_user_meta( $listing_author_id, ESB_META_PREFIX.'earning', $author_earning );
                    // }
                }

                // update cth_booking status: 0 - insert - 1 - active
                self::update_cth_booking_status($booking_id, 1);
                do_action( 'easybook_addons_booking_approved', $booking_id );
            // }
        }        

    }

    // public static function paypal_completed_check($payment_data = array(), $booking_id = 0){
    //     // check for amount
    //     // $bk_price = get_post_meta( $booking_id, ESB_META_PREFIX.'price_total', true );
    //     if($payment_data['pm_amount'] == get_post_meta( $booking_id, ESB_META_PREFIX.'price_total', true )) self::approve_booking($booking_id);

    // }

    private static function update_cth_booking_status($booking_id = 0, $status = 0){
        global $wpdb;
        $booking_table = $wpdb->prefix . 'cth_booking';
        $wpdb->update( $booking_table, array( 'status' => $status ), array( 'booking_id' => $booking_id ), array( '%d' ), array( '%d' ) );

    }

    // before delete booking and room post
    public static function before_delete_post($postid = 0){
        global $wpdb;
        $post_type = get_post_type($postid);
        if($post_type === 'lbooking' || $post_type === 'lrooms'){
            $booking_table = $wpdb->prefix . 'cth_booking';
            $wpdb->query( 
                $wpdb->prepare( 
                    "
                    DELETE FROM $booking_table
                    WHERE booking_id = %d OR room_id = %d
                    ",
                    $postid,
                    $postid
                )
            );
        }
    }


}
Esb_Class_Booking::init();