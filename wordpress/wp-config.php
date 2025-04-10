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
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'valur' );

/** Database username */
define( 'DB_USER', 'dev-db-usr' );

/** Database password */
define( 'DB_PASSWORD', 'B@list!c' );

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
define( 'AUTH_KEY',         'tqZC7N(yhQYBP(2M]5R}X),SJ$x7R)zx,UGJ8PwAeMhhu/n.H{_6iR8 (Bl<d5UT' );
define( 'SECURE_AUTH_KEY',  'vziBWE6TF5=pa#L1x7p@VByp9!Vu*&;F~Ayc@jSksR7fdKu(N:_>C9 Eal4.>7F[' );
define( 'LOGGED_IN_KEY',    'Pw}}wxb;L]ajUg3mkB3wgfi]vY=e(5YO3Vb_7a=[g,h.-NMSNI1/OoE{|M{{7vQR' );
define( 'NONCE_KEY',        ';eQe^Xf*#eli;}C7di~A)`<L<i>ZxX+!fN*TXw5zG<*s,~Rd$ 8D)qe/VS3si<^D' );
define( 'AUTH_SALT',        'Ln9m@UAkN.BfAJPQ&( =@^9.slL%r~:dK6#$4@i`8;l,1MfsK9fF6NBb{6<Cx~&S' );
define( 'SECURE_AUTH_SALT', 'Sn4g(J,@<?<`w5L[I/zKD|b)V9W5P<%y]boj/f.M*`){p0cXVui)d$+@Xnnx4|RP' );
define( 'LOGGED_IN_SALT',   'UhVtxx$RQ=bSArR6v{r`hzSvI;wpaGftg7+$Y5h(9Xx 9e>WF9g{nU!>U+Zu,mz@' );
define( 'NONCE_SALT',       '@iPv(>7Q1K9l<`ecH4@T(n JsPfS9ZHHF2hy1tiqW3,C+!}Q+R[13:,70{0+g{T0' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
