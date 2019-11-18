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
$azp_mID = $el_id = $el_class = $custom_price = $hide_widget_on = ''; 
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_widget_booking_product', 
    'azp-element-' . $azp_mID, 
    $el_class,
);
// $animation_data = self::buildAnimation($azp_attrs);  
// $classes[] = $animation_data['trigger'];
// $classes[] = self::buildTypography($azp_attrs);//will return custom class for the element without dot
// $azptextstyle = self::buildStyle($azp_attrs);
$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) ); 
if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}
if(( $hide_widget_on_check = easybook_addons_is_hide_on_plans($hide_widget_on) ) !== 'true') :
$lrooms = get_post_meta( get_the_ID(), ESB_META_PREFIX.'rooms_ids', true );
if(!empty($lrooms)){
?>
<div class="<?php echo $classes; ?> authplan-hide-<?php echo $hide_widget_on_check;?>" <?php echo $el_id;?>>
	<div class="box-widget-item fl-wrap" id="listing-booking-widget">
	    <div class="box-widget-item-header">
	        <h3><?php esc_html_e( 'Booking: ', 'easybook-add-ons' ); ?></h3>
	    </div>
	    <div class="box-widgets">
	        <div class="box-widget-content box-widget-woo">
	        	<?php 
	                $args = array(
	                    'post_type'         => 'product',
	                    'post_status'       => 'publish',
	                    'post__in'          => $lrooms,
	                    'posts_per_page'    => -1,
	                );
	                 $posts_query = new \WP_Query($args);
	                if($posts_query->have_posts()) :
	                    while($posts_query->have_posts()) : $posts_query->the_post();
	                    	$price = get_post_meta(get_the_ID(), ESB_META_PREFIX.'_price', true);
	                        ?>
	                        <!--  woo-item -->
	                        <div class="woo-item fl-wrap">
	                        	<div class="woo-thub">
	                        		<?php
				                    	if(has_post_thumbnail( )){ 
				                    		the_post_thumbnail('easybook-recent-post',array('class'=>'respimg') ); 
				                   		} 
				                   	?>
	                        	</div>
	                        	<div class="woo-content fl-wrap">
	                            	<h5><?php the_title();?></h5>
	                            	<a class="btn color-bg" href="<?php echo easybook_addons_get_add_to_cart_url( get_the_ID() );?>"><?php _e( 'Add to cart', 'easybook-add-ons' ); ?>
	                            	</a>
	                            	<span><?php echo easybook_addons_get_price_formated($price);?> </span>
	                            	<input type="hidden" name="listing_id" value="<?php echo get_the_ID();?>">
	                        	</div>
	                            
	                        </div>
	                        <!--  woo-item end -->         
	                     <?php
	                    endwhile; //end the while loop

	                endif; // end of the loop. 
		            ?>  
		            <?php wp_reset_postdata();?>    
	        </div>
	    </div>
	</div>
</div>
<?php } 

endif; 