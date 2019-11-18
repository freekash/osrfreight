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


// for ajax search
add_action('wp_ajax_nopriv_easybook_addons_ajax_search', 'easybook_addons_ajax_search_callback');
add_action('wp_ajax_easybook_addons_ajax_search', 'easybook_addons_ajax_search_callback');

function easybook_addons_ajax_search_callback() {
    // global $wp_query;
    $json = array(
        'success' => true,
        'data' => array(
            // 'POST'=>$_POST,
        ),
        'debug'     => false,
    );
    // wp_send_json($json );

    $nonce = $_POST['_nonce'];
    
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        $json['success'] = false;
        $json['data']['error'] = esc_html__( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ;

        // die ( '<p class="error">Security checked!, Cheatn huh?</p>' );

        wp_send_json($json );
    }

    // track for ajax request
    $json['data']['ajax_count']     = $_POST['ajax_count'];
    $post_args = array();







    // if( isset($_POST['search_term']) && $_POST['search_term'] != '' ) $post_args['s'] = $_POST['search_term'] ;

    $tax_queries = array();
    $merge_lcats = array();
    if(isset($_POST['lcats'])) $merge_lcats = array_merge( $merge_lcats, array_filter($_POST['lcats']) );
    if(isset($_POST['filter_subcats']) && !empty($_POST['filter_subcats'])) $merge_lcats =  array_filter($_POST['filter_subcats']);
    // if( isset($_POST['lcats']) && !empty( array_filter($_POST['lcats']) ) ){
    if( !empty( $merge_lcats ) ){
        $tax_queries[] =    array(
                                'taxonomy' => 'listing_cat',
                                'field'    => 'term_id',
                                'terms'    => $merge_lcats,
                                // 'include_children'  => false, // default true
                                // 'operator' => 'AND', // default IN
                            );
        // if($_SERVER['SERVER_NAME'] == 'easybook.cththemes.com' || $_SERVER['SERVER_NAME'] == 'easybook2.cththemes.com'){

        // }
        
    }else if( $_SERVER['SERVER_NAME'] == 'easybook.cththemes.net' || $_SERVER['SERVER_NAME'] == 'easybook.cththemes.com' || $_SERVER['SERVER_NAME'] == 'easybook2.cththemes.com'){

        $tax_queries[] =    array(
                                'taxonomy' => 'listing_cat',
                                'field'    => 'term_id',
                                'terms'    => array( 309 ),
                                'operator' => 'NOT IN',
                                // 'include_children'  => false, // default true
                            );
    }
    if( isset($_POST['lfeas']) && !empty( array_filter($_POST['lfeas']) ) ){
        $tax_queries[] =    array(
                                'taxonomy' => 'listing_feature',
                                'field'    => 'slug',
                                'terms'    => $_POST['lfeas'],
                                'operator' => 'AND', // default IN
                            );
    }
    if( isset($_POST['llocs']) && !empty($_POST['llocs'] ) ){
        $tax_queries[] =    array(
                                'taxonomy' => 'listing_location',
                                'field'    => 'slug',
                                // 'terms'    => sanitize_title($_POST['llocs']),
                                'terms'    => $_POST['llocs'],
                            );
    }
    if( isset($_POST['ltags']) && !empty( array_filter($_POST['ltags']) ) ){
        $tax_queries[] =    array(
                                'taxonomy' => 'post_tag',
                                'field'    => 'term_id',
                                'terms'    => $_POST['ltags'],
                                'operator' => 'AND', // default IN
                            );
    }

    if( isset($_POST['listing_tags']) && !empty( $_POST['listing_tags'] ) ){
        $tax_queries[] =    array(
                                'taxonomy' => 'listing_tag',
                                'field'    => 'term_id',
                                'terms'    => $_POST['listing_tags'],
                                'operator' => 'AND', // default IN
                            );
    }

    if(!empty($tax_queries)){
        if( count($tax_queries) > 1 ) $tax_queries['relation'] = easybook_addons_get_option('search_tax_relation');
        $post_args['tax_query'] = $tax_queries;
    } 

    if( isset($_POST['checkin']) && $_POST['checkin'] != '' ){

        $post__in_sum = easybook_addons_listing_available_date( $_POST['checkin'] );

        if( isset($_POST['checkout']) && $_POST['checkout'] != '' ){
            $avai_check_args = array(
                'checkin'   => $_POST['checkin'],
                'checkout'   => $_POST['checkout'],
                'listing_id'   => 0,
            );
            $listing_availables = easybook_addons_get_available_listings($avai_check_args);
            if(is_array($listing_availables) && !empty($listing_availables)){
                $post__in = array();
                foreach ($listing_availables as $avai) {
                    if( isset($avai->id) && (int)$avai->id > 0){
                        if(isset($_POST['no_rooms']) && (int)$_POST['no_rooms'] > 1){
                            $avai_check_args['listing_id'] = $avai->id;
                            // check quantity
                            $double_check = easybook_addons_get_available_listings($avai_check_args);
                            if(!empty($double_check)){
                                $room_quans = array_map(function($room){
                                    return ((int)$room->quantities > 0) ? (int)$room->quantities : 0;
                                },$double_check);
                                $room_quans = array_filter($room_quans);
                                if(array_sum($room_quans) >= $_POST['no_rooms']) $post__in[] = $avai->id;
                            }
                        }else{
                            $post__in[] = $avai->id;
                        }
                    }
                }
                $post__in_sum = array_merge($post__in_sum, $post__in);
            } 
        }
        $post__in_sum = array_filter($post__in_sum);
        if(!empty($post__in_sum)) $post_args['post__in'] = $post__in_sum;
    }

    // custom field query
    $meta_queries = array();

    if( isset($_POST['rating']) && !empty($_POST['rating'] ) ){
        $meta_queries[] =    array(
                                    'key'           => ESB_META_PREFIX.'rating_average',
                                    'value'         => $_POST['rating'],
                                    'compare'       => '>='
                                );
    }

    
    // address_add value
    // if( isset($_POST['search_term']) && !empty($_POST['search_term'] ) ){
    //     $address_q = explode(",", $_POST['search_term']);
    //     $addes_qr = array();
    //     foreach ($address_q as $add_r) {
    //         $addes_qr[] =    array(
    //                             'key' => ESB_META_PREFIX.'address',
    //                             'value'    => trim($add_r),
    //                             'compare' => 'LIKE',
    //                         );
    //     }
    //     if(count($addes_qr)> 1) $addes_qr['relation'] = 'OR';
        
    //     $meta_queries[] = $addes_qr;
    // }

    // price_range filter
    if( isset($_POST['price_range']) && !empty($_POST['price_range'] ) ){
        $range = explode(";", $_POST['price_range']);
        $range = array_map(function($val){
            return easybook_addons_parse_price($val);
        }, $range);
        // $range = array_filter($range);
        // $json['price_range'] = $range;
        if(count($range) == 2){

            $meta_queries[] = array(
                'key'     => '_price',
                'value'   => $range,
                'type'    => 'numeric',
                'compare' => 'BETWEEN',
            );

            // $meta_queries[] = array(
            //                     'relation' => 'AND',
            //                     array(
            //                             'key' => '_price',
            //                             'value'    => $range[0],
            //                             'compare'    => '>=',
            //                     ),
            //                     array(
            //                             'key' => '_price',
            //                             'value'    => $range[1],
            //                             'compare'    => '<=',
            //                     ),
            //                 );
        }
            
    }

    // query by date
    
    // if( isset($_POST['event_date']) && !empty($_POST['event_date'] ) ){
    //     $meta_queries[] =    array(
    //                                     'key'       => ESB_META_PREFIX.'levent_date',
    //                                     'value'     => $_POST['event_date'],
    //                                     'compare'   => '>=',
    //                                     'type'      => 'DATE'
    //                                 );
    // }
    // if( isset($_POST['event_time']) && !empty($_POST['event_time'] ) ){
    //     $meta_queries[] =    array(
    //                                     'key'       => ESB_META_PREFIX.'levent_time',
    //                                     'value'     => $_POST['event_time'],
    //                                     'compare'   => '>=',
    //                                     'type'      => 'TIME'
    //                                 );
    // }

        
    

    if(!empty($meta_queries)){
        if(count($meta_queries)> 1) $meta_queries['relation'] = 'AND';
        $post_args['meta_query'] = $meta_queries;
    } 

    
    $post_args['post_type'] = 'listing';
    $post_args['post_status'] = 'publish';
    $post_args['posts_per_page'] = easybook_addons_get_option('listings_count');
    $post_args['orderby'] = easybook_addons_get_option('listings_orderby');
    $post_args['order'] = easybook_addons_get_option('listings_order');

    if( isset($_POST['lposts_per_page']) ) $post_args['posts_per_page'] = $_POST['lposts_per_page'];
    if( isset($_POST['lorderby']) ) $post_args['orderby'] = $_POST['lorderby'];
    if( isset($_POST['lorder']) ) $post_args['order'] = $_POST['lorder'];
    
    if( ( isset($_POST['lorderby']) && $_POST['lorderby'] == 'listing_featured' ) || easybook_addons_get_option('listings_orderby') == 'listing_featured'){
        $post_args['meta_key'] = ESB_META_PREFIX.'featured';
        $post_args['orderby'] = 'meta_value';
        // https://wordpress.stackexchange.com/questions/45413/using-orderby-and-meta-value-num-to-order-numbers-first-then-strings
    }

    if(easybook_addons_get_option('listings_orderby') == 'event_start_date'){
        $post_args['meta_key'] = ESB_META_PREFIX.'levent_date';
        $post_args['meta_type'] = 'DATE';
        $post_args['orderby'] = 'meta_value_date';
    }


    $post_args['suppress_filters'] = false; // for additional wpdb query
    $post_args['cthqueryid'] = 'ajax-search';
    $post_args['paged'] = 1;
    if( isset($_POST['paged']) && is_numeric($_POST['paged']) ) $post_args['paged'] = $_POST['paged'];

    // meta prder
    if( isset($_POST['morderby']) && !empty($_POST['morderby'] ) ){
        switch ($_POST['morderby']) {
            case 'most_reviewed':
                $post_args['orderby'] = 'comment_count';
                $post_args['order'] = 'DESC';
                break;
            case 'most_viewed':
                $post_args['meta_key'] = ESB_META_PREFIX.'post_views_count';
                $post_args['orderby'] = 'meta_value_num';
                $post_args['order'] = 'DESC';
                break;
            case 'most_liked':
                $post_args['meta_key'] = ESB_META_PREFIX.'post_like_count';
                $post_args['orderby'] = 'meta_value_num';
                $post_args['order'] = 'DESC';
                break;
            case 'highest_rated':
                $post_args['meta_key'] = ESB_META_PREFIX.'rating_average';
                $post_args['orderby'] = 'meta_value_num';
                $post_args['order'] = 'DESC';
                break;
            case 'price_desc':
                $post_args['meta_key'] = '_price';
                $post_args['orderby'] = 'meta_value_num';
                $post_args['order'] = 'DESC';
                break;
            case 'price_asc':
                $post_args['meta_key'] = '_price';
                $post_args['orderby'] = 'meta_value_num';
                $post_args['order'] = 'ASC';
                break;
                
        }
    }
    

    
    // if(isset($_POST['status']) && $_POST['status'] == 'open'){
    //     $get_post_args = $post_args;
    //     $get_post_args['suppress_filters'] = true;
    //     // $get_post_args['offset'] = 0;

    //     $get_post_args['fields'] = 'ids';
    //     $get_post_args['posts_per_page'] = -1;
        
    //     $open_posts_list = get_posts( $get_post_args );
    //     $open_posts = array();
    //     foreach ( $open_posts_list as $post_ID ) {
    //         $wkhour = easybook_addons_get_working_hours($post_ID);
    //         if($wkhour['status'] === 'opening') $open_posts[] = $post_ID;
    //     }
    //     $json['data']['open_posts'] = $open_posts;
    //     if(!empty($open_posts)){
    //         $post_args['post__in'] = $open_posts;
    //     }else{
    //         $json['data']['posts'] = array();
    //         $json['data']['pagination'] = '';
    //         wp_send_json($json );
    //     }
    // }

    // fix search cache result
    $post_args['cache_results'] = false;
    $post_args['update_post_meta_cache'] = false;
    $post_args['update_post_term_cache'] = false;

    // add filter for custom filter field
    $post_args = apply_filters( 'easybook_addons_ajax_search_args', $post_args );
    
    // $json['data']['posts_query_after'] = $post_args;
    

    $posts_query = new WP_Query($post_args);

    // $json['data']['custom_sql'] = $posts_query->request;

    $json['data']['listings'] = '';
    if($posts_query->have_posts()): 
        while($posts_query->have_posts()) : $posts_query->the_post();
            
            ob_start();
            easybook_addons_get_template_part('template-parts/listing');
            $json['data']['listings'] .= ob_get_clean();
        endwhile;
    endif;
    ob_start(); 
    easybook_addons_ajax_pagination( $posts_query->max_num_pages,$range = 2, $posts_query );
    $json['data']['pagination'] = ob_get_clean();

    wp_reset_postdata();
    // https://premium.wpmudev.org/blog/load-posts-ajax/
    wp_send_json($json );

}

