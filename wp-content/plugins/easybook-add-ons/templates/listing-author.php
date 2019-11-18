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



get_header(  );

global $laumember;
?>
<!--section -->
<section class="color-bg middle-padding"> 
    <div class="wave-bg wave-bg2"></div>
    <div class="container">
        <div class="flat-title-wrap">
            <h2><span><?php esc_html_e( 'User  : ', 'easybook-add-ons' );?><strong><?php echo sprintf(__( '%s', 'easybook-add-ons' ), $laumember->display_name); ?></strong></span></h2>
            <span class="section-separator"></span>
            <h4><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec tincidunt arcu, sit amet fermentum sem.', 'easybook-add-ons' );?></h4>
        </div>
   </div>
</section>
<!-- section end -->
<div class="breadcrumbs-fs fl-wrap">
    <div class="container">
        <?php easybook_breadcrumbs(); ?>        
    </div>
</div>
<!--section -->
<section class="middle-padding grey-blue-bg" id="sec1">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="fl-wrap">
                    <!--box-widget-item -->
                    <div class="box-widget-item fl-wrap" >
                        <div class="box-widget-item-header">
                            <h3><?php esc_html_e( 'About Athor : ', 'easybook-add-ons' );?></h3>
                        </div>
                        <div class="box-widget list-author-widget">
                            <div class="list-author-widget-header fl-wrap">
                                <div class="box-widget-author-title-img ">
                                    <?php 
                                        echo get_avatar($laumember->user_email,'150','https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=150', $laumember->display_name ); 
                                    ?> 
                                </div>
                                <span class="list-author-widget-link">
                                    <a href="<?php echo get_author_posts_url( $laumember->ID ); ?>"><?php echo $laumember->display_name;?></a>
                                    <span><?php esc_html_e( 'Co-manager associated', 'easybook-add-ons' );?></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!--box-widget-item end -->
                    <!--box-widget-item -->
                    <?php
                        $au_phone = get_user_meta( $laumember->ID, '_cth_phone', true );
                        $au_address = get_user_meta( $laumember->ID, '_cth_address', true );
                        if ( $au_phone != '' && $au_address !=''):
                    ?>
                    <div class="box-widget-item fl-wrap">
                        <div class="box-widget-item-header">
                            <h3><?php esc_html_e( 'User Contacts : ', 'easybook-add-ons' ); ?></h3>
                        </div>
                        <div class="box-widget">
                            <div class="box-widget-content">
                                
                                <div class="list-author-widget-contacts list-item-widget-contacts">
                                    <ul>
                                        <?php if($au_phone != ''){ ?><li><span><i class="fa fa-phone"></i><?php esc_html_e( ' Phone :', 'easybook-add-ons' );?></span> <a href="tell:<?php echo esc_attr($au_phone);?>"><?php echo esc_html($au_phone);?></a></li><?php } ?>
                                        <?php if($au_address != ''){ ?><li><span><i class="fa fa-map-marker"></i><?php esc_html_e( ' Address :', 'easybook-add-ons' );?></span> <span><?php echo esc_html($au_address);?></span></li><?php } ?>
                                        <?php if($laumember->user_url != ''){ ?><li><span><i class="fa fa-globe"></i><?php esc_html_e( ' Website :', 'easybook-add-ons' );?></span> <a href="<?php echo esc_url( $laumember->user_url );?>" target="_blank"><?php echo esc_url( $laumember->user_url );?></a></li><?php } ?>
                                    </ul>
                                </div>

                                <?php 
                                $au_socials = get_user_meta( $laumember->ID, '_cth_socials', true );
                                // echo'<pre>';var_dump($au_socials);
                                if(is_array($au_socials) && count($au_socials)) : ?>
                                <div class="list-widget-social">
                                    <ul>
                                        <?php 
                                        foreach ($au_socials as $social) {
                                            echo '<li><a href="'.esc_url( $social['url'] ).'" target="_blank" ><i class="fab fa-'.esc_attr( $social['name'] ).'"></i></a></li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <?php 
                                endif;?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <!--box-widget-item end -->  
                    <?php if(get_current_user_id() != $laumember->ID): ?>          
                    <!--box-widget-item -->
                    <div class="box-widget-item fl-wrap">
                        <div class="box-widget-item-header">
                            <h3><?php esc_html_e( 'Get in Touch : ', 'easybook-add-ons' ); ?></h3>
                        </div>
                        <div class="box-widget">
                            <div class="box-widget-content">

                                <form class="author-message-form custom-form" action="#" method="post">
                                    <fieldset>
                                    <?php if ( !is_user_logged_in() ) { ?>
                                        <label><i class="fal fa-user"></i></i></label>
                                        <input name="lmsg_name" class="has-icon" type="text" placeholder="<?php esc_attr_e( 'Your Name*', 'easybook-add-ons' ); ?>" value="" required="required">
                                        <div class="clearfix"></div>
                                        <label><i class="fal fa-envelope"></i></label>
                                        <input name="lmsg_email" class="has-icon" type="text" placeholder="<?php esc_attr_e( 'Email Address*', 'easybook-add-ons' ); ?>" value="" required="required">
                                        <label><i class="fa fa-phone"></i></label>
                                        <input name="lmsg_phone" class="has-icon" type="text" placeholder="<?php esc_attr_e( 'Phone', 'easybook-add-ons' ); ?>" value="">
                                    <?php } ?>
                                        <textarea name="lmsg_message" cols="40" rows="3" placeholder="<?php esc_attr_e( 'Your message:', 'easybook-add-ons' ); ?>"></textarea>
                                    </fieldset>
                                    <input type="hidden" name="authid" value="<?php echo $laumember->ID; ?>">
                                    <button class="btn big-btn color-bg flat-btn" type="submit"><?php _e( 'Send Message <i class="fa fa-angle-right"></i>', 'easybook-add-ons' ); ?></button>
                                </form>
                
                            </div>
                        </div>
                    </div>
                    <!--box-widget-item end --> 
                    <?php endif; ?>                                            
                </div>
            </div>
            <!--box-widget-wrap end-->
            
            <div class="col-md-8">
                <div class="list-single-main-items fl-wrap">
                    <div class="list-single-main-item-title fl-wrap">
                        <h3><?php echo sprintf(__( 'About <span> %s</span> .', 'easybook-add-ons' ), $laumember->display_name); ?></h3>
                    </div>
                    <?php 
                    echo wpautop( get_the_author_meta('description',$laumember->ID), false );
                    if($laumember->user_url!='') echo '<a href="'.esc_url( $laumember->user_url ).'" class="btn color2-bg transparent-btn float-btn">'.__( 'Visit Website <i class="fa fa-angle-right"></i>', 'easybook-add-ons' ).'</a>';
                    ?>
                </div>
                <?php 
                if(is_front_page()) {
                    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
                } else {
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                }
                $post_args = array(
                    'post_type' => 'listing',
                    'author' => $laumember->ID,
                    'paged' => $paged,
                    'posts_per_page'=> easybook_addons_get_option('listings_count'),
                    // 'posts_per_page'=> $settings['posts_per_page'],
                    // 'orderby'=> $settings['order_by'],
                    // 'order'=> $settings['order'],
                    'post_status' => 'publish'
                );
                $posts_query = new WP_Query($post_args);
                if($posts_query->have_posts()) { 
                ?>
                <div class="list-main-wrap-opt fl-wrap">
                    <div class="list-main-wrap-title fl-wrap">
                        <h2><?php echo sprintf(__( "Hotels added by <span>%s</span>", 'easybook-add-ons' ), $laumember->display_name); ?></h2>
                        <div class="listing-view-layout" style="float:right;">
                            <ul>
                                <li><a class="grid<?php if(easybook_addons_get_option('listings_grid_layout')=='grid') echo ' active';?>" href="#"><i class="fa fa-th-large"></i></a></li>
                                <li><a class="list<?php if(easybook_addons_get_option('listings_grid_layout')=='list') echo ' active';?>" href="#"><i class="fa fa-list-ul"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="listings-grid-wrap two-cols">
                    <!-- list-main-wrap-->
                    <div class="list-main-wrap fl-wrap card-listing ">
                        <div id="listing-items" class="listing-items clearfix">
                        <?php
                            
                            /* Start the Loop */
                            while($posts_query->have_posts()) : $posts_query->the_post(); 
                                easybook_addons_get_template_part('template-parts/listing');
                            endwhile;
                        ?>
                        </div>
                        <?php
                            easybook_addons_custom_pagination($posts_query->max_num_pages,$range = 2, $posts_query);
                        ?>                                
                    </div>
                    <!-- list-main-wrap end-->
                </div>
                <!-- llistings-grid-wrap end-->
                <?php 
                }
                //end if has_posts 
                wp_reset_postdata();
                ?>                      
            </div>
            <!--box-widget-wrap -->
            
        </div>
    </div>
    <div class="section-decor"></div>
</section>
<!-- section end -->
<div class="limit-box fl-wrap"></div>

<?php

get_footer(  );