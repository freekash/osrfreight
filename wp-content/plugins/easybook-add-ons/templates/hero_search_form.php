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


if(!isset($hide_text_field)) $hide_text_field = 'yes';
if(!isset($for_jstmpl)) $for_jstmpl = 'no';
?>
<div class="main-search-form-wrap">
    <form role="search" method="get" action="<?php echo esc_url(home_url( '/' ) ); ?>" class="main-search-form">
        <?php 
            echo easybook_addons_azp_parser_listing( false , 'filter_herosec');
        ?>   
    </form>
</div>