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
 * Template Name: Left Sidebar
 *
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

if ( post_password_required() ) {
    get_template_part( 'template-parts/page/protected', 'page' ); 
    return;
}

get_header(); 

$sb_w = easybook_get_option('blog-sidebar-width','4');

$show_page_header = get_post_meta(get_the_ID(),'_cth_show_page_header',true ); 

if($show_page_header == 'yes') :
    $show_page_title = get_post_meta(get_the_ID(),'_cth_show_page_title',true );
?>
<!--section -->
<section class="color-bg parallax-section" data-scrollax-parent="true" id="sec1">
    <div class="bg par-elem"  data-bg="<?php echo esc_url( get_post_meta( get_the_ID(), '_cth_page_header_bg', true ) );?>" data-scrollax="properties: { translateY: '30%' }"></div>
    <?php if (empty(get_post_meta( get_the_ID(), '_cth_page_header_bg', true ))): ?>
        <div class="wave-bg wave-bg2"></div>
    <?php else: ?>
        <div class="overlay"></div>
    <?php endif; ?>
    <div class="container">
        <div class="flat-title-wrap center-align">
            <?php if($show_page_title == 'yes') : ?>
            <h1 class="head-sec-title"><span><?php single_post_title();?></span></h1>
            <?php endif ; ?>
            <span class="section-separator section-separator-dk-blue"></span>
            <?php 
                echo wp_kses_post( get_post_meta(get_the_ID(),'_cth_page_header_intro',true ) );
            ?>
        </div>
    </div>
</section>
<!-- section end -->
<div class="breadcrumbs-fs fl-wrap">
    <div class="container">
         <?php easybook_breadcrumbs(); ?>
    </div>
</div>
<?php endif;?>
<!--section -->   
<section class="middle-padding grey-blue-bg single-page-section" id="sec1">
    <div class="container">
        <div class="row">

            <div class="col-md-<?php echo esc_attr($sb_w );?> page-sidebar-column">
                <div class="blog-sidebar box-widget-wrap fl-wrap left-sidebar">
                    <?php 
                        get_sidebar('page'); 
                    ?>                 
                </div>
            </div>

            <div class="col-md-<?php echo (12 - $sb_w);?> col-wrap display-page hassidebar">
                <div class="list-single-main-wrapper fl-wrap" id="sec2">
                
                    <?php
                    while ( have_posts() ) : the_post();

                        get_template_part( 'template-parts/page/content', 'page' );

                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;

                    endwhile; // End of the loop.
                    ?>

                </div>
                <!-- end list-single-main-wrapper -->
            </div>
            <!-- end display-posts col-md-8 -->

        </div>
        <!-- end row -->
    </div>
    <!-- end container -->

</section>
<!-- section end -->

<?php 
get_footer( );
