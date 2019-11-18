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

class Esb_Class_Emails{
    public static function init(){
       add_action( 'easybook_addons_insert_listing_after',array( __CLASS__, 'insert_listing_after' ), 10, 2 );
       add_action( 'easybook_addons_insert_order_after',array( __CLASS__, 'insert_order_after' ), 10, 3 );
       add_action( 'easybook_addons_order_completed', array( __CLASS__, 'order_completed' ));
       add_action( 'easybook_addons_cthclaim_approved', array( __CLASS__, 'cthclaim_approved' ), 10, 3 );
       add_action( 'easybook_addons_lclaim_change_status_to_decline', array( __CLASS__, 'lclaim_change_status_to_decline' ), 10, 1 );
       add_action( 'easybook_addons_new_invoice', array( __CLASS__, 'new_invoice' ));
       add_action( 'easybook_addons_insert_booking_after',array( __CLASS__, 'insert_booking_after' ));
       add_action('esb_insert_booking_after', array(__CLASS__, 'insert_booking_after'));
       add_action( 'easybook_addons_edit_booking_approved',array( __CLASS__, 'edit_booking_approved' )); 
       add_action( 'easybook_addons_lclaim_change_status_to_asked_charge',array( __CLASS__, 'lclaim_change_status_to_asked_charge' ), 10, 1 );
    
        add_action( 'cth_chat_reply_after',array( __CLASS__, 'chat_reply_email' ), 10, 1 );
        add_action( 'easybook_addons_insert_message_after',array( __CLASS__, 'author_message_to_email' ), 10, 2 );



    }
    public static function wp_mail_from_name( $name){
        return easybook_addons_get_option('emails_name')? easybook_addons_get_option('emails_name'): $name;
    }
    public static function wp_mail_from( $email){
        return easybook_addons_get_option('emails_email')? easybook_addons_get_option('emails_email'): $email;
    }
    public static function do_wp_mail( $to, $subject='', $message='', $headers = array(), $attachments = array()){
        if(easybook_addons_get_option('emails_ctype') == 'html'){ 
            $headers[] = 'Content-Type: text/html; charset=UTF-8';
        }
        //$headers[] = 'From: '. $sender_option.' ' . '<'.$sender_email_option.'>';
        add_filter( 'wp_mail_from_name', array( __CLASS__, 'wp_mail_from_name' ));
        add_filter('wp_mail_from', array( __CLASS__, 'wp_mail_from' ));
        // $headers[] = 'Reply-To: '.self::wp_mail_from_name(__( 'Sender Name', 'easybook-add-ons' )) .' ' . '<'.self::wp_mail_from(__( 'senderemail@gmail.com', 'easybook-add-ons' )).'>';

        $email_sent = wp_mail( $to, $subject , $message , $headers, $attachments );

        remove_filter( 'wp_mail_from_name', array( __CLASS__, 'wp_mail_from_name' ));
        remove_filter('wp_mail_from', array( __CLASS__, 'wp_mail_from' ));

        return $email_sent;   
    }
    public static function process_email_template($email_template = '', $email_vars = array()){
        $email_vars = array_merge($email_vars,array('site_title' => get_bloginfo('name')));
        // get allow variables
        $allow_field_names = array_keys($email_vars);
        // extract variables, skip if existing
        extract($email_vars, EXTR_SKIP);
        if(preg_match_all("/{([\w\-_]+)[^\w\-_]*}/", $email_template, $matches) != FALSE){
            $fieldsPattern = array();//$matches[0];
            $fieldsReplace = array();
            foreach ($matches[1] as $key => $fn) {
                $fieldsPattern[] = "/{(".$fn.")[^\w\-_]*}/";
                if( isset($$fn) && in_array($fn, $allow_field_names ) ){
                    $fieldsReplace[] = $$fn;  //'['.$fn.']';
                }else{
                    $fieldsReplace[] = '{'.$fn.'}';
                } 
            }
            $email_template = preg_replace($fieldsPattern, $fieldsReplace, $email_template);
        }
        return $email_template;
    }
    public static function insert_listing_after($listing_id = 0, $is_editing_listing = true){
         if($is_editing_listing == false){
            $listing_post = get_post($listing_id);
            if (null != $listing_post){
                $cats = array();
                $terms = get_the_terms($listing_post,'listing_cat'); 
                if ( $terms && ! is_wp_error( $terms ) ){
                    
                    foreach ( $terms as $term ) {
                        $cats[] = $term->name;
                    }
                }
                $current_user = wp_get_current_user();

                // send admin notification email
                $email_recipients = easybook_addons_get_option('emails_admin_new_listing_recipients') ? easybook_addons_get_option('emails_admin_new_listing_recipients') : get_bloginfo('admin_email') ;
                if(easybook_addons_get_option('emails_admin_new_listing_enable') == 'yes'){
                    
                    $subj_args = array(
                        'listing_number' => $listing_post->ID,
                        'listing_title' => $listing_post->post_title,
                        'listing_date' => $listing_post->post_date,
                    );
                    
                    $email_subject = self::process_email_template(easybook_addons_get_option('emails_admin_new_listing_subject'), $subj_args);
                    $temp_args = array(
                        'listing_number' => $listing_post->ID,
                        'listing_author' => $current_user->display_name,
                        'listing_title' => $listing_post->post_title,
                        'listing_category' => implode(", ", $cats),
                        'listing_excerpt' => $listing_post->post_excerpt,
                        'listing_date' => $listing_post->post_date,
                        'author_email' => $current_user->user_email,
                        
                    );
                    
                    $email_template = self::process_email_template(easybook_addons_get_option('emails_admin_new_listing_temp'), $temp_args);
                    
                    $headers = array( 'Reply-To: '.$current_user->display_name .' ' . '<'.$current_user->user_email.'>' );
                    self::do_wp_mail( $email_recipients, $email_subject, $email_template, $headers);
                }
                // end new listing author email
                // send listing author email
                if(easybook_addons_get_option('emails_auth_new_listing_enable') == 'yes'){
                    
                    $subj_args = array(
                        'listing_title' => $listing_post->post_title,
                    );
                    
                    $email_subject = self::process_email_template(easybook_addons_get_option('emails_auth_new_listing_subject'), $subj_args);
                    $temp_args = array(
                        'listing_number' => $listing_post->ID,
                        'listing_author' => $current_user->display_name,
                        'listing_title' => $listing_post->post_title,
                        'listing_category' => implode(", ", $cats),
                        'listing_dashboard' => get_permalink(easybook_addons_get_option('dashboard_page')),
                    );
                    
                    $email_template = self::process_email_template(easybook_addons_get_option('emails_auth_new_listing_temp'), $temp_args);
                    
                    $auth_replies = array();
                    foreach ((array)$email_recipients as $em) {
                        $auth_replies[] = '<'.$em.'>';
                    }
                    
                    $headers = array( 'Reply-To: '. implode(',', $auth_replies) );

                    self::do_wp_mail( $current_user->user_email, $email_subject, $email_template, $headers);
                }
                // end new listing author email
                    
            }
            // if is correct listing
        }
        // send email for submit new listing only
    }
    public static function insert_order_after($order_id = 0, $listing_id = 0, $plan_id = 0){
        if(is_numeric($order_id)&&(int)$order_id > 0){
            $order_post = get_post($order_id);
            if (null != $order_post){
                $plan_post = get_post($plan_id);
                if (null != $plan_post){
                    // need to check if the order is for ad campaign
                    
                    // send admin notification email
                    if(easybook_addons_get_option('emails_admin_new_order_enable') == 'yes'){
                        
                        $subj_args = array(
                            'order_number' => $order_post->ID,
                            'order_date' => $order_post->post_date,
                        );
                        // $email_subject = easybook_addons_process_email_template(easybook_addons_get_option('emails_admin_new_order_subject'), $subj_args);
                        $email_subject = self::process_email_template(easybook_addons_get_option('emails_admin_new_order_subject'), $subj_args);
                        $temp_args = array(
                            'author' => get_post_meta( $order_id, ESB_META_PREFIX.'display_name', true ),
                            'order_amount' => get_post_meta( $order_id, ESB_META_PREFIX.'amount', true ),
                            'order_currency' => get_post_meta( $order_id, ESB_META_PREFIX.'currency_code', true ),
                            'order_method' => easybook_addons_get_order_method_text(get_post_meta( $order_id, ESB_META_PREFIX.'payment_method', true )),
                            'order_title' => $order_post->post_title,
                            'order_number' => $order_post->ID,
                            'order_date' => $order_post->post_date,
                            // 'listing_title' => $listing_post->post_title,
                            // 'listing_category' => implode(", ", $cats),
                            'plan_title' => $plan_post->post_title,
                            
                            
                        );
                        // $email_template = easybook_addons_process_email_template(easybook_addons_get_option('emails_admin_new_order_temp'), $temp_args);
                        $email_template = self::process_email_template(easybook_addons_get_option('emails_admin_new_order_temp'), $temp_args);
                        $email_recipients = easybook_addons_get_option('emails_admin_new_order_recipients') ? easybook_addons_get_option('emails_admin_new_order_recipients') : get_bloginfo('admin_email') ;
                        // easybook_addons_do_wp_mail( $email_recipients, $email_subject, $email_template);
                        self::do_wp_mail( $email_recipients, $email_subject, $email_template);
                    }
                    // end new order admi email
                }
                // end if plan_post
            }
            // end if order_post
        }
    }
    public static function order_completed($order_id = 0){
        if(is_numeric($order_id)&&(int)$order_id > 0){
            $order_post = get_post($order_id);
            if (null != $order_post){
                $plan_post = get_post(get_post_meta( $order_id, ESB_META_PREFIX.'plan_id', true ));
                if (null != $plan_post){
                    $listing_author_email = get_post_meta( $order_id, ESB_META_PREFIX.'email', true );
                    // send admin notification email
                    if(easybook_addons_get_option('emails_admin_order_completed_enable') == 'yes'){
                        
                        $subj_args = array(
                            'order_number' => $order_post->ID,
                            'order_date' => $order_post->post_date,
                        );
                        // $email_subject = easybook_addons_process_email_template(easybook_addons_get_option('emails_admin_order_completed_subject'), $subj_args);
                        $email_subject = self::process_email_template(easybook_addons_get_option('emails_admin_order_completed_subject'), $subj_args);
                        $temp_args = array(
                            'author' => get_post_meta( $order_id, ESB_META_PREFIX.'display_name', true ),
                            'order_amount' => get_post_meta( $order_id, ESB_META_PREFIX.'amount', true ),
                            'order_currency' => get_post_meta( $order_id, ESB_META_PREFIX.'currency_code', true ),
                            'order_method' => easybook_addons_get_order_method_text(get_post_meta( $order_id, ESB_META_PREFIX.'payment_method', true )),
                            'order_title' => $order_post->post_title,
                            'order_number' => $order_post->ID,
                            'order_date' => $order_post->post_date,
                            'plan_title' => $plan_post->post_title,
                            // 'listing_title' => $listing_post->post_title,
                            // 'listing_category' => implode(", ", $cats),
                            
                        );
                        // $email_template = easybook_addons_process_email_template(easybook_addons_get_option('emails_admin_order_completed_temp'), $temp_args);
                        $email_template = self::process_email_template(easybook_addons_get_option('emails_admin_order_completed_temp'), $temp_args);
                        $email_recipients = easybook_addons_get_option('emails_admin_order_completed_recipients') ? easybook_addons_get_option('emails_admin_order_completed_recipients') : get_bloginfo('admin_email') ;
                        // easybook_addons_do_wp_mail( $email_recipients, $email_subject, $email_template);
                        self::do_wp_mail( $email_recipients, $email_subject, $email_template);
                    }
                    // end new order admin email

                    // send author notification email
                    if(easybook_addons_get_option('emails_auth_order_completed_enable') == 'yes' && $listing_author_email !=''){
                        
                        $subj_args = array(
                            'order_number' => $order_post->ID,
                            'order_date' => $order_post->post_date,
                        );
                        // $email_subject = easybook_addons_process_email_template(easybook_addons_get_option('emails_auth_order_completed_subject'), $subj_args);
                        $email_subject = self::process_email_template(easybook_addons_get_option('emails_auth_order_completed_subject'), $subj_args);
                        $temp_args = array(
                            'author' => get_post_meta( $order_id, ESB_META_PREFIX.'display_name', true ),
                            'order_amount' => get_post_meta( $order_id, ESB_META_PREFIX.'amount', true ),
                            'order_currency' => get_post_meta( $order_id, ESB_META_PREFIX.'currency_code', true ),
                            'order_method' => easybook_addons_get_order_method_text(get_post_meta( $order_id, ESB_META_PREFIX.'payment_method', true )),
                            'order_title' => $order_post->post_title,
                            'order_number' => $order_post->ID,
                            'order_date' => $order_post->post_date,
                            'plan_title' => $plan_post->post_title,
                            // 'listing_title' => $listing_post->post_title,
                            // 'listing_category' => implode(", ", $cats),
                            
                        );
                        // $email_template = easybook_addons_process_email_template(easybook_addons_get_option('emails_auth_order_completed_temp'), $temp_args);
                        $email_template = self::process_email_template(easybook_addons_get_option('emails_auth_order_completed_temp'), $temp_args);
                        
                        // easybook_addons_do_wp_mail( $listing_author_email, $email_subject, $email_template);
                        self::do_wp_mail( $listing_author_email, $email_subject, $email_template);
                    }
                    // end new order author email
                }
                // end if plan_post
            }
            // end if order_post
        }    
    }
    public static function cthclaim_approved($claim_id = 0, $listing_id = 0, $user_id = 0){
        if(is_numeric($claim_id)&&(int)$claim_id > 0){
            $listing_id                     = get_post_meta( $claim_id, ESB_META_PREFIX.'listing_id', true );
            $user_id                        = get_post_meta( $claim_id, ESB_META_PREFIX.'user_id', true );
            
            $listing_post = get_post($listing_id);
            $user_info = get_userdata($user_id);

            $subject = apply_filters( 'easybook-addons-claim-approved-subject', __( 'Claim listing approved', 'easybook-add-ons' ) );
            $body = apply_filters( 'easybook-addons-claim-approved-body', sprintf(__( '{site_title}<br />Your claimed listing <a href="%2$s">%1$s</a> is approved.<br />Thank you.', 'easybook-add-ons' ), $listing_post->post_title, get_permalink($listing_post->ID) ) );

            $email_template =  self::process_email_template($body,array());
            self::do_wp_mail( $user_info->user_email, $subject,$email_template);
        }    
    }
    public static function lclaim_change_status_to_decline($claim_id = 0){
        if(is_numeric($claim_id)&&(int)$claim_id > 0){
            $listing_id                     = get_post_meta( $claim_id, ESB_META_PREFIX.'listing_id', true );
            $user_id                        = get_post_meta( $claim_id, ESB_META_PREFIX.'user_id', true );
            
            $listing_post = get_post($listing_id);
            $user_info = get_userdata($user_id);

            $subject = apply_filters( 'easybook-addons-claim-declined-subject', __( 'Claim listing declined', 'easybook-add-ons' ) );
            $body = apply_filters( 'easybook-addons-claim-declined-body', sprintf(__( '{site_title}<br />Your claimed listing for %s is declined.<br />Thank you.', 'easybook-add-ons' ), $listing_post->post_title, get_permalink($listing_post->ID) ) );

            $email_template = $this->process_email_template($body,array());
            self::do_wp_mail( $user_info->user_email, $subject,$email_template);
        }     
    }
    public static function new_invoice($invoice_id = 0){
        if(is_numeric($invoice_id)&&(int)$invoice_id > 0){
            $invoice_post = get_post($invoice_id);
            if (null != $invoice_post){

                $listing_author_email = get_post_meta( $invoice_id, ESB_META_PREFIX.'user_email', true );
                // send admin notification email
                if(easybook_addons_get_option('emails_admin_new_invoice_enable') == 'yes'){
                    
                    $subj_args = array(
                        'number' => $invoice_post->ID,
                        'date' => $invoice_post->post_date,
                    );
                    // $email_subject = easybook_addons_process_email_template(easybook_addons_get_option('emails_admin_new_invoice_subject'), $subj_args);
                    $email_subject = self::process_email_template(easybook_addons_get_option('emails_admin_new_invoice_subject'), $subj_args);
                    $temp_args = Esb_Class_Invoice_CPT::get_invoice_datas($invoice_post);
                    // $email_template = easybook_addons_process_email_template(easybook_addons_get_option('emails_admin_new_invoice_temp'), $temp_args);
                    $email_template = self::process_email_template(easybook_addons_get_option('emails_admin_new_invoice_temp'), $temp_args);
                    $email_recipients = easybook_addons_get_option('emails_admin_new_invoice_recipients') ? easybook_addons_get_option('emails_admin_new_invoice_recipients') : get_bloginfo('admin_email') ;
                    // easybook_addons_do_wp_mail( $email_recipients, $email_subject, $email_template);
                    self::do_wp_mail( $email_recipients, $email_subject, $email_template);
                }
                // end new order admin email

                // send author notification email
                if(easybook_addons_get_option('emails_auth_new_invoice_enable') == 'yes' && $listing_author_email !=''){
                    
                    $subj_args = array(
                        'number' => $invoice_post->ID,
                        'date' => $invoice_post->post_date,
                    );
                    // $email_subject = easybook_addons_process_email_template(easybook_addons_get_option('emails_auth_new_invoice_subject'), $subj_args);
                    $email_subject = self::process_email_template(easybook_addons_get_option('emails_auth_new_invoice_subject'), $subj_args);
                    $temp_args = Esb_Class_Invoice_CPT::get_invoice_datas($invoice_post);
                    // $email_template = easybook_addons_process_email_template(easybook_addons_get_option('emails_auth_new_invoice_temp'), $temp_args);
                    $email_template = self::process_email_template(easybook_addons_get_option('emails_auth_new_invoice_temp'), $temp_args);
                    
                    // easybook_addons_do_wp_mail( $listing_author_email, $email_subject, $email_template);
                    self::do_wp_mail( $listing_author_email, $email_subject, $email_template);
                }
                // end new order author email


            }
            // end if invoice_post
        }   
    }
    public static function insert_booking_after($booking_id = 0){
        if(is_numeric($booking_id)&&(int)$booking_id > 0){
            $booking_post = get_post($booking_id);
            if (null != $booking_post){
                $listing_id = get_post_meta( $booking_id, ESB_META_PREFIX.'listing_id', true );
                $listing_post = get_post($listing_id);
                if (null != $listing_post){
                    
                    $user_obj = get_userdata(get_post_meta( $booking_id, ESB_META_PREFIX.'user_id', true ));
                    if( $user_obj ){
                        $lb_name = $user_obj->display_name;
                        $lb_email = $user_obj->user_email;
                        $lb_phone = get_user_meta( $user_obj->ID, ESB_META_PREFIX.'phone', true);
                    }else{
                        $lb_name = get_post_meta( $booking_id, ESB_META_PREFIX.'lb_name', true );
                        $lb_email = get_post_meta( $booking_id, ESB_META_PREFIX.'lb_email', true );
                        $lb_phone = get_post_meta( $booking_id, ESB_META_PREFIX.'lb_phone', true );

                    }
                    if( empty($lb_phone) ) $lb_phone = get_post_meta( $booking_id, ESB_META_PREFIX.'lb_phone', true );

                    $rooms = get_post_meta( $booking_id, ESB_META_PREFIX.'rooms', true );
                    $room_title = '';
                    if (null != $rooms){
                        foreach ($rooms as $key => $room) {
                            $room_title = $room['title'];
                        }
                    } 
                    $lb_adults     = get_post_meta( $booking_id, ESB_META_PREFIX.'adults', true );
                    $lb_children  = get_post_meta( $booking_id, ESB_META_PREFIX.'children', true );
                    $person = (int)$lb_adults + (int)$lb_children;
                    $listing_author = get_user_by( 'ID', $listing_post->post_author );

                    $email_recipients = array();
                    if(!$listing_author) $email_recipients[] = $listing_author->user_email;
                    // also send to site owner
                    $email_recipients[] = get_bloginfo('admin_email');

                    $bktimes = get_post_meta($booking_id, ESB_META_PREFIX . 'times', true);
                    if (!empty($bktimes)) {
                        $bktimes = implode('<br \>', $bktimes);
                    }

                    $bkslots = get_post_meta($booking_id, ESB_META_PREFIX . 'slots', true);
                    if (!empty($bkslots)) {
                        $bkslots = implode('<br \>', $bkslots);
                    }

                    $checkin = get_post_meta($booking_id, ESB_META_PREFIX . 'checkin', true);
                    if ($checkin != '') {
                        $checkin = easybook_addons_date_format($checkin);
                    }

                    $checkout = get_post_meta($booking_id, ESB_META_PREFIX . 'checkout', true);
                    if ($checkout != '') {
                        $checkout = easybook_addons_date_format($checkout);
                    }


                    $temp_args = array(
                        'author' => $listing_author->display_name,
                        'name' => $lb_name,
                        'email' => $lb_email,
                        'phone' => $lb_phone,
                        'day' => get_post_meta( $booking_id, ESB_META_PREFIX.'nights', true ),
                        'person' => $person,
                        'listing_title' => $listing_post->post_title,
                        'room_type' => $room_title,
                        // olb booking form
                        'quantity' => get_post_meta( $booking_id, ESB_META_PREFIX.'lb_quantity', true ),
                        'date' => get_post_meta( $booking_id, ESB_META_PREFIX.'lb_date', true ),
                        'time' => get_post_meta( $booking_id, ESB_META_PREFIX.'lb_time', true ),
                        'info' => get_post_meta( $booking_id, ESB_META_PREFIX.'lb_add_info', true ),

                        'checkin'       => $checkin,
                        'checkout'      => $checkout,

                        'times'         => $bktimes,
                        'slots'         => $bkslots,
                    );

                    $temp_args = (array)apply_filters( 'listing_booking_email_args', $temp_args, $booking_id, $listing_id );

                    if(easybook_addons_get_option('emails_section_auth_booking_insert_enable') == 'yes'){
                     
                        $subj_args = array(
                            'listing_title' => $listing_post->post_title,
                        );
                        // $email_subject = easybook_addons_process_email_template(easybook_addons_get_option('emails_section_auth_booking_insert_subject'), $subj_args);
                        $email_subject = self::process_email_template(easybook_addons_get_option('emails_section_auth_booking_insert_subject'), $subj_args);
                        
                        // $email_template = easybook_addons_process_email_template(easybook_addons_get_option('emails_section_auth_booking_insert_temp'), $temp_args);
                        $email_template = self::process_email_template(easybook_addons_get_option('emails_section_auth_booking_insert_temp'), $temp_args);
                
                        // easybook_addons_do_wp_mail( $email_recipients, $email_subject, $email_template);

                        $headers = array( 'Reply-To: '.$lb_name .' ' . '<'.$lb_email.'>' );
                
                        self::do_wp_mail( $email_recipients, $email_subject, $email_template, $headers );
                    }
                    // listing author/admin emails

                    

                    if(easybook_addons_get_option('emails_section_customer_booking_insert_enable') == 'yes' && $lb_email != '' ){
                        
                        $subj_args = array(
                            'listing_title' => $listing_post->post_title,
                        );
                        // $email_subject = easybook_addons_process_email_template(easybook_addons_get_option('emails_section_customer_booking_insert_subject'), $subj_args);
                        $email_subject = self::process_email_template(easybook_addons_get_option('emails_section_customer_booking_insert_subject'), $subj_args);

                        
                        // $email_template = easybook_addons_process_email_template(easybook_addons_get_option('emails_section_customer_booking_insert_temp'), $temp_args);
                        $email_template = self::process_email_template(easybook_addons_get_option('emails_section_customer_booking_insert_temp'), $temp_args);
                        
                        $auth_replies = array();
                        foreach ($email_recipients as $em) {
                            $auth_replies[] = '<'.$em.'>';
                        }
                        
                        $headers = array( 'Reply-To: '. implode(',', $auth_replies) );
                        
                        self::do_wp_mail( $lb_email, $email_subject, $email_template, $headers);
                    }
                    // listing customer email
                }
                // end if is valid listing
            }
            // end if is valid booking

        }

    }
    public static function edit_booking_approved($booking_id = 0){
        if(is_numeric($booking_id)&&(int)$booking_id > 0){
            $booking_post = get_post($booking_id);
            if (null != $booking_post){
                $listing_id = get_post_meta( $booking_id, ESB_META_PREFIX.'listing_id', true );
                $listing_post = get_post($listing_id);
                if (null != $listing_post){
                    
                    $user_obj = get_userdata(get_post_meta( $booking_id, ESB_META_PREFIX.'user_id', true ));
                    if( $user_obj ){
                        $lb_name = $user_obj->display_name;
                        $lb_email = $user_obj->user_email;
                        $lb_phone = get_user_meta( $user_obj->ID, '_cth_phone', true);
                    }else{
                        $lb_name = get_post_meta( $booking_id, ESB_META_PREFIX.'name', true );
                        $lb_email = get_post_meta( $booking_id, ESB_META_PREFIX.'email', true );
                        $lb_phone = get_post_meta( $booking_id, ESB_META_PREFIX.'phone', true );

                    }
                    $rooms = get_post_meta( $booking_id, ESB_META_PREFIX.'rooms', true );
                    $room_title = '';
                    if (null != $rooms){
                        foreach ($rooms as $key => $room) {
                            $room_title = $room['title'];
                        }
                    } 
                    $lb_adults     = get_post_meta( $booking_id, ESB_META_PREFIX.'adults', true );
                    $lb_children  = get_post_meta( $booking_id, ESB_META_PREFIX.'children', true );
                    $person = (int)$lb_adults + (int)$lb_children;
                    $listing_author = get_user_by( 'ID', $listing_post->post_author );
                    if(easybook_addons_get_option('emails_section_customer_booking_approved_enable') == 'yes' && $lb_email != '' ){
                        
                        $subj_args = array(
                            'listing_title' => $listing_post->post_title,
                        );
                        // $email_subject = easybook_addons_process_email_template(easybook_addons_get_option('emails_section_customer_booking_approved_subject'), $subj_args);
                        $email_subject = self::process_email_template(easybook_addons_get_option('emails_section_customer_booking_approved_subject'), $subj_args);
                        $temp_args = array(
                            'author' => $listing_author->display_name,
                            'name' => $lb_name,
                            'email' => $lb_email,
                            'phone' => $lb_phone,
                            'day' => get_post_meta( $booking_id, ESB_META_PREFIX.'nights', true ),
                            'person' => $person,
                            'listing_title' => $listing_post->post_title,
                            'room_type' => $room_title,
                            // olb booking form
                            'quantity' => get_post_meta( $booking_id, ESB_META_PREFIX.'lb_quantity', true ),
                            'date' => get_post_meta( $booking_id, ESB_META_PREFIX.'lb_date', true ),
                            'time' => get_post_meta( $booking_id, ESB_META_PREFIX.'lb_time', true ),
                            'info' => get_post_meta( $booking_id, ESB_META_PREFIX.'lb_add_info', true ),
                        );
                        // $email_template = easybook_addons_process_email_template(easybook_addons_get_option('emails_section_customer_booking_approved_temp'), $temp_args);
                        $email_template = self::process_email_template(easybook_addons_get_option('emails_section_customer_booking_approved_temp'), $temp_args);
                
                        $headers = array( 'Reply-To: '.$listing_author->display_name .' ' . '<'.$listing_author->user_email.'>' );
                        self::do_wp_mail( $lb_email, $email_subject, $email_template, $headers);
                    }
                    // listing customer email
                }
                // end if is valid listing
            }
            // end if is valid booking

        }
        
    }
    public static function lclaim_change_status_to_asked_charge($claim_id = 0){
        if(is_numeric($claim_id)&&(int)$claim_id > 0){
            $claim_post = get_post($claim_id);
            if (null != $claim_post){

                $user_info = get_userdata( get_post_meta( $claim_id, ESB_META_PREFIX.'user_id', true ) );
                $listing_id = get_post_meta( $claim_id, ESB_META_PREFIX.'listing_id', true );

                $subj_args = array(
                    'id' => $claim_id,
                    'date' => current_time( get_option('date_format') ),
                );
                // $email_subject = easybook_addons_process_email_template(easybook_addons_get_option('emails_auth_claim_subject'), $subj_args);
                $email_subject = self::process_email_template(easybook_addons_get_option('emails_auth_claim_subject'), $subj_args);
                $temp_args = array(
                    'author'            => $claim_post->display_name,
                    'date'              => date_i18n( get_option( 'date_format' ), strtotime( $claim_post->post_date ) ),
                    'listing_id'        => $listing_id,
                    'listing_title'     => get_the_title( $listing_id ),
                    'listing_url'       => get_the_permalink( $listing_id ),
                    'add_to_cart'       => easybook_addons_get_add_to_cart_url($claim_id)
                );

                // $email_template = easybook_addons_process_email_template(easybook_addons_get_option('emails_auth_claim_temp'), $temp_args);
                $email_template = self::process_email_template(easybook_addons_get_option('emails_auth_claim_temp'), $temp_args);
                $headers = array( 'Reply-To: '.$listing_author->display_name .' ' . '<'.$listing_author->user_email.'>' );

                self::do_wp_mail( $user_info->user_email , $email_subject, $email_template, $headers);


            }// end check post object
        }// end check id
        
    }

