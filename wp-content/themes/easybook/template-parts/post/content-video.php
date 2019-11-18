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
 * Template part for displaying video posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

?>
<!-- article> --> 
<article id="post-<?php the_ID(); ?>" <?php post_class('fl-wrap ptype-content-video fw-post'); ?>>
	<?php
	if(get_post_meta(get_the_ID(), '_cth_embed_video', true)!=""){  ?>
    <div class="list-single-main-media fl-wrap">
        <div class="resp-video">
			<?php echo wp_oembed_get(esc_url(get_post_meta(get_the_ID(), '_cth_embed_video', true) )); ?>
		</div>
	</div>
	<?php
	}elseif(has_post_thumbnail( )){ ?>
	<div class="list-single-main-media fl-wrap">
        <a href="<?php the_permalink( ); ?>" class="blog-thumb-link">
        	<?php the_post_thumbnail('easybook-featured-image',array('class'=>'respimg') ); ?>
        </a>
    </div>
	<?php } ?>

    <div class="list-single-main-items fl-wrap">
        <div class="list-single-main-item-title fl-wrap">
        	<?php 
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
			easybook_edit_link( get_the_ID() );
			?>
        </div>
        <?php if(easybook_get_option('blog_post_format') ==='2'){
    			$excerpt = get_the_excerpt();
            	echo substr($excerpt, 0, 70);
            }else{
            	the_excerpt();
        	}
        ?>
        <?php easybook_link_pages(); ?>
		<?php easybook_list_post_author(); ?>
        <?php easybook_list_post_metas(); ?>
        <?php easybook_list_post_tags(); ?>
        <span class="fw-separator"></span>
        <div class="readmore-post"><a href="<?php the_permalink();?>" class="btn float-btn color-bg"><?php esc_html_e('Read more ','easybook' );?><i class="fal fa-angle-right"></i></a></div>
    </div>
</article>
<!-- article end -->       

