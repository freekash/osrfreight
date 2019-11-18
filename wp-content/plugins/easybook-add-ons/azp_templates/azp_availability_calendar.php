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
$azp_mID = $el_id = $el_class = $wid_title = $showing = $max = $dates_source = '';  

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
    'azp_element',
    'azp_availability_calendar',
    'azp-element-' . $azp_mID,
    $el_class,
);

$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) );  

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}

?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
    <div class="list-single-main-items">
        <?php if($wid_title != ''): ?>
        <div class="list-single-main-item-title fl-wrap">
            <h3><?php echo $wid_title; ?></h3>
        </div>
        <?php endif; ?>
        <div class="list-single-avilability-calendar">
            <div class="cth-availability-calendar"
                data-show="<?php echo $showing; ?>" 
                data-max="<?php echo $max; ?>" 
                data-name="checkin" 
                data-format="<?php _ex( 'YYYY-MM-DD', 'tour booking date format', 'easybook-add-ons' ); ?>" 
                data-default=""
                data-action="<?php echo $dates_source; ?>" 
                data-postid="<?php the_ID();?>" 
                data-selected="availability_dates"
            ></div>
        </div>
    </div> 
</div> 

