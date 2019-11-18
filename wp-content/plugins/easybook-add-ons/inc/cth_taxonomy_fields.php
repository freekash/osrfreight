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



if(!function_exists('easybook_select_media_file_field')){
 	function easybook_select_media_file_field($f_id = 'cat_header_image',$f_title = 'Header Background Image', $term_values = array(),$new_screen = true){
 		if($new_screen){
 			echo '<div class="form-field">';
 				echo '<label for="term_meta['.$f_id.']">'.$f_title.'</label>';
 		}else{
 			echo '<tr class="form-field">';
			    echo '<th scope="row" valign="top"><label for="term_meta['.$f_id.']">'.$f_title.'</label></th>';
			    echo '<td>';
 		}
 		
	        	echo '<img id="term_meta['.$f_id.'][preview]" src="'.(isset($term_values[$f_id]['url']) ? esc_attr($term_values[$f_id]['url']) : '').'" alt="" '.(isset($term_values[$f_id]['url']) ? ' style="display:block;width:200px;height=auto;"' : ' style="display:none;width:200px;height=auto;"').'>';
	            echo '<input type="hidden" name="term_meta['.$f_id.'][url]" id="term_meta['.$f_id.'][url]" value="'.(isset($term_values[$f_id]['url']) ? esc_attr($term_values[$f_id]['url']) : '').'">';
	            echo '<input type="hidden" name="term_meta['.$f_id.'][id]" id="term_meta['.$f_id.'][id]" value="'.(isset($term_values[$f_id]['id']) ? esc_attr($term_values[$f_id]['id']) : '').'">';
	            
	            echo '<p class="description"><a href="#" data-uploader_title="'.$f_title.'" class="button button-primary upload_image_button metakey-term_meta fieldkey-'.$f_id.'">'.esc_html__('Upload Image', 'easybook-add-ons').'</a>  <a href="#" class="button button-secondary remove_image_button metakey-term_meta fieldkey-'.$f_id.'">'.esc_html__('Remove', 'easybook-add-ons').'</a></p>';
	    if($new_screen){
 			echo '</div>';
 				
 		}else{
 				echo '</td>';
	    	echo '</tr>';
 		}

 	}
}

if(!function_exists('easybook_radio_options_field')){
	/**
	* field_options : array('id','name','desc','values','default')
	*
	*/
 	function easybook_radio_options_field($field_options, $term_values = array(),$new_screen = true){
 		if(isset($term_values[$field_options['id']]) && $term_values[$field_options['id']] != ''){
 			$checked = $term_values[$field_options['id']];
 		}elseif( isset($field_options['default']) ){
 			$checked = $field_options['default'];
 		}else{
 			$checked = ' No provide default value';
 		}
 		if($new_screen){
 			echo '<div class="form-field">';
 				echo '<label for="term_meta['.$field_options['id'].']">'.$field_options['name'].'</label>';
 		}else{
 			echo '<tr class="form-field">';
			    echo '<th scope="row" valign="top"><label for="term_meta['.$field_options['id'].']">'.$field_options['name'].'</label></th>';
			    echo '<td>';
 		}
 		
		        if(!empty($field_options['values'])){
		        	foreach ($field_options['values'] as $val => $opt) {
		        		echo '<input type="radio" name="term_meta['.$field_options['id'].']" id="term_meta['.$field_options['id'].']" value="'.$val.'" '.checked( $checked, $val,false).'>'.$opt.'&nbsp;&nbsp;';
		        	}
		        }
		        if(isset($field_options['desc'])){
		        	echo '<p class="description">'.$field_options['desc'].'</p>';
		        }
		if($new_screen){
 			echo '</div>';
 				
 		}else{
 				echo '</td>';
	    	echo '</tr>';
 		}
	            
	        

 	}
}

