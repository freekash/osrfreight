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



//For portfolio_cat taxonomy
//https://make.wordpress.org/core/2015/09/04/taxonomy-term-metadata-proposal/
// Add term page
function easybook_addons_listing_cat_add_new_meta_field() {
    
    // this will add the custom meta field to the add new term page 
    wp_enqueue_media();
    wp_enqueue_script('easybook_tax_meta', ESB_DIR_URL . 'inc/assets/upload_file.js', array('jquery'), null, true);
    // wp_enqueue_script('select2', ESB_DIR_URL . 'assets/js/select2.min.js', array('jquery'), null, true);
    // wp_enqueue_script('easybook_tax_repeat', ESB_DIR_URL . 'inc/assets/repeat_fields.js', array('jquery','jquery-ui-sortable'), null, true);
    
    // easybook_features_select_field(array(
    //                             'id'=>'features',
    //                             'name'=>esc_html__('Available Features','easybook-add-ons'),
    //                             'values' => array(
    //                                 'yes'=> esc_html__('Yes','easybook-add-ons'),
    //                                 'no'=> esc_html__('No','easybook-add-ons'),
    //                             ),
    //                             'required' => false,
    //                             'default'=>'yes'
    // ));

    // easybook_repeat_fields_options_field(array(
    //                             'id'=>'add-features',
    //                             'name'=>esc_html__('Additional Features','easybook-add-ons'),
    //                             'values' => array(
    //                                 'yes'=> esc_html__('Yes','easybook-add-ons'),
    //                                 'no'=> esc_html__('No','easybook-add-ons'),
    //                             ),
    //                             'required' => false,
    //                             'default'=>'yes'
    // ));


    // easybook_radio_options_field(array(
    //                             'id'=>'tax_show_header',
    //                             'name'=>esc_html__('Show Header Section','easybook-add-ons'),
    //                             'values' => array(
    //                                     'yes'=> esc_html__('Yes','easybook-add-ons'),
    //                                     'no'=> esc_html__('No','easybook-add-ons'),
    //                                 ),
    //                             'default'=>'yes'
    // ));
    easybook_select_media_file_field('featured_img',esc_html__('Featured Image','easybook-add-ons'), array());

}
add_action('listing_cat_add_form_fields', 'easybook_addons_listing_cat_add_new_meta_field', 10, 2);

