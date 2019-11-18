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


$css = $el_class = $bg_type = $slideshow_imgs = $video_id = $video_url = $bgimage = $overlay_opa = $content = $show_search = $hide_text_field = $content_after = $scroll_url = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'scroll-con-sec hero-section elementor-hero-section',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>

<section class="<?php echo esc_attr($css_class );?>" data-scrollax-parent="true">
	<?php if($bg_type == 'image') { ?>
        <div class="hero-bg-wrap"><div class="bg" style="background-image:url(<?php echo wp_get_attachment_url($bgimage) ?>);" data-bg="<?php echo wp_get_attachment_url($bgimage); ?>" data-scrollax="properties: { translateY: '200px' }"></div></div>
    <?php }elseif($bg_type == 'slideshow') { ?>
	    <?php if($slideshow_imgs != '') :
			foreach ((array)$slideshow_imgs as $img_id) { 
				?>
		        <div class="slideshow-container" data-scrollax="properties: { translateY: '200px' }" >
		                <div class="slideshow-item">
                            <div class="bg" style="background-image:url(<?php echo wp_get_attachment_image($img_id, 'thumbnail', false,'' ) ?>);"  data-bg="">
                            </div>
                        </div>
		        </div>
			<?php } ?>
        <?php endif; ?>
    <?php }else { ?>
        <div class="media-container video-parallax" data-scrollax="properties: { translateY: '200px' }">
            <div class="bg mob-bg" style="background-image:url(<?php echo wp_get_attachment_url($bgimage); ?>);" data-bg="<?php echo wp_get_attachment_url($bgimage); ?>"></div>
            <?php if($bg_type == 'yt_video') : 
            	$mute = '1';
                $quality = 'highres'; // 'default','small','medium','large','hd720','hd1080'
                $fittobackground = '1';
                $pauseonscroll = '0';
                $loop = '1';
                // Hg5iNVSp2z8
            ?>
            	<div  class="background-youtube-wrapper" data-vid="<?php echo $video_id; ?>" data-mt="<?php echo $mute; ?>" data-ql="<?php echo $quality ?>" data-ftb="<?php echo $fittobackground; ?>" data-pos="<?php echo $pauseonscroll; ?>" data-rep="<?php echo $loop; ?>"></div>
        	<?php elseif($bg_type == 'vm_video') : 
        		$dataobj = array();
        		$dataobj['video'] = $video_id;
        		$dataobj['quality'] = '1080p';
        		$dataobj['mute'] = '1';
        		$dataobj['loop'] = '1';
        	?>
            	<div class="video-holder">
                	<div  class="background-vimeo" data-opts='<?php echo json_encode($dataobj);?>'></div>
            	</div>
        	<?php else : 
        		$video_attrs = ' autoplay muted loop';
            	// http://localhost:8888/easybook/wp-content/uploads/2018/03/3.mp4
        	?>
	            <div class="video-container">
	                <video <?php echo $video_attrs; ?> class="bgvid">
	                    <source src="<?php echo $video_url; ?>" type="video/mp4">
	                </video>
	            </div>
        	<?php endif; ?>
        </div>
    <?php } ?>
    <div class="overlay" <?php if($overlay_opa != ''): ?> style="opacity:<?php echo $overlay_opa; ?>" <?php endif; ?>></div>
    <div class="hero-section-wrap fl-wrap">
        <div class="container">
        	<p><?php echo $content; ?></p>
        	<?php if($content != ""): ?>
	            <div class="intro-item fl-wrap">
	                <?php echo $content; ?>
	            </div>
	        <?php endif; ?>
			
			<?php if($show_search == 'yes'): ?>
            	<?php easybook_addons_get_template_part('templates/hero_search_form', '', array('for_jstmpl' => 'yes') ); ?>
        	<?php endif; ?>
			
			<?php if($content_after != '') : ?>
	            <div class="intro-item-after fl-wrap">
	                <?php echo $content_after; ?>
	            </div>
	        <?php endif; ?>

        </div>
    </div>
    <!-- <div class="bubble-bg"></div> -->
    <?php if($scroll_url != '') : ?>
	    <div class="header-sec-link">
	        <a href="<?php echo $scroll_url; ?>" class="custom-scroll-link"><i class="fa fa-angle-double-down"></i></a>
	    </div>
	<?php endif; ?>
</section>