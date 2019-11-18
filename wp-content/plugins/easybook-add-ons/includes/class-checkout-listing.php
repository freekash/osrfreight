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



defined( 'ABSPATH' ) || exit;


class Esb_Class_Checkout_Listing extends Esb_Class_Checkout{      
    protected $type = 'booking'; 
    protected $stripe_data = array(); 
    private $data_liting = '';
    public function __construct(){ 
        $this->data_user();
    }
    public function render(){
        $price_total = ESB_ADO()->cart->get_total();
        $cart_details = ESB_ADO()->cart->get_cart_details(); 

        // var_dump($price_total);

        // echo '<pre>';
        // var_dump(get_user_meta ( get_current_user_id()));


        ?>
            <section class="middle-padding gre y-blue-bg">
                <div class="container">
                    <?php if(empty($cart_details)): ?>
                        <div class="list-main-wrap-title single-main-wrap-title fl-wrap"> 
                            <h2><?php _e( 'Your cart is empty', 'easybook-add-ons' ); ?></h2>
                        </div>
                    <?php else: 
                        

                        $first_cart_item = reset($cart_details);

                        $this->stripe_data = array(
                            'amount' => easybook_addons_get_stripe_amount( $price_total ),
                            'plan' => sprintf(__( '%s booking', 'easybook-add-ons' ), $first_cart_item['title'] ),
                            // 'email' => $current_user->user_email,
                            'is_recurring' => false,
                        );

                        

                        $ck_type = !empty($first_cart_item['cart_item_type']) ? $first_cart_item['cart_item_type'] : 'listing_booking';
                        $need_logged_in = ($ck_type === 'listing_booking') ? easybook_addons_get_option('ck_book_logged_in') : easybook_addons_get_option('ck_need_logged_in') ;
                        $need_logged_in = apply_filters( 'esb_checkout_need_logged_in', $need_logged_in,  $ck_type );

                        if( easybook_addons_get_option('ck_show_title') == 'yes' && !empty($first_cart_item['title'])):?>
                            <div class="list-main-wrap-title single-main-wrap-title fl-wrap"> 
                                <h2><?php echo sprintf(__( 'Booking form for: <span>%s</span>', 'easybook-add-ons' ), $first_cart_item['title'] ); ?></h2>
                            </div>
                        <?php 
                        endif; ?>
                        <div class="row">
                            <div class="col-md-8">
                                <?php if( $need_logged_in && !is_user_logged_in() ): ?>
                                <div class="checkout-must-logged-in">
                                    <span class="must-logged-in-msg"><?php _e( 'You must be logged in to checkout.', 'easybook-add-ons' ); ?></span>
                                    <span class="must-logged-in-btn"><a href="#" class="btn-link logreg-modal-open"><?php _e( 'Login or register', 'easybook-add-ons' ); ?></a></span>
                                </div>
                                <!-- .checkout-must-logged-in end -->
                                <?php else: 
                                    $class_cs = '';
                                    if(easybook_addons_get_option('ck_hide_tabs') != 'yes'){
                                        $class_cs = 'bookiing-form-wrap';
                                    }else{
                                         $class_cs = 'bookiings-form-wrap';
                                    }
                                ?>
                                <div class="<?php echo $class_cs;?>">
                                    <?php $this->progressbar(); ?>
                                    <!--   list-single-main-item -->
                                    <div class="list-single-main-item fl-wrap hidden-section tr-sec">
                                        <div class="checkout-form-container">
                                            <div class="custom-form">
                                                <form class="listing-payments-form" id="easybook-checkout-form">

                                                    <?php 
                                                        $this->render_information(); 
                                                        $this->render_billingAddress(); 
                                                        $this->render_payments(); 
                                                        // $this->render_confirm(); 

                                                        if( easybook_addons_get_option('ck_hide_tabs') == 'yes' ){
                                                            $this->render_terms();
                                                            echo '<span class="fw-separator"></span>';
                                                            $this->render_submit(); 
                                                        } 
                                                    ?>
                                                    
                                                    <?php $_wpnonce = wp_create_nonce('esb-checkout-security'); ?>
                                                    <input type="hidden" name="_wpnonce" value="<?php echo $_wpnonce;?>">

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--   list-single-main-item end -->
                                </div>
                                <!-- .bookiing-form-wrap end -->
                                <?php endif; // end check logged in user for checkout ?>
                                <div class="limit-box"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="checkout-fix">
                                    <div class="box-widget-item-header">
                                        <h3><?php _e( 'Your Cart', 'easybook-add-ons' ); ?></h3>
                                    </div>
                                    <!--cart-details  --> 
                                    <div class="cart-details fl-wrap">
                                        <?php $this->render_cart_items($cart_details); ?>
                                    </div>
                                    <!--cart-details end --> 
                                    <!--cart-total --> 
                                    <div class="cart-total">
                                        <span class="cart-total_item_title"><?php esc_html_e( 'Total Cost', 'easybook-add-ons' ); ?></span>
                                        <strong><?php echo easybook_addons_get_price_formated($price_total); ?></strong>                                
                                    </div>
                                    <!--cart-total end -->   
                                </div>                      
                            </div>
                        </div>
                    <?php endif; // check cart data ?>
                </div>
            </section>
            <!-- section end -->

        <?php
    }
    protected function render_cart_items($cart_details = array()){
        foreach ($cart_details as $key => $data) {
            if(isset($data['cart_item_type']) && $data['cart_item_type'] == 'plan') 
                $this->render_cart_item_plan($data, $key);
            elseif(isset($data['cart_item_type']) && $data['cart_item_type'] == 'ad') 
                $this->render_cart_item_ad($data, $key);
            else
                $this->render_cart_item_booking($data, $key);
        }
    }
    protected function render_cart_item_ad($data = array(), $cart_key = ''){
        
        ?>
        <!--cart-details_header--> 
        <div class="cart-listing-details">
            <?php //if($data['thumbnail'] != '') echo $data['thumbnail']; ?>
            <div class="widget-posts-descr">
                <?php echo $data['title']; ?>
            </div>
        </div>
        <!--cart-details_header end--> 
        <!--ccart-details_text-->          
        <div class="cart-details_text">
            <ul class="cart-listi">
                <?php
                if($data['price']): ?>
                <li class="clearfix bk-price"><?php esc_html_e( 'Price', 'easybook-add-ons' ); ?>
                    <div class="cart-dtright">
                        <strong class="plan-quantity"><?php echo sprintf(__(' %d x ','easybook-add-ons'), $data['quantity']); ?></strong>
                        <strong><?php echo easybook_addons_get_price_formated($data['price']); ?></strong>
                    </div>
                </li>   
                <?php endif; ?>
                <?php if (!empty($data['period_text'])): ?>
                    <li class="clearfix bk-period"><?php esc_html_e( 'Period', 'easybook-add-ons' ); ?><div class="cart-dtright"><span class="period-text"><?php echo $data['period_text']; ?></span></div></li>   
                <?php endif ?>
                <?php if (!empty($data['expired'])): ?>
                    <li class="clearfix bk-expired"><?php esc_html_e( 'Expired', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['expired']; ?></div></li>   
                <?php endif ?>
                <?php
                if($data['subtotal_vat']): ?>
                <li class="clearfix bk-taxes"><?php esc_html_e( 'VAT', 'easybook-add-ons' ); ?><div class="cart-dtright"><strong><?php echo easybook_addons_get_price_formated($data['subtotal_vat']); ?></strong></div></li>
                <?php endif; ?>

            </ul>
        </div>
        <!--cart-details_text end --> 
        <?php
    }
    protected function render_cart_item_booking($data = array(), $cart_key = ''){
        
        ?>
        <!--cart-details_header--> 
        <div class="cart-listing-details">
            <?php if($data['thumbnail'] != ''){ ?>
            <a href="<?php echo $data['permalink']; ?>" class="widget-posts-img">
                <?php echo $data['thumbnail']; ?>
            </a>
            <?php } ?>
            <div class="widget-posts-descr">
                <a class="cart-listing-title" href="<?php echo $data['permalink']; ?>" title="<?php echo esc_attr($data['title']); ?>"><?php echo $data['title']; ?></a>
                <!-- <div class="listing-rating card-popup-rainingvis" data-starrating2="4"></div> -->
                <?php if($data['address'] != ''): ?><div class="booking-listing-address"><i class="fas fa-map-marker-alt"></i><?php echo $data['address']; ?></div><?php endif; ?>
            </div>
        </div>
        <!--cart-details_header end--> 
        <?php
            $this->render_cart_item_rooms($data, $cart_key);
            $this->render_cart_event_item($data, $cart_key);
            $this->render_cart_tour_item($data, $cart_key);
            $this->render_cart_slot_item($data, $cart_key);
            $this->render_cart_tpicker_item($data, $cart_key);
            $this->render_cart_rental_item($data, $cart_key);
            $this->render_cart_general_item($data, $cart_key);

            
    }
    protected function render_cart_event_item($data = array(), $cart_key = ''){
        if(!isset($data['qty']) || empty($data['qty']) || !isset($data['lprice']) || empty($data['lprice'])) return;
        ?>
        <div class="cart-details_text">
            <ul class="cart-listi">
                <?php if (!empty($data['date_event'])): ?>
                    <li class="clearfix bk-checkin"><?php esc_html_e( 'Date', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['date_event']; ?></div></li>   
                <?php endif ?>
                <?php if (!empty($data['qty'])): ?>
                    <li class="clearfix bk-checkin"><?php esc_html_e( 'Tickets', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['qty']; ?></div></li>   
                <?php endif ?>
                <?php $this->render_fee_services_coupon($data); ?>
            </ul>
        </div>

        <?php
        $this->render_form_coupon($data['listing_id']);
    }
    protected function render_cart_item_rooms($data = array(), $cart_key = ''){
         // var_dump($data);
        if(!isset($data['rooms']) || empty($data['rooms'])) return;
        ?>
        <!--ccart-details_text-->          
        <div class="cart-details_text">
            <ul class="cart-listi">
                <li class="clearfix"><?php esc_html_e( 'Rooms', 'easybook-add-ons' ); ?>
                    <div class="cart-rooms">
                    <?php 
                    foreach ($data['rooms'] as $rdata) {
                        ?>
                        <div class="cart-room-item"><?php echo $rdata['title'];?> 
                            <div class="cart-room-details">
                                <strong class="room-quantity"><?php echo sprintf(__(' %d x ','easybook-add-ons'), $rdata['quantity']); ?></strong>
                                <strong class="room-price"><?php echo easybook_addons_get_price_formated($rdata['price']); ?></strong>
                            </div>
                        </div>
                        <?php
                    } ?>
                    </div>
                </li>
                <?php if (!empty($data['checkin'])): ?>
                    <li class="clearfix bk-checkin"><?php esc_html_e( 'From', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['checkin']; ?></div></li>   
                <?php endif ?>
                <?php if (!empty($data['checkout'])): ?>
                    <li class="clearfix bk-checkout"><?php esc_html_e( 'To', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['checkout']; ?></div></li>   
                <?php endif ?>
                <?php if ( !empty($data['nights'])): ?>
                    <li class="clearfix bk-nights"><?php esc_html_e( 'Nights', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['nights']; ?></div></li>    
                <?php endif ?>
                <?php if (!empty($data['adults'])): ?>
                    <li class="clearfix bk-adults"><?php esc_html_e( 'Adults', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['adults']; ?></div></li>
                <?php endif ?>
                <?php if (!empty($data['children'])): ?>
                    <li class="clearfix bk-children"><?php esc_html_e( 'Children', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['children']; ?></div></li>
                <?php endif ?>
                <?php if (!empty($data['infants'])): ?>
                    <li class="clearfix bk-infants"><?php esc_html_e( 'Infants', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['infants']; ?></div></li>
                <?php endif ?>
                <?php $this->render_fee_services_coupon($data); ?>
            </ul>
        </div>
        <!--cart-details_text end --> 
      
        <?php
        $this->render_form_coupon($data['listing_id']);
    }
    protected function render_cart_tour_item($data = array(), $cart_key = ''){
         // var_dump($data);
        if(!isset($data['booking_type']) || $data['booking_type'] != 'tour') return;
        ?>
        <!--ccart-details_text-->          
        <div class="cart-details_text">
            <ul class="cart-listi">
                
                <?php if (!empty($data['checkin'])): ?>
                    <li class="clearfix bk-checkin"><?php esc_html_e( 'Departure date', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['checkin']; ?></div></li>   
                <?php endif ?>
                <?php if (!empty($data['checkout'])): ?>
                    <li class="clearfix bk-checkout"><?php esc_html_e( 'To', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['checkout']; ?></div></li>   
                <?php endif ?>
                <?php if (!empty($data['adults'])): ?>
                    <li class="clearfix bk-adults"><?php esc_html_e( 'Adults', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo sprintf(__( '%sx%s', 'easybook-add-ons' ), easybook_addons_get_price_formated($data['adult_price']), $data['adults']); ?></div></li>
                <?php endif ?>
                <?php if (!empty($data['children'])): ?>
                    <li class="clearfix bk-children"><?php esc_html_e( 'Children', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo sprintf(__( '%sx%s', 'easybook-add-ons' ), easybook_addons_get_price_formated($data['children_price']), $data['children']); ?></div></li>
                <?php endif ?>
                <?php if (!empty($data['infants'])): ?>
                    <li class="clearfix bk-infants"><?php esc_html_e( 'Infants', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo sprintf(__( '%sx%s', 'easybook-add-ons' ), easybook_addons_get_price_formated($data['infant_price']), $data['infants']); ?></div></li>
                <?php endif ?>
                <?php $this->render_fee_services_coupon($data); ?>
            </ul>
        </div>
        <!--cart-details_text end --> 
      
        <?php
        $this->render_form_coupon($data['listing_id']);
    }
    protected function render_cart_slot_item($data = array(), $cart_key = ''){
        if(!isset($data['booking_type']) || $data['booking_type'] != 'slot') return;
        ?>
        <!--ccart-details_text-->          
        <div class="cart-details_text">
            <ul class="cart-listi">
                <?php if (!empty($data['checkin'])): ?>
                    <li class="clearfix bk-checkin"><?php esc_html_e( 'Checkin', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['checkin']; ?></div></li>   
                <?php endif ?>
                <?php if (!empty($data['checkout'])): ?>
                    <li class="clearfix bk-checkout"><?php esc_html_e( 'Checkout', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['checkout']; ?></div></li>   
                <?php endif ?>
                <?php if (!empty($data['slots'])): ?>
                    <li class="clearfix bk-slots"><?php esc_html_e( 'Time Slots', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo implode("<br />", $data['slots'] ); ?></div></li>
                <?php endif ?>
                
                <?php $this->render_fee_services_coupon($data); ?>
            </ul>
        </div>
        <!--cart-details_text end --> 
        <?php
        $this->render_form_coupon($data['listing_id']);
    }

    protected function render_cart_tpicker_item($data = array(), $cart_key = ''){
        if(!isset($data['booking_type']) || $data['booking_type'] != 'tpicker') return;
        ?>
        <!--ccart-details_text-->          
        <div class="cart-details_text">
            <ul class="cart-listi">
                <?php if (!empty($data['checkin'])): ?>
                    <li class="clearfix bk-checkin"><?php esc_html_e( 'Checkin', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['checkin']; ?></div></li>   
                <?php endif ?>
                <?php if (!empty($data['checkout'])): ?>
                    <li class="clearfix bk-checkout"><?php esc_html_e( 'Checkout', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['checkout']; ?></div></li>   
                <?php endif ?>
                <?php if (!empty($data['times'])): ?>
                    <li class="clearfix bk-times"><?php esc_html_e( 'Times', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo implode("<br />", $data['times'] ); ?></div></li>
                <?php endif ?>
                <?php if (!empty($data['adults'])): ?>
                    <li class="clearfix bk-adults"><?php esc_html_e( 'Adults', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo sprintf(__( '%sx%s', 'easybook-add-ons' ), easybook_addons_get_price_formated($data['adult_price']), $data['adults']); ?></div></li>
                <?php endif ?>
                <?php if (!empty($data['children'])): ?>
                    <li class="clearfix bk-children"><?php esc_html_e( 'Children', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo sprintf(__( '%sx%s', 'easybook-add-ons' ), easybook_addons_get_price_formated($data['children_price']), $data['children']); ?></div></li>
                <?php endif ?>
                <?php if (!empty($data['infants'])): ?>
                    <li class="clearfix bk-infants"><?php esc_html_e( 'Infants', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo sprintf(__( '%sx%s', 'easybook-add-ons' ), easybook_addons_get_price_formated($data['infant_price']), $data['infants']); ?></div></li>
                <?php endif ?>
                <?php $this->render_fee_services_coupon($data); ?>
            </ul>
        </div>
        <!--cart-details_text end --> 
        <?php
        $this->render_form_coupon($data['listing_id']);
    }

    protected function render_cart_rental_item($data = array(), $cart_key = ''){
         // var_dump($data);
        if(!isset($data['booking_type']) || $data['booking_type'] != 'rental') return;
        ?>
        <!--ccart-details_text-->          
        <div class="cart-details_text">
            <ul class="cart-listi">
                
                <?php if (!empty($data['checkin'])): ?>
                    <li class="clearfix bk-checkin"><?php esc_html_e( 'From', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['checkin']; ?></div></li>   
                <?php endif ?>
                <?php if (!empty($data['checkout'])): ?>
                    <li class="clearfix bk-checkout"><?php esc_html_e( 'To', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['checkout']; ?></div></li>   
                <?php endif ?>
                <?php if ( !empty($data['nights'])): ?>
                    <li class="clearfix bk-nights"><?php esc_html_e( 'Nights', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['nights']; ?></div></li>    
                <?php endif ?>
                <?php if (!empty($data['adults'])): ?>
                    <li class="clearfix bk-adults"><?php esc_html_e( 'Adults', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['adults']; ?></div></li>
                <?php endif ?>
                <?php if (!empty($data['children'])): ?>
                    <li class="clearfix bk-children"><?php esc_html_e( 'Children', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['children']; ?></div></li>
                <?php endif ?>
                <?php if (!empty($data['infants'])): ?>
                    <li class="clearfix bk-infants"><?php esc_html_e( 'Infants', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['infants']; ?></div></li>
                <?php endif ?>
                <?php $this->render_fee_services_coupon($data); ?>
            </ul>
        </div>
        <!--cart-details_text end --> 
      
        <?php
        $this->render_form_coupon($data['listing_id']);
    }

    protected function render_cart_general_item($data = array(), $cart_key = ''){
         // var_dump($data);
        if(!isset($data['booking_type']) || $data['booking_type'] != 'general') return;

        // 
        ?>
        <!--ccart-details_text-->          
        <div class="cart-details_text">
            <ul class="cart-listi">
                
                <?php if (!empty($data['checkin'])): ?>
                    <li class="clearfix bk-checkin">
                        <div class="bkdates-dates">
                            <?php esc_html_e( 'Dates', 'easybook-add-ons' ); ?>
                            <div class="cart-dtright">
                                <?php echo easybook_addons_booking_date( $data['checkin'], get_option('date_format') ); ?>
                                <?php if(!empty($data['checkout'])) echo esc_html__( ' - ', 'easybook-add-ons' ) . easybook_addons_booking_date( $data['checkout'], get_option('date_format') ); ?>
                            </div>
                        </div>
                        <div class="bkdates-details">
                            
                    
                        <?php if (!empty($data['day_prices'])){
                            foreach ($data['day_prices'] as $dte => $pri) {
                                echo '<div class="bkdates-date">';
                                    echo easybook_addons_booking_date( easybook_addons_format_cal_date($dte), get_option('date_format') );
                                    echo '<div class="bkdates-date-detail">';
                                    
                                        echo easybook_addons_get_price_formated($pri) ;

                                    echo '</div>';
                                echo '</div>';
                            }
                        } ?>

                        <?php if (!empty($data['adult_prices'])){
                            foreach ($data['adult_prices'] as $dte => $pri) {
                                echo '<div class="bkdates-date">';
                                    echo easybook_addons_booking_date( easybook_addons_format_cal_date($dte), get_option('date_format') );
                                    echo '<div class="bkdates-date-detail">';
                                    
                                        echo sprintf(__( '<div class="bkdates-date-adult"><span>Adult:</span> %s x <strong>%s</strong></div>', 'easybook-add-ons' ), $data['adults'], easybook_addons_get_price_formated($pri) );
                                        if(isset($data['children_prices'][$dte])) 
                                            echo sprintf(__( '<div class="bkdates-date-children"><span>Children:</span> %s x <strong>%s</strong></div>', 'easybook-add-ons' ), $data['children'], easybook_addons_get_price_formated( $data['children_prices'][$dte] ) );
                                        if(isset($data['infant_prices'][$dte])) 
                                            echo sprintf(__( '<div class="bkdates-date-infant"><span>Infant:</span> %s x <strong>%s</strong></div>', 'easybook-add-ons' ), $data['infants'], easybook_addons_get_price_formated( $data['infant_prices'][$dte] ) );

                                    echo '</div>';
                                echo '</div>';


                            }
                        } ?>

                        </div>

                    </li>   
                <?php endif ?>

                        

                        


                <?php if ( isset($data['price_based']) && ( $data['price_based'] == 'per_day' || $data['price_based'] == 'day_person' ) && !empty($data['days'])): ?>
                    <li class="clearfix bk-days"><?php esc_html_e( 'Days', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['days']; ?></div></li>    
                <?php endif ?>

                <?php if (!empty($data['slots'])): ?>
                    <li class="clearfix bk-slots"><?php esc_html_e( 'Time Slots', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo implode("<br />", $data['slots'] ); ?></div></li>
                <?php endif ?>

                <?php if (!empty($data['times'])): ?>
                    <li class="clearfix bk-times"><?php esc_html_e( 'Times', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo implode("<br />", $data['times'] ); ?></div></li>
                <?php endif ?>

                <?php if ( isset($data['price_based']) && ( $data['price_based'] == 'per_night' || $data['price_based'] == 'night_person' ) && !empty($data['nights'])): ?>
                    <li class="clearfix bk-nights"><?php esc_html_e( 'Nights', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['nights']; ?></div></li>    
                <?php endif ?>
                <?php if ( isset($data['price_based']) && ( $data['price_based'] == 'per_day' || $data['price_based'] == 'per_night' ) ): ?>
                    <?php if (!empty($data['adults'])): ?>
                        <li class="clearfix bk-adults"><?php esc_html_e( 'Adults', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['adults']; ?></div></li>
                    <?php endif ?>
                    <?php if (!empty($data['children'])): ?>
                        <li class="clearfix bk-children"><?php esc_html_e( 'Children', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['children']; ?></div></li>
                    <?php endif ?>
                    <?php if (!empty($data['infants'])): ?>
                        <li class="clearfix bk-infants"><?php esc_html_e( 'Infants', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['infants']; ?></div></li>
                    <?php endif ?>
                <?php endif ?>
                <?php $this->render_fee_services_coupon($data); ?>
            </ul>
        </div>
        <!--cart-details_text end --> 
      
        <?php
        // echo '<pre>';
        // var_dump($data);
        $this->render_form_coupon($data['listing_id']);
    }

    


    protected function render_fee_services_coupon($data){
        if(!empty($data['subtotal_fee'])): ?>
        <li class="clearfix bk-fees"><?php esc_html_e( 'Service fee', 'easybook-add-ons' ); ?><div class="cart-dtright"><strong><?php echo easybook_addons_get_price_formated($data['subtotal_fee']); ?></strong></div></li>
        <?php endif; ?>
        <?php if(!empty($data['addservices'])): ?>
            <li class="clearfix bk-addservices"><?php esc_html_e( 'Services:', 'easybook-add-ons' ); ?>
                <ul >
                <?php
                $listing_id = $data['listing_id'] != '' ? $data['listing_id'] : 0;
                $services = get_post_meta($listing_id, ESB_META_PREFIX.'lservices', true);
                    if(isset($services) && is_array($services) && $services!= '') {
                       $value_key_ser  = array();
                        $value_serv = array();
                        $addservices = $data['addservices'] != '' ? $data['addservices'] : array();
                        foreach ($addservices  as $key => $item_serv) {
                            // var_dump($item_serv);
                            $value_key_ser[]  = array_search($item_serv,array_column($services,  'service_id'));
                        }
                        foreach ($value_key_ser as $key => $value) {
                             $value_serv[] = $services[$value];
                        } 
                        foreach ($value_serv as $key => $value) {
                            ?>
                            <li><?php echo sprintf(__('%1$s <div class="cart-dtright">%2$s</div>', 'easybook-add-ons'),$value['service_name'],easybook_addons_get_price_formated($value['service_price'])); ?></li>
                       <?php }
                    } ?>
                </ul>
            </li>
        <?php endif; ?>
        <?php
        if(!empty($data['subtotal_vat'])): ?>
        <li class="clearfix bk-taxes"><?php esc_html_e( 'VAT', 'easybook-add-ons' ); ?><div class="cart-dtright"><strong><?php echo easybook_addons_get_price_formated($data['subtotal_vat']); ?></strong></div></li>
        <?php endif; ?>
        <?php if (!empty($data['amount_of_discount']) && $data['amount_of_discount'] != ''): ?>
            <li class="clearfix bk-infants"><?php esc_html_e( 'Amount of discount', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo easybook_addons_get_price_formated( $data['amount_of_discount']); ?></div></li>
        <?php endif;
    }
    protected function render_form_coupon($listing_id = 0){?>

          <div class="cart-listing-details coupon-warp custom-form">
            <form action="" method="post" accept-charset="utf-8" class="coupons-code-content">
                <div class="row">
                    <div class="col-md-6">
                        <label for="coupons_code"><?php esc_html_e( 'Coupon:', 'easybook-add-ons' ); ?></label> 
                        <?php 
                        $cart_coupon = ESB_ADO()->cart->get_coupon_code();
                        ?>
                        <input type="text" name="coupon_code" class="coupons-code" id="coupons_code" value="<?php echo esc_attr( $cart_coupon ); ?>" placeholder="<?php esc_attr_e( 'Coupon code','easybook-add-ons' ); ?>">

                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="button"><?php esc_html_e( 'Apply coupon', 'easybook-add-ons' ); ?></button>
                        <input type="hidden" name="action" value="esb_add_to_coupon"/>
                        <input type="hidden" name="lid" value="<?php echo $listing_id;?>"/>
                        <input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce( 'easybook-add-to-coupon' ); ?>"> 
                    </div>
                    <div id="message-coupon"></div>
                </div>
            </form>
        </div>
        <?php
    }
    protected function render_cart_item_plan($data = array(), $cart_key = ''){
        // var_dump($data);
        // array(20) { ["quantity"]=> int(1) ["key"]=> string(19) "checkout_individual" ["product_id"]=> int(2320) ["cart_item_type"]=> string(4) "plan" ["price"]=> string(6) "149.00" ["limit"]=> string(1) "1" ["unlimited"]=> string(2) "on" ["interval"]=> string(1) "1" ["period"]=> string(5) "month" ["never_expire"]=> string(2) "on" ["is_recurring"]=> string(0) "" ["trial_interval"]=> string(1) "0" ["trial_period"]=> string(3) "day" ["permalink"]=> string(59) "http://localhost:8888/wpclean/plan/professional-membership/" ["thumbnail"]=> string(0) "" ["title"]=> string(12) "Professional" ["address"]=> string(0) "" ["subtotal"]=> float(149) ["subtotal_vat"]=> float(14.9) ["price_total"]=> float(163.9) }
        ?>
        <!--cart-details_header--> 
        <div class="cart-listing-details">
            <?php if($data['thumbnail'] != ''){ ?>
            <a href="<?php echo $data['permalink']; ?>" class="widget-posts-img">
                <?php echo $data['thumbnail']; ?>
            </a>
            <?php } ?>
            <div class="widget-posts-descr">
                <?php echo $data['title']; ?>
                <div class="subtitle"><?php _e( 'Membership plan', 'easybook-add-ons' ); ?></div>
            </div>
        </div>
        <!--cart-details_header end--> 
        <!--ccart-details_text-->          
        <div class="cart-details_text">
            <ul class="cart-listi">
                <?php
                if($data['price']): ?>
                <li class="clearfix bk-price"><?php esc_html_e( 'Price', 'easybook-add-ons' ); ?>
                    <div class="cart-dtright">
                        <strong class="plan-quantity"><?php echo sprintf(__(' %d x ','easybook-add-ons'), $data['quantity']); ?></strong>
                        <strong><?php echo easybook_addons_get_price_formated($data['price']); ?></strong>
                    </div>
                </li>   
                <?php endif; ?>
                <?php if (!empty($data['limit_text'])): ?>
                    <li class="clearfix bk-limit"><?php esc_html_e( 'Listings Limit', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['limit_text']; ?></div></li>   
                <?php endif ?>
                <?php if (!empty($data['author_fee'])): ?>
                    <li class="clearfix bk-author-fee"><?php esc_html_e( 'Author Fee', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo sprintf(__( '%s %%', 'easybook-add-ons' ), $data['author_fee']); ?></div></li>   
                <?php endif ?>
                <?php if (!empty($data['period_text'])): ?>
                    <li class="clearfix bk-period"><?php esc_html_e( 'Period', 'easybook-add-ons' ); ?><div class="cart-dtright"><span class="period-text"><?php echo $data['period_text']; ?></span></div></li>   
                <?php endif ?>
                <?php if (!empty($data['expired'])): ?>
                    <li class="clearfix bk-expired"><?php esc_html_e( 'Expired', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['expired']; ?></div></li>   
                <?php endif ?>
                <?php if (!empty($data['trial_text'])): ?>
                    <li class="clearfix bk-trial"><?php esc_html_e( 'Trial', 'easybook-add-ons' ); ?><div class="cart-dtright"><?php echo $data['trial_text']; ?></div></li>   
                <?php endif ?>
                <?php
                if($data['subtotal_vat']): ?>
                <li class="clearfix bk-taxes"><?php esc_html_e( 'VAT', 'easybook-add-ons' ); ?><div class="cart-dtright"><strong><?php echo easybook_addons_get_price_formated($data['subtotal_vat']); ?></strong></div></li>
                <?php endif; ?>

            </ul>
        </div>
        <!--cart-details_text end --> 
        <?php
    }

    protected function render_terms(){
        if(easybook_addons_get_option('ck_agree_terms') != 'yes') return;
        ?>
        <div class="ck-form-item ck-form-terms"> 
            <label class="flex-items-center">
                <div class="ck-validate-field">
                    <input class="check" value="1" name="term_condition" type="checkbox" required/>
                </div>
                <div class="ck-terms-text"><?php echo easybook_addons_get_option('ck_terms');?></div>
            </label>
        </div>
        <?php
    }
}