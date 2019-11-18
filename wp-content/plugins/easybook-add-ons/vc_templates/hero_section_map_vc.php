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


$css = $el_class = $content = $show_search = $hide_text_field = $use_pre_locs = $content_after = $cats = $scroll_url = $cat_ids = $ids = $ids_not = $posts_per_page ='';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'hero-section-map elementor-hero-section',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
$href = vc_build_link( $scroll_url );
// $url = $href['url'];
$url = ($href['url'] != '') ? $href['url'] : '#';
// $target = ($is_external == 'yes') ? 'target="_blank"' : '';
// $buttons = vc_param_group_parse_atts($atts['buttons']);
?>
<?php
if(!empty($ids)){
    $ids = explode(",", $ids);
    $post_args = array(
        'post_type' => 'listing',
        'posts_per_page'=> $posts_per_page,
        'post__in' => $ids,
        'post_status' => 'publish'
    );
}elseif(!empty($ids_not)){
    $ids_not = explode(",", $ids_not);
    $post_args = array(
        'post_type' => 'listing',
        'posts_per_page'=> $posts_per_page,
        'post__not_in' => $ids_not,
        'post_status' => 'publish'
    );
}else{
    $post_args = array(
        'post_type' => 'listing',
        'posts_per_page'=> $posts_per_page,
        'post_status' => 'publish'
    );
}

if(!empty($cat_ids)) $post_args['tax_query'] =  array(
                                                    array(
                                                        'taxonomy' => 'listing_cat',
                                                        'field'    => 'term_id',
                                                        'terms'    => $cat_ids,
                                                    ),
                                                );

        $gmap_listing = array();
        $posts_query = new \WP_Query($post_args);
        if($posts_query->have_posts()) { 
            while($posts_query->have_posts()){ 
                $posts_query->the_post();
                // $gmap_listing[] = easybook_addons_get_listing_post_data();
            }
        }
        wp_reset_postdata();
        wp_localize_script( 'easybook-addons', '_easybook_add_ons_locs', $gmap_listing);
        ?>
        <!-- home-map--> 
        <section class="<?php echo esc_attr( $css_class ); ?>">
            <div class="home-map fl-wrap">
                <!-- Map -->
                <div class="map-container fw-map2">
                    <?php if(easybook_addons_get_option('use_osm_map') == 'yes'): ?>
                    <div id="map-osm-main"></div>
                    
                <?php else: ?>
                    <div id="map-main"></div>
                <?php endif; ?>
                </div>
                <!-- Map end --> 

                <div class="absolute-main-search-input">
                    <div class="container">
                        <?php 
                        if(!empty($content)): ?>
                            <div class="intro-item fl-wrap">
                                <?php echo $content;?>
                            </div>
                        <?php 
                        endif;?>
                        <?php  if($show_search == 'yes') easybook_addons_get_template_part('templates/hero_search_form'); ?>
                         <?php 
                            if(!empty($content_after)): ?>
                            <div class="intro-item-after fl-wrap">
                                <?php echo $content_after;?>
                            </div>
                        <?php 
                        endif;?>
                    </div>
                </div>
                <!-- home-map end-->  
                <?php 
                if(!empty($url)): ?>
                    <div class="header-sec-link">
                        <div class="container"><a href="<?php echo $url;?>" class="custom-scroll-link color-bg"><i class="fal fa-angle-double-down"></i></a></div>
                    </div>
                <?php 
                endif;?>
            </div>
        </section>
        <!-- section end -->
