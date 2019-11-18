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

class CTH_Feature_Box extends Widget_Base {

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
        return 'feature_box';
    }

    // public function get_id() {
    //      return 'header-search';
    // }

    public function get_title() {
        return __( 'Feature Box', 'easybook-add-ons' );
    }

    public function get_icon() {
        // Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
        return 'fa fa-font  ';
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
                'label'         => __( 'Content', 'easybook-add-ons' ),
            ]
        );
        $this->add_control(
            'title',
            [
                'label'         => __( 'Title', 'easybook-add-ons' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '24 Hours Support',
                'label_block'   => true,
                
            ]
        );
        $this->add_control(
            'content',
            [   
                'label'         => __( 'Content', 'easybook-add-ons' ),
                'type'          => Controls_Manager::TEXTAREA,
                'default'       => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>',
            ]
        );
        $this->add_control(
            'icon',
            [
                'label'         => __( 'Icon', 'easybook-add-ons' ),
                'type'          => Controls_Manager::ICON,
                'default'       => 'fa fa-medkit'
                
            ]
        );


        $this->end_controls_section();

    }

    protected function render( ) {
        $settings = $this->get_settings();
        ?>  
        <!--features-box --> 
        <div class="features-box">
            <?php if($settings['icon']!=''): ?>
            <div class="time-line-icon">
                <i class="<?php echo $settings['icon']; ?>"></i>
            </div>
            <?php endif; ?>
            <?php if($settings['title']!='') echo '<h3>'.$settings['title'].'</h3>'; ?>
            <?php echo $settings['content']; ?>
        </div>
        <!-- features-box end  -->      
        <?php
    }

    protected function _content_template() {
        ?>
        <!--features-box --> 
        <div class="features-box">
            <# if(settings.icon!=''){ #>
            <div class="time-line-icon">
                <i class="{{settings.icon}}"></i>
            </div>
            <# } #>
            <# if(settings.title){ #><h3>{{{settings.title}}}</h3><# } #>
            {{{settings.content}}}
        </div>
        <!-- features-box end  -->      
        <?php
    }

   
   

}

// Plugin::instance()->widgets_manager->register_widget( 'Elementor\Widget_Header_Search' );

// Plugin::$instance->elements_manager->create_element_instance/ Plugin::$instance->elements_manager->create_element_instance/ Plugin::$instance->elements_manager->create_element_instance/ Plugin::$instance->elements_manager->create_element_instance