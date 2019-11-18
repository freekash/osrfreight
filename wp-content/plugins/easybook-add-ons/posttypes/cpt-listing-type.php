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




class Esb_Class_Listing_Type_CPT extends Esb_Class_CPT {
    protected $name = 'listing_type';

    protected function init(){
        parent::init();

        // remove publish box
        add_action( 'admin_menu', function(){
            remove_meta_box( 'submitdiv', 'listing_type', 'side' );   
        } );


        // $logged_in_ajax_actions = array(
        //     'submit_listing',
        //     'admin_lverified',
        //     'admin_lfeatured',
        // );
        // foreach ($logged_in_ajax_actions as $action) {
        //     $funname = str_replace('easybook_addons_', '', $action);
        //     add_action('wp_ajax_'.$action, array( $this, $funname )); 
        // }
    }

    protected function set_meta_boxes(){
        $this->meta_boxes = array(
            'builder'       => array(
                'title'         => __( 'Listing Type Builder', 'easybook-add-ons' ),
                'context'       => 'normal', // normal - side - advanced
                'priority'       => 'high', // default - high - low
                'callback_args'       => array(),
            ),
            'settings' => array(
                'title'         => __('Advanced Settings', 'easybook-add-ons'),
                'context'       => 'normal', // normal - side - advanced
                'priority'      => 'high', // default - high - low
                'callback_args' => array(),
            ),
        );
    }
    public function register(){

        $labels = array( 
            'name' => __( 'Listing Types', 'easybook-add-ons' ),
            'singular_name' => __( 'Listing Type', 'easybook-add-ons' ),
            'add_new' => __( 'Add New Listing Type', 'easybook-add-ons' ),
            'add_new_item' => __( 'Add New Listing Type', 'easybook-add-ons' ),    
            'edit_item' => __( 'Edit Listing Type', 'easybook-add-ons' ),
            'new_item' => __( 'New Listing Type', 'easybook-add-ons' ),
            'view_item' => __( 'View Listing Type', 'easybook-add-ons' ),
            'search_items' => __( 'Search Listings Type', 'easybook-add-ons' ),
            'not_found' => __( 'No Listings Type found', 'easybook-add-ons' ),
            'not_found_in_trash' => __( 'No Listings Type found in Trash', 'easybook-add-ons' ), 
            'parent_item_colon' => __( 'Parent Listing Type:', 'easybook-add-ons' ),  
            'menu_name' => __( 'Listing Types', 'easybook-add-ons' ),
        );

        $args = array( 
            'labels' => $labels,
            'hierarchical' => true,
            'description' => __( 'Listing Types', 'easybook-add-ons' ),  
            'supports' => array( 'title'),
            'taxonomies' =>  array(),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 25,
            'menu_icon' => 'dashicons-location-alt', // plugin_dir_url( __FILE__ ) .'assets/admin_ico_listing.png', 
            'show_in_nav_menus' => false,
            'publicly_queryable' => false,
            'exclude_from_search' => true,
            'has_archive' => false,
            'query_var' => false,
            'can_export' => true,
            'rewrite' => array( 'slug' => __('listing_type','easybook-add-ons') ),
            // 'rewrite' => array( 'slug' => 'listing_type', 'with_front' => true ),
            'capability_type' => 'post'
        );
        register_post_type( $this->name, $args );
    }

    protected function filter_meta_args($args, $post){
        $new_post = false;
        $args['new_post'] = $new_post;

        return $args;
    }

