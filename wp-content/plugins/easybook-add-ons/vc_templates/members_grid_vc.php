<?php
/**
 * @package EasyBook Add-Ons
 * @description A custom plugin for EasyBook - Hotel & Tour Booking WordPress Theme
 * @author CTHthemes - http://themeforest.net/user/cththemes
 * @date 03-10-2019
 * @version 1.1.7
 * @copyright Copyright ( C ) 2014 - 2019 cththemes.com . All rights reserved.
 * @license GNU General Public License version 3 or later; see LICENSE
 */


$css = $el_class = $ids = $ids_not = $order_by = $order = $posts_per_page = $columns_grid = $space = $show_btn = $view_all_link = $show_pagination = $is_external = $btn_name = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'items-grid-holder section-team',
    $space.'-pad',
    $columns_grid.'-cols',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
$href = vc_build_link( $view_all_link ); 

if(is_front_page()) {
    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
} else {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
}

if(!empty($ids)){
    $ids = explode(",", $ids);
    $post_args = array(
        'post_type' => 'member',
        'paged' => $paged,
        'posts_per_page'=> $posts_per_page,
        'post__in' => $ids,
        'orderby'=> $order_by,
        'order'=> $order,

        'post_status' => 'publish'
    );
}elseif(!empty($ids_not)){
    $ids_not = explode(",", $ids_not);
    $post_args = array(
        'post_type' => 'member',
        'paged' => $paged,
        'posts_per_page'=> $posts_per_page,
        'post__not_in' => $ids_not,
        'orderby'=> $order_by,
        'order'=> $order,

        'post_status' => 'publish'
    );
}else{
    $post_args = array(
        'post_type' => 'member',
        'paged' => $paged,
        'posts_per_page'=> $posts_per_page,
        'orderby'=> $order_by,
        'order'=> $order,

        'post_status' => 'publish'
    );
}
?>

<div class="<?php echo esc_attr($css_class );?>">
<?php 
    $posts_query = new \WP_Query($post_args);
    if($posts_query->have_posts()) : ?>
        <?php while($posts_query->have_posts()) : $posts_query->the_post(); ?>
            <!-- team-item -->
            <div id="member-<?php the_ID(); ?>" <?php post_class('items-grid-item team-box'); ?>>
                <?php
                if(has_post_thumbnail( )){ ?>
                <div class="team-photo">
                <?php the_post_thumbnail('easybook-featured-image',array('class'=>'respimg') ); ?>
                </div>
                <?php } ?>
                <div class="team-info">
                    <?php
                    the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
                    ?>
                    <?php the_excerpt(); ?>
                    <div class="team-social">
                        <ul >
                            <?php if(get_post_meta(get_the_ID(), '_cth_twitterurl' ,true)!=''){ ?>
                                <li><a title="<?php esc_attr_e('Follow on Twitter','easybook-add-ons');?>" href="<?php echo esc_url( get_post_meta(get_the_ID(), '_cth_twitterurl' ,true) ); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <?php } ?>
                            <?php if(get_post_meta(get_the_ID(), '_cth_facebookurl' ,true)!=''){ ?>
                                <li><a title="<?php esc_attr_e('Like on Facebook','easybook-add-ons');?>" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_cth_facebookurl' ,true)); ?>" target="_blank"><i class="fab fa-facebook"></i></a></li>
                            <?php } ?>
                            <?php if(get_post_meta(get_the_ID(), '_cth_googleplusurl' ,true)!=''){ ?>
                                <li><a title="<?php esc_attr_e('Circle on Google Plus','easybook-add-ons');?>" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_cth_googleplusurl' ,true)) ;?>" target="_blank"><i class="fab fa-google-plus"></i></a></li>
                            <?php } ?>
                            <?php if(get_post_meta(get_the_ID(), '_cth_linkedinurl' ,true)!=''){ ?>
                                <li><a title="<?php esc_attr_e('Be Friend on Linkedin','easybook-add-ons');?>" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_cth_linkedinurl' ,true) ); ?>" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                            <?php } ?>
                            <?php if(get_post_meta(get_the_ID(), '_cth_instagramurl' ,true)!=''){ ?>
                                <li><a title="<?php esc_attr_e('Follow on Instagram','easybook-add-ons');?>" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_cth_instagramurl' ,true) ); ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <?php } ?>
                            <?php if(get_post_meta(get_the_ID(), '_cth_tumblrurl' ,true)!=''){ ?>
                                <li><a title="<?php esc_attr_e('Follow on  Tumblr','easybook-add-ons');?>" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_cth_tumblrurl' ,true) ); ?>" target="_blank"><i class="fab fa-tumblr"></i></a></li>
                            <?php } ?>  
                            <?php if(get_post_meta(get_the_ID(), '_cth_behanceurl' ,true)!=''){ ?>
                                <li><a title="<?php esc_attr_e('View Behance profile','easybook-add-ons');?>" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_cth_behanceurl' ,true) ); ?>" target="_blank"><i class="fab fa-behance"></i></a></li>
                            <?php } ?>
                        </ul>
                        <?php if(get_post_meta(get_the_ID(), '_cth_mail' ,true)!=''){ ?>
                            <a class="team-contact_link" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_cth_mail' ,true) ); ?>" target="_blank"><i class="fa fa-envelope"></i></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- team-item end  -->

        <?php endwhile; ?>
    <?php endif; ?> 

</div>
<?php
if($show_pagination == 'yes') easybook_addons_custom_pagination($posts_query->max_num_pages,$range = 2, $posts_query) ;
?>
<?php
    if($show_btn == 'yes') :
        $url = $href['url'];
        $target = ($is_external == 'yes') ? 'target="_blank"' : '';
        if($url != '') { 
            echo '<div class="all-members-link"><a href="' . $url . '" ' . $target .' class="btn big-btn circle-btn dec-btn color-bg flat-btn">'.__('View All','easybook-add-ons').'<i class="fa fa-eye"></i></a></div>';
        } else {
            echo '<div class="all-members-link"><a href="#" ' . $target .' class="btn big-btn circle-btn dec-btn color-bg flat-btn">'.__('View All','easybook-add-ons').'<i class="fa fa-eye"></i></a></div>';
        }
    endif;
?>
<?php wp_reset_postdata();?>


