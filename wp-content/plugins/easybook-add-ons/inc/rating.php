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

 

function easybook_addons_get_average_ratings($postID) {
    $average_key = ESB_META_PREFIX.'rating_average';
    $count_key = ESB_META_PREFIX.'rating_count';


    $rating_average = get_post_meta($postID, $average_key, true);
    $listing_type_id = get_post_meta( $postID, ESB_META_PREFIX.'listing_type_id', true );
    $rating_fields = easybook_addons_get_rating_fields($listing_type_id); 
    $rating_values = array();
    if (!empty($rating_fields)) {
        foreach ((array)$rating_fields as $key => $field) {
            // $field = json_decode(json_encode($fields), true);
            // $rate_name = $field['fieldName'];
            // $rate_key =  ESB_META_PREFIX.$field['fieldName'];
            $rating_values[$field['fieldName']] = get_post_meta($postID, ESB_META_PREFIX.$field['fieldName'], true);    
        }
    }
    if($rating_average == ''){ 
        return false;
    }else{
        return array( 
            'count'     => get_post_meta($postID, $count_key, true),
            'sum'       => number_format((float)$rating_average, 1), 
            'values'    => $rating_values, 
        );
    }
    
}

// http://oscardias.com/development/php/wordpress/how-to-add-a-rate-field-to-wordpress-comments/
add_action('comment_post','easybook_addons_comment_ratings', 10, 2);
 
function easybook_addons_comment_ratings($comment_id, $approved) { 

    $comment = get_comment($comment_id);
    if(!empty($comment)){
        $comment_post_ID = $comment->comment_post_ID;
        $listing_type_id = get_post_meta( $comment_post_ID, ESB_META_PREFIX.'listing_type_id', true );
        $rating_fields = easybook_addons_get_rating_fields($listing_type_id);
        if (!empty($rating_fields)) {
            foreach ((array)$rating_fields as $key => $field) {
                // $field = json_decode(json_encode($fields), true);
                $rate_name = $field['fieldName'];
                if(isset($_POST[$rate_name])) add_comment_meta($comment_id, ESB_META_PREFIX.$rate_name, $_POST[$rate_name]);
                // var_dump(add_comment_meta($comment_id, $field['fieldName'], $_POST[$field['fieldName']]));
            }
        }
        if( easybook_addons_get_option('allow_rating_imgs') == 'yes' ){
            if(!empty($comment)){
                $comment_post_ID = $comment->comment_post_ID;
            }
            $images = easybook_addons_handle_image_multiple_upload( 'rating_imgs', $comment_post_ID);
            if( !empty( $images ) ) add_comment_meta($comment_id, 'rating_imgs', $images );
        }
    }
    // allow comment images
    $comment_post_ID = 0;
    // $comment = get_comment($comment_id);
    if( !empty($comment) && $approved === 1){
        easybook_addons_comment_unapproved_to_approved($comment);
        // var_dump(easybook_addons_comment_unapproved_to_approved($comment));
    }

}

