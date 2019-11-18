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




// get reviews for your 
add_action('wp_ajax_nopriv_easybook_addons_dasboard_reviews', 'easybook_addons_dasboard_reviews_callback');
add_action('wp_ajax_easybook_addons_dasboard_reviews', 'easybook_addons_dasboard_reviews_callback');

function easybook_addons_dasboard_reviews_callback() {
    
    $json = array(
        'success' => false,
        'data' => array(
            // 'POST'=>$_POST,
        ),
        'comments' => array(),
        'pagi' => array(),
    );
    $nonce = $_POST['_nonce'];
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        $json['error'] = __( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ; 
        wp_send_json($json );
    }
    $paged = 1;
    $user_id = isset($_POST['user_id'])? $_POST['user_id'] : 0;
    // var_dump($user_id);
	if( is_numeric($user_id) && $user_id > 0 ){

        if(isset($_POST['paged']) && (int)$_POST['paged'] > 1){
            $paged = (int)$_POST['paged'];
        }

        $comments_per_page = easybook_addons_dashboard_posts_per_page();

        $comment_args = array(
            'author__in'             => array($user_id), 
            // 'number'                 => 5,
            // 'offset'               => ($paged - 1) * 5,
            'status'               => 'approve' //Change this to the type of comments to be displayed
        );

        $comments_count = get_comments( 
            array_merge(
                $comment_args, 
                array(
                    'count'                 => true,
                )
            )
        );
		
		// $paged = 1;               
  //       $args = array(
		//     'post_type'     	=>  'listing',  
		//     'author'        	=>  $user_id, 
		//     // 'orderby'       =>  'date',
		//     // 'order'         =>  'DESC',
		//     // 'paged'         => $paged,
		//     'posts_per_page' 	=> -1,//-1 no limit

		//     'post_status'   	=> 'publish',
		//     'fields'			=> 'ids'
		// );
		// $listings_IDs = get_posts( $args );

		// $json['data']['listing_ids'] = $listings_IDs;
		// if (!empty($listings_IDs)) {
			$comments = get_comments( 
                array_merge(
                    $comment_args, 
                    array(
                        'number'                 => $comments_per_page,
                        'offset'               => ($paged - 1) * $comments_per_page,
                    )
                )
            );
            if($comments){
                foreach($comments as $comment) :
                    $rates = get_post_meta($comment->comment_post_ID, ESB_META_PREFIX.'rating_average', true);
                    $rating = 0;
                    if ($rates != '' && is_numeric($rates)) {
                        $rating = (float)$rates;
                    }
                    
                    $json['comments'][] = (object) array(
                        'id'                => $comment->comment_ID,
                        'author_name'       => $comment->comment_author,
                        'avatar'            => get_avatar($comment->comment_author_email,'150','https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=150', $comment->comment_author ),
                        'listing_title'     => get_the_title( $comment->comment_post_ID ),
                        'listing_url'       => get_permalink( $comment->comment_post_ID ),
                        'date'              => $comment->comment_date,
                        'comment'           => $comment->comment_content,
                        'rate'              => easybook_addons_rating_text($rating),
                        'rates'             => $rating,

                        'link_author'       => $comment->comment_author_url,
                        
                    );
                endforeach;
            }
		// }
		$json['pagi']['range'] = 2;
	    $json['pagi']['paged'] = $paged;
	    $json['pagi']['pages'] = ceil($comments_count / $comments_per_page);
    }else{
        $json['error'] = __( 'The author id is incorrect.', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }
    $json['success'] = true;
    wp_send_json($json );

}


// get your reviews
add_action('wp_ajax_nopriv_easybook_addons_dasboard_your_reviews', 'easybook_addons_dasboard_your_reviews_callback');
add_action('wp_ajax_easybook_addons_dasboard_your_reviews', 'easybook_addons_dasboard_your_reviews_callback');

function easybook_addons_dasboard_your_reviews_callback() {
    
    $json = array(
        'success' => false,
        'data' => array(
            // 'POST'=>$_POST,
        ),
        'comments' => array(),
        'pagi' => array(),
    );
    $nonce = $_POST['_nonce'];
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        $json['error'] = __( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ; 
        wp_send_json($json );
    }
    $paged = 1;
    $user_id = isset($_POST['user_id'])? $_POST['user_id'] : 0;
	if( is_numeric($user_id) && $user_id > 0 ){
        if(isset($_POST['paged']) && (int)$_POST['paged'] > 1){
            $paged = (int)$_POST['paged'];
        }

        $comments_per_page = easybook_addons_dashboard_posts_per_page();

        $listing_args = array(
            'post_type'         =>  'listing', 
            'author'            =>  $user_id, 
            // 'orderby'       =>  'date',
            // 'order'         =>  'DESC',
            // 'paged'         => $paged,
            'posts_per_page'    => -1,//-1 no limit

            'post_status'       => 'publish',
            'fields'            => 'ids'
        );

        $listings = get_posts( $listing_args );
        $listings_IDs = array();

        if(!empty($listings)){ 
            foreach ($listings as $list_ID) {
                $listings_IDs[] = $list_ID;
            }
        }
        if($listings_IDs){
            $comment_args = array(
                'post__in'          => $listings_IDs,
                'author__not_in'    => array($user_id), 

                // 'number'                 => 5,
                // 'offset'               => ($paged - 1) * 5,
                'status'               => 'approve' //Change this to the type of comments to be displayed
            );

            $comments_count = get_comments( 
                array_merge(
                    $comment_args, 
                    array(
                        'count'                 => true,
                    )
                )
            );

            $comments = get_comments( 
                array_merge(
                    $comment_args, 
                    array(
                        'number'                 => $comments_per_page,
                        'offset'               => ($paged - 1) * $comments_per_page,
                    )
                )
            );
            if($comments){
                foreach($comments as $comment) :
                    $rates = get_post_meta($comment->comment_post_ID, ESB_META_PREFIX.'rating_average', true);
                    $rating = 0;
                    if ($rates != '' && is_numeric($rates)) {
                        $rating = (float)$rates;
                    }
                    $json['comments'][] = (object) array(
                        'id'                => $comment->comment_ID,
                        'author_name'       => $comment->comment_author,
                        'avatar'            => get_avatar($comment->comment_author_email,'150','https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=150', $comment->comment_author ),
                        'listing_title'     => get_the_title( $comment->comment_post_ID ),
                        'listing_url'       => get_permalink( $comment->comment_post_ID ),
                        'date'              => $comment->comment_date,
                        'comment'           => $comment->comment_content,
                        'link_author'       => $comment->comment_author_url,
                        'rate'              => easybook_addons_rating_text($rating),
                        'rates'             => $rating,
                    );
                endforeach;
            }

            $json['pagi']['range'] = 2;
            $json['pagi']['paged'] = $paged;
            $json['pagi']['pages'] = ceil($comments_count / $comments_per_page);
        }
    }else{
        $json['error'] = __( 'The author id is incorrect.', 'easybook-add-ons' ) ;
        wp_send_json($json );
    }
    $json['success'] = true;
    wp_send_json($json );

}