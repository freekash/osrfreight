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
$azp_mID = $el_id = $el_class = $f_title = $field_value = $f_name = $f_wid = $f_type = $field_name ='';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
	'azp-element-' . $azp_mID,
    'azp_cus_field_bk',
    $el_class,
);
$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) );  

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}
// $cus_field = json_decode(urldecode($cus_field) , true) ;
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
	<div class="cus-field-title">
		<label class="cus-field-label"><?php echo $f_title;?></label>
	</div>
	<div class="cus-field-contens">
		<?php 
			if($f_name != ''){
				$field_value = get_post_meta( get_the_ID(), ESB_META_PREFIX.$f_name, true );
				// var_dump($field_value);
				$field_name = $f_name;
			};
			switch($f_type){
			 	case 'input':?>
			 		<input type="text" name="<?php echo $field_name;?>" value="<?php echo $field_value;?>">
			 		<?php
			 		break;
			 	case 'textarea':?>
					<textarea name="<?php echo $field_name;?>" defaultValue="<?php echo $field_value;?>"></textarea>
			 		<?php
			 		break;
			 	case 'select':
			 		if(is_array($field_value) && $field_value != ''){
			 		?>
						<select name="<?php echo $field_name;?>">
							<?php foreach ($field_value as $value) {?>
								<option value="<?php echo $value?>"><?php echo $value?></option>
							<?php } ?>
						</select>
			 		<?php
			 		}	
			 		break;
			 	default:
			 		break;
			}; 
		?>
	</div>
</div>