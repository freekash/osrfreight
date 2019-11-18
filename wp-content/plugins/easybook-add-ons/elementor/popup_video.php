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

class CTH_Popup_Video extends Widget_Base {

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
        return 'popup_video';
    }

    // public function get_id() {
    //    	return 'header-search';
    // }

    public function get_title() {
        return __( 'Popup Video', 'easybook-add-ons' );
    }

    public function get_icon() {
        // Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
        return 'fa fa-video-camera';
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
            'video_url',
            [
                'label' => __( 'Video URL', 'easybook-add-ons' ),
                'description' => __( 'Your Youtube, Vimeo or hosted video url', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' =>'https://vimeo.com/110234211',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => __( 'Image', 'easybook-add-ons' ),
                'type' => Controls_Manager::MEDIA,
                'default' =>[
                                'url' => Utils::get_placeholder_image_src(),
                            ],
            ]

        );
        $this->add_control(
            'video_title',
            [
                'label' => __( 'Video Title', 'easybook-add-ons' ),
                // 'description' => __( '', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' =>'Our Video Presentation',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'icon',
            [
                'label' => __( 'Button Icon', 'easybook-add-ons' ),
                'type' => Controls_Manager::ICON,
                'default'=>'fa fa-play',
            ]
        );


        $this->end_controls_section();

    }

    protected function render( ) {
        $settings = $this->get_settings();
        ?>
        <div class="video-box fl-wrap">
            <?php if($settings['image']['id']) echo wp_get_attachment_image( $settings['image']['id'], 'full' ); ?>
            <?php if($settings['video_url'] != ''): ?><a class="video-box-btn image-popup" href="<?php echo esc_url( $settings['video_url']);?>"><i class="<?php echo esc_attr( $settings['icon']);?>" aria-hidden="true"></i></a>
            <span class="video-box-title"><?php echo $settings['video_title'];?></span>
        <?php endif; ?>
        </div>
        <?php
    }

    protected function _content_template() {
        ?>
        <div class="video-box fl-wrap">
            <# if(settings.image.url){ #><img src="{{settings.image.url}}" alt=""><# } #>
            <# if(settings.video_url != ''){ #><a class="video-box-btn image-popup" href="{{settings.video_url}}"><i class="{{settings.icon}}" aria-hidden="true"></i></a><# } #>
            <# if(settings.video_title != ''){ #>
            <span class="video-box-title">{{{settings.video_title}}}</span>
            <# } #>
        </div>
        <?php
    }

   
   

}

// Plugin::instance()->widgets_manager->register_widget( 'Elementor\Widget_Header_Search' );

// Plugin::$instance->elements_manager->create_element_instance

