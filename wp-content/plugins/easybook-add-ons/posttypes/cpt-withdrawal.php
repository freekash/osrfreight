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



class Esb_Class_Withdrawal_CPT extends Esb_Class_CPT {
    protected $name = 'lwithdrawal';

    protected function init(){
        parent::init();
        add_action( 'easybook_addons_lwithdrawal_change_status_to_completed', array($this, 'do_completed') );
        add_action( 'easybook_addons_lwithdrawal_change_status_pending_to_completed', array($this, 'do_pending_to_completed') );
    }

    protected function set_meta_boxes(){
        $this->meta_boxes = array(
            'details'       => array(
                'title'         => __( 'Details', 'easybook-add-ons' ),
                'context'       => 'normal', // normal - side - advanced
                'priority'       => 'high', // default - high - low
                'callback_args'       => array(),
            ),
            'status'       => array(
                'title'         => __( 'Status', 'easybook-add-ons' ),
                'context'       => 'side', // normal - side - advanced
                'priority'       => 'high', // default - high - low
                'callback_args'       => array(),
            )
        );
    }

    public function register(){

        $labels = array( 
            'name' => __( 'Withdrawals', 'easybook-add-ons' ),
            'singular_name' => __( 'Withdrawals', 'easybook-add-ons' ), 
            'add_new' => __( 'Add New Withdrawals', 'easybook-add-ons' ),
            'add_new_item' => __( 'Add New Withdrawals', 'easybook-add-ons' ),
            'edit_item' => __( 'Edit Withdrawals', 'easybook-add-ons' ),
            'new_item' => __( 'New Withdrawals', 'easybook-add-ons' ),
            'view_item' => __( 'View Withdrawals', 'easybook-add-ons' ),
            'search_items' => __( 'Search Withdrawals', 'easybook-add-ons' ),
            'not_found' => __( 'No Withdrawals found', 'easybook-add-ons' ),
            'not_found_in_trash' => __( 'No Withdrawals found in Trash', 'easybook-add-ons' ),
            'parent_item_colon' => __( 'Parent Withdrawals:', 'easybook-add-ons' ), 
            'menu_name' => __( 'Listing Withdrawals', 'easybook-add-ons' ),
        );

        $args = array( 
            'labels' => $labels,
            'hierarchical' => false,
            'description' => __( 'List Withdrawals', 'easybook-add-ons' ),
            'supports' => array(''),
            'taxonomies' => array(),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,//default from show_ui
            'menu_position' => 25,
            'menu_icon' => 'dashicons-tickets-alt',
            'show_in_nav_menus' => false,
            'publicly_queryable' => false,
            'exclude_from_search' => true,
            'has_archive' => false,
            'query_var' => false,
            'can_export' => true,
            'rewrite' => array( 'slug' => __('withdrawals','easybook-add-ons') ),
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
        unset($columns['title']);
        unset($columns['author']);
        unset($columns['comments']);
        $columns['_id']             = __('Withdrawal','easybook-add-ons');
        $columns['_status']             = __('Status','easybook-add-ons');
        $columns['_amount']   = __('Amount','easybook-add-ons');
        $columns['_gateway']   = __('Payment','easybook-add-ons');
        return $columns;
    }
    public function meta_columns_content($column_name, $post_ID){
        if ($column_name == '_id') {
            echo '<div class="tips">';
            echo '<a href="'.admin_url('post.php?post='.$post_ID.'&action=edit' ).'"><strong>#'.$post_ID.'</strong></a>';
            echo __(' by ','easybook-add-ons'). '<strong>'.get_post_meta( $post_ID, ESB_META_PREFIX.'first_name', true ). ' '.get_post_meta( $post_ID, ESB_META_PREFIX.'last_name', true ).'</strong>';
            echo '<br /><small class="meta email"><a href="mailto:'.get_post_meta( $post_ID, ESB_META_PREFIX.'withdrawal_email', true ).'">'.get_post_meta( $post_ID, ESB_META_PREFIX.'withdrawal_email', true ).'</a></small>';
            echo '</div>';
        }
        if ($column_name == '_status') {
            echo '<strong>'.easybook_addons_get_booking_status_text(get_post_meta( $post_ID, ESB_META_PREFIX.'status', true )).'</strong>';
            
        }
        if ($column_name == '_gateway') {
            echo '<strong>'.easybook_addons_get_order_method_text(get_post_meta( $post_ID, ESB_META_PREFIX.'payment_method', true )).'</strong>';
            
        }
        if ($column_name == '_amount') {
            echo '<strong>'.easybook_addons_get_price_formated( get_post_meta( $post_ID, ESB_META_PREFIX.'amount', true ) ).'</strong>';
            
        }
    }

    public function lwithdrawal_details_callback($post, $args){
        wp_nonce_field( 'cth-cpt-fields', '_cth_cpt_nonce' );

        ?>
        <h2><?php echo sprintf(__( 'Withdrawals #%d details', 'easybook-add-ons' ), $post->ID); ?></h2>
        <table class="form-table withdrawals-details">
            <thead>
                <tr>
                    <th class="lod-plan"><?php _e( 'Email', 'easybook-add-ons' );?></th>
                    <th class="lod-price"><?php _e( 'Amount', 'easybook-add-ons' );?></th>
                    <th class="lod-quantity"><?php _e( 'Payment', 'easybook-add-ons' );?></th>
                   <!--  <th class="lod-amount"><?php _e( 'Amount', 'easybook-add-ons' );?></th> -->
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="lod-plan"><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'withdrawal_email', true ); ?></td>
                    <td class="lod-price"><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'amount', true ); ?></td>
                    <td class="lod-quantity"><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'payment_method', true ); ?></td>
                   <!--  <td class="lod-amount"><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'quantity', true );?></td> -->
                </tr>
            </tbody>
        </table>
        <?php   
    }

    public function lwithdrawal_status_callback($post, $args){
        /*
         * Use get_post_meta() to retrieve an existing value
         * from the database and use the value for the form.
         */
        $value = get_post_meta( $post->ID, ESB_META_PREFIX.'status', true );

        $status = easybook_addons_get_booking_statuses_array();
        ?>
        <table class="form-table lwithdrawal-details">
            <tbody>
                <tr class="hoz">
                    <td>
                        <select name="lo_status" class="w100">
                        <?php 
                        foreach ($status as $sts => $lbl) {
                            echo '<option value="'.$sts.'" '.selected( $value, $sts, false ).'>'.$lbl.'</option>';
                        }
                        ?>
                        </select>
                    </td>
                </tr>
                
            </tbody>
        </table>
        <?php
    }

    public function save_post($post_id, $post, $update){
        if(!$this->can_save($post_id)) return;

        if(isset($_POST['lo_status'])){
            $new_status = sanitize_text_field( $_POST['lo_status'] ) ;
            $origin_status = get_post_meta( $post_id, ESB_META_PREFIX.'status', true );
            if($new_status !== $origin_status){
                // update_post_meta( $post_id, ESB_META_PREFIX.'status', $new_status ); // move to action hook for checking

                // unhook this function so it doesn't loop infinitely
                remove_action( 'save_post_'.$this->name, array($this, 'save_post'), 10, 3  );
                
                    do_action('easybook_addons_lwithdrawal_change_status_'.$origin_status.'_to_'.$new_status, $post_id );
                    do_action('easybook_addons_lwithdrawal_change_status_to_'.$new_status, $post_id );

                // re-hook this function
                add_action( 'save_post_'.$this->name, array($this, 'save_post'), 10, 3  );

                
            }
        }
    }

    public function do_completed($post_id = 0){

    }
    public function do_pending_to_completed($post_id = 0){
        if(is_numeric($post_id)&&(int)$post_id > 0){
            Esb_Class_Earning::update($post_id);
            update_post_meta( $post_id, ESB_META_PREFIX.'status', 'completed' );
        }
    }
}

new Esb_Class_Withdrawal_CPT();

