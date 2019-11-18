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


// modify users columns
function easybook_addons_users_columns_head( $columns ) {
    $columns['membership'] = __('Membership Plan','easybook-add-ons');
    return $columns;
}
// add_filter( 'manage_users_columns', 'easybook_addons_users_columns_head' );

function easybook_addons_users_columns_content( $val, $column_name, $user_id ) {
    switch ($column_name) {
        case 'membership' :

        //var_dump(get_user_meta( $user_id, ESB_META_PREFIX.'subscriptions', true ));
        	// $plan_post = get_post(get_user_meta( $user_id, ESB_META_PREFIX.'member_plan', true));
         //    $val = null == $plan_post? __( 'None', 'easybook-add-ons' ) : sprintf( __( '%s<br />From: %s', 'easybook-add-ons' ), $plan_post->post_title, get_user_meta( $user_id, ESB_META_PREFIX.'payment_date', true) ) ;
                $val = implode( "<br />", (array) get_user_meta( $user_id, ESB_META_PREFIX.'subscriptions', true ) );
            break;
        
        default:
    }
    return $val;
}
// add_filter( 'manage_users_custom_column', 'easybook_addons_users_columns_content', 10, 3 );

// create stripe plan action
add_action('wp_ajax_nopriv_easybook_addons_delete_notification', 'easybook_addons_delete_notification_callback');
add_action('wp_ajax_easybook_addons_delete_notification', 'easybook_addons_delete_notification_callback');

function easybook_addons_delete_notification_callback() { 
    $json = array(
        'success' => false,
        'data' => array(
            // 'POST'=>$_POST,
        )
    );

    $nonce = $_POST['_nonce'];
    
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        $json['data']['error'] = esc_html__( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }

    $key = $_POST['key'];

    $current_user = wp_get_current_user();

    $notifications = get_user_meta( $current_user->ID, ESB_META_PREFIX.'notifications', true );

    if(!empty($notifications) && is_array($notifications)){
        if(array_key_exists($key, $notifications)){
            unset($notifications[$key]);

            update_user_meta( $current_user->ID, ESB_META_PREFIX.'notifications', $notifications );

            $json['success'] = true;
        }
    }


    wp_send_json($json );

}




// for bookmarks listing
add_action('wp_ajax_nopriv_easybook_addons_bookmarks_listing', 'easybook_addons_bookmarks_listing_callback');
add_action('wp_ajax_easybook_addons_bookmarks_listing', 'easybook_addons_bookmarks_listing_callback');

