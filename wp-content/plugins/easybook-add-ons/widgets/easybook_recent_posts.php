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
class EasyBook_Recent_Posts extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public 
	 */
	public function __construct() {
		$widget_ops = array('classname' => 'easybook_recent_posts', 'description' => __( "Your site&#8217;s most recent Posts.",'easybook-add-ons') );
		parent::__construct('easybook-recent-posts', __('EasyBook Recent Posts','easybook-add-ons'), $widget_ops);
		$this->alt_option_name = 'easybook_recent_posts';
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

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'EasyBook Recent Posts' ,'easybook-add-ons');

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$show_exp = isset( $instance['show_exp'] ) ? $instance['show_exp'] : false;
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$show_thumbnail = isset( $instance['show_thumbnail'] ) ? $instance['show_thumbnail'] : false;
		$show_comment = isset( $instance['show_comment'] ) ? $instance['show_comment'] : false;

		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );

		if ($r->have_posts()) :
		?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<div class="widget-posts fl-wrap">
			<ul>
			<?php while ( $r->have_posts() ) : $r->the_post(); ?>
				<li class="clearfix">
				<?php if(has_post_thumbnail( ) && $show_thumbnail == true) :?>
					<div class="box-image-widget-media">
		                <a href="<?php the_permalink(); ?>" class="widget-posts-img"><?php the_post_thumbnail( 'easybook-recent-post',array('class'=>'respimg'));?></a>
		                <a href="<?php the_permalink(); ?>" class="bt-details"><?php esc_html_e( 'Details', 'easybook-add-ons' ); ?></a>
		            </div>
	            <?php endif;?>

	            	<div class="widget-posts-descr<?php if($show_thumbnail == false || !has_post_thumbnail( ) ) echo ' widget-hide-thumb';?>">

	                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><h4><?php the_title() ; ?></h4></a>
	                    <?php if($show_exp == true) :
	                		$excerpt = get_the_excerpt();
                            echo substr($excerpt, 0, 70); 
	            		endif;?>
						<?php if ( $show_date || $show_comment ) : ?>
	                    <span class="widget-posts-date">
	                    <?php if ( $show_date ) : ?>
                            <span class="post-date"><i class="fal fa-calendar"></i> <?php echo get_the_date(esc_html__('d M Y','easybook-add-ons')); ?></span> 
                        <?php endif; ?>
                        <?php if ( $show_comment ) : ?>
                            <a href="<?php comments_link(); ?>" class="post-comments"><i class="far fa-comment"></i><?php
							printf( _nx( '%1$s Comment', '%1$s Comments', get_comments_number(), 'comments_num_title', 'easybook-add-ons' ),
								number_format_i18n( get_comments_number() ) );
						?></a> 
                        <?php endif; ?>
                        </span>
                        <?php endif; ?>

	                </div>
	            </li>
			<?php endwhile; ?>
            </ul>


        </div>


		<?php echo $args['after_widget']; ?>
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;
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
		$instance['show_exp'] = isset( $new_instance['show_exp'] ) ? (bool) $new_instance['show_exp'] : false;
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['show_thumbnail'] = isset( $new_instance['show_thumbnail'] ) ? (bool) $new_instance['show_thumbnail'] : false;
		$instance['show_comment'] = isset( $new_instance['show_comment'] ) ? (bool) $new_instance['show_comment'] : false;
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
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_exp = isset( $instance['show_exp'] ) ? (bool) $instance['show_exp'] : false;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		$show_thumbnail = isset( $instance['show_thumbnail'] ) ? (bool) $instance['show_thumbnail'] : false;
		$show_comment = isset( $instance['show_comment'] ) ? (bool) $instance['show_comment'] : false;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'easybook-add-ons'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ,'easybook-add-ons'); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>
		
		<p><input class="checkbox" type="checkbox"<?php checked( $show_exp ); ?> id="<?php echo $this->get_field_id( 'show_exp' ); ?>" name="<?php echo $this->get_field_name( 'show_exp' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_exp' ); ?>"><?php _e( 'Display post excerpt?' ,'easybook-add-ons'); ?></label></p>

		<p><input class="checkbox" type="checkbox"<?php checked( $show_thumbnail ); ?> id="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'show_thumbnail' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>"><?php _e( 'Display post thumbnail?' ,'easybook-add-ons'); ?></label></p>

		<p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?','easybook-add-ons'); ?></label></p>
		
		<p><input class="checkbox" type="checkbox"<?php checked( $show_comment ); ?> id="<?php echo $this->get_field_id( 'show_comment' ); ?>" name="<?php echo $this->get_field_name( 'show_comment' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_comment' ); ?>"><?php _e( 'Display comment count?','easybook-add-ons'); ?></label></p>


<?php
	}
}
