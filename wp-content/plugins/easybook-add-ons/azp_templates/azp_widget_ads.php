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



$azp_mID = $el_id = $el_class = $contents_order  = '';
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_widget_ads',
    'box-widget-item fl-wrap',
    'azp-element-' . $azp_mID,
    $el_class,
);
// $animation_data = self::buildAnimation($azp_attrs);
// $classes[] = $animation_data['trigger'];
// $classes[] = self::buildTypography($azp_attrs);//will return custom class for the element without dot
// $azptextstyle = self::buildStyle($azp_attrs);

$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) );

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}
if(easybook_addons_get_option('ads_sidebar_enable') != 'yes') return;
$args = array(
    'post_type'             =>  'listing', 
    'orderby'               => easybook_addons_get_option('ads_sidebar_orderby'),
    'order'                 => easybook_addons_get_option('ads_sidebar_order'),
    'posts_per_page'        => easybook_addons_get_option('ads_sidebar_count'),
    'post__not_in'          => array(get_the_ID()),
    'meta_query'            => array(
        'relation' => 'AND',
        array(
            'key'     => ESB_META_PREFIX.'is_ad',
            'value'   => '1',
        ),
        // array(
        //     'key'     => ESB_META_PREFIX.'ad_position',
        //     'value'   => 'sidebar',
        // ),
        array(
                'key'     => ESB_META_PREFIX.'ad_position_sidebar',
                'value'   => '1',
        ),
        array(
            'key'     => ESB_META_PREFIX.'ad_expire',
            'value'   => current_time('mysql', 1),
            'compare' => '>=',
            'type'    => 'DATETIME',
        ),
    ),

);
// The Query
$posts_query = new WP_Query( $args );
if($posts_query->have_posts()) :
?>
    <div class="<?php echo $classes; ?>" <?php echo $el_id;?>> 
        <div class="box-widget-item-header">
            <h3><?php esc_html_e( 'ADs : ', 'easybook-add-ons' );?></h3>
        </div>
        <div class="sidebar-ad-widget">
            <div class="sidebar-ad-carousel slick-carouse-wrap fl-wrap">
                <div class="listing-carousel-ads  fl-wrap">
                <?php 
                while($posts_query->have_posts()) : $posts_query->the_post();
                    ?>
                    <!--slick-slide-item-->
                    <?php easybook_addons_get_template_part('template-parts/listing', false, array( 'for_slider'=>true,'is_ad'=>true ));?>
                    <!--slick-slide-item-->
                    <?php
                endwhile;
                ?>

                </div>
            </div>
        </div> 
    </div>
<?php 
    wp_reset_postdata(); 
endif;