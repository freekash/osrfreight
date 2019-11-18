<?php
/**
 * @package EasyBook - Hotel & Tour Booking WordPress Theme
 * @author CTHthemes - http://themeforest.net/user/cththemes
 * @date 03-10-2019
 * @since 1.1.7
 * @version 1.1.7
 * @copyright Copyright ( C ) 2014 - 2019 cththemes.com . All rights reserved.
 * @license GNU General Public License version 3 or later; see LICENSE
 */


/**
 * EasyBook: Color Patterns
 */
// https://qiita.com/nanananamememe/items/6bc01e2e02fff8623331
class CTHColorChanger
{
    private $_r = 0, $_g = 0, $_b = 0, $_h = 0, $_s = 0, $_l = 0;

    public function lighten ($color, $lightness)
    {
        $this->setColor($color);
        $l = $this->_l;
        $l += $lightness;
        $this->_l = (100 < $l)?100:$l;
        $this->_getRgb();
        return $this->_decHex($this->_r) .  $this->_decHex($this->_g) .  $this->_decHex($this->_b);
    }

    public function darken ($color, $darkness)
    {
        $this->setColor($color);
        $l = $this->_l;
        $l -= $darkness;
        $this->_l = (0 > $l)?0:$l;
        $this->_getRgb();
        return $this->_decHex($this->_r) .  $this->_decHex($this->_g) .  $this->_decHex($this->_b);
    }

    public function saturate ($color, $per)
    {
        $this->setColor($color);
        $s = $this->_s;
        $s += $per;
        $this->_s = (100 < $s)?100:$s;
        $this->_getRgb();
        return $this->_decHex($this->_r) .  $this->_decHex($this->_g) .  $this->_decHex($this->_b);
    }

    public function desaturate ($color, $per)
    {
        $this->setColor($color);
        $s = $this->_s;
        $s -= $per;
        $this->_s = (0 > $s)?0:$s;
        $this->_getRgb();
        return $this->_decHex($this->_r) .  $this->_decHex($this->_g) .  $this->_decHex($this->_b);
    }

    public function _decHex ($dec)
    {
        return sprintf('%02s', dechex($dec));
    }

    public function adjust_hue($color, $per)
    {
        $this->setColor($color);
        $h = $this->_h;
        $h += $per;
        $this->_h = (360 < $h)?360:$h;
        $this->_getRgb();
        return $this->_decHex($this->_r) .  $this->_decHex($this->_g) .  $this->_decHex($this->_b);
    }

    private function setColor ($color)
    {
        $color = trim($color, '# ');
        $this->_r = hexdec(substr($color, 0, 2));
        $this->_g = hexdec(substr($color, 2, 2));
        $this->_b = hexdec(substr($color, 4, 2));
        $this->_maxRgb = max($this->_r, $this->_g, $this->_b);
        $this->_minRgb = min($this->_r, $this->_g, $this->_b);
        $this->_getHue();
        $this->_getSaturation();
        $this->_getLuminance();
    }

    private function _getHue ()
    {
        $r = $this->_r;
        $g = $this->_g;
        $b = $this->_b;
        $max = $this->_maxRgb;
        $min = $this->_minRgb;
        if ($r === $g && $r === $b) {
            $h = 0;
        } else {
            $mm = $max - $min;
            switch ($max) {
            case $r :
                $h = 60 * ($mm?($g - $b) / $mm:0);
                break;
            case $g :
                $h = 60 * ($mm?($b - $r) / $mm:0) + 120;
                break;
            case $b :
                $h = 60 * ($mm?($r - $g) / $mm:0) + 240;
                break;
            }
            if (0 > $h) {
                $h += 360;
            }
        }
        $this->_h = $h;
    }

    private function _getSaturation ()
    {
        $max = $this->_maxRgb;
        $min = $this->_minRgb;
        $cnt = round(($max + $min) / 2);
        if (127 >= $cnt) {
            $tmp = ($max + $min);
            $s = $tmp?($max - $min) / $tmp:0;
        } else {
            $tmp = (510 - $max - $min);
            $s = ($tmp)?(($max - $min) / $tmp):0;
        }
        $this->_s = $s * 100;
    }

