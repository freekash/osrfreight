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


<script type="text/template" id="tmpl-no-results">
    <?php easybook_addons_get_template_part('template-parts/search-no'); ?>
</script>


<script type="text/template" id="tmpl-map-info">
    <div class="map-popup-wrap">
        <div class="map-popup">
            <div class="infoBox-close"><i class="far fa-times"></i></div>
            <a href="{{data.url}}" class="listing-img-content fl-wrap">
                <img src="{{data.thumbnail}}" alt="{{data.title}}">
                <# if(data.price_from_formated){ #>
                    <span class="map-popup-location-price">
                        <?php echo sprintf(
                            __( 'Awg/Night %s', 'easybook-add-ons' ), 
                            '<strong class="per-night-price">{{{data.price_from_formated}}}</strong>'
                        ) ?>
                    </span> 
                <# } #>
            </a> 
            <div class="listing-content fl-wrap">
                <# if(data.rating){ #>
                    <div class="card-popup-rainingvis map-card-rainting" data-starrating2="{{data.rating.sum}}" data-stars="<?php echo esc_attr( easybook_addons_get_option('rating_base') ); ?>"></div>
                <# } #>
                <div class="listing-title fl-wrap">
                    <h4><a href="{{data.url}}">{{{data.title}}}</a></h4> 
                    <# if(data.address){ #>
                        <span class="map-popup-location-info">
                            <i class="fas fa-map-marker-alt"></i>{{{data.address}}}
                        </span> 
                    <# } #>
                </div>
            </div>
        </div>
    </div>
</script>
<div id="ol-popup" class="ol-popup">
    <a href="#" id="ol-popup-closer" class="ol-popup-closer"></a>
    <div id="ol-popup-content"></div>
</div>
<script type="text/template" id="tmpl-onmap-search">
    <input class="controls fl-wrap controls-mapwn pac-input" type="text" placeholder="<?php _e( 'What Nearby? Bar, Gym, Restaurant', 'easybook-add-ons' ); ?>"/>
</script>
<!-- <div className="popup" id="#ctb-view-invoice-modal">
    <div className="popup_inner">
        <button><i className="fal fa-times"></i></button>
        <a href="javascript:window.print()" class="print-button"><?php echo esc_html_e( 'Print this invoice','easybook-add-ons' )?></a>
        <div class="invoice-details-holder"></div>
    </div>
</div> -->
<script type="text/template" id="tmpl-invoice-popup">
    <div class="invoice-box">
       <table>
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="images/logo2.png" style="width:150px; height:auto" alt=""> 
                            </td>
                            <td>
                                Invoice #: 25<br />
                                Created: January 1, 2019<br />
                                Due: February 1, 2019
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                EasyBook , Inc.<br />
                                USA 27TH Brooklyn NY<br />
                                <a href="#"  style="color:#666; text-decoration:none">JessieManrty@domain.com</a>
                                <br />
                                <a href="#" style="color:#666; text-decoration:none">+4(333)123456</a>                                
                            </td>
                            <td>
                                Jessie Manrty<br />
                                <a href="#"  style="color:#666; text-decoration:none">yourmail@domain.com</a>
                                <br />
                                <a href="#"  style="color:#666; text-decoration:none">+7(123)987654</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>
                    Payment Method
                </td>
                <td>
                    Check #
                </td>
            </tr>
            <tr class="details">
                <td>
                    Visa ending **** 4242
                </td>
                <td>
                    Check
                </td>
            </tr>
            <tr class="heading">
                <td>
                    Option
                </td>
                <td>
                    Details
                </td>
            </tr>
            <tr class="item">
                <td>
                    Hotel
                </td>
                <td>
                    Premium Plaza Hotel
                </td>
            </tr>
            <tr class="item">
                <td>
                    Room Type
                </td>
                <td>
                    Standard Family Room $81
                </td>
            </tr>
            <tr class="item ">
                <td>
                    Days 
                </td>
                <td>
                    3
                </td>
            </tr>
            <tr class="item ">
                <td>
                    Persons
                </td>
                <td>
                    3
                </td>
            </tr>
            <tr class="item last">
                <td>
                    Taxes
                </td>
                <td>
                    $12
                </td>
            </tr>
            <tr class="total">
                <td></td>
                <td style="padding-top:50px;"> 
                    Total: $690.00
                </td>
            </tr>
        </table>
    </div>      
</script>


