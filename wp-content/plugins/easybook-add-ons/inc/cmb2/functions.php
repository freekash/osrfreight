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



function cmb2_render_callback_for_icon_picker( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
    echo $field_type_object->input( array( 'type' => 'icon_picker' ) );
}
add_action( 'cmb2_render_icon_picker', 'cmb2_render_callback_for_icon_picker', 10, 5 );

function cmb2_sanitize_icon_picker_callback( $override_value, $value ) {
    return $value;
}
add_filter( 'cmb2_sanitize_icon_picker', 'cmb2_sanitize_icon_picker_callback', 10, 2 );

/* cmb2 dependency field */
function easybook_cmb2_admin_scripts() {
    // Adding custom admin scripts file
    wp_enqueue_script( 'easybook_cmb2_admin', ESB_DIR_URL . 'inc/assets/depends_cmb2.js', array( 'jquery' ));

    // Registering and adding custom admin css
    wp_register_style( 'easybook_cmb2_admin', ESB_DIR_URL . 'inc/assets/depends_cmb2.css', false, '1.0.0' );
    wp_enqueue_style( 'easybook_cmb2_admin' ); 
}

add_action( 'admin_enqueue_scripts', 'easybook_cmb2_admin_scripts' );





add_action( 'cmb2_admin_init', 'easybook_cmb2_sample_metaboxes' ); 
/**
 * Define the metabox and field configurations.
 */
