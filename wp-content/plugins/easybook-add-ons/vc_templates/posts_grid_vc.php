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


$css = $el_class = $cat_ids = $ids = $ids_not = $order_by = $order = $posts_per_page = $columns_grid = $space = $excerpt_length = $show_author = $show_date = $show_views = $show_cats = $read_all_link = $show_pagination = $is_external = $btn_name = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'items-grid-holder',
    $space.'-pad',
    $columns_grid.'-cols',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
$href = vc_build_link( $read_all_link ); 

if(is_front_page()) {
    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
} else {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
}

if(!empty($ids)){
    $ids = explode(",", $ids);
    $post_args = array(
        'post_type' => 'post',
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
        'post_type' => 'post',
        'paged' => $paged,
        'posts_per_page'=> $posts_per_page,
        'post__not_in' => $ids_not,
        'orderby'=> $order_by,
        'order'=> $order,

        'post_status' => 'publish'
    );
}else{
    $post_args = array(
        'post_type' => 'post',
        'paged' => $paged,
        'posts_per_page'=> $posts_per_page,
        'orderby'=> $order_by,
        'order'=> $order,

        'post_status' => 'publish'
    );
}
if(!empty($cat_ids))
    $post_args['cat'] = $cat_ids;
?>


<div class="<?php echo esc_attr($css_class );?>">
<?php 
    $posts_query = new \WP_Query($post_args);
    if($posts_query->have_posts()) : ?>
        <?php while($posts_query->have_posts()) : $posts_query->the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('items-grid-item card-post ptype-content'); ?>>
                <?php
                if(has_post_thumbnail( )){ ?>
                <div class="card-post-img fl-wrap">
                    <a href="<?php echo esc_url( get_permalink() );?>"><?php the_post_thumbnail('easybook-post-grid',array('class'=>'respimg') ); ?></a>
                </div>
                <?php } ?>
                <div class="card-post-content fl-wrap">
                    <?php
                    the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
                    ?>
                    <?php //the_excerpt();
                        easybook_addons_the_excerpt_max_charlength($excerpt_length);
                    ?>
                    <?php if( $show_author == 'yes' ):?>
                    <div class="post-author">
                        <?php 
                            echo get_avatar(get_the_author_meta('user_email'),'80','https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=80', get_the_author_meta( 'display_name' ) );
                        ?>
                        <?php esc_html_e( 'By, ',  'easybook-add-ons' ) ; the_author_posts_link( );?>
                    </div>
                    <?php endif;?>
                    <?php if( $show_date == 'yes' || $show_views == 'yes' || $show_cats == 'yes' ):?>
                    <div class="post-opt">
                        <ul>
                            <?php if( $show_date == 'yes' ):?><li><i class="fal fa-calendar-check-o"></i> <span><?php the_time(get_option('date_format'));?></span></li><?php endif;?>
                            <?php if( $show_views == 'yes' ):?><li><i class="fal fa-eye"></i> <span><?php echo easybook_addons_get_post_views(get_the_ID());?></span></li><?php endif;?>
                            <?php if( $show_cats == 'yes' ):?>
                                <?php if(get_the_category( )) { ?>
                                <li><i class="fal fa-tags"></i><?php the_category( ' , ' ); ?></li>  
                                <?php } ?>
                            <?php endif;?>
                        </ul>
                    </div>
                    <?php endif;?>
                </div>
            </article>
        <?php endwhile; ?> 
    <?php endif; ?> 
</div>
<?php
if($show_pagination == 'yes') easybook_addons_custom_pagination($posts_query->max_num_pages,$range = 2, $posts_query) ;
?>
<?php
    $url = $href['url'];
    $target = ($is_external == 'yes') ? 'target="_blank"' : '';
    if($url != '') { 
        echo '<div class="all-posts-link"><a href="' . $url . '" ' . $target .' class="btn color-bg ">'.$btn_name.'<i class="fa fa-caret-right"></i></a></div>';
    }else {
        echo '<div class="all-posts-link"><a href="#!" ' . $target .' class="btn color-bg ">'.$btn_name.'<i class="fa fa-caret-right"></i></a></div>';
    }
?>
<?php wp_reset_postdata();?>

