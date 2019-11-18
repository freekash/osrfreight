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


/*
https://github.com/JonMasterson/WordPress-Post-Like-System
*/

/**
 * Register the stylesheets for the public-facing side of the site.
 * @since    0.5
 */
// add_action( 'wp_enqueue_scripts', 'easybook_addons_like_enqueue_scripts' );
function easybook_addons_like_enqueue_scripts() {
    wp_enqueue_script( 'easybook_addons_like-js', get_template_directory_uri() . '/js/like-post.js', array( 'jquery' ), false, true );
    wp_localize_script( 'easybook_addons_like-js', '_cth_like', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'like' => esc_html__( 'Like', 'easybook-add-ons' ),
        'unlike' => esc_html__( 'Unlike', 'easybook-add-ons' )
    ) ); 
}

/**
 * Processes like/unlike
 * @since    0.5
 */
add_action( 'wp_ajax_nopriv_easybook_addons_like', 'easybook_addons_process_like' );
add_action( 'wp_ajax_easybook_addons_like', 'easybook_addons_process_like' );
function easybook_addons_process_like() {
    // Security
    $nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( $_POST['nonce'] ) : 0;
    if ( !wp_verify_nonce( $nonce, 'easybook_addons-like' ) ) {
        exit( esc_html__( 'Not permitted', 'easybook-add-ons' ) );
    }
    // Test if javascript is disabled
    $disabled = ( isset( $_POST['disabled'] ) && $_POST['disabled'] == true ) ? true : false;
    // Test if this is a comment
    $is_comment = ( isset( $_POST['is_comment'] ) && $_POST['is_comment'] == 1 ) ? 1 : 0;
    // Base variables
    $post_id = ( isset( $_POST['post_id'] ) && is_numeric( $_POST['post_id'] ) ) ? $_POST['post_id'] : '';

    $result = array();
    $post_users = NULL;
    $like_count = 0;
    // Get plugin options
    if ( $post_id != '' ) {
        $count = ( $is_comment == 1 ) ? get_comment_meta( $post_id, "_cth_comment_like_count", true ) : get_post_meta( $post_id, "_cth_post_like_count", true ); // like count
        $count = ( isset( $count ) && is_numeric( $count ) ) ? $count : 0;
        if ( !easybook_addons_already_liked( $post_id, $is_comment ) ) { // Like the post
            if ( is_user_logged_in() ) { // user is logged in
                $user_id = get_current_user_id();
                $post_users = easybook_addons_post_user_likes( $user_id, $post_id, $is_comment );
                if ( $is_comment == 1 ) {
                    // Update User & Comment
                    $user_like_count = get_user_option( "_cth_comment_like_count", $user_id );
                    $user_like_count =  ( isset( $user_like_count ) && is_numeric( $user_like_count ) ) ? $user_like_count : 0;
                    update_user_option( $user_id, "_cth_comment_like_count", ++$user_like_count );
                    if ( $post_users ) {
                        update_comment_meta( $post_id, "_cth_user_comment_liked", $post_users );
                    }
                } else {
                    // Update User & Post
                    $user_like_count = get_user_option( "_cth_user_like_count", $user_id );
                    $user_like_count =  ( isset( $user_like_count ) && is_numeric( $user_like_count ) ) ? $user_like_count : 0;
                    update_user_option( $user_id, "_cth_user_like_count", ++$user_like_count );
                    if ( $post_users ) {
                        update_post_meta( $post_id, "_cth_user_liked", $post_users );
                    }
                }
            } else { // user is anonymous
                $user_ip = easybook_addons_get_ip();
                $post_users = easybook_addons_post_ip_likes( $user_ip, $post_id, $is_comment );
                // Update Post
                if ( $post_users ) {
                    if ( $is_comment == 1 ) {
                        update_comment_meta( $post_id, "_cth_user_comment_IP", $post_users );
                    } else { 
                        update_post_meta( $post_id, "_cth_user_IP", $post_users );
                    }
                }
            }
            $like_count = ++$count;
            $response['status'] = "liked";
            $response['icon'] = easybook_addons_get_liked_icon();
        } else { // Unlike the post
            if ( is_user_logged_in() ) { // user is logged in
                $user_id = get_current_user_id();
                $post_users = easybook_addons_post_user_likes( $user_id, $post_id, $is_comment );
                // Update User
                if ( $is_comment == 1 ) {
                    $user_like_count = get_user_option( "_cth_comment_like_count", $user_id );
                    $user_like_count =  ( isset( $user_like_count ) && is_numeric( $user_like_count ) ) ? $user_like_count : 0;
                    if ( $user_like_count > 0 ) {
                        update_user_option( $user_id, "_cth_comment_like_count", --$user_like_count );
                    }
                } else {
                    $user_like_count = get_user_option( "_cth_user_like_count", $user_id );
                    $user_like_count =  ( isset( $user_like_count ) && is_numeric( $user_like_count ) ) ? $user_like_count : 0;
                    if ( $user_like_count > 0 ) {
                        update_user_option( $user_id, '_cth_user_like_count', --$user_like_count );
                    }
                }
                // Update Post
                if ( $post_users ) {    
                    $uid_key = array_search( $user_id, $post_users );
                    unset( $post_users[$uid_key] );
                    if ( $is_comment == 1 ) {
                        update_comment_meta( $post_id, "_cth_user_comment_liked", $post_users );
                    } else { 
                        update_post_meta( $post_id, "_cth_user_liked", $post_users );
                    }
                }
            } else { // user is anonymous
                $user_ip = easybook_addons_get_ip();
                $post_users = easybook_addons_post_ip_likes( $user_ip, $post_id, $is_comment );
                // Update Post
                if ( $post_users ) {
                    $uip_key = array_search( $user_ip, $post_users );
                    unset( $post_users[$uip_key] );
                    if ( $is_comment == 1 ) {
                        update_comment_meta( $post_id, "_cth_user_comment_IP", $post_users );
                    } else { 
                        update_post_meta( $post_id, "_cth_user_IP", $post_users );
                    }
                }
            }
            $like_count = ( $count > 0 ) ? --$count : 0; // Prevent negative number
            $response['status'] = "unliked";
            $response['icon'] = easybook_addons_get_unliked_icon();
        }
        if ( $is_comment == 1 ) {
            update_comment_meta( $post_id, "_cth_comment_like_count", $like_count );
            update_comment_meta( $post_id, "_cth_comment_like_modified", date( 'Y-m-d H:i:s' ) );
        } else { 
            update_post_meta( $post_id, "_cth_post_like_count", $like_count );
            update_post_meta( $post_id, "_cth_post_like_modified", date( 'Y-m-d H:i:s' ) );
        }
        $response['count'] = easybook_addons_get_like_count( $like_count , true);
        $response['testing'] = $is_comment;
        if ( $disabled == true ) {
            if ( $is_comment == 1 ) {
                wp_redirect( get_permalink( get_the_ID() ) );
                exit();
            } else {
                wp_redirect( get_permalink( $post_id ) );
                exit();
            }
        } else {
            wp_send_json( $response );
        }
    }
}

