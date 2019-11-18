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
$azp_mID = $el_id = $el_class = $images_to_show = $hide_widget_on = $hide_contacts_on = '';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_widget_contacts',
    'azp-element-' . $azp_mID, 
    $el_class,
);
$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) ); 

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}
if(( $hide_widget_on_check = easybook_addons_is_hide_on_plans($hide_widget_on) ) !== 'true') :
?>
<div class="<?php echo $classes; ?> authplan-hide-<?php echo $hide_widget_on_check;?>" <?php echo $el_id;?>>
	<?php 
	if( $hide_contacts_on_check = easybook_addons_is_hide_on_plans($hide_contacts_on) !== 'true' ){
		easybook_addons_get_template_part('templates-inner/contact');
	}elseif( easybook_addons_check_hide_on_logout_user($hide_contacts_on) ){ ?>
        <div class="box-widget-item fl-wrap" id="listing-contacts-widget">
            <div class="box-widget-item-header">
                <h3><?php esc_html_e( 'Contact Information', 'easybook-add-ons' );?></h3>
            </div>
            <div class="box-widget">
                <div class="box-widget-content">
                    <?php esc_html_e( 'Please sign in to see contact details.','easybook-add-ons') ?>
                </div>
            </div>
        </div>
        <?php
    }
	?>
</div>
<?php endif; 