function easybook_addons_bookmarks_listing_callback() {
    $json = array(
        'success' => false,
        'data' => array(
            // 'POST'=>$_POST,
        )
    );

    $nonce = $_POST['_nonce'];
    
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        $json['data']['error'] = esc_html__( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }
    $tooltip = $_POST['tooltip'];
    $listing_post          = get_post($_POST['listing']);

    if(empty($listing_post)){
        $json['data']['error'] = esc_html__( 'Invalid listing', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }

    
    if(!is_user_logged_in()){
        $json['data']['error'] = esc_html__( 'Not logged in user', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }

    if(easybook_addons_already_bookmarked($listing_post->ID)){
        $json['data']['error'] = esc_html__( 'User had already bookmarked', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }

    $json['success'] = true;

    //update user bookmarks array
    $user_id = get_current_user_id();


    // increase listing bookmarks
    $bookmarks = get_post_meta( $listing_post->ID, ESB_META_PREFIX.'bookmarks', true );
    if($bookmarks == '')
        $bookmarks = 1;
    else 
        $bookmarks += 1;
    // update post meta
    update_post_meta( $listing_post->ID, ESB_META_PREFIX.'bookmarks', $bookmarks );

    // send notification to listing author
    // for new notification
    easybook_addons_add_user_notification($listing_post->post_author, array(
        'type'          => 'new_bookmark',
        'entity_id'     => $listing_post->ID,
        'actor_id'      => $user_id,
    ));

    $listing_bookmarks = get_user_meta( $user_id, ESB_META_PREFIX.'listing_bookmarks', true );

    if(!empty($listing_bookmarks) && is_array($listing_bookmarks)){
        if(array_search($listing_post->ID, $listing_bookmarks) === false){
            $listing_bookmarks[] = $listing_post->ID;
        }else{
            $json['data']['error'] = esc_html__( 'User had already bookmarked', 'easybook-add-ons' ) ;
        }
    }else{
        $listing_bookmarks = array($listing_post->ID);
    }

    update_user_meta( $user_id, ESB_META_PREFIX.'listing_bookmarks', $listing_bookmarks );

    // send notification to current user
    // for new notification
    easybook_addons_add_user_notification($user_id, array(
        'type'          => 'bookmarked',
        'entity_id'     => $listing_post->ID,
        'actor_id'      => $user_id,
    ));
    if(!empty($listing_bookmarks) && is_array($listing_bookmarks)){ 
        foreach ($listing_bookmarks as $lid) {
            $listing_post = get_post($lid);
            if(!empty($listing_post)){
                $json['data']['posts'][]= (OBJECT)array(
                    'id'        => $listing_post->ID,
                    'title'     => $listing_post->post_title,
                    'url'       => get_the_permalink($listing_post->ID),
                    'rating'    => easybook_addons_get_average_ratings($listing_post->ID),
                    'address'   => get_post_meta( $listing_post->ID, '_cth_address', true ),
                    'thub'      => wp_get_attachment_url( get_post_thumbnail_id($listing_post->ID), 'thumbnail' ),
                    'rating_base'=> (int)easybook_addons_get_option('rating_base'),
                    'price_from' => get_post_meta( $listing_post->ID, ESB_META_PREFIX.'price_from', true ),
                );
            }
        }
    }
    if($tooltip == 'tooltip') {
        $json['data']['icon'] = __( '<i class="fas fa-heart"></i><span class="geodir-opt-tooltip">Saved</span>', 'easybook-add-ons' );
    }else{
        $json['data']['icon'] = __( '<i class="fas fa-heart"></i> <span class="bm-text">Saved</span>', 'easybook-add-ons' );
    }
    $json['data']['couter'] = count($listing_bookmarks);
    wp_send_json($json );

}
function easybook_addons_already_bookmarked($post_ID = 0){
    if(!is_user_logged_in()) return false;

    $listing_bookmarks = get_user_meta( get_current_user_id(), ESB_META_PREFIX.'listing_bookmarks', true );
    
    if(!empty($listing_bookmarks) && is_array($listing_bookmarks)){
        if(array_search($post_ID, $listing_bookmarks) !== false) return true;
    }

    return false;

}
// for delete bookmark
add_action('wp_ajax_nopriv_easybook_addons_delete_bookmark', 'easybook_addons_delete_bookmark_callback');
add_action('wp_ajax_easybook_addons_delete_bookmark', 'easybook_addons_delete_bookmark_callback');

function easybook_addons_delete_bookmark_callback() {
    $json = array(
        'success' => false,
        'data' => array(
            // 'POST'=>$_POST,
        )
    );

    $nonce = $_POST['_nonce'];
    
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        $json['data']['error'] = esc_html__( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }

    $listing_post          = get_post($_POST['listing']);

    if(empty($listing_post)){
        $json['data']['error'] = esc_html__( 'Invalid listing', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }

    
    if(!is_user_logged_in()){
        $json['data']['error'] = esc_html__( 'Not logged in user', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }

    if(!easybook_addons_already_bookmarked($listing_post->ID)){
        $json['data']['error'] = esc_html__( 'You haven\'t bookmarked this listing', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }

    $json['success'] = true;


    // decrease listing bookmarks
    $bookmarks = get_post_meta( $listing_post->ID, ESB_META_PREFIX.'bookmarks', true );
    if($bookmarks == '')
        $bookmarks = 0;
    else 
        $bookmarks -= 1;
    // update post meta
    update_post_meta( $listing_post->ID, ESB_META_PREFIX.'bookmarks', $bookmarks );

    
    //update user bookmarks array
    $user_id = get_current_user_id();

    $listing_bookmarks = get_user_meta( get_current_user_id(), ESB_META_PREFIX.'listing_bookmarks', true );

    if(!empty($listing_bookmarks) && is_array($listing_bookmarks)){
        $key = array_search($listing_post->ID, $listing_bookmarks);
        if( $key !== false){
            unset($listing_bookmarks[$key]);
            update_user_meta( get_current_user_id(), ESB_META_PREFIX.'listing_bookmarks', $listing_bookmarks );
        }
    }
    $json['data']['couter'] = count($listing_bookmarks);
    wp_send_json($json );

}




/**
 * Show custom user profile fields
 * 
 * @param  object $profileuser A WP_User object
 * @return void
 */
function easybook_addons_user_add_meta_box( $profileuser ) {
?>
    <h2><?php _e( 'EasyBook Theme', 'easybook-add-ons' ); ?></h2>
    <table class="form-table">
        <tr>
            <th>
                <label for="user_avatar"><?php esc_html_e( 'Custom Avatar', 'easybook-add-ons' ); ?></label>
            </th>
            <td>
                
                <div class="edit-profile-photo fl-wrap">
                    <div class="profile-photo-wrap"><?php 
                        // https://wordpress.stackexchange.com/questions/7620/how-to-change-users-avatar
                        echo get_avatar($profileuser->user_email,'150','https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=150', $profileuser->display_name );
                    ?>
                    </div> 
                    <div class="change-photo-btn">
                        <div class="photoUpload">
                            <span><i class="fa fa-upload"></i><?php _e( ' Upload Photo', 'easybook-add-ons' ); ?></span>
                            <?php 
                            if( current_user_can( 'upload_files' ) ){
                                $avatar_data = get_user_meta($profileuser->ID,  ESB_META_PREFIX.'custom_avatar', true );
                                // var_dump($avatar_data);
                                if(is_array($avatar_data)){
                                    $custom_ava_id = reset($avatar_data);
                                    if(!is_numeric($custom_ava_id)) $avatar_data = array(key($avatar_data));
                                }else{
                                    $avatar_data = array();
                                }
                                easybook_addons_get_template_part( 'template-parts/images-select', false, array( 'is_single' => true, 'name'=>'custom_avatar', 'datas'=> $avatar_data ) );
                            }else{ ?>
                                <input type="file" class="upload cth-avatar-upload" name="custom_avatar_upload">
                            <?php
                            } ?>
                        </div>
                    </div>
                </div>

                
            </td>
        </tr>
        <tr>
            <th>
                <label for="user_socials"><?php esc_html_e( 'Socials', 'easybook-add-ons' ); ?></label>
            </th>
            <td>
                <?php 
                    $socials = get_user_meta( $profileuser->ID, ESB_META_PREFIX.'socials', true );
                ?>
                <div class="repeater-fields-wrap"  data-tmpl="tmpl-user-social">
                    <div class="repeater-fields user-socials">
                    <?php 
                    if(!empty($socials)){
                        foreach ($socials as $key => $social) {
                            easybook_addons_get_template_part('templates-inner/user-social',false, array('index'=>$key,'name'=>$social['name'],'url'=>$social['url']));
                        }
                    }
                    ?>
                    </div>
                    <button class="btn addfield" data-name="socials" type="button"><?php  esc_html_e( 'Add Social','easybook-add-ons' );?></button>
                </div>
                
            </td>
        </tr>
        <tr>
            <th>
                <label for="earning"><?php esc_html_e( 'Earning', 'easybook-add-ons' ); ?></label>
            </th>
            <td>
                <?php $earning = get_user_meta( $profileuser->ID, ESB_META_PREFIX.'earning', true ); ?>
                <p ><?php echo easybook_addons_get_price_formated(floatval($earning));?></p>

            </td>
        </tr>
    </table>
<?php
    // echo '<pre>';
    // var_dump(get_user_meta ( $profileuser->ID));

  //   ["billing_first_name"]=>
  // array(1) {
  //   [0]=>
  //   string(5) "Cuong"
  // }
  // ["billing_last_name"]=>
  // array(1) {
  //   [0]=>
  //   string(4) "Tran"
  // }
  // ["billing_company"]=>
  // array(1) {
  //   [0]=>
  //   string(9) "CTHthemes"
  // }
  // ["billing_address_1"]=>
  // array(1) {
  //   [0]=>
  //   string(6) "Line 1"
  // }
  // ["billing_address_2"]=>
  // array(1) {
  //   [0]=>
  //   string(6) "line 2"
  // }
  // ["billing_city"]=>
  // array(1) {
  //   [0]=>
  //   string(5) "Hanoi"
  // }
  // ["billing_postcode"]=>
  // array(1) {
  //   [0]=>
  //   string(6) "100000"
  // }
  // ["billing_country"]=>
  // array(1) {
  //   [0]=>
  //   string(2) "VN"
  // }
  // ["billing_state"]=>
  // array(1) {
  //   [0]=>
  //   string(5) "Hanoi"
  // }
  // ["billing_phone"]=>
  // array(1) {
  //   [0]=>
  //   string(5) "55555"
  // }
  // ["billing_email"]=>
  // array(1) {
  //   [0]=>
  //   string(18) "home.cth@gmail.com"
  // }
  // ["shipping_first_name"]=>
  // array(1) {
  //   [0]=>
  //   string(0) ""
  // }
  // ["shipping_last_name"]=>
  // array(1) {
  //   [0]=>
  //   string(0) ""
  // }
  // ["shipping_company"]=>
  // array(1) {
  //   [0]=>
  //   string(0) ""
  // }
  // ["shipping_address_1"]=>
  // array(1) {
  //   [0]=>
  //   string(0) ""
  // }
  // ["shipping_address_2"]=>
  // array(1) {
  //   [0]=>
  //   string(0) ""
  // }
  // ["shipping_city"]=>
  // array(1) {
  //   [0]=>
  //   string(0) ""
  // }
  // ["shipping_postcode"]=>
  // array(1) {
  //   [0]=>
  //   string(0) ""
  // }
  // ["shipping_country"]=>
  // array(1) {
  //   [0]=>
  //   string(0) ""
  // }
  // ["shipping_state"]=>
  // array(1) {
  //   [0]=>
  //   string(0) ""
  // }
}
add_action( 'show_user_profile', 'easybook_addons_user_add_meta_box', 10, 1 );
add_action( 'edit_user_profile', 'easybook_addons_user_add_meta_box', 10, 1 );

add_action ( 'personal_options_update' , 'easybook_addons_update_user_profile_fields' ); 
add_action ( 'edit_user_profile_update' , 'easybook_addons_update_user_profile_fields' );      

function easybook_addons_update_user_profile_fields ( $user_id ) {
    if ( ! current_user_can ( 'edit_user' , $user_id ) ) { return false ; }  
    if(isset($_POST[ 'socials' ])){
        $field_name = ESB_META_PREFIX.'socials';     
        update_user_meta ( $user_id , $field_name , $_POST[ 'socials' ] ); 
    }
    // if(isset($_POST[ 'earning' ])){
    //     $field_name = ESB_META_PREFIX.'earning';     
    //     update_user_meta ( $user_id , $field_name , $_POST[ 'earning' ] ); 
    // }
    if( isset($_POST[ 'custom_avatar' ]) && $_POST[ 'custom_avatar' ] ){
        update_user_meta ( $user_id , ESB_META_PREFIX.'custom_avatar' , $_POST[ 'custom_avatar' ] ); 
    }
    $custom_avatar_upload = easybook_addons_handle_image_multiple_upload('custom_avatar_upload');
    if(!empty($custom_avatar_upload)){
        reset($custom_avatar_upload);
        update_user_meta ( $user_id , ESB_META_PREFIX.'custom_avatar' , key($custom_avatar_upload) ); 
    } 
} 


// Apply filter - to use custom avatar
add_filter( 'get_avatar' , 'easybook_addons_custom_avatar' , 1 , 5 );

function easybook_addons_custom_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
    $user = false;

    if ( is_numeric( $id_or_email ) ) {

        $id = (int) $id_or_email;
        $user = get_user_by( 'id' , $id );

    } elseif ( is_object( $id_or_email ) ) {

        if ( ! empty( $id_or_email->user_id ) ) {
            $id = (int) $id_or_email->user_id;
            $user = get_user_by( 'id' , $id );
        }

    } else {
        $user = get_user_by( 'email', $id_or_email );   
    }

    if ( $user && is_object( $user ) ) {
        if(function_exists('bp_core_fetch_avatar')){
            $avatar = bp_core_fetch_avatar ( array( 'item_id' => $user->ID, 'type' => 'full' ) );
        }else{
            $custom_avatar = get_user_meta( $user->ID, ESB_META_PREFIX.'custom_avatar', true );
            if(is_array($custom_avatar) && count($custom_avatar)){
                $custom_ava_id = reset($custom_avatar);
                // if(!is_numeric($custom_ava_id)) $custom_ava_id = key($custom_avatar);
                $avatar = wp_get_attachment_url( $custom_ava_id );
                
                // $avatar = wp_get_attachment_url( reset($custom_avatar) );
                $avatar = "<img alt='{$alt}' src='{$avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
            }
        }
    }

    return $avatar;
}

add_filter('pre_get_avatar_data', function ($args, $id_or_email) {
    $user = false;

    if (is_numeric($id_or_email)) {

        $id   = (int) $id_or_email;
        $user = get_user_by('id', $id);

    } elseif (is_object($id_or_email)) {

        if (!empty($id_or_email->user_id)) {
            $id   = (int) $id_or_email->user_id;
            $user = get_user_by('id', $id);
        }

    } else {
        $user = get_user_by('email', $id_or_email);
    }
    if ($user && is_object($user)) {

        $custom_avatar = get_user_meta($user->ID, ESB_META_PREFIX . 'custom_avatar', true);
        if (is_array($custom_avatar) && count($custom_avatar)) {
            $custom_ava_id = reset($custom_avatar);
            if (!is_numeric($custom_ava_id)) {
                $custom_ava_id = key($custom_avatar);
            }

            $args['url'] = wp_get_attachment_url($custom_ava_id);
            
        }
    }
    return $args;
}, 10, 2);