// update listing rating for sort
add_action( 'comment_unapproved_to_approved', 'easybook_addons_comment_unapproved_to_approved' );
function easybook_addons_comment_unapproved_to_approved($comment){
    $postID = $comment->comment_post_ID;
    $average_key = ESB_META_PREFIX.'rating_average';
    $count_key = ESB_META_PREFIX.'rating_count';

    $rating_count = get_post_meta($postID, $count_key, true);

    $rate_cacl = array();
    $listing_type_id = get_post_meta( $postID, ESB_META_PREFIX.'listing_type_id', true );
    $rating_fields = easybook_addons_get_rating_fields($listing_type_id);
    if (!empty($rating_fields)) {
        foreach ($rating_fields as $key => $field) {
            $rFieldName = $field['fieldName'];
            $listing_rfield_average = get_post_meta($postID, ESB_META_PREFIX.$rFieldName, true);
            $rating_field_val = get_comment_meta($comment->comment_ID, ESB_META_PREFIX.$rFieldName, true);
            if( (int)$listing_rfield_average > 0 ){
                update_post_meta($postID, ESB_META_PREFIX.$rFieldName,round((($listing_rfield_average * $rating_count +(int)$rating_field_val)/ ($rating_count+1)), 1, PHP_ROUND_HALF_UP) );
            }else{
                update_post_meta($postID, ESB_META_PREFIX.$rFieldName, (int)$rating_field_val);
            }
            $rate_cacl[] = (int)$rating_field_val;
            
        }
    }
    // var_dump($rate_cacl);
    $comment_total_rating = 0;
    if (!empty($rate_cacl)){
        $comment_total_rating = round((array_sum($rate_cacl) / count($rate_cacl)), 1, PHP_ROUND_HALF_UP);
    }

    if($comment_total_rating != ''){
        // var_dump($comment_total_rating );

        // update rating average
        $listing_rsum_average = get_post_meta($postID, $average_key, true);
        if( (int)$listing_rsum_average > 0 ){
            update_post_meta($postID, $average_key,round((($listing_rsum_average * $rating_count + $comment_total_rating)/ ($rating_count+1)), 1, PHP_ROUND_HALF_UP));
        }else{
            update_post_meta($postID, $average_key, $comment_total_rating);
        }
        // update_post_meta($postID, $rating_key, $total_rating);
        // update rating count
        
        if((int)$rating_count > 0) 
            $rating_count++;
        else
            $rating_count = 1;

        update_post_meta($postID, $count_key, $rating_count);
    }
}
add_action( 'comment_approved_to_unapproved', 'easybook_addons_comment_approved_to_unapproved' );
function easybook_addons_comment_approved_to_unapproved($comment){

    $postID = $comment->comment_post_ID;
    $listing_type_id = get_post_meta( $postID, ESB_META_PREFIX.'listing_type_id', true );
    $rating_fields = easybook_addons_get_rating_fields($listing_type_id);

    $average_key = ESB_META_PREFIX.'rating_average';
    $count_key = ESB_META_PREFIX.'rating_count';

    $rating_count = get_post_meta($postID, $count_key, true);

    if((int)$rating_count > 1){
        $rate_cacl = array();
        if (!empty($rating_fields)) {
            foreach ($rating_fields as $key => $field) {
                $rFieldName = $field['fieldName'];
                $listing_rfield_average = get_post_meta($postID, ESB_META_PREFIX.$rFieldName, true);
                $rating_field_val = get_comment_meta($comment->comment_ID, ESB_META_PREFIX.$rFieldName, true);
                if( (int)$listing_rfield_average > 0 ){
                    update_post_meta($postID, ESB_META_PREFIX.$rFieldName,round((($listing_rfield_average * $rating_count - (int)$rating_field_val)/ ($rating_count-1)), 1, PHP_ROUND_HALF_UP));
                }else{
                    update_post_meta($postID, ESB_META_PREFIX.$rFieldName, (int)$rating_field_val); 
                }
                $rate_cacl[] = (int)$rating_field_val; 
            }
        }
        $comment_total_rating = 0;
        if (!empty($rate_cacl)){
            $comment_total_rating = round((array_sum($rate_cacl) / count($rate_cacl)), 1, PHP_ROUND_HALF_UP);
        }

        if($comment_total_rating != ''){
            $listing_rsum_average = get_post_meta($postID, $average_key, true);

            update_post_meta($postID, $average_key,round((($listing_rsum_average * $rating_count - $comment_total_rating)/ ($rating_count-1)), 1, PHP_ROUND_HALF_UP));
            update_post_meta($postID, $count_key, $rating_count-1);
        }

    }else{
        update_post_meta($postID, $average_key, 0);
        update_post_meta($postID, $count_key, 0);
        if (!empty($rating_fields)) {
            foreach ((array)$rating_fields as $key => $field) {
                update_post_meta($postID, ESB_META_PREFIX.$field['fieldName'], 0);
            }
        }
    }
}
// delete comment
add_action( 'delete_comment', function($comment_ID, $comment){
    easybook_addons_comment_approved_to_unapproved( $comment );
}, 10, 2 );


// modify comment template for listing post
add_filter( 'comments_template', function ( $template ) {
    $queried_object = get_queried_object();
    if (isset($queried_object->post_type) && $queried_object->post_type == 'listing') {
        return ESB_ABSPATH .'inc/comments.php';
    }
    return $template;
});

function easybook_addons_move_comment_field_to_bottom( $fields ) {
    $queried_object = get_queried_object();
    if (isset($queried_object->post_type) && $queried_object->post_type == 'listing') {
        $comment_field = $fields['comment'];
        unset( $fields['comment'] );
        $fields['comment'] = $comment_field;
        return $fields;
    }
    return $fields;
}
 
add_filter( 'comment_form_fields', 'easybook_addons_move_comment_field_to_bottom' );

