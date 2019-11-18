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


if ( ! defined( 'ABSPATH' ) ) { 
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $parallax_speed_bg
 * @var $parallax_speed_video
 * @var $content - shortcode content
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = $css_animation = '';
$disable_element = '';
$output = $after_output = '';

// for custom fields
$cth_layout
= $cth_sec_width
= $cth_padding
= $cth_bg_color
= $cth_overlay_color
// = $decor_top_bg
= $cth_cover_color
= $decor_bot_bg
= $cth_bubble_canvas
= $decor_bot_bg_hero
= $sec_scroll_link
// = $cth_scroll_btn_loca
= '';

$cth_parallax_bg = $cth_parallax_pos  = $cth_parallax_val

 = $bg_video_type = $bg_video = $bg_video_mute = $bg_video_loop

 = $use_particle = $particle_count = $particle_color

/* For portfolio layout */
 = $gallery_images

 = $items = $autoplay = $autoplayspeed = $autoplaytimeout = $responsive = $autoheight = $loop = $dots = $smartspeed = $center = $autowidth 

 = $show_thumbs = $show_cap = $show_zoom = $show_more_info

 = $gal_columns = $gal_space

 = $video_id = $video_bg_id = $video_quality = $video_mute

 = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// var_dump($cth_layout);
if($cth_layout == 'cth_hero_sec'){ //layout #2?>
	<?php $el_class = $this->getExtraClass( $el_class );

	$css_classes = array(
	    'cththemes_sec cth_hero_sec',
	    $el_class,
	    vc_shortcode_custom_css_class( $css ),
	    $cth_bg_color,
	    $cth_padding,
	);

	if ( 'yes' === $disable_element ) {
	    if ( vc_is_page_editable() ) {
	        $css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	    } else {
	        return '';
	    }
	}

	if ( isset( $atts['gap'] ) && $atts['gap'] != '' ) {
		$css_classes[] = 'cth_column-gap-' . $atts['gap'];
	}

	$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

	if($cth_parallax_bg != '' ) $css_class .= ' cth-para-sec';
	if($cth_bubble_canvas == 'yes'){
		$css_class .= ' use-bubbleUp';
	}
	// if($sec_scroll_link != ''){
	// 		$css_class .= ' use-scroll-button';
	// 	} 
	if( $decor_bot_bg_hero != '') $css_class .=' cth-bt-decor'; ?>
	<section <?php
	    echo isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : ""; ?> <?php
	    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?><?php echo !empty($cth_parallax_bg) ? ' data-scrollax-parent="true"' : '' ;?>>
	    

		<?php if(!empty($cth_parallax_bg)) :?>
		    <?php 
		    $bgcls = 'cth-bg '; 
		    $bgcls .= $cth_parallax_pos.'-dec-bg';
		    if(!empty($cth_parallax_val)){
		        $bgcls .= ' cth-para-bg';
		    }?>
		    <div class="<?php echo esc_attr($bgcls );?>" data-cthbg="<?php echo esc_url(easybook_addons_get_attachment_thumb_link($cth_parallax_bg, 'full') );?>"
			    <?php if(!empty($cth_parallax_val)): ?>
			     data-scrollax="properties:{<?php echo esc_attr($cth_parallax_val );?>}"
			    <?php endif; ?>  style="background: url(<?php echo wp_get_attachment_url( $cth_parallax_bg ); ?>) repeat; <?php if(!empty($cth_cover_color)) echo 'opacity: '.$cth_overlay_color; ?>"
		    ></div>
		<?php endif; ?>

	    <?php if($cth_overlay_color != '') : ?>
	    <div class="cth-overlay" style="opacity: <?php echo esc_attr($cth_overlay_color );?>;"></div>
	    <?php endif;?>

	    <div class="cth-sec-container container <?php echo esc_attr( $cth_sec_width ); ?>">
	        <div class="row cth-sec-row">
	            <?php echo wpb_js_remove_wpautop($content); ?>
	        </div>
	    </div>

		<!-- <div class="banner-bottom-shap-img-wrapper <?php if($decor_bot_bg_hero ==''): ?>scroll_bottom_no_image<?php endif; ?>">
			<?php if($sec_scroll_link != ''): ?>
				<div  class="scroll_bottom">
	                <div class="circle">
	                	<a href="<?php echo $sec_scroll_link; ?>"><span></span></a>
	                </div>
	            </div>
	    	<?php endif; ?>
	    	<?php if($decor_bot_bg_hero != ''): ?>
	        	<?php echo wp_get_attachment_image( $decor_bot_bg_hero, 'full'); ?>
	    	<?php endif; ?>
	    </div> -->
	    
	    <?php if($sec_scroll_link != ''): ?>
	    <div class="header-sec-link">
	            <div class="container"><a href="<?php echo $sec_scroll_link; ?>" class="custom-scroll-link color-bg"><i class="fal fa-angle-double-down"></i></a></div>
	        </div>
	    <?php endif ?>
		
	</section>
<?php }elseif($cth_layout == 'cth_page_sec'){ //layout #3?>
	<?php $el_class = $this->getExtraClass( $el_class );

		$css_classes = array(
		    'cththemes_sec cth_page_sec',
		    $el_class,
		    vc_shortcode_custom_css_class( $css ),
		    $cth_bg_color,
		    $cth_padding,
		);

		if ( 'yes' === $disable_element ) {
		    if ( vc_is_page_editable() ) {
		        $css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
		    } else {
		        return '';
		    }
		}

		if ( isset( $atts['gap'] ) && $atts['gap'] != '' ) {
			$css_classes[] = 'cth_column-gap-' . $atts['gap'];
		}

		$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

		if($cth_parallax_bg != '' ) $css_class .= ' cth-para-sec';
		if($cth_bubble_canvas == 'yes'){
			$css_class .= ' use-bubbleUp';
		} 
		
		if( $decor_bot_bg != '') $css_class .=' cth-bt-decor';
		if( $cth_cover_color != '') $css_class .= ' cth-cover-color';
	?>
	<section <?php
	    echo isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : ""; ?> <?php
	    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?><?php echo !empty($cth_parallax_bg) ? ' data-scrollax-parent="true"' : '' ;?> style="background: <?php echo $cth_cover_color; ?>">
	    
		<?php if(!empty($cth_parallax_bg)) :?>
		    <?php 
		    $bgcls = 'cth-bg '; 
		    $bgcls .= $cth_parallax_pos.'-dec-bg';
		    if(!empty($cth_parallax_val)){
		        $bgcls .= ' cth-para-bg';
		    }?>
		    <div class="<?php echo esc_attr($bgcls );?>" data-cthbg="<?php echo esc_url(easybook_addons_get_attachment_thumb_link($cth_parallax_bg, 'full') );?>"
			    <?php if(!empty($cth_parallax_val)): ?>
			     data-scrollax="properties:{<?php echo esc_attr($cth_parallax_val );?>}" style="background: url(<?php echo wp_get_attachment_url( $cth_parallax_bg ); ?>) repeat; <?php if(!empty($cth_cover_color)) echo 'opacity: '.$cth_overlay_color; ?>"
			    <?php endif; ?>
		    ></div>
		<?php endif; ?>

	    <?php if($cth_overlay_color != '' && $cth_parallax_bg != '' && $cth_cover_color == '') : ?>
	    <div class="cth-overlay" style="opacity: <?php echo esc_attr($cth_overlay_color );?>;"></div>
	    <?php endif;?>
		
		<div class="cth-sec-container container <?php echo esc_attr( $cth_sec_width ); ?>">
	        <div class="row cth-sec-row">
	            <?php echo wpb_js_remove_wpautop($content); ?>
	        </div>
	    </div>

		<?php if($decor_bot_bg != '') : 
			$img_bt = wp_get_attachment_url( $decor_bot_bg );
		?>
		    <div class="banner-bottom-shap-img-wrapper" style="background: url(<?php echo $img_bt; ?>);">
		        <!-- <?php echo wp_get_attachment_image( $decor_bot_bg, 'full'); ?> -->
		    </div>
		<?php endif; ?>
	</section>
<?php }else{ 

	wp_enqueue_script( 'wpb_composer_front_js' );

	$el_class = $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );

	$css_classes = array(
		'vc_row',
		'wpb_row',
		//deprecated
		'vc_row-fluid',
		$el_class,
		vc_shortcode_custom_css_class( $css ),
	);

	if ( 'yes' === $disable_element ) {
		if ( vc_is_page_editable() ) {
			$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
		} else {
			return '';
		}
	}

	if ( vc_shortcode_custom_css_has_property( $css, array(
			'border',
			'background',
		) ) || $video_bg || $parallax
	) {
		$css_classes[] = 'vc_row-has-fill';
	}

	if ( ! empty( $atts['gap'] ) ) {
		$css_classes[] = 'vc_column-gap-' . $atts['gap'];
	}

	$wrapper_attributes = array();
	// build attributes for wrapper
	if ( ! empty( $el_id ) ) {
		$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
	}
	if ( ! empty( $full_width ) ) {
		$wrapper_attributes[] = 'data-vc-full-width="true"';
		$wrapper_attributes[] = 'data-vc-full-width-init="false"';
		if ( 'stretch_row_content' === $full_width ) {
			$wrapper_attributes[] = 'data-vc-stretch-content="true"';
		} elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
			$wrapper_attributes[] = 'data-vc-stretch-content="true"';
			$css_classes[] = 'vc_row-no-padding';
		}
		$after_output .= '<div class="vc_row-full-width vc_clearfix"></div>';
	}

	if ( ! empty( $full_height ) ) {
		$css_classes[] = 'vc_row-o-full-height';
		if ( ! empty( $columns_placement ) ) {
			$flex_row = true;
			$css_classes[] = 'vc_row-o-columns-' . $columns_placement;
			if ( 'stretch' === $columns_placement ) {
				$css_classes[] = 'vc_row-o-equal-height';
			}
		}
	}

	if ( ! empty( $equal_height ) ) {
		$flex_row = true;
		$css_classes[] = 'vc_row-o-equal-height';
	}

	if ( ! empty( $content_placement ) ) {
		$flex_row = true;
		$css_classes[] = 'vc_row-o-content-' . $content_placement;
	}

	if ( ! empty( $flex_row ) ) {
		$css_classes[] = 'vc_row-flex';
	}

	$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

	$parallax_speed = $parallax_speed_bg;
	if ( $has_video_bg ) {
		$parallax = $video_bg_parallax;
		$parallax_speed = $parallax_speed_video;
		$parallax_image = $video_bg_url;
		$css_classes[] = 'vc_video-bg-container';
		wp_enqueue_script( 'vc_youtube_iframe_api_js' );
	}

	if ( ! empty( $parallax ) ) {
		wp_enqueue_script( 'vc_jquery_skrollr_js' );
		$wrapper_attributes[] = 'data-vc-parallax="' . esc_attr( $parallax_speed ) . '"'; // parallax speed
		$css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
		if ( false !== strpos( $parallax, 'fade' ) ) {
			$css_classes[] = 'js-vc_parallax-o-fade';
			$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
		} elseif ( false !== strpos( $parallax, 'fixed' ) ) {
			$css_classes[] = 'js-vc_parallax-o-fixed';
		}
	}

	if ( ! empty( $parallax_image ) ) {
		if ( $has_video_bg ) {
			$parallax_image_src = $parallax_image;
		} else {
			$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
			$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
			if ( ! empty( $parallax_image_src[0] ) ) {
				$parallax_image_src = $parallax_image_src[0];
			}
		}
		$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
	}
	if ( ! $parallax && $has_video_bg ) {
		$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
	}
	$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

	$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
	$output .= wpb_js_remove_wpautop( $content );
	$output .= '</div>';
	$output .= $after_output;

	echo $output;


} // end check for cth_layout