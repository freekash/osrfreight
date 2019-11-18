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
$azp_mID = $el_id = $el_class = $ids = $posts_per_page = $order_by = $order =''; 
// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_widget_near_post',
    'azp-element-' . $azp_mID,
    $el_class,
);

$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) );  

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"'; 
};
$user_ip = getenv('HTTP_CLIENT_IP')?:
getenv('HTTP_X_FORWARDED_FOR')?:
getenv('HTTP_X_FORWARDED')?:
getenv('HTTP_FORWARDED_FOR')?:
getenv('HTTP_FORWARDED')?:
getenv('REMOTE_ADDR');

// var_dump($user_ip);
$response = file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip");
if($response):
    $geo = unserialize($response);
    $latitude =  isset($geo["geoplugin_latitude"])?:'';
    $longitude = isset($geo["geoplugin_longitude"])?:'';

    // var_dump($latitude);
    // var_dump($longitude);
    if(!empty($latitude)&& !empty($longitude)):
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
    <div class="box-widget-item widget-posts-wrap fl-wrap">
        <div class="box-widget-item-header">
            <h3><?php esc_html_e('Recommended Attractions','easybook-add-ons');?></h3>  
        </div>
        <!--box-image-widget-->
        <div class="box-image-widget near-post-item" data-latitude="<?php echo $latitude; ?>" data-longitude ="<?php echo $longitude;?>">
            <div class="box-image-widget-media"><img src="images/all/4.jpg" alt="">
                <a href="#" class="color2-bg" target="_blank">Details</a>
            </div>
            <div class="box-image-widget-details">
                <h4>Times Square <span>2.3 km</span></h4>
                <p>It’s impossible to miss the colossal billboards, glitzy lights and massive crowds that make this intersection the city’s beating heart.</p>
            </div>
        </div>                                      
    </div>
</div>
<?php endif; 

endif;