function easybook_addons_change_submit_button( $submit_button ) {
    $queried_object = get_queried_object();
    if (isset($queried_object->post_type) && $queried_object->post_type == 'listing') {
        return '<button class="btn  big-btn  float-btn color2-bg" type="submit">'.__( 'Submit Comment <i class="fal fa-paper-plane" aria-hidden="true"></i>', 'easybook-add-ons' ).'</button>';
    }
    return $submit_button;
}
 
add_filter( 'comment_form_submit_button', 'easybook_addons_change_submit_button');

function easybook_addons_comment_rating_field(){
    
    if(!easybook_addons_get_option('single_show_rating')) return;
    $queried_object = get_queried_object();
    if (isset($queried_object->post_type) && $queried_object->post_type == 'listing') {
    $rating_base = (int)easybook_addons_get_option('rating_base');
    // var_dump($rating_base);
    $comment_post_ID = $queried_object->ID; 
    // var_dump($comment_post_ID);
    $listing_type_id = get_post_meta( $comment_post_ID, ESB_META_PREFIX.'listing_type_id', true );
    // var_dump($listing_type_id);
    $rating_field = easybook_addons_get_rating_fields($listing_type_id);
    // var_dump( $rating_field);
    // 
    $js_cals = array();
    if ($rating_field != null && !empty($rating_field)) {
    ?>
        <div class="review-range-container">
            <?php
            foreach ($rating_field as $key => $fields) {
                // var_dump($field);
                 $field = json_decode(json_encode($fields), true);
                  // var_dump($field);
                $js_cals[] = '{'.$field['fieldName'].'}'
                ?>
                  <!-- review-range-item-->
                <div class="review-range-item">
                    <div class="range-slider-title"><?php echo $field['title'] ?></div>
                    <div class="range-slider-wrap ">
                        <input type="text" class="rate-range" data-min="0" data-max="<?php echo $field['rating_base']; ?>"  name="<?php echo $field['fieldName'] ?>"  data-step="1" value="<?php echo  $field['default']?>">
                    </div>
                </div>
                <!-- review-range-item end --> 
            <?php 
                }
               
            ?>            
        </div>
        <?php if (count($rating_field) > 1): ?>
            <div class="review-total">
                <span class="reviews-total-score" id="reviews-total-score">0</span> 
                <!-- <span><input type="text" class="esb-auto-calc" name="rg_total" jAutoCalc="<?php echo '('.implode('+',$js_cals).')/'.count($js_cals);?>" value="0"></span>    -->
                <strong><?php _e( 'Your Score', 'easybook-add-ons' ); ?></strong>
            </div>
        <?php endif;?>
    <?php
        }
    if( easybook_addons_get_option('allow_rating_imgs') == 'yes' ): ?>
    <div class="leave-rating-imgs-wrap clearfix">
        <?php 
            easybook_addons_get_template_part( 'template-parts/images-upload', false, array( 'is_single'=>false, 'name'=>'rating_imgs[]', 'desc_text' => __( '<i class="fa fa-picture-o"></i> Rating images', 'easybook-add-ons' ) ) );
        ?>
    </div>
    <?php endif; 
    }
}

add_action('comment_form_before_fields','easybook_addons_comment_rating_field');
add_action('comment_form_logged_in_after','easybook_addons_comment_rating_field');



/**
 * Custom comments list
 *
 * @since EasyBook 1.0
 */
