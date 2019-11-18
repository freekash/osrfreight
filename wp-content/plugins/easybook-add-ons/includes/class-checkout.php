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


class Esb_Class_Checkout{
    protected $product_id = 0;
    protected $data = array();
    protected $data_user = array( 
        'ID'     => 0, 
        'first_name'     => '', 
        'last_name'     => '',
        'email'         => '',
        'phone'         => '',
        
        'billing_first_name'          => '',
        'billing_last_name'          => '',
        'billing_company'          => '',
        'billing_city'          => '',
        'billing_country'       => '',     
        'billing_address_1'     => '',
        'billing_address_2'     => '',
        'billing_state'         => '',
        'billing_postcode'      => '', 
        'billing_phone'      => '', 
        'billing_email'      => '', 
    ); 

    protected $user_billing = array(
        'billing_first_name'    ,
        'billing_last_name'     ,
        'billing_company'       ,
        'billing_city'          ,
        'billing_country'       ,     
        'billing_address_1'      ,
        'billing_address_2'      ,
        'billing_state'          ,
        'billing_postcode'       , 
        'billing_phone'          , 
        'billing_email'          , 
    ); 

    public function __construct(){
        
    }

    protected function data_user(){
        if(is_user_logged_in()){
            $user_object = wp_get_current_user();
            $this->data_user = array(
                'ID'     => $user_object->ID, 
                'first_name'     => $user_object->first_name, 
                'last_name'     => $user_object->last_name,
                'email'         => get_user_meta($user_object->ID, ESB_META_PREFIX . 'email', true), // $user_object->user_email,
                'phone'         => get_user_meta( $user_object->ID, ESB_META_PREFIX.'phone' , true),
            );

            if(is_array($this->user_billing) && !empty($this->user_billing)){
                foreach ($this->user_billing as $meta_key) {
                    $this->data_user[$meta_key] = get_user_meta( $user_object->ID, $meta_key , true);
                    
                }
            }

        }
    }

    protected function get_data(){
        // if(!isset($this->data)) $this->data = array();
        return $this->data;
    }
    protected function set_data($name, $value){
        $prev = '';
        if(isset($this->data[$name])) $prev = $this->data[$name];
        $this->data[$name] = $value;
        return $prev;
    }

    public function render(){
        echo 'this is checkout parent class'; 
    }

    public function breadcrumb(){
        ?>
        <div class="breadcrumbs-fs fl-wrap">
            <div class="container">
                <?php easybook_addons_breadcrumbs();?>
            </div>
        </div>
        <?php 
    }
    protected function progressbar(){
        if (easybook_addons_get_option('ck_hide_tabs') == 'yes') return;
        $tabs = array();
        if(easybook_addons_get_option('ck_hide_information') != 'yes') $tabs['personal_info'] = __( 'Personal Info', 'easybook-add-ons' );
        if(easybook_addons_get_option('ck_hide_billing') != 'yes') $tabs['user_billing'] = __( 'Billing Address', 'easybook-add-ons' );
        $tabs['payment_methods'] = __( 'Payment Method', 'easybook-add-ons' );
        $tabs['ck_confirm'] = __( 'Confirm', 'easybook-add-ons' );

        $tabs = apply_filters( 'esb_checkout_tab', $tabs );
        ?>
        <ul id="ck-progressbar" class="ck-progress-bar ck-progress-<?php echo count($tabs);?>">
            <?php 
            $count = 1;
            foreach ($tabs as $tab_id => $tab_title) {
                echo '<li class="ck-tab-item'.($count == 1? ' active':'').'" id="ck-tab-'.esc_attr( $tab_id ).'">'.$count . '. '.$tab_title.'</li>';
                $count++;
            } ?>
        </ul>
        <?php
    }
    
