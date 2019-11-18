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
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */
if ( post_password_required() ) {
    get_template_part( 'template-parts/page/protected', 'page' );
    return;
}
get_header(); 
$sb_w = easybook_get_option('blog-single-sidebar-width','4');

$show_page_header = get_post_meta(get_the_ID(),'_cth_show_page_header',true );
if($show_page_header == 'yes') :
    $show_page_title = get_post_meta(get_the_ID(),'_cth_show_page_title',true ); 
?>
<section class="color-bg middle-padding content-parallax-section" data-scrollax-parent="true">
    <div class="bg par-elem "  data-bg="<?php echo esc_url( get_post_meta( get_the_ID(), '_cth_page_header_bg', true ) );?>" data-scrollax="properties: { translateY: '30%' }"></div>
    <?php if (empty(get_post_meta( get_the_ID(), '_cth_page_header_bg', true ))): ?>
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
 <div class="breadcrumbs-fs fl-wrap">
    <div class="container">
         <?php easybook_breadcrumbs(); ?>      
    </div>
</div>
<?php endif;?>

<!--section -->   
<section class="middle-padding grey-blue-bg single-section" id="sec1">
    <div class="container">
        <div class="row">
            <?php if( easybook_get_option('blog_layout') ==='left_sidebar' && is_active_sidebar('sidebar-1')):?>
            <div class="col-md-<?php echo esc_attr($sb_w );?> blog-sidebar-column">
                <div class="blog-sidebar box-widget-wrap fl-wrap left-sidebar">
                    <?php 
                        get_sidebar(); 
                    ?>                 
                </div>
            </div>
            <?php endif;?>
            <?php if( easybook_get_option('blog_layout') ==='fullwidth' || !is_active_sidebar('sidebar-1')):?>
            <div class="col-md-12 display-post nosidebar">
            <?php else:?>
            <div class="col-md-<?php echo (12 - $sb_w);?> col-wrap display-post hassidebar">
            <?php endif;?>
                <div class="list-single-main-wrapper fl-wrap" id="sec2">
                
                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) : the_post();
                        // set post view
                        if(function_exists('easybook_addons_set_post_views')){
                            easybook_addons_set_post_views(get_the_ID());
                        }

                        get_template_part( 'template-parts/single/content', get_post_format() );

                        if( easybook_get_option('single_author_block', true ) && get_the_author_meta('description') !='' ) get_template_part( 'template-parts/single/author', 'block' );

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

            <?php if( easybook_get_option('blog_layout') === 'right_sidebar' && is_active_sidebar('sidebar-1')):?>
            <div class="col-md-<?php echo esc_attr($sb_w );?> blog-sidebar-column">
                <div class="blog-sidebar box-widget-wrap fl-wrap right-sidebar">
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

</section>
<!-- section end -->

<?php get_footer();




