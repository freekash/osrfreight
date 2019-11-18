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




function easybook_addons_author_profile(){   
	$current_user = wp_get_current_user();
	$author = array(
		'name'        => $current_user->display_name,
		'avata'       => get_avatar($current_user->user_email,'80','https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=80', $current_user->display_name ),
		'logout'      => wp_logout_url( easybook_addons_get_current_url() ),
        'plan_link'   => get_permalink( easybook_addons_get_option('packages_page') ),  
 		'user_email'  => $current_user->user_email,
		'user_url'    => $current_user->user_url,
		'phone'       => get_user_meta($current_user->ID,  ESB_META_PREFIX.'phone', true ),
		'address'     => get_user_meta($current_user->ID,  ESB_META_PREFIX.'address', true ),      
		'description' => $current_user->description, 
	);
	return $author;
}
function easybook_addons_update_status(){
    $author_id = get_current_user_id();
	// $current_user = wp_get_current_user(); 
    $views_count = 0;
    $au_listings = get_posts( array(
        'fields'                => 'ids',
        'post_type'             => 'listing', 
        'author'                => $author_id,
        // 'orderby'               => 'date',
        // 'order'                 => 'DESC',
        'post_status'           => 'publish',
        'posts_per_page'        => -1, // no limit
    ) );
    // $au_listing_ids = array();
    // // var_dump($au_listings);
    // foreach ( $au_listings as $post_ID ) {
    //     // $views_count += Esb_Class_LStats::get_stats($post_ID);
    //     $au_listing_ids[] = $post_ID;
    // }
    // var_dump($au_listing_ids);
    $lbooking_post = get_posts(array(
        'post_type'     =>  'lbooking', 
        // 'orderby'       =>  'date',
        // 'order'         =>  'DESC',
        // 'paged'         => $paged,
        'posts_per_page'    => -1,
        'fields'            => 'ids',
        'post_status'   => 'publish',
        'meta_query' => array(
        // show user bookings
            array(
                'relation' => 'AND',
                array(
                    'key'     => ESB_META_PREFIX.'user_id',
                    'value'   => $author_id,
                ),
                array(
                    'key'     => ESB_META_PREFIX.'lb_status',
                    'value'   => 'canceled',
                    'compare' => '!='
                )
            ),
        ),
        
    ));
    // $meta_queries = array(
    //     array(
    //         'relation' => 'AND',
    //         array(
    //             'key'     => $current_user->ID,
    //             'value'   => $current_user->ID,
    //         ),
    //         array(
    //             'key'     => ESB_META_PREFIX.'lb_status',
    //             'value'   => 'canceled',
    //             'compare' => '!='
    //         )
    //     ),
    // );  
    $lbooking_post_author = get_posts(array( 
        'post_type'         => 'lbooking', 
        'post_status'       => 'publish',
        'posts_per_page'    => -1,
        'fields'            => 'ids',
        // 'meta_query'        => $meta_queries,
        'meta_key'          => ESB_META_PREFIX.'lauthor_id',
        'meta_value_num'    => $author_id,
    ));
    $listing_comments = get_comments(array(
        // 'post__in'          => $au_listings,
        // 'orderby'           => 'comment_date',
        // 'order'             => 'DESC',
        'count'             => true,
        'post_type'         => 'listing',
        'post_author__in'   => array($author_id), 
    ));
    $your_comments = get_comments(array(
        // 'post__in'      => $au_listing_ids,
        'author__in'    => array($author_id), 
        'post_type'     => 'listing',
        'count'         => true
    ));


    $update_status = array(
        'count_listings'        => count($au_listings),
        'views_count'           => $views_count,
        'comments'              => $listing_comments,
        'your_comments'         => $your_comments,
        'count_lbokking'        => count($lbooking_post), // customer bookings
        'count_lbooking_author' => count($lbooking_post_author), // author listing's bookings
    );
   
    // var_dump($update_status);
    // die;
    return $update_status;

}

