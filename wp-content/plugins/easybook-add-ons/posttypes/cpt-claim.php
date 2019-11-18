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



class Esb_Class_Claim_CPT extends Esb_Class_CPT {
    protected $name = 'cthclaim';

    protected function init(){
        parent::init();

        $logged_in_ajax_actions = array(
            'claim_listing',
        );
        foreach ($logged_in_ajax_actions as $action) {
            $funname = str_replace('easybook_addons_', '', $action);
            add_action('wp_ajax_'.$action, array( $this, $funname ));
        }

        add_action( 'easybook_addons_lclaim_change_status_to_approved', array($this, 'claim_approved_callback') );
    }

    public function register(){

        $labels = array( 
            'name' => __( 'Claims', 'easybook-add-ons' ),
            'singular_name' => __( 'Claim', 'easybook-add-ons' ),
            'add_new' => __( 'Add New Claim', 'easybook-add-ons' ),
            'add_new_item' => __( 'Add New Claim', 'easybook-add-ons' ),
            'edit_item' => __( 'Edit Claim', 'easybook-add-ons' ),
            'new_item' => __( 'New Claim', 'easybook-add-ons' ),
            'view_item' => __( 'View Claim', 'easybook-add-ons' ),
            'search_items' => __( 'Search Claims', 'easybook-add-ons' ),
            'not_found' => __( 'No Claims found', 'easybook-add-ons' ),
            'not_found_in_trash' => __( 'No Claims found in Trash', 'easybook-add-ons' ),
            'parent_item_colon' => __( 'Parent Claim:', 'easybook-add-ons' ),
            'menu_name' => __( 'Listing Claims', 'easybook-add-ons' ),
        );

        $args = array( 
            'labels' => $labels,
            'hierarchical' => false,
            'description' => __( 'Listing author claims', 'easybook-add-ons' ),
            'supports' => array( 'title'),
            'taxonomies' => array(),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,//default from show_ui
            'menu_position' => 25,
            'menu_icon' => 'dashicons-money',
            'show_in_nav_menus' => false,
            'publicly_queryable' => false,
            'exclude_from_search' => true,
            'has_archive' => false,
            'query_var' => false,
            'can_export' => false,
            'rewrite' => array( 'slug' => __('claim','easybook-add-ons') ),
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
        $columns['_id']             = __('ID','easybook-add-ons');
        $columns['_status']             = __('Status/Actions','easybook-add-ons');
        return $columns;
    }
    public function meta_columns_content($column_name, $post_ID){
        if ($column_name == '_status') {
            echo '<strong>'.easybook_add_ons_get_claim_status( get_post_meta( $post_ID, ESB_META_PREFIX.'claim_status', true ) ).'</strong>';
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

    public function cthclaim_details_callback($post, $args){
        wp_nonce_field( 'cth-cpt-fields', '_cth_cpt_nonce' );

        $listing_id             = get_post_meta( $post->ID, ESB_META_PREFIX.'listing_id', true );
        $user_id                = get_post_meta( $post->ID, ESB_META_PREFIX.'user_id', true );
        $listing_post           = get_post($listing_id);

        $user_info = get_userdata($user_id);

        ?>
        <table class="form-table lclaim-details">
            <tbody>

                <tr class="hoz">
                    <th class="w20"><?php _e( 'For Listing', 'easybook-add-ons' ); ?></th>
                    <td>
                        <?php 
                            echo sprintf(__( '<h3><a href="%s" target="_blank">%s</a></h3>', 'easybook-add-ons' ), esc_url(get_permalink($listing_post->ID)), $listing_post->post_title );
                        ?>
                    </td>
                </tr>

                <tr class="hoz">
                    <th class="w20"><?php _e( 'Claim Author', 'easybook-add-ons' ); ?></th>
                    <td>
                    <?php 
                    if(!$user_info){
                        _e( 'No author', 'easybook-add-ons' );
                    }else{
                        echo sprintf(__( '<a href="%s" target="_blank">%s</a>', 'easybook-add-ons' ), esc_url(get_author_posts_url($user_info->ID)), $user_info->display_name );

                    }
                    ?>
                    </td>
                </tr>
                <?php 
                $statuses = easybook_add_ons_get_claim_status();
                $selected = get_post_meta( $post->ID, ESB_META_PREFIX.'claim_status', true ); ?>
                <tr class="hoz">
                    <th class="w20"><?php _e( 'Status/Actions', 'easybook-add-ons' ); ?></th>
                    <td>
                        <?php 
                        if(count($statuses)){
                            echo '<select id="claim_status" name="claim_status">';
                            foreach ($statuses as $status => $label) {
                                echo '<option value="'.$status.'" '.selected( $selected, $status, false ).'>'.$label.'</option>';
                            }
                            echo '</select>';
                        }
                        ?>

                    </td>
                </tr>
                
                <tr class="hoz claim-price-tr<?php if($selected == 'asked_charge') echo ' claim-fee-asked'; ?>" id="claim_price_tr">
                    <th class="w20"><?php _e( 'Claim Price', 'easybook-add-ons' ); ?></th>
                    <td>
                        <?php echo easybook_addons_get_option('currency_symbol','$'); ?><input type="text" name="_price" value="<?php echo (float) get_post_meta( $post->ID, '_price', true );?>">
                        <p><?php _e( 'Enter listing claim price then save the change. Claimed user will receive an email contains details for paying this.', 'easybook-add-ons' ); ?></p>
                    </td>
                </tr>

                <tr class="hoz">
                    <th class="w20"><?php _e( 'Author Message', 'easybook-add-ons' ); ?></th>
                    <td>
                        <textarea name="claim_msg" id="claim_msg" cols="30" rows="5" class="w100"><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'claim_msg', true );?></textarea>
                    </td>
                </tr>

            </tbody>
        </table>
        <?php   
    }

    public function save_post($post_id, $post, $update){
        if(!$this->can_save($post_id)) return;

        if(isset($_POST['claim_msg'])){
            $new_val = sanitize_textarea_field( $_POST['claim_msg'] ) ;
            $origin_val = get_post_meta( $post_id, ESB_META_PREFIX.'claim_msg', true );
            if($new_val !== $origin_val){
                update_post_meta( $post_id, ESB_META_PREFIX.'claim_msg', $new_val );
            }
            
        }

        if(isset($_POST['_price'])){
            $new_val = (float)$_POST['_price'];
            $origin_val = (float) get_post_meta( $post_id, '_price', true );
            if($new_val !== $origin_val){
                update_post_meta( $post_id, '_price', $new_val );
            }
            
        }

        if(isset($_POST['claim_status'])){
            $new_status = sanitize_text_field( $_POST['claim_status'] ) ;
            $origin_status = get_post_meta( $post_id, ESB_META_PREFIX.'claim_status', true );
            if($new_status !== $origin_status){
                update_post_meta( $post_id, ESB_META_PREFIX.'claim_status', $new_status );

                // unhook this function so it doesn't loop infinitely
                remove_action( 'save_post_'.$this->name, array($this, 'save_post'), 10, 3  );
                
                    do_action('easybook_addons_lclaim_change_status_'.$origin_status.'_to_'.$new_status, $post_id );
                    do_action('easybook_addons_lclaim_change_status_to_'.$new_status, $post_id );  

                // re-hook this function
                add_action( 'save_post_'.$this->name, array($this, 'save_post'), 10, 3  );
            }
        }
    }

    // admin approve claim
    public function claim_approved_callback($claim_id = 0){
        if(is_numeric($claim_id)&&(int)$claim_id > 0){
            $claim_post = get_post($claim_id);
            if (null != $claim_post){
                $listing_id                     = get_post_meta( $claim_post->ID, ESB_META_PREFIX.'listing_id', true );
                $user_id                        = get_post_meta( $claim_post->ID, ESB_META_PREFIX.'user_id', true );
                
                // update user role to listing author - need to check for option
                // update role for subscriber and listing customer only 
                // only update role if lower role
                if(in_array( easybook_addons_get_user_role($user_id) , array( 'author', 'contributor', 'subscriber', 'l_customer' ))){
                    $user_id_new = wp_update_user( array( 'ID' => $user_id, 'role' => 'listing_author' ) );
                    if ( is_wp_error( $user_id_new ) ) {
                        if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Can not update user role to listing_author" . PHP_EOL, 3, ESB_LOG_FILE);
                    }else{
                        easybook_addons_add_user_notification($user_id, array(
                            'type' => 'role_change',
                        ));
                    }
                }
                // update listing author to claimed author
                $lis_args = array(
                    'ID'                => $listing_id,
                    'post_author'       => $user_id,
                );
                $lis_id = wp_update_post( $lis_args, true );    
                if (is_wp_error($lis_id)) {
                    if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Update listing (ID: $lis_id) to claimed author (ID: $user_id) error: " . $lis_id->get_error_message() . PHP_EOL, 3, ESB_LOG_FILE);
                }else{
                    update_post_meta( $listing_id, ESB_META_PREFIX.'verified',  '1'  );
                }

                do_action( 'easybook_addons_cthclaim_approved', $claim_id, $listing_id, $user_id );
            }
        }
                    
    }

    public function claim_listing(){
        $json = array(
            'success' => false,
            'data' => array(
                // 'POST'=>$_POST,
            )
        );

        Esb_Class_Ajax_Handler::verify_nonce('claim_listing');

        $listing_post = get_post($_POST['listing_id']);

        if(empty($listing_post)){
            $json['error'] = esc_html__( 'Invalid listing ID', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }

        if( get_post_meta( $listing_post->ID, ESB_META_PREFIX.'verified', true ) == '1' ){
            $json['error'] = esc_html__( 'This listing was verified! Contact us for further assistance.', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }

        $lclaim_datas = array();
        $current_user = wp_get_current_user();

        $lclaim_datas['post_title'] = sprintf( _x( '%s claimed for %s listing', 'listing claim title', 'easybook-add-ons' ), $current_user->display_name, $listing_post->post_title );

        $lclaim_datas['post_content'] = '';
        $lclaim_datas['post_status'] = 'publish';
        $lclaim_datas['post_type'] = 'cthclaim';

        do_action( 'easybook_addons_insert_cthclaim_before', $lclaim_datas );

        $claim_id = wp_insert_post($lclaim_datas ,true );
        if (!is_wp_error($claim_id)) {
            if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Claim inserted: " . $claim_id . PHP_EOL, 3, ESB_LOG_FILE);
            // update claim meta datas
            $claim_metas['listing_id'] = $listing_post->ID;
            $claim_metas['claim_status'] = 'pending';
            $claim_metas['user_id'] = $current_user->ID;
            $claim_metas['claim_msg'] = isset($_POST['claim_message']) ? $_POST['claim_message'] : '';
            foreach ($claim_metas as $key => $value) {
                update_post_meta( $claim_id, ESB_META_PREFIX.$key,  $value  );
                
            }
            $json['success'] = true;
            $json['message'] = __( 'Your claim has been submitted.', 'easybook-add-ons' );
        }

        wp_send_json($json );
    }
}

new Esb_Class_Claim_CPT();








