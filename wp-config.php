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
define( 'AUTH_KEY',          'eLR.^0L21drk[K)l7R,swcS;TD8(:A:>Ev`5`|I4!rcm;*F+qOKM3GGcwaAXBt~u' );
define( 'SECURE_AUTH_KEY',   'Vgc)3qXF(`(IGsyX)hp,qK$.(T{Gb:bw:#ILS@jtyOg}cL,6wM-+(,PAT MD=JB-' );
define( 'LOGGED_IN_KEY',     '^uB_=jUl14{&,1[P|#&Saq=;m08sb5m(DsB%n.=:@s&?fPe,{^^B3p(?`4:(Vg-g' );
define( 'NONCE_KEY',         'cLW/WN>x-1v!pu1_1Gdi&x(BE$4zXz?qD^25UZF4oCtW>Zr<J|4Kb_aD>:2g51$ ' );
define( 'AUTH_SALT',         '</^kS&Mk+}g &m6<34lO>G_Tw?GYM.]w),i5PM(`i+(kB>]&~#=W[(Wa4R@0(Yo?' );
define( 'SECURE_AUTH_SALT',  'mgYzO[mV*wO-mX#_l7uRnHOU|V--cD>C]%@Sg>;Kq&gw_6hj+zhW~_6EsnfI1b2C' );
define( 'LOGGED_IN_SALT',    'sOIzP)$2}y*+%,l>!/k{-8)uI|`9#C<bf*+)!u#BS0H5WgDVh=9R4]oeK`~hH0.H' );
define( 'NONCE_SALT',        'I^o<bkvnz$rl?_wG^Ev)nBc{q!1_[oWRvhk)l?-:e@7Cyckx;zy>][YupL#$>f)g' );
define( 'WP_CACHE_KEY_SALT', 'R]W7,__8?SknS`=ZTU!Ego)6x(d4xORtub{SoywUB;$QA;}vc~+W*j%^QxNC02N0' );


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

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