// add_filter( 'easybook_addons_ajax_search_args', function($post_args){
//     $tax_queries = isset($post_args['tax_query']) && is_array($post_args['tax_query']) ? $post_args['tax_query'] : array();

//     if( isset($_POST['stars']) && !empty( $_POST['stars'] ) ){
//         $tax_queries[] =    array(
//                                 'taxonomy' => 'campings_etoiles',
//                                 'field'    => 'slug',
//                                 'terms'    => $_POST['stars'],
//                                 'operator' => 'AND', // default IN
//                             );
//     }

//     if(!empty($tax_queries)){
//         if( count($tax_queries) > 1 ) $tax_queries['relation'] = easybook_addons_get_option('search_tax_relation');
//         $post_args['tax_query'] = $tax_queries;
//     } 

//     return $post_args;

// } );

add_filter( 'posts_clauses', 'easybook_addons_posts_clauses_callback', 999, 2 );

function easybook_addons_posts_clauses_callback($clauses, $query_obj){

    global $wpdb;
    if($query_obj->get('cthqueryid') == 'ajax-search' || $query_obj->get('cthqueryid') == 'main-search') {
        // echo'<pre>';
        // var_dump($clauses);
        // --->
        // array(7) {
        //   ["where"]=>
        //   string(369) " AND wp_posts.ID IN (5192,5130,1886) AND wp_posts.post_type = 'listing' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'tribe-ea-success' OR wp_posts.post_status = 'tribe-ea-failed' OR wp_posts.post_status = 'tribe-ea-schedule' OR wp_posts.post_status = 'tribe-ea-pending' OR wp_posts.post_status = 'tribe-ea-draft' OR wp_posts.post_status = 'private')"
        //   ["groupby"]=>
        //   string(0) ""
        //   ["join"]=>
        //   string(0) ""
        //   ["orderby"]=>
        //   string(23) "wp_posts.post_date DESC"
        //   ["distinct"]=>
        //   string(0) ""
        //   ["fields"]=>
        //   string(10) "wp_posts.*"
        //   ["limits"]=>
        //   string(10) "LIMIT 0, 6"
        // }
        $fields = '';
        $joins = '';
        $having = array();
        $wheres = array();
        if( isset($_POST['nearme-filter']) && $_POST['nearme-filter'] == 'yes' && isset($_POST['address_lat']) && !empty($_POST['address_lat'] ) && isset($_POST['address_lng']) && !empty($_POST['address_lng'] ) && isset($_POST['ldistance']) && $_POST['ldistance'] ){
            $fields .= $wpdb->prepare(
                ", ( 6371 * acos( cos( radians( %s ) ) * cos( radians( distance_lat.meta_value ) ) * cos( radians( distance_lng.meta_value ) - radians( %s ) ) + sin( radians( %s ) ) * sin( radians( distance_lat.meta_value ) ) ) ) AS listing_distance ",
                $_POST['address_lat'], 
                $_POST['address_lng'], 
                $_POST['address_lat']
            );
            $joins .= $wpdb->prepare(
                " INNER JOIN $wpdb->postmeta distance_lat ON distance_lat.post_id = {$wpdb->posts}.ID AND distance_lat.meta_key = %s"
                . " INNER JOIN  $wpdb->postmeta distance_lng ON distance_lng.post_id = {$wpdb->posts}.ID AND distance_lng.meta_key = %s ",
                '_cth_latitude',
                '_cth_longitude'
            );

            $having[] = "listing_distance < '{$_POST['ldistance']}'";
        }

        // https://stackoverflow.com/questions/14950466/how-to-split-the-name-string-in-mysql
        // https://stackoverflow.com/questions/12344795/count-the-number-of-occurrences-of-a-string-in-a-varchar-field

        $search_term_string = '';
        if( isset($_REQUEST['search_term']) ){
            if( is_array($_REQUEST['search_term']) )
                $search_term_string = reset($_REQUEST['search_term']);
            else 
                $search_term_string = $_REQUEST['search_term'];
        }
        $search_term_string = trim($search_term_string);
        if( $search_term_string != '' ){
            $address_q = explode(",", $search_term_string);
            $address_qr = array();
            foreach ($address_q as $add_r) {
                $address_qr[] =   $wpdb->prepare("laddress_meta.meta_value LIKE %s", '%' . $wpdb->esc_like(trim($add_r)) . '%');
            }
            $address_qr_text = '';
            if(!empty($address_qr)){
                $address_qr_text = "OR ( ".implode(" OR ", $address_qr)." )";
            }

            // $wheres[] = $wpdb->prepare("({$wpdb->posts}.post_title LIKE %s OR {$wpdb->posts}.post_content LIKE %s)", '%' . $wpdb->esc_like($_REQUEST['search_term']) . '%', '%' . $wpdb->esc_like($_REQUEST['search_term']) . '%');
            // $title_like = $wpdb->prepare("{$wpdb->posts}.post_title LIKE %s", '%' . $wpdb->esc_like($_REQUEST['search_term']) . '%');
            // $title_like .= $wpdb->prepare(" OR {$wpdb->posts}.post_content LIKE %s", '%' . $wpdb->esc_like($_REQUEST['search_term']) . '%');
            // $title_like .= " OR $address_qr";
            $joins .= $wpdb->prepare(
                " LEFT JOIN $wpdb->postmeta AS laddress_meta ON laddress_meta.post_id = {$wpdb->posts}.ID AND laddress_meta.meta_key = %s",
                '_cth_address'
                
            );
            // $joins .= " AND ($title_like)";
            // $joins .= " AND $address_qr";

            $search_term_esc = '%' . $wpdb->esc_like($search_term_string) . '%';
            $post_tag_like = '';
            if(easybook_addons_get_option('tag_search_enable', 'yes') == 'yes'){
                $post_tag_like = $wpdb->prepare( " OR EXISTS (
                        SELECT 1
                        FROM $wpdb->term_relationships
                        INNER JOIN $wpdb->term_taxonomy
                        ON $wpdb->term_taxonomy.term_taxonomy_id = $wpdb->term_relationships.term_taxonomy_id
                        INNER JOIN $wpdb->terms 
                        ON $wpdb->terms.term_id = $wpdb->term_taxonomy.term_id AND $wpdb->terms.name LIKE %s 
                        WHERE $wpdb->term_taxonomy.taxonomy = %s
                        AND $wpdb->term_relationships.object_id = {$wpdb->posts}.ID
                    )", $search_term_esc, 'post_tag' );
            }
            $wheres[] = $wpdb->prepare(
                "(({$wpdb->posts}.post_title LIKE %s OR {$wpdb->posts}.post_content LIKE %s) $address_qr_text $post_tag_like)", 
                $search_term_esc, 
                $search_term_esc
            );

        }


        $clauses[ 'fields' ] .= $fields ;
        $clauses[ 'join' ] .= $joins ;

        if(!empty($having)){
            $distance_groupby = '';
            if(empty($clauses[ 'groupby' ])) $distance_groupby = "{$wpdb->posts}.ID";

            $clauses[ 'groupby' ] .= " $distance_groupby HAVING ".implode(" AND ", $having);
        }

        if(!empty($wheres)){
            $clauses[ 'where' ] .= " AND ".implode(" AND ", $wheres);
        }

        // var_dump($clauses);die;
            
    }

    return $clauses;
}

