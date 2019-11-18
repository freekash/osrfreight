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



class Esb_Class_AD_CPT extends Esb_Class_CPT {
    protected $name = 'cthads';

    protected function init(){
        parent::init();

        add_action( 'init', array($this, 'taxonomies'), 0 );
        add_action( 'easybook_addons_cthads_change_status_to_completed', array($this, 'do_completed') );
        add_action( 'easybook_addons_cthads_change_status_to_disable', array($this, 'disable_ad') );
    }

    public function register(){

        $labels = array( 
            'name' => __( 'ADs', 'easybook-add-ons' ),
            'singular_name' => __( 'AD', 'easybook-add-ons' ),
            'add_new' => __( 'Add New AD', 'easybook-add-ons' ),
            'add_new_item' => __( 'Add New AD', 'easybook-add-ons' ),
            'edit_item' => __( 'Edit AD', 'easybook-add-ons' ),
            'new_item' => __( 'New AD', 'easybook-add-ons' ),
            'view_item' => __( 'View AD', 'easybook-add-ons' ),
            'search_items' => __( 'Search ADs', 'easybook-add-ons' ),
            'not_found' => __( 'No ADs found', 'easybook-add-ons' ),
            'not_found_in_trash' => __( 'No ADs found in Trash', 'easybook-add-ons' ),
            'parent_item_colon' => __( 'Parent AD:', 'easybook-add-ons' ),
            'menu_name' => __( 'Listing ADs', 'easybook-add-ons' ),
        );

        $args = array( 
            'labels' => $labels,
            'hierarchical' => false,
            'description' => __( 'Listing author ads', 'easybook-add-ons' ),
            'supports' => array( 'title'),
            'taxonomies' => array(),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,//default from show_ui
            'menu_position' => 25,
            'menu_icon' => 'dashicons-forms',
            'show_in_nav_menus' => false,
            'publicly_queryable' => false,
            'exclude_from_search' => true,
            'has_archive' => false,
            'query_var' => false,
            'can_export' => false,
            'rewrite' => array( 'slug' => __('cthads','easybook-add-ons') ),
            'capability_type' => 'post',

            'capabilities' => array(
                'create_posts' => 'do_not_allow', // false < WP 4.5, credit @Ewout
            ),
            'map_meta_cap' => true, // Set to `false`, if users are not allowed to edit/delete existing posts
        );

        register_post_type( $this->name, $args );
    }
    public function taxonomies(){
        $labels = array(
            'name' => __( 'ADs Package', 'easybook-add-ons' ),
            'singular_name' => __( 'ADs Package', 'easybook-add-ons' ),
            'search_items' =>  __( 'Search ADs Packages','easybook-add-ons' ),
            'all_items' => __( 'All ADs Packages','easybook-add-ons' ),
            'parent_item' => __( 'Parent ADs Package','easybook-add-ons' ),
            'parent_item_colon' => __( 'Parent ADs Package:','easybook-add-ons' ),
            'edit_item' => __( 'Edit ADs Package','easybook-add-ons' ), 
            'update_item' => __( 'Update ADs Package','easybook-add-ons' ),
            'add_new_item' => __( 'Add New ADs Package','easybook-add-ons' ),
            'new_item_name' => __( 'New ADs Package Name','easybook-add-ons' ),
            'menu_name' => __( 'ADs Packages','easybook-add-ons' ),
        );     

        // Now register the taxonomy

        register_taxonomy('cthads_package',array('cthads'), array(
            'hierarchical' => false,
            'labels' => $labels,
            'public' => false,
            'show_ui' => true,
            'show_in_nav_menus'=> false,
            'show_admin_column' => true,
            'query_var' => false,
            'rewrite' => array( 'slug' => __('cthads_package','easybook-add-ons') ),
            // https://codex.wordpress.org/Roles_and_Capabilities
            // 'capabilities' => array(
            //     'manage_terms' => 'manage_categories',
            //     'edit_terms' => 'manage_categories',
            //     'delete_terms' => 'manage_categories',
            //     'assign_terms' => 'edit_posts'
            // ),

        ));
    }
    protected function set_meta_columns(){
        $this->has_columns = true;
    }
    public function meta_columns_head($columns){
        unset($columns['date']);
        unset($columns['author']);
        unset($columns['comments']);
        $columns['_status']             = __('Status','easybook-add-ons');
        $columns['_ad_pos']   = __('AD Positions','easybook-add-ons');
        $columns['_from_date']   = __('Active Date','easybook-add-ons');
        $columns['_end_date']   = __('Expire Date','easybook-add-ons');

        return $columns;
    }
    public function meta_columns_content($column_name, $post_ID){
        if ($column_name == '_status') {
            echo '<strong>'.easybook_addons_get_booking_status_text(get_post_meta( $post_ID, ESB_META_PREFIX.'status', true )).'</strong>';
        }
        if ($column_name == '_ad_pos') {
            $listing_id = get_post_meta( $post_ID, ESB_META_PREFIX.'listing_id', true );
            foreach (easybook_addons_listing_ad_positions() as $pos => $lbl) {
                if( get_post_meta( $listing_id, ESB_META_PREFIX.'ad_position_'.$pos, true ) == 'yes' ){
                    echo '<strong>'.$lbl.'</strong><br />';
                }
            }
        }
        if ($column_name == '_from_date') {
            echo '<strong>'.get_post_meta( $post_ID, ESB_META_PREFIX.'from_date', true ).'</strong>';
        }
        if ($column_name == '_end_date') {
            echo '<strong>'.get_post_meta( $post_ID, ESB_META_PREFIX.'end_date', true ).'</strong>';
        }
    }

