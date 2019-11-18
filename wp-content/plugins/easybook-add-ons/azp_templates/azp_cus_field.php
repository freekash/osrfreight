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
$azp_mID = $el_id = $el_class = $f_title = $cus_field = $f_class = $fiels_class = $f_wid = $f_type = '';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
	'azp-element-' . $azp_mID,
    'azp_cus_field',
    'list-single-main-items fl-wrap',
    $el_class,
);
$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) );  

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}

// if( easybook_addons_is_hide_on_plans('logout_user') ) === 'true' ) return;

$cus_field = json_decode(urldecode($cus_field) , true) ;
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
	<div class="cus-field-header list-single-main-item-title fl-wrap">
		<h3><?php echo $field_title;?></h3>
	</div>
	<div class="cus-field-body">
		<div class="cus-fields-wrap">
		<?php 
			foreach ($cus_field as $key => $field) { 
				switch($field['f_type']) {
					case 'gallery':
						$fiels_class = 'cus-field-items' .' '.$field['f_class'].' '. $field['f_wid'];
						break;
					default:
						$fiels_class = 'cus-field-item' .' '. $field['f_class'].' '. $field['f_wid'];
						break;
				}
				// cus-field-item

				$field_name = get_post_meta( get_the_ID(), ESB_META_PREFIX.$field['f_name'], true );
				// var_dump($field_name);
				if(is_array($field_name) && !empty($field_name)){?>
					<div class="<?php echo $fiels_class;?>">
						<div class="cus-field-title">
							<?php echo $field['f_title']; ?>
						</div>
						<div class="cus-field-content">
						<?php 
							switch($field['f_type']){
								case 'gallery':
									?>
										<div class="gallery-items big-pad">
											<div class="grid-sizer"></div>
										<?php
											foreach ($field_name as $image) {?>
												<div class="gallery-item item">
													<?php echo wp_get_attachment_image($image,'featured', false, array('class'=>'respimg'));?>
												</div>
										<?php } ?>
										</div>
									<?php 
									break;
								case 'image':
									foreach ($field_name as $image) {
									?>
										<div class="image-item">
											<?php echo wp_get_attachment_image($image,'featured', false, array('class'=>'respimg'));?>
										</div>
									<?php
										}
									break;
								case 'list':?>
									<ul>
										<?php
											foreach ($field_name as $key => $value) {
											echo '<li>'.$value.'</li>';
											}; 
										?>
									</ul>
									<?php
									break;
								default:
									foreach ($field_name as $value) {
											echo'<div class="cus-field-cont-item">'.$value.'</div>';
									}
									break;
							};
						?>
						</div>
					</div>
			<?php	
				}elseif(!empty($field_name)){?>
					<div class="<?php echo $fiels_class;?>">
						<div class="cus-field-title">
							<?php echo $field['f_title']; ?>
						</div>
						<div class="cus-field-content">
							<?php echo $field_name;?>
						</div>
					</div>
			<?php 	
				}		
			}
		?>
		</div>
	</div>
</div>