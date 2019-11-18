<?php

/**
 * Class ActionScheduler_wpPostStore_PostTypeRegistrar
 * @codeCoverageIgnore
 */
class ActionScheduler_wpPostStore_PostTypeRegistrar {
	public function register() {
		register_post_type( ActionScheduler_wpPostStore::POST_TYPE, $this->post_type_args() );
	}

	/**
	 * Build the args array for the post type definition
	 *
	 * @return array
	 */
	protected function post_type_args() {
		$args = array(
			'label' => __( 'Scheduled Actions', 'easybook-add-ons' ),
			'description' => __( 'Scheduled actions are hooks triggered on a cetain date and time.', 'easybook-add-ons' ),
			'public' => false,
			'map_meta_cap' => true,
			'hierarchical' => false,
			'supports' => array('title', 'editor','comments'),
			'rewrite' => false,
			'query_var' => false,
			'can_export' => true,
			'ep_mask' => EP_NONE,
			'labels' => array(
				'name' => __( 'Scheduled Actions', 'easybook-add-ons' ),
				'singular_name' => __( 'Scheduled Action', 'easybook-add-ons' ),
				'menu_name' => _x( 'Scheduled Actions', 'Admin menu name', 'easybook-add-ons' ),
				'add_new' => __( 'Add', 'easybook-add-ons' ),
				'add_new_item' => __( 'Add New Scheduled Action', 'easybook-add-ons' ),
				'edit' => __( 'Edit', 'easybook-add-ons' ),
				'edit_item' => __( 'Edit Scheduled Action', 'easybook-add-ons' ),
				'new_item' => __( 'New Scheduled Action', 'easybook-add-ons' ),
				'view' => __( 'View Action', 'easybook-add-ons' ),
				'view_item' => __( 'View Action', 'easybook-add-ons' ),
				'search_items' => __( 'Search Scheduled Actions', 'easybook-add-ons' ),
				'not_found' => __( 'No actions found', 'easybook-add-ons' ),
				'not_found_in_trash' => __( 'No actions found in trash', 'easybook-add-ons' ),
			),
		);

		$args = apply_filters('action_scheduler_post_type_args', $args);
		return $args;
	}
}
 