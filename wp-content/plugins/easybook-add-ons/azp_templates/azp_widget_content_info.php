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
$azp_mID = $el_id = $el_class = $images_to_show = ''; 

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_widget_content_info', 
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
/**
 * @package EasyBook Add-Ons
 * @description A custom plugin for EasyBook - Hotel & Tour Booking WordPress Theme
 * @author CTHthemes - http://themeforest.net/user/cththemes
 * @date 03-10-2019
 * @version 1.1.7
 * @copyright Copyright ( C ) 2014 - 2019 cththemes.com . All rights reserved.
 * @license GNU General Public License version 3 or later; see LICENSE
 */


// if( easybook_addons_check_package_single_field( 'hide_contacts_info' ) ) return;  
// $contact_infos = get_post_meta( get_the_ID(), '_cth_contact_infos', true );
$contact_infos = array(
    'address' => get_post_meta( get_the_ID(), '_cth_address', true ),
    'latitude' => get_post_meta( get_the_ID(), '_cth_latitude', true ),
    'longitude' => get_post_meta( get_the_ID(), '_cth_longitude', true ),
    'phone' => get_post_meta( get_the_ID(), '_cth_author_phone', true ),
    'email' => get_post_meta( get_the_ID(), '_cth_author_email', true ),
    'website' => get_post_meta( get_the_ID(), '_cth_author_website', true ),
);
$rating = easybook_addons_get_average_ratings(get_the_ID());
// $price_from_formated = easybook_addons_get_price_formated(get_post_meta( get_the_ID(), ESB_META_PREFIX.'price_from', true ));
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
    <div class="box-widget-item flat-hero-container fl-wrap remov-reviw-cont" data-remov="yes" id="listing-content-widget">
        <div class="box-widget-item-header fl-wrap ">
            <h3><?php the_title(); ?><?php if( get_post_meta( get_the_ID(), ESB_META_PREFIX.'verified', true ) == '1' ) echo '<span class="listing-verified tooltipwrap tooltip-center"><i class="fa fa-check"></i><span class="tooltiptext">'.__('Verified','easybook-add-ons').'</span></span>'; ?>
                <?php easybook_addons_edit_listing_link(get_the_ID());?>
            </h3>
            
            <?php if (!empty($rating['sum']) && is_numeric($rating['sum']) && $rating['sum']!== ''): ?>
                <div class="listing-rating-wrap">
                    <div class="listing-rating card-popup-rainingvis" data-starrating2="<?php echo $rating['sum'];?>"></div>
                </div>
            <?php endif; ?> 
        </div>
        <div class="list-single-hero-price fl-wrap">
            <?php echo sprintf(
                __( 'Average Price %s', 'easybook-add-ons' ), 
                '<strong class="per-night-price">'.easybook_addons_get_price_formated(easybook_addons_get_average_price()).'</strong>'
            ) ?>
        </div>
        <div class="clearfix"></div>
         <?php if (!empty($rating)): ?>
                <div class="rate-class-name-wrap fl-wrap">
                    <div class="rate-class-name">
                        <span><?php echo $rating['sum']; ?></span>
                        <div class="score">
                            <strong class="review-text"><?php echo easybook_addons_rating_text($rating['sum']); ?></strong>
                            <?php
                            echo sprintf( _nx( '%s comment', '%s comments', (int)$rating['count'], 'comments count', 'easybook-add-ons' ), (int)$rating['count'] );
                            ?>
                         </div>
                    </div>
                    <a href="#listing-add-review" class="color-bgs"><?php esc_html_e( ' Add Comment  ', 'easybook-add-ons' );?><i class="far fa-comment-alt-check"></i></a>
                </div>
            
            <div class="clearfix"></div>
           <div class="review-score-detail">
                <!-- review-score-detail-list-->
                <div class="review-score-detail-list">
                <?php
                    $rating_base = (int)easybook_addons_get_option('rating_base'); 
                    $rating_fields = easybook_addons_get_rating_fields(get_post_meta( get_the_ID(), ESB_META_PREFIX.'listing_type_id', true ));
                    if (!empty($rating_fields)) {
                        foreach ((array)$rating_fields as $key => $field) {?>

                        <!-- rate item-->
                        <div class="rate-item fl-wrap">
                            <div class="rate-item-title fl-wrap"><span><?php echo $field['title']; ?></span></div>
                            <div class="rate-item-bg" data-percent="<?php echo ($rating['values'][$field['fieldName']]/$rating_base)*100 ?>%">
                                        <div class="rate-item-line color-bgs"></div>
                                    </div>
                            <div class="rate-item-percent"><?php echo $rating['values'][$field['fieldName']]; ?></div>
                        </div>
                        <!-- rate item end-->
                    <?php 
                        }
                    }
                ?>
                </div>
                <!-- review-score-detail-list end-->
            </div>
        <!-- reviews-score-wrap end --> 
        <?php endif ?> 
        <a href="#listing-booking-widget" class="btn color2-bg big-btn float-btn"><?php esc_html_e( ' Book Now  ', 'easybook-add-ons' );?><i class="far fa-bookmark"></i></a>
    </div>
</div>