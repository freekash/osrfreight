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
$azp_mID = $el_id = $el_class = $images_to_show = $images_hightlight ='';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_sroom_gallery',
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
$gallery_imgs_room = get_post_meta( get_the_ID(), ESB_META_PREFIX.'room_images', true );
if (!empty($gallery_imgs_room) && $gallery_imgs_room != ''):   
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
	<?php   
        $gMoreImages = array();
        $gMoreImage = '';
        foreach ($gallery_imgs_room as $key =>  $id ) {
            if($gMoreImage == '') $gMoreImage = wp_get_attachment_url($id);
            $gMoreImages[] = array( 'src'=> wp_get_attachment_url($id), 'subHtml'=> get_the_title($id) );
        }
    ?>
    <div class="ajax-modal-media fl-wrap">
        <img src="<?php echo $gMoreImage; ?>" class="respimg" alt="">
        <div class="ajax-modal-title">
            <div class="section-title-separator"><span></span></div>
            <?php the_title(); ?>
        </div>
        <div class="ajax-modal-photos-btn dynamic-gal" data-dynamicPath='<?php echo json_encode($gMoreImages);?>'><?php echo sprintf(__( 'Photos (<span>%s</span>)', 'easybook-add-ons' ), count($gallery_imgs_room) ) ?></div>
    </div>
</div>
 <?php endif ?>