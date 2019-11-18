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
<div class="team-box-wrap">
    <?php 
    $mem_img = '';
    if(!empty($member['id_image'])){
        $mem_img = reset($member['id_image']);
    }
    if(!empty($mem_img)):
    ?>
    <div class="team-photo">
        <?php echo wp_get_attachment_image( $mem_img, 'full', false, array('class'  => 'respimg') ); ?>
    </div>
    <?php endif; ?>
    <div class="team-info">
        <?php if(!empty($member['name'])): ?><h3 class="entry-title"><?php echo $member['name'];?></h3><?php endif; ?>
        <?php if(!empty($member['job'])): ?><h4><?php echo $member['job'];?></h4><?php endif; ?>
        <?php if(!empty($member['desc'])): ?><p><?php echo $member['desc'];?></p><?php endif; ?>
        <?php if(!empty($member['socials'])): ?>
        <ul class="team-mem-socials">
            <?php 
            foreach ($member['socials'] as $key => $social): 
                 echo '<li><a href="'.esc_url( $social['url'] ).'" target="_blank" ><i class="fab fa-'.esc_attr( $social['name'] ).'"></i></a></li>';
            endforeach ?>
        </ul>
        <?php endif; ?>
    </div>
</div>