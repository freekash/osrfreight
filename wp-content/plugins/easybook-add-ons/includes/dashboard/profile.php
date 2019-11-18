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



// update profile
add_action('wp_ajax_nopriv_easybook_addons_get_profile', 'easybook_addons_get_profile_callback');
add_action('wp_ajax_easybook_addons_get_profile', 'easybook_addons_get_profile_callback');

function easybook_addons_get_profile_callback() {
    $json = array(
        'success' => false,
        'data' => array(
             // 'POST'=>$_POST,
            // 'FILES'=>$_FILES,
        )
    );
    // wp_send_json($json );

    $nonce = $_POST['_nonce'];
    
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        $json['data']['error'] = esc_html__( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ; 
        wp_send_json($json );
    }

    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : 0;

    if($user_id == get_current_user_id()){
        $user_object = wp_get_current_user();
        $user_data = array( 
            'first_name'        => $user_object->first_name,
            'last_name'        => $user_object->last_name,
            'display_name'        => $user_object->display_name,
            'user_url'        => $user_object->user_url,
            'description'       => $user_object->description,
            'address'       => get_user_meta( $user_id, ESB_META_PREFIX.'address' , true),
            'phone'       => get_user_meta( $user_id, ESB_META_PREFIX.'phone' , true),
            'socials'       => get_user_meta( $user_id, ESB_META_PREFIX.'socials' , true),
            'custom_avatar'       => get_user_meta( $user_id, ESB_META_PREFIX.'custom_avatar' , true),
            'email'       => get_user_meta( $user_id, ESB_META_PREFIX.'email' , true),
            'registered_email'       => $user_object->user_email,
        );

        $json['user']   = $user_data;
        $json['success']   = true;
    }else{
        $json['data']['error'] = esc_html__( 'You have no access to this user.', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }

    
    wp_send_json($json );
}

// update profile
add_action('wp_ajax_nopriv_easybook_addons_save_profile', 'easybook_addons_save_profile_callback');
add_action('wp_ajax_easybook_addons_save_profile', 'easybook_addons_save_profile_callback');

function easybook_addons_save_profile_callback() {
    $json = array(
        'success' => false,
        'data' => array(
            // 'POST'=>$_POST,
            // 'FILES'=>$_FILES,
        )
    );
    // wp_send_json($json );

    $nonce = $_POST['_nonce'];
    
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        $json['data']['error'] = esc_html__( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }

    $user_data = array(
        'ID'                => get_current_user_id(),
        'first_name'        => $_POST['first_name'],
        'last_name'         => $_POST['last_name'],
        'display_name'      => $_POST['display_name'],
        'user_url'          => $_POST['user_url'],
        'description'       => $_POST['description'],
    );

    $user_id = wp_update_user( $user_data );

    if ( is_wp_error( $user_id ) ) {
        // There was an error, probably that user doesn't exist.
        $json['error'] = $user_id->get_error_message() ;
    } else {
        $json['data']['user_id'] = $user_id;

        $meta_fields = array(
            'email' => 'text',
            'phone' => 'text',
            'address' => 'text',
            'socials' => 'array',
            // for custom avatar upload
            'custom_avatar' => 'array',
        );
        $user_metas = array();
        foreach($meta_fields as $field => $ftype){
            if(isset($_POST[$field])){ 
                $user_metas[$field] = $_POST[$field] ;
            }else{
                if($ftype == 'array'){
                    $user_metas[$field] = array();
                }else{
                    $user_metas[$field] = '';
                }
            } 
        }
        $custom_avatar_upload = easybook_addons_handle_image_multiple_upload('custom_avatar_upload');
        if(!empty($custom_avatar_upload)){
            reset($custom_avatar_upload);
            $user_metas['custom_avatar'] = array(key($custom_avatar_upload));
        }
        // unset custom avatar if empty
        if( empty($user_metas['custom_avatar']) ) unset($user_metas['custom_avatar']);
        
        foreach ($user_metas as $key => $value) {
            if ( !update_user_meta( $user_id, ESB_META_PREFIX.$key,  $value  ) ) {
                $json['data'][] = sprintf(__('Insert user %s meta failure or existing meta value','easybook-add-ons'),$key);
            }
        }
        // end update meta field

        do_action( 'cth_author_profile_metas', $user_id );


        // for new notification
        easybook_addons_add_user_notification($user_id, array(
            'type' => 'edit_profile',
        ));
        
        // $dashboard_page_id = easybook_addons_get_option('dashboard_page');
        // $json['data']['url'] = get_permalink( $dashboard_page_id ) ;

        $json['message'] = __( 'Your profile has been updated.', 'easybook-add-ons' );
        $json['success'] = true;
    }   
    wp_send_json($json );
}



// change password
add_action('wp_ajax_nopriv_easybook_addons_change_pass', 'easybook_addons_change_pass_callback');
add_action('wp_ajax_easybook_addons_change_pass', 'easybook_addons_change_pass_callback');

function easybook_addons_change_pass_callback() {
    $json = array(
        'success' => false,
        'data' => array( 
            // 'POST'=>$_POST,
            // 'FILES'=>$_FILES,
        )
    );
    

    $nonce = $_POST['_nonce'];
    
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        $json['error'] = esc_html__( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }

    $current_user = wp_get_current_user();
    $json['data']['current_user'] = $current_user;
    if ( $current_user->exists() ) {
        $old_pass = $_POST['old_pass'];
        if(wp_check_password( $old_pass, $current_user->data->user_pass, $current_user->ID)){
            $json['data'][] = esc_html__( 'The current password is correct.', 'easybook-add-ons' ) ;
            $new_pass = $_POST['new_pass'];
            $confirm_pass = $_POST['confirm_pass'];
            if($new_pass === $confirm_pass){
                // wp_set_password( $new_pass, $current_user->ID );
                $user_id_new = wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => $new_pass ) );
                if ( is_wp_error( $user_id_new ) ) {
                    // $json['success'] = false;
                    $json['error'] = $user_id_new->get_error_message() ;
                } else {
                    
                    // $json['data']['success'] = esc_html__( 'Updated', 'easybook-add-ons' ) ;
                    $dashboard_page_id = easybook_addons_get_option('dashboard_page');
                    // $json['data']['url'] = get_permalink( $dashboard_page_id ) ;

                    // send notification to current user
                    
                    $json['success'] = true;
                    $json['message'] =  __( 'Your password has been changed.', 'easybook-add-ons' );


                }   
            }else{
                $json['success'] = false;
                $json['error'] = esc_html__( 'The new password does not match each other.', 'easybook-add-ons' ) ;
            }
        }else{
            $json['success'] = false;
            $json['error'] = esc_html__( 'The old password is incorrect.', 'easybook-add-ons' ) ;
        }
    }else{
        $json['success'] = false;
        $json['error'] = esc_html__( 'User does not exists. Can not update password', 'easybook-add-ons' ) ;
    }

    wp_send_json($json );

}