    private function _getLuminance ()
    {
        $max = $this->_maxRgb;
        $min = $this->_minRgb;
        $this->_l = ($max + $min) / 2 / 255 * 100;
    }

    private function _getMaxMinHsl ()
    {
        $s = $this->_s;
        $l = $this->_l;
        if (49 >= $l) {
            $max = 2.55 * ($l + $l * ($s / 100));
            $min = 2.55 * ($l - $l * ($s / 100));
        } else {
            $max = 2.55 * ($l + (100 - $l) * ($s / 100));
            $min = 2.55 * ($l - (100 - $l) * ($s / 100));
        }
        $this->_maxHsl = $max;
        $this->_minHsl = $min;
    }

    private function _getRGB ()
    {
        $this->_getMaxMinHsl();
        $h = $this->_h;
        $s = $this->_s;
        $l = $this->_l;
        $max = $this->_maxHsl;
        $min = $this->_minHsl;
        if (60 >= $h) {
            $r = $max;
            $g = ($h / 60) * ($max - $min) + $min;
            $b = $min;
        } else if (120 >= $h) {
            $r = ((120 - $h) / 60) * ($max - $min) + $min;
            $g = $max;
            $b = $min;
        } else if (180 >= $h) {
            $r = $min;
            $g = $max;
            $b = (($h - 120) / 60) * ($max - $min) + $min;
        } else if (240 >= $h) {
            $r = $min;
            $g = ((240 - $h) / 60) * ($max - $min) + $min;
            $b = $max;
        } else if (300 >= $h) {
            $r = (($h - 240) / 60) * ($max - $min) + $min;
            $g = $min;
            $b = $max;
        } else {
            $r = $max;
            $g = $min;
            $b = ((360 - $h) / 60) * ($max - $min) + $min;
        }
        $this->_r = round($r);
        $this->_g = round($g);
        $this->_b = round($b);
    }
}


if (!function_exists('easybook_hex2rgb')) {
    function easybook_hex2rgb($hex) {
        
        $hex = str_replace("#", "", $hex);
        
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } 
        else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        return $rgb;
    }
}
if (!function_exists('easybook_colourBrightness')) {
    
    /*
     * $hex = '#ae64fe';
     * $percent = 0.5; // 50% brighter
     * $percent = -0.5; // 50% darker
    */
    function easybook_colourBrightness($hex, $percent) {
        
        // Work out if hash given
        $hash = '';
        if (stristr($hex, '#')) {
            $hex = str_replace('#', '', $hex);
            $hash = '#';
        }
        
        /// HEX TO RGB
        $rgb = easybook_hex2rgb($hex);
        
        //// CALCULATE
        for ($i = 0; $i < 3; $i++) {
            
            // See if brighter or darker
            if ($percent > 0) {
                
                // Lighter
                $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1 - $percent));
            } 
            else {
                
                // Darker
                $positivePercent = $percent - ($percent * 2);
                $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1 - $positivePercent));
            }
            
            // In case rounding up causes us to go to 256
            if ($rgb[$i] > 255) {
                $rgb[$i] = 255;
            }
        }
        
        //// RBG to Hex
        $hex = '';
        for ($i = 0; $i < 3; $i++) {
            
            // Convert the decimal digit to hex
            $hexDigit = dechex($rgb[$i]);
            
            // Add a leading zero if necessary
            if (strlen($hexDigit) == 1) {
                $hexDigit = "0" . $hexDigit;
            }
            
            // Append to the hex string
            $hex.= $hexDigit;
        }
        return $hash . $hex;
    }
}
// https://www.ofcodeandcolor.com/cuttle/
/**
 * Change the brightness of the passed in color
 *
 * $diff should be negative to go darker, positive to go lighter and
 * is subtracted from the decimal (0-255) value of the color
 * 
 * @param string $hex color to be modified
 * @param string $diff amount to change the color
 * @return string hex color
 */
