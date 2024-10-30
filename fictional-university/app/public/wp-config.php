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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}


define('AUTH_KEY',         'elHwBMsvsTlnvoyJKOQcfTRvH0th0/KBYTZNxycq7yis2tu0Xdt6f9MSFDtKDFO83NRjJl4gUPRAkwLnPje9Gg==');
define('SECURE_AUTH_KEY',  'mIUPDroxGXqpc1/E/3upwFpfS1qPBTeXxnpG70mA7Aw99ZFQ743mm7u55mD2dnKvaaFlN4mxhKQ52QrKJ59l5A==');
define('LOGGED_IN_KEY',    'MR07LN32s/lb0p7+Zf94D988/aVeaX5fhlVHyQhqYYJ/jpqZOAc1tDtlyDuRgdhjz1ysB3EEjJHYyhwnTvRPsw==');
define('NONCE_KEY',        '8yh6YA4DPlQsIpOLKrf8a822zGkNx8PsNurhQXjL8/clhTJg4ZjFrSoT6EHzj0ncMaUJPyIwsaSAnUHidKIk1Q==');
define('AUTH_SALT',        'gkfbLrFdqCgW8pPdnAMxYkBaETOG+wOUpIyydb46mgh2ySK7O5OTbWj+r5RUE2cA7/ChITzBnkS1b3pxN+KDOQ==');
define('SECURE_AUTH_SALT', 'VUFT7XxcxCPvzkmc4/dehEjq/TCIy96H0pYrl5jfZweJsL5bchk0YYorLVi5MoVhEDKliTkDtjc5xNgY1NJ4Vw==');
define('LOGGED_IN_SALT',   'HilRz+2lC73gAWSDS6CaxfuqF4QAgPRCfOJnrOG7XX0e8OTA4DUl+Q2i5SfwAVpZTXyUhfFFMVUuwexRrDU0KA==');
define('NONCE_SALT',       '4CWdbYTR9BPouKuO1/Lvh9gb65P7muXz5ddBKbP1tV1YNAJalhcO4ymKA8gIOXtdPXHUAbbJDVLga1p/kztCiQ==');
define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