// Edit term page
function easybook_addons_listing_cat_edit_meta_field($term) {
    wp_enqueue_style( 'font-awesome', ESB_DIR_URL . 'inc/assets/font-awesome/font-awesome.min.css');
    wp_enqueue_style( 'cth-backend', ESB_DIR_URL . 'inc/assets/backend.css');
    wp_enqueue_media();
    wp_enqueue_script('easybook_tax_meta', ESB_DIR_URL . 'inc/assets/upload_file.js', array('jquery'), null, true);
    wp_enqueue_script('select2', ESB_DIR_URL . 'assets/js/select2.min.js', array('jquery'), null, true);
    wp_enqueue_script('easybook_tax_repeat', ESB_DIR_URL . 'inc/assets/repeat_fields.js', array('jquery','jquery-ui-sortable'), null, true);
    
    // put the term ID into a variable
    // $t_id = $term->term_id;

    $term_meta = get_term_meta( $term->term_id, ESB_META_PREFIX.'term_meta', true );
    
    // retrieve the existing value(s) for this meta field. This returns an array
    // $term_meta = get_option(ESB_META_PREFIX."tax_listing_cat_$t_id");

    // easybook_features_select_new_field(array(
    //                             'id'=>'features',
    //                             'name'=>esc_html__('Available Features','easybook-add-ons'),
    //                             'values' => array(
    //                                 'yes'=> esc_html__('Yes','easybook-add-ons'),
    //                                 'no'=> esc_html__('No','easybook-add-ons'),
    //                             ),
    //                             'required' => false,
    //                             'default'=>'yes',
    //                             'desc'  => __( 'Select features for this category available to check when submit/edit listing. These also be used for advanced filter when this category is selected.', 'easybook-add-ons' ),
    // ),$term_meta,false);

    // easybook_repeat_fields_options_field(array(
    //                             'id'=>'add-features',
    //                             'name'=>esc_html__('Additional Features','easybook-add-ons'),
    //                             'values' => array(
    //                                 'yes'=> esc_html__('Yes','easybook-add-ons'),
    //                                 'no'=> esc_html__('No','easybook-add-ons'),
    //                             ),
    //                             'required' => false,
    //                             'default'=>'yes'
    // ),$term_meta,false);

    // easybook_addons_content_widgets_order_options_field(array(
    //                             'id'=>'content-widgets-order',
    //                             'id_hide'=>'content-widgets-hide',
    //                             'name'=>esc_html__('Content Widgets Order','easybook-add-ons'),
    //                             'values' => array(
    //                                 'speaker'=> esc_html__('Speaker Widget','easybook-add-ons'),
    //                                 'promo_video'=> esc_html__('Promo Video','easybook-add-ons'),
    //                                 'content'=> esc_html__('Content Widget','easybook-add-ons'),
    //                                 'gallery'=> esc_html__('Gallery Widget','easybook-add-ons'),
    //                                 'slider'=> esc_html__('Slider Widget','easybook-add-ons'),
    //                                 'faqs'=> esc_html__('FAQs Widget','easybook-add-ons'),
    //                                 'amenities'=> esc_html__('Amenities Widget','easybook-add-ons'),
    //                                 'rooms'=> esc_html__('Rooms Widget','easybook-add-ons'),
                                    
    //                             ),
    //                             'required' => false,
    //                             // 'default'=>array('promo_video','content','gallery','slider','faqs','speaker'),
    //                             'default'=>easybook_addons_get_listing_content_order_default(),

    //                             'id_2'=>'sidebar-widgets-order',
    //                             'id_hide_2'=>'sidebar-widgets-hide',
    //                             'values_2' => array(
    //                                 'countdown'=> esc_html__('Countdown','easybook-add-ons'),
    //                                 'addfeas' => esc_html__('Additional Features','easybook-add-ons'),
    //                                 'price_range'=> esc_html__('Price Range Widget','easybook-add-ons'),
    //                                 'booking'=> esc_html__('Booking Widget','easybook-add-ons'),
    //                                 'weather'=> esc_html__('Weather Widget','easybook-add-ons'),
    //                                 'contacts'=> esc_html__('Contacts Widget','easybook-add-ons'),
    //                                 'author'=> esc_html__('Author Widget','easybook-add-ons'),
    //                                 'moreauthor'=> esc_html__('More From Author Widget','easybook-add-ons'),
                                    
    //                             ),
    //                             // 'default_2'=>array('wkhour','countdown','price_range','booking','contacts','author','moreauthor'),
    //                             'default_2'=>easybook_addons_get_listing_widget_order_default(),
    // ),$term_meta,false);


    
    easybook_radio_options_field(array(
                                'id'=>'tax_show_header',
                                'name'=>esc_html__('Show Header Section','easybook-add-ons'),
                                'values' => array(
                                        'yes'=> esc_html__('Yes','easybook-add-ons'),
                                        'no'=> esc_html__('No','easybook-add-ons'),
                                    ),

                                'default'=>'yes'
    ),$term_meta,false);

    easybook_addons_icon_select_field(array(
                                'id'=>'icon_class',
                                'name'=>esc_html__('Icon','easybook-add-ons'),
                                // 'values' => array(
                                //         'yes'=> esc_html__('Yes','easybook-add-ons'),
                                //         'no'=> esc_html__('No','easybook-add-ons'),
                                //     ),

                                'default'=>'fa fa-cutlery'
    ),$term_meta,false);

    easybook_select_media_file_field('featured_img',esc_html__('Featured Image','easybook-add-ons'), $term_meta,false);

    easybook_select_media_file_field('gmap_marker',esc_html__('Google Map Marker','easybook-add-ons'), $term_meta,false);
}
add_action('listing_cat_edit_form_fields', 'easybook_addons_listing_cat_edit_meta_field', 10, 2);

