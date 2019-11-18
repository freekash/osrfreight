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

class CTH_Collage_Images extends Widget_Base {

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
        return 'collage_images';
    }

    // public function get_id() {
    //      return 'header-search';
    // }

    public function get_title() {
        return __( 'Collage Images', 'easybook-add-ons' );
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
            'title',
            [
                'label'       => __( 'Title', 'easybook-add-ons' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => 'Easy<span>Book</span>',
                'label_block' => true,
                
            ]
        );

        $this->add_control(
            'images',
            [
                'label' => __( 'Images', 'easybook-add-ons' ),
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'order' => '',
                        'title' => 'Main Image - Avatar 1',
                        'image' => array(
                            'id'=>'3409',
                            'url' => Utils::get_placeholder_image_src(),
                        ),
                        'left_pos' => '',
                        'top_pos' => '',
                        'zindex' => '',
                        'use_animation' => '',
                        'use_content'=> '',
                        'content' => '',
                        'show_icon' => '',
                        'icon'    => '',
                    ],
                    [
                        'order' => '2',
                        'title' => 'Image 2 - Avatar 2',
                        'image' => array(
                            'id'=>'3470',
                            'url' => Utils::get_placeholder_image_src(),
                        ),
                        'left_pos' => '78',
                        'top_pos' => '35',
                        'zindex' => '2',
                        'use_animation' => 'yes',
                        'use_content'=> '',
                        'content' => '',
                        'show_icon' => '',
                        'icon'    => '',
                    ],
                    [
                        'order' => '1',
                        'title' => 'Image 3 - Avatar 4',
                        'image' => array(
                            'id'=>'3471',
                            'url' => Utils::get_placeholder_image_src(),
                        ),
                        'left_pos' => '70',
                        'top_pos' => '61',
                        'zindex' => '5',
                        'use_animation' => 'yes',
                        'use_content'=> '',
                        'content' => '',
                        'show_icon' => '',
                        'icon'    => '',
                    ],
                    [
                        'order' => '3',
                        'title' => 'Image 4 - Avatar 6',
                        'image' => array(
                            'id'=>'3472',
                            'url' => Utils::get_placeholder_image_src(),
                        ),
                        'left_pos' => '26',
                        'top_pos' => '82',
                        'zindex' => '11',
                        'use_animation' => 'yes',
                        'use_content'=> '',
                        'content' => '',
                        'show_icon' => '',
                        'icon'    => '',
                    ],
                    [
                        'order' => '',
                        'title' => 'Search - Avatar 5',
                        'image' => array(
                            'id'=>'',
                            'url' => Utils::get_placeholder_image_src(),
                        ),
                        'left_pos' => '90',
                        'top_pos' => '10',
                        'zindex' => '11',
                        'use_animation' => '',
                        'use_content'=> 'yes',
                        'content' => 'Search',
                        'show_icon' => 'yes',
                        'icon'    => 'fa fa-search',
                    ],
                    [
                        'order' => '',
                        'title' => 'Booking now - Avatar 7',
                        'image' => array(
                            'id'=>'',
                            'url' => Utils::get_placeholder_image_src(),
                        ),
                        'left_pos' => '67',
                        'top_pos' => '0',
                        'zindex' => '11',
                        'use_animation' => '',
                        'use_content'=> 'yes',
                        'content' => 'Booking now',
                        'show_icon' => 'no',
                        'icon'    => '',
                    ],
                ],
                'fields' => [ //,1971,1973,1975,1974
                    [
                        'name' => 'title',
                        'label' => __( 'Image Title', 'easybook-add-ons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => 'Image Title',
                        'label_block' => true,
                        'description' => __( 'For editing only', 'easybook-add-ons' ),
                    ],
                    [
                        'name' => 'image',
                        'label' => __( 'Image', 'easybook-add-ons' ),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                         ],
                    ],
                    [
                        'name' => 'left_pos',
                        'label' => __( 'Left Position', 'easybook-add-ons' ),
                        'type' => Controls_Manager::NUMBER,
                        'default' => '23',
                        'description' => __( 'Left position (%) related to element (top-left corner) ', 'easybook-add-ons' ),
                    ],
                    [
                        'name' => 'top_pos',
                        'label' => __( 'Top Position', 'easybook-add-ons' ),
                        'type' => Controls_Manager::NUMBER,
                        'default' => '10',
                        'description' => __( 'Left position (%) related to element (top-left corner) ', 'easybook-add-ons' ),
                    ],
                    [
                        'name' => 'zindex',
                        'label' => __( 'Zindex', 'easybook-add-ons' ),
                        'type' => Controls_Manager::NUMBER,
                        'default' => '0',
                        'description' => __( 'Use to control image displaying in Z axis.', 'easybook-add-ons' ),
                    ],
                    [
                        'name' => 'use_animation',
                        'label' => __( 'Animation Image?', 'easybook-add-ons' ),
                        'type' => Controls_Manager::SWITCHER,
                        'default' => '',
                        'label_on' => __( 'Yes', 'easybook-add-ons' ),
                        'label_off' => __( 'No', 'easybook-add-ons' ),
                        'return_value' => 'yes',
                    ],
                    [
                        'name' => 'order',
                        'label' => __( 'Animation Duration Order', 'easybook-add-ons' ),
                        'type' => Controls_Manager::NUMBER,
                        'default' => '1',
                        'description' => __( 'Choose from 1 to 5: 1-0s, 2-2.5s, 3-3.5s, 4-4.5s, 5-5.5s', 'easybook-add-ons' ),
                    ],
                    [
                        'name' => 'use_content',
                        'label' => __( 'Display content?', 'easybook-add-ons' ),
                        'type' => Controls_Manager::SWITCHER,
                        'default' => '',
                        'label_on' => __( 'Yes', 'easybook-add-ons' ),
                        'label_off' => __( 'No', 'easybook-add-ons' ),
                        'return_value' => 'yes',
                    ],
                    [
                        'name' => 'content',
                        'label' => __( 'Content', 'easybook-add-ons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => 'Booking now',
                        'label_block' => true,
                        'description' => __( 'For editing only', 'easybook-add-ons' ),
                    ],
                    [
                        'name' => 'show_icon',
                        'label' => __( 'Display Icon?', 'easybook-add-ons' ),
                        'type' => Controls_Manager::SWITCHER,
                        'default' => '',
                        'label_on' => __( 'Yes', 'easybook-add-ons' ),
                        'label_off' => __( 'No', 'easybook-add-ons' ),
                        'return_value' => 'yes',
                    ],
                    [
                        'name' => 'icon',
                        'label' => __( 'Icon', 'easybook-add-ons' ),
                        'type' => Controls_Manager::ICON,
                        'default' => '',
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );



        

        $this->end_controls_section();

    }

    protected function render( ) {
        $settings = $this->get_settings();
        if(is_array($settings['images']) && !empty($settings['images']) ):
            
        ?>
        <div class="images-collage fl-wrap">
            <div class="images-collage-title anim-col"><?php echo $settings['title']; ?></div>
            <?php 
            foreach ($settings['images'] as $key => $image) {
                if ($image['use_content'] == 'yes') { 
                    $img_class = ($image['show_icon'] == 'yes' ? 'collage-image-input' :'collage-image-btn color2-bg');
                }else{
                    $img_class = ($key == 0 ? 'main-collage-image' : 'images-collage-item images-collage-other');
                }

                if($image['use_animation'] == 'yes') $img_class .= ' cim-'.$image['order'];
                $img_datas = '';
                if($image['left_pos']) $img_datas .= ' data-position-left="'.$image['left_pos'].'"';
                if($image['top_pos']) $img_datas .= ' data-position-top="'.$image['top_pos'].'"';
                if($image['zindex']) $img_datas .= ' data-zindex="'.$image['zindex'].'"';

                $img_size = ($key == 0 ? 'full' : array(90,90));
                $animation_duration = ($key == 0 ? 'animation-duration-0s' : 'animation-duration-');
                ?>
                <div class="<?php echo esc_attr( $img_class ); ?>" <?php echo $img_datas; ?>>
                    <?php 
                    if ($image['use_content'] == 'yes'){
                        echo $image['content'];
                        if ($image['show_icon'] == 'yes'){ ?>
                            <i class="<?php echo $image['icon']; ?>"></i>
                        <?php }
                    }else{
                        echo wp_get_attachment_image( $image['image']['id'],  $img_size, false, array('class'=>'no-lazy') );
                    }
                    ?>
                </div>
            <?php 
            }
            ?>
        </div>
        <?php
        endif;
    }

    // protected function _content_template() {
    //     
    //     <# if(_.isArray(settings.images) && settings.images.length){ #>
    //     <div class="images-collage fl-wrap">
    //         <div class="images-collage-title">{{{settings.title}}}</div>
    //         <# _.each(settings.images,function(image,index){ 
            
    //             var cls = 'images-collage-item' + (index == 0? ' images-collage-main':' images-collage-other');
    //             if(image.use_animation == 'yes') cls += ' anim-col';
                
    //             var img_datas = '';
    //             if(image.left_pos) img_datas += ' data-position-left="'+image.left_pos+'"';
    //             if(image.top_pos) img_datas += ' data-position-top="'+image.top_pos+'"';
    //             if(image.zindex) img_datas += ' data-zindex="'+image.zindex+'"';
    //         #>
    //             <div class="{{cls}}"{{{img_datas}}}><img src="{{image.image.url}}" alt="{{image.image.title}}"></div>
    //         <# }) #>
    //     </div>
    //     <# } #>
    //     <?php
    // }
    // end _content_template



}
