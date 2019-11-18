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


if(!isset($name)) $name = 'radio_head';
if(!isset($checked)) $checked = 'no';
if(!isset($value)) $value = 'yes';
if(!isset($label)) $label = '';
?>
<div class="add-list-media-header">
    <label class="radio inline"> 
    <input type="radio" name="<?php echo esc_attr( $name );?>" value="<?php echo esc_attr( $value );?>" <?php checked( $checked, $value, true );?>>
    <span><?php echo $label ;?></span> 
    </label>
</div>
<!-- add-list-media-header end -->