function easybook_adjust_hue($hex, $diff) {
    $rgb = str_split(trim($hex, '# '), 2);
    foreach ($rgb as &$hex) {
        $dec = hexdec($hex);
        if ($diff >= 0) {
            $dec += $diff;
        }
        else {
            $dec -= abs($diff);         
        }
        $dec = max(0, min(255, $dec));
        $hex = str_pad(dechex($dec), 2, '0', STR_PAD_LEFT);
    }
    return '#'.implode($rgb);
}
if (!function_exists('easybook_bg_png')) {
    function easybook_bg_png($color, $input, $output) {
        $image = imagecreatefrompng($input);
        $rgbs = easybook_hex2rgb($color);
        $background = imagecolorallocate($image, $rgbs[0], $rgbs[1], $rgbs[2]);
        
        imagepng($image, $output);
    }
}

if (!function_exists('easybook_stripWhitespace')) {
    
    /**
     * Strip whitespace.
     *
     * @param  string $content The CSS content to strip the whitespace for.
     * @return string
     */
    function easybook_stripWhitespace($content) {
        
        // remove leading & trailing whitespace
        $content = preg_replace('/^\s*/m', '', $content);
        $content = preg_replace('/\s*$/m', '', $content);
        
        // replace newlines with a single space
        $content = preg_replace('/\s+/', ' ', $content);
        
        // remove whitespace around meta characters
        // inspired by stackoverflow.com/questions/15195750/minify-compress-css-with-regex
        $content = preg_replace('/\s*([\*$~^|]?+=|[{};,>~]|!important\b)\s*/', '$1', $content);
        $content = preg_replace('/([\[(:])\s+/', '$1', $content);
        $content = preg_replace('/\s+([\]\)])/', '$1', $content);
        $content = preg_replace('/\s+(:)(?![^\}]*\{)/', '$1', $content);
        
        // whitespace around + and - can only be stripped in selectors, like
        // :nth-child(3+2n), not in things like calc(3px + 2px) or shorthands
        // like 3px -2px
        $content = preg_replace('/\s*([+-])\s*(?=[^}]*{)/', '$1', $content);
        
        // remove semicolon/whitespace followed by closing bracket
        $content = preg_replace('/;}/', '}', $content);
        
        return trim($content);
    }
}

if (!function_exists('easybook_add_rgba_background_inline_style')) {
    function easybook_add_rgba_background_inline_style($color = '#ed5153', $handle = 'skin') {
        $inline_style = '.testimoni-wrapper,.pricing-wrapper,.da-thumbs li  article,.team-caption,.home-centered{background-color:rgba(' . implode(",", hex2rgb($color)) . ', 0.9);}';
        wp_add_inline_style($handle, $inline_style);
    }
}

function easybook_custom_fonts(){
    $css = '';
    if(easybook_get_option('use_custom_fonts')){
        $body_font = easybook_get_option('body-font');
        if(!empty($body_font['font-family'])) 
            $css .= 'body, .custom-form  input::-webkit-input-placeholder , .custom-form  textarea::-webkit-input-placeholder {font-family: '.$body_font['font-family'].'}';
        $heading_font = easybook_get_option('heading-font');
        if(!empty($heading_font['font-family'])) 
            $css .= 'h1,h2,h3,h4,h5,h6{font-family: '.$heading_font['font-family'].'}';
        $paragraph_font = easybook_get_option('paragraph-font');
        if(!empty($paragraph_font['font-family'])) 
            $css .= 'p{font-family: '.$paragraph_font['font-family'].'}';
        $bold_font = easybook_get_option('theme-bolder-font');
        if(!empty($bold_font['font-family'])) 
            $css .= '.main-register h3 span,.images-collage-title,.footer-menu  li a,.error-wrap h2,.cs-countdown-item span{font-family: '.$bold_font['font-family'].'}';
        $italic_font = easybook_get_option('theme-italic-font');
        if(!empty($italic_font['font-family'])) 
            $css .= 'blockquote p,.price-num-desc,.testimonilas-text p,.testimonilas-text li a,.footer-widget .about-widget h4,.video-item p{font-family: '.$italic_font['font-family'].'}';
    }
    return $css;
}

