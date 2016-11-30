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
// ** MySQL settings - You can get this info from your web host ** //
 /** The name of the database for WordPress */
 define('DB_NAME', $_ENV['OPENSHIFT_APP_NAME']);
 /** MySQL database username */
 define('DB_USER', $_ENV['OPENSHIFT_MYSQL_DB_USERNAME']);
 /** MySQL database password */
 define('DB_PASSWORD', $_ENV['OPENSHIFT_MYSQL_DB_PASSWORD']);
 /** MySQL hostname */
 define('DB_HOST', $_ENV['OPENSHIFT_DB_HOST']);
 /** Database Charset to use in creating database tables. */
 define('DB_CHARSET', 'utf8');
 /** The Database Collate type. Don't change this if in doubt. */
 define('DB_COLLATE', '');
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '^v*4dy&u R;OvAjfA[6`oXD7{Xch[PE&oS.=)~KCm#K|)@HItI+1AQBlCu`,Jlx=');
define('SECURE_AUTH_KEY',  'fgJZ&@8&$kc/p7(Fd2m2D&l5RAv#@->-% ty<pbh(]?M.u&EN?9TDwlfI.J1e^wj');
define('LOGGED_IN_KEY',    'N&twPiG$sma33ZLc63S4o|G?F~n0 5H*7@t?*^  `FqQ5Ddbd8YJ**D?(<`h|<iJ');
define('NONCE_KEY',        '=*|<Cu)t-&!V62N6x0O/~K[B$]?^EGUUE=sX.qE18wu8l^z3B]h+3kAp3|iH4SHI');
define('AUTH_SALT',        'IcbU=_T<s.%[-Nt9kD?b#+|1zd6 R^.t-|S[3T>DbqmjRT+89yeS{=^-<={+Kc8.');
define('SECURE_AUTH_SALT', '%hV-`#f]}0V)5tu6aTb)#l(NcBK<sH-|O0^p`lf7n>^8YH6jT8/07DYz7XK`&vny');
define('LOGGED_IN_SALT',   'N:QAVCaNeL?AwHf`Y8H8nxZ8gJ5My_t<WMQk6umob=V.EGbo03 )Z5X5+2Cy~S#o');
define('NONCE_SALT',       '~RYl_5u6/qY>)NaoZYh+NjrI)ga[,??:s,:d70C!6D(5;f}l#ARi1=s3>M+TLK;4');

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
