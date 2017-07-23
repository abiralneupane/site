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
define('DB_NAME', 'db_abiral');

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

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'e)t7OUOQlv3G5Qy0KI>f[)Ey}Z%2EQqmaD<[ @QTBGiE-6M>UHtb#NG).aTuqu_&');
define('SECURE_AUTH_KEY',  'z}i>5#AKzZMHCkFdN;vF?g%v$4GQhVZB`X5T}MnSs{DT %(BM1XUg*Mou!Dm62U(');
define('LOGGED_IN_KEY',    'ezYJ7bWKgr<AVQ0oA}hbbMF^6{;+mL*nEJwVK#fcEb1<-v]jQNLLIsZx#J((5ezL');
define('NONCE_KEY',        'Gpu%8JsX.[rVobnf{jbo$1Qw/dmX2eBX{7U*j%x)Z<oa5D5vz{$!P~c3YM5p&nxe');
define('AUTH_SALT',        '7_kVxH2OZ0.cD5H-6J=9/KLhO,|}6:]}9_?#9.V94,g*`g8{~iPp`Y|KH<&PB{uv');
define('SECURE_AUTH_SALT', '-J2FFo4Z~H}Me~>|tas+iay8&r5]6iSvoR.@JnH}Yuaf@pJa<E1Iz7k2[D&38;K{');
define('LOGGED_IN_SALT',   'X.M&>BU2pzdG>!Za`GqQz=p==pn%zk*T7)MmVZ.BoU$t-YC,lKF8Mo[!KzGk]#J1');
define('NONCE_SALT',       'n}G*]`2Sj;Q4g[~{jr;3%e1b@KKe]3rM8S<wAP%Mi24@)3t*Umuu&h;fc5x<Zcoe');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'abrl_';

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
