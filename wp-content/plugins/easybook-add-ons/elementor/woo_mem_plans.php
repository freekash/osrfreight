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
 
class CTH_Woo_Mem_Plans extends Widget_Base { 

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
        return 'woo_mem_plans';
    }

    // public function get_id() {
    //      return 'header-search';
    // }

    public function get_title() {
        return __( 'Membership Plans - Woo', 'easybook-add-ons' );
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
                'default' => '1',
                'description' => esc_html__("Best price item number. 0 for first item. Leave empty for none.", 'easybook-add-ons'),
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
                'default' => 'yes',
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
        <?php  if($settings['show_pricing_switcher'] == 'yes'):?>
                <div class="pricing-switcher">
                    <div class="fieldset color-bg">
                        <input type="radio" name="duration-1"  id="monthly-1" class="tariff-toggle" checked>
                        <label for="monthly-1" class="monthly-1">Monthly Tariff</label>
                        <input type="radio" name="duration-1" class="tariff-toggle"  id="yearly-1">
                        <label for="yearly-1">Yearly Tariff</label>
                        <span class="switch"></span>
                    </div>
                </div>
        <?php endif; ?>
        <?php 
            $checkout_page_id = easybook_addons_get_option('checkout_page');

            $posts_query = new \WP_Query($post_args);
            if($posts_query->have_posts()) : ?>
                <?php 
                $idx = 0;
                $best_price_item = $settings['best_price_item'];
                while($posts_query->have_posts()) : $posts_query->the_post(); ?>
                    <!-- plan-item -->
                    <div class="price-item<?php if($best_price_item == $idx) echo ' best-price';?>">
                        <div class="price-head color-bg">
                            <?php if(get_post_meta( get_the_ID(), ESB_META_PREFIX.'price_icon', true ) != ''): ?>
                                   <?php 
                                    $decor = '';
                                    switch ($idx) {
                                        case '0':
                                            $decor = 'cloud-2';
                                            break;
                                        case '1':
                                            $decor = 'cloud-1';
                                            break;
                                        case '2':
                                            $decor = 'stars-dec';
                                            break;
                                        default:
                                            $decor = 'cloud-1';
                                            break;
                                    }

                                ?>
                                <div class="price-head-decor <?php echo  $decor;?>">
                                    <i class="<?php echo get_post_meta( get_the_ID(), ESB_META_PREFIX.'price_icon', true ); ?>"></i>
                                </div>
                            <?php endif; ?>
                            <h3><?php the_title(); ?></h3>
                            <?php if(get_post_meta( get_the_ID(), ESB_META_PREFIX.'subtitle', true ) != '') echo '<h4>'.get_post_meta( get_the_ID(), ESB_META_PREFIX.'subtitle', true ).'</h4>'; ?>
                            <?php if(get_post_meta( get_the_ID(), ESB_META_PREFIX.'price_sale', true ) != '') echo '<span class="year-sale">-'.get_post_meta( get_the_ID(), ESB_META_PREFIX.'price_sale', true ).'%</span>'; ?>   
                        </div>
                        <div class="price-content fl-wrap">
                        <?php if( get_post_meta( get_the_ID(), '_price', true ) ):
                             $key_num = ($best_price_item == $idx) ? '2' : '1' ?>
                            <div class="price-num col-dec-<?php echo $key_num; ?> fl-wrap">
                                <div class="price-num-item">
                                    <span class="mouth-cont">
                                        <span class="curen"><?php echo easybook_addons_get_currency_symbol(); ?></span><?php echo get_post_meta( get_the_ID(),'_price', true ); ?></span>
                                    <span class="year-cont">
                                        <?php   $price_year = get_post_meta( get_the_ID(), ESB_META_PREFIX.'price_year', true );
                                                $price_sale = get_post_meta( get_the_ID(), ESB_META_PREFIX.'price_sale', true );
                                                $price_year_sale = $price_year * ((100 - $price_sale ) / 100);
                                        ?>
                                        <span class="curen"><?php echo easybook_addons_get_currency_symbol(); ?></span><?php echo floor($price_year_sale);?>
                                        </span>
                                </div> 
                                <div class="price-num-desc"><span class="mouth-cont"><?php echo easybook_add_ons_get_plan_period_text( get_post_meta( get_the_ID(), ESB_META_PREFIX.'interval', true ), get_post_meta( get_the_ID(), ESB_META_PREFIX.'period', true ) ); ?></span><span class="year-cont"><?php echo get_post_meta( get_the_ID(), ESB_META_PREFIX.'period_year', true ); ?></span>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="price-num fl-wrap">
                               
                                <span class="price-num-item"><?php _e( 'Free', 'easybook-add-ons' ); ?></span>
                                <div class="price-num-desc"><?php echo easybook_add_ons_get_plan_period_text( get_post_meta( get_the_ID(), ESB_META_PREFIX.'interval', true ), get_post_meta( get_the_ID(), ESB_META_PREFIX.'period', true ) ); ?></div>
                                
                            </div>
                        <?php endif; ?>
                            <div class="price-desc fl-wrap">
                                <?php the_content(); ?>
                                <?php if(is_user_logged_in()) : ?>
                                <a href="<?php echo easybook_addons_get_add_to_cart_url( get_the_ID() );?>" class="price-link <?php if($idx == 1)echo 'color2-bg' ?>"><?php echo sprintf(__( 'Choose %s', 'easybook-add-ons' ), get_the_title()); ?></a>
                                <?php else : ?>
                                <a href="#" class="price-link logreg-modal-open" data-message="<?php esc_attr_e( 'You must be logged in to order a membership plan.', 'easybook-add-ons' ); ?>"><?php echo sprintf(__( 'Choose %s', 'easybook-add-ons' ), get_the_title()); ?></a>
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



