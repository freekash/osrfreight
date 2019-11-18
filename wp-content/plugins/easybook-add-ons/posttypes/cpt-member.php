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



class Esb_Class_Member_CPT extends Esb_Class_CPT {
    protected $name = 'member';

    protected function set_meta_boxes(){
        // $this->meta_boxes = array(
        //     'socials'       => array(
        //         'title'         => __( 'Social Links', 'easybook-add-ons' ),
        //         'context'       => 'normal', // normal - side - advanced
        //         'priority'       => 'default', // default - high - low
        //         'callback_args'       => array(),
        //     )
        // );
    }
    public function register(){

        $labels = array( 
            'name' => __( 'Members', 'easybook-add-ons' ),
            'singular_name' => __( 'Member', 'easybook-add-ons' ),
            'add_new' => __( 'Add New Member', 'easybook-add-ons' ),
            'add_new_item' => __( 'Add New Member', 'easybook-add-ons' ),
            'edit_item' => __( 'Edit Member', 'easybook-add-ons' ),
            'new_item' => __( 'New Member', 'easybook-add-ons' ),
            'view_item' => __( 'View Member', 'easybook-add-ons' ),
            'search_items' => __( 'Search Members', 'easybook-add-ons' ),
            'not_found' => __( 'No Members found', 'easybook-add-ons' ),
            'not_found_in_trash' => __( 'No Members found in Trash', 'easybook-add-ons' ),
            'parent_item_colon' => __( 'Parent Member:', 'easybook-add-ons' ),
            'menu_name' => __( 'Members', 'easybook-add-ons' ),
        );

        $args = array( 
            'labels' => $labels,
            'hierarchical' => true,
            'description' => __( 'List Members', 'easybook-add-ons' ),
            'supports' => array( 'title', 'editor', 'thumbnail','excerpt'/*,'comments', 'post-formats'*/),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 25,
            'menu_icon' =>  'dashicons-groups',
            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => false,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => array( 'slug' => __('member','easybook-add-ons') ),
            'capability_type' => 'post'
        );
        register_post_type( $this->name, $args );
    }

    public function member_socials_callback($post, $args){
        wp_nonce_field( 'cth-cpt-fields', '_cth_cpt_nonce' );

        $socials = get_post_meta( $post->ID, ESB_META_PREFIX.'socials', true );
        ?>
        <h4><?php _e( 'Job Position', 'easybook-add-ons' ); ?></h4>
        <div class="custom-form">
            <input type="text" name="job_pos" value="<?php echo get_post_meta( $post->ID, ESB_META_PREFIX.'job_pos', true ); ?>">
        </div>
        <h4><?php _e( 'Socials', 'easybook-add-ons' ); ?></h4>
        <div class="custom-form">
            <div class="repeater-fields-wrap repeater-socials"  data-tmpl="tmpl-user-social">
                <div class="repeater-fields">
                <?php 
                if(!empty($socials)){
                    foreach ($socials as $key => $social) {
                        easybook_addons_get_template_part('templates-inner/social',false, array('index'=>$key,'name'=>$social['name'],'url'=>$social['url']));
                    }
                }
                ?>
                </div>
                <button class="btn addfield" type="button"><?php  esc_html_e( 'Add Social','easybook-add-ons' );?></button>
            </div>
        </div>
        <?php
    }

    public function save_post($post_id, $post, $update){
        if(!$this->can_save($post_id)) return;

        if(isset($_POST['job_pos'])){
            $new_val = sanitize_text_field( $_POST['job_pos'] ) ;
            $origin_val = get_post_meta( $post_id, ESB_META_PREFIX.'job_pos', true );
            if($new_val !== $origin_val){
                update_post_meta( $post_id, ESB_META_PREFIX.'job_pos', $new_val );
            }
        }
        if(isset($_POST['socials'])){
            update_post_meta( $post_id, ESB_META_PREFIX.'socials', $_POST['socials'] );
        }else{
            update_post_meta( $post_id, ESB_META_PREFIX.'socials', array() );
        }
    }

    protected function set_meta_columns(){
        $this->has_columns = true;
    }
    public function meta_columns_head($columns){
        $columns['_thumbnail'] = __( 'Thumbnail', 'easybook-add-ons' );
        $columns['_id'] = __( 'ID', 'easybook-add-ons' );
        return $columns;
    }
    public function meta_columns_content($column_name, $post_ID){
        if ($column_name == '_id') {
            echo $post_ID;
        }
        if ($column_name == '_thumbnail') {
            echo get_the_post_thumbnail( $post_ID, 'thumbnail', array('style'=>'width:100px;height:auto;') );
        }
    }

}

new Esb_Class_Member_CPT();