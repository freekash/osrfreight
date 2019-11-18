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



function easybook_addons_notification_entity($type = ''){
	$entities = array(
		'listing_submitted'	=> array(
			'entity_type_id'	=> 1,
			// 'entity_id'			=> 1,
			'desc'				=> 'This notification is sent when a listing is created.',
			'noti_msg'			=> 'User A created a listing.',
		),
		'edit_profile'	=> array(
			'entity_type_id'	=> 2,
			// 'entity_id'			=> 2,
			'desc'				=> 'This notification is sent when user profile edited.',
			'noti_msg'			=> _x( '<i class="far fa-check ficon"></i> Your profile has been successfully edited.','Edit profile activity message template', 'easybook-add-ons' ),
		),

        'role_change'  => array(
            'entity_type_id'    => 3,
            // 'entity_id'          => 2,
            'desc'              => 'This notification is sent when user role change by membership.',
            'noti_msg'          => _x( '<i class="far fa-check ficon"></i> Your role is changed to Listing Author so you can now submit listing.','Listing author role changed activity message template', 'easybook-add-ons' ),
        ),

        'order_completed'  => array(
            'entity_type_id'    => 4,
            // 'entity_id'          => 2,
            'desc'              => 'This notification is sent when author subscription order completed.',
            'noti_msg'          => _x( '<i class="far fa-check ficon"></i> Your subscription order has marked as completed. So you can submit listings now.','Subscription completed activity message template', 'easybook-add-ons' ),
        ),

        'new_order'  => array(
            'entity_type_id'    => 8,
            // 'entity_id'          => 2,
            'desc'              => 'New order',
            'noti_msg'          => _x( '<i class="far fa-check ficon"></i> Your subscription order has been received and will be checked soon.','New order notification', 'easybook-add-ons' ),
        ),

        'new_invoice'  => array(
            'entity_type_id'    => 5,
            // 'entity_id'          => 2,
            'desc'              => 'This notification is sent when new invoice received.',
            'noti_msg'          => _x( '<i class="far fa-check ficon"></i> You have a new invoice. ID: {post_id}','Subscription completed activity message template', 'easybook-add-ons' ),
        ),
        'booking_approved'  => array(
            'entity_type_id'    => 6,
            // 'entity_id'          => 2,
            'desc'              => 'Booking approved notification',
            'noti_msg'          => _x( '<i class="far fa-check ficon"></i> Your booking for <strong>{post_title}</strong> listing has been approved.','Booking approved notification', 'easybook-add-ons' ),
        ),
        'new_booking'  => array(
            'entity_type_id'    => 7,
            // 'entity_id'          => 2,
            'desc'              => 'New booking notification',
            'noti_msg'          => _x( '<i class="far fa-check ficon"></i> <strong>{actor}</strong> booked your <a href="{post_link}" target="_blank">{post_title}</a> listing','New booking notification', 'easybook-add-ons' ),
        ),

        

        

		'bookmarked'	=> array(
			'entity_type_id'	=> 9,
			// 'entity_id'			=> 2,
			'desc'				=> 'This notification is sent to user who bookmark listing.',
			'noti_msg'			=> _x( '<i class="far fa-heart ficon"></i> You have bookmarked <a href="{post_link}" target="_blank">{post_title}</a> listing!','User bookmark activity message template to user', 'easybook-add-ons' ),
		),

		'new_bookmark'	=> array(
			'entity_type_id'	=> 10,
			// 'entity_id'			=> 2,
			'desc'				=> 'This notification is sent to listing author when user bookmark his listing.',
			'noti_msg'			=> _x( '<i class="far fa-heart ficon"></i> <strong>{actor}</strong> bookmarked your <a href="{post_link}" target="_blank">{post_title}</a> listing!','User bookmark activity message template to listing author', 'easybook-add-ons' ),
		),

        'withdrawal_new'  => array(
            'entity_type_id'    => 11,
            // 'entity_id'          => 2,
            'desc'              => 'New withdrawal notification',
            'noti_msg'          => _x( '<i class="fas fa-money-check-alt ficon"></i> Your withdrawal request has been received. It will be proccessed soon.','New withdrawal notification', 'easybook-add-ons' ),
        ),

        'listing_expired'  => array(
            'entity_type_id'    => 12,
            'desc'              => 'Listing expired notification',
            'noti_msg'          => _x( '<i class="fas fa-money-check-alt ficon"></i> Your <a href="{post_link}" target="_blank">{post_title}</a> listing has expired. Please renew membership subscription to get it live back.','Listing expired notification template', 'easybook-add-ons' ),
        ),

        'new_ad'  => array(
            'entity_type_id'    => 13,
            'desc'              => 'new listing ad notification',
            'noti_msg'          => _x( '<i class="fas fa-money-check-alt ficon"></i> Your listing AD is added. Please follow the link bellow to complete payment<br /><a href="{post_link}" target="_blank">Pay now</a>','New Listing ad notification template', 'easybook-add-ons' ),
        ),

        'ad_approved'  => array(
            'entity_type_id'    => 14,
            'desc'              => 'Listing ad approved notification',
            'noti_msg'          => _x( '<i class="far fa-check ficon"></i> Ad for your <a href="{post_link}" target="_blank">{post_title}</a> listing is approved.','Listing ad approved notification template', 'easybook-add-ons' ),
        ),

        'membership_will_expired'  => array(
            'entity_type_id'    => 15,
            'desc'              => 'Membership will expire notification',
            'noti_msg'          => _x( '<i class="fal fa-exclamation-triangle"></i> Your membership subscription will expire within 5 days. Please renew it.','Membership expired notification template', 'easybook-add-ons' ),
        ),

        'ad_will_expired'  => array(
            'entity_type_id'    => 16,
            'desc'              => 'AD will expire notification',
            'noti_msg'          => _x( '<i class="fal fa-exclamation-triangle"></i> Your AD for a listing will expire within 5 days.','AD will expire notification template', 'easybook-add-ons' ),
        ),

        'membership_expired'  => array(
            'entity_type_id'    => 17,
            'desc'              => 'Membership expired notification',
            'noti_msg'          => _x( '<i class="fal fa-exclamation-triangle"></i> Your membership subscription has expired. Please renew it.','Membership expired notification template', 'easybook-add-ons' ),
        ),

        
        

	);
	if($type != '' && isset($entities[$type])) return $entities[$type];
	$entities_val = array();
	foreach ($entities as $type => $entity) {
		$entity['type_name'] = $type;
		$entities_val[$entity['entity_type_id']] = $entity;
	}
	return $entities_val;
}

