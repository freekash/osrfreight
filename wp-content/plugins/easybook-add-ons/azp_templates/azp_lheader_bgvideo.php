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
$azp_mID = $el_id = $el_class = $images_to_show = $ratings = $contacts = $share =
$price = $breadcrumb = $login_contac_hidden =''; 

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_lheader_bgvideo',
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
$index = 0;
$headerImages = get_post_meta( get_the_ID(), '_cth_header_imgs', true );
// var_dump($headerImages);
$bgimg = '';
if(!empty($headerImages)){
   reset($headerImages);
    // var_dump(key($headerImages));
    $bgimg = easybook_addons_get_attachment_thumb_link( current($headerImages), 'full' ); 

    // var_dump($bgimg);
} 
$youtube_bg = get_post_meta( get_the_ID(), '_cth_headerbg_youtube', true ); // _cth_headerbg_vimeo - _cth_headerbg_mp4
// $price_from_formated = easybook_addons_get_price_formated(get_post_meta( get_the_ID(), ESB_META_PREFIX.'price_from', true ));

$rating = easybook_addons_get_average_ratings(get_the_ID());
$rating_base = (int)easybook_addons_get_option('rating_base');
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
	<!--  section  --> 
	<section class="parallax-section single-par list-single-section" data-scrollax-parent="true" id="sec1">
	    <div class="media-container video-parallax">
	        <div class="bg mob-bg" data-bg="<?php echo esc_url( $bgimg );?>"></div>
	    <?php 
	        if(get_post_meta( get_the_ID(), '_cth_headerbg_youtube', true ) != '') : 

	            $mute = '1';
	            $quality = 'highres'; // 'default','small','medium','large','hd720','hd1080'
	            $fittobackground = '1';
	            $pauseonscroll = '0';
	            $loop = '1';
	            // Hg5iNVSp2z8
	        ?>
	        <div  class="background-youtube-wrapper" data-vid="<?php echo esc_attr( get_post_meta( get_the_ID(), '_cth_headerbg_youtube', true ) );?>" data-mt="<?php echo esc_attr( $mute );?>" data-ql="<?php echo esc_attr( $quality );?>" data-ftb="<?php echo esc_attr( $fittobackground );?>" data-pos="<?php echo esc_attr( $pauseonscroll );?>" data-rep="<?php echo esc_attr( $loop );?>"></div>
	    <?php 
	        elseif(get_post_meta( get_the_ID(), '_cth_headerbg_vimeo', true ) != '') : 
	            $dataArr = array();
	            $dataArr['video'] = get_post_meta( get_the_ID(), '_cth_headerbg_vimeo', true );
	            $dataArr['quality'] = '1080p'; // '4K','2K','1080p','720p','540p','360p'
	            $dataArr['mute'] = '1';
	            $dataArr['loop'] = '1';
	            // 97871257
	            ?>
	        <div class="video-holder">
	            <div  class="background-vimeo" data-opts='<?php echo json_encode( $dataArr );?>'></div>
	        </div>
	    <?php else : 
	        $video_attrs = ' autoplay';
	        $video_attrs .=' muted';
	        $video_attrs .=' loop';

	        // http://localhost:8888/easybook/wp-content/uploads/2018/03/3.mp4
	    ?>
	        <div class="video-container">
	            <video<?php echo esc_attr( $video_attrs );?> class="bgvid">
	                <source src="<?php echo esc_url( get_post_meta( get_the_ID(), '_cth_headerbg_mp4', true ) );?>" type="video/mp4">
	            </video>
	        </div>
	    <?php endif; ?>
	    </div>

	    <div class="overlay"></div>
	   <!--  <div class="bubble-bg"></div> -->
	    <div class="list-single-header absolute-header fl-wrap">
	         <div class="container">
	            <div class="row">
	                <div class="col-md-8">
	                	<?php if (!empty($rating['sum']) && is_numeric($rating['sum']) && $rating['sum']!== ''): ?>
		                    <div class="listing-rating-wrap">
		                        <div class="listing-rating card-popup-rainingvis" data-starrating2="<?php echo $rating['sum'];?>" data-stars="<?php echo $rating_base;?>"></div>
		                    </div>
		                <?php endif; ?>
	                    <h2>
	                        <?php the_title( ) ;?>
	                        <?php if( get_post_meta( get_the_ID(), ESB_META_PREFIX.'verified', true ) == '1' ) echo '<span class="listing-verified tooltipwrap tooltip-center"><i class="fa fa-check"></i><span class="tooltiptext">'.__('Verified','easybook-add-ons').'</span></span>'; ?>
	                        <?php if( false == easybook_addons_check_package_single_field( 'hide_author_info' ) ): ?>
	                        <span  class="hosted-by-span"><?php esc_html_e( ' - Hosted By ', 'easybook-add-ons' );?></span><?php the_author_posts_link( );?> 
	                        <?php endif; ?>
	                        <?php easybook_addons_edit_listing_link(get_the_ID());?>
	                    </h2>
	                    <?php if($login_contac_hidden != 'hidden' || is_user_logged_in()){?>
	                    		<div class="list-single-header-contacts fl-wrap">
		                        	<?php easybook_addons_get_template_part( 'templates-inner/listing-contacts');?>
		                    	</div>
	                    <?php }else{ ?>
								<div class="list-single-header-contacts fl-wrap">
		                        	 <p><?php esc_html_e( 'Please sign in to see contact details.','easybook-add-ons') ?></p>
		                    	</div>
	                    	<?php 
	                    	}
	                    ?>
	                    	
	                </div>
	                <div class="col-md-4">
	                	<?php // if (!empty($rating)): ?>
	                		<!--  list-single-hero-details-->
		                    <div class="list-single-hero-details fl-wrap">
		                        <!--  list-single-hero-rating-->
		                        <?php if($ratings == 'show' && !empty($rating) ): ?>
		                        <div class="list-single-hero-rating">
		                            <div class="rate-class-name">
		                            	<div class="score">
                                            <strong class="review-text"><?php echo easybook_addons_rating_text($rating['sum']); ?></strong>
                                            <?php
                                            echo sprintf( _nx( '%s comment', '%s comments', (int)$rating['count'], 'comments count', 'easybook-add-ons' ), (int)$rating['count'] );
                                            ?>
                                        </div>
		                                <span><?php echo $rating['sum']; ?></span>                                             
		                            </div>
		                            <!-- list-single-hero-rating-list-->
		                            <div class="list-single-hero-rating-list">
					                    <?php
											$rating_base = (int)easybook_addons_get_option('rating_base'); 
					                        $rating_fields = easybook_addons_get_rating_fields(get_post_meta( get_the_ID(), ESB_META_PREFIX.'listing_type_id', true ));
					                        if (!empty($rating_fields)) {
					                            foreach ((array)$rating_fields as $key => $field) {?>

							                    <!-- rate item-->
						                        <div class="rate-item fl-wrap">
				                                    <div class="rate-item-title fl-wrap"><span><?php echo $field['title']; ?></span></div>
				                                    <div class="rate-item-bg" data-percent="<?php echo (floatval($rating['values'][$field['fieldName']])/$rating_base)*100 ?>%">
				                                                <div class="rate-item-line color-bgs"></div>
				                                            </div>
				                                    <div class="rate-item-percent"><?php echo floatval($rating['values'][$field['fieldName']]); ?></div>
				                                </div>
						                        <!-- rate item end-->
						                    <?php 
						                    	}
						                    }
					                    ?>
				                        
		                            </div>
		                            <!-- list-single-hero-rating-list end-->
		                        </div>
		                    <?php endif; ?>
		                        <!--  list-single-hero-rating  end-->
		                        <div class="clearfix"></div>
		                        <!-- list-single-hero-links-->
		                        <?php if($share == 'show'): ?>
			                        <div class="list-single-hero-links">
			                            <?php easybook_addons_get_template_part( 'templates-inner/listing-share');?>
			                        </div>
			                    <?php endif; ?>

		                        <!--  list-single-hero-links end-->                                            
		                    </div>
		                    <!--  list-single-hero-details  end-->
			        	<?php // endif; ?>
			        </div>
			    </div>
	            <div class="breadcrumbs-hero-buttom fl-wrap">
	                <?php if($breadcrumb == 'show'): 
	            		easybook_addons_breadcrumbs('gradient-bg  fl-wrap');
	            	endif ?>
	                <?php if ($price == 'show'): ?>
	                 	<div class="list-single-hero-price">
                            <?php echo sprintf(
                                __( 'AWG/NIGHT %s', 'easybook-add-ons' ), 
                                '<strong class="per-night-price">'.easybook_addons_get_price_formated(easybook_addons_get_average_price()).'</strong>'
                            ) ?>
                            
	                 	</div>  
	                <?php endif; ?>
	            </div>
	        </div>
	    </div>
	</section>
	<!--  section end --> 
</div>