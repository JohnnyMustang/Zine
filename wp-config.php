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
define('DB_NAME', 'zine_test');

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

/** Defining Multisite */

define('WP_DEBUG', false);

define('WP_ALLOW_MULTISITE', true);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'XG(=cMfe%D#! }NSo!OQrxU)I#2g1BTK_HBihT&FADzN7V0#)Shg)RO~(i#(<<@:');
define('SECURE_AUTH_KEY',  '@*~m~WTUPTMw/H~=qXI15DL=9?}>[SFcWv!M@XW)-[/[km<lr9UWhF+{i9<S6>$~');
define('LOGGED_IN_KEY',    ';fD]Aesl>43(iu=OW:D5@bE{f!II !/7v+`1=7m.Bm#`1.*^wZJFyw8>^&UGUicz');
define('NONCE_KEY',        'R0:m9J1Wh`%5%W2Z/Ca6:QZPYmmvRAE31.krvK@RP^]aU/pfAKLCdx5HK)nAnDzs');
define('AUTH_SALT',        'rTd7b7*#BUzKlwewZH;;xx|e[v`_ M>k?[;mB$`]&I4ZXYl8C.99.}=N^YtFOL@~');
define('SECURE_AUTH_SALT', 'glSlU6cHy&>/EAVY!w`9aujDvIM@c #lWcmpJM,T,l7W7l8Y@B7}ey1~|+>UotCK');
define('LOGGED_IN_SALT',   '_H`r!`@(=C<`u7-uAzQI>@,QNqf+UAp3<&7Fg|cz;<#k|06# A;T}wtw5tx$Vdwh');
define('NONCE_SALT',       'UeOsW=N_&A< oizz;YDW=(cllrK#~4&DVWhxcI?-)_GoK_v7e]k2^FdT>,R}Z!;g');

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
