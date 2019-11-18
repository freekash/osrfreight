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
 * Template Name: Header Map
 *
 */

if ( post_password_required() ) {
    get_template_part( 'template-parts/page/protected', 'page' );
    return;
}

get_header(); 

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
            <div class="section-title-separator">
                <span>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </span>
            </div>
            <?php if($show_page_title == 'yes') : ?>
            <h1 class="head-sec-title"><span><?php single_post_title();?></span></h1>
            <?php endif ; ?>
            <span class="section-separator section-separator-dk-blue"></span>
            <?php 
                echo '<h4>'.wp_kses_post( get_post_meta(get_the_ID(),'_cth_page_header_intro',true ) ).'</h4>';
            ?>
        </div>
    </div>
    <div class="header-sec-link">
        <div class="container"><a href="#sec2" class="custom-scroll-link color-bg"><i class="fal fa-angle-double-down"></i></a></div>
    </div>
</section>
<!-- section end -->
<?php endif;?>
<div class="breadcrumbs-fs fl-wrap">
    <div class="container">
         <?php easybook_breadcrumbs(); ?>
    </div>
</div>

<?php
while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/page/content', 'fullwidth-page' );

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

endwhile; // End of the loop.
?>


<?php 
get_footer( );
