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
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

?>
<!-- list-single-main-item -->   
<div class="list-single-main-item fl-wrap">
    <div class="list-single-main-item-title fl-wrap author-heading">
        <h3><?php esc_html_e( 'Author', 'easybook' );?></h3>
    </div>
    <div class="post-author post-author-block clearfix">
        <div class="author-img">
            <?php 
                echo get_avatar(get_the_author_meta('user_email'), '80', '//0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=80', get_the_author_meta( 'display_name' ) );
            ?> 
        </div>
        <div class="author-content">
            <h5><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_meta('nickname');?></a></h5>
            <p><?php echo get_the_author_meta('description');?></p>
            <?php if ( 'no' !== esc_html_x( 'yes', 'Show author socials on single post page: yes or no', 'easybook' ) ) : ?>
            <div class="author-social">
                <ul>
                    <?php if(get_user_meta(get_the_author_meta('ID'), '_cth_twitterurl' ,true)!=''){ ?>
                        <li><a title="<?php esc_attr_e('Follow on Twitter','easybook');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_cth_twitterurl' ,true)); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <?php } ?>
                    <?php if(get_user_meta(get_the_author_meta('ID'), '_cth_facebookurl' ,true)!=''){ ?>
                        <li><a title="<?php esc_attr_e('Like on Facebook','easybook');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_cth_facebookurl' ,true)); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <?php } ?>
                    <?php if(get_user_meta(get_the_author_meta('ID'), '_cth_googleplusurl' ,true)!=''){ ?>
                        <li><a title="<?php esc_attr_e('Circle on Google Plus','easybook');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_cth_googleplusurl' ,true)) ;?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                    <?php } ?>
                    <?php if(get_user_meta(get_the_author_meta('ID'), '_cth_linkedinurl' ,true)!=''){ ?>
                        <li><a title="<?php esc_attr_e('Be Friend on Linkedin','easybook');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_cth_linkedinurl' ,true) ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                    <?php } ?>
                    <?php if(get_user_meta(get_the_author_meta('ID'), '_cth_instagramurl' ,true)!=''){ ?>
                        <li><a title="<?php esc_attr_e('Follow on Instagram','easybook');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_cth_instagramurl' ,true) ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                    <?php } ?>
                    <?php if(get_user_meta(get_the_author_meta('ID'), '_cth_tumblrurl' ,true)!=''){ ?>
                        <li><a title="<?php esc_attr_e('Follow on  Tumblr','easybook');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_cth_tumblrurl' ,true) ); ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li>
                    <?php } ?>  
                </ul>
            </div>
            <?php endif; ?>  
        </div>
    </div>
</div>
<!-- list-single-main-item end -->   