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
    <h3><?php esc_html_e( 'Billing Address', 'easybook-add-ons' ); ?></h3>
</div>
<div class="row">
    <div class="col-sm-6">
        <label><?php esc_html_e( 'First Name ', 'easybook-add-ons' ); ?><i class="far fa-user"></i> </label>
        <div class="ck-validate-field">
            <input type="text" name="billing_first_name" placeholder="<?php esc_attr_e( 'First Name', 'easybook-add-ons' ); ?>" value="<?php echo $user_datas['billing_first_name']?>" required />                                                  
        </div>
    </div>
    <div class="col-sm-6">
        <label><?php esc_html_e( 'Last Name', 'easybook-add-ons' ); ?> <i class="far fa-user"></i> </label>
        <div class="ck-validate-field">
            <input type="text" name="billing_last_name" placeholder="<?php esc_attr_e( 'Last Name', 'easybook-add-ons' ); ?>" value="<?php echo $user_datas['billing_last_name']?>" required />                                                  
        </div>
    </div>
    <div class="col-sm-12">
        <label><?php esc_html_e( 'Company', 'easybook-add-ons' ); ?> <i class="far fa-building"></i> </label>
        <div class="ck-validate-field">
            <input type="text" name="billing_company" placeholder="<?php esc_attr_e( 'Company', 'easybook-add-ons' ); ?>" value="<?php echo $user_datas['billing_company']?>" required />                                                  
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <label><?php esc_html_e( 'City', 'easybook-add-ons' ); ?> <i class="fal fa-globe-asia"></i></label>
        <div class="ck-validate-field">
            <input type="text" name="billing_city" placeholder="<?php esc_attr_e( 'Your city', 'easybook-add-ons' ); ?>" value="<?php echo $user_datas['billing_city']?>" required />                                                  
        </div>
    </div>
    <div class="col-sm-6">
        <label><?php esc_html_e( 'Country', 'easybook-add-ons' ); ?> </label>
        <div class="ck-validate-field">
            <div class="listsearch-input-item ">
                <select data-placeholder="<?php esc_attr_e( 'Your Country', 'easybook-add-ons' ); ?>" name="billing_country" class="chosen-selects no-search-select">
                    <?php 
                    $billing_country = easybook_addons_get_google_contry_codes(); 
                    foreach ($billing_country as $code => $value) { 
                    ?>
                       <option value="<?php echo $code;?>" <?php selected($user_datas['billing_country'], $code); ?>><?php echo $value;?></option>
                   <?php }
                    ?>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <label><?php esc_html_e( 'Address Line 1', 'easybook-add-ons' ); ?><i class="fal fa-road"></i> </label>
        <div class="ck-validate-field">
            <input type="text" name="billing_address_1" placeholder="<?php esc_attr_e( 'Address Line 1', 'easybook-add-ons' ); ?>" value="<?php echo $user_datas['billing_address_1']?>" required/>                                                  
        </div>
    </div>
    <div class="col-sm-6">
        <label><?php esc_html_e( 'Address Line 2 ', 'easybook-add-ons' ); ?><i class="fal fa-road"></i> </label>
        <div class="ck-validate-field">
            <input type="text" name="billing_address_2" placeholder="<?php esc_attr_e( 'Address Line 2', 'easybook-add-ons' ); ?>" value="<?php echo $user_datas['billing_address_2']?>" />                                                  
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-8">
        <label><?php esc_html_e( 'State / County', 'easybook-add-ons' ); ?><i class="fal fa-street-view"></i></label>
        <div class="ck-validate-field">
            <input type="text" name="billing_state" placeholder="<?php esc_attr_e( 'Your State', 'easybook-add-ons' ); ?>" value="<?php echo $user_datas['billing_state']?>" />                                                  
        </div>
    </div>
    <div class="col-sm-4">
        <label><?php esc_html_e( 'Postcode / ZIP', 'easybook-add-ons' ); ?><i class="fal fa-barcode"></i> </label>
        <div class="ck-validate-field">
            <input type="text" name="billing_postcode" placeholder="<?php esc_attr_e( '123456', 'easybook-add-ons' ); ?>" value="<?php echo $user_datas['billing_postcode']?>" required />
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <label><?php esc_html_e( 'Phone', 'easybook-add-ons' ); ?> <i class="fas fa-phone"></i> </label>
        <div class="ck-validate-field">
            <input type="text" name="billing_phone" placeholder="<?php esc_attr_e( 'Phone', 'easybook-add-ons' ); ?>" value="<?php echo $user_datas['billing_phone']?>" />                                                  
        </div>
    </div>
    <div class="col-sm-6">
        <label><?php esc_html_e( 'Email Address', 'easybook-add-ons' ); ?> <i class="far fa-envelope"></i> </label>
        <div class="ck-validate-field">
            <input type="text" name="billing_email" placeholder="<?php esc_attr_e( 'far fa-envelope', 'easybook-add-ons' ); ?>" value="<?php echo $user_datas['billing_email']?>" required />                                                  
        </div>
    </div>
</div>
<div class="list-single-main-item-title fl-wrap">
    <h3><?php _e( 'Addtional Notes', 'easybook-add-ons' ); ?></h3>
</div>
<div class="ck-validate-field">
    <textarea cols="40" rows="3" placeholder="<?php esc_attr_e( 'Notes', 'easybook-add-ons' ); ?>" name="notes"></textarea>
</div>