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
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */
get_header(); ?>

<!--  section  --> 
<section class="parallax-section color-bg password-sec" data-scrollax-parent="true" id="sec1">
    <div class="bg par-elem "  data-bg="<?php echo esc_url(easybook_get_option('error404_bg'));?>" data-scrollax="properties: { translateY: '30%' }"></div>
    <?php if (empty(easybook_get_option('error404_bg' ))): ?>
        <div class="city-bg"></div>
        <div class="overlay op1 color3-bg"></div>
    <?php else: ?>
        <div class="overlay"></div>
    <?php endif; ?>
    <div class="container">
        <div class="protected-wrap">
            <h2 class="protected-text"><?php the_title( );?></h2>
            <?php echo get_the_password_form(); ?>
        </div>
    </div>
</section>
<!--  section  end--> 
<?php     
get_footer();