    protected function set_meta_boxes(){
        $this->meta_boxes = array(
            'details'       => array(
                'title'         => __( 'AD Details', 'easybook-add-ons' ),
                'context'       => 'normal', // normal - side - advanced
                'priority'       => 'core', // default - high - core - low
                'callback_args'       => array(),
            ),
            'customer'       => array(
                'title'         => __( 'Customer', 'easybook-add-ons' ),
                'context'       => 'normal', // normal - side - advanced
                'priority'       => 'core', // default - high - core - low
                'callback_args'       => array(),
            ),
            'meta'       => array(
                'title'         => __( 'AD Details', 'easybook-add-ons' ),
                'context'       => 'normal', // normal - side - advanced
                'priority'       => 'core', // default - high - core - low
                'callback_args'       => array(),
            ),
            'status'       => array(
                'title'         => __( 'AD Status', 'easybook-add-ons' ),
                'context'       => 'side', // normal - side - advanced
                'priority'       => 'high', // default - high - core - low
                'callback_args'       => array(),
            ),
        );
    }

    public function cthads_details_callback($post, $args){
        wp_nonce_field( 'cth-cpt-fields', '_cth_cpt_nonce' );
        $plan_title = __( 'Deleted Package', 'easybook-add-ons' );
        $plan_id = get_post_meta( $post->ID, ESB_META_PREFIX.'plan_id', true);
        $prices             = easybook_addons_get_plan_prices($plan_id);
        
        $ad_package = get_term( $plan_id, 'cthads_package' );
        if ( !empty( $ad_package ) && !is_wp_error( $ad_package ) ){
            $plan_title         = $ad_package->name;
            $prices             = easybook_addons_get_plan_prices(0, get_term_meta( $ad_package->term_id, ESB_META_PREFIX.'ad_price', true ) );

        } 
        ?>
        <table class="form-table cthads-details">
            <thead>
                <tr>
                    <th class="lod-plan"><?php _e( 'Package', 'easybook-add-ons' );?></th>
                    <th class="lod-price"><?php _e( 'Price', 'easybook-add-ons' );?></th>
                    <th class="lod-quantity"><?php _e( 'Quantity', 'easybook-add-ons' );?></th>
                    <th class="lod-amount"><?php _e( 'Amount', 'easybook-add-ons' );?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="lod-plan"><?php echo $plan_title; ?></td>
                    <td class="lod-price"><?php echo easybook_addons_get_price_formated( $prices['price'] ); ?></td>
                    <td class="lod-quantity"><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'quantity', true ); ?></td>
                    <td class="lod-amount"><?php echo easybook_addons_get_price_formated( $prices['total'] ); ?></td>
                    
