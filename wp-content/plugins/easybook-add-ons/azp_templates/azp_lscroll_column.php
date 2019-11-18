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
$azp_mID = $el_id = $el_class = $images_to_show = $show_share = $show_review = 
$show_bookmarks = $show_book = '';  

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(  
	'azp_element',
    'azp_lscroll_column',
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
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>> 
	<!-- fixed-scroll-column  -->
    <div class="lscroll-column">
        <div class="fixed-scroll-column">
            <div class="fixed-scroll-column-item fl-wrap">
                <?php if($show_share == 'show'): 
                    $optext = __( 'Share', 'easybook-add-ons' );
                    $cltext = __( 'Close', 'easybook-add-ons' );
                    $share_names = easybook_addons_get_option('widgets_share_names','facebook, pinterest, googleplus, twitter, linkedin');
                ?>
                    <div class="showshare sfcs fc-button" data-optext="<?php echo esc_attr( $optext ); ?>" data-cltext="<?php echo esc_attr( $cltext ); ?>">
                        <i class="far fa-share-alt"></i>
                        <span><?php echo $optext; ?></span>
                    </div>
                    <div class="share-holder fixed-scroll-column-share-container">
                        <div class="share-container  isShare" data-share="<?php echo esc_attr( trim($share_names, ", \t\n\r\0\x0B") ); ?>"></div>
                    </div>
                <?php endif ?>
                <?php if($show_review == 'show'): ?>
                    <a class="fc-button custom-scroll-link" href="#listing-add-review">
                        <i class="far fa-comment-alt-check"></i> <span><?php esc_html_e( 'Add comment', 'easybook-add-ons' ); ?> </span>
                    </a>
                <?php endif ?>
                <?php if(!is_user_logged_in() && $show_bookmarks == 'show'): ?>
                    <a href="#" class="save-btn logreg-modal-open tooltipwrap fc-button" data-message="<?php esc_attr_e( 'Logging in first to bookmark this listing.', 'easybook-add-ons' ); ?>"><i class="far fa-heart"></i><span><?php esc_html_e( ' Save ', 'easybook-add-ons' ); ?></span></a>
                    <?php elseif( easybook_addons_already_bookmarked( get_the_ID() ) ): ?>
                    <a href="javascript:void(0);" class="save-btn tooltipwrap fc-button" data-id="<?php the_ID(); ?>"><i class="fas fa-heart"></i><span><?php esc_html_e( ' Saved ', 'easybook-add-ons' ); ?></span></a>
                    <?php else: ?>
                    <a href="#" class="save-btn bookmark-listing-btn tooltipwrap fc-button" data-id="<?php the_ID(); ?>"><i class="far fa-heart"></i><span><?php esc_html_e( 'Save', 'easybook-add-ons' ); ?> </span></a>
                <?php endif; ?>
                <?php if($show_book == 'show'): ?>
                    <a class="fc-button" href="#"><i class="far fa-bookmark"></i> <span> <?php esc_html_e( 'Book Now', 'easybook-add-ons' ); ?> </span>
                    </a>
                <?php endif ?>
            </div>
        </div>
    </div>
    <!-- fixed-scroll-column end   -->
</div>



