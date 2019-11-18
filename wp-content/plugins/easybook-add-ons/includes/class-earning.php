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



defined( 'ABSPATH' ) || exit;


class Esb_Class_Earning{

    public static function init(){
        add_action( 'before_delete_post', array( __CLASS__, 'before_delete_post' ), 10, 1 );
    }
    public static function getBalance($author_id = 0){
        global $wpdb;
        $tb_name = $wpdb->prefix . 'cth_austats';

        // $type = 'author_earning';

        $author_earning = $wpdb->get_var( 
            $wpdb->prepare( 
                "
                SELECT SUM(earning) FROM $tb_name 
                WHERE author_id = %d AND ((type = %s AND status = 1) OR (type = %s AND status IN (0,1)))
                ",
                $author_id,
                'author_earning',
                'author_withdrawal'
            )
        );

        if($author_earning === NULL) 
            return 0;

        return $author_earning;
    }

    public static function insert($order_id = 0, $author_id = 0, $listing_id = 0){
        global $wpdb;
        $tb_name = $wpdb->prefix . 'cth_austats';
        $year = date('Y');
        $month = date('m');
        $date = date('Y-m-d');
        $time = date('U');

        $type = 'author_earning';

        if($order_id && $author_id){
            $author_fee = get_user_meta($author_id, ESB_META_PREFIX.'author_fee', true);
            if(empty($author_fee)) $author_fee = apply_filters('esb_author_fee_default', 10);

            $order_total = get_post_meta( $order_id, ESB_META_PREFIX.'price_total', true );
            $earning = $order_total * (1 - floatval($author_fee)/100);

            $earning = (float)apply_filters('esb_booking_author_earning', $earning, $order_id, $listing_id, $author_id);

            $stats_meta = '';
            // $stats_meta = maybe_serialize( array( array( 'time' => $time, 'ip' => $ip, 'user_id' => $user_id ) ) );
            $inserted = $wpdb->insert( 
                $tb_name, 
                array( 
                    'author_id'                 => $author_id,
                    'order_id'                  => $order_id, 
                    'child_post_id'             => 0, 
                    'type'                      => $type, 
                    'total'                     => $order_total, 
                    'fee_rate'                  => $author_fee, 
                    'fee'                       => $order_total - $earning, 
                    'earning'                   => $earning, 
                    'meta'                      => $stats_meta, 
                    'year'                      => $year, 
                    'month'                     => $month, 
                    'date'                      => $date, 
                    'time'                      => $time, 
                    'status'                    => 1,
                ) 
            );
            if($inserted !== false) return $earning;
        }
        return false;
    }

    public static function insert_withdrawal($withdrawal_id = 0){
        global $wpdb;
        $tb_name = $wpdb->prefix . 'cth_austats';
        $year = date('Y');
        $month = date('m');
        $date = date('Y-m-d');
        $time = date('U');

        $type = 'author_withdrawal';

        if( $withdrawal_id ){
            $author_fee = 0;
            

            $order_total = get_post_meta( $withdrawal_id, ESB_META_PREFIX.'amount', true );
            $author_id = get_post_meta( $withdrawal_id, ESB_META_PREFIX.'user_id', true );
            
            $stats_meta = '';
            // $stats_meta = maybe_serialize( array( array( 'time' => $time, 'ip' => $ip, 'user_id' => $user_id ) ) );
            $inserted = $wpdb->insert( 
                $tb_name, 
                array( 
                    'author_id'                 => $author_id,
                    'order_id'                  => $withdrawal_id, 
                    'child_post_id'             => 0, 
                    'type'                      => $type, 
                    'total'                     => $order_total, 
                    'fee_rate'                  => $author_fee, 
                    'fee'                       => $author_fee, 
                    'earning'                   => -$order_total, 
                    'meta'                      => $stats_meta, 
                    'year'                      => $year, 
                    'month'                     => $month, 
                    'date'                      => $date, 
                    'time'                      => $time, 
                    'status'                    => 0,
                ) 
            );

            if($inserted !== false) return $order_total;
        }
        return false;
    }

