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



// global $query_string;
// echo '<pre>';
// var_dump($query_string);
// wp_parse_str( $query_string, $search_query );
// // $search = new WP_Query( $search_query );

// var_dump($search_query);

do_action( 'easybook_addons_listings_loop_before'); 

?>
<div id="listing-items" class="listing-items clearfix"> 
<?php
$action_args = array(
	'gmap_listings' => array()
);
// https://codex.wordpress.org/Function_Reference/do_action_ref_array
do_action_ref_array( 'easybook_addons_listing_loop_before', array(&$action_args) );


// global $wp_query;
// var_dump($wp_query->found_posts);
// var_dump($action_args);
if ( have_posts() ) :
    /* Start the Loop */
    while ( have_posts() ) : the_post();
        easybook_addons_get_template_part('template-parts/listing');
        $action_args['listings'][] = get_the_ID();
    endwhile;

elseif(empty($action_args['listings'])):
    easybook_addons_get_template_part('template-parts/search-no');
endif;
    ?>
</div>
<div class="listings-pagination-wrap">
	<?php
	easybook_addons_ajax_pagination();
	?>
</div>
<?php
// end if has_posts
// wp_localize_script( 'easybook-addons', '_easybook_add_ons_locs', $action_args['gmap_listings']);
        
do_action( 'easybook_addons_listings_loop_after'); 
