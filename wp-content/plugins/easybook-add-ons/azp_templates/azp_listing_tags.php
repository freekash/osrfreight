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
$azp_mID = $el_id = $el_class = $sec_id = $wid_title = '';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_ltags',
    'azp-element-' . $azp_mID,
    $el_class,
);
$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) ); 

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}

$terms = get_the_terms(get_the_ID(), 'listing_tag');
if ( $terms && ! is_wp_error( $terms ) ){ 
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
    <div class="list-single-main-items fl-wrap">
        <?php if($wid_title != ''): ?>
        <div class="list-single-main-item-title no-dec-title fl-wrap">
            <h3><?php echo $wid_title; ?></h3>
        </div>
        <?php endif; ?>
        <div class="list-single-tags tags-stylwrap">
            <?php 
            foreach( $terms as $key => $term){
                echo sprintf( '<a href="%1$s" class="listing-tag">%2$s</a>',
                    esc_url( get_term_link( $term->term_id, 'listing_tag' ) ),
                    esc_html( $term->name )
                );
            }
            ?>                                                                              
        </div>
    </div>
</div>
<?php }