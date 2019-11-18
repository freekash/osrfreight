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
$azp_mID = $el_id = $el_class = $images_to_show = '';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_lheader_bgvideo',
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

$headerImages = get_post_meta( get_the_ID(), '_cth_header_imgs', true );
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
	<div class="list-single-carousel-wrap fl-wrap" id="sec1">
	    <?php if($headerImages){ ?>
	    <div class="fw-carousel fl-wrap full-height lightgallery">
	        <?php
	        
	            foreach ($headerImages as $id ) {
	                ?>
	                <!-- slick-slide-item -->
	                <div class="slick-slide-item">
	                    <div class="box-item">
	                        <?php echo wp_get_attachment_image( $id, 'full' ); ?>
	                        <a href="<?php echo wp_get_attachment_url( $id );?>" class="gal-link popup-image" data-sub-html=".listing-caption">
	                            <i class="fa fa-search"></i>
	                            <?php 
	                            $image = get_post($id);
	                            $image_title = $image->post_title;
	                            $image_caption = $image->post_excerpt;
	                            ?>
	                            <div class="listing-caption">
	                                <h3><?php echo esc_html( $image_title ); ?></h3>
	                                <?php echo $image_caption; ?>
	                            </div>
	                        </a>
	                    </div>
	                </div>
	                <!-- slick-slide-item end -->
	                <?php
	            }

	        ?>
	        
	    </div>
	    <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
	    <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
	    <?php } ?>
	</div>
	<!--  carousel  end-->
</div>