function easybook_addons_select_options_field($field_options, $term_values = array(),$new_screen = true){
		if(isset($term_values[$field_options['id']]) && $term_values[$field_options['id']] != ''){
			$selected = $term_values[$field_options['id']];
		}elseif( isset($field_options['default']) ){
			$selected = $field_options['default'];
		}else{
			$selected = '';
		}
		if($new_screen){
			echo '<div class="form-field">';
				echo '<label for="term_meta['.$field_options['id'].']">'.$field_options['name'].'</label>';
		}else{
			echo '<tr class="form-field">';
		    echo '<th scope="row" valign="top"><label for="term_meta['.$field_options['id'].']">'.$field_options['name'].'</label></th>';
		    echo '<td>';
		}
			echo '<select name="term_meta['.$field_options['id'].']" id="term_meta['.$field_options['id'].']">';
	        if(!empty($field_options['values'])){
	        	foreach ($field_options['values'] as $val => $opt) {
	        		echo '<option value="'.$val.'" '.selected( $selected, $val,false).'>'.$opt.'</option>';
	        		// echo '<input type="radio" name="term_meta['.$field_options['id'].']" id="term_meta['.$field_options['id'].']" value="'.$val.'" '.checked( $checked, $val,false).'>'.$opt.'&nbsp;&nbsp;';
	        	}
	        }
	        echo '</select>';
	        if(isset($field_options['desc'])){
	        	echo '<p class="description">'.$field_options['desc'].'</p>';
	        }
	if($new_screen){
			echo '</div>';
				
		}else{
				echo '</td>';
    	echo '</tr>';
		}
            
        

}

function easybook_addons_select2_options_field($field_options, $term_values = array(),$new_screen = true){
		if(isset($term_values[$field_options['id']]) && $term_values[$field_options['id']] != ''){
			$selected = $term_values[$field_options['id']];
		}elseif( isset($field_options['default']) ){
			$selected = $field_options['default'];
		}else{
			$selected = '';
		}
		if($new_screen){
			echo '<div class="form-field">';
				echo '<label for="term_meta['.$field_options['id'].'][]">'.$field_options['name'].'</label>';
		}else{
			echo '<tr class="form-field">';
		    echo '<th scope="row" valign="top"><label for="term_meta['.$field_options['id'].'][]">'.$field_options['name'].'</label></th>';
		    echo '<td>';
		}

			echo '<input type="hidden" name="term_meta['.$field_options['id'].']" value="">';// for delete all option

			echo '<select name="term_meta['.$field_options['id'].'][]" id="term_meta['.$field_options['id'].'][]" class="js-example-basic-multiple" multiple="multiple">';
	        if(!empty($field_options['values'])){
	        	foreach ($field_options['values'] as $val => $opt) {
	        		
	        		if (in_array($val, (array)$selected)){
						echo '<option value="'.$val.'" selected>' . $opt . '</option>';
					}else{
						echo '<option value="'.$val.'">' . $opt . '</option>';
					}

	        	}
	        }
	        echo '</select>';
	        if(isset($field_options['desc'])){
	        	echo '<p class="description">'.$field_options['desc'].'</p>';
	        }
	if($new_screen){
			echo '</div>';
				
		}else{
				echo '</td>';
    	echo '</tr>';
		}
            
        

}

function easybook_addons_text_options_field($field_options, $term_values = array(),$new_screen = true){
		if(isset($term_values[$field_options['id']]) && $term_values[$field_options['id']] != ''){
			$value = $term_values[$field_options['id']];
		}elseif( isset($field_options['default']) ){
			$value = $field_options['default'];
		}else{
			$value = '';
		}
		if($new_screen){
			echo '<div class="form-field">';
				echo '<label for="term_meta['.$field_options['id'].']">'.$field_options['name'].'</label>';
		}else{
			echo '<tr class="form-field">';
		    echo '<th scope="row" valign="top"><label for="term_meta['.$field_options['id'].']">'.$field_options['name'].'</label></th>';
		    echo '<td>';
		}
			echo '<input type="text" name="term_meta['.$field_options['id'].']" id="term_meta['.$field_options['id'].']" value="'.$value.'">';

	        if(isset($field_options['desc'])){
	        	echo '<p class="description">'.$field_options['desc'].'</p>';
	        }
	if($new_screen){
			echo '</div>';
				
		}else{
				echo '</td>';
    	echo '</tr>';
		}
            
        

}

