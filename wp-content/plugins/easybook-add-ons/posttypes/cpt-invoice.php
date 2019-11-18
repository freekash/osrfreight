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



class Esb_Class_Invoice_CPT extends Esb_Class_CPT {
    protected $name = 'cthinvoice';

    protected function init(){
        parent::init();

        $logged_in_ajax_actions = array(
            'view_invoice',
        );
        foreach ($logged_in_ajax_actions as $action) {
            $funname = str_replace('easybook_addons_', '', $action);
            add_action('wp_ajax_'.$action, array( $this, $funname ));
        }
    }

    public function register(){

        $labels = array( 
            'name' => __( 'Invoice', 'easybook-add-ons' ),
            'singular_name' => __( 'Invoice', 'easybook-add-ons' ),
            'add_new' => __( 'Add New Invoice', 'easybook-add-ons' ),
            'add_new_item' => __( 'Add New Invoice', 'easybook-add-ons' ),
            'edit_item' => __( 'Edit Invoice', 'easybook-add-ons' ),
            'new_item' => __( 'New Invoice', 'easybook-add-ons' ),
            'view_item' => __( 'View Invoice', 'easybook-add-ons' ),
            'search_items' => __( 'Search Invoices', 'easybook-add-ons' ),
            'not_found' => __( 'No Invoices found', 'easybook-add-ons' ),
            'not_found_in_trash' => __( 'No Invoices found in Trash', 'easybook-add-ons' ),
            'parent_item_colon' => __( 'Parent Invoice:', 'easybook-add-ons' ),
            'menu_name' => __( 'Listing Invoices', 'easybook-add-ons' ),
        );

        $args = array( 
            'labels' => $labels,
            'hierarchical' => false,
            'description' => __( 'Subscription invoice', 'easybook-add-ons' ),
            'supports' => array( '' ),
            'taxonomies' => array(),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,//default from show_ui
            'menu_position' => 25,
            'menu_icon' => 'dashicons-media-text',
            'show_in_nav_menus' => false,
            'publicly_queryable' => false,
            'exclude_from_search' => true,
            'has_archive' => false,
            'query_var' => false,
            'can_export' => false,
            'rewrite' => array( 'slug' => __('cthinvoice','easybook-add-ons') ),
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
        unset($columns['comments']);
        $columns['_plan']   = __('Plan','easybook-add-ons');
        $columns['_end_date']   = __('Expire Date','easybook-add-ons');
        $columns['_payment']       =  __('Payment','easybook-add-ons');
        $columns['_amount']   = __('Total','easybook-add-ons');
    
        return $columns;
    }
    public function meta_columns_content($column_name, $post_ID){
        if ($column_name == '_payment') {
            echo '<strong>'.easybook_addons_get_order_method_text(get_post_meta( $post_ID, ESB_META_PREFIX.'payment', true )).'</strong>';
        }
        if ($column_name == '_amount') {
            echo '<strong>'.easybook_addons_get_price_formated( get_post_meta( $post_ID, ESB_META_PREFIX.'amount', true ) ).'</strong>';
            
        }
        if ($column_name == '_plan') {
            echo '<strong>'.get_post_meta( $post_ID, ESB_META_PREFIX.'plan_title', true).'</strong>'; 
        }
        // if ($column_name == 'from_date') {
        //     echo '<strong>'.get_post_meta( $post_ID, ESB_META_PREFIX.'from_date', true ).'</strong>';
            
        // }
        if ($column_name == '_end_date') {
            echo '<strong>'.get_post_meta( $post_ID, ESB_META_PREFIX.'end_date', true ).'</strong>';
        }
    }

    protected function set_meta_boxes(){
        $this->meta_boxes = array(
            'details'       => array(
                'title'         => __( 'Invoice Details', 'easybook-add-ons' ),
                'context'       => 'normal', // normal - side - advanced
                'priority'       => 'core', // default - high - core - low
                'callback_args'       => array(),
            )
        );
    }

    public function cthinvoice_details_callback($post, $args){
        wp_nonce_field( 'cth-cpt-fields', '_cth_cpt_nonce' );
        ?>
        <table class="form-table cth-table table-invoice-details">
            <tbody>
                <tr>
                    <td class="w40" colspan="2"><?php _e( 'Date', 'easybook-add-ons' ); ?></td>
                    <td class="w60 text-bold" colspan="3"><?php echo easybook_addons_date_format( $post->post_date ); ?></td>
                </tr>
                <tr>
                    <td class="w40" colspan="2"><?php _e( 'Subscribed with', 'easybook-add-ons' ); ?></td>
                    <td class="w40 text-bold" colspan="3"><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'user_name', true ); ?></td>
                </tr>
                <tr>
                    <td class="w40" colspan="2"><?php _e( 'Charged via', 'easybook-add-ons' ); ?></td>
                    <td class="w40 text-bold" colspan="3"><?php echo easybook_addons_get_order_method_text(get_post_meta( $post->ID, ESB_META_PREFIX.'payment', true )); ?></td>
                </tr>
                <tr>
                    <td class="w40" colspan="2"><?php _e( 'Expiration date', 'easybook-add-ons' ); ?></td>
                    <td class="w40 text-bold" colspan="3"><?php echo easybook_addons_date_format( get_post_meta( $post->ID, ESB_META_PREFIX.'end_date', true ), true ); ?></td>
                </tr>
                <tr>
                    <td class="w80" colspan="4"><?php _e( 'Subscription to', 'easybook-add-ons' ); ?> <?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'plan_title', true ); ?></td>
                    <td class="w20 text-right"><?php echo easybook_addons_get_price_formated(get_post_meta( $post->ID, ESB_META_PREFIX.'amount', true )); ?></td>
                </tr>
                <tr>
                    <td class="w40 text-right text-bold text-blur" colspan="2"><?php _e( 'Subtotal', 'easybook-add-ons' ); ?></td>
                    <td class="w40 text-right" colspan="3"><?php echo easybook_addons_get_price_formated(get_post_meta( $post->ID, ESB_META_PREFIX.'amount', true )); ?></td>
                </tr>
                <tr>
                    <td class="w40 text-right text-bold text-blur" colspan="2"><?php _e( 'Total', 'easybook-add-ons' ); ?></td>
                    <td class="w40 text-right" colspan="3"><?php echo easybook_addons_get_price_formated(get_post_meta( $post->ID, ESB_META_PREFIX.'amount', true )); ?></td>
                </tr>
                <tr>
                    <td class="w40 text-right text-bold" colspan="2"><?php _e( 'Paid', 'easybook-add-ons' ); ?></td>
                    <td class="w60 text-right text-bold" colspan="3"><?php echo easybook_addons_get_price_formated(get_post_meta( $post->ID, ESB_META_PREFIX.'amount', true )); ?></td>
                </tr>
            </tbody>
        </table>
        <?php   
    }

    public function view_invoice(){
        $json = array(
            'success' => false,
            // 'data' => array(
            //     'POST'=>$_POST,
            // )
        );
        Esb_Class_Ajax_Handler::verify_nonce('easybook-add-ons');
        $invoice_post          = get_post($_POST['invoice']);
        if(empty($invoice_post)){
            $json['error'] = esc_html__( 'Invalid invoice', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }
        $json['success'] = true;
        $json['invoice'] = self::get_invoice_datas($invoice_post);
        wp_send_json($json );
    }

    public static function get_invoice_datas($invoice_post){
        return array(
            'author' => get_post_meta( $invoice_post->ID, ESB_META_PREFIX.'user_name', true ),
            'amount' => easybook_addons_get_price_formated(get_post_meta( $invoice_post->ID, ESB_META_PREFIX.'amount', true )),
            
            'method' => easybook_addons_get_order_method_text(get_post_meta( $invoice_post->ID, ESB_META_PREFIX.'payment', true )),
            'title' => $invoice_post->post_title,
            'number' => $invoice_post->ID,
            'date' => easybook_addons_date_format( $invoice_post->post_date ),

            'plan' => get_post_meta( $invoice_post->ID, ESB_META_PREFIX.'plan_title', true ),
            'expire' => easybook_addons_date_format( get_post_meta( $invoice_post->ID, ESB_META_PREFIX.'end_date', true ), true ),
            
        );
    }
}

new Esb_Class_Invoice_CPT();

    



















