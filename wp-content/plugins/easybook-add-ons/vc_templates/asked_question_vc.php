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


$css = $el_class = $title = $asked_question = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'asked-question',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
$asked_question = vc_param_group_parse_atts($atts['asked_question']);
// var_dump($asked_question);
?>

<div class="<?php echo $css_class;?>">
    <div class="container">
    	<div class="row">
    		<div class="col-md-4">
		        <div class="box-widget-item fl-wrap help-bar">
		            <div class="box-widget">
		                <div class="box-widget-content">
		                    <div class="box-widget-item-header">
		                        <h3><?php echo $title; ?></h3>
		                    </div>
		                    <div class="faq-nav fl-wrap">
		                        <ul id="myUL">
		                            <?php  
		                            foreach ($asked_question as $key => $asked_questiones) {
		                                    $key += 1;
		                                    $asked_class = ($key == 1 ? 'custom-scroll-link act-faq-link' : 'custom-scroll-link');
		                                ?>
		                                <li><a class="<?php echo $asked_class; ?>" href="#faq<?php echo $key;?>"><?php echo $asked_questiones['question_title'];?></a></li>
		                            <?php } ?>
		                        </ul>
		                    </div>
		                    <div class="search-widget">
		                        <form class="fl-wrap">
		                            <input id="myInput" type="text" class="search" placeholder="Enter Keyword" value="">
		                            <button class="search-submit color2-bg" ><i class="fal fa-search transition"></i> </button>
		                        </form>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		    <div class="col-md-8">
		        <div class="asked-question-item">
		             <?php  
		                foreach ($asked_question as $key => $asked_questions) {
		                        $key += 1;	?>
		                <div class="list-single-main-item fl-wrap" id="faq<?php echo $key;?>">
		                    <div class="list-single-main-item-title fl-wrap">
		                        <h3><?php echo $asked_questions['question_title'];?></h3>
		                    </div>
		                    <p><?php echo $asked_questions['content'];?></p>
		                </div>
		            <?php } ?>
		        </div>
		    </div>
    	</div>
    </div>
</div>
<div class="limit-box"></div>

