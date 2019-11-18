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
$azp_mID = $el_id = $el_class = $images_to_show = $show_contact = $hide_widget_on = '';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_widget_author',
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
if(( $hide_widget_on_check = easybook_addons_is_hide_on_plans($hide_widget_on) ) !== 'true') :
?>
<div class="<?php echo $classes; ?> authplan-hide-<?php echo $hide_widget_on_check;?>" <?php echo $el_id;?>>
    <div class="for-hide-on-author"></div>
	<div class="box-widget-item fl-wrap" id="listing-author-widget">
	    <div class="box-widget-item-header">
	        <h3><?php esc_html_e( 'Hosted by : ', 'easybook-add-ons' );?></h3>
	    </div>
	    <?php 
	    $author_ID = get_the_author_meta( 'ID' );
	    ?>
	    <div class="box-widget list-author-widget">
	        <div class="list-author-widget-header fl-wrap">
	            <div class="box-widget-author-title-img ">
	                <?php 
	                    echo get_avatar(get_the_author_meta('user_email'),'150','https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=150', get_the_author_meta('display_name') ); 
	                ?> 
	            </div>
	            <span class="list-author-widget-link">
	                <a href="<?php echo get_author_posts_url( $author_ID ); ?>"><?php echo get_the_author_meta('display_name');?></a>
	                <?php 
	                	$current_user = wp_get_current_user(); 
						$args = array(
						    'fields'            => 'ids', 
						    'posts_per_page'    => 1000, 
						    'post_type'         => 'listing',
						    'author'            => $current_user->ID,
						    'post_status'       =>'publish',
						);
						$listings_post = get_posts( $args ); 
	                    ?>
	                    <span><?php echo  count($listings_post); ?> <?php esc_html_e('Places Hosted', 'easybook-add-ons') ?></span>
	            </span>
	        </div>
	        <a href="<?php echo get_author_posts_url( $author_ID ); ?>" class="btn flat-btn color-bg float-btn"><?php esc_html_e( 'View Profile ', 'easybook-add-ons' );?><i class="fal fa-user-alt"></i></a>
	    </div>
	</div>
</div>
<?php endif; 
