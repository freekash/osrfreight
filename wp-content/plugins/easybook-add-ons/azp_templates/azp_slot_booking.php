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



//$azp_attrs,$azp_content,$azp_element
$azp_mID = $el_id = $el_class = $hide_widget_on = $wid_title = $dformat = $dlabel = $tlabel = $dicon = ''; 

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_slot_booking',
    'azp-element-' . $azp_mID,
    $el_class,
);
$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) );

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}

// array(5) { ["checkout"]=> string(10) "2018-12-20" ["checkin"]=> string(10) "2018-12-19" ["lb_adults"]=> string(1) "1" ["lb_children"]=> string(1) "0" ["rooms"]=> array(1) { [5174]=> string(1) "2" } }
if(( $hide_widget_on_check = easybook_addons_is_hide_on_plans($hide_widget_on) ) !== 'true') :

// $symbol_multiple = sprintf( __( '%s<span class="multiplication">x</span>', 'easybook-add-ons' ), easybook_addons_get_currency_symbol() );
// $max_guests = easybook_addons_listing_max_guests();
?>
<div class="<?php echo $classes; ?> authplan-hide-<?php echo $hide_widget_on_check;?>" <?php echo $el_id;?>>
    <div class="for-hide-on-author"></div>
	<div class="box-widget-item fl-wrap" id="widget-slot-booking">
	    <?php if($wid_title != ''): ?>
	    <div class="box-widget-item-header">
	        <h3><?php echo $wid_title; ?></h3>
	    </div>
		<?php endif; ?>
	    <div class="slot-booking-inner">
	        <form method="POST" name="esb-slot-booking"> 
	        	<div class="cth-date-picker-wrap esb-field has-icon">
	        		<div class="lfield-header">
		        		<label class="lfield-label"><?php echo esc_html( $dlabel ); ?></label>
                        <span class="lfield-icon"><i class="<?php echo esc_attr( $dicon ); ?>"></i></span>
		        	</div>
					<div class="cth-date-picker" 
						data-name="checkin" 
						data-format="<?php echo $dformat; ?>" 
						data-default=""
						data-action="listing_dates" 
						data-postid="<?php the_ID();?>" 
						data-selected="slot_date"
					></div>
	        	</div>



	        	<?php 
                $slots = get_post_meta( get_the_ID(), ESB_META_PREFIX.'time_slots', true );

                if( !empty($slots) && is_array($slots) ){ ?>
                <div class="time-slots-row">
                	<div class="cth-dropdown-warp">
                        <div class="cth-dropdown-header"><label><?php echo esc_html( $tlabel ); ?></label></div>
                        <div class="cth-dropdown-options">
                            <div class="cth-dropdown-inner">
                                <?php
                                foreach ($slots as $slot) {
                                ?>
                                    <div class="cth-dropdown-item">
                                        <input type="checkbox" id="slot-<?php echo $slot['slot_id'];?>" name='slots[]' value="<?php echo $slot['slot_id'];?>">
                                        <label for="slot-<?php echo $slot['slot_id'];?>"><?php echo $slot['time'];?><span class="cth-dropdown-meta"><?php echo sprintf(__( '<span class="avai-slot-num">%d</span> slots available', 'easybook-add-ons' ), $slot['available'] ); ?></span></label>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
				<?php } ?>

                <?php 
                $lservices = get_post_meta( get_the_ID(), ESB_META_PREFIX.'lservices', true );
                if( !empty($lservices) && is_array($lservices) ){?>
                <div class="lservices-row">
                	<div class="cth-dropdown-warp">
                        <div class="cth-dropdown-header"><label><?php esc_html_e('Extral Services','easybook-add-ons') ?><span class="count-select-ser">0</span></label></div>
                        <div class="cth-dropdown-options">
                            <div class="cth-dropdown-inner">
                                <?php
                                $serprefix = uniqid('lserv');
                                foreach ($lservices as $serv) {
                                	$serv_price = easybook_addons_get_price( $serv['service_price'] );
                                ?>
                                    <div class="cth-dropdown-item lserv-dropdown">
                                        <input type="checkbox" id="<?php echo $serprefix .'-'. $serv['service_id'];?>" name='addservices[]' class="lserv-item-checkbox" data-price="<?php echo $serv_price;?>" value="<?php echo $serv['service_id'];?>">
                                        <label for="<?php echo $serprefix .'-'. $serv['service_id'];?>"><?php echo $serv['service_name'];?><span class="cth-dropdown-meta"><?php echo easybook_addons_get_price_formated( $serv['service_price'] );?></span></label>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <input class="hid-input" type="text" name="item_total" value="0">
                </div>
                <?php } ?>   
                

				<div class="total-coast fl-wrap clearfix">
					<strong><?php _e( 'Total Cost', 'easybook-add-ons' ); ?></strong>
					<span><input class="total-cost-input" type="text" name="grand_total" value="" jAutoCalc="SUM({item_total})"><?php echo easybook_addons_get_currency_symbol(); ?></span>
				</div>

				<div class="booking-buttons">
					<button class="btn btnaplly color2-bg"  type="submit"><?php esc_html_e( 'Book Now', 'easybook-add-ons' ); ?><i class="fal fa-paper-plane"></i></button>
				</div>

	        	<input type="hidden" name="booking_type" value="slot">
	        	<input type="hidden" name="product_id" value="<?php the_ID(); ?>">
	        	<input type="hidden" name="action" value="esb_add_to_cart">
	        	<input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce('easybook-add-to-cart'); ?>">
                
            </form>

	    </div>
	</div>
</div>
<?php
endif; 