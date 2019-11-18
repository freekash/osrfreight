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



function easybook_addons_scheduleExpireEvent($id,$ts){
	if (wp_next_scheduled('listingExpireAction',array($id)) !== false) {
		wp_clear_scheduled_hook('listingExpireAction',array($id)); //Remove any existing hooks
		if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "ID: $id -> found - unscheduled" . PHP_EOL, 3, ESB_LOG_FILE);
	}
	wp_schedule_single_event($ts,'listingExpireAction',array($id));

	if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "ID: $id -> scheduled at ".date_i18n('r',$ts)." "."(".$ts.")" . PHP_EOL, 3, ESB_LOG_FILE);
}

function easybook_addons_unscheduleExpireEvent($id) {
	// Delete Scheduled Expiration
	if (wp_next_scheduled('listingExpireAction',array($id)) !== false) {
		wp_clear_scheduled_hook('listingExpireAction',array($id)); //Remove any existing hooks
		if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "ID: $id -> found - unscheduled" . PHP_EOL, 3, ESB_LOG_FILE);
	}
}
function listingExpireActionCallback($id){
	if (empty($id)) {
		if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "No listing ID found - exiting" . PHP_EOL, 3, ESB_LOG_FILE);
		return false;
	}

	if (is_null(get_post($id))) {
		if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "ID: $id -> Post does not exist - exiting" . PHP_EOL, 3, ESB_LOG_FILE);
		return false;
	}

	// Remove KSES - wp_cron runs as an unauthenticated user, which will by default trigger kses filtering,
	// even if the post was published by a admin user.  It is fairly safe here to remove the filter call since
	// we are only changing the post status/meta information and not touching the content.
	// kses_remove_filters();

	if (wp_update_post(array('ID' => $id, 'post_status' => 'pending')) == 0) {
		if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "ID: $id -> Failed save post to draft" . PHP_EOL, 3, ESB_LOG_FILE);
	}else{
        update_post_meta( $id, ESB_META_PREFIX.'expired', '1' );
        // push notification
        $author_id = get_post_field ('post_author', $id);
        easybook_addons_add_user_notification($author_id, array(
            'type' => 'listing_expired',
            'entity_id'     => $id
        ));
    }
    
    
}
add_action( 'listingExpireAction', 'listingExpireActionCallback' );
