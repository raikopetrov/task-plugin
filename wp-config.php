<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
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

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'todo_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'Cw MscG;#[[]L.6D${|M=n8,-(Qphsc*c$~n5lfy2%OT-4SZy![b2NHJ`SY0P%c>' );
define( 'SECURE_AUTH_KEY',  '_m#!>E4EN)|kUc)>MR8l?C?4c;{2R} EfNGzk2I2C`i_1SyiXI~y2m%B,(AwJAm/' );
define( 'LOGGED_IN_KEY',    '|r_^sP{xn%QU^r=~QyuJ?9zh1nHv~4Qb|#P+wYmh:!U6K$Lu<|=eSA5MBeTr))#y' );
define( 'NONCE_KEY',        '.[NfVtO^m,{9$NA/vQaL_IpO&q7^P%WA?y^4n/o@Fa@7Nv)Kh2VFrhlp|N(hqvT&' );
define( 'AUTH_SALT',        '[+GoF4w#f83qwvh45r{GK`vh{nUGL3x1h%Bm&S_A:,$7R({<rP$y~UAA#RTaML)n' );
define( 'SECURE_AUTH_SALT', ':s0es$a8lT{UVa)SGd0zcr#BizKAu$?A}9gX(C&/ydcBxuv(77jjV`r#b:48GNNk' );
define( 'LOGGED_IN_SALT',   'E9hmq ]L4VOWgh_DF(CquM_l;q00Rlryav-O[y6;HOp@wSgF0?{Y=+Fm|}7HPtbI' );
define( 'NONCE_SALT',       'xGLFB6noyEiGfYg_l9n3%~tI9e<8Fe$7;(zY*QeC$EF0f+MXk</6${,9}}0bli5e' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
