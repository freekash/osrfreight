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


$css = $el_class = $image = $title = $sub_title = $show_search = $id = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'slider-item fl-wrap',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>

<div class="<?php echo esc_attr( $css_class ); ?>">
    <div class="bg bg-ser" data-bg="<?php echo esc_url( easybook_addons_get_attachment_thumb_link($image, 'bg-image') ); ?>"></div>
    <div class="overlay"></div>
    <div class="hero-section-wrap fl-wrap">
        <div class="container">
            <?php 
            if(empty($id)){
                // if(!empty($content)):
                ?>
                <!-- <div class="intro-item fl-wrap">
                    <?php echo do_shortcode( $content );?>
                </div> -->
                <!-- <?php 
                endif;?> -->
                <div class="intro-item fl-wrap">
                	<?php if(!empty($title)) : ?>
                		<h2><?php echo $title; ?></h2>
                	<?php endif; ?>
                	<?php if(!empty($sub_title)) : ?>
                		<h2><?php echo $sub_title; ?></h2>
                	<?php endif; ?>
                </div>
                <?php if($show_search == 'yes') easybook_addons_get_template_part('templates/hero_search_form'); 
                }else{ 
                    $listing_post = get_post($id);
                    $rating = easybook_addons_get_average_ratings($listing_post->ID);
                ?>
                <div class="home-intro-card">
                    <div class="listing-rating-wrap">
                        <div class="listing-rating card-popup-rainingvis" data-starrating2="<?php echo $rating['sum'];?>"></div>
                    </div>
                    <div class="clearfix"></div>
                    <h3><?php echo $listing_post->post_title; ?></h3>
                    <div class="clearfix"></div>
                    <div class="home-intro-card-counter home-intro-card-counter_price">
                        <?php echo sprintf(
                            __( 'Awg/Night %s', 'easybook-add-ons' ), 
                            '<strong class="per-night-price">'.easybook_addons_get_price_formated(get_post_meta($listing_post->ID , ESB_META_PREFIX.'price_from', true )).'</strong>'
                        ) ?>
                    </div>
                    <div class="clearfix"></div>
                    <h5><?php echo $listing_post->post_excerpt; ?></h5>
                    <a href="<?php echo get_the_permalink($listing_post->ID)?>" class="btn  color2-bg float-btn"> <?php esc_html_e( 'View All Details', 'easybook-add-ons' ); ?><i class="fas fa-caret-right"></i></a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
