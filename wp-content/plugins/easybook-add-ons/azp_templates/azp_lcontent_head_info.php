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
$azp_mID = $el_id = $el_class = '';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_lcontent_head_info',
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
   	<div class="list-single-header list-single-header-inside fl-wrap remov-reviw-cont" data-remov="yes">
	    <div class="row">
	        <div class="col-sm-7">
	            <div class="list-single-main-item-title fl-wrap">
	                <h3><?php the_title(); ?><?php if( get_post_meta( get_the_ID(), ESB_META_PREFIX.'verified', true ) == '1' ) echo '<span class="listing-verified tooltipwrap tooltip-center"><i class="fa fa-check"></i><span class="tooltiptext">'.__('Verified','easybook-add-ons').'</span></span>'; ?>
                      <?php easybook_addons_edit_listing_link(get_the_ID());?>   
                    </h3>
                   
                    
                    <?php if (!empty($rating['sum']) && is_numeric($rating['sum'])): ?>
	                       <div class="listing-rating card-popup-rainingvis" data-starrating2="<?php echo $rating['sum'];?>"></div>
                    <?php endif; ?>
	                <?php if(!empty($contact_infos['latitude']) && !empty($contact_infos['longitude']) && !empty($contact_infos['address'])): ?>
	                  <div class="geodir-category-location fl-wrap"><a href="https://www.google.com/maps/search/?api=1&query=<?php echo $contact_infos['latitude'].','.$contact_infos['longitude'];?>" target="_blank"><i class="far fa-map-marker-alt"></i><?php echo esc_attr( $contact_infos['address'] );?></a></div>
	                <?php endif;?>
	              
	            </div>
	        </div>
	        <div class="col-sm-5">
                <div class="list-single-hero-price fl-wrap">
                    <?php echo sprintf(
                        __( 'Average Price %s', 'easybook-add-ons' ), 
                        '<strong class="per-night-price">'.easybook_addons_get_price_formated(easybook_addons_get_average_price()).'</strong>'
                    ) ?>

                </div>   	
            </div>
	    </div>
	    <span class="fw-separator"></span>
        <?php if (!empty($rating)): ?>
	    <!--reviews-score-wrap-->   
            <div class="reviews-score-wrap fl-wrap">
                    <div class="review-score-total">
                        <span><?php echo $rating['sum']; ?>
                            <strong class="review-text"><?php echo easybook_addons_rating_text($rating['sum']); ?></strong>
                        </span>
                        <a href="#listing-add-review" class="color2-bg"><?php esc_html_e('Add Comment','easybook-add-ons'); ?></a> 
                    </div>
                <div class="review-score-detail">
                    <!-- review-score-detail-list-->
                    <div class="review-score-detail-list">
                    <?php
                        $rating_base = (int)easybook_addons_get_option('rating_base'); 
                        if($rating_base == 0) $rating_base = 5;
                        $rating_fields = easybook_addons_get_rating_fields(get_post_meta( get_the_ID(), ESB_META_PREFIX.'listing_type_id', true ));
                        if (!empty($rating_fields)) {
                            foreach ((array)$rating_fields as $key => $field) {?>

                            <!-- rate item-->
                            <div class="rate-item fl-wrap">
                                <div class="rate-item-title fl-wrap"><span><?php echo $field['title']; ?></span></div>
                                <div class="rate-item-bg" data-percent="<?php echo (floatval($rating['values'][$field['fieldName']])/$rating_base)*100 ?>%">
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
            </div>
            <!-- reviews-score-wrap end -->
        <?php endif ?>                                             
	</div>
	<!-- list-single-header end -->
</div>