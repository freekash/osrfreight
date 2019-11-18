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
$azp_mID = $el_id = $el_class  = $bk_img = '';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_lpromo_video',
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
// var_dump($bk_img);
// $promo_bg = get_post_meta( get_the_ID(), '_cth_promo_bg', true );
if ( get_post_meta( get_the_ID(), '_cth_promovideo_url', true ) !='' ) {
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
    <?php  if(empty( $bk_img )){ ?>
        <div class="list-single-main-item-nobgr fl-wrap promo-video-embed">
            <!-- <div class="list-single-main-item-title fl-wrap">
                <h3><?php esc_html_e( 'Promo Video', 'easybook-add-ons' ); ?></h3>
            </div> -->
            <div class="iframe-holder fl-wrap">
                <div class="resp-video">
                    <?php echo wp_oembed_get(esc_url(get_post_meta(get_the_ID(), '_cth_promovideo_url', true) )); ?>
                </div>
            </div>
        </div>
    <?php }else{ ?>
        <div class="list-single-main-media fl-wrap" id="sec_promo_video">
            <?php echo wp_get_attachment_image( $bk_img, 'featured', false, array('class'=>'respimg') );?>
            <a href="<?php echo esc_url( get_post_meta( get_the_ID(), '_cth_promovideo_url', true ) ); ?>" class="promo-link gradient-bg image-popup"><i class="fa fa-play"></i><span><?php esc_html_e( 'Promo Video', 'easybook-add-ons' ); ?></span></a>
        </div>
    <?php } ?>   
</div>
<?php 
}
// end if promo_video 
?>