    public function listing_type_settings_callback($post, $args){
        $filter_by_type = get_post_meta( $post->ID, ESB_META_PREFIX.'filter_by_type', true );
        
        if($filter_by_type === '') $filter_by_type = true; // default true
        $price_based = get_post_meta( $post->ID, ESB_META_PREFIX.'price_based', true );
        ?>
        <table class="form-table filter_by_type">
            <tbody>

                <tr class="hoz">
                    <th class="w20 align-left"><?php _e( 'Hero/Header filter by type', 'easybook-add-ons' ); ?></th>
                    <td>
                        <input type="checkbox" class="input-text" name="filter_by_type" value="1" <?php checked( $filter_by_type, true, true ); ?>>
                        <p><?php _e( 'Check this if you want hero and header search forms showing listings from this type only.', 'easybook-add-ons' ); ?></p>
                    </td>
                </tr>
                
            </tbody>
        </table>
        <table class="form-table price_based">
            <tbody>

                <tr class="hoz">
                    <th class="w20 align-left"><?php _e( 'Listing price based', 'easybook-add-ons' ); ?></th>
                    <td>
                        <select name="price_based">
                            <option value="listing" <?php selected( $price_based, 'listing', true ); ?>><?php _e('Per listing', 'easybook-add-ons') ?></option>
                            <option value="per_person" <?php selected( $price_based, 'per_person', true ); ?>><?php _e('Per person', 'easybook-add-ons') ?></option>
                            <option value="per_night" <?php selected( $price_based, 'per_night', true ); ?>><?php _e('Per night', 'easybook-add-ons') ?></option>
                            <option value="night_person" <?php selected( $price_based, 'night_person', true ); ?>><?php _e('Per person/night', 'easybook-add-ons') ?></option>
                            <option value="per_day" <?php selected( $price_based, 'per_day', true ); ?>><?php _e('Per day', 'easybook-add-ons') ?></option>
                            <option value="day_person" <?php selected( $price_based, 'day_person', true ); ?>><?php _e('Per person/day', 'easybook-add-ons') ?></option>
                            <option value="per_hour" <?php selected( $price_based, 'per_hour', true ); ?>><?php _e('Per hour', 'easybook-add-ons') ?></option>
                            <option value="hour_person" <?php selected( $price_based, 'hour_person', true ); ?>><?php _e('Per person/hour', 'easybook-add-ons') ?></option>
                            
                            <option value="none" <?php selected( $price_based, 'none', true ); ?>><?php _e('No listing price', 'easybook-add-ons') ?></option>
                        </select>
                        

                    </td>
                </tr>
                
            </tbody>
        </table>
        
        <?php
        
    }

