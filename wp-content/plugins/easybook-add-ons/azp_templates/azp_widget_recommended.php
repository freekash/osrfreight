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
$azp_mID = $el_id = $el_class = $images_to_show = $ids = $posts_per_page = $order_by = $order = $hide_widget_on = '';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_widget_recommended',
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
$rating_base = (int)easybook_addons_get_option('rating_base');
if(( $hide_widget_on_check = easybook_addons_is_hide_on_plans($hide_widget_on) ) !== 'true') :
?>
<div class="<?php echo $classes; ?> authplan-hide-<?php echo $hide_widget_on_check;?>" <?php echo $el_id;?>>
    <div class="for-hide-on-author"></div>
	<?php
	$author_ID = get_the_author_meta( 'ID' );
	// $price_from = get_post_meta( get_the_ID(), ESB_META_PREFIX.'price_from', true );
	
	if (!empty($ids)) {
		$id = explode(",", $ids);
		$args = array(
		    'post_type'     =>  'listing',  
		    'author'        =>  $author_ID,
		    'post__in' 		=> 	$id, 
		    'orderby'       =>  $order_by,
		    'order'         =>  $order, 
		    'posts_per_page' => $posts_per_page
		);
	}else{
		$args = array(
		    'post_type'     =>  'listing', 
		    'author'        =>  $author_ID,
		    'orderby'       =>  $order_by,
		    'order'         =>  $order, 
		    'posts_per_page' => $posts_per_page
		);
	}
	// The Query
	$posts_query = new WP_Query( $args );
	if($posts_query->have_posts()) : ?>
	<!--box-widget-item -->
	<div class="box-widget-item widget-posts-wrap fl-wrap" id="listing-morefauthor-widget">
	    <div class="box-widget-item-header">
	        <h3><?php esc_html_e( 'Similar Listings', 'easybook-add-ons' ); ?></h3>
	    </div>
	    <div class="box-widget">
	        <div class="box-widget-content widget-posts">
	            <ul>
	            <?php while($posts_query->have_posts()) : $posts_query->the_post(); ?>
	                <li class="clearfix">
	                    <?php
	                    if(has_post_thumbnail( )){ ?>
	                    <a href="<?php echo esc_url( get_permalink() ); ?>"  class="widget-posts-img"><?php the_post_thumbnail('easybook-recent-post',array('class'=>'respimg') ); ?></a>
	                    <?php } ?>
	                    <div class="widget-posts-descr">
	                        <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
	                        <?php if (!empty($rating)):?>
	                        	 <div class="listing-rating card-popup-rainingvis" data-starrating2="<?php echo $rating['sum'];?>" data-stars="<?php echo $rating_base;?>"></div>
	                        <?php endif ?>
	                        <?php $contact_infos = array(
	                            'address' => get_post_meta( get_the_ID(), '_cth_address', true ),
	                            'latitude' => get_post_meta( get_the_ID(), '_cth_latitude', true ),
	                            'longitude' => get_post_meta( get_the_ID(), '_cth_longitude', true ),
	                        );
	                        if (!empty($contact_infos)):?>
		                        <div class="geodir-category-location fl-wrap"><a href="https://www.google.com/maps/search/?api=1&query=<?php echo $contact_infos['latitude'].','.$contact_infos['longitude'];?>" target="_blank"><i class="far fa-map-marker-alt"></i><?php echo esc_attr( $contact_infos['address'] );?></a></div>
		                    <?php endif; ?>
	                        <?php //if ($price_from !== ''): ?>
	                        	<span class="rooms-price">
                                    <?php echo sprintf(
                                        __( '%s / night', 'easybook-add-ons' ), 
                                        '<strong class="per-night-price">'.easybook_addons_get_price_formated( get_post_meta( get_the_ID(), '_price', true ) ).'</strong>'
                                    ) ?>
                                </span>
	                        <?php //endif ?>
	                        
	                    </div>
	                </li>
	                
	            <?php endwhile; ?>
	            </ul>
	            <a class="widget-posts-link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php esc_html_e( 'See All Listing', 'easybook-add-ons' ); ?><i class="fal fa-long-arrow-right"></i></a>   
	        </div>
	    </div>
	</div>
	<!--box-widget-item end --> 
	<?php 
	wp_reset_postdata();
	endif;
	?>
</div>
<?php endif; 
