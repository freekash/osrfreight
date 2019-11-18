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



$css = $el_class = $cat_ids = $cat_ids_not = $orderby = $order = $hide_empty = $number = $columns_grid = $items_width = $space = $view_all_link = $is_external = $btn_name = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'gallery-items fl-wrap mr-bot spad',
    $columns_grid .'-columns',
    $space .'-pad',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
$href = vc_build_link( $view_all_link );
?>
<?php 
$term_args = array(
    'taxonomy' => 'listing_cat',
    'hide_empty' => (bool)$hide_empty,
    'orderby' => $orderby,
    'order' => $order,
    'number' => $number,
);
if(!empty($cat_ids)) {
    $cat_ids = explode(',',$cat_ids);
    $term_args['include']  = $cat_ids;
} elseif(!empty($cat_ids_not)) {
    $cat_ids_not = explode(',',$cat_ids_not);
    $term_args['exclude']  = $cat_ids_not;
}        

$listing_terms = get_terms( $term_args );
if ( ! empty( $listing_terms ) && ! is_wp_error( $listing_terms ) ) { ?>
    <div class="<?php echo esc_attr( $css_class );?>">
        <div class="grid-sizer"></div>
        <?php 
        $items_width = explode(',',$items_width);
        // $items_width = array_filter($items_width);
        $key = 0;
        foreach ($listing_terms as $term) { 
            
            $imgid = '';
            $term_meta = get_term_meta( $term->term_id, ESB_META_PREFIX.'term_meta', true );
            if(isset($term_meta['featured_img']) && !empty($term_meta['featured_img'])){
               $imgid = $term_meta['featured_img']['id'];
            }

            $tnsize = 'easybook-lcat-one';

            $item_cls = 'gallery-item';
            if(isset($items_width[$key])){
                switch ($items_width[$key]) {
                    case 'x2':
                        $item_cls .= ' gallery-item-second';
                        $tnsize = 'easybook-lcat-two';
                        break;
                    case 'x3':
                        $item_cls .= ' gallery-item-three';
                        $tnsize = 'easybook-lcat-three';
                        break;
                }
            }
            ?>
            <!-- gallery-item-->
            <div id="listing_cat-<?php echo esc_attr( $term->term_id );?>" class="<?php echo esc_attr( $item_cls ); ?>">
                <div class="grid-item-holder">
                    <div class="listing-item-grid">
                        <?php if($imgid != '') echo '<a href="'.esc_url( get_term_link( $term ) ).'" class="listing-cat-link">' . wp_get_attachment_image( $imgid, $tnsize ) .'</a>'; ?>
                        <div class="listing-counter"><span><?php echo esc_html($term->count) ?> </span> <?php esc_html_e( 'Locations', 'easybook-add-ons' ); ?></div>
                        <div class="listing-item-cat">
                            <h3><a href="<?php echo esc_url( get_term_link( $term ) ) ?>"><?php echo esc_html($term->name); ?></a></h3>
                            <?php echo term_description( $term->term_id, 'listing_cat' ); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- gallery-item end-->
        <?php
            $key++;
        }
        // end foreach

        ?>
    </div>
    <?php
        $url = $href['url'];
        // echo '<div>'.$url.'</div>';
        $target = ($is_external == 'yes') ? 'target="_blank"' : '';
        if($url != '') {
            echo '<div class="view-all-cats"><a href="' . $url . '" ' . $target .' class="btn big-btn circle-btn dec-btn color-bg flat-btn">'.$btn_name.'<i class="fa fa-eye"></i></a></div>';
        }else {
            echo '<div class="view-all-cats"><a href="#" ' . $target .' class="btn big-btn circle-btn dec-btn color-bg flat-btn">'.$btn_name.'<i class="fa fa-eye"></i></a></div>';
        }
    ?>
<?php } ?>

