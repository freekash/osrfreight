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



class Esb_Class_Listing_CPT extends Esb_Class_CPT {  
    protected $name = 'listing';

    protected function init(){
        parent::init();

        add_action( 'init', array($this, 'taxonomies'), 0 );

        add_filter('manage_edit-listing_cat_columns', array($this, 'tax_cat_columns_head') );
        add_filter('manage_listing_cat_custom_column', array($this, 'tax_cat_columns_content'), 10, 3);  

        add_filter('manage_edit-listing_feature_columns', array($this, 'tax_alt_columns_head') );
        add_filter('manage_listing_feature_custom_column', array($this, 'tax_alt_columns_content'), 10, 3); 

        add_filter('manage_edit-listing_location_columns', array($this, 'tax_alt_columns_head') );
        add_filter('manage_listing_location_custom_column', array($this, 'tax_alt_columns_content'), 10, 3); 

        add_filter('manage_edit-listing_tag_columns', array($this, 'tax_alt_columns_head') );
        add_filter('manage_listing_tag_custom_column', array($this, 'tax_alt_columns_content'), 10, 3); 

        $logged_in_ajax_actions = array(
            'submit_listing',
            'admin_lverified',
            'admin_lfeatured',
        );
        foreach ($logged_in_ajax_actions as $action) {
            $funname = str_replace('easybook_addons_', '', $action); 
            add_action('wp_ajax_'.$action, array( $this, $funname ));
        }

        add_filter('use_block_editor_for_post_type', array($this, 'disable_gutenberg'), 10, 2 );

    }
    public function disable_gutenberg( $current_status, $post_type ){
        if ($post_type === 'listing') 
            return false;

        return $current_status;
    }
    public function tax_cat_columns_head($columns) {
        $columns['_thumbnail'] = __('Thumbnail','easybook-add-ons');
        $columns['_id'] = __('ID','easybook-add-ons');
        return $columns;
    }

    public function tax_cat_columns_content($c, $column_name, $term_id) {
        if ($column_name == '_id') {
            echo $term_id;
        }
        if ($column_name == '_thumbnail') {
            $term_meta = get_term_meta( $term_id, ESB_META_PREFIX.'term_meta', true );
            if(isset($term_meta['featured_img']) && !empty($term_meta['featured_img'])){
                echo wp_get_attachment_image( $term_meta['featured_img']['id'], 'thumbnail', false, array('style'=>'width:100px;height:auto;') );
                
            }
        }
    }
    public function tax_alt_columns_head($columns) {
        $columns['_id'] = __('ID','easybook-add-ons');
        return $columns;
    }

    public function tax_alt_columns_content($c, $column_name, $term_id) {
        if ($column_name == '_id') {
            echo $term_id;
        }
    }
    protected function set_meta_boxes(){
        $this->meta_boxes = array(
            'datas'       => array(
                'title'                 => __( 'Listing Datas', 'easybook-add-ons' ),
                'context'               => 'normal', // normal - side - advanced
                'priority'              => 'high', // default - high - low
                'callback_args'         => array(),
            ),
            'expire'       => array(
                'title'                 => __( 'Listing Expire', 'easybook-add-ons' ),
                'context'               => 'side', // normal - side - advanced
                'priority'              => 'high', // default - high - low
                'callback_args'         => array(),
            )
        );
    }
    public function register(){

        $labels = array( 
            'name' => __( 'Listing', 'easybook-add-ons' ),
            'singular_name' => __( 'Listing', 'easybook-add-ons' ),
            'add_new' => __( 'Add New Listing', 'easybook-add-ons' ),
            'add_new_item' => __( 'Add New Listing', 'easybook-add-ons' ),
            'edit_item' => __( 'Edit Listing', 'easybook-add-ons' ),
            'new_item' => __( 'New Listing', 'easybook-add-ons' ),
            'view_item' => __( 'View Listing', 'easybook-add-ons' ),
            'search_items' => __( 'Search Listings', 'easybook-add-ons' ),
            'not_found' => __( 'No Listings found', 'easybook-add-ons' ),
            'not_found_in_trash' => __( 'No Listings found in Trash', 'easybook-add-ons' ),
            'parent_item_colon' => __( 'Parent Listing:', 'easybook-add-ons' ),
            'menu_name' => __( 'EasyBook Listings', 'easybook-add-ons' ),
        );

        $args = array( 
            'labels' => $labels,
            'hierarchical' => true,
            'description' => __( 'List Listings', 'easybook-add-ons' ),
            'supports' => array( 'title', 'editor',  'author', 'thumbnail','comments','excerpt', 'page-attributes'/*, 'post-formats'*/),
            'taxonomies' => array('listing_cat','post_tag', 'listing_feature', 'listing_location', 'listing_tag'),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 25,
            'menu_icon' => 'dashicons-location-alt', // plugin_dir_url( __FILE__ ) .'assets/admin_ico_listing.png', 
            'show_in_nav_menus' => true,
            'has_archive' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            
            'query_var' => true,
            'can_export' => true,
            'rewrite' => array( 'slug' => __('listing','easybook-add-ons') ),
            'capability_type' => 'post'
        );
        register_post_type( $this->name, $args );
    }