function easybook_addons_add_user_notification( $user_id = 0, $message = array() ){
    $user = get_user_by('ID', $user_id);
    if(!$user) return;
    // if(!isset($message['type']) || !isset($message['message'])) return;
    if( !isset($message['type']) ) return;
    $noti_entity = easybook_addons_notification_entity($message['type']);
    if( !isset($noti_entity['entity_type_id']) ) return;

    if( !isset($message['entity_id']) ) $message['entity_id'] = 0; // set default object if not exist
    $notifier_id = $actor_id = $user->ID;
    if( isset($message['notifier_id']) ) $notifier_id =  $message['notifier_id']; // set default object if not exist
    if( isset($message['actor_id']) ) $actor_id =  $message['actor_id']; // set default object if not exist

    global $wpdb;

    $notification_object_table = $wpdb->prefix . 'cth_noti_obj';
	$notification_table = $wpdb->prefix . 'cth_noti';
	$notification_change_table = $wpdb->prefix . 'cth_noti_change';

	$time = time();
	// insert record to notification_object table
    $noti_obj_result = $wpdb->insert( 
        $notification_object_table, 
        array( 
            'entity_type_id'  => $noti_entity['entity_type_id'], 
            'entity_id'  => $message['entity_id'], 
            'time'      => $time,
            'status'      => 1 
        ) 
    );
    if($noti_obj_result != false){
    	$newly_created_noti = $wpdb->insert_id;
    	// insert record to notification_change table
        $noti_result = $wpdb->insert( 
            $notification_table, 
            array( 
            	'notification_obj_id'       => $newly_created_noti,
                'notifier_id'				=> $notifier_id,
                'status'      				=> 1 
            ) 
        );
        // insert record to notification_change table
        $noti_change_result = $wpdb->insert( 
            $notification_change_table, 
            array( 
            	'notification_obj_id'       => $newly_created_noti,
                'actor_id'					=> $actor_id,
                'status'      				=> 1 
            ) 
        );

    }
}

