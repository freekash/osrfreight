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



// get booking
add_action('wp_ajax_nopriv_easybook_addons_dasboard_booking', 'easybook_addons_easybook_addons_dasboard_booking_callback');
add_action('wp_ajax_easybook_addons_dasboard_booking', 'easybook_addons_easybook_addons_dasboard_booking_callback');

function easybook_addons_easybook_addons_dasboard_booking_callback() {   
    
    $json = array(
        'success' => false, 
        'data' => array(
            // 'POST'=>$_POST,
        ),
        'posts' => array(),
    );
    $nonce = $_POST['_nonce'];
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        $json['data']['error'] = __( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ;  
        wp_send_json($json );
    }
    $user_id = isset($_POST['user_id'])? $_POST['user_id'] : 0;  
    if( is_numeric($user_id) && $user_id > 0 ){
		$paged = 1; 
		$current_user = wp_get_current_user();
		$au_listings = get_posts( array(
		    'fields'                => 'ids',
		    'post_type'             =>  'listing', 
		    'author'                =>  $user_id,
		    'orderby'               =>  'date',
		    'order'                 =>  'DESC',
		    'post_status'           => 'publish',
		    'posts_per_page'        => -1, // no limit
		) );
		$au_listing_ids = array();
		foreach ( $au_listings as $post_ID ) {
		   $au_listing_ids[] = $post_ID;
		}
        if(isset($_POST['status']) && $_POST['status'] == 'you'){  
            $meta_queries = array(
                // show user bookings
                array(
                    'relation' => 'AND',
                    array(
                        'key'     => ESB_META_PREFIX.'user_id',
                        'value'   => $current_user->ID,
                    ),
                    array(
                        'key'     => ESB_META_PREFIX.'lb_status',
                        'value'   => 'canceled',
                        'compare' => '!='
                    )
                    
                ),
            );
        }
        if(isset($_POST['status']) && $_POST['status'] == 'customer'){
            $meta_queries = array(
                // show user bookings
                array(
                    'relation' => 'AND',
                    // array(
                    //     'key'     => ESB_META_PREFIX.'user_id',
                    //     'value'   => $current_user->ID,
                    //     'compare' => 'NOT IN'
                    // ),
                    array(
                        'key'     => $user_id,
                        'value'   => $current_user->ID,
                        'compare' => 'LIKE'
                    ),
                    
                    array(
                        'key'     => ESB_META_PREFIX.'lb_status',
                        'value'   => 'canceled',
                        'compare' => '!='
                    )
                ),
            );
            if(!empty($au_listing_ids) && $au_listing_ids != '')  {
                $meta_queries['relation'] = 'OR';
                $meta_queries[] = array(
                    'key'     => ESB_META_PREFIX.'listing_id',
                    'value'   => $au_listing_ids,
                    'compare' => 'IN',
                    'type' => 'NUMERIC',
                );
                // $meta_queries['relation'] = 'AND';
                // $meta_queries[] = array(
                //     'key'     => ,
                //     'value'   => ,
                //     'compare' => '',
                // );
            }     
        }  
		     

		$args = array(
		    'post_type'     =>  'lbooking', 
		    // 'author'        =>  $user_id, 
		    'orderby'       =>  'date',
		    'order'         =>  'DESC',
		    'paged'         => $paged,
		     // 'post_status'   =>  array( 'pending', 'draft', 'future','publish' ),
		    'post_status'   => 'publish',
		    // 'posts_per_page' => -1, // no limit
		    // 'posts_per_page' => 1,
		    'meta_query' => $meta_queries
		    
		);
		if(isset($_POST['paged']) && $_POST['paged'] != ''){
			$paged = $_POST['paged'];
			$args['paged'] = $_POST['paged'];
		}
         // if(isset($_POST['status']) && $_POST['status'] == 'you'){
         //    $args['author__not_in'] = $user_id;
         // }
		// The Query
		$posts_query = new WP_Query( $args );

		if($posts_query->have_posts()) :
				

			 while($posts_query->have_posts()) : $posts_query->the_post(); 
			 	$room = get_post( get_post_meta( get_the_ID(), ESB_META_PREFIX.'lb_room', true ) );
				$listing_post =	get_post( get_post_meta( get_the_ID(), ESB_META_PREFIX.'listing_id', true ) );
                $lb_adults     = get_post_meta( get_the_ID(), ESB_META_PREFIX.'adults', true );
                $lb_children  = get_post_meta( get_the_ID(), ESB_META_PREFIX.'children', true );
                $date_event = get_post_meta( get_the_ID(), ESB_META_PREFIX.'date_event', true );
                $qty = get_post_meta( get_the_ID(), ESB_META_PREFIX.'qty', true );
                $person = (int)$lb_adults + (int)$lb_children;

                $listing_id = get_post_meta( get_the_ID(), ESB_META_PREFIX.'listing_id', true );
                $services = get_post_meta($listing_id, ESB_META_PREFIX.'lservices', true);
                $value_serv = array();
                if(isset($services) && is_array($services) && $services!= '') {
                    $value_key_ser  = array();
                    $addservices = get_post_meta( get_the_ID(), ESB_META_PREFIX.'addservices', true );
                    if(isset($addservices) && is_array($addservices) && $addservices != ''){
                        foreach ($addservices  as $key => $item_serv) {
                            // var_dump($item_serv);
                            $value_key_ser[]  = array_search($item_serv,array_column($services,  'service_id'));
                        }
                        foreach ($value_key_ser as $key => $value) {
                             $value_serv[] = $services[$value];
                        }
                    }
                }

                $lb_name = get_post_meta( get_the_ID(), ESB_META_PREFIX.'lb_name', true );
                $lb_email = get_post_meta( get_the_ID(), ESB_META_PREFIX.'lb_email', true );
                $lb_phone = get_post_meta( get_the_ID(), ESB_META_PREFIX.'lb_phone', true );

                $user_obj = get_userdata( get_post_meta( get_the_ID(), ESB_META_PREFIX.'user_id', true ) );
                if( $user_obj ){
                    if( empty($lb_name) ) $lb_name = $user_obj->display_name;
                    if( empty($lb_email) ) $lb_email = $user_obj->user_email;
                    if( empty($lb_phone) ) $lb_phone = get_user_meta( $user_obj->ID, ESB_META_PREFIX.'phone', true);
                } 
                
			 	$json['posts'][] = (object) array(
			 		'ID'						=> get_the_ID(),
			 		'title'						=> get_the_title(),
			 		'listing_id'				=>	get_post_meta( get_the_ID(), ESB_META_PREFIX.'listing_id', true),
			 		// 'room_id'					=>	get_post_meta( get_the_ID(), ESB_META_PREFIX.'lb_room', true ),
			 		// 'room_title'				=> $room->post_title,
			 		'listing_title'				=> $listing_post->post_title,
			 		'listing_url'				=> get_the_permalink( get_post_meta( get_the_ID(), ESB_META_PREFIX.'listing_id', true )),
			 		'avatar'					=> get_avatar( $lb_email,'150','https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=150',$lb_name ),
			 		'date_book'					=> get_the_date(get_option( 'date_format' )),
			 		// 'booking-time'				=> get_post_meta( get_the_ID(), ESB_META_PREFIX.'lb_time', true ),
			 		'email'						=> $lb_email,
			 		'mail'						=> $current_user->user_email,
			 		'phone'						=> $lb_phone,
			 		'nights'                		=> get_post_meta( get_the_ID(), ESB_META_PREFIX.'nights', true ),
	                'person'                    => $person,
	                'checkin'            	=> get_post_meta( get_the_ID(), ESB_META_PREFIX.'checkin', true ),
	                'checkout'              	=> get_post_meta( get_the_ID(), ESB_META_PREFIX.'checkout', true ),
	                'status'					=> get_post_meta( get_the_ID(), ESB_META_PREFIX.'lb_status', true ),
	                'payment_method'			=> get_post_meta( get_the_ID(), ESB_META_PREFIX.'payment-method', true ),
	                'notes'						=> get_post_meta( get_the_ID(), ESB_META_PREFIX.'notes', true ),
	                'name_user'					=> $lb_name,
	                'del'						=> easybook_addons_get_option('booking_author_delete'),
                    'appc'                      => easybook_addons_get_option('booking_approved_cancel'),
                    'tickets'                   => $qty,
                    'date_event'                => $date_event,
                    'addservices'               => $value_serv,
			 	);

			endwhile;
		    $json['pagi']['range'] = 2;
		    $json['pagi']['paged'] = $paged;
		    $json['pagi']['pages'] = $posts_query->max_num_pages;

			wp_reset_postdata();

		endif;

    }else{
        $json['data']['error'] = __( 'The author id is incorrect.', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }
    $json['success'] = true;
    wp_send_json($json );

}


// delete listing
add_action('wp_ajax_nopriv_easybook_addons_delete_booking', 'easybook_addons_delete_booking_callback');
add_action('wp_ajax_easybook_addons_delete_booking', 'easybook_addons_delete_booking_callback');

function easybook_addons_delete_booking_callback() {
    $json = array(
        'success' => false,
        'data' => array(
            // 'POST'=>$_POST,
        ),
        'post'	=> array(
        	'ID'	=> 0
        )
    );
    

    $nonce = $_POST['_nonce'];
    
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        $json['data']['error'] = esc_html__( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }


    $bkid = isset($_POST['bkid'])? $_POST['bkid'] : 0;
    if(is_numeric($bkid) && (int)$bkid > 0){
	    $listing_id = get_post_meta( $bkid, ESB_META_PREFIX.'listing_id', true );
        if(get_current_user_id() != get_post_field('post_author', $listing_id) || easybook_addons_get_option('booking_author_delete') != 'yes' ){
            $json['data']['error'] = __( "You don't have permission to approve this booking", 'easybook-add-ons' );
            $json['data']['user'] = get_current_user_id();
            $json['data']['author'] = get_post_field('post_author', $listing_id);
            wp_send_json($json );
        }

        $force_delete = easybook_addons_get_option('booking_del_trash') == 'yes' ? false : true;
        $deleted_post = wp_delete_post( $bkid, $force_delete );//move to trash
        if($deleted_post){
           	$json['post'] = $deleted_post;
            $json['success'] = true;
        }else{
            $json['data']['error'] = esc_html__( 'Delete booking failure', 'easybook-add-ons' ) ;
        }
    }else{
        // $json['success'] = false;
        $json['data']['error'] = esc_html__( 'The post id is incorrect.', 'easybook-add-ons' ) ;
    }

    wp_send_json($json );

}
// cancel booking
add_action('wp_ajax_nopriv_easybook_addons_cancel_booking', 'easybook_addons_cancel_booking_callback');
add_action('wp_ajax_easybook_addons_cancel_booking', 'easybook_addons_cancel_booking_callback');

function easybook_addons_cancel_booking_callback() {
    $json = array(
        'success' => false,
        'data' => array(
            // 'POST'=>$_POST,
        ),
        'post'	=> array(
        	'ID'	=> 0
        ),
    );
    

    $nonce = $_POST['_nonce'];
    
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        $json['success'] = false;
        $json['data']['error'] = esc_html__( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }


    $bkid = $_POST['bkid'];
    if(is_numeric($bkid) && (int)$bkid > 0){
        $current_user = wp_get_current_user(); 
        if( $current_user->ID  != get_post_meta( $bkid, ESB_META_PREFIX.'user_id', true ) ){
            $json['data'][] = __( "You don't have permission to this booking", 'easybook-add-ons' );
            wp_send_json($json );
        }
        if ( !update_post_meta( $bkid, ESB_META_PREFIX.'lb_status',  'canceled'  ) ) {
            $json['data'][] = sprintf(__('Insert booking %s meta failure or existing meta value','easybook-add-ons'),'lb_status');
            
        }else{
            $json['post'] = array(
                'ID'    => $bkid,
                'status' => 'canceled',
            );
            $json['success'] = true;
        }
    }else{
        
        $json['data']['error'] = esc_html__( 'The post id is incorrect.', 'easybook-add-ons' ) ;
    }

    wp_send_json($json );

}
// approve booking
add_action('wp_ajax_nopriv_easybook_addons_approve_booking', 'easybook_addons_approve_booking_callback');
add_action('wp_ajax_easybook_addons_approve_booking', 'easybook_addons_approve_booking_callback');

function easybook_addons_approve_booking_callback() {
    $json = array(
        'success' => false,
        'data' => array(
            // 'POST'=>$_POST,
        ),
        'post' => array(
        )
    );

    // $json['success'] = true;
    // $json['post'] = array(
    //     'ID'    => $_POST['bkid'],
    //     'status' => 'completed',
    // );
    
    // wp_send_json($json);

    $nonce = $_POST['_nonce'];
    
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        $json['success'] = false;
        $json['data']['error'] = esc_html__( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }


    $bkid = $_POST['bkid'];
    if(is_numeric($bkid) && (int)$bkid > 0){
        $listing_id = get_post_meta( $bkid, ESB_META_PREFIX.'listing_id', true );
        if(get_current_user_id() != get_post_field('post_author', $listing_id) ){
            $json['data'][] = __( "You don't have permission to approve this booking", 'easybook-add-ons' );
            $json['data']['user'] = get_current_user_id();
            $json['data']['author'] = get_post_field('post_author', $listing_id);
            wp_send_json($json );
        }

        
        if ( !update_post_meta( $bkid, ESB_META_PREFIX.'lb_status',  'completed'  ) ) {
                $json['data'][] = sprintf(__('Insert booking %s meta failure or existing meta value','easybook-add-ons'),'lb_status');
            }else{
                $json['success'] = true;
                $json['post'] = array(
                	'ID'	=> $bkid,
                	'status' => 'completed',
                );
                // push customer notification
                $customer = get_user_by( 'email', get_userdata(get_post_meta( get_the_ID(), ESB_META_PREFIX.'user_id', true ))->user_email);
                // if ( ! empty( $customer ) ) {
                //     easybook_addons_user_add_notification($customer->ID, array(
                //         'type' => 'booking_approved',
                //         'message' => sprintf(__( 'Your booking for <strong>%s</strong> listing has been approved.', 'easybook-add-ons' ), get_post_field('post_title', $listing_id) )
                //     ));
                // }
                do_action( 'easybook_addons_edit_booking_approved', $bkid );

            }
            
    }else{
        
        $json['data']['error'] = esc_html__( 'The booking id is incorrect.', 'easybook-add-ons' ) ;
    }

    wp_send_json($json );

}