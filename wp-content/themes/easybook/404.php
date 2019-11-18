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
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 */


get_header(); 

?>
<!--  section  --> 
<section class="color-bg parallax-section error404-wrap" data-scrollax-parent="true" id="sec1">
    <div class="bg par-elem "  data-bg="<?php echo esc_url(easybook_get_option('error404_bg'));?>" data-scrollax="properties: { translateY: '30%' }"></div> 
    <?php if (empty(easybook_get_option('error404_bg'))): ?>
        <div class="city-bg"></div>
        <div class="cloud-anim cloud-anim-bottom x1"><i class="fal fa-cloud"></i></div>
        <div class="cloud-anim cloud-anim-top x2"><i class="fal fa-cloud"></i></div> 
        <div class="overlay op1 color3-bg"></div>
    <?php else: ?>
         <div class="overlay"></div>
    <?php endif ?>
    <div class="container">
        <div class="error-wrap">
            <h2><?php esc_html_e( '404','easybook' ); ?></h2>
            <p><?php echo easybook_get_option('error404_msg');?></p>
            <div class="clearfix"></div> 
            <?php get_search_form();?>
            <div class="clearfix"></div>
            <?php 
            if (easybook_get_option('error404_btn')) : 
            ?>
                <p><?php esc_html_e( 'Or', 'easybook' );?></p>
                <a href="<?php echo esc_url( home_url() );?>" class="btn color2-bg " ><?php esc_html_e( 'Back to Home Page', 'easybook' ); ?> <i class="fal fa-home"></i></a> 
            <?php 
            endif; ?>
        </div>
    </div>
</section>
<!--  section  end--> 

<div class="limit-box"></div>

<?php get_footer();
