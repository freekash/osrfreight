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



get_header(  );


/* Start the Loop */
while ( have_posts() ) : the_post();
    if(easybook_addons_get_option('show_listing_view') === 'yes' || easybook_addons_get_option('dashboard_view_stats') === 'yes') Esb_Class_LStats::set_stats(get_the_ID());
    
    $listing_type_ID = get_post_meta( get_the_ID(), ESB_META_PREFIX.'listing_type_id', true );

    $lcontent = easybook_addons_azp_parser_listing( $listing_type_ID , 'single', get_the_ID() );
    $lcontent = apply_filters( 'azp_single_content', $lcontent );
    echo $lcontent;

    easybook_addons_get_template_part('template-parts/listing-claim-modal');
endwhile;
// end the loop
?>
<div class="limit-box fl-wrap"></div>
<script type="text/template" id="tmpl-custom-get-field"><?php 
    echo easybook_addons_azp_parser_listing( $listing_type_ID  , 'booking_from', get_the_ID() );?>
</script>
<?php 
get_footer(  );