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
// define( 'DB_NAME', 'talends_2024' );

// /** Database username */
// define( 'DB_USER', 'root' );

// /** Database password */
// define( 'DB_PASSWORD', 'Pass@123' );

define( 'DB_NAME', 'talends_2024_sep' );

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
define( 'AUTH_KEY',         'D4Hd>Xt>4yysF^?%{~og2K3el!ki>x^1}(I)/vdw(1p) eu miZkj1k^p.vy![pm' );
define( 'SECURE_AUTH_KEY',  'f}s@<q^5TOy=C!_Qd3vRlx]//m}UejOdmu6 ^onm9IfFYC?@hHg^iq,=A`pu.JF6' );
define( 'LOGGED_IN_KEY',    '*hIm}>cYGX3r{;<#C.1`9{Cf:BrbS9zFmvts#O9XVb_:VF6O5A<c?n3dE1Jzim?F' );
define( 'NONCE_KEY',        '[]obX+_JqsN*vN}e987M3/6}.s=B/fgR/yITH05f8O =a>&}GLp+^8 _Q?7!_,HI' );
define( 'AUTH_SALT',        '4?B#T^d,wLPlyztPHwE=`w.V].z<:,5aiN0toZAIrzDFjMsLtc*6W&yTIx7od1CC' );
define( 'SECURE_AUTH_SALT', '-f};zw?5p]pg,[G.@yiL@=W$B`77qO6K~oSq#D$G10l14k5}P2pf?]D0]Vwxxl&h' );
define( 'LOGGED_IN_SALT',   'e)AVXO^>EV$IHTx:vd,Mq,%FG<|qnAd8`)iY3FKI]xHeN=Q9q-bCQnScz<6FaTF)' );
define( 'NONCE_SALT',       '<_kwGp/*#mEd`~~u2[]}2,qr*8;?b2Urg<#o,XJSbFs:abORZWMSO&1!sB} PhAR' );


/** Custom WordPress URLs */
// define('WP_HOME', 'http://3.82.196.218');
// define('WP_SITEURL', 'http://3.82.196.218');

define('WP_HOME', 'http://wp_talends.test');
define('WP_SITEURL', 'http://wp_talends.test');
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
define( 'WP_DEBUG', true );
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', true); // Keep false for production

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
