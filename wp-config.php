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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'volv-db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3306' );

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
define( 'AUTH_KEY',         'q@DK3Uzn:La&I^V{(h3k5W<MwHi{:|4:7eK&C33*Trd^oWjF{wb%)F{^G8,mFmy ' );
define( 'SECURE_AUTH_KEY',  '{$&j#8j?jK6.<wjTVUP0E%Tr%.2w%7<&#RQI2:[2[J5Gjf3{+(#DKoX3w{/O<CDc' );
define( 'LOGGED_IN_KEY',    '0CxnH#HGQnYo((ABCY]48EPwa$.D&W5nNL#&8u47jV]4cTBc=ajUMLl?r~M?Zb;w' );
define( 'NONCE_KEY',        ']r$xSP+wLyW:54cH/hkGOX%A}ecRbsto^a[5jyN:W*zf1/hdQFhWs?&4>*lI:Wm8' );
define( 'AUTH_SALT',        'xS-!ji6@DT[UB/Qx]h,O,-FE?[#V6t6!,{E4}Y)f#,Lw;51LdmTb@%d5N0H9ECB~' );
define( 'SECURE_AUTH_SALT', '!Y9Wy.ONj0KBMH*rps4Z/ DAyxqJH^#k&&iqomsELE|O$NT+:H`0.OarEs,{0`r-' );
define( 'LOGGED_IN_SALT',   'XEUwJ~h([~_se`G61= <[u_xDxtZ?#^Ffa?jiLhxbd+jn$NOr>P`AOn&CvrqPK:t' );
define( 'NONCE_SALT',       'D8cjf^:ALXH];E]I2mWz=4x&UJky9{<}2e&hs>ufaGy-mS)p-C>wfQXXF7hjmsl ' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
