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



// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// redirect page for dashboard
function easybook_addons_dashboard_page_template_redirect(){
    $dashboard_page_id = easybook_addons_get_option('dashboard_page');  
    if( ($dashboard_page_id && is_page( $dashboard_page_id )) )
    {
        if (! is_user_logged_in()) {
            wp_redirect( home_url( '/' ) ); 
            die;
        }
            
    }
}
add_action( 'template_redirect', 'easybook_addons_dashboard_page_template_redirect' );

/*
https://wordpress.stackexchange.com/questions/192360/current-user-can-edit-post-post-id-does-not-work-for-contributer-but-for
https://codex.wordpress.org/Function_Reference/map_meta_cap
https://developer.wordpress.org/reference/hooks/map_meta_cap/
https://wordpress.stackexchange.com/questions/108338/capabilities-and-custom-post-types
https://wordpress.stackexchange.com/questions/65418/admins-cant-edit-each-others-posts
*/
function easybook_addons_map_meta_cap( $caps, $cap, $user_id, $args ){
    if ( 'edit_post' == $cap ) {
        $post = get_post( $args[0] );
        $post_type = get_post_type_object( $post->post_type );
        $caps = array();
        if ( $user_id == $post->post_author )
            $caps[] = $post_type->cap->edit_posts;
        else
            $caps[] = $post_type->cap->edit_others_posts;
    }
    return $caps;
}
add_filter( 'map_meta_cap', 'easybook_addons_map_meta_cap', 10, 4 );



function easybook_addons_maintenance_mode() {
    global $pagenow;
    $mode = easybook_addons_get_option('maintenance_mode');
    $demo_mode = isset($_GET['demo_mode'])? $_GET['demo_mode'] : '';
    if ( $pagenow !== 'wp-login.php' && ! current_user_can( 'manage_options' ) && ! is_admin() && ($mode == 'maintenance'||$mode=='coming_soon'||$demo_mode =='maintenance'||$demo_mode =='coming_soon') ) {
        // wp_redirect( home_url( ) );// redirect to home page first
        header( $_SERVER["SERVER_PROTOCOL"] . __( ' 503 Service Temporarily Unavailable', 'easybook-add-ons' ), true, 503 );
        header( 'Content-Type: text/html; charset=utf-8' );
        if($mode == 'coming_soon'||$demo_mode =='coming_soon'){
            easybook_addons_get_template_part('templates/coming_soon');
        }else{
            header( 'Retry-After: 3600' );
            easybook_addons_get_template_part('templates/maintenance');
        } 
        // wp_die();
        die;
    }
}

add_action( 'wp_loaded', 'easybook_addons_maintenance_mode' );

