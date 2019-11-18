<?php
/**
Plugin Name: EasyBook Add-Ons
Plugin URI: https://easybook.cththemes.com
Description: A custom plugin for EasyBook - Hotel & Tour Booking WordPress Theme
Version: 1.1.7
Author: CTHthemes
Author URI: http://themeforest.net/user/cththemes
Text Domain: easybook-add-ons
Domain Path: /languages/
Copyright: ( C ) 2014 - 2019 cththemes.com . All rights reserved.
License: GNU General Public License version 3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */



if ( ! defined('ABSPATH') ) {
    die('Please do not load this file directly!');
}

if ( ! defined( 'ESB_PLUGIN_FILE' ) ) {
    define( 'ESB_PLUGIN_FILE', __FILE__ );
}

if ( ! class_exists( 'EasyBook_Addons' ) ) {
    include_once dirname( __FILE__ ) . '/includes/class-addons.php';
}

function ESB_ADO() {
    return EasyBook_Addons::getInstance();
}

ESB_ADO();