    protected function render_information(){
        if(easybook_addons_get_option('ck_hide_information') == 'yes') return;
        ?>
            <fieldset  id="ck-fieldset-personal_info" class="fl-wrap ck-fieldset-item clearfix">
                <?php easybook_addons_get_template_part( 'template-parts/checkout/tab', 'infos', array('user_datas'=> $this->data_user ) );?>
                
                <?php 
                if (easybook_addons_get_option('ck_hide_tabs') != 'yes') {
                    $this->render_terms();
                ?>
                    <span class="fw-separator"></span>
                    <?php 
                    if ( easybook_addons_get_option('ck_hide_billing') == 'yes' && easybook_addons_get_option('ck_hide_payments') == 'yes') {
                        $this->render_submit();
                    }elseif( easybook_addons_get_option('ck_hide_billing') != 'yes' ){ ?>
                        <a  href="#"  class="next-form action-button btn no-shdow-btn color-bg"><?php esc_html_e('Billing Address ', 'easybook-add-ons');?><i class="fal fa-angle-right"></i></a>
                    <?php }elseif( easybook_addons_get_option('ck_hide_payments') != 'yes' ){ ?>
                        <a  href="#"  class="next-form action-button btn no-shdow-btn color-bg"><?php esc_html_e('Payment ', 'easybook-add-ons');?><i class="fal fa-angle-right"></i></a>
                    <?php } ?>
                <?php } ?>

            </fieldset>
        <?php
    }
    protected function render_billingAddress(){
        if(easybook_addons_get_option('ck_hide_billing') == 'yes') return;
        ?>
            <fieldset  id="ck-fieldset-user_billing" class="fl-wrap checkout-required ck-fieldset-item clearfix">
                <?php easybook_addons_get_template_part( 'template-parts/checkout/tab', 'billing', array('user_datas'=> $this->data_user ) );?>
                
                <?php 
                if (easybook_addons_get_option('ck_hide_tabs') != 'yes') {
                    if (easybook_addons_get_option('ck_hide_information') == 'yes') $this->render_terms();
                ?>
                    <span class="fw-separator"></span>
                    <?php 
                    if (easybook_addons_get_option('ck_hide_information') != 'yes') {?>
                        <a  href="#"  class="previous-form action-button back-form color-bg"><i class="fal fa-angle-left"></i><?php esc_html_e('Back', 'easybook-add-ons');?></a>
                    <?php 
                    } ?>
                    <?php 
                    if (easybook_addons_get_option('ck_hide_payments') == 'yes') {
                        $this->render_submit();
                    }else{ ?>
                        <a  href="#"  class="next-form action-button btn no-shdow-btn color-bg"><?php esc_html_e('Payment ', 'easybook-add-ons');?><i class="fal fa-angle-right"></i></a>
                    <?php } ?>
                <?php } ?>
            </fieldset>
        <?php
    }

    protected function render_payments(){
        ?>
        <fieldset id="ck-fieldset-payment_methods" class="fl-wrap ck-fieldset-item clearfix">
            <?php easybook_addons_get_template_part( 'template-parts/checkout/tab', 'payments' );?>
                

            <?php
            if ( easybook_addons_get_option('ck_hide_tabs') != 'yes' ) {
                if( easybook_addons_get_option('ck_hide_information') == 'yes' && easybook_addons_get_option('ck_hide_billing') == 'yes') $this->render_terms();
                echo '<span class="fw-separator"></span>';
                if( easybook_addons_get_option('ck_hide_information') != 'yes' || easybook_addons_get_option('ck_hide_billing') != 'yes'){
            ?>
                
                <a  href="#" class="previous-form action-button back-form color-bg"><i class="fal fa-angle-left"></i><?php _e('Back', 'easybook-add-ons');?></a>
                <?php } ?>
            <?php
                $this->render_submit();
            } ?>

            
            
                                          
        </fieldset> 
        <?php
    }

    public function render_submit(){
        // $this->render_terms();
        ?>
        <button data-payment="<?php echo rawurlencode( json_encode( $this->stripe_data ) ); ?>" class="btn color2-bg lcheckout_btn" type="submit" id="lcheckout_btn"><span class="btn-text"><?php esc_attr_e( 'Place Order', 'easybook-add-ons' ); ?></span><i class="fal fa-angle-right i-for-default"></i><i class="fa fa-spinner fa-pulse i-for-loading"></i></button>


        
        <div class="clearfix"></div>
        <?php
    }

    protected function render_confirm(){
        if(easybook_addons_get_option('ck_hide_tabs') == 'yes') return;
        ?>
            <fieldset class="fl-wrapn ck-fieldset-item clearfix"  id="ck-fieldset-ck_confirm">
                <div class="list-single-main-item-title fl-wrap">
                    <h3><?php _e( 'Confirmation', 'easybook-add-ons' ); ?></h3>
                </div>
                <div class="success-table-container clearfix">
                    <div class="success-table-header fl-wrap">
                        <i class="fal fa-check-circle decsth"></i>
                    <h4><?php _e( 'Thank you. Your reservation has been received.', 'easybook-add-ons' ); ?></h4>
                    <div class="clearfix"></div>
                    <p><?php _e( 'Your payment has been processed successfully.', 'easybook-add-ons' ); ?></p>
                        <a href="#" class="color-bg view-invoice-btn" data-invoice="0"><?php _e( 'View Invoice', 'easybook-add-ons' ); ?></a>
                    </div>
                </div>
                <!-- <span class="fw-separator"></span>
                <a  href="#"  class="previous-form action-button  back-form   color-bg"><i class="fal fa-angle-left"></i> Back</a>-->
            </fieldset>
        <?php
    }


    public function update_user_billing($user_id = 0){
        if($user_id == 0) $user_id = get_current_user_id();
        if($user_id == 0) return;
        if(is_array($this->user_billing) && !empty($this->user_billing)){
            foreach ($this->user_billing as $meta_key) {
                if(isset($_POST[$meta_key]) && $_POST[$meta_key]) update_user_meta( $user_id, $meta_key, $_POST[$meta_key] );
            }
        }
    }


}