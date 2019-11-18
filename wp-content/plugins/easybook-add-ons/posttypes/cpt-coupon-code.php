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



class Esb_Class_Coupon_Code_CPT extends Esb_Class_CPT { 
    protected $name = 'cthcoupons';

    protected function init(){
        parent::init();
        // add_action( 'before_delete_post', array( __CLASS__, 'before_delete_post' ), 10, 1 );  
        // add_action( 'init', array($this, 'taxonomies'), 0 );
    }

    public function register(){

        $labels = array( 
            'name' => __( 'Coupons', 'easybook-add-ons' ),
            'singular_name' => __( 'Coupon', 'easybook-add-ons' ),
            'add_new' => __( 'Add New Coupon', 'easybook-add-ons' ),
            'add_new_item' => __( 'Add New Coupon', 'easybook-add-ons' ),
            'edit_item' => __( 'Edit Coupon', 'easybook-add-ons' ),
            'new_item' => __( 'New Coupon', 'easybook-add-ons' ),
            'view_item' => __( 'View Coupon', 'easybook-add-ons' ),
            'search_items' => __( 'Search Coupons', 'easybook-add-ons' ),
            'not_found' => __( 'No Coupons found', 'easybook-add-ons' ),
            'not_found_in_trash' => __( 'No Coupons found in Trash', 'easybook-add-ons' ),
            'parent_item_colon' => __( 'Parent Coupon:', 'easybook-add-ons' ),
            'menu_name' => __( 'Listing Coupons', 'easybook-add-ons' ),
        );
        $args = array( 
            'labels' => $labels,
            'hierarchical' => false,
            'description' => __( 'Coupons Code', 'easybook-add-ons' ),
            'supports' => array(''),
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
            'rewrite' => array( 'slug' => __('cthcoupons','easybook-add-ons') ),
            'capability_type' => 'post',
            // 'capabilities' => array(
            //     'create_posts' => 'do_not_allow', // false < WP 4.5, credit @Ewout
            // ),
            'map_meta_cap' => true, // Set to `false`, if users are not allowed to edit/delete existing posts
        );

        register_post_type( $this->name, $args );
    }
    public function taxonomies(){
        $labels = array(
            'name' => __( 'Coupons Package', 'easybook-add-ons' ),
            'singular_name' => __( 'Coupons Package', 'easybook-add-ons' ),
            'search_items' =>  __( 'Search Coupons Packages','easybook-add-ons' ),
            'all_items' => __( 'All Coupons Packages','easybook-add-ons' ),
            'parent_item' => __( 'Parent Coupons Package','easybook-add-ons' ),
            'parent_item_colon' => __( 'Parent Coupons Package:','easybook-add-ons' ),
            'edit_item' => __( 'Edit Coupons Package','easybook-add-ons' ), 
            'update_item' => __( 'Update Coupons Package','easybook-add-ons' ),
            'add_new_item' => __( 'Add New Coupons Package','easybook-add-ons' ),
            'new_item_name' => __( 'New Coupons Package Name','easybook-add-ons' ),
            'menu_name' => __( 'Coupons Packages','easybook-add-ons' ),
        );     

        // Now register the taxonomy

        register_taxonomy('cthcoupons_package',array('cthcoupons'), array(
            'hierarchical' => false,
            'labels' => $labels,
            'public' => false,
            'show_ui' => true,
            'show_in_nav_menus'=> false,
            'show_admin_column' => true,
            'query_var' => false,
            'rewrite' => array( 'slug' => __('cthcoupons_package','easybook-add-ons') ),
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
        unset($columns['title']);
        unset($columns['date']);
        unset($columns['author']);
        unset($columns['comments']);
         $columns['_id']             = __('Coupon Code','easybook-add-ons');
        $columns['_quantity']             = __('Quantity','easybook-add-ons');
        // $columns['_ad_pos']   = __('AD Positions','easybook-add-ons');
        $columns['_amount']   = __('Discount amount','easybook-add-ons');
        $columns['_expiry_date']   = __('Expire Date','easybook-add-ons');

        return $columns;
    }
    public function meta_columns_content($column_name, $post_ID){
        if ($column_name == '_id') {
            echo '<strong>'.get_post_meta( $post_ID, ESB_META_PREFIX.'coupon_code', true ).'</strong>';
        }
        if ($column_name == '_quantity') {
            echo '<strong>'.get_post_meta( $post_ID, ESB_META_PREFIX.'coupon_qty', true ).'</strong>';
        }
        if ($column_name == '_amount') {
            echo '<strong>'.get_post_meta( $post_ID, ESB_META_PREFIX.'dis_amount', true ).'</strong>';
        }
        if ($column_name == '_expiry_date') {
            echo '<strong>'.get_post_meta( $post_ID, ESB_META_PREFIX.'coupon_expiry_date', true ).'</strong>';
        }
    }

    protected function set_meta_boxes(){
        $this->meta_boxes = array(
            'details'       => array(
                'title'         => __( 'Coupon data', 'easybook-add-ons' ),
                'context'       => 'normal', // normal - side - advanced
                'priority'       => 'core', // default - high - core - low
                'callback_args'       => array(),
            ),
        );
    }

    public function cthcoupons_details_callback($post, $args){
        wp_nonce_field( 'cth-cpt-fields', '_cth_cpt_nonce' ); 
        ?>
        <table class="form-table cth-table table-coupon_data">
            <tbody>
                <tr class="hoz">
                    <th><label for="coupon_code"><?php  esc_html_e( 'Coupon code', 'easybook-add-ons' );?></label></th>
                    <td> <input type="text" class="short wc_input_price" style="" name="coupon_code" id="coupon_code" value="<?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'coupon_code', true ); ?>" placeholder="code"> </td>
                </tr>
                <tr class="hoz">
                    <th><label for="coupon_decs"><?php  esc_html_e( 'Description', 'easybook-add-ons' );?></label></th>
                    <td><textarea id="coupon_decs" name="coupon_decs" cols="5" rows="2" class="w100" placeholder="Description" ><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'coupon_decs', true ); ?></textarea></td>
                </tr>
                <tr class="hoz">
                    <th><label for="discount_type"><?php  esc_html_e( 'Discount type', 'easybook-add-ons' );?></label></th>
                    <td>
                        <?php 
                            $type_coupon = array(
                                'percent'       => 'Percentage discount',
                                'fixed_cart'    => 'Fixed cart discount',
                            );
                            $selected = get_post_meta( $post->ID, ESB_META_PREFIX.'discount_type', true );
                            echo '<select id="discount_type" name="discount_type">';
                            foreach ($type_coupon as $val => $label) {
                                echo '<option value="'.$val.'" '.selected( $selected, $val, false ).'>'.$label.'</option>';
                            }
                            echo '</select>';

                        ?>
                    </td>
                </tr>
                <tr class="hoz">
                    <th><label for="dis_amount"><?php  esc_html_e( 'Discount amount', 'easybook-add-ons' );?></label></th>
                    <td> <input type="text" class="short wc_input_price" style="" name="dis_amount" id="dis_amount" value="<?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'dis_amount', true ); ?>" placeholder="0"> </td>
                </tr>
                <tr class="hoz">
                    <th><label for="coupon_qty"><?php  esc_html_e( 'Coupon quantity', 'easybook-add-ons' );?></label></th>
                    <td><input type="mumber" class="short wc_input_price" style="" name="coupon_qty" id="coupon_qty" value="<?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'coupon_qty', true ); ?>" placeholder="0"> </td>
                </tr>
                <tr class="hoz">
                    <th><label for="expiry_date"><?php  esc_html_e( 'Coupon expiry date', 'easybook-add-ons' );?></label></th>
                    <td> <input type="text" class="date-picker hasDatepicker"name="coupon_expiry_date" id="expiry_date" value="<?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'coupon_expiry_date', true ); ?>"></td>     
                </tr>
                <tr class="hoz">
                    <th><label for="for_coupon_listing_id"><?php  esc_html_e( 'For post', 'easybook-add-ons' );?></label></th>
                    <td>
                        <?php 
                            $listing_post = get_posts( array(
                                'post_type'         => 'listing',
                                'posts_per_page'    => -1,
                                'post_status'       => 'publish',
                                'fields'            => 'ids',
                            ));
                            $selected = get_post_meta( $post->ID, ESB_META_PREFIX.'for_coupon_listing_id', true );
                            echo '<select id="for_coupon_listing_id" name="for_coupon_listing_id">';
                            foreach ($listing_post as $key => $lid) {
                                echo '<option value="'.$lid.'" '.selected( $selected, $lid, false ).'>'.get_the_title($lid).'</option>';
                                
                            }
                            echo '</select>';

                        ?>
                    </td>
                </tr>
             </tbody>
        </table>
       
        <?php   
    }
    public function save_post($post_id, $post, $update){
        if(!$this->can_save($post_id)) return;
        $listing_id = 0;
        if(isset($_POST['for_coupon_listing_id'])){
           
            $listing_id = $_POST['for_coupon_listing_id'];
        }
        $old_coupon_listing_id = get_post_meta( $post_id, ESB_META_PREFIX.'for_coupon_listing_id', true );
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
            if(isset($_POST[$field])) 
                $coupon_metas[$field] = $_POST[$field] ;
            else{
                if($ftype == 'array'){
                    $coupon_metas[$field] = array();
                }else{
                    $coupon_metas[$field] = '';
                }
            } 
        }
        foreach ($coupon_metas as $key => $value) {
            $old_val = get_post_meta( $post_id, ESB_META_PREFIX.$key, true );
            if($old_val != $value) update_post_meta( $post_id, ESB_META_PREFIX.$key, $value );
        }

        // for changing listing
        $for_coupon_listing_id = get_post_meta( $post_id, ESB_META_PREFIX.'for_coupon_listing_id', true );
        if($for_coupon_listing_id != $listing_id) 
            update_post_meta( $post_id, ESB_META_PREFIX.'for_coupon_listing_id', $listing_id);
  
        if($old_coupon_listing_id == ''){
            update_post_meta( $listing_id, ESB_META_PREFIX.'coupon_ids', array($post_id) );
        }elseif( $old_coupon_listing_id != $listing_id){
            // remove room from old listing
            $old_listing_coupons = array_unique((array)get_post_meta( $old_coupon_listing_id, ESB_META_PREFIX.'coupon_ids', true ));
            update_post_meta( $old_coupon_listing_id, ESB_META_PREFIX.'coupon_ids', array_diff( $old_listing_coupons, array($post_id) ) );

            $new_listing_coupons = (array)get_post_meta( $listing_id, ESB_META_PREFIX.'coupon_ids', true );
            $new_listing_coupons[] = $post_id;

            update_post_meta( $listing_id, ESB_META_PREFIX.'coupon_ids', array_unique( $new_listing_coupons ) );
        }

    }
    //  public static function before_delete_post($postid = 0){
    //     global $wpdb;
    //     $post_type = get_post_type($postid);
    //     if($post_type === 'cthcoupons'){
    //         $booking_table = $wpdb->prefix . 'cth_for_coupon_listing_id';
    //         $wpdb->query( 
    //             $wpdb->prepare( 
    //                 "
    //                 DELETE FROM $booking_table
    //                 WHERE  coupon_id = %d 
    //                 ",
    //                 $postid
    //             )
    //         );
    //     }
    // }

}

new Esb_Class_Coupon_Code_CPT();