function easybook_addons_cont_fiels_select(){
     $listing_locs = get_terms( array(
        'taxonomy' => 'listing_location',
        'hide_empty' => false
    ) );
    if ( ! empty( $listing_locs ) && ! is_wp_error( $listing_locs ) ){
        $locs = array();
        foreach ($listing_locs as $loc ){
             $locs[]= array(
                'value' => $loc->term_id,
                'label' => $loc->name
             );
        }
    }
	// $listing_locations = easybook_addons_get_listing_locations(true); 
	$listing_cats = easybook_addons_get_listing_categories(easybook_addons_get_option('search_cat_level'));
	$cont = array();
    foreach ($listing_cats as $cat) {
    	$cont = array(
			'category'	=> $listing_cats,
			'location'  => $locs,
		);         
    }
	return $cont;
}


function easybook_addons_single_listing_types(){
	$current_user = wp_get_current_user(); 
	$listing_type = get_posts( array(
        'post_type' => 'listing_type',
        'posts_per_page' => -1, 
        'author'        =>  $current_user->ID,
        'post_status' =>'any', 

    ));
    $type_id = array(array(
            'ID'    => '0',
            'title'    => __( 'None', 'easybook-add-ons' ),
        ));
    foreach ($listing_type as $ID) {
        $type_id[] = array(
            'ID'    => $ID->ID,
            'title'    => get_the_title($ID),
        );
    }
	// $fields = json_encode($fiels);
	return $type_id ;

}


function easybook_addons_listing_plans(){
    $listing_type = get_posts( array(
        'post_type' => 'lplan',
        'posts_per_page' => -1, 
        'post_status' =>'any', 

    ));
    $type_id = array(array(
            'ID'    => '0',
            'title'    => __( 'None', 'easybook-add-ons' ),
        ));
    foreach ($listing_type as $ID) {
        $type_id[] = array(
            'ID'         => $ID->ID,
            'title'      => get_the_title($ID),
            'price'      => easybook_addons_get_price_formated(get_post_meta( $ID->ID, ESB_META_PREFIX.'price', true )),
        );
    }
    // $fields = json_encode($fiels);
    return $type_id ;

}
function easybook_addons_get_listing_features(){
    $featuresed = array();
    // $features = get_the_terms(get_the_ID(), 'listing_feature');
    // $features =  get_terms( 'listing_feature' );
    $features =  get_terms( array(
        'taxonomy'          => 'listing_feature',
        'hide_empty'        => false
    ) );

    
    if ( $features && ! is_wp_error( $features ) ){ 
        foreach ( $features as $term ) {
            $featuresed[] = array(
                'name' => $term->name,
                'id'   =>  $term->term_id,
            );      
        }
    }
    return $featuresed;
}
// function easybook_addons_get_coupon_type($listing_id = 0){
//     var_dump($listing_id);
//     $coupon_type = array(array(
//         'ID'    => '0',
//         'title'    => __( 'None', 'easybook-add-ons' ),
//     ));
//     if(is_numeric($listing_id) && $listing_id > 0) {
//         $coupon_ids = get_post_meta( $listing_id, ESB_META_PREFIX.'coupon_code', true );
//         if(is_array($coupon_ids) && $coupon_ids != ''){
//             $listing_type = get_posts( array(
//                 'post_type'     => 'cthcoupons',
//                 'posts_per_page' => -1, 
//                 'post_status'   =>'publish',
//                 'include'       => $coupon_ids,

//             ));
            
//             foreach ($listing_type as $ID) {
//                 $coupon_type[] = array(
//                     'ID'         => $ID->ID,
//                     'title'      => get_post_meta( $ID->ID, ESB_META_PREFIX.'coupon_code', true ),
//                 );
//             }
//         }
//     }
//     var_dump($coupon_type);
//     return $coupon_type;
// }