    public function taxonomies(){
        $labels = array(
            'name' => __( 'Listing Categories', 'easybook-add-ons' ),
            'singular_name' => __( 'Category', 'easybook-add-ons' ),
            'search_items' =>  __( 'Search Categories','easybook-add-ons' ),
            'all_items' => __( 'All Categories','easybook-add-ons' ),
            'parent_item' => __( 'Parent Category','easybook-add-ons' ),
            'parent_item_colon' => __( 'Parent Category:','easybook-add-ons' ),
            'edit_item' => __( 'Edit Category','easybook-add-ons' ), 
            'update_item' => __( 'Update Category','easybook-add-ons' ),
            'add_new_item' => __( 'Add New Category','easybook-add-ons' ),
            'new_item_name' => __( 'New Category Name','easybook-add-ons' ),
            'menu_name' => __( 'Listing Categories','easybook-add-ons' ),
        );     
        // Now register the taxonomy
        register_taxonomy('listing_cat',array('listing'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_in_nav_menus'=> true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => __('listing_cat','easybook-add-ons') ),
            // https://codex.wordpress.org/Roles_and_Capabilities
            'capabilities' => array(
                'manage_terms' => 'manage_categories',
                'edit_terms' => 'manage_categories',
                'delete_terms' => 'manage_categories',
                'assign_terms' => 'edit_posts'
            ),

        ));

        $labels = array(
            'name' => __( 'Listing Features', 'easybook-add-ons' ),
            'singular_name' => __( 'Feature', 'easybook-add-ons' ),
            'search_items' =>  __( 'Search Features','easybook-add-ons' ),
            'all_items' => __( 'All Features','easybook-add-ons' ),
            'parent_item' => __( 'Parent Feature','easybook-add-ons' ),
            'parent_item_colon' => __( 'Parent Feature:','easybook-add-ons' ),
            'edit_item' => __( 'Edit Feature','easybook-add-ons' ), 
            'update_item' => __( 'Update Feature','easybook-add-ons' ),
            'add_new_item' => __( 'Add New Feature','easybook-add-ons' ),
            'new_item_name' => __( 'New Feature Name','easybook-add-ons' ),
            'menu_name' => __( 'Listing Features','easybook-add-ons' ),
        );     

        // Now register the taxonomy

        register_taxonomy('listing_feature',array('listing', 'lrooms'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_in_nav_menus'=> true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => __('listing_feature','easybook-add-ons') ),
            // https://codex.wordpress.org/Roles_and_Capabilities
            // 'capabilities' => array(
            //     'manage_terms' => 'manage_categories',
            //     'edit_terms' => 'manage_categories',
            //     'delete_terms' => 'manage_categories',
            //     'assign_terms' => 'edit_posts'
            // ),

        ));

        $labels = array(
            'name' => __( 'Listing Locations', 'easybook-add-ons' ),
            'singular_name' => __( 'Location', 'easybook-add-ons' ),
            'search_items' =>  __( 'Search Locations','easybook-add-ons' ),
            'all_items' => __( 'All Locations','easybook-add-ons' ),
            'parent_item' => __( 'Parent Location','easybook-add-ons' ),
            'parent_item_colon' => __( 'Parent Location:','easybook-add-ons' ),
            'edit_item' => __( 'Edit Location','easybook-add-ons' ), 
            'update_item' => __( 'Update Location','easybook-add-ons' ),
            'add_new_item' => __( 'Add New Location','easybook-add-ons' ),
            'new_item_name' => __( 'New Location Name','easybook-add-ons' ),
            'menu_name' => __( 'Listing Locations','easybook-add-ons' ),
        );     

        // Now register the taxonomy

        register_taxonomy('listing_location',array('listing'), array(
            'hierarchical' => true, // false for insert new tax when inserting post
            'labels' => $labels,
            'show_ui' => true,
            'show_in_nav_menus'=> true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => __('listing_location','easybook-add-ons') ),
            // https://codex.wordpress.org/Roles_and_Capabilities
            // 'capabilities' => array(
            //     'manage_terms' => 'manage_categories',
            //     'edit_terms' => 'manage_categories',
            //     'delete_terms' => 'manage_categories',
            //     'assign_terms' => 'edit_posts'
            // ),

        ));

