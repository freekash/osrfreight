<?php
/* add_ons_php */
/**
 * Settings for PayFast Gateway.
 *
 * @package WooCommerce/Classes/Payment
 */

defined('ABSPATH') || exit;

return array(
    'enabled'      => array(
        'title'   => __('Enable/Disable', 'easybook-woo-payments'),
        'type'    => 'checkbox',
        'label'   => __('Enable PayFast Recurring', 'easybook-woo-payments'),
        'default' => 'no',
    ),
    'title'        => array(
        'title'       => __('Title', 'easybook-woo-payments'),
        'type'        => 'text',
        'description' => __('This controls the title which the user sees during checkout.', 'easybook-woo-payments'),
        'default'     => 'EasyBook PayFast',
        'desc_tip'    => true,
    ),
    'description'  => array(
        'title'       => __('Description', 'easybook-woo-payments'),
        'type'        => 'text',
        'desc_tip'    => true,
        'description' => __('This controls the description which the user sees during checkout.', 'easybook-woo-payments'),
        'default'     => "Pay via PayFast; you can pay with your credit card if you don't have a PayFast account.",
    ),

    'merchant'     => array(
        'title'       => __('Merchant options', 'easybook-woo-payments'),
        'type'        => 'title',
        'description' => '',
    ),

    'merchant_id'  => array(
        'title'       => __('Merchant ID', 'easybook-woo-payments'),
        'type'        => 'text',
        'description' => __('You PayFast merchant id', 'easybook-woo-payments'),
        'default'     => '',
        'desc_tip'    => false,
    ),

    'merchant_key' => array(
        'title'       => __('Merchant Key', 'easybook-woo-payments'),
        'type'        => 'text',
        'description' => __('You PayFast merchant key', 'easybook-woo-payments'),
        'default'     => '',
        'desc_tip'    => false,
    ),

    'passphrase' => array(
        'title'       => __('Merchant passphrase', 'easybook-woo-payments'),
        'type'        => 'text',
        'description' => sprintf( __( 'Enter your PayFast passphrase. Learn how to create your <a href="%s">PayFast passphrase</a>.<br /><a href="%s">WooCommerce PayFast Payment Gateway</a>', 'easybook-woo-payments' ), 'https://support.payfast.co.za/article/120-how-do-i-enable-a-passphrase-on-my-payfast-account', 'https://docs.woocommerce.com/document/payfast-payment-gateway/' ),
        'default'     => '',
        'desc_tip'    => false,
    ),

    'email_confirmation'      => array(
        'title'       => __( 'Email Confirmation?', 'easybook-woo-payments' ),
        'type'        => 'checkbox',
        'label'       => __( 'Enable email confirmation', 'easybook-woo-payments' ),
        'default'     => 'yes',
        'description' => __( 'Whether to send email confirmation to the merchant of the transaction.', 'easybook-woo-payments' ),
    ),
    'confirmation_address'        => array(
        'title'       => __( 'Confirmation Email Address', 'easybook-woo-payments' ),
        'type'        => 'email',
        'description' => __( 'The address to send the confirmation email to.', 'easybook-woo-payments' ),
        'default'     => '',
        'desc_tip'    => true,
        'placeholder' => 'you@youremail.com',
    ),


    'advanced'     => array(
        'title'       => __('Advanced options', 'easybook-woo-payments'),
        'type'        => 'title',
        'description' => '',
    ),
    'testmode'     => array(
        'title'       => __('PayFast sandbox', 'easybook-woo-payments'),
        'type'        => 'checkbox',
        'label'       => __('Enable PayFast sandbox', 'easybook-woo-payments'),
        'default'     => 'no',
        /* translators: %s: URL */
        'description' => sprintf(__('PayFast sandbox can be used to test payments. Sign up for a <a href="%s">developer account</a>.', 'easybook-woo-payments'), 'https://developer.payfast.com/'),
    ),
    'debug'        => array(
        'title'       => __('Debug log', 'easybook-woo-payments'),
        'type'        => 'checkbox',
        'label'       => __('Enable logging', 'easybook-woo-payments'),
        'default'     => 'no',
        /* translators: %s: URL */
        'description' => sprintf(__('Log PayFast events, such as IPN requests, inside %s Note: this may log personal information. We recommend using this for debugging purposes only and deleting the logs when finished.', 'easybook-woo-payments'), '<code>' . WC_Log_Handler_File::get_log_file_path('cth-payfast') . '</code>'),
    ),

);
