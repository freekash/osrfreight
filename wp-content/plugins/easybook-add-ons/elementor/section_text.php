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

class CTH_Section_Text extends Widget_Base {

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
        return 'section_text';
    }

    // public function get_id() {
    //      return 'header-search';
    // }

    public function get_title() {
        return __( 'Section Text', 'easybook-add-ons' );
    }

    public function get_icon() {
        // Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
        return 'fa fa-font';
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
            'section_content',
            [
                'label' => __( 'Content', 'easybook-add-ons' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'About <span>Alisa Noory</span>',
                'label_block' => true,
                
            ]
        );
        $this->add_control(
            'content',
            [
                 'label'   => __( 'content', 'easybook-add-ons' ),
                 'type'    => Controls_Manager::TEXTAREA,
                 'default' => '<p>Ut euismod ultricies sollicitudin. Curabitur sed dapibus nulla. Nulla eget iaculis lectus. Mauris ac maximus neque. Nam in mauris quis libero sodales eleifend. Morbi varius, nulla sit amet rutrum elementum, est elit finibus tellus, ut tristique elit risus at metus.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat purus viverra.</p>',
            ]
        );
        $this->add_control(
            'button',
            [
                'label' => __( 'Button Name', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Visit Website',
                'label_block' => true,
                
            ]
        );
        $this->add_control(
            'icon',
            [
                'label' => __( 'Social Icon', 'easybook-add-ons' ),
                'type' => Controls_Manager::ICON,
            ]
        );  
        $this->add_control(
              'icon_position',
              [
                 'label'       => __( 'Icon Position', 'easybook-add-ons' ),
                 'type' => Controls_Manager::SELECT,
                 'default' => 'after',
                 'options' => [
                    'after'  => __( 'after', 'easybook-add-ons' ),
                    'before' => __( 'before', 'easybook-add-ons' ),
                 ],
                 'selectors' => [ // You can use the selected value in an auto-generated css rule.
                    '{{WRAPPER}} .your-element' => 'border-style: {{VALUE}}',
                 ],
              ]
            );
        $this->add_control(
          'link',
          [
             'label' => __( 'Website URL', 'easybook-add-ons' ),
             'type' => Controls_Manager::URL,
             'default' => [
                'url' => 'http://',
                'is_external' => '',
             ],
             'show_external' => true, // Show the 'open in new tab' button.
          ]
        );
        


        $this->end_controls_section();

    }

    protected function render( ) {

        $settings = $this->get_settings();
        $link = $settings['link'];
        $target = $link['is_external'] ? 'target="_blank"' : '';
        ?>
        
        <div class="list-single-main-item fl-wrap">
            <div class="list-single-main-item-title fl-wrap">
                <?php if($settings['title']!='') echo '<h3>'.$settings['title'].'</h3>'?>
            </div>
            <?php if($settings['content']!='') echo $settings['content']; ?>
            <?php 
                if($settings['icon_position']=='after')
                {
                    echo '<a href="'.$link['url'].'" class="btn transparent-btn float-btn">'.$settings['button'].'<i class="'.$settings['icon'].'"></i></a>';
                }
                else {
                    echo '<a href="'.$link['url'].'" class="btn transparent-btn float-btn"><i class="'.$settings['icon'].'"></i>'.$settings['button'].'</a>';
                }
            ?>
        </div>
        <?php

    }

    // protected function _content_template() {
    //     
    //     <div class="section-title">
    //         <# if(settings.title){ #><h2>{{{settings.title}}}</h2><# } #>
    //         <# if(settings.over_title){ #><div class="section-subtitle">{{{settings.over_title}}}</div><# } #>
    //         <# if(settings.show_sep == 'yes'){ #><span class="section-separator"></span><# } #>
    //         {{{settings.sub_title}}}
    //     </div>
    //     <?php

    }

   
   



// Plugin::instance()->widgets_manager->register_widget( 'Elementor\Widget_Header_Search' );

// Plugin::$instance->elements_manager->create_element_instance