    public static function chat_reply_email($reply_obj){
        // get to user
        $to_user = $reply_obj['uid'];
        if( $reply_obj['user_one'] != $reply_obj['current_user'] ){
            $to_user = $reply_obj['user_one'];
        }

        $receiver = get_userdata( $to_user );
        $replyer = get_userdata( $reply_obj['current_user'] );

        $temp_args = array(
            'receiver'          => $receiver->display_name,
            'reply_text'             => $reply_obj['reply'],
            'date'              => current_time( get_option( 'date_format' ) ),
            'replyer'           => $replyer->display_name,
        );
        $email_template = self::process_email_template( 
            easybook_addons_get_option('new_chat_temp'), 
            $temp_args
        );

        $headers = array( 'Reply-To: '.$replyer->display_name .' ' . '<'.$replyer->user_email.'>' );
        self::do_wp_mail( $receiver->user_email, 'Chat reply', $email_template, $headers);
    }

    public static function author_message_to_email($message, $datas){
        $receiver = get_userdata( $datas['to_user_id'] );
        
        $temp_args = array(
            'author'          => $receiver->display_name,
            'message'        => $datas['lmsg_message'],
            'date'              => current_time( get_option( 'date_format' ) ),
            'name'           => $datas['lmsg_name'],
            'phone'           => $datas['lmsg_phone'],
            'listing'           => get_the_title( $datas['listing_id'] ),
        );
        $email_template = self::process_email_template( 
            easybook_addons_get_option('new_auth_msg_temp'), 
            $temp_args
        );

        $headers = array( 'Reply-To: '.$datas['lmsg_name'] .' ' . '<'.$datas['lmsg_email'].'>' );
        $subject = __( 'New customer message', 'easybook-add-ons' );
        self::do_wp_mail( $receiver->user_email, $subject, $email_template, $headers);
    }

    
}
Esb_Class_Emails::init();
// $class_email = new Esb_Class_Emails();
// $class_email->init();
