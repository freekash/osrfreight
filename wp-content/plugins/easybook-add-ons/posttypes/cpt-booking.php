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



class Esb_Class_Booking_CPT extends Esb_Class_CPT {   
    protected $name = 'lbooking';

    protected function init(){
        parent::init();

        $logged_in_ajax_actions = array(
            
            'easybook_addons_cancel_lbooking',
            'easybook_addons_approve_lbooking',
        );
        foreach ($logged_in_ajax_actions as $action) {
            $funname = str_replace('easybook_addons_', '', $action);   
            add_action('wp_ajax_'.$action, array( $this, $funname ));
        }

        $not_logged_in_ajax_actions = array(
            'easybook_addons_booking_listing',
            'check_availability',
            // 'tour_calendar_metas',
            'hotel_room_dates',
            // 'house_dates',
            // 'event_dates',
            'listing_dates',
        );
        foreach ($not_logged_in_ajax_actions as $action) {
            $funname = str_replace('easybook_addons_', '', $action);   
            add_action('wp_ajax_'.$action, array( $this, $funname ));
            add_action('wp_ajax_nopriv_'.$action, array( $this, $funname ));
        }
    }

    public function register(){

        $labels = array( 
            'name' => __( 'Booking', 'easybook-add-ons' ),
            'singular_name' => __( 'Booking', 'easybook-add-ons' ), 
            'add_new' => __( 'Add New Booking', 'easybook-add-ons' ),
            'add_new_item' => __( 'Add New Booking', 'easybook-add-ons' ),
            'edit_item' => __( 'Edit Booking', 'easybook-add-ons' ),
            'new_item' => __( 'New Booking', 'easybook-add-ons' ),
            'view_item' => __( 'View Booking', 'easybook-add-ons' ),
            'search_items' => __( 'Search Bookings', 'easybook-add-ons' ),
            'not_found' => __( 'No Bookings found', 'easybook-add-ons' ),
            'not_found_in_trash' => __( 'No Bookings found in Trash', 'easybook-add-ons' ),   
            'parent_item_colon' => __( 'Parent Booking:', 'easybook-add-ons' ),
            'menu_name' => __( 'Listing Bookings', 'easybook-add-ons' ),  
        );

        $args = array(  
            'labels' => $labels,
            'hierarchical' => false,
            'description' => __( 'Listing booking', 'easybook-add-ons' ),
            // 'supports' => array( 'title', 'editor', 'author', 'thumbnail','comments','excerpt'/*, 'post-formats'*/),
            'supports' => array( '' ),
            'taxonomies' => array(),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,//default from show_ui
            'menu_position' => 25,
            'menu_icon' => 'dashicons-calendar-alt',
            'show_in_nav_menus' => false,
            'publicly_queryable' => false,
            'exclude_from_search' => true,
            'has_archive' => false,
            'query_var' => true,
            'can_export' => false,
            'rewrite' => array( 'slug' => __('booking','easybook-add-ons') ),
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
        $columns['_id']             = __('Booking','easybook-add-ons');
        $columns['_listing']             = __('Listing','easybook-add-ons');
        $columns['_lb_room']   = __('Room Type','easybook-add-ons');
        $columns['_status']             = __('Status','easybook-add-ons');
        $columns['_checkin']   = __('Check In','easybook-add-ons');
        $columns['_checkout']   = __('Check Out','easybook-add-ons');
        $columns['_nights']   = __('Nights','easybook-add-ons');
        $columns['_adults']   = __('Adults','easybook-add-ons');
        $columns['_children']   = __('Children','easybook-add-ons');
        // $columns['_coupon']   = __('Coupon Code','easybook-add-ons');
        $columns['_total']   = __('Total','easybook-add-ons');
        return $columns;
    }
    public function meta_columns_content($column_name, $post_ID){
        $qty = get_post_meta( $post_ID, ESB_META_PREFIX.'qty', true );
        if ($column_name == '_id') {
            $user_object = get_userdata( get_post_meta( $post_ID, ESB_META_PREFIX.'user_id', true ) );
            echo '<div class="tips">';
            echo '<a href="'.admin_url('post.php?post='.$post_ID.'&action=edit' ).'"><strong>#'.$post_ID.'</strong></a>';
            echo __(' by ','easybook-add-ons'). '<strong>'.get_user_meta( $user_object->ID ,'first_name',true).'</strong>';
            echo '<br /><small class="meta email"><a href="mailto:'.$user_object->user_email.'">'.$user_object->user_email.'</a></small>';
            echo '</div>';
        }
        if ($column_name == '_listing') {
            $listing = get_post( get_post_meta( $post_ID, ESB_META_PREFIX.'listing_id', true ) );
            if (null != $listing) echo '<strong>'.$listing->post_title.'</strong>';
            if (null != $qty) echo '<strong>'._e( ' ( Event )', 'easybook-add-ons' ).'</strong>';
        }
        if ($column_name == '_lb_room') {
            $rooms =  get_post_meta( $post_ID, ESB_META_PREFIX.'rooms', true );
            // var_dump($rooms);

            if (null != $rooms && is_array($rooms)){
                foreach ($rooms as $key => $room) {
                    echo '<strong>'.$room["title"].'</strong><br/>';       
                }
            } 
            
        }
        if ($column_name == '_status') {
            echo '<strong>'.easybook_addons_get_booking_status_text(get_post_meta( $post_ID, ESB_META_PREFIX.'lb_status', true )).'</strong>';
            
        }
        if ($column_name == '_checkin') {
            $date_event = get_post_meta( $post_ID, ESB_META_PREFIX.'date_event', true );
            $checkin = get_post_meta( $post_ID, ESB_META_PREFIX.'checkin', true );
            echo '<strong>'.(($checkin != '' && $date_event == '')? $checkin : $date_event).'</strong>';
        }
        if ($column_name == '_checkout') {
            echo '<strong>'.get_post_meta( $post_ID, ESB_META_PREFIX.'checkout', true ).'</strong>';
            
        }
        if ($column_name == '_nights') {
            echo '<strong>'.get_post_meta( $post_ID, ESB_META_PREFIX.'nights', true ).'</strong>';
            
        }
        if ($column_name == '_adults') {
            echo '<strong>'.get_post_meta( $post_ID, ESB_META_PREFIX.'adults', true ).'</strong>';
            
        }
        if ($column_name == '_children') {
            echo '<strong>'.get_post_meta( $post_ID, ESB_META_PREFIX.'children', true ).'</strong>';
            
        }
        // if ($column_name == '_coupon') {
        //     echo '<strong>'.get_post_meta( $post_ID, ESB_META_PREFIX.'bkcoupon', true ).'</strong>';
            
        // }
        if ($column_name == '_total') {
            $price_total_room = get_post_meta( $post_ID, ESB_META_PREFIX.'price_total_room', true );
            if (!empty($price_total_room) && $price_total_room != '') {
               echo '<strong>'.easybook_addons_get_price_formated($price_total_room).'</strong>';
            }else{
                echo '<strong>'.easybook_addons_get_price_formated(get_post_meta( $post_ID, ESB_META_PREFIX.'price_total', true )).'</strong>';
            }
            
            
        }
    }

    protected function set_meta_boxes(){
        $this->meta_boxes = array(
            'customer'       => array(
                'title'         => __( 'Customer', 'easybook-add-ons' ),
                'context'       => 'normal', // normal - side - advanced
                'priority'       => 'core', // default - high - core - low
                'callback_args'       => array(),
            ),
            'meta'       => array(
                'title'         => __( 'Meta Data', 'easybook-add-ons' ),
                'context'       => 'normal', // normal - side - advanced
                'priority'       => 'core', // default - high - core - low
                'callback_args'       => array(),
            ),
            'status'       => array(
                'title'         => __( 'Status', 'easybook-add-ons' ),
                'context'       => 'side', // normal - side - advanced
                'priority'       => 'high', // default - high - core - low
                'callback_args'       => array(),
            )
        );
    }

    public function lbooking_customer_callback($post, $args){
        wp_nonce_field( 'cth-cpt-fields', '_cth_cpt_nonce' );
        $user_object = get_userdata( get_post_meta( $post->ID, ESB_META_PREFIX.'user_id', true ) );
        ?>
        <h2><?php _e( 'Customer details', 'easybook-add-ons' ); ?></h2>
        <p class="lbk-desc"></p>
        <table class="form-table lorder-details">
            <tbody>
                <tr class="hoz">
                    <th class="w20"><?php _e( 'First Name :', 'easybook-add-ons' ); ?></th>
                    <td><a href="<?php echo get_edit_user_link( get_post_meta( $post->ID, ESB_META_PREFIX.'user_id', true ) ); ?>"><?php echo get_userdata(get_post_meta( $post->ID, ESB_META_PREFIX.'user_id', true ))->display_name; ?></a></td>
                </tr>
                <tr class="hoz">
                    <th class="w20"><?php _e( 'Email : ', 'easybook-add-ons' ); ?></th>
                    <td><a href="mailto:<?php echo $user_object->user_email; ?>"><?php echo $user_object->user_email; ?></a></td>
                </tr>
                <tr class="hoz">
                    <th class="w20"><?php _e( 'Phone :', 'easybook-add-ons' ); ?></th>
                    <td><span><?php echo get_user_meta( $user_object->ID ,'_cth_phone',true) ?></span></td>
                </tr>
                <tr class="hoz">
                    <th class="w20"><?php _e( 'Listing Item :', 'easybook-add-ons' ); ?></th>
                    <?php 
                    $listing = get_post( get_post_meta( $post->ID, ESB_META_PREFIX.'listing_id', true ) );
                    if (null != $listing) echo '<td><span>'.$listing->post_title.'</span></td>';
                    ?>

                </tr>
                <?php $this->tour_booking_details($post); ?>
                <?php $this->tour_slot_details($post); ?>
                <?php $this->tour_tpicker_details($post); ?>
                <?php 
                    $checkin = get_post_meta( $post->ID, ESB_META_PREFIX.'checkin', true );
                    $checkout = get_post_meta( $post->ID, ESB_META_PREFIX.'checkout', true );

                if (!empty($checkin) && !empty($checkout)): ?>
                    <tr class="hoz">
                        <th class="w20"><?php _e( 'Booking Date :', 'easybook-add-ons' ); ?></th>
                        <td><span><?php echo $checkin.' - '.$checkout; ?></span></td>
                    </tr>
                <?php endif ?>
                <?php $qty = get_post_meta( $post->ID, ESB_META_PREFIX.'qty', true ); 
                    if(!empty($qty) && $qty != null){?>
                        <tr class="hoz">
                            <th class="w20"><?php _e( 'Tickets:', 'easybook-add-ons' ); ?></th>
                            <td><span><?php echo $qty; ?></span></td>
                        </tr> 
                <?php 
                    }
                ?>
                <?php 
                    $bkcoupon = get_post_meta( $post->ID, ESB_META_PREFIX.'bkcoupon', true ); 
                    if(!empty($bkcoupon) && $bkcoupon != null){?>
                        <tr class="hoz">
                            <th class="w20"><?php _e( 'Coupon Code:', 'easybook-add-ons' ); ?></th>
                            <td><span><?php echo $bkcoupon; ?></span></td>
                        </tr> 

                <?php 
                    }
                ?>
                <?php 
                    $date_event = get_post_meta( $post->ID, ESB_META_PREFIX.'date_event', true );
                    if(!empty($date_event) && $date_event != null){?>
                        <tr class="hoz">
                            <th class="w20"><?php _e( 'Date Event:', 'easybook-add-ons' ); ?></th>
                            <td><span><?php echo $date_event; ?></span></td>
                        </tr> 
                <?php 
                    }
                ?>
                <?php   $rooms =  get_post_meta( $post->ID, ESB_META_PREFIX.'rooms', true );
                        $quantity = get_post_meta( $post->ID, ESB_META_PREFIX.'quantity', true );
                    if (!empty($quantity) && $quantity != '' && $quantity > 0) {
                       if(!empty($rooms) && $rooms != '' ) {
                            foreach ($rooms as $key => $room) {?>
                           <tr class="hoz">
                                <th class="w20"><?php printf( esc_html__( 'Room %s : ', 'easybook-add-ons' ),$key+1); ?></th>
                                <td><?php printf( esc_html__( '%s  x %s', 'easybook-add-ons' ),get_the_title($room['ID']),$quantity); ?></td>
                            </tr>
                       
                            
                    <?php  }
                        }
                            
                    }else{

                        if(!empty($rooms) && $rooms != '' ) {
                            foreach ($rooms as $key => $room) { ?>
                            <tr class="hoz">
                                <th class="w20"><?php printf( esc_html__( 'Room %s : ', 'easybook-add-ons' ),$key+1); ?></th>
                                <td><?php printf( esc_html__( '%s  x %s', 'easybook-add-ons' ),get_the_title($room['ID']),$room['quantity']); ?></td>
                            </tr> 
                    <?php  
                            }
                        }
                    }
                    
                ?>
                 <tr class="hoz">
                    
                    <?php 
                        $listing_id = get_post_meta( $post->ID, ESB_META_PREFIX.'listing_id', true );
                        $services = get_post_meta($listing_id, ESB_META_PREFIX.'lservices', true);
                        if(isset($services) && is_array($services) && $services!= '') {
                            $value_key_ser  = array();
                            $value_serv = array();
                            $addservices = get_post_meta( $post->ID, ESB_META_PREFIX.'addservices', true );
                            foreach ($addservices  as $key => $item_serv) {
                                // var_dump($item_serv);
                                $value_key_ser[]  = array_search($item_serv,array_column($services,  'service_id'));
                            }
                            foreach ($value_key_ser as $key => $value) {
                                 $value_serv[] = $services[$value];
                            }
                            if (!empty( $value_serv) && is_array( $value_serv) &&  $value_serv != '') {   
                                ?>
                                <th class="w20"><?php _e( 'Extra Services :', 'easybook-add-ons' ); ?></th>
                                <td>
                                    <ul>
                                        <?php
                                        foreach ($value_serv as $key => $value) {
                                            echo '<li>'.$value['service_name'].'</li>';
                                        }
                                        ?>
                                    </ul>
                                </td>
                                <?php
                            }
                        } 
                    ?>
                </tr>

                
                <tr class="hoz">
                    <th class="w20"><?php _e( 'Totals:', 'easybook-add-ons' ); ?></th>
                    <td><strong><?php echo easybook_addons_get_price_formated( get_post_meta( $post->ID, ESB_META_PREFIX.'price_total', true ) ); ?></strong></td>
                </tr>


            </tbody>
        </table>
        <?php   
    }

    protected function tour_booking_details($post){
        $booking_type = get_post_meta( $post->ID, ESB_META_PREFIX.'booking_type', true  );
        if($booking_type != 'tour') return;

        $checkin = get_post_meta( $post->ID, ESB_META_PREFIX.'checkin', true );
        $checkout = get_post_meta( $post->ID, ESB_META_PREFIX.'checkout', true );
        if ( !empty($checkin) ): ?>
            <tr class="hoz">
                <th class="w20"><?php _e( 'Tour Dates:', 'easybook-add-ons' ); ?></th>
                <td><span><?php echo $checkin; if($checkout != '') echo sprintf(__( ' - %s', 'easybook-add-ons' ), $checkout); ?></span></td>
            </tr>
        <?php endif; ?>
        <tr class="hoz">
            <th class="w20"><?php _e( 'Adults:', 'easybook-add-ons' ); ?></th>
            <td><span><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'adults', true ); ?></span></td>
        </tr>
        <tr class="hoz">
            <th class="w20"><?php _e( 'Children:', 'easybook-add-ons' ); ?></th>
            <td><span><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'children', true ); ?></span></td>
        </tr>
        <tr class="hoz">
            <th class="w20"><?php _e( 'Infants:', 'easybook-add-ons' ); ?></th>
            <td><span><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'infants', true ); ?></span></td>
        </tr>
        <?php
    }
    protected function tour_slot_details($post){
        $booking_type = get_post_meta( $post->ID, ESB_META_PREFIX.'booking_type', true  );
        if($booking_type != 'slot') return;

        $checkin = get_post_meta( $post->ID, ESB_META_PREFIX.'checkin', true );
        $checkout = get_post_meta( $post->ID, ESB_META_PREFIX.'checkout', true );
        if ( !empty($checkin) ): ?>
            <tr class="hoz">
                <th class="w20"><?php _e( 'Dates:', 'easybook-add-ons' ); ?></th>
                <td><span><?php echo $checkin; if($checkout != '') echo sprintf(__( ' - %s', 'easybook-add-ons' ), $checkout); ?></span></td>
            </tr>
        <?php endif; ?>
        <tr class="hoz">
            <th class="w20"><?php _e( 'Time Slots:', 'easybook-add-ons' ); ?></th>
            <td><span><?php echo implode("<br />", get_post_meta( $post->ID, ESB_META_PREFIX.'slots', true ) ); ?></span></td>
        </tr>
        
        <?php
    }

    protected function tour_tpicker_details($post){
        $booking_type = get_post_meta( $post->ID, ESB_META_PREFIX.'booking_type', true  );
        if($booking_type != 'tpicker') return;

        $checkin = get_post_meta( $post->ID, ESB_META_PREFIX.'checkin', true );
        $checkout = get_post_meta( $post->ID, ESB_META_PREFIX.'checkout', true );
        if ( !empty($checkin) ): ?>
            <tr class="hoz">
                <th class="w20"><?php _e( 'Dates:', 'easybook-add-ons' ); ?></th>
                <td><span><?php echo $checkin; if($checkout != '') echo sprintf(__( ' - %s', 'easybook-add-ons' ), $checkout); ?></span></td>
            </tr>
        <?php endif; ?>
        <tr class="hoz">
            <th class="w20"><?php _e( 'Times:', 'easybook-add-ons' ); ?></th>
            <td><span><?php echo implode("<br />", get_post_meta( $post->ID, ESB_META_PREFIX.'times', true ) ); ?></span></td>
        </tr>
        
        <?php
    }


    public function lbooking_meta_callback($post, $args){
        
        ?>
        <h2><?php _e( 'Booking Meta', 'easybook-add-ons' ); ?></h2>
        <p class="lbk-desc"></p>
        <table class="form-table lorder-details">
            <tbody>

                <tr class="hoz">
                    <th class="w20"><?php _e( 'Gateway', 'easybook-add-ons' ); ?></th>
                    <td><?php echo easybook_addons_get_order_method_text(get_post_meta( $post->ID, ESB_META_PREFIX.'payment_method', true ));?></td>
                </tr>
                <?php 
                // if( 'woo' == get_post_meta( $post->ID, ESB_META_PREFIX.'payment_method', true ) ):
                ?>
                <!-- <tr class="hoz">
                    <th class="w20"><?php _e( 'WooCommerce Order', 'easybook-add-ons' ); ?></th>
                    <td><a href="<?php echo get_edit_post_link( get_post_meta( $post->ID, ESB_META_PREFIX.'woo_order', true ) ); ?>"><?php echo sprintf( __( '#%s', 'easybook-add-ons' ), get_post_meta( $post->ID, ESB_META_PREFIX.'woo_order', true ) ); ?></a></td>
                </tr> -->
                <?php 
                // endif; 
                ?>

                
                <tr class="hoz">
                    <th class="w20"><?php _e( 'Note', 'easybook-add-ons' ); ?></th>
                    <td>
                        <textarea name="lb_notes" id="lb_notes" cols="30" rows="5" class="w100"><?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'notes', true );?></textarea>
                    </td>
                </tr>



            </tbody>
        </table>
        <?php   
    }

    public function lbooking_status_callback($post, $args){
        /*
         * Use get_post_meta() to retrieve an existing value
         * from the database and use the value for the form.
         */
        $value = get_post_meta( $post->ID, ESB_META_PREFIX.'lb_status', true );

        $status = easybook_addons_get_booking_statuses_array();
        ?>
        <table class="form-table lorder-details">
            <tbody>
                <tr class="hoz">
                    <td>
                        <select name="lb_status" class="w100">
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

        if(isset($_POST['lb_status'])){
            $new_status = sanitize_text_field( $_POST['lb_status'] ) ;
            $origin_status = get_post_meta( $post_id, ESB_META_PREFIX.'lb_status', true );
            if($new_status !== $origin_status){
                update_post_meta( $post_id, ESB_META_PREFIX.'lb_status', $new_status );
                // unhook this function so it doesn't loop infinitely
                remove_action( 'save_post_'.$this->name, array($this, 'save_post'), 10, 3  );
                    do_action('easybook_addons_lbooking_change_status_'.$origin_status.'_to_'.$new_status, $post_id );
                    do_action('easybook_addons_lbooking_change_status_to_'.$new_status, $post_id );
                // re-hook this function
                add_action( 'save_post_'.$this->name, array($this, 'save_post'), 10, 3  );
                    
            }
        }
    }
    public function booking_listing(){
        $json = array(
            'success' => false,
            'data' => array(
                'POST'=>$_POST,
            )
        );
        Esb_Class_Ajax_Handler::verify_nonce('easybook-add-ons');
        $listing_id = $_POST['listing_id'];
        if(is_numeric($listing_id) && (int)$listing_id > 0){

            $booking_title = __( '%1$s booking request by %2$s', 'easybook-add-ons' ); 
            $booking_datas = array();
            // $booking_metas_loggedin = array();
            $current_user = wp_get_current_user();
            if( $current_user->exists() ){
                $lb_name = $current_user->display_name;
                $lb_email = get_user_meta( $current_user->ID, ESB_META_PREFIX.'email', true);
                $lb_phone = get_user_meta( $current_user->ID, ESB_META_PREFIX.'phone', true);
            }
            // override user details by booking details
            if( !empty($_POST['lb_name']) ){
                $lb_name = $_POST['lb_name'] ;
            }

            if( !empty($_POST['lb_email']) ){
                $lb_email = $_POST['lb_email'];
            }

            if( !empty($_POST['lb_phone']) ){
                $lb_phone = $_POST['lb_phone'];
            }

            if( empty($lb_email) && $current_user->exists() ) $lb_email = $current_user->user_email;

            $booking_datas['post_title'] = sprintf( $booking_title, get_the_title( $listing_id ), $lb_name );

            $booking_datas['post_content'] = '';
            //$booking_datas['post_author'] = '0';// default 0 for no author assigned
            $booking_datas['post_status'] = 'publish';
            $booking_datas['post_type'] = 'lbooking';

            do_action( 'easybook_addons_booking_request_before', $booking_datas );
            $booking_id = wp_insert_post($booking_datas ,true );

            if (!is_wp_error($booking_id)) {
                $listing_author_id = get_post_field( 'post_author', $listing_id );
                easybook_addons_user_add_notification($listing_author_id, array(
                    'type' => 'new_booking',
                    'entity_id'     => $listing_id,
                    'actor_id'      => $current_user->ID
                ));

                $meta_fields = array(
                    // 'listing_id' => 'text', listing_id will be set manually
                    'lb_name'               => 'text',
                    'lb_email'              => 'text',
                    'lb_phone'              => 'text',

                    'notes'                 => 'text',

                    // 'lb_quantity'           => 'text',
                    // 'lb_date'               => 'text',
                    // 'lb_time'               => 'text',
                    // 'lb_add_info'           => 'text',
                    // 'lb_booking_type'       => 'text',

                    'checkin'              => 'text',
                    'checkout'              => 'text',
                    // 'nights'              => 'text',
                    // 'days'              => 'text',
                    'adults'              => 'text',
                    'children'              => 'text',
                    'infants'              => 'text',

                );

                $meta_fields = apply_filters( 'esb_booking_request_meta_fields', $meta_fields );
                $booking_metas = array();
                foreach($meta_fields as $field => $ftype){
                    if(isset($_POST[$field])) $booking_metas[$field] = $_POST[$field] ;
                    else{
                        if($ftype == 'array'){
                            $booking_metas[$field] = array();
                        }else{
                            $booking_metas[$field] = '';
                        }
                    } 
                }
                $booking_metas['listing_id'] = $listing_id;
                $booking_metas['lb_status'] = 'pending'; // pending - completed - failed - refunded - canceled
                // user id for non logged in user, will be override with loggedin info
                
                $booking_metas['lb_name'] =  $lb_name;
                $booking_metas['lb_email'] =  $lb_email;
                $booking_metas['lb_phone'] =  $lb_phone;

                $booking_metas['user_id'] = $current_user->ID;
                $booking_metas['payment_method'] = 'request'; // banktransfer - paypal - stripe - woo
                
                // merge with logged in customser data
                // $booking_metas = array_merge($booking_metas,$booking_metas_loggedin);

                // woo payment
                $booking_metas['payment_method'] = 'request'; // banktransfer - paypal - stripe - woo

                // $cmb_prefix = '_cth_';
                foreach ($booking_metas as $key => $value) {
                    update_post_meta( $booking_id, ESB_META_PREFIX.$key,  $value  );
                }
                // add _price for woo
                $listing_price = get_post_meta( $listing_id, '_price', true );
                if( $listing_price != '' && is_numeric($listing_price) ){
                    update_post_meta( $booking_id, '_price',  $listing_price );

                    if( easybook_addons_get_option('add_cart_delay') < 300000 ){
                        $quantity = (isset($_POST['lb_quantity']) && is_numeric($_POST['lb_quantity']) && $_POST['lb_quantity'] )? $_POST['lb_quantity'] : 1;
                        $json['data']['url'] = easybook_addons_get_add_to_cart_url( $booking_id, $quantity );
                    }
                        
                }

                if (isset($_POST['addservices']) && is_array($_POST['addservices']) && $_POST['addservices'] != ''){
                     update_post_meta( $booking_id, ESB_META_PREFIX.'addservices', $_POST['addservices']);     
                }
                // slot booking
                if ( isset($_POST['slots']) && is_array($_POST['slots']) && !empty($_POST['slots']) ){
                    update_post_meta( $booking_id, ESB_META_PREFIX.'slots', $_POST['slots']);     
                    update_post_meta( $booking_id, ESB_META_PREFIX.'slots_text', implode("|", $_POST['slots'] ) );     
                }
                // tpicker booking
                if ( isset($_POST['times']) && is_array($_POST['times']) && !empty($_POST['times']) ){
                    update_post_meta( $booking_id, ESB_META_PREFIX.'times', $_POST['times']);     
                    update_post_meta( $booking_id, ESB_META_PREFIX.'times_text', implode("|", $_POST['times'] ) );     
                }
                


                // update bookings count
                // self::update_bookings_count($listing_author_id);
                // $json['data']['booking_metas'] = $booking_metas;
                $json['success'] = true;
                $json['data']['message'] = apply_filters( 'easybook_addons_insert_booking_message', __( 'Your booking is received. The listing author will contact with you soon.<br>You can also login with your email to manage bookings.<br>Thank you.', 'easybook-add-ons' ) );

                do_action( 'easybook_addons_booking_request_after', $booking_id );
            }else{
                $json['success'] = false;
                $json['data']['error'] = $booking_id->get_error_message();

                if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Insert booking post error: " . $booking_id->get_error_message() . PHP_EOL, 3, ESB_LOG_FILE);

                // throw new Exception($booking_id->get_error_message());

            }

        }else{
            $json['success'] = false;
            $json['data']['error'] = esc_html__( 'The listing id is incorrect.', 'easybook-add-ons' ) ;
        }

        wp_send_json($json );
    }

    public function cancel_lbooking(){
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
        $bkid = $_POST['bkid'];
        if(is_numeric($bkid) && (int)$bkid > 0){
            $current_user = wp_get_current_user(); 
            if($current_user->user_email != get_post_meta( $bkid, ESB_META_PREFIX.'lb_email', true ) ){
                $json['data'][] = __( "You don't have permission to this booking", 'easybook-add-ons' );
                wp_send_json($json );
            }
            if ( !update_post_meta( $bkid, ESB_META_PREFIX.'lb_status',  'canceled'  ) ) {
                $json['data'][] = sprintf(__('Insert booking %s meta failure or existing meta value','easybook-add-ons'),'lb_status');
            }else{
                $json['success'] = true;
            }
        }else{
            
            $json['data']['error'] = esc_html__( 'The post id is incorrect.', 'easybook-add-ons' ) ;
        }

        wp_send_json($json );
    }

    public function approve_lbooking(){
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


        $bkid = $_POST['bkid'];
        if(is_numeric($bkid) && (int)$bkid > 0){
            $listing_id = get_post_meta( $bkid, ESB_META_PREFIX.'listing_id', true );
            if(get_current_user_id() != get_post_field('post_author', $listing_id) ){
                $json['data'][] = __( "You don't have permission to approve this booking", 'easybook-add-ons' );
                $json['data']['user'] = get_current_user_id();
                $json['data']['author'] = get_post_field('post_author', $listing_id);
                wp_send_json($json );
            }

            if( easybook_addons_get_option('booking_author_woo') == 'yes' && get_post_meta( $bkid, ESB_META_PREFIX.'woo_order', true ) != '' ){
                $woo_order = wc_get_order( get_post_meta( $bkid, ESB_META_PREFIX.'woo_order', true ) );
                if(!empty($woo_order)){
                    $woo_order->update_status( 'completed' , __( 'Listing author has approved this payment.', 'easybook-add-ons' ) );
                }
            }else{
                if ( !update_post_meta( $bkid, ESB_META_PREFIX.'lb_status',  'completed'  ) ) {
                    $json['data'][] = sprintf(__('Insert booking %s meta failure or existing meta value','easybook-add-ons'),'lb_status');
                }else{
                    $json['success'] = true;
                    // push customer notification
                    $customer = get_user_by( 'email', get_post_meta( $bkid, ESB_META_PREFIX.'lb_email', true ) );
                    if ( ! empty( $customer ) ) {
                        if( easybook_addons_get_option('db_hide_bookings') != 'yes' ){
                            // easybook_addons_user_add_notification($customer->ID, array(
                            //     'type' => 'booking_approved',
                            //     'message' => sprintf(__( 'Your booking for <strong>%s</strong> listing has been approved.', 'easybook-add-ons' ), get_post_field('post_title', $listing_id) )
                            // ));
                        }
                        
                    }
                    do_action( 'easybook_addons_edit_booking_approved', $bkid );

                }
            }
                
        }else{
            
            $json['data']['error'] = esc_html__( 'The booking id is incorrect.', 'easybook-add-ons' ) ;
        }

        wp_send_json($json );
    }

    public function check_availability(){
        $json = array(
            'success' => false,
            'data' => array(
                // 'POST'=>$_POST,
            ),
            'rooms' => array(),
            'available' => array(),
            'add_services'      => array(),
        );
        
        Esb_Class_Ajax_Handler::verify_nonce('easybook-add-ons');

        $listing_id = $_POST['listing_id'];
        if(is_numeric($listing_id) && (int)$listing_id > 0){
            $listing_post = get_post($listing_id);
            if(empty($listing_post) || $listing_post->post_type != 'listing'){
                $json['error'] = esc_html__( 'Invalid listing post', 'easybook-add-ons' ) ;
                wp_send_json($json );
            }

            // get rooms data
            $rooms_ids = get_post_meta( $listing_id, ESB_META_PREFIX.'rooms_ids', true );
            if(!empty($rooms_ids) && is_array($rooms_ids)){
                foreach ($rooms_ids as $rid) {
                    
                    $json['rooms'][] = array( 'id'=> $rid, 'title' => get_post_field( 'post_title', $rid), 'adults' => (int)get_post_meta($rid, ESB_META_PREFIX.'adults', true), 'children' => (int)get_post_meta($rid, ESB_META_PREFIX.'children', true), 'price' => get_post_meta($rid, '_price', true) );
                }
            }
            if(isset($_POST['checkin']) && $_POST['checkin'] != '' && isset($_POST['checkout']) && $_POST['checkout'] != ''){
                $json['available'] = easybook_addons_get_available_listings(
                    array(
                        'checkin'   => $_POST['checkin'],
                        'checkout'   => $_POST['checkout'],
                        'listing_id'   => $listing_id,
                    )
                );
            }

            if( !empty($json['available']) ) $json['add_services'] = get_post_meta( $listing_id, ESB_META_PREFIX.'lservices', true );

            $json['success'] = true;
        }else{
            $json['error'] = esc_html__( 'The listing id is incorrect.', 'easybook-add-ons' ) ;
        }
        wp_send_json($json );
    }


    private function rooms_date_check($listing_id = 0, $date = ''){
        $rooms = get_post_meta( $listing_id, ESB_META_PREFIX.'rooms_ids', true );
    }

    public function hotel_room_dates(){
        $json = array(
            'success' => false,
            'data' => array(
                'POST'=>$_POST,
            ),
            'debug'     => false
        );

        // $json['listing'] = get_the_ID(); --> not working

        if(isset($_POST['postid']) && $_POST['postid'] != '' ){
            $listing_id = $_POST['postid'];
            $hotel_rooms = get_post_meta( $listing_id, ESB_META_PREFIX.'rooms_ids', true );
            
            $_show_metas = 'true';
            $available = array();
            if( isset($_POST['dates']) && !empty($_POST['dates']) && !empty($hotel_rooms) ){
                foreach ((array)$_POST['dates'] as $date) {
                    $rooms_datas = array();
                    foreach ($hotel_rooms as $room_id) {
                        $room_dates = get_post_meta( $room_id, ESB_META_PREFIX.'calendar', true );
                        if( false === strpos($room_dates, $date) )
                            continue;

                        $room_dates_metas = get_post_meta( $room_id, ESB_META_PREFIX.'calendar_metas', true );
                        $_show_metas = get_post_meta( $room_id, ESB_META_PREFIX.'calendar_show_metas', true );

                        $metas = array(
                            'quantity'                  =>  get_post_meta( $room_id, ESB_META_PREFIX.'quantity', true ),
                            'price'                     => easybook_addons_get_price( get_post_meta( $room_id, '_price', true ) ),
                        );
                        if(isset($room_dates_metas[$date])){
                            if( isset($room_dates_metas[$date]['quantity']) && $room_dates_metas[$date]['quantity'] !== '' ) $metas['quantity'] = $room_dates_metas[$date]['quantity'];
                            if( isset($room_dates_metas[$date]['price']) && $room_dates_metas[$date]['price'] !== '' ) $metas['price'] = easybook_addons_get_price( $room_dates_metas[$date]['price'] );
                        }

                        $rooms_datas[] = $metas;
                    }
                    if(!empty($rooms_datas)){
                        if($_show_metas === 'false'){
                            $sum_metas = array();
                        }else{

                            $sum_metas = array(
                                'quantity'      => 0,
                                'price'         => 0,
                            );
                            foreach ($rooms_datas as $rdata) {
                                $sum_metas['quantity'] += $rdata['quantity'];
                                // get min price to display in calendar
                                if( $sum_metas['price'] == 0 || $sum_metas['price'] > $rdata['price'])
                                    $sum_metas['price'] = $rdata['price'];
                            }

                            $sum_metas['html'] =    '<div class="date-metas-inner">'.
                                                    '<span class="date-meta-item">'.__( 'Available:', 'easybook-add-ons' ).
                                                        '<span class="date-meta-item-val">'.$sum_metas['quantity'].'</span>'.
                                                    '</span>'.
                                                    '<span class="date-meta-item">'.__( 'Price:', 'easybook-add-ons' ).
                                                        '<span class="date-meta-item-val">'. sprintf( _x( '%s%s', 'calendar price', 'easybook-add-ons' ), easybook_addons_get_currency_symbol(), $sum_metas['price'] ) .'</span>'.
                                                    '</span>'.
                                                '</div>';

                            $sum_metas['avaiHtml'] = '<span class="avai-cal-meta">'. sprintf( _x( '%s%s', 'calendar price', 'easybook-add-ons' ), easybook_addons_get_currency_symbol(), $sum_metas['price'] ) .'</span>';
                        }
                        $sum_metas = (array)apply_filters( 'cth_rooms_date_metas', $sum_metas );

                        $available[$date] = $sum_metas;
                    }
                }
            }
            $json['available'] = $available;
            $json['check_available'] = true;
            if(empty($hotel_rooms)) $json['check_available'] = false;
            $json['success'] = true;
        }

        wp_send_json($json );
    }

    public function listing_dates(){
        $json = array(
            'success' => false,
            'data' => array(
                'POST'=>$_POST,
            ),
            'debug'     => false
        );

        // $json['listing'] = get_the_ID(); --> not working

        if(isset($_POST['postid']) && $_POST['postid'] != '' ){
            $listing_id = $_POST['postid'];
            $listing_dates = get_post_meta( $listing_id, ESB_META_PREFIX.'listing_dates', true );
            $_show_metas = get_post_meta( $listing_id, ESB_META_PREFIX.'listing_dates_show_metas', true );
            
            $available = array();
            if( isset($_POST['dates']) && !empty($_POST['dates']) ){
                foreach ((array)$_POST['dates'] as $date) {
                    if( false !== strpos($listing_dates, $date) ){
                        if($_show_metas === 'false'){
                            $metas = array();
                        }else{
                            $metas = array();
                            $dprice = easybook_addons_get_price( get_post_meta( $listing_id, '_price', true ) );
                            $listing_dates_metas = get_post_meta( $listing_id, ESB_META_PREFIX.'listing_dates_metas', true );
                            if(isset($listing_dates_metas[$date])){
                                // for price meta
                                if( isset($listing_dates_metas[$date]['price']) ){
                                    if( $listing_dates_metas[$date]['price'] !== '' ){
                                        $dprice = $metas['price'] = easybook_addons_get_price( $listing_dates_metas[$date]['price'] );
                                    }else
                                        $metas['price'] = $dprice;
                                }
                                // for guests meta
                                if( isset($listing_dates_metas[$date]['guests']) ){
                                    if( $listing_dates_metas[$date]['guests'] !== '' ) 
                                        $metas['guests'] = $listing_dates_metas[$date]['guests'];
                                    else
                                        $metas['guests'] = easybook_addons_listing_max_guests($listing_id);
                                }
                                // for price_adult meta
                                if( isset($listing_dates_metas[$date]['price_adult']) ){
                                    if( $listing_dates_metas[$date]['price_adult'] !== '' ) 
                                        $metas['price_adult'] = easybook_addons_get_price( $listing_dates_metas[$date]['price_adult'] );
                                    // else
                                    //     $metas['price_adult'] = 0;
                                }
                                // for guests meta
                                if( isset($listing_dates_metas[$date]['price_children']) ){
                                    if( $listing_dates_metas[$date]['price_children'] !== '' ) 
                                        $metas['price_children'] = easybook_addons_get_price( $listing_dates_metas[$date]['price_children'] );
                                    // else
                                    //     $metas['price_children'] = 0;
                                }
                                if( isset($listing_dates_metas[$date]['price_infant']) ){
                                    if( $listing_dates_metas[$date]['price_infant'] !== '' ) 
                                        $metas['price_infant'] = easybook_addons_get_price( $listing_dates_metas[$date]['price_infant'] );
                                    // else
                                    //     $metas['price_infant'] = 0;
                                }

                                $metas['html'] =    '<div class="date-metas-inner">';
                                if(isset($metas['guests'])) 
                                    $metas['html'] .= '<span class="date-meta-item">'.__( 'Max guests:', 'easybook-add-ons' ).
                                                            '<span class="date-meta-item-val">'.$metas['guests'].'</span>'.
                                                        '</span>';
                                if(isset($metas['price'])) 
                                    $metas['html'] .= '<span class="date-meta-item">'.__( 'Price:', 'easybook-add-ons' ).
                                                            '<span class="date-meta-item-val">'. sprintf( _x( '%s%s', 'calendar price', 'easybook-add-ons' ), easybook_addons_get_currency_symbol(), $metas['price'] ) .'</span>'.
                                                        '</span>';
                                if(isset($metas['price_adult'])) 
                                    $metas['html'] .= '<span class="date-meta-item">'.__( 'Adult:', 'easybook-add-ons' ).
                                                            '<span class="date-meta-item-val">'. sprintf( _x( '%s%s', 'calendar price', 'easybook-add-ons' ), easybook_addons_get_currency_symbol(), $metas['price_adult'] ) .'</span>'.
                                                        '</span>';
                                if(isset($metas['price_children'])) 
                                    $metas['html'] .= '<span class="date-meta-item">'.__( 'Children:', 'easybook-add-ons' ).
                                                            '<span class="date-meta-item-val">'. sprintf( _x( '%s%s', 'calendar price', 'easybook-add-ons' ), easybook_addons_get_currency_symbol(), $metas['price_children'] ) .'</span>'.
                                                        '</span>';
                                if(isset($metas['price_infant'])) 
                                    $metas['html'] .= '<span class="date-meta-item">'.__( 'Infant:', 'easybook-add-ons' ).
                                                            '<span class="date-meta-item-val">'. sprintf( _x( '%s%s', 'calendar price', 'easybook-add-ons' ), easybook_addons_get_currency_symbol(), $metas['price_infant'] ) .'</span>'.
                                                        '</span>';

                                $metas['html'] .= '</div>';
                            }

                            

                                

                            $metas['avaiHtml'] = '<span class="avai-cal-meta">'. sprintf( _x( '%s%s', 'calendar price', 'easybook-add-ons' ), easybook_addons_get_currency_symbol(), $dprice ) .'</span>';

                        }
                        $metas = (array)apply_filters( 'cth_listing_date_metas', $metas );

                        $available[$date] = $metas;
                    }
                }
            }
            $json['available'] = $available;
            
            $json['check_available'] = true;
            if($listing_dates == '') $json['check_available'] = false;
            $json['success'] = true;
        }

        wp_send_json($json );
    }

    




}

new Esb_Class_Booking_CPT();


