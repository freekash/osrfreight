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



//For category taxonomy
// Add term page
function easybook_category_add_new_meta_field() {
    
    // this will add the custom meta field to the add new term page
    wp_enqueue_media();
    wp_enqueue_script('easybook_tax_meta', ESB_DIR_URL . 'inc/assets/upload_file.js', array('jquery'), null, true);
    easybook_radio_options_field(array(
                                'id'=>'tax_show_header',
                                'name'=>esc_html__('Show Header Section','easybook-add-ons'),
                                'values' => array(
                                        'yes'=> esc_html__('Yes','easybook-add-ons'),
                                        'no'=> esc_html__('No','easybook-add-ons'),
                                    ),
                                'default'=>'yes'
    ));
    easybook_select_media_file_field('cat_header_image',esc_html__('Header Background Image','easybook-add-ons'), array());
    easybook_radio_options_field(array(
                                'id'=>'tax_title_in_content',
                                'name'=>esc_html__('Show Category Info','easybook-add-ons'),
                                'values' => array(
                                        'yes'=> esc_html__('Yes','easybook-add-ons'),
                                        'no'=> esc_html__('No','easybook-add-ons'),
                                    ),
                                
                                'default'=>'no'
    ) );
}
add_action('category_add_form_fields', 'easybook_category_add_new_meta_field', 10, 2);

// Edit term page
function easybook_category_edit_meta_field($term) {
    wp_enqueue_media();
    wp_enqueue_script('easybook_tax_meta', ESB_DIR_URL . 'inc/assets/upload_file.js', array('jquery'), null, true);
    
    // put the term ID into a variable
    $t_id = $term->term_id;
    
    // retrieve the existing value(s) for this meta field. This returns an array
    $term_meta = get_option("easybook_taxonomy_category_$t_id");
    easybook_radio_options_field(array(
                                'id'=>'tax_show_header',
                                'name'=>esc_html__('Show Header Section','easybook-add-ons'),
                                'values' => array(
                                        'yes'=> esc_html__('Yes','easybook-add-ons'),
                                        'no'=> esc_html__('No','easybook-add-ons'),
                                    ),

                                'default'=>'tes'
    ),$term_meta,false);
    easybook_select_media_file_field('cat_header_image',esc_html__('Header Background Image','easybook-add-ons'), $term_meta,false);
    easybook_radio_options_field(array(
                                'id'=>'tax_title_in_content',
                                'name'=>esc_html__('Show Category Info','easybook-add-ons'),
                                'values' => array(
                                        'yes'=> esc_html__('Yes','easybook-add-ons'),
                                        'no'=> esc_html__('No','easybook-add-ons'),
                                    ),
                                
                                'default'=>'no'
    ) ,$term_meta,false);
}
add_action('category_edit_form_fields', 'easybook_category_edit_meta_field', 10, 2);

// Save extra taxonomy fields callback function.
function easybook_save_category_custom_meta($term_id) {
    if (isset($_POST['term_meta'])) {
        $t_id = $term_id;
        $term_meta = get_option("easybook_taxonomy_category_$t_id");
        $cat_keys = array_keys($_POST['term_meta']);
        foreach ($cat_keys as $key) {
            if (isset($_POST['term_meta'][$key])) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        
        // Save the option array.
        update_option("easybook_taxonomy_category_$t_id", $term_meta);
    }
}
add_action('edited_category', 'easybook_save_category_custom_meta', 10, 2);
add_action('create_category', 'easybook_save_category_custom_meta', 10, 2);
