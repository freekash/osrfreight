<?php 
/* add_ons_php */
/**
 * Settings for PayPal Gateway.
 *
 * @package WooCommerce/Classes/Payment
 */

defined( 'ABSPATH' ) || exit;

return array(
	'enabled'               => array(
		'title'   => __( 'Enable/Disable', 'easybook-woo-payments' ),
		'type'    => 'checkbox',
		'label'   => __( 'Enable PayPal Standard', 'easybook-woo-payments' ),
		'default' => 'no',
	),
	'title'                 => array(
		'title'       => __( 'Title', 'easybook-woo-payments' ),
		'type'        => 'text',
		'description' => __( 'This controls the title which the user sees during checkout.', 'easybook-woo-payments' ),
		'default'     => __( 'EasyBook PayPal', 'easybook-woo-payments' ),
		'desc_tip'    => true,
	),
	'description'           => array(
		'title'       => __( 'Description', 'easybook-woo-payments' ),
		'type'        => 'text',
		'desc_tip'    => true,
		'description' => __( 'This controls the description which the user sees during checkout.', 'easybook-woo-payments' ),
		'default'     => __( "Pay via PayPal; you can pay with your credit card if you don't have a PayPal account.", 'easybook-woo-payments' ),
	),
	'email'                 => array(
		'title'       => __( 'PayPal email', 'easybook-woo-payments' ),
		'type'        => 'email',
		'description' => __( 'Please enter your PayPal email address; this is needed in order to take payment.', 'easybook-woo-payments' ),
		'default'     => get_option( 'admin_email' ),
		'desc_tip'    => true,
		'placeholder' => 'you@youremail.com',
	),
	'advanced'              => array(
		'title'       => __( 'Advanced options', 'easybook-woo-payments' ),
		'type'        => 'title',
		'description' => '',
	),
	'testmode'              => array(
		'title'       => __( 'PayPal sandbox', 'easybook-woo-payments' ),
		'type'        => 'checkbox',
		'label'       => __( 'Enable PayPal sandbox', 'easybook-woo-payments' ),
		'default'     => 'no',
		/* translators: %s: URL */
		'description' => sprintf( __( 'PayPal sandbox can be used to test payments. Sign up for a <a href="%s">developer account</a>.', 'easybook-woo-payments' ), 'https://developer.paypal.com/' ),
	),
	'debug'                 => array(
		'title'       => __( 'Debug log', 'easybook-woo-payments' ),
		'type'        => 'checkbox',
		'label'       => __( 'Enable logging', 'easybook-woo-payments' ),
		'default'     => 'no',
		/* translators: %s: URL */
		'description' => sprintf( __( 'Log PayPal events, such as IPN requests, inside %s Note: this may log personal information. We recommend using this for debugging purposes only and deleting the logs when finished.', 'easybook-woo-payments' ), '<code>' . WC_Log_Handler_File::get_log_file_path( 'cth-paypal' ) . '</code>' ),
	),
	'ipn_notification'      => array(
		'title'       => __( 'IPN Email Notifications', 'easybook-woo-payments' ),
		'type'        => 'checkbox',
		'label'       => __( 'Enable IPN email notifications', 'easybook-woo-payments' ),
		'default'     => 'yes',
		'description' => __( 'Send notifications when an IPN is received from PayPal indicating refunds, chargebacks and cancellations.', 'easybook-woo-payments' ),
	),
	'receiver_email'        => array(
		'title'       => __( 'Receiver email', 'easybook-woo-payments' ),
		'type'        => 'email',
		'description' => __( 'If your main PayPal email differs from the PayPal email entered above, input your main receiver email for your PayPal account here. This is used to validate IPN requests.', 'easybook-woo-payments' ),
		'default'     => '',
		'desc_tip'    => true,
		'placeholder' => 'you@youremail.com',
	),
	'identity_token'        => array(
		'title'       => __( 'PayPal identity token', 'easybook-woo-payments' ),
		'type'        => 'text',
		'description' => __( 'Optionally enable "Payment Data Transfer" (Profile > Profile and Settings > My Selling Tools > Website Preferences) and then copy your identity token here. This will allow payments to be verified without the need for PayPal IPN.', 'easybook-woo-payments' ),
		'default'     => '',
		'desc_tip'    => true,
		'placeholder' => '',
	),
	'invoice_prefix'        => array(
		'title'       => __( 'Invoice prefix', 'easybook-woo-payments' ),
		'type'        => 'text',
		'description' => __( 'Please enter a prefix for your invoice numbers. If you use your PayPal account for multiple stores ensure this prefix is unique as PayPal will not allow orders with the same invoice number.', 'easybook-woo-payments' ),
		'default'     => 'WC-',
		'desc_tip'    => true,
	),
	'send_shipping'         => array(
		'title'       => __( 'Shipping details', 'easybook-woo-payments' ),
		'type'        => 'checkbox',
		'label'       => __( 'Send shipping details to PayPal instead of billing.', 'easybook-woo-payments' ),
		'description' => __( 'PayPal allows us to send one address. If you are using PayPal for shipping labels you may prefer to send the shipping address rather than billing. Turning this option off may prevent PayPal Seller protection from applying.', 'easybook-woo-payments' ),
		'default'     => 'yes',
	),
	'address_override'      => array(
		'title'       => __( 'Address override', 'easybook-woo-payments' ),
		'type'        => 'checkbox',
		'label'       => __( 'Enable "address_override" to prevent address information from being changed.', 'easybook-woo-payments' ),
		'description' => __( 'PayPal verifies addresses therefore this setting can cause errors (we recommend keeping it disabled).', 'easybook-woo-payments' ),
		'default'     => 'no',
	),
	'paymentaction'         => array(
		'title'       => __( 'Payment action', 'easybook-woo-payments' ),
		'type'        => 'select',
		'class'       => 'wc-enhanced-select',
		'description' => __( 'Choose whether you wish to capture funds immediately or authorize payment only.', 'easybook-woo-payments' ),
		'default'     => 'sale',
		'desc_tip'    => true,
		'options'     => array(
			'sale'          => __( 'Capture', 'easybook-woo-payments' ),
			'authorization' => __( 'Authorize', 'easybook-woo-payments' ),
		),
	),
	'page_style'            => array(
		'title'       => __( 'Page style', 'easybook-woo-payments' ),
		'type'        => 'text',
		'description' => __( 'Optionally enter the name of the page style you wish to use. These are defined within your PayPal account. This affects classic PayPal checkout screens.', 'easybook-woo-payments' ),
		'default'     => '',
		'desc_tip'    => true,
		'placeholder' => __( 'Optional', 'easybook-woo-payments' ),
	),
	'image_url'             => array(
		'title'       => __( 'Image url', 'easybook-woo-payments' ),
		'type'        => 'text',
		'description' => __( 'Optionally enter the URL to a 150x50px image displayed as your logo in the upper left corner of the PayPal checkout pages.', 'easybook-woo-payments' ),
		'default'     => '',
		'desc_tip'    => true,
		'placeholder' => __( 'Optional', 'easybook-woo-payments' ),
	),
	// 'api_details'           => array(
	// 	'title'       => __( 'API credentials', 'easybook-add-ons' ),
	// 	'type'        => 'title',
	// 	/* translators: %s: URL */
	// 	'description' => sprintf( __( 'Enter your PayPal API credentials to process refunds via PayPal. Learn how to access your <a href="%s">PayPal API Credentials</a>.', 'easybook-add-ons' ), 'https://developer.paypal.com/webapps/developer/docs/classic/api/apiCredentials/#create-an-api-signature' ),
	// ),
	// 'api_username'          => array(
	// 	'title'       => __( 'Live API username', 'easybook-add-ons' ),
	// 	'type'        => 'text',
	// 	'description' => __( 'Get your API credentials from PayPal.', 'easybook-add-ons' ),
	// 	'default'     => '',
	// 	'desc_tip'    => true,
	// 	'placeholder' => __( 'Optional', 'easybook-add-ons' ),
	// ),
	// 'api_password'          => array(
	// 	'title'       => __( 'Live API password', 'easybook-add-ons' ),
	// 	'type'        => 'password',
	// 	'description' => __( 'Get your API credentials from PayPal.', 'easybook-add-ons' ),
	// 	'default'     => '',
	// 	'desc_tip'    => true,
	// 	'placeholder' => __( 'Optional', 'easybook-add-ons' ),
	// ),
	// 'api_signature'         => array(
	// 	'title'       => __( 'Live API signature', 'easybook-add-ons' ),
	// 	'type'        => 'text',
	// 	'description' => __( 'Get your API credentials from PayPal.', 'easybook-add-ons' ),
	// 	'default'     => '',
	// 	'desc_tip'    => true,
	// 	'placeholder' => __( 'Optional', 'easybook-add-ons' ),
	// ),
	// 'sandbox_api_username'  => array(
	// 	'title'       => __( 'Sandbox API username', 'easybook-add-ons' ),
	// 	'type'        => 'text',
	// 	'description' => __( 'Get your API credentials from PayPal.', 'easybook-add-ons' ),
	// 	'default'     => '',
	// 	'desc_tip'    => true,
	// 	'placeholder' => __( 'Optional', 'easybook-add-ons' ),
	// ),
	// 'sandbox_api_password'  => array(
	// 	'title'       => __( 'Sandbox API password', 'easybook-add-ons' ),
	// 	'type'        => 'password',
	// 	'description' => __( 'Get your API credentials from PayPal.', 'easybook-add-ons' ),
	// 	'default'     => '',
	// 	'desc_tip'    => true,
	// 	'placeholder' => __( 'Optional', 'easybook-add-ons' ),
	// ),
	// 'sandbox_api_signature' => array(
	// 	'title'       => __( 'Sandbox API signature', 'easybook-add-ons' ),
	// 	'type'        => 'text',
	// 	'description' => __( 'Get your API credentials from PayPal.', 'easybook-add-ons' ),
	// 	'default'     => '',
	// 	'desc_tip'    => true,
	// 	'placeholder' => __( 'Optional', 'easybook-add-ons' ),
	// ),
);
