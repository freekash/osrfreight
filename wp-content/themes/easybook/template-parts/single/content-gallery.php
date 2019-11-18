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
 * Template part for displaying gallery posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

?>
<!-- article> --> 
<article id="post-<?php the_ID(); ?>" <?php post_class('pos-single ptype-content-gallery'); ?>> 
    <?php 
    if(easybook_get_option('single_featured' )): ?>
        <?php 
        // Get the list of files
        $slider_images = get_post_meta( get_the_ID(), '_cth_post_slider_images', true);
        if( !empty($slider_images)&& easybook_get_option('blog_show_format' ) ){ ?>
        <div class="list-single-main-media fl-wrap">
        	<div class="gallery-items lightgallery ver-small-pad <?php echo get_post_meta( get_the_ID() , '_cth_gallery_cols', true );?>-columns">
	            <div class="grid-sizer"></div>
	        <?php 
	        foreach ( (array) $slider_images as $img_id => $img_url ) {
	            ?>

	            <div class="gallery-item">
	                <div class="grid-item-holder">
	                    <?php echo wp_get_attachment_image( $img_id, 'easybook-folio-one'); ?>
	                    <a href="<?php echo esc_url( wp_get_attachment_url($img_id ) );?>" class="popup-image slider-zoom"><i class="fa fa-search"></i></a>
	                </div>
	            </div>

	        <?php
	        }
	        ?>
	        

	        </div>
        </div>
        <?php
        }elseif(has_post_thumbnail( )){ ?>
        <div class="list-single-main-media fl-wrap">
            <?php the_post_thumbnail('easybook-single-image',array('class'=>'respimg') ); ?>
        </div>
        <?php } 
        ?>
    <?php 
    endif; ?>
    <div class="list-single-main-items fl-wrap">
        <div class="list-single-main-item-title fl-wrap">
            <?php 
            the_title( '<h3 class="entry-title">', '</h3>' );
            easybook_edit_link( get_the_ID() );
            ?>
        </div>
        <?php the_content();?>
        <?php easybook_link_pages('post-single'); ?>
        <div class="clearfix"></div>
        <?php easybook_single_post_author(); ?>
        <?php easybook_single_post_metas(); ?>
        <?php easybook_single_post_tags(); ?>
        <span class="fw-separator"></span>
        <?php easybook_post_nav();?> 
    </div>
</article>
<!-- article end -->       
<span class="section-separator"></span>

