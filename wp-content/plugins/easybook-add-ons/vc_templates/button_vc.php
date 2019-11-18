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


$css = $el_class = $name_bt = $links = $icon = $is_external = $bt_color = $btn_s = $buttons = $btn_style = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'btn float-btn',
    'color'.$bt_color.'-bg',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
$href = vc_build_link( $links );
// $url = $href['url'];
$url = ($href['url'] != '') ? $href['url'] : '#';
$target = ($is_external == 'yes') ? 'target="_blank"' : '';
$buttons = vc_param_group_parse_atts($atts['buttons']);
?>

<?php if($btn_s != 'yes') { ?>
	<?php if($btn_style == 'btn_style_1') { ?>
		<a href="<?php echo $url; ?>" <?php echo $target; ?> class="<?php echo esc_attr($css_class );?>">
		    <?php echo $name_bt; ?><i class="<?php echo $icon;?>"></i>
		</a>
	<?php }elseif($btn_style == 'btn_style_2') { ?>
		<a class="down-btn color3-bg" href="<?php echo $url; ?>" <?php echo $target; ?>><i class="<?php echo $icon; ?>"><?php echo $name_bt; ?></a>
	<?php }else { ?>
		<a class="color-bg-link modal-open" href="<?php echo $url; ?>" <?php echo $target; ?>><?php echo $name_bt; ?></a>
	<?php } ?>
<?php }else{ ?>
	<?php foreach ($buttons as $key => $button) { 
		$href = vc_build_link( $button['links']);
		$url = ($href['url'] != '') ? $href['url'] : '#';
		$target = ($button['is_external'] == 'yes') ? 'target="_blank"' : '';
		?>
		<?php if($btn_style == 'btn_style_1') { ?>
			<a href="<?php echo $url; ?>" <?php echo $target; ?> class="<?php echo esc_attr($css_class );?>">
			    <?php echo $button['name_bt']; ?><i class="<?php echo $button['icon'];?>"></i>
			</a>
		<?php }elseif($btn_style == 'btn_style_2') { ?>
			<a class="down-btn color3-bg" href="<?php echo $url; ?>" <?php echo $target; ?>><i class="<?php echo $button['icon']; ?>"></i><?php echo $button['name_bt']; ?></a>
		<?php }else { ?>
			<a class="color-bg-link modal-open" href="<?php echo $url; ?>" <?php echo $target; ?>><?php echo $button['name_bt']; ?></a>
		<?php } ?>
	<?php } ?>
<?php } ?>
