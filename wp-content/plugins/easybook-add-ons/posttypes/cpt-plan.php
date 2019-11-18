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



class Esb_Class_Plan_CPT extends Esb_Class_CPT {
    protected $name = 'lplan';

    protected function init(){
        parent::init();

        $logged_in_ajax_actions = array(
            'create_stripe_plan',
        );
        foreach ($logged_in_ajax_actions as $action) {
            $funname = str_replace('easybook_addons_', '', $action);
            add_action('wp_ajax_'.$action, array( $this, $funname ));
        }
    }

    public function register(){

        $labels = array( 
            'name' => __( 'Plan', 'easybook-add-ons' ),
            'singular_name' => __( 'Plan', 'easybook-add-ons' ), 
            'add_new' => __( 'Add New Plan', 'easybook-add-ons' ),
            'add_new_item' => __( 'Add New Plan', 'easybook-add-ons' ),
            'edit_item' => __( 'Edit Plan', 'easybook-add-ons' ),
            'new_item' => __( 'New Plan', 'easybook-add-ons' ),
            'view_item' => __( 'View Plan', 'easybook-add-ons' ),
            'search_items' => __( 'Search Plans', 'easybook-add-ons' ),
            'not_found' => __( 'No Plans found', 'easybook-add-ons' ),
            'not_found_in_trash' => __( 'No Plans found in Trash', 'easybook-add-ons' ),
            'parent_item_colon' => __( 'Parent Plan:', 'easybook-add-ons' ), 
            'menu_name' => __( 'Author Plans', 'easybook-add-ons' ),
        );

        $args = array( 
            'labels' => $labels,
            'hierarchical' => false,
            'description' => __( 'Author plans', 'easybook-add-ons' ),
            'supports' => array( 'title', 'editor', 'thumbnail'/*, 'post-formats'*/),
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
            'rewrite' => array( 'slug' => __('plan','easybook-add-ons') ),
            'capability_type' => 'post'
        );
        register_post_type( $this->name, $args );
    }
    protected function set_meta_columns(){
        $this->has_columns = true;
    }
    public function meta_columns_head($columns){
        unset($columns['date']);
        $columns['_id']             = __('ID','easybook-add-ons');
        $columns['_price']          = __('Price','easybook-add-ons');
        $columns['_pm_count']       = __('Subscribes Count','easybook-add-ons');
        return $columns;
    }
    public function meta_columns_content($column_name, $post_ID){
        if ($column_name == '_price') {
            echo '<strong>'.easybook_addons_get_price_formated( get_post_meta( $post_ID, '_price', true ) ).'</strong>';
        }
        if ($column_name == '_id') {
            echo '<strong>'.$post_ID.'</strong>';
        }
        if ($column_name == '_pm_count') {
            echo '<strong>'.get_post_meta( $post_ID, ESB_META_PREFIX.'pm_count', true ).'</strong>';
        }
    }

    protected function set_meta_boxes(){
        $this->meta_boxes = array(
            'stripe_plan'       => array(
                'title'         => __( 'Stripe Recurring Plan', 'easybook-add-ons' ),
                'context'       => 'normal', // normal - side - advanced
                'priority'       => 'core', // default - high - core - low
                'callback_args'       => array(),
            )
        );
    }

