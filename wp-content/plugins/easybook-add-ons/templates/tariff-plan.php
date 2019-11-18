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


$user_role = easybook_addons_get_user_role();

if($user_role == 'listing_author' && ($plan_id = get_user_meta( get_current_user_id(), ESB_META_PREFIX.'member_plan', true )) != ''){
    $plan_string = sprintf(__('<span>Tariff Plan: </span> <strong>%1$s</strong>', 'easybook-add-ons'), get_the_title($plan_id));
    $plan_desc = sprintf(__('<p>You are on <a>%1$s</a>. Use link bellow to view details or upgrade.</p><a class="tfp-det-btn color2-bg" href="%2$s">Details</a>', 'easybook-add-ons'), get_the_title($plan_id), get_permalink( easybook_addons_get_option('packages_page') ) );
}else{
    $plan_string = sprintf(__('<span>Your are: </span> <strong>%1$s</strong>', 'easybook-add-ons'), easybook_addons_get_user_role_name());
    $plan_desc = sprintf(__('<p>You are <a>%1$s</a>. Order an membership plan to submit listings.</p><a class="tfp-det-btn color2-bg" href="%2$s">Membership Plans</a>', 'easybook-add-ons'), easybook_addons_get_user_role_name(), get_permalink( easybook_addons_get_option('packages_page') ) );
}



?>
<div class="tfp-btn"><?php echo $plan_string; ?></div>
<div class="tfp-det"><?php echo $plan_desc; ?></div>

