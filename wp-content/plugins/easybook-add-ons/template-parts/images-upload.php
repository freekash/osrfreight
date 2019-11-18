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


if(!isset($name)) $name = 'images_upload';
if(!isset($is_single)) $is_single = false;
if(!isset($desc_text)) $desc_text = __( '<i class="fa fa-picture-o"></i> Click here or drop files to upload', 'easybook-add-ons' );
?>
<div class="add-list-media-wrap<?php if($is_single) echo ' single-image-upload';?>">
    <div class="fuzone">
        <div class="fu-text">
            <span><?php echo $desc_text;?></span>
        </div>
        <input type="file" name="<?php echo esc_attr( $name );?>" class="upload"<?php if($is_single==false) echo ' multiple';?>>
        <div class="fu-imgs"></div>
    </div>
</div>
<!-- add-list-media-wrap end -->