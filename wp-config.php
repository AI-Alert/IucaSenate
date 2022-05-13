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
define( 'DB_NAME', 'senate' );

/** Database username */
define( 'DB_USER', 'iuca_senate' );

/** Database password */
define( 'DB_PASSWORD', 'C_KdvD2CEYb8HqWf' );

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
define( 'AUTH_KEY',         '}MlsS){>eJXCyIT@9.Ftp(5<nqOO*M5D$5aVHE*=BeLxC;ZUJ9szA6_jOe>jO(6d' );
define( 'SECURE_AUTH_KEY',  'yhe~*w>I,tPb72tvuWZzxV|TP+Uq1j8hfTUscR<G-J[I$X;ij>!q{dDmMTLCd(42' );
define( 'LOGGED_IN_KEY',    '~7Q+CK80~- Te6s6sI_f~0ngpXb:B}w$o^FADwr{h<BJ>R/TY3ffC2bmIal2l^xo' );
define( 'NONCE_KEY',        'boW23EOX`%0_(1a7&Qn~^gTxp,v6DO$,HflCApejG1eW gz&fgvsF@r)1C]D>Ek8' );
define( 'AUTH_SALT',        'G@6Y?A524&/6,&RFKpqfd&QJTN)fSqQN(bifXSETA^#DP-q)Ae Fuhn5NY {s47~' );
define( 'SECURE_AUTH_SALT', 'p^hp~BAJXGVB!S[GmWZ`/GiZf|2]l$RW@+ginAq}E*=;gv)L?Kxt{}5u*`Dt0}lA' );
define( 'LOGGED_IN_SALT',   '=WVW/!+wX !A9370$v4|E$`E8Gz>x46uAQW?Mz-B5UM$mGx_QZhSP34XRiaWv,pr' );
define( 'NONCE_SALT',       'EEVbPt^(c57&1o9wVvD,(p>~/IvM`zMJI#z%?LV+b8-gp}oKRM*eJv3E0T ?!WJa' );

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