    public function listing_type_builder_callback($post, $args){
        wp_nonce_field( 'cth-cpt-fields', '_cth_cpt_nonce' );
        $listing_fields = get_post_meta( $post->ID, ESB_META_PREFIX.'listing_fields', true );
        $room_fields = get_post_meta( $post->ID, ESB_META_PREFIX.'room_fields', true );
        $rating_fields = get_post_meta( $post->ID, ESB_META_PREFIX.'rating_fields', true );
        $schema_markup = get_post_meta( $post->ID, ESB_META_PREFIX.'schema_markup', true );

        wp_localize_script( 'easybook-react-adminapp', '_easybook_addons_lfields', json_decode($listing_fields) );
        wp_localize_script( 'easybook-react-adminapp', '_easybook_addons_rfields', json_decode($room_fields) );
        wp_localize_script( 'easybook-react-adminapp', '_easybook_addons_frating', json_decode($rating_fields) );
        wp_localize_script( 'easybook-react-adminapp', '_easybook_addons_schema', json_decode($schema_markup) );
        ?>
        <div id="adminapp"></div>
        <input type="hidden" name="post_status" value="publish">

        <textarea id="listing_type_fields_lfields" name="listing_fields"><?php echo $listing_fields; ?></textarea>
        <textarea id="listing_type_fields_rfields" name="room_fields"><?php echo $room_fields; ?></textarea>

        <textarea id="listing_type_single_layout" name="single_layout"><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'single_layout', true ); ?></textarea>
        <textarea id="listing_type_preview_layout" name="preview_layout"><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'preview_layout', true ); ?></textarea>
        <textarea id="listing_type_filter_layout" name="filter_layout"><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'filter_layout', true ); ?></textarea>

        <textarea id="listing_type_fherosec_layout" name="filter_herosec_layout"><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'filter_herosec_layout', true ); ?></textarea>
        <textarea id="listing_type_fheader_layout" name="filter_header_layout"><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'filter_header_layout', true ); ?></textarea>
        <textarea id="listing_type_sbooking_layout" name="booking_from_layout"><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'booking_from_layout', true ); ?></textarea>
        <textarea id="listing_type_sroom_layout" name="single_room_layout"><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'single_room_layout', true ); ?></textarea>

        <textarea id="listing_type_proom_layout" name="preview_room_layout"><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'preview_room_layout', true ); ?></textarea>
        <textarea id="listing_type_general"><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'general_field_meta', true ); ?></textarea>
        <textarea id="listing_type_schema" name="schema_markup"><?php echo $schema_markup; ?></textarea>
        <?php 
        $single_css = '';
        $preview_css = '';
        $filter_css = '';
        $filter_hero_css = '';
        $filter_header_css = '';
        $single_booking_css = '';
        $single_room_css = '';
        $preview_room_css = '';
        $azp_csses = get_option( 'azp_csses', false ); 
        if($azp_csses !== false && is_array($azp_csses)){
            if( isset($azp_csses[$post->ID]) && is_array($azp_csses[$post->ID]) ){
                if(isset($azp_csses[$post->ID]['single'])) $single_css = $azp_csses[$post->ID]['single'];
                if(isset($azp_csses[$post->ID]['preview'])) $preview_css = $azp_csses[$post->ID]['preview'];
                if(isset($azp_csses[$post->ID]['filter'])) $filter_css = $azp_csses[$post->ID]['filter'];
                if(isset($azp_csses[$post->ID]['fheader'])) $filter_header_css = $azp_csses[$post->ID]['fheader'];
                if(isset($azp_csses[$post->ID]['fherosec'])) $filter_hero_css = $azp_csses[$post->ID]['fherosec'];
                if(isset($azp_csses[$post->ID]['sbooking'])) $single_booking_css = $azp_csses[$post->ID]['sbooking'];
                if(isset($azp_csses[$post->ID]['sroom'])) $single_room_css = $azp_csses[$post->ID]['sroom'];
                 if(isset($azp_csses[$post->ID]['proom'])) $preview_room_css = $azp_csses[$post->ID]['proom'];
            }
        }

        ?>
        <textarea id="listing_type_single_css" name="ltype_single_css"><?php echo $single_css; ?></textarea>
        <textarea id="listing_type_preview_css" name="ltype_preview_css"><?php echo $preview_css; ?></textarea>
        <textarea id="listing_type_filter_css" name="ltype_filter_css"><?php echo $filter_css; ?></textarea>
        <textarea id="listing_type_fheader_css" name="ltype_fheader_css"><?php echo $filter_header_css; ?></textarea>
        <textarea id="listing_type_fherosec_css" name="ltype_fherosec_css"><?php echo $filter_hero_css; ?></textarea>
        <textarea id="listing_type_sbooking_css" name="ltype_sbooking_css"><?php echo $single_booking_css; ?></textarea>
        <textarea id="listing_type_sroom_css" name="ltype_sroom_css"><?php echo $single_room_css; ?></textarea>
        <textarea id="listing_type_proom_css" name="ltype_proom_css"><?php echo $preview_room_css; ?></textarea>
        <?php
    }

    public function save_post($post_id, $post, $update){
        if(!$this->can_save($post_id)) return;

        
        if(isset($_POST['listing_fields'])){
            update_post_meta( $post_id, ESB_META_PREFIX.'listing_fields', $_POST['listing_fields'] );
        }
        if(isset($_POST['room_fields'])){
            update_post_meta( $post_id, ESB_META_PREFIX.'room_fields', $_POST['room_fields'] );
        }
         if(isset($_POST['listing-frating-value'])){
            update_post_meta( $post_id, ESB_META_PREFIX.'rating_fields', $_POST['listing-frating-value'] );
        }

        if(isset($_POST['single_layout'])){
            update_post_meta( $post_id, ESB_META_PREFIX.'single_layout', $_POST['single_layout'] );
        }
        if(isset($_POST['listing-type-value'])){
            update_post_meta( $post_id, ESB_META_PREFIX.'listing_type', $_POST['listing-type-value'] );
        }
        if(isset($_POST['preview_layout'])){
            update_post_meta( $post_id, ESB_META_PREFIX.'preview_layout', $_POST['preview_layout'] );
        }
        if(isset($_POST['filter_layout'])){
            update_post_meta( $post_id, ESB_META_PREFIX.'filter_layout', $_POST['filter_layout'] );
        }
        if(isset($_POST['filter_herosec_layout'])){
            update_post_meta( $post_id, ESB_META_PREFIX.'filter_herosec_layout', $_POST['filter_herosec_layout'] );
        }
        if(isset($_POST['filter_header_layout'])){
            update_post_meta( $post_id, ESB_META_PREFIX.'filter_header_layout', $_POST['filter_header_layout'] );
        }
        if(isset($_POST['booking_from_layout'])){
            update_post_meta( $post_id, ESB_META_PREFIX.'booking_from_layout', $_POST['booking_from_layout'] );
        }
        if(isset($_POST['single_room_layout'])){
            update_post_meta( $post_id, ESB_META_PREFIX.'single_room_layout', $_POST['single_room_layout'] );
        }
        if(isset($_POST['listing-type-id'])){
            update_post_meta( $post_id, ESB_META_PREFIX.'room_type_id', $_POST['listing-type-id'] );
        }
        if(isset($_POST['preview_room_layout'])){
            update_post_meta( $post_id, ESB_META_PREFIX.'preview_room_layout', $_POST['preview_room_layout'] );
        }
        if(isset($_POST['listing_type_general'])){
            update_post_meta( $post_id, ESB_META_PREFIX.'general_field_meta', $_POST['listing_type_general'] );
        }
        if(isset($_POST['listing_type_child_type'])){
            // var_dump($_POST['listing-type-child-type']);
            // die;
            update_post_meta( $post_id, ESB_META_PREFIX.'child_type_meta', $_POST['listing_type_child_type'] );
        }

        if(isset($_POST['schema_markup'])){
            update_post_meta( $post_id, ESB_META_PREFIX.'schema_markup', $_POST['schema_markup'] );
        }

        if (isset($_POST['filter_by_type'])) {
            update_post_meta($post_id, ESB_META_PREFIX . 'filter_by_type', $_POST['filter_by_type']);
        }else{
            update_post_meta($post_id, ESB_META_PREFIX . 'filter_by_type', '0' );
        }
        if (isset($_POST['price_based'])) {
            update_post_meta($post_id, ESB_META_PREFIX . 'price_based', $_POST['price_based'] );
        }
        if (isset($_POST['featured_image'])) {
            update_post_meta($post_id, ESB_META_PREFIX . 'featured_image', $_POST['featured_image']);
        }else{
            update_post_meta($post_id, ESB_META_PREFIX . 'featured_image', '' );
        }


        $azp_csses = get_option( 'azp_csses', false );
        if($azp_csses !== false && is_array($azp_csses)){
            if( !isset($azp_csses[$post_id]) || !is_array($azp_csses[$post_id]) ) $azp_csses[$post_id] = array();
        }else{
            $azp_csses = array();
            $azp_csses[$post_id] = array();
        }

        if(isset($_POST['ltype_single_css'])){
            $azp_csses[$post_id]['single'] = $_POST['ltype_single_css'];
        }
        if(isset($_POST['ltype_preview_css'])){
            $azp_csses[$post_id]['preview'] = $_POST['ltype_preview_css'];
        }
        if(isset($_POST['ltype_filter_css'])){
            $azp_csses[$post_id]['filter'] = $_POST['ltype_filter_css'];
        }
        if(isset($_POST['ltype_fheader_css'])){
            $azp_csses[$post_id]['fheader'] = $_POST['ltype_fheader_css'];
        }
        if(isset($_POST['ltype_fherosec_css'])){
            $azp_csses[$post_id]['fherosec'] = $_POST['ltype_fherosec_css'];
        }
        if(isset($_POST['ltype_sbooking_css'])){
            $azp_csses[$post_id]['sbooking'] = $_POST['ltype_sbooking_css'];
        }
        if(isset($_POST['ltype_sroom_css'])){
            $azp_csses[$post_id]['sroom'] = $_POST['ltype_sroom_css'];
        }
        if(isset($_POST['ltype_proom_css'])){
            $azp_csses[$post_id]['proom'] = $_POST['ltype_proom_css'];
        }

        update_option( 'azp_csses', $azp_csses );

        //if(easybook_addons_get_option('azp_css_external') == 'yes'){
            $upload_path = easybook_addons_upload_dirs('azp', 'css');
            $css_file = $upload_path . DIRECTORY_SEPARATOR . "listing_types.css";
            @file_put_contents($css_file, self::get_azp_css());
        //}
    }

    protected function set_meta_columns(){
        $this->has_columns = true;
    }
    public function meta_columns_head($columns){
        $columns['_id'] = __( 'ID', 'easybook-add-ons' ); 
        
        return $columns;
    }
    public function meta_columns_content($column_name, $post_ID){
        if ($column_name == '_id') {
            echo $post_ID;
        }
        
    }


    public static function get_azp_css(){
        $csses = '';
        $azp_csses = get_option( 'azp_csses', false );
        if($azp_csses !== false && is_array($azp_csses)){
            foreach ($azp_csses as $postID => $postCsses) {
                if(is_array($postCsses) && !empty($postCsses)){
                    $csses .= implode("", self::azp_correct_bgimage(array_values($postCsses)));
                }
            }
        }
        return $csses;
    }
    public static function azp_correct_bgimage($csses = array()){
        // $str = 'azpwpreplace_23_full';
        return preg_replace_callback('/azpwpreplace_(\d+)_([a-zA-Z]*)/m', 
            function ($matches) {
                // var_dump($matches);
                $size = isset($matches[2]) ? $matches[2] : 'full';
                if(isset($matches[1]) && $matches[1]){
                    return 'url('.wp_get_attachment_image_url( $matches[1], $size ).')';
                }else{
                    return '';
                }
            }, $csses);
    }



}

