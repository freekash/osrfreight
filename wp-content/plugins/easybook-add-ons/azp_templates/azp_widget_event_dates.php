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
$azp_mID = $el_id = $el_class = $dates_to_show = $show_end = $wid_title = '';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_widget_event-dates',
    'azp-element-' . $azp_mID,
    $el_class,
);
$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) ); 

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}


$event_dates = easybook_addons_get_event_dates( get_the_ID() );
if(empty($event_dates)) 
    return ;
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
	<div class="box-widget-item fl-wrap" id="event-dates-widget">
		<?php if($wid_title != ''): ?>
	    <div class="box-widget-item-header">
	        <h3><?php echo $wid_title; ?></h3>
	    </div>
		<?php endif; ?>
	    <div class="box-widget opening-hours widget-event-dates">
	        <div class="box-widget-content">
	            
	            <?php 
	            $count = 1;
	            ?>
	            <ul>
	            <?php
	            foreach ($event_dates as $date) {
	            	if($count < $dates_to_show){
	            		$start_date_str = date_i18n( get_option( 'date_format' ), strtotime( $date['start_date'] ) );
	            		$end_date_str = date_i18n( get_option( 'date_format' ), strtotime( $date['end_date'] ) );

	            		$start_time_str = date_i18n( get_option( 'time_format' ), strtotime( $date['start_date'] ) );
	            		$end_time_str = date_i18n( get_option( 'time_format' ), strtotime( $date['start_date'] ) );
	            		if($start_date_str === $end_date_str): 
	            			if($show_end == 'yes') $start_time_str = sprintf( __( '%s - %s', 'easybook-add-ons' ), $start_time_str, $end_time_str );
	            		?>
	            		<li class="wkhour-li-item"><span class="opening-hours-day"><?php echo $start_date_str;?></span><span class="opening-hours-time"><?php echo $start_time_str; ?></span></li>
	            		<?php else: ?>
	            		<li class="wkhour-li-item event-start-date"><span class="opening-hours-day"><?php echo $start_date_str;?></span><span class="opening-hours-time"><?php echo $start_time_str; ?></span></li>
	            		<?php if($show_end == 'yes'): ?><li class="wkhour-li-item event-end-date"><span class="opening-hours-day"><?php echo sprintf(__( 'End: %s', 'easybook-add-ons' ), $end_date_str);?></span><span class="opening-hours-time"><?php echo $end_time_str; ?></span></li><?php endif; ?>
	            		<?php endif; 
	            	}
		            $count++;
	            } // end foreach
	            ?>
	            </ul>
	        </div>
	    </div>
	</div>
</div>
