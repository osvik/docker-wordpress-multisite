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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpressdb' );

/** MySQL database username */
define( 'DB_USER', 'generic' );

/** MySQL database password */
define( 'DB_PASSWORD', 'gfvcry35y@ehG1209' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'Qcw^t3<C{u5{Nyrc4sZmg_9]8V4/zEajdf(-f7@,]x8lOKBNw4Kk~yIDLIWBm[ F' );
define( 'SECURE_AUTH_KEY',  'x!vv.@2F&kkeO2L^h%_>EZ.|/^8o~tq(wNo8ZswB}p=P+lp(Y[ Wbbvf/fP<~|T|' );
define( 'LOGGED_IN_KEY',    '0OaB@yXGyc>5zw~!O=5R%3@Ogzxn;i xsxo~DwoF63uQ%cI1|W>(JTr_hp3k_08A' );
define( 'NONCE_KEY',        '6gAw;>_mWNz`%)2oc{t+L*4<A4CW>GK6k%e:.lSf|7=qVL0Uzk;F9gbhK Q}+4Rv' );
define( 'AUTH_SALT',        ',s=IIP~UcE8qb-p%-muybS]I3W7~w/?3@-Eb#Bp|j^-mVQw*frD.h#4_<,0RYN%L' );
define( 'SECURE_AUTH_SALT', 'Kpwt4Z.Vl?_,c-z0(^O,>{K-W;]{$.u,rOvdQr]f`V0sG#W>X~!-.(bCloeGaPhE' );
define( 'LOGGED_IN_SALT',   'kw[7cmdWHk{m@+r3e}OK(.9hNl bH#%9yxQ,9L3Z!dW[<wup6|(T,]Tipo}1F/=t' );
define( 'NONCE_SALT',       '*zl.XBFa{{`RblUz]vyHGXQV7+E&cf85a]fnKxj>@&YxcgFLAD_WDI{L7T$:syJV' );

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
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );

/* Add any custom values between this line and the "stop editing" line. */

define( 'WP_ALLOW_MULTISITE', true );
define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', false );
define( 'DOMAIN_CURRENT_SITE', 'localhost' );
define( 'PATH_CURRENT_SITE', '/' );
define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