                </tr>
            </tbody>
        </table>
        <?php   
    }
    public function cthads_customer_callback($post, $args){
        ?>
        <table class="form-table cthads-details">
            <tbody>

                <tr class="hoz">
                    <th class="w20"><?php _e( 'First Name', 'easybook-add-ons' ); ?></th>
                    <td><a href="<?php echo get_edit_user_link( get_post_meta( $post->ID, ESB_META_PREFIX.'user_id', true ) ); ?>"><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'first_name', true ); ?></a></td>
                </tr>
                <tr class="hoz">
                    <th class="w20"><?php _e( 'Email', 'easybook-add-ons' ); ?></th>
                    <td><a href="mailto:<?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'email', true ); ?>"><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'email', true ); ?></a></td>
                </tr>
            </tbody>
        </table>
        <?php   
    }
    public function cthads_meta_callback($post, $args){
        ?>
        <table class="form-table cthads-details">
            <tbody>

                <tr class="hoz">
                    <th class="w20"><?php _e( 'Gateway', 'easybook-add-ons' ); ?></th>
                    <td><?php echo easybook_addons_get_order_method_text(get_post_meta( $post->ID, ESB_META_PREFIX.'payment_method', true ));?></td>
                </tr>
                <tr class="hoz">
                    <th class="w20"><?php _e( 'Purchase Code', 'easybook-add-ons' ); ?></th>
                    <td><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'purchase_code', true );?></td>
                </tr>
                <tr class="hoz">
                    <th class="w20"><?php _e( 'Listing', 'easybook-add-ons' ); ?></th>
                    <td><?php echo get_the_title(get_post_meta( $post->ID, ESB_META_PREFIX.'listing_id', true )); ?></td>
                </tr>
                <tr class="hoz">
                    <th class="w20"><?php _e( 'Note', 'easybook-add-ons' ); ?></th>
                    <td>
                        <textarea name="ad_notes" id="ad_notes" cols="30" rows="5" class="w100"><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'ad_notes', true );?></textarea>
                    </td>
                </tr>

            </tbody>
        </table>
        <?php   
    }
    public function cthads_status_callback($post, $args){
        /*
         * Use get_post_meta() to retrieve an existing value
         * from the database and use the value for the form.
         */
        $value = get_post_meta( $post->ID, ESB_META_PREFIX.'status', true );

        $status = self::ad_statuses();
        ?>
        <table class="form-table cthads-details">
            <tbody>
                <tr class="hoz">
                    <td>
                        <select name="ad_status" class="w100">
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

        if(isset($_POST['ad_notes'])){
            $new_val = sanitize_textarea_field( $_POST['ad_notes'] ) ;
            $origin_val = get_post_meta( $post_id, ESB_META_PREFIX.'ad_notes', true );
            if($new_val !== $origin_val){
                update_post_meta( $post_id, ESB_META_PREFIX.'ad_notes', $new_val );
            }
            
        }

        
        if(isset($_POST['ad_status'])){
            $new_status = sanitize_text_field( $_POST['ad_status'] ) ;
            $origin_status = get_post_meta( $post_id, ESB_META_PREFIX.'status', true );
            if($new_status !== $origin_status){
                update_post_meta( $post_id, ESB_META_PREFIX.'status', $new_status );

                // unhook this function so it doesn't loop infinitely
                remove_action( 'save_post_'.$this->name, array($this, 'save_post'), 10, 3  );
                
                    do_action('easybook_addons_cthads_change_status_'.$origin_status.'_to_'.$new_status, $post_id );
                    do_action('easybook_addons_cthads_change_status_to_'.$new_status, $post_id );

                // re-hook this function
                add_action( 'save_post_'.$this->name, array($this, 'save_post'), 10, 3  );
            }
        }
    }

    public static function ad_statuses($status = '' ) {
        $statuses = array(
            // paypal
            'pending'=> __('Pending','easybook-add-ons'), 
            'completed'=> __('Completed','easybook-add-ons'), 
            'failed'=> __('Failed','easybook-add-ons'), 
            'refunded'=> __('Refunded','easybook-add-ons'), 
            // stripe
            'created'=> __('Created','easybook-add-ons'), 
            'trialing'=>__('Trialing','easybook-add-ons'), 
            'active'=>__('Active','easybook-add-ons'), 
            'past_due'=>__('Past Due','easybook-add-ons'), 
            'canceled'=>__('Canceled','easybook-add-ons') ,
            'unpaid'=>__('Unpaid','easybook-add-ons') 
        );
        if(!empty($status) && isset($statuses[$status])) return $statuses[$status];

        return $statuses;
    }

    public function do_completed($post_id = 0){
        Esb_Class_ADs::active_ad($post_id);
    }
    public function disable_ad($order_id = 0){
        if(is_numeric($order_id)&&(int)$order_id > 0){
            $order_post = get_post($order_id);
            if (null != $order_post){

                $plan_id = get_post_meta( $order_post->ID, ESB_META_PREFIX.'plan_id', true );

                $ad_package = get_term( $plan_id, 'cthads_package' );
                // check if the ad package is deleted
                if ( empty( $ad_package ) || is_wp_error( $ad_package ) ) 
                    $ad_package_positions = array();
                else
                    $ad_package_positions = get_term_meta( $ad_package->term_id, ESB_META_PREFIX.'ad_type', true );


                $ad_listing = get_post_meta( $order_post->ID, ESB_META_PREFIX.'listing_id', true );
                // update listin is_ad to yes
                update_post_meta( $ad_listing, ESB_META_PREFIX. 'is_ad', 'no' );
                // update listing ad_position
                if($ad_listing != ''){
                    if(is_array($ad_package_positions) && !empty($ad_package_positions)){

                        // $ad_pos_key = 1;
                        foreach ($ad_package_positions as $pos) {
                            update_post_meta( $ad_listing, ESB_META_PREFIX. 'ad_position_'.$pos, 'no');
                            // $ad_pos_key++;
                        }
                        
                    }
                }
            }
        }           
    }
}

new Esb_Class_AD_CPT();