if(!function_exists('easybook_addons_login_logout_sc')){
    function easybook_addons_login_logout_sc($atts, $content = ''){

        extract(shortcode_atts(array(
               'show_register' =>esc_html_x( 'no', 'Show register button: yes or no', 'easybook-add-ons' ),
               'show_register_when_logged_in'=>'no',
               'style'=>'two',
               'extraclass'=>''
         ), $atts));

        

        ob_start();
        // check if the user already login - the correct way is using is_user_logged_in()
        $current_user = wp_get_current_user();
        if ( 0 == $current_user->ID ) {
            // Not logged in.
            ?>
            <?php if($show_register == 'yes'){ ?>
            <div class="show-reg-form logreg-modal-open"><?php _e('<i class="fa fa-lock"></i>Register','easybook-add-ons');?></div>
            <?php } ?>
            <div class="show-reg-form logreg-modal-open"><?php _e('<i class="fa fa-sign-in"></i>Sign In','easybook-add-ons');?></div>
        <?php
        } else {
            // Logged in.
            ?>
            <div class="header-user-menu user-menu-<?php echo $style;?>">
                <div class="header-user-name user-name-<?php echo $style;?>">
                    <span class="au-avatar"><?php 
                        echo get_avatar($current_user->user_email,'80','https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=80', $current_user->display_name );
                    ?></span>
                    <?php echo esc_html__( 'My account',  'easybook-add-ons' ) ?>
                    <?php if($style != 'two'): ?>
                    <span class="au-name"><?php echo esc_html__( 'Hello , ',  'easybook-add-ons' ) . $current_user->display_name ; ?></span>
                    <?php endif; ?>
                </div>
                <ul>
                    <?php if($style == 'two'): ?>
                    <li><div class="au-name-li">
                        <h2 class="au-name"><?php echo esc_html__( 'Hello , ',  'easybook-add-ons' ) . $current_user->display_name ; ?></h2>
                        <div class="au-role"><?php echo easybook_addons_get_user_role_name() ; ?></div>
                        <?php if(Esb_Class_Membership::is_author()): ?>
                        <div class="au-earning"><a href="<?php echo easybook_addons_dashboard_screen('withdrawals');?>"><?php echo sprintf(__( 'Earning: %s', 'easybook-add-ons' ), easybook_addons_get_price_formated( Esb_Class_Earning::getBalance($current_user->ID) ) ) ;?></a></div>
                        <?php endif; ?>
                    </div></li>
                    <?php endif; ?>
                    <li><a href="<?php echo easybook_addons_dashboard_screen();?>"><?php _e( 'Dashboard', 'easybook-add-ons' );?></a></li> 
                <?php if( easybook_addons_current_user_can('view_listings_dashboard') ): ?>
                    <li><a href="<?php echo easybook_addons_add_listing_url();?>"><?php _e( 'Add Listing', 'easybook-add-ons' );?></a></li>
                    <li><a href="<?php echo easybook_addons_dashboard_screen('bookings');?>"><?php _e( 'Bookings', 'easybook-add-ons' );?></a></li>
                    <li><a href="<?php echo easybook_addons_dashboard_screen('reviews');?>"><?php _e( 'Comments', 'easybook-add-ons' );?></a></li>
                <?php else : ?>
                    <li><a href="<?php echo easybook_addons_dashboard_screen('bookings');?>"><?php _e( 'Bookings', 'easybook-add-ons' );?></a></li>
                    <li><a href="<?php echo easybook_addons_dashboard_screen('chats');?>"><?php _e( 'Messages', 'easybook-add-ons' );?></a></li>
                <?php endif; ?>
                    <li><a href="<?php echo wp_logout_url( easybook_addons_get_current_url() ); ?>"><?php _e('Log Out','easybook-add-ons');?></a></li>
                </ul>
            </div>
        <?php 
        }
        $output = ob_get_clean();

        if ( 0 == $current_user->ID ) add_action( 'wp_footer', 'easybook_addons_print_login_modal' );
        add_action( 'wp_footer', 'easybook_addons_single_map_modal' );

        return $output;

    }

    add_shortcode( 'easybook_login', 'easybook_addons_login_logout_sc' );
}

