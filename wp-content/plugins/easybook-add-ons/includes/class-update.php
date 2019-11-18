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


class Esb_Class_Update {
	/**
	 * Instance.
	 *
	 * Holds the CTB_Update instance.
	 *
	 */
	public static $instance = null;

	public static $messages = array('<p>Thank you for using this plugin! <strong>'.ESB_VERSION.'</strong>.</p>');

	/**
	 * Instance.
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 *
	 * @return CTB_Update An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public static function update(){
		set_transient( 'ctb-update-admin-notice', true, 30 );

		self::$messages[] = '<p>Thank you for using this plugin! <strong>'.ESB_VERSION.'</strong>.</p>';
	}

	public function admin_notices(){

		/* Check transient, if available display notice */
	    if( get_transient( 'ctb-update-admin-notice' ) ){
	        ?>
	        <div class="updated notice is-dismissible">
	            <?php echo implode("<br />", self::$messages); ?>
	        </div>
	        <?php
	        /* Delete transient, only display this notice once. */
	        delete_transient( 'ctb-update-admin-notice' );
	    }
	}
	private function __construct() {
		register_activation_hook( ESB_PLUGIN_FILE, array('CTB_Update', 'update'));

		add_action( 'admin_notices', [ $this, 'admin_notices' ] );
	}

}