new Esb_Class_Listing_Type_CPT();


// get active plan for setting selection
function easybook_addons_get_listing_types(){
    $results = array();

    $post_args = array(
        'post_type'             => 'listing_type',
        
        'posts_per_page'        => -1,
        'orderby'               => 'date',
        'order'                 => 'DESC',

        'post_status'           => 'any'
    );

    $posts = get_posts( $post_args );
    if ( $posts ) {
        foreach ( $posts as $post ) {
            $results[$post->ID] = apply_filters( 'the_title' , $post->post_title ); 
            
        }
    }

    return $results;
}


// get active plan for setting selection
function listing_type_id($listing_type_id = 0){
    $fields = '[]';
    if(is_numeric($listing_type_id) && (int)$listing_type_id > 0)
        $fields = get_post_meta( $listing_type_id, ESB_META_PREFIX.'listing_fields', true );
    else 
        $fields = get_post_meta( easybook_addons_get_option('default_listing_type'), ESB_META_PREFIX.'listing_fields', true );

    $fields = json_decode($fields);
    if(!is_array($fields)) return array();
    return $fields;
}
// get active plan for setting selection
function easybook_addons_get_listing_type_fields_obj($listing_type_id = 0, $with_countries = false , $with_feature = false, $with_cats = false, $with_locs = false ){
    $fields = '[]';
    if(is_numeric($listing_type_id) && (int)$listing_type_id > 0)
        $fields = get_post_meta( $listing_type_id, ESB_META_PREFIX.'listing_fields', true );
    else 
        $fields = get_post_meta( easybook_addons_get_option('default_listing_type'), ESB_META_PREFIX.'listing_fields', true );

    $fields = json_decode($fields);
    if(!is_array($fields)) return array();
    // modify country
    if($with_countries){
        foreach($fields as $key => $field) {
            if ('location' == $field->type) {
                $field->countries = easybook_addons_get_google_contry_codes();

                $fields[$key] = $field;
                break;
            }
        }
    }
    if($with_cats){
        foreach($fields as $key => $field) {
            
            if ( 'categories' == $field->type || ('select' == $field->type && $field->fieldName == 'cats')) {
                // $field->options = 
                if(is_array($field->choises) && !empty($field->choises) ){
                    foreach ($field->choises as $fid) {
                        if( $term = get_term( $fid, 'listing_cat') ){

                            $field->cats[] = $term;
                            // get child terms
                            $child_terms = get_terms( array(
                                'taxonomy'          => 'listing_cat',
                                'hide_empty'        => false,
                                'parent'            => $term->term_id,
                            ) );
                            if ( $child_terms && ! is_wp_error( $child_terms ) ){ 
                                foreach ( $child_terms as $cterm ) {
                                    $field->cats[] = $cterm;

                                    // get child terms
                                    $child_terms = get_terms( array(
                                        'taxonomy'          => 'listing_cat',
                                        'hide_empty'        => false,
                                        'parent'            => $cterm->term_id,
                                    ) );
                                    if ( $child_terms && ! is_wp_error( $child_terms ) ){ 
                                        foreach ( $child_terms as $cterm ) {
                                            $field->cats[] = $cterm;

                                            // get child terms
                                            $child_terms = get_terms( array(
                                                'taxonomy'          => 'listing_cat',
                                                'hide_empty'        => false,
                                                'parent'            => $cterm->term_id,
                                            ) );
                                            if ( $child_terms && ! is_wp_error( $child_terms ) ){ 
                                                foreach ( $child_terms as $cterm ) {
                                                    $field->cats[] = $cterm;
                                                }
                                            }
                                            // end childs 3

                                        }
                                    }
                                    // end childs 2

                                }
                            }
                            // end childs 1

                        }
                        // $field->cats[] = get_term( $fid, 'listing_cat');
                    }
                }                
                $fields[$key] = $field;
                break;
            }


        }
    }
    if($with_locs){
        foreach($fields as $key => $field) {
            if ( 'locations' == $field->type ) {
                // $field->options = 
                if(is_array($field->choises) && !empty($field->choises) ){
                    foreach ($field->choises as $fid) {
                        if( $term = get_term( $fid, 'listing_location') ){

                            $field->locs[] = $term;
                            // get child terms
                            $child_terms = get_terms( array(
                                'taxonomy'          => 'listing_location',
                                'hide_empty'        => false,
                                'parent'            => $term->term_id,
                            ) );
                            if ( $child_terms && ! is_wp_error( $child_terms ) ){ 
                                foreach ( $child_terms as $cterm ) {
                                    $field->locs[] = $cterm;

                                    // get child terms
                                    $child_terms = get_terms( array(
                                        'taxonomy'          => 'listing_location',
                                        'hide_empty'        => false,
                                        'parent'            => $cterm->term_id,
                                    ) );
                                    if ( $child_terms && ! is_wp_error( $child_terms ) ){ 
                                        foreach ( $child_terms as $cterm ) {
                                            $field->locs[] = $cterm;

                                            // get child terms
                                            $child_terms = get_terms( array(
                                                'taxonomy'          => 'listing_location',
                                                'hide_empty'        => false,
                                                'parent'            => $cterm->term_id,
                                            ) );
                                            if ( $child_terms && ! is_wp_error( $child_terms ) ){ 
                                                foreach ( $child_terms as $cterm ) {
                                                    $field->locs[] = $cterm;
                                                }
                                            }
                                            // end childs 3

                                        }
                                    }
                                    // end childs 2

                                }
                            }
                            // end childs 1

                        }
                    }
                }                
                $fields[$key] = $field;
                break;
            }
        }
    }
    if($with_feature){
        foreach($fields as $key => $field) {
            if ('feature' == $field->type) {
                // $field->options = 
                if(is_array($field->choises) && !empty($field->choises) ){
                    foreach ($field->choises as $fid) {
                        if( $term = get_term( $fid, 'listing_feature') ) $field->features[] = $term;
                        // $field->features[] = get_term( $fid, 'listing_feature');
                    }
                }
                // $field->feature = easybook_addons_get_listing_features();
                
                $fields[$key] = $field;
                break;
            }
        }
    }
        
    return $fields;
}
function easybook_addons_get_rooms_type_fields_obj($listing_type_id = 0 , $with_feature = false){
    $fields = '[]';
    if(is_numeric($listing_type_id) && (int)$listing_type_id > 0)
        $fields = get_post_meta( $listing_type_id, ESB_META_PREFIX.'room_fields', true );
    else 
        $fields = get_post_meta( easybook_addons_get_option('default_listing_type'), ESB_META_PREFIX.'room_fields', true );

    $fields = json_decode($fields);
    if(!is_array($fields)) return array();
    if($with_feature){
        foreach($fields as $key => $field) {
            if ('feature' == $field->type) {
                // $field->options = 
                if(isset($field->choises) && is_array($field->choises) && !empty($field->choises) ){
                    foreach ($field->choises as $fid) {
                        if( $term = get_term( $fid, 'listing_feature') ) $field->features[] = $term;
                        // $field->features[] = get_term( $fid, 'listing_feature');
                    }
                }
                // $field->feature = easybook_addons_get_listing_features();
                
                $fields[$key] = $field;
                break;
            }
        }
    }
    return $fields;
}

