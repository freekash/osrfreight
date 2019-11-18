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



class Esb_Class_Product_CPT extends Esb_Class_CPT {  
    protected $name = 'product';

    protected function init(){
        add_action( 'before_delete_post', array( __CLASS__, 'before_delete_post' ), 10, 1 ); 
        if(!empty($this->meta_boxes)){
            add_action( 'add_meta_boxes_'.$this->name, array($this, 'add_meta_boxes') );
            add_action( 'save_post_'.$this->name, array($this, 'save_post'), 20, 3 );
        }
        add_filter( 'product_type_selector', array($this, 'new_product_type') );
        // add_filter( 'woocommerce_product_data_tabs', array($this, 'demo_product_tab') );
        // add_action( 'woocommerce_product_data_panels', array($this,'demo_product_tab_product_tab_content' ));
        // if($this->has_columns){
        //     add_action( 'manage_'.$this->name.'_posts_columns', array($this, 'meta_columns_head') );
        //     add_action( 'manage_'.$this->name.'_posts_custom_column', array($this, 'meta_columns_content'), 10, 2 );
        // }
    }

    public function new_product_type($types){
        $types[ 'listing_cpt' ] = __( 'Single Listing', 'easybook-add-ons' ); 
        return $types;
    }
    
    protected function set_meta_boxes(){
        $this->meta_boxes = array(
            'data'       => array(
                'title'         => __( 'Listing Product Datas', 'easybook-add-ons' ),
                'context'       => 'normal', // normal - side - advanced
                'priority'       => 'high', // default - high - low
                'callback_args'       => array(),
            )
        );
    }

    public function product_data_callback($post, $args){
        wp_nonce_field( 'cth-cpt-fields', '_cth_cpt_nonce' );
        $listing_fields = get_post_meta( $post->ID, ESB_META_PREFIX.'listing_fields', true );
        $room_fields = get_post_meta( $post->ID, ESB_META_PREFIX.'room_fields', true );
        $rating_fields = get_post_meta( $post->ID, ESB_META_PREFIX.'rating_fields', true );
        wp_localize_script( 'easybook-react-adminapp', '_easybook_addons_lfields', json_decode($listing_fields) );
        wp_localize_script( 'easybook-react-adminapp', '_easybook_addons_rfields', json_decode($room_fields) );
        wp_localize_script( 'easybook-react-adminapp', '_easybook_addons_frating', json_decode($rating_fields) );
        ?>
        <div id="react-woo-app"></div>
        <?php
    }

    public function save_post($post_id, $post, $update){
        if(!$this->can_save($post_id)) return;

        if ( ! current_user_can( 'edit_product', $post_id ) ) {
            return;
        }

        // - Update the post's metadata.
        $listing_id = 0;
        if(isset($_POST['for_listing_id'])){
           
            $listing_id = $_POST['for_listing_id'];
        }
        // unhook this function so it doesn't loop infinitely
        remove_action( 'save_post_'.$this->name, array($this, 'save_post'), 20, 3  );
        
            $this->save_post_meta($post_id, true, true , $listing_id);

        // re-hook this function
        add_action( 'save_post_'.$this->name, array($this, 'save_post'), 20, 3 );
    }

    public static function do_save_metas($post_id = 0, $room_post = array(), $listing_id = 0){
        $meta_fields = easybook_addons_get_listing_type_fields_meta( get_post_meta( $listing_id, ESB_META_PREFIX.'listing_type_id', true ) , true);
        $room_metas = array();
        foreach($meta_fields as $fname => $ftype){
            if(isset($room_post[$fname])) 
                $room_metas[$fname] = $room_post[$fname] ;
            else{
                if($ftype == 'array'){
                    $room_metas[$fname] = array();
                }else{
                    $room_metas[$fname] = '';
                }
            } 
        }
        foreach ($room_metas as $key => $value) {
            $old_val = get_post_meta( $post_id, ESB_META_PREFIX.$key, true );
            if($old_val != $value) update_post_meta( $post_id, ESB_META_PREFIX.$key, $value );
        }

        // room price
        if( isset($room_post['_price']) && $room_post['_price'] ) update_post_meta( $post_id, '_price', $room_post['_price'] );
        // for changing listing
        $for_listing_id = get_post_meta( $post_id, ESB_META_PREFIX.'for_listing_id', true );
        if($for_listing_id != $listing_id) 
            update_post_meta( $post_id, ESB_META_PREFIX.'for_listing_id', $listing_id );

    }

    protected function save_post_meta($post_id = 0, $edit = false, $backend = false,$listing_id =0){
        
        $old_listing_id = get_post_meta( $post_id, ESB_META_PREFIX.'for_listing_id', true );

        // old listing id must be get first
        self::do_save_metas($post_id, $_POST, $listing_id);

        if($old_listing_id == ''){
            update_post_meta( $listing_id, ESB_META_PREFIX.'rooms_ids', array($post_id) );
            update_post_meta( $listing_id, '_price', get_post_meta( $post_id, '_price', true ) ); 
        }elseif( $old_listing_id != $listing_id){
            // remove room from old listing
            $old_listing_rooms = array_unique((array)get_post_meta( $old_listing_id, ESB_META_PREFIX.'rooms_ids', true ));
            update_post_meta( $old_listing_id, ESB_META_PREFIX.'rooms_ids', array_diff( $old_listing_rooms, array($post_id) ) );
            // update old listing price
            Esb_Class_Listing_CPT::update_listing_price($old_listing_id);

            // add room to new listing
            $new_listing_rooms = (array)get_post_meta( $listing_id, ESB_META_PREFIX.'rooms_ids', true );
            $new_listing_rooms[] = $post_id;

            update_post_meta( $listing_id, ESB_META_PREFIX.'rooms_ids', array_unique( $new_listing_rooms ) );
            // update new listing price
            Esb_Class_Listing_CPT::update_listing_price($listing_id);
        }
        // $demo_product_info = $_POST['demo_product_info'];
         
        //     if( !empty( $demo_product_info ) ) {
         
        //     update_post_meta( $post_id, 'demo_product_info', esc_attr( $demo_product_info ) );
        // }
    }
    public static function before_delete_post($postid = 0){
        global $wpdb;
        $post_type = get_post_type($postid);
        if($post_type === 'product'){
            $booking_table = $wpdb->prefix . 'cth_booking';
            $wpdb->query( 
                $wpdb->prepare( 
                    "
                    DELETE FROM $booking_table
                    WHERE  room_id = %d 
                    ",
                    $postid
                )
            );
        }
    }

}

new Esb_Class_Product_CPT();


