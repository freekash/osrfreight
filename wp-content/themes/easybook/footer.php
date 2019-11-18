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
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */

                do_action( 'easybook_footer_before');
?>
                </div>
                <!-- Content end -->
            </div>
            <!-- wrapper end -->
            <!--footer -->
            <footer class="easybook-footer main-footer dark-footer  ">  
                <?php if (easybook_get_option( 'show_subscribe' ) == 'yes'):?>
                    <!--subscribe-wrap-->
                    <div class="subscribe-wrap color-bg  fl-wrap">
                        <div class="container">
                            <div class="sp-bg"></div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="subscribe-header">
                                       <?php echo wp_kses_post( easybook_get_option( 'footer_subscribe' ) ); ?>
                                    </div>
                                </div>
                                <div class="col-sm-0 col-md-1"></div>
                                <div class="col-sm-12 col-md-5">
                                    <div class="footer-widget fl-wrap">
                                        <div class="subscribe-widget fl-wrap">
                                            <div class="subcribe-form">
                                               <?php echo do_shortcode(easybook_check_shortcode('[easybook_subscribe]', 'easybook_subscribe')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wave-bg"></div>
                    </div>
                    <!--subscribe-wrap end -->
                <?php 
                endif;
                $footer_widgets = easybook_get_option('footer_widgets_top',array());
                // var_dump($footer_widgets);
                if ($footer_widgets ) {
                ?>
                    <div class="container footer_widgets_top">
                        <div class="row">
                            <?php
                                foreach ($footer_widgets as $widget) {
                                    if($widget['title']&&$widget['classes']){
                                        if(is_active_sidebar($widget['widid'])){
                                            echo '<div class="dynamic-footer-widget '.esc_attr($widget['classes'] ).'">';
                                                dynamic_sidebar($widget['widid']);
                                            echo '</div>';
                                        }
                                    }
                                }
                            ?>
                    </div>
                </div>
                <?php
                }
                ?>
                <?php 
                $footer_widgets = easybook_get_option('footer_widget',array());
                $has_active_fw = false;
                if ($footer_widgets ) {
                ?>
                <div class="container footer_widget">
                    <div class="row fwids-row"><?php
                        foreach ($footer_widgets as $widget) {
                            if($widget['title']&&$widget['classes']){
                                if(is_active_sidebar($widget['widid'])){
                                    echo '<div class="dynamic-footer-widget '.esc_attr($widget['classes'] ).'">';
                                        dynamic_sidebar($widget['widid']);
                                    echo '</div>';
                                    $has_active_fw = true;
                                }
                            }
                        }
                    ?></div>
                </div>
                <?php
                }
                ?>
                <?php 
                $footer_widgets = easybook_get_option('footer_widgets_bottom',array());
                // var_dump($footer_widgets);
                if ($footer_widgets ) {
                ?>
                    <div class="container footer_widgets_bottom">
                        <div class="row">
                            <?php
                                foreach ($footer_widgets as $widget) {
                                    if($widget['title']&&$widget['classes']){
                                        if(is_active_sidebar($widget['widid'])){  
                                            echo '<div class="dynamic-footer-widget '.esc_attr($widget['classes'] ).'">';
                                                dynamic_sidebar($widget['widid']);
                                            echo '</div>';
                                        }

                                    }
                                }
                            ?>
                    </div>
                </div>
                <?php
                }
                ?>
                <?php $footer_backg = easybook_get_option('footer_backg','');
                if ($footer_backg != ''){
                ?>
                    <div class="footer-bg" data-fbg="<?php echo  wp_get_attachment_image_url($footer_backg);?>"></div>
                <?php } ?>
                <div class="sub-footer fl-wrap">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                 <?php 
                                get_template_part( 'template-parts/footer/site', 'info' );
                                ?>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <?php echo wp_kses_post( easybook_get_option( 'subfooter_nav' ) ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!--footer end  -->
            
		
            <a class="to-top"><i class="fa fa-angle-up"></i></a>
            
        </div>
        <!-- Main end -->
        <?php wp_footer(); ?>
    </body>
</html>
