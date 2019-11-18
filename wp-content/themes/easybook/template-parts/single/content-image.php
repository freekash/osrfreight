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
 * Template part for displaying image posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */


?>
<!-- article> --> 
<article id="post-<?php the_ID(); ?>" <?php post_class('pos-single ptype-content-image'); ?>>
    <?php 
    if(easybook_get_option('single_featured' )): ?>
        <?php
        if(has_post_thumbnail( )){ ?>
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