/**
 * Utility to test if the post is already liked
 * @since    0.5
 */
function easybook_addons_already_liked( $post_id, $is_comment ) {
    $post_users = NULL;
    $user_id = NULL;
    if ( is_user_logged_in() ) { // user is logged in
        $user_id = get_current_user_id();
        $post_meta_users = ( $is_comment == 1 ) ? get_comment_meta( $post_id, "_cth_user_comment_liked" ) : get_post_meta( $post_id, "_cth_user_liked" );
        if ( count( (array)$post_meta_users ) != 0 ) {
            $post_users = $post_meta_users[0];
        }
    } else { // user is anonymous
        $user_id = easybook_addons_get_ip();
        $post_meta_users = ( $is_comment == 1 ) ? get_comment_meta( $post_id, "_cth_user_comment_IP" ) : get_post_meta( $post_id, "_cth_user_IP" ); 
        if ( count( (array)$post_meta_users ) != 0 ) { // meta exists, set up values
            $post_users = $post_meta_users[0];
        }
    }
    if ( is_array( $post_users ) && in_array( $user_id, $post_users ) ) {
        return true;
    } else {
        return false;
    }
} // easybook_addons_already_liked()

/**
 * Output the like button
 * @since    0.5
 */
function easybook_addons_get_likes_button( $post_id, $is_comment = NULL ) {
    $is_comment = ( NULL == $is_comment ) ? 0 : 1;
    $output = '';
    $nonce = wp_create_nonce( 'easybook_addons-like' ); // Security
    if ( $is_comment == 1 ) {
        // $post_id_class = esc_attr( ' easybook_addons-like-comment-button-' . $post_id );
        // $comment_class = esc_attr( ' easybook_addons-like-comment' );
        $like_count = get_comment_meta( $post_id, "_cth_comment_like_count", true );
        $like_count = ( isset( $like_count ) && is_numeric( $like_count ) ) ? $like_count : 0;
    } else {
        // $post_id_class = esc_attr( ' easybook_addons-like-button-' . $post_id );
        // $comment_class = esc_attr( '' );
        $like_count = get_post_meta( $post_id, "_cth_post_like_count", true );
        $like_count = ( isset( $like_count ) && is_numeric( $like_count ) ) ? $like_count : 0;
    }
    $count = easybook_addons_get_like_count( $like_count , true);
    $icon_empty = easybook_addons_get_unliked_icon();
    $icon_full = easybook_addons_get_liked_icon();
    // Loader
    $loader = '<span id="easybook_addons-like-loader"><i class="fa fa-spinner fa-pulse"></i></span>';
    // Liked/Unliked Variables
    if ( easybook_addons_already_liked( $post_id, $is_comment ) ) {
        $class = esc_attr( ' liked' );
        $title = esc_html__( 'Unlike', 'easybook-add-ons' );
        $icon = $icon_full;
    } else {
        $class = '';
        $title = esc_html__( 'Like', 'easybook-add-ons' );
        $icon = $icon_empty;
    }
    $output = '<span class="easybook_addons-like-wrapper"><a href="#" class="easybook_addons-like-button' . $class  . '" data-nonce="' . $nonce . '" data-post-id="' . $post_id . '" data-iscomment="' . $is_comment . '" title="' . $title . '">'.$count.$icon.'</a>'.$loader.'</span>';
    return $output;
} // easybook_addons_get_likes_button()

