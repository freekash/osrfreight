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
$azp_mID = $el_id = $el_class = $dec_banner = $content_baner = $book_url = $hide_widget_on = '';  

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_widget_banner',
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

$levent_end_date = get_post_meta( get_the_ID(), ESB_META_PREFIX.'levent_end_date', true );
$levent_end_time = get_post_meta( get_the_ID(), ESB_META_PREFIX.'levent_end_time', true );
$timezone = get_post_meta( get_the_ID(), ESB_META_PREFIX."wkh_tz", true );
$content_baner = get_post_meta( get_the_ID(), ESB_META_PREFIX.'content_baner', true );
if(( $hide_widget_on_check = easybook_addons_is_hide_on_plans($hide_widget_on) ) !== 'true') :
?>
<div class="<?php echo $classes; ?> authplan-hide-<?php echo $hide_widget_on_check;?>" <?php echo $el_id;?>>
    <div class="for-hide-on-author"></div>
	<!--box-widget-item -->
    <div class="box-widget-itemes fl-wrap">
        <div class="box-widget counter-widget" data-countdate="<?php echo easybook_addons_get_gmt_from_date( $levent_end_date.' '.$levent_end_time, $timezone, 'm/d/Y H:i:s' );?>">
            <div class="banner-wdget fl-wrap">
                <div class="overlay"></div>
                <div class="bg"  data-bg="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>"></div>
                <div class="banner-wdget-content fl-wrap">
                    <?php echo $content_baner; ?>
                    <?php if ($levent_end_date != ''): ?>
                        <div class="countdown fl-wrap">
                            <div class="countdown-item">
                                <span class="days rot">00</span>
                                <p>days</p>
                            </div>
                            <div class="countdown-item">
                                <span class="hours rot">00</span>
                                <p>hours </p>
                            </div>
                            <div class="countdown-item">
                                <span class="minutes rot">00</span>
                                <p>minutes </p>
                            </div>
                            <div class="countdown-item">
                                <span class="seconds rot">00</span>
                                <p>seconds</p>
                            </div>
                        </div>
                    <?php endif ?>
                    
                    <a href="#listing-booking-widget"><?php esc_html_e( 'Book Now','easybook-add-ons' ) ?></a>
                </div>
            </div>
        </div>
    </div>
    <!--box-widget-item end -->  
</div>
<?php endif; 
