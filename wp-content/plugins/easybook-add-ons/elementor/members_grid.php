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

class CTH_Members_Grid extends Widget_Base {

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
        return 'members_grid';
    }

    // public function get_id() {
    //      return 'header-search';
    // }

    public function get_title() {
        return __( 'Team Members Grid', 'easybook-add-ons' );
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
                'label' => __( 'Members Query', 'easybook-add-ons' ),
            ]
        );

        $this->add_control(
            'ids',
            [
                'label' => __( 'Enter Member IDs', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'description' => __("Enter Member ids to show, separated by a comma. Leave empty to show all.", 'easybook-add-ons')
                
            ]
        );
        $this->add_control(
            'ids_not',
            [
                'label' => __( 'Or Member IDs to Exclude', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'description' => __("Enter member ids to exclude, separated by a comma (,). Use if the field above is empty.", 'easybook-add-ons')
                
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
                'default' => 'DESC',
                'separator' => 'before',
                'description' => esc_html__("Select Ascending or Descending order. More at", 'easybook-add-ons').'<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.', 
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __( 'Members to show', 'easybook-add-ons' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '3',
                'description' => esc_html__("Number of members to show (-1 for all).", 'easybook-add-ons'),
                
            ]
        );

        

        $this->end_controls_section();

        $this->start_controls_section(
            'section_layout',
            [
                'label' => __( 'Posts Layout', 'easybook-add-ons' ),
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
                    'seven' => esc_html__('Seven Columns', 'easybook-add-ons'), 
                    'eight' => esc_html__('Eight Columns', 'easybook-add-ons'), 
                    'nine' => esc_html__('Nine Columns', 'easybook-add-ons'), 
                    'ten' => esc_html__('Ten Columns', 'easybook-add-ons'), 
                ],
                'default' => 'three',
                // 'description' => esc_html__("Number of posts to show (-1 for all).", 'easybook-add-ons'),
                
            ]
        );



        $this->add_control(
            'space',
            [
                'label' => __( 'Space', 'easybook-add-ons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'exbig' => esc_html__('Extra Big', 'easybook-add-ons'), 
                    'mbig' => esc_html__('Bigger', 'easybook-add-ons'), 
                    'big' => esc_html__('Big', 'easybook-add-ons'), 
                    'medium' => esc_html__('Medium', 'easybook-add-ons'), 
                    'small' => esc_html__('Small', 'easybook-add-ons'), 
                    'extrasmall' => esc_html__('Extra Small', 'easybook-add-ons'), 
                    'no' => esc_html__('None', 'easybook-add-ons'), 
                    
                ],
                'default' => 'medium',
                // 'description' => esc_html__("Number of posts to show (-1 for all).", 'easybook-add-ons'),
                
            ]
        );

        

        $this->add_control(
            'view_all_link',
            [
                'label' => __( 'View All URL', 'easybook-add-ons' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '',
                    'is_external' => '',
                ],
                'show_external' => true, // Show the 'open in new tab' button.
            ]
        );


        $this->add_control(
            'show_pagination',
            [
                'label' => __( 'Show Pagination', 'easybook-add-ons' ),
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

        if(is_front_page()) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        } else {
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }

        if(!empty($settings['ids'])){
            $ids = explode(",", $settings['ids']);
            $post_args = array(
                'post_type' => 'member',
                'paged' => $paged,
                'posts_per_page'=> $settings['posts_per_page'],
                'post__in' => $ids,
                'orderby'=> $settings['order_by'],
                'order'=> $settings['order'],

                'post_status' => 'publish'
            );
        }elseif(!empty($settings['ids_not'])){
            $ids_not = explode(",", $settings['ids_not']);
            $post_args = array(
                'post_type' => 'member',
                'paged' => $paged,
                'posts_per_page'=> $settings['posts_per_page'],
                'post__not_in' => $ids_not,
                'orderby'=> $settings['order_by'],
                'order'=> $settings['order'],

                'post_status' => 'publish'
            );
        }else{
            $post_args = array(
                'post_type' => 'member',
                'paged' => $paged,
                'posts_per_page'=> $settings['posts_per_page'],
                'orderby'=> $settings['order_by'],
                'order'=> $settings['order'],

                'post_status' => 'publish'
            );
        }




        $css_classes = array(
            'items-grid-holder section-team',
            $settings['space'].'-pad',
            $settings['columns_grid'].'-cols',
        );

        $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

        ?>
        <div class="<?php echo esc_attr($css_class );?>">
        <?php 
            $posts_query = new \WP_Query($post_args);
            if($posts_query->have_posts()) : ?>
                <?php while($posts_query->have_posts()) : $posts_query->the_post(); ?>
                    <!-- team-item -->
                    <div id="member-<?php the_ID(); ?>" <?php post_class('items-grid-item team-box'); ?>>
                        <?php
                        if(has_post_thumbnail( )){ ?>
                        <div class="team-photo">
                        <?php the_post_thumbnail('easybook-featured-image',array('class'=>'respimg') ); ?>
                        </div>
                        <?php } ?>
                        <div class="team-info">
                            <?php
                            the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
                            ?>
                            <?php the_excerpt(); ?>
                            <div class="team-social">
                                <ul >
                                    <?php if(get_post_meta(get_the_ID(), '_cth_twitterurl' ,true)!=''){ ?>
                                        <li><a title="<?php esc_attr_e('Follow on Twitter','easybook-add-ons');?>" href="<?php echo esc_url( get_post_meta(get_the_ID(), '_cth_twitterurl' ,true) ); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                    <?php } ?>
                                    <?php if(get_post_meta(get_the_ID(), '_cth_facebookurl' ,true)!=''){ ?>
                                        <li><a title="<?php esc_attr_e('Like on Facebook','easybook-add-ons');?>" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_cth_facebookurl' ,true)); ?>" target="_blank"><i class="fab fa-facebook"></i></a></li>
                                    <?php } ?>
                                    <?php if(get_post_meta(get_the_ID(), '_cth_googleplusurl' ,true)!=''){ ?>
                                        <li><a title="<?php esc_attr_e('Circle on Google Plus','easybook-add-ons');?>" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_cth_googleplusurl' ,true)) ;?>" target="_blank"><i class="fab fa-google-plus"></i></a></li>
                                    <?php } ?>
                                    <?php if(get_post_meta(get_the_ID(), '_cth_linkedinurl' ,true)!=''){ ?>
                                        <li><a title="<?php esc_attr_e('Be Friend on Linkedin','easybook-add-ons');?>" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_cth_linkedinurl' ,true) ); ?>" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                                    <?php } ?>
                                    <?php if(get_post_meta(get_the_ID(), '_cth_instagramurl' ,true)!=''){ ?>
                                        <li><a title="<?php esc_attr_e('Follow on Instagram','easybook-add-ons');?>" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_cth_instagramurl' ,true) ); ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                    <?php } ?>
                                    <?php if(get_post_meta(get_the_ID(), '_cth_tumblrurl' ,true)!=''){ ?>
                                        <li><a title="<?php esc_attr_e('Follow on  Tumblr','easybook-add-ons');?>" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_cth_tumblrurl' ,true) ); ?>" target="_blank"><i class="fab fa-tumblr"></i></a></li>
                                    <?php } ?>  
                                    <?php if(get_post_meta(get_the_ID(), '_cth_behanceurl' ,true)!=''){ ?>
                                        <li><a title="<?php esc_attr_e('View Behance profile','easybook-add-ons');?>" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_cth_behanceurl' ,true) ); ?>" target="_blank"><i class="fab fa-behance"></i></a></li>
                                    <?php } ?>
                                </ul>
                                <?php if(get_post_meta(get_the_ID(), '_cth_mail' ,true)!=''){ ?>
                                    <a class="team-contact_link" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_cth_mail' ,true) ); ?>" target="_blank"><i class="fa fa-envelope"></i></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- team-item end  -->

                <?php endwhile; ?>
            <?php endif; ?> 

        </div>
        <?php
        if($settings['show_pagination'] == 'yes') easybook_addons_custom_pagination($posts_query->max_num_pages,$range = 2, $posts_query) ;
        ?>
        <?php
            $url = $settings['view_all_link']['url'];
            $target = $settings['view_all_link']['is_external'] ? 'target="_blank"' : '';
            if($url != '') echo '<div class="all-members-link"><a href="' . $url . '" ' . $target .' class="btn big-btn circle-btn dec-btn color-bg flat-btn">'.__('View All','easybook-add-ons').'<i class="fa fa-eye"></i></a></div>';
        ?>
        <?php wp_reset_postdata();?>
        <?php

    }

    protected function _content_template() {}

   
    

}



