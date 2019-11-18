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

class CTH_Posts_Grid extends Widget_Base {

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
        return 'posts_grid';
    }

    // public function get_id() {
    //    	return 'header-search';
    // }

    public function get_title() {
        return __( 'Posts Grid', 'easybook-add-ons' );
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
    * @since 1.0.10
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
                'label' => __( 'Posts Query', 'easybook-add-ons' ),
            ]
        );

        $this->add_control(
            'cat_ids',
            [
                'label' => __( 'Post Category IDs to include', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'description' => __("Enter post category ids to include, separated by a comma. Leave empty to get posts from all categories.", 'easybook-add-ons')
                
            ]
        );

        $this->add_control(
            'ids',
            [
                'label' => __( 'Enter Post IDs', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                // 'default' => '437,439,451',
                'default' => '',
                'label_block' => true,
                'description' => __("Enter Post ids to show, separated by a comma. Leave empty to show all.", 'easybook-add-ons')
                
            ]
        );
        $this->add_control(
            'ids_not',
            [
                'label' => __( 'Or Post IDs to Exclude', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'description' => __("Enter post ids to exclude, separated by a comma (,). Use if the field above is empty.", 'easybook-add-ons')
                
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
                'label' => __( 'Posts to show', 'easybook-add-ons' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '3',
                'description' => esc_html__("Number of posts to show (-1 for all).", 'easybook-add-ons'),
                
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
                'default' => 'mbig',
                // 'description' => esc_html__("Number of posts to show (-1 for all).", 'easybook-add-ons'),
                
            ]
        );

        $this->add_control(
            'excerpt_length',
            [
                'label' => __( 'Post Description Length', 'easybook-add-ons' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '250',
                'min'     => 0,
                'max'     => 500,
                'step'    => 10,
                
                
            ]
        );

        $this->add_control(
            'show_author',
            [
                'label' => __( 'Show Author', 'easybook-add-ons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Show', 'easybook-add-ons' ),
                'label_off' => __( 'Hide', 'easybook-add-ons' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'show_date',
            [
                'label' => __( 'Show Date', 'easybook-add-ons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Show', 'easybook-add-ons' ),
                'label_off' => __( 'Hide', 'easybook-add-ons' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'show_views',
            [
                'label' => __( 'Show Views', 'easybook-add-ons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Show', 'easybook-add-ons' ),
                'label_off' => __( 'Hide', 'easybook-add-ons' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'show_cats',
            [
                'label' => __( 'Show Categories', 'easybook-add-ons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Show', 'easybook-add-ons' ),
                'label_off' => __( 'Hide', 'easybook-add-ons' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'read_all_link',
            [
                'label' => __( 'Read All URL', 'easybook-add-ons' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => 'http://',
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
                'post_type' => 'post',
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
                'post_type' => 'post',
                'paged' => $paged,
                'posts_per_page'=> $settings['posts_per_page'],
                'post__not_in' => $ids_not,
                'orderby'=> $settings['order_by'],
                'order'=> $settings['order'],

                'post_status' => 'publish'
            );
        }else{
            $post_args = array(
                'post_type' => 'post',
                'paged' => $paged,
                'posts_per_page'=> $settings['posts_per_page'],
                'orderby'=> $settings['order_by'],
                'order'=> $settings['order'],

                'post_status' => 'publish'
            );
        }





        if(!empty($settings['cat_ids']))
            $post_args['cat'] = $settings['cat_ids'];


        // $css_classes = array(
        //     'posts-grid-wrapper',
        //     'posts-grid-',//.$settings['columns_grid']
        // );

        $css_classes = array(
            'items-grid-holder',
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

                    <?php 
                        // if(easybook_get_option('blog_show_format', true ))
                        //     get_template_part( 'template-parts/post/content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) );
                        // else
                        //    get_template_part( 'template-parts/post/content' ); 
                    ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class('items-grid-item card-post ptype-content'); ?>>
                        <?php
                        if(has_post_thumbnail( )){ ?>
                        <div class="card-post-img fl-wrap">
                            <a href="<?php echo esc_url( get_permalink() );?>"><?php the_post_thumbnail('easybook-post-grid',array('class'=>'respimg') ); ?></a>
                        </div>
                        <?php } ?>
                        <div class="card-post-content fl-wrap">
                            <?php
                            the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
                            ?>
                            <?php //the_excerpt();
                                easybook_addons_the_excerpt_max_charlength($settings['excerpt_length']);
                            ?>
                            <?php if( $settings['show_author'] == 'yes' ):?>
                            <div class="post-author">
                                <?php 
                                    echo get_avatar(get_the_author_meta('user_email'),'80','https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=80', get_the_author_meta( 'display_name' ) );
                                ?>
                                <?php esc_html_e( 'By, ',  'easybook-add-ons' ) ; the_author_posts_link( );?>
                            </div>
                            <?php endif;?>
                            <?php if( $settings['show_date'] == 'yes' || $settings['show_views'] == 'yes' || $settings['show_cats'] == 'yes' ):?>
                            <div class="post-opt">
                                <ul>
                                    <?php if( $settings['show_date'] == 'yes' ):?><li><i class="fal fa-calendar-check-o"></i> <span><?php the_time(get_option('date_format'));?></span></li><?php endif;?>
                                    <?php if( $settings['show_views'] == 'yes' ):?><li><i class="fal fa-eye"></i> <span><?php echo easybook_addons_get_post_views(get_the_ID());?></span></li><?php endif;?>
                                    <?php if( $settings['show_cats'] == 'yes' ):?>
                                        <?php if(get_the_category( )) { ?>
                                        <li><i class="fal fa-tags"></i><?php the_category( ' , ' ); ?></li>  
                                        <?php } ?>
                                    <?php endif;?>
                                </ul>
                            </div>
                            <?php endif;?>
                        </div>
                    </article>

                <?php endwhile; ?>


                

            <?php endif; ?> 

        </div>
        <?php
        if($settings['show_pagination'] == 'yes') easybook_addons_custom_pagination($posts_query->max_num_pages,$range = 2, $posts_query) ;
        ?>
        <?php
            $url = $settings['read_all_link']['url'];
            $target = $settings['read_all_link']['is_external'] ? 'target="_blank"' : '';
            if($url != '') echo '<div class="all-posts-link"><a href="' . $url . '" ' . $target .' class="btn color-bg ">'.__('Read All News','easybook-add-ons').'<i class="fa fa-caret-right"></i></a></div>';
        ?>
        <?php wp_reset_postdata();?>
        <?php

    }

    protected function _content_template() {}

   
    

}

