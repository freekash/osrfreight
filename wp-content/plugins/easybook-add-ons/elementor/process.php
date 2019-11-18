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

class CTH_Process extends Widget_Base { 

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
        return 'process';
    }

    // public function get_id() {
    //    	return 'header-search';
    // }

    public function get_title() {
        return __( 'Process', 'easybook-add-ons' );
    }

    public function get_icon() {
        // Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
        return 'eicon-sync';
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

        
        // $this->add_control(
        //     'step',
        //     [
        //         'label' => __( 'Step', 'easybook-add-ons' ),
        //         'type' => Controls_Manager::TEXT,
        //         'default' => '01 . ',
        //         // 'label_block' => true,
                
        //     ]
        // );

        $this->add_control(
            'icon',
            [
                'label' => __( 'Icon', 'easybook-add-ons' ),
                'type' => Controls_Manager::ICON,
                // 'include' => [
                //     'fa fa-facebook',
                //     'fa fa-flickr',
                //     'fa fa-google-plus',
                //     'fa fa-instagram',
                //     'fa fa-linkedin',
                //     'fa fa-pinterest',
                //     'fa fa-reddit',
                //     'fa fa-twitch',
                //     'fa fa-twitter',
                //     'fa fa-vimeo',
                //     'fa fa-youtube',
                // ],
                'default' => 'fa fa-map-o',
            ]
        );

    
        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Find Interesting Placek',
                'label_block' => true,
                
            ]
        );

        $this->add_control(
            'desc',
            [
                'label' => __( 'Description', 'easybook-add-ons' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => '<p>Proin dapibus nisl ornare diam varius tempus. Aenean a quam luctus, finibus tellus ut, convallis eros sollicitudin turpis.</p>',
                'show_label' => false,
                
            ]
        );

        $this->add_control(
            'show_decor',
            [
                'label' => __( 'Show Right Decoration', 'easybook-add-ons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Yes', 'easybook-add-ons' ),
                'label_off' => __( 'No', 'easybook-add-ons' ),
                'return_value' => 'yes',
            ]
        );

        

        

        $this->end_controls_section();

        

    }

    protected function render( ) {
        $settings = $this->get_settings();
        
        ?>
        <div class="process-item-wrap">
            <div class="process-item">
                <?php if($settings['icon']) : ?><div class="time-line-icon"><i class="<?php echo $settings['icon'];?>"></i></div><?php endif; ?>
                <?php if($settings['title']) : ?><h4><?php echo $settings['title'];?></h4><?php endif; ?>
                <?php echo $settings['desc'];?>
            </div>
            <?php if($settings['show_decor'] == 'yes') echo '<span class="pr-dec"></span>'; ?>
        </div>
        <?php
    }

    protected function _content_template() {
        ?>
        <div class="process-item-wrap">
            <div class="process-item">
               
                <# if(settings.icon){ #><div class="time-line-icon"><i class="{{settings.icon}}"></i></div><# } #>
                <# if(settings.title){ #><h4>{{{settings.title}}}</h4><# } #>
                {{{settings.desc}}}
            </div>
            <# if(settings.show_decor=='yes'){ #><span class="pr-dec"></span><# } #>
        </div>
        <?php
    }

   
    

}

