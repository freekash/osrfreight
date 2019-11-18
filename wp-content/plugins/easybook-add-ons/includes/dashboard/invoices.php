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


add_action('wp_ajax_nopriv_easybook_addons_get_posts_invoices','easybook_addons_get_posts_invoices_callback');
add_action('wp_ajax_easybook_addons_get_posts_invoices', 'easybook_addons_get_posts_invoices_callback');

function easybook_addons_get_posts_invoices_callback() {
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
		$args = array(
		    'post_type'     =>  'cthinvoice', 
		     'author'        =>  $user_id,
		    // 'orderby'       =>  'date',
		    // 'order'         =>  'DESC',
		    // 'paged'         => $paged,
		    // double test for user invoice
		    // 'meta_key'      => $user_id,
    		// 'meta_value'    => $current_user->ID,

		    'post_status'   => array( 'publish', 'pending', 'draft', 'future' ),
		);
		if(isset($_POST['paged']) && $_POST['paged'] != ''){
			$paged = $_POST['paged'];
			$args['paged'] = $_POST['paged'];
		}
		$posts_query = new WP_Query( $args );
		if($posts_query->have_posts()) :
			while($posts_query->have_posts()) : $posts_query->the_post();
				$json['posts'][] = (object) array(
					'id'	=> get_the_ID(),
					'title' => get_the_title(),
					'plan_title' => get_post_meta( get_the_ID(), ESB_META_PREFIX.'plan_title', true ),
					'from_date' =>get_post_meta( get_the_ID(), ESB_META_PREFIX.'from_date', true),
					'end_date' => get_post_meta( get_the_ID(), ESB_META_PREFIX.'end_date', true),
					'amount' => easybook_addons_get_price_formated( get_post_meta( get_the_ID(), ESB_META_PREFIX.'amount', true ) ),
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
add_action('wp_ajax_nopriv_easybook_addons_get_posts_id_invoices','easybook_addons_get_posts_id_invoices_callback');
add_action('wp_ajax_easybook_addons_get_posts_id_invoices', 'easybook_addons_get_posts_id_invoices_callback');

function easybook_addons_get_posts_id_invoices_callback() {
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
    $id = isset($_POST['id'])? $_POST['id'] : 0;  
    if( is_numeric($id) && $id > 0 ){
		$current_user = wp_get_current_user(); 
		$args = array(
		    'post_type'     =>  'cthinvoice', 
		    'author'        =>  $user_id,
		    'p'				=> $id,
		    // 'orderby'       =>  'date',
		    // 'order'         =>  'DESC',
		    // 'paged'         => $paged,
		    // double test for user invoice
		    // 'meta_key'      => $user_id,
    		// 'meta_value'    => $current_user->ID,

		    'post_status'   => array( 'publish', 'pending', 'draft', 'future' ),
		);
		
		$posts_query = new WP_Query( $args );
		if($posts_query->have_posts()) :
			while($posts_query->have_posts()) : $posts_query->the_post();
				$json['posts'][] = (object) array(
					'id'			=> get_the_ID(),
					'title' 		=> get_the_title(),
					'payment'		=>easybook_addons_get_order_method_text(get_post_meta( get_the_ID(), ESB_META_PREFIX.'payment', true )),
					'plan_title'	=> get_post_meta( get_the_ID(), ESB_META_PREFIX.'plan_title', true ),
					'from_date' 	=>get_post_meta( get_the_ID(), ESB_META_PREFIX.'from_date', true),
					'end_date' 		=> get_post_meta( get_the_ID(), ESB_META_PREFIX.'end_date', true),
					'amount' 		=> easybook_addons_get_price_formated( get_post_meta( get_the_ID(), ESB_META_PREFIX.'amount', true ) ),
					'user_name' 	=> get_userdata(get_post_meta( get_the_ID(), ESB_META_PREFIX.'user_id', true ))->display_name,
					'user_email'	=> get_userdata(get_post_meta( get_the_ID(), ESB_META_PREFIX.'user_id', true ))->user_email,
					'phone'						=> get_user_meta(get_post_meta( get_the_ID(), ESB_META_PREFIX.'user_id', true ),'_cth_phone',true),
					'creat'			=> get_the_date(),
				);
			endwhile;
			wp_reset_postdata();

		endif;
    }else{
        $json['data']['error'] = __( 'The id is incorrect.', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }
    $json['success'] = true;
    wp_send_json($json );
}