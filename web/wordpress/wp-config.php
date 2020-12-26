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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpressFinAi' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'UP23|ftT_C2|.//]>(11K7aF>Sb=yfz9ennRru5L]ba5WeEx>PY?uf#uu%XV~:u4' );
define( 'SECURE_AUTH_KEY',  '/fTOrM}e7na<22lA]+%7>{?1R):rGu7]XUZuZpFlxf]3`7v9xx<COMd>5[,Yz8pa' );
define( 'LOGGED_IN_KEY',    'tgMV>/pDt5ba3!NE1EnSIU`J-CA2>~KPHBNBF@0n%j!hJb9N)1)n7{[zRp%D~=>t' );
define( 'NONCE_KEY',        'aF2KD!B2JRvgi;i}J^!.SfN1:lvq>N3+=AfN:)M):X,hn`#MH%ma}y/02=zP~$*U' );
define( 'AUTH_SALT',        ')WP#  ,G}R1xgfq@Gq!,DiscX@4$ >2(8ogkKN:d9z~D daI[leDwAx0sS53u1:G' );
define( 'SECURE_AUTH_SALT', 'tWG+;mu1<eyxWb1mP*b #x4g,;|9>xX-yA(_g&C2J8ts.n$>$j`%B,Q8AiQ4@Et#' );
define( 'LOGGED_IN_SALT',   'pOYS <.CavLC< d0G D.z8{p !O3lm7ysIy5IseT`:J70!SE{bxP/1A%LSx  j;J' );
define( 'NONCE_SALT',       ',_ie]xC|OaECPs*AN|Kr2W]MW.ZLI`dJr;Tn7RPL(fbJH0p{PM;QRN7d,lt)#qqi' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