function easybook_addons_get_user_notifications( $user_id = 0, $type = '' ){
	global $wpdb;

    $notification_object_table = $wpdb->prefix . 'cth_noti_obj';
	$notification_table = $wpdb->prefix . 'cth_noti';
	$notification_change_table = $wpdb->prefix . 'cth_noti_change';

	$notifications = $wpdb->get_results(
        "
        SELECT n_o.id, n_o.entity_id, n_o.entity_type_id, n_o.time, n.notifier_id, n_c.actor_id
        FROM $notification_object_table n_o
        INNER JOIN $notification_table n
        INNER JOIN $notification_change_table n_c 
        WHERE n.notification_obj_id = n_o.id AND n_c.notification_obj_id = n_o.id AND n.notifier_id = $user_id
        ORDER BY n_o.id DESC LIMIT 0, 10");
    $notis = array();
	if($notifications){
		$entities = easybook_addons_notification_entity();
		foreach ($notifications as $noti) {
			if(isset($entities[$noti->entity_type_id])){
				$entity = $entities[$noti->entity_type_id];
				$actor = get_userdata($noti->actor_id);
				$entity_post = false;
				switch ($entity['type_name']) {
					case 'bookmarked':
                    case 'new_bookmark':
					case 'new_invoice':
					case 'booking_approved':
                    case 'new_booking':
					case 'new_order':
                    case 'listing_expired':
                    case 'ad_approved':
						$entity_post = get_post($noti->entity_id);
						break;
				}
				$message_vars = array(
					'actor'	=> $actor ? $actor->display_name : _x( 'Someone', 'Activity no actor default name', 'easybook-add-ons' ),
					'post_link'	=> $entity_post ? get_permalink( $entity_post ) : null,
                    'post_title'    => $entity_post ? $entity_post->post_title : null,
					'post_id'	=> $entity_post ? $entity_post->ID : null,
				);

                if($entity['type_name'] == 'new_ad'){
                    $message_vars['post_link'] = easybook_addons_add_to_cart_link($noti->entity_id);
                }

				$noti->message = Esb_Class_Emails::process_email_template($entity['noti_msg'], $message_vars);
				$noti->time = date_i18n( sprintf(_x( '%1$s %2$s', 'Dashboard activity time format', 'easybook-add-ons' ), get_option( 'date_format' ), get_option( 'time_format' ) )  , $noti->time, false );
				$notis[] = $noti;
			}
		}
	}
    return $notis;
}
function easybook_addons_delete_user_notification( $notification_id = 0 ){
	if( is_numeric($notification_id) && $notification_id > 0 ){ 
		global $wpdb;

	    $notification_object_table = $wpdb->prefix . 'cth_noti_obj';
		$notification_table = $wpdb->prefix . 'cth_noti';
		$notification_change_table = $wpdb->prefix . 'cth_noti_change';

	    $del_noti_val = $wpdb->query( 
	        $wpdb->prepare( 
	            "
	            DELETE FROM $notification_table
	            WHERE notification_obj_id = %d
	            ",
	            $notification_id
	        )
	    );
	    $del_noti_change_val = $wpdb->query( 
	        $wpdb->prepare( 
	            "
	            DELETE FROM $notification_change_table
	            WHERE notification_obj_id = %d
	            ",
	            $notification_id
	        )
	    );
	    $del_noti_obj_val = $wpdb->query( 
	        $wpdb->prepare( 
	            "
	            DELETE FROM $notification_object_table
	            WHERE id = %d
	            ",
	            $notification_id
	        )
	    );

	    if($del_noti_val && $del_noti_change_val && $del_noti_obj_val){
	    	return $notification_id;
	    }else{
	    	return false;
	    }

	}
}
