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

 

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class CTH_Membership_Plans extends Widget_Base {

    /**
    * Get widget name.
    *
    * Retrieve alert widget name.
    *
    * @since 1.0.0
    * @access public
    *
    * @return string Widget name. 
    */
    public function get_name() { 
        return 'membership_plans';
    }

    // public function get_id() {
    //      return 'header-search';
    // }

    public function get_title() {
        return __( 'Membership Plans', 'easybook-add-ons' ); 
    }

    public function get_icon() {
        // Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
        return 'eicon-gallery-justified';
    }

    /**
    * Get widget categories.
    *
    * Retrieve the widget categories.
    *
    * @since 1.0.0
    * @access public
    *
    * @return array Widget categories.
    */
    public function get_categories() {
        return [ 'easybook-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_query',
            [
                'label' => __( 'Plans Query', 'easybook-add-ons' ),
            ]
        );

        $this->add_control(
            'ids',
            [
                'label' => __( 'Enter Plan IDs', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'description' => __("Enter Plan ids to show, separated by a comma. Leave empty to show all.", 'easybook-add-ons')
                
            ]
        );
        $this->add_control(
            'ids_not',
            [
                'label' => __( 'Or Plan IDs to Exclude', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'description' => __("Enter plan ids to exclude, separated by a comma (,). Use if the field above is empty.", 'easybook-add-ons')
                
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => __( 'Order by', 'easybook-add-ons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'date' => esc_html__('Date', 'easybook-add-ons'), 
                    'ID' => esc_html__('ID', 'easybook-add-ons'), 
                    'author' => esc_html__('Author', 'easybook-add-ons'), 
                    'title' => esc_html__('Title', 'easybook-add-ons'), 
                    'modified' => esc_html__('Modified', 'easybook-add-ons'),
                    'rand' => esc_html__('Random', 'easybook-add-ons'),
                    'comment_count' => esc_html__('Comment Count', 'easybook-add-ons'),
                    'menu_order' => esc_html__('Menu Order', 'easybook-add-ons'),
                    'post__in' => esc_html__('ID order given (post__in)', 'easybook-add-ons'),
                ],
                'default' => 'date',
                'separator' => 'before',
                'description' => esc_html__("Select how to sort retrieved posts. More at ", 'easybook-add-ons').'<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.', 
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => __( 'Sort Order', 'easybook-add-ons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => esc_html__('Ascending', 'easybook-add-ons'), 
                    'DESC' => esc_html__('Descending', 'easybook-add-ons'), 
                ],
                'default' => 'ASC',
                'separator' => 'before',
                'description' => esc_html__("Select Ascending or Descending order. More at", 'easybook-add-ons').'<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.', 
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __( 'Plans to show', 'easybook-add-ons' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '3',
                'description' => esc_html__("Number of plans to show (-1 for all).", 'easybook-add-ons'),
                
            ]
        );

        

        $this->end_controls_section();

        $this->start_controls_section(
            'section_layout',
            [
                'label' => __( 'Plans Layout', 'easybook-add-ons' ),
            ]
        );

        $this->add_control(
            'columns_grid',
            [
                'label' => __( 'Columns Grid', 'easybook-add-ons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'one' => esc_html__('One Column', 'easybook-add-ons'), 
                    'two' => esc_html__('Two Columns', 'easybook-add-ons'), 
                    'three' => esc_html__('Three Columns', 'easybook-add-ons'), 
                    'four' => esc_html__('Four Columns', 'easybook-add-ons'), 
                    'five' => esc_html__('Five Columns', 'easybook-add-ons'), 
                    'six' => esc_html__('Six Columns', 'easybook-add-ons'), 
                    
                ],
                'default' => 'three',
                
                
            ]
        );


        $this->add_control(
            'best_price_item',
            [
                'label' => __( 'Best Price Item', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => '2',
                'description' => esc_html__("Best price item number. 1 for first item. Leave empty for none.", 'easybook-add-ons'),
            ]
        );

        $this->add_control(
            'best_price_icon',
            [
                'label' => __( 'Best Price Icon', 'easybook-add-ons' ),
                'type' => Controls_Manager::ICON,
                'default' => 'fa fa-check',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'best_price_text',
            [
                'label' => __( 'Best Price Recommended Text', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Recommended',
                'label_block' => true,
                
            ]
        );
        $this->add_control(
            'show_pricing_switcher',
            [
                'label' => __( 'Show Button Switcher Pricing', 'easybook-add-ons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __( 'Show', 'easybook-add-ons' ),
                'label_off' => __( 'Hide', 'easybook-add-ons' ),
                'return_value' => 'yes',
            ]
        );



        


        $this->end_controls_section();

    }

    protected function render( ) {

        $settings = $this->get_settings();

        
        if(!empty($settings['ids'])){
            $ids = explode(",", $settings['ids']);
            $post_args = array(
                'post_type' => 'lplan',
                
                'posts_per_page'=> $settings['posts_per_page'],
                'post__in' => $ids,
                'orderby'=> $settings['order_by'],
                'order'=> $settings['order'],

                'post_status' => 'publish'
            );
        }elseif(!empty($settings['ids_not'])){
            $ids_not = explode(",", $settings['ids_not']);
            $post_args = array(
                'post_type' => 'lplan',
                
                'posts_per_page'=> $settings['posts_per_page'],
                'post__not_in' => $ids_not,
                'orderby'=> $settings['order_by'],
                'order'=> $settings['order'],

                'post_status' => 'publish'
            );
        }else{
            $post_args = array(
                'post_type' => 'lplan',
                
                'posts_per_page'=> $settings['posts_per_page'],
                'orderby'=> $settings['order_by'],
                'order'=> $settings['order'],

                'post_status' => 'publish'
            );
        }




        $css_classes = array(
            'membership-plans-wrap clearfix',
            // $settings['space'].'-pad',
            $settings['columns_grid'].'-cols',
        );

        $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

        ?>
        <div class="<?php echo esc_attr($css_class );?>">
        <?php 
            if($settings['show_pricing_switcher'] == 'yes'):?>
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
                $best_price_item = $settings['best_price_item'];
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
                                        <span class="curen"><?php echo easybook_addons_get_currency_symbol(); ?></span><span><?php echo easybook_addons_get_price_formated($_price, false); ?></span>
                                    </span>
                                    <span class="year-cont">
                                        <span class="year-cont-inner">
                                            <?php
                                                $yearly_price = easybook_addons_calculate_yearly_price($_price, $period, $interval, $yearly_sale);
                                            ?>
                                            <span class="curen"><?php echo easybook_addons_get_currency_symbol(); ?></span><span><?php echo easybook_addons_get_price_formated($yearly_price, false); ?></span>
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
                                    <?php if($settings['best_price_icon'] !='') echo '<i class="'.$settings['best_price_icon'].'"></i>'; ?>
                                    <?php if($settings['best_price_text'] !='') echo '<span class="recomm-text">'.$settings['best_price_text'].'</span>'; ?>
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
        <?php

    }

    protected function _content_template() {}

   
    

}



