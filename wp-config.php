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
define( 'AUTH_KEY',         'Sl!9>Oiu@3K]}<EK::;[%i%Si(@jSN@$<h 0q)sHkOHR<_#v;6A8c|DDcc_BVd(%' );
define( 'SECURE_AUTH_KEY',  'c(n# Fp7$I9/RKR2Wyk$@F;VP:(!!tse7Q|>8QFTy7tJZKF(;rj?7^uoXV71q!A;' );
define( 'LOGGED_IN_KEY',    '2*O:N%Uu0RK!-K9Y)rD8>&0?;|(<?RoF|Yx1F]Cg9Eh|zSwKYB!,s|I!QXSQ?Vn,' );
define( 'NONCE_KEY',        'i)aWCGzLVN&XHTD99T9 t9t/`Xk#$%^4KXp%,b>AN?b43g=g?7VI092Jib.gm& G' );
define( 'AUTH_SALT',        'e,n7%KMY.[$iWS#Ftk(_Q0&9`3s!lg7#at&lBt^xeZ}}n_79=89Twugh`3vS:L|_' );
define( 'SECURE_AUTH_SALT', '`qKeND4?,<h _kG6VS#T,|Z^/g$FbNi;@FJF)piM{V63JjWaXa.nmEwli/.n}/)(' );
define( 'LOGGED_IN_SALT',   'v$FT:_]>bk[#7RCR~B{1I(Ng[e?pEoK,c5zf`O.^l]5,UN/AZ,.6f#5tMD8$aEZS' );
define( 'NONCE_SALT',       'a^<,vwXv 8;rLSH4E_;1_GU-1L3/nRDNrN1FSqE!?PqRz:4mvfm*qBbSxrC0!4XX' );

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
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
