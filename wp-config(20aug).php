<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/** Enable W3 Total Cache Edge Mode */
define('W3TC_EDGE_MODE', true); // Added by W3 Total Cache


/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'studykik_studykik');

/** MySQL database username */
define('DB_USER', 'studykik_study');

/** MySQL database password */
define('DB_PASSWORD', ',!y@E;zZZ+UJ');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
define('WP_MEMORY_LIMIT', '512M');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '8a:y2kcM)vf3o50s.uPBuzluXhqohD[,|E$0e~^Lm`B]jvQ(8K<a0wNv1l5ZE8Xm');
define('SECURE_AUTH_KEY',  ')X%>cRV!pPC)n!?}f2u/[8T%Y]Xi=61$nXJ +aXs4rXw[6Rt&UhMUx|D-0RM0(9f');
define('LOGGED_IN_KEY',    'D^]VHS[>M;%$PIOl02yqY60aM]8A<I>R;r |T04]eA[, p%w1<,R8K]!#ztMsxaJ');
define('NONCE_KEY',        '9(p.5#uVpzK7ocq{7NMY|pektGI7a}VpQ*Yu=OkL5K}g>D9y!VxycvBRz7s~V1*N');
define('AUTH_SALT',        '**H@m-8tf&6s_e7zG@5NUgQ%:)C@[Rmu~+>~&w%#TLtn+V+_f*j59 v;f)N:LAjo');
define('SECURE_AUTH_SALT', '-kuC&,phGq3-0G5;PQ?E&bhv/1/-?0K?I.&8P[M@c7P|z<9gd+MCkS<L sJlp.=A');
define('LOGGED_IN_SALT',   'Rc~H$#GZKQ(Z6ji~/)WNat/5PosG>AV`Lq@I04<?:WmdmF<K&jd?%YQ$),1{e%~A');
define('NONCE_SALT',       'ZpI}S5D3];~J*$mGI ]bgys`_g<}+K%x_p!:#eb+ lFPa~Qau/m0JGP<+,?D8PK>');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = '0gf1ba_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
//Disable File Edits
define('DISALLOW_FILE_EDIT', true);
unset($_GET['name']);

@ini_set('display_errors', 0);

