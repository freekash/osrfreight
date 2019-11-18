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
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

get_header(); 

$sb_w = easybook_get_option('blog-sidebar-width','4');     


if( easybook_get_option('show_blog_header', false) ) :?> 
<!--section -->
<section class="color-bg middle-padding" data-scrollax-parent="true">
    <div class="bg par-elem"  data-bg="<?php echo esc_url( easybook_get_option('blog_header_image' ) );?>" data-scrollax="properties: { translateY: '30%' }"></div>
    <?php if (empty(easybook_get_option('blog_header_image' ))): ?>
        <div class="wave-bg wave-bg2"></div>
    <?php else: ?>
        <div class="overlay"></div>
    <?php endif; ?>
    <div class="container">
        <div class="flat-title-wrap center-align">
            <h1 class="head-sec-title"><span><?php echo wp_kses_post( easybook_get_option('blog_head_title') );?></span></h1>
            <span class="section-separator"></span>
            <?php echo wp_kses_post( easybook_get_option('blog_head_intro') );?>
        </div>
    </div>
</section>
<!-- section end -->
<div class="breadcrumbs-fs fl-wrap">
    <div class="container">
         <?php easybook_breadcrumbs(); ?>
    </div>
</div>
<?php 
endif;?>
<!--section -->   
<section class="middle-padding grey-blue-bg" id="sec1">
    <div class="container">
        <div class="row">
            <?php if( easybook_get_option('blog_layout') ==='left_sidebar' && is_active_sidebar('sidebar-1')):?>
            <div class="col-md-<?php echo esc_attr($sb_w );?> blog-sidebar-column">
                <div class="blog-sidebar box-widget-wrap <?php if( easybook_get_option('blog_post_format') ==='1'): echo 'fixed-bar'?> <?php endif;?> fl-wrap left-sidebar">
                    <?php 
                        get_sidebar(); 
                    ?>                 
                </div>
            </div>
            <?php endif;?>
            <?php if( easybook_get_option('blog_layout') ==='fullwidth' || !is_active_sidebar('sidebar-1')):?>
            <div class="col-md-12 display-posts nosidebar">
            <?php else:?>
            <div class="col-md-<?php echo (12 - $sb_w);?> col-wrap display-posts post-container hassidebar">
            <?php endif;?>
                    <div class="list-single-main-wrapper fl-wrap <?php if( easybook_get_option('blog_post_format') ==='2'): echo 'list-single-format-post-wrapper'?> <?php endif;?>" id="sec2">
                        <?php
                        if ( have_posts() ) :

                            /* Start the Loop */
                            while ( have_posts() ) : the_post(); 

                                /*
                                 * Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                if(easybook_get_option('blog_show_format', true ))
                                    get_template_part( 'template-parts/post/content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) );
                                else
                                   get_template_part( 'template-parts/post/content' );

                            endwhile;

                            easybook_pagination();
                            

                        else :

                            get_template_part( 'template-parts/post/content', 'none' );

                        endif;
                        ?>

                    </div>
                    <!-- end list-single-main-wrapper -->
            </div>
            <!-- end display-posts col-md-8 -->

            <?php if( easybook_get_option('blog_layout') === 'right_sidebar' && is_active_sidebar('sidebar-1')):?>
            <div class="col-md-<?php echo esc_attr($sb_w );?> blog-sidebar-column">
                <div class="blog-sidebar box-widget-wrap  <?php if( easybook_get_option('blog_post_format') ==='1'): echo 'fixed-bar'?> <?php endif;?> fl-wrap right-sidebar">
                    <?php 
                        get_sidebar(); 
                    ?>                 
                </div>
            </div>
            <?php endif;?>
      
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
    <div class="limit-box fl-wrap"></div>
</section>
<!-- section end -->
<?php get_footer();
