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

class CTH_Our_Partners extends Widget_Base {

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
        return 'our_partners';
    }

    // public function get_id() {
    //    	return 'header-search';
    // }

    public function get_title() {
        return __( 'Our Partners', 'easybook-add-ons' );
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
            'section_images',
            [
                'label' => __( 'Content', 'easybook-add-ons' ),
            ]
        );

        $this->add_control(
            'images',
            [
                'label' => __( 'Partners Images', 'easybook-add-ons' ),
                'type' => Controls_Manager::GALLERY,
                'default' => array(
                    array('id' => 1843,'url'=>''),
                    array('id' => 1844,'url'=>''),
                    array('id' => 1845,'url'=>''),
                    array('id' => 1846,'url'=>''),
                    array('id' => 1847,'url'=>''),
                    array('id' => 1848,'url'=>''),
                )
            ]
        );

        $this->add_control(
            'links',
            [
                'label' => __( 'Partner Links', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXTAREA, // WYSIWYG,
                'default' => 'https://jquery.com/|https://envato.com/|https://wordpress.org/|https://jquery.com/|https://envato.com/|https://wordpress.org/',
                // 'show_label' => false,
                'description' => __( 'Enter links for each partner (Note: divide links with linebreaks (Enter) or | and no spaces).', 'easybook-add-ons' )
            ]
        );

        $this->add_control(
            'is_external',
            [
                'label' => __( 'Is External Links', 'easybook-add-ons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Show', 'easybook-add-ons' ),
                'label_off' => __( 'Hide', 'easybook-add-ons' ),
                'return_value' => 'yes',
            ]
        );

        

        $this->end_controls_section();

        // $this->start_controls_section(
        //     'section_layout',
        //     [
        //         'label' => __( 'Posts Layout', 'easybook-add-ons' ),
        //     ]
        // );

       
        // $this->add_control(
        //     'excerpt_length',
        //     [
        //         'label' => __( 'Post Description Length', 'easybook-add-ons' ),
        //         'type' => Controls_Manager::NUMBER,
        //         'default' => '250',
        //         'min'     => 0,
        //         'max'     => 500,
        //         'step'    => 10,
                
                
        //     ]
        // );

        // $this->add_control(
        //     'show_author',
        //     [
        //         'label' => __( 'Show Author', 'easybook-add-ons' ),
        //         'type' => Controls_Manager::SWITCHER,
        //         'default' => 'yes',
        //         'label_on' => __( 'Show', 'easybook-add-ons' ),
        //         'label_off' => __( 'Hide', 'easybook-add-ons' ),
        //         'return_value' => 'yes',
        //     ]
        // );

        // $this->add_control(
        //     'show_date',
        //     [
        //         'label' => __( 'Show Date', 'easybook-add-ons' ),
        //         'type' => Controls_Manager::SWITCHER,
        //         'default' => 'yes',
        //         'label_on' => __( 'Show', 'easybook-add-ons' ),
        //         'label_off' => __( 'Hide', 'easybook-add-ons' ),
        //         'return_value' => 'yes',
        //     ]
        // );

        // $this->add_control(
        //     'show_views',
        //     [
        //         'label' => __( 'Show Views', 'easybook-add-ons' ),
        //         'type' => Controls_Manager::SWITCHER,
        //         'default' => 'yes',
        //         'label_on' => __( 'Show', 'easybook-add-ons' ),
        //         'label_off' => __( 'Hide', 'easybook-add-ons' ),
        //         'return_value' => 'yes',
        //     ]
        // );

        // $this->add_control(
        //     'show_cats',
        //     [
        //         'label' => __( 'Show Categories', 'easybook-add-ons' ),
        //         'type' => Controls_Manager::SWITCHER,
        //         'default' => 'yes',
        //         'label_on' => __( 'Show', 'easybook-add-ons' ),
        //         'label_off' => __( 'Hide', 'easybook-add-ons' ),
        //         'return_value' => 'yes',
        //     ]
        // );

        // $this->add_control(
        //     'read_all_link',
        //     [
        //         'label' => __( 'Read All URL', 'easybook-add-ons' ),
        //         'type' => Controls_Manager::URL,
        //         'default' => [
        //             'url' => 'http://',
        //             'is_external' => '',
        //         ],
        //         'show_external' => true, // Show the 'open in new tab' button.
        //     ]
        // );


        // $this->add_control(
        //     'show_pagination',
        //     [
        //         'label' => __( 'Show Pagination', 'easybook-add-ons' ),
        //         'type' => Controls_Manager::SWITCHER,
        //         'default' => 'no',
        //         'label_on' => __( 'Show', 'easybook-add-ons' ),
        //         'label_off' => __( 'Hide', 'easybook-add-ons' ),
        //         'return_value' => 'yes',
        //     ]
        // );


        


        // $this->end_controls_section();

    }

    protected function render( ) {

        $settings = $this->get_settings();

        
        $css_classes = array(
            'fl-wrap spons-list',
            // 'posts-grid-',//.$settings['columns_grid']
        );

        $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

        // var_dump($settings['images']);
        if(is_array($settings['images']) && !empty($settings['images'])):

            $seppos = strpos(strip_tags($settings['links']), "|");
            if($seppos !== false){
                $partnerslinks = explode("|", strip_tags($settings['links']));
            }else{
                $partnerslinks = preg_split( '/\r\n|\r|\n/', strip_tags($settings['links']) );//explode("\n", $content);
            }
        ?>
        <div class="<?php echo esc_attr($css_class );?>">
            <ul class="client-carousel">
                <?php 
                foreach ($settings['images'] as $key => $image) {
                    echo '<li>';
                    if(isset($partnerslinks[$key])){
                        $target = $settings['is_external'] == 'yes'? ' target="_blank"':'';
                        echo '<a href="'.esc_url($partnerslinks[$key] ).'"'.$target.'>';
                    }else{
                        echo '<a href="javascript:void(0);">';
                    }
                    
                    echo wp_get_attachment_image( $image['id'],  'partner' );
                    echo '</a></li>';
                }
                ?>
            </ul>
            <div class="sp-cont sp-cont-prev"><i class="fa fa-angle-left"></i></div>
            <div class="sp-cont sp-cont-next"><i class="fa fa-angle-right"></i></div>
        </div>
        <?php
        endif;
    }

    protected function _content_template() {}

   
    

}