    public static function getEarningsPosts($user_id = 0){
        global $wpdb;
        $tb_name = $wpdb->prefix . 'cth_austats';
        $type = 'author_earning';
        $json = array(
            'posts' => array(),
            'pagi' => array(
                'range' => 2,
                'paged' => 1,
                'pages' => 1,
            ),
        );
        // The Query
        $paged = 1;
        $limit_sql = '';
        // $found_rows = '';

        if(isset($_POST['paged']) && $_POST['paged'] != '' && is_numeric($_POST['paged'])){
            $paged = intval($_POST['paged']);
        }
        $posts_per_page = easybook_addons_dashboard_posts_per_page();
        if($posts_per_page > 0){
            $limit_sql = $wpdb->prepare( "LIMIT %d", $posts_per_page);
            if($paged > 1){
                $offset = ( $paged - 1 ) * $posts_per_page;
                $limit_sql = $wpdb->prepare( "LIMIT %d OFFSET %d", $posts_per_page, $offset);
            }
            // $found_rows = 'SQL_CALC_FOUND_ROWS';
        }
        
        $author_earnings = $wpdb->get_results( 
            $wpdb->prepare( 
                "
                SELECT * FROM $tb_name 
                WHERE author_id = %d AND type = %s AND status = 1 ORDER BY time DESC $limit_sql
                ",
                $user_id,
                $type
            )
        );

        // $json['wpdb'] = $wpdb;
        
        if(!empty($author_earnings)){
            foreach ($author_earnings as $earning) {
                $earning_data = array(
                    // 'ID'                    => $earning->ID,
                    'order_id'              => $earning->order_id,
                    // 'order_data'            => sprintf( __( '# %d', 'easybook-add-ons' ), $earning->order_id ),
                    'total'                 => easybook_addons_get_price_formated($earning->total),
                    'fee_rate'              => sprintf( __( '%d %% - ', 'easybook-add-ons' ), number_format( (float)$earning->fee_rate, 2 ) ),
                    'fee'                   => easybook_addons_get_price_formated($earning->fee),
                    'earning'               => easybook_addons_get_price_formated($earning->earning),
                    // 'date'                  => $earning->date,
                    'time'                  => date_i18n( get_option('date_format'), $earning->time, true ) ,
                    // 'meta'                  => $earning->meta,
                );

                $earning_data['order_data'] = '<div class="earn-order-data">'.get_the_title($earning->order_id).'<br />'.sprintf( __( '# %d', 'easybook-add-ons' ), $earning->order_id ).'</div>';

                $earning_data = apply_filters( 'esb_earning_data', $earning_data, $earning->order_id, $earning );

                $json['posts'][] = (object) $earning_data;
            }
            
            // $found_posts = $wpdb->get_var( 'SELECT FOUND_ROWS()' );
            $found_posts = $wpdb->get_var( 
                $wpdb->prepare( 
                    "
                    SELECT COUNT(*) FROM $tb_name 
                    WHERE author_id = %d AND type = %s AND status = 1 ORDER BY time DESC
                    ",
                    $user_id,
                    $type
                )
                //"SELECT COUNT(*) FROM {$wpdb->posts} $join WHERE 1=1 $where" 
            );
            // $json['found_posts'] = $found_posts;
            $json['pagi']['paged'] = $paged;
            $json['pagi']['pages'] = ceil( $found_posts / $posts_per_page );

        }

        return $json;
    }

    public static function update($order_id = 0, $type = 'author_withdrawal'){
        global $wpdb;
        $tb_name = $wpdb->prefix . 'cth_austats';
        $wpdb->update( 
            $tb_name, 
            array( 
                'status' => 1,  
            ), 
            array( 
                'order_id' => $order_id,  
                'type' => $type,
            ), 
            array( 
                '%d',
            ), 
            array( 
                '%d', 
                '%s', 
            ) 
        );
    }

    public static function get_datas($author_id = 0, $data_period = 'week', $add_param = '', $type = 'author_earning'){
        global $wpdb;
        $tb_name = $wpdb->prefix . 'cth_austats';
        if($author_id && (int)$author_id > 0){
            
            switch ($data_period) {
                case 'alltime':
                    $add_query = " GROUP BY year ORDER BY year ASC";
                    $add_params = array();
                    break;
                case 'year':
                    $add_query = "AND year = %s GROUP BY month ORDER BY month ASC LIMIT %d";
                    $add_params = array($add_param , 12);
                    break;
                case 'month':
                    $mparam = substr($add_param, -2);
                    $yparam = substr($add_param, 0, 4);
                    $add_query = "AND month = %s AND year = %s GROUP BY date ORDER BY date ASC LIMIT %d";
                    $add_params = array($mparam, $yparam, 31);
                    break;
                default:
                    $add_query = "AND date >= %s GROUP BY date ORDER BY date ASC LIMIT %d";
                    $add_params = array($add_param, 7);
                    break;
            }

            $main_query = "SELECT SUM(earning) AS sum, year, month, date FROM $tb_name WHERE author_id = %d AND type = %s $add_query";

            $list_stats = $wpdb->get_results( $wpdb->prepare( $main_query, array_merge( array($author_id, $type), $add_params ) ), ARRAY_A );

            // var_dump($list_stats);

            return $list_stats;
        }
        return array();
    }

    // before delete booking and room post
    public static function before_delete_post($postid = 0){
        global $wpdb;
        $post_type = get_post_type($postid);
        $tb_name = $wpdb->prefix . 'cth_austats';
        if($post_type === 'lbooking' ){
            $wpdb->query( 
                $wpdb->prepare( 
                    "
                    DELETE FROM $tb_name
                    WHERE type = %s AND (order_id = %d OR child_post_id = %d)
                    ",
                    'author_earning',
                    $postid,
                    $postid
                )
            );
        }elseif($post_type === 'lwithdrawal' ){
            $wpdb->query( 
                $wpdb->prepare( 
                    "
                    DELETE FROM $tb_name
                    WHERE type = %s AND (order_id = %d OR child_post_id = %d)
                    ",
                    'author_withdrawal',
                    $postid,
                    $postid
                )
            );
        }
    }

}
Esb_Class_Earning::init();