if(!function_exists('easybook_repeat_fields_options_field')){
	function easybook_repeat_fields_options_field($field_options, $term_values = array(),$new_screen = true) { 
	    // cth_create_opening_tag_new($value);
	    // global $gather_stripe_options, $global_opt_name ;

	    //$repeat_vs = get_option($value['id']);

	    // echo '<pre>';
	    // var_dump( $term_values[$field_options['id']] );

	    if($new_screen){
 			echo '<div class="form-field">';
 				echo '<label for="term_meta['.$field_options['id'].']">'.$field_options['name'].'</label>';
 		}else{
 			echo '<tr class="form-field">';
			    echo '<th scope="row" valign="top"><label for="term_meta['.$field_options['id'].']">'.$field_options['name'].'</label></th>';
			    echo '<td>';
 		}
 		
		        // if(!empty($field_options['values'])){
		        // 	foreach ($field_options['values'] as $val => $opt) {
		        // 		echo '<input type="radio" name="term_meta['.$field_options['id'].']" id="term_meta['.$field_options['id'].']" value="'.$val.'" '.checked( $checked, $val,false).'>'.$opt.'&nbsp;&nbsp;';
		        // 	}
		        // }
		        // if(isset($field_options['desc'])){
		        // 	echo '<p class="description">'.$field_options['desc'].'</p>';
		        // }

			// if(isset($term_values[$field_options['id']]) && $term_values[$field_options['id']] != ''){


 				echo '<table class="repeatfield_table">
		    		<thead><tr>
		    			<th>Field Type</th>
		    			<th>Field Name</th>
		    			<th>Field Label</th>
		    			<th class="field_values_col">Field Values</th>

		    		</tr></thead>';
		    		echo '<input type="hidden" name="term_meta['.$field_options['id'].']" value="">';// for delete all option
		    		echo 	'<tbody><tr data-key="0" class="hide"></tr>';
		    			
		    	if( isset($term_values[$field_options['id']]) && !empty( $term_values[$field_options['id']] ) ){
		    		$key  = 1;
		    		foreach ( $term_values[$field_options['id']] as  $val) {
		    	// if($repeat_vs && !empty($repeat_vs)){
		    	// 	foreach ($repeat_vs as $key => $val) {
		    			echo '<tr data-key="'.$key.'">';
		    			if(isset($val['type'])){
		    				echo '<td><select name="term_meta['.$field_options['id'].']'.'['.$key.'][type]" class="select_field_type" data-name="term_meta['.$field_options['id'].']'.'['.$key.']" data-type="'.$val['type'].'"';
		    
		    				echo '>';

										echo '<option value="text"'.(($val['type'] == 'text')? ' selected="selected"' : '').'>Text Field</option>
										<option value="select"'.(($val['type'] == 'select')? ' selected="selected"' : '').'>Select Field</option>
										<option value="checkbox"'.(($val['type'] == 'checkbox')? ' selected="selected"' : '').'>Checkbox Field</option>
										<option value="radio"'.(($val['type'] == 'radio')? ' selected="selected"' : '').'>Radio Field</option>
										<option value="switch"'.(($val['type'] == 'switch')? ' selected="selected"' : '').'>Switch Field</option>
										<option value="textarea"'.(($val['type'] == 'textarea')? ' selected="selected"' : '').'>Textarea Field</option>';
							echo '</select></td>';
		    			}
		    			if(isset($val['name'])){
		    				echo '<td><input type="text" name="term_meta['.$field_options['id'].']'.'['.$key.'][name]" value="'.$val['name'].'" placeholder="Field Name"></td>';
		    			}
		    			if(isset($val['label'])){
		    				echo '<td><input type="text" name="term_meta['.$field_options['id'].']'.'['.$key.'][label]" value="'.$val['label'].'" placeholder="Field Label"></td>';
		    			}
		    			// if(isset($val['value'])){echo'<pre>val value';var_dump($val['value']);
		    				if(isset($val['type']) && ($val['type'] == 'select'||$val['type'] == 'radio')){
		    					echo '<td  class="field_values_col field_select_ops">';
		    						echo '<table><tr data-key="0" class="hide"></tr>';

			    					if(!empty($val['value'])){
			    						foreach ((array)$val['value'] as $op_in => $sl_ops) {
			    							echo '<tr data-key="'.$op_in.'">';
							    			if(isset($sl_ops['name'])){
							    				echo '<td><input type="text" name="term_meta['.$field_options['id'].']'.'['.$key.'][value]['.$op_in.'][name]" value="'.$sl_ops['name'].'" placeholder="Option Name"></td>';
							    			}
							    			if(isset($sl_ops['value'])){
							    				echo '<td><input type="text" name="term_meta['.$field_options['id'].']'.'['.$key.'][value]['.$op_in.'][value]" value="'.$sl_ops['value'].'" placeholder="Option Value"></td>';
							    			}
							    			echo '<td><a href="#" class="repeatable_fields_select_remove_option"><span class="dashicons dashicons-minus"></span></a></td></tr>';
			    						}
			    					
			    					}
			    
			    					echo '<tr><td><a href="#" class="repeatable_fields_select_add_option" data-name="term_meta['.$field_options['id'].']'.'['.$key.'][value]"><span class="dashicons dashicons-plus"></span></a><td><td></td></tr>';
			    					echo '</table>';

		    					echo '</td>';
		    				}else{
		    					echo '<td  class="field_values_col"><input type="text" name="term_meta['.$field_options['id'].']'.'['.$key.'][value]" value="'.$val['value'].'"  placeholder="Field Value"></td>';
		    				}
		    				
		    			// }
		    			if(isset($field_options['required']) && $field_options['required'] ){
		    				$checked = '';
		    				if(isset($val['required'])&&$val['required'] === 'true'){
						    	$checked = ' checked="checked" ';
						    }
		    				echo '<td><input type="checkbox" name="term_meta['.$field_options['id'].']'.'['.$key.'][required]" value="true" '.$checked.'/>Required Field?</td>';
		    			}
		    			echo '<td><a href="#" class="repeatable_fields_remove_field"><span class="dashicons dashicons-trash"></span></a></td></tr>';

		    			// <span class="dashicons dashicons-trash"></span>

		    			$key++;
		    		}
		    	}

		    	echo '</tbody>';

		    	echo '<tfoot><tr><td><a href="#" class="repeatable_fields_add_field" data-name="term_meta['.$field_options['id'].']'.'">Add Field</a><td><td></td></tr></tfoot>';
		    		
		    	echo '</table>';


		if($new_screen){
 			echo '</div>';
 				
 		}else{
 				echo '</td>';
	    	echo '</tr>';
 		}



	    
		    	
	    // cth_create_closing_tag_new($value);
	}
}


