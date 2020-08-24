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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

/** ATTENTION! - The following values are used in the initialization of the container.
* You must only provide VALID values and avoid the usage of quotation marks */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bitnami_wordpress' );

/** MySQL database username */
define( 'DB_USER', 'bn_wordpress' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'mariadb:3306' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',         'w8JTuSbkMKgqiUKZlbRuB89DGdy7Y2p0' );
define( 'SECURE_AUTH_KEY',  'XeooaIp8ODWF1daRmhSyt7LkL0UaZ4di' );
define( 'LOGGED_IN_KEY',    'gU6G0VG5FGw9zS5KnAuf1mMdP4duE8wa' );
define( 'NONCE_KEY',        'fDqWsrdPh5R68SFjhzcOFbuz9GtLqvk9' );
define( 'AUTH_SALT',        'hhgn3DoAXQXlJk2u8GHcTwwfurxsCWjb' );
define( 'SECURE_AUTH_SALT', 'ZtHxD1E8aSVUiXZbVdjK3umaywOUtNQ3' );
define( 'LOGGED_IN_SALT',   'wec9rJJ5F6HojdLC0FlPZa52J8MpDhOC' );
define( 'NONCE_SALT',       'sf9eMR4N8KBGi5GyOJ70L9IrBhPwU6G9' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

define('WP_PLUGIN_DIR', '/bitnami/wordpress' . '/wp-content/plugins');
/* That's all, stop editing! Happy publishing. */


if ( defined( 'WP_CLI' ) ) {
  $_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/');
define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/');
define('FS_METHOD', 'direct');
/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {
	define('ABSPATH', '/opt/bitnami/wordpress' . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

define('WP_TEMP_DIR', '/opt/bitnami/wordpress/tmp');

if ( !defined( 'WP_CLI' ) ) {
//  Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
//  More info at: https://wiki.bitnami.com/Applications/Bitnami_WordPress#XMLRPC_and_Pingback

// remove x-pingback HTTP header
add_filter("wp_headers", function($headers) {
            unset($headers["X-Pingback"]);
            return $headers;
           });
// disable pingbacks
add_filter( "xmlrpc_methods", function( $methods ) {
             unset( $methods["pingback.ping"] );
             return $methods;
           });
}
