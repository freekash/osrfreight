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

class CTH_Counter extends Widget_Base {

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
        return 'counter';
    }

    // public function get_id() {
    //    	return 'header-search';
    // }

    public function get_title() {
        return __( 'Counter', 'easybook-add-ons' );
    }

    public function get_icon() {
        // Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
        return 'eicon-counter';
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
            'section_content',
            [
                'label' => __( 'Content', 'easybook-add-ons' ),
            ]
        );

        $this->add_control(
            'number',
            [
                'label' => __( 'Counter Number', 'easybook-add-ons' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '254',
                'min'     => 1,
                // 'max'     => 500,
                'step'    => 1,
            ]
        );

    
        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'New Listing Every Week',
                'label_block' => true,
                
            ]
        );
        $this->add_control(
            'icon',
            [
                'label' => __( 'Icon', 'easybook-add-ons' ),
                'type' => Controls_Manager::ICON,
                'default' => 'fa fa-map-o',
            ]
        );


        

        

        $this->end_controls_section();

        

    }

    protected function render( ) {
        $settings = $this->get_settings();
        if($settings['number']):
        $new_icon = '';
        if($settings['icon']) $new_icon = str_replace(array(
            'fa fa-map-o',
            'fa-bitbucket-square',
        ),
        array(
            'far fa-map',
            'fab fa-bitbucket',
        ), $settings['icon']);

        // array(
        //         'fa fa-bitbucket-square'     => 'fab fa-bitbucket',
        //         'fa-facebook-official'    => 'fa-facebook-f',
        //         'fa-google-plus-circle'   => 'fa-google-plus',
        //         'fa-google-plus-official' => 'fa-google-plus',
        //         'fa-linkedin-square'      => 'fa-linkedin',
        //         'fa-youtube-play'         => 'fa-youtube'
        // )

        ?>
        <div class="inline-facts-wrap">
            <div class="inline-facts">
                <?php if($new_icon) : ?><i class="<?php echo $new_icon;?>"></i><?php endif; ?>
                <div class="milestone-counter">
                    <div class="stats animaper">
                        <div class="num" data-content="0" data-num="<?php echo $settings['number'];?>"><?php echo $settings['number'];?></div>
                    </div>
                </div>
                <?php if($settings['title']) : ?><h6><?php echo $settings['title'];?></h6><?php endif; ?>
            </div>
        </div>
        <?php
        endif;
    }

    protected function _content_templates() {
        ?>
        <# var new_icon = '';
            if(settings.icon) { new_icon = settings.icon.replace('fa fa-map-o','far fa-map').replace('fa-bitbucket-square','fab fa-bitbucket')  }
        #>
        <# if(settings.number){ #>
        <div class="inline-facts-wrap">
            <div class="inline-facts">
                <# if(new_icon) { #><i class="{{new_icon}}"></i><# } #>
                <div class="milestone-counter">
                    <div class="stats animaper">
                        <div class="num" data-content="0" data-num="{{settings.number}}">{{{settings.number}}}</div>
                    </div>
                </div>
                <# if(settings.title){ #><h6>{{{settings.title}}}</h6><# } #>
            </div>
        </div>
        <# } #>
        <?php
    }

   
    

}