function easybook_features_select_new_field($field_options, $term_values = array(),$new_screen = true){
 		// if(isset($term_values[$field_options['id']]) && $term_values[$field_options['id']] != ''){
 		// 	$checked = $term_values[$field_options['id']];
 		// }elseif( isset($field_options['default']) ){
 		// 	$checked = $field_options['default'];
 		// }else{
 		// 	$checked = ' No provide default value';
 		// }

		$features = get_terms( array(
			// 'orderby'    => 'count',
		    'taxonomy' => 'listing_feature',
		    'hide_empty' => false,
		) );

		// var_dump($term_values);


		$selected = isset($term_values[$field_options['id']])? $term_values[$field_options['id']] : array() ;


 		if($new_screen){
 			echo '<div class="form-field">';
 				echo '<label for="term_meta['.$field_options['id'].'][]">'.$field_options['name'].'</label>';
 		}else{
 			echo '<tr class="form-field">';
			    echo '<th scope="row" valign="top"><label for="term_meta['.$field_options['id'].'][]">'.$field_options['name'].'</label></th>';
			    echo '<td>';
 		}
 			echo '<input type="hidden" name="term_meta['.$field_options['id'].']" value="">';// for delete all option
 				
 			if ( ! empty( $features ) && ! is_wp_error( $features ) ){

 				$feature_group = array();
                foreach( $features as $key => $term){
                    if(easybook_addons_get_option('feature_parent_group') == 'yes'){
                        if($term->parent){
                            if(!isset($feature_group[$term->parent]) || !is_array($feature_group[$term->parent])) $feature_group[$term->parent] = array();
                            $feature_group[$term->parent][$term->term_id] = $term->name;
                        }else{
                            if(!isset($feature_group[$term->term_id])) $feature_group[$term->term_id] = $term->name;
                        }
                    }else{
                        if(!isset($feature_group[$term->term_id])) $feature_group[$term->term_id] = $term->name;
                    }
                        
                }



	        	echo '<div class="lcat-features-wrap">';
	        	foreach( $feature_group as $tid => $tvalue){
                    if( is_array( $tvalue ) && count( $tvalue ) ){
                        $term = get_term_by( 'id', $tid , 'listing_feature' );
                        // var_dump($term);
                        if($term){

                        	$fea_checked = '';
			        		if (in_array($tid, (array)$selected)) $fea_checked = ' checked="checked"';
			        		echo 	'<div class="lcat-feature-item lcat-feature-item-has-children">
			        						
											<label class="lcat-fea-lbl" for="'.$field_options['id'].'_'.$tid.'">
			        							<input type="checkbox" id="'.$field_options['id'].'_'.$tid.'" name="term_meta['.$field_options['id'].']['.$tid.']" value="'.$tid.'"'.$fea_checked.'>' . $term->name . '
			        						</label>

			        					</div>';


                            echo '<div class="lcat-feature-children">';

                            foreach ($tvalue as $id => $name) {
                                $fea_checked = '';
				        		if (in_array($id, (array)$selected)) $fea_checked = ' checked="checked"';
				        		echo 	'<div class="lcat-feature-item">
				        						
												<label class="lcat-fea-lbl" for="'.$field_options['id'].'_'.$id.'">
				        							<input type="checkbox" id="'.$field_options['id'].'_'.$id.'" name="term_meta['.$field_options['id'].']['.$id.']" value="'.$id.'"'.$fea_checked.'>' . $name . '
				        						</label>

				        					</div>';
                            }

                            echo '</div>';
                        }
                        
                    }else{
                    	$fea_checked = '';
		        		if (in_array($tid, (array)$selected)) $fea_checked = ' checked="checked"';
		        		echo 	'<div class="lcat-feature-item">
		        						
										<label class="lcat-fea-lbl" for="'.$field_options['id'].'_'.$tid.'">
		        							<input type="checkbox" id="'.$field_options['id'].'_'.$tid.'" name="term_meta['.$field_options['id'].']['.$tid.']" value="'.$tid.'"'.$fea_checked.'>' . $tvalue . '
		        						</label>

		        					</div>';

                    }
                    
                        
                }



	        // 	foreach ($features as $fea) {
	        // 		$fea_checked = '';
	        // 		if (in_array($fea->term_id, (array)$selected)) $fea_checked = ' checked="checked"';
	        // 		echo 	'<div class="lcat-feature-item">
	        						
									// <label class="lcat-fea-lbl" for="'.$field_options['id'].'_'.$fea->term_id.'">
	        // 							<input type="checkbox" id="'.$field_options['id'].'_'.$fea->term_id.'" name="term_meta['.$field_options['id'].']['.$fea->term_id.']" value="'.$fea->term_id.'"'.$fea_checked.'>' . $fea->name . '
	        // 						</label>

	        // 					</div>';

	        // 	}
	        	echo '</div>';//end content-widgets-wrap

			}else{

			}

	        if(isset($field_options['desc'])){
	        	echo '<p class="description">'.$field_options['desc'].'</p>';
	        }
		if($new_screen){
 			echo '</div>';
 				
 		}else{
 				echo '</td>';
	    	echo '</tr>';
 		}
	            
	        

 	}