function easybook_addons_get_available_listings( $available_args = array() /*$checkin = '', $checkout = '', $listing_id = 0*/){ // 63,65,1886
    global $wpdb;
    $checkin = easybook_addons_booking_date_modify($available_args['checkin'], 0, 'Ymd');
    $checkout = easybook_addons_booking_date_modify($available_args['checkout'], 0, 'Ymd');


    $listing_type_ID = get_post_meta( $available_args['listing_id'], ESB_META_PREFIX.'listing_type_id', true );
    $child_pt = get_post_meta( $listing_type_ID, ESB_META_PREFIX.'child_type_meta', true );
    $child_type = ($child_pt == 'product') ? 'product' : 'lrooms';
    

    if(empty($checkin) || empty($checkout)) return array();
    // key1 -> listing_id
    // key2 -> calendar
    // key3 -> calendar
    $post_type      = $child_type;
    $post_status    = 'publish';
    $meta_key1      = '_cth_for_listing_id';
    $meta_key2      = '_cth_calendar';
    $meta_key3      = '_cth_quantity';

    $booking_table = $wpdb->prefix . 'cth_booking';

    

    $fields = "DISTINCT key1.meta_value AS id";
    $from = "$wpdb->postmeta AS key1";

    

    $join_1 = $wpdb->prepare("INNER JOIN  $wpdb->postmeta AS key2 ON key2.post_id = key1.post_id AND key2.meta_key = %s", $meta_key2);
    $join_2 = "LEFT JOIN $booking_table bookings ON bookings.room_id = key1.post_id AND bookings.status = 1";
    $join_3 = $wpdb->prepare("INNER JOIN  $wpdb->postmeta AS key3 ON key3.post_id = key1.post_id AND key3.meta_key = %s", $meta_key3);
    $join_4 = $wpdb->prepare("INNER JOIN  $wpdb->posts AS posts ON posts.ID = key1.post_id AND posts.post_type = %s AND posts.post_status = %s", $post_type, $post_status);

    

    $where_1 = $wpdb->prepare("key1.meta_key = %s", $meta_key1);

    $diff = easybook_addons_booking_nights($checkin, $checkout);

    if($diff > 0){
        $date_arr = array();
        for ($i=0; $i <= $diff ; $i++) { 
            $modified_date = easybook_addons_booking_date_modify($checkin, $i, 'Ymd');
            if($modified_date){
                $date_arr[] = $wpdb->prepare( "key2.meta_value LIKE %s", '%' . $wpdb->esc_like($modified_date) . '%');
            }  
        }
        $where_2 =  "(". implode(' AND ', $date_arr).")";
    }else{
        $where_2 =  $wpdb->prepare( "key2.meta_value LIKE %s", '%' . $wpdb->esc_like($checkin) . '%');
    }

    // $where_3 = $wpdb->prepare("(CASE 
    //                 WHEN bookings.ID IS NULL
    //                     THEN key3.meta_value > 0 
    //                 ELSE 
    //                     (CASE
    //                         WHEN (bookings.date_to >= %s AND bookings.date_from >= %s) OR (bookings.date_to <= %s AND bookings.date_to <= %s)
    //                             THEN key3.meta_value > 0 
    //                         ELSE
    //                             key3.meta_value - (SELECT SUM(quantities.quantity) FROM $booking_table AS quantities WHERE 
    //                                                 quantities.room_id = key1.post_id AND 
    //                                                 ((quantities.date_to >= %s AND quantities.date_to <= %s) OR (quantities.date_from >= %s AND quantities.date_from <= %s) OR (quantities.date_from >= %s AND quantities.date_to <= %s) OR (quantities.date_from <= %s AND quantities.date_to >= %s)) 
    //                                                 ) > 0
    //                     END)
    //             END)", $checkin, $checkout,   $checkin, $checkout,   $checkin, $checkout,   $checkin, $checkout,   $checkin, $checkout,   $checkin, $checkout );

    $where_3 = $wpdb->prepare("(CASE 
                    WHEN bookings.ID IS NULL
                        THEN key3.meta_value > 0 
                    ELSE 
                        (CASE
                            WHEN (SELECT @quantityVar := SUM(quantities.quantity) FROM $booking_table AS quantities WHERE 
                                                    quantities.room_id = key1.post_id AND 
                                                    ((quantities.date_to >= %s AND quantities.date_to <= %s) OR (quantities.date_from >= %s AND quantities.date_from <= %s) OR (quantities.date_from >= %s AND quantities.date_to <= %s) OR (quantities.date_from <= %s AND quantities.date_to >= %s)) 
                                    ) IS NULL THEN key3.meta_value > 0 
                            ELSE
                                key3.meta_value - @quantityVar > 0
                        END)
                END)", $checkin, $checkout,   $checkin, $checkout,   $checkin, $checkout,   $checkin, $checkout );

    


    $groupby = '';
    $orderby = 'ORDER BY id DESC';
    $limits = '';
    $found_rows = '';
    $distinct = '';

    if(isset($available_args['listing_id']) && is_numeric($available_args['listing_id']) && (int)$available_args['listing_id'] > 0){
        $fields = $wpdb->prepare("DISTINCT key1.post_id AS id, (CASE  WHEN (SELECT @quantityVar := SUM(bookings.quantity) FROM $booking_table AS bookings WHERE bookings.room_id = key1.post_id AND bookings.status = 1 AND ((bookings.date_to >= %s AND bookings.date_to <= %s) OR 
                                    (bookings.date_from >= %s AND bookings.date_from <= %s) OR 
                                    (bookings.date_from >= %s AND bookings.date_to <= %s) OR 
                                    (bookings.date_from <= %s AND bookings.date_to >= %s)) ) IS NULL THEN key3.meta_value ELSE key3.meta_value - @quantityVar  END) AS quantities 
                                    ", $checkin, $checkout,   $checkin, $checkout,   $checkin, $checkout,   $checkin, $checkout
                                );
        $join_2 = '';


        $meta_key1 = '_cth_for_listing_id';
        $where_1 = $wpdb->prepare("key1.meta_key = %s AND key1.meta_value = %s", $meta_key1, $available_args['listing_id']);
        $where_3 = "1=1";
    }

    $joins = $join_1 . ' ' . $join_2 . ' ' . $join_3 . ' ' . $join_4 ;
    $wheres = $where_1 . ' AND ' . $where_2 . ' AND ' . $where_3  ;

    $request = "SELECT $found_rows $distinct $fields FROM $from $joins WHERE 1=1 AND $wheres $groupby $orderby $limits";

    $postids = $wpdb->get_results($request);
    // var_dump($postids);

    if ( $postids ) return $postids;
    return array();
}

