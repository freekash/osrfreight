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

   

// submit a author message
// add_action('wp_ajax_nopriv_easybook_addons_lauthor_message', 'easybook_addons_lauthor_message_chat_callback');
// add_action('wp_ajax_easybook_addons_lauthor_message', 'easybook_addons_lauthor_message_chat_callback');

function easybook_addons_lauthor_message_chat_callback() {
    global $wpdb;
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

    $authid = isset($_POST['authid'])? $_POST['authid'] : 0;
    if( is_numeric($authid) && $authid > 0 ){
        $from_user_id = 0;
        if(isset($_POST['lmsg_name'])&&isset($_POST['lmsg_email']) ){
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

            $user_id = wp_insert_user( $new_user_data );

            if ( ! is_wp_error( $user_id ) ) {
                // send login
                if(easybook_addons_get_option('new_user_email') != 'none') wp_new_user_notification( $user_id, null, easybook_addons_get_option('new_user_email') );
                if(easybook_addons_get_option('register_auto_login') == 'yes') easybook_addons_auto_login_new_user( $user_id );

                
            }else{
                $json['data']['error'] = $user_id->get_error_message() ;
                wp_send_json($json );
            }
            $from_user_id = $user_id;
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

            // insert new chat contact
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
                // insert reply row
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
                        do_action( 'cth_lauthor_message' );
                    }else{
                        $json['data']['error'] = __( 'Can not create chat message.', 'easybook-add-ons' );
                        wp_send_json($json );
                    }
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


// submit chat reply
add_action('wp_ajax_nopriv_easybook_addons_chat_reply', 'easybook_addons_chat_reply_callback');
add_action('wp_ajax_easybook_addons_chat_reply', 'easybook_addons_chat_reply_callback');

function easybook_addons_chat_reply_callback() {
    global $wpdb;

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
    $user_id_checked = 0;
    // if loggined user
    if(isset($_POST['user_id']) && $_POST['user_id']){
        if( get_current_user_id() != $_POST['user_id'] ){
            // incorrect logged in user
            $json['data']['error'] = __( 'Incorrect logged in user.', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }

        $user_id_checked = get_current_user_id();

    }else{ // for guest message

        $json['data']['error'] = __( 'Invalid send user', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }

    // check for to user id (receive user)
    $to_user_id_checked = 0;
    if(isset($_POST['touid']) && $_POST['touid']){
        $to_user_id_checked = $_POST['touid'];
    }else{ // for guest message
        $json['data']['error'] = __( 'You have no contact to chat.<br />Please use chat form on single listing page to begin chat with author.', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }

    $chat_table = $wpdb->prefix . 'cth_chat';
    $chat_reply_table = $wpdb->prefix . 'cth_chat_reply';

    $time = time();
    $ip = $_SERVER['REMOTE_ADDR'];

    if($user_id_checked != $to_user_id_checked){
        // check for chat
        $chat_id_checked = isset($_POST['cid'])? $_POST['cid'] : 0;
        $chatids = $wpdb->get_col( "SELECT c_id FROM $chat_table WHERE ((user_one ='$user_id_checked' AND user_two ='$to_user_id_checked') OR (user_one ='$to_user_id_checked' AND user_two ='$user_id_checked')) AND c_id = '$chat_id_checked' ");
        
        if(!$chatids){
            // create new chat row

            $result = $wpdb->insert( 
                $chat_table, 
                array( 
                    
                    'user_one'  => $user_id_checked, 
                    'user_two'  => $to_user_id_checked, 
                    'ip'        => $ip, 
                    'time'      => $time, 
                ) 
            );
            // end inshert chat
            // https://codex.wordpress.org/Class_Reference/wpdb#INSERT_row
            if($result != false){
                $chat_id_checked = $wpdb->insert_id;
            }
        }
    }
    // user_id
    // cid
    // touid
    $reply_insert_id = 0;
    if($chat_id_checked){
        $result = $wpdb->insert( 
            $chat_reply_table, 
            array( 
                
                'user_id_fk'    => $user_id_checked, 
                'reply'         => $_POST['reply_text'], 
                'ip'            => $ip, 
                'time'          => $time, 
                'c_id_fk'       => $chat_id_checked
            ) 
        );
        if($result != false){
            $reply_insert_id = $wpdb->insert_id;
        }
    }

    $reply_user = get_userdata( $user_id_checked );

    $reply_obj = array();

    $reply_obj['cid'] = $chat_id_checked;
    $reply_obj['crid'] = $reply_insert_id;
    $reply_obj['crtime'] = $time;
    $reply_obj['reply'] = $_POST['reply_text'];
    $reply_obj['uid'] = $user_id_checked;
    $reply_obj['display_name'] = $reply_user->display_name;
    $reply_obj['user_email'] = $reply_user->user_email;
    $reply_obj['user_one'] = 0;


    $reply_obj['avatar'] = get_avatar($reply_user->user_email,'150','https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=150', $reply_user->display_name );
    $reply_obj['avatar_url'] = get_avatar_url( $reply_user->user_email, array('size'=>150, 'default'=>'https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=150') );
        
    $reply_obj['time'] = sprintf(__( '%s <span>%s</span>', 'easybook-add-ons' ), date_i18n( get_option('date_format'), easybook_addons_gmt_to_local_timestamp($time) ), date_i18n( get_option('time_format'), easybook_addons_gmt_to_local_timestamp($time) ));
    $reply_obj['current_user'] = get_current_user_id();



    $reply_post = $wpdb->get_results( $wpdb->prepare( 
            "
            SELECT R.cr_id AS crid,R.time AS crtime,R.reply,U.ID AS uid,U.display_name,U.user_email, C.user_one, C.c_id AS cid
            FROM $chat_reply_table R, $wpdb->users U, $chat_table C
            WHERE U.ID = R.user_id_fk AND C.c_id = R.c_id_fk AND R.cr_id = %s
            ",
            $reply_insert_id
        )
    );
    if ( $reply_post ){
        $reply_data  = reset($reply_post);

        $reply_obj['crid'] = $reply_data->crid;
        $reply_obj['crtime'] = $reply_data->crtime;
        $reply_obj['reply'] = $reply_data->reply;
        $reply_obj['uid'] = $reply_data->uid;
        $reply_obj['display_name'] = $reply_data->display_name;
        $reply_obj['user_email'] = $reply_data->user_email;
        $reply_obj['user_one'] = $reply_data->user_one;


        $reply_obj['avatar'] = get_avatar($reply_data->user_email,'150','https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=150', $reply_data->display_name );
        $reply_obj['avatar_url'] = get_avatar_url( $reply_data->user_email, array('size'=>150, 'default'=>'https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=150') );
       
        $reply_obj['time'] = sprintf(__( '%s <span>%s</span>', 'easybook-add-ons' ), date_i18n( get_option('date_format'), easybook_addons_gmt_to_local_timestamp($reply_data->crtime) ), date_i18n( get_option('time_format'), easybook_addons_gmt_to_local_timestamp($reply_data->crtime) ));
        $reply_obj['current_user'] = get_current_user_id();

        do_action( 'cth_chat_reply_after', $reply_obj  );

    }
    $json['reply'] = $reply_obj;
    $json['success'] = true;
    wp_send_json( $json );
}

// get replies
add_action('wp_ajax_nopriv_easybook_addons_chat_replies', 'easybook_addons_chat_replies_callback');
add_action('wp_ajax_easybook_addons_chat_replies', 'easybook_addons_chat_replies_callback');

function easybook_addons_chat_replies_callback() {
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
    $json['replies'] = array();
    if(isset($_POST['cid']) && $_POST['cid']){
        // set first reply for new user chat
        if($_POST['cid'] == 'new' ){
            // for listing author data 
            if(isset($_POST['touid']) && isset($_POST['repliesCount']) && $_POST['repliesCount'] == 1){
                $listing_author = get_userdata( $_POST['touid'] );
                $time = time();
                $first_reply = array();
                $first_reply['crid'] = 1;
                $first_reply['crtime'] = $time;
                $first_reply['reply'] = sprintf(__( 'Hello, I am %s.<br />May I help you?', 'easybook-add-ons' ), $listing_author->display_name );
                $first_reply['uid'] = $listing_author->ID;
                $first_reply['display_name'] = $listing_author->display_name;
                $first_reply['user_email'] = $listing_author->user_email;
                $first_reply['user_one'] = get_current_user_id();


                $first_reply['avatar'] = get_avatar($listing_author->user_email,'150','https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=150', $listing_author->display_name );
                $first_reply['avatar_url'] = get_avatar_url( $listing_author->user_email, array('size'=>150, 'default'=>'https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=150') );

                $first_reply['time'] = sprintf(__( '%s <span>%s</span>', 'easybook-add-ons' ), date_i18n( get_option('date_format'), easybook_addons_gmt_to_local_timestamp($time) ), date_i18n( get_option('time_format'), easybook_addons_gmt_to_local_timestamp($time) ));
                $first_reply['current_user'] = get_current_user_id();
                $json['replies'] = array($first_reply);
            }else{
                $json['replies'] = array();
            }
        }else{
            // modify get replies clauses
            add_filter( 'ctb_chat_replies_clauses', function($clauses){
                // get new latest replies
                if( isset($_POST['lastRID']) && $_POST['lastRID'] ){
                    $clauses['wheres'] .= " AND R.cr_id > {$_POST['lastRID']}";
                }
                // get 5 prev replies
                if( isset($_POST['firstRID']) && $_POST['firstRID'] ){
                    $clauses['wheres'] .= " AND R.cr_id < {$_POST['firstRID']}";
                    // $clauses['orders'] = " ORDER BY R.cr_id DESC";
                    if(easybook_addons_get_option('messages_prev_load') > 0){
                        $clauses['limits'] = easybook_addons_get_option('messages_prev_load');
                    }
                }
                return $clauses;
            } );
            
            $json['replies'] = easybook_addons_get_chat_replies($_POST['cid']);
        }
            
    }else{
        $json['data']['error'] = __( 'Invalid chat contact.<br />Please use chat form on single listing page to begin chat with author.', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }

    $json['success'] = true;
    wp_send_json($json );
}

// get chat contact for current user - create new on to site admin if not existing

add_action('wp_ajax_nopriv_easybook_addons_chat_contacts', 'wp_ajax_nopriv_easybook_addons_chat_contacts_callback');
add_action('wp_ajax_easybook_addons_chat_contacts', 'wp_ajax_nopriv_easybook_addons_chat_contacts_callback');
function wp_ajax_nopriv_easybook_addons_chat_contacts_callback(){
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

    $user_id = isset($_POST['for'])? $_POST['for'] : 0;
    
    $json['chat'] = easybook_addons_get_chats($user_id);

    $json['success'] = true;
    wp_send_json( $json );
}

function easybook_addons_get_chats($user_id = 0){
    global $wpdb;

    if(!$user_id){
        // return false when no user
        if(!is_user_logged_in()) return false;
        $user_id = get_current_user_id();
    }

    $chat_table = $wpdb->prefix . 'cth_chat';
    $chat_reply_table = $wpdb->prefix . 'cth_chat_reply';
    $user_chats = array();
    $newly_created = false;

    $chats = $wpdb->get_results(
        "
        SELECT u.ID AS uid,c.c_id AS cid,c.time AS ctime,u.display_name,u.user_email,c.user_one,(CASE WHEN c.user_one ='$user_id' THEN c.user_two ELSE c.user_one END) AS touid
        FROM $chat_table c, $wpdb->users u
        WHERE 
            CASE 
                WHEN c.user_one = '$user_id'
                    THEN c.user_two = u.ID
                WHEN c.user_two = '$user_id'
                    THEN c.user_one= u.ID
            END 
        AND ( c.user_one ='$user_id' OR c.user_two ='$user_id' )
        ORDER BY c.c_id DESC
        "
    );

    // create new to site admin if not exists
    $time = time();
    $ip = $_SERVER['REMOTE_ADDR'];
    $newly_created_chat = 0;
    $active_chat = 0;
    $touid = 0;
    $fuid = 0;
    $replies = array();



    if(!$chats){
        $admin_user = easybook_addons_get_option('chat_default_contact');
        if($admin_user == '0'){
            $add_user = get_users(array(
                'role'      => 'Administrator',
                'number'    => 1,
                // 'fields'    => 'ID'
            ));
            $admin_user = $add_user[0]->ID;
        }
        $result = $wpdb->insert( 
            $chat_table, 
            array( 
                
                'user_one'  => $admin_user, 
                'user_two'  => $user_id, 
                'ip'        => $ip, 
                'time'      => $time, 
            ) 
        );
        // end inshert chat
        // https://codex.wordpress.org/Class_Reference/wpdb#INSERT_row
        if($result != false){
            $newly_created = true;
            $newly_created_chat = $wpdb->insert_id;

            // add init message
            $result = $wpdb->insert( 
                $chat_reply_table, 
                array( 
                    
                    'user_id_fk'    => $admin_user, 
                    'reply'         => sprintf(__( 'Hello, I am %s.<br />May I help you?', 'easybook-add-ons' ), __( 'the site admin', 'easybook-add-ons' ) ), 
                    'ip'            => '0', 
                    'time'          => $time, 
                    'c_id_fk'       => $newly_created_chat
                ) 
            );
            // if($result != false){
            //     $reply_insert_id = $wpdb->insert_id;
            // }

            $chats = $wpdb->get_results(
                "
                SELECT u.ID AS uid,c.c_id AS cid,c.time AS ctime,u.display_name,u.user_email,c.user_one,(CASE WHEN c.user_one ='$user_id' THEN c.user_two ELSE c.user_one END) AS touid
                FROM $chat_table c, $wpdb->users u
                WHERE 
                    CASE 
                        WHEN c.user_one = '$user_id'
                            THEN c.user_two = u.ID
                        WHEN c.user_two = '$user_id'
                            THEN c.user_one= u.ID
                    END 
                AND ( c.user_one ='$user_id' OR c.user_two ='$user_id' )
                ORDER BY c.c_id DESC
                "
            );
            
        }
    }
        
    if ( $chats ){
        foreach ( $chats as $key => $chat ){
            // get active id
            if($key === 0){
                $active_chat = $chat->cid;
                $touid = $chat->touid;
                $fuid = $chat->user_one;

                $replies = easybook_addons_get_chat_replies($chat->cid);
            }
            $last_reply = $wpdb->get_results( $wpdb->prepare( 
                    "
                    SELECT R.cr_id AS crid,R.time AS crtime,R.reply 
                    FROM $chat_reply_table R
                    WHERE R.c_id_fk = %s 
                    ORDER BY R.cr_id DESC LIMIT 1
                    ",
                    $chat->cid
                )
            );

            $chat->date = date_i18n( get_option('date_format'), easybook_addons_gmt_to_local_timestamp($chat->ctime) );

            $last_reply_result = (object) array();

            if ( $last_reply ){
                $last_reply_result = reset($last_reply);
                $last_reply_result->date = date_i18n( get_option('date_format'), easybook_addons_gmt_to_local_timestamp($last_reply_result->crtime) );
            }

            $last_reply_result->avatar = get_avatar($chat->user_email,'150','https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=150', $chat->display_name );
            $last_reply_result->avatar_url = get_avatar_url( $chat->user_email, array('size'=>150, 'default'=>'https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=150') );
                
            $user_chats[] = (object) array_merge((array)$chat, (array)$last_reply_result);

        }   
    }

    return array(
        'active'            => $active_chat,
        'touid'             => $touid,
        'fuid'              => $fuid,
        'contacts'          => $user_chats,
        'replies'           => $replies
    );
    return $user_chats;

}

function easybook_addons_get_chat_replies($chat_id = 0){
    global $wpdb;

    if(!$chat_id || !is_numeric($chat_id)) return false;

    $chat_table = $wpdb->prefix . 'cth_chat';
    $chat_reply_table = $wpdb->prefix . 'cth_chat_reply';

    $selects = "SELECT R.cr_id AS crid,R.time AS crtime,R.reply,U.ID AS uid,U.display_name,U.user_email, C.user_one,C.c_id AS cid";
    $froms = "FROM $chat_reply_table R, $wpdb->users U, $chat_table C";
    $wheres = $wpdb->prepare( "WHERE R.user_id_fk = U.ID AND C.c_id = R.c_id_fk AND R.c_id_fk = %s", $chat_id);
    $orders = "ORDER BY R.cr_id DESC"; // get last replies then reverse using php
    if(easybook_addons_get_option('messages_first_load') > 0){
        $limits = easybook_addons_get_option('messages_first_load');
    }

    $pieces = array( 'selects', 'froms', 'wheres', 'orders', 'limits' );


    $clauses = (array) apply_filters_ref_array( 'ctb_chat_replies_clauses', array( compact( $pieces ) ) );

    $selects = isset( $clauses[ 'selects' ] ) ? $clauses[ 'selects' ] : '';
    $froms = isset( $clauses[ 'froms' ] ) ? $clauses[ 'froms' ] : '';
    $wheres = isset( $clauses[ 'wheres' ] ) ? $clauses[ 'wheres' ] : '';
    $orders = isset( $clauses[ 'orders' ] ) ? $clauses[ 'orders' ] : '';
    $limits = isset( $clauses[ 'limits' ] ) ? $clauses[ 'limits' ] : '';

    if($limits != '') $limits = "LIMIT {$limits}";

    
    $replies = $wpdb->get_results( $selects . ' ' . $froms . ' ' . $wheres . ' ' . $orders . ' ' . $limits );

    $results = array();

    if($replies){
        // $replies = array_reverse($replies);
        foreach (array_reverse($replies) as $reply) {
            $reply->avatar =  get_avatar($reply->user_email,'150','https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=150', $reply->display_name );
            $reply->avatar_url = get_avatar_url( $reply->user_email, array('size'=>150, 'default'=>'https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=150') );
            $reply->time = sprintf(__( '%s <span>%s</span>', 'easybook-add-ons' ), date_i18n( get_option('date_format'), easybook_addons_gmt_to_local_timestamp($reply->crtime) ), date_i18n( get_option('time_format'), easybook_addons_gmt_to_local_timestamp($reply->crtime) ));
            $reply->current_user = get_current_user_id();
            $results[] = $reply;
        }
        
    }
    return $results;

}

function easybook_addons_delete_chat_user( $user_id ) {
    global $wpdb;

    $chat_table = $wpdb->prefix . 'cth_chat';
    $chat_reply_table = $wpdb->prefix . 'cth_chat_reply';

    $wpdb->query( 
        $wpdb->prepare( 
            "
            DELETE FROM $chat_reply_table
            WHERE c_id_fk = (SELECT c_id FROM $chat_table WHERE user_one = %d OR user_two = %d)
            ",
            $user_id,
            $user_id
        )
    );

    $wpdb->query( 
        $wpdb->prepare( 
            "
            DELETE FROM $chat_table
            WHERE user_one = %d OR user_two = %d
            ",
            $user_id,
            $user_id
        )
    );

    $earning_table = $wpdb->prefix . 'cth_austats';

    $wpdb->query( 
        $wpdb->prepare( 
            "
            DELETE FROM $earning_table
            WHERE author_id = %d
            ",
            $user_id
        )
    );

}
add_action( 'delete_user', 'easybook_addons_delete_chat_user' );
