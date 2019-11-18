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
$azp_mID = $el_id = $el_class = $hide_widget_on = $title = $dformat = $tformat = $ticon = $dlabel = $tlabel = $sllable = $dicon = ''; 
$checkin_show = $checkout_show = $tpicker_show = $slots_show = $bprice = '';
$adult_show = $adult_lbl = $adult_desc = $child_show = $child_lbl = $child_desc = $infant_show = $infant_lbl = $infant_desc = '';
$show_name = $show_email = $show_phone = $show_notes = '';
// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'inquiry_booking',
    'azp-element-' . $azp_mID, 
    $el_class,
);
// $animation_data = self::buildAnimation($azp_attrs);  
// $classes[] = $animation_data['trigger'];
// $classes[] = self::buildTypography($azp_attrs);//will return custom class for the element without dot 
// $azplgallerystyle = self::buildStyle($azp_attrs);

$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) );

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}

// if(get_post_meta( get_the_ID(), ESB_META_PREFIX.'featured', true ) == 1) return;


if(( $hide_widget_on_check = easybook_addons_is_hide_on_plans($hide_widget_on) ) !== 'true') :

    $symbol_multiple = sprintf( __( '%s<span class="multiplication">x</span>', 'easybook-add-ons' ), easybook_addons_get_currency_symbol() );
    $max_guests = easybook_addons_listing_max_guests();

    $listing_type_id = get_post_meta( get_the_ID(), ESB_META_PREFIX.'listing_type_id', true );
    $bprice = get_post_meta( $listing_type_id, ESB_META_PREFIX.'price_based', true );
    if($bprice === '') $bprice = 'listing';

?>
<div class="<?php echo $classes; ?> authplan-hide-<?php echo $hide_widget_on_check;?>" <?php echo $el_id;?>>
    <div class="for-hide-on-author"></div>
	<div class="box-widget-item fl-wrap" id="inquiry-booking-widget">
	    <?php if($title != ''): ?>
        <div class="box-widget-item-header">
            <h3><?php echo $title; ?></h3>
        </div>
        <?php endif; ?>
	    <div class="box-widget">
	        <div class="box-widget-content">
	            <form method="POST" class="inquiry-booking-formxs custom-form" enctype="multipart/form-data" > 
	                
	                <?php 
	                $is_logged_in = is_user_logged_in();
	                if ( $is_logged_in === false || $show_name === 'yes' ) { ?>
                    <div class="fl-wrap">
	                    <label><i class="fal fa-user"></i></label>
	                    <input name="lb_name" class="has-icon" type="text" placeholder="<?php esc_attr_e( 'Your Name*', 'easybook-add-ons' ); ?>" value="" required="required">
	               </div>
	                <?php } 
	                if ( $is_logged_in === false || $show_email === 'yes' ) { ?>
                    <div class="fl-wrap">
	                    <label><i class="fal fa-envelope"></i></label>
	                    <input name="lb_email" class="has-icon" type="text" placeholder="<?php esc_attr_e( 'Email Address*', 'easybook-add-ons' ); ?>" value="" required="required">
	                </div>
                    <?php } 
	                if ( $is_logged_in === false || $show_phone === 'yes' ) { ?>
                    <div class="fl-wrap">
	                	<label><i class="fal fa-phone"></i></label>
	                    <input name="lb_phone" class="has-icon" type="text" placeholder="<?php esc_attr_e( 'Phone', 'easybook-add-ons' ); ?>" value="" required="required">
	                </div>
                    <?php } ?>
	                    
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
                        
                    </div>
                    <?php } ?>  

                    <?php 
                    if($show_notes == 'yes'): ?> 
                    <textarea name="notes" cols="40" rows="3" placeholder="<?php esc_attr_e( 'Additional Information', 'easybook-add-ons' ); ?>"></textarea>
                    <?php endif; ?>

                    <div class="booking-buttons">
                        <button class="btn big-btn color-bg flat-btn book-btn lbooking-submitxs"  type="submit"><?php esc_html_e( 'Submit', 'easybook-add-ons' ); ?><i class="fal fa-angle-right"></i></button>
                    </div>

                    <input type="hidden" name="listing_id" value="<?php the_ID(); ?>">
                    
                    

	            </form>
	        </div>
	    </div>
	</div>
</div>
<?php endif;