// Save extra taxonomy fields callback function.
function easybook_addons_save_listing_cat_custom_meta($term_id) {
    if (isset($_POST['term_meta'])) {
        $term_meta = get_term_meta( $term_id, ESB_META_PREFIX.'term_meta', true );
        if(!$term_meta||!is_array($term_meta)) $term_meta = array();
        $cat_keys = array_keys($_POST['term_meta']);
        foreach ($cat_keys as $key) {
            if (isset($_POST['term_meta'][$key])) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        
        // Save the option array.
        update_term_meta($term_id, ESB_META_PREFIX.'term_meta', $term_meta);

    }
}
add_action('create_listing_cat', 'easybook_addons_save_listing_cat_custom_meta', 10, 2);
add_action('edited_listing_cat', 'easybook_addons_save_listing_cat_custom_meta', 10, 2);



// Add term page
function easybook_addons_listing_location_add_new_meta_field() {
    
    // this will add the custom meta field to the add new term page
    wp_enqueue_media();
    wp_enqueue_script('easybook_tax_meta', ESB_DIR_URL . 'inc/assets/upload_file.js', array('jquery'), null, true);
    
    
    easybook_select_media_file_field('featured_img',esc_html__('Featured Image','easybook-add-ons'), array());

}
add_action('listing_location_add_form_fields', 'easybook_addons_listing_location_add_new_meta_field', 10, 2);

// Edit term page
function easybook_addons_listing_location_edit_meta_field($term) {
    wp_enqueue_media();
    wp_enqueue_script('easybook_tax_meta', ESB_DIR_URL . 'inc/assets/upload_file.js', array('jquery'), null, true);
    
    $term_meta = get_term_meta( $term->term_id, ESB_META_PREFIX.'term_meta', true );
    

    easybook_select_media_file_field('featured_img',esc_html__('Featured Image','easybook-add-ons'), $term_meta,false);
}
add_action('listing_location_edit_form_fields', 'easybook_addons_listing_location_edit_meta_field', 10, 2);

// Save extra taxonomy fields callback function.
function easybook_addons_save_listing_location_custom_meta($term_id) {
    if (isset($_POST['term_meta'])) {
        $term_meta = get_term_meta( $term_id, ESB_META_PREFIX.'term_meta', true );
        if(!$term_meta||!is_array($term_meta)) $term_meta = array();
        $cat_keys = array_keys($_POST['term_meta']);
        foreach ($cat_keys as $key) {
            if (isset($_POST['term_meta'][$key])) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        
        // Save the option array.
        update_term_meta($term_id, ESB_META_PREFIX.'term_meta', $term_meta);

    }
}
add_action('create_listing_location', 'easybook_addons_save_listing_location_custom_meta', 10, 2);
add_action('edited_listing_location', 'easybook_addons_save_listing_location_custom_meta', 10, 2);

function easybook_addons_cthads_package_add_new_meta_field() {
    wp_enqueue_media();
    wp_enqueue_script('easybook_tax_meta', ESB_DIR_URL . 'inc/assets/upload_file.js', array('jquery'), null, true);
    wp_enqueue_script('select2', ESB_DIR_URL . 'assets/js/select2.min.js', array('jquery'), null, true);
    wp_enqueue_script('easybook_tax_repeat', ESB_DIR_URL . 'inc/assets/repeat_fields.js', array('jquery','jquery-ui-sortable'), null, true);

    

    easybook_radio_options_field(array(
                                'id'=>'is_active',
                                'name'=>esc_html__('Is Active Package','easybook-add-ons'),
                                'values' => array(
                                        'yes'=> esc_html__('Yes','easybook-add-ons'),
                                        'no'=> esc_html__('No','easybook-add-ons'),
                                    ),

                                'default'=>'yes'
    ));

    easybook_addons_select2_options_field(array(
                                'id'=>'ad_type',
                                'name'=>esc_html__('AD Type','easybook-add-ons'),
                                'values' => easybook_addons_listing_ad_positions(),
                                'default'=>'sidebar'
    ));

    

    easybook_addons_text_options_field(array(
                                'id'=>'ad_price',
                                'name'=>esc_html__('AD Price','easybook-add-ons'),
                                'default'=>'10',
                                'desc' => easybook_addons_get_option('currency_symbol','$'),
    ));

    easybook_addons_select_options_field(array(
                                'id'=>'ad_period',
                                'name'=>esc_html__('AD Period','easybook-add-ons'),
                                'values' => array(
                                        'day'=> esc_html__('Days','easybook-add-ons'),
                                        'week'=> esc_html__('Weeks','easybook-add-ons'),
                                        'month'=> esc_html__('Months','easybook-add-ons'),
                                        'year'=> esc_html__('Years','easybook-add-ons'),
                                    ),

                                'default'=>'day',
                                'desc'  => __( 'AD expiration period', 'easybook-add-ons' ),
    ));

    easybook_addons_text_options_field(array(
                                'id'=>'ad_interval',
                                'name'=>esc_html__('AD Interval','easybook-add-ons'),
                                'default'=>'30',
                                'desc' => __( 'Numbers of PERIOD value the AD will be expired', 'easybook-add-ons' ),
    ));

    

    easybook_select_media_file_field('icon_img',esc_html__('Image Icon','easybook-add-ons'), array() );
}
add_action('cthads_package_add_form_fields', 'easybook_addons_cthads_package_add_new_meta_field', 10, 2);


// Edit term page
function easybook_addons_cthads_package_edit_meta_field($term) {
    wp_enqueue_media();
    wp_enqueue_script('easybook_tax_meta', ESB_DIR_URL . 'inc/assets/upload_file.js', array('jquery'), null, true);
    wp_enqueue_script('select2', ESB_DIR_URL . 'assets/js/select2.min.js', array('jquery'), null, true);
    wp_enqueue_script('easybook_tax_repeat', ESB_DIR_URL . 'inc/assets/repeat_fields.js', array('jquery','jquery-ui-sortable'), null, true);

    
    $term_meta = array(
        'is_active' => get_term_meta( $term->term_id, ESB_META_PREFIX.'is_active', true ),
        'ad_type' => get_term_meta( $term->term_id, ESB_META_PREFIX.'ad_type', true ),
        'ad_price' => get_term_meta( $term->term_id, ESB_META_PREFIX.'ad_price', true ),
        'ad_period' => get_term_meta( $term->term_id, ESB_META_PREFIX.'ad_period', true ),
        'ad_interval' => get_term_meta( $term->term_id, ESB_META_PREFIX.'ad_interval', true ),
        'icon_img' => get_term_meta( $term->term_id, ESB_META_PREFIX.'icon_img', true ),
    );

    easybook_radio_options_field(array(
                                'id'=>'is_active',
                                'name'=>esc_html__('Is Active Package','easybook-add-ons'),
                                'values' => array(
                                        'yes'=> esc_html__('Yes','easybook-add-ons'),
                                        'no'=> esc_html__('No','easybook-add-ons'),
                                    ),

                                'default'=>'yes'
    ),$term_meta,false);

    easybook_addons_select2_options_field(array(
                                'id'=>'ad_type',
                                'name'=>esc_html__('AD Type','easybook-add-ons'),
                                'values' => easybook_addons_listing_ad_positions(),
                                'default'=>'sidebar'
    ),$term_meta,false);

    

    easybook_addons_text_options_field(array(
                                'id'=>'ad_price',
                                'name'=>esc_html__('AD Price','easybook-add-ons'),
                                'default'=>'10',
                                'desc' => easybook_addons_get_option('currency_symbol','$'),
    ),$term_meta,false);

    easybook_addons_select_options_field(array(
                                'id'=>'ad_period',
                                'name'=>esc_html__('AD Period','easybook-add-ons'),
                                'values' => array(
                                        'day'=> esc_html__('Days','easybook-add-ons'),
                                        'week'=> esc_html__('Weeks','easybook-add-ons'),
                                        'month'=> esc_html__('Months','easybook-add-ons'),
                                        'year'=> esc_html__('Years','easybook-add-ons'),
                                    ),

                                'default'=>'day',
                                'desc'  => __( 'AD expiration period', 'easybook-add-ons' ),
    ),$term_meta,false);

    easybook_addons_text_options_field(array(
                                'id'=>'ad_interval',
                                'name'=>esc_html__('AD Interval','easybook-add-ons'),
                                'default'=>'30',
                                'desc' => __( 'Numbers of PERIOD value the AD will be expired', 'easybook-add-ons' ),
    ),$term_meta,false);

    

    easybook_select_media_file_field('icon_img',esc_html__('Image Icon','easybook-add-ons'), $term_meta,false);
}
add_action('cthads_package_edit_form_fields', 'easybook_addons_cthads_package_edit_meta_field', 10, 2);

// Save extra taxonomy fields callback function.
function easybook_addons_save_cthads_package_custom_meta($term_id) {
    if (isset($_POST['term_meta'])) {
        foreach ($_POST['term_meta'] as $key => $value) {
            update_term_meta($term_id, ESB_META_PREFIX.$key, $value);
        }


        // $term_meta = get_term_meta( $term_id, ESB_META_PREFIX.'term_meta', true );
        // if(!$term_meta||!is_array($term_meta)) $term_meta = array();
        // $cat_keys = array_keys($_POST['term_meta']);
        // foreach ($cat_keys as $key) {
        //     if (isset($_POST['term_meta'][$key])) {
        //         $term_meta[$key] = $_POST['term_meta'][$key];
        //     }
        // }
        
        // // Save the option array.
        // update_term_meta($term_id, ESB_META_PREFIX.'term_meta', $term_meta);

    }
}
add_action('create_cthads_package', 'easybook_addons_save_cthads_package_custom_meta', 10, 2);
add_action('edited_cthads_package', 'easybook_addons_save_cthads_package_custom_meta', 10, 2);

