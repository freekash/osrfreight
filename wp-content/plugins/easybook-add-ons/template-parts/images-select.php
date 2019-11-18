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


// if(!isset($prefix)) $prefix = '_cth_';
if(!isset($name)) $name = 'images';
if(!isset($is_single)) $is_single = false;
if(!isset($datas)) $datas = array();
?>
<div class="list-select-images-wrap select-images-wrap select-images-<?php echo $name;?>">
<?php if($is_single):?>
    <input type="button" data-single data-field="<?php echo $name;?>" value="<?php esc_html_e( 'Select or Upload File', 'easybook-add-ons' );?>" class="button select-images-btn">
    <input type="hidden" name="<?php echo $name;?>" id="<?php echo $name;?>" value="">
    <ul class="select-images-list single-image-select"><?php else : ?>
    <input type="button" data-field="<?php echo $name;?>" value="<?php esc_html_e( 'Select or Upload Files', 'easybook-add-ons' );?>" class="button select-images-btn">
    <input type="hidden" name="<?php echo $name;?>" id="<?php echo $name;?>" value="">
    <ul class="select-images-list"><?php endif;?><?php
    if(!empty($datas)){
        foreach ((array)$datas as $img_id ) {
            easybook_addons_get_template_part( 'templates-inner/image',false,array( 'name'=>$name, 'data'=>array('id'=>$img_id) ) );
        }
    } ?></ul>
</div>