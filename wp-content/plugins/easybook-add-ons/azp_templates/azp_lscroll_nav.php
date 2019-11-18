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
$azp_mID = $el_id = $el_class = $images_to_show =$latitude = $longitude = $contents_order = $show_mobile ='';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_lscroll_nav',
    'azp-element-' . $azp_mID,
    // 'lscroll-mobile-'.$show_mobile,
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

$contents_order = json_decode(urldecode($contents_order) , true) ;

// var_dump( $contents_order );
$address = get_post_meta( get_the_ID(), '_cth_address', true );
$latitude = get_post_meta( get_the_ID(), '_cth_latitude', true );
$longitude = get_post_meta( get_the_ID(), '_cth_longitude', true );
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
	<div class="scroll-nav-wrapper fl-wrap <?php echo 'lscroll-mobile-'.$show_mobile; ?>">
        <div class="hidden-map-container fl-wrap">
            <?php if(easybook_addons_get_option('use_osm_map') == 'yes'): ?>
                <div  id="<?php echo uniqid('singleMapOSM'); ?>" class="singleMapOSM" data-lat="<?php echo $latitude; ?>" data-lng="<?php echo $longitude;?>" data-loc="<?php echo $address;?>"></div>
            <?php else: ?>
                <div class="map-container">
                    <div class="singleMap" data-lat="<?php echo $latitude; ?>" data-lng="<?php echo $longitude;?>" data-loc="<?php echo $address;?>"></div>
                </div>
            <?php endif; ?>
        </div>
        <div class="container">
            <nav class="scroll-nav scroll-init">
                <ul>
                    <li class="sclnav-item sclnav-ltop"><a class="act-scrlink" href="#sec1"><?php esc_html_e( 'Top', 'easybook-add-ons' ); ?></a></li>
                     <?php if (!empty($contents_order) && $contents_order != '') {
                        foreach ($contents_order as $widget) { 
                            $nv_cls = 'sclnav-item';
                            if(isset($widget['show_mobile'])) $nv_cls .= ' sclnav-item-mobile-'.$widget['show_mobile'];
                            ?>
                            <li class="<?php echo esc_attr( $nv_cls ); ?>"><a href="<?php echo $widget['sec_id']; ?>"><?php echo $widget['title']; ?></a></li>                  
                    <?php   } 
                        }
                    ?> 
                </ul>
            </nav>
            <?php 
            $optext = __( 'On The Map', 'easybook-add-ons' ); 
            $cltext = __( 'Close', 'easybook-add-ons' ); 
            ?>
            <a href="#" class="show-hidden-map" data-optext="<?php echo esc_attr($optext); ?>" data-cltext="<?php echo esc_attr($cltext); ?>"><span><?php echo $optext; ?></span> <i class="fal fa-map-marked-alt"></i></a>
        </div>
    </div>
</div>