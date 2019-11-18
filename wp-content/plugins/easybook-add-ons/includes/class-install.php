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


class Esb_Class_Install{
    public static function install(){
        $result = add_role( 
                        'l_customer', 
                        // __( 'Listing Customer', 'easybook-add-ons'),
                        _x( 'Listing Customer', 'User role', 'easybook-add-ons' ),
                        array(
                            'level_0'                => true, // Subscriber
                            'read' => true, 
                        )
                        
                    );
        if($result === null) echo  __('Oh... the l_customer role already exists.','easybook-add-ons'); 
       

        $result =   add_role( 
                        'listing_author', 
                        // __( 'Listing Author', 'easybook-add-ons'),
                        _x( 'Listing Author', 'User role', 'easybook-add-ons' ),
                        array(
                            'level_2'                => true, // Author
                            'level_1'                => true, // Contributor
                            'level_0'                => true, // Subscriber

                            'delete_posts'         => true,  // true allows this capability // Use false to explicitly deny
                            'delete_published_posts'   => true,
                            'edit_posts' => true, 
                            'edit_published_posts' => true, 
                            // 'edit_private_posts' => true,
                            'publish_posts' => false, 
                            'read' => true, 
                            'upload_files' => true, 
                        )
                        
                    );
        if($result === null) echo  __('Oh... the listing_author role already exists.','easybook-add-ons'); 
        // add submit_listing cap to administrator and listing_author role
        global $wp_roles;
        if ( ! isset( $wp_roles ) ) {
            $wp_roles = new WP_Roles();
        }
        $wp_roles->add_cap( 'listing_author', 'submit_listing' );
        $wp_roles->add_cap( 'administrator', 'submit_listing' );
        // if need admin can edit each other posts
        // $wp_roles->add_cap( 'administrator', 'edit_others_posts' );

        

        // http://www.wpexplorer.com/wordpress-page-templates-plugin/
        $exists_options = get_option( 'easybook-addons-options', array() );
        // add new pages
        // - page args
        $_p = array();
        // $_p['post_content']   = '';
        $_p['post_status']    = 'publish';
        $_p['post_type']      = 'page';
        $_p['comment_status'] = 'closed';
        $_p['ping_status']    = 'closed';

        $_p['page_template']    = 'home-page.php';

        // - dashboard page
        $dashboard_page_title = __('Dashboard','easybook-add-ons');
        $dashboard_page = get_page_by_title($dashboard_page_title);
        if (!$dashboard_page){
            $_p['post_title']     = $dashboard_page_title;

            $_p['post_content']   = '[listing_dashboard_page]';
            // Insert the post into the database
            $exists_options['dashboard_page'] = wp_insert_post($_p); // return post Id or 0 or WP_Error if not success

        }else{
            //make sure the page is not trashed...
            $dashboard_page->post_status = 'publish';
            $dashboard_page->post_content = '[listing_dashboard_page]';
            // $dashboard_page->page_template = 'home-page.php';
            $exists_options['dashboard_page'] = wp_update_post($dashboard_page); // return post Id or 0 if not success
        }

        // - checkout page
        $page_title = __('Listing Checkout','easybook-add-ons');
        $page_post = get_page_by_title($page_title);
        if (!$page_post){
            $_p['post_title']     = $page_title;
            $_p['post_content']   = '[listing_checkout_page]';
            // Insert the post into the database
            $exists_options['checkout_page'] = wp_insert_post($_p); // return post Id or 0 or WP_Error if not success
        }else{
            //make sure the page is not trashed...
            $page_post->post_status = 'publish';
            $page_post->post_content = '[listing_checkout_page]';
            $exists_options['checkout_page'] = wp_update_post($page_post); // return post Id or 0 if not success
        }
        // update plugin options
        $return = update_option( 'easybook-addons-options', $exists_options );

        

        $fresh_installed = false;

        $demo_azp_css = '{"3758":{"single":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jnv3zspgm{width:66.66%;}.body-easybook .azp-element-jnv3zspgm{padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:0px;}.body-easybook .azp-element-jnv3ztkyv{width:33.33%;}}","preview":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jp2fhc7bp{padding-top:0px;padding-right:0px;padding-bottom:20px;padding-left:0px;}.body-easybook .azp-element-jp2fhc7bp{border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;}.body-easybook .azp-element-jp2fhc7bp{border-color:#eeeeee;}.body-easybook .azp-element-jp2fhc7bp{border-style:dashed;}.body-easybook .azp-element-jp2fhrhdu{padding-top:0px;padding-right:0px;padding-bottom:30px;padding-left:0px;}.body-easybook .azp-element-jp2fhrhdu{border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;}.body-easybook .azp-element-jp2fhrhdu{border-color:#eeeeee;}.body-easybook .azp-element-jp2fhrhdu{border-style:dashed;}}","filter":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jntppopsl{margin-top:0px;margin-right:0px;margin-bottom:20px;margin-left:0px;}.body-easybook .azp-element-jntppoptq{padding-top:0px;padding-right:20px;padding-bottom:0px;padding-left:20px;}.body-easybook .azp-element-jntppoptb{padding:px;}.body-easybook .azp-element-jntppopt2{padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:15px;}.body-easybook .azp-element-jntppopt9{padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:15px;}.body-easybook .azp-element-jntsaoshn{width:30%;}.body-easybook .azp-element-jntxupccy{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jntxupwfc{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jntxuq22y{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jntsaq58s{width:50%;}.body-easybook .azp-element-jntsaqw31{width:20%;}}@media screen and (max-width: 1024px) and (min-width: 768px) {.body-easybook .azp-element-jntppoptq{width:100%;}.body-easybook .azp-element-jntppoptq{padding:1px;}.body-easybook .azp-element-jntppopt2{width:100%;}.body-easybook .azp-element-jntppopt9{width:100%;}.body-easybook .azp-element-jntsaoshn{width:100%;}.body-easybook .azp-element-jntsaq58s{width:100%;}.body-easybook .azp-element-jntsaqw31{width:100%;}.body-easybook .azp-element-jntxvme4t{width:100%;}.body-easybook .azp-element-jntxw1qca{width:100%;}}","fheader":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jo6tan48k{width:30%;}.body-easybook .azp-element-jo6tan48k{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jo6tao5qk{width:30%;}.body-easybook .azp-element-jo6tao5qk{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jo6taopq9{width:30%;}.body-easybook .azp-element-jo6taopq9{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jo6tapo5a{width:10%;}}","fherosec":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jntnucyc1{width:28%;}.body-easybook .azp-element-jntnucyc1{padding:px;}.body-easybook .azp-element-jntnucyck{width:28%;}.body-easybook .azp-element-jntnucyck{padding:px;}.body-easybook .azp-element-jntnucyca{width:28%;}.body-easybook .azp-element-jntnucyca{padding:0px;}.body-easybook .azp-element-jntnucycf{width:100%;}.body-easybook .azp-element-jntnucycp{width:16%;}}","sbooking":"@media screen and (min-width: 1024px){}","sroom":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jnwlb3cvv{width:40%;}.body-easybook .azp-element-jnwlb3cvv{padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:15px;}.body-easybook .azp-element-jnwlb4bk4{width:60%;}.body-easybook .azp-element-jnwlb4bk4{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jnwlej7h6{width:50%;}.body-easybook .azp-element-jnwlejiq7{width:50%;}}","proom":"@media screen and (min-width: 1024px){}"},"4098":{"single":"","preview":"","filter":"","fheader":"","fherosec":"","sbooking":"","sroom":"","proom":""},"4076":{"single":"","preview":"","filter":"","fheader":"","fherosec":"","sbooking":"","sroom":"","proom":""},"5058":{"single":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jnv3zspgm{width:66.66%;}.body-easybook .azp-element-jnv3zspgm{padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:0px;}.body-easybook .azp-element-jnv3ztkyv{width:33.33%;}}","preview":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jp2fhc7bp{margin-top:0px;margin-right:0px;margin-bottom:12px;margin-left:0px;}.body-easybook .azp-element-jp2fhc7bp{padding-top:0px;padding-right:0px;padding-bottom:20px;padding-left:0px;}.body-easybook .azp-element-jp2fhc7bp{border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;}.body-easybook .azp-element-jp2fhc7bp{border-color:#cccccc;}.body-easybook .azp-element-jp2fhc7bp{border-style:dashed;}.body-easybook .azp-element-jp2fhrhdu{margin-top:0px;margin-right:0px;margin-bottom:20px;margin-left:0px;}.body-easybook .azp-element-jp2fhrhdu{padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;}.body-easybook .azp-element-jp2fhrhdu{border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;}.body-easybook .azp-element-jp2fhrhdu{border-color:#ccc;}.body-easybook .azp-element-jp2fhrhdu{border-style:dashed;}.body-easybook .azp-element-jp2fhugl5{width:60%;}.body-easybook .azp-element-jp2fhysj7{width:40%;}}@media screen and (max-width: 1024px) and (min-width: 768px) {.body-easybook .azp-element-jp2fhugl5{width:60%;}.body-easybook .azp-element-jp2fhysj7{width:40%;}}@media screen and (max-width: 767px){.body-easybook .azp-element-jp2fhugl5{width:55%;}.body-easybook .azp-element-jp2fhysj7{width:45%;}}","filter":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jntppopsl{margin-top:0px;margin-right:0px;margin-bottom:20px;margin-left:0px;}.body-easybook .azp-element-jntppoptq{padding-top:0px;padding-right:20px;padding-bottom:0px;padding-left:20px;}.body-easybook .azp-element-jntppoptb{}.body-easybook .azp-element-jntppopt2{padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:15px;}.body-easybook .azp-element-jntppopt9{padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:15px;}.body-easybook .azp-element-jntsaoshn{width:30%;}.body-easybook .azp-element-jntxupccy{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jntxupwfc{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jntxuq22y{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jntsaq58s{width:50%;}.body-easybook .azp-element-jntsaqw31{width:20%;}.body-easybook .azp-element-jntxvme4t{width:33.33%;}.body-easybook .azp-element-jntxw1qca{width:66.67%;}}@media screen and (max-width: 1024px) and (min-width: 768px) {.body-easybook .azp-element-jntppoptq{width:100%;}.body-easybook .azp-element-jntppoptq{padding:1px;}.body-easybook .azp-element-jntppopt2{width:100%;}.body-easybook .azp-element-jntppopt9{width:100%;}.body-easybook .azp-element-jntsaoshn{width:100%;}.body-easybook .azp-element-jntxupccy{width:33.33%;}.body-easybook .azp-element-jntxupwfc{width:33.33%;}.body-easybook .azp-element-jntxuq22y{width:33.33%;}.body-easybook .azp-element-jntsaq58s{width:100%;}.body-easybook .azp-element-jntsaqw31{width:100%;}.body-easybook .azp-element-jntxvme4t{width:100%;}.body-easybook .azp-element-jntxw1qca{width:100%;}}@media screen and (max-width: 767px){.body-easybook .azp-element-jntxupccy{width:33.33%;}.body-easybook .azp-element-jntxupwfc{width:33.33%;}.body-easybook .azp-element-jntxuq22y{width:33.33%;}}","fheader":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jo6tan48k{width:33.33%;}.body-easybook .azp-element-jo6tan48k{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jo6tao5qk{width:25%;}.body-easybook .azp-element-jo6tao5qk{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jo6taopq9{width:25%;}.body-easybook .azp-element-jo6taopq9{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jo6tapo5a{width:16.66%;}}@media screen and (max-width: 1024px) and (min-width: 768px) {.body-easybook .azp-element-jo6tcczie{width:33.33%;}.body-easybook .azp-element-jo6tcd6f9{width:33.33%;}.body-easybook .azp-element-jo6tcdr1y{width:33.33%;}}@media screen and (max-width: 767px){.body-easybook .azp-element-jo6tcczie{width:33.33%;}.body-easybook .azp-element-jo6tcd6f9{width:33.33%;}.body-easybook .azp-element-jo6tcdr1y{width:33.33%;}}","fherosec":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jntnucyc1{width:28%;}.body-easybook .azp-element-jntnucyc1{}.body-easybook .azp-element-jntnucyck{width:28%;}.body-easybook .azp-element-jntnucyck{}.body-easybook .azp-element-jntnucyca{width:28%;}.body-easybook .azp-element-jntnucyca{padding:0px;}.body-easybook .azp-element-jntnucycf{width:100%;}.body-easybook .azp-element-jntnucycp{width:16%;}}","sbooking":"@media screen and (min-width: 1024px){}","sroom":"@media screen and (min-width: 1024px){}","proom":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jrbjigyl7{width:40%;}.body-easybook .azp-element-jrbjiiz3o{width:60%;}.body-easybook .azp-element-jrbjjq07j{width:50%;}.body-easybook .azp-element-jrbjjqeyl{width:50%;}}@media screen and (max-width: 1024px) and (min-width: 768px) {.body-easybook .azp-element-jrbjjq07j{width:50%;}.body-easybook .azp-element-jrbjjqeyl{width:50%;}}@media screen and (max-width: 767px){.body-easybook .azp-element-jrbjjq07j{width:100%;}.body-easybook .azp-element-jrbjjqeyl{width:100%;}}"},"5064":{"single":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jqfz9xu82{width:66.66%;}.body-easybook .azp-element-jqfz9zqyg{width:33.33%;}}","preview":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jp2fhc7bp{margin-top:0px;margin-right:0px;margin-bottom:12px;margin-left:0px;}.body-easybook .azp-element-jp2fhc7bp{padding-top:0px;padding-right:0px;padding-bottom:20px;padding-left:0px;}.body-easybook .azp-element-jp2fhc7bp{border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;}.body-easybook .azp-element-jp2fhc7bp{border-color:#cccccc;}.body-easybook .azp-element-jp2fhc7bp{border-style:dashed;}.body-easybook .azp-element-jp2fhrhdu{margin-top:0px;margin-right:0px;margin-bottom:20px;margin-left:0px;}.body-easybook .azp-element-jp2fhrhdu{padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;}.body-easybook .azp-element-jp2fhrhdu{border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;}.body-easybook .azp-element-jp2fhrhdu{border-color:#ccc;}.body-easybook .azp-element-jp2fhrhdu{border-style:dashed;}.body-easybook .azp-element-jp2fhugl5{width:60%;}.body-easybook .azp-element-jp2fhysj7{width:40%;}}@media screen and (max-width: 1024px) and (min-width: 768px) {.body-easybook .azp-element-jp2fhugl5{width:60%;}.body-easybook .azp-element-jp2fhysj7{width:40%;}}@media screen and (max-width: 767px){.body-easybook .azp-element-jp2fhugl5{width:55%;}.body-easybook .azp-element-jp2fhysj7{width:45%;}}","filter":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jntppopsl{margin-top:0px;margin-right:0px;margin-bottom:20px;margin-left:0px;}.body-easybook .azp-element-jntppoptq{padding-top:0px;padding-right:20px;padding-bottom:0px;padding-left:20px;}.body-easybook .azp-element-jntppoptb{}.body-easybook .azp-element-jntppopt2{padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:15px;}.body-easybook .azp-element-jntppopt9{padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:15px;}.body-easybook .azp-element-jntsaoshn{width:30%;}.body-easybook .azp-element-jntxupccy{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jntxupwfc{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jntxuq22y{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jntsaq58s{width:50%;}.body-easybook .azp-element-jntsaqw31{width:20%;}}@media screen and (max-width: 1024px) and (min-width: 768px) {.body-easybook .azp-element-jntppoptq{width:100%;}.body-easybook .azp-element-jntppoptq{padding:1px;}.body-easybook .azp-element-jntppopt2{width:100%;}.body-easybook .azp-element-jntppopt9{width:100%;}.body-easybook .azp-element-jntsaoshn{width:100%;}.body-easybook .azp-element-jntsaq58s{width:100%;}.body-easybook .azp-element-jntsaqw31{width:100%;}.body-easybook .azp-element-jntxvme4t{width:100%;}.body-easybook .azp-element-jntxw1qca{width:100%;}}@media screen and (max-width: 767px){.body-easybook .azp-element-jntppoptq{width:100%;}.body-easybook .azp-element-jntppopt2{width:100%;}.body-easybook .azp-element-jntppopt9{width:100%;}.body-easybook .azp-element-jntsaoshn{width:100%;}.body-easybook .azp-element-jntsaq58s{width:100%;}.body-easybook .azp-element-jntsaqw31{width:100%;}}","fheader":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jo6tan48k{width:33.33%;}.body-easybook .azp-element-jo6tan48k{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jo6tao5qk{width:25%;}.body-easybook .azp-element-jo6tao5qk{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jo6taopq9{width:25%;}.body-easybook .azp-element-jo6taopq9{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jo6tapo5a{width:16.66%;}}","fherosec":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jntnucyc1{width:28%;}.body-easybook .azp-element-jntnucyc1{}.body-easybook .azp-element-jntnucyck{width:28%;}.body-easybook .azp-element-jntnucyck{}.body-easybook .azp-element-jntnucyca{width:28%;}.body-easybook .azp-element-jntnucyca{padding:0px;}.body-easybook .azp-element-jntnucycf{width:100%;}.body-easybook .azp-element-jntnucycp{width:16%;}}","sbooking":"@media screen and (min-width: 1024px){}","sroom":"@media screen and (min-width: 1024px){}","proom":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jrbjvwwlk{width:40%;}.body-easybook .azp-element-jrbjvy4wt{width:60%;}.body-easybook .azp-element-jrbjwk57s{width:50%;}.body-easybook .azp-element-jrbjwksx3{width:50%;}}@media screen and (max-width: 1024px) and (min-width: 768px) {.body-easybook .azp-element-jrbjwk57s{width:50%;}.body-easybook .azp-element-jrbjwksx3{width:50%;}}@media screen and (max-width: 767px){.body-easybook .azp-element-jrbjwk57s{width:100%;}.body-easybook .azp-element-jrbjwksx3{width:100%;}}"},"5065":{"single":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jnv3zspgm{width:66.66%;}.body-easybook .azp-element-jnv3zspgm{padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:0px;}.body-easybook .azp-element-jnv3ztkyv{width:33.33%;}}","preview":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jp2fhc7bp{margin-top:0px;margin-right:0px;margin-bottom:12px;margin-left:0px;}.body-easybook .azp-element-jp2fhc7bp{padding-top:0px;padding-right:0px;padding-bottom:20px;padding-left:0px;}.body-easybook .azp-element-jp2fhc7bp{border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;}.body-easybook .azp-element-jp2fhc7bp{border-color:#cccccc;}.body-easybook .azp-element-jp2fhc7bp{border-style:dashed;}.body-easybook .azp-element-jp2fhrhdu{margin-top:0px;margin-right:0px;margin-bottom:20px;margin-left:0px;}.body-easybook .azp-element-jp2fhrhdu{padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;}.body-easybook .azp-element-jp2fhrhdu{border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;}.body-easybook .azp-element-jp2fhrhdu{border-color:#ccc;}.body-easybook .azp-element-jp2fhrhdu{border-style:dashed;}.body-easybook .azp-element-jp2fhugl5{width:60%;}.body-easybook .azp-element-jp2fhysj7{width:40%;}}@media screen and (max-width: 1024px) and (min-width: 768px) {.body-easybook .azp-element-jp2fhugl5{width:60%;}.body-easybook .azp-element-jp2fhysj7{width:40%;}}@media screen and (max-width: 767px){.body-easybook .azp-element-jp2fhugl5{width:55%;}.body-easybook .azp-element-jp2fhysj7{width:45%;}}","filter":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jntppopsl{margin-top:0px;margin-right:0px;margin-bottom:20px;margin-left:0px;}.body-easybook .azp-element-jntppoptq{padding-top:0px;padding-right:20px;padding-bottom:0px;padding-left:20px;}.body-easybook .azp-element-jntppoptb{}.body-easybook .azp-element-jntppopt2{padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:15px;}.body-easybook .azp-element-jntppopt9{padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:15px;}.body-easybook .azp-element-jntsaoshn{width:30%;}.body-easybook .azp-element-jntxupccy{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jntxupwfc{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jntxuq22y{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jntsaq58s{width:50%;}.body-easybook .azp-element-jntsaqw31{width:20%;}}@media screen and (max-width: 1024px) and (min-width: 768px) {.body-easybook .azp-element-jntppoptq{width:100%;}.body-easybook .azp-element-jntppoptq{padding:1px;}.body-easybook .azp-element-jntppopt2{width:100%;}.body-easybook .azp-element-jntppopt9{width:100%;}.body-easybook .azp-element-jntsaoshn{width:100%;}.body-easybook .azp-element-jntsaq58s{width:100%;}.body-easybook .azp-element-jntsaqw31{width:100%;}.body-easybook .azp-element-jntxvme4t{width:100%;}.body-easybook .azp-element-jntxw1qca{width:100%;}}@media screen and (max-width: 767px){.body-easybook .azp-element-jntppoptq{width:100%;}.body-easybook .azp-element-jntppopt2{width:100%;}.body-easybook .azp-element-jntppopt9{width:100%;}.body-easybook .azp-element-jntsaoshn{width:100%;}.body-easybook .azp-element-jntsaq58s{width:100%;}.body-easybook .azp-element-jntsaqw31{width:100%;}}","fheader":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jo6tan48k{width:33.33%;}.body-easybook .azp-element-jo6tan48k{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jo6tao5qk{width:25%;}.body-easybook .azp-element-jo6tao5qk{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jo6taopq9{width:25%;}.body-easybook .azp-element-jo6taopq9{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jo6tapo5a{width:16.66%;}}","fherosec":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jntnucyc1{width:28%;}.body-easybook .azp-element-jntnucyc1{}.body-easybook .azp-element-jntnucyck{width:28%;}.body-easybook .azp-element-jntnucyck{}.body-easybook .azp-element-jntnucyca{width:28%;}.body-easybook .azp-element-jntnucyca{padding:0px;}.body-easybook .azp-element-jntnucycf{width:100%;}.body-easybook .azp-element-jntnucycp{width:16%;}}","sbooking":"@media screen and (min-width: 1024px){}","sroom":"@media screen and (min-width: 1024px){}","proom":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jrbjyzmnn{width:40%;}.body-easybook .azp-element-jrbjz73rn{width:60%;}.body-easybook .azp-element-jrbjzrlw5{width:50%;}.body-easybook .azp-element-jrbjzrytm{width:50%;}}@media screen and (max-width: 1024px) and (min-width: 768px) {.body-easybook .azp-element-jrbjzrlw5{width:50%;}.body-easybook .azp-element-jrbjzrytm{width:50%;}}@media screen and (max-width: 767px){.body-easybook .azp-element-jrbjzrlw5{width:100%;}.body-easybook .azp-element-jrbjzrytm{width:100%;}}"},"5113":{"single":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jnv3zspgm{width:66.66%;}.body-easybook .azp-element-jnv3zspgm{padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:0px;}.body-easybook .azp-element-jnv3ztkyv{width:33.33%;}}","preview":"@media screen and (min-width: 1024px){}","filter":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jntppopsl{margin-top:0px;margin-right:0px;margin-bottom:20px;margin-left:0px;}.body-easybook .azp-element-jntppoptq{padding-top:0px;padding-right:20px;padding-bottom:0px;padding-left:20px;}.body-easybook .azp-element-jntppoptb{}.body-easybook .azp-element-jntppopt2{padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:15px;}.body-easybook .azp-element-jntppopt9{padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:15px;}.body-easybook .azp-element-jntsaoshn{width:30%;}.body-easybook .azp-element-jntxupccy{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jntxupwfc{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jntxuq22y{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jntsaq58s{width:50%;}.body-easybook .azp-element-jntsaqw31{width:20%;}}@media screen and (max-width: 1024px) and (min-width: 768px) {.body-easybook .azp-element-jntppoptq{width:100%;}.body-easybook .azp-element-jntppoptq{padding:1px;}.body-easybook .azp-element-jntppopt2{width:100%;}.body-easybook .azp-element-jntppopt9{width:100%;}.body-easybook .azp-element-jntsaoshn{width:100%;}.body-easybook .azp-element-jntsaq58s{width:100%;}.body-easybook .azp-element-jntsaqw31{width:100%;}.body-easybook .azp-element-jntxvme4t{width:100%;}.body-easybook .azp-element-jntxw1qca{width:100%;}}@media screen and (max-width: 767px){.body-easybook .azp-element-jntppoptq{width:100%;}.body-easybook .azp-element-jntppopt2{width:100%;}.body-easybook .azp-element-jntppopt9{width:100%;}.body-easybook .azp-element-jntsaoshn{width:100%;}.body-easybook .azp-element-jntsaq58s{width:100%;}.body-easybook .azp-element-jntsaqw31{width:100%;}}","fheader":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jo6tan48k{width:33.33%;}.body-easybook .azp-element-jo6tan48k{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jo6tao5qk{width:25%;}.body-easybook .azp-element-jo6tao5qk{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jo6taopq9{width:25%;}.body-easybook .azp-element-jo6taopq9{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jo6tapo5a{width:16.66%;}}","fherosec":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jntnucyc1{width:28%;}.body-easybook .azp-element-jntnucyc1{}.body-easybook .azp-element-jntnucyck{width:28%;}.body-easybook .azp-element-jntnucyck{}.body-easybook .azp-element-jntnucyca{width:28%;}.body-easybook .azp-element-jntnucyca{padding:0px;}.body-easybook .azp-element-jntnucycf{width:100%;}.body-easybook .azp-element-jntnucycp{width:16%;}}","sbooking":"@media screen and (min-width: 1024px){}","sroom":"@media screen and (min-width: 1024px){}","proom":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jrbjswq2h{width:40%;}.body-easybook .azp-element-jrbjsy5lo{width:60%;}.body-easybook .azp-element-jrbjtksey{width:50%;}.body-easybook .azp-element-jrbjtm3t0{width:50%;}}@media screen and (max-width: 1024px) and (min-width: 768px) {.body-easybook .azp-element-jrbjtksey{width:50%;}.body-easybook .azp-element-jrbjtm3t0{width:50%;}}@media screen and (max-width: 767px){.body-easybook .azp-element-jrbjtksey{width:100%;}.body-easybook .azp-element-jrbjtm3t0{width:100%;}}"},"5121":{"single":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jnv3zspgm{width:66.66%;}.body-easybook .azp-element-jnv3zspgm{padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:0px;}.body-easybook .azp-element-jnv3ztkyv{width:33.33%;}}","preview":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jp2fhc7bp{margin-top:0px;margin-right:0px;margin-bottom:12px;margin-left:0px;}.body-easybook .azp-element-jp2fhc7bp{padding-top:0px;padding-right:0px;padding-bottom:20px;padding-left:0px;}.body-easybook .azp-element-jp2fhc7bp{border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;}.body-easybook .azp-element-jp2fhc7bp{border-color:#cccccc;}.body-easybook .azp-element-jp2fhc7bp{border-style:dashed;}.body-easybook .azp-element-jp2fhrhdu{margin-top:0px;margin-right:0px;margin-bottom:20px;margin-left:0px;}.body-easybook .azp-element-jp2fhrhdu{padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;}.body-easybook .azp-element-jp2fhrhdu{border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;}.body-easybook .azp-element-jp2fhrhdu{border-color:#ccc;}.body-easybook .azp-element-jp2fhrhdu{border-style:dashed;}.body-easybook .azp-element-jp2fhugl5{width:60%;}.body-easybook .azp-element-jp2fhysj7{width:40%;}}@media screen and (max-width: 1024px) and (min-width: 768px) {.body-easybook .azp-element-jp2fhugl5{width:60%;}.body-easybook .azp-element-jp2fhysj7{width:40%;}}@media screen and (max-width: 767px){.body-easybook .azp-element-jp2fhugl5{width:55%;}.body-easybook .azp-element-jp2fhysj7{width:45%;}}","filter":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jntppopsl{margin-top:0px;margin-right:0px;margin-bottom:20px;margin-left:0px;}.body-easybook .azp-element-jntppoptq{padding-top:0px;padding-right:20px;padding-bottom:0px;padding-left:20px;}.body-easybook .azp-element-jntppoptb{}.body-easybook .azp-element-jntppopt2{padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:15px;}.body-easybook .azp-element-jntppopt9{padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:15px;}.body-easybook .azp-element-jntsaoshn{width:30%;}.body-easybook .azp-element-jntxupccy{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jntxupwfc{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jntxuq22y{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jntsaq58s{width:50%;}.body-easybook .azp-element-jntsaqw31{width:20%;}}@media screen and (max-width: 1024px) and (min-width: 768px) {.body-easybook .azp-element-jntppoptq{width:100%;}.body-easybook .azp-element-jntppoptq{padding:1px;}.body-easybook .azp-element-jntppopt2{width:100%;}.body-easybook .azp-element-jntppopt9{width:100%;}.body-easybook .azp-element-jntsaoshn{width:100%;}.body-easybook .azp-element-jntsaq58s{width:100%;}.body-easybook .azp-element-jntsaqw31{width:100%;}.body-easybook .azp-element-jntxvme4t{width:100%;}.body-easybook .azp-element-jntxw1qca{width:100%;}}@media screen and (max-width: 767px){.body-easybook .azp-element-jntppoptq{width:100%;}.body-easybook .azp-element-jntppopt2{width:100%;}.body-easybook .azp-element-jntppopt9{width:100%;}.body-easybook .azp-element-jntsaoshn{width:100%;}.body-easybook .azp-element-jntsaq58s{width:100%;}.body-easybook .azp-element-jntsaqw31{width:100%;}}","fheader":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jo6tan48k{width:33.33%;}.body-easybook .azp-element-jo6tan48k{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jo6tao5qk{width:25%;}.body-easybook .azp-element-jo6tao5qk{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jo6taopq9{width:25%;}.body-easybook .azp-element-jo6taopq9{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jo6tapo5a{width:16.66%;}}","fherosec":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jntnucyc1{width:28%;}.body-easybook .azp-element-jntnucyc1{}.body-easybook .azp-element-jntnucyck{width:28%;}.body-easybook .azp-element-jntnucyck{}.body-easybook .azp-element-jntnucyca{width:28%;}.body-easybook .azp-element-jntnucyca{padding:0px;}.body-easybook .azp-element-jntnucycf{width:100%;}.body-easybook .azp-element-jntnucycp{width:16%;}}","sbooking":"@media screen and (min-width: 1024px){}","sroom":"@media screen and (min-width: 1024px){}","proom":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jrbk3anjf{width:40%;}.body-easybook .azp-element-jrbk41nf2{width:60%;}.body-easybook .azp-element-jrbk5g78o{width:50%;}.body-easybook .azp-element-jrbk5glbu{width:50%;}}@media screen and (max-width: 1024px) and (min-width: 768px) {.body-easybook .azp-element-jrbk5g78o{width:50%;}.body-easybook .azp-element-jrbk5glbu{width:50%;}}@media screen and (max-width: 767px){.body-easybook .azp-element-jrbk5g78o{width:100%;}.body-easybook .azp-element-jrbk5glbu{width:100%;}}"},"6149":{"single":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jnv3zspgm{width:66.66%;}.body-easybook .azp-element-jnv3zspgm{padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:0px;}.body-easybook .azp-element-jnv3ztkyv{width:33.33%;}}","preview":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jp2fhc7bp{margin-top:0px;margin-right:0px;margin-bottom:12px;margin-left:0px;}.body-easybook .azp-element-jp2fhc7bp{padding-top:0px;padding-right:0px;padding-bottom:20px;padding-left:0px;}.body-easybook .azp-element-jp2fhc7bp{border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;}.body-easybook .azp-element-jp2fhc7bp{border-color:#cccccc;}.body-easybook .azp-element-jp2fhc7bp{border-style:dashed;}.body-easybook .azp-element-jp2fhrhdu{margin-top:0px;margin-right:0px;margin-bottom:20px;margin-left:0px;}.body-easybook .azp-element-jp2fhrhdu{padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;}.body-easybook .azp-element-jp2fhrhdu{border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;}.body-easybook .azp-element-jp2fhrhdu{border-color:#ccc;}.body-easybook .azp-element-jp2fhrhdu{border-style:dashed;}.body-easybook .azp-element-jp2fhugl5{width:60%;}.body-easybook .azp-element-jp2fhysj7{width:40%;}}@media screen and (max-width: 1024px) and (min-width: 768px) {.body-easybook .azp-element-jp2fhugl5{width:60%;}.body-easybook .azp-element-jp2fhysj7{width:40%;}}@media screen and (max-width: 767px){.body-easybook .azp-element-jp2fhugl5{width:55%;}.body-easybook .azp-element-jp2fhysj7{width:45%;}}","filter":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jntppopsl{margin-top:0px;margin-right:0px;margin-bottom:20px;margin-left:0px;}.body-easybook .azp-element-jntppoptq{padding-top:0px;padding-right:20px;padding-bottom:0px;padding-left:20px;}.body-easybook .azp-element-jntppoptb{}.body-easybook .azp-element-jntppopt2{padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:15px;}.body-easybook .azp-element-jntppopt9{padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:15px;}.body-easybook .azp-element-jntsaoshn{width:30%;}.body-easybook .azp-element-jntxupccy{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jntxupwfc{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jntxuq22y{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jntsaq58s{width:50%;}.body-easybook .azp-element-jntsaqw31{width:20%;}.body-easybook .azp-element-jntxvme4t{width:33.33%;}.body-easybook .azp-element-jntxw1qca{width:66.67%;}}@media screen and (max-width: 1024px) and (min-width: 768px) {.body-easybook .azp-element-jntppoptq{width:100%;}.body-easybook .azp-element-jntppoptq{padding:1px;}.body-easybook .azp-element-jntppopt2{width:100%;}.body-easybook .azp-element-jntppopt9{width:100%;}.body-easybook .azp-element-jntsaoshn{width:100%;}.body-easybook .azp-element-jntxupccy{width:33.33%;}.body-easybook .azp-element-jntxupwfc{width:33.33%;}.body-easybook .azp-element-jntxuq22y{width:33.33%;}.body-easybook .azp-element-jntsaq58s{width:100%;}.body-easybook .azp-element-jntsaqw31{width:100%;}.body-easybook .azp-element-jntxvme4t{width:100%;}.body-easybook .azp-element-jntxw1qca{width:100%;}}@media screen and (max-width: 767px){.body-easybook .azp-element-jntxupccy{width:33.33%;}.body-easybook .azp-element-jntxupwfc{width:33.33%;}.body-easybook .azp-element-jntxuq22y{width:33.33%;}}","fheader":"","fherosec":"","sbooking":"","sroom":"","proom":""},"6151":{"single":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jnv3zspgm{width:66.66%;}.body-easybook .azp-element-jnv3zspgm{padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:0px;}.body-easybook .azp-element-jnv3ztkyv{width:33.33%;}}","preview":"","filter":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jntppopsl{margin-top:0px;margin-right:0px;margin-bottom:20px;margin-left:0px;}.body-easybook .azp-element-jntppoptq{padding-top:0px;padding-right:20px;padding-bottom:0px;padding-left:20px;}.body-easybook .azp-element-jntppoptb{}.body-easybook .azp-element-jntppopt2{padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:15px;}.body-easybook .azp-element-jntppopt9{padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:15px;}.body-easybook .azp-element-jntsaoshn{width:30%;}.body-easybook .azp-element-jntxupccy{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jntxupwfc{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jntxuq22y{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jntsaq58s{width:50%;}.body-easybook .azp-element-jntsaqw31{width:20%;}.body-easybook .azp-element-jntxvme4t{width:33.33%;}.body-easybook .azp-element-jntxw1qca{width:66.67%;}}@media screen and (max-width: 1024px) and (min-width: 768px) {.body-easybook .azp-element-jntppoptq{width:100%;}.body-easybook .azp-element-jntppoptq{padding:1px;}.body-easybook .azp-element-jntppopt2{width:100%;}.body-easybook .azp-element-jntppopt9{width:100%;}.body-easybook .azp-element-jntsaoshn{width:100%;}.body-easybook .azp-element-jntxupccy{width:33.33%;}.body-easybook .azp-element-jntxupwfc{width:33.33%;}.body-easybook .azp-element-jntxuq22y{width:33.33%;}.body-easybook .azp-element-jntsaq58s{width:100%;}.body-easybook .azp-element-jntsaqw31{width:100%;}.body-easybook .azp-element-jntxvme4t{width:100%;}.body-easybook .azp-element-jntxw1qca{width:100%;}}@media screen and (max-width: 767px){.body-easybook .azp-element-jntxupccy{width:33.33%;}.body-easybook .azp-element-jntxupwfc{width:33.33%;}.body-easybook .azp-element-jntxuq22y{width:33.33%;}}","fheader":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jo6tan48k{width:33.33%;}.body-easybook .azp-element-jo6tan48k{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jo6tao5qk{width:25%;}.body-easybook .azp-element-jo6tao5qk{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jo6taopq9{width:25%;}.body-easybook .azp-element-jo6taopq9{padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;}.body-easybook .azp-element-jo6tapo5a{width:16.66%;}}@media screen and (max-width: 1024px) and (min-width: 768px) {.body-easybook .azp-element-jo6tcczie{width:33.33%;}.body-easybook .azp-element-jo6tcd6f9{width:33.33%;}.body-easybook .azp-element-jo6tcdr1y{width:33.33%;}}@media screen and (max-width: 767px){.body-easybook .azp-element-jo6tcczie{width:33.33%;}.body-easybook .azp-element-jo6tcd6f9{width:33.33%;}.body-easybook .azp-element-jo6tcdr1y{width:33.33%;}}","fherosec":"@media screen and (min-width: 1024px){.body-easybook .azp-element-jntnucyc1{width:28%;}.body-easybook .azp-element-jntnucyc1{}.body-easybook .azp-element-jntnucyck{width:28%;}.body-easybook .azp-element-jntnucyck{}.body-easybook .azp-element-jntnucyca{width:28%;}.body-easybook .azp-element-jntnucyca{padding:0px;}.body-easybook .azp-element-jntnucycf{width:100%;}.body-easybook .azp-element-jntnucycp{width:16%;}}","sbooking":"","sroom":"","proom":""}}';
        $demo_azp_css = json_decode($demo_azp_css, true);

        if( get_option( 'easybook-addons-version', 'fresh_installed' ) == 'fresh_installed' ){
            $easybook_addons_version = '1.0.0';
            $fresh_installed = true;

            $upload_path = easybook_addons_upload_dirs('azp', 'css');
            // $demo_azp_css = json_decode($demo_azp_css, true);
            if( null != $demo_azp_css){
                // set default css
                update_option( 'azp_csses', $demo_azp_css );
                $css_file = $upload_path . DIRECTORY_SEPARATOR . "listing_types.css";
                if(!file_exists($css_file))
                    @file_put_contents($css_file, Esb_Class_Listing_Type_CPT::get_azp_css() );
            }

            self::chat_system();
            self::notification_system();
            self::booking_system();
            self::listing_stats();
            self::author_earning();

        }else{
            if( get_option('azp_csses') == '' && null != $demo_azp_css){
                // set default css
                update_option( 'azp_csses', $demo_azp_css );
                $upload_path = easybook_addons_upload_dirs('azp', 'css');
                $css_file = $upload_path . DIRECTORY_SEPARATOR . "listing_types.css";
                if(!file_exists($css_file))
                    @file_put_contents($css_file, Esb_Class_Listing_Type_CPT::get_azp_css() );
            }
        }
        // else{
        //     if( version_compare('1.0.0', '1.0.1', '<') ){
        //         self::listing_stats();
        //         self::author_earning();
        //     }
        // }
        
        // else{
        //     $easybook_addons_version = get_option( 'easybook-addons-version');
        // }
        // end message
        update_option( 'easybook-addons-version', ESB_VERSION );
            
    }
    public static function uninstall(){
        // remove submit_listing cap to administrator and listing_author role
        global $wp_roles;
        if ( ! isset( $wp_roles ) ) {
            $wp_roles = new WP_Roles();
        }
        $wp_roles->remove_cap( 'listing_author', 'submit_listing' );
        $wp_roles->remove_cap( 'administrator', 'submit_listing' );

        if( get_role('listing_author') ){
            remove_role( 'listing_author' );
        }
        if( get_role('l_customer') ){
            remove_role( 'l_customer' );
        }
        
        // move pages to trash
        $force_delete = false;
        // trash listing pages
        $exists_options = get_option( 'easybook-addons-options', array() );
        if(isset($exists_options['dashboard_page'])){
            wp_delete_post($exists_options['dashboard_page'], $force_delete);
        }
        if(isset($exists_options['checkout_page'])){
            wp_delete_post($exists_options['checkout_page'], $force_delete);
        }

        if( version_compare( get_option( 'easybook-addons-version', '1.0.8' ) , '1.1.0', '<') ){
            // self::drop_foreign_keys();
            self::update_cals();
        }
    }