function easybook_cmb2_sample_metaboxes() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_cth_';

    /**
     * Initiate Post metabox
     */
    $post_cmb = new_cmb2_box( array(
        'id'            => 'post_options',
        'title'         => esc_html__( 'Post Format Options', 'easybook-add-ons' ),
        'object_types'  => array( 'post'), // Post type
        'context'       => 'normal',// normal, side and advanced
        'priority'      => 'high',// default, high and low - core
        'show_names'    => true, // Show field names on the left
    ) );

    $post_cmb->add_field( array(
        'name' => esc_html__('Post Slider and Gallery Images', 'easybook-add-ons' ),
        'id'   => $prefix . 'post_slider_images',
        'type' => 'file_list',
        'preview_size' => array( 150, 150 ), // Default: array( 50, 50 )
    ) );

    $post_cmb->add_field( array(
        'name' => esc_html__('Gallery Columns', 'easybook-add-ons' ),
        'desc' => esc_html__('For Gallery post format only.','easybook-add-ons'),
        'id'   => $prefix . 'gallery_cols',
        'type'    => 'select',
        'default'=>'three',
        'options' => array(
            'one' => esc_html__( 'One column', 'easybook-add-ons' ),
            'two'   => esc_html__( 'Two columns', 'easybook-add-ons' ),
            'three'   => esc_html__( 'Three columns', 'easybook-add-ons' ),
            'four'   => esc_html__( 'Four columns', 'easybook-add-ons' ),
            'five'   => esc_html__( 'Five columns', 'easybook-add-ons' ),
            
        ),
    ) );

    $post_cmb->add_field( array(
        'name'       => esc_html__('oEmbed for Post Format', 'easybook-add-ons' ),
        'desc'       => wp_kses(__('Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.', 'easybook-add-ons' ),array('a'=>array('href'=>array()))),
        'id'   => $prefix . 'embed_video',
        'type' => 'oembed',
    ) );

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Initiate Post metabox 2
     */
    $post2_cmb = new_cmb2_box( array(
        'id'            => 'post_layout_options',
        'title'         => esc_html__( 'Post Layout Options', 'easybook-add-ons' ),
        'object_types'  => array( 'post'), // Post type
        'context'       => 'normal',// normal, side and advanced
        'priority'      => 'high',// default, high and low - core
        'show_names'    => true, // Show field names on the left
    ) );

   

    $post2_cmb->add_field( array(
        'name' => esc_html__('Show Post Header', 'easybook-add-ons' ), 
        'id'   => $prefix . 'show_page_header',
        'type'    => 'radio_inline',
        'default'=>'yes',
        'options' => array(
            'yes' => esc_html__( 'Yes', 'easybook-add-ons' ),
            'no'   => esc_html__( 'No', 'easybook-add-ons' ),
            
        ),
    ) );

    $post2_cmb->add_field( array(
        'name' => esc_html__('Header Image Background', 'easybook-add-ons' ),
        'id'   => $prefix . 'page_header_bg',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => true, // Hide the text input for the url
            
        ),
    ) );

    $post2_cmb->add_field( array(
        'name' => esc_html__('Show Post Title in header', 'easybook-add-ons' ),
        'id'   => $prefix . 'show_page_title',
        'type'    => 'radio_inline',
        'default'=>'yes',
        'options' => array(
            'yes' => esc_html__( 'Yes', 'easybook-add-ons' ),
            'no'   => esc_html__( 'No', 'easybook-add-ons' ),
            
        ),
    ) );



    // $post2_cmb->add_field( array(
    //     'name' => esc_html__('Header Subtitle', 'easybook-add-ons' ),
    //     'id'   => $prefix . 'page_header_sub',
    //     'type' => 'text'
    // ) );

    $post2_cmb->add_field( array(
        'name' => esc_html__('Header Additional Info', 'easybook-add-ons' ),
        'id'   => $prefix . 'page_header_intro',
        'type' => 'textarea_small'
    ) );



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Initiate Post featured
     */
    $post3_cmb = new_cmb2_box( array(
        'id'            => 'post_featured_options',
        'title'         => esc_html__( 'Featured', 'easybook-add-ons' ),
        'object_types'  => array( 'post'), // Post type
        'context'       => 'side',// normal, side and advanced
        'priority'      => 'high',// default, high and low - core
        'show_names'    => true, // Show field names on the left
    ) );

    $post3_cmb->add_field( array(
        'name' => esc_html__( 'Is Featured post', 'easybook-add-ons' ),
        'id' => $prefix . 'is_featured',
        'type'             => 'select',
        'show_option_none' => false,
        'default'          => 'no',
        'options'          => array(
            'no' => esc_html__( 'No', 'easybook-add-ons' ),
            'yes' => esc_html__( 'Yes', 'easybook-add-ons' ),
        ),
    ) );
    // listing type
    $plan_ltype_cmb = new_cmb2_box( array(
        'id'            => 'lplan_ltype_fields',
        'title'         => esc_html__('Listing Types', 'easybook-add-ons' ),
        'object_types'  => array( 'lplan'), // Post type
        'context'       => 'normal',// normal, side and advanced
        'priority'      => 'high',// default, high and low - core
        'show_names'    => true, // Show field names on the left
    ) );
    $plan_ltype_cmb->add_field( array(
        'name'    => esc_html__('Listing Type', 'easybook-add-ons' ),
        'desc'    => __('Select listing types which author subscribed for this plan can submit listings to', 'easybook-add-ons' ),
        'id'      => $prefix . 'listing_types',
        'type'    => 'multicheck',
        'options' => easybook_addons_get_listing_type_options(),
    ) );
    

