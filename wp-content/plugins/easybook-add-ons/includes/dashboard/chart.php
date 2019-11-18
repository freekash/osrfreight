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


add_action('wp_ajax_nopriv_easybook_addons_data_chart', 'easybook_addons_data_chart_callback');
add_action('wp_ajax_easybook_addons_data_chart', 'easybook_addons_data_chart_callback');
function easybook_addons_data_chart_callback() {
    
    $json = array(
        'success' => false, 
        'data' => array(
            // 'POST'=>$_POST,
        ),
        'chart' => array(),
    );
    $nonce = $_POST['_nonce'];
    if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
        $json['data']['error'] = __( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ;  
        wp_send_json($json );
    }
    $user_id = isset($_POST['user_id'])? $_POST['user_id'] : 0;  
    if( is_numeric($user_id) && $user_id > 0 ){
 		$date_range = strtotime ( '-7 day' );  
	    $args = array(
	        'fields'            => 'ids', 
	        'posts_per_page'    => -1,
	        'post_type'         => 'listing',
	        'author'            => $user_id,
	        'post_status'       => 'publish',
	   //      'date_query' 		=> array(
	   //      	array(
	   //      		'column' => 'post_date',
    //                 'after' => array(
    //                     // 'year'  => date('Y', $date_range ),
    //                     // 'month' => date('m', $date_range ),
    //                     // 'day'   => date('d', $date_range ),
    //                     'year' => date( 'Y' ),
				// 		'week' => date( 'W' ),
    //                 ),
    //             )
    //   //           array(
	   //   //    		'column' => 'post_date',
    //   //               'before' => array(
    //   //                   // 'year'  => date('Y', $date_range ),
    //   //                   // 'month' => date('m', $date_range ),
    //   //                   // 'day'   => date('d', $date_range ),
    //   //                   'year' => date( 'Y' ),
				// 		// 'week' => date( 'W' ),
    //   //               ),
    //   //           )
    // //             array(
				// // 	'year' => date( 'Y' ),
				// // 	'week' => date( 'W' ),
				// // ),
	   //      )
	    );
	    $listings_ID = get_posts( $args );
	    // $json['data']['listings_ID'] = $listings_ID;

        $data_period = isset($_POST['period'])? $_POST['period'] : 'week'; 

        $chart_datas = array();

        if($data_period == 'alltime'){
            // for alltime stats
            $listing_views = Esb_Class_LStats::get_datas($listings_ID, $data_period);
            $earning_rows = Esb_Class_Earning::get_datas($user_id, $data_period);

            $alltime_years = array_merge( array_column($listing_views, 'year'), array_column($earning_rows, 'year') );
            $alltime_years = array_unique($alltime_years);

            asort($alltime_years);

            // $json['earning_rows'] = $earning_rows;
            // $json['alltime_years'] = $alltime_years;
            
            if(!empty($alltime_years)){
                foreach ($alltime_years as $year) {
                    $lview_row = array_search($year, array_column($listing_views, 'year'));
                    if($lview_row === false)
                        $lview = 0;
                    else
                        $lview = $listing_views[$lview_row]['sum'];
                    $earning_row = array_search($year, array_column($earning_rows, 'year'));
                    if($earning_row === false)
                        $earning = 0;
                    else
                        $earning = $earning_rows[$earning_row]['sum'];
                    $chart_datas[] = array(
                        'date_string'       => $year,
                        'label'             => $year,
                        'views'             => $lview,
                        'booking'           => $earning,
                    );
                }
            }
            // end alltime stats
        }else{
            // for week - month and year stats
            $limit = false; 

            if($data_period == 'week'){
                $day_in_week = date('N');
                $cur_day = date('d');

                if($day_in_week == 1){
                    $start_date = date('Y-m-d');
                }else{
                    $cur_seconds = date('U');
                    $diff_days = $day_in_week - 1;
                    $start_date = date('Y-m-d', $cur_seconds - DAY_IN_SECONDS * $diff_days );
                }

                // $json['start_date'] = $start_date;

                $label_arr = array(
                    __( 'Monday', 'easybook-add-ons' ),
                    __( 'Tuesday', 'easybook-add-ons' ),
                    __( 'Wednesday', 'easybook-add-ons' ),
                    __( 'Thursday', 'easybook-add-ons' ),
                    __( 'Friday', 'easybook-add-ons' ),
                    __( 'Saturday', 'easybook-add-ons' ),
                    __( 'Sunday', 'easybook-add-ons' ),
                );

                $limit = 7;

                $add_param = $start_date;

            }elseif($data_period == 'month'){
                $cur_year = date('Y');
                $cur_month = date('m');
                if(isset($_POST['date']) && $_POST['date'] != '' && strlen($_POST['date']) == 7){
                    $cur_year = substr($_POST['date'], 0, 4) ;
                    $cur_month = substr($_POST['date'], -2) ;
                } 

                $limit = cal_days_in_month(CAL_GREGORIAN, $cur_month, $cur_year);
                $label_arr = range(1, $limit);

                $add_param = $cur_year . $cur_month;
            }elseif($data_period == 'year'){
                $cur_year = date('Y');
                if(isset($_POST['date']) && $_POST['date'] != '') $cur_year = $_POST['date'];
                // $cur_month = date('m');
                $limit = 12;
                $label_arr = range(1, $limit);

                $add_param = $cur_year;
            }

            

            $listing_views = Esb_Class_LStats::get_datas($listings_ID, $data_period, $add_param);
            $earning_rows = Esb_Class_Earning::get_datas($user_id, $data_period, $add_param);

            // $json['listing_views'] = $listing_views;

            for ($i = 0; $i < $limit ; $i++) { 
                if($data_period == 'week'){
                    $date_string = easybook_addons_booking_date_modify($start_date, $i, 'Y-m-d');
                    $lview_row = array_search($date_string, array_column($listing_views, 'date'));
                    $earning_row = array_search($date_string, array_column($earning_rows, 'date'));
                }
                elseif($data_period == 'month'){
                    $date_string = "$cur_year-$cur_month-".sprintf('%02d', $i+1);
                    $lview_row = array_search($date_string, array_column($listing_views, 'date'));
                    $earning_row = array_search($date_string, array_column($earning_rows, 'date'));
                }
                elseif($data_period == 'year'){
                    $date_string = "$cur_year-".sprintf('%02d', $i+1);
                    $lview_row = array_search( $date_string, array_map(function($year_date){return substr($year_date, 0, 7);}, array_column($listing_views, 'date')) );
                    $earning_row = array_search( $date_string, array_map(function($year_date){return substr($year_date, 0, 7);}, array_column($earning_rows, 'date')) );
                }

                // $lview_row = array_search($date_string, array_column($listing_views, 'date'));
                if($lview_row === false)
                    $lview = 0;
                else
                    $lview = $listing_views[$lview_row]['sum'];

                if($earning_row === false)
                    $earning = 0;
                else
                    $earning = $earning_rows[$earning_row]['sum'];

                // if(isset($listing_views[$i])) $lview = $listing_views[$i]['sum'];
                $chart_datas[$i] = array(
                    'date_string'       => $date_string,
                    'label'             => $label_arr[$i],
                    'views'             => $lview,
                    'booking'           => $earning,
                );
            }
            // end week - month and year stats
        }

        // $json['chart'] = array_reverse($chart_datas);
        $json['chart'] = $chart_datas;

        $json['success'] = true;

	 //    $lbooking_post =array(
	 //        'post_type'     =>  'lbooking', 
	 //        'post_status'   => 'publish',
	 //        // 'meta_query' =>  array(
	 //        // // show user bookings
	 //        //     array(
	 //        //         'relation' => 'AND',
	 //        //         array(
	 //        //             'key'     => ESB_META_PREFIX.'lb_email',
	 //        //             'value'   => $current_user->user_email,
	 //        //         ),
	 //        //     ),
	 //        // )

		// );
  //   	$count_lbokking = count($lbooking_post);
  //   	$json['data']['count_lbokking']= $count_lbokking;
    }else{
        $json['data']['error'] = __( 'The author id is incorrect.', 'easybook-add-ons' ) ;
    }
    
    wp_send_json($json );

}