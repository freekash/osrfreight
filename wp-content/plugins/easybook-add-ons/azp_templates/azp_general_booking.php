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
$azp_mID = $el_id = $el_class = $hide_widget_on = $wid_title = $dformat = $tformat = $ticon = $dlabel = $tlabel = $sllable = $dicon = ''; 
$checkin_show = $checkout_show = $tpicker_show = $slots_show = $bprice = '';
$adult_show = $adult_lbl = $adult_desc = $child_show = $child_lbl = $child_desc = $infant_show = $infant_lbl = $infant_desc = '';
// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_general_booking',
    'azp-element-' . $azp_mID,
    $el_class,
);
$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) );

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}

// array(5) { ["checkout"]=> string(10) "2018-12-20" ["checkin"]=> string(10) "2018-12-19" ["lb_adults"]=> string(1) "1" ["lb_children"]=> string(1) "0" ["rooms"]=> array(1) { [5174]=> string(1) "2" } }
if(( $hide_widget_on_check = easybook_addons_is_hide_on_plans($hide_widget_on) ) !== 'true') :

$symbol_multiple = sprintf( __( '%s<span class="multiplication">x</span>', 'easybook-add-ons' ), easybook_addons_get_currency_symbol() );
$max_guests = easybook_addons_listing_max_guests();
?>
<div class="<?php echo $classes; ?> authplan-hide-<?php echo $hide_widget_on_check;?>" <?php echo $el_id;?>>
    <div class="for-hide-on-author"></div>
	<div class="box-widget-item fl-wrap" id="widget-general-booking">
	    <?php if($wid_title != ''): ?>
	    <div class="box-widget-item-header">
	        <h3><?php echo $wid_title; ?></h3>
	    </div>
		<?php endif; ?>
	    <div class="general-booking-inner">
	        <form method="POST" name="esb-general-booking"> 
                <?php if( $checkin_show === '1' && $checkout_show === '1' ): ?>
                <div class="cth-daterange-picker"
                    data-name="checkin" 
                    data-name2="checkout" 
                    data-format="<?php echo $dformat; ?>" 
                    data-default="current"
                    data-label="<?php echo esc_attr( $dlabel ); ?>" 
                    data-icon="<?php echo $dicon;?>" 
                    data-selected="general_daterange"
                ></div>
                
                <?php elseif( $checkin_show === '1' ): ?>
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
						data-selected="general_date"
					></div>
	        	</div>
                <?php endif; ?>

                <div class="price-days-nights hid-input">
                    <input class="hid-input jscal-nights" readonly="readonly" type="text" name="nights" value="1">
                    <input class="hid-input jscal-days" readonly="readonly" type="text" name="days" value="1">
                    <input class="hid-input jscal-price" readonly="readonly" type="text" name="lprice" value="<?php echo easybook_addons_get_price( get_post_meta( get_the_ID(), '_price', true ) ); ?>">
                
                    <?php if($bprice == 'per_night'): ?>
                        <input class="hid-input" type="text" name="item_total" value="" jAutoCalc="{nights} * {lprice}">
                    <?php endif; ?>
                    <?php if($bprice == 'per_day'): ?>
                        <input class="hid-input" type="text" name="item_total" value="" jAutoCalc="{days} * {lprice}">
                    <?php endif; ?>
                </div>
                
                <?php if($tpicker_show === '1'): ?>
                <label class="tpicker-label"><?php echo esc_html( $tlabel ); ?></label>
                <div class="cth-time-picker booking-time-picker" data-name="times[]" data-format="<?php echo $tformat; ?>" data-icon="<?php echo esc_attr( $ticon ); ?>"></div>
		        <?php endif; ?>

                <?php 
                if($slots_show === '1'):
                $slots = get_post_meta( get_the_ID(), ESB_META_PREFIX.'time_slots', true );

                if( !empty($slots) && is_array($slots) ){ ?>
                <div class="time-slots-row">
                    <div class="cth-dropdown-warp">
                        <div class="cth-dropdown-header"><label><span><?php echo esc_html( $sllable ); ?></span><span class="slot-selected"></span></label></div>
                        <div class="cth-dropdown-options">
                            <div class="cth-dropdown-inner">
                                <?php
                                foreach ($slots as $slot) {
                                ?>
                                    <div class="cth-dropdown-item">
                                        <input type="checkbox" id="slot-<?php echo $slot['slot_id'];?>" name='slots[]' value="<?php echo $slot['slot_id'];?>" data-slot="<?php echo esc_attr( $slot['time'] );?>">
                                        <label for="slot-<?php echo $slot['slot_id'];?>"><?php echo $slot['time'];?><span class="cth-dropdown-meta"><?php echo sprintf(__( '<span class="avai-slot-num">%d</span> slots available', 'easybook-add-ons' ), $slot['available'] ); ?></span></label>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } 
                endif; ?>

                <?php if($adult_show === '1'): ?>
                <div class="qtt-item qtt-item-full qtt-item-js fl-wrap m-b20">
                    <div class="qtt-label-wrap">
                        <?php if($adult_lbl != ''): ?><label class="qtt-label"><?php echo $adult_lbl; ?></label><?php endif; ?>
                        <?php if($adult_desc != ''): ?><span><?php echo $adult_desc; ?></span><?php endif; ?>
                    </div>
                    <?php if( $bprice == 'per_person' || $bprice == 'night_person' || $bprice == 'day_person' ): ?>
                    <div class="qtt-price text-right">
                        <input class="hids-input jscal-price" readonly="readonly" type="text" name="price_adult" value="<?php echo easybook_addons_get_price( get_post_meta( get_the_ID(), '_price', true ) ); ?>"><?php echo $symbol_multiple; ?>
                    </div>
                    <?php endif; ?>
                    <div class="qtt-input">
                        <input type="number" name="adults" min="0" max="<?php echo $max_guests; ?>" step="1" value="1">
                        <div class="qtt-nav">
                            <div class="qtt-btn qtt-up">+</div>
                            <div class="qtt-btn qtt-down">-</div>
                        </div>
                    </div>
                    <?php if( $bprice == 'per_person' ): ?>
                    <input class="hid-input" type="text" name="item_total" value="" jAutoCalc="{adults} * {price_adult}">
                    <?php elseif( $bprice == 'night_person' ): ?>
                    <input class="hid-input" type="text" name="item_total" value="" jAutoCalc="{adults} * {price_adult} * {nights}">
                    <?php elseif( $bprice == 'day_person' ): ?>
                    <input class="hid-input" type="text" name="item_total" value="" jAutoCalc="{adults} * {price_adult} * {days}">
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <?php if($child_show === '1'): ?>
                <div class="qtt-item qtt-item-full qtt-item-js fl-wrap m-b20">
                    <div class="qtt-label-wrap">
                        <?php if($child_lbl != ''): ?><label class="qtt-label"><?php echo $child_lbl; ?></label><?php endif; ?>
                        <?php if($child_desc != ''): ?><span><?php echo $child_desc; ?></span><?php endif; ?>
                    </div>
                    <?php if( $bprice == 'per_person' || $bprice == 'night_person' || $bprice == 'day_person' ): ?>
                    <div class="qtt-price text-right">
                        <input class="hids-input jscal-price" readonly="readonly" type="text" name="price_children" value="<?php echo easybook_addons_get_price( get_post_meta( get_the_ID(), ESB_META_PREFIX .'children_price', true ) ); ?>"><?php echo $symbol_multiple; ?>
                    </div>
                    <?php endif; ?>
                    <div class="qtt-input">
                        <input type="number" name="children" min="0" max="<?php echo $max_guests; ?>" step="1" value="0">
                        <div class="qtt-nav">
                            <div class="qtt-btn qtt-up">+</div>
                            <div class="qtt-btn qtt-down">-</div>
                        </div>
                    </div>

                    <?php if( $bprice == 'per_person' ): ?>
                    <input class="hid-input" type="text" name="item_total" value="" jAutoCalc="{children} * {price_children}">
                    <?php elseif( $bprice == 'night_person' ): ?>
                    <input class="hid-input" type="text" name="item_total" value="" jAutoCalc="{children} * {price_children} * {nights}">
                    <?php elseif( $bprice == 'day_person' ): ?>
                    <input class="hid-input" type="text" name="item_total" value="" jAutoCalc="{children} * {price_children} * {days}">
                    <?php endif; ?>

                </div>
                <?php endif; ?>
                <?php if($infant_show === '1'): ?>
                <div class="qtt-item qtt-item-full qtt-item-js fl-wrap m-b20">
                    <div class="qtt-label-wrap">
                        <?php if($infant_lbl != ''): ?><label class="qtt-label"><?php echo $infant_lbl; ?></label><?php endif; ?>
                        <?php if($infant_desc != ''): ?><span><?php echo $infant_desc; ?></span><?php endif; ?>
                    </div>
                    <?php if( $bprice == 'per_person' || $bprice == 'night_person' || $bprice == 'day_person' ): ?>
                    <div class="qtt-price text-right">
                        <input class="hids-input jscal-price" readonly="readonly" type="text" name="price_infant" value="<?php echo easybook_addons_get_price( get_post_meta( get_the_ID(), ESB_META_PREFIX .'infant_price', true ) ); ?>"><?php echo $symbol_multiple; ?>
                    </div>
                    <?php endif; ?>
                    <div class="qtt-input">
                        <input type="number" name="infants" min="0" max="<?php echo $max_guests; ?>" step="1" value="0">
                        <div class="qtt-nav">
                            <div class="qtt-btn qtt-up">+</div>
                            <div class="qtt-btn qtt-down">-</div>
                        </div>
                    </div>

                    <?php if( $bprice == 'per_person' ): ?>
                    <input class="hid-input" type="text" name="item_total" value="" jAutoCalc="{infants} * {price_infant}">
                    <?php elseif( $bprice == 'night_person' ): ?>
                    <input class="hid-input" type="text" name="item_total" value="" jAutoCalc="{infants} * {price_infant} * {nights}">
                    <?php elseif( $bprice == 'day_person' ): ?>
                    <input class="hid-input" type="text" name="item_total" value="" jAutoCalc="{infants} * {price_infant} * {days}">
                    <?php endif; ?>

                </div>
                <?php endif; ?>


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
                
                <?php if( $bprice != 'none' ): ?>
				<div class="total-coast fl-wrap clearfix">
					<strong><?php _e( 'Total Cost', 'easybook-add-ons' ); ?></strong>
					<span><input class="total-cost-input" type="text" name="grand_total" value="" jAutoCalc="SUM({item_total})"><?php echo easybook_addons_get_currency_symbol(); ?></span>
				</div>
                <?php endif; ?>
				<div class="booking-buttons">
					<button class="btn btnaplly color2-bg"  type="submit"><?php esc_html_e( 'Book Now', 'easybook-add-ons' ); ?><i class="fal fa-paper-plane"></i></button>
				</div>

                <input type="hidden" name="booking_type" value="general">
	        	<input type="hidden" name="price_based" value="<?php echo esc_attr( $bprice ); ?>">
	        	<input type="hidden" name="product_id" value="<?php the_ID(); ?>">
	        	<input type="hidden" name="action" value="esb_add_to_cart">
	        	<input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce('easybook-add-to-cart'); ?>">
                
            </form>

	    </div>
	</div>
</div>
<?php
endif; 