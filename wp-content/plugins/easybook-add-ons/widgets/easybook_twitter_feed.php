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
 * Core class used to implement a Twitter Feed widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class EasyBook_Twitter_Feed extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'easybook_twitter_feed', 
			'description' => __( "Display tweets on your site.",'easybook-add-ons') 
		);
		parent::__construct('easybook-twitter-feed', __('EasyBook Twitter Feed','easybook-add-ons'), $widget_ops);
		$this->alt_option_name = 'easybook_twitter_feed';
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

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$show_user = isset( $instance['show_user'] ) ? $instance['show_user'] : false;
		$hidden_user = ($show_user == false)? 'tweet-hidden-user' : '';
		$interact = isset( $instance['interact'] ) ? $instance['interact'] : false;
		$hidden_interact = ($interact == false)? 'tweet-hidden-interact' : '';
		$username =  $instance['username'];
		$list = $instance['list'];
		$hashtag = $instance['hashtag'];
		$count = ( ! empty( $instance['count'] ) ) ? absint( $instance['count'] ) : 2;
		if ( ! $count )
			$count = 2;

		$follow_url = $instance['follow_url'];
		$list_ticker = $instance['list_ticker'];

		?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<div class="tweet easybook-tweet tweet-count-<?php echo esc_attr($count );?> tweet-ticker-<?php echo esc_attr($list_ticker );?>" data-username="<?php echo esc_attr($username );?>" data-list="<?php echo esc_attr($list );?>" data-hashtag="<?php echo esc_attr($hashtag );?>" data-ticker="<?php echo esc_attr($list_ticker );?>" data-count="<?php echo esc_attr($count );?>" data-hiddenuser="<?php echo esc_attr($hidden_user);?>" data-hiddenint="<?php echo esc_attr($hidden_interact);?>"></div>
		<?php 
		if($follow_url != '') : ?>
		<div class="follow-wrap">
			<a  href="<?php echo esc_url( $follow_url );?>" target="_blank" class="twiit-button"><?php _e(' Follow Us','easybook-add-ons');?></a>  
		</div>
		<?php endif;?>

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
		$instance['username'] = $new_instance['username'];
		$instance['list'] = $new_instance['list'];
		$instance['hashtag'] = $new_instance['hashtag'];
		$instance['follow_url'] = $new_instance['follow_url'];
		$instance['count'] = (int) $new_instance['count'];
		$instance['show_user'] = isset( $new_instance['show_user'] ) ? (bool) $new_instance['show_user'] : false;
		$instance['interact'] = isset( $new_instance['interact'] ) ? (bool) $new_instance['interact'] : false;
		$instance['list_ticker'] = $new_instance['list_ticker'];

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
		$username    = isset( $instance['username'] ) ?  $instance['username'] : '';
		$list    = isset( $instance['list'] ) ?  $instance['list'] : '';
		$hashtag    = isset( $instance['hashtag'] ) ?  $instance['hashtag'] : '';
		$count    = isset( $instance['count'] ) ? absint( $instance['count'] ) : 2;

		$follow_url    = isset( $instance['follow_url'] ) ?  $instance['follow_url'] : '';
		$show_user = isset( $instance['show_user'] ) ? (bool) $instance['show_user'] : false;
		$interact = isset( $instance['interact'] ) ? (bool) $instance['interact'] : false;
		$list_ticker    = isset( $instance['list_ticker'] ) ?  $instance['list_ticker'] : '';
		
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title' ,'easybook-add-ons'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		
		<p><label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Username' ,'easybook-add-ons'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo $username; ?>" /></p>
		<p><?php _e('Option to load tweets from another account - Optional. Leave this empty to load from your own (account with API keys on <strong>Settings -> EasyBook Add-Ons -> Twitter Feeds Section</strong> tab).','easybook-add-ons');?></p>
		<p><input class="checkbox" type="checkbox"<?php checked( $show_user ); ?> id="<?php echo $this->get_field_id( 'show_user' ); ?>" name="<?php echo $this->get_field_name( 'show_user' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_user' ); ?>"><?php _e( 'Display Username?' ,'easybook-add-ons'); ?></label></p>

		
		<p><label for="<?php echo $this->get_field_id( 'list' ); ?>"><?php _e( 'List name' ,'easybook-add-ons'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'list' ); ?>" name="<?php echo $this->get_field_name( 'list' ); ?>" type="text" value="<?php echo $list; ?>" /></p>

		<p><?php _e('List name to load tweets from - Optional. If you define list name you also must define the username of the list owner in the Username option.','easybook-add-ons');?></p>

		<p><label for="<?php echo $this->get_field_id( 'hashtag' ); ?>"><?php _e( 'Hashtag' ,'easybook-add-ons'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'hashtag' ); ?>" name="<?php echo $this->get_field_name( 'hashtag' ); ?>" type="text" value="<?php echo $hashtag; ?>" /></p>
		<p><?php _e('Option to load tweets with a specific hashtag - Optional.','easybook-add-ons');?></p>
		
		
		<p><label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Number of tweets you want to display.' ,'easybook-add-ons'); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="number" step="1" min="1" value="<?php echo $count; ?>" size="3" /></p>

		<p><label for="<?php echo $this->get_field_id( 'follow_url' ); ?>"><?php _e( 'Follow Us link' ,'easybook-add-ons'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'follow_url' ); ?>" name="<?php echo $this->get_field_name( 'follow_url' ); ?>" type="text" value="<?php echo $follow_url; ?>" /></p>

		<p>
			<label for="<?php echo $this->get_field_id( 'list_ticker' ); ?>"><?php _e( 'Display tweets as a list ticker','easybook-add-ons'); ?></label>
			<select id="<?php echo $this->get_field_id( 'list_ticker' ); ?>" name="<?php echo $this->get_field_name( 'list_ticker' ); ?>">
				<option value="no" <?php selected( $list_ticker, 'no' ); ?>>
					<?php _e( 'No','easybook-add-ons'); ?>
				</option>
				<option value="yes" <?php selected( $list_ticker, 'yes' ); ?>>
					<?php _e( 'Yes','easybook-add-ons'); ?>
				</option>
				
			</select>
		</p>
		<p><input class="checkbox" type="checkbox"<?php checked( $interact ); ?> id="<?php echo $this->get_field_id( 'interact' ); ?>" name="<?php echo $this->get_field_name( 'interact' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'interact' ); ?>"><?php _e( 'Display Interact?' ,'easybook-add-ons'); ?></label></p>
		


<?php
	}
}