    private static function update_cals(){
        $listings = get_posts( array(
            'fields'            => 'ids', 
            'posts_per_page'    => -1, 
            'post_type'         => 'listing',
            'post_status'       => 'publish',
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key'     => '_cth_event_dates',
                    'value'   => '',
                    'compare' => '!=',
                ),
                array(
                    'key'     => '_cth_house_dates',
                    'value'   => '',
                    'compare' => '!=',
                ),
                array(
                    'key'     => '_cth_tour_dates',
                    'value'   => '',
                    'compare' => '!=',
                ),
            ),

        ) );
        if ( $listings ) {
            foreach ( $listings as $lid ) {
                if ( metadata_exists( 'post', $lid, '_cth_event_dates' ) ) {
                    $old_dates = get_post_meta( $lid, '_cth_event_dates', true );
                    if($old_dates != ''){
                        update_post_meta( $lid, '_cth_listing_dates', $old_dates );
                        delete_post_meta( $lid, '_cth_event_dates');
                    }
                    $old_metas = get_post_meta( $lid, '_cth_event_dates_metas', true );
                    if($old_metas != ''){
                        update_post_meta( $lid, '_cth_listing_dates_metas', $old_metas );
                        delete_post_meta( $lid, '_cth_event_dates_metas');
                    }
                    $old_show_metas = get_post_meta( $lid, '_cth_event_dates_show_metas', true );
                    if($old_show_metas != ''){
                        update_post_meta( $lid, '_cth_listing_dates_show_metas', $old_show_metas );
                        delete_post_meta( $lid, '_cth_event_dates_show_metas');
                    }

                }

                if ( metadata_exists( 'post', $lid, '_cth_house_dates' ) ) {
                    $old_dates = get_post_meta( $lid, '_cth_house_dates', true );
                    if($old_dates != ''){
                        update_post_meta( $lid, '_cth_listing_dates', $old_dates );
                        delete_post_meta( $lid, '_cth_house_dates');
                    }
                    $old_metas = get_post_meta( $lid, '_cth_house_dates_metas', true );
                    if($old_metas != ''){
                        update_post_meta( $lid, '_cth_listing_dates_metas', $old_metas );
                        delete_post_meta( $lid, '_cth_house_dates_metas');
                    }
                    $old_show_metas = get_post_meta( $lid, '_cth_house_dates_show_metas', true );
                    if($old_show_metas != ''){
                        update_post_meta( $lid, '_cth_listing_dates_show_metas', $old_show_metas );
                        delete_post_meta( $lid, '_cth_house_dates_show_metas');
                    }

                }

                if ( metadata_exists( 'post', $lid, '_cth_tour_dates' ) ) {
                    $old_dates = get_post_meta( $lid, '_cth_tour_dates', true );
                    if($old_dates != ''){
                        update_post_meta( $lid, '_cth_listing_dates', $old_dates );
                        delete_post_meta( $lid, '_cth_tour_dates');
                    }
                    $old_metas = get_post_meta( $lid, '_cth_tour_dates_metas', true );
                    if($old_metas != ''){
                        update_post_meta( $lid, '_cth_listing_dates_metas', $old_metas );
                        delete_post_meta( $lid, '_cth_tour_dates_metas');
                    }
                    $old_show_metas = get_post_meta( $lid, '_cth_tour_dates_show_metas', true );
                    if($old_show_metas != ''){
                        update_post_meta( $lid, '_cth_listing_dates_show_metas', $old_show_metas );
                        delete_post_meta( $lid, '_cth_tour_dates_show_metas');
                    }

                }

            }
        }

    }
    private static function chat_system(){
        global $wpdb;

        $chat_table = $wpdb->prefix . 'cth_chat';
        $chat_reply_table = $wpdb->prefix . 'cth_chat_reply';
        $charset_collate = $wpdb->get_charset_collate();

        $chat_sql = "CREATE TABLE IF NOT EXISTS $chat_table (
            c_id int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            user_one bigint(20) UNSIGNED NOT NULL,
            user_two bigint(20) UNSIGNED NOT NULL,
            ip varchar(30) DEFAULT NULL,
            time int(11) DEFAULT NULL
        ) $charset_collate;";

        // ,
        //     FOREIGN KEY (user_one) REFERENCES $wpdb->users(ID),
        //     FOREIGN KEY (user_two) REFERENCES $wpdb->users(ID)

        $chat_reply_sql = "CREATE TABLE IF NOT EXISTS $chat_reply_table (
            cr_id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            reply text,
            user_id_fk bigint(20) UNSIGNED NOT NULL,
            ip varchar(30) DEFAULT NULL,
            time int(11) DEFAULT NULL,
            c_id_fk int(11) UNSIGNED NOT NULL,
            status TINYINT(1) DEFAULT 0
        ) $charset_collate;";

        // ,
        //     FOREIGN KEY (user_id_fk) REFERENCES $wpdb->users(ID),
        //     FOREIGN KEY (c_id_fk) REFERENCES {$chat_table}(c_id)
        


        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $chat_sql );
        dbDelta( $chat_reply_sql );
    }

    private static function notification_system(){
        global $wpdb;

        $notification_object_table = $wpdb->prefix . 'cth_noti_obj';
        $notification_table = $wpdb->prefix . 'cth_noti';
        $notification_change_table = $wpdb->prefix . 'cth_noti_change';
        $charset_collate = $wpdb->get_charset_collate();

        $noti_obj_sql = "CREATE TABLE IF NOT EXISTS $notification_object_table (
            id int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            entity_type_id int(11) UNSIGNED NOT NULL,
            entity_id int(11) UNSIGNED NOT NULL,
            time int(11) DEFAULT NULL,
            status TINYINT(1) NOT NULL
        ) $charset_collate;";

        $noti_sql = "CREATE TABLE IF NOT EXISTS $notification_table (
            id int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            notification_obj_id int(11) UNSIGNED NOT NULL,
            notifier_id bigint(20) UNSIGNED NOT NULL,
            status TINYINT(1) NOT NULL
        ) $charset_collate;";
        // ,
        //     FOREIGN KEY (notification_obj_id) REFERENCES {$notification_object_table}(id)

        $noti_change_sql = "CREATE TABLE IF NOT EXISTS $notification_change_table (
            id int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            notification_obj_id int(11) UNSIGNED NOT NULL,
            actor_id bigint(20) UNSIGNED NOT NULL,
            status TINYINT(1) NOT NULL
        ) $charset_collate;";
        // ,
        //     FOREIGN KEY (notification_obj_id) REFERENCES {$notification_object_table}(id)

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $noti_obj_sql );
        dbDelta( $noti_sql );
        dbDelta( $noti_change_sql );
    }

    private static function booking_system(){
        global $wpdb;

        $booking_table = $wpdb->prefix . 'cth_booking';
        $charset_collate = $wpdb->get_charset_collate();

        $booking_table_sql = "CREATE TABLE IF NOT EXISTS $booking_table (
            ID bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            booking_id bigint(20) UNSIGNED NOT NULL,
            room_id bigint(20) UNSIGNED NOT NULL,
            guest_id bigint(20) UNSIGNED NOT NULL,
            listing_id bigint(20) UNSIGNED NOT NULL,
            status TINYINT(1) NOT NULL,
            date_from bigint(20) UNSIGNED DEFAULT NULL,
            date_to bigint(20) UNSIGNED DEFAULT NULL,
            quantity TINYINT NOT NULL
        ) $charset_collate;";

        // ,
        //     FOREIGN KEY (booking_id) REFERENCES $wpdb->posts(ID),
        //     FOREIGN KEY (room_id) REFERENCES $wpdb->posts(ID)

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $booking_table_sql );
    }

    private static function listing_stats(){
        global $wpdb;

        $lstats_table = $wpdb->prefix . 'cth_lstats';
        $charset_collate = $wpdb->get_charset_collate();

        $lstats_table_sql = "CREATE TABLE IF NOT EXISTS $lstats_table (
            ID BIGINT(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            post_id BIGINT(20) UNSIGNED NOT NULL,
            child_post_id BIGINT(20) UNSIGNED DEFAULT NULL,
            type VARCHAR(100) DEFAULT NULL,
            value INT(11) NOT NULL,
            meta LONGTEXT DEFAULT NULL,
            year YEAR DEFAULT NULL,
            month VARCHAR(2) DEFAULT NULL,
            date DATE DEFAULT NULL,
            time INT(11) DEFAULT NULL,
            ip VARCHAR(30) DEFAULT NULL,
            guest_id BIGINT(20) UNSIGNED DEFAULT NULL
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $lstats_table_sql );
    }

    private static function author_earning(){
        global $wpdb;

        $earning_table = $wpdb->prefix . 'cth_austats';
        $charset_collate = $wpdb->get_charset_collate();

        $earning_table_sql = "CREATE TABLE IF NOT EXISTS $earning_table (
            ID BIGINT(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            author_id BIGINT(20) UNSIGNED NOT NULL,
            order_id BIGINT(20) UNSIGNED NOT NULL,
            child_post_id BIGINT(20) UNSIGNED DEFAULT NULL,
            type VARCHAR(100) DEFAULT NULL,
            total DECIMAL(13, 4) NOT NULL,
            fee_rate DECIMAL(5, 2) NOT NULL,
            fee DECIMAL(13, 4) NOT NULL,
            earning DECIMAL(13, 4) NOT NULL,
            meta LONGTEXT DEFAULT NULL,
            year YEAR DEFAULT NULL,
            month VARCHAR(2) DEFAULT NULL,
            date DATE DEFAULT NULL,
            time INT(11) DEFAULT NULL,
            status TINYINT(1) NOT NULL
        ) $charset_collate;";

        // DECIMAL(13, 4) - money type

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $earning_table_sql );
    }

    public static function drop_foreign_keys(){
        global $wpdb;



        $booking_table = $wpdb->prefix . 'cth_booking';
        $wpdb->query( "ALTER TABLE $booking_table ADD CONSTRAINT FK_booking_id FOREIGN KEY (booking_id) REFERENCES $wpdb->posts(ID) ON DELETE CASCADE" );
        $wpdb->query( "ALTER TABLE $booking_table DROP FOREIGN KEY FK_booking_id" );
        // $wpdb->query( $wpdb->prepare( "ALTER TABLE $booking_table DROP FOREIGN KEY %s", 'booking_id' ) );
        $wpdb->query( "ALTER TABLE $booking_table ADD CONSTRAINT FK_room_id FOREIGN KEY (room_id) REFERENCES $wpdb->posts(ID) ON DELETE CASCADE" );
        $wpdb->query( "ALTER TABLE $booking_table DROP FOREIGN KEY FK_room_id" ) ;
        // $wpdb->query( $wpdb->prepare( "ALTER TABLE $booking_table DROP FOREIGN KEY %s", 'room_id' ) );

        $notification_object_table = $wpdb->prefix . 'cth_noti_obj';
        $notification_table = $wpdb->prefix . 'cth_noti';
        $wpdb->query( "ALTER TABLE $notification_table ADD CONSTRAINT FK_notification_obj_id FOREIGN KEY (notification_obj_id) REFERENCES {$notification_object_table}(id) ON DELETE CASCADE" );
        $wpdb->query( "ALTER TABLE $notification_table DROP FOREIGN KEY FK_notification_obj_id" ) ;
        // $wpdb->query( $wpdb->prepare( "ALTER TABLE $notification_table DROP FOREIGN KEY %s", 'notification_obj_id' ) );

        $notification_change_table = $wpdb->prefix . 'cth_noti_change';
        $wpdb->query( "ALTER TABLE $notification_change_table ADD CONSTRAINT FK_change_notification_obj_id FOREIGN KEY (notification_obj_id) REFERENCES {$notification_object_table}(id) ON DELETE CASCADE" );
        $wpdb->query( "ALTER TABLE $notification_change_table DROP FOREIGN KEY FK_change_notification_obj_id" ) ;
        // $wpdb->query( $wpdb->prepare( "ALTER TABLE $notification_change_table DROP FOREIGN KEY %s", 'notification_obj_id' ) );

        $chat_table = $wpdb->prefix . 'cth_chat';
        $wpdb->query( "ALTER TABLE $chat_table ADD CONSTRAINT FK_user_one FOREIGN KEY (user_one) REFERENCES $wpdb->users(ID) ON DELETE CASCADE" );
        $wpdb->query( "ALTER TABLE $chat_table DROP FOREIGN KEY FK_user_one" ) ;
        // $wpdb->query( $wpdb->prepare( "ALTER TABLE $chat_table DROP FOREIGN KEY %s", 'user_one' ) );
        $wpdb->query( "ALTER TABLE $chat_table ADD CONSTRAINT FK_user_two FOREIGN KEY (user_two) REFERENCES $wpdb->users(ID) ON DELETE CASCADE" );
        $wpdb->query( "ALTER TABLE $chat_table DROP FOREIGN KEY FK_user_two" ) ;
        // $wpdb->query( $wpdb->prepare( "ALTER TABLE $chat_table DROP FOREIGN KEY %s", 'user_two' ) );

        $chat_reply_table = $wpdb->prefix . 'cth_chat_reply';
        $wpdb->query( "ALTER TABLE $chat_reply_table ADD CONSTRAINT FK_user_id_fk FOREIGN KEY (user_id_fk) REFERENCES $wpdb->users(ID) ON DELETE CASCADE" );
        $wpdb->query( "ALTER TABLE $chat_reply_table DROP FOREIGN KEY FK_user_id_fk" ) ;
        // $wpdb->query( $wpdb->prepare( "ALTER TABLE $chat_reply_table DROP FOREIGN KEY %s", 'user_id_fk' ) );
        $wpdb->query( "ALTER TABLE $chat_reply_table ADD CONSTRAINT FK_c_id_fk FOREIGN KEY (c_id_fk) REFERENCES {$chat_table}(c_id) ON DELETE CASCADE" );
        $wpdb->query( "ALTER TABLE $chat_reply_table DROP FOREIGN KEY FK_c_id_fk" ) ;
        // $wpdb->query( $wpdb->prepare( "ALTER TABLE $chat_reply_table DROP FOREIGN KEY %s", 'c_id_fk' ) );
    }

    

    // drop custom table
    // $booking_table = $wpdb->prefix . 'cth_booking';
    // $wpdb->query( "DROP TABLE {$booking_table}" );

    // $chat_table = $wpdb->prefix . 'cth_chat';
    // $chat_reply_table = $wpdb->prefix . 'cth_chat_reply';

    // $wpdb->query( "DROP TABLE {$chat_reply_table}" );
    // $wpdb->query( "DROP TABLE {$chat_table}" );

    // $notification_object_table = $wpdb->prefix . 'cth_noti_obj';
    // $notification_table = $wpdb->prefix . 'cth_noti';
    // $notification_change_table = $wpdb->prefix . 'cth_noti_change';

    // $wpdb->query( "DROP TABLE {$notification_table}" );
    // $wpdb->query( "DROP TABLE {$notification_change_table}" );
    // $wpdb->query( "DROP TABLE {$notification_object_table}" );


    // drop foreign key
    // https://www.w3schools.com/sql/sql_foreignkey.asp
    // ALTER TABLE Orders DROP FOREIGN KEY FK_PersonOrder;

}