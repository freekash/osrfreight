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
$azp_mID = $el_id = $el_class = $title = '';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_sbook_room',
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
    <div class="listsearch-input-item"> 
    <?php 
        $lrooms = get_post_meta( get_the_ID(), ESB_META_PREFIX.'rooms_ids', true );
     ?>
        <label><?php echo $title; ?></label>
        <select data-placeholder="Room Type" name="lb_room"   class="chosen-select no-search-select" >
            <?php 
            $current_user = wp_get_current_user();
            $args = array(
                        'post_type' => 'lrooms',
                        'post_status' => 'publish',
                        'post__in' => $lrooms,
                      	'posts_per_page' => -1,
                        // 'author' => $current_user->ID,
                    ); 
            $lrooms_query = get_posts($args); 
            foreach ($lrooms_query as $value){
            		$pricing_room = get_post_meta( $value->ID, ESB_META_PREFIX.'_price', true );
                    $selected = "";
                    if(!empty($lrooms) && in_array($value->ID, $lrooms)) $selected=' selected="selected"';
                    echo '<option value="'.$value->ID.'"'.$selected.'>' . $value->post_title.' - '.$pricing_room .' $ '. '</option>';
                } ?>
        </select>
        <!--data-formula -->
    </div>
    <!-- <div class="clearfix"></div> -->
</div>