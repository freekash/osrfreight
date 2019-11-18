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



//$azp_attrs,$azp_content,$azp_element
$azp_mID = $el_id = $el_class = $hide_widget_on = $show_dates = $dates_to_show = $show_end = '';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_widget_wkhour',
    'azp-element-' . $azp_mID,
    $el_class,
);
// $animation_data = self::buildAnimation($azp_attrs);
// $classes[] = $animation_data['trigger'];
// $classes[] = self::buildTypography($azp_attrs);//will return custom class for the element without dot
// $azplgallerystyle = self::buildStyle($azp_attrs);

$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) ); 

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}


$event_dates = easybook_addons_get_event_dates( get_the_ID() );
if(empty($event_dates)) 
    return ;
$next_date = reset($event_dates);

if(empty($next_date)) 
	return;

$timezone = get_post_meta( get_the_ID(), ESB_META_PREFIX."wkh_tz", true );

if(( $hide_widget_on_check = easybook_addons_is_hide_on_plans($hide_widget_on) ) !== 'true') :
?>
<div class="<?php echo $classes; ?> authplan-hide-<?php echo $hide_widget_on_check;?>" <?php echo $el_id;?>>
    <div class="for-hide-on-author"></div>
	<div class="box-widget-item fl-wrap" id="listing-counter-widget">
	    <div class="box-widget-item-header">
	        <h3><?php esc_html_e( 'Event Will Begin : ', 'easybook-add-ons' ); ?><span class="widget-event-date"><?php echo sprintf( __( 'on <span>%s</span> at <span>%s</span>', 'easybook-add-ons' ), date_i18n( get_option( 'date_format' ), strtotime( $next_date['start_date'] ) ), date_i18n( get_option( 'time_format' ), strtotime( $next_date['start_date'] ) ) ); ?></span></h3>
	    </div>
	    <div class="box-widget countdown-widget gradient-bg" data-countdate="<?php echo easybook_addons_get_gmt_from_date( $next_date['start_date'], $timezone, 'm/d/Y H:i:s' );?>">
	        <div class="countdown fl-wrap clearfix">
	            <div class="countdown-completed">
	                <span><?php _e( 'Event started', 'easybook-add-ons' ); ?></span>
	            </div>
	            <div class="countdown-item">
	                <span class="days rot">00</span>
	                <p><?php esc_html_e( 'days', 'easybook-add-ons' ); ?></p>
	            </div>
	            <div class="countdown-item">
	                <span class="hours rot">00</span>
	                <p><?php esc_html_e( 'hours', 'easybook-add-ons' ); ?></p>
	            </div>
	            <div class="countdown-item no-dec">
	                <span class="minutes rot2">00</span>
	                <p><?php esc_html_e( 'minutes', 'easybook-add-ons' ); ?></p>
	            </div>
	            <div class="countdown-item-seconds">
	                <span class="seconds rot2">00</span>
	            </div>

	        </div>
	        <?php if($show_dates == 'yes' && (int)$dates_to_show > 0): 
	        	$count = 1;
	        	?>
	        	<div class="event-dates-wrap clearfix">
	        		<h5 class="event-dates-title"><?php esc_html_e( 'Event dates:', 'easybook-add-ons' );?></h5>
	        	<?php
	        	
			    foreach ($event_dates as $date) {
		            if($count < $dates_to_show){
		            	echo '<div class="event-dates-item">';
		            		echo sprintf( __( 'Next event: <span>%s</span> at <span>%s</span>', 'easybook-add-ons' ), date_i18n( get_option( 'date_format' ), strtotime( $date['start_date'] ) ), date_i18n( get_option( 'time_format' ), strtotime( $date['start_date'] ) ) );

		            		if($show_end == 'yes'){
		            			echo '<div class="event-dates-item-end">';
		            			echo sprintf( __( 'End: <span>%s</span> at <span>%s</span>', 'easybook-add-ons' ), date_i18n( get_option( 'date_format' ), strtotime( $date['end_date'] ) ), date_i18n( get_option( 'time_format' ), strtotime( $date['end_date'] ) ) );
		            			echo '</div>';
		            		}
		            	echo '</div>';
		            }
		            $count++;
			    }

	        	?>
	        	</div>
	        <?php endif; ?>
	    </div>
	</div>
</div>
<?php endif;