function easybook_addons_listing_available_date($checkin = ''){
    global $wpdb;
    $checkin = easybook_addons_booking_date_modify($checkin, 0, 'Ymd');
    if( empty($checkin) ) return array();
    $calendars =    array(
                        // 'house_dates',
                        // 'event_dates',
                        // 'tour_dates',
                        'listing_dates',
                    );

    

    $fields = "DISTINCT key1.post_id AS id";
    $from = "$wpdb->postmeta AS key1";

    $where_keys = array();
    foreach ($calendars as $mtkey) {
        $where_keys[] = $wpdb->prepare("key1.meta_key = %s", ESB_META_PREFIX.$mtkey);
    }

    $where_1 = '('.implode(' OR ', $where_keys).')';

    $where_2 =  $wpdb->prepare( "key1.meta_value LIKE %s", '%' . $wpdb->esc_like($checkin) . '%');


    $groupby = '';
    $orderby = 'ORDER BY id DESC';
    $limits = '';
    $found_rows = '';
    $distinct = '';

    $joins = '';
    $wheres = $where_1 . ' AND ' . $where_2  ;

    $request = "SELECT $found_rows $distinct $fields FROM $from $joins WHERE 1=1 AND $wheres $groupby $orderby $limits";

    // $postids = $wpdb->get_results($request);
    $postids = $wpdb->get_col($request);
    // var_dump($postids);

    if ( $postids ) return $postids;
    return array();
}