// for saving listing
function easybook_addons_post_object_fields(){
    return array(
        'title',
        'tags',
        'cats',
        'features',
        'locations',
        'content',
        'thumbnail',
        'room_thumbnail',

        'listing_rooms',
        'working_hours',

        'ltags_names',
        'select_locations',
        'post_excerpt'
    );
}

function easybook_addons_get_listing_type_fields($listing_type_id = 0, $room_fields = false){
    if($room_fields)
        $fields_obj_arr = easybook_addons_get_rooms_type_fields_obj($listing_type_id);
    else
        $fields_obj_arr = easybook_addons_get_listing_type_fields_obj($listing_type_id);

    $fields = array();

    $ignore_types = array('section_title');
    
    if(is_array($fields_obj_arr) && !empty($fields_obj_arr)){
        foreach ($fields_obj_arr as $field) {
            if( is_object($field) && !in_array($field->type, $ignore_types) ){
                switch ($field->type) {
                    case 'input':
                    case 'radio':
                    case 'switch':
                    case 'select':
                    case 'textarea':
                    case 'editor':
                    case 'ltype':
                    case 'calendar':
                        $fields[$field->fieldName] = 'text';
                        break;
                    case 'calendar_metas':
                        // $fields[$field->fieldName] = 'calendar_metas';
                        $fields[$field->fieldName] = 'text';
                        $fields[$field->fieldName .'_metas'] = 'array';
                        $fields[$field->fieldName .'_show_metas'] = 'text';
                        break;
                    case 'image':
                    case 'socials':
                    case 'facts':
                    case 'add_rooms':
                    case 'checkbox':
                    case 'muti':
                    case 'gallery_imgs':
                    case 'header_imgs':
                    case 'header_imgs':
                    case 'faq':
                    // case 'calendar':
                    case 'feature':
                    case 'lcoupon':
                    case 'lservices':
                    case 'lmember':
                    case 'slots':
                        $fields[$field->fieldName] = 'array';
                        break;
                    default:
                        $fields[$field->fieldName] = 'text';
                        break;
                }
            }
        }
    }

    return $fields;
}


function easybook_addons_get_listing_type_fields_meta($listing_type_id = 0, $room_fields = false){
    $fields = easybook_addons_get_listing_type_fields($listing_type_id, $room_fields);
    $meta_fields = array();
    if(!empty($fields)){
        $ignore_fields = easybook_addons_post_object_fields();

        foreach ((array)$fields as $fname => $ftype) {
            if(!in_array($fname, $ignore_fields)) $meta_fields[$fname] = $ftype;
        }
    }

    return $meta_fields;

}

function easybook_addons_get_rating_fields($listing_type_id = 0){
    // $fields = '[]';
    if(is_numeric($listing_type_id) && (int)$listing_type_id > 0)
        $fields = get_post_meta( $listing_type_id, ESB_META_PREFIX.'rating_fields', true );
    else 
        $fields = get_post_meta( easybook_addons_get_option('default_rooms_type'), ESB_META_PREFIX.'rating_fields', true );

    $fields = json_decode($fields, true);
    if(!is_array($fields)) return array();
    return $fields;
}



