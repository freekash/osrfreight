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


//http://proteusthemes.github.io/one-click-demo-import/
//https://wordpress.org/plugins/one-click-demo-import/

function easybook_import_files() {
    return array(
        array(
            'import_file_name'             => esc_html__('EasyBook theme - Full Demo Content (widgets included)','easybook' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo_data_files/all-content.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demo_data_files/widgets.wie',
            'import_notice'                => esc_html__( 'EasyBook theme - Full Demo Content (widgets included).', 'easybook' ),
        ),

    );
}
add_filter( 'pt-ocdi/import_files', 'easybook_import_files' );