add_filter( 'posts_clauses', 'easybook_addons_auto_locate_posts_clauses_callback', 999, 2 );

function easybook_addons_auto_locate_posts_clauses_callback($clauses, $query_obj){
    global $wpdb;
    if( $query_obj->get('cthqueryid') == 'auto-locate' ) {

        $fields = '';
        $joins = '';
        $having = array();
        $wheres = array();

        $latitude = ESB_ADO()->geo->get('lat');
        $longitude = ESB_ADO()->geo->get('lng');
        if( !empty($latitude) && !empty($longitude) ){
            $fields .= $wpdb->prepare(
                ", ( 6371 * acos( cos( radians( %s ) ) * cos( radians( distance_lat.meta_value ) ) * cos( radians( distance_lng.meta_value ) - radians( %s ) ) + sin( radians( %s ) ) * sin( radians( distance_lat.meta_value ) ) ) ) AS listing_distance ",
                $latitude, 
                $longitude, 
                $latitude
            );
            $joins .= $wpdb->prepare(
                " INNER JOIN $wpdb->postmeta distance_lat ON distance_lat.post_id = {$wpdb->posts}.ID AND distance_lat.meta_key = %s"
                . " INNER JOIN  $wpdb->postmeta distance_lng ON distance_lng.post_id = {$wpdb->posts}.ID AND distance_lng.meta_key = %s ",
                '_cth_latitude',
                '_cth_longitude'
            );

            $distance = apply_filters( 'cth_nearby_distance', 50 );

            $having[] = "listing_distance < '$distance'";
        }

        $clauses[ 'fields' ] .= $fields ;
        $clauses[ 'join' ] .= $joins ;

        if(!empty($having)){
            $distance_groupby = '';
            if(empty($clauses[ 'groupby' ])) $distance_groupby = "{$wpdb->posts}.ID";

            $clauses[ 'groupby' ] .= " $distance_groupby HAVING ".implode(" AND ", $having);
        }

        if(!empty($wheres)){
            $clauses[ 'where' ] .= " AND ".implode(" AND ", $wheres);
        }
            
    }

    return $clauses;

}

