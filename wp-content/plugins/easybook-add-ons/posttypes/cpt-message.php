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



class Esb_Class_Message_CPT extends Esb_Class_CPT {
    protected $name = 'lmessage';

    protected function init(){
        parent::init();

        $not_logged_in_ajax_actions = array(
            'easybook_addons_del_lmessage',
            'easybook_addons_lauthor_message',
        );
        foreach ($not_logged_in_ajax_actions as $action) {
            $funname = str_replace('easybook_addons_', '', $action);
            add_action('wp_ajax_'.$action, array( $this, $funname ));
            add_action('wp_ajax_nopriv_'.$action, array( $this, $funname ));
        }

        add_filter('manage_edit-lmessage_sortable_columns', array($this, 'sortable_columns'));
        add_action('pre_get_posts', array($this, 'sort_order'));
    }

    public function sortable_columns($columns)
    {

        $columns['_to']      = '_to';
        return $columns;
    }
    public function sort_order($query)
    {
        if (!is_admin()) {
            return;
        }

        $orderby = $query->get('orderby');

        if ('_to' == $orderby) {
            $query->set('meta_key', ESB_META_PREFIX.'to_user_id');
            $query->set('orderby', 'meta_value_num');
        }
    }

    public function register(){

        $labels = array( 
            'name' => __( 'Message', 'easybook-add-ons' ),
            'singular_name' => __( 'Message', 'easybook-add-ons' ),
            'add_new' => __( 'Add New Message', 'easybook-add-ons' ),
            'add_new_item' => __( 'Add New Message', 'easybook-add-ons' ),
            'edit_item' => __( 'Edit Message', 'easybook-add-ons' ),
            'new_item' => __( 'New Message', 'easybook-add-ons' ),
            'view_item' => __( 'View Message', 'easybook-add-ons' ),
            'search_items' => __( 'Search Messages', 'easybook-add-ons' ),
            'not_found' => __( 'No Messages found', 'easybook-add-ons' ),
            'not_found_in_trash' => __( 'No Messages found in Trash', 'easybook-add-ons' ),
            'parent_item_colon' => __( 'Parent Message:', 'easybook-add-ons' ),
            'menu_name' => __( 'Listing Messages', 'easybook-add-ons' ),
        );

        $args = array( 
            'labels' => $labels,
            'hierarchical' => false,
            'description' => __( 'List Messages', 'easybook-add-ons' ),
            'supports' => array( 'title' /*, 'editor', 'author', 'thumbnail','comments','excerpt', 'post-formats'*/),
            'taxonomies' => array(),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,//default from show_ui
            'menu_position' => 25,
            'menu_icon' => 'dashicons-email-alt',
            'show_in_nav_menus' => false,
            'publicly_queryable' => false,
            'exclude_from_search' => true,
            'has_archive' => false,
            'query_var' => true,
            'can_export' => false,
            'rewrite' => array( 'slug' => __('lmessage','easybook-add-ons') ),
            'capability_type' => 'post',
            'capabilities' => array(
                'create_posts' => 'do_not_allow', // false < WP 4.5, credit @Ewout
            ),
            'map_meta_cap' => true, // Set to `false`, if users are not allowed to edit/delete existing posts
        );
        register_post_type( $this->name, $args );
    }
    protected function set_meta_columns(){
        $this->has_columns = true;
    }
    public function meta_columns_head($columns){
        unset($columns['date']);
        unset($columns['author']);
        unset($columns['comments']);
        
        $columns['_from']             = __('From','easybook-add-ons');
        $columns['_to']             = __('To','easybook-add-ons');
        $columns['_status']             = __('Status','easybook-add-ons');
        $columns['_date']   = __('Date','easybook-add-ons');

        $columns['_id']             = __('ID','easybook-add-ons');
        return $columns;
    }
    public function meta_columns_content($column_name, $post_ID){
        if ($column_name == '_from') {
            if(get_post_meta( $post_ID, ESB_META_PREFIX.'from_user_id', true ) == 0){
                $from_name = get_post_meta( $post_ID, ESB_META_PREFIX.'lmsg_name', true );
            }else{
                $user_info = get_userdata( get_post_meta( $post_ID, ESB_META_PREFIX.'from_user_id', true ) );
                $from_name = $user_info->display_name;
            }
            echo '<strong>'.$from_name.'</strong>';
        }
        if ($column_name == '_to') {
            // only send to an user
            $user_info = get_userdata( get_post_meta( $post_ID, ESB_META_PREFIX.'to_user_id', true ) );
            echo '<strong>'.$user_info->display_name.'</strong>';
        }
        if ($column_name == '_status') {
            echo '<strong>'.easybook_addons_get_booking_status_text(get_post_meta( $post_ID, ESB_META_PREFIX.'lmsg_status', true )).'</strong>';
            
        }

        if ($column_name == '_id') {
            echo '<strong>'.$post_ID.'</strong>';
        }
    }