    public function lplan_stripe_plan_callback($post, $args){
        wp_nonce_field( 'cth-cpt-fields', '_cth_cpt_nonce' );

        ?>
        <table class="form-table stripe_plan">
            <tbody>

                <tr class="hoz">
                    <th class="w20 align-left"><?php _e( 'Stripe Plan', 'easybook-add-ons' ); ?></th>
                    <td>
                        <input type="text" class="input-text" name="<?php echo ESB_META_PREFIX.'stripe_plan_id' ?>" id="<?php echo ESB_META_PREFIX.'stripe_plan_id' ?>" value="<?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'stripe_plan_id', true );?>">
                        <p><?php _e( 'Enter your Stripe Plan ID or create <a href="#" class="ctb-modal-open">New Plan</a> using this plan details.', 'easybook-add-ons' ); ?></p>
                        
                    </td>
                </tr>
                
            </tbody>
        </table>
        <?php 

        add_action( 'admin_footer', function()use($post){
            ?>
            <div class="ctb-modal-wrap ctb-modal">
                <div class="ctb-modal-holder">
                    <div class="ctb-modal-inner">
                        <div class="ctb-modal-close"><span class="dashicons dashicons-no-alt"></span></div>
                        <h3><?php _e( 'Create a ', 'easybook-add-ons' );?><span><?php esc_html_e( 'Stripe Plan', 'easybook-add-ons' ); ?></span></h3>
                        <div class="ctb-modal-content">

                            <form id="create-stripe-plan-form" class="create-stripe-plan-form custom-form" action="#" method="POST">
                                

                                <label for="stripe_plan"><?php _e( 'Plan Title *', 'easybook-add-ons' ); ?></label>
                                <input type="text" id="stripe_plan" name="stripe_plan" value="<?php echo $post->post_title; ?>" required="required">
                                
                                <label for="stripe_product"><?php _e( 'Product Title *', 'easybook-add-ons' ); ?></label>
                                <input type="text" id="stripe_product" name="stripe_product" value="<?php echo sprintf(__( '%s Stripe product', 'easybook-add-ons' ), $post->post_title ); ?>" required="required">
                                
                                <input type="hidden" name="lplan_id" value="<?php echo $post->ID; ?>" required="required">
                         

                                <?php wp_nonce_field( 'create_stripe_plan', 'stripe_nonce' ); ?>

                                <input class="stripe-plan-submit" type="submit" id="stripe_submit" value="<?php esc_attr_e( 'Submit', 'easybook-add-ons' ); ?>">

                            </form>
                            
                        </div>
                        <!-- end modal-content -->
                    </div>
                </div>
            </div>
            <!-- end modal --> 
            <?php
        } );  
    }

    public function save_post($post_id, $post, $update){
        if(!$this->can_save($post_id)) return;

        if(isset($_POST[ESB_META_PREFIX.'stripe_plan_id'])){
            $new_val = sanitize_text_field( $_POST[ESB_META_PREFIX.'stripe_plan_id'] ) ;
            $origin_val = get_post_meta( $post_id, ESB_META_PREFIX.'stripe_plan_id', true );
            if($new_val !== $origin_val){
                update_post_meta( $post_id, ESB_META_PREFIX.'stripe_plan_id', $new_val );
            }
            
        }
    }

    public function create_stripe_plan(){
        $json = array(
            'success' => false,
            'data' => array(
                // 'POST'=>$_POST,
            )
        );

        if( !isset($_POST['stripe_nonce']) || !isset($_POST['lplan_id']) || !isset($_POST['stripe_plan']) || !isset($_POST['stripe_product']) ){
            $json['data']['error'] = esc_html__( 'Invalid create stripe form', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }
        

        $nonce = $_POST['stripe_nonce'];
        
        if ( ! wp_verify_nonce( $nonce, 'create_stripe_plan' ) ){
            $json['data']['error'] = esc_html__( 'Security checked!, Cheatn huh?', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }


        $plan_post          = get_post($_POST['lplan_id']);

        if(empty($plan_post)){
            $json['data']['error'] = esc_html__( 'Invalid listing plan ID', 'easybook-add-ons' ) ;
            wp_send_json($json );
        }

        $prices = easybook_addons_get_plan_prices($plan_post->ID);

        $stripe_args = array(
            'nickname'      => $_POST['stripe_plan'],
            'product'       => array(
                'name'  => $_POST['stripe_product']
            ),
            'amount'        => easybook_addons_get_stripe_amount( $prices['total'] ),
            'interval'      => get_post_meta( $plan_post->ID , ESB_META_PREFIX.'period', true ),
            'interval_count'=> get_post_meta( $plan_post->ID , ESB_META_PREFIX.'interval', true )
        );

        require_once ESB_ABSPATH.'posttypes/payment-stripe.php';
        $payment_class = new CTH_Payment_Stripe();

        $plan = $payment_class->createPlan($stripe_args);

        if($plan){
            $json['success'] = true;
            $json['plan_id'] = $plan->id;

            $update_lplan_field = true;

            if($update_lplan_field){
                update_post_meta( $plan_post->ID, ESB_META_PREFIX.'stripe_plan_id', $plan->id );
            }
        }else{
            $json['data']['error'] = esc_html__( 'There is something wrong. Please try again.', 'easybook-add-ons' ) ;
        }

        wp_send_json($json );

    }
}

new Esb_Class_Plan_CPT();

        