///////////////////////////////////////////// 
    /**
     * Initiate Plan metabox
     */
    $plan_cmb = new_cmb2_box( array(
        'id'            => 'lplan_fields',
        'title'         => esc_html__('Plan Options', 'easybook-add-ons' ),
        'object_types'  => array( 'lplan'), // Post type
        'context'       => 'normal',// normal, side and advanced
        'priority'      => 'high',// default, high and low - core
        'show_names'    => true, // Show field names on the left
    ) );

    $plan_cmb->add_field( array(
        'name'          => esc_html__('Subtitle', 'easybook-add-ons' ),
        // 'desc'          => esc_html__('', 'easybook-add-ons' ),
        'default'       => '',
        'id'            => $prefix . 'subtitle',
        'type'          => 'text'
    ) );
    

    $plan_cmb->add_field( array(
        'name'          => esc_html__('Price', 'easybook-add-ons' ),
        'desc'          => esc_html__('Value 0 for free.', 'easybook-add-ons' ),
        'default'       => '49',
        'id'            => '_price',
        'type'          => 'text_small',
        // 'before_field'  => '$',
    ) );

    $plan_cmb->add_field( array(
        'name'          => esc_html__( 'Period', 'easybook-add-ons' ),
        'desc'          => esc_html__( 'Expired period', 'easybook-add-ons' ),
        'id'            => $prefix . 'period',
        'type'             => 'select',
        'show_option_none' => false,
        'default'          => 'month',
        'options'       => easybook_add_ons_get_subscription_duration_units(),
        
    ) );
    $plan_cmb->add_field( array(
        'name'          => esc_html__('Interval', 'easybook-add-ons' ),
        'desc'          => esc_html__('Numbers of PERIOD value which listing will be expired', 'easybook-add-ons' ),
        'default'       => '1',
        'id'            => $prefix . 'interval',
        'type'          => 'text_small'
    ) );

    $plan_cmb->add_field( array(
        'name'          => esc_html__('No Expire', 'easybook-add-ons' ),
        'desc'          => esc_html__('Check this if subscription never expire.', 'easybook-add-ons' ),
        'default'       => '0',
        'id'            => $prefix . 'lnever_expire',
        'type'          => 'checkbox'
    ) );
    $plan_cmb->add_field( array(
        'name'          => esc_html__('Yearly price reduction', 'easybook-add-ons' ),
        'desc'          => esc_html__('value from 1%. O for no redution. Yealy price will be automatically calculated', 'easybook-add-ons' ),
        'default'       => '5',
        'id'            => $prefix . 'yearly_sale',
        'type'          => 'text_small',
    ) );

    $plan_cmb->add_field( array(
        'name'          => esc_html__('Author Fee', 'easybook-add-ons' ),
        'desc'          => esc_html__('Value 0% to 100%.', 'easybook-add-ons' ),
        'default'       => '5',
        'id'            => $prefix . 'author_fee',
        'type'          => 'text_small',
    ) );

    $plan_cmb->add_field( array(
        'name'          => esc_html__('Prcing Icon Class', 'easybook-add-ons' ),
        'desc'          => esc_html__('Take the page access class icon : https://fontawesome.com/', 'easybook-add-ons' ),
        'default'       => 'fal fa-plane-alt',
        'id'            => $prefix . 'price_icon',
        'type'          => 'text',
    ) );
    

    $plan_cmb->add_field( array(
        'name'          => esc_html__('Listing Submission Limit', 'easybook-add-ons' ),
        'desc'          => esc_html__('Numbers of listing who subscribe for this plan can submit.', 'easybook-add-ons' ),
        'default'       => '1',
        'id'            => $prefix . 'llimit',
        'type'          => 'text_small'
    ) );

    $plan_cmb->add_field( array(
        'name'          => esc_html__('Unlimited Listing Submission', 'easybook-add-ons' ),
        'desc'          => esc_html__('Check this if this plan has unlimited listing submission.', 'easybook-add-ons' ),
        'default'       => '0',
        'id'            => $prefix . 'lunlimited',
        'type'          => 'checkbox'
    ) );

    $plan_cmb->add_field( array(
        'name'          => esc_html__('Featured Listings', 'easybook-add-ons' ),
        'desc'          => esc_html__('Numbers of featured listings for this plan.', 'easybook-add-ons' ),
        'default'       => '1',
        'id'            => $prefix . 'lfeatured',
        'type'          => 'text_small'
    ) );

    $plan_cmb->add_field( array(
        'name'          => esc_html__('Is Recurring', 'easybook-add-ons' ),
        'desc'          => esc_html__('Check this if this plan required recurring payment.', 'easybook-add-ons' ),
        'default'       => '0',
        'id'            => $prefix . 'is_recurring',
        'type'          => 'checkbox'
    ) );


    

    ///////
    $plan_recurring_cmb = new_cmb2_box( array(
        'id'            => 'lplan_recurring_fields',
        'title'         => esc_html__('Recurring Options', 'easybook-add-ons' ),
        'object_types'  => array( 'lplan'), // Post type
        'context'       => 'normal',// normal, side and advanced
        'priority'      => 'high',// default, high and low - core
        'show_names'    => true, // Show field names on the left
    ) );

    $plan_recurring_cmb->add_field( array(
        'name'          => esc_html__('Trial Interval', 'easybook-add-ons' ),
        'desc'          => esc_html__('Value O for disable.', 'easybook-add-ons' ),
        'default'       => '0',
        'id'            => $prefix . 'trial_interval',
        'type'          => 'text_small'
    ) );

    $plan_recurring_cmb->add_field( array(
        'name'          => esc_html__( 'Trial Period', 'easybook-add-ons' ),
        // 'desc'          => esc_html__( 'Trial Expired period', 'easybook-add-ons' ),
        'id'            => $prefix . 'trial_period',
        'type'             => 'select',
        'show_option_none' => false,
        'default'          => 'day',
        'options'       => easybook_add_ons_get_subscription_duration_units(),
        
    ) );


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Initiate Page metabox
     */
    $page_cmb = new_cmb2_box( array(
        'id'            => 'des_header',
        'title'         => esc_html__('Page Layout Options - For normal page template only', 'easybook-add-ons' ),
        'object_types'  => array( 'page'), // Post type
        'context'       => 'normal',// normal, side and advanced
        'priority'      => 'high',// default, high and low - core
        'show_names'    => true, // Show field names on the left
    ) );

   

    $page_cmb->add_field( array(
        'name' => esc_html__('Show Post Header', 'easybook-add-ons' ),
        'id'   => $prefix . 'show_page_header',
        'type'    => 'radio_inline',
        'default'=>'yes',
        'options' => array(
            'yes' => esc_html__( 'Yes', 'easybook-add-ons' ),
            'no'   => esc_html__( 'No', 'easybook-add-ons' ),
            
        ),
    ) );

    $page_cmb->add_field( array(
        'name' => esc_html__('Header Image Background', 'easybook-add-ons' ),
        'id'   => $prefix . 'page_header_bg',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => true, // Hide the text input for the url
            
        ),
    ) );

    $page_cmb->add_field( array(
        'name' => esc_html__('Show Post Title in header', 'easybook-add-ons' ),
        'id'   => $prefix . 'show_page_title',
        'type'    => 'radio_inline',
        'default'=>'yes',
        'options' => array(
            'yes' => esc_html__( 'Yes', 'easybook-add-ons' ),
            'no'   => esc_html__( 'No', 'easybook-add-ons' ),
            
        ),
    ) );


    $page_cmb->add_field( array(
        'name' => esc_html__('Header Additional Info', 'easybook-add-ons' ),
        'id'   => $prefix . 'page_header_intro',
        'type' => 'textarea_small'
    ) );

    

