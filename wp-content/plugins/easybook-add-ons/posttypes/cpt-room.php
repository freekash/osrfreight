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



class Esb_Class_LRooms_CPT extends Esb_Class_CPT {
    protected $name = 'lrooms';

    protected function init(){
        parent::init();

        add_filter('use_block_editor_for_post_type', array($this, 'disable_gutenberg'), 10, 2 );
    }
    public function disable_gutenberg( $current_status, $post_type ){
        if ($post_type === 'lrooms') 
            return false;

        return $current_status;
    }

    protected function set_meta_boxes(){
        $this->meta_boxes = array(
            'data'       => array(
                'title'         => __( 'Room Datas', 'easybook-add-ons' ),
                'context'       => 'normal', // normal - side - advanced
                'priority'       => 'high', // default - high - low
                'callback_args'       => array(),
            )
        );
    }
    public function register(){

        $labels = array( 
            'name' => __( 'Rooms', 'easybook-add-ons' ), 
            'singular_name' => __( 'Rooms', 'easybook-add-ons' ),
            'add_new' => __( 'Add New Rooms', 'easybook-add-ons' ),
            'add_new_item' => __( 'Add New Rooms', 'easybook-add-ons' ),   
            'edit_item' => __( 'Edit Rooms', 'easybook-add-ons' ),
            'new_item' => __( 'New Rooms', 'easybook-add-ons' ),
            'view_item' => __( 'View Rooms', 'easybook-add-ons' ),
            'search_items' => __( 'Search Rooms', 'easybook-add-ons' ), 
            'not_found' => __( 'No Rooms found', 'easybook-add-ons' ),
            'not_found_in_trash' => __( 'No Rooms found in Trash', 'easybook-add-ons' ),   
            'parent_item_colon' => __( 'Parent Rooms:', 'easybook-add-ons' ), 
            'menu_name' => __( 'Listing Rooms', 'easybook-add-ons' ), 
        );

        $args = array( 
            'labels' => $labels,
            'hierarchical' => true,
            'description' => __( 'List Rooms', 'easybook-add-ons' ),
            'supports'=> array( 'title', 'editor','author', 'thumbnail','comments','excerpt'/*, 'post-formats'*/),
            'show_in_rest'  => true,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 25,
            'menu_icon' =>  'dashicons-store',
            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => array( 'slug' => __('lrooms','easybook-add-ons') ),
            // 'capability_type' => 'post'
        );
        register_post_type( $this->name, $args );
    }

    protected function filter_meta_args($args, $post){
        $new_post = false;
        $args['new_post'] = $new_post;

        return $args;
    }

    public function lrooms_data_callback($post, $args){
        wp_nonce_field( 'cth-cpt-fields', '_cth_cpt_nonce' );
        $listing_fields = get_post_meta( $post->ID, ESB_META_PREFIX.'listing_fields', true );
        $room_fields = get_post_meta( $post->ID, ESB_META_PREFIX.'room_fields', true );
        $rating_fields = get_post_meta( $post->ID, ESB_META_PREFIX.'rating_fields', true );
        wp_localize_script( 'easybook-react-adminapp', '_easybook_addons_lfields', json_decode($listing_fields) );
        wp_localize_script( 'easybook-react-adminapp', '_easybook_addons_rfields', json_decode($room_fields) );
        wp_localize_script( 'easybook-react-adminapp', '_easybook_addons_frating', json_decode($rating_fields) );
        ?>
        <div id="admin-room-app"></div>
        <?php
    }

    public function save_post($post_id, $post, $update){
        if(!$this->can_save($post_id)) return;

        // - Update the post's metadata.
        if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Begin: easybook_addons_save_lrooms_meta" . PHP_EOL, 3, ESB_LOG_FILE);
        $listing_id = 0;
        if(isset($_POST['for_listing_id'])){
           
            $listing_id = $_POST['for_listing_id'];
        }
        // unhook this function so it doesn't loop infinitely
        remove_action( 'save_post_'.$this->name, array($this, 'save_post'), 10, 3  );
        
            $this->save_post_meta($post_id, true, true , $listing_id);

        // re-hook this function
        add_action( 'save_post_'.$this->name, array($this, 'save_post'), 10, 3  );
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
        if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Begin easybook_addons_do_save_lrooms_meta ". PHP_EOL, 3, ESB_LOG_FILE);
        
        $old_listing_id = get_post_meta( $post_id, ESB_META_PREFIX.'for_listing_id', true );

        // old listing id must be get first
        self::do_save_metas($post_id, $_POST, $listing_id);

        // if($old_listing_id == ''){
        //     $new_listing_rooms = (array)get_post_meta( $listing_id, ESB_META_PREFIX.'rooms_ids', true );
        //     $new_listing_rooms[] = $post_id;
        //     update_post_meta( $listing_id, ESB_META_PREFIX.'rooms_ids', array_unique( $new_listing_rooms ) );
        //     // update new listing price
        //     Esb_Class_Listing_CPT::update_listing_price($listing_id);
        // }else
        if( $old_listing_id != $listing_id){
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
        }else{
            $new_listing_rooms = (array)get_post_meta( $listing_id, ESB_META_PREFIX.'rooms_ids', true );
            $new_listing_rooms[] = $post_id;
            update_post_meta( $listing_id, ESB_META_PREFIX.'rooms_ids', array_unique( $new_listing_rooms ) );
            // update new listing price
            Esb_Class_Listing_CPT::update_listing_price($listing_id);
        }
    }


    protected function set_meta_columns(){
        $this->has_columns = true;
    }
    public function meta_columns_head($columns){
        $columns['_id'] = __( 'ID', 'easybook-add-ons' ); 
        $columns['_listing'] = __( 'Listing', 'easybook-add-ons' );  
        $columns['_thumbnail'] = __( 'Thumbnail', 'easybook-add-ons' );
        $columns['_price'] = __( 'Price', 'easybook-add-ons' );   
        $columns['_quantity'] = __( 'Quantity', 'easybook-add-ons' );    
        return $columns;
    }
    public function meta_columns_content($column_name, $post_ID){
        if ($column_name == '_id') {
            echo $post_ID;
        }
        if ($column_name == '_listing') {
            $listing = get_post( get_post_meta( $post_ID, ESB_META_PREFIX.'for_listing_id', true ) );
            if (null != $listing) echo '<strong><a  href="'. esc_url( get_permalink($listing->ID) ).'">'.$listing->post_title.'<a/></strong>';
        }
        if ($column_name == '_thumbnail') {
            echo get_the_post_thumbnail( $post_ID, 'thumbnail', array('style'=>'width:100px;height:auto;') );
        }
        if ($column_name == '_price') {
            echo get_post_meta( $post_ID, ESB_META_PREFIX.'_price', true );
        }
        if ($column_name == '_quantity') {
            echo get_post_meta( $post_ID, ESB_META_PREFIX.'quantity', true );
        }
    }

}

new Esb_Class_LRooms_CPT();