function easybook_addons_print_login_modal(){
    ?>

    <div class="main-register-wrap modal ctb-modal" id="ctb-logreg-modal"> 
        <div class="reg-overlay"></div>
        <div class="main-register-holder">
            <div class="main-register fl-wrap">
                <div class="ctb-modal-close close-reg color-bg"><i class="fal fa-times"></i></div>
                <ul class="tabs-menu">
                    <li class="current"><a href="#tab-1"><i class="fal fa-sign-in-alt"></i><?php esc_html_e(' Login','easybook-add-ons');?></a></li>
                    <li><a href="#tab-2"><i class="fal fa-user-plus"></i><?php esc_html_e(' Register','easybook-add-ons');?> </a></li>
                </ul>
                <!--tabs -->                       
                <div id="tabs-container">
                    <div class="tab">
                        <!--tab -->
                        <div id="tab-1" class="tab-content">
                            <h3><?php _e( 'Sign In ', 'easybook-add-ons' );?><span><?php bloginfo( 'name' );?></span></h3>
                            <div class="custom-form clearfix">
                                <?php do_action( 'easybook_log_form_before'); ?>
                                <form method="post" id="easybook-login">
                                    <div class="log-message"></div>
                                    <label for="user_login"><?php _e( 'Username or Email Address <span>*</span> ', 'easybook-add-ons' );?></label>
                                    <input id="user_login" name="log" type="text" onClick="this.select()" value="" required>

                                    <label for="user_pass"><?php _e( 'Password <span>*</span> ', 'easybook-add-ons' );?></label>
                                    <input id="user_pass" name="pwd" type="password" onClick="this.select()" value="" required>

                                    <?php easybook_addons_display_recaptcha('loginCaptcha'); ?>

                                    <button type="submit" id="log-submit" class="log-submit-btn"><span><?php _e( 'Log In', 'easybook-add-ons' );?><i class="fa fa-spinner fa-pulse"></i></span></button>

                                    <div class="clearfix"></div>
                                    <div class="filter-tags">
                                        <input name="rememberme" id="rememberme" value="true" type="checkbox">
                                        <label for="rememberme"><?php _e('Remember me','easybook-add-ons');?></label>
                                    </div>
                                    <?php
                                        $nonce = wp_create_nonce( 'easybook-login' );
                                    ?>
                                    <input type="hidden" name="_wpnonce" value="<?php echo $nonce; ?>">
                                    <?php 
                                    $login_redirect_page = easybook_addons_get_option('login_redirect_page');
                                    if($login_redirect_page != 'cth_current_page' && is_numeric($login_redirect_page) )
                                        $login_redirect_url = get_permalink( $login_redirect_page );
                                    else 
                                        $login_redirect_url = easybook_addons_get_current_url();

                                    ?>
                                    <input type="hidden" name="redirection" value="<?php echo $login_redirect_url; ?>" />
                                </form>
                                <div class="lost_password">
                                    <a class="lost-password" href="<?php echo wp_lostpassword_url( easybook_addons_get_current_url() ); ?>"><?php _e('Lost Your Password?','easybook-add-ons');?></a>
                                </div>
                            </div>
                        </div>
                        <!--tab end -->
                        <!--tab -->
                        <div class="tab">
                            <div id="tab-2" class="tab-content">
                               <h3><?php _e( 'Sign Up ', 'easybook-add-ons' );?><span><?php bloginfo( 'name' );?></span></h3>
                                <div class="custom-form">
                                    <?php do_action( 'easybook_reg_form_before'); ?>
                                    <form method="post" class="main-register-form" id="easybook-register">
                                        <div class="reg-message"></div>

                                        <p><?php esc_html_e( 'Account details will be confirmed via email.', 'easybook-add-ons' ); ?></p>

                                        <label for="reg_username"><?php _e( 'Username <span>*</span> ', 'easybook-add-ons' );?></label>
                                        <input id="reg_username" name="username" type="text"  onClick="this.select()" value="" required>

                                        <label for="reg_email"><?php _e( 'Email Address <span>*</span> ', 'easybook-add-ons' );?></label>
                                        <input id="reg_email" name="email" type="email"  onClick="this.select()" value="" required>
                                        <?php if(easybook_addons_get_option('register_password') == 'yes'): ?>
                                        <label for="reg_password"><?php _e( 'Password <span>*</span> ', 'easybook-add-ons' );?></label>
                                        <input id="reg_password" name="password" type="password" onClick="this.select()" value="" required>
                                        <?php endif; ?>
                                        <div class="terms_wrap">
                                            <?php if(easybook_addons_get_option('register_role') == 'yes'): ?>
                                            <div class="filter-tags">
                                                <input id="reg_lauthor" name="reg_lauthor" value="1" type="checkbox" required="required">
                                                <label for="reg_lauthor"><?php echo esc_html_e('Register as author','easybook-add-ons');?></label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(easybook_addons_get_option('register_term_text') != ''): ?>
                                            <div class="filter-tags">
                                                <input id="accept_term" name="accept_term" value="1" type="checkbox" required="required">
                                                <label for="accept_term"><?php echo easybook_addons_get_option('register_term_text');?></label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(easybook_addons_get_option('register_consent_data_text') != ''): ?>
                                            <div class="filter-tags">
                                                <input id="consent_data" name="consent_data" value="1" type="checkbox" required="required">
                                                <label for="consent_data"><?php echo easybook_addons_get_option('register_consent_data_text');?></label>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="clearfix"></div>

                                        <?php easybook_addons_display_recaptcha('regCaptcha'); ?>
                                        
                                        <button type="submit" id="reg-submit" class="log-submit-btn"><span><?php _e( 'Register', 'easybook-add-ons' );?><i class="fa fa-spinner fa-pulse"></i></span></button>

                                        <?php
                                            $nonce = wp_create_nonce( 'easybook-register' );
                                        ?>
                                        <input type="hidden" name="_wpnonce" value="<?php echo $nonce; ?>">

                                        <input type="hidden" name="redirection" value="<?php echo easybook_addons_get_current_url(); ?>" />

                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--tab end -->
                    </div>
                    <!--tabs end -->
                    <?php 
                    $logreg_form_after = easybook_addons_get_option('logreg_form_after');
                    if ( $logreg_form_after != '' ): ?>
                    <div class="log-separator fl-wrap"><span><?php _e( 'or', 'easybook-add-ons' );?></span></div>
                    <div class="soc-log fl-wrap">
                        <?php echo do_shortcode( $logreg_form_after ); ?>
                    </div>
                    <?php 
                    endif; 
                    do_action( 'easybook_logreg_form_after');
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="ctb-modal-wrap ctb-modal" id="ctb-resetpsw-modal">
        <div class="ctb-modal-holder">
            <div class="ctb-modal-inner">
                <div class="ctb-modal-close"><i class="fal fa-times"></i></div>
                <h3><?php _e( 'Reset <span>Your Password</span>', 'easybook-add-ons' );?></h3>
                <div class="ctb-modal-content">
                    
                    <form id="forget-password-form" class="reset-password-form custom-form" action="#" method="post">
                        
                        <fieldset>
                            <label for="user_reset"><?php _e( 'Username or Email Address <span>*</span> ', 'easybook-add-ons' );?></label>
                            <input id="user_reset" name="user_login" type="text"  value="" required>
                        </fieldset>
                        <input id="forgetpws-submit" class="btn color-bg" type="submit" value="<?php esc_attr_e( 'Get New Password', 'easybook-add-ons' ); ?>">
                        
                        <?php
                            $nonce = wp_create_nonce( 'easybook-forgetpsw' );
                        ?>
                        <input type="hidden" name="_wpnonce" value="<?php echo $nonce; ?>">
                    </form>
                    <div class="come-back-login">
                        <a class="logreg-modal-open btn-link" href="#"><?php _e('Go Back','easybook-add-ons');?></a>
                    </div>
                </div>
                <!-- end modal-content -->
            </div>
        </div>
    </div>
    <!-- end reset password modal --> 

    <?php
}

