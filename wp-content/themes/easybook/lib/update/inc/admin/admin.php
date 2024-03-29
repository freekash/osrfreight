<?php
/**
 * @package EasyBook - Hotel & Tour Booking WordPress Theme
 * @author CTHthemes - http://themeforest.net/user/cththemes
 * @date 03-10-2019
 * @since 1.1.7
 * @version 1.1.7
 * @copyright Copyright ( C ) 2014 - 2019 cththemes.com . All rights reserved.
 * @license GNU General Public License version 3 or later; see LICENSE
 */


namespace CTHthemesAutoUpdate;

/**
 * 
 */
class Admin
{
    private static $_instance = null;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
            
        }

        return self::$_instance;
    }

    function __construct(){
        $this->init_actions();
    }

    public function init_actions() {

        // @codeCoverageIgnoreEnd
        // Deferred Download.
        add_action( 'upgrader_package_options', array( $this, 'maybe_deferred_download' ), 9 );

        // Add pre download filter to help with 3rd party plugin integration.
        // add_filter( 'upgrader_pre_download', array( $this, 'upgrader_pre_download' ), 2, 4 );

        add_action( 'admin_menu', array( $this, 'add_menu_page' ) );

        add_action( 'admin_init', array( $this, 'register_settings' ) );

        // admin notice for letting users know about new update system
        add_action( 'admin_enqueue_scripts', array( $this, 'load_script' ) );
        add_action( 'admin_notices', array( $this, 'notices' ) );
        add_action( 'wp_ajax_cththemes_dismiss_notice', array( $this, 'dismiss_notice' ) );

    }

    public function load_script(){
        wp_enqueue_script(
            'cththemes-notices',
            cththemes_auto_update()->get_plugin_url() .'update/assets/admin.js',
            array( 'jquery' ),
            false,
            true
        );
    }

    public function dismiss_notice(){
        if( isset($_POST['type']) && !empty($_POST['type']) ){

            $option = cththemes_auto_update()->get_options();
            if ( !isset($option['dismissed_notices']) || empty($option['dismissed_notices']) ) {
                $option['dismissed_notices'] = array();
            }
            $option['dismissed_notices'][$_POST['type']] = true;
            cththemes_auto_update()->set_options($option);
        }

        wp_send_json( array() );
    }



    public function notices(){
        $type = 'purchase-code';
        $dismissed_notices = cththemes_auto_update()->get_option('dismissed_notices', array());
        if( !isset($dismissed_notices[$type]) || $dismissed_notices[$type] != true ):
        // if( cththemes_auto_update()->get_envato_purchase_code_option_value() == '' ):
        ?>
        <div data-notice="<?php echo esc_attr( $type ); ?>" class="cththemes-notice notice notice-warning is-dismissible">
            <h3><?php esc_html_e( 'EasyBook - Directory & Listing WordPress Theme', 'easybook' ); ?></h3>
            <p><?php esc_html_e( 'From version 1.0.2 we provide new update system which allow you update our theme and its add-ons plugin directly from WordPress Themes/Plugins screen.', 'easybook' ); ?></p>
            <p><?php esc_html_e( 'You do not need to delete and reinstall add-ons plugins anymore.', 'easybook' ); ?> <a href="https://docs.cththemes.com/docs/installation/new-update-system/" target="_blank"><?php esc_html_e( 'See guide -->', 'easybook' ); ?></a></p>
            <p><?php esc_html_e( 'And your purchase code is REQUIRED', 'easybook' ); ?></p>
            <p><strong><a href="<?php echo esc_url(admin_url('admin.php?page=cththemes-auto-update')); ?>"><?php esc_html_e( 'ADD PURCHASE CODE', 'easybook' ); ?></a></strong></p>
        </div>
        <?php
        endif;
    }

    /**
     * Defers building the API download url until the last responsible moment to limit file requests.
     *
     * Filter the package options before running an update.
     *
     *
     * @param array $options {
     *     Options used by the upgrader.
     *
     * @type string $package Package for update.
     * @type string $destination Update location.
     * @type bool   $clear_destination Clear the destination resource.
     * @type bool   $clear_working Clear the working resource.
     * @type bool   $abort_if_destination_exists Abort if the Destination directory exists.
     * @type bool   $is_multi Whether the upgrader is running multiple times.
     * @type array  $hook_extra Extra hook arguments.
     * }
     */
    public function maybe_deferred_download( $options ) {
        $package = $options['package'];
        if ( false !== strrpos( $package, 'cth_defer_download' ) && false !== strrpos( $package, 'item_id' ) && false !== strrpos( $package, 'type' ) ) {
            parse_str( parse_url( $package, PHP_URL_QUERY ), $vars );
            if ( $vars['item_id'] && $vars['type'] ) {
                $options['package'] = cththemes_auto_update()->api()->download( $vars['item_id'], $vars['type'] );
            }
        }

        return $options;
    }

    public function add_menu_page() {
        $page = add_menu_page(
            __( 'CTHthemes Update', 'easybook' ), __( 'CTHthemes Update', 'easybook' ), 'manage_options', cththemes_auto_update()->get_slug(), array(
                $this,
                'render_admin_callback',
            )
        );

        // // Enqueue admin CSS.
        // add_action( 'admin_print_styles-' . $page, array( $this, 'admin_enqueue_style' ) );

        // // Enqueue admin JavaScript.
        // add_action( 'admin_print_scripts-' . $page, array( $this, 'admin_enqueue_script' ) );

        // // Add Underscore.js templates.
        // add_action( 'admin_footer-' . $page, array( $this, 'render_templates' ) );
    }


    public function render_admin_callback() {
        require( cththemes_auto_update()->get_plugin_path() . 'inc/admin/options/admin.php' );
    }

    public function register_settings() {
        // Setting.
        register_setting( cththemes_auto_update()->get_slug(), cththemes_auto_update()->get_envato_purchase_code_option_name() );

        add_settings_section(
            cththemes_auto_update()->get_option_name() . '_purchase_code',
            __( 'EasyBook Theme Purchase Code', 'easybook' ),
            array( $this, 'render_purchase_code_section_callback' ),
            cththemes_auto_update()->get_slug()
        );

        add_settings_field(
            'purchase_code',
            __( 'Purchase Code', 'easybook' ),
            array( $this, 'render_purchase_code_setting_callback' ),
            cththemes_auto_update()->get_slug(),
            cththemes_auto_update()->get_option_name() . '_purchase_code'
        );

        // register_setting( cththemes_auto_update()->get_slug(), cththemes_auto_update()->get_option_name() );

    }
    public function render_purchase_code_setting_callback() {
        require( cththemes_auto_update()->get_plugin_path() . 'inc/admin/options/settings/purchase_code.php' );
    }
    public function render_purchase_code_section_callback() {
        require( cththemes_auto_update()->get_plugin_path() . 'inc/admin/options/purchase_code.php' );
    }
}