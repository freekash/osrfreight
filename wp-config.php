<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'krushqbd_wp747' );

/** MySQL database username */
define( 'DB_USER', 'krushqbd_wp747' );

/** MySQL database password */
define( 'DB_PASSWORD', 'OSb(98)r7p' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'ad26qfuhpx24dlelr3pj7tult2rjwbx1twjhk60fvaduhe6dryirzw0qfgzj1hh1' );
define( 'SECURE_AUTH_KEY',  '0qw9koxz5biih0pa9o5kndhf5qjorcerqsivazrybyimumdicxjdvwpfokbiofya' );
define( 'LOGGED_IN_KEY',    'dakcam2kfa66acljyyxbrioq3k61wghir5csxaaxym6skyi7axkrcc2lspatosny' );
define( 'NONCE_KEY',        'izzfjqhkjy9fdwhnawjlilbalcmgecpjyab1hhalrgqhdsdbknyjjsfs8gwqheof' );
define( 'AUTH_SALT',        'xmbdo2zydkduehb0silzw81bwoq8dkvaxm4winceflfmc3v42crnl4lktzlrm0x9' );
define( 'SECURE_AUTH_SALT', 'kxc52fgph3wbijxbtwjxjx1nx5fa9sv2gdci00skuiyclfcsiewwni7nvw7jfcat' );
define( 'LOGGED_IN_SALT',   'bvif9ncezno8x1oiwkzbpl2wxyh78fh2n3iwjdnu5hcptzqiemm9q0x3djoqfg17' );
define( 'NONCE_SALT',       'ff6xn6adkgszekmyv4int9nw5zfx14bkzllmrs2cuwsjomlkijbdxs0lwooeti1u' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp0f_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
