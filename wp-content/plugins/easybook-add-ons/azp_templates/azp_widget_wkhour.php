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
$azp_mID = $el_id = $el_class = $hide_widget_on = '';

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
$working_hours = easybook_addons_get_working_hours(get_the_ID());
// var_dump($working_hours);
if(( $hide_widget_on_check = easybook_addons_is_hide_on_plans($hide_widget_on) ) !== 'true') :
?>
<div class="<?php echo $classes; ?> authplan-hide-<?php echo $hide_widget_on_check;?>" <?php echo $el_id;?>>
    <div class="for-hide-on-author"></div>
    <div class="box-widget-item fl-wrap" id="listing-wkhour-widget">
	    <div class="box-widget-item-header">
	        <h3><?php esc_html_e( 'Working Hours : ', 'easybook-add-ons' );?></h3>
	    </div>
	    <div class="box-widget opening-hours">
	        <div class="box-widget-content">
	            
	            <span class="current-status"><i class="fa fa-clock-o"></i> <?php echo $working_hours['statusText'];?> <span class="listing-timezone"><?php echo $working_hours['timezone'];?></span></span>
	            <?php 
	            $working_days_hours = $working_hours['days_hours'];
	            if(count($working_days_hours)) :
	            ?>
	            <ul>
	            <?php
	            foreach ($working_days_hours as $day => $hours) { 
	            	// if($hours === 'Day Off') continue;
	            	$licls = implode('_', (array)$hours);
	            	$licls = sanitize_title_with_dashes( $licls );
	                ?>
	                <li class="wkhour-li-item <?php echo esc_attr( $licls );?>"><span class="opening-hours-day"><?php echo $day;?></span><span class="opening-hours-time"><?php
	                foreach ($hours as $hr) {
	                    echo $hr;
	                }
	                ?></span></li>
	            <?php
	            } // end foreach
	            ?>
	            </ul>
	            <?php 
	            endif; // end if count($working_days_hours)
	            ?>
	        </div>
	    </div>
	</div>
</div>
<?php endif;