if (!function_exists('easybook_addons_comments')) {
    function easybook_addons_comments($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        extract($args, EXTR_SKIP);
        
        if ('div' == $args['style']) {
            $tag = 'div';
            $add_below = 'comment';
        } 
        else {
            $tag = 'li';
            $add_below = 'div-comment';
        }
?>
        <<?php
        echo esc_attr($tag); ?> <?php
        comment_class(empty($args['has_children']) ? 'reviews-comments-item comment-nochild' : 'reviews-comments-item comment-haschild') ?> id="comment-<?php
        comment_ID() ?>">
        <?php
        if ('div' != $args['style']): ?>
        <div id="div-comment-<?php
            comment_ID() ?>" class="comment-body thecomment">
        <?php
        endif; ?>

            <div class="review-comments-avatar">
                <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size'], 'https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s='.$args['avatar_size'], get_comment_author( $comment->comment_ID )); ?>
            </div>
            <div class="reviews-comments-item-text">
                <h4><?php echo get_comment_author_link($comment->comment_ID); ?>
                <?php
                if(is_singular() && $comment->comment_post_ID != get_the_ID()) { 
                    echo esc_html__( ' on ', 'easybook-add-ons' ) . sprintf( '<a href="%1$s" class="reviews-comments-item-link">%2$s</a> ',
                                                        esc_url( get_the_permalink( $comment->comment_post_ID ) ),
                                                        esc_html( get_the_title( $comment->comment_post_ID ) )
                                                    );
                }
                ?>

                </h4>
                <?php 
                    $rate_cacl = array();
                    $listing_type_id = get_post_meta( $comment->comment_post_ID, ESB_META_PREFIX.'listing_type_id', true );
                    // var_dump( $comment->comment_post_ID);
                    // var_dump( $listing_type_id);
                    $rating_fields = easybook_addons_get_rating_fields($listing_type_id);
                    // var_dump( $rating_fields);
                    if (!empty($rating_fields)) {
                        foreach ((array)$rating_fields as $key => $field) {
                            // $field = json_decode(json_encode($fields), true);
                            $rate_cacl[] = get_comment_meta($comment->comment_ID,ESB_META_PREFIX.$field['fieldName'], true);
                            // $field['fieldName'] = get_comment_meta($comment->comment_ID,$field['fieldName'], true);
                         }
                    }
                    // var_dump($rate_cacl);
                    // var_dump(count($rate_cacl));
                    if (!empty($rate_cacl)){
                        $total_rating = round((array_sum($rate_cacl) / count($rate_cacl)), 1, PHP_ROUND_HALF_UP);
                    }
                    // var_dump( $total_rating);

                ?>
                <?php easybook_addons_rating_score($total_rating);?>
                <div class="clearfix"></div>
                <?php comment_text(); ?>
                 <?php 
                $rating_imgs = get_comment_meta( $comment->comment_ID, 'rating_imgs', true );
                if(easybook_addons_get_option('allow_rating_imgs') == 'yes' && !empty($rating_imgs)):
                ?>
                    <div class="leave-rating-imgs clearfix lightgallery rating-imgs-<?php echo easybook_addons_get_option('submit_media_limit', 3); ?>">
                        <?php 
                        foreach ( (array)$rating_imgs as $id => $url) {
                            ?>
                            <div class="rating-img">
                                <a class="popup-image" href="<?php echo wp_get_attachment_url( $id ); ?>">
                                    <?php echo wp_get_attachment_image( $id, 'thumbnail', false, array('class'=>'resp-img') ); ?>
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                <?php endif;?>
                <div class="comment-text-sep"></div>
                <span class="reviews-comments-item-date"><i class="fa fa-calendar-check-o"></i><?php echo get_comment_date(esc_html__('F j, Y g:i a', 'easybook-add-ons')); ?></span>
                <span class="review-item-reply"><?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
                <?php
                if ($comment->comment_approved == '0'): ?>
                        <em class="comment-awaiting-moderation alignleft"><?php
                    esc_html_e('The comment is awaiting moderation.', 'easybook-add-ons'); ?></em>
                        <br />
                    <?php
                endif; ?> 
            </div>       
        <?php
        if ('div' != $args['style']): ?>
        </div> 
        <?php
        endif; ?>

    <?php
    }
}
function easybook_addons_rating_text($score = ''){
    if((int)easybook_addons_get_option('rating_base') == 10) $score /= 2;
    $score = floatval($score);
    $score_text = __( 'No rating', 'easybook-add-ons' );
    if($score >= 5) 
        $score_text = __( 'Very Good', 'easybook-add-ons' );
    elseif($score >= 4) 
        $score_text = __( 'Good', 'easybook-add-ons' );
    elseif($score >= 3) 
        $score_text = __( 'Pleasant', 'easybook-add-ons' );
    elseif($score >= 2) 
        $score_text = __( 'Bad', 'easybook-add-ons' );
    elseif($score >= 0.5) 
        $score_text = __( 'Very Bad', 'easybook-add-ons' );

    return $score_text;
}
function easybook_addons_rating_score($score = '', $classes = 'review-score-user'){
    if (!empty($score) && is_numeric($score) ): ?>
        <div class="<?php echo esc_attr( $classes ); ?>">
            <span class="review-value"><?php echo $score; ?></span>
            <strong class="review-text"><?php echo easybook_addons_rating_text($score); ?></strong>
        </div>
    <?php endif;
}
