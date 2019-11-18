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
// set global options value
if(!isset($easybook_addons_options)) 
    $easybook_addons_options = get_option( 'easybook-addons-options', array() );  

final class EasyBook_Addons { 
    public $cthversion = '1.1.7';
    public $cart = null;
    public $geo = null;
    private static $_instance;

    public $options = null;
    private $plugin_url;
    private $plugin_path;
    public $payment_methods;

    private function __construct() {
        $this->define_constants();
        $this->includes();
        $this->init_hooks();
    }

    private function init_hooks() {
        add_action('plugins_loaded', array( $this, 'load_plugin_textdomain' ));
        add_action('after_setup_theme', array( $this, 'after_setup_theme' ));

        register_activation_hook( ESB_PLUGIN_FILE, array( 'Esb_Class_Install', 'install') );
        register_deactivation_hook( ESB_PLUGIN_FILE, array( 'Esb_Class_Install', 'uninstall') );

        add_action( 'init', array( $this, 'init' ), 0 );
        // add_action( 'init', array( $this, 'init_after' ) ); // flush_rewrite_rules
        add_action( 'init', array( $this, 'init_scheduler' ) );
        add_action( 'easybook_expire_scheduler_action', array( $this, 'do_expire_scheduler' ) );

        add_action( 'widgets_init', array( $this, 'register_widgets' ) );

        add_action( 'wp_loaded', array( $this, 'set_cookie_currency' ) );

        add_filter( 'ajax_query_attachments_args', array($this, 'filter_media_frontend') );

        add_filter( 'wpml_single_edit_language_context', function($context, $post_type){
            if($post_type === 'listing_type') $context = 'normal';
            return $context;
        } , 10, 2);
    }

    public function load_plugin_textdomain(){
        load_plugin_textdomain( 'easybook-add-ons', false, plugin_basename(dirname(ESB_PLUGIN_FILE)) . '/languages' );
    }

    public function after_setup_theme(){
        if(!is_admin() && is_user_logged_in() &&  in_array( easybook_addons_get_user_role(), easybook_addons_get_option('admin_bar_hide_roles') ) ) {
            show_admin_bar( false );
        }
    }


    public function register_widgets() {
        register_widget( 'EasyBook_About_Author' );
        register_widget( 'EasyBook_Recent_Posts' );
        register_widget( 'EasyBook_Instagram_Feed' );
        register_widget( 'EasyBook_Banner' );
        register_widget( 'EasyBook_Banner_Video' );
        register_widget( 'EasyBook_Twitter_Feed' );
        register_widget( 'EasyBook_Partners' );
        register_widget( 'EasyBook_Languages' );
    }

