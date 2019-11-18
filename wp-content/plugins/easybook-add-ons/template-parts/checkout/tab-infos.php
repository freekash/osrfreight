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


$disabled = '';
if( is_user_logged_in() ) $disabled = ' disabled="disabled"';
?>

<div class="list-single-main-item-title fl-wrap">
    <h3><?php esc_html_e( 'Your personal Information', 'easybook-add-ons' ); ?></h3>
</div>
<div class="row">
    <div class="col-sm-6">
        <label><?php esc_html_e( 'First Name ', 'easybook-add-ons' ); ?><i class="far fa-user"></i></label>
        <div class="ck-validate-field">
            <input type="text" placeholder="<?php esc_attr_e( 'Your Name', 'easybook-add-ons' ); ?>" name="first_name" value="<?php echo $user_datas['first_name'];?>" required="required" <?php echo $disabled; ?>/>                                                  
        </div>
    </div>
    <div class="col-sm-6">
        <label><?php esc_html_e( 'Last Name ', 'easybook-add-ons' ); ?><i class="far fa-user"></i></label>
        <div class="ck-validate-field">
            <input type="text" placeholder="<?php esc_attr_e( 'Your Last Name', 'easybook-add-ons' ); ?>" name="last_name" value="<?php echo $user_datas['last_name'];?>" required="required" <?php echo $disabled; ?>/> 
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <label><?php esc_html_e( 'Email Address', 'easybook-add-ons' ); ?><i class="far fa-envelope"></i>  </label>
        <div class="ck-validate-field">
            <input type="text" placeholder="<?php esc_attr_e( 'yourmail@domain.com', 'easybook-add-ons' ); ?>" name="user_email" value="<?php echo $user_datas['email'];?>" required="required" <?php echo $disabled; ?>/>                                                  
        </div>
    </div>
    <div class="col-sm-6">
        <label><?php esc_html_e( 'Phone', 'easybook-add-ons' ); ?><i class="far fa-phone"></i>  </label>
        <div class="ck-validate-field">
            <input type="text" placeholder="<?php esc_attr_e( '87945612233', 'easybook-add-ons' ); ?>" name="phone" value="<?php echo $user_datas['phone'];?>" <?php echo $disabled; ?>/>
        </div>
    </div>
</div>


<?php if( is_user_logged_in() ): ?>
    <a href="<?php echo easybook_addons_dashboard_screen('editProfile'); ?>" class="btn-link go-edit-profile color-text"><?php _e( 'Change profile infos', 'easybook-add-ons' ); ?></a>
<?php else: ?>
    <div class="log-massage"><?php _e( 'Existing Customer? ', 'easybook-add-ons' ); ?><a href="#" class="logreg-modal-open color-text"><?php _e( 'Click here to login', 'easybook-add-ons' ); ?></a></div>
    <?php
    $logreg_form_after = easybook_addons_get_option('logreg_form_after');
    if ( $logreg_form_after != '' ): 
        _e( '<div class="log-separator fl-wrap"><span>or</span></div>', 'easybook-add-ons' );
    ?>
    <div class="soc-log fl-wrap">
        <?php echo do_shortcode( $logreg_form_after ); ?>
    </div>
    <?php 
    endif; ?>
<?php endif; ?>

    
