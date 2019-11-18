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

class CTH_Asked_Question extends Widget_Base {

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
        return 'asked_question';
    }

    // public function get_id() {
    //    	return 'header-search';
    // }

    public function get_title() {
        return __( 'Asked Question', 'easybook-add-ons' );
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
                'default'     => 'Frequently Asked Question',
                'label_block' => true,
                
            ]
        );
        $this->add_control(
            'asked_question',
            [
                    'label' => __( 'Question List', 'easybook-add-ons' ),
                    'type' => Controls_Manager::REPEATER,
                    'default' => [
                            [
                                'question_title' => 'Payments',
                                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat .',
                            ],
                            [
                                'question_title' => 'Suggestions',
                                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat .',
                            ],
                            [
                                'question_title' => 'Reccomendations',
                                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat .',
                            ],
                            [
                                'question_title' => 'Booking',
                                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat .',
                            ],
                    ],
                    'fields' => [
                            [
                                'name' => 'question_title',
                                'label' => __( 'Question Title', 'easybook-add-ons' ),
                                'type' => Controls_Manager::TEXT,
                                'default' => __( 'Payments' , 'easybook-add-ons' ),
                                'label_block' => true,
                            ],
                            [
                                'name' => 'content',
                                'label' => __( 'Content', 'easybook-add-ons' ),
                                'type' => Controls_Manager::WYSIWYG,
                                'default' => 'Qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram seacula quarta decima et quinta decima.',
                                'show_label' => false,
                            ],
                    ],
                    'title_field' => '{{{ name }}}',
            ]
        );
        $this->add_control(
            'class_css',
            [
                'label' => __( 'Extra class name', 'easybook-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'description' => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'easybook-add-ons'),
            ]
        );
        $this->end_controls_section();
    }

    protected function render( ) {
        $settings = $this->get_settings();
        $css_classes = array(
            'asked-question',
            $settings['class_css'],
        );

        $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
        $asked_question = $settings['asked_question'];
        if(is_array($settings['asked_question']) && !empty($settings['asked_question']) ):
         ?> 
           <div class="<?php echo $css_class;?>">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="box-widget-item fl-wrap help-bar">
                                <div class="box-widget">
                                    <div class="box-widget-content">
                                        <div class="box-widget-item-header">
                                            <h3><?php echo $settings['title']; ?></h3>
                                        </div>
                                        <div class="faq-nav fl-wrap">
                                            <ul id="myUL">
                                                <?php 
                                                foreach ($asked_question as $key => $asked_questiones) {
                                                        $key += 1;
                                                        $asked_class = ($key == 1 ? 'custom-scroll-link act-faq-link' : 'custom-scroll-link');
                                                    ?>
                                                    <li><a class="<?php echo $asked_class; ?>" href="#faq<?php echo $key;?>"><?php echo $asked_questiones['question_title'];?></a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                        <div class="search-widget">
                                            <form class="fl-wrap">
                                                <input id="myInput" type="text" class="search" placeholder="<?php _e( 'Enter Keyword', 'easybook-add-ons' ); ?>" value="">
                                                <button class="search-submit color2-bg" ><i class="fal fa-search transition"></i> </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="asked-question-item">
                                <?php 
                                    foreach ($asked_question as $key => $asked_questions) {
                                            $key += 1;?>
                                    <!--   list-single-main-item -->
                                    <div class="list-single-main-item fl-wrap" id="faq<?php echo $key;?>">
                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3><?php echo $asked_questions['question_title'];?></h3>
                                        </div>
                                        <p><?php echo $asked_questions['content'];?></p>
                                    </div>
                                    <!--   list-single-main-item end -->
                                <?php } ?>
                            </div>
                        </div> 
                    </div>
                </div>
           </div>
           <div class="limit-box"></div>
        <?php
        endif;

    }

    protected function _content_template() {}

   
    

}