function easybook_color_basic(){
    $css = 'body{background-color: '.easybook_get_option('main-bg-color').';}';
    $css .= '.loader-wrap{background-color: '.easybook_get_option('loader-bg-color').';}';
    $css .= 'body{color: '.easybook_get_option('body-text-color').';}';
    $css .= 'p{color: '.easybook_get_option('paragraph-color').';}';
    $css .= 'a{color: '.easybook_get_option('link_color').';}a:hover{color: '.easybook_get_option('link_hover_color').';}a:active,a:focus{color: '.easybook_get_option('link_active_color').';}';
    $css .= 'header.main-header{color: '.easybook_get_option('header-text-color').';background-color: '.easybook_get_option('header-bg-color').';}';
    $css .= '.nav-holder nav li ul{background-color: '.easybook_get_option('submenu-bg-color').';}';
    $css .= '.nav-holder nav li a{color: '.easybook_get_option('mainmenu_color').';}';
    $css .= '.nav-holder nav li a:hover{color: '.easybook_get_option('mainmenu_hover_color').';}';
    $css .= '.nav-holder nav li a:active,.nav-holder nav li a:focus, .nav-holder nav li.current-menu-ancestor > a, .nav-holder nav li.current-menu-parent > a,.nav-holder nav li.current-menu-item > a{color: '.easybook_get_option('mainmenu_active_color').';}';
    $css .= '.nav-holder nav li ul a{color: '.easybook_get_option('submenu_color').';}';
    $css .= '.nav-holder nav li ul a:hover{color: '.easybook_get_option('submenu_hover_color').';}';
    $css .= '.nav-holder nav li ul li a:active,.nav-holder nav li ul li a:focus,.nav-holder nav li ul li.current-menu-ancestor > a,.nav-holder nav li ul li.current-menu-parent > a,.nav-holder nav li ul li.current-menu-item > a{color: '.easybook_get_option('submenu_active_color').';}';
    $css .= 'footer.easybook-footer{background-color: '.easybook_get_option('footer-bg-color').';}';
    $css .= 'footer.easybook-footer,.footer-counter,.footer-social li a{color: '.easybook_get_option('footer-text-color').';}';
    $css .= '.sub-footer{background-color: '.easybook_get_option('subfooter-bg-color').';}';

    return $css;
}

