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
$azp_mID = $el_id = $el_class = $images_to_show = $posts_per_page = $order_by = $order ='';     

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_lRooms',
    'azp-element-' . $azp_mID,
    $el_class,
);
$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) ); 
if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}
// $current_user = wp_get_current_user();  
$lrooms = get_post_meta( get_the_ID(), ESB_META_PREFIX.'rooms_ids', true );  
// var_dump($lrooms);
$listing_type_ID = get_post_meta( get_the_ID(), ESB_META_PREFIX.'listing_type_id', true );
$child_pt = get_post_meta( $listing_type_ID, ESB_META_PREFIX.'child_type_meta', true );
$child_type = ($child_pt == 'product') ? 'product' : 'lrooms';
// var_dump(get_post_meta( get_the_ID(), ESB_META_PREFIX.'coupon_ids', true ));
if(!empty($lrooms) && is_array($lrooms) && $lrooms != ''){ 
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>> 
    <div class="list-single-main-items fl-wrap">
    		<div class="list-single-main-item-title fl-wrap">
                <h3><?php esc_html_e('Available Rooms','easybook-add-ons'); ?></h3>
            </div>
            <div class="rooms-container fl-wrap" data-listingids="<?php echo get_the_ID();?>">
            <?php 
                $args = array(
                        'post_type'         => $child_type,
                        'post_status'       => 'publish',
                        'post__in'          => $lrooms,
                        'posts_per_page'    => -1,
                        // 'author'            => $current_user->ID,
                        'orderby'           => $order_by,
                        'order'             => $order,

                    );
                     $posts_query = new \WP_Query($args);
                    if($posts_query->have_posts()) :
                        while($posts_query->have_posts()) : $posts_query->the_post(); 
                            ?>
                            <div class="room-item-warp">
                                <?php if ($child_pt == 'product'): ?>
                                    <form  method="POST" class="lroom-form-cart" accept-charset="utf-8">
                                <?php endif ?>
                                
                                    <!--  rooms-item -->
                                    <div class="rooms-item fl-wrap">
                                    
                                        <?php 
                                            echo easybook_addons_azp_parser_listing( $listing_type_ID  , 'preview_room', get_the_ID() );
                                        ?>
                                    </div>
                                    <!--  rooms-item end -->
                                 <?php if ($child_pt == 'product'): ?>
                                    </form>
                                <?php endif ?>
                            </div>     
                         <?php
                        endwhile; //end the while loop

                    endif; // end of the loop. 
                ?>  
                <?php wp_reset_postdata();?>                                      
            </div>	
        <div class="ctb-rooms-claim-modal" ></div>
    </div>     
</div>
<?php 
}
?>