//////////////////////////////////////////////////////////////////////////////////////


    $member_cmb2 = new_cmb2_box( array(
        'id'            => 'member_additional_mtb',
        'title'         => esc_html__('Social Links', 'easybook-add-ons' ),
        'object_types'  => array( 'member'), // Post type
        'context'       => 'normal',// normal, side and advanced
        'priority'      => 'high',// default, high and low - core
        'show_names'    => true, // Show field names on the left
    ) );

    $member_cmb2->add_field( array(
        'name'        => __( 'Select Icon', 'easybook-add-ons' ),
        'id'          => $prefix . 'member_icon',   
        'type'    => 'icon_picker',
        'options' => array(
            // The icons you want to use goes into this array:
            'icons' => array('fa-amazon','fa-ambulance','fa-american-sign-language-interpreting','fa-anchor'),
            // Add font-family to "fonts" !important; Note that you can use multiple iconfonts.
            'fonts' => array('FontAwesome', 'dashicons'),
        ),  
    ) );
    $member_cmb2->add_field( array(
        'name' => esc_html__( 'Mail URL', 'easybook-add-ons' ),
        'id'   => $prefix . 'mail',
        'type' => 'text_url',
    ) );
    $member_cmb2->add_field( array(
        'name' => esc_html__( 'Facebook URL', 'easybook-add-ons' ),
        'id'   => $prefix . 'facebookurl',
        'type' => 'text_url',
    ) );

    $member_cmb2->add_field( array(
        'name' => esc_html__( 'Twitter URL', 'easybook-add-ons' ),
        'id'   => $prefix . 'twitterurl',
        'type' => 'text_url',
    ) );
    $member_cmb2->add_field( array(
        'name' => esc_html__( 'Google+ URL', 'easybook-add-ons' ),
        'id'   => $prefix . 'googleplusurl',
        'type' => 'text_url',
    ) );
    $member_cmb2->add_field( array(
       'name' => esc_html__( 'Linkedin URL', 'easybook-add-ons' ),
        'id'   => $prefix . 'linkedinurl',
        'type' => 'text_url',
    ) );
    $member_cmb2->add_field( array(
       'name' => esc_html__( 'Instagram URL', 'easybook-add-ons' ),
        'id'   => $prefix . 'instagramurl',
        'type' => 'text_url',
    ) );
    $member_cmb2->add_field( array(
       'name' => esc_html__( 'Tumblr URL', 'easybook-add-ons' ),
        'id'   => $prefix . 'tumblrurl',
        'type' => 'text_url',
    ) );

    $member_cmb2->add_field( array(
       'name' => esc_html__( 'Behance URL', 'easybook-add-ons' ),
        'id'   => $prefix . 'behanceurl',
        'type' => 'text_url',
    ) );


    /**
     * Initiate Resumes metabox
     */
    $resume_cmb = new_cmb2_box( array(
        'id'            => 'resumes_mtb',
        'title'         => esc_html__('Resume Options', 'easybook-add-ons' ),
        'object_types'  => array( 'cth_resume'), // Post type
        'context'       => 'normal',// normal, side and advanced
        'priority'      => 'high',// default, high and low - core
        'show_names'    => true, // Show field names on the left
    ) );

    $resume_cmb->add_field( array(
        'name' => esc_html__( 'Resume Date', 'easybook-add-ons' ),
        'id' => $prefix . 'resume_date',
        'type'             => 'text',
        'default'          => '2017',
    ) );

    /**
     * Initiate Testimonials metabox
     */
    $testim_cmb = new_cmb2_box( array(
        'id'            => 'testimonial_mtb',
        'title'         => esc_html__('Testimonial Meta Options', 'easybook-add-ons' ),
        'object_types'  => array( 'cth_testimonial'), // Post type
        'context'       => 'normal',// normal, side and advanced
        'priority'      => 'high',// default, high and low - core
        'show_names'    => true, // Show field names on the left
    ) );

    $testim_cmb->add_field( array(
        'name' => esc_html__( 'Rating Stars', 'easybook-add-ons' ),
       
        'id' => $prefix . 'testim_rate',
        'type'             => 'select',
        'show_option_none' => false,
        'default'          => 'five',
        'options' => array(
            'no' => esc_html__( 'Not Rate', 'easybook-add-ons' ),
            '1' => esc_html__( '1 Star', 'easybook-add-ons' ),
            '1.5' => esc_html__( '1.5 Stars', 'easybook-add-ons' ),
            '2' => esc_html__( '2 Stars', 'easybook-add-ons' ),
            '2.5' => esc_html__( '2.5 Stars', 'easybook-add-ons' ),
            '3' => esc_html__( '3 Stars', 'easybook-add-ons' ),
            '3.5' => esc_html__( '3.5 Stars', 'easybook-add-ons' ),
            '4' => esc_html__( '4 Stars', 'easybook-add-ons' ),
            '4.5' => esc_html__( '4.5 Stars', 'easybook-add-ons' ),
            '5' => esc_html__( '5 Stars', 'easybook-add-ons' ),
            
        ),
    ) );


}