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


/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */

?><!DOCTYPE html>
<html class="no-js no-svg" itemscope>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <title><?php echo wp_get_document_title() ?></title>
    <link rel="stylesheet"  href="https://fonts.googleapis.com/css?family=Montserrat%3A400%2C500%2C600%2C700%2C800%2C800i%2C900%7CQuicksand%3A300%2C400%2C500%2C700&amp;subset=cyrillic%2Ccyrillic-ext%2Clatin-ext%2Cvietnamese" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo ESB_DIR_URL.'inc/assets/font-awesome/font-awesome.min.css'; ?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo ESB_DIR_URL.'assets/css/maintenance.css'; ?>" type="text/css" media="all">
</head>

<body>
    <div id="main-theme" class="is-hide-loader">
        <!-- cs-wrapper -->
        <div class="cs-wrapper fl-wrap">
            <!-- container  -->
            <div class="container small-container"> 
                <div class="cs-logo">
                    <?php 
                    if(has_custom_logo()) the_custom_logo(); 
                    else echo '<a class="custom-logo-link logo-text" href="'.esc_url( home_url('/' ) ).'"><h2>'.get_bloginfo( 'name' ).'</h2></a>'; 
                    ?>
                </div>
                <span class="section-separator"></span>
                <?php echo do_shortcode( easybook_addons_get_option('maintenance_msg') ); ?>
                <!-- cs-social -->
                
                <!-- cs-social end -->
            </div>
            <!-- container end -->
        </div>
        <!-- cs-wrapper end-->


    </div>
    <!-- Main end -->
    <script type='text/javascript' src='<?php echo ESB_DIR_URL.'assets/js/jquery.min.js'; ?>'></script>
    <script type='text/javascript'>
    /* <![CDATA[ */
    var _easybook_add_ons = {"pl_w":"Please wait...","url": "<?php echo esc_url(admin_url( 'admin-ajax.php' ) ); ?>","disable_bubble":"<?php _ex( 'no', 'Disable bubbles on maintenance page: yes or no', 'easybook-add-ons' ) ?>"};
    /* ]]> */
    </script>
    <script type='text/javascript' src='<?php echo ESB_DIR_URL.'assets/js/maintenance.min.js'; ?>'></script>
</body>
</html>

