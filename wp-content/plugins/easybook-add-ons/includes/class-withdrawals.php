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

class Esb_Class_Withdrawals{

    public static function authorWithdrawals($author_id = 0){
        $au_withdrawals = get_posts(array(
            'post_type'        => 'lwithdrawal', 
            'fields'           => 'ids',
            'posts_per_page'   => -1,
            'post_status'      => 'publish',
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key'     => ESB_META_PREFIX.'status',
                    'compare' => 'IN',
                    'value'   => array('pending', 'completed'),
                ),
                array(
                    'key'     => ESB_META_PREFIX.'user_id',
                    'value'   => $author_id,
                    'type'    => 'numeric',
                ),
            ),
        ));
        $withdrawals_amount = 0;
        if($au_withdrawals){
            foreach ($au_withdrawals as $w_id) {
                $withdrawals_amount += (float)get_post_meta( $w_id, ESB_META_PREFIX.'amount', true );
            }
        }
        return $withdrawals_amount;
    }

    public static function getWithdrawalsPosts($user_id = 0){
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
        $args = array(
            'post_type'         => 'lwithdrawal', 
            // 'fields'           => 'id',
            // 'author'           =>  $user_id,
            'meta_key'          => ESB_META_PREFIX.'user_id',
            'meta_value_num'    => $user_id,
            'post_status'       => 'publish',
            'paged'             => $paged,
        );
        if(isset($_POST['paged']) && $_POST['paged'] != ''){
            $paged = $_POST['paged'];
            $args['paged'] = $_POST['paged'];
        }
        $posts_query = new WP_Query( $args );
        if($posts_query->have_posts()) :
             while($posts_query->have_posts()) : $posts_query->the_post(); 
                $json['posts'][] = (object) array(
                    'ID'                        => get_the_ID(),
                    'title'                     => get_the_title(  ),
                    'email'                     => get_post_meta( get_the_ID(), ESB_META_PREFIX.'withdrawal_email', true),
                    'method'                    => easybook_addons_get_order_method_text(get_post_meta( get_the_ID(), ESB_META_PREFIX.'payment_method', true )),
                    'amount'                    => easybook_addons_get_price_formated(get_post_meta( get_the_ID(), ESB_META_PREFIX.'amount', true )),
                    'created'                   => get_the_date( get_option( 'date_format' ), get_the_ID() ),
                    'status'                    => get_post_meta( get_the_ID(), ESB_META_PREFIX.'status', true ),
                    'status_text'               => easybook_addons_get_booking_status_text(get_post_meta( get_the_ID(), ESB_META_PREFIX.'status', true )),
                );

            endwhile;
            $json['pagi']['range'] = 2;
            $json['pagi']['paged'] = $paged;
            $json['pagi']['pages'] = $posts_query->max_num_pages;

            wp_reset_postdata();

            

        endif;

        return $json;
    }
    
    public static function getPendingWithdrawals($user_id = 0){
        $pending_withdrawals = get_posts(array(
            'post_type'        => 'lwithdrawal', 
            'fields'           => 'ids',
            'posts_per_page'   => -1,
            // 'author'           =>  $user_id,
            'post_status'      => 'publish',

            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key'     => ESB_META_PREFIX.'status',
                    'value'   => 'pending',
                ),
                array(
                    'key'     => ESB_META_PREFIX.'user_id',
                    'value'   => $user_id,
                    'type'    => 'numeric',
                ),
            ),
        ));
        $pending_amount = 0;
        if($pending_withdrawals){
            foreach ($pending_withdrawals as $pd_id) {
                $pending_amount += (float)get_post_meta( $pd_id, ESB_META_PREFIX.'amount', true );
            }
        }
        return $pending_amount;
    }

}

// Esb_Class_Withdrawals::init();