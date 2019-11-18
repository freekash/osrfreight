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
$filter_wrap_cl = '';
switch (easybook_addons_get_option('map_pos')) { 
    case 'left':
        $map_wrap_cl = 'listings-has-map column-map left-pos-map fix-map hid-mob-map';   
        $list_wrap_cl = 'right-list';
        $filter_wrap_cl = 'right-filter';
        break;
    case 'right':
        $map_wrap_cl = 'listings-has-map column-map right-pos-map fix-map hid-mob-map';
        $list_wrap_cl = 'left-list';
        break;
    case 'top':
        $map_wrap_cl = 'listings-has-map fw-map top-post-map big_map hid-mob-map'; 
        $list_wrap_cl = 'fh-col-list-wrap left-list';
        break;
    default:
        $map_wrap_cl = 'listings-has-map column-map right-pos-map fix-map hid-mob-map'; 
        $list_wrap_cl = 'fh-col-list-wrap left-list fh-col-list-wrap fh-col-list-wrap left-list fix-mar-map'; 
        break;
}
if(easybook_addons_get_option('filter_pos') == 'left_col'){
    $map_wrap_cl .= ' map-lcol-filter';
    $list_wrap_cl .= ' list-lcol-filter';
}

$search_term_title = post_type_archive_title('', false);
if( is_tax('listing_cat') || is_tax('listing_feature') || is_tax('listing_location') || is_tax('listing_tag') ) $search_term_title =  single_term_title( '', false );
if( isset($_GET['search_term']) && $_GET['search_term'] != '' ) $search_term_title = $_GET['search_term'];
$search_term_title = apply_filters( 'cth_search_results_text', $search_term_title );
?>
<div class="listing-search-template listings-grid-wrap <?php echo easybook_addons_get_option('columns_grid') ?>-cols clearfix">
   <?php 
    if(easybook_addons_get_option('map_pos') != 'hide'): ?>
    <div class="map-container <?php echo esc_attr( $map_wrap_cl ); ?>">
        <?php if(easybook_addons_get_option('use_osm_map') == 'yes'): ?>
            <div id="map-osm-main"></div>
        <?php else: ?>
            <div id="map-main"></div>
            <ul class="mapnavigation">
                <li><a href="#" class="prevmap-nav"><?php esc_html_e( 'Prev', 'easybook-add-ons' ); ?></a></li>
                <li><a href="#" class="nextmap-nav"><?php esc_html_e( 'Next', 'easybook-add-ons' ); ?></a></li>
            </ul>
            <div class="map-close"><i class="fas fa-times"></i></div>
            
        <?php endif; ?>
    </div>
    <!-- Map end -->  
    <?php endif; ?>
    <?php if(easybook_addons_get_option('filter_pos') == 'left_col'): ?>
    <div class="col-filter-wrap col-filter <?php echo esc_attr( $filter_wrap_cl ); ?>">
        <div class="container">
            <div class="mobile-list-controls fl-wrap">
                <div class="container">
                    <div class="mlc show-hidden-column-map schm"><i class="fal fa-map-marked-alt"></i><?php esc_html_e( ' Show Map', 'easybook-add-ons' ); ?></div>
                    <div class="mlc show-list-wrap-search"><i class="fal fa-filter"></i><?php esc_html_e( ' Filter', 'easybook-add-ons' ); ?></div>
                </div>
            </div>
            <div class="fl-wrap listing-search-sidebar">
                <?php easybook_addons_get_template_part('templates/filter_form'); ?>
            </div>
        </div>
    </div>
    <?php endif; ?> 

    <!--col-list-wrap -->   
    <div class="col-list-wrap col-list-wrap-main <?php echo esc_attr( $list_wrap_cl ); ?>">
        <?php if(easybook_addons_get_option('filter_pos') == 'top'): ?>
        <div class="mobile-list-controls top-filter-mobile-wrap fl-wrap">
            <div class="container">
                <?php if (easybook_addons_get_option('map_pos') != 'hide') {?>
                    <div class="mlc show-hidden-column-map schm"><i class="fal fa-map-marked-alt"></i><?php esc_html_e( ' Show Map', 'easybook-add-ons' ); ?></div>
                    <div class="mlc show-list-wrap-search"><i class="fal fa-filter"></i><?php esc_html_e( ' Filter', 'easybook-add-ons' ); ?></div>
                <?php }else{?>
                     <div class="mlc show-list-wrap-search fl-wrap"><i class="fal fa-filter"></i><?php esc_html_e( ' Filter', 'easybook-add-ons' ); ?></div>
                <?php } ?>
            </div>
        </div>
        <div class="fl-wrap top-filter-wrap" id="lisfw" >
            <?php easybook_addons_get_template_part('templates/filter_form'); ?>
        </div>
        <?php elseif(easybook_addons_get_option('filter_pos') == 'left_col'): ?>
        <div class="fl-wrap left-filter-mobile-wrap" id="lisfw">
            <div class="container">
                <div class="mobile-list-controls fl-wrap">
                    <div class="container">
                        <div class="mlc show-hidden-column-map schm"><i class="fal fa-map-marked-alt"></i><?php esc_html_e( ' Show Map', 'easybook-add-ons' ); ?></div>
                        <div class="mlc show-list-wrap-search"><i class="fal fa-filter"></i><?php esc_html_e( ' Filter', 'easybook-add-ons' ); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <!-- list-main-wrap-->
        <div class="list-main-wrap fl-wrap card-listing">
            <!-- <a class="custom-scroll-link back-to-filters btf-l" href="#lisfw"><?php _e( '<i class="fa fa-angle-double-up"></i><span>Back to Filters</span>', 'easybook-add-ons' ); ?></a>  -->
            <div class="container"> 
                <div class="row">
                    <?php 
                    if(easybook_addons_get_option('filter_pos') == 'left'):?>
                    <div class="col-md-4">
                        <div class="fl-wrap listing-search-sidebar">
                            <?php easybook_addons_get_template_part('templates/filter_form'); ?>
                        </div>
                    </div>
                    <?php endif;?>
                    <?php 
                    if(easybook_addons_get_option('filter_pos') == 'left'||easybook_addons_get_option('filter_pos') == 'right'):?>
                    <div class="col-md-8">
                    <?php else : ?>
                    <div class="col-md-12">
                    <?php endif;?>
                        <div class="listsearch-header list-main-wrap-titles fl-wrap listsearch-header-sidebar list-search-tax">
                            <h1 class="head-sec-title"><?php printf( esc_html__( 'Results for: %s', 'easybook-add-ons' ), '<span>' . $search_term_title . '</span>' ); ?></h1>
                            
                            <div class="listing-view-layout">
                                <ul>
                                    <li><a class="grid<?php if(easybook_addons_get_option('listings_grid_layout')=='grid') echo ' active';?>" href="#"><i class="fa fa-th-large"></i></a></li>
                                    <li><a class="list<?php if(easybook_addons_get_option('listings_grid_layout')=='list') echo ' active';?>" href="#"><i class="fa fa-list-ul"></i></a></li>
                                    <?php if(easybook_addons_get_option('map_pos') == 'left'||easybook_addons_get_option('map_pos') == 'right'): ?>
                                    <li><a href="#" class="expand-listing-view"><i class="fa fa-expand"></i></a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <?php if( is_tax('listing_cat') || is_tax('listing_feature') || is_tax('listing_location') || is_tax('listing_tag') ): ?><div class="listing-term-desc"><?php echo term_description( ) ?></div><?php endif; ?>
                        </div>
                        <?php

                        echo easybook_addons_get_option('search_infor_before');

                        easybook_addons_get_template_part('templates/loop'); 

                        echo easybook_addons_get_option('search_infor_after');

                        ?>
                    </div>
                    <!-- end col-md-8 -->
                    <?php 
                    if(easybook_addons_get_option('filter_pos') == 'right'):?>
                    <div class="col-md-4">
                        <div class="fl-wrap listing-search-sidebar">
                            <?php easybook_addons_get_template_part('templates/filter_form'); ?>
                        </div>
                    </div>
                    <?php endif;?>

                </div> 
                <!-- end row -->
            </div>
            <!-- end container -->
            
        </div>
        <!-- list-main-wrap end-->
    </div>
    <!--col-list-wrap -->  
</div>
<!-- listings-grid-wrap -->  
<div class="limit-box fl-wrap"></div>

<?php // easybook_addons_get_template_part('templates/tmpls'); ?>
<?php
get_footer(  );