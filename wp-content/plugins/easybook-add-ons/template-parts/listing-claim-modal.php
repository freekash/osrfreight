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
<div class="ctb-modal-wrap ctb-modal" id="ctb-listing-claim-modal">
    <div class="ctb-modal-holder">
        <div class="ctb-modal-inner">
            <div class="ctb-modal-close"><i class="fa fa-times"></i></div>
            <h3><?php echo sprintf( __( 'Claim listing: <span class="lauthor-msg-title">%s</span>', 'easybook-add-ons' ), get_the_title() );?></h3>
            <div class="ctb-modal-content">
                <?php do_action( 'easybook-addons-claim-form-before' ); ?>
                <form class="listing-claim-form custom-form" action="#" method="POST">
                    <fieldset>
                        <?php do_action( 'easybook-addons-claim-form' ); ?>
                        <textarea name="claim_message" cols="40" rows="3" placeholder="<?php esc_attr_e( 'Additional information here.', 'easybook-add-ons' ); ?>" required="required"></textarea>
                    </fieldset>
                    <input type="hidden" name="listing_id" value="<?php echo get_the_ID(); ?>" required="required">
                    <button class="btn flat-btn color-bg" type="submit" id="lclaim-submit"><?php _e( 'Submit', 'easybook-add-ons' ); ?><i class="fal fa-paper-plane i-for-default" aria-hidden="true"></i><i class="fa fa-spinner fa-pulse i-for-loading" aria-hidden="true"></i></button>

                    <?php $nonce = wp_create_nonce('claim_listing'); ?>
                    <input type="hidden" name="_wpnonce" value="<?php echo $nonce;?>">
                </form>
                <?php do_action( 'easybook-addons-claim-form-after' ); ?>
            </div>
            <!-- end modal-content -->
        </div>
    </div>
</div>
<!-- end modal --> 