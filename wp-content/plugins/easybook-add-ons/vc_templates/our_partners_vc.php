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


$css = $el_class = $partnerimgs = $links = $is_external = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'fl-wrap spons-list',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
$target = ($is_external == 'yes') ? ' target="_blank"' : '';
?>
<?php if(!empty($partnerimgs)){
    $partners = $partnerlinks = array();
    $partners = explode(",", $partnerimgs);
    if(!empty($links)){
        $seppos = strpos(strip_tags($links), "|");
        if($seppos !== false){
            $partnerlinks = explode("|", strip_tags($links));
        }else{
            $partnerlinks = preg_split( '/\r\n|\r|\n/', strip_tags($links) );
        }
    }
?>
    <div class="<?php echo esc_attr($css_class );?>">
        <ul class="client-carousel">
            <?php 
            // var_dump($partners);
            foreach ($partners as $key => $img) {
                $img_post = get_post($img);
                $link = isset($partnerlinks[$key])? esc_url($partnerlinks[$key] ) : 'javascript:void(0)'; ?>
                <li>
                    <a href="<?php echo $link; ?>" <?php echo $target; ?>>
                        <?php echo wp_get_attachment_image( $img,  'partner' ); ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
        <div class="sp-cont sp-cont-prev"><i class="fa fa-angle-left"></i></div>
        <div class="sp-cont sp-cont-next"><i class="fa fa-angle-right"></i></div>
    </div>

<?php } ?>