/**
 * Output the like button
 * @since    0.5
 */
function easybook_addons_get_likes_stats( $post_id, $is_comment = NULL ) {
    $is_comment = ( NULL == $is_comment ) ? 0 : 1;
    $output = '';
    if ( $is_comment == 1 ) {
        $like_count = get_comment_meta( $post_id, "_cth_comment_like_count", true );
        $like_count = ( isset( $like_count ) && is_numeric( $like_count ) ) ? $like_count : 0;
    } else {
        $like_count = get_post_meta( $post_id, "_cth_post_like_count", true );
        $like_count = ( isset( $like_count ) && is_numeric( $like_count ) ) ? $like_count : 0;
    }
    $count = easybook_addons_get_like_count( $like_count, true );
    $icon_empty = easybook_addons_get_unliked_icon();
    $icon_full = easybook_addons_get_liked_icon();
    // Liked/Unliked Variables
    if ( easybook_addons_already_liked( $post_id, $is_comment ) ) {
        $class = esc_attr( ' liked' );
        $icon = $icon_full;
    } else {
        $class = ' click-to-like';
        $icon = $icon_empty;
    }

    $output = '<span class="'.$class.'">'.$count .$icon .'</span>';

    // $output = '<span class="easybook_addons-like-wrapper"><a href="' . admin_url( 'admin-ajax.php?action=easybook_addons_process_like' . '&post_id=' . $post_id . '&nonce=' . $nonce . '&is_comment=' . $is_comment . '&disabled=false' ) . '" class="easybook_addons-like-button' . $post_id_class . $class . $comment_class . '" data-nonce="' . $nonce . '" data-post-id="' . $post_id . '" data-iscomment="' . $is_comment . '" title="' . $title . '">' . $icon .$count . '</a>' . $loader . '</span>';
    return $output;
} // easybook_addons_get_likes_stats()


/**
 * Utility retrieves post meta user likes (user id array), 
 * then adds new user id to retrieved array
 * @since    0.5
 */
function easybook_addons_post_user_likes( $user_id, $post_id, $is_comment ) {
    $post_users = '';
    $post_meta_users = ( $is_comment == 1 ) ? get_comment_meta( $post_id, "_cth_user_comment_liked" ) : get_post_meta( $post_id, "_cth_user_liked" );
    if ( count( (array)$post_meta_users ) != 0 ) {
        $post_users = $post_meta_users[0];
    }
    if ( !is_array( $post_users ) ) {
        $post_users = array();
    }
    if ( !in_array( $user_id, $post_users ) ) {
        $post_users['user-' . $user_id] = $user_id;
    }
    return $post_users;
} // easybook_addons_post_user_likes()

/**
 * Utility retrieves post meta ip likes (ip array), 
 * then adds new ip to retrieved array
 * @since    0.5
 */
