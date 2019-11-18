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


$socials = easybook_addons_get_socials_list();
if(!isset($index)) $index = false;
if(!isset($url)) $url = '#';
if(!isset($name)) $name = 'facebook';
?>
<div class="entry">
    <select class="custom-select" name="socials[<?php echo $index === false ? '{{data.index}}':$index;?>][name]" required>
        <?php
        foreach ($socials as $val => $lbl) {
            echo '<option value="'.$val.'" '.selected( $name, $val, false ).'>'.$lbl.'</option>';
        }
        ?>
    </select>
    <input type="text" name="socials[<?php echo $index === false ? '{{data.index}}':$index;?>][url]" placeholder="<?php esc_attr_e( 'Social URL',  'easybook-add-ons' );?>" value="<?php echo $url;?>" required>
    <button class="btn rmfield" type="button" ><i class="fa fa-trash"></i></button>
</div>
<!-- end entry -->