if(!function_exists('easybook_features_select_field')){
	/**
	* field_options : array('id','name','desc','values','default')
	*
	*/
 	function easybook_features_select_field($field_options, $term_values = array(),$new_screen = true){
 		// if(isset($term_values[$field_options['id']]) && $term_values[$field_options['id']] != ''){
 		// 	$checked = $term_values[$field_options['id']];
 		// }elseif( isset($field_options['default']) ){
 		// 	$checked = $field_options['default'];
 		// }else{
 		// 	$checked = ' No provide default value';
 		// }

		$features = get_terms( array(
			'orderby'    => 'count',
		    'taxonomy' => 'listing_feature',
		    'hide_empty' => false,
		) );

		// var_dump($term_values);


		$selected = isset($term_values[$field_options['id']])? $term_values[$field_options['id']] : array() ;


 		if($new_screen){
 			echo '<div class="form-field">';
 				echo '<label for="term_meta['.$field_options['id'].'][]">'.$field_options['name'].'</label>';
 		}else{
 			echo '<tr class="form-field">';
			    echo '<th scope="row" valign="top"><label for="term_meta['.$field_options['id'].'][]">'.$field_options['name'].'</label></th>';
			    echo '<td>';
 		}
 			echo '<input type="hidden" name="term_meta['.$field_options['id'].']" value="">';// for delete all option
 				
 			if ( ! empty( $features ) && ! is_wp_error( $features ) ){

 				echo '<select class="js-example-basic-multiple" name="term_meta['.$field_options['id'].'][]" id="term_meta['.$field_options['id'].'][]" multiple="multiple">';
				
				foreach ( $features as $fea ) {
					if (in_array($fea->term_id, (array)$selected)){
						echo '<option value="'.$fea->term_id.'" selected>' . $fea->name . '</option>';
					}else{
						echo '<option value="'.$fea->term_id.'">' . $fea->name . '</option>';
					}
			        
			    }

				echo '</select>';

			}else{

			}

	        if(isset($field_options['desc'])){
	        	echo '<p class="description">'.$field_options['desc'].'</p>';
	        }
		if($new_screen){
 			echo '</div>';
 				
 		}else{
 				echo '</td>';
	    	echo '</tr>';
 		}
	            
	        

 	}
}


