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
$show_page_title = get_post_meta(get_the_ID(),'_cth_show_page_title',true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('page-single'); ?>>
	 <div class="list-single-main-item-title fl-wrap">
		<?php if($show_page_title != 'yes'|| $show_page_title != '') the_title( '<h3 class="entry-title">', '</h3>' ); ?>
		<?php easybook_edit_link( get_the_ID() ); ?>
	</div> 
	<!-- .list-single-main-item-title-->
	<div class="page-single-content entry-content clearfix">
		<?php
			the_content();
		?>
	</div><!-- .entry-content -->
    <?php easybook_link_pages('page'); ?>
</article><!-- #post-## -->
