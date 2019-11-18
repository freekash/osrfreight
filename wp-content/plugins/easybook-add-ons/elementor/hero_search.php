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

class CTH_Hero_Search extends Widget_Base {

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
      return 'hero_search';
   }

   // public function get_id() {
   //    	return 'header-search';
   // }

   public function get_title() {
      return __( 'Hero Search', 'easybook-add-ons' );
   }

   public function get_icon() {
      // Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
      return 'fa fa-search';
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

      $this->add_control(
         'section_blog_posts',
         [
            'label' => __( 'Blog Posts', 'easybook-add-ons' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'some_text',
         [
            'label' => __( 'Text', 'easybook-add-ons' ),
            'type' => Controls_Manager::TEXT,
            'default' => '',
            'title' => __( 'Enter some text', 'easybook-add-ons' ),
            'section' => 'section_blog_posts',
         ]
      );

      $this->add_control(
         'posts_per_page',
         [
            'label' => __( 'Number of Posts', 'easybook-add-ons' ),
            'type' => Controls_Manager::SELECT,
            'default' => 5,
            'section' => 'section_blog_posts',
            'options' => [
               1 => __( 'One', 'easybook-add-ons' ),
               2 => __( 'Two', 'easybook-add-ons' ),
               5 => __( 'Five', 'easybook-add-ons' ),
               10 => __( 'Ten', 'easybook-add-ons' ),
            ]
         ]
      );

   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

      $custom_text = ! empty( $instance['some_text'] ) ? $instance['some_text'] : ' (no text was entered ) ';
      $post_count = ! empty( $instance['posts_per_page'] ) ? (int)$instance['posts_per_page'] : 5;

      ?>
      <div class="main-search-form-wrap">
         <form action="" class="main-search-form">
            <div class="main-search-input fl-wrap">
                <div class="main-search-input-item">
                    <input type="text" placeholder="What are you looking for?" value=""/>
                </div>
                <div class="main-search-input-item location">
                    <input type="text" placeholder="Location" value=""/>
                    <a href="#"><i class="fa fa-dot-circle-o"></i></a>
                </div>
                <div class="main-search-input-item">
                    <select data-placeholder="All Categories" class="chosen-select" >
                        <option>All Categories</option>
                        <option>Shops</option>
                        <option>Hotels</option>
                        <option>Restaurants</option>
                        <option>Fitness</option>
                        <option>Events</option>
                    </select>
                </div>
                <button class="main-search-button" onclick="window.location.href='listings-half-screen-map-list.html'">Search</button>
            </div>
         </form>
     </div>
      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}