function easybook_addons_single_map_modal(){
    $smclass = 'singleMap';
    if(easybook_addons_get_option('use_osm_map') == 'yes') $smclass = 'singleMapOSM';
    ?>
    <!--map-modal -->
    <div class="map-modal-wrap">
        <div class="map-modal-wrap-overlay"></div>
        <div class="map-modal-item">
            <div class="map-modal-container fl-wrap">
                <div class="map-modal fl-wrap">
                    <div class="<?php echo $smclass; ?>" data-lat="<?php echo easybook_addons_get_option('gmap_default_lat'); ?>" data-lng="<?php echo easybook_addons_get_option('gmap_default_long'); ?>" data-loc=""></div>
                </div>
                <h3><i class="fal fa-location-arrow"></i><a href="#"><?php _e( 'Hotel Title', 'easybook-add-ons' ); ?></a></h3>
                <div class="map-modal-close"><i class="fal fa-times"></i></div>
            </div>
        </div>
    </div>
    <!--map-modal end --> 
    <!--ajax-modal-container-->
    <div class="ajax-modal-overlay"></div>
    <div class="ajax-modal-container">
        <!--ajax-modal -->
        <div class='ajax-loader'>
            <div class='ajax-loader-cirle'></div>
        </div>
        <div id="ajax-modal" class="fl-wrap"></div><!--#ajax-modal end -->
    </div>
    <!--ajax-modal-container end -->
    <script type="text/template" id="tmpl-bookmarks-whis">       
       <#
       _.each(data, function(data){ #>   
            <li class="clearfix wishlist-item fl-wrap cth-table-list">
                <a href="#" class="delete-bookmark-btn" data-id="{{data.id}}"><i class="fal fa-times-circle"></i></a>
                <div class="wishlist-sec"> 
                    <a href="{{data.url}}"  class="widget-posts-img"><img src="{{data.thub}}" class="respimg" alt=""></a>
                    <div class="widget-posts-descr">
                        <a href="{{data.url}}">{{{data.title}}}</a>
                        <div class="listing-rating card-popup-rainingvis"data-starrating2="{{data.rating['sum']}}" data-stars="{{data.rating_base}}"></div>                                            
                        <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i>{{{data.address}}}</a></div>
                        <span class="rooms-price"> $ {{{data.price_from}}}<strong><?php esc_html_e(' /  Awg','easybook-add-ons'); ?></strong></span>
                    </div>
                </div>           
            </li>
        <# }) #>
    </script>
    <?php
}
if(!function_exists('easybook_addons_submit_button_sc')){
    function easybook_addons_submit_button_sc($atts, $content = ''){

        if( easybook_addons_get_option('always_show_submit') != 'yes' ) return;
        ob_start();
        
        if(is_user_logged_in()) : ?>
                <a href="<?php echo easybook_addons_add_listing_url();?>" class="add-list"><?php _e( 'Add Listing <span><i class="fas fa-plus"></i></span>', 'easybook-add-ons' );?></a>
         <?php else : ?>
            <a href="#" class="add-list logreg-modal-open" data-message="<?php esc_attr_e( 'You must be logged in to add listings.', 'easybook-add-ons' ); ?>"><?php _e( 'Add Listing <span><i class="fas fa-plus"></i></span>', 'easybook-add-ons' );?></a>
        <?php 
        endif;
        $output = ob_get_clean();
        return $output;

    }

    add_shortcode( 'easybook_submit_button', 'easybook_addons_submit_button_sc' ); 
}
// search header top shortcode
if(!function_exists('easybook_addons_search_header_top_sc')){
    function easybook_addons_search_header_top_sc($atts, $content = ''){
        ob_start();
        ?>
            <div class="header-search vis-search">
                <div class="container">
                    <div class="row">
                        <form role="search" method="get" action="<?php echo esc_url(home_url( '/' ) ); ?>" class="list-search-header-form">
                            <?php 
                                echo easybook_addons_azp_parser_listing( false , 'filter_header');
                            ?>    
                        </form>                                                        
                    </div>
                </div>
                <div class="close-header-search"><i class="fa fa-angle-double-up"></i></div>
            </div>
        <?php
        $output = ob_get_clean();

        
        return $output;

    }

    add_shortcode( 'easybook_search_header_top', 'easybook_addons_search_header_top_sc' );  
}

// Currency list shortcode
if(!function_exists('easybook_addons_currencies_switcher_sc')){
    function easybook_addons_currencies_switcher_sc($atts, $content = '') {
        ob_start();
        $curr_attrs = easybook_addons_get_currency_attrs();
        $currencies = easybook_addons_get_option('currencies');
        ?>
        <div class="currency-wrap">
            <div class="show-currency-tooltip"><i class="currency-symbol"><?php echo $curr_attrs['symbol']; ?></i><span><?php echo $curr_attrs['currency']; ?><i class="fa fa-caret-down"></i></span></div>
            <ul class="currency-tooltip currency-switcher">
                <?php 
                if(is_array($currencies) && !empty($currencies)){
                    $base_curr = easybook_addons_get_base_currency();
                    $currencies = array_merge($currencies, array( $base_curr ) );
                    foreach ($currencies as $key => $val) { 
                        if(is_array($val) && isset($val['currency']) && $val['currency'] !== $curr_attrs['currency'] ) {
                        ?>
                        <li><a class="currency-item" href="<?php echo add_query_arg( 'currency', $val['currency'] ); ?>"><i class="currency-symbol"><?php echo $val['symbol'] ?></i><?php echo $val['currency'] ?></a></li>
                        <?php
                        }
                    }
                }
                ?>
            </ul>
        </div>
        <?php
        $output = ob_get_clean();
        return $output;
    }
    add_shortcode( 'currency_list', 'easybook_addons_currencies_switcher_sc' ); 
    add_shortcode( 'currencies_switcher', 'easybook_addons_currencies_switcher_sc' ); 
}


//header wishlist shortcode
if(!function_exists('easybook_addons_header_wishlist_sc')){
    function easybook_addons_header_wishlist_sc($atts, $content = ''){
        ob_start();
        $listing_bookmarks = get_user_meta( get_current_user_id(), ESB_META_PREFIX.'listing_bookmarks', true );
        // var_dump(count( $listing_bookmarks ));
        ?>
        <!-- wishlist-wrap-->            
        <div class="wishlist-wrap scrollbar-inner novis_wishlist">
            <div class="box-widget-content">
                <?php if(!empty($listing_bookmarks) && is_array($listing_bookmarks)){ ?>
                <div class="widget-posts fl-wrap">
                    <ul class="bookmark-wishlist-wrap">
                        <?php 
                        if(!empty($listing_bookmarks) && is_array($listing_bookmarks)){ 
                            foreach ($listing_bookmarks as $lid) {
                                $listing_post = get_post($lid);
                                $rating = easybook_addons_get_average_ratings($listing_post->ID);
                                 // var_dump($rating);
                                $price_from = get_post_meta( $listing_post->ID, ESB_META_PREFIX.'price_from', true );
                                $address = get_post_meta( $listing_post->ID, '_cth_address', true );
                                $url = wp_get_attachment_url( get_post_thumbnail_id($listing_post->ID), 'thumbnail' ); 
                                $rating_base = (int)easybook_addons_get_option('rating_base');
                                if(empty($listing_post)) continue;
                                ?>
                                <li class="clearfix wishlist-item fl-wrap cth-table-list">
                                    <a href="#" class="delete-bookmark-btn" data-id="<?php echo $listing_post->ID; ?>"><i class="fal fa-times-circle"></i></a>
                                    <div class="wishlist-sec"> 
                                        <a href="#"  class="widget-posts-img"><img src="<?php echo $url; ?>" class="respimg" alt=""></a>
                                        <div class="widget-posts-descr">
                                            <a href="<?php echo esc_url(get_the_permalink($listing_post->ID));?>"><?php echo esc_html( $listing_post->post_title ); ?></a>
                                            <?php if (!empty($rating['sum']) && is_numeric($rating['sum']) && $rating['sum']!== ''): 
                                           ?>
                                                <div class="listing-rating card-popup-rainingvis"data-starrating2="<?php echo $rating['sum'];?>" data-stars="<?php echo $rating_base;?>"></div>
                                            <?php endif; ?>
                                            <?php if (!empty($address)): ?>
                                                 <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i> <?php echo $address; ?></a></div>
                                            <?php endif ?>
                                            <?php if ($price_from !== ''): ?>
                                                <span class="rooms-price"> $ <?php echo $price_from; ?> <strong><?php esc_html_e(' /  Awg','easybook-add-ons'); ?></strong></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>           
                                </li>
                         <?php
                            }
                        } ?>
                    </ul>
                </div>
            <?php 
                }else{
            ?>
                <div class="cth-table-list">
                     <p><?php echo _e( 'You have no bookmark.', 'easybook-add-ons' ); ?></p>
                </div>
            <?php
                }
            ?>
            </div>
        </div>
        <!-- wishlist-wrap end--> 
        
        <?php
        $output = ob_get_clean();

        return $output;
    }

    add_shortcode( 'easybook_wishlist', 'easybook_addons_header_wishlist_sc' ); 
}



// dashboard page shortcode
if(!function_exists('easybook_addons_listing_dashboard_page_sc')){
    function easybook_addons_listing_dashboard_page_sc($atts, $content = ''){
        ob_start();

        easybook_addons_get_template_part('templates/dashboard');
        
        $output = ob_get_clean();

        return $output;
    }

    add_shortcode( 'listing_dashboard_page', 'easybook_addons_listing_dashboard_page_sc' ); 
}

// dashboard page shortcode
if(!function_exists('easybook_addons_listing_checkout_page_sc')){
    function easybook_addons_listing_checkout_page_sc($atts, $content = ''){

        ob_start();

        
        $classname = "Esb_Class_Checkout";
        if(isset($_POST['esb-checkout-type']) && $_POST['esb-checkout-type'] != ''){ 
            $classname = "Esb_Class_Checkout_".ucfirst($_POST['esb-checkout-type']);
        }else{
            $classname =  "Esb_Class_Checkout_listing";
        }
        $checkout = new $classname;
        $checkout->breadcrumb();
        $checkout->render();
        $output = ob_get_clean();
        return $output;
    }

    add_shortcode( 'listing_checkout_page', 'easybook_addons_listing_checkout_page_sc' ); 
}

// add new field to submit form
function easybook_addons_submit_addfields_callback($listing_id = 0, $is_edit = false){
    $content_addfields = easybook_addons_get_option('content_addwidgets');
    if(empty($content_addfields) || !is_array($content_addfields)) return;
    foreach ($content_addfields as $widget) {
        ?>
        <!-- profile-edit-container--> 
        <div class="profile-edit-container add-list-container">
            <div class="profile-edit-header fl-wrap">
                <h4><?php echo $widget['widget_title'];?></h4>
            </div>
            <div class="custom-form">
                <div class="listing-additional-fields">
                <?php 
                $name_prefix = 'add_fields_';
                $add_fields_arr = array();
                if(!empty($widget['fields'])){
                    foreach ((array)$widget['fields'] as $key => $field) {
                        $add_fields_arr[] = array(
                            'type' => $field['field_type'],
                            'name' => $field['field_name'],
                            'label' => $field['field_label'],
                            'value' => '',
                            'lvalue'    => ($is_edit? get_post_meta( $listing_id, ESB_META_PREFIX.$name_prefix.$field['field_name'], true ) : ''),
                        );
                    }
                }
                foreach ($add_fields_arr as $addfield) {
                    easybook_addons_get_template_part('templates-inner/add-field-frontend',false,array('name_prefix'=> $name_prefix,'addfield'=>$addfield));
                }
                ?>
                </div>
            </div>
        </div>
        <!-- profile-edit-container end-->  
    <?php
    }
    ?>
    
    <?php
}

add_action( 'wp_footer', function(){
    if( !is_page( easybook_addons_get_option('dashboard_page') ) && easybook_addons_get_option('use_messages') == 'yes' && easybook_addons_get_option('show_fchat') == 'yes' ):
    ?>
        <div id="chat-app"></div>
    <?php 
        
    endif;
    easybook_addons_get_template_part('templates/tmpls');
} );


if(!function_exists('easybook_addons_widget_comment_sc')){
    function easybook_addons_widget_comment_sc($atts, $content = ''){
        ob_start();
        $rating = easybook_addons_get_average_ratings(get_the_ID()); 
        // var_dump( $rating );
        $rating_fields = easybook_addons_get_rating_fields(get_post_meta( get_the_ID(), ESB_META_PREFIX.'listing_type_id', true ));
        ?>
         <?php if(!empty($rating) && easybook_addons_get_option('single_show_rating') == '1' && count($rating_fields) > 1): ?>
            <!--reviews-score-wrap-->   
            <div class="reviews-score-wrap fl-wrap" id="reviews-total-sec">
                    <div class="review-score-total">
                        <span><?php echo $rating['sum']; ?>
                            <strong class="review-text"><?php echo easybook_addons_rating_text($rating['sum']); ?></strong>
                        </span>
                        <a href="#listing-add-review" class="color2-bg"><?php esc_html_e('Add Comment','easybook-add-ons'); ?></a> 
                    </div>
                <div class="review-score-detail">
                    <!-- review-score-detail-list-->
                    <div class="review-score-detail-list">
                        <?php
                       
                        $rating_base = (int)easybook_addons_get_option('rating_base'); 
                        if (!empty($rating_fields)) {
                            foreach ((array)$rating_fields as $key => $field) {
                                ?>
                                <!-- rate item-->
                                <div class="rate-item fl-wrap">
                                    <div class="rate-item-title fl-wrap"><span><?php echo $field['title']; ?></span></div>
                                    <div class="rate-item-bg" data-percent="<?php echo (floatval($rating['values'][$field['fieldName']])/$rating_base)*100 ?>%">
                                                <div class="rate-item-line color-bgs"></div>
                                            </div>
                                    <div class="rate-item-percent"><?php echo floatval($rating['values'][$field['fieldName']]); ?></div>
                                </div>
                                <!-- rate item end-->
                                <?php 
                            }
                        }
                        ?> 
                    </div>
                    <!-- review-score-detail-list end-->
                </div>
            </div>
            <!-- reviews-score-wrap end -->   
        <?php endif ?>
        <?php  
        $output = ob_get_clean();
        return $output;
    }
    add_shortcode( 'easybook_widget_comment', 'easybook_addons_widget_comment_sc' );  
}

