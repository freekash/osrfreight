<?php
/**
 * @package EasyBook - Hotel & Tour Booking WordPress Theme
 * @author CTHthemes - http://themeforest.net/user/cththemes
 * @date 03-10-2019
 * @since 1.1.7
 * @version 1.1.7
 * @copyright Copyright ( C ) 2014 - 2019 cththemes.com . All rights reserved.
 * @license GNU General Public License version 3 or later; see LICENSE
 */



?>
<div class="wrap">
    <form action="<?php echo esc_url( admin_url( 'options.php' ) ); ?>" method="POST">

        <?php 
            settings_fields( cththemes_auto_update()->get_slug() ); 

            do_settings_sections( cththemes_auto_update()->get_slug() );

            submit_button(); 
        ?>
    </form>
</div>