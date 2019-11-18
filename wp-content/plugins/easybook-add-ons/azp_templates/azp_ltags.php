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
$azp_mID = $el_id = $el_class = $images_to_show = $sec_id = '';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_ltags',
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
if( false == easybook_addons_check_package_field('hide_tags', true ) && get_the_tags( ) ) :
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
    <div class="list-single-main-items fl-wrap" >
        <!-- <span class="fw-separator"></span> -->
        <div class="list-single-main-item-title no-dec-title fl-wrap">
            <h3><?php esc_html_e( 'Tags', 'easybook-add-ons' ); ?></h3>
        </div>
        <div class="list-single-tags tags-stylwrap">
            <?php the_tags('','','');?>                                                                              
        </div>
    </div>
</div>
<?php endif;?>