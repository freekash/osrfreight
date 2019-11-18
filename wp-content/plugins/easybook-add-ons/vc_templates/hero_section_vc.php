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


$css = $el_class = $bg_type = $slideshow_imgs = $video_id = $video_url = $bgimage = $overlay_opa = $show_search = $hide_text_field = $content_after = $scroll_url = $show_starts = $title = $show_separator = $separator_color = '';
// $css = $el_class = $h_color = $title = $show_starts = $show_separator = $separator_color = $show_search = $content_after = $hide_text_field = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'scroll-con-sec hero-section elementor-hero-section',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
$slider = explode(",", $slideshow_imgs);
?>

<section class="<?php echo esc_attr($css_class );?>" data-scrollax-parent="true">
    <?php 
    if($bg_type == 'image' && $bgimage != ''){ ?>
        <div class="hero-bg-wrap"><div class="bg" style="background-image:url(<?php echo wp_get_attachment_url( $bgimage );?>);"  data-bg="<?php echo wp_get_attachment_url( $bgimage );?>" data-scrollax="properties: { translateY: '200px' }"></div></div>
    <?php }elseif($bg_type == 'slideshow'){ ?>
        <div class="slideshow-container-wrap">
            <div class="slideshow-container" data-scrollax="properties: { translateY: '200px' }" >
                <?php
                foreach ( $slider as $key => $img ) {
                    ?>
                    <div class="slideshow-item">
                        <div class="bg" data-bg="<?php echo esc_url( easybook_addons_get_attachment_thumb_link($img, 'bg-image') ); ?>"></div>
                    </div>
                <?php
                }
                ?>                    
            </div>
        </div>
    <?php }else{ ?>
        <div class="media-container-wrap">
            <div class="media-container video-parallax" data-scrollax="properties: { translateY: '200px' }">
                <div class="bg mob-bg" data-bg="<?php echo esc_url( $bgimage );?>"></div>
                <?php if($bg_type == 'yt_video') { 
                    $mute = '1';
                    $quality = 'highres'; // 'default','small','medium','large','hd720','hd1080'
                    $fittobackground = '1';
                    $pauseonscroll = '0';
                    $loop = '1';
                    // Hg5iNVSp2z8
                ?>
                    <div  class="background-youtube-wrapper" data-vid="<?php echo esc_attr( $video_id );?>" data-mt="<?php echo esc_attr( $mute );?>" data-ql="<?php echo esc_attr( $quality );?>" data-ftb="<?php echo esc_attr( $fittobackground );?>" data-pos="<?php echo esc_attr( $pauseonscroll );?>" data-rep="<?php echo esc_attr( $loop );?>"></div>
                <?php } elseif($bg_type == 'vm_video') { 
                    $dataArr = array();
                    $dataArr['video'] = $video_id;
                    $dataArr['quality'] = '1080p'; // '4K','2K','1080p','720p','540p','360p'
                    $dataArr['mute'] = '1';
                    $dataArr['loop'] = '1';
                    // 97871257
                ?>
                    <div class="video-holder">
                        <div  class="background-vimeo" data-opts='<?php echo json_encode( $dataArr );?>'></div>
                    </div>
                <?php } else {
                    $video_attrs = ' autoplay';
                    $video_attrs .=' muted';
                    $video_attrs .=' loop';

                    // http://localhost:8888/easybook/wp-content/uploads/2018/03/3.mp4
                ?>
                    <div class="video-container">
                        <video<?php echo esc_attr( $video_attrs );?> class="bgvid">
                            <source src="<?php echo esc_url( $video_url );?>" type="video/mp4">
                        </video>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
    <div class="overlay"<?php if(!empty($overlay_opa)) echo ' style="opacity:'.$overlay_opa.';"';?>></div>
    <div class="hero-section-wrap fl-wrap">
        <div class="container">
            
            <div class="intro-item fl-wrap">
                <?php if($show_starts == 'yes'): ?>
                    <div class="section-title-separator">
                        <span></span>
                    </div>
                <?php endif; ?>

                <?php if(!empty($title)) echo '<h2>'.$title.'</h2>'; ?>

                <?php if($show_separator == 'yes'): ?>
                    <span class="section-separator section-separator-<?php echo $separator_color; ?>"></span> 
                <?php endif; ?>

                <?php if( !empty($content) ) : ?>
                    <h3><?php echo $content; ?></h3>
                <?php endif; ?>
                <!-- <?php if( !empty($content) )  : ?>
                    <?php echo wpb_js_remove_wpautop( $content ); ?>
                <?php endif; ?> -->
            </div>
            
            
            <?php if($show_search == 'yes') easybook_addons_get_template_part('templates/hero_search_form', '', array('hide_text_field' => $hide_text_field) ); ?>

            <?php if(!empty($content_after)): ?>
                <div class="intro-item-after fl-wrap">
                    <?php echo $content_after;?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- <div class="bubble-bg"> </div> -->
    <?php 
    if(!empty($scroll_url)): ?>
    <div class="header-sec-link">
        <a href="<?php echo $scroll_url;?>" class="custom-scroll-link color-bg"><i class="fa fa-angle-double-down"></i></a>
    </div>
    <?php 
    endif;?>
</section>
