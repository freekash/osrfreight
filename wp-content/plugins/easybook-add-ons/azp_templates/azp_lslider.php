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



//$azp_attrs,$azp_content,$azp_element
$azp_mID = $el_id = $el_class = '';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_lslider',
    'azp-element-' . $azp_mID,
    $el_class,
);
// $animation_data = self::buildAnimation($azp_attrs);
// $classes[] = $animation_data['trigger'];
// $classes[] = self::buildTypography($azp_attrs);//will return custom class for the element without dot
// $azplgallerystyle = self::buildStyle($azp_attrs);

$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) ); 

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}
if ( $slider_imgs = get_post_meta( get_the_ID(), '_cth_gallery_imgs', true ) ) {
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
    <div class="list-single-main-item-nobgr fl-wrap">
        <div class="single-slider-wrapper fl-wrap">
            <div class="slider-for fl-wrap"  >
                <?php
                foreach ($slider_imgs as $id ) {
                    ?>
                    <div class="slick-slide-item"><?php echo wp_get_attachment_image( $id, 'lslider' ); ?></div>
                    <?php
                }
                ?> 
            </div>
            <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
            <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
        </div>
        <div class="single-slider-wrapper fl-wrap">
            <div class="slider-nav fl-wrap">
                <?php
                foreach ($slider_imgs as $id ) {
                    ?>
                    <div class="slick-slide-item"><?php echo wp_get_attachment_image( $id, 'lslider' ); ?></div>
                    <?php
                }
                ?> 
            </div>
        </div>
    </div>      
</div>
<?php } ?>