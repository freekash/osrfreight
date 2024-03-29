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
function easybook_addons_listing_feature_add_new_meta_field() {
    
    // this will add the custom meta field to the add new term page
    wp_enqueue_media();
    wp_enqueue_script('easybook_tax_meta', ESB_DIR_URL . 'inc/assets/upload_file.js', array('jquery'), null, true);
    easybook_select_media_file_field('featured_img',esc_html__('Featured Image','easybook-add-ons'), array());
}
add_action('listing_feature_add_form_fields', 'easybook_addons_listing_feature_add_new_meta_field', 10, 2);

// Edit term page
function easybook_addons_listing_feature_edit_meta_field($term) {
    wp_enqueue_style( 'font-awesome', ESB_DIR_URL . 'inc/assets/font-awesome/font-awesome.min.css');
    wp_enqueue_style( 'cth-backend', ESB_DIR_URL . 'inc/assets/backend.css');
    wp_enqueue_media();
    wp_enqueue_script('easybook_tax_meta', ESB_DIR_URL . 'inc/assets/upload_file.js', array('jquery'), null, true);
    wp_enqueue_script('select2', ESB_DIR_URL . 'assets/js/select2.min.js', array('jquery'), null, true);
    wp_enqueue_script('easybook_tax_repeat', ESB_DIR_URL . 'inc/assets/repeat_fields.js', array('jquery','jquery-ui-sortable'), null, true);
    
    // put the term ID into a variable
    // $t_id = $term->term_id;

    $term_meta = get_term_meta( $term->term_id, '_cth_term_meta', true );
    
    // retrieve the existing value(s) for this meta field. This returns an array

    
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
}
add_action('listing_feature_edit_form_fields', 'easybook_addons_listing_feature_edit_meta_field', 10, 2);

// Save extra taxonomy fields callback function.
function easybook_addons_save_listing_feature_custom_meta($term_id) {
    if (isset($_POST['term_meta'])) {
        $term_meta = get_term_meta( $term_id, '_cth_term_meta', true );
        if(!$term_meta||!is_array($term_meta)) $term_meta = array();
        $cat_keys = array_keys($_POST['term_meta']);
        foreach ($cat_keys as $key) {
            if (isset($_POST['term_meta'][$key])) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        
        // Save the option array.
        update_term_meta($term_id, '_cth_term_meta', $term_meta);

    }
}
add_action('create_listing_feature', 'easybook_addons_save_listing_feature_custom_meta', 10, 2);
add_action('edited_listing_feature', 'easybook_addons_save_listing_feature_custom_meta', 10, 2);
