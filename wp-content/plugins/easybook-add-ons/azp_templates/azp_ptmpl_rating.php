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
    'azp_ptmpl_rating',
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
$rating = easybook_addons_get_average_ratings(get_the_ID());     
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>  
    <div class="preview-rating">
        <div class="geodir-category-opt">
            <div class="listing-rating card-popup-rainingvis" data-starrating2="<?php echo esc_attr( $rating['sum'] );?>" data-stars="<?php echo esc_attr( easybook_addons_get_option('rating_base') ); ?>"></div> 
            <div class="rate-class-name">
                <?php if( $rating != false ): ?>
                    <div class="score">
                        <strong class="review-text"><?php echo easybook_addons_rating_text($rating['sum']); ?></strong>
                        <?php echo sprintf( _nx( '%s comment', '%s comments', (int)$rating['count'], 'comments count', 'easybook-add-ons' ), (int)$rating['count'] ); ?>
                    </div>
                    <span class="review-value"><?php echo $rating['sum']; ?></span> 
                <?php else : ?>
                    <span class="review-value"><?php esc_html_e( '0.0',  'easybook-add-ons' );?></span> 
                <?php endif; ?>                                  
            </div>
        </div>
    </div>
</div>
