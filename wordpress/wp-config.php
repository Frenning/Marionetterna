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
define('DB_NAME', 'marionetterna_se');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('WP_HOME','http://localhost/marionetterna/wordpress/'); 
define('WP_SITEURL','http://localhost/marionetterna/wordpress/');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'x KQZ}(uZ%]%Z=_ZwDUl#6:OhHB2/;Q^i/SmJQk$lyEX;A8PwkE-6N)zm &,pM1B');
define('SECURE_AUTH_KEY',  ' Q4a(wt^@?eB/=a~DhRg{io|LyHKTsg<jN(Zgr@vR*L4qmJuL1eLnP3SW)ms2XH`');
define('LOGGED_IN_KEY',    ' 4#6CbTny#Lcxt:D)DRA53AtbtZ7vqPF n$2{BpjtL#1eSlSsGLcM?#8yU/ldc05');
define('NONCE_KEY',        '1JgaHO1z~]DLI8y^qQI^S8A~_ZB%V=jhI]wg< Gi6NWL%!`YY)i[di=Amh3WYL6-');
define('AUTH_SALT',        'x=Sui}b[iPR* e@:VjapE^=5{kGVi_IH0i2=9Dd~jqY $3OXafBE?H|(>svkw*Au');
define('SECURE_AUTH_SALT', '+V+i/kh}<07`9;J-d,yAF^Z$V(@u-7jcOR2psGk.:sgP%-A6dijX, GFtC~UXFk|');
define('LOGGED_IN_SALT',   'T)$Eur{e)}?| {7^$=0-1(+}fT*G9gJlu=g=+!U/doJw#:ip*`oAK9(v,D0(_AQn');
define('NONCE_SALT',       'jcbJB107^.4/5BajP/vxmdou606hsS.8AJM$JO@e,u|yK$BAm;G+QB=@+s%<Q4j;');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
