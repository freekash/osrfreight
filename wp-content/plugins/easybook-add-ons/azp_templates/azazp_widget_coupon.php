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
$azp_mID = $el_id = $el_class = $dec_banner = $content_baner = $book_url = '';  

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_widget_coupon',
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

// $coupon_expiry_date = get_post_meta( , ESB_META_PREFIX.'coupon_expiry_date',true );



?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
	<!--box-widget-item -->
    <div class="box-widget-itemes fl-wrap">
        <div class="box-widget counter-widget" data-countdate="<?php ?>">
            <div class="banner-wdget fl-wrap">
                <div class="overlay"></div>
                <div class="bg"  data-bg="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>"></div>
                <div class="banner-wdget-content fl-wrap">
                   <!--  <?php echo $content_baner; ?> -->
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
                    <a href="#listing-booking-widget"><?php esc_html_e( 'Book Now','easybook-add-ons' ) ?></a>
                </div>
            </div>
        </div>
    </div>
    <!--box-widget-item end -->  
</div>

