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


$css = $el_class = $ids = $ids_not = $order_by = $order = $posts_per_page = $columns_grid = $best_price_item = $best_price_icon = $best_price_text = $show_pricing_switcher = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_classes = array(
    'membership-plans-wrap clearfix',
    $columns_grid.'-cols',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

?>
<?php
if(!empty($ids)){
    $ids = explode(",", $ids);
    $post_args = array(
        'post_type' => 'lplan',
        
        'posts_per_page'=> $posts_per_page,
        'post__in' => $ids,
        'orderby'=> $order_by,
        'order'=> $order,

        'post_status' => 'publish'
    );
}elseif(!empty($ids_not)){
    $ids_not = explode(",", $ids_not);
    $post_args = array(
        'post_type' => 'lplan',
        
        'posts_per_page'=> $posts_per_page,
        'post__not_in' => $ids_not,
        'orderby'=> $order_by,
        'order'=> $order,

        'post_status' => 'publish'
    );
}else{
    $post_args = array(
        'post_type' => 'lplan',
        
        'posts_per_page'=> $posts_per_page,
        'orderby'=> $order_by,
        'order'=> $order,

        'post_status' => 'publish'
    );
}

?>
<div class="<?php echo esc_attr($css_class );?>">
<?php 
    if($show_pricing_switcher == 'yes'):?>
        <div class="pricing-switcher">
            <div class="fieldset color-bg">
                <input type="radio" name="duration-1"  id="monthly-1" class="tariff-toggle monthly-1" checked>
                <label for="monthly-1" class="monthly-1"><?php esc_html_e( 'Monthly Tariff','easybook-add-ons' ) ?></label>
                <input type="radio" name="duration-1" class="tariff-toggle yearly-1"  id="yearly-1">
                <label for="yearly-1"><?php esc_html_e( 'Yearly Tariff','easybook-add-ons' ) ?></label>
                <span class="switch"></span>
            </div>
        </div>
    <?php endif; ?>
<?php 
    // $checkout_page_id = easybook_addons_get_option('checkout_page');

    $posts_query = new \WP_Query($post_args);
    if($posts_query->have_posts()) : ?>
        <?php 
        $idx = 0;
        $best_price_item = $best_price_item;
        while($posts_query->have_posts()) : $posts_query->the_post(); 
            $yearly_sale = get_post_meta( get_the_ID(), ESB_META_PREFIX.'yearly_sale', true );
            $_price = get_post_meta( get_the_ID(), '_price', true );
            $period = get_post_meta( get_the_ID(), ESB_META_PREFIX.'period', true );
            $interval = get_post_meta( get_the_ID(), ESB_META_PREFIX.'interval', true );
            $key_num = ($best_price_item == $idx) ? '2' : '1';

            $period_text = easybook_add_ons_get_plan_period_text($interval, $period);
            
            ?>
            <!-- plan-item -->
            <div class="price-item<?php if($best_price_item == $idx) echo ' best-price';?>">
                <div class="price-head color-bg">
                    <?php 
                    if(($price_icon = get_post_meta( get_the_ID(), ESB_META_PREFIX.'price_icon', true ) )!= ''): ?>
                        <?php 
                            $decor_icon = 'cloud-2';
                            if($idx % 2 == 0)
                                $decor_icon = 'cloud-1';
                            elseif($idx % 3 == 0)
                                $decor_icon = 'stars-dec';
                            

                        ?>
                        <div class="price-head-decor <?php echo  $decor_icon;?>">
                            <i class="<?php echo $price_icon; ?>"></i>
                        </div>
                    <?php endif; ?>
                    <?php the_title( '<h3 class="pricing-item-title">', '</h3>', true ); ?>
                    
                    <?php 
                    if( ($subtitle = get_post_meta( get_the_ID(), ESB_META_PREFIX.'subtitle', true )) != '') 
                        echo '<h4 class="pricing-item-subtitle">'.$subtitle.'</h4>'; 

                    if($yearly_sale != '') 
                        echo '<span class="year-sale">'.easybook_addons_format_pricing_yearly_sale($yearly_sale).'</span>'; ?>   
                </div>
                <div class="price-content fl-wrap">
                <?php 
                
                $is_free = true;
                if( (float)$_price > 0 ):
                    
                    $is_free = false;
                ?>
                    <div class="price-num col-dec-<?php echo $key_num; ?> fl-wrap">
                        <div class="price-num-item">
                            <span class="mouth-cont">
                                <span class="curen"><?php echo easybook_addons_get_currency_symbol(); ?></span>
                                <span><?php echo easybook_addons_get_price_formated($_price, false); ?></span>
                            </span>
                            <span class="year-cont">
                                <span class="year-cont-inner">
                                    <?php
                                        // $yearly_price = easybook_addons_calculate_yearly_price($_price, $period, $interval, $yearly_sale);
                                    ?>
                                    <span class="curen"><?php echo easybook_addons_get_currency_symbol(); ?></span>
                                    <span><?php echo easybook_addons_get_price_formated($yearly_price, false); ?></span>
                                </span>
                            </span>
                        </div> 
                        <div class="price-num-desc">
                            <span class="mouth-cont"><?php echo $period_text; ?></span>
                            <span class="year-cont">
                                <span class="year-cont-inner"><?php _ex( 'Per Year', 'pricing yearly period text', 'easybook-add-ons' ); ?></span>
                            </span>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="price-num col-dec-<?php echo $key_num; ?> fl-wrap"> 
                        <span class="price-num-item"><?php _e( 'Free', 'easybook-add-ons' ); ?></span>
                        <div class="price-num-desc"><?php echo $period_text; ?></div>
                    </div>
                <?php endif; ?>
                    <div class="price-desc fl-wrap">
                        <?php the_content(); ?>
                            
                        <?php if(is_user_logged_in()) : ?>
                            <form method="post">
                                <input class="price-link color<?php echo $key_num; ?>-bg" type="submit" value="<?php echo sprintf(__( 'Choose %s', 'easybook-add-ons' ), get_the_title()); ?>">
                                <input type="hidden" name="product_id" value="<?php echo esc_attr( get_the_ID() );?>">
                                <input type="hidden" name="action" value="<?php echo ($is_free ? 'esb_add_free_mem' : 'esb_add_to_cart'); ?>"> 
                                <input type="hidden" class="yearly_price_input" name="yearly_price" value="0"> 
                                <input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce( 'easybook-add-to-cart' ); ?>"> 
                            </form>

                        <?php else : ?>
                            <a href="#" class="price-link logreg-modal-open color<?php echo $key_num; ?>-bg" data-message="<?php esc_attr_e( 'You must be logged in to order a membership plan.', 'easybook-add-ons' ); ?>"><?php echo sprintf(__( 'Choose %s', 'easybook-add-ons' ), get_the_title()); ?></a>
                        <?php endif; ?>
                        
                        <?php if($best_price_item == $idx){ ?>
                        <div class="recomm-price">
                            <?php if($best_price_icon !='') echo '<i class="'.$best_price_icon.'"></i>'; ?>
                            <?php if($best_price_text !='') echo '<span class="recomm-text">'.$best_price_text.'</span>'; ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- plan-item end  -->

        <?php 
        $idx++;
        endwhile; ?>
    <?php endif; ?> 

</div>
<?php wp_reset_postdata();?>