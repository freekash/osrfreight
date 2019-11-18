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


// remove default woo sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );


//add action woo before main content
add_action( 'woocommerce_before_main_content', function(){
    ?>
    <!--section -->
    <section class="color-bg middle-padding cth-woo-head" data-scrollax-parent="true">
        <div class="bg par-elem"  data-bg="<?php echo esc_url( easybook_get_option('blog_header_image' ) );?>" data-scrollax="properties: { translateY: '30%' }"></div>
        <?php if (empty(easybook_get_option('blog_header_image' ))): ?> 
            <div class="wave-bg wave-bg2"></div>
        <?php else: ?>
            <div class="overlay"></div>
        <?php endif; ?>
        <div class="container">
            <div class="flat-title-wrap center-align">
                <h1 class="head-sec-title"><span><?php woocommerce_page_title(); ?></span></h1>
                <!-- <?php do_action( 'easybook_shop_header'); ?> -->
                <span class="section-separator"></span>
            </div>
        </div>
    </section>
    <!-- section end -->
    <div class="breadcrumbs-fs fl-wrap">
        <div class="container">
             <?php easybook_breadcrumbs(); ?>
        </div>
    </div>
    <?php
},2 );

add_filter( 'woocommerce_page_title', function($title){
    if(is_single()) $title = single_post_title('',false);
    return $title;
});

// change single title
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary', function(){
    the_title( '<h2 class="product_title entry-title">', '</h2>' );
}, 5 );

// add woo shop layout
add_action( 'woocommerce_before_main_content', function(){
    $sb_w = 12 - easybook_get_option('blog-sidebar-width','4');
    add_action( 'easybook_shop_sidebar', 'woocommerce_get_sidebar' );
    if(!is_active_sidebar('sidebar-shop')) $sb_w = 12;
    ?>
    <section class="gray-section cth-shop-sec" id="sec1">
        <div class="container">
            <div class="row">
                <div class="col-md-<?php echo esc_attr( $sb_w );?> col-wrap">
    <?php
},5);

//add action woo after main content
add_action( 'woocommerce_after_main_content', function(){
    $sb_w = easybook_get_option('blog-sidebar-width','4');
    ?>
                </div>
                <!-- end col-md-9 -->
                <?php if(is_active_sidebar('sidebar-shop')): ?>
                    <?php //if(!is_singular('product')): ?>
                        <div class="col-md-<?php echo esc_attr($sb_w );?> shop-sidebar-column">
                            <div class="shop-sidebar box-widget-wrap fl-wrap right-sidebar">
                                <?php do_action( 'easybook_shop_sidebar' ); ?>                
                            </div>
                        </div>
                    <?php //endif; ?>
                <?php endif; ?>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- end gray-section cth-shop-sec -->
    <?php
}, 30 );

// remove link open

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );


add_action( 'woocommerce_before_shop_loop_item', function(){
    ?>
    <div class="cth-woo-item-wrap">
        <div class="cth-woo-img"><?php do_action( 'cth-woo-product-top' ); ?></div><!-- .cth-woo-img -->
        <div class="cth-woo-content">
    <?php
}, 1 );

add_action( 'woocommerce_after_shop_loop_item', function(){
    ?>
        </div>
        <!-- .cth-woo-content -->
    </div>
    <!-- .cth-woo-item-wrap -->
    <?php
}, 99 );


add_action('cth-woo-product-top', 'woocommerce_template_loop_product_link_open', 5);
add_action('cth-woo-product-top', 'woocommerce_show_product_loop_sale_flash', 10);
add_action('cth-woo-product-top', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('cth-woo-product-top', function(){
    echo '<div class="overlay"></div>';
}, 20);
add_action('cth-woo-product-top', 'woocommerce_template_loop_product_link_close', 30);


// define the woocommerce_pagination_args callback 
function easybook_woocommerce_pagination_args( $array ) { 
    // make filter magic happen here... 
    $array = array(
        'prev_text' => '<i class="fa fa-caret-left"></i>', 
        'next_text' => '<i class="fa fa-caret-right"></i>',
    );
    return $array; 
}; 
         
// add the filter 
add_filter( 'woocommerce_pagination_args', 'easybook_woocommerce_pagination_args', 10, 1 ); 


//remove action
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
//add action woo breadcrumb
add_action( 'easybook_shop_header', 'woocommerce_breadcrumb');