if(!function_exists('easybook_addons_content_widgets_order_options_field')){
	/**
	* field_options : array('id','name','desc','values','default')
	*
	*/
 	function easybook_addons_content_widgets_order_options_field($field_options, $term_values = array(),$new_screen = true){
 		// if(isset($term_values[$field_options['id']]) && $term_values[$field_options['id']] != ''){
 		// 	$checked = $term_values[$field_options['id']];
 		// }elseif( isset($field_options['default']) ){
 		// 	$checked = $field_options['default'];
 		// }else{
 		// 	$checked = ' No provide default value';
 		// }
 		$content_widgets_value = isset($term_values[$field_options['id']])? $term_values[$field_options['id']] : array();
 		$content_widgets_hide = isset($term_values[$field_options['id_hide']])? $term_values[$field_options['id_hide']] : array();
 		// var_dump($content_widgets_value);
 		if(isset($field_options['default']) && is_array($field_options['default'])) $content_widgets_value = array_unique( array_merge($content_widgets_value,$field_options['default']) );
 		// var_dump($content_widgets_value);

 		$sidebar_widgets_value = isset($term_values[$field_options['id_2']])? $term_values[$field_options['id_2']] : array();
 		$sidebar_widgets_hide = isset($term_values[$field_options['id_hide_2']])? $term_values[$field_options['id_hide_2']] : array();
 		// var_dump($sidebar_widgets_value);
 		if(isset($field_options['default_2']) && is_array($field_options['default_2'])) $sidebar_widgets_value = array_unique( array_merge($sidebar_widgets_value,$field_options['default_2']) );
 		// var_dump($sidebar_widgets_value);

 		if($new_screen){
 			echo '<div class="form-field">';
 				echo '<label>'.$field_options['name'].'</label>';
 		}else{
 			echo '<tr class="form-field">';
			    echo '<th scope="row" valign="top"><label>'.$field_options['name'].'</label></th>';
			    echo '<td>';
 		}
 				echo'<div class="content-widgets-orders-holder">';
 					// echo'<div class="col-md-8">';
 						if(!empty($content_widgets_value)){
				        	echo '<div class="content-widgets-wrap">';
				        	foreach ($content_widgets_value as $key => $wname) {
				        		if(isset($field_options['values'][$wname])){
				        			$hide_checked = '';
				        			if(isset($content_widgets_hide[$wname]) && $content_widgets_hide[$wname] == 'on' ) $hide_checked = ' checked="checked"';
				        			echo 	'<div class="content-widgets-item">
				        						<span class="wid-icon"><i class="dashicons dashicons-move"></i></span>'.$field_options['values'][$wname].'<span class="wid-icon-after"></span>
				        						<input type="hidden" name="term_meta['.$field_options['id'].'][]" value="'.$wname.'">
												
												<label class="lbl-hide-widget" for="'.$field_options['id_hide'].'_'.$wname.'">'.__( 'Hide this', 'easybook-add-ons' ).'
				        							<input type="checkbox" id="'.$field_options['id_hide'].'_'.$wname.'" name="term_meta['.$field_options['id_hide'].']['.$wname.']" value="on"'.$hide_checked.'>
				        						</label>

				        					</div>';
				        		}
				        	}
				        	echo '</div>';//end content-widgets-wrap

				        }
 					// echo '</div>';
 					// echo'<div class="col-md-4">';
 						if(!empty($sidebar_widgets_value)){
				        	echo '<div class="sidebar-widgets-wrap">';
				        	foreach ($sidebar_widgets_value as $key => $wname) {
				        		if(isset($field_options['values_2'][$wname])){
				        			$hide_checked = '';
				        			if(isset($sidebar_widgets_hide[$wname]) && $sidebar_widgets_hide[$wname] == 'on' ) $hide_checked = ' checked="checked"';
				        			echo 	'<div class="sidebar-widgets-item">
				        						<span class="wid-icon">
				        							<i class="dashicons dashicons-move"></i>
				        						</span>'.$field_options['values_2'][$wname].'<span class="wid-icon-after"></span>
				        						<input type="hidden" name="term_meta['.$field_options['id_2'].'][]" value="'.$wname.'">
				        						<label class="lbl-hide-widget" for="'.$field_options['id_hide_2'].'_'.$wname.'">'.__( 'Hide this', 'easybook-add-ons' ).'
				        							<input type="checkbox" id="'.$field_options['id_hide_2'].'_'.$wname.'" name="term_meta['.$field_options['id_hide_2'].']['.$wname.']" value="on"'.$hide_checked.'>
				        						</label>
	
				        					</div>';
				        		}
				        	}
				        	echo '</div>';//end sidebar-widgets-wrap

				        }
 					// echo '</div>';
 				echo '</div>';

		 				
 		
		        // if(!empty($field_options['values'])){
		        // 	echo '<div class="content-widgets-wrap">';
		        // 	foreach ($field_options['values'] as $wname => $wlbl) {
		        // 		echo '<div class="content-widgets-item"><input type="hidden" name="term_meta['.$field_options['id'].'][]" value="'.$wname.'">'.$wlbl.'</div>';
		        // 		// echo '<input type="radio" name="term_meta['.$field_options['id'].']" id="term_meta['.$field_options['id'].']" value="'.$val.'" '.checked( $checked, $val,false).'>'.$opt.'&nbsp;&nbsp;';
		        // 	}
		        // 	echo '</div>';//end content-widgets-wrap

		        // }
		        if(isset($field_options['desc'])){
		        	echo '<p class="description">'.$field_options['desc'].'</p>';
		        }
		if($new_screen){
 			echo '</div>';
 				
 		}else{
 				echo '</td>';
	    	echo '</tr>';
 		}
	            
	        

 	}
}

