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
add_action('wp_ajax_nopriv_easybook_addons_dashboard_contents', 'easybook_addons_dashboard_contents_callback');
add_action('wp_ajax_easybook_addons_dashboard_contents', 'easybook_addons_dashboard_contents_callback');

function easybook_addons_dashboard_contents_callback() { 
    
    $json = array(
        'success' => false,
        'data' => array(
            // 'POST'=>$_POST,
        ),
        'contents' => array(
        	'notifications' => array(),
        	'statistics' => array(),
        ),
    );
    $nonce = $_POST['_nonce'];
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        $json['data']['error'] = __( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ; 
        wp_send_json($json );
    }
    $user_id = isset($_POST['user_id'])? $_POST['user_id'] : 0;
    if( is_numeric($user_id) && $user_id > 0 ){
		
		$json['contents']['notifications'] = easybook_addons_get_user_notifications($user_id);

    }else{
        $json['data']['error'] = __( 'The author id is incorrect.', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }
    $json['success'] = true;
    wp_send_json($json );

}
add_action('wp_ajax_nopriv_easybook_addons_delete_activity', 'easybook_addons_delete_activity_callback');
add_action('wp_ajax_easybook_addons_delete_activity', 'easybook_addons_delete_activity_callback');

function easybook_addons_delete_activity_callback() {
    
    $json = array(
        'success' => false,
        'data' => array(
            // 'POST'=>$_POST,
        ),
        'id'	=> 0
    );
    $nonce = $_POST['_nonce'];
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        $json['data']['error'] = __( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ; 
        wp_send_json($json );
    }
    $id = isset($_POST['id'])? $_POST['id'] : 0;
    if( is_numeric($id) && $id > 0 ){
		
		$deleted = easybook_addons_delete_user_notification($id);

		if($deleted) $json['id'] = $deleted;
		

    }else{
        $json['data']['error'] = __( 'Invalid activity id.', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }
    $json['success'] = true;
    wp_send_json($json );

}
