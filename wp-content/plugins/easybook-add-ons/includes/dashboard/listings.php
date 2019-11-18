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



// get listings
add_action('wp_ajax_nopriv_easybook_addons_dasboard_listings', 'easybook_addons_dasboard_listings_callback');
add_action('wp_ajax_easybook_addons_dasboard_listings', 'easybook_addons_dasboard_listings_callback'); 

function easybook_addons_dasboard_listings_callback() { 
    
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
        $args = array(
		    'post_type'     =>  'listing',  
		    'author'        =>  $user_id, 
		    'orderby'       =>  'date',
		    'order'         =>  'DESC',
		    'paged'         => $paged,
		    'posts_per_page' => easybook_addons_dashboard_posts_per_page(),//-1 no limit

		    'post_status'   => 'publish',
		);
		if(isset($_POST['status']) && $_POST['status'] != ''){
			$args['post_status'] = $_POST['status'];
		}
		if(isset($_POST['paged']) && $_POST['paged'] != ''){
			$paged = $_POST['paged'];
			$args['paged'] = $_POST['paged'];
		}

		// The Query
		$posts_query = new WP_Query( $args );

		if($posts_query->have_posts()) :


			 while($posts_query->have_posts()) : $posts_query->the_post(); 

			 	$json['posts'][] = (object) array(
			 		'ID'				=> get_the_ID(),
			 		'title'				=> get_post_field('post_title', get_the_ID()), // get_the_title(  ),
			 		'permalink'			=> get_the_permalink( ),
			 		'address'			=> get_post_meta(get_the_ID(), ESB_META_PREFIX.'address', true),
			 		'thumbnail'			=> get_the_post_thumbnail_url(  null ,  'dashboard-listing' ),
			 		'edit_url'			=> easybook_addons_edit_listing_url(get_the_ID()),
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

// get edit listing
add_action('wp_ajax_nopriv_easybook_addons_get_edit_listing', 'easybook_addons_get_edit_listing_callback');
add_action('wp_ajax_easybook_addons_get_edit_listing', 'easybook_addons_get_edit_listing_callback');

function easybook_addons_get_edit_listing_callback() {
    $json = array(
        'success' => false,
        'data' => array(
            'POST' => $_POST,
        ),
        'post'      => array(),
        'fields'    => array(),
        'rFields'   => array(),
        // 'rpost'     => array(),
        'coupons'   => array(),
        'rooms'     => array(),
        'isEditing'    => false,
        'isAdding'      => false,
    );
    $nonce = $_POST['_nonce'];
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        $json['data']['error'] = __( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ; 
        wp_send_json($json );
    }
    $lid = isset($_POST['lid'])? $_POST['lid'] : 0;

    $ltype_id = get_post_meta( $lid, ESB_META_PREFIX.'listing_type_id', true );
    // if( $ltype_id == '' ) $ltype_id =  easybook_addons_get_option('default_listing_type');

    if(isset($_POST['listing_type_id']) && (int)$_POST['listing_type_id'] > 0 ) $ltype_id = $_POST['listing_type_id'];

    $allow_types = Esb_Class_Membership::author_listing_types_ids();
    // if(empty($allow_types) || ( absint($ltype_id) > 0 && !in_array($ltype_id, $allow_types) ) ){
    if( empty($allow_types) ){
        $json['post']['listing_type_id'] = -1;
        $json['error'] = __( 'You are not allowed to submit listing to this type.', 'easybook-add-ons' ) ; 
        wp_send_json($json );
    }elseif($ltype_id == 0 || !in_array($ltype_id, $allow_types) ){
        $dftype = easybook_addons_get_option('default_listing_type');
        if(in_array($dftype, $allow_types)){
            $ltype_id = $dftype;
        }else{
            $ltype_id = reset($allow_types);
        }
    }
    
    // get listing fields
    $json['fields'] = easybook_addons_get_listing_type_fields_obj( $ltype_id , true, true,true, true);
    $json['rFields'] = easybook_addons_get_rooms_type_fields_obj( $ltype_id ,true);
    $user_id = isset($_POST['user_id'])? $_POST['user_id'] : 0;
    if($user_id == false) $user_id = get_current_user_id();
    if( is_numeric($user_id) && $user_id > 0 ){
        if( ! user_can( $user_id, 'edit_post' , $lid ) ){
            $json['data']['error'] = __( "You don't have permission to edit this listing.", 'easybook-add-ons' ) ;
            wp_send_json( $json );
        }
        // $lpost = get_posts( array(
        //     'post_type'     =>  'listing', 
        //     'p' => $lid,
        //     'post_status'   => array('publish', 'pending'),
        // ) );
        // if(!$lpost){
        //     $json['data']['error'] = __( "The editing listing is incorrect.", 'easybook-add-ons' ) ;
        //     wp_send_json( $json );
        // }else{
            $json['success'] = true;
            $cur_cats = array();
            $cats = get_the_terms( $lid , 'listing_cat' );    
            // var_dump($cats);
            if ( $cats && ! is_wp_error( $cats ) ){
                foreach ( $cats as $cat ) {
                    $cur_cats[] = $cat->term_id;
                }
            }
            $get_tags = get_the_tags($lid);
            $listing_tags = '';
            if ( $get_tags && ! is_wp_error( $get_tags ) ){
                foreach ($get_tags as $tag) {
                    $listing_tags .= $tag->name.',';
                }
                
            }

            // get listing location
            // features
            // $cur_locs = array();
            //  $cur_loc = array();
            // $locs = get_the_terms( $lid , 'listing_location' );    
            // // var_dump($cats);
            // if ( $locs && ! is_wp_error( $locs ) ){
            //     foreach ( $locs as $loc ) {
            //         $cur_locs[] = $loc->term_id;
            //     }
            // }  
            $json['post'] = array(
                'lid'                       => $lid,
                'title'                     => get_post_field('post_title', $lid), // get_the_title( $lid ), // https://www.tipsandtricks-hq.com/how-to-fix-the-character-encoding-problem-in-wordpress-1480
                'content'                   => apply_filters('the_content', get_post_field('post_content', $lid) ),

                // 'address'                   => 'This is listing address',
                // 'latitude'                  => '57',
                // 'longitude'                 => '102',

                'thumbnail'                 => array(get_post_thumbnail_id($lid)),
                'listing_type_id'           => $ltype_id,
                'cats'                      => $cur_cats,
                'tags'                      => $listing_tags, 
                'locations'                 => easybook_addons_get_listing_locations_hierarchy($lid), // $cur_locs
                'features'                  => easybook_addons_get_listing_feature_hierarchy($lid),
                // 'lcoupon'                   => easybook_addons_get_listing_coupon($lid),

                'working_hours'             => easybook_addons_get_listing_working_hours_data($lid),
                'ltags_names'               => easybook_addons_get_listing_tags($lid),

                'post_excerpt'              => get_the_excerpt( $lid ),

                // 'select_locations'          => easybook_addons_get_listing_locations_selected( $lid ),

                'preview_url'               => get_permalink( $lid ),
            );
            // check has location selects
            $locations_select = false;
            foreach((array)easybook_addons_get_listing_type_fields_meta( $ltype_id ) as $fname => $ftype){
                $json['post'][$fname] = get_post_meta( $lid, ESB_META_PREFIX.$fname, true );
                if($ftype === 'locations') $locations_select = true;
            }
            if( $locations_select ) $json['post']['select_locations'] = easybook_addons_get_listing_locations_selected( $lid );
            // get rooms data
            $rooms_ids = get_post_meta( $lid, ESB_META_PREFIX.'rooms_ids', true );
            if(!empty($rooms_ids) && is_array($rooms_ids)){
                foreach ($rooms_ids as $rid) {
                    $rdatas = easybook_addons_get_room_post_data($rid, $ltype_id);
                    if(!empty($rdatas)) $json['rooms'][] = $rdatas;
                }
            }
            $coupon_ids = get_post_meta( $lid, ESB_META_PREFIX.'coupon_ids', true );
            if(!empty($coupon_ids) && is_array($coupon_ids)){
                foreach ($coupon_ids as $cid) {
                    $cdatas = easybook_addons_get_listing_coupon($cid);
                    if(!empty($cdatas)) $json['coupons'][] = $cdatas;
                }
            }
            // set isEditing
            $json['isEditing'] = true;
        // }  
    }else{
        $json['data']['error'] = __( 'The author id is incorrect.', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }
    
    wp_send_json($json );

}
function easybook_addons_get_listing_coupon($cid = 0){
    if(is_numeric($cid) && $cid > 0){
        $coupon_data = array(
            'coupon_code'          => get_post_meta( $cid, ESB_META_PREFIX.'coupon_code', true ),
            'discount_type'         => get_post_meta( $cid, ESB_META_PREFIX.'discount_type', true ),
            'dis_amount'            => get_post_meta( $cid, ESB_META_PREFIX.'dis_amount', true ),
            'coupon_decs'           => get_post_meta( $cid, ESB_META_PREFIX.'coupon_decs', true ),
            'coupon_qty'            => get_post_meta( $cid, ESB_META_PREFIX.'coupon_qty', true ),
            'coupon_expiry_date'    => get_post_meta( $cid, ESB_META_PREFIX.'coupon_expiry_date', true ),
        );
        return $coupon_data;
    }
    return false;
          

}
function easybook_addons_get_listing_locations_hierarchy($listing_id = 0) {
    $taxonomy = 'listing_location'; //Put your custom taxonomy term here
    $terms = get_the_terms( $listing_id, $taxonomy );
    $country_term = false;
    $state_term = false;
    $city_term = false;
    if ( !is_wp_error( $terms ) && $terms ) {
        foreach ( $terms as $term ){
            if ($term->parent == 0){
                // this gets the parent of the current post taxonomy
                $country_term = $term;
            } 
        }
        if($country_term){
            foreach ( $terms as $term ){
                if ($term->parent != 0 && $term->parent == $country_term->term_id){
                    // this gets the parent of the current post taxonomy
                    $state_term = $term;
                } 
            }
            if($state_term){
                foreach ( $terms as $term ){
                    if ($term->parent != 0 && $term->parent == $state_term->term_id){
                        // this gets the parent of the current post taxonomy
                        $city_term = $term;
                    } 
                }
            }
        }
    }
    $return = '';
    if($country_term) $return .= easybook_addons_encodeURIComponent(strtoupper($country_term->slug));
    if($state_term) $return .= "|" . easybook_addons_encodeURIComponent($state_term->name);
    if($city_term) $return .= "|" . easybook_addons_encodeURIComponent($city_term->name);

    return $return;
}
function easybook_addons_get_listing_feature_hierarchy($listing_id = 0) {
    $taxonomy = 'listing_feature'; //Put your custom taxonomy term here
    $terms = get_the_terms( $listing_id, $taxonomy );
    $featuresed = array();
    if ( !is_wp_error( $terms ) && $terms ) {
         foreach( $terms as $key => $term){
            $featuresed[] = $term->term_id;
         }
    }
    return $featuresed;
}
function easybook_addons_get_listing_tags($listing_id = 0) {
    $taxonomy = 'listing_tag'; //Put your custom taxonomy term here
    $terms = get_the_terms( $listing_id, $taxonomy );
    $term_names = array();
    if ( !is_wp_error( $terms ) && $terms ) {
        foreach( $terms as $key => $term){
            $term_names[] = $term->name;
        }
    }
    return implode(',', $term_names);
}

function easybook_addons_get_listing_locations_selected($listing_id = 0) {
    $taxonomy = 'listing_location'; //Put your custom taxonomy term here
    $terms = get_the_terms( $listing_id, $taxonomy );
    $selected = array();
    if ( !is_wp_error( $terms ) && $terms ) {
        foreach ( $terms as $term ){
            $selected[] = $term->term_id;
        }
    }
    return $selected;
}

// get room post data
function easybook_addons_get_room_post_data($rid = 0, $listing_type_id = 0){
    if(is_numeric($rid) && $rid > 0){
        $rpost = get_post($rid);
        if(!empty($rpost)){
            $data = array(
                'rid'                        => $rid,
                'title'                     => get_post_field('post_title', $rid), // get_the_title( $rid ),
                'content'                   => apply_filters('the_content', get_post_field('post_content', $rid) ),
                'room_thumbnail'                 => array(get_post_thumbnail_id($rid)),
                'dbthumb_url'               => get_the_post_thumbnail_url( $rid, 'medium' ),
                'features'                  => easybook_addons_get_listing_feature_hierarchy($rid),
            );
            foreach((array)easybook_addons_get_listing_type_fields_meta( $listing_type_id, true ) as $fname => $ftype){
                $data[$fname] = get_post_meta( $rid, ESB_META_PREFIX.$fname, true );
            }
            return $data;
        }
        return false;
    }
    return false;
}
// get submit listing fields
add_action('wp_ajax_nopriv_easybook_addons_get_submit_listing_fields', 'easybook_addons_get_submit_listing_fields_callback');
add_action('wp_ajax_easybook_addons_get_submit_listing_fields', 'easybook_addons_get_submit_listing_fields_callback');

function easybook_addons_get_submit_listing_fields_callback() {
    $json = array(
        'success' => false,
        'data' => array(
            // 'POST'=>$_POST,
        ),
        'post'      => array(),
        'fields'    => array(),
        'rFields'   => array(),
        // 'rpost'     => array(),
        'rooms'     => array(),
        'isEditing'    => false,
        'isAdding'      => false,
        'debug'         => false,
    );
    $nonce = $_POST['_nonce'];
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        $json['error'] = __( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ; 
        wp_send_json($json );
    }
    $ltype_id = isset($_POST['ltype_id'])? $_POST['ltype_id'] : 0;
    // $ltype_id = $ltype_id ? : easybook_addons_get_option('default_listing_type');
    $allow_types = Esb_Class_Membership::author_listing_types_ids();
    
    if(empty($allow_types) || ( absint($ltype_id) > 0 && !in_array($ltype_id, $allow_types) ) ){
        $json['post']['listing_type_id'] = -1;
        $json['error'] = __( 'You are not allowed to submit listing to any type. Please order an author membership to start submit listing.', 'easybook-add-ons' ) ; 
        wp_send_json($json );
    }elseif($ltype_id == 0){
        $dftype = easybook_addons_get_option('default_listing_type');
        if(in_array($dftype, $allow_types)){
            $ltype_id = $dftype;
        }else{
            $ltype_id = reset($allow_types);
        }
    }
    if(Esb_Class_Membership::can_add() == false){
        $json['post']['listing_type_id'] = -1;
        // $end_date = get_user_meta( get_current_user_id(), ESB_META_PREFIX .'end_date', true );
        // $json['error'] = easybook_addons_compare_dates($end_date, 'now', '<=');
        // $json['error'] = count_user_posts(get_current_user_id(), 'listing');
        $json['error'] = __( 'You are not allowed to submit listing. Your author subscription has expired or listing limitation exceeded.', 'easybook-add-ons' ) ; 
        wp_send_json($json );
    }

    $json['post']['listing_type_id'] = $ltype_id;

    // default listing timezone
    $json['post']['working_hours'] = easybook_addons_get_listing_working_hours_data();
    $json['post']['locations'] = easybook_addons_get_option('default_country');

    // get listing fields
    $json['fields'] = easybook_addons_get_listing_type_fields_obj( $ltype_id, true , true, true, true);
    $json['rFields'] = easybook_addons_get_rooms_type_fields_obj( $ltype_id );
    // if(isset($_POST['for_editing']) && $_POST['for_editing'])
    //     $json['isEditing'] = true;
    // else
        $json['isAdding'] = true;
    
    $json['success'] = true;
    wp_send_json($json );

}


// delete listing
add_action('wp_ajax_nopriv_easybook_addons_delete_listing', 'easybook_addons_delete_listing_callback');
add_action('wp_ajax_easybook_addons_delete_listing', 'easybook_addons_delete_listing_callback');

function easybook_addons_delete_listing_callback() {
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


    $lid = isset($_POST['lid'])? $_POST['lid'] : 0;
    if(is_numeric($lid) && (int)$lid > 0){
        $deleted_post = wp_delete_post( $lid, false );//move to trash

        if($deleted_post){
            $json['success'] = true;
            $json['post'] = $deleted_post;
            // update order/subscription listings data
            $listing_order = get_post_meta( $lid,  ESB_META_PREFIX.'order_id', true );
            if(is_numeric($listing_order) && (int)$listing_order > 0){

                // check for existing listings item
                $order_listings = get_post_meta( $listing_order, ESB_META_PREFIX.'listings', true );
                if(is_array($order_listings) && !empty($order_listings)){
                    if (($key = array_search($lid, $order_listings)) !== false) {
                        unset($order_listings[$key]);
                        update_post_meta( $listing_order, ESB_META_PREFIX.'listings', $order_listings );
                    }
                }


                update_post_meta( $lid, ESB_META_PREFIX.'order_id', '' );
            }
            // set expire_date to current date
            update_post_meta( $lid, ESB_META_PREFIX.'expire_date', current_time('mysql', 1) );


        }else{
            // $json['success'] = false;
            $json['data']['error'] = esc_html__( 'Delete listing failure', 'easybook-add-ons' ) ;
        }
    }else{
        // $json['success'] = false;
        $json['data']['error'] = esc_html__( 'The post id is incorrect.', 'easybook-add-ons' ) ;
    }

    wp_send_json($json );

}
add_action('wp_ajax_nopriv_easybook_addons_fetch_images', 'easybook_addons_fetch_images_callback');
add_action('wp_ajax_easybook_addons_fetch_images', 'easybook_addons_fetch_images_callback');
function easybook_addons_fetch_images_callback(){
    $json = array(
        'success' => false,
        'data' => array(
            // 'POST'=>$_POST,
        ),
        'images'    => array()
    );
    

    $nonce = $_POST['_nonce'];
    
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        $json['data']['error'] = esc_html__( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }

    $images = isset($_POST['images'])? $_POST['images'] : array();
    if(is_array($images) && !empty($images)){
        foreach ($images as $id) {
            $json['images'][] = array(
                'id'        => $id,
                'url'       => wp_get_attachment_url( $id )
            );
        }
            
    }
    $json['success'] = true;
    wp_send_json($json );
}




//---------------get field room type-----------------//
add_action('wp_ajax_nopriv_easybook_addons_get_field_room_type', 'easybook_addons_get_field_room_type_callback');
add_action('wp_ajax_easybook_addons_get_field_room_type', 'easybook_addons_get_field_room_type_callback');

function easybook_addons_get_field_room_type_callback() { 
    $json = array(
        'success' => false,
        'data' => array(
            // 'POST'=>$_POST,
        ),
        // 'post'      => array(),
        'fields'    => array(),
    );
    $nonce = $_POST['_nonce'];
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        $json['data']['error'] = __( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ; 
        wp_send_json($json );
    }
    $ltype_id = isset($_POST['ltype_id'])? $_POST['ltype_id'] : 0;
    // $json['post']['listing_type_id'] =  $ltype_id ? $ltype_id : easybook_addons_get_option('default_listing_type');

    // get room fields
    $json['fields'] = easybook_addons_get_rooms_type_fields_obj( $ltype_id );
    $json['success'] = true;
    wp_send_json($json );

}


//============= get single type room ==============//
 
add_action('wp_ajax_nopriv_easybook_addons_get_single_type', 'easybook_addons_get_single_type_callback');
add_action('wp_ajax_easybook_addons_get_single_type', 'easybook_addons_get_single_type_callback');

function easybook_addons_get_single_type_callback() {
    $json = array(
        'success' => false,
        'data' => array(
            // 'POST'=>$_POST,
        ),
        'post' =>array(),
    );

    $nonce = $_POST['_nonce'];
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        $json['data']['error'] = __( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ; 
        wp_send_json($json );
    }
    $id = isset($_POST['user_id'])? $_POST['user_id'] : 0;
    if( is_numeric($id) && $id > 0 ){   
    $listing_type = get_posts( array(
        'post_type' => 'listing_type',
        'posts_per_page' => -1, 
        'author'        =>  $id, 
        'post_status' =>'any', 

    ) );
    $tylisting = array(array(
            'ID'    => '0',
            'title'    => __( 'None', 'easybook-add-ons' ),
        ));
    foreach ($listing_type as $ID) {
        $tylisting[] = array(
            'ID'    => $ID->ID,
            'title'    => get_the_title($ID),
        );
    }

    $json['post'] = $tylisting;


    }else{
         $json['data']['error'] = __( 'The author id is incorrect.', 'easybook-add-ons' ) ;
         wp_send_json($json );
    }
    $json['success'] = true;
    wp_send_json($json );

}

add_action('wp_ajax_nopriv_easybook_addons_get_edit_room', 'easybook_addons_get_edit_room_callback');
add_action('wp_ajax_easybook_addons_get_edit_room', 'easybook_addons_get_edit_room_callback');

function easybook_addons_get_edit_room_callback() {
    $json = array(
        'success' => false,
        'data' => array(
            // 'POST'=>$_POST,
        ),
        'rFields'   => array(),
        'rpost'     => array(),
    );
    $nonce = $_POST['_nonce'];
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        $json['data']['error'] = __( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ; 
        wp_send_json($json );
    }
    $rid = isset($_POST['rid'])? $_POST['rid'] : 0;
    // $lid = isset($_POST['listing_id'])? $_POST['listing_id'] : 0;
    $listing_id = get_post_meta( $rid, ESB_META_PREFIX.'for_listing_id', true );

    $listing_type_id = get_post_meta( $listing_id, ESB_META_PREFIX.'listing_type_id', true );
    // $json['data']['ltid'] =  $listing_type_id ;
    if( $listing_type_id == '' ) $listing_type_id =  easybook_addons_get_option('default_listing_type');

    $json['rFields'] = easybook_addons_get_rooms_type_fields_obj( $listing_type_id );
    $user_id = isset($_POST['user_id'])? $_POST['user_id'] : 0;
    if($user_id == false) $user_id = get_current_user_id();
    if( is_numeric($user_id) && $user_id > 0 ){
        if( ! user_can( $user_id, 'edit_post' , $rid ) ){
            $json['data']['error'] = __( "You don't have permission to edit this listing.", 'easybook-add-ons' ) ;
            wp_send_json( $json );
        }
        $lpost = get_posts( array(
            'post_type'     =>  'lrooms', 
            'p' => $rid,
            'post_status'   => array('publish', 'pending'),
        ) );
        if(!$lpost){
            $json['data']['error'] = __( "The editing listing is incorrect.", 'easybook-add-ons' ) ;
            wp_send_json( $json );
        }else{
            $json['success'] = true;

            $json['rpost'] = array(
                'rid'                       => $rid,
                'title'                     => get_the_title( $rid ),
                'content'                   => apply_filters('the_content', get_post_field('post_content', $rid) ),
                'thumbnail'                 => array(get_post_thumbnail_id($rid)),
                'for_listing_id'            => get_post_meta( $rid, ESB_META_PREFIX.'for_listing_id', true ),
            );

            foreach((array)easybook_addons_get_listing_type_fields_meta( $listing_type_id , true) as $fname => $ftype){
                $json['rpost'][$fname] = get_post_meta( $rid, ESB_META_PREFIX.$fname, true );
            }
        }  
    }else{
        $json['data']['error'] = __( 'The author id is incorrect.', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }
    
    wp_send_json($json );

}
add_action('wp_ajax_nopriv_easybook_addons_get_room_fields', 'easybook_addons_get_room_fieldscallback');
add_action('wp_ajax_easybook_addons_get_room_fields', 'easybook_addons_get_room_fields_callback');

function easybook_addons_get_room_fields_callback() {
    $json = array(
        'success' => false,
        'data' => array(
            // 'POST'=>$_POST,
        ),
        'rFields'   => array(),
        'rpost'     => array(),
    );
    $nonce = $_POST['_nonce'];
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        $json['error'] = __( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ; 
        wp_send_json($json );
    }
    $listing_id = isset($_POST['ltype_id'])? $_POST['ltype_id'] : 0; // get listing id room attached to
    $listing_type_id = get_post_meta( $listing_id, ESB_META_PREFIX.'listing_type_id', true );
    if( $listing_type_id == '' ) $listing_type_id =  easybook_addons_get_option('default_listing_type');

    // $allow_types = Esb_Class_Membership::author_listing_types();
    // if(!empty($allow_types)){
    //     $allow_types = array_map(function($type){
    //         return $type['ID'];
    //     }, $allow_types);
    // }
    // if(empty($allow_types) || !in_array($listing_type_id, $allow_types)){
    //     $json['post']['listing_type_id'] = -1;
    //     $json['error'] = __( 'You are not allowed to submit listing to any type. Please order an author membership to start submit listing.', 'easybook-add-ons' ) ; 
    //     wp_send_json($json );
    // }
    // $json['post']['listing_type_id'] =  $listing_type_id ? $listing_type_id : easybook_addons_get_option('default_listing_type');

    // get listing fields
    // $json['fields'] = easybook_addons_get_listing_type_fields_obj( $listing_type_id );
    $json['rFields'] = easybook_addons_get_rooms_type_fields_obj( $listing_type_id );

    $json['success'] = true;
    wp_send_json($json );

}
add_action('wp_ajax_nopriv_easybook_addons_get_edit_woo', 'easybook_addons_get_edit_woo_callback');
add_action('wp_ajax_easybook_addons_get_edit_woo', 'easybook_addons_get_edit_woo_callback');

function easybook_addons_get_edit_woo_callback() {
    $json = array(
        'success' => false,
        'data' => array(
            // 'POST'=>$_POST,
        ),
        'rFields'   => array(),
        'rpost'     => array(),
    );
    $nonce = $_POST['_nonce'];
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        $json['data']['error'] = __( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ; 
        wp_send_json($json );
    }
    $wid = isset($_POST['wid'])? $_POST['wid'] : 0;
    // $lid = isset($_POST['listing_id'])? $_POST['listing_id'] : 0;
    $listing_id = get_post_meta( $wid, ESB_META_PREFIX.'for_listing_id', true );

    $listing_type_id = get_post_meta( $listing_id, ESB_META_PREFIX.'listing_type_id', true );
    // $json['data']['ltid'] =  $listing_type_id ;
    if( $listing_type_id == '' ) $listing_type_id =  easybook_addons_get_option('default_listing_type');

    $json['rFields'] = easybook_addons_get_rooms_type_fields_obj( $listing_type_id );
    $user_id = isset($_POST['user_id'])? $_POST['user_id'] : 0;
    if($user_id == false) $user_id = get_current_user_id();
    if( is_numeric($user_id) && $user_id > 0 ){
        // if( ! user_can( $user_id, 'edit_post' , $wid ) ){
        //     $json['data']['error'] = __( "You don't have permission to edit this listing.", 'easybook-add-ons' ) ;
        //     wp_send_json( $json );
        // }
        $lpost = get_posts( array(
            'post_type'     =>  'product', 
            'p' => $wid,
            'post_status'   => array('publish', 'pending'),
        ) );
        if(!$lpost){
            $json['data']['error'] = __( "The editing listing is incorrect.", 'easybook-add-ons' ) ;
            wp_send_json( $json );
        }else{
            $json['success'] = true;

            $json['rpost'] = array(
                'wid'                       => $wid,
                'title'                     => get_the_title( $wid ),
                'content'                   => apply_filters('the_content', get_post_field('post_content', $wid) ),
                'thumbnail'                 => array(get_post_thumbnail_id($wid)),
                'for_listing_id'            => get_post_meta( $wid, ESB_META_PREFIX.'for_listing_id', true ),
            );

            foreach((array)easybook_addons_get_listing_type_fields_meta( $listing_type_id , true) as $fname => $ftype){
                $json['rpost'][$fname] = get_post_meta( $wid, ESB_META_PREFIX.$fname, true );
            }
        }  
    }else{
        $json['data']['error'] = __( 'The author id is incorrect.', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }
    
    wp_send_json($json );

}


// featured listing
add_action('wp_ajax_nopriv_easybook_addons_featured_listing', 'easybook_addons_featured_listing_callback');
add_action('wp_ajax_easybook_addons_featured_listing', 'easybook_addons_featured_listing_callback');

function easybook_addons_featured_listing_callback() {
    $json = array(
        'success' => false,
        'debug' => false,
        // 'data' => array(
        //     'POST'=>$_POST,
        // )
    );
    $nonce = $_POST['_nonce'];
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        
        $json['data']['error'] = esc_html__( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }
    $lid = isset($_POST['lid'])? $_POST['lid'] : 0;
    if(is_numeric($lid) && (int)$lid > 0){
        $lfeatured = isset($_POST['lfeatured'])? $_POST['lfeatured'] : false;
        if($lfeatured){ // unfeatured listing
            update_post_meta( $lid, ESB_META_PREFIX.'featured', '0' );
            $json['success'] = true;
        }else{ // featured listing
            $author_id = get_current_user_id();
            $plan_id = get_user_meta( $author_id, ESB_META_PREFIX.'member_plan', true ); // get_post_meta( $listing_order, ESB_META_PREFIX.'plan_id', true );
            $featured_limit = get_post_meta( $plan_id, ESB_META_PREFIX.'lfeatured', true );
            $json['plan_id'] = $plan_id;
            $json['featured_limit'] = $featured_limit;
            if(is_numeric($featured_limit) && $featured_limit > 0){
                $author_featured = get_posts(
                    array(
                        'post_type'         => 'listing',
                        'post_status'       => array( 'publish', 'pending' ),
                        'author'            => $author_id,
                        'meta_key'          => ESB_META_PREFIX.'featured',
                        'meta_value'        => '1', 
                        'posts_per_page'    => -1,
                        'fields'            => 'ids'
                    )
                );
                $json['author_featured'] = $author_featured;
                if(in_array($lid, $author_featured)){
                    $json['data']['error'] = esc_html__( 'Listing was already featured', 'easybook-add-ons' ) ;
                }else{
                    if((int)$featured_limit > count($author_featured)){
                        update_post_meta( $lid, ESB_META_PREFIX.'featured', '1' );
                        $json['success'] = true;
                        $json['data'][] = esc_html__( 'Listing is featured', 'easybook-add-ons' ) ;
                    }else{
                        $json['data']['error'] = esc_html__( 'Your subscription hit featured listing limit', 'easybook-add-ons' ) ;
                    }
                }
            }else{
                $json['data']['error'] = esc_html__( 'Your author subscription has no featured listings or hit the limit', 'easybook-add-ons' ) ;
            }
        }
    }else{
        // $json['success'] = false;
        $json['data']['error'] = esc_html__( 'The post id is incorrect.', 'easybook-add-ons' ) ;
    }

    wp_send_json($json );

}