if(!function_exists('easybook_addons_icon_select_field')){
	/**
	* field_options : array('id','name','desc','values','default')
	*
	*/
 	function easybook_addons_icon_select_field($field_options, $term_values = array(),$new_screen = true){
 		$icons = easybook_addons_extract_awesome_icon_array();

		$value = isset($term_values[$field_options['id']])? $term_values[$field_options['id']] : (null != $field_options['default']? $field_options['default'] : '');


 		if($new_screen){
 			echo '<div class="form-field">';
 				echo '<label for="term_meta['.$field_options['id'].'][]">'.$field_options['name'].'</label>';
 		}else{
 			echo '<tr class="form-field">';
			    echo '<th scope="row" valign="top"><label for="term_meta['.$field_options['id'].']">'.$field_options['name'].'</label></th>';
			    echo '<td>';
 		}

 			
 				
 			if ( ! empty( $icons ) && ! is_wp_error( $icons ) ){

 			// 	echo '<select class="js-select2-single" name="term_meta['.$field_options['id'].']" id="term_meta['.$field_options['id'].']">';
				
				// foreach ( $icons as $icon => $icname ) {
				// 	echo '<option value="'.$icon.'" '.selected( $selected, $icon, false ).'><span class="icon-select-icon"><i class="'.$icon.'"></i></span> ' . $icname . '</option>';
			 //    }

				// echo '</select>';
 				?>
 				<div class="cth-icons-wrap">
 					<input type="text" name="term_meta[<?php echo $field_options['id'] ?>]" id="term_meta[<?php echo $field_options['id'] ?>]" value="<?php echo $value ?>" placeholder="<?php echo esc_attr_e( 'Type to search', 'easybook-add-ons' );?>">
					<a href="#" class="close-icons"><i class="ti-close"></i></a>
					<div class="cth-icons-hold off_select">
						<?php
							
							$html = array();
							foreach ($icons as $icon => $icname) {
								$html[] = "\t".'<div class="cthicon-select" data-font="'.$icon.'">';
								$html[] = "\t\t".'<i class="'.$icon.'" title="'.$icon.'"></i>';
								$html[] = "\t".'</div>';
							}

							echo implode("\n\t\t\t", $html);
							
						?>
					</div>
					
					<div class="cth-icon-preview"><i class="<?php echo $value; ?> fa-2x"></i></div>
					
				</div><!-- .icons-holder -->
			<?php
			}else{

			}

	        if(isset($field_options['desc'])){
	        	echo '<p class="description">'.$field_options['desc'].'</p>';
	        }
		if($new_screen){
 			echo '</div>';
 				
 		}else{
 				echo '</td>';
	    	echo '</tr>';
 		}
	            
	        

 	}
}

function easybook_addons_extract_awesome_icon_array(){
	$icons = array();
	// $pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"\\\\(.+)";\s+}/';
	$pattern = '/\.(fa-(\w+(-\w+)*)):before/m';


	$subject =  file_get_contents(ESB_ABSPATH.'inc/assets/font-awesome/font-awesome.min.css');
	preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);

	foreach($matches as $match) {
		// var_dump($match);
	    $icons['fas '.$match[1]] = str_replace("fa-", "", $match[1] );
	}

	// .fa,.fab,.fal,.far,.fas

	ksort($icons);  

	return $icons;
}
