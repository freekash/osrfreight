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



/* Enable shortcode in widget text content */
add_filter('widget_text', 'do_shortcode');

if(!function_exists('faicon_sc')) {

    function faicon_sc( $atts, $content="" ) {
    
        extract(shortcode_atts(array(
               'name' =>"magic",
               'class'=>'',
         ), $atts));

        $name = str_replace(array("fa fa-","fa-"), "", $name);

        $classes = 'fa fa-'.$name;
        if(!empty($class)){
            $classes .= ' '.$class;
        }
        
        return '<i class="'.$classes.'"></i>'. $content;
     
    }
        
    add_shortcode( 'faicon', 'faicon_sc' ); //Icon
}
if(!function_exists('fapro_sc')) {

    function fapro_sc( $atts, $content="" ) {
    
        extract(shortcode_atts(array(
               'icon' => "",
               'class'=>'',
         ), $atts));

        if(!empty($class)){
            $icon .= ' '.$class;
        }
        
        return '<i class="'.$icon.'"></i>'. $content;
     
    }
        
    add_shortcode( 'fapro', 'fapro_sc' ); //Icon
}
if(!function_exists('easybook_instagram_sc')){
    function easybook_instagram_sc($atts, $content = ''){

        extract(shortcode_atts(array(
               'limit' =>"6",
               'get'=>'user',//tagged
               'clientid'=>'5d9aa6ad29704bcb9e7e151c9b7afcbc',
               'access'=>'3075034521.5d9aa6a.284ff8339f694dbfac8f265bf3e93c8a',
               'userid'=>'3075034521',
               'tagged'=>'easybook-add-ons',
               'resolution'=>'thumbnail',
               'columns'=>'3'
         ), $atts));

        if($get == 'tagged'){
            $getval = $tagged;
        }else if($get == 'user'){
            $getval = $userid;
        }else {
            $getval = 'popular';
        }

        ob_start();

        ?>

        <div class="cththemes-instafeed grid-cols-<?php echo esc_attr($columns );?>" data-limit="<?php echo esc_attr($limit );?>" data-get="<?php echo esc_attr($get );?>" data-getval="<?php echo esc_attr($getval );?>" data-client="<?php echo esc_attr($clientid );?>" data-access="<?php echo esc_attr($access );?>" data-res="<?php echo esc_attr($resolution );?>"><div class='cth-insta-thumb'><ul class="cththemes-instafeed-ul" id="<?php echo uniqid('cththemes-instafeed');?>"></ul></div></div>

        <?php

        $output = ob_get_clean();

        return $output;

    }

    //add_shortcode( 'easybook_instagram', 'easybook_instagram_sc' ); 
}

if(!function_exists('easybook_subscribe_callback')) {

    function easybook_subscribe_callback( $atts, $content="" ) {
        
        extract(shortcode_atts(array(
           'class'=>'',
           // 'title'=>'Newsletter',
           'message'=>__( '', 'easybook-add-ons' ),
           'placeholder'=>__( 'Your Email', 'easybook-add-ons' ),
           'button'=>__( 'Submit', 'easybook-add-ons' ),
           'list_id' => '',
        ), $atts));

        $return = '';

        ob_start();
        ?>
        
        <div class="subscribe-form <?php echo esc_attr( $class ); ?>">
            <?php echo $message; ?>
            <form class="easybook_mailchimp-form">
                <input class="enteremail" id="subscribe-email" name="email" placeholder="<?php echo esc_attr( $placeholder ); ?>" type="email" required="required">
                <button type="submit" class="subscribe-button"><i class="fas fa-rss-square"></i> <?php echo esc_html( $button ); ?></button>
                <label for="subscribe-email" class="subscribe-message"></label>
                <?php if ( function_exists( 'wp_create_nonce' ) ) { ?>
                <input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce( 'easybook_mailchimp' ) ?>">
                <?php } 
                if($list_id !=''){ ?>
                <input type="hidden" name="_list_id" value="<?php echo esc_attr( $list_id ); ?>">
                <?php } ?>
            </form>
        </div>
        <?php  
        return ob_get_clean();
            
    }
        
    add_shortcode( 'easybook_subscribe', 'easybook_subscribe_callback' ); //Mailchimp

}

if(!function_exists('easybook_tweets_sc')){
    function easybook_tweets_sc($atts, $content = ''){

        extract(shortcode_atts(array(
               'username' =>'',
               'list'=>'',
               'hashtag'=>'',
               'count'=>'3',
               'list_ticker'=>'no',
               'follow_url' => '',
               'extraclass'=>''
         ), $atts));

        if ( $count =='')
            $count = 3;

        ob_start();

        ?>
        <div class="tweet easybook-tweet tweet-count-<?php echo esc_attr($count );?> tweet-ticker-<?php echo esc_attr($list_ticker );?>" data-username="<?php echo esc_attr($username );?>" data-list="<?php echo esc_attr($list );?>" data-hashtag="<?php echo esc_attr($hashtag );?>" data-ticker="<?php echo esc_attr($list_ticker );?>" data-count="<?php echo esc_attr($count );?>"></div>
        <?php 
        if($follow_url != '') : ?>
        <div class="follow-wrap">
            <a  href="<?php echo esc_url( $follow_url );?>" target="_blank" class="twiit-button"><i class="fa fa-twitter"></i><?php _e(' Follow Us','easybook-add-ons');?></a>  
        </div>
        <?php endif;?>
        <?php

        $output = ob_get_clean();

        return $output;

    }

    add_shortcode( 'easybook_tweets', 'easybook_tweets_sc' ); 
}