    public static function getInstance() {
        if ( ! ( self::$_instance instanceof self ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    private function __clone() {
    }

    private function __wakeup() {
    }

    private function define_constants() {
        $upload_dir = wp_upload_dir( null, false );

        $this->define( 'ESB_ABSPATH', plugin_dir_path( ESB_PLUGIN_FILE ) );
        $this->define( 'ESB_DIR_URL', plugin_dir_url( ESB_PLUGIN_FILE ) );
        $this->define( 'ESB_VERSION', $this->cthversion );
        $this->define( 'ESB_META_PREFIX', '_cth_' );
        $this->define( 'ESB_DEBUG', true );
        $this->define( 'ESB_LOG_FILE', $upload_dir['basedir'] .'/cthdev.log' );


        $this->plugin_url = plugin_dir_url(ESB_PLUGIN_FILE);
        $this->plugin_path = plugin_dir_path(ESB_PLUGIN_FILE);
    }

    private function define( $name, $value ) {
        if ( ! defined( $name ) ) {
            define( $name, $value );
        }
    }

    public function is_request( $type ) {
        switch ( $type ) {
            case 'admin':
                return is_admin();
            case 'ajax':
                return defined( 'DOING_AJAX' );
            case 'frontend':
                return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
        }
    }

    private function includes() {
        require_once ESB_ABSPATH . 'includes/core-functions.php';
        
        require_once ESB_ABSPATH . 'inc/template_tags.php';

        include_once ESB_ABSPATH . 'includes/class-install.php';
        include_once ESB_ABSPATH . 'includes/class-update.php';
        
        // require_once ESB_ABSPATH . 'includes/class-cookies.php';

        // for listing post type
        require_once ESB_ABSPATH .'includes/class-cpt.php';
        


        // azp
        require_once ESB_ABSPATH . 'includes/azp.php';
        require_once ESB_ABSPATH . 'shortcodes/azp.php';
        require_once ESB_ABSPATH . 'includes/azp_parser.php';
        


        if($this->is_request('admin')){

            // plugin option values
            require_once ESB_ABSPATH . 'includes/option_values.php';
            /* plugin options */
            require_once ESB_ABSPATH . 'includes/class-options.php';

            require_once ESB_ABSPATH . 'includes/class-admin-scripts.php';
            require_once ESB_ABSPATH . 'includes/azp_template.php';
            
            
            require_once ESB_ABSPATH . 'inc/cmb2/functions.php';

            require_once ESB_ABSPATH . 'includes/class-import.php';
        }

        if($this->is_request('frontend')){
            require_once ESB_ABSPATH . 'includes/class-frontend-scripts.php';
            require_once ESB_ABSPATH . 'includes/class-form-handler.php';
            require_once ESB_ABSPATH . 'includes/class-ajax-handler.php';
            // cart
            
            require_once ESB_ABSPATH . 'includes/class-cart.php';
            require_once ESB_ABSPATH . 'includes/class-geolocation.php';
            if(easybook_addons_get_option('lazy_load') == 'yes')
                require_once ESB_ABSPATH . 'includes/class-lazy-load.php';

            require_once ESB_ABSPATH . 'shortcodes/listing.php';
            // azp
            
        }
        // membership
        require_once ESB_ABSPATH .'includes/class-membership.php';
        require_once ESB_ABSPATH .'includes/class-booking.php';
        require_once ESB_ABSPATH .'includes/class-earning.php';
        require_once ESB_ABSPATH .'includes/class-withdrawals.php';
        // checkout
        require_once ESB_ABSPATH .'includes/class-checkout.php';
        require_once ESB_ABSPATH .'includes/class-checkout-listing.php'; 
        //payment
        require_once ESB_ABSPATH .'includes/class-payment.php';
        require_once ESB_ABSPATH .'includes/class-payment-paypal.php'; 
        require_once ESB_ABSPATH .'includes/class-payment-stripe.php';
        require_once ESB_ABSPATH .'includes/class-payment-payfast.php'; 

        // dashboard
        // require_once ESB_ABSPATH . 'includes/expire.php';
        require_once ESB_ABSPATH . 'includes/woo.php';

        // for chat
        require_once ESB_ABSPATH . 'includes/chat.php';
        require_once ESB_ABSPATH . 'includes/class-ads.php';


        require_once ESB_ABSPATH . 'inc/dashboard_data.php';
        require_once ESB_ABSPATH . 'includes/dashboard/dashboard.php';
        require_once ESB_ABSPATH . 'includes/dashboard/listings.php';
        require_once ESB_ABSPATH . 'includes/dashboard/reviews.php';
        require_once ESB_ABSPATH . 'includes/dashboard/booking.php';
        require_once ESB_ABSPATH . 'includes/dashboard/chart.php';
        require_once ESB_ABSPATH . 'includes/dashboard/profile.php';
        require_once ESB_ABSPATH . 'includes/dashboard/notification.php';
        require_once ESB_ABSPATH . 'includes/dashboard/withdrawals.php';
        require_once ESB_ABSPATH . 'includes/dashboard/invoices.php';


        require_once ESB_ABSPATH .'inc/rating.php';
        /**
         * Implement Post views
         *
         * @since EasyBook 1.0
         */
        require_once ESB_ABSPATH . 'inc/cth_for_vc.php';
        // require_once ESB_ABSPATH . 'inc/post_views.php';
        require_once ESB_ABSPATH . 'includes/class-lstats.php';
        /**
         * Implement Like Post
         *
         * @since EasyBook 1.0
         */
        require_once ESB_ABSPATH . 'inc/post_like.php';
        require_once ESB_ABSPATH . 'inc/elementor.php';

        // action-scheduler
        require_once ESB_ABSPATH . 'includes/action-scheduler/action-scheduler.php';
        //widgets
        require_once ESB_ABSPATH .'widgets/shortcodes.php';
        require_once ESB_ABSPATH .'widgets/easybook_recent_posts.php';
        require_once ESB_ABSPATH .'widgets/easybook_about_author.php';
        require_once ESB_ABSPATH .'widgets/easybook_banner.php';
        require_once ESB_ABSPATH .'widgets/easybook_banner_video.php';
        require_once ESB_ABSPATH .'widgets/easybook_instagram_feed.php';
        require_once ESB_ABSPATH .'widgets/easybook_twitter_feed.php';
        require_once ESB_ABSPATH .'widgets/easybook_partners.php';
        require_once ESB_ABSPATH .'widgets/easybook_languages.php';
    }

    public function init() {
        // $this->set_cookie_currency();

        // $this->options = new Esb_Class_Options();

        if ( $this->is_request( 'frontend' ) ) {
            foreach (easybook_addons_get_order_method_text('', true) as $key => $title) {
                $pm_class = 'Esb_Class_Payment_'. ucfirst($key); // form -> Form
                if(class_exists($pm_class))
                    $this->payment_methods[$key] = new $pm_class;
            }
            $this->cart = new Esb_Class_Cart();
            $this->geo = new Esb_Class_Geolocation();
        }


    }

    public function init_after(){
        // https://codex.wordpress.org/Function_Reference/flush_rewrite_rules
        // do not use on live/production servers
        $ver = filemtime( __FILE__ ); // Get the file time for this file as the version number
        $defaults = array( 'version' => 0, 'time' => time() );
        $r = wp_parse_args( get_option( __CLASS__ . '_flush', array() ), $defaults );

        if ( $r['version'] != $ver || $r['time'] + 172800 < time() ) { // Flush if ver changes or if 48hrs has passed.
            flush_rewrite_rules();
            // trace( 'flushed' );
            $args = array( 'version' => $ver, 'time' => time() );
            if ( ! update_option( __CLASS__ . '_flush', $args ) ) add_option( __CLASS__ . '_flush', $args );
        }
    }

    public function init_scheduler(){
        if ( false === as_next_scheduled_action( 'easybook_expire_scheduler_action' ) ) {
            as_schedule_recurring_action( strtotime( 'midnight tonight' ), DAY_IN_SECONDS, 'easybook_expire_scheduler_action' );
        }
    }

    public function do_expire_scheduler(){
        // will expire message based author subscription post
        $next_5_days = easybook_add_ons_cal_next_date('now', 'day', 5, 'Y-m-d H:i:s');

        $query_args = array(
            'post_type'         => 'lorder',
            'posts_per_page'    => -1,
            'post_status'       => 'publish',
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key'     => ESB_META_PREFIX.'status',
                    'value'   => 'completed',
                    'compare' => '=',
                    // 'type'    => 'CHAR'
                ),
                array(
                    'key'     => ESB_META_PREFIX.'end_date',
                    'value'   => current_time( 'mysql' ),
                    'compare' => '>=',
                    'type'    => 'DATETIME'
                ),
                array(
                    'key'     => ESB_META_PREFIX.'end_date',
                    'value'   => $next_5_days,
                    'compare' => '<=',
                    'type'    => 'DATETIME'
                )
            ),
            'orderby' => 'date',
            'order' => 'DESC'
        );
        $expired_authors = array();
        $expired_posts = array();
        $expired_subs = get_posts( $query_args );
        if(!empty($expired_subs)){
            foreach ($expired_subs as $exsub) {
                $expired_authors[] = get_post_meta( $exsub->ID, ESB_META_PREFIX.'user_id', true ); // $exsub->post_author;
                $expired_posts[] = $exsub->ID;
            }
            // $expired_authors = array_unique($expired_authors);
        }

        if(!empty($expired_authors)){
            foreach ($expired_authors as $key => $auth) {
                do_action( 'esb_addons_subscription_will_expire', $auth, $expired_posts[$key] );
                easybook_addons_add_user_notification( $auth, array(
                    'type'          => 'membership_will_expired',
                    'entity_id'     => $expired_posts[$key]
                ) );
            }
        }

        


        // ad will expire
        $query_args = array(
            'post_type'         => 'cthads',
            'posts_per_page'    => -1,
            'post_status'       => 'publish',
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key'     => ESB_META_PREFIX.'status',
                    'value'   => 'completed',
                    'compare' => '=',
                    // 'type'    => 'CHAR'
                ),
                array(
                    'key'     => ESB_META_PREFIX.'end_date',
                    'value'   => current_time( 'mysql' ),
                    'compare' => '>=',
                    'type'    => 'DATETIME'
                ),
                array(
                    'key'     => ESB_META_PREFIX.'end_date',
                    'value'   => $next_5_days,
                    'compare' => '<=',
                    'type'    => 'DATETIME'
                )
            ),
            'orderby' => 'date',
            'order' => 'DESC'
        );
        $expired_authors = array();
        $expired_posts = array();
        $expired_subs = get_posts( $query_args );
        if(!empty($expired_subs)){
            foreach ($expired_subs as $exsub) {
                $expired_authors[] = get_post_meta( $exsub->ID, ESB_META_PREFIX.'user_id', true ); // $exsub->post_author;
                $expired_posts[] = $exsub->ID;
            }
            // $expired_authors = array_unique($expired_authors);
        }

