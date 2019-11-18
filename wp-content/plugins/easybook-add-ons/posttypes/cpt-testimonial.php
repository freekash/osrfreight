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



class Esb_Class_Testimonial_CPT extends Esb_Class_CPT {
    protected $name = 'cth_testimonial';

    public function register(){

        $labels = array( 
            'name' => __( 'Testimonial', 'easybook-add-ons' ),
            'singular_name' => __( 'Testimonial', 'easybook-add-ons' ),
            'add_new' => __( 'Add New Testimonial', 'easybook-add-ons' ),
            'add_new_item' => __( 'Add New Testimonial', 'easybook-add-ons' ),
            'edit_item' => __( 'Edit Testimonial', 'easybook-add-ons' ),
            'new_item' => __( 'New Testimonial', 'easybook-add-ons' ),
            'view_item' => __( 'View Testimonial', 'easybook-add-ons' ),
            'search_items' => __( 'Search Testimonials', 'easybook-add-ons' ),
            'not_found' => __( 'No Testimonials found', 'easybook-add-ons' ),
            'not_found_in_trash' => __( 'No Testimonials found in Trash', 'easybook-add-ons' ),
            'parent_item_colon' => __( 'Parent Testimonial:', 'easybook-add-ons' ),
            'menu_name' => __( 'Testimonials', 'easybook-add-ons' ),
        );

        $args = array( 
            'labels' => $labels,
            'hierarchical' => true,
            'description' => __( 'List Testimonials', 'easybook-add-ons' ),
            'supports' => array( 'title', 'editor', 'thumbnail'/*,'comments', 'post-formats'*/),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 25,
            'menu_icon' => 'dashicons-format-chat', 
            'show_in_nav_menus' => false,
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'has_archive' => false,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => array( 'slug' => __('cth_testimonial','easybook-add-ons') ),
            'capability_type' => 'post'
        );
        register_post_type( $this->name, $args );
    }
    protected function set_meta_columns(){
        $this->has_columns = true;
    }
    public function meta_columns_head($columns){
        $columns['_thumbnail'] = __( 'Thumbnail', 'easybook-add-ons' );
        $columns['_rating'] = __( 'Rating', 'easybook-add-ons' );
        $columns['_id'] = __( 'ID', 'easybook-add-ons' );
        return $columns;
    }
    public function meta_columns_content($column_name, $post_ID){
        if ($column_name == '_id') {
            echo $post_ID;
        }
        if ($column_name == '_thumbnail') {
            echo get_the_post_thumbnail( $post_ID, 'thumbnail', array('style'=>'width:100px;height:auto;') );
        }
        if ($column_name == '_rating') {
            $rated = get_post_meta($post_ID, ESB_META_PREFIX.'testim_rate', true );
            if($rated != '' && $rated != 'no'){
                $ratedval = floatval($rated);
                echo '<ul class="star-rating">';
                for ($i=1; $i <= 5; $i++) { 
                    if($i <= $ratedval){
                        echo '<li><i class="testimfa testimfa-star"></i></li>';
                    }else{
                        if($i - 0.5 == $ratedval){
                            echo '<li><i class="testimfa testimfa-star-half"></i></li>';
                        }
                    }
                    
                }
                echo '</ul>';
            }else{
                esc_html_e('Not Rated','easybook-add-ons' );
            }
        }
    }

}

new Esb_Class_Testimonial_CPT();

