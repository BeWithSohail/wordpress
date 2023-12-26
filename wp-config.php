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

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         'F6Q<?0 Nwql`9nbD2!gS/.X1PjHL feD`|_M({Yr&d@@7p.kq7jutZQaJUxx?)`L' );
define( 'SECURE_AUTH_KEY',  'hL3{eF!q 7j>S0zT=!WK0%eVbA?@EUXjGNa|dmS0%$X5*1OT/#8y]Q<--9q`;W=A' );
define( 'LOGGED_IN_KEY',    '#w6p7NO%)t#^yz?UttkEWlkN=31tH)|sp~fIp{&_Ci@:i(^OEzMRXkf1so]l1mqQ' );
define( 'NONCE_KEY',        ' wR$zA.P5mrF{BTD*_u$rYGa#e7`R</qK8v?|$ NYWYmGDVK^Nh@NMN?ATCCc/ W' );
define( 'AUTH_SALT',        '$<5-b=!^o_y0z<%*d8GvwwRQ;/e]7P(ZrJ,{DUT8U<lV!GMv#D!Z5OO1WX3xqkCK' );
define( 'SECURE_AUTH_SALT', '+0~>Hm(bmHR%<jNfwX@m3E4xZwEF39pYm%s3%1J17$?_<>^#1[_P0#>w.wo}a&=x' );
define( 'LOGGED_IN_SALT',   '-A7AGU5!Fzwr;+,PE<Ez-Odb`ZHjZ(=+2yDQN=@cnJ}hHfGbpgB[PY6MD2:-GZaD' );
define( 'NONCE_SALT',       '|*i!ZIt ijZesnJ*D&*o[H`ub]KZ^A$8Ir${a.-f!bPk^jV/?5#M6;>?X8W2}p1d' );

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
