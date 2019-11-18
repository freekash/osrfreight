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


$css = $el_class = $cat_ids = $ids = $ids_not = $order_by = $order = $posts_per_page = $columns_grid = $map_pos = $map_width = $filter_pos = $show_pagination = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$class_width = ($map_pos != 'top' && $map_pos != 'hidden') ? $map_width : '';
$css_classes = array(
    'listings-grid-wrap clearfix',
    $columns_grid.'-cols',
    'map-width-'.$class_width,
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

if(!empty($ids)){
    $ids = explode(",", $ids);
    $post_args = array(
        'post_type' => 'listing',
        'paged' => 1,
        'posts_per_page'=> $posts_per_page,
        'post__in' => $ids,
        'orderby'=> $order_by,
        'order'=> $order,
        'post_status' => 'publish'
    );
}elseif(!empty($ids_not)){
    $ids_not = explode(",", $ids_not);
    $post_args = array(
        'post_type' => 'listing',
        'paged' => 1,
        'posts_per_page'=> $posts_per_page,
        'post__not_in' => $ids_not,
        'orderby'=> $order_by,
        'order'=> $order,

        'post_status' => 'publish'
    );
}else{
    $post_args = array(
        'post_type' => 'listing',
        'paged' => 1,
        'posts_per_page'=> $posts_per_page,
        'orderby'=> $order_by,
        'order'=> $order,

        'post_status' => 'publish'
    );
}

$filter_args = array(
    'posts_per_page'=> $posts_per_page,
    'orderby'=> $order_by,
    'order'=> $order,
);



if(!empty($cat_ids)) $post_args['tax_query'] =  array(
                                                    array(
                                                        'taxonomy' => 'listing_cat',
                                                        'field'    => 'term_id',
                                                        'terms'    => $cat_ids,
                                                    ),
                                                );

$meta_queries = array();
if(!empty($meta_queries)) $post_args['meta_query'] = $meta_queries;

?>
<!-- carousel -->
<div class="<?php echo esc_attr( $css_class );?>">
<?php 
$filter_wrap_cl = '';
switch ($map_pos) {
    case 'left':
        $map_wrap_cl = 'listings-has-map column-map left-pos-map fix-map hid-mob-map';
        $list_wrap_cl = 'right-list';
        $filter_wrap_cl = 'right-filter';
        break;
    case 'right':
        $map_wrap_cl = 'listings-has-map column-map right-pos-map fix-map hid-mob-map';
        $list_wrap_cl = 'left-list';
        break;
    case 'top':
        $map_wrap_cl = 'listings-has-map fw-map top-post-map big_map hid-mob-map';
        $list_wrap_cl = 'fh-col-list-wrap left-list';
        break;
    default:
        $map_wrap_cl = 'listings-has-map column-map right-pos-map fix-map hid-mob-map';
        $list_wrap_cl = 'fh-col-list-wrap left-list fix-mar-map';
        break;
        }

if($filter_pos == 'left_col'){
    $map_wrap_cl .= ' map-lcol-filter';
    $list_wrap_cl .= ' list-lcol-filter';
}
?>
<?php 
if($map_pos != 'hide' && $map_pos != 'top'): ?> 

    <div class="map-container <?php echo esc_attr( $map_wrap_cl ); ?>">
        <?php if(easybook_addons_get_option('use_osm_map') == 'yes'): ?>
            <div id="map-osm-main"></div>
            
        <?php else: ?>
            <div id="map-main"></div>
            <ul class="mapnavigation">
                <li><a href="#" class="prevmap-nav"><i class="fas fa-caret-left"></i><?php esc_html_e( 'Prev', 'easybook-add-ons' ); ?></a></li>
                <li><a href="#" class="nextmap-nav"><?php esc_html_e( 'Next', 'easybook-add-ons' ); ?><i class="fas fa-caret-right"></i></a></li>
            </ul>
            
        <?php endif; ?>
        <div class="map-close"><i class="fas fa-times"></i></div>
    </div>
    <!-- Map end -->  
<?php endif; ?>
<?php if($map_pos != 'hide' && $map_pos == 'top'): ?>
    <div class="map-container <?php echo esc_attr( $map_wrap_cl ); ?>">
        <?php if(easybook_addons_get_option('use_osm_map') == 'yes'): ?>
            <div id="map-osm-main"></div>
        <?php else: ?>
            <div id="map-main"></div>
            <ul class="mapnavigation">
                <li><a href="#" class="prevmap-nav"><i class="fas fa-caret-left"></i><?php esc_html_e( 'Prev', 'easybook-add-ons' ); ?></a></li>
                <li><a href="#" class="nextmap-nav"><?php esc_html_e( 'Next', 'easybook-add-ons' ); ?><i class="fas fa-caret-right"></i></a></li>
            </ul>
            
        <?php endif; ?>
        <div class="map-close"><i class="fas fa-times"></i></div>
    </div>
    <!-- Map end -->
    <div class="breadcrumbs-fs fl-wrap">
        <div class="container">
             <?php easybook_breadcrumbs(); ?>  
        </div>
    </div>
<?php endif; ?>
<?php if($filter_pos == 'left_col'): ?>
<div class="col-filter-wrap col-filter <?php echo esc_attr( $filter_wrap_cl ); ?>">
    <div class="container">
        <div class="mobile-list-controls fl-wrap">
            <div class="container">
                <div class="mlc show-hidden-column-map schm"><i class="fal fa-map-marked-alt"></i><?php esc_html_e( ' Show Map', 'easybook-add-ons' ); ?></div>
                <div class="mlc show-list-wrap-search"><i class="fal fa-filter"></i><?php esc_html_e( ' Filter', 'easybook-add-ons' ); ?></div>
            </div>
        </div>
        <div class="fl-wrap listing-search-sidebar">
            <?php easybook_addons_get_template_part('templates/filter_form', '', $filter_args); ?>
        </div>
    </div>
</div>
<?php endif; ?>
<!--col-list-wrap -->   
    <div class="col-list-wrap col-list-wrap-main <?php echo esc_attr( $list_wrap_cl ); ?> <?php if($map_pos == 'top') echo 'col-list-top'?>">
        <?php if($filter_pos == 'top'): ?>
        <div class="mobile-list-controls fl-wrap">
            <div class="container">
                <?php if ($map_pos != 'hide') {?>
                    <div class="mlc show-hidden-column-map schm"><i class="fal fa-map-marked-alt"></i><?php esc_html_e( ' Show Map', 'easybook-add-ons' ); ?></div>
                    <div class="mlc show-list-wrap-search"><i class="fal fa-filter"></i><?php esc_html_e( ' Filter', 'easybook-add-ons' ); ?></div>
                <?php }else{?>
                     <div class="mlc show-list-wrap-search fl-wrap"><i class="fal fa-filter"></i><?php esc_html_e( ' Filter', 'easybook-add-ons' ); ?></div>
                <?php } ?>
            </div>
        </div>
        <?php if($map_pos == 'left' || $map_pos == 'right'){?>
             <?php easybook_addons_get_template_part( 'templates/filter_form', '', $filter_args ); ?>
        <?php }else{ ?>
            <div class="fl-wrap top-filter-wrap">
                <div class="container">
                     <?php easybook_addons_get_template_part( 'templates/filter_form', '', $filter_args ); ?>
                </div>
            </div>
        <?php } ?>
        <?php elseif($filter_pos == 'left_col'): ?>
        <div class="mobile-list-controls fl-wrap">
            <div class="container">
                <div class="mlc show-hidden-column-map schm"><i class="fal fa-map-marked-alt"></i><?php esc_html_e( ' Show Map', 'easybook-add-ons' ); ?></div>
                <div class="mlc show-list-wrap-search"><i class="fal fa-filter"></i><?php esc_html_e( ' Filter', 'easybook-add-ons' ); ?></div>
            </div>
        </div>
        <?php endif; ?>
        <?php if ($filter_pos == 'left_col'|| $filter_pos == 'left' && $map_pos == 'top') {?>
           <div class="mobile-list-controls fl-wrap">
                <div class="container">
                    <div class="mlc show-hidden-column-map schm"><i class="fal fa-map-marked-alt"></i><?php esc_html_e( ' Show Map', 'easybook-add-ons' ); ?></div>
                    <div class="mlc show-list-wrap-search"><i class="fal fa-filter"></i><?php esc_html_e( ' Filter', 'easybook-add-ons' ); ?></div>
                </div>
            </div>
        <?php } ?>
        <!-- list-main-wrap-->
        <div class="<?php if($map_pos != 'top' && $filter_pos != 'left') echo 'list-main-wrap'?> fl-wrap card-listing">
            <a class="custom-scroll-link back-to-filters" href="#lisfw"><i class="fas fa-angle-up"></i>
                <span><?php esc_html_e( 'Back to Filters', 'easybook-add-ons' ); ?></span></a> 
            <div class="container"> 
                <div class="row">
                    <?php 
                    if($filter_pos == 'left'):?>
                    <div class="mobile-list-controls fl-wrap">
                        <div class="container">
                            <div class="mlc show-hidden-column-map schm"><i class="fal fa-map-marked-alt"></i> <?php esc_html_e( ' Show Map', 'easybook-add-ons' ); ?></div> 
                            <div class="mlc show-list-wrap-search"><i class="fal fa-filter"></i><?php esc_html_e( ' Filter', 'easybook-add-ons' ); ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="fl-wrap listing-search-sidebar ">
                            <?php easybook_addons_get_template_part('templates/filter_form', '', $filter_args ); ?>
                        </div>
                    </div>
                    <?php endif;?>
                    <?php 
                    if($map_pos == 'top' && $filter_pos == 'left'):?>
                        <div class="mobile-list-controls fl-wrap" style="margin-bottom: 50px;margin-top:0;">
                            <div class="container">
                                <div class="mlc show-hidden-column-map schm"><i class="fal fa-map-marked-alt"></i> <?php esc_html_e( ' Show Map', 'easybook-add-ons' ); ?></div>
                                <div class="mlc show-list-wrap-search"><i class="fal fa-filter"></i><?php esc_html_e( ' Filter', 'easybook-add-ons' ); ?></div>
                            </div>
                        </div>
                    <?php 
                       endif; 
                        ?>
                    <?php 
                    if($filter_pos == 'left' || $filter_pos == 'right'):?>
                    <div class="col-md-8">
                    <?php else : ?>
                    <div class="col-md-12">
                    <?php endif;?>
                        <div class="listsearch-header fl-wrap">
                            <div class="list-main-wrap-title fl-wrap">
                                <h2><?php esc_html_e( 'Results For : ',  'easybook-add-ons' );?><span><?php esc_html_e( 'All Listing',  'easybook-add-ons' );?></span></h2>
                            </div>
                            <!-- list-main-wrap-opt-->
                            <div class="list-main-wrap-opt fl-wrap">
                                <!-- price-opt-->
                                <div class="price-opt">
                                    <span class="price-opt-title"><?php esc_html_e( 'Sort results by:',  'easybook-add-ons' );?></span>
                                    <div class="listsearch-input-item">
                                        <select data-placeholder="Popularity" class="chosen-select no-search-select" name="morderby">
                                            <option value="popularity"><?php esc_html_e( 'Popularity',  'easybook-add-ons' );?></option>
                                            <option value="average_rating"><?php esc_html_e( 'Average rating',  'easybook-add-ons' );?></option>
                                            <option value="price_low"><?php esc_html_e( 'Price: low to high',  'easybook-add-ons' );?></option>
                                            <option value="price_high"><?php esc_html_e( 'Price: high to low',  'easybook-add-ons' );?></option>
                                        </select>
                                    </div>
                                    <?php  ?>
                                </div>
                                <!-- price-opt end-->
                                <!-- price-opt-->
                                <div class="listing-view-layout grid-opt">
                                    <ul>
                                        <li><a class="grid<?php if(easybook_addons_get_option('listings_grid_layout')=='grid') echo ' active';?>" href="#"><i class="fas fa-th-large"></i></a></li>
                                        <li><a class="list<?php if(easybook_addons_get_option('listings_grid_layout')=='list') echo ' active';?>" href="#"><i class="fas fa-bars"></i></i></a></li>
                                    </ul>
                                </div>
                                <!-- price-opt end-->                             
                            </div>
                            <!-- list-main-wrap-opt end-->
                        </div>
                        <div class="listing-term-desc"></div>
                        <div id="listing-items" class="listing-items pot-fl clearfix">
                            <?php
                            $action_args = array(
                                'gmap_listings' => array()
                            );
                            // https://codex.wordpress.org/Function_Reference/do_action_ref_array
                            do_action_ref_array( 'easybook_addons_elementor_listings_grid_before', array(&$action_args) );

                            $posts_query = new \WP_Query($post_args);
                            if($posts_query->have_posts()) :
                                /* Start the Loop */
                                while($posts_query->have_posts()) : $posts_query->the_post(); 
                                    // $action_args['gmap_listings'][] = easybook_addons_get_listing_post_data();

                                endwhile;

                            endif;
                                ?>
                        </div>
                        <?php
                        if($show_pagination == 'yes'){
                        ?>
                        <div class="listings-pagination-wrap">
                            <?php
                            easybook_addons_ajax_pagination($posts_query->max_num_pages,$range = 2, $posts_query);
                            ?>
                        </div>
                        <?php
                        }
                        // end if has_posts
                        wp_localize_script( 'easybook-addons', '_easybook_add_ons_locs', $action_args['gmap_listings']);
                        // wp_localize_script( 'easybook-addons', '_easybook_add_ons_eqv', $posts_query->query_vars);

      
                        ?>
                    </div>
                    <!-- end col-md-8 -->
                    <?php 
                    if($filter_pos == 'right'):?>
                    <div class="col-md-4">
                        <?php if ($map_pos == 'hide'){ ?>
                            <div class="mobile-list-controls fl-wrap" style="margin-bottom: 50px;margin-top:0;">
                                <div class="container">
                                    <div class="mlc show-list-wrap-search fl-wrap"><i class="fal fa-filter"></i> Filter</div>
                                </div>
                            </div>
                        <?php }else{ ?>
                            <div class="mobile-list-controls fl-wrap">
                                <div class="container">
                                    <div class="mlc show-hidden-column-map schm"><i class="fal fa-map-marked-alt"></i><?php esc_html_e( ' Show Map', 'easybook-add-ons' ); ?></div> 
                                    <div class="mlc show-list-wrap-search"><i class="fal fa-filter"></i><?php esc_html_e( ' Filter', 'easybook-add-ons' ); ?></div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="fl-wrap listing-search-sidebar">
                            <?php easybook_addons_get_template_part('templates/filter_form', '', $filter_args ); ?>
                        </div>
                    </div>
                    <?php endif;?>

                </div> 
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- list-main-wrap end-->
    </div>
    <!--col-list-wrap -->  
    <!-- <div class="limit-box fl-wrap"></div> -->
</div>
<!--  listings-grid-wrap end-->

<div class="limit-box fl-wrap"></div>

<?php //easybook_addons_get_template_part('templates/tmpls'); ?>

<?php wp_reset_postdata();?>
