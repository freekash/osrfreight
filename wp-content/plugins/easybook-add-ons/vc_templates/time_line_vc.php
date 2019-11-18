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


$css = $el_class = $first_side = $end_icon = $time_lines = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'time-line-wrap fl-wrap',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
$time_lines = vc_param_group_parse_atts($atts['time_lines']);
// var_dump($time_lines);
?>

<?php
if(is_array($time_lines) && !empty($time_lines) ):
    $first_side = $first_side; 
    ?>
	<div class="<?php echo esc_attr( $css_class ); ?>">
	<?php
		$step_num = 1;
	    foreach ($time_lines as $key => $timeline) {
	        if(($key+1)%2 == 0){
	            $media_cl = $first_side == 'left'? 'tl-left' : 'tl-right';
	            $content_cl = $first_side == 'left'? 'tl-right' : 'tl-left';
	            $container_cl = $first_side == 'left'? 'ct-right' : 'ct-left';

	        }else{
	            $content_cl = $first_side == 'left'? 'tl-left' : 'tl-right';
	            $media_cl = $first_side == 'left'? 'tl-right' : 'tl-left';
	            $container_cl = $first_side == 'left'? 'ct-left' : 'ct-right';
	        }
	?>
	    <!--  time-line-container  --> 
	    <div class="time-line-container <?php echo esc_attr( $container_cl ); ?>">
	        <!-- <?php if($timeline['step']!='') echo '<div class="step-item">'.esc_html($timeline['step']).'</div>'; ?> -->
	        <?php if($step_num > 9) {
	        	$step_num = $step_num; 
	        } else { 
	        	$step_num = '0'.$step_num;
         	}?>
	        <div class="step-item"><?php echo $step_num; ?></div>
	        <div class="time-line-box tl-text <?php echo esc_attr( $content_cl ); ?>">
	            <!-- <?php if($timeline['step_num']!='') echo '<span class="process-count">'.esc_html($timeline['step_num']).'</span>'; ?> -->
	            <span class="process-count"><?php echo $step_num.' . '; ?></span>
	            <?php if($timeline['icon']!=''): ?>
	            <div class="time-line-icon">
	                <i class="<?php echo esc_attr( $timeline['icon'] ); ?>"></i>
	            </div>
	            <?php endif;?>
	            <?php if($timeline['title']!='') echo '<h3>'.esc_html($timeline['title']).'</h3>'; ?>
	            <?php echo $timeline['content']; ?>
	        </div>

	        <?php 
	        if($timeline['image'] != '') : ?>
		        <div class="time-line-box tl-media <?php echo esc_attr( $media_cl ); ?>">
		            <?php echo wp_get_attachment_image( $timeline['image'], 'full' ); ?>
		        </div>
	        <?php elseif ($timeline['link_video'] !='') : 
	        	$href = vc_build_link( $timeline['link_video'] );
	        	$url = $href['url'];
	        ?>
		        <div class="time-line-box tl-media tl-video <?php echo esc_attr( $media_cl ); ?>">
		            <div class="resp-video">
		                <?php echo wp_oembed_get( esc_url($url) ); ?>
		            </div>
		        </div>
	        <?php endif;?>
	    </div>
	    <!--  time-line-container -->         
	    <?php $step_num++; } ?>
	    <div class="clearfix"></div>
	    <?php if($end_icon!=''): ?>
	        <div class="timeline-end"><i class="<?php echo esc_attr( $end_icon ); ?>"></i></div>
	    <?php endif;?>
	    
	</div>
<?php endif; ?>