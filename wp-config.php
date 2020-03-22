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
define( 'DB_NAME', 'vs_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '.E~ 2ZPr#)H.c//VGXm&gY+sGXAtDA%Ex^i*s0(38+Srog[ho2L+S&*6 jR:wj8o' );
define( 'SECURE_AUTH_KEY',  'vW6([m]+P=JnKtU9g:/m7&<,sIvJ*:zgEB`OSpv[Q#s7,e,=%UW]#DNXnusjlsmw' );
define( 'LOGGED_IN_KEY',    'yahx!uF$|14+9F`-e_?{]R0{Qn%,oSMTC^|e]RSqR+*p}Q[YzL5iwCPF@gM@g6+N' );
define( 'NONCE_KEY',        'M j9ouG=A02(hnk]!.h8JX4)zSlR$[9Z}B}+Q,J1eV}jmWquzkJ.meaasq%sw8bq' );
define( 'AUTH_SALT',        '2)#gPKH2Ui2~qF`B,,WO]w6|R]om+4N__z;YPO6C-E@M%1{Sf8>-Tcm[<*o`J:Fw' );
define( 'SECURE_AUTH_SALT', '+cEA||yx/5zA;/jQfmSOw`C| wjawy6jGn<W*!K^WP44V*Q^ttbXHLg}`UR`a|$K' );
define( 'LOGGED_IN_SALT',   'AWqp{l8/QYR@6G}Zu4nwx&>44I6xLUHv)W<XvCu%mN>d}?CEnsK`aK9!BLcTC%0k' );
define( 'NONCE_SALT',       '1Y6!S_zi[/ >S]3ad9QxGq-sYWiR+D+Q0EyM)-82#)Uh]`g9cr6vDErz1z@am%j`' );

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
