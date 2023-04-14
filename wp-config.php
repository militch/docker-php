<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

if (!function_exists('getenvs')) {
	// https://github.com/docker-library/wordpress/issues/588 (WP-CLI will load this file 2x)
	function getenvs($env, $default) {
		if ($fileEnv = getenv($env . '_FILE')) {
			return rtrim(file_get_contents($fileEnv), "\r\n");
		}
		else if (($val = getenv($env)) !== false) {
			return $val;
		}
		else {
			return $default;
		}
	}
}

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', getenvs('WORDPRESS_DB_NAME', 'wordpress'));

/** Database username */
define( 'DB_USER', getenvs('WORDPRESS_DB_USER', 'wordpress'));

/** Database password */
define( 'DB_PASSWORD', getenvs('WORDPRESS_DB_PASSWORD', 'example password'));

/** Database hostname */
define( 'DB_HOST', getenvs('WORDPRESS_DB_HOST', 'mysql'));

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', getenvs('WORDPRESS_DB_CHARSET', 'utf8'));

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', getenvs('WORDPRESS_DB_COLLATE', ''));

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         getenvs('WORDPRESS_AUTH_KEY', 'put your unique phrase here'));
define( 'SECURE_AUTH_KEY',  getenvs('WORDPRESS_SECURE_AUTH_KEY', 'put your unique phrase here'));
define( 'LOGGED_IN_KEY',    getenvs('WORDPRESS_LOGGED_IN_KEY', 'put your unique phrase here'));
define( 'NONCE_KEY',        getenvs('WORDPRESS_NONCE_KEY', 'put your unique phrase here'));
define( 'AUTH_SALT',        getenvs('WORDPRESS_AUTH_SALT', 'put your unique phrase here'));
define( 'SECURE_AUTH_SALT', getenvs('WORDPRESS_SECURE_AUTH_SALT', 'put your unique phrase here'));
define( 'LOGGED_IN_SALT',   getenvs('WORDPRESS_LOGGED_IN_SALT', 'put your unique phrase here'));
define( 'NONCE_SALT',       getenvs('WORDPRESS_NONCE_SALT', 'put your unique phrase here'));

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = getenvs('WORDPRESS_TABLE_PREFIX', 'wp_');

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', !!getenvs('WORDPRESS_DEBUG', ''));

/* Add any custom values between this line and the "stop editing" line. */

if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false) {
	$_SERVER['HTTPS'] = 'on';
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