function easybook_addons_post_ip_likes( $user_ip, $post_id, $is_comment ) {
    $post_users = '';
    $post_meta_users = ( $is_comment == 1 ) ? get_comment_meta( $post_id, "_cth_user_comment_IP" ) : get_post_meta( $post_id, "_cth_user_IP" );
    // Retrieve post information
    if ( count( (array)$post_meta_users ) != 0 ) {
        $post_users = $post_meta_users[0];
    }
    if ( !is_array( $post_users ) ) {
        $post_users = array();
    }
    if ( !in_array( $user_ip, $post_users ) ) {
        $post_users['ip-' . $user_ip] = $user_ip;
    }
    return $post_users;
} // easybook_addons_post_ip_likes()

/**
 * Utility to retrieve IP address
 * @since    0.5
 */
function easybook_addons_get_ip() {
    if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) && ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) && ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = ( isset( $_SERVER['REMOTE_ADDR'] ) ) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
    }
    $ip = filter_var( $ip, FILTER_VALIDATE_IP );
    $ip = ( $ip === false ) ? '0.0.0.0' : $ip;
    return $ip;
} // easybook_addons_get_ip()

/**
 * Utility returns the button icon for "like" action
 * @since    0.5
 */
function easybook_addons_get_liked_icon() {
    $icon = '<i class="fa fa-heart" aria-hidden="true"></i>';
    return $icon;
} // easybook_addons_get_liked_icon()

/**
 * Utility returns the button icon for "unlike" action
 * @since    0.5
 */
function easybook_addons_get_unliked_icon() {
    $icon = '<i class="fa fa-heart-o" aria-hidden="true"></i>';
    return $icon;
} // easybook_addons_get_unliked_icon()

/**
 * Utility function to format the button count,
 * appending "K" if one thousand or greater,
 * "M" if one million or greater,
 * and "B" if one billion or greater (unlikely).
 * $precision = how many decimal points to display (1.25K)
 * @since    0.5
 */
function easybook_addons_format_count( $number ) {
    $precision = 2;
    if ( $number >= 1000 && $number < 1000000 ) {
        $formatted = number_format( $number/1000, $precision ).'K';
    } else if ( $number >= 1000000 && $number < 1000000000 ) {
        $formatted = number_format( $number/1000000, $precision ).'M';
    } else if ( $number >= 1000000000 ) {
        $formatted = number_format( $number/1000000000, $precision ).'B';
    } else {
        $formatted = $number; // Number is less than 1000
    }
    $formatted = str_replace( '.00', '', $formatted );
    return $formatted;
} // easybook_addons_format_count()

/**
 * Utility retrieves count plus count options, 
 * returns appropriate format based on options
 * @since    0.5
 */
function easybook_addons_get_like_count( $like_count, $show_zero = false ) {
    $like_text = esc_html__( 'Like', 'easybook-add-ons' );
    if ( is_numeric( $like_count ) && $like_count > 0 ) { 
        $number = easybook_addons_format_count( $like_count );
    } else {
        if($show_zero){
            $number = '0';
        }else{
            $number = $like_text;
        }
        
    }
    $count = '<span class="easybook_addons-like-count">' . $number . '</span>';
    return $count;
} // easybook_addons_get_like_count()

// User Profile List
function easybook_addons_show_user_likes( $user ) { ?>        
    <table class="form-table">
        <tr>
            <th><label for="user_likes"><?php _e( 'You Like:', 'easybook-add-ons' ); ?></label></th>
            <td>
            <?php
            $types = get_post_types( array( 'public' => true ) );
            $args = array(
              'numberposts' => -1,
              'post_type' => $types,
              'meta_query' => array (
                array (
                  'key' => '_cth_user_liked',
                  'value' => $user->ID,
                  'compare' => 'LIKE'
                )
              ) );      
            $sep = '';
            $like_query = new WP_Query( $args );
            if ( $like_query->have_posts() ) : ?>
            <p>
            <?php while ( $like_query->have_posts() ) : $like_query->the_post(); 
            echo $sep; ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
            <?php
            $sep = ' &middot; ';
            endwhile; 
            ?>
            </p>
            <?php else : ?>
            <p><?php _e( 'You do not like anything yet.', 'easybook-add-ons' ); ?></p>
            <?php 
            endif; 
            wp_reset_postdata(); 
            ?>
            </td>
        </tr>
    </table>
<?php } // easybook_addons_show_user_likes()