        register_taxonomy('listing_tag',array('listing'), array(
            'hierarchical'      => false, // false for insert new tax when inserting post
            'labels'            => array(
                'name' => __( 'Listing Tags', 'easybook-add-ons' ),
                'singular_name' => __( 'Tag', 'easybook-add-ons' ),
                'search_items' =>  __( 'Search Tags','easybook-add-ons' ),
                'all_items' => __( 'All Tags','easybook-add-ons' ),
                'parent_item' => __( 'Parent Tag','easybook-add-ons' ),
                'parent_item_colon' => __( 'Parent Tag:','easybook-add-ons' ),
                'edit_item' => __( 'Edit Tag','easybook-add-ons' ), 
                'update_item' => __( 'Update Tag','easybook-add-ons' ),
                'add_new_item' => __( 'Add New Tag','easybook-add-ons' ),
                'new_item_name' => __( 'New Tag Name','easybook-add-ons' ),
                'menu_name' => __( 'Listing Tags','easybook-add-ons' ),
            ),
            'show_ui'           => true,
            'show_in_nav_menus' => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => __('listing_tag','easybook-add-ons') ),
            // https://codex.wordpress.org/Roles_and_Capabilities
            // 'capabilities' => array(
            //     'manage_terms' => 'manage_categories',
            //     'edit_terms' => 'manage_categories',
            //     'delete_terms' => 'manage_categories',
            //     'assign_terms' => 'edit_posts'
            // ),

        ));


    }

    protected function filter_meta_args($args, $post){
        $new_post = false;
        if($post->post_date == $post->post_modified && $post->post_date_gmt == '0000-00-00 00:00:00' && $post->post_modified_gmt == '0000-00-00 00:00:00' ) 
            $new_post = true;
        $args['new_post'] = $new_post;

        return $args;
    }

    public function listing_datas_callback($post, $args){
        wp_nonce_field( 'cth-cpt-fields', '_cth_cpt_nonce' );

        $listing_fields = get_post_meta( $post->ID, ESB_META_PREFIX.'listing_fields', true );
        $room_fields = get_post_meta( $post->ID, ESB_META_PREFIX.'room_fields', true );
        $rating_fields = get_post_meta( $post->ID, ESB_META_PREFIX.'rating_fields', true );
        wp_localize_script( 'easybook-react-adminapp', '_easybook_addons_lfields', json_decode($listing_fields) );
        wp_localize_script( 'easybook-react-adminapp', '_easybook_addons_rfields', json_decode($room_fields) );
        wp_localize_script( 'easybook-react-adminapp', '_easybook_addons_frating', json_decode($rating_fields) );
        ?>
        <div id="admin-listing-app"></div>
        <?php
    }
    public function listing_expire_callback($post, $args){
        ?>
        <div class="custom-form">
            <?php 
            $expire = get_post_meta( $post->ID, ESB_META_PREFIX.'expire_date', true );
            if($expire == 'NEVER') $expire = '';
            ?>
            <p><?php _e( 'Set expiration date. Leave <strong>empty</strong> for <strong>never</strong> expire.', 'easybook-add-ons' ); ?></p>
            <input type="text" id="listing_expire_date" name="expire_date" value="<?php echo $expire;?>">
        </div>
        <?php
    }
    /**
     * Save post metadata when a post is saved.
     *
     * @param int $post_id The post ID.
     * @param post $post The post object.
     * @param bool $update Whether this is an existing post being updated or not.
     */
    public function save_post($post_id, $post, $update){
        if(!$this->can_save($post_id)) return;

        // - Update the post's metadata.
        if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Begin: easybook_addons_save_listing_meta" . PHP_EOL, 3, ESB_LOG_FILE);
        // unhook this function so it doesn't loop infinitely
        remove_action( 'save_post_'.$this->name, array($this, 'save_post'), 10, 3  );
        
            $this->save_post_meta($post_id, true, true);

        // re-hook this function
        add_action( 'save_post_'.$this->name, array($this, 'save_post'), 10, 3  );
    }

    protected function save_post_meta($listing_id = 0, $edit = false, $backend = false){
        
        $listing_type_id = easybook_addons_get_option('default_listing_type');
        if(isset($_POST['listing_type_id']) && $_POST['listing_type_id']) 
            $listing_type_id = $_POST['listing_type_id'];

        update_post_meta( $listing_id, ESB_META_PREFIX.'listing_type_id', $listing_type_id );

        self::do_save_metas($listing_id, $_POST);
        
        if( isset($_POST['_price']) ) update_post_meta( $listing_id, '_price', $_POST['_price'] );
        
        // adding price for woo support in future
        // https://github.com/woocommerce/woocommerce/issues/14212
        // http://reigelgallarde.me/programming/how-to-add-custom-post-type-to-woocommerce/

        // disable update subscription meta from back-end
        if($backend != true){
            // current user sub
            
        }
        // end back-end disable

        // set backend expiration date
        if($backend && isset($_POST['expire_date'])){
            if($_POST['expire_date'] == ''){
                update_post_meta( $listing_id, ESB_META_PREFIX.'expire_date',  'NEVER' );
                // easybook_addons_unscheduleExpireEvent($listing_id);
            }else{
                update_post_meta( $listing_id, ESB_META_PREFIX.'expire_date',  $_POST['expire_date'] );
                // convert local time to GMT - Simply subtracts the value of the 'gmt_offset' option.
                // $ts = get_gmt_from_date($_POST['expire_date'],'U');
                // easybook_addons_scheduleExpireEvent($listing_id,$ts);
            }
        }

        // if there is no current sub or any user
        // add expire date for submit listing only and not set yet
        // if(get_post_meta( $listing_id, ESB_META_PREFIX.'expire_date', true ) == ''){
        //     $expire_date = easybook_add_ons_cal_next_date('', 'day', easybook_addons_get_option('listing_expire_days') );
        //     update_post_meta( $listing_id, ESB_META_PREFIX.'expire_date', $expire_date  );

        //     $ts = get_gmt_from_date($expire_date,'U');
        //     easybook_addons_scheduleExpireEvent($listing_id,$ts);
        // }


    }

    public function submit_listing() {
        $json = array(
            'success' => false,
            'data' => array(
                '_POST'=>$_POST,
                '_FILE'=>$_FILES
            )
        );

        // wp_send_json( $json );

        // verify google reCAPTCHA
        // if( easybook_addons_verify_recaptcha() === false ){
        //     $json['error'] = esc_html__( 'reCAPTCHA failed, please try again.', 'easybook-add-ons' ) ;
        // }

        Esb_Class_Ajax_Handler::verify_nonce('easybook-add-ons');


        
        // register new user and log he in
        if(isset($_POST['user_email'])){

            $user_name = isset($_POST['user_login'])? $_POST['user_login'] : substr($_POST['user_email'], 0, strpos($_POST['user_email'], "@") ); // substr(string,start,length)

            $new_user_data = array(
                'user_login' => $user_name,
                // 'user_pass'  => easybook_addons_generate_password(), // // When creating an user, `user_pass` is expected.
                'user_email' => $_POST['user_email'],
                'role'       => 'listing_author' //'subscriber'
            );
            $user_id = wp_insert_user( $new_user_data );
            //On success
            if ( ! is_wp_error( $user_id ) ) {
                // echo "User created : ". $user_id;

                $json['data']['user_id'] = $user_id;
                if(easybook_addons_get_option('new_user_email') != 'none') wp_new_user_notification( $user_id, null, easybook_addons_get_option('new_user_email') );
                // auto login user
                if( easybook_addons_get_option('register_auto_login') == 'yes' || easybook_addons_get_option('users_can_submit_listing') == 'yes' ) easybook_addons_auto_login_new_user( $user_id );
                do_action( 'easybook_addons_register_user', $user_id, true /*is when submit lisitng*/ );

            }else{
                $json['error'] = $user_id->get_error_message() ;
                $json['data']['new_user_data'] = $new_user_data ;
                // $json['data']['at_pos'] = strpos("@", $_POST['user_email']);
                // $json['data']['substr'] = substr($_POST['user_email'], 0, strpos($_POST['user_email'], "@") );
                wp_send_json( $json );
            }
        }else{
            // check if logged in user
            if(!is_user_logged_in()){
                $json['error'] = __( 'You must login on submiting a listing.', 'easybook-add-ons' );
                wp_send_json( $json );
            }
            $user_id = get_current_user_id();
        }

        if(Esb_Class_Membership::can_add() == false){
            $json['post']['listing_type_id'] = -1;
            $json['error'] = __( 'You are not allowed to submit listing. Your author subscription has expired or listing limitation exceeded.', 'easybook-add-ons' ) ; 
            wp_send_json($json );
        }

        // begin insert listing
        $listing_data = array();
        $edit_listing_id = isset($_POST['lid'])? $_POST['lid'] : 0;
        $is_editing_listing = false;
        if(is_numeric($edit_listing_id) && (int)$edit_listing_id > 0){
            $old_listing_post = get_post( $edit_listing_id );
            if($old_listing_post){
                $is_editing_listing = true;
                // $json['data']['is_editing_listing'] = true;
                if( ! user_can( $user_id, 'edit_post' , $edit_listing_id ) ){
                    $json['error'] = __( "You don't have permission to edit this listing.", 'easybook-add-ons' ) ;
                    // $json['url'] = esc_url( home_url('/') );
                    wp_send_json( $json );
                }
                // don't update post author
                $listing_data['post_author'] = $old_listing_post->post_author;
                $listing_data['post_status'] = $old_listing_post->post_status;
                $listing_data['post_date'] = $old_listing_post->post_date;
            }
        }
        $listing_data['ID'] = $edit_listing_id; // set ID to update
        $listing_data['post_title'] = isset($_POST['title'])? $_POST['title'] : '';
        $listing_data['tax_input'] = array();

        if(isset($_POST['cats'])&& $_POST['cats']) $listing_data['tax_input']['listing_cat'] = $_POST['cats'];
        if(isset($_POST['features'])&& $_POST['features']) $listing_data['tax_input']['listing_feature'] = $_POST['features'];
        
        $ltags = array();
        if(isset($_POST['tags']) && $_POST['tags'])
            $ltags = explode(",", $_POST['tags']);
        $ltags = (array) apply_filters( 'ctb_submit_ltags', $ltags );

        $listing_data['tags_input'] = $ltags;

        // new listing tags
        $ltags_names = array();
        if(isset($_POST['ltags_names']) && $_POST['ltags_names'])
            $ltags_names = explode(",", $_POST['ltags_names']);
        $ltags_names = (array) apply_filters( 'ctb_submit_listing_tags_names', $ltags_names );
        $listing_data['tax_input']['listing_tag'] = $ltags_names;


        if(isset($_POST['locations']) && $_POST['locations']){
            $plocs = explode("|", $_POST['locations']);
            $plocs = array_filter(
                array_map(function($loc){
                    return urldecode($loc);
                }, $plocs)
            );
            $plocs = array_values($plocs);
            $location_terms = array();
            if(!empty($plocs)){
                $country = $plocs[0];
                // Check if the country exists
                $country_term = term_exists( $country, 'listing_location', 0 );
                // Create country if it doesn't exist
                if( !$country_term ) {
                    $country_term = wp_insert_term( easybook_addons_get_google_contry_codes($country), 'listing_location', array( 'parent' => 0 , 'slug' => $country ) );
                }

                if($country_term && !is_wp_error($country_term)){
                    $location_terms[] = $country_term['term_taxonomy_id'];

                    if(count($plocs) >= 2){
                        $state = $plocs[1];
                        // Check if the state exists
                        $state_term = term_exists( $state, 'listing_location', $country_term['term_taxonomy_id'] );
                        // Create state if it doesn't exist
                        if( !$state_term ) {
                            $state_term = wp_insert_term( $state, 'listing_location', array( 'parent' => $country_term['term_taxonomy_id'] ) );
                        }
                        if($state_term && !is_wp_error($state_term)){
                            $location_terms[] = $state_term['term_taxonomy_id'];
                            if(count($plocs) >= 3){
                                $city = $plocs[2];
                                // Check if the city exists
                                $city_term = term_exists( $city, 'listing_location', $state_term['term_taxonomy_id'] );
                                // Create city if it doesn't exist
                                if( !$city_term ) {
                                    $city_term = wp_insert_term( $city, 'listing_location', array( 'parent' => $state_term['term_taxonomy_id'] ) );
                                }
                                if($city_term && !is_wp_error($city_term)) $location_terms[] = $city_term['term_taxonomy_id'];
                            }
                        }
                    }
                }
            }
            $listing_data['tax_input']['listing_location'] = $location_terms;
        } 

        // if(isset($_POST['locations'])&& $_POST['locations']) $listing_data['tax_input']['listing_location'] = $_POST['locations'];
        
        // new listing location select
        if(isset($_POST['select_locations'])&& !empty( $_POST['select_locations'] ) ){
            if(!is_array($_POST['select_locations'])){
                $listing_data['tax_input']['listing_location'] = array( $_POST['select_locations'] );
            }else{
                $listing_data['tax_input']['listing_location'] = $_POST['select_locations'];
            }
            
        } 
        

        // $listing_data['post_author'] = 2;
        if(isset($_POST['post_excerpt'])) $listing_data['post_excerpt'] = $_POST['post_excerpt'];
        $listing_data['post_content'] = isset($_POST['content'])? $_POST['content'] : '';
        //$listing_data['post_author'] = '0';// default 0 for no author assigned
        // set status for listing submission only
        if($is_editing_listing == false){
            if(easybook_addons_get_option('auto_publish_paid_listings') == 'yes')
                $listing_data['post_status'] = 'publish';
            else
                $listing_data['post_status'] = 'pending'; // publish, future, draft, pending, private, trash, auto-draft, inherit
        }

        
        $listing_data['post_type'] = 'listing';

        $listing_data['comment_status'] = 'open'; // closed

        $json['data']['post_data'] = $listing_data;
        // wp_send_json( $json );

        do_action( 'easybook_addons_insert_listing_before', $listing_data, $is_editing_listing );

        $listing_id = wp_insert_post($listing_data ,true );
                        

        if (!is_wp_error($listing_id)) {
            $json['success'] = true;
            $json['data']['lid'] = $listing_id;

            // update listing type id
            $listing_type_id = easybook_addons_get_option('default_listing_type');
            if(isset($_POST['listing_type_id']) && $_POST['listing_type_id']) 
                $listing_type_id = $_POST['listing_type_id'];

            update_post_meta( $listing_id, ESB_META_PREFIX.'listing_type_id', $listing_type_id );
        
            // for insert/update listing rooms
            $old_listing_rooms_ids = array_unique((array)get_post_meta( $listing_id, ESB_META_PREFIX.'rooms_ids', true ));
            $listing_rooms_ids = array();
            if(isset($_POST['listing_rooms']) && is_array($_POST['listing_rooms']) && !empty($_POST['listing_rooms'])){
                foreach ($_POST['listing_rooms'] as $room_data) {
                    $room_id = $this->insert_room_post($room_data, $listing_id);
                    if($room_id && is_numeric($room_id)){
                        $listing_rooms_ids[] = $room_id;
                        if(!empty($old_listing_rooms_ids)){
                            $old_key = array_search($room_id, $old_listing_rooms_ids);
                            if($old_key !== false) unset($old_listing_rooms_ids[$old_key]);
                        }
                    } 
                }
            }
            // update room_ids for listing - two ways binding
            update_post_meta( $listing_id, ESB_META_PREFIX.'rooms_ids', $listing_rooms_ids );
            // add listing _price for filter
            self::update_listing_price($listing_id, $_POST);

            // $json['data']['listing_rooms_ids'] = $listing_rooms_ids;
            // delete unused room
            if(!empty($old_listing_rooms_ids)){
                foreach ($old_listing_rooms_ids as $rdid) {
                    wp_delete_post( $rdid, false );
                }
            }
            //for insert/update coupon
            
            $old_lcoupon_ids = array_unique((array)get_post_meta( $listing_id, ESB_META_PREFIX.'coupon_ids', true ));
            $coupon_ids = array();
            if(isset($_POST['lcoupon']) && is_array($_POST['lcoupon']) && !empty($_POST['lcoupon'])){
                foreach ($_POST['lcoupon'] as $coupon_data) {
                    $coupon_id = $this->insert_coupon_code($coupon_data, $listing_id);
                    if($coupon_id && is_numeric($coupon_id)){
                        $coupon_ids[] = $coupon_id;
                        if(!empty($old_lcoupon_ids)){
                            $old_key = array_search($coupon_id, $old_lcoupon_ids);
                            if($old_key !== false) unset($old_lcoupon_ids[$old_key]);
                        }
                    } 
                }
            }
            // update coupon_ids for listing - two ways binding
            update_post_meta( $listing_id, ESB_META_PREFIX.'coupon_ids', $coupon_ids );
            // delete unused room
            if(!empty($old_lcoupon_ids)){
                foreach ($old_lcoupon_ids as $couponid) {
                    wp_delete_post( $couponid, false );
                }
            }


            // new update listing meta
            self::do_save_metas($listing_id, $_POST);

            // process image for listing submission only
            if($is_editing_listing == false){
                
                // set expire date
                $end_date = Esb_Class_Membership::expire_date();

                
                if($end_date == 'NEVER'){
                    update_post_meta( $listing_id, ESB_META_PREFIX.'expire_date',  'NEVER' );
                }else{
                    update_post_meta( $listing_id, ESB_META_PREFIX.'expire_date',  $end_date );
                    // $ts = get_gmt_from_date($end_date,'U');
                    // easybook_addons_scheduleExpireEvent($listing_id,$ts);
                }
            }
            // end if($is_editing_listing == false)

            // if( get_post_meta( $listing_id, ESB_META_PREFIX.'featured', true ) === '' ){
            //     update_post_meta( $listing_id, ESB_META_PREFIX.'featured', '0' );
            // }
                
            // update thumbnail image
            if(( $is_editing_listing || is_user_logged_in()  )&& isset($_POST['thumbnail'])){
                $featured = $_POST['thumbnail'];
                if(is_array($featured) && count($featured)){
                    // reset($featured); // reset array to first element
                    $json['data']['thumbnail_meta_id'] = set_post_thumbnail( $listing_id, reset($featured) ); // key($featured) - get first array key -> image id
                }else{
                    $json['data']['edit_featured'] = __( "Featured image is empty.", 'easybook-add-ons' );
                }

            }
            // end update featured
            switch (easybook_addons_get_option('submit_redirect')) {
                case 'home':
                    $listing_redirect_url = esc_url( home_url('/') );
                    break;
                case 'dashboard':
                    $listing_redirect_url = '/';
                    break;
                default:
                    $listing_redirect_url = get_post_permalink($listing_id);
                    break;
            }
            
            if(!is_wp_error($listing_redirect_url)) $json['url'] = $listing_redirect_url ;

            
            // $json['data'] = $_POST['test_var'];

            do_action( 'easybook_addons_insert_listing_after', $listing_id, $is_editing_listing );
        }else{
            $json['error'] = $listing_id->get_error_message();
        }
        wp_send_json( $json );

        // https://codex.wordpress.org/Function_Reference/wp_handle_upload
        // https://wordpress.org/plugins/radio-buttons-for-taxonomies/

        // https://stackoverflow.com/questions/19949876/how-to-auto-login-after-registration-in-wordpress-with-core-php
        // https://stackoverflow.com/questions/19949876/how-to-auto-login-after-registration-in-wordpress-with-core-php
        // https://codex.wordpress.org/Roles_and_Capabilities
        // https://codex.wordpress.org/Function_Reference/register_taxonomy
        // https://developer.wordpress.org/reference/functions/wp_insert_post/
    }

    public static function do_save_metas($post_id = 0, $post_data = array()){
        // new update listing meta
        $meta_fields = easybook_addons_get_listing_type_fields_meta( get_post_meta( $post_id, ESB_META_PREFIX.'listing_type_id', true ) );
        $listing_metas = array();
        foreach($meta_fields as $fname => $ftype){
            if(isset($post_data[$fname])) $listing_metas[$fname] = $post_data[$fname] ;
            else{
                if($ftype == 'array'){
                    $listing_metas[$fname] = array();
                }else{
                    $listing_metas[$fname] = '';
                }
            } 
        }
        foreach ($listing_metas as $key => $value) {
            $old_val = get_post_meta( $post_id, ESB_META_PREFIX.$key, true );
            if($old_val != $value) update_post_meta( $post_id, ESB_META_PREFIX.$key, $value );
        }

        if( get_post_meta( $post_id, ESB_META_PREFIX.'featured', true ) === '' ){
            update_post_meta( $post_id, ESB_META_PREFIX.'featured', '0' );
        }
    }


    protected function set_meta_columns(){
        $this->has_columns = true;
    }
    public function meta_columns_head($columns){
        unset($columns['tags']);
        unset($columns['comments']);
        unset($columns['taxonomy-listing_feature']);
        unset($columns['taxonomy-listing_tag']);
        $columns['_ltype'] = __( 'Listing Type', 'easybook-add-ons' );
        $columns['_thumbnail'] = __( 'Thumbnail', 'easybook-add-ons' );
        $columns['_id'] = __( 'ID', 'easybook-add-ons' );
        $columns['expire_date'] = __( 'Expiration Date', 'easybook-add-ons' );
        $columns['_featured'] = __( 'Featured', 'easybook-add-ons' );
        $columns['_verified'] = __( 'Verified', 'easybook-add-ons' );
        return $columns;
    }
    public function meta_columns_content($column_name, $post_ID){
        if ($column_name == '_id') { 
            echo $post_ID;
        }
        if ($column_name == '_ltype') {
            echo get_the_title( get_post_meta( $post_ID, ESB_META_PREFIX.'listing_type_id', true ) );
        }
        if ($column_name == '_thumbnail') {
            echo get_the_post_thumbnail( $post_ID, 'thumbnail', array('style'=>'width:100px;height:auto;') );
        }

        if ($column_name == 'expire_date') {
            $expire_date = get_post_meta( $post_ID, ESB_META_PREFIX.'expire_date', true );
            if($expire_date == 'NEVER'){
                _e( 'Never', 'easybook-add-ons' );
            }elseif( $expire_date < current_time( 'mysql', 1 ) ){
                _e( 'Expired', 'easybook-add-ons' );
                //echo '<br />'.$expire_date;
            }else{
                echo $expire_date;
            }
        }

        if ($column_name == '_featured') {
            echo '<a href="#" class="button set-lfeatured'.( get_post_meta( $post_ID, ESB_META_PREFIX.'featured', true ) == '1'? ' lfeatured' : '' ).'" data-id="'.$post_ID.'"><span class="lfeatured-loading"><i class="fa fa-spinner fa-pulse"></i></span><span class="as-lfeatured">'.__( 'Set as featured', 'easybook-add-ons' ).'</span><span class="lfeatured">'.__( 'Featured', 'easybook-add-ons' ).'</span></a>';
        }
        if ($column_name == '_verified') {
            // var_dump(get_post_meta( $post_ID, ESB_META_PREFIX.'verified', true ));
            echo '<a href="#" class="button set-lverified'.( get_post_meta( $post_ID, ESB_META_PREFIX.'verified', true ) == '1' ? ' lverified' : '' ).'" data-id="'.$post_ID.'"><span class="lverified-loading"><i class="fa fa-spinner fa-pulse"></i></span><span class="as-lverified">'.__( 'Verify', 'easybook-add-ons' ).'</span><span class="lverified">'.__( 'Verified', 'easybook-add-ons' ).'</span></a>';
        }
    }

    protected function insert_room_post($room_post = array(), $listing_id = 0 ){
        // begin insert listing
        $room_datas = array();
        $edit_room_id = isset($room_post['rid'])? $room_post['rid'] : 0;
        $is_editing_room = false;
        if(is_numeric($edit_room_id) && (int)$edit_room_id > 0){
            $old_room_post = get_post( $edit_room_id );
            if($old_room_post){
                $is_editing_room = true; 
                // don't update post author
                $room_datas['post_author'] = $old_room_post->post_author;
                $room_datas['post_status'] = $old_room_post->post_status;
                $room_datas['post_date'] = $old_room_post->post_date;
            }
        }
        $room_datas['ID'] = $edit_room_id; // set ID to update
        $room_datas['post_title'] = isset($room_post['title'])? $room_post['title'] : '';
        $room_datas['tax_input'] = array();
        if(isset($room_post['features'])&& $room_post['features']) $room_datas['tax_input']['listing_feature'] = $room_post['features'];
        
        $room_datas['post_content'] = isset($room_post['content'])? $room_post['content'] : '';
        //$room_datas['post_author'] = '0';// default 0 for no author assigned
        // set status for listing submission only
        if($is_editing_room == false){
            $room_datas['post_status'] = 'publish'; // publish, future, draft, pending, private, trash, auto-draft, inherit
        }
        $listing_type_id = get_post_meta($listing_id,ESB_META_PREFIX.'listing_type_id',true);
        $child_pt = get_post_meta($listing_type_id,ESB_META_PREFIX.'child_type_meta',true);
        
        $room_datas['post_type'] = ($child_pt == 'product') ? 'product' : 'lrooms';

        $room_datas['comment_status'] = 'open'; // closed

        do_action( 'easybook_addons_insert_room_before', $room_datas, $is_editing_room );

        $room_id = wp_insert_post($room_datas ,true );
             
        if (!is_wp_error($room_id)) {
            if($child_pt != 'lrooms' && $child_pt != 'none'){
                 $meta_fields = easybook_addons_get_listing_type_fields_meta( get_post_meta( $listing_id, ESB_META_PREFIX.'listing_type_id', true ) , true);
                $woo_metas = array();
                foreach($meta_fields as $fname => $ftype){
                    if(isset($room_post[$fname])) 
                        $woo_metas[$fname] = $room_post[$fname] ;
                    else{
                        if($ftype == 'array'){
                            $woo_metas[$fname] = array();
                        }else{
                            $woo_metas[$fname] = '';
                        }
                    } 
                }
                foreach ($woo_metas as $key => $value) {
                    $old_val = get_post_meta( $room_id, ESB_META_PREFIX.$key, true );
                    if($old_val != $value) update_post_meta( $room_id, ESB_META_PREFIX.$key, $value );
                }

                // room price
                if( isset($room_post['_price']) && $room_post['_price'] ) update_post_meta( $room_id, '_price', $room_post['_price'] );
                // for changing listing
                $for_listing_id = get_post_meta( $room_id, ESB_META_PREFIX.'for_listing_id', true );
                if($for_listing_id != $listing_id) 
                    update_post_meta( $room_id, ESB_META_PREFIX.'for_listing_id', $listing_id );
                // update thumbnail image
                // product_image_gallery
                 if( isset($room_post['room_images']) && $room_post['room_images'] ){
                    update_post_meta( $room_id, 'room_images', $room_post['room_images'] );
                    update_post_meta( $room_id, 'product_image_gallery', $room_post['room_images'] );
                 }
                
            }else{

                Esb_Class_LRooms_CPT::do_save_metas($room_id, $room_post, $listing_id);

            };
            // update thumbnail image
            if(isset($room_post['room_thumbnail'])){
                $featured = $room_post['room_thumbnail'];
                if(is_array($featured) && count($featured)){
                    set_post_thumbnail( $room_id, reset($featured) ); // key($featured) - get first array key -> image id
                }

            }
            do_action( 'easybook_addons_insert_room_after', $room_id, $room_datas, $is_editing_room );

            return $room_id;
        }
        return false;
    }
    protected function insert_coupon_code ($coupon_post = array(), $listing_id = 0){
        // begin insert 
        if(is_numeric($listing_id) && (int)$listing_id > 0){
            $coupon_title = __( '%1$s for %2$s', 'easybook-add-ons' );
            $coupon_datas = array();
            $coupon_datas['post_title'] = sprintf( $coupon_title, (isset($_POST['coupon_code']) ? $_POST['coupon_code'] : '' ) , get_the_title( $listing_id ));
            $coupon_datas['post_content'] = '';
            $coupon_datas['post_status'] = 'publish';
            $coupon_datas['post_type'] = 'cthcoupons';

            $coupon_id = wp_insert_post($coupon_datas ,true );  
            if (!is_wp_error($coupon_id)) {
                $meta_fields = array(
                    'coupon_code'               => 'text',
                    'discount_type'             => 'text',
                    'dis_amount'                => 'text',
                    'coupon_decs'                => 'text',
                    'coupon_qty'                => 'text',
                    'coupon_expiry_date'        => 'text',
                );
                $coupon_metas = array();
                foreach($meta_fields as $field => $ftype){
                    if(isset($coupon_post[$field])) 
                        $coupon_metas[$field] = $coupon_post[$field] ;
                    else{
                        if($ftype == 'array'){
                            $coupon_metas[$field] = array();
                        }else{
                            $coupon_metas[$field] = '';
                        }
                    } 
                }
                foreach ($coupon_metas as $key => $value) {
                    $old_val = get_post_meta( $coupon_id, ESB_META_PREFIX.$key, true );
                    if($old_val != $value) update_post_meta( $coupon_id, ESB_META_PREFIX.$key, $value );
                }

                // for changing listing
                $for_coupon_listing_id = get_post_meta( $coupon_id, ESB_META_PREFIX.'for_coupon_listing_id', true );
                if($for_coupon_listing_id != $listing_id) 
                    update_post_meta( $coupon_id, ESB_META_PREFIX.'for_coupon_listing_id', $listing_id );
                return $coupon_id;
            }
        }
        return false;

    }
    public static function update_listing_price( $listing_id = 0,  $post_data = array() ){
        $listing_prices = array();
        $listing_rooms_ides = (array)get_post_meta( $listing_id, ESB_META_PREFIX.'rooms_ids', true );
        if(!empty($listing_rooms_ides)){
            foreach ($listing_rooms_ides as $rid) {
                $listing_prices[] = (float)get_post_meta( $rid, '_price', true );
            }
        }
        $_price = 0;
        if(!empty($listing_prices)) 
            $_price = array_sum($listing_prices)/count($listing_prices);
        elseif( isset($post_data['_price']) ){ // if has _price
            $_price = absint($post_data['_price']);
        }elseif(isset($post_data['price_from']) && absint($post_data['price_from']) > 0){ // if has price range
            $_price = absint($post_data['price_from']);
        }
        
        update_post_meta( $listing_id, '_price', $_price ); 
    }

    public function admin_lfeatured(){
        $json = array(
            'success' => false,
            // 'data' => array(
            //     'POST'=>$_POST,
            // )
        );

        $lid = isset($_POST['lid'])? $_POST['lid'] : 0;
        if(is_numeric($lid) && (int)$lid > 0){
            $lfeatured = isset($_POST['lfeatured'])? $_POST['lfeatured'] : false;
            if($lfeatured)
                update_post_meta( $lid, ESB_META_PREFIX.'featured', '0' );
            else
                update_post_meta( $lid, ESB_META_PREFIX.'featured', '1' );
            $json['success'] = true;
        }else{
            // $json['success'] = false;
            $json['data']['error'] = esc_html__( 'The post id is incorrect.', 'easybook-add-ons' ) ;
        }

        wp_send_json($json );

    }

    function admin_lverified(){
        $json = array(
            'success' => false,
            'data' => array(
                // 'POST'=>$_POST,
            )
        );
        $lid = isset($_POST['lid'])? $_POST['lid'] : 0;
        if(is_numeric($lid) && (int)$lid > 0){
            $lverified = isset($_POST['lverified']) && $_POST['lverified'] ? '0' : '1';
            if(update_post_meta( $lid, ESB_META_PREFIX.'verified', $lverified ))
            $json['success'] = true;
        }else{
            // $json['success'] = false;
            $json['data'] = esc_html__( 'The post id is incorrect.', 'easybook-add-ons' ) ;
        }

        wp_send_json($json );

    }
}

new Esb_Class_Listing_CPT();



/**
 * Taxonomy meta box
 *
 * @since EasyBook 1.0
 */
require_once ESB_ABSPATH . 'inc/cth_taxonomy_fields.php';
require_once ESB_ABSPATH . 'inc/listing_cat_metabox_fields.php';
require_once ESB_ABSPATH . 'inc/listing_feature_metabox_fields.php';





