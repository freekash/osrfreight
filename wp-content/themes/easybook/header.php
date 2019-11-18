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


/**
 * The header for our theme 
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials 
 *
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg" itemscope> 
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="//gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php 
if(easybook_get_option('show_loader', true ) ) : 
    $loader_icon = easybook_get_option('loader_icon');
?>
    <!--loader-->
    <div class="loader-wrap">
        <div class="loader-inner">
        <?php if(!empty($loader_icon)): ?>
            <div class="loader-icon-img">
                <?php echo wp_get_attachment_image( $loader_icon, 'full', false, array('class'=>'no-lazy')); ?> 
            </div>
            <div class="ldicon-pulse"></div>
        <?php else: ?>
            <div class="pin">
                <div class="pulse"></div>
            </div>
            
        <?php endif; ?>
        </div>
    </div>
    <!--loader end-->
    <div id="main-theme">
<?php else :?>
    <div id="main-theme" class="is-hide-loader">
<?php endif;?>

        <!-- header-->
        <header id="masthead" class="easybook-header main-header dark-header fs-header sticky">
            <?php
            if(easybook_get_option( 'header_info'  ) != ''): ?>
            <div class="header-contacts">
                <?php echo wp_kses_post( easybook_get_option( 'header_info') ); ?>
            </div>
            <?php endif;?>
          <div class="header-top fl-wrap">
                <div class="container">
                    <div class="logo-holder">
                        <?php 
                        if(has_custom_logo()) the_custom_logo(); 
                        else echo '<a class="custom-logo-link logo-text" href="'.esc_url( home_url('/' ) ).'"><h2>'.get_bloginfo( 'name' ).'</h2></a>'; 
                        ?>
                    </div>
                   
                   
                </div>
            </div>
            <div class="header-inner fl-wrap">
                <div class="container">
          
              

                    <div class="home-btn"><a href="<?php echo esc_url( home_url('/' ) ); ?>"><i class="fa fa-home"></i></a></div>
                    <!-- nav-button-wrap-->
                    <div class="nav-button-wrap">
                        <div class="nav-button">
                            <span></span><span></span><span></span>
                        </div>
                    </div>
                    <!-- nav-button-wrap end-->
                    <?php if ( has_nav_menu( 'top' ) ) : ?>
                        <!--  .nav-holder -->
                        <div class="nav-holder main-menu">
                            <?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
                        </div><!-- .nav-holder -->
                    <?php endif; ?>
                    
                    <!-- wishlist-wrap-->            
                    <?php echo do_shortcode( easybook_check_shortcode('[easybook_wishlist]', 'easybook_wishlist') );?>
                    <!-- wishlist-wrap end--> 
                </div>
            </div>
            <?php 
            if(easybook_get_option('show_fixed_search', true )) : ?>     
            <?php echo do_shortcode( easybook_check_shortcode('[easybook_search_header_top]', 'easybook_search_header_top') );?>
            <?php endif;?>
        </header>
        <!--  header end -->
        <!--  wrapper  -->
        <div id="wrapper">
            <!-- Content-->
            <div class="content">

                