        if(!empty($expired_authors)){
            foreach ($expired_authors as $key => $auth) {
                do_action( 'esb_addons_ad_will_expire', $auth, $expired_posts[$key] );
                easybook_addons_add_user_notification( $auth, array(
                    'type'          => 'ad_will_expired',
                    'entity_id'     => $expired_posts[$key]
                ) );
            }
        }


        // expired subscription

        $query_args = array(
            'post_type'         => 'lorder',
            'posts_per_page'    => -1,
            'post_status'       => 'publish',
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key'     => ESB_META_PREFIX.'status',
                    'value'   => 'completed',
                    'compare' => '=',
                    // 'type'    => 'CHAR'
                ),
                array(
                    'key'     => ESB_META_PREFIX.'end_date',
                    'value'   => current_time( 'mysql' ),
                    'compare' => '<',
                    'type'    => 'DATETIME'
                )
            ),
            'orderby' => 'date',
            'order' => 'DESC'
        );
        $expired_authors = array();
        $expired_posts = array();
        $expired_subs = get_posts( $query_args );
        if(!empty($expired_subs)){
            foreach ($expired_subs as $exsub) {
                $expired_authors[] = get_post_meta( $exsub->ID, ESB_META_PREFIX.'user_id', true ); // $exsub->post_author;
                $expired_posts[] = $exsub->ID;
            }
            // $expired_authors = array_unique($expired_authors);
        }

        if(!empty($expired_authors)){
            foreach ($expired_authors as $key => $auth) {
                $subs_post = $expired_posts[$key];
                // do not unsubscribe for admin
                if(easybook_addons_get_user_role($auth) != 'administrator'){
                    Esb_Class_Membership::deactive_membership($subs_post);
                }

                do_action( 'esb_addons_subscription_expired', $auth, $subs_post );
                easybook_addons_add_user_notification( $auth, array(
                    'type'          => 'membership_expired',
                    'entity_id'     => $subs_post
                ) );
            }
        }


    }

    public function filter_media_frontend( $query ) {
        // admins get to see everything
        if ( ! current_user_can( 'manage_options' ) ) $query['author'] = get_current_user_id();
        return $query;
    }

    public function set_cookie_currency(){
        if(!isset($_REQUEST['currency']) || $_REQUEST['currency'] == '' || (isset($_COOKIE['esb_currency']) && $_COOKIE['esb_currency'] == $_REQUEST['currency'])) return;

        esb_setcookie( 'esb_currency', $_REQUEST['currency'], time() + MONTH_IN_SECONDS );

        $_COOKIE['esb_currency'] = $_REQUEST['currency'];
    }
}