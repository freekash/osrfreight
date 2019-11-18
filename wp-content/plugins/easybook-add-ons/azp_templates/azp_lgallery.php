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
$azp_mID = $el_id = $el_class = $items_width = $images_to_show = ''; 

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_lgallery',
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
if ( $gallery_imgs = get_post_meta( get_the_ID(), ESB_META_PREFIX.'gallery_imgs', true ) ) { 
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
    <div class="list-single-main-item-nobgr fl-wrap" >
        <!-- gallery-items   -->
        <div class="gallery-items grid-small-pad   list-single-gallery three-columns lightgallery">
            <div class="grid-sizer"></div>
            <?php
            $gMoreImages = array();
            $gMoreImage = '';
            $items_widths = explode(',',$items_width);
            foreach ($gallery_imgs as $key =>  $id ) {
                $image_post = get_post($id);
                if( null == $image_post) continue;
                ?>
                <?php if($key <= $images_to_show - 1):?>
                <!-- 1 -->
                <?php                    
                $item_cls = 'gallery-item';
                if(isset($items_widths[$key])){
                    switch ($items_widths[$key]) {
                        case 'x2':
                            $item_cls .= ' gallery-item-second';
                            break;
                        case 'x3':
                            $item_cls .= ' gallery-item-three';
                            break;
                    }
                }
                ?>
                    <div  class="<?php echo esc_attr( $item_cls ); ?>">
                        <div class="grid-item-holder">
                            <div class="box-item">
                                <?php echo wp_get_attachment_image( $id, 'lgallery' ); ?>
	                                <a href="<?php echo wp_get_attachment_url( $id );?>" data-sub-html=".listing-caption" class="gal-link popup-image">
	                                    <i class="fa fa-search"></i>
	                                    
	                                    <div class="listing-caption">
	                                        <h3><?php echo esc_html( $image_post->post_title ); ?></h3>
	                                        <?php echo $image_post->post_excerpt; ?>
	                                    </div>
                    
	                                </a>
                                
                            </div>
                        </div>
                    </div>
                    <!-- 1 end -->
                <?php else:
                	if($gMoreImage == '') $gMoreImage = wp_get_attachment_url($id);
                	$gMoreImages[] = array('src'=> wp_get_attachment_url($id), 'subHtml'=> get_the_title($id) );

                 endif;
            	}
            ?> 
            <?php if(!empty($gMoreImages)): ?>
				<!-- more -->
                <div class="gallery-item">
                    <div class="grid-item-holder">
                        <div class="box-item">
                            <img src="<?php echo $gMoreImage; ?>" class="attachment-lgallery size-lgallery" alt="">

                            <div class="more-photos-button dynamic-gal"  data-dynamicPath='<?php echo json_encode($gMoreImages);?>'><?php esc_html_e( 'Other', 'easybook-add-ons' );?> <span><?php echo count($gallery_imgs) - $images_to_show; ?></span><i class="far fa-long-arrow-right"></i></div>
                        </div>
                    </div>
                </div>
                <!-- more end -->
           <?php endif; ?>    
        </div>
        <!-- end gallery items -->                                 
    </div>
    <!-- list-single-main-item end -->     
</div>
<?php  } ?>