    protected function set_meta_boxes(){
        $this->meta_boxes = array(
            'details'       => array(
                'title'         => __( 'Details', 'easybook-add-ons' ),
                'context'       => 'normal', // normal - side - advanced
                'priority'       => 'core', // default - high - core - low
                'callback_args'       => array(),
            )
        );
    }

    public function lmessage_details_callback($post, $args){
        wp_nonce_field( 'cth-cpt-fields', '_cth_cpt_nonce' );

        $listing_id             = get_post_meta( $post->ID, ESB_META_PREFIX.'listing_id', true );
        $user_id                = get_post_meta( $post->ID, ESB_META_PREFIX.'user_id', true );
        $listing_post           = get_post($listing_id);

        $user_info = get_userdata($user_id);

        ?>
        <table class="form-table lclaim-details">
            <tbody>
                <tr class="hoz">
                    <th class="w20"><?php _e( 'Name:', 'easybook-add-ons' ); ?></th>
                    <td><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'lmsg_name', true ); ?></a></td>
                </tr>
                <tr class="hoz">
                    <th class="w20"><?php _e( 'Email:', 'easybook-add-ons' ); ?></th>
                    <td><a href="mailto:<?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'lmsg_email', true ); ?>"><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'lmsg_email', true ); ?></a></td>
                </tr>
                <tr class="hoz">
                    <th class="w20"><?php _e( 'Phone:', 'easybook-add-ons' ); ?></th>
                    <td><span><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'lmsg_phone', true ); ?></span></td>
                </tr>
                <tr class="hoz">
                    <th class="w20"><?php _e( 'Message:', 'easybook-add-ons' ); ?></th>
                    <td>
                        <?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'lmsg_message', true );?>
                    </td>
                </tr>

            </tbody>
        </table>
        <?php   
    }

    public function lauthor_message() {
        $json = array(
            'success' => true,
            'data' => array(
                // 'POST'=>$_POST,
            )
        );
        

        $nonce = $_POST['_nonce'];
        
        if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
            $json['success'] = false;
            $json['data']['error'] = esc_html__( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }


        $authid = $_POST['authid'];
        if(is_numeric($authid) && (int)$authid > 0){

            $lmessage_datas = array();
            $lmessage_metas_loggedin = array();
            if(isset($_POST['lmsg_name'])&&isset($_POST['lmsg_email']) ){
                // $lmessage_datas['post_title'] = sprintf(__( 'Message from %s', 'easybook-add-ons' ), $_POST['lmsg_name']);
                $lmessage_datas['post_title'] = $_POST['lmsg_name'];
            }else{
                $current_user = wp_get_current_user();
                if(0 == $current_user->ID){ // no logged in user and invalid form
                    $json['success'] = false;
                    $json['data']['error'] = __( 'Invalid message form without name and email.', 'easybook-add-ons' );
                    
                }else{
                    // $lmessage_datas['post_title'] = sprintf(__( 'Message from %s', 'easybook-add-ons' ), $current_user->display_name ); 
                    $lmessage_datas['post_title'] = $current_user->display_name;

                    $lmessage_metas_loggedin['lmsg_name'] = $current_user->display_name;
                    $lmessage_metas_loggedin['lmsg_email'] = $current_user->user_email;
                    $lmessage_metas_loggedin['lmsg_phone'] = get_user_meta($current_user->ID,  ESB_META_PREFIX.'phone', true );
                }
                
            }
            $lmessage_datas['post_content'] = '';
            //$lmessage_datas['post_author'] = '0';// default 0 for no author assigned
            $lmessage_datas['post_status'] = 'publish';
            $lmessage_datas['post_type'] = 'lmessage';

            do_action( 'easybook_addons_insert_message_before', $lmessage_datas );

            $lmessage_id = wp_insert_post($lmessage_datas ,true );

            if (!is_wp_error($lmessage_id)) {
                //print( $lmessage_id->get_error_message() );
                // $json['data']['lmessage_id'] = $lmessage_id;
                $meta_fields = array(
                    'lmsg_name'                 => 'text',
                    'lmsg_email'                => 'text',
                    'lmsg_phone'                => 'text',

                    
                    'lmsg_message'              => 'text',
                    'lmsg_type'                 => 'text',
                );
                $lmessage_metas = array();
                foreach($meta_fields as $field => $ftype){
                    if(isset($_POST[$field])) $lmessage_metas[$field] = $_POST[$field] ;
                    else{
                        if($ftype == 'array'){
                            $lmessage_metas[$field] = array();
                        }else{
                            $lmessage_metas[$field] = '';
                        }
                    } 
                }
                $lmessage_metas['to_user_id'] = $authid;
                $lmessage_metas['from_user_id'] = get_current_user_id();
                $lmessage_metas['lmsg_status'] = 'pending'; // pending - completed - failed - refunded - canceled

                // merge with logged in customser data
                $lmessage_metas = array_merge($lmessage_metas,$lmessage_metas_loggedin);

                // $cmb_prefix = '_cth_';
                foreach ($lmessage_metas as $key => $value) {
                    // https://codex.wordpress.org/Function_Reference/update_post_meta
                    // Returns meta_id if the meta doesn't exist, otherwise returns true on success and false on failure. 
                    // NOTE: If the meta_value passed to this function is the same as the value that is already in the database, this function returns false.
                    if ( !update_post_meta( $lmessage_id, ESB_META_PREFIX.$key,  $value  ) ) {
                        $json['data'][] = sprintf(__('Insert message %s meta failure or existing meta value','easybook-add-ons'),$key);
                        // wp_send_json($json );
                    }
                }

                // $json['data']['lmessage_metas'] = $lmessage_metas;

                $json['data']['message'] = apply_filters( 'easybook_addons_insert_message_message', __( 'Your message is received. The listing author will contact with you soon.<br />You can also login with your email to manage messages.<br />Thank you.', 'easybook-add-ons' ) );

                do_action( 'easybook_addons_insert_message_after', $lmessage_id , $lmessage_metas);
            }else{
                $json['success'] = false;
                $json['data']['error'] = $lmessage_id->get_error_message();

                if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Insert booking post error: " . $lmessage_id->get_error_message() . PHP_EOL, 3, ESB_LOG_FILE);

                // throw new Exception($lmessage_id->get_error_message());

            }

        }else{
            $json['success'] = false;
            $json['data']['error'] = esc_html__( 'The author id is incorrect.', 'easybook-add-ons' ) ;
        }

        wp_send_json($json );

    }
    public function del_lmessage() {
        $json = array(
            'success' => false,
            'data' => array(
                // 'POST'=>$_POST,
            )
        );
        

        $nonce = $_POST['_nonce'];
        
        if ( ! wp_verify_nonce( $nonce, 'easybook-add-ons' ) ){
            $json['success'] = false;
            $json['data']['error'] = esc_html__( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }


        $msgid = $_POST['msgid'];
        if(is_numeric($msgid) && (int)$msgid > 0){
            if(get_current_user_id() != get_post_meta( $msgid, ESB_META_PREFIX.'to_user_id', true ) ){
                $json['data']['error'] = __( "You don't have permission to delete this message", 'easybook-add-ons' );
                // wp_send_json($json );
            }else{

                $deleted_post = wp_delete_post( $msgid, true );//move to trash
                if($deleted_post){
                    $json['data']['deleted_message'] = $deleted_post;
                    $json['success'] = true;
                }else{
                    $json['data']['error'] = esc_html__( 'Delete message failure', 'easybook-add-ons' ) ;
                }

            }

                
        }else{
            
            $json['data']['error'] = esc_html__( 'The message id is incorrect.', 'easybook-add-ons' ) ;
        }

        wp_send_json($json );

    }

}

new Esb_Class_Message_CPT();



		