if (!function_exists('easybook_overridestyle')) {
    function easybook_overridestyle() {

        $theme_color_opt = easybook_get_option('theme-color');

        $colorChanger = new CTHColorChanger();

        $gradient_light = '#'.$colorChanger->saturate($colorChanger->darken($colorChanger->desaturate($colorChanger->adjust_hue($theme_color_opt,-7.9140), 1.1173), 0.5882), 3);
        
        $gradient_dark = '#'.$colorChanger->darken($colorChanger->desaturate($colorChanger->adjust_hue($theme_color_opt,2.0055), 0.9340), 3.1373);


        $second_color = easybook_get_option('theme-color-second'); 

        $third_color = easybook_get_option('theme-color-third');

        $darker_color = '#'.$colorChanger->darken( $theme_color_opt, 30);
        $lighter_color = '#'.$colorChanger->lighten( $theme_color_opt, 10);

    	$inline_style = '
.listing-feature-wrap input[type="checkbox"]:checked:after, .listing-feature-wrap input[type="radio"]:checked:after,
.add-feature-checkbox input[type="checkbox"]:checked:after,
.add-feature-radio input[type="radio"]:checked:after,
.listing-features-loader,
.account-box a,
.comment-date i,
.pager a i,
.sticky .list-single-main-item-title h3 a,
.info-button:hover, .footer-social li a, .lost_password a:hover, .nav-holder nav li a.act-link, .nav-holder nav li a:hover, .testi-text:before, .testi-text:after, .easybook-tweet .timePosted a:before, .map-popup-contact-infos i, .dark-header .nav-holder nav li ul a:hover, .main-register h3 span strong, .main-register label i, .listsearch-header h3 span, .listing-view-layout li a.active, .listsearch-input-text label i, .distance-title i, .listsearch-input-item i, .filter-tags input:checked:after, .more-filter-option:hover, .distance-title span, .selectbox li.selected, .mapzoom-in:hover, .mapzoom-out:hover, .footer-widget .widget-posts-date, .listsearch-input-text span.loc-act, .list-single-header-contacts li i, .viewed-counter i, .list-single-header-column .custom-scroll-link i, .list-single-header-cat span i, .scroll-nav-wrapper .scroll-nav li a.act-scrlink, .listing-features li i, .list-author-widget-contacts li span i, .list-author-widget-contacts li a:hover, .current-status i, .scroll-nav-wrapper .save-btn i, .list-single-contacts li i, .list-post-counter.single-list-post-counter i, .reviews-comments-item-date i,
.list-single-main-item-title span,
.section-title-left span,
.custom-form label i, .custom-form .quantity span i, .box-widget .widget-posts .widget-posts-date i, .box-widget .widget-posts .widget-posts-descr a:hover, .team-social li a, .team-info h3 a:hover, .section-title h2 a, section.color-bg .header-sec-link a:hover, .user-profile-menu li a.user-profile-act, .user-profile-menu li a.active, .user-profile-menu li a:hover, .log-out-btn, .pass-input-wrap span, .header-user-name:before, .header-user-menu ul li a:hover, .reply-mail a, .dashboard-message-text h4 span, .profile-edit-page-header .breadcrumbs span, .profile-edit-page-header .breadcrumbs a:hover, .reviews-comments-item-link, .fuzone:hover .fu-text i, .radio input[type="radio"]:checked + span:before,
.booking-details a, .booking-details span.booking-text,
.message-details a, .message-details span.msg-text,
.dashboard-listing-table-address i, .post-opt li i, .list-single-main-item-title h3 a:hover, .post-opt li a:hover, .post-link i, .post-link:hover, .tl-text i, .tl-text h3, .features-box .time-line-icon i, .features-box h3, .images-collage-title span, .process-item .time-line-icon i, .card-post-content h3 a:hover, .card-listing .list-post-counter i, .section-subtitle, .process-item:hover .process-count, .footer-contacts li i, .main-search-input-item.location a, .card-listing .geodir-category-location i, .show-reg-form:hover, .show-search-button i, .menusb li a i, .menusb a.back:before, .menusb a.act-link, .sp-cont, .list-single-tags a:hover, .card-listing .geodir-category-content h3 a:hover, .easybook-tweet a:hover, .subscribe-message.error a, .share-holder.hid-share .share-container .share-icon, .footer-contacts li a:hover, .listing-title a:hover,
.listings-loader,
.no-results-search a,
.nav-holder nav li.current-menu-item > a,
.nav-holder nav li.current-menu-parent > a,
.nav-holder nav li.current-menu-ancestor > a,
.logo-text h2,
.claim-widget-link a,
.claim-success,
.sidebar-ad-widget .list-post-counter i,
.sidebar-ad-widget .geodir-category-location i ,
.sidebar-ad-widget .geodir-category-content h3 a:hover,
.attr-nav .cart-link:hover,
ul.cart_list li .quantity .amount, .body-easybook ul.product_list_widget li .quantity .amount,
ul.cart_list li a:hover, .body-easybook ul.product_list_widget li a:hover,


.au-name-li .au-role,
.wkhour-opening,
.mb-open-filter:hover,
.mb-open-filter.active,
span.viewed-count,
.single-event-date,
.remove-date-time i,
.flatWeatherPlugin ul.wiForecasts li.wi,
.total-cost-input,
.wpml-ls-legacy-dropdown-click a.wpml-ls-item-toggle:after,
.wpml-ls-legacy-dropdown a.wpml-ls-item-toggle:after
{
  color: '.$theme_color_opt.'; 
}

.tagcloud a,
.navslide-wrap, .slide-progress, nav li a.act-link:before, .hs-nav .navslide-wrap.next-slide-wrap a, .folio-counter, .add-list, .section-separator:before,
.listing-carousel-wrap .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active, .card-btn:hover, .footer-widget #subscribe-button,
.custom-form .log-submit-btn, .add-list, .parallax-section .section-separator:before, .sw-btn, .color-bg, .mapzoom-in, .mapzoom-out, .infoBox-close,
.ctb-modal-close, .header-search-button, .listing-view-layout li a, .listsearch-input-item .selectbox, .rangeslider__fill, .fs-map-btn, .lfilter-submit, .more-filter-option span,
.back-to-filters, .back-to-filters span, .pin, .load-more-button, .footer-menu li:before,
.pagination a.current-page, .pagination a:hover, .pagination .nav-links > span.current, .section-title .breadcrumbs a:before,
.showshare, .scroll-nav-wrapper .scroll-nav li a:before, .list-single-main-wrapper .breadcrumbs, .list-widget-social li a,
.btn.transparent-btn:hover, .btn.flat-btn, .accordion a.toggle.act-accordion, .custom-form .quantity input.qty, .widget-posts-link span,
.box-item a.gal-link, .custom-form .selectbox, .photoUpload, .user-profile-menu li a span, .tabs-menu li.current a, .tabs-menu li a:hover,
.header-social li a:hover, .main-search-button, .selectbox li:hover, .color-overlay, .trs-btn, .testi-counter, .to-top, .header-sec-link a,
.card-btn, .profile-edit-page-header .breadcrumbs a:before, .dashboard-listing-table-opt li a.del-btn, .widget_search .search-submit,
.box-widget-item .list-single-tags a, .reviews-comments-item-text .new-dashboard-item:hover, .step-item, .video-box-btn, .slick-dots li.slick-active button,
.time-line-container:before, .error-wrap form .search-submit, .testimonials-carousel .slick-current .testimonilas-text, .cs-social li a,
.cs-countdown-item:before, .listing-counter, .price-head, .price-link, .sp-cont:hover, .cluster div, .lg-actions .lg-next, .lg-actions .lg-prev,
.log-out-btn:hover, .map-popup-category, .mapnavigation a:hover,
.addfield,
.list-author-widget-socials a,
.nav-holder nav li.current-menu-item > a:before,
.nav-holder nav li.current-menu-parent > a:before,
.nav-holder nav li.current-menu-ancestor > a:before,
.author-social a,
.subscribe-form .subscribe-button,
.protected-wrap input[type="submit"] ,


.listsearch-input-item .nice-select , 
.listsearch-input-item .nice-select .list li.selected.focus ,  
.listsearch-input-item .nice-select .list li:hover ,  
.listsearch-input-item .nice-select .list li.selected , 
.custom-form .nice-select .list li:hover , 
.custom-form .nice-select .list li.selected , 
.custom-form .nice-select , .header-search-select-item .nice-select .list li:hover , 
.header-search-select-item .nice-select .list li.selected , 
.main-search-input-item  .nice-select .list li:hover , 
.main-search-input-item  .nice-select .list li.selected , 
.pac-item:hover,
.listing-verified,
.tooltipwrap .tooltiptext,
.cart-count,
.mb-btns-wrap,
.mb-open-filter,
.remove-date-time:hover,
.sw-btn.swiper-button-prev,
.sw-btn.swiper-button-next,
.available-cal-months .cal-date-checked
{
  background: '.$theme_color_opt.'; 
}
.available-cal-months .cal-date-checked:hover{
    background: '.$darker_color.'; 
}
.available-cal-months .cal-date-inside {
    background: '.$lighter_color.';
}
.tooltipwrap .tooltiptext:after{border-color: '.$theme_color_opt.' transparent transparent transparent;}
.pulse:after {
	-webkit-box-shadow: 0 0 1px 3px '.$theme_color_opt.';
    box-shadow: 0 0 1px 3px '.$theme_color_opt.';
}

.listing-view-layout li a.active, .rangeslider__handle, .list-author-widget-text .btn, .btn.transparent-btn, .log-out-btn, blockquote, .cluster div:before,
.header-search-select-item .nice-select:after, 
.main-search-input-item  .nice-select:after ,
.mb-open-filter:hover,
.mb-open-filter.active
 {
  border-color: '.$theme_color_opt.'; }
.selectbox .trigger .arrow
{
	border-top: 5px solid '.$theme_color_opt.';
}
.listing-rating i {
  color: #FACC39; }

.gradient-bg,
.listing-geodir-category,
.list-single-header-cat a,
.box-widget-item .list-single-tags a:hover,
.nav-holder nav li a:before,
.tagcloud a:hover {
  background-color: '.$gradient_dark.';
  background: -webkit-gradient(linear, 0% 0%, 0% 100%, from('.$gradient_dark.'), to('.$gradient_light.'));
  background: -webkit-linear-gradient(top, '.$gradient_dark.', '.$gradient_light.');
  background: -o-linear-gradient(top, '.$gradient_dark.', '.$gradient_light.'); }

.slick-carouse-wrap .swiper-button-next,
.slick-carouse-wrap .swiper-button-prev,

.onoffswitch-inner:before,
.onoffswitch-inner:after
{ background-color: '.$theme_color_opt.'; }
.testimonilas-avatar-item:before {border-top-color: '.$theme_color_opt.';}
.process-end i,.best-price .price-head,
.notification.success,.new-dashboard-item,.you-booked,
.dashboard-listing-table-opt li a,
.package-status,
.ad-status,
#submit-listing-message.success,
.easybook-lang-switcher .wpml-ls-legacy-dropdown-click .wpml-ls-sub-menu a:hover,
.easybook-lang-switcher .wpml-ls-legacy-dropdown .wpml-ls-sub-menu a:hover
{background-color: '.$second_color.';}
.profile-edit-header h4 span,.recomm-price i,
.opening-hours .current-status,
.pricerange,
.list-single-header-item h2 a,
.item-ad
{color: '.$second_color.';}
.recomm-price i,
.item-ad
{border-color: '.$second_color.';}
.you-booked,
.btn.delete-bookmark-btn:hover,
.btn.delete-bookmark-btn-clicked:hover,
.mapzoom-in:hover,
.mapzoom-out:hover,
.soc-log a:hover,
.ctb-modal-close:hover,
.custom-form .log-submit-btn:hover,
.custom-form .log-submit-btn:disabled,
.listing-claim-form #lclaim-submit:disabled,
.stripe-plan-submit:hover,
.dark-header,
.btn.color-bg:hover,
.btn:disabled,
.btn.flat-btn:disabled,
#edit-profile-submit.disabled,
#change-pass-submit.disabled
{background-color: '.$third_color.';}

.body-easybook div.datedropper.primary .pick-lg-b .pick-sl:before,
.body-easybook div.datedropper.primary .pick-lg-h,
.body-easybook div.datedropper.primary .pick-m,
.body-easybook div.datedropper.primary .pick-submit,
.body-easybook div.datedropper.primary:before{
    background-color:'.$theme_color_opt.'
}
.body-easybook div.datedropper.primary .pick li span,
.body-easybook div.datedropper.primary .pick-btn,
.body-easybook div.datedropper.primary .pick-lg-b .pick-wke,
.body-easybook div.datedropper.primary .pick-y.pick-jump{
    color:'.$theme_color_opt.'
}
.body-easybook .td-clock{box-shadow:0 0 0 1px '.$theme_color_opt.',0 0 0 8px rgba(0,0,0,.05);}
.body-easybook .td-clock:before{border-left:1px solid '.$theme_color_opt.';border-top:1px solid '.$theme_color_opt.';}
.body-easybook .td-select:after{box-shadow:0 0 0 1px '.$theme_color_opt.';}
.body-easybook .td-clock .td-time span.on{color:'.$theme_color_opt.'}


.body-easybook span.onsale {
  background: '.$theme_color_opt.'; }

.body-easybook a.button,
.body-easybook button.button {
  color: '.$theme_color_opt.';
  border-color: '.$theme_color_opt.'; }
  .body-easybook a.button:hover,
  .body-easybook a.button:focus,
  .body-easybook button.button:hover,
  .body-easybook button.button:focus {
    background: '.$theme_color_opt.';
    color: #fff;
    border-color: '.$theme_color_opt.'; }

.body-easybook ul.products li.product a:hover {
  color: '.$theme_color_opt.'; }

.body-easybook ul.products li.product .onsale {
  background: '.$theme_color_opt.'; }

.body-easybook ul.products li.product .cth-add-to-cart a {
  background: '.$theme_color_opt.';
  border-color: '.$theme_color_opt.'; }
  .body-easybook ul.products li.product .cth-add-to-cart a:hover {
    background: '.$third_color.';
    border-color: '.$third_color.'; }
  .body-easybook ul.products li.product .cth-add-to-cart a.added_to_cart {
    background: transparent;
    color: '.$theme_color_opt.'; }
    .body-easybook ul.products li.product .cth-add-to-cart a.added_to_cart:hover {
      border-color: '.$theme_color_opt.'; }
.body-easybook .woocommerce-mini-cart__buttons .button {
  background: '.$theme_color_opt.';
  border-color: '.$theme_color_opt.'; }
  .body-easybook .woocommerce-mini-cart__buttons .button:hover {
    background: '.$third_color.';
    border-color: '.$third_color.';
    color: #fff; }
  .body-easybook .woocommerce-mini-cart__buttons .button.checkout {
    color: '.$theme_color_opt.'; }
    .body-easybook .woocommerce-mini-cart__buttons .button.checkout:hover {
      background: '.$theme_color_opt.';
      color: #fff;
      border-color: '.$theme_color_opt.'; }
.body-easybook nav.woocommerce-pagination .page-numbers:hover,
.body-easybook nav.woocommerce-pagination .page-numbers.current {
  background: '.$theme_color_opt.';
  border-color: '.$theme_color_opt.';
  color: #fff; }
.body-easybook ul.products li.product .price,
.body-easybook div.product .price {
  color: '.$theme_color_opt.'; }
.body-easybook #respond input#submit,
.body-easybook a.button.alt,
.body-easybook button.button.alt,
.body-easybook input.button.alt {
  color: #fff;
  background: '.$theme_color_opt.'; }
  .body-easybook #respond input#submit:hover,
  .body-easybook #respond input#submit:focus,
  .body-easybook a.button.alt:hover,
  .body-easybook a.button.alt:focus,
  .body-easybook button.button.alt:hover,
  .body-easybook button.button.alt:focus,
  .body-easybook input.button.alt:hover,
  .body-easybook input.button.alt:focus {
    background: '.$third_color.';
    border-color: '.$third_color.'; }
.body-easybook .woocommerce-info,
.body-easybook .woocommerce-message {
  border-top-color: '.$theme_color_opt.'; }
  .body-easybook .woocommerce-info:before,
  .body-easybook .woocommerce-message:before {
    color: '.$theme_color_opt.'; }
.body-easybook .widget_price_filter .price_slider_wrapper .ui-widget-content {
  background-color: '.$third_color.'; }
.body-easybook .widget_price_filter .ui-slider .ui-slider-range,
.body-easybook .widget_price_filter .ui-slider .ui-slider-handle {
  background-color: '.$theme_color_opt.'; }
.body-easybook .box-widget .woocommerce-Price-amount {
  color: '.$theme_color_opt.'; }
section.products > h2:after {
  background: '.$theme_color_opt.'; }
.products > h2,
.wc-tab > h2,
.body-easybook div.product .product_title,
.woocommerce-Reviews-title,
.easybook-lang-switcher .wpml-ls-legacy-list-vertical a:hover,
.easybook-lang-switcher .wpml-ls-legacy-list-vertical .wpml-ls-current-language a,
.easybook-lang-switcher .wpml-ls-legacy-list-horizontal a:hover,
.easybook-lang-switcher .wpml-ls-legacy-list-horizontal .wpml-ls-current-language a,
.cth-daterange-picker .lfield-icon i:before,
.tpick-icon,
.bkdates-date-detail strong
 { color: '.$third_color.'; }
.woocommerce-product-search button {
  background: '.$theme_color_opt.'; }
  .woocommerce-product-search button:hover {
    background: '.$third_color.'; }
.mb-btn:hover,
input:checked + .switchbtn-labelr,
.cth-dropdown-options input[type=checkbox]:checked+label,
.count-select-ser{
    background: '.$third_color.';
}
';   
        // for custom color
        $inline_style .= easybook_color_basic();
        // Remove whitespace
        $inline_style = easybook_stripWhitespace($inline_style);
        
        return $inline_style;
    }
}


