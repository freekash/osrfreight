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
function easybook_addons_get_plugin_options(){  
    return array(
        'advanced' => array(
            array(
                "type" => "section",
                'id' => 'advanced_sec_1',
                "title" => __( 'AZP Builder', 'easybook-add-ons' ),   
            ),


            array(
                "type" => "field",
                "field_type" => "checkbox", 
                'id' => 'azp_cache',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Enable AZP builder cache', 'easybook-add-ons'),  
                'desc'  => '',
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox", 
                'id' => 'azp_css_external',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('AZP External CSS', 'easybook-add-ons'),  
                'desc'  => __( 'Builder style will be loaded from external css file instead of adding inline to page.', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox", 
                'id' => 'lazy_load',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable Lazy Load Images', 'easybook-add-ons'),   
                'desc'  => __( 'For page speed improvement.', 'easybook-add-ons' ),
            ),
            array(
                "type" => "field",
                "field_type" => "image",
                'id' => 'lazy_placeholder',
                "title" => __('Lazy Placeholder', 'easybook-add-ons'),
                'desc'  => __( 'Select placeholder image for lazy load. Leave empty for hide images before load (recommended)', 'easybook-add-ons' ),
            ),
            
        ),
        'general' => array(
            array(
                "type" => "section",
                'id' => 'general_design_opts',
                "title" => __( 'General Options', 'easybook-add-ons' ),    
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox", 
                'id' => 'disable_bubble',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Disable Bubble Animation', 'easybook-add-ons'),  
                'desc'  => '',
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox", 
                'id' => 'use_clock_24h',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Use 24-hour format', 'easybook-add-ons'),
                'desc'  => '',
            ),
            array(
                "type" => "field",
                "field_type" => "checkbox", 
                'id' => 'use_messages',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Show Chat', 'easybook-add-ons'),
                'desc'  => '',
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox", 
                'id' => 'show_fchat',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Show Chat front-end', 'easybook-add-ons'),
                'desc'  => '',
            ),

  
            
            array(
                "type" => "section",
                'id' => 'general_section_5',
                "title" => __( 'Currency Options', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'currency',
                "title" => __('Currency', 'easybook-add-ons'),
                'args'=> array(
                    'default'   => 'USD',
                    'options'   => easybook_addons_get_currency_array(),
                    'class'     => 'base_currency_select'
                )
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'currency_symbol',
                'args' => array(
                    'default'  => '$',
                ),
                "title" => __('Symbol', 'easybook-add-ons'),
                // 'desc'  => __('General', 'easybook-add-ons'),
            ),


            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'currency_pos',
                "title" => __('Currency position', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'left_space',
                    'options'=> array(
                        'left' => __( 'Left', 'easybook-add-ons' ),
                        'left_space' => __( 'Left with space', 'easybook-add-ons' ),
                        'right' => __( 'Right', 'easybook-add-ons' ),
                        'right_space' => __( 'Right with space', 'easybook-add-ons' ),
                    ),
                )
            ),
            

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'thousand_sep',
                'args' => array(
                    'default'  => ',',
                ),
                "title" => __('Thousand separator', 'easybook-add-ons'),
                // 'desc'  => __('General', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'decimal_sep',
                'args' => array(
                    'default'  => '.',
                ),
                "title" => __('Decimal separator', 'easybook-add-ons'),
                // 'desc'  => __('General', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "number",
                'id' => 'decimals',
                "title" => __('Number of decimals', 'easybook-add-ons'),
                'args' => array(
                    'default'  => '2',
                    'min'  => '0',
                    'max'  => '14',
                    'step'  => '1',
                ),
                // 'desc'  => __('Timezone offset value from UTC', 'easybook-add-ons'),
            ),



            array(
                "type" => "section",
                'id' => 'general_section_51',
                "title" => __( 'Multiple Currencies', 'easybook-add-ons' ),
            ),


            // easybook_addons_get_option('currencies')

            array(
                "type" => "field",
                "field_type" => "currencies",
                'id' => 'currencies',
                'args' => array(
                    'default'  => '',
                    'load_tmpl' => true
                ),
                "title" => __('Currencies', 'easybook-add-ons'),
                'desc'  => __('Available currencies for front-end show.', 'easybook-add-ons'),
            ),

            // array(
            //     'currencies'    => array(
            //         0   => array(USD, 1, 'Symbol', ),
            //         1   => array(0.00023, 'D',),
            //     ),
            //     'vat_tax'       => '10'
            // );

            array(
                "type" => "section",
                'id' => 'general_tax_sec',
                "title" => __( 'Taxes', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'vat_tax',
                "title" => __('VAT Tax', 'easybook-add-ons'),
                'desc'  => __( 'VAT tax percent. Default: 10%', 'easybook-add-ons' ),
                'args' => array(
                    'default' => '10',
                )
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'service_fee',
                "title" => __('Service Fees (percent)', 'easybook-add-ons'),
                'desc'  => '',
                'args' => array(
                    'default' => '5',
                )
            ),

            
            array(
                "type" => "section",
                'id' => 'general_section_6',
                "title" => __( 'Listing Pages - Important', 'easybook-add-ons' ),
            ),

            // array(
            //     "type" => "field",
            //     "field_type" => "page_select",
            //     'id' => 'submit_page',
            //     "title" => __('Submit Listing Page', 'easybook-add-ons'),
            //     'desc'  => __('The page will be used to display listing submission. The page content should contain <b>[listing_submit_page]</b> shortcode', 'easybook-add-ons'),
            //     'args' => array(
            //         'default_title' => "Submit Listing",
            //     )
            // ),

            // array(
            //     "type" => "field",
            //     "field_type" => "page_select",
            //     'id' => 'edit_page',
            //     "title" => __('Edit Listing Page', 'easybook-add-ons'),
            //     'desc'  => __('The page will be used to edit listing. The page content should contain <b>[listing_edit_page]</b> shortcode', 'easybook-add-ons'),
            //     'args' => array(
            //         'default_title' => "Edit Listing",
            //     )
            // ),

            array(
                "type" => "field",
                "field_type" => "page_select",
                'id' => 'dashboard_page',
                "title" => __('Listing Author Dashboard Page', 'easybook-add-ons'),
                'desc'  => __('The page will be used for listing author dashboard. The page content should contain <b>[listing_dashboard_page]</b> shortcode', 'easybook-add-ons'),
                'args' => array(
                    'default_title' => "Dashboard",
                )
            ),

            // array(
            //     "type" => "field",
            //     "field_type" => "page_select",
            //     'id' => 'payment_page',
            //     "title" => __('Listing Payment Page', 'easybook-add-ons'),
            //     'desc'  => __('The page will be used for listing/booking checkout', 'easybook-add-ons'),
            //     'args' => array(
            //         'default_title' => "Listing Payment",
            //     )
            // ),

            array(
                "type" => "field",
                "field_type" => "page_select",
                'id' => 'checkout_page',
                "title" => __('Listing Checkout Page', 'easybook-add-ons'),
                'desc'  => __('The page will be used for Membership/Listing checkout. The page content should contain <b>[listing_checkout_page]</b> shortcode', 'easybook-add-ons'),
                'args' => array(
                    'default_title' => "Listing Checkout",
                )
            ),

            array(
                "type" => "field",
                "field_type" => "page_select",
                'id' => 'checkout_success_page',
                "title" => __('Free membership success', 'easybook-add-ons'),
                'desc'  => __('The page user will be redirected to when click to free membership plan.', 'easybook-add-ons'),
                'args' => array(
                    'default'   => 'none',
                    'default_title' => "Checkout Success",
                    'options' => array(
                        array(
                            'none',
                            __( 'Front Page', 'easybook-add-ons' ),
                        ),
                    )
                )
            ),
            

        ),
        // end tab array
        'register'      => array(

            array(
                "type" => "section",
                'id' => 'register_general_sec',
                "title" => __( 'User Registration', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'new_user_email',
                "title" => __('Send new user registration email to', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'both',
                    'options'=> array(
                        'user' => __( 'User only', 'easybook-add-ons' ),
                        'admin' => __( 'Admin only', 'easybook-add-ons' ),
                        'both' => __( 'Admin and user', 'easybook-add-ons' ),
                        'none' => __( 'None', 'easybook-add-ons' ),
                        
                    ),
                )
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'register_password',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Show Password field', 'easybook-add-ons'),
                'desc'  => '',
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'register_auto_login',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Login user after registered?', 'easybook-add-ons'),
                'desc'  => '',
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'register_no_redirect',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Disable redirect after registered?', 'easybook-add-ons'),
                'desc'  => '',
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'register_role',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Allow register as author?', 'easybook-add-ons'),
                'desc'  => '',
            ),

            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'register_term_text',
                "title" => __('Terms Text', 'easybook-add-ons'),
                'desc'  => __( 'Accept terms text on user register form.', 'easybook-add-ons' ),
                'args' => array(
                    'default' => 'By using the website, you accept the terms and conditions',
                )
            ),

            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'register_consent_data_text',
                "title" => __('Consent Personal Data Text', 'easybook-add-ons'),
                'desc'  => '',
                'args' => array(
                    'default' => 'Consent to processing of personal data',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'logreg_form_after',
                "title" => __('Log/Reg Footer Content', 'easybook-add-ons'),
                'desc'  => __( 'Content showing up bellow user login - register form. You can add shortcode for social login.', 'easybook-add-ons' ),
                'args' => array(
                    'default' => '<p>For faster login or register use your social account.</p>
[fbl_login_button redirect="" hide_if_logged="" size="large" type="continue_with" show_face="true"]',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'admin_bar_hide_roles',
                "title" => __('Hide Admin Bar for', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> array('l_customer','listing_author','subscriber','contributor','author'),
                    'options'=> easybook_addons_get_author_roles(),
                    'multiple' => true,
                    'use-select2' => true
                ),
                // 'desc' => esc_html__("The page redirect to after submit/edit listing", 'easybook-add-ons'), 
            ),


            array(
                "type" => "section",
                'id' => 'register_login_sec',
                "title" => __( 'User Login', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "page_select",
                'id' => 'login_redirect_page',
                "title" => __('After Login Redirect', 'easybook-add-ons'),
                'desc'  => __('The page user redirect to after login.', 'easybook-add-ons'),
                'args' => array(
                    'default'   => 'cth_current_page',
                    // 'default_title' => "Pricing Tables",
                    'options' => array(
                        array(
                            'cth_current_page',
                            __( 'Current Page', 'easybook-add-ons' ),
                        ),
                    )
                )
            ),

            array(
                "type" => "field",
                "field_type" => "number",
                'id' => 'login_delay',
                "title" => __('Login Redirect Timeout', 'easybook-add-ons'),
                'args' => array(
                    'default'  => '5000',
                    'min'  => '0',
                    'max'  => '500000',
                    'step'  => '1000',
                ),
                'desc'  => __('The number of milliseconds to wait before logged in redirect', 'easybook-add-ons') . __( '<br>And larger than <strong>300000</strong> for disabled.', 'easybook-add-ons' ),
            ),
            
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'log_reg_dis_nonce',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Disable verify nonce?', 'easybook-add-ons'),
                'desc'  => __( 'Use this option if you receive "Security checked!, Cheatn huh?" error when using cache plugin.', 'easybook-add-ons' ),
            ),


        ),
        // end tab array
        'membership' => array(
            array(
                "type" => "section",
                'id' => 'membership_general_sec',
                "title" => __( 'General', 'easybook-add-ons' ),
            ),


            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'always_show_submit',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Show submit button', 'easybook-add-ons'),
                // 'desc'  => __('', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "page_select",
                'id' => 'free_submit_page',
                "title" => __('Pricing Tables page', 'easybook-add-ons'),
                'desc'  => __('The page free user will be redirected to when click to Add Listing and Add New button. User must subscribed for a membership plan (including FREE) to submit listing.', 'easybook-add-ons'),
                'args' => array(
                    'default'   => 'default',
                    'default_title' => "Pricing Tables",
                    
                )
            ),


            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'users_can_submit_listing',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Membership', 'easybook-add-ons'),
                'desc'  => __(' Anyone can submit listing', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'auto_active_free_sub',
                "title" => __('Auto Active Free Subscription', 'easybook-add-ons'),
                'desc'  => __( 'Active free subscription automatically, so user can submit listings then.', 'easybook-add-ons' ),
                'args' => array(
                    'default' => 'no',
                    'value' => 'yes',
                )
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'listing_expire_days',
                "title" => __('Free Listing Expiration Day', 'easybook-add-ons'),
                'desc'  => __( 'Number of days a free listing will be expired.', 'easybook-add-ons' ),
                'args' => array(
                    'default' => '30',
                )
            ),


            
            array(
                "type" => "section",
                'id' => 'membership_expired_sec',
                "title" => __( 'Subscription Expired Action', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'membership_package_expired_hide',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Listings', 'easybook-add-ons'),
                'desc'  => __('Hide listings assigned to the package when it expired.', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'membership_single_expired_hide',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Listing', 'easybook-add-ons'),
                'desc'  => __('Hide listing assigned to the single package when it expired.', 'easybook-add-ons'),
            ),


            array(
                "type" => "section",
                'id' => 'listings_sec_submit',
                "title" => __( 'Publish Listing', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'auto_publish_paid_listings',
                "title" => __('Publish Listing after paid', 'easybook-add-ons'),
                'desc'  => '',
                'args' => array(
                    'value' => 'yes',
                    'default' => 'no',
                )
            ),
            array(
                "type" => "section",
                'id' => 'membership_defaults_sec',
                "title" => __( 'Default Plans', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'admin_lplan',
                "title" => __('Admin Plan', 'easybook-add-ons'),
                'args'=> array(
                    'options'=> easybook_addons_get_listing_plans(),
                )
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'free_lplan',
                "title" => __('Free Plan', 'easybook-add-ons'),
                'args'=> array(
                    'options'=> easybook_addons_get_listing_plans(),
                )
            ),
            //=========
            array(
                "type" => "section",
                'id' => 'membership_checkout_sec',
                "title" => __( 'Checkout', 'easybook-add-ons' ),
            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'ck_hide_tabs',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Tabs', 'easybook-add-ons'),
                'desc'  => __( 'Check this if you want to use single page checkout instead of tabs.', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'ck_hide_information',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Hide Information Tab', 'easybook-add-ons'),
                'desc'  => '',
            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'ck_hide_billing',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Billing Tab', 'easybook-add-ons'),
                'desc'  => '',
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'ck_show_title',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Show Checkout Title', 'easybook-add-ons'),
                'desc'  => '',
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'ck_agree_terms',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Agree to Terms', 'easybook-add-ons'),
                'desc'  => __('User must agree to terms before puchasing', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'ck_terms',
                "title" => __('Checkout Terms', 'easybook-add-ons'),
                // 'desc'  => __( 'Number of listings to show on a page (-1 for all)', 'easybook-add-ons' ),
                'args' => array(
                    'default' => 'I have read and accept the <a target="_blank" href="#"> terms, conditions</a> and <a href="#" target="_blank">Privacy Policy</a>',
                )
            ),


            array(
                "type" => "field",
                "field_type" => "page_select",
                'id' => 'checkout_success',
                "title" => __('Checkout Success Page', 'easybook-add-ons'),
                'desc'  => __('The page display after user complete checkout.', 'easybook-add-ons'),
                'args' => array(
                    'default'   => 'default',
                    'default_title' => "Checkout Success",
                    
                )
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'checkout_success_redirect',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Checkout Success Redirect', 'easybook-add-ons'),
                'desc'  => __('User will redirect to success page instead of showing in tab.', 'easybook-add-ons'),
            ),


            

            //=======
            array(
                "type" => "section",
                'id' => 'membership_dashboard',
                "title" => __( 'Dashboard', 'easybook-add-ons' ),
            ),


            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'db_hide_messages',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Messages', 'easybook-add-ons'),
                'desc'  => '',
            ),
           
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'db_hide_bookings',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Bookings', 'easybook-add-ons'),
                'desc'  => '',
            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'db_hide_reviews',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Comments', 'easybook-add-ons'),
                'desc'  => '',
            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'db_hide_withdrawals',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Withdrawals', 'easybook-add-ons'),
                'desc'  => '',
            ),
             array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'db_hide_invoices',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Invoices', 'easybook-add-ons'),
                'desc'  => '',
            ),


            array(
                "type" => "section",
                'id' => 'membership_package',
                "title" => __( 'Dashboard', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "page_select",
                'id' => 'packages_page',
                "title" => __('Membership Packages Page', 'easybook-add-ons'),
                'desc'  => __('The packages page current user can see their current plan details or update plan.', 'easybook-add-ons'),
                'args' => array(
                    'default'   => 'default',
                    'default_title' => "Pricing Tables",
                    
                )
            ),


            array(
                "type" => "section",
                'id' => 'dashboard_message',
                "title" => __( 'Dashboard Message', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'chatbox_message',
                "title" => __('Chat box message', 'easybook-add-ons'),
                // 'desc'  => __( 'Number of listings to show on a page (-1 for all)', 'easybook-add-ons' ),
                'args' => array(
                    'default' => __( 'We are here to help. Please ask us anything or share your feedback', 'easybook-add-ons' ),
                )
            ),

            array(
                "type" => "field",
                "field_type" => "user_select",
                'id' => 'chat_default_contact',
                "title" => __('Chat admin contact', 'easybook-add-ons'),
                'args' => array(
                    'default'  => 1,
                    'default_name' => 'admin'
                ),
                // 'desc'  => __('User default contact', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "number",
                'id' => 'messages_first_load',
                "title" => __('Loading Messages', 'easybook-add-ons'),
                'args' => array(
                    'default'  => '10',
                    'min'  => '-1',
                    'max'  => '200',
                    'step'  => '1',
                ),
                'desc'  => __('Number of messages loading first', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "number",
                'id' => 'messages_prev_load',
                "title" => __('Previous Messages', 'easybook-add-ons'),
                'args' => array(
                    'default'  => '5',
                    'min'  => '1',
                    'max'  => '100',
                    'step'  => '1',
                ),
                'desc'  => __('Number of previous messages will load when user scrolling to top.', 'easybook-add-ons'),
            ),
            

            array(
                "type" => "section",
                'id' => 'dashboard_listing',
                "title" => __( 'Dashboard Listing', 'easybook-add-ons' ),
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'listings_per',
                "title" => __('Listings per page', 'easybook-add-ons'),
                'desc'  => __( 'Number of listings to show on a page (-1 for all)', 'easybook-add-ons' ),
                'args' => array(
                    'default' => '5',
                )
            ),
            array(
                "type" => "section",
                'id' => 'dashboard_invoice',
                "title" => __( 'Invoice', 'easybook-add-ons' ),
            ),
            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'invoice_author',
                "title" => __('Information author for invoice', 'easybook-add-ons'),
                // 'desc'  => __( 'Number of listings to show on a page (-1 for all)', 'easybook-add-ons' ),
                'args' => array(
                    'default' => 'EasyBook , Inc.<br />
                                     USA 27TH Brooklyn NY<br />
                                        <a href="#" >JessieManrty@domain.com</a><br />
                                        <a href="#">+4(333)123456</a>     ',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "image",
                'id' => 'invoice_logo',
                "title" => __('Logo Invoice', 'easybook-add-ons'),
                'desc'  => ''
            ),

           


        ),
        // end tab array
        'submit_listing' => array(
            array(
                "type" => "section",
                'id' => 'submit_sec_1',
                "title" => __( 'General', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'default_listing_type',
                "title" => __('Listing Default Type', 'easybook-add-ons'),
                'args'=> array(
                    'options'=> easybook_addons_get_listing_types(),
                )
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'submit_redirect',
                "title" => __('Submit Redirect', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'single',
                    'options'=> array(
                        'single' => esc_html__('Single Listing', 'easybook-add-ons'), 
                        'home' => esc_html__('Home', 'easybook-add-ons'), 
                        'dashboard' => esc_html__('Dashboard', 'easybook-add-ons'), 
                        
                    ),
                ),
                'desc' => esc_html__("The page redirect to after submit/edit listing", 'easybook-add-ons'), 
            ),
            array(
                "type" => "section",
                'id' => 'submit_media_upload',
                "title" => __( 'Media Upload', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "number",
                'id' => 'submit_media_limit',
                "title" => __('Media Limit', 'easybook-add-ons'),
                'args' => array(
                    'default'  => '3',
                    'min'  => '1',
                    'max'  => '200',
                    'step'  => '1',
                ),
                'desc'  => __('The maximum number of upload images per field.', 'easybook-add-ons'),
            ),
            array(
                "type" => "field",
                "field_type" => "number",
                'id' => 'submit_media_limit_size',
                "title" => __('File Size Limit', 'easybook-add-ons'),
                'args' => array(
                    'default'  => '2',
                    'min'  => '1',
                    'max'  => '100',
                    'step'  => '1',
                ),
                'desc'  => __('The maximum upload file size in MB (Megabyte).', 'easybook-add-ons'),
            ),
            array(
                "type" => "section",
                'id' => 'submit_captcha_sec',
                "title" => __( 'Google reCAPTCHA', 'easybook-add-ons' ),
                'callback' => function(){
                    echo sprintf(__( '<p>Get <a href="%s" target="_blank">reCAPTCHA Keys</a></p>', 'easybook-add-ons' ), esc_url('https://www.google.com/recaptcha'));
                    
                }
            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'enable_g_recaptcah',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Enable reCAPTCHA', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'g_recaptcha_site_key',
                "title" => __('Site Key', 'easybook-add-ons'),
                'desc'  => '',
                'args' => array(
                    'default' => '',
                )
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'g_recaptcha_secret_key',
                "title" => __('Secret key', 'easybook-add-ons'),
                'desc'  => '',
                'args' => array(
                    'default' => '',
                )
            ),

            array(
                "type" => "section",
                'id' => 'submit_loc_sec',
                "title" => __( 'Listing Location', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'default_country',
                "title" => __('Default Country', 'easybook-add-ons'),
                'args'=> array(
                    'default'       => 'US',
                    'options'       => easybook_addons_get_google_contry_codes(),
                    'use-select2'   => true
                ),
                'desc' => __( 'Default country for listing location.', 'easybook-add-ons' )
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox", 
                'id' => 'location_show_state',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Show Listing Location State', 'easybook-add-ons'),  
                'desc'  => '',
            ),


        ),
        'search' => array(

            array(
                "type" => "section",
                'id' => 'search_category_opts',
                "title" => __( 'Category Options', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'ajax_search_chage',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Search on field changed', 'easybook-add-ons'),
                'desc' => __("Check this if you want listing search on every filter field changed.", 'easybook-add-ons'), 

            ),


            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'search_cat_level',
                "title" => __('Category Level', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> '0',
                    'options'=> array(
                        '0' => esc_html__('1 Level', 'easybook-add-ons'), 
                        '1' => esc_html__('2 Level', 'easybook-add-ons'), 
                        '2' => esc_html__('3 Level', 'easybook-add-ons'), 
                        '3' => esc_html__('4 Level', 'easybook-add-ons'), 
                        '4' => esc_html__('5 Level', 'easybook-add-ons'), 
                    ),
                ),
                'desc' => esc_html__("Max category level display on search form.", 'easybook-add-ons'), 
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'search_load_subcat',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Load Sub-Cat', 'easybook-add-ons'),
                'desc' => esc_html__("Load sub categories for filter.", 'easybook-add-ons'), 

            ),

            

            array(
                "type" => "section",
                'id' => 'search_taxonomy_opts',
                "title" => __( 'Taxonomy Options', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'search_include_tag',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Include Tag', 'easybook-add-ons'),
                'desc' => esc_html__("Include listing tag for search value", 'easybook-add-ons'), 

            ),

            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'search_tax_relation',
                "title" => __('Taxonomy Relation', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'AND',
                    'options'=> array(
                        'AND' => esc_html__('AND', 'easybook-add-ons'), 
                        'OR' => esc_html__('OR', 'easybook-add-ons'), 
                        
                    ),
                ),
                'desc' => esc_html__("The logical relationship between each inner taxonomy.", 'easybook-add-ons'), 
            ),

            array(
                "type" => "section",
                'id' => 'search_filter_opts',
                "title" => __( 'Filter Options', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'filter_hide_string',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Filter String', 'easybook-add-ons'),
                'desc' => '', 

            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'filter_hide_loc',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Location', 'easybook-add-ons'),
                'desc' => '', 

            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'filter_hide_cat',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Category', 'easybook-add-ons'),
                'desc' => '', 

            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'filter_hide_address',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Address', 'easybook-add-ons'),
                'desc' => '', 

            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'filter_hide_event_date',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Event Date', 'easybook-add-ons'),
                'desc' => '', 

            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'filter_hide_event_time',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Event Time', 'easybook-add-ons'),
                'desc' => '', 

            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'filter_hide_open_now',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Open Now', 'easybook-add-ons'),
                'desc' => '', 

            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'filter_hide_price_range',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Price Range', 'easybook-add-ons'),
                'desc' => '', 

            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'filter_hide_sortby',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Sort By', 'easybook-add-ons'),
                'desc' => '', 

            ),

            array(
                "type" => "field",
                "field_type" => "lfeatures",
                'id' => 'filter_features',
                'args'=> array(
                    'default' => array(),
                    // 'hide_empty'    => true, // default is true
                ),
                "title" => __('Features', 'easybook-add-ons'),
                'desc' => '', 

            ),

            array(
                "type" => "field",
                "field_type" => "cth_tags",
                'id' => 'filter_ltags',
                'args'=> array(
                    'default' => array(),
                    'hide_empty'    => true,
                ),
                "title" => __('Tags Filter', 'easybook-add-ons'),
                'desc' => '', 

            ),
            

        ),
        // end tab array
        // end tab array
        'listings' => array(
            array(
                "type" => "section",
                'id' => 'listings_archive_sec',
                "title" => __( 'Archive Layout', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'map_pos',
                "title" => __('Map Position', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'right',
                    'options'=> array(
                        'top' => esc_html__('Top', 'easybook-add-ons'), 
                        'left' => esc_html__('Left', 'easybook-add-ons'), 
                        'right' => esc_html__('Right', 'easybook-add-ons'), 
                        'hide' => esc_html__('Hide', 'easybook-add-ons'), 
                    ),
                ),
                'desc' => esc_html__("Select Google Map position", 'easybook-add-ons'), 
            ),

            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'filter_pos',
                "title" => __('Filter Position', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'top',
                    'options'=> array(
                        'top' => esc_html__('Top', 'easybook-add-ons'), 
                        'left' => esc_html__('Left', 'easybook-add-ons'), 
                        'right' => esc_html__('Right', 'easybook-add-ons'), 
                        'left_col' => esc_html__('Column Left', 'easybook-add-ons'), 
                    ),
                ),
                'desc' => esc_html__("Select Listing Filter position", 'easybook-add-ons'), 
            ),

            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'columns_grid',
                "title" => __('Columns Grid', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'two',
                    'options'=> array(
                        'one' => esc_html__('One Column', 'easybook-add-ons'), 
                        'two' => esc_html__('Two Columns', 'easybook-add-ons'), 
                        'three' => esc_html__('Three Columns', 'easybook-add-ons'), 
                        'four' => esc_html__('Four Columns', 'easybook-add-ons'), 
                        'five' => esc_html__('Five Columns', 'easybook-add-ons'), 
                        'six' => esc_html__('Six Columns', 'easybook-add-ons'), 
                    ),
                ),
                'desc' => '', 
            ),


            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'listings_grid_layout',
                "title" => __('Default Layout', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'grid',
                    'options'=> array(
                        'grid' => esc_html__('Grid View', 'easybook-add-ons'), 
                        'list' => esc_html__('List View', 'easybook-add-ons'), 
                        
                    ),
                ),
                'desc' => '', 
            ),

            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'listings_orderby',
                "title" => __('Order Listings by', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'date',
                    'options'=> easybook_addons_get_post_orderby(),
                ),
                'desc' => '', 
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'listings_order',
                "title" => __('Sort Order', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'DESC',
                    'options'=> array(
                        'ASC' => __( 'Ascending order - (1, 2, 3; a, b, c)', 'easybook-add-ons' ),
                        'DESC' => __( 'Descending order - (3, 2, 1; c, b, a)', 'easybook-add-ons' ),
                    ),
                ),
                'desc' => '', 
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'listings_count',
                "title" => __('Listings per page', 'easybook-add-ons'),
                'desc'  => __( 'Number of listings to show on a page (-1 for all)', 'easybook-add-ons' ),
                'args' => array(
                    'default' => '6',
                )
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'excerpt_length',
                "title" => __('Excerpt Characters Length', 'easybook-add-ons'),
                'desc'  => '',
                'args' => array(
                    'default' => '55',
                )
            ),
            array(
                "type" => "section",
                'id' => 'listings_search_sec',
                "title" => __( 'Listing Search Page', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'search_infor_before',
                "title" => __('Information Before', 'easybook-add-ons'),
                'desc'  => '',
                'args' => array(
                    'default' => '',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'search_infor_after',
                "title" => __('Information After', 'easybook-add-ons'),
                'desc'  => '',
                'args' => array(
                    'default' => '',
                )
            ),

        ),
        // end tab array
        'ads' => array(
            // sidebar
            // archive
            // category
            // search
            // home
            // custom_grid

            array(
                "type" => "section",
                'id' => 'ads_sec_archive',
                "title" => __( 'Listings Archive Page AD', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'ads_archive_enable',
                "title" => __('Enable/Disable', 'easybook-add-ons'),
                'desc'  => __( 'ADs on the page', 'easybook-add-ons' ),
                'args' => array(
                    'value' => 'yes',
                    'default' => 'yes',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'ads_archive_count',
                "title" => __('Count', 'easybook-add-ons'),
                'desc'  => __( 'Number of ads to show', 'easybook-add-ons' ),
                'args' => array(
                    'default' => '2',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'ads_archive_orderby',
                "title" => __('Order AD by', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'date',
                    'options'=> easybook_addons_get_post_orderby(),
                ),
                'desc' => '', 
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'ads_archive_order',
                "title" => __('Sort Order', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'DESC',
                    'options'=> array(
                        'ASC' => __( 'Ascending order - (1, 2, 3; a, b, c)', 'easybook-add-ons' ),
                        'DESC' => __( 'Descending order - (3, 2, 1; c, b, a)', 'easybook-add-ons' ),
                    ),
                ),
                'desc' => '', 
            ),

            array(
                "type" => "section",
                'id' => 'ads_sec_category',
                "title" => __( 'Listings Category Page AD', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'ads_category_enable',
                "title" => __('Enable/Disable', 'easybook-add-ons'),
                'desc'  => __( 'ADs on the page', 'easybook-add-ons' ),
                'args' => array(
                    'value' => 'yes',
                    'default' => 'yes',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'ads_category_count',
                "title" => __('Count', 'easybook-add-ons'),
                'desc'  => __( 'Number of ads to show', 'easybook-add-ons' ),
                'args' => array(
                    'default' => '2',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'ads_category_orderby',
                "title" => __('Order AD by', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'date',
                    'options'=> easybook_addons_get_post_orderby(),
                ),
                'desc' => '', 
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'ads_category_order',
                "title" => __('Sort Order', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'DESC',
                    'options'=> array(
                        'ASC' => __( 'Ascending order - (1, 2, 3; a, b, c)', 'easybook-add-ons' ),
                        'DESC' => __( 'Descending order - (3, 2, 1; c, b, a)', 'easybook-add-ons' ),
                    ),
                ),
                'desc' => '', 
            ),

            array(
                "type" => "section",
                'id' => 'ads_sec_search',
                "title" => __( 'Listings Search Page AD', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'ads_search_enable',
                "title" => __('Enable/Disable', 'easybook-add-ons'),
                'desc'  => __( 'ADs on the page', 'easybook-add-ons' ),
                'args' => array(
                    'value' => 'yes',
                    'default' => 'yes',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'ads_search_count',
                "title" => __('Count', 'easybook-add-ons'),
                'desc'  => __( 'Number of ads to show', 'easybook-add-ons' ),
                'args' => array(
                    'default' => '2',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'ads_search_orderby',
                "title" => __('Order AD by', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'date',
                    'options'=> easybook_addons_get_post_orderby(),
                ),
                'desc' => '', 
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'ads_search_order',
                "title" => __('Sort Order', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'DESC',
                    'options'=> array(
                        'ASC' => __( 'Ascending order - (1, 2, 3; a, b, c)', 'easybook-add-ons' ),
                        'DESC' => __( 'Descending order - (3, 2, 1; c, b, a)', 'easybook-add-ons' ),
                    ),
                ),
                'desc' => '', 
            ),


            array(
                "type" => "section",
                'id' => 'ads_sec_sidebar',
                "title" => __( 'Listing Sidebar Page AD', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'ads_sidebar_enable',
                "title" => __('Enable/Disable', 'easybook-add-ons'),
                'desc'  => __( 'ADs on the page', 'easybook-add-ons' ),
                'args' => array(
                    'value' => 'yes',
                    'default' => 'yes',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'ads_sidebar_count',
                "title" => __('Count', 'easybook-add-ons'),
                'desc'  => __( 'Number of ads to show', 'easybook-add-ons' ),
                'args' => array(
                    'default' => '2',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'ads_sidebar_orderby',
                "title" => __('Order AD by', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'date',
                    'options'=> easybook_addons_get_post_orderby(),
                ),
                'desc' => '', 
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'ads_sidebar_order',
                "title" => __('Sort Order', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'DESC',
                    'options'=> array(
                        'ASC' => __( 'Ascending order - (1, 2, 3; a, b, c)', 'easybook-add-ons' ),
                        'DESC' => __( 'Descending order - (3, 2, 1; c, b, a)', 'easybook-add-ons' ),
                    ),
                ),
                'desc' => '', 
            ),

            array(
                "type" => "section",
                'id' => 'ads_sec_home',
                "title" => __( 'Elementor Listings Slider AD', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'ads_home_enable',
                "title" => __('Enable/Disable', 'easybook-add-ons'),
                'desc'  => __( 'ADs on Listings Slider', 'easybook-add-ons' ),
                'args' => array(
                    'value' => 'yes',
                    'default' => 'yes',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'ads_home_count',
                "title" => __('Count', 'easybook-add-ons'),
                'desc'  => __( 'Number of ads to show', 'easybook-add-ons' ),
                'args' => array(
                    'default' => '2',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'ads_home_orderby',
                "title" => __('Order AD by', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'date',
                    'options'=> easybook_addons_get_post_orderby(),
                ),
                'desc' => '', 
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'ads_home_order',
                "title" => __('Sort Order', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'DESC',
                    'options'=> array(
                        'ASC' => __( 'Ascending order - (1, 2, 3; a, b, c)', 'easybook-add-ons' ),
                        'DESC' => __( 'Descending order - (3, 2, 1; c, b, a)', 'easybook-add-ons' ),
                    ),
                ),
                'desc' => '', 
            ),

            




            array(
                "type" => "section",
                'id' => 'ads_sec_custom_grid',
                "title" => __( 'Elementor Listings Grid AD', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'ads_custom_grid_enable',
                "title" => __('Enable/Disable', 'easybook-add-ons'),
                'desc'  => __( 'ADs on Listings Grid', 'easybook-add-ons' ),
                'args' => array(
                    'value' => 'yes',
                    'default' => 'yes',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'ads_custom_grid_count',
                "title" => __('Count', 'easybook-add-ons'),
                'desc'  => __( 'Number of ads to show', 'easybook-add-ons' ),
                'args' => array(
                    'default' => '2',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'ads_custom_grid_orderby',
                "title" => __('Order AD by', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'date',
                    'options'=> easybook_addons_get_post_orderby(),
                ),
                'desc' => '', 
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'ads_custom_grid_order',
                "title" => __('Sort Order', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'DESC',
                    'options'=> array(
                        'ASC' => __( 'Ascending order - (1, 2, 3; a, b, c)', 'easybook-add-ons' ),
                        'DESC' => __( 'Descending order - (3, 2, 1; c, b, a)', 'easybook-add-ons' ),
                    ),
                ),
                'desc' => '', 
            ),
            // array(
            //     "type" => "section",
            //     'id' => 'ads_google_adsense',
            //     "title" => __( 'Google AdSense', 'easybook-add-ons' ),
            // ),
            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'ads_google_adsense_enable',
            //     "title" => __('Enable/Disable', 'easybook-add-ons'),
            //     'desc'  => __( 'Turn on google adsense on the page', 'easybook-add-ons' ),
            //     'args' => array(
            //         'value' => 'yes',
            //         'default' => 'yes',
            //     )
            // ),
            // array(
            //     "type" => "field",
            //     "field_type" => "text",
            //     'id' => 'google_ad_client',
            //     "title" => __('Google AdSense Client', 'easybook-add-ons'),
            //     'desc'  => __( 'Input user key', 'easybook-add-ons' ),
            //     'args' => array(
            //         'default' => '',
            //     )
            // ),
        ),
        // end tab array
        'single' => array(
            array(
                "type" => "section",
                'id' => 'single_thumbnail',
                "title" => __( 'Thumbnail', 'easybook-add-ons' ),
            ),

            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'enable_img_click',
            //     "title" => __('Enable Thumbnail Click', 'easybook-add-ons'),
            //     'desc'  => '',
            //     'args' => array(
            //         'value' => 'yes',
            //         'default' => 'no',
            //     )),
            // 
            array(
                "type" => "field",
                "field_type" => "image",
                'id' => 'default_thumbnail',
                "title" => __('Default Thumbnail', 'easybook-add-ons'),
                'desc'  => ''
            ),

            array(
                "type" => "section",
                'id' => 'single_section_1',
                "title" => __( 'Rating', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'single_show_rating',
                "title" => __('Show Rating', 'easybook-add-ons'),
                'desc'  => '',
                'args' => array(
                    'value' => '1',
                    'default' => '1',
                )
            ),


            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'rating_base',
                "title" => __('Rating System', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> '5',
                    'options'=> array(
                        '5' => esc_html__('Five Stars', 'easybook-add-ons'), 
                        '10' => esc_html__('Ten Stars', 'easybook-add-ons'), 
                        
                    ),
                ),
                'desc' => '', 
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'allow_rating_imgs',
                "title" => __('Rating Allow Images', 'easybook-add-ons'),
                'desc'  => '',
                'args' => array(
                    'value' => 'yes',
                    'default' => 'yes',
                )
            ),

            array(
                "type" => "section",
                'id' => 'single_feature',
                "title" => __( 'Features', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'feature_parent_group',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => esc_html__('Group by parent', 'easybook-add-ons'),
                'desc' => '', 

            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'single_post_nav',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => esc_html__('Show Next/Prev post Nav', 'easybook-add-ons'),
                'desc' => '', 

            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'single_same_term',
                'args'=> array(
                    'default' => '0',
                    'value' => '1',
                ),
                "title" => esc_html__('Next/Prev posts should be in same category', 'easybook-add-ons'),
                'desc' => '', 

            ),
            array(
                "type" => "section",
                'id' => 'single_claim_opts',
                "title" => __( 'Listing Claim', 'easybook-add-ons' ),
                'callback' => function(){
                    echo sprintf(__( '<p>Read <a href="%s" target="_blank">Claim Listing</a> document for more details.</p>', 'easybook-add-ons' ), esc_url('https://docs.cththemes.com/docs/advance-features/claim-listing/'));
                    
                }
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'single_hide_claim',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => esc_html__('Hide Claim Listing', 'easybook-add-ons' ),
                'desc'          => __('Check this to hide <strong>Claim Listing</strong> on price range widget.', 'easybook-add-ons' ),
            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'single_hide_claimed',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => esc_html__('Hide Claim on Claimed Listing', 'easybook-add-ons' ),
                'desc'          => __('Check this to hide <strong>Claim Listing</strong> on price range widget for already claimed listing.', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'approve_claim_after_paid',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => esc_html__('Auto Approved', 'easybook-add-ons' ),
                'desc'          => __('Check this to make listing claim auto approved after paid.', 'easybook-add-ons' ),
            ),


        ),
        // end tab array
        'gmap' => array(
            array(
                "type" => "section",
                'id' => 'gmap_osm_sec',
                "title" => __( 'OpenEasyBookMap', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'use_osm_map',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Use Free OpenEasyBookMap Instead', 'easybook-add-ons'),
                'desc'  => '',
            ),
            array(
                "type" => "section",
                'id' => 'gmap_section_1',
                "title" => __( 'Google API', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'gmap_api_key',
                "title" => __('Google Map API Key', 'easybook-add-ons'),
                'desc'  => sprintf( __( 'You have to enter your API key to use google map feature. Required services: <b>Google Places API Web Service</b>, <b>Google Maps JavaScript API</b> and <b>Google Maps Geocoding API</b>.<br /><a href="%s" target="_blank">Get Your Key</a>', 'easybook-add-ons' ), esc_url('https://developers.google.com/maps/documentation/javascript/get-api-key' ) ),
            ),

            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'gmap_type',
                "title" => __('Google Map Type', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'ROADMAP',
                    'options'=> array(
                        "ROADMAP" => __('ROADMAP - default 2D map','easybook-add-ons'), 
                        "SATELLITE" => __('SATELLITE - photographic map','easybook-add-ons'), 
                        "HYBRID" => __('HYBRID - photographic map + roads and city names','easybook-add-ons'), 
                        "TERRAIN" => __('TERRAIN - map with mountains, rivers, etc','easybook-add-ons'), 
                        
                    ),
                )
            ),
            
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'google_map_language',
                "title" => __('Google Map Language Code', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> '',
                ),
                'desc'  => sprintf( __( 'Leave this empty for user location or browser settings value. Available value at <a href="%s" target="_blank">Google Supported Languages</a>', 'easybook-add-ons' ), 'https://developers.google.com/maps/faq#languagesupport'),
            ),

            


            array(
                "type" => "section",
                'id' => 'gmap_section_geolocation',
                "title" => __( 'Place Autocomplete', 'easybook-add-ons' ),
            ),
            // https://developers.google.com/places/web-service/supported_types#table2
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'listing_location_result_type',
                "title" => __('Listing Location Type', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'administrative_area_level_1',
                    'options'=> array(
                        "locality" => __('District','easybook-add-ons'), 
                        "sublocality" => __('Road','easybook-add-ons'), 
                        "postal_code" => __('Postal Code','easybook-add-ons'), 
                        "country" => __('Country','easybook-add-ons'), 
                        "administrative_area_level_1" => __('State','easybook-add-ons'), 
                        "administrative_area_level_2" => __('City','easybook-add-ons'),
                    ),
                )
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'listing_address_format',
                "title" => __('Or Define Your Address Format', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'formatted_address',
                ),
                'desc'  => sprintf( __( 'Define address format will received when user using google autocomplete place service. Address types separated by comma. Available types at <a href="%s" target="_blank">Google Address Types</a>', 'easybook-add-ons' ), 'https://developers.google.com/maps/documentation/geocoding/intro#Types'). '<br />'.__( 'Using <strong>formatted_address</strong> for Google formated address.', 'easybook-add-ons' ),
            ),



            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'country_restrictions',
                "title" => __('Restriction Countries', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> '',
                    'options'=> easybook_addons_get_google_contry_codes('', true),
                    'multiple' => true,
                    'use-select2' => true
                ),
                'desc' => __( 'Type to search. Restrict the search to a specific countries. Leave empty for all. ', 'easybook-add-ons' )
            ),

            array(
                "type" => "section",
                'id' => 'gmap_section_listings',
                "title" => __( 'Listings Map', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'gmap_default_lat',
                'args'=> array(
                    'default'=> '40.7',
                ),
                "title" => __('Default Latitude', 'easybook-add-ons'),
                'desc'  => sprintf( __( 'Enter your address latitude - default: 40.7. You can get value from this <a href="%s" target="_blank">website</a>', 'easybook-add-ons' ), esc_url('http://www.gps-coordinates.net/' ) ),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'gmap_default_long',
                'args'=> array(
                    'default'=> '-73.87',
                ),
                "title" => __('Default Longtitude', 'easybook-add-ons'),
                'desc'  => sprintf( __( 'Enter your address longtitude - default: -73.87. You can get value from this <a href="%s" target="_blank">website</a>', 'easybook-add-ons' ), esc_url('http://www.gps-coordinates.net/' ) ),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'gmap_default_zoom',
                'args'=> array(
                    'default'=> '10',
                ),
                "title" => __('Default Zoom', 'easybook-add-ons'),
                'desc'  => __('Default map zoom level, max: 18', 'easybook-add-ons'),
            ),


            array(
                "type" => "field",
                "field_type" => "image",
                'id' => 'gmap_marker',
                "title" => __('Map Marker', 'easybook-add-ons'),
                // 'args'=> array(
                //     'default'=> array(
                //         'url' => ESB_DIR_URL ."assets/images/marker.png"
                //     )
                // ),
                
                'desc'  => ''
            ),

        ),
        // end tab array
        'booking' => array(
            // array(
            //     "type" => "section",
            //     'id' => 'booking_sec_1',
            //     "title" => __( 'General', 'easybook-add-ons' ),
            // ),

            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'booking_clock_24h',
            //     'args'=> array(
            //         'default' => 'yes',
            //         'value' => 'yes',
            //     ),
            //     "title" => __('Use 24-hour format', 'easybook-add-ons'),
            //     'desc'  => '',
            // ),
            // array(
            //     "type" => "field",
            //     "field_type" => "color",
            //     'id' => 'time_picker_color',
            //     'args'=> array(
            //         'default' => '#4DB7FE',
            //     ),
            //     "title" => __('Time picker style color', 'easybook-add-ons'),
            //     'desc'  => '',
            // ),

            array(
                "type" => "section",
                'id' => 'booking_sec_woo',
                "title" => __( 'WooCommerce Integration', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "number",
                'id' => 'add_cart_delay',
                "title" => __('Add booking to cart delay', 'easybook-add-ons'),
                'args' => array(
                    'default'  => '3000',
                    'min'  => '0',
                    'max'  => '86400000',
                    'step'  => '1000',
                ),
                'desc'  => __('The number of milliseconds to wait before redirecting to cart page when booking success. 0 for immediately redirect.', 'easybook-add-ons') . __( '<br />And larger than <strong>300000</strong> for disabled.', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'booking_author_woo',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Mark Order as complete', 'easybook-add-ons'),
                'desc'  => __('Whether listing author will also mark WooCommerce order (for selling their booking) as completed when approve booking or not?', 'easybook-add-ons'),
            ),
            array(
                "type" => "section",
                'id' => 'booking_dashboard_sec',
                "title" => __( 'Dashboard Options', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'booking_author_delete',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Author Can Delete Booking', 'easybook-add-ons'),
                'desc'  => '',
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'booking_del_trash',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Move Deleted Booking to Trash?', 'easybook-add-ons'),
                'desc'  => '',
            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'booking_approved_cancel',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Approved Booking Cancelable?', 'easybook-add-ons'),
                'desc'  => '',
            ),


        ),
        // end tab array

            


        'payments' => array(
            array(
                "type" => "section",
                'id' => 'payments_sec_general',
                "title" => __( 'General Options', 'easybook-add-ons' ),
            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'payments_test_mode',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Test mode', 'easybook-add-ons'),
                'desc'  => __('While in test mode no live transactions are processed. To fully use test mode, you must have a sandbox (test) account for the payment gateway you are testing.', 'easybook-add-ons'),
            ),

            array(
                "type" => "section",
                'id' => 'payments_sec_form',
                "title" => __( 'Submit Form', 'easybook-add-ons' ),
            ),

            
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'payments_form_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'easybook-add-ons'),
                'desc'  => __('Enable this payment method', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'payments_form_details',
                'args'=> array(
                    'default' => '<p>Your payment details will be submitted for review.</p>',
                ),
                "title" => __('Payment description', 'easybook-add-ons'),
                // 'desc'  => __( 'Enter your bank account details', 'easybook-add-ons' ) ,
            ),

            array(
                "type" => "section",
                'id' => 'payments_sec_cod',
                "title" => __( 'Cash on delivery', 'easybook-add-ons' ),
            ),

            
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'payments_cod_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'easybook-add-ons'),
                'desc'  => __('Enable this payment method', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'payments_cod_details',
                'args'=> array(
                    'default' => '<p>Your payment details will be submitted. Then pay on delivery.</p>',
                ),
                "title" => __('Payment description', 'easybook-add-ons'),
                // 'desc'  => __( 'Enter your bank account details', 'easybook-add-ons' ) ,
            ),


            array(
                "type" => "section",
                'id' => 'payments_sec_bank',
                "title" => __( 'Bank Transfer', 'easybook-add-ons' ),
            ),

            
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'payments_banktransfer_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'easybook-add-ons'),
                'desc'  => __('Enable this payment method', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'payments_banktransfer_details',
                'args'=> array(
                    'default' => '<p>
<strong>Bank name</strong>: Bank of America, NA<br />
<strong>Bank account number</strong>: 0175380000<br />
<strong>Bank address</strong>:USA 27TH Brooklyn NY<br />
<strong>Bank SWIFT code</strong>: BOFAUS 3N<br />
</p>',
                ),
                "title" => __('Bank Account', 'easybook-add-ons'),
                'desc'  => __( 'Enter your bank account details', 'easybook-add-ons' ) ,
            ),

            array(
                "type" => "section",
                'id' => 'payments_sec_paypal',
                "title" => __( 'Paypal Payment', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'payments_paypal_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'easybook-add-ons'),
                'desc'  => __('Enable this payment method', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'payments_paypal_desc',
                'args'=> array(
                    'default' => '<p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p><p>Important: You will be redirected to PayPal\'s website to complete payment.</p>',
                ),
                "title" => __('Payment description', 'easybook-add-ons'),
                // 'desc'  => __( '', 'easybook-add-ons' ) ,
            ),

            array(
                "type"          => "field",
                "field_type"    => "text",
                'id'            => 'payments_paypal_business',
                'args'=> array(
                    'default'=> 'cththemespp-facilitator@gmail.com',
                ),
                "title"         => __('Paypal Business Email', 'easybook-add-ons'),
                'desc'          => ''
            ),

            array(
                "type" => "section",
                'id' => 'payments_sec_stripe',
                "title" => __( 'Stripe Payment', 'easybook-add-ons' ),
            ),

            

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'payments_stripe_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'easybook-add-ons'),
                'desc'  => __('Enable this payment method', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'payments_stripe_desc',
                'args'=> array(
                    'default' => '<p>Pay via Stripe; you can pay with your credit card.</p>',
                ),
                "title" => __('Payment description', 'easybook-add-ons'),
                // 'desc'  => __( '', 'easybook-add-ons' ) ,
            ),

            array(
                "type" => "section",
                'id' => 'payments_stripe_apis',
                "title" => __( 'Stripe API Keys - Settings', 'easybook-add-ons' ),
                'callback' => function(){
                    echo sprintf(__( '<p>You can get api keys in <a href="%s" target="_blank">the Dashboard</a></p>', 'easybook-add-ons' ), esc_url('https://dashboard.stripe.com/account/apikeys'));
                    
                }
            ),

            array(
                "type"          => "field",
                "field_type"    => "text",
                'id'            => 'payments_stripe_live_secret',
                // 'args'=> array(
                //     'default'=> '',
                // ),
                "title"         => __('Live Secret Key', 'easybook-add-ons'),
                'desc'          => ''
            ),

            array(
                "type"          => "field",
                "field_type"    => "text",
                'id'            => 'payments_stripe_live_public',
                // 'args'=> array(
                //     'default'=> '',
                // ),
                "title"         => __('Live Publishable Key', 'easybook-add-ons'),
                'desc'          => ''
            ),

            array(
                "type"          => "field",
                "field_type"    => "text",
                'id'            => 'payments_stripe_test_secret',
                // 'args'=> array(
                //     'default'=> '',
                // ),
                "title"         => __('Test Secret Key', 'easybook-add-ons'),
                'desc'          => __( 'For test mode only', 'easybook-add-ons' ),
            ),

            array(
                "type"          => "field",
                "field_type"    => "text",
                'id'            => 'payments_stripe_test_public',
                // 'args'=> array(
                //     'default'=> '',
                // ),
                "title"         => __('Test Publishable Key', 'easybook-add-ons'),
                'desc'          => __( 'For test mode only', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "info",
                'id' => 'payments_stripe_webhook',
                "title" => __('Webhooks End Point', 'easybook-add-ons'),
                'desc'  => sprintf( __( '<p>Webhooks are configured in the <a href="%1$s" target="_blank">Webhooks setting</a> section of the Dashboard.<br />Clicking <strong>Add endpoint</strong> reveals a form to add this URL <span class="webhooks-url">%2$s</span> for receiving webhooks.</p><p><img src="%3$s" class="webhooks-img"></p>', 'easybook-add-ons' ), esc_url('https://dashboard.stripe.com/account/webhooks'), esc_url(home_url('/?action=esb_stripewebhook' ) ), ESB_DIR_URL.'assets/admin/stripe-webhook.png'), 
            ),

            array(
                "type" => "field",
                "field_type" => "image",
                'id' => 'stripe_logo',
                "title" => __('Logo', 'easybook-add-ons'),
                'desc'  => __( 'A square image of your brand or product. The recommended minimum size is 128x128px. The supported image types are: <b>.gif</b>, <b>.jpeg</b>, and <b>.png</b>.', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'payments_stripe_use_email',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Use User Email', 'easybook-add-ons'),
                'desc'  => __('Enable this option for using current user email as Stripe checkout email form.', 'easybook-add-ons'),
            ),
            array(
                "type" => "section",
                'id' => 'payments_sec_payfast',
                "title" => __( 'Payfast Payment', 'easybook-add-ons' ),
            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'payments_payfast_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'easybook-add-ons'),
                'desc'  => __('Enable this payment method', 'easybook-add-ons'),
            ),
            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'payments_payfast_desc',
                'args'=> array(
                    'default' => '<p>Pay via Payfast; you can pay with your credit card.</p>',
                ),
                "title" => __('Payment description', 'easybook-add-ons'),
                // 'desc'  => __( '', 'easybook-add-ons' ) ,
            ),
            array(
                "type"          => "field",
                "field_type"    => "text",
                'id'            => 'payments_payfast_merchant_id',
                // 'args'=> array(
                //     'default'=> '',
                // ),
                "title"         => __('Payfast merchant id', 'easybook-add-ons'),
                'desc'          => ''
            ),
            array(
                "type"          => "field",
                "field_type"    => "text",
                'id'            => 'payments_payfast_merchant_key',
                // 'args'=> array(
                //     'default'=> '',
                // ),
                "title"         => __('Payfast merchant key', 'easybook-add-ons'),
                'desc'          => ''
            ),

            array(
                "type"          => "field",
                "field_type"    => "text",
                'id'            => 'payfast_passphrase',
                "title"         => __('Payfast Merchant passphrase', 'easybook-add-ons'),
                'desc'          => sprintf( __( 'Enter your PayFast passphrase. Learn how to create your <a href="%s">PayFast passphrase</a>.<br /><a href="%s">WooCommerce PayFast Payment Gateway</a>', 'easybook-add-ons' ), 'https://support.payfast.co.za/article/120-how-do-i-enable-a-passphrase-on-my-payfast-account', 'https://docs.woocommerce.com/document/payfast-payment-gateway/' ),
            ),

            array(
                "type"          => "field",
                "field_type"    => "text",
                'id'            => 'payfast_rate',
                'args'=> array(
                    'default'=> '13.9893',
                ),
                "title"         => __('ZAR currency rate', 'easybook-add-ons'),
                'desc'          => __('Exchange rates for your current currency to South African Rand ( ZAR )', 'easybook-add-ons'),
            ),

            array(
                "type"          => "field",
                "field_type"    => "checkbox",
                'id'            => 'email_confirmation',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title"         => __('Email Confirmation?', 'easybook-add-ons'),
                'desc'          => __( 'Whether to send email confirmation to the merchant of the transaction.', 'easybook-add-ons' ),
            ),

            array(
                "type"          => "field",
                "field_type"    => "text",
                'id'            => 'confirmation_address',
                "title"         => __( 'Confirmation Email Address', 'easybook-add-ons' ),
                'desc'          => __( 'The address to send the confirmation email to.', 'easybook-add-ons' ),
            ),
            
            
        ),
        // end tab array
            


        // end tab array
        'emails' => array(
            array(
                "type" => "section",
                'id' => 'email_section_1',
                "title" => __( 'General', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_name',
                "title" => __('Sender Name', 'easybook-add-ons'),
                'desc'  => __( 'This should probably be your listing sitename.', 'easybook-add-ons' ) ,
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_email',
                "title" => __('Sender Email', 'easybook-add-ons'),
                'desc'  => __( 'This will act as the "from" and "reply-to" email address.', 'easybook-add-ons' ) ,
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'emails_ctype',
                "title" => __('Email Template', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'html',
                    'options'=> array(
                        "html" => __('HTML Template','easybook-add-ons'), 
                        "plain" => __('Plain Text only','easybook-add-ons'),
                    ),
                )
            ),

            array(
                "type" => "section",
                'id' => 'emails_section_admin_new_listing',
                "title" => __( 'New Listing Admin Emails', 'easybook-add-ons' ),
                'callback' => function(){
                    echo '<p>'.esc_html__( 'New listing emails are sent to admin recipient(s) when a new listing is submitted.', 'easybook-add-ons' ).'</p>';
                }
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'emails_admin_new_listing_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'easybook-add-ons'),
                'desc'  => __('Enable this email notification', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_admin_new_listing_recipients',
                'args'=> array(
                    'default' => get_bloginfo('admin_email'),
                ),
                "title" => __('Recipient(s)', 'easybook-add-ons'),
                'desc'  => sprintf(__('Enter recipients (comma separated) for this email. Default is: %s', 'easybook-add-ons'), get_bloginfo('admin_email'))
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_admin_new_listing_subject',
                'args'=> array(
                    'default' => '[{site_title}] New listing ({listing_number}) {listing_title} - {listing_date}',
                ),
                "title" => __('Subject', 'easybook-add-ons'),
                'desc'  => __('Available template tags:<br />
        {site_title} - The site title<br />
        {listing_number} - Listing ID<br />
        {listing_title} - Listing Title<br />
        {listing_date} - Listing Date<br />', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'emails_admin_new_listing_temp',
                "title" => __('Email Template', 'easybook-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello Admin,</p>
<p style="text-align: left;">There is new listing from {listing_author}</p>
<p style="text-align: left;"><em>Listing Detials</em></p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;"><strong>Date:</strong> {listing_date}</p>
<p style="text-align: left;"><strong>ID:</strong> {listing_number}</p>
<p style="text-align: left;"><strong>Title:</strong> {listing_title}</p>
<p style="text-align: left;"><strong>Category:</strong> {listing_category}</p>
<p style="text-align: left;"><strong>Excerpt:</strong> {listing_excerpt}</p>
<p style="text-align: left;">-------------------------</p>',
                    
                    'desc' => __("Available template tags:<br />
        {site_title} - The site title<br />
        {listing_author} - The author's display name<br />
        {listing_number} - Listing ID<br />
        {listing_title} - Listing Title<br />
        {listing_category} - Listing categories<br />
        {listing_excerpt} - The listing excerpt<br />
        {listing_date} - The listing date.<br />",'easybook-add-ons'),

                )
            ),

            // end new listing admin emails

            array(
                "type" => "section",
                'id' => 'emails_section_auth_new_listing',
                "title" => __( 'New Listing Author Emails', 'easybook-add-ons' ),
                'callback' => function(){
                    echo '<p>'.esc_html__( 'New listing email are sent to author when a new listing is submitted.', 'easybook-add-ons' ).'</p>';
                }
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'emails_auth_new_listing_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'easybook-add-ons'),
                'desc'  => __('Enable this email notification', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_auth_new_listing_subject',
                'args'=> array(
                    'default' => '[{site_title}] Your new listing {listing_title}',
                ),
                "title" => __('Subject', 'easybook-add-ons'),
                'desc'  => __('Available template tags:<br />
        {site_title} - The site title<br />
        {listing_title} - Listing Title<br />', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'emails_auth_new_listing_temp',
                "title" => __('Email Template', 'easybook-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello {listing_author},</p>
<p style="text-align: left;">Thank you for submiting new listing to our site. We will review and publish it soon.</p>
<p style="text-align: left;"><em>Your Listing Detials</em></p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;"><strong>Title:</strong> {listing_title}</p>
<p style="text-align: left;"><strong>Category:</strong> {listing_category}</p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;">You can also edit the listing from <a href="{listing_dashboard}">dashboard</a> area to make it publish immediately by using paid plan.</p>',
                    
                    'desc' => __("Enter the email that is sent to listing author after completing a submission. Available template tags:<br />
        {site_title} - The site title<br />
        {listing_author} - The author's display name<br />
        {listing_title} - Listing Title<br />
        {listing_category} - Listing categories<br />
        {listing_dashboard} - The author dashboard page<br />",'easybook-add-ons'),

                )
            ),
            // end new listing author email
            array(
                "type" => "section",
                'id' => 'emails_section_admin_new_order',
                "title" => __( 'New Order Admin Emails', 'easybook-add-ons' ),
                'callback' => function(){
                    echo '<p>'.esc_html__( 'New order emails are sent to admin recipient(s) when a new order is received.', 'easybook-add-ons' ).'</p>';
                }
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'emails_admin_new_order_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'easybook-add-ons'),
                'desc'  => __('Enable this email notification', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_admin_new_order_recipients',
                'args'=> array(
                    'default' => get_bloginfo('admin_email'),
                ),
                "title" => __('Recipient(s)', 'easybook-add-ons'),
                'desc'  => sprintf(__('Enter recipients (comma separated) for this email. Default is: %s', 'easybook-add-ons'), get_bloginfo('admin_email'))
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_admin_new_order_subject',
                'args'=> array(
                    'default' => '[{site_title}] New order ({order_number}) {order_date}',
                ),
                "title" => __('Subject', 'easybook-add-ons'),
                'desc'  => __('Available template tags:<br />
        {site_title} - The site title<br />
        {order_number} - Order ID<br />
        {order_date} - Order Date<br />', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'emails_admin_new_order_temp',
                "title" => __('Email Template', 'easybook-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello Admin,</p>
<p style="text-align: left;">You have received an order from {author}</p>
<p style="text-align: left;"><em>Order Detials</em></p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;"><strong>Amount:</strong> {order_amount} {order_currency}</p>
<p style="text-align: left;"><strong>Payment method:</strong> {order_method}</p>
<p style="text-align: left;"><strong>Date:</strong> {order_date}</p>
<p style="text-align: left;"><strong>ID:</strong> {order_number}</p>
<p style="text-align: left;"><strong>For Plan:</strong> {plan_title}</p>
<p style="text-align: left;">-------------------------</p>',
                    
                    'desc' => __("Available template tags:<br />
        {site_title} - The site title<br />
        {author} - The order author's display name<br />
        {order_amount} - Order total/amount<br />
        {order_currency} - Order currency<br />
        {order_method} - Payment method<br />
        {order_number} - Order ID<br />
        {order_date} - Order Date<br />
        {plan_title} - The Plan<br />",'easybook-add-ons'),

                )
            ),
            // and new order admin emails
            array(
                "type" => "section",
                'id' => 'emails_section_admin_order_completed',
                "title" => __( 'Completed Order Admin Emails', 'easybook-add-ons' ),
                'callback' => function(){
                    echo '<p>'.esc_html__( 'New order emails are sent to admin recipient(s) when a order is paid (mark as completed).', 'easybook-add-ons' ).'</p>';
                }
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'emails_admin_order_completed_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'easybook-add-ons'),
                'desc'  => __('Enable this email notification', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_admin_order_completed_recipients',
                'args'=> array(
                    'default' => get_bloginfo('admin_email'),
                ),
                "title" => __('Recipient(s)', 'easybook-add-ons'),
                'desc'  => sprintf(__('Enter recipients (comma separated) for this email. Default is: %s', 'easybook-add-ons'), get_bloginfo('admin_email'))
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_admin_order_completed_subject',
                'args'=> array(
                    'default' => '[{site_title}] Order from {order_date} is complete',
                ),
                "title" => __('Subject', 'easybook-add-ons'),
                'desc'  => __('Available template tags:<br />
        {site_title} - The site title<br />
        {order_number} - Order ID<br />
        {order_date} - Order Date<br />', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'emails_admin_order_completed_temp',
                "title" => __('Email Template', 'easybook-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello Admin,</p>
<p style="text-align: left;">An order from {author} is paid (or mark as completed)</p>
<p style="text-align: left;"><em>Order Detials</em></p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;"><strong>Amount:</strong> {order_amount} {order_currency}</p>
<p style="text-align: left;"><strong>Payment method:</strong> {order_method}</p>
<p style="text-align: left;"><strong>Date:</strong> {order_date}</p>
<p style="text-align: left;"><strong>ID:</strong> {order_number}</p>
<p style="text-align: left;"><strong>For Plan:</strong> {plan_title}</p>
<p style="text-align: left;">-------------------------</p>',
                    
                    'desc' => __("Available template tags:<br />
        {site_title} - The site title<br />
        {author} - The order author's display name<br />
        {order_amount} - Order total/amount<br />
        {order_currency} - Order currency<br />
        {order_method} - Payment method<br />
        {order_number} - Order ID<br />
        {order_title} - Order Title<br />
        {order_date} - Order Date<br />
        {plan_title} - The Plan<br />",'easybook-add-ons'),

                )
            ),
            // and completed order admin emails
            array(
                "type" => "section",
                'id' => 'emails_section_auth_order_completed',
                "title" => __( 'Completed Order Author Emails', 'easybook-add-ons' ),
                'callback' => function(){
                    echo '<p>'.esc_html__( 'New order emails are sent to listing author when an order is paid (mark as completed).', 'easybook-add-ons' ).'</p>';
                }
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'emails_auth_order_completed_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'easybook-add-ons'),
                'desc'  => __('Enable this email notification', 'easybook-add-ons'),
            ),

            

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_auth_order_completed_subject',
                'args'=> array(
                    'default' => '[{site_title}] Your order from {order_date} is complete',
                ),
                "title" => __('Subject', 'easybook-add-ons'),
                'desc'  => __('Available template tags:<br />
        {site_title} - The site title<br />
        {order_number} - Order ID<br />
        {order_date} - Order Date<br />', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'emails_auth_order_completed_temp',
                "title" => __('Email Template', 'easybook-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello {author},</p>
<p style="text-align: left;">Your order is completed</p>
<p style="text-align: left;"><em>Order Detials</em></p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;"><strong>Amount:</strong> {order_amount} {order_currency}</p>
<p style="text-align: left;"><strong>Payment method:</strong> {order_method}</p>
<p style="text-align: left;"><strong>Date:</strong> {order_date}</p>
<p style="text-align: left;"><strong>ID:</strong> {order_number}</p>
<p style="text-align: left;"><strong>For Plan:</strong> {plan_title}</p>
<p style="text-align: left;">-------------------------</p>',
                    
                    'desc' => __("Available template tags:<br />
        {site_title} - The site title<br />
        {author} - The order author's display name<br />
        {order_amount} - Order total/amount<br />
        {order_currency} - Order currency<br />
        {order_method} - Payment method<br />
        {order_number} - Order ID<br />
        {order_title} - Order Title<br />
        {order_date} - Order Date<br />
        {plan_title} - The Plan<br />",'easybook-add-ons'),

                )
            ),
            // and completed order author emails





            // and new invoice admin emails
            array(
                "type" => "section",
                'id' => 'emails_admin_new_invoice',
                "title" => __( 'New Invoice Admin Emails', 'easybook-add-ons' ),
                'callback' => function(){
                    echo '<p>'.esc_html__( 'Email send to admin recipient(s) when a new invoice is created. This can be invoice for new order/subscription or renew invoice for recurring subscription.', 'easybook-add-ons' ).'</p>';
                }
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'emails_admin_new_invoice_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'easybook-add-ons'),
                'desc'  => __('Enable this email notification', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_admin_new_invoice_recipients',
                'args'=> array(
                    'default' => get_bloginfo('admin_email'),
                ),
                "title" => __('Recipient(s)', 'easybook-add-ons'),
                'desc'  => sprintf(__('Enter recipients (comma separated) for this email. Default is: %s', 'easybook-add-ons'), get_bloginfo('admin_email'))
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_admin_new_invoice_subject',
                'args'=> array(
                    'default' => '[{site_title}] New Invoice #{number}',
                ),
                "title" => __('Subject', 'easybook-add-ons'),
                'desc'  => __('Available template tags:<br />
        {site_title} - The site title<br />
        {number} - Invoice ID<br />
        {date} - Invoice Date<br />', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'emails_admin_new_invoice_temp',
                "title" => __('Email Template', 'easybook-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello Admin,</p>
<p style="text-align: left;">New invoice from {author}</p>
<p style="text-align: left;"><em>Invoice Detials</em></p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;"><strong>Amount:</strong> {amount}</p>
<p style="text-align: left;"><strong>Payment method:</strong> {method}</p>
<p style="text-align: left;"><strong>Date:</strong> {date}</p>
<p style="text-align: left;"><strong>ID:</strong> {number}</p>
<p style="text-align: left;"><strong>For Plan:</strong> {plan}</p>
<p style="text-align: left;"><strong>Expire at:</strong> {expire}</p>
<p style="text-align: left;">-------------------------</p>',
                    
                    'desc' => __("Available template tags:<br />
        {site_title} - The site title<br />
        {author} - The Invoice author's display name<br />
        {amount} - Invoice total/amount<br />
        {method} - Payment method<br />
        {number} - Invoice ID<br />
        {title} - Invoice Title<br />
        {expire} - Invoice expiration date<br />
        {plan} - Subscription plan title<br />
        {date} - Invoice Date<br />",'easybook-add-ons'),

                )
            ),
            // end new invoice admin emails
            array(
                "type" => "section",
                'id' => 'emails_auth_new_invoice',
                "title" => __( 'New Invoice Author Emails', 'easybook-add-ons' ),
                'callback' => function(){
                    echo '<p>'.esc_html__( 'Email send to listing author when a new invoice is created. This can be invoice for new order/subscription or renew invoice for recurring subscription.', 'easybook-add-ons' ).'</p>';
                }
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'emails_auth_new_invoice_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'easybook-add-ons'),
                'desc'  => __('Enable this email notification', 'easybook-add-ons'),
            ),

            

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_auth_new_invoice_subject',
                'args'=> array(
                    'default' => '[{site_title}] New Invoice #{number} for you',
                ),
                "title" => __('Subject', 'easybook-add-ons'),
                'desc'  => __('Available template tags:<br />
        {site_title} - The site title<br />
        {number} - Invoice ID<br />
        {date} - Invoice Date<br />', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'emails_auth_new_invoice_temp',
                "title" => __('Email Template', 'easybook-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<div style="width:595px;min-height:842px;margin:0 auto;padding:56px 56px 48px;font-family:Roboto,Helvetica,Arial,sans-serif;font-weight:normal;box-sizing:border-box">
<p style="text-align: left;">Hello {author},</p>
<p style="text-align: left;">We received payment for your subscription {title}</p>
<table style="border-collapse:collapse;width:100%">
        <tbody><tr>
            <td colspan="2" style="width:40%;padding:10px 0;border-bottom:1px solid rgba(188,181,185,0.3);line-height:16px;font-size:14px;color:#574751">
                Date
            </td>
            <td colspan="3" style="width:60%;padding:10px 0 10px 10px;border-bottom:1px solid rgba(188,181,185,0.3);line-height:16px;font-size:14px;font-weight:700;color:#574751">
                {date}
            </td>
        </tr>
        <tr>
            <td colspan="2" style="width:40%;padding:10px 0;border-bottom:1px solid rgba(188,181,185,0.3);line-height:16px;font-size:14px;color:#574751">
                Subscribed with
            </td>
            <td colspan="3" style="width:60%;padding:10px 0 10px 10px;border-bottom:1px solid rgba(188,181,185,0.3);line-height:16px;font-size:14px;font-weight:700;color:#574751">
                {author}
            </td>
        </tr>
        
        <tr>
            <td colspan="2" style="width:40%;padding:10px 0;border-bottom:1px solid rgba(188,181,185,0.3);line-height:16px;font-size:14px;color:#574751">
                Charged via
            </td>
            <td colspan="3" style="width:60%;padding:10px 0 10px 10px;border-bottom:1px solid rgba(188,181,185,0.3);line-height:16px;font-size:14px;font-weight:700;color:#574751">
                
                    {method}
                
            </td>
        </tr>
        
        
        <tr>
            <td colspan="2" style="width:40%;padding:10px 0;border-bottom:1px solid rgba(188,181,185,0.3);line-height:16px;font-size:14px;color:#574751">
                Expiration date
            </td>
            <td colspan="3" style="width:60%;padding:10px 0 10px 10px;border-bottom:1px solid rgba(188,181,185,0.3);line-height:16px;font-size:14px;font-weight:700;color:#574751">
                <span>{expire}</span>
            </td>
        </tr>
        
        
        <tr>
            <td colspan="4" style="width:80%;padding:10px 0;border-bottom:1px solid rgba(188,181,185,0.3);line-height:16px;font-size:14px;color:#574751">
                Subscription to {plan}
            </td>
            <td style="width:20%;padding:10px 0 10px 10px;border-bottom:1px solid rgba(188,181,185,0.3);text-align:right;line-height:16px;font-size:14px;color:#574751">
                {amount}
            </td>
        </tr>
        
        <tr>
            <td colspan="2" style="width:40%;padding:10px 0;border-bottom:1px solid rgba(188,181,185,0.3);text-align:right;line-height:16px;font-size:14px;font-weight:700;color:#bcb5b9">
                Subtotal
            </td>
            <td colspan="3" style="width:60%;padding:10px 0 10px 10px;border-bottom:1px solid rgba(188,181,185,0.3);text-align:right;line-height:16px;font-size:14px;color:#574751">
                {amount}
            </td>
        </tr>
        <tr>
            <td colspan="2" style="width:40%;padding:10px 0;border-bottom:1px solid rgba(188,181,185,0.3);text-align:right;line-height:16px;font-size:14px;font-weight:700;color:#bcb5b9">
                Total
            </td>
            <td colspan="3" style="width:60%;padding:10px 0 10px 10px;border-bottom:1px solid rgba(188,181,185,0.3);text-align:right;line-height:16px;font-size:14px;color:#574751">
                {amount}
            </td>
        </tr>
        
        
        <tr>
            <td colspan="2" style="width:40%;padding:10px 0;text-align:right;line-height:16px;font-size:14px;font-weight:700;color:#574751">
                Paid
            </td>
            <td colspan="3" style="width:60%;padding:10px 0 10px 10px;text-align:right;line-height:16px;font-size:14px;font-weight:700;color:#574751">
                {amount}
            </td>
        </tr>
        
    </tbody></table>
<div style="width:150px;margin-top:70px">
    <div style="font-weight:700;line-height:25px;font-size:22px;color:#bcb5b9">
        Thank you!
    </div>
    <div style="margin-top:12px;font-weight:500;line-height:16px;font-size:14px;color:#574751">
        CTHthemes
    </div>
</div>
</div>',
                    
                    'desc' => __("Available template tags:<br />
        {site_title} - The site title<br />
        {author} - The Invoice author's display name<br />
        {amount} - Invoice total/amount<br />
        {method} - Payment method<br />
        {number} - Invoice ID<br />
        {title} - Invoice Title<br />
        {expire} - Invoice expiration date<br />
        {plan} - Subscription plan title<br />
        {date} - Invoice Date<br />",'easybook-add-ons'),

                )
            ),
            // and new invoice author emails






            // and booking author emails
            array(
                "type" => "section",
                'id' => 'emails_section_auth_booking_insert',
                "title" => __( 'New Booking Author Emails', 'easybook-add-ons' ),
                'callback' => function(){
                    echo '<p>'.esc_html__( 'Emails send to author when a customer booked their listing.', 'easybook-add-ons' ).'</p>';
                }
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'emails_section_auth_booking_insert_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'easybook-add-ons'),
                'desc'  => __('Enable this email notification', 'easybook-add-ons'),
            ),

            

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_section_auth_booking_insert_subject',
                'args'=> array(
                    'default' => '[{site_title}] New booking for {listing_title}',
                ),
                "title" => __('Subject', 'easybook-add-ons'),
                'desc'  => __('Available template tags:<br />
        {site_title} - The site title<br />
        {listing_title} - Listing title', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'emails_section_auth_booking_insert_temp',
                "title" => __('Email Template', 'easybook-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello {author},</p>
<p style="text-align: left;">You have a new booking for {listing_title}</p>
<p style="text-align: left;"><em>Booking Detials</em></p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;"><strong>Name:</strong> {name}</p>
<p style="text-align: left;"><strong>Email:</strong> {email}</p>
<p style="text-align: left;"><strong>Phone:</strong> {phone}</p>
<p style="text-align: left;"><strong>Room Type:</strong> {room_type}</p>
<p style="text-align: left;"><strong>Day:</strong> {day}</p>
<p style="text-align: left;"><strong>Persons:</strong> {person}</p>
<p style="text-align: left;">-------------------------</p>',
                    
                    'desc' => __("Available template tags:<br />
        {site_title} - The site title<br />
        {author} - The order author's display name<br />
        {name} - Customer name<br />
        {email} - Cusotmer email<br />
        {phone} - Customer phone number<br />
        {room_type} - Room Type<br />
        {day} - Booking Date<br />
        {person} - Persons<br />
        {listing_title} - The listing title<br />",'easybook-add-ons'),

                )
            ),
            // and booking author emails

            // and booking customer email
            array(
                "type" => "section",
                'id' => 'emails_section_customer_booking_insert',
                "title" => __( 'New Booking Customer Email', 'easybook-add-ons' ),
                'callback' => function(){
                    echo '<p>'.esc_html__( 'Email send to customer book a listing.', 'easybook-add-ons' ).'</p>';
                }
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'emails_section_customer_booking_insert_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'easybook-add-ons'),
                'desc'  => __('Enable this email notification', 'easybook-add-ons'),
            ),

            

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_section_customer_booking_insert_subject',
                'args'=> array(
                    'default' => '[{site_title}] Your booking for {listing_title} listing is received',
                ),
                "title" => __('Subject', 'easybook-add-ons'),
                'desc'  => __('Available template tags:<br />
        {site_title} - The site title<br />
        {listing_title} - Listing title', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'emails_section_customer_booking_insert_temp',
                "title" => __('Email Template', 'easybook-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello {name},</p>
<p style="text-align: left;">You have booked for {listing_title} listing</p>
<p style="text-align: left;"><em>Booking Detials</em></p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;"><strong>Name:</strong> {name}</p>
<p style="text-align: left;"><strong>Email:</strong> {email}</p>
<p style="text-align: left;"><strong>Phone:</strong> {phone}</p>
<p style="text-align: left;"><strong>Room Type:</strong> {room_type}</p>
<p style="text-align: left;"><strong>Day:</strong> {day}</p>
<p style="text-align: left;"><strong>Persons:</strong> {person}</p>
<p style="text-align: left;">-------------------------</p>',
                    
                    'desc' => __("Available template tags:<br />
        {site_title} - The site title<br />
        {author} - The order author's display name<br />
        {name} - Customer name<br />
        {email} - Cusotmer email<br />
        {phone} - Customer phone number<br />
        {room_type} - Room Type<br />
        {day} - Booking Date<br />
        {person} - Persons<br />
        {listing_title} - The listing title<br />",'easybook-add-ons'),

                )
            ),
            // and booking customer email

            // and booking approved customer email
            array(
                "type" => "section",
                'id' => 'emails_section_customer_booking_approved',
                "title" => __( 'Approved Booking Customer Email', 'easybook-add-ons' ),
                'callback' => function(){
                    echo '<p>'.esc_html__( 'Email send to customer when a booking is approved.', 'easybook-add-ons' ).'</p>';
                }
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'emails_section_customer_booking_approved_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'easybook-add-ons'),
                'desc'  => __('Enable this email notification', 'easybook-add-ons'),
            ),

            

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_section_customer_booking_approved_subject',
                'args'=> array(
                    'default' => '[{site_title}] Your booking for {listing_title} listing is approved',
                ),
                "title" => __('Subject', 'easybook-add-ons'),
                'desc'  => __('Available template tags:<br />
        {site_title} - The site title<br />
        {listing_title} - Listing title', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'emails_section_customer_booking_approved_temp',
                "title" => __('Email Template', 'easybook-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello {name},</p>
<p style="text-align: left;">Your booking for {listing_title} listing is approved.</p>
<p style="text-align: left;"><em>Booking Detials</em></p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;"><strong>Name:</strong> {name}</p>
<p style="text-align: left;"><strong>Email:</strong> {email}</p>
<p style="text-align: left;"><strong>Phone:</strong> {phone}</p>
<p style="text-align: left;"><strong>Room Type:</strong> {room_type}</p>
<p style="text-align: left;"><strong>Day:</strong> {day}</p>
<p style="text-align: left;"><strong>Persons:</strong> {person}</p>
<p style="text-align: left;">-------------------------</p>',
                    
                    'desc' => __("Available template tags:<br />
        {site_title} - The site title<br />
        {author} - The order author's display name<br />
        {name} - Customer name<br />
        {email} - Cusotmer email<br />
        {phone} - Customer phone number<br />
        {room_type} - Room Type<br />
        {day} - Booking Date<br />
        {person} - Persons<br />
        {listing_title} - The listing title<br />",'easybook-add-ons'),

                )
            ),
            // and booking approved customer email

            array(
                "type" => "section",
                'id' => 'emails_section_auth_claim',
                "title" => __( 'Listing Claim Fee Request Email', 'easybook-add-ons' ),
                'callback' => function(){
                    echo '<p>'.esc_html__( 'Email send to author when his listing claim post is request to charge a fee.', 'easybook-add-ons' ).'</p>';
                }
            ),

            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'emails_section_customer_booking_approved_enable',
            //     'args'=> array(
            //         'default' => 'yes',
            //         'value' => 'yes',
            //     ),
            //     "title" => __('Enable/Disable', 'easybook-add-ons'),
            //     'desc'  => __('Enable this email notification', 'easybook-add-ons'),
            // ),

            
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_auth_claim_subject',
                'args'=> array(
                    'default' => '[{site_title}] Claim listing fee request',
                ),
                "title" => __('Subject', 'easybook-add-ons'),
                'desc'  => __('Available template tags:<br />
        {site_title} - The site title<br />
        {id} - Claim post id<br />
        {date} - Email sending date', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'emails_auth_claim_temp',
                "title" => __('Email Template', 'easybook-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello {author},</p>
<p style="text-align: left;">You listing claim details:</p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;"><strong>For listing:</strong> <a href="{listing_url}" target="_blank">{listing_title}</a></p>
<p style="text-align: left;"><strong>Claim Time:</strong> {date}</p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;">Please follow this link <a href="{add_to_cart}" target="_blank">{add_to_cart}</a> to pay for the claim fee. <br />After you finish, you will have immediate be owner of the listing and access to all of our business tools!</p>',
                    
                    'desc' => __("Available template tags:<br />
        {site_title} - The site title<br />
        {author} - The order author's display name<br />
        {date} - Claim created date<br />
        {add_to_cart} - Add to cart link, allow author pay the fee<br />
        {listing_id} - Listing ID<br />
        {listing_title} - Listing title<br />
        {listing_url} - The listing url<br />",'easybook-add-ons'),

                )
            ),
            // claim listing email

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'new_chat_temp',
                "title" => __('New Chat Reply Email Template', 'easybook-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello {receiver},</p>
<p style="text-align: left;">{replyer} has just replied you on {site_title}</p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;">{reply_text}</p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;">Please login to view details.</p>',
                    
                    'desc' => __("Available template tags:<br />
        {site_title} - The site title<br />
        {receiver} -  Receiver name<br />
        {reply_text} - Reply Text<br />
        {date} - date<br />
        {replyer} - replyer name<br />",'easybook-add-ons'),

                )
            ),
            // new chat email
            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'new_auth_msg_temp',
                "title" => __('New Message Email Template', 'easybook-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello {author},</p>
<p style="text-align: left;">{name} has just sent you a message on {site_title}</p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;">{phone}</p>
<p style="text-align: left;">{message}</p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;">Reply him or login to view details.</p>',
                    
                    'desc' => __("Available template tags:<br />
        {site_title} - The site title<br />
        {author} -  Author name<br />
        {message} - Message text<br />
        {date} - date<br />
        {name} - User name<br />
        {phone} - User phone<br />",'easybook-add-ons'),

                )
            ),
            // new auth message email

        ),
        // end tab array

        'widgets' => array(


            array(
                "type" => "section",
                'id' => 'mailchimp_sub_section',
                "title" => __( 'Mailchimp Section', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'mailchimp_api',
                "title" => __('Mailchimp API key', 'easybook-add-ons'),
                'desc'  => '<a href="'.esc_url('http://kb.mailchimp.com/accounts/management/about-api-keys#Finding-or-generating-your-API-key').'" target="_blank">'.esc_html__('Find your API key','easybook-add-ons' ).'</a>'
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'mailchimp_list_id',
                "title" => __('Mailchimp List ID', 'easybook-add-ons'),
                'desc'  => '<a href="'.esc_url('http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id').'" target="_blank">'.esc_html__('Find your list ID','easybook-add-ons' ).'</a>',
            ),
        
            array(
                "type" => "field",
                "field_type" => "info",
                'id' => 'mailchimp_shortcode',
                "title" => __('Subscribe Shortcode', 'easybook-add-ons'),
                'desc'  => wp_kses_post( __('Use the <code><strong>[easybook_subscribe]</strong></code> shortcode  to display subscribe form inside a post, page or text widget.
<br />Available Variables:<br />
<code><strong>message</strong></code> (Optional) - The message above subscription form.<br />
<code><strong>placeholder</strong></code> (Optional) - The form placeholder text.<br />
<code><strong>button</strong></code> (Optional) - The submit button text.<br />
<code><strong>list_id</strong></code> (Optional) - List ID. If you want user subscribe to a different list from the option above.<br />
<code><strong>class</strong></code> (Optional) - Your extraclass used to style the form.<br /><br />
Example: <code><strong>[easybook_subscribe list_id="b02fb5f96f" class="your_class_here"]</strong></code>', 'easybook-add-ons') )
                
            ),

            array(
                "type" => "section",
                'id' => 'tweets_section',
                "title" => __( 'Twitter Feeds Section', 'easybook-add-ons' ),
                'callback' => function($arg){ 
                    echo '<p>'.esc_html__('Visit ','easybook-add-ons' ).
                        '<a href="'.esc_url('https://apps.twitter.com' ).'" target="_blank">'.esc_html__("Twitter's Application Management",'easybook-add-ons' ).'</a> '
                        .__('page, sign in with your account, click on Create a new application and create your own keys if you haven\'t one.<br /> Fill all the fields bellow with those keys.','easybook-add-ons' ).
                        '</p>';  
                }
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'consumer_key',
                "title" => __('Consumer Key', 'easybook-add-ons'),
                'desc'  => ''
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'consumer_secret',
                "title" => __('Consumer Secret', 'easybook-add-ons'),
                'desc'  => ''
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'access_token',
                "title" => __('Access Token', 'easybook-add-ons'),
                'desc'  => ''
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'access_token_secret',
                "title" => __('Access Token Secret', 'easybook-add-ons'),
                'desc'  => ''
            ),
            array(
                "type" => "field",
                "field_type" => "info",
                'id' => 'tweets_shortcode',
                "title" => __('Access Token Secret', 'easybook-add-ons'),
                'desc'  => wp_kses_post( __('You can use <code><strong>EasyBook Twitter Feed</strong></code> widget or  <code><strong>[easybook_tweets]</strong></code> shortcode  to display tweets inside a post, page or text widget.
<br />Available Variables:<br />
<code><strong>username</strong></code> (Optional) - Option to load tweets from another account. Leave this empty to load from your own.<br />
<code><strong>list</strong></code> (Optional) - List name to load tweets from. If you define list name you also must define the <strong>username</strong> of the list owner.<br />
<code><strong>hashtag</strong></code> (Optional) - Option to load tweets with a specific hashtag.<br />
<code><strong>count</strong></code> (Required) - Number of tweets you want to display.<br />
<code><strong>list_ticker</strong></code> (Optional) - Display tweets as a list ticker?. Values: <strong>yes</strong> or <strong>no</strong><br />
<code><strong>follow_url</strong></code> (Optional) - Follow us link.<br />
<code><strong>extraclass</strong></code> (Optional) - Your extraclass used to style the form.<br /><br />
Example: <code><strong>[easybook_tweets count="3" username="CTHthemes" list_ticker="no" extraclass="your_class_here"]</strong></code>', 'easybook-add-ons') )
                
            ),
            // api weather
            array(
                "type" => "section",
                'id' => 'weather_api_section',
                "title" => __( 'Weather Section', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'weather_api',
                "title" => __('Weather API key', 'easybook-add-ons'),
                'desc'  => '<a href="'.esc_url('https://openweathermap.org/api').'" target="_blank">'.esc_html__('Find your API key','easybook-add-ons' ).'</a>'
            ),
            // socials share
            array(
                "type" => "section",
                'id' => 'widgets_section_3',
                "title" => __( 'Socials Share', 'easybook-add-ons' ),
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'widgets_share_names',
                "title" => __('Socials Share', 'easybook-add-ons'),
                'desc'  => __('Enter your social share names separated by a comma.<br /> List bellow are available names:<strong><br /> facebook,twitter,linkedin,in1,tumblr,digg,googleplus,reddit,pinterest,stumbleupon,email,vk</strong>', 'easybook-add-ons'),
                'args'=> array(
                    'default' => 'facebook, pinterest, googleplus, twitter, linkedin'
                ),
            ),


        ),
        // end tab array

        // end tab array
        'maintenance' => array(
            array(
                "type" => "section",
                'id' => 'maintenance_section_1',
                "title" => __( 'Status', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "radio",
                'id' => 'maintenance_mode',
                "title" => __('Mode', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'disable',
                    'options'=> array(
                        'disable' => __( 'Disable', 'easybook-add-ons' ),
                        'maintenance' => __( 'Maintenance', 'easybook-add-ons' ),
                        'coming_soon' => __( 'Coming Soon', 'easybook-add-ons' ),
                    ),
                    'options_block' => true
                )
            ),
            array(
                "type" => "section",
                'id' => 'maintenance_section_2',
                "title" => __( 'Maintenance Options', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'maintenance_msg',
                "title" => __('Message', 'easybook-add-ons'),
                'args' => array(
                    'default'  => '<h3 class="soon-title">We\'ll be right back!</h3>
<p>We are currently performing some quick updates. Leave us your email and we\'ll let you know as soon as we are back up again.</p>
[easybook_subscribe message=""]
<div class="cs-social fl-wrap">
<ul>
<li><a href="#" target="_blank" ><i class="fab fa-facebook"></i></a></li>
<li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
<li><a href="#" target="_blank" ><i class="fab fa-chrome"></i></a></li>
<li><a href="#" target="_blank" ><i class="fab fa-vk"></i></a></li>
<li><a href="#" target="_blank" ><i class="fab fa-whatsapp"></i></a></li>
</ul>
</div>',
                ),
                'desc'  => ''
            ),

            array(
                "type" => "section",
                'id' => 'maintenance_section_3',
                "title" => __( 'Coming Soon Options', 'easybook-add-ons' ),
            ),
            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'coming_soon_msg',
                "title" => __('Message', 'easybook-add-ons'),
                'args' => array(
                    'default'  => '<h3 class="soon-title">Our website is coming soon!</h3>',
                ),
                'desc'  => ''
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'coming_soon_date',
                "title" => __('Coming Soon Date', 'easybook-add-ons'),
                'args' => array(
                    'default'  => '09/12/2021',
                ),
                'desc'  => __('The date should be DD/MM/YYYY format. Ex: 09/12/2021', 'easybook-add-ons'),
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'coming_soon_time',
                "title" => __('Coming Soon Time', 'easybook-add-ons'),
                'args' => array(
                    'default'  => '10:30:00',
                ),
                'desc'  => __('The time should be hh:mm:ss format. Ex: 10:30:00', 'easybook-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "number",
                'id' => 'coming_soon_tz',
                "title" => __('Timezone Offset', 'easybook-add-ons'),
                'args' => array(
                    'default'  => '0',
                    'min'  => '-12',
                    'max'  => '14',
                    'step'  => '1',
                ),
                'desc'  => __('Timezone offset value from UTC', 'easybook-add-ons'),
            ),
            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'coming_soon_msg_after',
                "title" => __('Message After', 'easybook-add-ons'),
                'args' => array(
                    'default'  => '[easybook_subscribe]
<div class="cs-social fl-wrap">
<ul>
<li><a href="#" target="_blank" ><i class="fa fa-facebook-official"></i></a></li>
<li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
<li><a href="#" target="_blank" ><i class="fa fa-chrome"></i></a></li>
<li><a href="#" target="_blank" ><i class="fa fa-vk"></i></a></li>
<li><a href="#" target="_blank" ><i class="fa fa-whatsapp"></i></a></li>
</ul>
</div>',
                ),
                'desc'  => ''
            ),

            array(
                "type" => "field",
                "field_type" => "image",
                'id' => 'coming_soon_bg',
                "title" => __('Background', 'easybook-add-ons'),
                'desc'  => ''
            ),


        ),
        // end tab array
        
        'chat'      => array(

            array(
                "type" => "section",
                'id' => 'chat_general_sec',
                "title" => __( 'Chat', 'easybook-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "toggle_chat",
                'id' => 'toggle_chat',
                "title" => __('Toggle chat server', 'easybook-add-ons'),
                'args'=> array(
                    'default'=> 'both',
                )
            ),
        ),
        // end chat array


    );
}