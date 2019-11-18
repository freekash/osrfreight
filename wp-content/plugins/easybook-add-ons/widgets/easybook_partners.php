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
class EasyBook_Partners extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array('classname' => 'easybook_partners', 'description' => __( "EasyBook partners widget",'easybook-add-ons') );
		// Add Widget scripts
   		// add_action('admin_enqueue_scripts', array($this, 'scripts'));
 
		parent::__construct('easybook-partners', __('EasyBook Partners','easybook-add-ons'), $widget_ops);
		$this->alt_option_name = 'easybook_partners';
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
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Partners widget' ,'easybook-add-ons');

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$widget_imgs = isset( $instance['widget_imgs'] ) ? $instance['widget_imgs'] : array();
		$widget_link = ! empty( $instance['widget_link'] ) ? $instance['widget_link'] : '';

		?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-9">
				<div class="partners-widget">
					<ul class="partners-img-carousel">
						<?php 
							$target = !empty( $instance['show_in_new_tab'] ) ? 'target="_blank"' : 'target="_self"';
			      	    	$widget_links=explode(',',$widget_link);
			      	    	$arraye = array_combine($widget_imgs, $widget_links);
			      	    	foreach ($arraye as $key => $value) {
			      	    		$widget_imges_id = wp_get_attachment_image( $key, array('183', '93'));
			      	    		echo '<li><a href="'.$value.'" '.$target.'>'.$widget_imges_id.'</a></li>';
			      	    	}
		      	    	?>
					</ul>
			        <div class="sp-cont partners-img-prev"><i class="fa fa-angle-left"></i></div>
		            <div class="sp-cont partners-img-next"><i class="fa fa-angle-right"></i></div> 
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

		$instance['widget_link'] = ( ! empty( $new_instance['widget_link'] ) ) ? $new_instance['widget_link'] : '';

		$instance['show_in_new_tab'] = ! empty( $new_instance['show_in_new_tab'] );

		$instance['widget_imgs'] = ( ! empty( $new_instance['widget_imgs'] ) ) ? $new_instance['widget_imgs'] : array();

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

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'banner_img' => '') );

		$title     = sanitize_text_field( $instance['title'] );
		$widget_link = isset( $instance['widget_link'] ) ? $instance['widget_link'] : '';
		$show_in_new_tab = isset( $instance['show_in_new_tab'] ) ? $instance['show_in_new_tab'] : 1;
		$widget_imgs = isset( $instance['widget_imgs'] ) ? $instance['widget_imgs'] : array();
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'easybook-add-ons'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>


   		<p><input id="<?php echo $this->get_field_id('show_in_new_tab'); ?>" name="<?php echo $this->get_field_name('show_in_new_tab'); ?>" type="checkbox"<?php checked( $show_in_new_tab ); ?> />&nbsp;<label for="<?php echo $this->get_field_id('show_in_new_tab'); ?>"><?php _e('Open in new tab','easybook-add-ons'); ?></label></p>

   		<?php 
        // $headerimgs = get_post_meta( $listing_id, ESB_META_PREFIX.'headerimgs', true );
        // var_dump($headerimgs);
        easybook_addons_get_template_part( 'template-parts/images-select', false, array( 'name'=> $this->get_field_name('widget_imgs'), 'datas'=> $widget_imgs ) );
        ?>
        <p><label for="<?php echo $this->get_field_id( 'widget_link' ); ?>"><?php _e( 'Link:' ,'easybook-add-ons'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'widget_link' ); ?>" name="<?php echo $this->get_field_name( 'widget_link' ); ?>" type="text" value="<?php echo $widget_link; ?>" /></p>
		<p><?php _e('Enter the path for the image. For example: faceboook.com, youtube.com, ... links separated by accents ",".','easybook-add-ons');?></p>

<?php
	}
}
