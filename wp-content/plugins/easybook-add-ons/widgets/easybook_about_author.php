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



/**
 * Core class used to implement a Recent Posts widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class EasyBook_About_Author extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array('classname' => 'easybook_about_author', 'description' => __( "EasyBook about author widget",'easybook-add-ons') );
		// Add Widget scripts
   		add_action('admin_enqueue_scripts', array($this, 'scripts'));
 
		parent::__construct('easybook-about-author', __('EasyBook Author','easybook-add-ons'), $widget_ops);
		$this->alt_option_name = 'easybook_about_author';
	}

	public function scripts()
	{
	   	wp_enqueue_script( 'media-upload' );
	   	wp_enqueue_media();
	   	wp_enqueue_script('easybook_au_wid_js', ESB_DIR_URL . 'assets/admin/easybook_au_wid_js.js', array('jquery'));
	}

	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'About Author' ,'easybook-add-ons');

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$au_text = ! empty( $instance['text'] ) ? $instance['text'] : '';
		$au_name = ! empty( $instance['au_name'] ) ? $instance['au_name'] : '';
		$au_sub = ! empty( $instance['au_sub'] ) ? $instance['au_sub'] : '';

		$au_photo = ! empty( $instance['au_photo'] ) ? $instance['au_photo'] : '';
		$au_link = ! empty( $instance['au_link'] ) ? $instance['au_link'] : 'javascript:void(0)';
		$au_socials = ! empty( $instance['au_socials'] ) ? $instance['au_socials'] : '';



		$text = apply_filters( 'easybook_author_widget_text', $au_text, $instance, $this );

		?>

		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
			<div class="box-widget list-author-widget">
                <div class="list-author-widget-header fl-wrap">
                	<div class="box-widget-author-title-img ">
						<?php if($au_photo): ?>
				      		<img src="<?php echo esc_url($au_photo); ?>" class="respimg" alt="<?php echo esc_html($au_name); ?>">
				   		<?php endif;?>
                	</div>
                	<?php if($au_name): ?>
			            <span class="list-author-widget-link"><a href="<?php echo $au_link; ?>"><?php echo esc_html($au_name); ?></a></span>
			        <?php endif;?>
			        <?php if($au_sub): ?>
			            <span><?php echo esc_html($au_sub); ?></span>
			        <?php endif;?>
                </div>
                <div class="box-widget-content">
                    <div class="list-author-widget-text">
                        <div class="list-author-widget-contacts">
                            <?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?>
                        </div>
                        <?php if($au_socials !=''): ?>
                        <div class="list-widget-social">
							<?php echo $au_socials; ?>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>

        <?php echo $args['after_widget']; ?>

	<?php

	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		$instance['au_photo'] = ( ! empty( $new_instance['au_photo'] ) ) ? $new_instance['au_photo'] : '';
		$instance['au_link'] = ( ! empty( $new_instance['au_link'] ) ) ? $new_instance['au_link'] : '';

		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = wp_kses_post( $new_instance['text'] );
		}

		$instance['au_name'] = ( ! empty( $new_instance['au_name'] ) ) ? $new_instance['au_name'] : '';
		$instance['au_sub'] = ( ! empty( $new_instance['au_sub'] ) ) ? $new_instance['au_sub'] : '';
		$instance['au_socials'] = ( ! empty( $new_instance['au_socials'] ) ) ? $new_instance['au_socials'] : '';

		$instance['filter'] = ! empty( $new_instance['filter'] );

		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '','au_photo' => '', 'au_sig' => '') );

		$title     = sanitize_text_field( $instance['title'] );
		$au_photo = ! empty( $instance['au_photo'] ) ? $instance['au_photo'] : '';
		$au_sig = ! empty( $instance['au_sig'] ) ? $instance['au_sig'] : '';

		

		$au_name = isset( $instance['au_name'] ) ? $instance['au_name'] : '';
		$au_sub = isset( $instance['au_sub'] ) ? $instance['au_sub'] : '';
		$au_link = isset( $instance['au_link'] ) ? $instance['au_link'] : '';
		$au_socials = isset( $instance['au_socials'] ) ? $instance['au_socials'] : '<ul>
    <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
    <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
    <li><a href="#" target="_blank"><i class="fab fa-vk"></i></a></li>
    <li><a href="#" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
</ul>';
		$filter = isset( $instance['filter'] ) ? $instance['filter'] : 0;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'easybook-add-ons'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p>
      	<label for="<?php echo $this->get_field_id( 'au_photo' ); ?>"><?php _e( 'Author Photo:','easybook-add-ons' ); ?></label>
      	<input class="widefat" id="<?php echo $this->get_field_id( 'au_photo' ); ?>" name="<?php echo $this->get_field_name( 'au_photo' ); ?>" type="text" value="<?php echo esc_url( $au_photo ); ?>" />
      	<br />
      	<button class="easybook_author_upload_image_button button button-primary"><?php _e('Upload Image','easybook-add-ons');?></button>
   		</p>

   		

   		<p><label for="<?php echo $this->get_field_id( 'au_name' ); ?>"><?php _e( 'Author Name:' ,'easybook-add-ons'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'au_name' ); ?>" name="<?php echo $this->get_field_name( 'au_name' ); ?>" type="text" value="<?php echo $au_name; ?>" /></p>


		<p><label for="<?php echo $this->get_field_id( 'au_sub' ); ?>"><?php _e( 'Author Sub:' ,'easybook-add-ons'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'au_sub' ); ?>" name="<?php echo $this->get_field_name( 'au_sub' ); ?>" type="text" value="<?php echo $au_sub; ?>" /></p>
		
		


		<p><label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Author Description:' ,'easybook-add-ons'); ?></label>
		<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $instance['text'] ); ?></textarea></p>

   		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox"<?php checked( $filter ); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs','easybook-add-ons'); ?></label></p>
		
		<p><label for="<?php echo $this->get_field_id( 'au_link' ); ?>"><?php _e( 'Author URL:' ,'easybook-add-ons'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'au_link' ); ?>" name="<?php echo $this->get_field_name( 'au_link' ); ?>" type="text" value="<?php echo $au_link; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id( 'au_socials' ); ?>"><?php _e( 'Socials:' ,'easybook-add-ons'); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id( 'au_socials' ); ?>" name="<?php echo $this->get_field_name( 'au_socials' ); ?>" rows="7"><?php echo $au_socials; ?></textarea></p>


		
<?php
	}
}
