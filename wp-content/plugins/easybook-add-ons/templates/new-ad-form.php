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


?>
<form id="new-ad-canpaign-form" class="new-ad-canpaign-form custom-form" method="post">
                    
    <fieldset>
        <?php 
        // listing meta search
        $meta_queries = array();
        // check for membership expired
        // if(easybook_addons_get_option('membership_package_expired_hide') == 'yes'){
        //     $meta_queries['relation'] = 'OR';
        //     $meta_queries[] = array(
        //         'key'     => ESB_META_PREFIX.'expire_date',
        //         'value'   => current_time('mysql', 1),
        //         'compare' => '>=',
        //         'type'    => 'DATETIME',
        //     );
        //     $meta_queries[] = array(
        //         'key'     => ESB_META_PREFIX.'expire_date',
        //         'value'   => 'NEVER',
        //         'compare' => '=',
        //     );

        // }
        $current_user = wp_get_current_user();
        $listing_args = array(
            'post_type'         => 'listing',
            'author'            =>  $current_user->ID,
            'post_status'       => 'publish',
            'posts_per_page'    => -1,
        );

        if(!empty($meta_queries)) $listing_args['meta_query'] = $meta_queries;

        $listing_posts = get_posts($listing_args);
        if(empty($listing_posts)) echo '<div class="ad-no-listing-msg">'.__( 'You have no Published listings yet!', 'easybook-add-ons' ).'</div>';
        ?>
        <label for="ad-listing-select"><?php _e( 'Select listing for ad', 'easybook-add-ons' ); ?></label>
        <select name="ad-listing" id="ad-listing-select" class="chosen-select ad-listing-select" required="required"<?php if(empty($listing_posts)) echo ' disabled="disabled"'; ?>>
            <option value=""><?php esc_html_e( 'Select a listing',  'easybook-add-ons' );?></option>
            <?php 
            if(!empty($listing_posts)){
                foreach ($listing_posts as $listing) {
                    echo '<option value="'.$listing->ID.'">'.$listing->post_title.'</option>';
                }
            }
            ?>
        </select>
        <?php 
        $ad_packages = get_terms( array(
            'taxonomy' => 'cthads_package',
            'hide_empty' => false,
            'meta_key'  => ESB_META_PREFIX.'ad_price',
            'orderby'   => 'meta_value_num',
            // 'order'     => 'ASC',
            'meta_query' => array(
                // 'relation' => 'OR',
                array(
                    'key' => ESB_META_PREFIX.'is_active',
                    'value' => 'yes',
                    // 'compare' => 'LIKE',
                ),
                // array(
                //     'key' => 'bar_key',
                // ),
            ),



        ) );
         
        if ( ! empty( $ad_packages ) && ! is_wp_error( $ad_packages ) ) { ?>
        <label><?php _e( 'Which position for ad?', 'easybook-add-ons' ); ?></label>
        <div class="ad-packages">
        <?php
            foreach ($ad_packages as $package) {
                $icon_img = get_term_meta( $package->term_id, ESB_META_PREFIX.'icon_img', true );
            ?>
            <div class="ad-package-item ad-package-<?php echo $package->slug;?>">
                    <label for="ad-package-<?php echo $package->slug;?>">
                        <div class="ad-package-title"><?php echo $package->name; ?></div>
                        <?php if(isset($icon_img['id'])) echo wp_get_attachment_image( $icon_img['id'] ); ?>
                        <div class="ad-package-input">
                            <input type="radio" name="ad-package" id="ad-package-<?php echo $package->slug;?>" value="<?php echo $package->term_id;?>" required="required">
                        </div>
                        <span class="ad-package-desc"><?php //echo $data['desc'];?></span>
                        <div class="ad-package-price">
                            <?php 
                            echo sprintf(__( '<span class="ad-price">%s</span> <span class="ad-period">%s</span>', 'easybook-add-ons' ), easybook_addons_get_price_formated(get_term_meta( $package->term_id, ESB_META_PREFIX.'ad_price', true )), easybook_add_ons_get_plan_period_text( get_term_meta( $package->term_id, ESB_META_PREFIX.'ad_interval', true ), get_term_meta( $package->term_id, ESB_META_PREFIX.'ad_period', true ) ) );
                            ?>
                        </div>
                    </label>
                    <?php 
                    $ad_positions = get_term_meta( $package->term_id, ESB_META_PREFIX.'ad_type', true );
                    if(!empty($ad_positions)){
                        echo '<div class="ad-pos-desc">'. __( 'Positions:', 'easybook-add-ons' );
                        foreach ((array)$ad_positions as $pos) {
                            echo '<div class="ad-pos-item">'.easybook_addons_listing_ad_positions($pos). '</div>';
                        }
                        echo '</div>';
                    }
                    ?>
                </div>
                <!-- end <?php echo $package->slug;?> -->
            <?php
            } ?>
        </div>
        <?php
        } ?>
    </fieldset>
    <input type="hidden" name="ad-type" value="listing" />
    <button class="btn color-bg no-ani" id="new-ad-submit" type="submit"><?php esc_attr_e( 'Submit', 'easybook-add-ons' ); ?></button>
</form>