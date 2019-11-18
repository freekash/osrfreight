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


$widget_positions = easybook_addons_get_currency_array();

$currency_positions = array(
    'left'      => __( 'Left ($100)', 'easybook-add-ons' ),
    'right'     => __( 'Right (100$)', 'easybook-add-ons' ),
);

if(!isset($index)) $index = false;
if(!isset($name)) $name = false;


if(!isset($currency)){
    $currency = easybook_addons_get_base_currency();
}elseif( isset($currency['curr']) ){
    if(!empty($currency['curr'])) $currency['currency'] = $currency['curr'];
    if(!empty($currency['number_decimal'])) $currency['decimal'] = $currency['number_decimal'];
    if(!empty($currency['decimal_separator'])) $currency['dec_sep'] = $currency['decimal_separator'];
    if(!empty($currency['thousand_separator'])) $currency['ths_sep'] = $currency['thousand_separator'];
    if(!empty($currency['position'])) $currency['sb_pos'] = $currency['position'];
}
if(!isset($base)) $base = easybook_addons_get_option('currency', 'USD');

$index_text = ($index === false)? '{{data.index}}':$index;
$name_text = ($name == false)? '{{data.field_name}}':$name;
?>
<div class="entry">
    <div class="widget-infos">
        <select class="col-first currency-cur curr-col-code" name="<?php echo $name_text; ?>[<?php echo $index_text;?>][currency]" required>
            
            <?php
            foreach ($widget_positions as $pos => $lbl) {
                echo '<option value="'.$pos.'" '.selected( (isset($currency['currency'])? $currency['currency'] : ''), $pos, false ).'>'.$lbl.'</option>';
            }
            ?>
        </select>

        <input class="curr-col-symbol" type="text" name="<?php echo $name_text; ?>[<?php echo $index_text;?>][symbol]" placeholder="<?php esc_attr_e( 'Symbol',  'easybook-add-ons' );?>" value="<?php echo isset($currency['symbol'])? $currency['symbol'] : '';?>" required>

        <input class="curr-col-rate curr-rate-input" type="text" name="<?php echo $name_text; ?>[<?php echo $index_text;?>][rate]" placeholder="<?php esc_attr_e( 'Rate',  'easybook-add-ons' );?>" value="<?php echo isset($currency['rate'])? $currency['rate'] : '';?>" required>
        
        <button class="btn btn-rate get-curr-rate curr-col-get-rate" type="button" data-base="<?php echo $base; ?>" data-cur="<?php echo $currency['currency'];?>">
            <span class=""><?php esc_html_e( 'currencyconverterapi.com', 'easybook-add-ons' ) ?></span>
            <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
        </button>
            
        <select class="curr-col-spos"  name="<?php echo $name_text; ?>[<?php echo $index_text;?>][sb_pos]" required>
            <?php
            foreach ($currency_positions as $pos => $lbl) {
                echo '<option value="'.$pos.'" '.selected( (isset($currency['sb_pos'])? $currency['sb_pos'] : ''), $pos, false ).'>'.$lbl.'</option>';
            }
            ?>
        </select>

        <input class="curr-col-nod" type="text" name="<?php echo $name_text; ?>[<?php echo $index_text;?>][decimal]" placeholder="<?php esc_attr_e( 'Number decimal',  'easybook-add-ons' );?>" value="<?php echo isset($currency['decimal'])? $currency['decimal'] : '';?>" required>

        <input class="curr-col-tsep" type="text" name="<?php echo $name_text; ?>[<?php echo $index_text;?>][ths_sep]" placeholder="<?php esc_attr_e( 'Thousand separator',  'easybook-add-ons' );?>" value="<?php echo isset($currency['ths_sep'])? $currency['ths_sep'] : '';?>" required>

        <input class="curr-col-dsep" type="text" name="<?php echo $name_text; ?>[<?php echo $index_text;?>][dec_sep]" placeholder="<?php esc_attr_e( 'Decimal separator',  'easybook-add-ons' );?>" value="<?php echo isset($currency['dec_sep'])? $currency['dec_sep'] : '';?>" required>
        <button class="btn rmwidget" type="button" data-min="1"><span class="dashicons dashicons-trash"></span></button>
    </div> 
</div>
<!-- end entry -->
