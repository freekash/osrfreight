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
    'azp_ptmpl_fact',
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

$featuresed = array();
$features = get_the_terms(get_the_ID(), 'listing_feature');
if ( $features && ! is_wp_error( $features ) ){ 
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>  
    <div class="preview-fact fl-wrap">
        <ul class="facilities-list fl-wrap">
            <?php 
            $count = 0;
            foreach( $features as $key => $term){ 
                if($count < 5){
                $term_meta = get_term_meta( $term->term_id, ESB_META_PREFIX.'term_meta', true );
            ?>
                <li class="lfea-term-<?php echo $term->slug;?>">
                    <?php if( isset($term_meta['icon_class']) && $term_meta['icon_class'] != '' ): ?>
                    <i class="<?php echo esc_attr( $term_meta['icon_class'] ); ?>"></i><span class="fea-tooltip"><?php echo $term->name; ?></span>
                    <?php else: ?>
                    <span class="fea-tooltip-noicon"><?php echo $term->name; ?></span>
                    <?php endif; ?>
                </li>
            <?php
                }
                $count++;
            } ?>
        </ul>
    </div>
</div>
<?php 
} 


