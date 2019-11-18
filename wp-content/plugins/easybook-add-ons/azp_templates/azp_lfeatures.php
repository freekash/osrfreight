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
$azp_mID = $el_id = $el_class = $num_feature = '';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_lfeatures',
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
$features = get_the_terms(get_the_ID(), 'listing_feature');
if ( $features && ! is_wp_error( $features ) ){ 
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>> 
    <div class="list-single-main-items fl-wrap">
    	<?php
            $feature_group = array();
            foreach( $features as $key => $term){
                if(easybook_addons_get_option('feature_parent_group') == 'yes'){
                    if($term->parent){
                        if( !isset($feature_group[$term->parent]) || !is_array($feature_group[$term->parent]) ) $feature_group[$term->parent] = array();
                        $feature_group[$term->parent][$term->term_id] = $term->name;
                    }else{
                        if(!isset($feature_group[$term->term_id])) $feature_group[$term->term_id] = $term->name;
                    }
                }else{
                    if(!isset($feature_group[$term->term_id])) $feature_group[$term->term_id] = $term->name;
                }
                    
            }
            // var_dump($feature_group);

        ?>
        <div class="list-single-main-item-title fl-wrap">
            <h3><?php esc_html_e( 'Amenities', 'easybook-add-ons' ); ?></h3>
        </div>
        <div class="listing-features fl-wrap">
            <ul class="fea-parent">
        <?php
            $count = 1;
            foreach( $feature_group as $tid => $tvalue){
                if($count <= (int)$num_feature){
                    if( is_array( $tvalue ) && count( $tvalue ) ){
                        $term = get_term_by( 'id', $tid , 'listing_feature' );
                        // var_dump($term);
                        if($term){
                            $term_meta = get_term_meta( $term->term_id, ESB_META_PREFIX.'term_meta', true );

                            echo sprintf( '<li class="fea-has-children">%1$s<ul class="fea-children">',
                                isset($term_meta['icon_class'])? '<i class="'.$term_meta['icon_class'].'"></i>' . esc_html( $term->name ) : esc_html( $term->name )
                            );

                            foreach ($tvalue as $id => $name) {
                                $term_meta = get_term_meta( $id, ESB_META_PREFIX.'term_meta', true );

                                echo sprintf( '<li>%1$s</li>',
                                    isset($term_meta['icon_class'])? '<i class="'.$term_meta['icon_class'].'"></i>' . esc_html( $name ) : esc_html( $name )
                                );
                            }

                            echo '</ul></li>';
                        }
                        
                    }else{
                        $term_meta = get_term_meta( $tid, ESB_META_PREFIX.'term_meta', true );

                        echo sprintf( '<li>%1$s</li>',
                            isset($term_meta['icon_class'])? '<i class="'.$term_meta['icon_class'].'"></i>' . esc_html( $tvalue ) : esc_html( $tvalue )
                        );
                    }
                }
                $count++;    
            }

        ?>
            </ul>
        </div>  
    </div>
</div>
<?php
    }
    // end features check
?>