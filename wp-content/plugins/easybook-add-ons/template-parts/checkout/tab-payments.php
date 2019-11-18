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



?>
<div class="list-single-main-item-title fl-wrap">
    <h3><?php _e( 'Payment method', 'easybook-add-ons' ); ?></h3>
</div>

<div class="payment-methods">
    <div class="payment-methods-wrap">
        <?php 
        $idx = 0;
        foreach (easybook_addons_get_payment_methods() as $method => $data) {
        ?>
        <div class="payment-method-item payment-method-<?php echo $method;?>">
            <label for="payment-<?php echo $method;?>">
                <span class="payment-info"><span class="payment-title"><?php echo $data['title']; ?></span><?php if($data['icon']): ?><img class="payment-icon" src="<?php echo $data['icon'];?>" alt="<?php echo esc_attr( $data['title'] );?>"><?php endif; ?></span>
                <input class="payment-method-radio" type="radio" name="payment-method" id="payment-<?php echo $method;?>" data-btn="<?php echo $data['checkout_text'];?>" value="<?php echo $method;?>" required="required" <?php if($idx == 0) echo ' checked="checked"'; ?>>
                <span class="payment-desc-wrap"><span class="payment-desc"><?php echo $data['desc'];?></span></span>
            </label>
        </div>
        <!-- end <?php echo $method;?> -->
        <?php
        $idx++;
        } ?>
        
    </div>
</div>
<!-- .payment-methods end -->
