<?php
define( 'WP_CACHE', true );

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
define( 'DB_NAME', 'u505131560_vaays' );

/** Database username */
define( 'DB_USER', 'u505131560_ALphE' );

/** Database password */
define( 'DB_PASSWORD', 'BWS0aG35Fb' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',          'w=aRYt/F(zCHR16pkWvuw&hP%9GT`c8 :Rb 7|=Of7o}yEf(aRx=>lf?dM)<>Ntk' );
define( 'SECURE_AUTH_KEY',   'alEt,|X[IoV_Y6whzP$;.cu-AGf2_9.vB;=g-/;z0OsnGlc;Ei{=:NTyy]XR|aI*' );
define( 'LOGGED_IN_KEY',     'gE.vV7`u/x#8JvY{69rT<Qcaa]Y_%^}d4;,Vk.KWvi2x(mANWv9,>|N)F 7jd~.)' );
define( 'NONCE_KEY',         ' (=(W_m^7BJ/La}r5)u!kTJ)Zf/R@(4.UBS1FXYB{!@GTSPJKs@J_|:LPVH6+=f0' );
define( 'AUTH_SALT',         'I?ZpCC>j&:rf8ob`eyXSg-Ji9Js&!.-$P>I](#?tQsDa|}.Cxg`_DGh&yPi,yKk&' );
define( 'SECURE_AUTH_SALT',  '9PJNUBvN@+<Y=`L[2>2v}4BeGn5B,MYATMl[zqKbBx=VV1wC6+6 d;R~I6-g,Ivj' );
define( 'LOGGED_IN_SALT',    '^M%n)UiS`$kY)~rcOlH%tm!&>}[e4ajkO$rsn_<Bt~yWf<z:2k0XqVK@/OND2rp6' );
define( 'NONCE_SALT',        'XsB30A3<NZd[_ON>L exd^|xPBWuNmd`HF9O& !+&x*M3lK]FXZ/O@t3qmXW.xId' );
define( 'WP_CACHE_KEY_SALT', 'i=$AX0B?tynZ&zBDU`[wj9t4=X [xBqn4)F?|gYj.>_8j b5IM{dF8a~m+)Br6RB' );


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

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', 'f1fc9aef5b75e6be9c1b3ce5e8315d8b' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );

// Technical SEO / Performance Tweaks
define( 'WP_MEMORY_LIMIT', '256M' ); // Increase memory limit for faster processing
define( 'WP_POST_REVISIONS', 5 ); // Limit revisions to prevent database bloat
define( 'EMPTY_TRASH_DAYS', 7 ); // Empty trash sooner

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
