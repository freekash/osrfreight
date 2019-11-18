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


?>
<!--list-wrap-search   -->
<div class="list-wrap-search fl-wrap lws_mobile listsearch-optiones filter_form_template" id="lisfw">
    <?php do_action( 'easybook_addons_before_filters' ); ?>
    <div class="container">   
        <form id="list-search-page-form" role="search" method="get" action="<?php echo esc_url(home_url( '/' ) ); ?>" class="list-search-page-form">
            <div class="search-opts-wrap fl-wrap">
                <div class="search-opt-wrap-container">
                    <?php 
                       echo easybook_addons_azp_parser_listing( false , 'filter');
                    ?>                          
                </div>
                <div class="search-input-item-foot">
                    <div class="col-list-search-input-item fl-wrap">
                        <button type="submit" class="header-search-button"><?php _e( 'Search ', 'easybook-add-ons' ); ?><i class="far fa-search"></i></button> 
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!--list-wrap-search end -->
